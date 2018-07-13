<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('email', 255);
            $table->longText('password');
            $table->boolean('needChangePassword')->default(true);
            $table->enum('status', ['active', 'inactive', 'ban'])->default('active');
            $table->unsignedInteger('roleId');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('roleId')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
