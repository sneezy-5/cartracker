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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('brand');
            $table->integer('year_of_manufacture');
            $table->string('fuel_type');
            $table->string('numberplate');
            $table->string('mileage');
            $table->string('rental_price_per_day');
            $table->string('gearbox');
            $table->boolean('gps')->default(0);
            $table->integer('number_place');
            $table->string('description');
            $table->string('status');
            $table->string('picture1');
            $table->string('picture2');
            $table->string('picture3');
            $table->string('picture4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
