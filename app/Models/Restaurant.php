<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website',
        'location',
        'about',
        'profileimage'
    ];

    protected $casts = [
        'amenities' => 'array',
        'restaurantimages' => 'array'
    ];

    protected function reviews(){
        return $this->hasMany(Review::class);
    }
}
