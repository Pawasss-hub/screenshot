<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['scene_id', 'user_id', 'body'];

    public function scene()
    {
        return $this->belongsTo(Scene::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwnedBy($user)
    {
        return $user && $this->user_id === $user->id;
    }
}
