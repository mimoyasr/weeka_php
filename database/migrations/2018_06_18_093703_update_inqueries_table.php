<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInqueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inqueries', function (Blueprint $table) {
            $table->unsignedInteger('telephone_id')->nullable()->default(null)->change();
            $table->unsignedInteger('address_id')->nullable()->default(null)->change();
            $table->unsignedInteger('payment_id')->nullable()->default(null)->change();
            $table->float('additional_cost')->nullable()->default(null)->change();
            $table->integer('state')->nullable()->default(null)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inqueries', function (Blueprint $table) {
            $table->unsignedInteger('telephone_id')->change();
            $table->unsignedInteger('address_id')->change();
            $table->unsignedInteger('payment_id')->change();
            $table->float('additional_cost')->change();
            $table->integer('state')->change();
        });
    }
}
