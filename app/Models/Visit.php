<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $table = 'visits'; 
    protected $fillable = ['ip_address', 'visited_at'];
    public $timestamps = false;
}
