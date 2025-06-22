<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Scene;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CollectionController extends Controller
{
    // Tampilkan semua koleksi milik user yang login
    public function index()
    {
        $collections = Auth::user()->collections()->with('scenes')->get();
        return view('collections.index', compact('collections'));
    }

    // Form tambah koleksi baru
    public function create()
    {
        return view('collections.create');
    }

    // Simpan koleksi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $collection = Auth::user()->collections()->create($request->only('name', 'description'));

        return redirect()->route('collections.show', $collection->id)
            ->with('success', 'Collection created successfully.');
    }

    // Tampilkan detail koleksi beserta scenes-nya
    public function show($id)
    {
        $collection = Auth::user()->collections()->with('scenes')->findOrFail($id);
        return view('collections.show', compact('collection'));
    }

    // Form tambah scene ke koleksi
    public function addSceneForm($id)
    {
        $collection = Auth::user()->collections()->findOrFail($id);
        $scenes = Scene::with(['film', 'tags'])->get(); // Load relasi film dan tags
        return view('collections.add_scene', compact('collection', 'scenes'));
    }

    // Proses tambah scene ke koleksi
    public function addScene(Request $request, $id)
    {
        $request->validate([
            'scene_ids' => 'required|array',
            'scene_ids.*' => 'exists:scenes,id',
        ]);

        $collection = Auth::user()->collections()->findOrFail($id);

        // Tambahkan scene yang dipilih ke collection
        foreach ($request->scene_ids as $sceneId) {
            if (!$collection->scenes->contains($sceneId)) {
                $collection->scenes()->attach($sceneId);
            }
        }

        return redirect()->route('collections.show', $collection->id)
            ->with('success', 'Scenes added to collection successfully.');
    }

    // Hapus koleksi
    public function destroy($id)
    {
        $collection = Auth::user()->collections()->findOrFail($id);
        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', 'Collection deleted.');
    }

    // Tampilkan modal pilih koleksi
    public function showAddSceneModal(Request $request)
    {
        try {
            $collections = auth()->user()->collections;

            if ($collections->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum memiliki koleksi. Silakan buat koleksi terlebih dahulu.'
                ]);
            }

            return view('components.collection-modal', [
                'collections' => $collections,
                'scene_id' => $request->scene_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memuat modal koleksi.'
            ]);
        }
    }

    // Simpan scene ke koleksi (AJAX)
    public function addSceneAjax(Request $request)
    {
        try {
            $request->validate([
                'collection_id' => 'required|exists:collections,id',
                'scene_id' => 'required|exists:scenes,id',
            ]);

            $collection = auth()->user()->collections()->findOrFail($request->collection_id);

            // Check if scene already exists in collection
            if ($collection->scenes()->where('scene_id', $request->scene_id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Scene sudah ada dalam koleksi ini.'
                ]);
            }

            $collection->scenes()->attach($request->scene_id);

            return response()->json([
                'success' => true,
                'message' => 'Scene berhasil disimpan ke koleksi!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->errors())
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan scene ke koleksi.'
            ], 500);
        }
    }

    // Hapus scene dari koleksi
    public function removeScene(Request $request, $id)
    {
        $request->validate([
            'scene_id' => 'required|exists:scenes,id',
        ]);

        $collection = Auth::user()->collections()->findOrFail($id);
        $collection->scenes()->detach($request->scene_id);

        return redirect()->route('collections.show', $collection->id)
            ->with('success', 'Scene removed from collection successfully.');
    }
}
