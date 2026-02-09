<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ApiDocsController;

// Route API Docs (Explorer)
Route::get('/api-docs', [ApiDocsController::class, 'index'])->name('api.docs');

// Route Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('views.beranda');

// Route Profil Sekolah
Route::get('/profil-sekolah', [HomeController::class, 'profilSekolah'])->name('views.profil_sekolah');

// Route Sambutan Kepala Sekolah
Route::get('/sambutan-kepala-sekolah', [HomeController::class, 'sambutan'])->name('views.sambutan');

// Route Visi & Misi
Route::get('/visi-misi', [HomeController::class, 'visimisi'])->name('views.visimisi');

// Route Struktur Organisasi
Route::get('/struktur-organisasi', [HomeController::class, 'struktur'])->name('views.struktur');

// Route Sarana & Prasarana
Route::get('/sarana-prasarana', [HomeController::class, 'sarana'])->name('views.sarana');

// Route Fasilitas Detail
Route::get('/fasilitas-unggulan', [HomeController::class, 'fasilitas'])->name('views.fasilitas');

// Route Ekstrakurikuler
Route::get('/ekstrakurikuler', [HomeController::class, 'ekstrakurikuler'])->name('views.ekstra');

// Route Kejuruan
Route::prefix('kejuruan')->group(function () {
    Route::get('/teknik-pemesinan', [HomeController::class, 'mesin'])->name('views.mesin');
    Route::get('/pplg', [HomeController::class, 'pplg'])->name('views.pplg');
});

// Route Galeri
Route::get('/galeri', [HomeController::class, 'galeri'])->name('views.galeri');

Route::prefix('bkk')->group(function () {
    Route::get('/registrasi-alumni', [HomeController::class, 'registrasiAlumni'])->name('bkk.registrasi');
    Route::get('/info-lowongan', [HomeController::class, 'infoLowongan'])->name('bkk.lowongan');
});

Route::get('/kontak', [HomeController::class, 'kontak'])->name('views.kontak');

// Route Berita
Route::get('/berita', [HomeController::class, 'berita'])->name('views.berita');

Route::get('/kurikulum', [HomeController::class, 'kurikulum'])->name('views.kurikulum');

Route::get('/kalender-akademik', [HomeController::class, 'kalender'])->name('views.kalender');

Route::get('/prestasi', [HomeController::class, 'prestasi'])->name('views.prestasi');
