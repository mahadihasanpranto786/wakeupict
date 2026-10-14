<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpgradeLmsQuizzesAndExamEngine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Upgrade lms_quizzes table
        if (Schema::hasTable('lms_quizzes')) {
            Schema::table('lms_quizzes', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quizzes', 'view_mode')) {
                    $table->string('view_mode', 30)->default('all_questions')->comment('all_questions, one_by_one');
                }
                if (!Schema::hasColumn('lms_quizzes', 'subject_code')) {
                    $table->string('subject_code', 20)->default('101')->nullable();
                }
                if (!Schema::hasColumn('lms_quizzes', 'board_name')) {
                    $table->string('board_name', 100)->default('Wake Up ICT Board')->nullable();
                }
                if (!Schema::hasColumn('lms_quizzes', 'question_set')) {
                    $table->string('question_set', 20)->default('Set A')->nullable();
                }
                if (!Schema::hasColumn('lms_quizzes', 'negative_marks')) {
                    $table->decimal('negative_marks', 8, 2)->default(0.00);
                }
                if (!Schema::hasColumn('lms_quizzes', 'locking_policy')) {
                    $table->string('locking_policy', 30)->default('mode_default')->comment('mode_default, instant_lock, confirm_lock');
                }
                if (!Schema::hasColumn('lms_quizzes', 'result_release_policy')) {
                    $table->string('result_release_policy', 30)->default('immediate')->comment('immediate, after_deadline, admin_publish');
                }
                if (!Schema::hasColumn('lms_quizzes', 'allow_question_flagging')) {
                    $table->boolean('allow_question_flagging')->default(true);
                }
                if (!Schema::hasColumn('lms_quizzes', 'stimulus_text')) {
                    $table->text('stimulus_text')->nullable();
                }
            });
        }

        // 2. Upgrade lms_questions table
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_questions', 'set_code')) {
                    $table->string('set_code', 20)->default('A')->nullable();
                }
                if (!Schema::hasColumn('lms_questions', 'category')) {
                    $table->string('category', 100)->nullable();
                }
                if (!Schema::hasColumn('lms_questions', 'chapter')) {
                    $table->string('chapter', 150)->nullable();
                }
                if (!Schema::hasColumn('lms_questions', 'topic')) {
                    $table->string('topic', 150)->nullable();
                }
                if (!Schema::hasColumn('lms_questions', 'difficulty')) {
                    $table->string('difficulty', 30)->default('medium')->comment('easy, medium, hard');
                }
                if (!Schema::hasColumn('lms_questions', 'negative_marks')) {
                    $table->decimal('negative_marks', 8, 2)->nullable();
                }
                if (!Schema::hasColumn('lms_questions', 'stimulus')) {
                    $table->text('stimulus')->nullable();
                }
            });
        }

        // 3. Upgrade lms_quiz_attempts table
        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quiz_attempts', 'view_mode')) {
                    $table->string('view_mode', 30)->default('all_questions');
                }
                if (!Schema::hasColumn('lms_quiz_attempts', 'question_set')) {
                    $table->string('question_set', 20)->default('Set A')->nullable();
                }
                if (!Schema::hasColumn('lms_quiz_attempts', 'questions_snapshot')) {
                    $table->longText('questions_snapshot')->nullable()->comment('JSON frozen snapshot of questions/options');
                }
                if (!Schema::hasColumn('lms_quiz_attempts', 'flagged_question_ids')) {
                    $table->text('flagged_question_ids')->nullable()->comment('JSON array of flagged question IDs');
                }
                if (!Schema::hasColumn('lms_quiz_attempts', 'negative_marks_deducted')) {
                    $table->decimal('negative_marks_deducted', 8, 2)->default(0.00);
                }
            });
        }

        // 4. Upgrade lms_quiz_answers table
        if (Schema::hasTable('lms_quiz_answers')) {
            Schema::table('lms_quiz_answers', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quiz_answers', 'is_finalized')) {
                    $table->boolean('is_finalized')->default(false)->index();
                }
                if (!Schema::hasColumn('lms_quiz_answers', 'finalized_at')) {
                    $table->timestamp('finalized_at')->nullable();
                }
                if (!Schema::hasColumn('lms_quiz_answers', 'is_flagged')) {
                    $table->boolean('is_flagged')->default(false);
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
        if (Schema::hasTable('lms_quiz_answers')) {
            Schema::table('lms_quiz_answers', function (Blueprint $table) {
                $columns = ['is_finalized', 'finalized_at', 'is_flagged'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_quiz_answers', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        if (Schema::hasTable('lms_quiz_attempts')) {
            Schema::table('lms_quiz_attempts', function (Blueprint $table) {
                $columns = ['view_mode', 'question_set', 'questions_snapshot', 'flagged_question_ids', 'negative_marks_deducted'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_quiz_attempts', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $columns = ['set_code', 'category', 'chapter', 'topic', 'difficulty', 'negative_marks', 'stimulus'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_questions', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        if (Schema::hasTable('lms_quizzes')) {
            Schema::table('lms_quizzes', function (Blueprint $table) {
                $columns = ['view_mode', 'subject_code', 'board_name', 'question_set', 'negative_marks', 'locking_policy', 'result_release_policy', 'allow_question_flagging', 'stimulus_text'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_quizzes', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
}
