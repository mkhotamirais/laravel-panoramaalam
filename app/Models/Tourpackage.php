<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourpackage extends Model
{
    /** @use HasFactory<\Database\Factories\TourpackageFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'detail',
        'price',
        'price_detail',
        'itenary_description',
        'itenary_detail',
        'policy_description',
        'policy_detail',
        'info_description',
        'info_detail',
        'status',
        'tourpackagecat_id',
        'banner',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function tourpackagecat()
    {
        return $this->belongsTo(Tourpackagecat::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourimages()
    {
        return $this->hasMany(Tourimage::class);
    }
}
