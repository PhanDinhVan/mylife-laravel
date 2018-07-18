<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->unsignedInteger('shopId');
            $table->enum('state', ['waiting', 'confirmed', 'cancelled'])->default('waiting');
            $table->date('date');
            $table->time('time');
            $table->integer('numberPerson');
            $table->longText('extraData')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('shopId')->references('id')->on('shop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
