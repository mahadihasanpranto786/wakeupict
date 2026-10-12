<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsSchedulesAttendanceAndAssignmentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. LMS Class Schedules (Live Zoom/Meet, Offline Labs, Recordings)
        if (!Schema::hasTable('lms_class_schedules')) {
            Schema::create('lms_class_schedules', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->unsignedBigInteger('instructor_id')->nullable()->index();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('class_type', 50)->default('live_online')->comment('live_online, offline_lab, recorded');
                $table->string('meeting_platform', 50)->default('zoom')->comment('zoom, google_meet, lab_room, custom');
                $table->text('meeting_link')->nullable();
                $table->string('meeting_id')->nullable();
                $table->string('meeting_password')->nullable();
                $table->date('class_date');
                $table->time('start_time');
                $table->time('end_time');
                $table->string('room_number', 50)->nullable();
                $table->boolean('is_cancelled')->default(false);
                $table->text('cancellation_reason')->nullable();
                $table->text('recording_url')->nullable();
                $table->timestamps();
            });
        }

        // 2. LMS Student Attendances
        if (!Schema::hasTable('lms_attendances')) {
            Schema::create('lms_attendances', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('schedule_id')->nullable()->index();
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->date('attendance_date');
                $table->string('status', 50)->default('present')->comment('present, absent, late, excused');
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
        }

        // 3. LMS Assignments & Projects
        if (!Schema::hasTable('lms_assignments')) {
            Schema::create('lms_assignments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('chapter_id')->nullable()->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->string('title');
                $table->longText('description')->nullable();
                $table->string('assignment_type', 50)->default('assignment')->comment('assignment, project, homework');
                $table->decimal('total_marks', 8, 2)->default(100.00);
                $table->decimal('pass_marks', 8, 2)->default(40.00);
                $table->timestamp('due_date')->nullable();
                $table->string('allowed_file_types')->default('pdf,zip,png,jpg,doc,docx');
                $table->integer('max_file_size_mb')->default(25);
                $table->string('attachment_file')->nullable();
                $table->boolean('is_published')->default(true);
                $table->timestamps();
            });
        }

        // 4. LMS Assignment Submissions
        if (!Schema::hasTable('lms_assignment_submissions')) {
            Schema::create('lms_assignment_submissions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('assignment_id')->index();
                $table->unsignedBigInteger('student_account_id')->index();
                $table->text('submission_text')->nullable();
                $table->string('submitted_file')->nullable();
                $table->timestamp('submitted_at')->nullable();
                $table->string('status', 50)->default('submitted')->comment('submitted, graded, resubmission_required');
                $table->decimal('marks_obtained', 8, 2)->nullable();
                $table->text('feedback')->nullable();
                $table->unsignedBigInteger('graded_by')->nullable()->index();
                $table->timestamp('graded_at')->nullable();
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
        Schema::dropIfExists('lms_assignment_submissions');
        Schema::dropIfExists('lms_assignments');
        Schema::dropIfExists('lms_attendances');
        Schema::dropIfExists('lms_class_schedules');
    }
}
