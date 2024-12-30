<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carrental extends Model
{
    /** @use HasFactory<\Database\Factories\CarrentalFactory> */
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'slug',
        'license_plate',
        'rental_price',
        'color',
        'policy',
        'information',
        'banner',
        'carrentalcat_id',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function carrentalcat(): BelongsTo
    {
        return $this->belongsTo(Carrentalcat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
