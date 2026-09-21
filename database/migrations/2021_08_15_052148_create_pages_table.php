<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('page_name')->nullable();
            $table->string('title')->nullable();
            $table->string('link_canonical')->nullable();
            $table->string('og_locale')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_site_name')->nullable();
            $table->string('msvalidate')->nullable();
            $table->text('description')->nullable();
            $table->string('article_publisher')->nullable();
            $table->string('article_modified_time')->nullable();
            $table->string('image')->nullable();
            $table->string('og_image_width')->nullable();
            $table->string('og_image_height')->nullable();
            $table->string('twitter_card')->nullable();
            $table->string('twitter_label1')->nullable();
            $table->string('twitter_data1')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
