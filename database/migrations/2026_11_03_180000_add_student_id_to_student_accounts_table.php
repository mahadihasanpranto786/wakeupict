<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\model\StudentAccount;
use App\model\Student;

class AddStudentIdToStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('student_accounts', 'student_id')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                $table->unsignedBigInteger('student_id')->nullable()->after('id')->index();
            });
        }

        // Backfill existing student_accounts to link with parent students table
        try {
            $accounts = StudentAccount::all();
            foreach ($accounts as $acc) {
                // If student_id already set, skip
                if (!empty($acc->student_id)) {
                    continue;
                }

                // 1. Try finding in meta
                $meta = is_array($acc->meta) ? $acc->meta : json_decode($acc->meta, true);
                if (!empty($meta['student_record_id'])) {
                    $found = Student::find($meta['student_record_id']);
                    if ($found) {
                        $acc->update(['student_id' => $found->id]);
                        continue;
                    }
                }

                // 2. Try finding by phone
                $cleanPhone = preg_replace('/[^0-9]/', '', (string)$acc->phone);
                $st = Student::where('personal_call_no', $acc->phone)
                    ->orWhere('personal_call_no', $cleanPhone)
                    ->orWhere('personal_call_no', 'LIKE', '%' . substr($cleanPhone, -10))
                    ->first();

                // 3. Try finding by email
                if (!$st && !empty($acc->email)) {
                    $st = Student::where('email', $acc->email)->first();
                }

                // 4. If no parent Student record exists, create one as parent!
                if (!$st) {
                    $st = Student::create([
                        'student_name' => $acc->name ?: 'Student',
                        'personal_call_no' => $acc->phone ?: '01700000000',
                        'email' => $acc->email ?: '',
                        'course_id' => 0,
                        'course_fee' => '0',
                        'status' => 1,
                        'gander' => 'other',
                        'fathers_name' => '',
                        'mothers_name' => '',
                        'nationality' => 'Bangladeshi',
                        'national_id_no' => '',
                        'present_address' => '',
                        'permanent_address' => '',
                        'religion' => 'Islam',
                        'occupation' => 'student',
                        'age' => '',
                        'educational_qualification' => '',
                        'result' => '',
                        'passing_year' => '',
                    ]);
                }

                $acc->update(['student_id' => $st->id]);
            }
        } catch (\Exception $e) {
            // Keep migration robust
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('student_accounts', 'student_id')) {
            Schema::table('student_accounts', function (Blueprint $table) {
                $table->dropColumn('student_id');
            });
        }
    }
}
