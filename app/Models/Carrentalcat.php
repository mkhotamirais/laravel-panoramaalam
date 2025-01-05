<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrentalcat extends Model
{
    /** @use HasFactory<\Database\Factories\CarrentalcatFactory> */
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function ($carrentalcat) {
            if ($carrentalcat->id !== 1) {
                Carrental::where('carrentalcat_id', $carrentalcat->id)->update(['carrentalcat_id' => 1]);
            } else {
                throw new \Exception('Default Car Rental category cannot be deleted.');
            }
        });
    }

    protected $fillable = ['name', 'slug'];

    public function carrentals()
    {
        return $this->hasMany(Carrental::class);
    }
}
