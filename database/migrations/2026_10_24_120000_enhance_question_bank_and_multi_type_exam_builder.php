<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnhanceQuestionBankAndMultiTypeExamBuilder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Upgrade lms_questions for related questions and multi-type answer metadata
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_questions', 'parent_question_id')) {
                    $table->unsignedBigInteger('parent_question_id')->nullable()->index()->after('id');
                }
                if (!Schema::hasColumn('lms_questions', 'correct_answer_text')) {
                    $table->text('correct_answer_text')->nullable()->after('question_text');
                }
                if (!Schema::hasColumn('lms_questions', 'cq_subquestions')) {
                    $table->longText('cq_subquestions')->nullable()->after('correct_answer_text');
                }
                if (!Schema::hasColumn('lms_questions', 'matching_pairs')) {
                    $table->text('matching_pairs')->nullable()->after('cq_subquestions');
                }
                if (!Schema::hasColumn('lms_questions', 'hints')) {
                    $table->text('hints')->nullable()->after('matching_pairs');
                }
                if (!Schema::hasColumn('lms_questions', 'source_reference')) {
                    $table->string('source_reference', 150)->nullable()->after('topic');
                }
            });
        }

        // 2. Upgrade lms_quizzes to directly link with a question paper
        if (Schema::hasTable('lms_quizzes')) {
            Schema::table('lms_quizzes', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quizzes', 'paper_id')) {
                    $table->unsignedBigInteger('paper_id')->nullable()->index()->after('course_id');
                }
            });
        }

        // 3. Upgrade lms_question_paper_sections for question type hints
        if (Schema::hasTable('lms_question_paper_sections')) {
            Schema::table('lms_question_paper_sections', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_question_paper_sections', 'question_type')) {
                    $table->string('question_type', 40)->nullable()->after('section_code');
                }
            });
        }

        // 4. Upgrade lms_quiz_answers for CQ and manual grading
        if (Schema::hasTable('lms_quiz_answers')) {
            Schema::table('lms_quiz_answers', function (Blueprint $table) {
                if (!Schema::hasColumn('lms_quiz_answers', 'cq_answers')) {
                    $table->longText('cq_answers')->nullable()->after('text_answer');
                }
                if (!Schema::hasColumn('lms_quiz_answers', 'grading_status')) {
                    $table->string('grading_status', 30)->default('auto')->after('is_correct');
                }
                if (!Schema::hasColumn('lms_quiz_answers', 'teacher_feedback')) {
                    $table->text('teacher_feedback')->nullable()->after('grading_status');
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
        if (Schema::hasTable('lms_questions')) {
            Schema::table('lms_questions', function (Blueprint $table) {
                $columns = ['parent_question_id', 'correct_answer_text', 'cq_subquestions', 'matching_pairs', 'hints', 'source_reference'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_questions', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }

        if (Schema::hasTable('lms_quizzes')) {
            Schema::table('lms_quizzes', function (Blueprint $table) {
                if (Schema::hasColumn('lms_quizzes', 'paper_id')) {
                    $table->dropColumn('paper_id');
                }
            });
        }

        if (Schema::hasTable('lms_question_paper_sections')) {
            Schema::table('lms_question_paper_sections', function (Blueprint $table) {
                if (Schema::hasColumn('lms_question_paper_sections', 'question_type')) {
                    $table->dropColumn('question_type');
                }
            });
        }

        if (Schema::hasTable('lms_quiz_answers')) {
            Schema::table('lms_quiz_answers', function (Blueprint $table) {
                $columns = ['cq_answers', 'grading_status', 'teacher_feedback'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('lms_quiz_answers', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
}
