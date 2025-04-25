<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'banner',
        'blogcat_id',
        // 'user_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function blogcat(): BelongsTo
    {
        return $this->belongsTo(Blogcat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if ($filters['category'] ?? false) {
            $slugCategory = str_replace('-', ' ', $filters['category']);
            $query->whereHas('blogcat', function ($q) use ($slugCategory) {
                $q->whereRaw('LOWER(name) = ?', [strtolower($slugCategory)]);
            });
        }

        if ($filters['sort'] ?? false) {
            if ($filters['sort'] === 'latest') {
                $query->latest();
            } else if ($filters['sort'] === 'oldest') {
                $query->oldest();
            }
        }
    }
}
