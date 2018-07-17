<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 255);
            $table->char('phone', 20);
            $table->longText('address');
            $table->char('district', 255);
            $table->char('lat', 20);
            $table->char('lng', 20);
            $table->longText('image');
            $table->unsignedInteger('type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type')->references('id')->on('company');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop');
    }
}
