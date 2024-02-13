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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pic')->nullable();
            $table->string('phoneNumber');
            $table->string('password');
            $table->tinyInteger('role')->default(3);
            $table->tinyInteger('taxiSets')->default(0);
            $table->boolean('isAvailable')->default(1);
            $table->tinyInteger('paymentMethod')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
