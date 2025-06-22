<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    // Tampilkan semua genre
    public function index()
    {
        $genres = Genre::paginate(10);
        return view('genres.index', compact('genres'));

    }

    // Form tambah genre
    public function create()
    {
        return view('genres.create');
    }

    // Simpan genre baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name',
        ]);

        Genre::create($request->only('name'));

        return redirect()->route('genres.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    // Form edit genre
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        return view('genres.edit', compact('genre'));
    }

    // Update genre
    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,' . $id,
        ]);

        $genre->update($request->only('name'));

        return redirect()->route('genres.index')->with('success', 'Genre berhasil diupdate.');
    }

    // Hapus genre
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('genres.index')->with('success', 'Genre berhasil dihapus.');
    }
}
