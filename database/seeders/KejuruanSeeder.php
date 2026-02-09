<?php

namespace Database\Seeders;

use App\Models\Kejuruan;
use Illuminate\Database\Seeder;

class KejuruanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Teknik Pemesinan
        $tp = Kejuruan::create([
            'nama' => 'Teknik Pemesinan',
            'slug' => 'teknik-pemesinan',
            'deskripsi' => 'Ahli operasional mesin & manufaktur',
            'visi_misi' => 'Menghasilkan operator mesin yang presisi dan disiplin.',
            'ikon' => 'seeders/jawa2.png', // Placeholder icon
            'extras' => ['kaprog' => 'Agus Setiawan, S.T', 'jumlah_bengkel' => 2],
        ]);
        // Use placeholder image
        $tp->media()->create(['file_path' => 'https://via.placeholder.com/256x256?text=Teknik+Mesin']);


        // 2. RPL / PPLG
        $pplg = Kejuruan::create([
            'nama' => 'RPL / PPLG',
            'slug' => 'pplg',
            'deskripsi' => 'Software Engineering & Coding',
            'visi_misi' => 'Mencetak programmer handal yang siap kerja.',
            'ikon' => 'seeders/jawa1.png', // Placeholder icon
            'extras' => ['kaprog' => 'Budi Santoso, S.Kom', 'jumlah_lab' => 3],
        ]);
        $pplg->media()->create(['file_path' => 'https://via.placeholder.com/256x256?text=RPL']);
    }
}
