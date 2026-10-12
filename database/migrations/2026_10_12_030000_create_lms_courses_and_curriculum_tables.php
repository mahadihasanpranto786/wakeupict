<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsCoursesAndCurriculumTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. LMS Chapters / Modules
        if (!Schema::hasTable('lms_chapters')) {
            Schema::create('lms_chapters', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('course_id')->index();
                $table->string('title');
                $table->text('description')->nullable();
                $table->integer('order_index')->default(0);
                $table->tinyInteger('status')->default(1)->comment('1: active, 0: draft');
                $table->timestamps();
            });
        }

        // 2. LMS Lessons (Videos, PDFs, Lecture Sheets, Notes)
        if (!Schema::hasTable('lms_lessons')) {
            Schema::create('lms_lessons', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('chapter_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->string('title');
                $table->string('lesson_type', 50)->default('video')->comment('video, pdf, article, interactive');
                $table->string('video_provider', 50)->default('youtube')->comment('youtube, vimeo, custom');
                $table->string('video_url')->nullable();
                $table->string('pdf_file')->nullable();
                $table->longText('content')->nullable();
                $table->integer('duration_minutes')->default(0);
                $table->integer('order_index')->default(0);
                $table->boolean('is_free_preview')->default(false);
                $table->tinyInteger('status')->default(1)->comment('1: active, 0: draft');
                $table->timestamps();
            });
        }

        // 3. LMS Student Course Enrollments
        if (!Schema::hasTable('lms_enrollments')) {
            Schema::create('lms_enrollments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->string('enrollment_type', 50)->default('admitted')->comment('admitted, self_enrolled, trial');
                $table->string('status', 50)->default('active')->comment('active, completed, cancelled');
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();

                $table->unique(['student_account_id', 'course_id'], 'student_course_unique');
            });
        }

        // 4. LMS Student Lesson Completion & Progress Tracking
        if (!Schema::hasTable('lms_lesson_progress')) {
            Schema::create('lms_lesson_progress', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('lesson_id')->index();
                $table->boolean('is_completed')->default(false);
                $table->integer('last_watched_seconds')->default(0);
                $table->timestamp('completed_at')->nullable();
                $table->timestamps();

                $table->unique(['student_account_id', 'lesson_id'], 'student_lesson_unique');
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
        Schema::dropIfExists('lms_lesson_progress');
        Schema::dropIfExists('lms_enrollments');
        Schema::dropIfExists('lms_lessons');
        Schema::dropIfExists('lms_chapters');
    }
}
