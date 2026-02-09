<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. UAS
        $news1 = News::updateOrCreate(
            ['slug' => 'ujian-akhir-semester-uas-2025-2026'],
            [
                'title' => 'Ujian Akhir Semester (UAS) Tahun Ajaran 2025/2026',
                'content' => 'Pelaksanaan Ujian Akhir Semester Ganjil Tahun Ajaran 2025/2026 akan dilaksanakan secara serentak.',
                'status' => 'published',
                'event_date' => '2025-12-22',
                'location' => 'Kampus SMK MARHAS'
            ]
        );
        if (!$news1->image()->exists()) {
            $news1->image()->create(['file_path' => 'seeders/jawa4.png']);
        }

        // 2. Wisuda
        $news2 = News::updateOrCreate(
            ['slug' => 'wisuda-pelepasan-siswa-2025'],
            [
                'title' => 'Wisuda & Pelepasan Siswa Kelas XII Angkatan 2025',
                'content' => 'Acara seremonial pelepasan siswa kelas XII yang telah menyelesaikan masa studinya di SMK MARHAS.',
                'status' => 'published',
                'event_date' => '2025-12-08',
                'location' => 'Hotel Sutan Raja'
            ]
        );
        if (!$news2->image()->exists()) {
            $news2->image()->create(['file_path' => 'seeders/jawa5.jpeg']);
        }

        // 3. PPDB
        $news3 = News::updateOrCreate(
            ['slug' => 'ppdb-gelombang-1'],
            [
                'title' => 'Penerimaan Peserta Didik Baru (PPDB) Gelombang 1',
                'content' => 'Segera daftarkan diri Anda di Gelombang 1 PPDB SMK MARHAS. Kuota terbatas!',
                'status' => 'published',
                'event_date' => '2025-05-31',
                'location' => 'Sekretariat PPDB'
            ]
        );
        if (!$news3->image()->exists()) {
            $news3->image()->create(['file_path' => 'seeders/jawa1.png']);
        }

        // 4. Kunjungan Industri (Gameloft)
        $news4 = News::updateOrCreate(
            ['slug' => 'kunjungan-industri-gameloft'],
            [
                'title' => 'Kunjungan Industri Jurusan PPLG ke Gameloft Indonesia',
                'content' => 'Studi lapangan untuk melihat proses pengembangan game di studio Gameloft Yogyakarta.',
                'status' => 'published',
                'event_date' => '2026-01-15',
                'location' => 'Yogyakarta'
            ]
        );
        if (!$news4->image()->exists()) {
            $news4->image()->create(['file_path' => 'seeders/jawa2.jpeg']); // Assume/Reuse available image
        }

        // 5. Turnamen Futsal
        $news5 = News::updateOrCreate(
            ['slug' => 'turnamen-futsal-bandung-raya'],
            [
                'title' => 'Turnamen Futsal Antar Pelajar Se-Bandung Raya',
                'content' => 'Ajang kompetisi futsal bergengsi antar pelajar SMA/SMK se-Bandung Raya.',
                'status' => 'published',
                'event_date' => '2026-01-20',
                'location' => 'GOR Saparua Bandung'
            ]
        );
        if (!$news5->image()->exists()) {
            $news5->image()->create(['file_path' => 'https://via.placeholder.com/800x600.png?text=Futsal']);
        }

        // 6. Workshop Digital Marketing
        $news6 = News::updateOrCreate(
            ['slug' => 'workshop-digital-marketing-bdp'],
            [
                'title' => 'Workshop "Digital Marketing" untuk Kelas XI Bisnis Daring',
                'content' => 'Pelatihan strategi pemasaran digital terkini untuk siswa jurusan BDP.',
                'status' => 'published',
                'event_date' => '2026-01-25',
                'location' => 'Lab Komputer 1'
            ]
        );
        if (!$news6->image()->exists()) {
            $news6->image()->create(['file_path' => 'https://via.placeholder.com/800x600.png?text=Workshop']);
        }
    }
}
