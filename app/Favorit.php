<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Film;

class Favorit extends Model
{
    protected $fillable = ['user_id', 'film_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
