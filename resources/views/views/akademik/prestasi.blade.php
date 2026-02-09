@extends('layouts.frontend')

@section('title', 'Prestasi Siswa - SMK MARHAS')

@section('content')
<style>
    /* --- WRAPPER & LAYOUT --- */
    .prestasi-wrapper {
        background-color: #f9fafb;
        padding: 50px 0;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        color: #1f2937;
    }

    .container-custom {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* --- PAGE HEADER (News UI Style) --- */
    .header-section {
        display: flex;
        align-items: center;
        gap: 40px;
        margin-bottom: 50px;
        background: white;
        padding: 30px;
        border-radius: 20px;
        /* box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); */
    }

    .header-image {
        flex: 0 0 120px;
        height: 120px;
        background: #e0f2fe;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0284c7;
        font-size: 50px;
    }

    .header-content h1 {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .header-content p {
        color: #6b7280;
        font-size: 16px;
        line-height: 1.6;
        max-width: 800px;
    }

    /* --- STATS / MAP TITLE --- */
    .stats-title-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .stats-title-section h2 {
        font-size: 24px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 5px;
    }

    .stats-title-section p {
        color: #6b7280;
    }

    /* --- FILTER BAR --- */
    .filter-card {
        background: white;
        border-radius: 16px;
        /* box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); */
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid #f3f4f6;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .filter-label {
        font-size: 13px;
        font-weight: 600;
        color: #4b5563;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-select, .filter-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        background-color: #f9fafb;
        color: #374151;
        font-size: 14px;
        transition: all 0.2s;
    }

    .filter-select:focus, .filter-input:focus {
        border-color: var(--primary-color);
        background-color: white;
        outline: none;
        /* box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); */
    }

    /* Search takes full width on its row or spans columns */
    .search-row {
        grid-column: span 4;
        margin-top: 10px;
        display: flex;
        gap: 15px;
        align-items: flex-end;
    }

    .btn-search {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        height: 42px; /* Match input height */
    }

    .btn-search:hover {
        background-color: var(--hover-color);
    }

    /* --- DATA TABLE --- */
    .table-container {
        background: white;
        border-radius: 16px;
        /* box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); */
        border: 1px solid #f3f4f6;
        overflow: hidden;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th {
        background-color: #f8fafc;
        text-align: left;
        padding: 18px 25px;
        font-size: 13px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-custom td {
        padding: 20px 25px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 15px;
        vertical-align: middle;
    }

    .table-custom tr:last-child td { border-bottom: none; }
    .table-custom tr:hover td { background-color: #f8fafc; }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-gold { background: #fef3c7; color: #d97706; border: 1px solid #fcd34d; }
    .badge-silver { background: #f1f5f9; color: #64748b; border: 1px solid #cbd5e1; }
    .badge-bronze { background: #fff7ed; color: #c2410c; border: 1px solid #fdba74; }
    
    .badge-level { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }

    /* --- RESPONSIVE --- */
    @media (max-width: 1024px) {
        .filter-grid { grid-template-columns: repeat(2, 1fr); }
        .search-row { grid-column: span 2; }
    }

    @media (max-width: 768px) {
        .header-section { flex-direction: column; text-align: center; gap: 20px; }
        .filter-grid { grid-template-columns: 1fr; }
        .search-row { grid-column: span 1; flex-direction: column; }
        .btn-search { width: 100%; }
        
        /* Table scroll for mobile */
        .table-container { overflow-x: auto; }
        .table-custom th, .table-custom td { white-space: nowrap; }
    }
</style>

<div class="prestasi-wrapper">
    <div class="container-custom">
        <!-- Stats Title -->
        <div class="stats-title-section fade-in">
            <h2>Peserta Didik Berprestasi Tersebar Diberbagai Provinsi</h2>
            <p>Lacak jumlah Peserta Didik berprestasi berdasarkan wilayah dan kategori.</p>
        </div>

        <!-- Filter Bar -->
        <div class="filter-card fade-in">
            <form action="" method="GET">
                <div class="filter-grid">
                    <!-- Provinsi -->
                    <div class="filter-item">
                        <label class="filter-label">Provinsi</label>
                        <select class="filter-select">
                            <option value="">Cari Provinsi</option>
                            <option value="jabar">Jawa Barat</option>
                            <option value="jateng">Jawa Tengah</option>
                            <option value="jatim">Jawa Timur</option>
                        </select>
                    </div>

                    <!-- Kabupaten -->
                    <div class="filter-item">
                        <label class="filter-label">Kabupaten</label>
                        <select class="filter-select" disabled>
                            <option value="">Cari Kabupaten</option>
                        </select>
                    </div>

                    <!-- Tingkat Prestasi -->
                    <div class="filter-item">
                        <label class="filter-label">Tingkat Prestasi</label>
                        <select class="filter-select">
                            <option value="">Semua</option>
                            <option value="internasional">Internasional</option>
                            <option value="nasional">Nasional</option>
                            <option value="provinsi">Provinsi</option>
                            <option value="kabkota">Kabupaten/Kota</option>
                        </select>
                    </div>

                    <!-- Jenjang Pendidikan -->
                    <div class="filter-item">
                        <label class="filter-label">Jenjang Pendidikan</label>
                        <select class="filter-select">
                            <option value="">Semua</option>
                            <option value="smk">SMK</option>
                            <option value="smp">SMP</option>
                            <option value="sd">SD</option>
                        </select>
                    </div>

                    <!-- Kategori -->
                    <div class="filter-item">
                        <label class="filter-label">Kategori</label>
                        <select class="filter-select">
                            <option value="">Semua</option>
                            <option value="sains">Sains & Teknologi</option>
                            <option value="olahraga">Olahraga</option>
                            <option value="seni">Seni & Budaya</option>
                            <option value="agama">Keagamaan</option>
                        </select>
                    </div>

                     <!-- Tahun -->
                     <div class="filter-item">
                        <label class="filter-label">Tahun</label>
                        <select class="filter-select">
                            <option value="">Semua</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>

                    <!-- Search Row -->
                    <div class="search-row">
                        <div class="filter-item" style="flex-grow: 1;">
                            <label class="filter-label">Kata Kunci</label>
                            <input type="text" class="filter-input" placeholder="Cari nama siswa atau event...">
                        </div>
                        <button type="button" class="btn-search">
                            <i class="fas fa-search"></i> Cari Data
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container fade-in">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Siswa / Tim</th>
                        <th width="30%">Nama Kompetisi</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Tingkat</th>
                        <th width="15%">Capaian</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <!-- Row 1 -->
                    <tr>
                        <td>1</td>
                        <td>
                            <strong>Ahmad Subagja</strong>
                            <div style="font-size: 12px; color: #666;">Kelas XI - Teknik Pemesinan</div>
                        </td>
                        <td>
                            Lomba Kompetensi Siswa (LKS) Bidang CNC Milling
                            <div style="font-size: 12px; color: #666;"><i class="far fa-calendar"></i> 2024</div>
                        </td>
                        <td>Teknologi</td>
                        <td><span class="badge badge-level">Kabupaten</span></td>
                        <td>Juara 1 (Emas)</td>
                    </tr>

                    <!-- Row 2 -->
                    <tr>
                        <td>2</td>
                        <td>
                            <strong>Siti Aminah</strong>
                            <div style="font-size: 12px; color: #666;">Kelas XII - PPLG</div>
                        </td>
                        <td>
                            Web Technologies Competition
                            <div style="font-size: 12px; color: #666;"><i class="far fa-calendar"></i> 2024</div>
                        </td>
                        <td>Sains & Tek</td>
                        <td><span class="badge badge-level">Provinsi</span></td>
                        <td>Juara 2 (Perak)</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td>3</td>
                        <td>
                            <strong>Tim Voli Putra MARHAS</strong>
                            <div style="font-size: 12px; color: #666;">Ekstrakurikuler</div>
                        </td>
                        <td>
                            Turnamen Voli Antar Pelajar Regional
                            <div style="font-size: 12px; color: #666;"><i class="far fa-calendar"></i> 2023</div>
                        </td>
                        <td>Olahraga</td>
                        <td><span class="badge badge-level">Regional</span></td>
                        <td>Juara 3 (Perunggu)</td>
                    </tr>

                    <!-- Row 4 -->
                    <tr>
                        <td>4</td>
                        <td>
                            <strong>Rina Wulandari</strong>
                            <div style="font-size: 12px; color: #666;">Kelas X - PPLG</div>
                        </td>
                        <td>
                            Olimpiade Matematika Terapan
                            <div style="font-size: 12px; color: #666;"><i class="far fa-calendar"></i> 2023</div>
                        </td>
                        <td>Sains</td>
                        <td><span class="badge badge-level">Nasional</span></td>
                        <td>Gold Medal</td>
                    </tr>

                    <!-- Row 5 -->
                    <tr>
                        <td>5</td>
                        <td>
                            <strong>Fajar Shadiq</strong>
                            <div style="font-size: 12px; color: #666;">Kelas XI - TSM</div>
                        </td>
                        <td>
                            Safety Riding Competition Honda
                            <div style="font-size: 12px; color: #666;"><i class="far fa-calendar"></i> 2022</div>
                        </td>
                        <td>Otomotif</td>
                        <td><span class="badge badge-level">Provinsi</span></td>
                        <td>Runner Up</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Example -->
        <div style="margin-top: 30px; text-align: center; color: #999;">
            {{-- This would use the custom pagination partial in a real dynamic scenario --}}
            {{-- {{ $data->links('vendor.pagination.custom') }} --}}
            <button class="btn-secondary" style="background: white; border: 1px solid #ddd;">Muat Lebih Banyak</button>
        </div>

    </div>
</div>
@endsection