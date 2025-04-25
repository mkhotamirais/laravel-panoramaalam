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

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('brand_name', 'like', '%' . request('search') . '%');
        }

        if ($filters['category'] ?? false) {
            $slugCategory = str_replace('-', ' ', $filters['category']);
            $query->whereHas('carrentalcat', function ($q) use ($slugCategory) {
                $q->whereRaw('LOWER(name) = ?', [strtolower($slugCategory)]);
            });
        }

        if ($filters['sort'] ?? false) {
            if ($filters['sort'] === 'cheapest') {
                $query->orderBy('rental_price');
            } else if ($filters['sort'] === 'most-expensive') {
                $query->orderByDesc('rental_price');
            }
        }
    }
}
