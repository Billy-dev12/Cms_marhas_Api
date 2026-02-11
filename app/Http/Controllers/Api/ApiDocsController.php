<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ApiDocsController extends Controller
{
    /**
     * Daftar lengkap endpoint dengan search & filter.
     * Query params: ?q=keyword &method=GET &group=profile
     */
    public function index(Request $request)
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {
            return str_starts_with($route->uri, 'api') &&
                !str_contains($route->uri, 'sanctum') &&
                !str_contains($route->uri, 'docs');
        })->map(function ($route) {
            $method = implode('|', array_filter($route->methods, fn($m) => $m !== 'HEAD'));

            $description = $this->generateDescription($route->uri, $method);
            $group = $this->getGroup($route->uri);
            $params = $this->extractParams($route->uri);

            // Deteksi apakah endpoint butuh login
            $middlewares = $route->gatherMiddleware();
            $needsAuth = collect($middlewares)->contains(fn($m) => str_contains((string) $m, 'auth'));

            return [
                'method' => $method,
                'endpoint' => $route->uri,
                'url' => url($route->uri),
                'description' => $description,
                'group' => $group,
                'parameters' => $params,
                'tips' => $this->getTips($method),
                'emoji' => $this->getEmoji($method, $route->uri),
                'auth_required' => $needsAuth,
                'auth_note' => $needsAuth
                    ? '🔒 Endpoint ini khusus admin. Anda harus login terlebih dahulu dan kirim token di header: Authorization: Bearer {token}'
                    : '🟢 Endpoint ini bisa diakses tanpa login (publik).',
            ];
        });

        // === SEARCH & FILTER ===
        $search = $request->query('q') ?? $request->query('search');
        $methodFilter = $request->query('method');
        $groupFilter = $request->query('group');

        if ($search) {
            $search = strtolower($search);
            $routes = $routes->filter(function ($r) use ($search) {
                return str_contains(strtolower($r['endpoint']), $search) ||
                    str_contains(strtolower($r['description']), $search) ||
                    str_contains(strtolower($r['group']), $search);
            });
        }

        if ($methodFilter) {
            $methodFilter = strtoupper($methodFilter);
            $routes = $routes->filter(fn($r) => str_contains($r['method'], $methodFilter));
        }

        if ($groupFilter) {
            $groupFilter = strtolower($groupFilter);
            $routes = $routes->filter(fn($r) => str_contains(strtolower($r['group']), $groupFilter));
        }

        $grouped = $routes->groupBy('group');

        $response = [
            'title' => '📱 SMK Marhas CMS API',
            'greeting' => 'Halo developer! 👋',
            'message' => 'Ini nih daftar API yang tersedia. Silakan dipakai dengan bijak ya!',
            'total_endpoints' => $routes->count(),
            'groups' => $grouped,
            'quick_notes' => [
                '💡' => 'Gunakan header: Authorization: Bearer {token}',
                '🔒' => 'Endpoint dengan * membutuhkan auth',
                '📝' => 'POST/PUT butuh Content-Type: application/json',
                '🎯' => 'Base URL: ' . url('/'),
            ],
            'fun_fact' => 'API ini dibuat dengan ❤️ oleh tim SMK Marhas',
        ];

        // Tampilkan filter aktif jika ada
        if ($search || $methodFilter || $groupFilter) {
            $response['filter_aktif'] = array_filter([
                'pencarian' => $search,
                'method' => $methodFilter,
                'group' => $groupFilter,
            ]);
            $response['message'] = "Menampilkan {$routes->count()} endpoint yang cocok dengan filter kamu 🔍";
        }

        // Tambahkan panduan search
        $response['cara_search'] = [
            'cari_keyword' => url('api') . '?q=profile',
            'filter_method' => url('api') . '?method=GET',
            'filter_group' => url('api') . '?group=berita',
            'kombinasi' => url('api') . '?q=profile&method=POST',
        ];

        return response()->json($response);
    }

    /**
     * Daftar menu sederhana — cuma nama-nama resource yang tersedia.
     * Cocok buat developer yang mau lihat sekilas "ada apa aja sih?"
     */
    public function listMenu()
    {
        $menu = [
            [
                'nama' => '🏠 Konfigurasi Beranda',
                'endpoint' => '/api/home-config',
                'keterangan' => 'Semua data halaman utama (slider, hero, widget, dll) dalam satu panggilan.',
                'akses' => '🟢 Publik — bisa diakses tanpa login.',
            ],
            [
                'nama' => '📰 Berita & Agenda',
                'endpoint' => '/api/berita',
                'keterangan' => 'Daftar berita, pengumuman, dan agenda sekolah.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🏫 Profil Sekolah',
                'endpoint' => '/api/profile-sekolah',
                'keterangan' => 'Informasi lengkap profil sekolah (sejarah, identitas, dll).',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '👤 Profil (Umum)',
                'endpoint' => '/api/profile',
                'keterangan' => 'Data profil berdasarkan tipe (sambutan, visi misi, struktur, dll).',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🎓 Jurusan / Kejuruan',
                'endpoint' => '/api/jurusan',
                'keterangan' => 'Daftar program keahlian yang tersedia di sekolah.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🖼️ Galeri',
                'endpoint' => '/api/galeri',
                'keterangan' => 'Koleksi foto dan dokumentasi kegiatan sekolah.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🏆 Prestasi',
                'endpoint' => '/api/prestasi',
                'keterangan' => 'Daftar pencapaian dan penghargaan siswa maupun sekolah.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🎠 Slider',
                'endpoint' => '/api/slider',
                'keterangan' => 'Gambar slider/banner untuk halaman utama.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🃏 Hero Cards',
                'endpoint' => '/api/hero-cards',
                'keterangan' => 'Kartu hero untuk tampilan beranda (dengan gambar dan link).',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '🖼️ Hero Profile',
                'endpoint' => '/api/hero-profile',
                'keterangan' => 'Gambar hero besar untuk bagian profil di beranda. Jika mau update gambar ekstrakurikuler bisa di sini juga.',
                'akses' => '🔒 Semua aksi butuh login admin (GET/POST/PUT/DELETE).',
            ],
            [
                'nama' => '🎪 Modal Sliders',
                'endpoint' => '/api/modal-sliders',
                'keterangan' => 'Gambar popup/modal yang muncul saat pertama kali buka website.',
                'akses' => '🟢 Publik (GET) | 🔒 Admin (POST/PUT/DELETE — harus login dulu).',
            ],
            [
                'nama' => '⚽ Ekstrakurikuler',
                'endpoint' => '/api/ekstrakurikuler',
                'keterangan' => 'Daftar kegiatan ekstrakurikuler yang ada di sekolah.',
                'akses' => '🟢 Publik (GET) — hanya bisa lihat data.',
            ],
            [
                'nama' => '🤝 Mitra Industri',
                'endpoint' => '/api/mitra',
                'keterangan' => 'Daftar perusahaan dan industri yang bekerja sama dengan sekolah.',
                'akses' => '🟢 Publik (GET) — hanya bisa lihat data.',
            ],
            [
                'nama' => '📬 Kontak / Pesan Masuk',
                'endpoint' => '/api/kontak',
                'keterangan' => 'Kirim pesan (publik) atau kelola pesan masuk (admin).',
                'akses' => '🟢 Publik (POST kirim pesan) | 🔒 Admin (GET/DELETE kelola pesan — harus login dulu).',
            ],
            [
                'nama' => '📤 Upload Media',
                'endpoint' => '/api/media/upload',
                'keterangan' => 'Upload file gambar ke server.',
                'akses' => '🔒 Khusus admin — harus login terlebih dahulu.',
            ],
            [
                'nama' => '🔐 Login',
                'endpoint' => '/api/login',
                'keterangan' => 'Masuk sebagai admin untuk mengelola konten. Kirim email & password, akan dapat token.',
                'akses' => '🟢 Publik — siapa saja bisa mencoba login.',
            ],
            [
                'nama' => '🚪 Logout',
                'endpoint' => '/api/logout',
                'keterangan' => 'Keluar dari sesi admin. Token akan dihapus.',
                'akses' => '🔒 Harus sudah login — kirim token di header.',
            ],
        ];

        return response()->json([
            'title' => '📋 Daftar Menu API',
            'pesan' => 'Berikut adalah daftar fitur/resource yang tersedia di API ini.',
            'total_menu' => count($menu),
            'catatan_penting' => [
                '🟢 Publik' => 'Endpoint bisa diakses langsung tanpa login.',
                '🔒 Admin' => 'Endpoint butuh login dulu. Kirim header: Authorization: Bearer {token_dari_login}.',
                '📖 Detail' => 'Untuk dokumentasi lengkap setiap endpoint, kunjungi ' . url('api'),
            ],
            'cara_login' => [
                'langkah_1' => 'POST ke /api/login dengan body: {"email": "admin@email.com", "password": "password123"}',
                'langkah_2' => 'Simpan token yang didapat dari response.',
                'langkah_3' => 'Kirim token di header setiap request: Authorization: Bearer {token}',
            ],
            'menu' => $menu,
        ]);
    }

    private function generateDescription($uri, $method)
    {
        $actions = [
            'GET' => 'Ambil data',
            'POST' => 'Buat data baru',
            'PUT' => 'Update data',
            'DELETE' => 'Hapus data',
            'PATCH' => 'Update sebagian data'
        ];

        $baseAction = $actions[$method] ?? 'Akses endpoint';

        if (preg_match('/api\/([^\/]+)/', $uri, $matches)) {
            $resource = $matches[1];
            $resource = str_replace('-', ' ', $resource);

            if (str_contains($uri, '{')) {
                return "$baseAction {$resource} spesifik";
            }

            return "$baseAction {$resource}";
        }

        return $baseAction;
    }

    private function getGroup($uri)
    {
        $segments = explode('/', $uri);
        if (isset($segments[1])) {
            $group = $segments[0] . '/' . $segments[1];

            $groupNames = [
                'api/login' => '🔐 Autentikasi',
                'api/logout' => '🔐 Autentikasi',
                'api/user' => '🔐 Autentikasi',
                'api/profile' => '👤 Profil',
                'api/profile-sekolah' => '🏫 Profil Sekolah',
                'api/home-config' => '🏠 Konfigurasi Beranda',
                'api/berita' => '📰 Berita',
                'api/jurusan' => '🎓 Jurusan',
                'api/galeri' => '🖼️ Galeri',
                'api/prestasi' => '🏆 Prestasi',
                'api/slider' => '🎠 Slider',
                'api/hero-cards' => '🃏 Hero Cards',
                'api/hero-profile' => '🖼️ Hero Profile',
                'api/modal-sliders' => '🎪 Modal Sliders',
                'api/ekstrakurikuler' => '⚽ Ekstrakurikuler',
                'api/mitra' => '🤝 Mitra Industri',
                'api/kontak' => '📬 Kontak',
                'api/media' => '📤 Media Upload',
            ];

            return $groupNames[$group] ?? '🎯 ' . ucfirst($segments[1]);
        }

        return '🎯 Umum';
    }

    private function extractParams($uri)
    {
        preg_match_all('/\{(\w+)\}/', $uri, $matches);

        if (empty($matches[1])) {
            return null;
        }

        $params = [];
        foreach ($matches[1] as $param) {
            $params[$param] = [
                'type' => in_array($param, ['id', 'user_id']) ? 'integer' : 'string',
                'required' => true,
                'example' => $this->getParamExample($param),
                'note' => $this->getParamNote($param)
            ];
        }

        return $params;
    }

    private function getParamExample($param)
    {
        $examples = [
            'id' => 123,
            'user_id' => 456,
            'slug' => 'judul-artikel',
            'email' => 'user@example.com',
            'token' => 'abc123...'
        ];

        return $examples[$param] ?? 'value';
    }

    private function getParamNote($param)
    {
        $notes = [
            'id' => 'ID unik dari database',
            'slug' => 'URL-friendly version dari judul',
            'token' => 'Dapatkan dari endpoint login'
        ];

        return $notes[$param] ?? null;
    }

    private function getTips($method)
    {
        $tips = [
            'GET' => 'Bisa pakai query parameters untuk filter',
            'POST' => 'Jangan lupa kirim JSON body ya!',
            'PUT' => 'Butuh ID di URL dan data lengkap di body',
            'DELETE' => 'Hati-hati, data akan hilang permanen!',
            'PATCH' => 'Cukup kirim field yang mau diupdate'
        ];

        return $tips[$method] ?? null;
    }

    private function getEmoji($method, $uri)
    {
        $methodEmojis = [
            'GET' => '📥',
            'POST' => '✨',
            'PUT' => '🔄',
            'DELETE' => '🗑️',
            'PATCH' => '🔧'
        ];

        $emoji = $methodEmojis[$method] ?? '🔗';

        if (str_contains($uri, 'auth') || str_contains($uri, 'login') || str_contains($uri, 'logout'))
            return '🔐';
        if (str_contains($uri, 'upload'))
            return '🚀';
        if (str_contains($uri, 'export'))
            return '📤';

        return $emoji;
    }
}