<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('income_id');
            $table->string('student_id');
            $table->string('course_id');
            $table->string('batch_id');
            $table->string('date');
            $table->string('mobile');
            $table->text('remark');
            $table->string('paid');
            $table->bigInteger('return_money')->default(0);
            $table->string('return_date')->nullable();
            $table->string('return_reason', 500)->nullable();
            $table->string('created_by');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_payments');
    }
}
