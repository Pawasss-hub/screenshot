<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('home.index');
});

// Homepage route (accessible without login)
Route::get('/homepage', [HomeController::class, 'index'])->name('homepage.public');

// ============================
// ✅ Admin Only
// ============================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    Route::resource('films', FilmController::class)->except(['index', 'show']); // CRUD, kecuali index & show
    Route::resource('genres', GenreController::class);
    Route::resource('scenes', SceneController::class);
    Route::resource('tags', TagController::class);
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

// ============================
// ✅ User Authenticated (admin & user biasa)
// ============================
Route::middleware('auth')->group(function () {
    // Halaman home sesudah login
    Route::get('/home', [HomeController::class, 'index'])->name('homepage');

    // Scene save/unsave toggle
    Route::post('/scenes/{scene}/toggle-save', [SceneController::class, 'toggleSave'])->name('scenes.toggleSave');

    // Collection modal routes (HARUS SEBELUM resource collections)
    Route::get('/collections/modal', [CollectionController::class, 'showAddSceneModal'])->name('collections.modal');
    Route::post('/collections/add-scene', [CollectionController::class, 'addSceneAjax'])->name('collections.addSceneAjax');

    // Route collections (favorit, koleksi scene) - HARUS SETELAH modal routes
    Route::resource('collections', CollectionController::class);
    Route::get('collections/{collection}/add-scene', [CollectionController::class, 'addSceneForm'])->name('collections.addSceneForm');
    Route::post('collections/{collection}/add-scene', [CollectionController::class, 'addScene'])->name('collections.addScene');
    Route::delete('collections/{collection}/remove-scene', [CollectionController::class, 'removeScene'])->name('collections.removeScene');

    // Profile routes (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Comment routes - lebih eksplisit untuk debugging
    Route::patch('/comments/{comment}', [SceneController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{comment}', [SceneController::class, 'deleteComment'])->name('comments.delete');
});

// ============================
// ✅ Public / Semua Pengunjung
// ============================

// Search functionality
Route::get('/search', [SearchController::class, 'search'])->name('search');

// User bisa lihat daftar film & detail film (tanpa login pun bisa)
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');

// Scene modal dan comment routes
Route::get('/scenes/{scene}/modal', [SceneController::class, 'showModal'])->name('scenes.modal');
Route::post('/scenes/{scene}/comment', [SceneController::class, 'addComment'])->name('scenes.comment');

require __DIR__.'/auth.php';
