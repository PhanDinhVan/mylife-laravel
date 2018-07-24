<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('name');
            $table->mediumText('content');
            $table->mediumText('url');
            $table->mediumText('image');
            $table->enum('status', ['publish', 'completed', 'cancelled'])->default('publish');
            $table->unsignedInteger('createdBy');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('createdBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
