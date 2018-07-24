<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('name');
            $table->mediumText('url');
            $table->mediumText('image');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->enum('status', ['not_start', 'in_progress', 'completed', 'cancelled'])->default('in_progress');
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
        Schema::dropIfExists('promotion');
    }
}
