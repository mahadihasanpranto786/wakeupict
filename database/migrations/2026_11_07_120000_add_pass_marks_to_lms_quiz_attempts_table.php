<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPassMarksToLmsQuizAttemptsTable extends Migration
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
                if (!Schema::hasColumn('lms_quiz_attempts', 'pass_marks')) {
                    $table->decimal('pass_marks', 8, 2)->nullable()->after('total_marks');
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
                if (Schema::hasColumn('lms_quiz_attempts', 'pass_marks')) {
                    $table->dropColumn('pass_marks');
                }
            });
        }
    }
}

