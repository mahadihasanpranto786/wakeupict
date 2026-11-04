<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsExamViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Add security violations columns to lms_quiz_attempts table
        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quiz_attempts', 'security_violations_count')) {
                    $table->unsignedInteger('security_violations_count')->default(0)->after('status')->index();
                }
                if (!Schema::hasColumn('lms_quiz_attempts', 'security_violations_log')) {
                    $table->longText('security_violations_log')->nullable()->after('security_violations_count');
                }
            });
        }

        // 2. Create lms_exam_violations audit table
        if (!Schema::hasTable('lms_exam_violations')) {
            Schema::create('lms_exam_violations', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('attempt_id')->index();
                $table->unsignedBigInteger('quiz_id')->index();
                $table->unsignedBigInteger('student_account_id')->index();
                $table->string('violation_type', 60)->index(); // tab_switch, window_blur, copy_attempt, cut_attempt, paste_attempt, right_click, dev_tools, restricted_shortcut
                $table->unsignedInteger('warning_count')->default(1);
                $table->text('details')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->timestamps();

                $table->foreign('attempt_id')->references('id')->on('lms_quiz_attempts')->onDelete('cascade');
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
        Schema::dropIfExists('lms_exam_violations');

        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                if (Schema::hasColumn('lms_quiz_attempts', 'security_violations_log')) {
                    $table->dropColumn('security_violations_log');
                }
                if (Schema::hasColumn('lms_quiz_attempts', 'security_violations_count')) {
                    $table->dropColumn('security_violations_count');
                }
            });
        }
    }
}

