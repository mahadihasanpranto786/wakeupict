<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentAttemptIdToLmsQuizAttempts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quiz_attempts', 'parent_attempt_id')) {
                    $table->unsignedBigInteger('parent_attempt_id')->nullable()->after('student_account_id');
                    $table->index('parent_attempt_id');
                }
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
        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                if (Schema::hasColumn('lms_quiz_attempts', 'parent_attempt_id')) {
                    $table->dropIndex(['parent_attempt_id']);
                    $table->dropColumn('parent_attempt_id');
                }
            });
        }
    }
}

