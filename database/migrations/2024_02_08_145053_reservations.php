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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('passengerId');
            $table->unsignedBigInteger('routeId');
            $table->integer('seats');
            $table->string('resDate');

            // Foreign keys
            $table->foreign('driverId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('passengerId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('routeId')->references('id')->on('routes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }

};
