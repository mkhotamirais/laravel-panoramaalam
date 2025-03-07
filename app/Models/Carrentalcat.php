<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrentalcat extends Model
{
    /** @use HasFactory<\Database\Factories\CarrentalcatFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function carrentals()
    {
        return $this->hasMany(Carrental::class);
    }
}
