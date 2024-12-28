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
        Schema::create('car_rentals', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('slug')->unique();
            $table->string('license_plate');
            $table->string('rental_price');
            $table->string('color');
            $table->string('banner');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_rental_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rentals');
    }
};
