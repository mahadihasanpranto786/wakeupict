<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppearanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('appearance_settings')) {
            Schema::create('appearance_settings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('section', 64)->default('global')->index();
                $table->string('key', 128)->unique();
                $table->longText('value_en')->nullable();
                $table->longText('value_bn')->nullable();
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
        Schema::dropIfExists('appearance_settings');
    }
}
