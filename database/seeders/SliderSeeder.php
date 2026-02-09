<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SMK MARHAS Slider 1
        $slider1 = Slider::create([
            'title' => 'SMK MARHAS Slider 1',
            'subtitle' => 'Sekolah Pusat Keunggulan', // Added subtitle as filler since Frontend didn't have specific subtitle
            'link' => '#',
            'is_active' => true,
        ]);
        $slider1->image()->create(['file_path' => 'https://via.placeholder.com/1920x1080?text=Slider+1']);

        // 2. SMK MARHAS Slider 2
        $slider2 = Slider::create([
            'title' => 'SMK MARHAS Slider 2',
            'subtitle' => 'Mencetak Generasi Kompeten',
            'link' => '#',
            'is_active' => true,
        ]);
        $slider2->image()->create(['file_path' => 'https://via.placeholder.com/1920x1080?text=Slider+2']);

        // 3. Mobile Slider 1 (Added as general slider since no type column)
        $slider3 = Slider::create([
            'title' => 'Mobile Slider 1',
            'subtitle' => 'Versi Mobile',
            'link' => '#',
            'is_active' => true,
        ]);
        $slider3->image()->create(['file_path' => 'https://via.placeholder.com/480x200?text=Mobile+Slider+1']);
    }
}
