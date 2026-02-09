@extends('layouts.frontend')

@section('title', 'Registrasi Alumni - BKK SMK MARHAS')

@section('content')
<style>
    /* Hero Section */
    .bkk-hero {
        background: linear-gradient(rgba(21, 128, 61, 0.9), rgba(21, 128, 61, 0.9)), url('{{ asset("image/bkk-bg.jpg") }}');
        background-size: cover;
        background-position: center;
        padding: 50px 0;
        text-align: center;
        color: white;
    }

    .bkk-hero h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
    }

    /* Main Container */
    .page-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Two Column Layout */
    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        align-items: start;
    }

    /* Form Section */
    .form-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        /* box-shadow: 0 10px 25px rgba(0,0,0,0.05); */
        border: 1px solid #e5e7eb;
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #4b5563; font-size: 0.95rem; }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        transition: 0.3s;
        font-size: 0.95rem;
        background-color: #f9fafb;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        background-color: white;
        outline: none;
        /* box-shadow: 0 0 0 3px rgba(21, 128, 61, 0.1); */
    }

    /* Radio & Checkbox Styling */
    .radio-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .radio-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }
    .radio-option input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
    }

    /* Buttons */
    .btn-row {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        flex: 1;
    }
    .btn-submit:hover { background: #116631; }
    
    .btn-reset {
        background: white;
        color: #ef4444; /* Keep red text for Reset logic, or change to neutral? User said "ubah warna nya menjadi putih" implies background. Let's make it white bg, maybe grey border. Text color commonly matches hover or is neutral. User said "hover jadi hijau". Wait, logic: Reset usually red. But user said "hover jadi hijau". Okay, I will follow exactly: White bg -> Green bg on hover. */
        /* Actually, user said "Reset button... hover valdi hijau". Usually reset is red-ish. But if they want green hover, I will do green hover. */
        /* Let's double check request: "tombol reset itu ubah warna nya menjadi putih tapi saat dihover jadi hijau" */
        border: 1px solid #d1d5db;
        color: #374151;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
        flex: 0.5;
    }
    .btn-reset:hover { 
        background: var(--primary-color); 
        color: white; 
        border-color: var(--primary-color);
    }

    /* Info Loker Sidebar */
    .sidebar-card {
        background: transparent;
        padding: 0; /* Removing padding might affect layout, let's keep padding but remove bg */
        padding: 25px; 
        border: none;
        position: sticky;
        top: 20px;
    }
    .sidebar-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #166534;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .loker-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .loker-item {
        background: white;
        padding: 15px;
        border-radius: 10px;
        /* box-shadow: 0 2px 5px rgba(0,0,0,0.05); */
        transition: transform 0.2s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .loker-item:hover { transform: translateY(-3px); }
    .loker-title { font-weight: 700; color: #1f2937; margin-bottom: 5px; display: block; }
    .loker-meta { font-size: 0.85rem; color: #6b7280; display: block; }

    /* Responsive */
    @media (max-width: 900px) {
        .content-grid { 
            grid-template-columns: 1fr; 
            gap: 30px;
        }
        
        .sidebar-card { 
            /* order: -1; Removed to keep it at the bottom as per user request */
            margin-top: 20px; 
            position: static; /* Remove sticky on mobile if content is stacked */
        }

        .page-container {
            padding: 0 15px; /* Reduce horizontal padding on small screens */
            margin: 20px auto;
        }

        .bkk-hero {
            padding: 40px 0;
        }

        .bkk-hero h1 {
            font-size: 1.8rem; /* Smaller title on mobile */
        }
        
        .form-card {
            padding: 20px; /* Less padding in form card on mobile */
        }

        .btn-row {
            flex-direction: column; /* Stack buttons on very small screens? Or keep row? user said "responsif". 2 buttons in row usually ok, but let's see. */
        }
    }
</style>

<div class="bkk-hero fade-in">
    <h1>REGISTRASI ALUMNI</h1>
    <p>Lengkapi Form di bawah ini untuk terdata di Database Alumni</p>
</div>

<div class="page-container fade-in">
    <div class="content-grid">
        
        <!-- LEFT COLUMN: FORM -->
        <div class="form-card">
            <h2 class="form-title">Formulir Data Diri Alumni</h2>
            <form action="#" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" class="form-control" name="nis" placeholder="Ketik disini.." required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Ketik disini.." required>
                </div>

                <div class="form-group">
                    <label>Jurusan / Tahun Lulus</label>
                    <input type="text" class="form-control" name="jurusan_tahun" placeholder="Contoh: RPL/2017">
                </div>

                <div class="form-group">
                    <label>Tempat, Tanggal Lahir</label>
                    <!-- Using two inputs for better UX, or one text as requested "Ketik disini.." implies text -->
                    <input type="text" class="form-control" name="ttl" placeholder="Ketik disini.. (Contoh: Bandung, 17 Agustus 2005)">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <label class="radio-option"><input type="radio" name="jk" value="L"> Laki-laki</label>
                        <label class="radio-option"><input type="radio" name="jk" value="P"> Perempuan</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Agama</label>
                    <div class="radio-group" style="column-gap: 15px; row-gap: 10px;">
                        <label class="radio-option"><input type="radio" name="agama" value="Islam"> Islam</label>
                        <label class="radio-option"><input type="radio" name="agama" value="Katolik"> Katolik</label>
                        <label class="radio-option"><input type="radio" name="agama" value="Protestan"> Protestan</label>
                        <label class="radio-option"><input type="radio" name="agama" value="Hindu"> Hindu</label>
                        <label class="radio-option"><input type="radio" name="agama" value="Budha"> Budha</label>
                        <label class="radio-option"><input type="radio" name="agama" value="Konghucu"> Konghucu</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" placeholder="Ketik disini.."></textarea>
                </div>

                <div class="form-group">
                    <label>Nomor HP/Whatsapp</label>
                    <input type="text" class="form-control" name="no_hp" placeholder="Ketik disini..">
                </div>

                <div class="form-group">
                    <label>Sosial Media</label>
                    <input type="text" class="form-control" name="sosmed" placeholder="Ketik disini.. (Contoh: IG @username)">
                </div>

                <div class="form-group">
                    <label>Kondisi dan Dimana</label>
                    <div class="radio-group" style="column-gap: 15px; row-gap: 10px;">
                        <label class="radio-option"><input type="radio" name="kondisi" value="Bekerja"> Bekerja</label>
                        <label class="radio-option"><input type="radio" name="kondisi" value="Wirausaha"> Wirausaha</label>
                        <label class="radio-option"><input type="radio" name="kondisi" value="Kuliah"> Kuliah</label>
                        <label class="radio-option"><input type="radio" name="kondisi" value="Belum Bekerja"> Belum Bekerja</label>
                        <label class="radio-option"><input type="radio" name="kondisi" value="Lain-lain"> Lain-lain</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dimana dan Alamat (Tempat Kerja/Kuliah/Usaha)</label>
                    <input type="text" class="form-control" name="tempat_kondisi" placeholder="Ketik disini..">
                </div>

                <div class="btn-row">
                    <button type="submit" class="btn-submit">Daftar</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: INFO LOKER -->
        <div class="sidebar-card">
            <h3 class="sidebar-title"><i class="fas fa-briefcase"></i> Info Loker</h3>
            
            <div class="loker-list">
                <!-- Example Items -->
                <a href="#" class="loker-item">
                    <span class="loker-title">Junior Web Developer</span>
                    <span class="loker-meta">PT. Teknologi Maju • Bandung</span>
                </a>
                <a href="#" class="loker-item">
                    <span class="loker-title">Admin Gudang</span>
                    <span class="loker-meta">CV. Logistik Jaya • Cimahi</span>
                </a>
                <a href="#" class="loker-item">
                    <span class="loker-title">Teknisi Mesin CNC</span>
                    <span class="loker-meta">PT. Manufaktur Indonesia • Kab. Bandung</span>
                </a>
                <a href="#" class="loker-item">
                    <span class="loker-title">Staff Admin & Keuangan</span>
                    <span class="loker-meta">Klinik Sehat • Bandung</span>
                </a>
                
                <div style="text-align: center; margin-top: 10px;">
                    <a href="#" style="color: var(--primary-color); font-weight: 600; font-size: 14px; text-decoration: none;">Lihat Semua Lowongan &rarr;</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection