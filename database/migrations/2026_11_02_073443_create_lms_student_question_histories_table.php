<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLmsStudentQuestionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_student_question_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_account_id')->index();
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('attempt_id')->nullable()->index();
            $table->string('category', 150)->nullable()->index();
            $table->unsignedInteger('course_id')->nullable()->index();
            $table->unsignedInteger('rotation_cycle')->default(1)->index();
            $table->boolean('is_correct')->nullable();
            $table->text('selected_option_ids')->nullable();
            $table->unsignedInteger('times_attempted')->default(1);
            $table->timestamp('last_attempted_at')->nullable();
            $table->timestamps();

            $table->unique(['student_account_id', 'question_id', 'rotation_cycle'], 'sqh_student_q_cycle_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_student_question_histories');
    }
}
