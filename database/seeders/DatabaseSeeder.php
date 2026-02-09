<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Copy images to storage
        $sourceDir = public_path('image/backend');
        $targetDir = storage_path('app/public/seeders');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $files = glob($sourceDir . '/*');
        foreach ($files as $file) {
            $filename = basename($file);
            copy($file, $targetDir . '/' . $filename);
        }

        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            KejuruanSeeder::class,
            NewsSeeder::class,
            GallerySeeder::class,
            AchievementSeeder::class,
            SliderSeeder::class,
        ]);
    }
}
