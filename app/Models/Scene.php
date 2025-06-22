<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{

    use HasFactory;

    protected $fillable = ['film_id', 'title', 'image', 'description'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'scene_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'scene_user');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

}
