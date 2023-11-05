<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('start_date');
            // $table->string('end_date');
            $table->string('fname');
            $table->string('email');
            $table->string('lname');
            $table->string('phone');
            $table->string('time');
            $table->text('special_request')->nullable();
            $table->double('amount');
            $table->string('status');
            $table->unsignedBigInteger('car_id');
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
