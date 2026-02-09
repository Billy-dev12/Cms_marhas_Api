<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Sambutan Kepala Sekolah
        $sambutan = Profile::updateOrCreate(
            ['type' => 'sambutan'],
            [
                'title' => 'Sambutan Kepala Sekolah',
                'content' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Puji syukur kita panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya. Selamat datang di portal resmi SMK MARHAS Margahayu...</p>',
                'extras' => ['nama_kepsek' => 'Nama Kepala Sekolah, S.Pd., M.M.', 'jabatan' => 'Kepala Sekolah SMK MARHAS'],
            ]
        );
        $sambutan->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/417x556?text=Kepsek']);

        // 2. Sejarah Sekolah
        $sejarah = Profile::updateOrCreate(
            ['type' => 'sejarah'],
            [
                'title' => 'Sejarah Singkat',
                'content' => 'SMK MARHAS Margahayu didirikan dengan semangat untuk memberikan akses pendidikan kejuruan yang berkualitas...',
            ]
        );
        $sejarah->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/631x400?text=Sejarah']);

        // 3. Visi & Misi
        Profile::updateOrCreate(
            ['type' => 'visi_misi'],
            [
                'title' => 'Visi & Misi',
                'content' => 'Menjadi Lembaga Pendidikan Kejuruan yang Unggul.',
                'extras' => [
                    'visi' => '"Menjadi Lembaga Pendidikan Kejuruan yang Unggul, Mencetak Lulusan yang Kompeten..."',
                    'misi' => [
                        'Menyelenggarakan pendidikan dan pelatihan...',
                        'Menanamkan nilai-nilai religius...',
                        'Meningkatkan kualitas SDM...'
                    ]
                ],
            ]
        );

        // 4. Profil Sekolah (Identitas)
        Profile::updateOrCreate(
            ['type' => 'profil'],
            [
                'title' => 'Identitas Sekolah',
                'content' => 'SMK MARHAS Margahayu adalah sekolah swasta (Pusat Keunggulan).',
                'extras' => [
                    'nama_sekolah' => 'SMK MARHAS Margahayu',
                    'npsn' => '20206214',
                    'status' => 'Swasta (Pusat Keunggulan)',
                    'akreditasi' => 'A (Sangat Baik)',
                    'alamat' => 'Jl. Terusan Kopo No.385/299, Margahayu, Kec. Margahayu, Kab. Bandung',
                    'email' => 'adm.smkmarhas@gmail.com',
                    'telepon' => '(022) 5410926'
                ],
            ]
        );

        // 5. BMW (Visi Kami) - NEW
        $bmw = Profile::updateOrCreate(
            ['type' => 'bmw'],
            [
                'title' => 'BMW: Bekerja, Melanjutkan, Wirausaha',
                'content' => 'Siapkan Masa Depanmu di Sini',
                'extras' => ['subtitle' => 'Visi Kami'],
            ]
        );
        $bmw->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/631x400?text=BMW+Vision']);

        // 6. Struktur Organisasi
        Profile::updateOrCreate(
            ['type' => 'struktur'],
            [
                'title' => 'Struktur Organisasi',
                'content' => 'Bagan struktur organisasi sekolah tahun ajaran 2025/2026.',
            ]
        );

        // 7. Sarana & Prasarana
        $lab = Profile::updateOrCreate(
            ['title' => 'Laboratorium Komputer', 'type' => 'sarana'], // Match by title too for sarana
            [
                'content' => 'Fasilitas komputer canggih untuk jurusan PPLG.',
                'extras' => ['kondisi' => 'Baik', 'jumlah' => 4],
            ]
        );
        $lab->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/800x600?text=Lab+Komputer']);

        $bengkel = Profile::updateOrCreate(
            ['title' => 'Bengkel Pemesinan', 'type' => 'sarana'],
            [
                'content' => 'Bengkel lengkap dengan mesin CNC dan Bubut.',
                'extras' => ['kondisi' => 'Baik', 'jumlah' => 2],
            ]
        );
        $bengkel->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/800x600?text=Bengkel+Mesin']);

        // 8. Ekstrakurikuler
        $pramuka = Profile::updateOrCreate(
            ['title' => 'Pramuka', 'type' => 'ekstrakurikuler'],
            [
                'content' => 'Mewujudkan pribadi yang mandiri dan disiplin.',
                'extras' => ['pembina' => 'Kak Budi', 'jadwal' => 'Jumat, 14.00'],
            ]
        );
        $pramuka->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/249x200?text=Pramuka']);

        $futsal = Profile::updateOrCreate(
            ['title' => 'Futsal', 'type' => 'ekstrakurikuler'],
            [
                'content' => 'Mengembangkan bakat olahraga sepak bola mini.',
                'extras' => ['pembina' => 'Pak Andi', 'jadwal' => 'Sabtu, 08.00'],
            ]
        );
        $futsal->media()->firstOrCreate(['file_path' => 'https://via.placeholder.com/249x200?text=Futsal']);
    }
}
