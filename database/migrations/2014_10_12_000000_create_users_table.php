<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('image')->nullable()->default(null);
            $table->string('password');
            $table->enum('type',['admin','chef','client']);
            $table->longText('desc')->nullable()->default(null);
            $table->enum('state',['available','busy','not available'])->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
