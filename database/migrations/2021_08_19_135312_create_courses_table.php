<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('course_title');
            $table->string('price');
            $table->text('short_description');
            $table->text('course_content');
            $table->text('long_description');
            $table->text('importents');
            $table->text('future_of_this_course');
            $table->text('possibilities_of_this_course');
            $table->string('time_line');
            $table->string('course_slug');
            $table->text('student_quantity');
            $table->string('image');
            $table->string('image_alt')->nullable();
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
        Schema::dropIfExists('courses');
    }
}