<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPanelMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('student_panel_menus')) {
            Schema::create('student_panel_menus', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('parent_id')->default(0)->index();
                $table->string('menu_key', 100)->unique();
                $table->string('title_en');
                $table->string('title_bn');
                $table->string('route_name')->nullable();
                $table->string('url')->nullable();
                $table->string('icon', 100)->default('fa fa-circle-o');
                $table->integer('order_index')->default(0);
                $table->boolean('is_active')->default(true);
                $table->string('required_role', 100)->nullable();
                $table->string('badge_callback', 100)->nullable();
                $table->text('meta')->nullable();
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
        Schema::dropIfExists('student_panel_menus');
    }
}
