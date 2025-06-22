<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'poster', 'logo', 'description',
        'director', 'cast', 'release_year',
        'duration', 'language', 'overlay_color', 'background'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }

}
