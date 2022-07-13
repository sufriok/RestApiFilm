<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Film;

class Rating extends Model
{
    protected $fillable = ['rating', 'user_id', 'film_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
