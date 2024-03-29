<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('country_id')->default(1);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedInteger('city_id')->default(1);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('name')->nullable()->default(null);
            $table->string('street')->nullable()->default(null);
            $table->integer('buildingno')->nullable()->default(null);
            $table->string('floorno')->nullable()->default(null);
            $table->integer('flatno')->nullable()->default(null);
            $table->string('notice')->nullable()->default(null);
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
        Schema::dropIfExists('addresses');
    }
}
