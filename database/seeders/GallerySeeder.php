<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 12; $i++) {
            $gallery = Gallery::create([
                'title' => 'Kegiatan ' . $i,
                'description' => 'Dokumentasi kegiatan sekolah nomor ' . $i,
            ]);
            $gallery->media()->create(['file_path' => 'https://via.placeholder.com/1080x1080?text=Gallery+' . $i]);
        }
    }
}
