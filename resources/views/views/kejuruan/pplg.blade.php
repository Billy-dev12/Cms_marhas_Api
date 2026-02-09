@extends('layouts.frontend')

@section('title', 'PPLG (Pengembangan Perangkat Lunak & Gim) - SMK MARHAS')

@section('content')
    <style>
        /* --- RESET & LAYOUT UMUM --- */
        .pplg-wrapper {
            background-color: #f4f4f4;
            /* Background abu-abu muda seperti di gambar */
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .pplg-container {
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
            border: 5px solid #00a651;
            /* Lingkaran Hijau */
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
            background-color: #00c0c0;
            /* Warna Tosca */
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
            background-color: #222;
            /* Kotak Hitam untuk icon plus */
            color: white;
            width: 45px;
            height: 45px;
            /* Tinggi disesuaikan agar full height */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        /* Accordion Styles */
        .menu-item.active .menu-icon {
            transform: rotate(45deg);
            /* Roate plus to becomes x (close) optional */
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

            .col-left,
            .col-right {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .profile-card {
                margin-top: 20px;
            }
        }
    </style>

    <div class="pplg-wrapper">
        <div class="pplg-container">

            <div class="row-custom">
                <div class="col-left">
                    @php
                        $imagePath = $kejuruan->media->first() ? asset('storage/' . $kejuruan->media->first()->file_path) : asset('image/lab-pplg.jpg');
                    @endphp
                    <img src="{{ $imagePath }}" alt="Kegiatan Siswa {{ $kejuruan->nama }}" class="main-hero-img">
                </div>

                <div class="col-right">
                    <div class="profile-card">
                        <div class="profile-img-box">
                            <img src="{{ asset('image/kaprog-pplg.jpg') }}" alt="Ketua Program">
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
                                        <li>Dasar Logika & Algoritma Pemrograman</li>
                                        <li>Pemrograman Web (HTML, CSS, JS, PHP/Laravel)</li>
                                        <li>Pemrograman Berorientasi Objek (Java/OOP)</li>
                                        <li>Pemrograman Perangkat Bergerak (Android/Kotlin)</li>
                                        <li>Basis Data (MySQL, MongoDB)</li>
                                        <li>Pengembangan Gim (Unity/C#)</li>
                                        <li>Produk Kreatif & Kewirausahaan</li>
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
                                        <li>Full Stack Web Developer</li>
                                        <li>Mobile Application Developer (Android/iOS)</li>
                                        <li>Game Developer & Designer</li>
                                        <li>UI/UX Designer</li>
                                        <li>Database Administrator</li>
                                        <li>Software Quality Assurance (QA)</li>
                                        <li>IT Consultant & Startup Founder</li>
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
                                    <p>Kami bekerja sama dengan berbagai perusahaan teknologi top untuk memberikan wawasan
                                        industri kepada siswa:</p>
                                    <ul style="list-style-type: disc; padding-left: 20px; margin-top: 5px;">
                                        <li>Gameloft Indonesia (Yogyakarta)</li>
                                        <li>Agate International (Bandung)</li>
                                        <li>PT. Telekomunikasi Indonesia</li>
                                        <li>Software House & Digital Agency di Bandung & Jakarta</li>
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
                                        <li>Juara 1 LKS Tingkat Kabupaten - Web Technologies</li>
                                        <li>Juara 2 LKS Tingkat Provinsi - IT Software Solutions for Business</li>
                                        <li>Finalis Kompetisi Hackathon Pelajar Nasional</li>
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
                    <h3
                        style="font-size: 24px; color: #1f2937; margin-bottom: 20px; border-left: 5px solid var(--primary-color); padding-left: 15px;">
                        Informasi Lengkap PPLG
                    </h3>
                    <div class="content-text">
                        <p style="margin-bottom: 15px;">
                            Pengembangan Perangkat Lunak dan Gim (PPLG) adalah kompetensi keahlian yang mempelajari cara
                            merancang, membuat, menguji, dan memelihara perangkat lunak, mulai dari website, aplikasi
                            mobile, hingga video game interaktif. Jurusan ini sangat relevan dengan kebutuhan Era Digital
                            4.0 di mana hampir semua sektor industri membutuhkan digitalisasi.
                        </p>
                        <p style="margin-bottom: 15px;">
                            <strong>Fasilitas Unggulan:</strong><br>
                            SMK MARHAS menyediakan Laboratorium Komputer dengan spesifikasi tinggi (High-End PC) yang mampu
                            menjalankan software berat seperti Android Studio, Unity 3D, dan Adobe Creative Cloud. Koneksi
                            internet dedicated memastikan proses belajar dan eksplorasi teknologi berjalan lancar tanpa
                            hambatan.
                        </p>
                        <p style="margin-bottom: 15px;">
                            <strong>Metode Pembelajaran:</strong><br>
                            Kami menerapkan metode pembelajaran berbasis proyek (<em>Project Based Learning</em>) dan
                            <em>Teaching Factory</em>. Siswa tidak hanya belajar teori koding, tetapi langsung praktik
                            membuat produk digital nyata. Budaya "Clean Code" dan logika algoritma menjadi pondasi utama
                            yang kami tanamkan sejak kelas X.
                        </p>
                        <p>
                            <strong>Sertifikasi Industri:</strong><br>
                            Lulusan PPLG dibekali sertifikasi kompetensi dari BNSP serta kesempatan mengikuti ujian
                            sertifikasi internasional dari vendor teknologi terkemuka (seperti Microsoft Technology
                            Associate atau Oracle Academy) untuk meningkatkan daya saing di pasar kerja global.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Toggle active class on button
                    this.classList.toggle('active');

                    // Get content element (sibling)
                    const content = this.nextElementSibling;

                    // Toggle animation
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>
@endpush