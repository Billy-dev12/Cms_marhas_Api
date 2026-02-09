<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\HomeSetting;
use App\Models\WelcomeFeature;
use App\Models\HeroCard;
use App\Models\SocialWidget;
use App\Models\BenefitItem;
use App\Models\VisionPoint;
use App\Models\ModalSlider;

class HomeConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Truncate Tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        HomeSetting::truncate();
        WelcomeFeature::truncate();
        HeroCard::truncate();
        SocialWidget::truncate();
        BenefitItem::truncate();
        BenefitItem::truncate();
        VisionPoint::truncate();
        ModalSlider::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Seed Home Settings
        $settings = [
            // Hero Section (Desktop)
            'hero_title' => "SMK MARHAS\nMARGAHAYU",
            'hero_desc' => 'Sekolah Pusat Keunggulan, Mencetak Generasi Kompeten dan Berkarakter.',

            // Profile Section
            'profile_desc' => 'SMK MARHAS Margahayu adalah lembaga pendidikan kejuruan yang berdedikasi tinggi dalam mencetak lulusan yang siap kerja, cerdas, dan berakhlak mulia. Berlokasi strategis di Kabupaten Bandung, kami terus berinovasi dalam metode pembelajaran dan melengkapi fasilitas praktik sesuai standar industri terkini.',
            'profile_image' => 'https://via.placeholder.com/400x350?text=Profile+Image',
            'mobile_profile_image' => 'https://via.placeholder.com/440x200?text=Mobile+Profile',
            'mobile_profile_title' => 'Profil SMK MARHAS',
            'mobile_profile_desc' => 'SMK MARHAS Margahayu adalah lembaga pendidikan kejuruan yang berdedikasi tinggi dalam mencetak lulusan yang siap kerja, cerdas, dan berakhlak mulia.',

            // Welcome Section (Desktop)
            'welcome_title' => "Kenapa Harus \nSMK MARHAS?",
            'welcome_button_text' => 'DAFTAR SPMB SEKARANG',
            'welcome_button_url' => '#',

            // Welcome Section (Mobile)
            'mobile_welcome_title' => "Selamat Datang di \nSMK MARHAS",
            'mobile_welcome_desc' => "Pusat Keunggulan, Mencetak Generasi Kompeten.",
            'mobile_button_text' => "DAFTAR PPDB SEKARANG",
            'mobile_button_url' => "#",

            // Section Headers
            'programs_title' => 'Kompetensi Keahlian',
            'programs_subtitle' => 'Pilih jurusan sesuai minat dan bakatmu untuk masa depan gemilang',
            'gallery_title' => 'Galeri Kegiatan',
            'gallery_subtitle' => 'Dokumentasi aktivitas siswa di lingkungan sekolah dan industri',

            // Mobile Specific Headers
            'mobile_programs_title' => 'Kompetensi Keahlian',
            'mobile_programs_subtitle' => 'Pilih jurusan sesuai minat dan bakatmu',
            'mobile_gallery_title' => 'Galeri Kegiatan',
            'mobile_gallery_subtitle' => 'Dokumentasi aktivitas siswa',
            'mobile_footer_title' => 'SMK MARHAS',
            'mobile_footer_desc' => 'Mencetak Generasi Kompeten dan Berkarakter',

            // Statistics (3 Columns)
            'stat1_value' => 'A',
            'stat1_label' => 'Akreditasi',
            'stat1_sublabel' => 'BAN-SM',

            'stat2_value' => '2',
            'stat2_label' => 'Jurusan',
            'stat2_sublabel' => 'Unggulan',

            'stat3_value' => '1k+',
            'stat3_label' => 'Alumni',
            'stat3_sublabel' => 'Terserap Kerja',

            // Benefits Section (Penerimaan Siswa Baru)
            'benefit_title' => 'Penerimaan Siswa Baru',
            'benefit_subtitle' => 'Tahun Ajaran 2025/2026 Telah Dibuka!',
            'benefit_btn_text' => 'INFO LENGKAP',
            'benefit_btn_url' => '#',

            // Vision / BMW Section
            'vision_title' => 'Visi Kami',
            'vision_subtitle' => 'BMW: Bekerja, Melanjutkan, Wirausaha',
            'vision_tagline' => 'Siapkan Masa Depanmu di Sini',
            'bmw_image' => 'https://via.placeholder.com/631x400?text=BMW+Image',
            'mobile_dream_image' => 'https://via.placeholder.com/440x180?text=Mobile+Dream',
        ];

        foreach ($settings as $key => $value) {
            HomeSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Seed Welcome Features
        $features = [
            ['text' => 'Kurikulum Berbasis Industri', 'order' => 1, 'type' => 'desktop'],
            ['text' => 'Fasilitas Praktik Lengkap', 'order' => 2, 'type' => 'desktop'],
            ['text' => 'Penyaluran Kerja (BKK)', 'order' => 3, 'type' => 'desktop'],
            ['text' => 'Kurikulum Industri', 'order' => 1, 'type' => 'mobile'],
            ['text' => 'Fasilitas Lengkap', 'order' => 2, 'type' => 'mobile'],
            ['text' => 'Siap Kerja', 'order' => 3, 'type' => 'mobile'],
        ];

        foreach ($features as $feature) {
            WelcomeFeature::create($feature);
        }

        // 4. Seed Benefits Items
        $benefits = [
            ['text' => 'Terakreditasi "A"', 'order' => 1],
            ['text' => 'Guru Sertifikasi', 'order' => 2],
            ['text' => 'Lingkungan Asri', 'order' => 3],
        ];
        foreach ($benefits as $item) {
            BenefitItem::create($item);
        }

        // 5. Seed Vision Points
        $visions = [
            ['text' => 'Pendidikan Karakter', 'order' => 1],
            ['text' => 'Siap Kerja', 'order' => 2],
            ['text' => 'Disiplin Tinggi', 'order' => 3],
            ['text' => 'Kompeten', 'order' => 4],
        ];
        foreach ($visions as $item) {
            VisionPoint::create($item);
        }

        // 6. Seed Hero Cards
        $baseUrl = config('app.url') . '/storage/hero-cards/';
        // NOTE: We now store relative paths in DB because Media table 'file_path' usually expects relative or full. 
        // But for consistency with previous seeder which used absolute URLs for testing... 
        // Actually, Media table usually stores 'storage/path/file.jpg'.
        // Let's use relative 'storage/hero-cards/...' for the Media 'file_path'.
        // BUT the files must exist there. I assume they do or I'll point to them.
        // For this refactor, I will seed with RELATIVE paths that imply they are in storage.

        $cards = [
            [
                'title' => 'Ekstrakurikuler',
                'image_path' => 'storage/hero-cards/1770173777_b128f36d17967e99c2954e26c4373b25.jpg',
                'link' => '#',
                'order' => 1,
            ],
            [
                'title' => 'Prestasi Siswa',
                'image_path' => 'storage/hero-cards/1770173799_b128f36d17967e99c2954e26c4373b25.jpg',
                'link' => '#',
                'order' => 2,
            ],
            [
                'title' => 'Kunjungan Industri',
                'image_path' => 'storage/hero-cards/1770173811_b128f36d17967e99c2954e26c4373b25.jpg',
                'link' => '#',
                'order' => 3,
            ],
        ];

        foreach ($cards as $item) {
            $card = HeroCard::create([
                'title' => $item['title'],
                'link' => $item['link'],
                'order' => $item['order']
            ]);

            $card->image()->create([
                'file_path' => $item['image_path']
            ]);
        }

        // 7. Seed Social Widgets
        $widgets = [
            [
                'platform' => 'Instagram',
                'embed_code' => '<div class="instagram-feed-container"><div class="instagram-header"><i class="fab fa-instagram" style="font-size: 24px;"></i><span>@marhasupdate</span></div><div style="flex: 1; background: white; min-height: 500px;"><div class="tagembed-widget" style="width:100%;height:100%;min-height:500px;overflow:auto;" data-widget-id="313437" data-website="1"></div><script src="https://widget.tagembed.com/embed.min.js" type="text/javascript"></script></div></div>',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'platform' => 'TikTok',
                'embed_code' => '<div class="tiktok-feed-container"><div class="tiktok-header"><i class="fab fa-tiktok" style="font-size: 24px;"></i><span>@marhasupdate</span></div><div style="flex: 1; background: white;"><script src="https://elfsightcdn.com/platform.js" async></script><div class="elfsight-app-e7b1febe-2c1c-4c20-9619-b3ca0f179095" data-elfsight-app-lazy></div></div></div>',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($widgets as $widget) {
            SocialWidget::create($widget);
        }

        // 8. Seed Modal Sliders
        $modalSliders = [
            [
                'title' => 'Selamat Datang',
                'image_path' => 'storage/hero-cards/1770173777_b128f36d17967e99c2954e26c4373b25.jpg',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'PPDB 2026',
                'image_path' => 'storage/hero-cards/1770173799_b128f36d17967e99c2954e26c4373b25.jpg',
                'is_active' => true,
                'order' => 2,
            ],
        ];

        foreach ($modalSliders as $ms) {
            $slider = ModalSlider::create([
                'title' => $ms['title'],
                'is_active' => $ms['is_active'],
                'order' => $ms['order']
            ]);

            $slider->image()->create([
                'file_path' => $ms['image_path']
            ]);
        }
    }
}
