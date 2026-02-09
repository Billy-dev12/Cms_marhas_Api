<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $ach1 = Achievement::create([
            'title' => 'Juara 1 LKS Web Technologies',
            'winner_name' => 'Budi Santoso',
            'rank' => 'Juara 1',
            'level' => 'provinsi',
            'date_achieved' => '2025-08-17',
            'description' => 'Meraih medali emas dalam ajang LKS tingkat provinsi.',
        ]);
        $ach1->image()->create(['file_path' => 'seeders/jawa1.png']);

        $ach2 = Achievement::create([
            'title' => 'Juara 2 Futsal Cup',
            'winner_name' => 'Tim Futsal Sekolah',
            'rank' => 'Juara 2',
            'level' => 'kabupaten',
            'date_achieved' => '2025-10-28',
            'description' => 'Turnamen futsal antar pelajar se-kabupaten.',
        ]);
        $ach2->image()->create(['file_path' => 'seeders/jawa2.png']);
    }
}
