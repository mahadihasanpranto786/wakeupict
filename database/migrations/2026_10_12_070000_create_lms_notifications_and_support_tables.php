<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsNotificationsAndSupportTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. LMS Notifications & Broadcast Announcements Table
        if (!Schema::hasTable('lms_notifications')) {
            Schema::create('lms_notifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->nullable()->index()->comment('null for global announcements');
                $table->unsignedBigInteger('course_id')->nullable()->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->string('title');
                $table->text('message');
                $table->string('type', 50)->default('info')->comment('info, success, warning, danger, announcement');
                $table->string('action_url')->nullable();
                $table->boolean('is_read')->default(false);
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }

        // 2. LMS Helpdesk Support Tickets Table
        if (!Schema::hasTable('lms_support_tickets')) {
            Schema::create('lms_support_tickets', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->string('ticket_number', 50)->unique();
                $table->string('subject');
                $table->string('category', 50)->default('academic')->comment('academic, technical, fees_payment, exam_quiz, general');
                $table->string('priority', 50)->default('medium')->comment('low, medium, high, urgent');
                $table->string('status', 50)->default('open')->comment('open, in_progress, answered, closed');
                $table->timestamp('last_reply_at')->nullable();
                $table->timestamps();
            });
        }

        // 3. LMS Support Ticket Conversation Replies Table
        if (!Schema::hasTable('lms_ticket_replies')) {
            Schema::create('lms_ticket_replies', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('ticket_id')->index();
                $table->unsignedBigInteger('user_id')->nullable()->index()->comment('faculty / admin staff');
                $table->unsignedBigInteger('student_account_id')->nullable()->index()->comment('student responder');
                $table->text('message');
                $table->string('attachment_file')->nullable();
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
        Schema::dropIfExists('lms_ticket_replies');
        Schema::dropIfExists('lms_support_tickets');
        Schema::dropIfExists('lms_notifications');
    }
}
