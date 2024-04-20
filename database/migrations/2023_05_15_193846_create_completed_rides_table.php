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
        Schema::create('completed_rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ride_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('driver_id');
            $table->timestamps();

            $table->foreign('ride_id')->references('id')->on('ride_requests');
            $table->foreign('customer_id')->references('id')->on('users');
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
        Schema::dropIfExists('completed_rides');
    }
};
