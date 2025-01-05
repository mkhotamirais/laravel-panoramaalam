<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinationblog extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationblogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
