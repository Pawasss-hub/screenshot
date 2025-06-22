<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scene;
use App\Models\Film;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;

class SceneController extends Controller
{
    // Tampilkan semua scene
    public function index()
    {
        $scenes = Scene::with('film', 'tags')->get();
        return view('scenes.index', compact('scenes'));
    }

    // Form tambah scene
    public function create()
    {
        $films = Film::all();
        $tags = Tag::all();
        return view('scenes.create', compact('films', 'tags'));
    }

    // Simpan scene baru
    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('scenes', 'public');

        // Simpan scene
        $scene = Scene::create([
            'film_id' => $request->film_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        // Attach tags jika ada
        if ($request->has('tags')) {
            $scene->tags()->attach($request->tags);
        }

        return redirect()->route('scenes.index')->with('success', 'Scene berhasil ditambahkan.');
    }

    // Form edit scene
    public function edit($id)
    {
        $scene = Scene::with('tags')->findOrFail($id);
        $films = Film::all();
        $tags = Tag::all();
        return view('scenes.edit', compact('scene', 'films', 'tags'));
    }

    // Update scene
    public function update(Request $request, $id)
    {
        $scene = Scene::findOrFail($id);

        $request->validate([
            'film_id' => 'required|exists:films,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($scene->image && Storage::disk('public')->exists($scene->image)) {
                Storage::disk('public')->delete($scene->image);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('scenes', 'public');
            $scene->image = $imagePath;
        }

        $scene->film_id = $request->film_id;
        $scene->title = $request->title;
        $scene->description = $request->description;
        $scene->save();

        // Sync tags
        $scene->tags()->sync($request->tags ?? []);

        return redirect()->route('scenes.index')->with('success', 'Scene berhasil diperbarui.');
    }

    // Hapus scene
    public function destroy($id)
    {
        $scene = Scene::findOrFail($id);

        // Hapus gambar dari storage
        if ($scene->image && Storage::disk('public')->exists($scene->image)) {
            Storage::disk('public')->delete($scene->image);
        }

        $scene->delete();

        return redirect()->route('scenes.index')->with('success', 'Scene berhasil dihapus.');
    }

    public function showModal(Scene $scene)
    {
        $scene->load(['comments.user']); // eager load komentar beserta user-nya
        
        // Check if scene is saved by current user
        $isSaved = false;
        if (auth()->check()) {
            $isSaved = auth()->user()->scene()->where('scene_id', $scene->id)->exists();
        }
        
        return view('components.scene-modal', compact('scene', 'isSaved'));
    }

    public function addComment(Request $request, Scene $scene)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = $scene->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        // Load the user relationship for the view
        $comment->load('user');

        // Untuk AJAX, return partial komentar saja
        return view('components.comment-item', ['comment' => $comment]);
    }

    public function updateComment(Request $request, Comment $comment)
    {
        try {
            if (!$comment->isOwnedBy(auth()->user())) {
                abort(403, 'Unauthorized');
            }
            
            $request->validate([
                'body' => 'required|string|max:1000',
            ]);
            
            $comment->body = $request->body;
            $comment->save();
            
            // Load the user relationship for the view
            $comment->load('user');
            
            // Return partial untuk AJAX
            return view('components.comment-item', ['comment' => $comment]);
        } catch (\Exception $e) {
            \Log::error('Comment update error: ' . $e->getMessage());
            abort(500, 'Internal server error');
        }
    }

    public function deleteComment(Request $request, Comment $comment)
    {
        try {
            if (!$comment->isOwnedBy(auth()->user())) {
                abort(403, 'Unauthorized');
            }
            
            $comment->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Comment delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Internal server error'], 500);
        }
    }

    public function toggleSave(Request $request, Scene $scene)
    {
        try {
            $user = auth()->user();
            
            // Check if scene is already saved by user
            $isSaved = $user->scene()->where('scene_id', $scene->id)->exists();
            
            if ($isSaved) {
                // Remove from saved scenes
                $user->scene()->detach($scene->id);
                $action = 'unsaved';
            } else {
                // Add to saved scenes
                $user->scene()->attach($scene->id);
                $action = 'saved';
            }
            
            return response()->json([
                'success' => true,
                'action' => $action,
                'isSaved' => !$isSaved,
                'message' => $action === 'saved' ? 'Scene saved to collection!' : 'Scene removed from collection!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Toggle save error: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'error' => 'Failed to toggle save status'
            ], 500);
        }
    }
}
