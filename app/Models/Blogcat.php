<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogcat extends Model
{
    /** @use HasFactory<\Database\Factories\BlogcatFactory> */
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function ($blogcat) {
            if ($blogcat->id !== 1) {
                Blog::where('blogcat_id', $blogcat->id)->update(['blogcat_id' => 1]);
            } else {
                throw new \Exception('Default Blog category cannot be deleted.');
            }
        });
    }

    protected $fillable = ['name', 'slug'];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
