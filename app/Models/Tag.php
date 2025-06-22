<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use HasFactory;
    protected $fillable = ['name'];

    public function scenes()
    {
        return $this->belongsToMany(Scene::class, 'scene_tag');
    }
}
