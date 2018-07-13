<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('id');
            $table->char('memberCode', 100);
            $table->unsignedInteger('userId');
            $table->char('name', 100);
            $table->mediumText('avatar')->nullable();
            $table->char('gender', 25)->nullable();
            $table->date('birthday')->nullable();
            $table->char('phone', 50)->nullable();
            $table->char('nationality', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
