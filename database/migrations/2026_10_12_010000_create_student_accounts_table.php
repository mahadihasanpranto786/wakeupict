<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('student_accounts')) {
            Schema::create('student_accounts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('student_id_code', 50)->unique();
                $table->unsignedBigInteger('admited_student_id')->nullable()->index();
                $table->string('name');
                $table->string('email')->nullable()->index();
                $table->string('phone', 50)->index();
                $table->string('password');
                $table->string('avatar')->nullable();
                $table->tinyInteger('status')->default(1)->comment('1: active, 0: inactive/suspended');
                $table->timestamp('email_verified_at')->nullable();
                $table->timestamp('phone_verified_at')->nullable();
                $table->timestamp('last_login_at')->nullable();
                $table->string('last_login_ip', 45)->nullable();
                $table->rememberToken();
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
        Schema::dropIfExists('student_accounts');
    }
}
