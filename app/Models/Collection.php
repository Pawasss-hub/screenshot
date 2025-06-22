<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    // Relasi ke User (pemilik koleksi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many ke Scene lewat tabel pivot collection_scene
    public function scenes()
    {
        return $this->belongsToMany(Scene::class, 'collection_scene');
    }
}
