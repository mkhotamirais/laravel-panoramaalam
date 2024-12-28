<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarRental extends Model
{
    /** @use HasFactory<\Database\Factories\CarRentalFactory> */
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'slug',
        'license_plate',
        'rental_price',
        'color',
        'banner',
        'car_rental_category_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function carRentalCategory(): BelongsTo
    {
        return $this->belongsTo(CarRentalCategory::class);
    }
}
