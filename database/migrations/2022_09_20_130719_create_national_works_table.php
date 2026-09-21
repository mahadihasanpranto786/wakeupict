<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_works', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title');
            $table->string('blog_id');
            $table->string('image');
            $table->string('image_alt');
            $table->string('logo');
            $table->text('description');
            $table->integer('active_project')->default(1);
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
        Schema::dropIfExists('national_works');
    }
}
