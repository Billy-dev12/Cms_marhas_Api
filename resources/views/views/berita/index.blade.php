@extends('layouts.frontend')

@section('title', 'Berita & Kegiatan - SMK MARHAS')

@section('content')
<style>
    /* --- WRAPPER UTAMA --- */
    .berita-wrapper {
        background-color: #f9f9f9; /* Latar belakang abu muda */
        padding: 50px 0;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .container-custom {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* --- HEADER SECTION --- */
    .page-header {
        margin-bottom: 40px;
        border-left: 5px solid #f59e0b;
        padding-left: 20px;
    }

    .page-header h2 {
        font-size: 32px;
        color: #333;
        margin: 0;
    }

    /* --- GRID SYSTEM --- */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Kolom */
        gap: 40px 30px; /* Jarak vertikal lebih besar, horizontal standar */
    }

    /* --- ITEM BERITA WRAPPER (Struktur Utama) --- */
    .event-item {
        display: flex;
        flex-direction: column;
        /* Tidak ada background atau border di sini */
    }

    /* --- BAGIAN KOTAK GAMBAR (Ini yang jadi "Kotak") --- */
    .event-thumb-box {
        position: relative;
        background: white;
        border-radius: 12px; /* Sudut membulat */
        overflow: hidden;
        /* box-shadow: 0 4px 15px rgba(0,0,0,0.05); */
        border: 1px solid #eee;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 220px; /* Tinggi gambar tetap */
    }

    /* Efek Hover pada Kotak Gambar saat item disorot */
    .event-item:hover .event-thumb-box {
        transform: translateY(-5px);
        /* box-shadow: 0 10px 25px rgba(0,0,0,0.1); */
    }

    .event-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Badge Tanggal */
    .date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #f59e0b;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        z-index: 10;
        /* box-shadow: 0 2px 6px rgba(0,0,0,0.2); */
    }

    /* --- BAGIAN KONTEN TEKS (Di bawah kotak) --- */
    .event-content-below {
        padding: 15px 5px 0 5px; /* Padding atas agar ada jarak dari gambar */
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        /* Tanpa background, langsung menyatu dengan .berita-wrapper */
    }

    .event-title {
        font-size: 18px;
        font-weight: 700;
        color: #222; /* Warna teks sedikit lebih gelap agar kontras */
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .event-meta {
        font-size: 13px;
        color: #16a34a; /* Warna HIJAU */
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 6px;
        font-weight: 500;
    }

    .meta-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }
    
    .meta-row i {
        margin-top: 3px;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 1024px) {
        .news-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .news-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="berita-wrapper">
    
    <div class="container-custom">
        
        <div class="page-header fade-in">
            <h2>Agenda & Informasi Sekolah</h2>
            <p style="color: #666; margin-top: 5px;">Berita terbaru, jadwal ujian, dan informasi kegiatan di SMK MARHAS Margahayu.</p>
        </div>

        <div class="news-grid">
            
            <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Monday, 22 Dec 2025
                    </div>
                    <img src="{{ asset('image/berita/uas-banner.jpg') }}" alt="UAS Banner"> 
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Ujian Akhir Semester (UAS) Tahun Ajaran 2025/2026</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Kampus SMK MARHAS Margahayu</span>
                        </div>
                        <div class="meta-row">
                            <i class="far fa-clock"></i>
                            <span>22 - 27 Desember 2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Monday, 08 Dec 2025
                    </div>
                    <img src="{{ asset('image/berita/wisuda-banner.jpg') }}" alt="Wisuda Banner">
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Wisuda & Pelepasan Siswa Kelas XII Angkatan 2025</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Hotel Sutan Raja, Soreang</span>
                        </div>
                        <div class="meta-row">
                            <i class="far fa-clock"></i>
                            <span>08.00 WIB - Selesai</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Saturday, 31 May 2025
                    </div>
                    <img src="{{ asset('image/berita/ppdb-banner.jpg') }}" alt="PPDB Banner">
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Penerimaan Peserta Didik Baru (PPDB) Gelombang 1</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Sekretariat PPDB SMK MARHAS</span>
                        </div>
                        <div class="meta-row">
                            <i class="far fa-clock"></i>
                            <span>14.00 - 19.00 WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Thursday, 15 Jan 2026
                    </div>
                    <img src="{{ asset('image/berita/kunjungan.jpg') }}" alt="Kunjungan Industri">
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Kunjungan Industri Jurusan PPLG ke Gameloft Indonesia</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Yogyakarta, Jawa Tengah</span>
                        </div>
                    </div>
                </div>
            </div>

             <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Sunday, 20 Jan 2026
                    </div>
                    <img src="{{ asset('image/berita/lomba.jpg') }}" alt="Lomba Futsal">
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Turnamen Futsal Antar Pelajar Se-Bandung Raya</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>GOR Saparua Bandung</span>
                        </div>
                    </div>
                </div>
            </div>

             <div class="event-item fade-in">
                <div class="event-thumb-box">
                    <div class="date-badge">
                        <i class="far fa-calendar-alt"></i> Friday, 25 Jan 2026
                    </div>
                    <img src="{{ asset('image/berita/workshop.jpg') }}" alt="Workshop">
                </div>
                <div class="event-content-below">
                    <h3 class="event-title">Workshop "Digital Marketing" untuk Kelas XI Bisnis Daring</h3>
                    <div class="event-meta">
                        <div class="meta-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lab Komputer 1 SMK MARHAS</span>
                        </div>
                    </div>
                </div>
            </div>

        </div> </div>
</div>
@endsection