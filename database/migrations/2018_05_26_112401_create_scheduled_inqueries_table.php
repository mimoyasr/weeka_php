<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledInqueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_inqueries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inquery_id');
            $table->foreign('inquery_id')->references('id')->on('inqueries');
            $table->dateTime('at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scheduled_inqueries');
    }
}
