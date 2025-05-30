<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurfSpot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'image',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

