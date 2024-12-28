<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarRentalCategory extends Model
{
    /** @use HasFactory<\Database\Factories\CarRentalCategoryFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function carRentals(): HasMany
    {
        return $this->hasMany(CarRental::class);
    }
}
