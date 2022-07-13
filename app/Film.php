<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorit;
use App\Rating;

class Film extends Model
{
    protected $fillable = ['judul', 'video', 'status'];
    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }
    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
