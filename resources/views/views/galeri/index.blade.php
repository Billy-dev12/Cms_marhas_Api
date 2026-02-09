@extends('layouts.frontend')

@section('title', 'Galeri Sekolah - SMK MARHAS Margahayu')

@section('content')
<style>
    /* --- HERO --- */
    .gallery-hero {
        background: #f3f4f6;
        padding: 50px 0;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 28px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* --- LAYOUT UMUM --- */
    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 50px 20px;
    }

    /* --- PHOTO GRID SYSTEM --- */
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Desktop: 3 Kolom */
        gap: 20px;
        margin-bottom: 40px;
    }

    /* --- KOTAK HIJAU (PLACEHOLDER GAMBAR) --- */
    .green-box {
        width: 100%;
        background-color: #15803d; /* Full Hijau */
        aspect-ratio: 1 / 1; /* Kotak Persegi Sempurna */
        border-radius: 12px;
        /* box-shadow: 0 4px 6px rgba(0,0,0,0.1); */
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .green-box:hover {
        transform: scale(1.03);
        background-color: #166534; /* Hijau lebih gelap saat hover */
    }

    /* --- BUTTON LIHAT SEMUA --- */
    .btn-center-wrapper {
        text-align: center;
        margin-bottom: 80px; /* Jarak ke bagian video */
    }

    .btn-see-all {
        display: inline-block;
        padding: 12px 40px;
        background-color: transparent;
        border: 2px solid #15803d;
        color: #15803d;
        font-weight: 700;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-see-all:hover {
        background-color: #15803d;
        color: white;
    }

    /* --- VIDEO SECTION --- */
    .video-section {
        border-top: 1px solid #e5e7eb;
        padding-top: 50px;
    }

    .video-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Desktop Video: 2 Kolom biar besar */
        gap: 30px;
        margin-top: 30px;
    }

    .video-box {
        width: 100%;
        aspect-ratio: 16 / 9; /* Rasio Video Youtube Standard */
        background-color: #000;
        border-radius: 12px;
        overflow: hidden;
    }

    .video-box iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    /* --- RESPONSIVE MOBILE --- */
    @media (max-width: 768px) {
        .photo-grid {
            grid-template-columns: repeat(2, 1fr); /* Mobile: 2 Kolom ke samping */
            gap: 15px;
        }

        .video-grid {
            grid-template-columns: 1fr; /* Mobile Video: 1 Kolom ke bawah */
        }
    }
</style>

<div class="gallery-hero">
    <div class="fade-in">
        <h1 class="section-title">Galeri Foto</h1>
        <p style="color: #6b7280;">Dokumentasi kegiatan siswa dan fasilitas sekolah</p>
    </div>
</div>

<div class="container-custom">
    
    <div class="photo-grid">
        <div class="green-box fade-in"></div>
        <div class="green-box fade-in"></div>
        <div class="green-box fade-in"></div>
        <div class="green-box fade-in"></div>
        <div class="green-box fade-in"></div>
        <div class="green-box fade-in"></div>
    </div>

    <div class="btn-center-wrapper fade-in">
        <a href="#" class="btn-see-all">Lihat Semua Foto</a>
    </div>


    <div class="video-section fade-in">
        <div style="text-align: center;">
            <h2 class="section-title">Galeri Video</h2>
            <p style="color: #6b7280;">Cuplikan kegiatan dan profil sekolah</p>
        </div>

        <div class="video-grid">
            <div class="video-box">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="video-box">
                 <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            
             <div class="video-box">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           </div>

           <div class="video-box">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
           </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Efek Fade In sederhana saat scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
</script>
@endpush