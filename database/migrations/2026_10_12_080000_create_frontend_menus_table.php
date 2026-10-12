<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrontendMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('frontend_menus')) {
            Schema::create('frontend_menus', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('location', 50)->default('header')->index()->comment('header, footer_quick, footer_services, footer_legal');
                $table->unsignedBigInteger('parent_id')->nullable()->index();
                $table->string('title_en');
                $table->string('title_bn')->nullable();
                $table->string('url')->default('#');
                $table->string('route_name')->nullable();
                $table->string('target', 20)->default('_self');
                $table->string('icon', 100)->nullable();
                $table->string('badge_text', 50)->nullable();
                $table->string('badge_color', 50)->nullable();
                $table->integer('order_index')->default(0);
                $table->boolean('status')->default(true);
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
        Schema::dropIfExists('frontend_menus');
    }
}
