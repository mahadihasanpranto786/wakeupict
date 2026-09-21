<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmitedStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admited_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->integer('batch_id');
            $table->string('student_type');
            $table->string('course_fee');
            $table->string('course_after_discount');
            $table->string('discount_amount');
            $table->string('student_name');
            $table->string('gander');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->string('nationality');
            $table->string('national_id_no');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('personal_call_no');
            $table->string('email');
            $table->string('religion');
            $table->string('occupation');
            $table->string('age');
            $table->string('educational_qualification');
            $table->string('result');
            $table->string('passing_year');
            $table->string('student_photo');
            $table->integer('status')->default(1);
            $table->integer('active_status')->default(1);
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
        Schema::dropIfExists('admited_students');
    }
}
