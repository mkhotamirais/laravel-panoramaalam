<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tourpackagecat extends Model
{
    protected $fillable = ['name', 'slug'];

    public function tourpackages()
    {
        return $this->hasMany(Tourpackage::class);
    }
}
