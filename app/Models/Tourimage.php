<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tourimage extends Model
{
    protected $fillable = ['image_path'];
    public function tourpackage()
    {
        return $this->belongsTo(Tourpackage::class);
    }
}
