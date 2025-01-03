<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tourpackagecat extends Model
{
    protected static function booted()
    {
        static::deleting(function ($tourpackagecat) {
            if ($tourpackagecat->id !== 1) {
                Tourpackage::where('tourpackagecat_id', $tourpackagecat->id)->update(['tourpackagecat_id' => 1]);
            } else {
                throw new \Exception('Default Tour Package category cannot be deleted.');
            }
        });
    }

    protected $fillable = ['name', 'slug'];

    public function tourpackages()
    {
        return $this->hasMany(Tourpackage::class);
    }
}
