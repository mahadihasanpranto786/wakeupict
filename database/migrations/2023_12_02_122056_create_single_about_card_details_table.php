<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSingleAboutCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_about_card_details', function (Blueprint $table) {
            $table->bigIncrements('id');       
            $table->unsignedBigInteger('about_card_id');
            $table->string('employee_type');
            $table->text('description');
            $table->date('joining_date');
            $table->boolean('currently_working_status')->default(1)->comment('1=currently working; 0= now working;');
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('single_about_card_details');
    }
}
