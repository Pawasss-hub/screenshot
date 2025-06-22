<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Genre;

class FilmController extends Controller
{
    // Tampilkan semua film
    public function index()
    {
        $films = Film::select('id', 'title', 'poster', 'release_year', 'duration')->get();
        $user = auth()->user(); // null jika tidak login

        return view('films.movies', compact('films', 'user'));
    }

    // Form tambah film
    public function create()
    {
        $genres = Genre::all();
        return view('films.create', compact('genres'));
    }

    // Simpan film baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'director' => 'nullable|string|max:255',
            'cast' => 'nullable|string|max:255',
            'release_year' => 'nullable|digits:4',
            'duration' => 'nullable|integer',
            'language' => 'nullable|string|max:100',
            'poster' => 'nullable|image',
            'logo' => 'nullable|image',
            'background' => 'nullable|image',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
            'overlay_color' => 'nullable|string|',
        ]);

        $film = new Film();
        $film->title = $request->title;
        $film->description = $request->description;
        $film->director = $request->director;
        $film->cast = $request->cast;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->language = $request->language;
        $film->overlay_color = $request->overlay_color;

        // Simpan poster, logo, dan background jika ada
        if ($request->hasFile('poster')) {
            $film->poster = $request->file('poster')->store('posters', 'public');
        }
        if ($request->hasFile('logo')) {
            $film->logo = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('background')) {
            $film->background = $request->file('background')->store('backgrounds', 'public');
        }

        $film->save();

        // Sync genre
        if ($request->genre_ids) {
            $film->genres()->sync($request->genre_ids);
        }

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan');
    }

    // Tampilkan detail film
    public function show($id)
    {
        $film = Film::with('genres', 'scenes')->findOrFail($id);
        
        // Check which scenes are saved by current user
        $savedSceneIds = [];
        if (auth()->check()) {
            $savedSceneIds = auth()->user()->scene()->pluck('scene_id')->toArray();
        }
        
        // Get overlay color from film, default to a dark color if not set
        $overlay = $film->overlay_color ?? '#0d0d0d';
        
        return view('films.show', compact('film', 'savedSceneIds', 'overlay'));
    }

    // Form edit film
    public function edit($id)
    {
        $film = Film::with('genres')->findOrFail($id);
        $genres = Genre::all();
        return view('films.edit', compact('film', 'genres'));
    }

    // Update film
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'director' => 'nullable|string|max:255',
            'cast' => 'nullable|string|max:255',
            'release_year' => 'nullable|digits:4',
            'duration' => 'nullable|integer',
            'language' => 'nullable|string|max:100',
            'poster' => 'nullable|image',
            'logo' => 'nullable|image',
            'background' => 'nullable|image',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
            'overlay_color' => 'nullable|string|',
        ]);

        $film = Film::findOrFail($id);
        $film->title = $request->title;
        $film->description = $request->description;
        $film->director = $request->director;
        $film->cast = $request->cast;
        $film->release_year = $request->release_year;
        $film->duration = $request->duration;
        $film->language = $request->language;
        $film->overlay_color = $request->overlay_color;

        if ($request->hasFile('poster')) {
            $film->poster = $request->file('poster')->store('posters', 'public');
        }
        if ($request->hasFile('logo')) {
            $film->logo = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('background')) {
            $film->background = $request->file('background')->store('backgrounds', 'public');
        }

        $film->save();

        // Sync genre
        if ($request->genre_ids) {
            $film->genres()->sync($request->genre_ids);
        } else {
            $film->genres()->detach();
        }

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui');
    }

    // Hapus film
    public function destroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus');
    }
}
