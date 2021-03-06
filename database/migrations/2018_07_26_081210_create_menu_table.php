<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title');
            $table->mediumText('description');
            $table->mediumText('price');
            $table->mediumText('image');

            $table->unsignedInteger('companyId');
            $table->unsignedInteger('menuCategoryId');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('companyId')->references('id')->on('company');
            $table->foreign('menuCategoryId')->references('id')->on('menu_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}