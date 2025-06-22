<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Tag;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        
        if (empty($query)) {
            return response()->json([
                'movies' => [],
                'tags' => [],
                'query' => $query
            ]);
        }

        // Search movies
        $movies = Film::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'poster', 'release_year']);

        // Search tags
        $tags = Tag::where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name']);

        return response()->json([
            'movies' => $movies,
            'tags' => $tags,
            'query' => $query
        ]);
    }
} 