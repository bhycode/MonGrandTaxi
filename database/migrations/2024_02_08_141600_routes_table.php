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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('travelHour');
            $table->string('travelDate');
            $table->unsignedBigInteger('departCity');
            $table->unsignedBigInteger('arriveCity');
            $table->unsignedBigInteger('driverId')->nullable();


            $table->foreign('departCity')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('arriveCity')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('driverId')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
};
