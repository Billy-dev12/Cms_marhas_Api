@extends('layouts.frontend')

@section('title', 'Kurikulum - SMK MARHAS')

@section('content')
<style>
    .kurikulum-wrapper {
        background-color: #ffffff;
        padding: 20px;
        font-family: "Times New Roman", Times, serif;
        color: #000000;
    }

    .container-custom {
        max-width: 100%;
        margin: 0;
        padding: 10px;
        border: 2px solid black;
    }

    /* --- READER HEADER --- */
    .doc-header {
        text-align: left;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 5px double black;
    }

    .doc-icon {
        display: none; /* Icon hidden for extra ugliness/simplicity */
    }

    .doc-title {
        font-size: 24px;
        font-weight: bold;
        color: #000000;
        margin-bottom: 5px;
        text-transform: uppercase;
        text-decoration: underline;
    }

    .doc-subtitle {
        font-size: 14px;
        color: #000000;
        font-style: italic;
    }

    /* --- SECTIONS --- */
    .content-section {
        margin-bottom: 30px;
        border: 1px solid black;
        padding: 10px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: #000000;
        margin-bottom: 10px;
        background-color: #cccccc;
        padding: 5px;
        border: 1px solid black;
    }

    .section-title i { display: none; }

    /* --- FEATURE GRID (Simple) --- */
    .feature-grid {
        display: block; /* No grid, just block stacking */
    }

    .feature-item {
        background: white;
        padding: 10px;
        margin-bottom: 10px;
        border: 2px solid black;
        border-radius: 0;
    }

    .feature-item:hover {
        transform: none;
    }

    .feature-icon {
        display: none;
    }

    .feature-title {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
        text-decoration: underline;
    }

    .feature-desc {
        font-size: 12px;
        color: #000000;
    }

    /* --- TABLE STYLE --- */
    .curriculum-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border: 2px solid black;
    }

    .curriculum-table th, .curriculum-table td {
        border: 1px solid black;
        padding: 5px;
        font-size: 12px;
        color: black;
    }

    .curriculum-table th {
        background: #cccccc;
        text-align: center;
        font-weight: bold;
    }

    .curriculum-table ul {
        margin: 0; padding-left: 20px;
        color: black;
        list-style-type: square;
    }

    /* --- DOWNLOAD BAR --- */
    .download-bar {
        background: white;
        border: 1px solid black;
        border-radius: 0;
        padding: 10px;
        margin-bottom: 10px;
        display: block;
    }

    .download-info h4 { margin: 0; font-size: 14px; font-weight: bold; }
    .download-info p { margin: 0; font-size: 12px; color: black; }

    .btn-download {
        background: #eeeeee;
        color: blue;
        padding: 2px 5px;
        border: 1px solid black;
        border-radius: 0;
        text-decoration: underline;
        font-size: 12px;
        font-weight: normal;
        display: inline-block;
        margin-top: 5px;
        cursor: pointer;
    }
    .btn-download:hover { background: #dddddd; }
</style>

<div class="kurikulum-wrapper">
    <div class="container-custom">
        
        <!-- HEADER -->
        <div class="doc-header fade-in">
            <div class="doc-icon"><i class="fas fa-book-reader"></i></div>
            <h1 class="doc-title">Kurikulum Pembelajaran</h1>
            <p class="doc-subtitle">Penerapan Kurikulum Merdeka yang berpusat pada peserta didik dan terkoneksi dengan dunia industri.</p>
        </div>

        <!-- PRINCIPLES (Simplified) -->
        <div class="content-section fade-in">
            <div class="section-title"><i class="fas fa-star"></i> Prinsip Pembelajaran</div>
            <div class="feature-grid">
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-shapes"></i></div>
                    <div class="feature-title">Kurikulum Merdeka</div>
                    <div class="feature-desc">Pembelajaran intrakurikuler yang beragam di mana konten akan lebih optimal agar peserta didik memiliki cukup waktu untuk mendalami konsep.</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-handshake"></i></div>
                    <div class="feature-title">Link & Match</div>
                    <div class="feature-desc">Penyelarasan kurikulum sekolah dengan kebutuhan IDUKA (Industri, Dunia Usaha, dan Dunia Kerja).</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="fas fa-cogs"></i></div>
                    <div class="feature-title">Teaching Factory</div>
                    <div class="feature-desc">Model pembelajaran berbasis produk (barang/jasa) melalui sinergi sekolah dengan industri.</div>
                </div>
            </div>
        </div>

        <!-- STRUCTURE TABLE -->
        <div class="content-section fade-in">
            <div class="section-title"><i class="fas fa-layer-group"></i> Struktur Kurikulum</div>
            <table class="curriculum-table">
                <thead>
                    <tr>
                        <th width="30%">Kelompok Mata Pelajaran</th>
                        <th>Rincian Materi / Muatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>A. Muatan Nasional</strong>
                            <div style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Wajib ditempuh seluruh jurusan</div>
                        </td>
                        <td>
                            <ul>
                                <li>Pendidikan Agama dan Budi Pekerti</li>
                                <li>Pendidikan Pancasila dan Kewarganegaraan</li>
                                <li>Bahasa Indonesia</li>
                                <li>Matematika</li>
                                <li>Sejarah Indonesia</li>
                                <li>Bahasa Inggris</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>B. Muatan Kewilayahan</strong>
                            <div style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Muatan Lokal Jawa Barat</div>
                        </td>
                        <td>
                            <ul>
                                <li>Seni Budaya</li>
                                <li>Pendidikan Jasmani, Olahraga, dan Kesehatan</li>
                                <li>Bahasa Sunda</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>C. Muatan Kejuruan</strong>
                            <div style="font-size: 12px; color: #9ca3af; margin-top: 5px;">Sesuai Konsentrasi Keahlian</div>
                        </td>
                        <td>
                            <ul>
                                <li><strong>Dasar Program Keahlian:</strong> Fisika, Kimia, Gambar Teknik (Tergantung Jurusan)</li>
                                <li><strong>Konsentrasi Keahlian:</strong> 
                                    <span style="display:block; margin-top:5px; margin-left:10px;">• Teknik Pemesinan (Bubut, Frais, CNC)</span>
                                    <span style="display:block; margin-left:10px;">• PPLG (Coding, Database, Web)</span>
                                </li>
                                <li>Produk Kreatif dan Kewirausahaan</li>
                                <li>Praktik Kerja Lapangan (PKL)</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- DOWNLOADS -->
        <div class="content-section fade-in">
            <div class="section-title"><i class="fas fa-file-download"></i> Dokumen Akademik</div>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div class="download-bar">
                    <div class="download-info">
                        <h4>Struktur Kurikulum Lengkap</h4>
                        <p>Dokumen detail pembagian jam pelajaran per semester tahun ajaran 2025/2026.</p>
                    </div>
                    <a href="#" class="btn-download"><i class="fas fa-download"></i> Unduh PDF</a>
                </div>

                <div class="download-bar">
                    <div class="download-info">
                        <h4>Panduan Akademik & Tata Tertib</h4>
                        <p>Buku saku siswa mengenai peraturan akademik dan tata tertib sekolah.</p>
                    </div>
                    <a href="#" class="btn-download"><i class="fas fa-download"></i> Unduh PDF</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection