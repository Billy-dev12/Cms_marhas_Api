<style>
    /* --- TICKER WRAPPER --- */
    .ticker-section {
        background-color: #f9f9f9; /* Light background matching news page wrapper */
        padding: 50px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        position: relative;
        overflow: hidden;
        /* Separation from footer is handled by this padding + placement in layout */
    }

    .ticker-container {
        display: flex; /* Centers the content if needed, though we use track */
        align-items: center;
        width: 100%;
    }

    /* Gradient Overlay for smooth fade */
    .ticker-section::before,
    .ticker-section::after {
        content: "";
        position: absolute;
        top: 0;
        width: 150px;
        height: 100%;
        z-index: 10;
        pointer-events: none;
    }

    .ticker-section::before {
        left: 0;
        background: linear-gradient(to right, #f9f9f9, transparent);
    }

    .ticker-section::after {
        right: 0;
        background: linear-gradient(to left, #f9f9f9, transparent);
    }

    /* --- TICKER TRACK --- */
    .ticker-track {
        display: flex;
        gap: 30px;
        animation: scroll-cards 40s linear infinite;
        width: max-content; /* Ensure track fits all items */
        
        /* PERFORMANCE OPTIMIZATION */
        will-change: transform;
        transform: translate3d(0, 0, 0); /* Force GPU layer */
        backface-visibility: hidden;
        perspective: 1000px;
    }

    .ticker-section:hover .ticker-track {
        animation-play-state: paused;
    }

    @keyframes scroll-cards {
        0% { transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-50%, 0, 0); } /* Scroll half because we duplicate content */
    }

    /* --- CARD COMPONENT (Replicated from Berita Page) --- */
    /* Fixed width for ticker items */
    .ticker-item {
        width: 350px; 
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
    }

    .ticker-thumb-box {
        position: relative;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        /* box-shadow: 0 4px 15px rgba(0,0,0,0.05); */
        border: 1px solid #eee;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 200px; /* Slightly smaller height for ticker context */
    }

    .ticker-item:hover .ticker-thumb-box {
        transform: translateY(-5px);
        /* box-shadow: 0 10px 25px rgba(0,0,0,0.1); */
    }

    .ticker-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .ticker-date-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: #f59e0b;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        z-index: 10;
        /* box-shadow: 0 2px 6px rgba(0,0,0,0.2); */
    }

    .ticker-content-below {
        padding: 15px 5px 0 5px;
        display: flex;
        flex-direction: column;
    }

    .ticker-title {
        font-size: 16px; /* Slightly adjusted */
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        line-height: 1.4;
        
        /* Clamp text to 2 lines */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ticker-meta {
        font-size: 12px;
        color: #16a34a;
        margin-top: auto;
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-weight: 500;
    }

    .ticker-meta-row {
        display: flex;
        align-items: flex-start;
        gap: 6px;
    }

    .ticker-meta-row i {
        margin-top: 3px;
    }
    
    .ticker-header {
        margin-bottom: 20px;
        text-align: center;
    }
    
    .ticker-header h3 {
        font-size: 24px;
        color: #333;
        font-weight: 700;
    }

    /* Mobile specific adjustments */
    @media (max-width: 768px) {
        .ticker-item {
            width: 280px;
        }
        .ticker-thumb-box {
            height: 160px;
        }
        .ticker-section::before, .ticker-section::after {
            width: 50px;
        }
    }
</style>

<div class="ticker-section">
    <!-- Optional Header within the section -->
    {{-- <div class="ticker-header fade-in">
        <h3>Berita & Kegiatan Terbaru</h3>
    </div> --}}

    <div class="ticker-container">
        <div class="ticker-track">
            <!-- Content Duplicated for Infinite Loop (A + B + A + B logic) -->
            <!-- We repeat the block twice so the animation can scroll -50% cleanly -->
            
            @for ($i = 0; $i < 2; $i++)
            
                <!-- Item 1 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 22 Dec 2025
                        </div>
                        <img src="{{ asset('image/berita/uas-banner.jpg') }}" alt="UAS">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Ujian Akhir Semester (UAS) Tahun Ajaran 2025/2026</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Kampus SMK MARHAS</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 08 Dec 2025
                        </div>
                        <img src="{{ asset('image/berita/wisuda-banner.jpg') }}" alt="Wisuda">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Wisuda & Pelepasan Siswa Kelas XII Angkatan 2025</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Hotel Sutan Raja</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 31 May 2025
                        </div>
                        <img src="{{ asset('image/berita/ppdb-banner.jpg') }}" alt="PPDB">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Penerimaan Peserta Didik Baru (PPDB) Gelombang 1</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Sekretariat PPDB</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 15 Jan 2026
                        </div>
                        <img src="{{ asset('image/berita/kunjungan.jpg') }}" alt="Kunjungan">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Kunjungan Industri Jurusan PPLG ke Gameloft Indonesia</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Yogyakarta</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 20 Jan 2026
                        </div>
                        <img src="{{ asset('image/berita/lomba.jpg') }}" alt="Lomba">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Turnamen Futsal Antar Pelajar Se-Bandung Raya</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>GOR Saparua Bandung</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="ticker-item">
                    <div class="ticker-thumb-box">
                        <div class="ticker-date-badge">
                            <i class="far fa-calendar-alt"></i> 25 Jan 2026
                        </div>
                        <img src="{{ asset('image/berita/workshop.jpg') }}" alt="Workshop">
                    </div>
                    <div class="ticker-content-below">
                        <h3 class="ticker-title">Workshop "Digital Marketing" untuk Kelas XI Bisnis Daring</h3>
                        <div class="ticker-meta">
                            <div class="ticker-meta-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Lab Komputer 1</span>
                            </div>
                        </div>
                    </div>
                </div>

            @endfor
        </div>
    </div>
</div>
