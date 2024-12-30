<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourpackagecat extends Model
{
    /** @use HasFactory<\Database\Factories\TourpackagecatFactory> */
    use HasFactory;

    // protected static function booted()
    // {
    //     static::deleting(function ($blogcat) {
    //         if ($blogcat->id !== 1) {
    //             Carrental::where('carrentalcat_id', $blogcat->id)->update(['_id' => 1]);
    //         } else {
    //             throw new \Exception('Default Car Rental category cannot be deleted.');
    //         }
    //     });
    // }

    protected $fillable = ['name', 'slug'];

    // public function carrentals()
    // {
    //     return $this->hasMany(Carrental::class);
    // }
}
