<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsQuizzesAndExamsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. LMS Quizzes & Exams Table
        if (!Schema::hasTable('lms_quizzes')) {
            Schema::create('lms_quizzes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('course_id')->nullable()->index();
                $table->unsignedBigInteger('chapter_id')->nullable()->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('quiz_type', 50)->default('practice')->comment('practice, exam, chapter_quiz');
                $table->string('class_level', 50)->nullable()->comment('Class 6, Class 7, Class 8, Class 9-10, Professional');
                $table->integer('duration_minutes')->default(30);
                $table->decimal('total_marks', 8, 2)->default(100.00);
                $table->decimal('pass_marks', 8, 2)->default(40.00);
                $table->boolean('shuffle_questions')->default(true);
                $table->boolean('shuffle_options')->default(true);
                $table->integer('max_attempts')->default(1)->comment('0 for unlimited');
                $table->boolean('is_published')->default(true);
                $table->timestamp('start_time')->nullable();
                $table->timestamp('end_time')->nullable();
                $table->timestamps();
            });
        }

        // 2. LMS Questions Table
        if (!Schema::hasTable('lms_questions')) {
            Schema::create('lms_questions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('quiz_id')->index();
                $table->text('question_text');
                $table->string('question_type', 50)->default('mcq_single')->comment('mcq_single, mcq_multi, true_false, short_answer');
                $table->decimal('marks', 8, 2)->default(1.00);
                $table->text('explanation')->nullable()->comment('Rationale & explanation');
                $table->integer('order_index')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // 3. LMS Question Options Table
        if (!Schema::hasTable('lms_question_options')) {
            Schema::create('lms_question_options', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('question_id')->index();
                $table->text('option_text');
                $table->boolean('is_correct')->default(false);
                $table->integer('order_index')->default(0);
                $table->timestamps();
            });
        }

        // 4. LMS Quiz Attempts Table
        if (!Schema::hasTable('lms_quiz_attempts')) {
            Schema::create('lms_quiz_attempts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('quiz_id')->index();
                $table->unsignedBigInteger('student_account_id')->index();
                $table->integer('attempt_number')->default(1);
                $table->timestamp('started_at');
                $table->timestamp('submitted_at')->nullable();
                $table->decimal('score', 8, 2)->default(0.00);
                $table->decimal('total_marks', 8, 2)->default(0.00);
                $table->decimal('percentage', 5, 2)->default(0.00);
                $table->string('status', 50)->default('in_progress')->comment('in_progress, submitted, graded, timed_out');
                $table->integer('time_spent_seconds')->default(0);
                $table->timestamps();
            });
        }

        // 5. LMS Quiz Answers Table
        if (!Schema::hasTable('lms_quiz_answers')) {
            Schema::create('lms_quiz_answers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('attempt_id')->index();
                $table->unsignedBigInteger('question_id')->index();
                $table->text('selected_option_ids')->nullable()->comment('JSON or comma-separated option IDs');
                $table->text('text_answer')->nullable();
                $table->boolean('is_correct')->nullable();
                $table->decimal('marks_obtained', 8, 2)->default(0.00);
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
        Schema::dropIfExists('lms_quiz_answers');
        Schema::dropIfExists('lms_quiz_attempts');
        Schema::dropIfExists('lms_question_options');
        Schema::dropIfExists('lms_questions');
        Schema::dropIfExists('lms_quizzes');
    }
}
