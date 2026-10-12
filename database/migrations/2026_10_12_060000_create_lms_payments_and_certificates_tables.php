<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsPaymentsAndCertificatesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. LMS Student Payment Submissions (bKash, Nagad, Rocket, Bank)
        if (!Schema::hasTable('lms_payment_submissions')) {
            Schema::create('lms_payment_submissions', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->unsignedBigInteger('batch_id')->nullable()->index();
                $table->string('payment_method', 50)->default('bkash')->comment('bkash, nagad, rocket, bank_transfer, cash');
                $table->string('transaction_id')->index();
                $table->string('sender_number');
                $table->decimal('amount', 10, 2);
                $table->string('payment_proof_file')->nullable();
                $table->text('student_note')->nullable();
                $table->text('admin_note')->nullable();
                $table->string('status', 50)->default('pending')->comment('pending, verified, rejected');
                $table->unsignedBigInteger('verified_by')->nullable()->index();
                $table->timestamp('verified_at')->nullable();
                $table->string('receipt_number', 50)->nullable()->unique();
                $table->timestamps();
            });
        }

        // 2. LMS Fee Installment Schedules
        if (!Schema::hasTable('lms_fee_installments')) {
            Schema::create('lms_fee_installments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->integer('installment_number')->default(1);
                $table->date('due_date');
                $table->decimal('amount', 10, 2);
                $table->decimal('paid_amount', 10, 2)->default(0.00);
                $table->string('status', 50)->default('unpaid')->comment('unpaid, partially_paid, paid, waived');
                $table->timestamps();
            });
        }

        // 3. LMS Official Student Course Certificates
        if (!Schema::hasTable('lms_certificates')) {
            Schema::create('lms_certificates', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('student_account_id')->index();
                $table->unsignedBigInteger('course_id')->index();
                $table->string('certificate_code', 50)->unique();
                $table->string('title');
                $table->string('grade', 20)->nullable();
                $table->decimal('score_percentage', 5, 2)->nullable();
                $table->date('issue_date');
                $table->string('status', 50)->default('issued')->comment('issued, revoked');
                $table->string('verification_hash', 100)->unique();
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
        Schema::dropIfExists('lms_certificates');
        Schema::dropIfExists('lms_fee_installments');
        Schema::dropIfExists('lms_payment_submissions');
    }
}
