<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProfileSekolahController;
use App\Http\Controllers\Api\HeroProfileController;
use App\Http\Controllers\Api\KejuruanController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\EkstrakurikulerController;
use App\Http\Controllers\Api\MitraController;
use App\Http\Controllers\Api\InboxController;
use App\Http\Controllers\Api\HeroCardController;
use App\Http\Controllers\Api\ModalSliderController;
use App\Http\Controllers\Api\HomeConfigController;
use App\Http\Controllers\Api\ApiDocsController;
use App\Http\Controllers\Api\MediaController;

Route::get('/listmenu', [ApiDocsController::class, 'listMenu']);
Route::get('/', [ApiDocsController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', fn() => response()->json([
    'message' => 'Anda belum login. Silakan login terlebih dahulu.',
    'error' => 'Unauthenticated'
], 401))->name('login');

Route::get('/profile/tipe', [ProfileController::class, 'types']);
Route::get('/profile/{type}', [ProfileController::class, 'getByType'])->where('type', '[A-Za-z_]+');

Route::get('/profile-sekolah', [ProfileSekolahController::class, 'index']);

Route::get('/home-config', [HomeConfigController::class, 'index']);
Route::get('/home-config/tipe', [HomeConfigController::class, 'getTypes']);
Route::get('/home-config/{section}', [HomeConfigController::class, 'getSection']);

Route::post('/kontak', [InboxController::class, 'store']);

Route::apiResource('profile', ProfileController::class)->only(['index', 'show']);
Route::apiResource('jurusan', KejuruanController::class)->only(['index', 'show']);
Route::apiResource('berita', NewsController::class)->only(['index', 'show']);
Route::apiResource('galeri', GalleryController::class)->only(['index', 'show']);
Route::apiResource('prestasi', AchievementController::class)->only(['index', 'show']);
Route::apiResource('slider', SliderController::class)->only(['index', 'show']);
Route::apiResource('ekstrakurikuler', EkstrakurikulerController::class)->only(['index', 'show']);
Route::apiResource('mitra', MitraController::class)->only(['index', 'show']);
Route::apiResource('hero-cards', HeroCardController::class)->only(['index', 'show']);
Route::apiResource('modal-sliders', ModalSliderController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    Route::apiResource('profile', ProfileController::class)->except(['index', 'show']);
    Route::post('profile/{profile}', [ProfileController::class, 'update']);

    Route::apiResource('profile-sekolah', ProfileSekolahController::class)->except(['update']);
    Route::post('profile-sekolah/{id}', [ProfileSekolahController::class, 'update']);

    Route::apiResource('hero-profile', HeroProfileController::class);
    Route::post('hero-profile/{id}', [HeroProfileController::class, 'update']);

    Route::apiResource('jurusan', KejuruanController::class)->except(['index', 'show']);
    Route::post('jurusan/{jurusan}', [KejuruanController::class, 'update']);

    Route::apiResource('berita', NewsController::class)->except(['index', 'show']);
    Route::post('berita/{berita}', [NewsController::class, 'update']);

    Route::apiResource('galeri', GalleryController::class)->except(['index', 'show']);
    Route::post('galeri/{galeri}', [GalleryController::class, 'update']);
    Route::delete('galeri/{galeri}/media/{media}', [GalleryController::class, 'deleteMedia']);

    Route::apiResource('prestasi', AchievementController::class)->except(['index', 'show']);

    Route::apiResource('slider', SliderController::class)->except(['index', 'show']);
    Route::post('slider/{slider}', [SliderController::class, 'update']);

    Route::apiResource('hero-cards', HeroCardController::class)->except(['index', 'show']);
    Route::post('hero-cards/{hero_card}', [HeroCardController::class, 'update']);

    Route::apiResource('modal-sliders', ModalSliderController::class)->except(['index', 'show']);
    Route::post('modal-sliders/{modal_slider}', [ModalSliderController::class, 'update']);

    Route::apiResource('kontak', InboxController::class)->except(['store', 'update']);

    Route::post('/media/upload', [MediaController::class, 'store']);

    // User Settings
    Route::prefix('user/setting')->group(function () {
        Route::put('profile', [AuthController::class, 'updateProfile']);
        Route::put('password', [AuthController::class, 'updatePassword']);
    });
});