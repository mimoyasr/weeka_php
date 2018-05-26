<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('day',['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']);
            $table->unsignedInteger('from_hour');
            $table->unsignedInteger('from_min');
            $table->enum('from_period',['AM','PM']);
            $table->unsignedInteger('to_hour');
            $table->unsignedInteger('to_min');
            $table->enum('to_period',['AM','PM']);
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
        Schema::dropIfExists('working_hours');
    }
}
