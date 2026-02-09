@extends('layouts.frontend')

@section('title', 'Hubungi Kami - SMK MARHAS Margahayu')

@section('content')
<style>
    .contact-hero {
        background: linear-gradient(rgba(21, 128, 61, 0.8), rgba(21, 128, 61, 0.8)), url('{{ asset("image/hero-bg.jpg") }}');
        background-size: cover;
        padding: 60px 0;
        text-align: center;
        color: white;
    }

    .contact-container { padding: 80px 64px; display: grid; grid-template-columns: 1fr 1.5fr; gap: 50px; }

    /* --- INFO CARDS --- */
    .info-item {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
        background: #f9fafb;
        padding: 25px;
        border-radius: 15px;
        transition: 0.3s;
    }
    .info-item:hover { transform: translateY(-5px); /* box-shadow: 0 10px 20px rgba(0,0,0,0.05); */ }
    .info-item i {
        font-size: 24px;
        color: var(--primary-color);
        background: white;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        /* box-shadow: 0 4px 10px rgba(0,0,0,0.05); */
    }
    .info-text h4 { margin-bottom: 5px; color: #1f2937; }
    .info-text p { color: #6b7280; font-size: 14px; line-height: 1.6; }

    /* --- FORM --- */
    .contact-form-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        /* box-shadow: 0 15px 35px rgba(0,0,0,0.08); */
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #374151; }
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }
    .form-control:focus { border-color: var(--primary-color); /* box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.1); */ }

    /* --- MAP --- */
    .map-section { padding: 0 64px 80px; }
    .map-wrapper {
        border-radius: 20px;
        overflow: hidden;
        /* box-shadow: 0 10px 30px rgba(0,0,0,0.1); */
        height: 450px;
    }

    @media (max-width: 900px) {
        .contact-container { grid-template-columns: 1fr; padding: 40px 20px; }
        .form-row { grid-template-columns: 1fr; }
        .map-section { padding: 0 20px 40px; }
    }
</style>

<div class="contact-hero">
    <div class="fade-in">
        <h1>HUBUNGI KAMI</h1>
        <p>Ada pertanyaan? Kami siap membantu Anda.</p>
    </div>
</div>

<section class="contact-container">
    <div class="contact-info">
        <div class="fade-in">
            <span class="section-badge">INFO KONTAK</span>
            <h2 style="margin: 15px 0 30px;">Saluran Komunikasi <br><span class="text-primary">Resmi Sekolah</span></h2>
        </div>

        <div class="info-item fade-in">
            <i class="fas fa-map-marker-alt"></i>
            <div class="info-text">
                <h4>Alamat Sekolah</h4>
                <p>Jl. Terusan Kopo No.385/299, Margahayu Sel., Kec. Margahayu, Kabupaten Bandung, Jawa Barat 40226</p>
            </div>
        </div>

        <div class="info-item fade-in">
            <i class="fas fa-phone-alt"></i>
            <div class="info-text">
                <h4>Telepon / Fax</h4>
                <p>(022) 5410926</p>
            </div>
        </div>

        <div class="info-item fade-in">
            <i class="fas fa-envelope"></i>
            <div class="info-text">
                <h4>Email</h4>
                <p>adm.smkmarhas@gmail.com</p>
            </div>
        </div>

        <div class="info-item fade-in">
            <i class="fas fa-clock"></i>
            <div class="info-text">
                <h4>Jam Operasional</h4>
                <p>Senin - Jumat: 06:45 – 16:45 WIB<br>Sabtu - Minggu: Tutup</p>
            </div>
        </div>
    </div>

    <div class="contact-form fade-in">
        <div class="contact-form-card">
            <form action="#" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="email@contoh.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Subjek</label>
                    <input type="text" class="form-control" placeholder="Tujuan pesan (Misal: Info PPDB)">
                </div>
                <div class="form-group">
                    <label>Pesan Anda</label>
                    <textarea class="form-control" rows="5" placeholder="Tuliskan pesan Anda secara detail..."></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; padding: 15px;">KIRIM PESAN SEKARANG</button>
            </form>
        </div>
    </div>
</section>

<section class="map-section fade-in">
    <div class="map-wrapper">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2827269149684!2d107.56790847327544!3d-6.9759313683056146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68eed478753375%3A0x4c0d27e8b815d111!2sSMK%20Marhas%20Margahayu%20(SMK%20Pusat%20Keunggulan)!5e0!3m2!1sid!2sid!4v1766050912477!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>
@endsection