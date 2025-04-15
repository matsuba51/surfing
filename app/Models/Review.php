<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['surf_spot_id', 'shop_id', 'user_id', 'title', 'content', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function surfSpot()
    {
        return $this->belongsTo(SurfSpot::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);  
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
