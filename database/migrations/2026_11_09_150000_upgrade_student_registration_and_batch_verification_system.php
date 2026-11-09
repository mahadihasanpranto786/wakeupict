<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpgradeStudentRegistrationAndBatchVerificationSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Update courses table with unique course_code
        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                if (!Schema::hasColumn('courses', 'course_code')) {
                    $table->string('course_code', 20)->nullable()->unique()->after('course_title');
                }
            });

            // Backfill existing courses with unique two-digit codes
            try {
                $courses = DB::table('courses')->orderBy('id', 'asc')->get();
                $existingCodes = [];
                foreach ($courses as $index => $course) {
                    if (!empty($course->course_code)) {
                        $existingCodes[] = $course->course_code;
                        continue;
                    }

                    // Assign standard 2-digit code
                    $code = str_pad($course->id, 2, '0', STR_PAD_LEFT);
                    if (in_array($code, $existingCodes)) {
                        $counter = 1;
                        do {
                            $code = str_pad($counter, 2, '0', STR_PAD_LEFT);
                            $counter++;
                        } while (in_array($code, $existingCodes));
                    }
                    $existingCodes[] = $code;

                    DB::table('courses')->where('id', $course->id)->update([
                        'course_code' => $code,
                    ]);
                }
            } catch (\Exception $e) {
                // Silently handle if in raw migration environment
            }
        }

        // 2. Update batches table with batch_code, academic_year, dates
        if (Schema::hasTable('batches')) {
            Schema::table('batches', function (Blueprint $table) {
                if (!Schema::hasColumn('batches', 'batch_code')) {
                    $table->string('batch_code', 20)->nullable()->unique()->after('batch_number');
                }
                if (!Schema::hasColumn('batches', 'academic_year')) {
                    $table->string('academic_year', 10)->nullable()->after('batch_code');
                }
                if (!Schema::hasColumn('batches', 'start_date')) {
                    $table->date('start_date')->nullable()->after('academic_year');
                }
                if (!Schema::hasColumn('batches', 'end_date')) {
                    $table->date('end_date')->nullable()->after('start_date');
                }
            });

            // Backfill any existing batches
            try {
                $batches = DB::table('batches')->orderBy('id', 'asc')->get();
                foreach ($batches as $index => $b) {
                    if (empty($b->batch_code)) {
                        $cleanNum = preg_replace('/[^0-9]/', '', (string)$b->batch_number);
                        $bCode = !empty($cleanNum) ? str_pad($cleanNum, 2, '0', STR_PAD_LEFT) : str_pad($b->id, 2, '0', STR_PAD_LEFT);
                        DB::table('batches')->where('id', $b->id)->update([
                            'batch_code' => $bCode,
                            'academic_year' => $b->academic_year ?: date('Y'),
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Keep robust
            }
        }

        // 3. Update students table
        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                if (!Schema::hasColumn('students', 'registration_number')) {
                    $table->string('registration_number', 30)->nullable()->unique()->after('batch_id');
                }
                if (!Schema::hasColumn('students', 'registration_status')) {
                    $table->string('registration_status', 20)->default('pending')->after('registration_number');
                }
                if (!Schema::hasColumn('students', 'verified_by')) {
                    $table->unsignedBigInteger('verified_by')->nullable()->after('registration_status');
                }
                if (!Schema::hasColumn('students', 'verified_at')) {
                    $table->timestamp('verified_at')->nullable()->after('verified_by');
                }
                if (!Schema::hasColumn('students', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable()->after('verified_at');
                }
            });
        }

        // 4. Update student_accounts table
        if (Schema::hasTable('student_accounts')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                if (!Schema::hasColumn('student_accounts', 'registration_number')) {
                    $table->string('registration_number', 30)->nullable()->unique()->after('student_id_code');
                }
                if (!Schema::hasColumn('student_accounts', 'registration_status')) {
                    $table->string('registration_status', 20)->default('pending')->after('registration_number');
                }
                if (!Schema::hasColumn('student_accounts', 'verified_by')) {
                    $table->unsignedBigInteger('verified_by')->nullable()->after('registration_status');
                }
                if (!Schema::hasColumn('student_accounts', 'verified_at')) {
                    $table->timestamp('verified_at')->nullable()->after('verified_by');
                }
                if (!Schema::hasColumn('student_accounts', 'rejection_reason')) {
                    $table->text('rejection_reason')->nullable()->after('verified_at');
                }
            });

            // Mark existing student accounts as approved so no existing accounts break!
            try {
                DB::table('student_accounts')
                    ->where(function ($q) {
                        $q->whereNull('registration_status')
                          ->orWhere('registration_status', 'pending')
                          ->orWhere('registration_status', '');
                    })
                    ->update([
                        'registration_status' => 'approved',
                        'verified_at' => now(),
                    ]);
            } catch (\Exception $e) {
                // Keep robust
            }
        }

        // 5. Create registration_sequences table for transaction-safe pessimistic lock serial generation
        if (!Schema::hasTable('registration_sequences')) {
            Schema::create('registration_sequences', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('academic_year', 10);
                $table->string('batch_code', 20);
                $table->string('course_code', 20);
                $table->unsignedInteger('last_serial')->default(0);
                $table->timestamps();

                $table->unique(['academic_year', 'batch_code', 'course_code'], 'reg_seq_year_batch_course_unique');
            });
        }

        // 6. Create registration_verifications table for audit logging, rate limiting & admin approvals
        if (!Schema::hasTable('registration_verifications')) {
            Schema::create('registration_verifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->nullable()->index();
                $table->string('phone', 50)->index();
                $table->string('batch_code', 50)->index();
                $table->string('ip_address', 45)->index();
                $table->text('user_agent')->nullable();
                $table->unsignedInteger('attempts_count')->default(1);
                $table->string('status', 30)->default('failed')->comment('success, failed, blocked, admin_approved, admin_rejected');
                $table->string('otp_code', 10)->nullable();
                $table->timestamp('otp_expires_at')->nullable();
                $table->boolean('is_otp_verified')->default(false);
                $table->unsignedBigInteger('admin_id')->nullable();
                $table->text('admin_notes')->nullable();
                $table->timestamp('action_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_verifications');
        Schema::dropIfExists('registration_sequences');

        if (Schema::hasTable('student_accounts')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                $table->dropColumn([
                    'registration_number',
                    'registration_status',
                    'verified_by',
                    'verified_at',
                    'rejection_reason',
                ]);
            });
        }

        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropColumn([
                    'registration_number',
                    'registration_status',
                    'verified_by',
                    'verified_at',
                    'rejection_reason',
                ]);
            });
        }

        if (Schema::hasTable('batches')) {
            Schema::table('batches', function (Blueprint $table) {
                $table->dropColumn([
                    'batch_code',
                    'academic_year',
                    'start_date',
                    'end_date',
                ]);
            });
        }

        if (Schema::hasTable('courses')) {
            Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn('course_code');
            });
        }
    }
}

