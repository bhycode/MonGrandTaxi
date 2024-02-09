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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rateValue');
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('passengerId');
            $table->string('comment');

            // Foreign keys
            $table->foreign('driverId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('passengerId')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }

};
