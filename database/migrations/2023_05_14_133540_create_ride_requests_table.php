<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('pickup');
            $table->string('pickupLat'); 
            $table->string('pickupLong');  
            $table->string('destination'); 
            $table->string('destinationLat'); 
            $table->string('destinationLong'); 
            $table->dateTime('pickTime');
            $table->string('distance');
            $table->string('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('driver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ride_requests');
    }
};
