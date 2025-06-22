<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Scene;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $scenes = Scene::with(['film', 'tags'])->inRandomOrder()->get();
        $films = Film::all();
        $tags = Tag::all();
        $user = Auth::user(); // null jika tidak login

        return view('homepage', compact('scenes', 'films', 'tags', 'user'));
    }
}
