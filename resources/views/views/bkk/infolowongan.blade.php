@extends('layouts.frontend')

@section('title', 'Info Lowongan Kerja - BKK SMK MARHAS')

@section('content')
<style>
    .page-wrapper {
        padding: 50px 0;
        background: #f8fafc;
        min-height: 80vh;
    }
    
    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* BREADCRUMB / HERO SIMPLE */
    .page-header {
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e2e8f0;
    }
    .page-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 5px;
    }
    .page-header p { color: #64748b; }

    /* LAYOUT GRID */
    .loker-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        align-items: start;
    }

    /* SIDEBAR */
    .sidebar-category {
        background: white;
        padding: 25px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        position: sticky;
        top: 20px;
    }
    .sidebar-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
    }
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .category-btn {
        text-align: left;
        background: none;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        font-size: 0.95rem;
    }
    .category-btn:hover {
        background: #f1f5f9;
        color: var(--primary-color);
    }
    .category-btn.active {
        background: #dcfce7; /* Light green */
        color: #166534; /* Dark green */
    }
    .count-badge {
        background: #f1f5f9;
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 50px;
        color: #94a3b8;
    }
    .category-btn.active .count-badge {
        background: white;
        color: #166534;
    }

    /* CONTENT AREA */
    .content-area {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    /* JOB CARDS */
    .loker-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .loker-card:hover {
        transform: translateY(-3px);
        /* box-shadow: 0 10px 20px -5px rgba(0,0,0,0.05); */
        border-color: var(--primary-color);
    }
    
    .loker-main { flex: 1; }
    .company {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        display: block;
    }
    .job-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 15px;
    }
    .job-meta {
        display: flex;
        gap: 20px;
        font-size: 0.9rem;
        color: #64748b;
        flex-wrap: wrap;
    }
    .meta-item { display: flex; align-items: center; gap: 6px; }

    .btn-detail {
        background: white;
        border: 1px solid #cbd5e1;
        color: #334155;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
        margin-left: 20px;
    }
    .btn-detail:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .loker-layout { grid-template-columns: 1fr; }
        .sidebar-category { margin-bottom: 20px; position: static; }
        .loker-card { flex-direction: column; align-items: flex-start; gap: 20px; }
        .btn-detail { margin-left: 0; width: 100%; text-align: center; }
    }
</style>

<div class="page-wrapper">
    <div class="container-custom">
        
        <!-- Header -->
        <div class="page-header fade-in">
            <h1>Informasi Lowongan Kerja</h1>
            <p>Temukan karier impianmu bersama mitra industri SMK MARHAS</p>
        </div>

        <div class="loker-layout fade-in">
            <!-- Sidebar Filters -->
            <aside class="sidebar-category">
                <h3 class="sidebar-title">Kategori Pekerjaan</h3>
                <ul class="category-list">
                    <li>
                        <button class="category-btn active" onclick="filterLoker('all', this)">
                            Semua Lowongan <span class="count-badge">5</span>
                        </button>
                    </li>
                    <li>
                        <button class="category-btn" onclick="filterLoker('rpl', this)">
                            RPL / PPLG <span class="count-badge">2</span>
                        </button>
                    </li>
                    <li>
                        <button class="category-btn" onclick="filterLoker('mesin', this)">
                            Teknik Mesin <span class="count-badge">2</span>
                        </button>
                    </li>
                    <li>
                        <button class="category-btn" onclick="filterLoker('jobfair', this)">
                            Job Fair <span class="count-badge">1</span>
                        </button>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="content-area">
                <h2 class="section-title">Daftar Lowongan Kerja</h2>
                
                <!-- Job List -->
                <div id="lokerGrid" style="display: flex; flex-direction: column; gap: 20px;">
                    
                    <!-- Item 1: Mesin -->
                    <div class="loker-card" data-category="mesin">
                        <div class="loker-main">
                            <span class="company">PT. Astra Honda Motor</span>
                            <h3 class="job-title">Operator Produksi (CNC Specialist)</h3>
                            <div class="job-meta">
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Bekasi, Jawa Barat</div>
                                <div class="meta-item"><i class="fas fa-tools"></i> Teknik Pemesinan</div>
                                <div class="meta-item"><i class="far fa-clock"></i> Batas: 30 Des 2024</div>
                            </div>
                        </div>
                        <a href="#" class="btn-detail">Detail & Lamar</a>
                    </div>

                    <!-- Item 2: RPL -->
                    <div class="loker-card" data-category="rpl">
                        <div class="loker-main">
                            <span class="company">Tech Innovate Solutions</span>
                            <h3 class="job-title">Junior Web Developer</h3>
                            <div class="job-meta">
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Bandung (Remote)</div>
                                <div class="meta-item"><i class="fas fa-laptop-code"></i> PPLG / RPL</div>
                                <div class="meta-item"><i class="far fa-clock"></i> Batas: 15 Jan 2025</div>
                            </div>
                        </div>
                        <a href="#" class="btn-detail">Detail & Lamar</a>
                    </div>

                    <!-- Item 3: Mesin -->
                    <div class="loker-card" data-category="mesin">
                        <div class="loker-main">
                            <span class="company">CV. Logam Jaya Abadi</span>
                            <h3 class="job-title">Technician Staff</h3>
                            <div class="job-meta">
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Cimahi</div>
                                <div class="meta-item"><i class="fas fa-tools"></i> Teknik Pemesinan</div>
                                <div class="meta-item"><i class="far fa-clock"></i> Batas: 20 Jan 2025</div>
                            </div>
                        </div>
                        <a href="#" class="btn-detail">Detail & Lamar</a>
                    </div>

                    <!-- Item 4: RPL -->
                    <div class="loker-card" data-category="rpl">
                        <div class="loker-main">
                            <span class="company">Startup Studio Bandung</span>
                            <h3 class="job-title">Mobile App Developer Intern</h3>
                            <div class="job-meta">
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Bandung</div>
                                <div class="meta-item"><i class="fas fa-mobile-alt"></i> PPLG</div>
                                <div class="meta-item"><i class="far fa-clock"></i> Batas: 10 Feb 2025</div>
                            </div>
                        </div>
                        <a href="#" class="btn-detail">Detail & Lamar</a>
                    </div>

                    <!-- Item 5: Job Fair -->
                    <div class="loker-card" data-category="jobfair">
                        <div class="loker-main">
                            <span class="company">Disnaker Kab. Bandung</span>
                            <h3 class="job-title">Job Fair Raya Bandung 2025</h3>
                            <div class="job-meta">
                                <div class="meta-item"><i class="fas fa-map-marker-alt"></i> Dome Bale Rame</div>
                                <div class="meta-item"><i class="fas fa-users"></i> Umum / Alumni</div>
                                <div class="meta-item"><i class="far fa-calendar-alt"></i> Pelaksanaan: 1-3 Maret 2025</div>
                            </div>
                        </div>
                        <a href="#" class="btn-detail">Lihat Info</a>
                    </div>

                </div>
                
                <!-- Empty State (Hidden Pattern) -->
                <div id="emptyState" style="display: none; text-align: center; padding: 40px; color: #64748b;">
                    <i class="far fa-folder-open" style="font-size: 40px; margin-bottom: 10px; display: block;"></i>
                    <p>Tidak ada lowongan untuk kategori ini.</p>
                </div>

            </main>
        </div>
    </div>
</div>

<script>
    function filterLoker(category, btnElement) {
        // 1. Manage Active State
        const buttons = document.querySelectorAll('.category-btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');

        // 2. Filter Content
        const cards = document.querySelectorAll('.loker-card');
        let hasVisible = false;

        cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                hasVisible = true;
            } else {
                card.style.display = 'none';
            }
        });

        // 3. Toggle Empty State
        const emptyState = document.getElementById('emptyState');
        if (!hasVisible) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }
</script>
@endsection