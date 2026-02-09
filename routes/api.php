<?php

use App\Http\Controllers\Api\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\KejuruanController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\InboxController;
use App\Http\Controllers\Api\EkstrakurikulerController;
use App\Http\Controllers\Api\MitraController;
use App\Http\Controllers\Api\HeroCardController;
use App\Http\Controllers\Api\ModalSliderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth Routes
Route::post('/login', [AuthController::class, 'login']);

// Fallback route
Route::get('/login', function () {
    return response()->json([
        'message' => 'Anda belum login. Silakan login terlebih dahulu.',
        'error' => 'Unauthenticated'
    ], 401);
})->name('login');

// --- Public Routes (Read Only / Open Access) ---

// Custom Custom Routes (Must come before resources to avoid conflict with {id})
Route::get('/profile/tipe', [ProfileController::class, 'types']);
Route::get('/profile/{type}', [ProfileController::class, 'getByType']); // Filter by Type
Route::get('/profile-sekolah', [App\Http\Controllers\Api\ProfileSekolahController::class, 'index']);
Route::get('/home-config', [App\Http\Controllers\Api\HomeConfigController::class, 'index']);
Route::get('/home-config/tipe', [App\Http\Controllers\Api\HomeConfigController::class, 'getTypes']); // List available sections
Route::get('/home-config/{section}', [App\Http\Controllers\Api\HomeConfigController::class, 'getSection']); // Filtered by Section
Route::post('/kontak', [InboxController::class, 'store']); // Public Contact Form

// Public Resources (Index & Show Only)
Route::apiResource('profile', ProfileController::class)->only(['index', 'show']);
Route::apiResource('jurusan', KejuruanController::class)->only(['index', 'show']);
Route::apiResource('berita', NewsController::class)->only(['index', 'show']);
Route::apiResource('galeri', GalleryController::class)->only(['index', 'show']);
Route::apiResource('prestasi', AchievementController::class)->only(['index', 'show']);
Route::apiResource('slider', SliderController::class)->only(['index', 'show']);
Route::apiResource('ekstrakurikuler', EkstrakurikulerController::class)->only(['index', 'show']);
Route::apiResource('mitra', MitraController::class)->only(['index', 'show']);

// --- Protected Routes (Admin / Write Access) ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    // Admin Resources (Create, Update, Delete)
    // Note: We used 'except(index, show)' because those are public.
    Route::apiResource('profile', ProfileController::class)->except(['index', 'show',]);
    Route::post('profile/{profile}', [ProfileController::class, 'update']);

    // Profile Sekolah Resource (CRUD)
    // Profile Sekolah Resource (CRUD)
    Route::apiResource('profile-sekolah', App\Http\Controllers\Api\ProfileSekolahController::class)->except(['update']);
    Route::post('profile-sekolah/{id}', [App\Http\Controllers\Api\ProfileSekolahController::class, 'update']);

    // Hero Profile Resource (CRUD)
    Route::apiResource('hero-profile', App\Http\Controllers\Api\HeroProfileController::class);
    Route::post('hero-profile/{id}', [App\Http\Controllers\Api\HeroProfileController::class, 'update']);
    Route::apiResource('jurusan', KejuruanController::class)->except(['index', 'show']);
    Route::post('jurusan/{jurusan}', [KejuruanController::class, 'update']);
    Route::apiResource('berita', NewsController::class)->except(['index', 'show']);
    Route::post('berita/{berita}', [NewsController::class, 'update']);
    Route::apiResource('galeri', GalleryController::class)->except(['index', 'show']);
    Route::post('galeri/{galeri}', [GalleryController::class, 'update']);
    Route::delete('galeri/{galeri}/media/{media}', [GalleryController::class, 'deleteMedia']);
    Route::apiResource('prestasi', AchievementController::class)->except(['index', 'show']);
    // Explicit POST update for Slider (to handle multipart/form-data easier)
    Route::post('slider/{slider}', [SliderController::class, 'update']);
    Route::apiResource('slider', SliderController::class)->except(['index', 'show']);

    // Hero Cards (Ekstrakurikuler, Prestasi cards)
    Route::post('hero-cards/{hero_card}', [HeroCardController::class, 'update']);
    Route::apiResource('hero-cards', HeroCardController::class)->except(['index', 'show']);

    // Modal Sliders (Welcome Modal Images)
    Route::post('modal-sliders/{modal_slider}', [ModalSliderController::class, 'update']);
    Route::apiResource('modal-sliders', ModalSliderController::class)->except(['index', 'show']);

    // Inbox Admin (Read & Delete messages)
    Route::apiResource('kontak', InboxController::class)->except(['store', 'update']); // Store is public

    // Media Upload
    Route::post('/media/upload', [MediaController::class, 'store']);
});
