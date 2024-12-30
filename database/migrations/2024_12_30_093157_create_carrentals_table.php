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
        Schema::create('carrentals', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('slug')->unique();
            $table->string('license_plate')->nullable();
            $table->decimal('rental_price', 20, 0)->default(0);
            $table->string('color');
            $table->text('policy');
            $table->text('information')->nullable();
            $table->string('banner')->nullable();
            $table->foreignId('carrentalcat_id')->default(1)->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrentals');
    }
};
