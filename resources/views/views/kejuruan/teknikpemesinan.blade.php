@extends('layouts.frontend')

@section('title', 'Teknik Pemesinan - SMK MARHAS')

@section('content')
<style>
    /* --- RESET & LAYOUT UMUM --- */
    .mesin-wrapper {
        background-color: #f4f4f4; /* Background abu-abu muda seperti di gambar */
        padding: 40px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .mesin-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
        background: white;
        /* box-shadow: 0 2px 10px rgba(0,0,0,0.05); */
        padding-bottom: 50px;
    }

    /* --- GRID SYSTEM CUSTOM (Jika tidak pakai Bootstrap full) --- */
    .row-custom {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }
    
    .col-left {
        flex: 0 0 70%;
        max-width: 70%;
        padding: 20px;
    }

    .col-right {
        flex: 0 0 30%;
        max-width: 30%;
        padding: 20px;
    }

    /* --- HERO IMAGE (Kiri Atas) --- */
    .main-hero-img {
        width: 100%;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
        background: white;
    }

    /* --- PROFILE CARD (Kanan Atas) --- */
    .profile-card {
        border: 1px solid #eee;
        padding: 20px;
        text-align: center;
        background: white;
        margin-bottom: 30px;
    }

    .profile-img-box {
        width: 140px;
        height: 140px;
        margin: 0 auto 15px;
        border-radius: 50%;
        overflow: hidden;
        border: 5px solid var(--primary-color); /* Lingkaran Hijau */
        padding: 3px;
        background: white;
    }

    .profile-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .kaprog-name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .kaprog-title {
        font-size: 14px;
        color: #777;
    }

    /* --- TEXT CONTENT (Kiri Bawah) --- */
    .content-text {
        text-align: justify;
        line-height: 1.8;
        color: #555;
        font-size: 15px;
        margin-top: 20px;
    }

    /* --- MENU ACCORDION / "PLUS PLUS" (Kanan Bawah) --- */
    .menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .menu-item {
        background-color: #00c0c0; /* Warna Tosca */
        color: white;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0;
        cursor: pointer;
        transition: 0.3s;
        font-weight: bold;
        font-size: 14px;
    }

    .menu-item:hover {
        background-color: #008b8b;
    }

    .menu-text {
        padding: 12px 15px;
        text-transform: uppercase;
    }

    .menu-icon {
        background-color: #222; /* Kotak Hitam untuk icon plus */
        color: white;
        width: 45px;
        height: 45px; /* Tinggi disesuaikan agar full height */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    /* Accordion Styles */
    .menu-item.active .menu-icon {
        transform: rotate(45deg); /* Roate plus to becomes x (close) optional */
        background-color: var(--primary-color);
    }
    
    .menu-item.active {
        background-color: #008b8b;
    }

    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background: #f9f9f9;
        border-left: 3px solid #00c0c0;
    }

    .accordion-inner {
        padding: 15px;
        font-size: 14px;
        color: #555;
        line-height: 1.6;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .col-left, .col-right {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .profile-card {
            margin-top: 20px;
        }
    }
</style>

@include('partials.hero-section', [
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('views.beranda')],
        ['label' => 'Kejuruan', 'url' => null],
        ['label' => 'Teknik Pemesinan', 'url' => null],
    ],
    'heading' => '<span class="highlight">Jurusan</span> Teknik Pemesinan'
])

<div class="mesin-wrapper">
    <div class="mesin-container">
        
        <div class="row-custom">
            <div class="col-left">
                <!-- Fallback image logic if layout specific image isn't available -->
                @php
                    $imagePath = $kejuruan->media->first() ? asset('storage/' . $kejuruan->media->first()->file_path) : asset('image/lab-mesin.jpg');
                @endphp
                <img src="{{ $imagePath }}" onerror="this.src='{{ asset('image/lab-pplg.jpg') }}'" alt="Kegiatan Siswa {{ $kejuruan->nama }}" class="main-hero-img">
            </div>

            <div class="col-right">
                <div class="profile-card">
                    <div class="profile-img-box">
                        <img src="{{ asset('image/kaprog-mesin.jpg') }}" onerror="this.src='{{ asset('image/kaprog-pplg.jpg') }}'" alt="Ketua Program">
                    </div>
                    <div class="kaprog-name">{{ $kejuruan->extras['kaprog'] ?? 'Belum diatur' }}</div>
                    <div class="kaprog-title">Ketua Program {{ $kejuruan->nama }}</div>
                </div>
            </div>
        </div>

        <div class="row-custom">
            <div class="col-left">
                <div class="content-text">
                    {!! $kejuruan->deskripsi !!}
                </div>
            </div>

            <div class="col-right">
                <ul class="menu-list">
                    <!-- KURIKULUM -->
                    <li class="menu-item-wrapper">
                        <div class="menu-item">
                            <span class="menu-text">KURIKULUM</span>
                            <span class="menu-icon"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-inner">
                                <ul style="list-style-type: disc; padding-left: 20px;">
                                    <li>Dasar Perancangan Teknik Mesin</li>
                                    <li>Gambar Teknik Manufaktur (CAD 2D/3D)</li>
                                    <li>Teknik Pemesinan Bubut & Frais</li>
                                    <li>Teknik Pemesinan Gerinda</li>
                                    <li>Teknik Pemesinan NC/CNC & CAM</li>
                                    <li>Produk Kreatif dan Kewirausahaan</li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- PELUANG KERJA -->
                    <li class="menu-item-wrapper">
                        <div class="menu-item">
                            <span class="menu-text">PELUANG KERJA</span>
                            <span class="menu-icon"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-inner">
                                <ul style="list-style-type: disc; padding-left: 20px;">
                                    <li>Operator Mesin Industri (Bubut, Milling, CNC)</li>
                                    <li>Programmer CNC</li>
                                    <li>Quality Control (QC) Manufaktur</li>
                                    <li>Drafter Teknik (CAD Operator)</li>
                                    <li>Maintenance & Repair Technician</li>
                                    <li>Wirausaha Bengkel Pemesinan</li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- KUNJUNGAN INDUSTRI -->
                    <li class="menu-item-wrapper">
                        <div class="menu-item">
                            <span class="menu-text">KUNJUNGAN INDUSTRI</span>
                            <span class="menu-icon"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-inner">
                                <p>Siswa diajak mengunjungi berbagai industri manufaktur terkemuka untuk melihat langsung proses produksi dan budaya kerja, antara lain:</p>
                                <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                    <li>PT. Dirgantara Indonesia (Indonesian Aerospace)</li>
                                    <li>PT. Pindad (Persero)</li>
                                    <li>Toyota Motor Manufacturing Indonesia</li>
                                    <li>Berbagai industri komponen otomotif di kawasan industri Jawa Barat</li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- PRESTASI -->
                    <li class="menu-item-wrapper">
                        <div class="menu-item">
                            <span class="menu-text">PRESTASI</span>
                            <span class="menu-icon"><i class="fas fa-plus"></i></span>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-inner">
                                <ul style="list-style-type: disc; padding-left: 20px;">
                                    <li>Juara 1 Lomba Kompetensi Siswa (LKS) Tingkat Kabupaten - Bidang CNC Turning</li>
                                    <li>Juara 2 LKS Tingkat Provinsi - Bidang Mechanical Engineering CAD</li>
                                    <li>Juara Harapan 1 Lomba Inovasi Teknologi Tepat Guna</li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- NEW SECTION: INFORMASI LENGKAP -->
        <div class="row-custom" style="margin-top: 50px; border-top: 1px solid #eee; padding-top: 40px;">
            <div class="col-left" style="max-width: 100%; flex: 0 0 100%;">
                <h3 style="font-size: 24px; color: #1f2937; margin-bottom: 20px; border-left: 5px solid var(--primary-color); padding-left: 15px;">
                    Informasi Lengkap Teknik Pemesinan
                </h3>
                <div class="content-text">
                    <p style="margin-bottom: 15px;">
                        Teknik Pemesinan adalah salah satu kompetensi keahlian yang paling mendasar dan vital dalam dunia industri manufaktur. Di SMK MARHAS, jurusan ini tidak hanya mengajarkan cara mengoperasikan mesin, tetapi juga menanamkan pola pikir presisi, disiplin, dan keselamatan kerja (K3) yang menjadi standar industri global.
                    </p>
                    <p style="margin-bottom: 15px;">
                        <strong>Fasilitas Unggulan:</strong><br>
                        Kami memiliki bengkel pemesinan yang luas dan lengkap, terdiri dari mesin bubut konvensional, mesin frais, mesin gerinda, hingga mesin CNC (Computer Numerical Control) terbaru. Siswa juga dibekali dengan laboratorium komputer untuk desain CAD (Computer Aided Design) dan simulasi CAM (Computer Aided Manufacturing) sebelum melakukan eksekusi pada mesin nyata.
                    </p>
                    <p style="margin-bottom: 15px;">
                        <strong>Metode Pembelajaran:</strong><br>
                        Pembelajaran dilakukan dengan sistem blok (Teori dan Praktik) dengan porsi praktik yang lebih dominan (70:30). Kami menerapkan model <em>Project Based Learning</em> (PjBL) di mana siswa mengerjakan proyek-proyek nyata, mulai dari pembuatan komponen sederhana, sparepart mesin, hingga perakitan alat tepat guna. Hal ini bertujuan untuk melatih soft skills seperti pemecahan masalah (<em>problem solving</em>) dan kerjasama tim.
                    </p>
                    <p>
                        <strong>Sertifikasi Kompetensi:</strong><br>
                        Setiap lulusan Teknik Pemesinan SMK MARHAS akan mengikuti uji kompetensi keahlian yang bekerja sama dengan Lembaga Sertifikasi Profesi (LSP) P1 maupun P2. Sertifikat ini diakui secara nasional oleh Badan Nasional Sertifikasi Profesi (BNSP), menjadi nilai tambah yang signifikan saat melamar kerja di industri.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                // Toggle active class on button
                this.classList.toggle('active');

                // Get content element (sibling)
                const content = this.nextElementSibling;

                // Toggle animation
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    // Close others if accordion behavior (one open at a time) is desired
                    // menuItems.forEach(otherItem => {
                    //    if (otherItem !== item) {
                    //        otherItem.classList.remove('active');
                    //        otherItem.nextElementSibling.style.maxHeight = null;
                    //    }
                    // });

                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    });
</script>
@endpush
