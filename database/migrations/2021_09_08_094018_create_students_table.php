<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id');
            $table->integer('batch_id')->nullable();
            $table->string('course_fee');
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
            $table->string('student_photo')->nullable();
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
        Schema::dropIfExists('students');
    }
}
