<?php

namespace App\Models;

use App\Models\User;
use App\Models\Beach;
use App\Models\Hotel;
use App\Models\Adventure;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'ratings',
    ];

    protected function user(){
        return $this->belongsTo(User::class);
    }

    protected function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    protected function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    protected function adventure(){
        return $this->belongsTo(Adventure::class);
    }

    protected function beach(){
        return $this->belongsTo(Beach::class);
    }
}
