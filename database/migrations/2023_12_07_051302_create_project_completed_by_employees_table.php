<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCompletedByEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_completed_by_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('about_card_id');
            $table->string('project_title');
            $table->string('short_description', 500);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('currently_working_status')->default(1)->comment('1=currently working; 0= now working;');
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
        Schema::dropIfExists('project_completed_by_employees');
    }
}
