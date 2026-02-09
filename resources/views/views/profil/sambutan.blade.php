@extends('layouts.frontend')

@section('title', 'Sambutan Kepala Sekolah - SMK MARHAS Margahayu')

@section('content')
<style>
    /* --- CONTENT STYLES --- */
    .section-content { padding: 80px 64px; background: #fff; }

    .sambutan-layout {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 60px;
        align-items: start;
    }

    .headmaster-frame {
        position: relative;
        text-align: center;
    }

    .headmaster-image {
        width: 100%;
        aspect-ratio: 3/4;
        background: var(--light-gray);
        border-radius: 30px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .headmaster-image i { font-size: 100px; color: #ccc; }

    .headmaster-info {
        margin-top: 25px;
        padding: 20px;
        background: var(--green-lightest);
        border-radius: 15px;
    }

    .headmaster-name { font-size: 20px; font-weight: 700; color: #333; margin-bottom: 5px; }
    .headmaster-title { font-size: 14px; color: var(--primary-color); font-weight: 600; text-transform: uppercase; }

    .sambutan-text {
        font-size: 17px;
        line-height: 1.9;
        color: #555;
        text-align: justify;
    }

    .quote-icon {
        font-size: 40px;
        color: var(--green-light);
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* --- TEACHERS SECTION --- */
    .teachers-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .teacher-card {
        /* background: white; REMOVED */
        /* border-radius: 20px; REMOVED/OPTIONAL */
        /* box-shadow: 0 5px 20px rgba(0,0,0,0.05); REMOVED */
        padding: 10px; /* Reduced padding since no box */
        display: flex;
        align-items: center;
        gap: 20px;
        width: calc(50% - 30px); /* 2 items per row with gap consideration */
        /* border: 1px solid #eee; REMOVED */
        transition: transform 0.3s ease;
    }

    .teacher-card:hover { transform: translateY(-5px); }

    .teacher-img {
        width: 80px;
        height: 80px;
        background: var(--light-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 30px;
        color: #aaa;
    }

    .teacher-info { flex: 1; }
    .teacher-name { font-size: 18px; font-weight: 700; color: #333; margin-bottom: 5px; }
    .teacher-role { font-size: 14px; color: var(--primary-color); font-weight: 600; }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .section-content { padding: 40px 20px; }
        .sambutan-layout { grid-template-columns: 1fr; gap: 40px; }
        .headmaster-image { max-width: 300px; margin: 0 auto; }
        
        /* Teachers Mobile */
        .teacher-card { width: 100%; } /* Stack vertically */
    }
</style>

@include('partials.hero-section', [
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('views.beranda')],
        ['label' => 'Profil', 'url' => null],
        ['label' => 'Sambutan Kepala Sekolah', 'url' => null],
    ],
    'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Sambutan Kepala Sekolah'
])

<section class="section-content">
    <div class="sambutan-layout">
        <div class="headmaster-frame fade-in">
            <div class="headmaster-image">
                @if($sambutan->media->first())
                    <img src="{{ asset('storage/' . $sambutan->media->first()->file_path) }}" alt="Kepala Sekolah" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <i class="fas fa-user-tie"></i>
                @endif
            </div>
            <div class="headmaster-info">
                <div class="headmaster-name">{{ $sambutan->extras['nama_kepsek'] ?? 'Kepala Sekolah' }}</div>
                <div class="headmaster-title">NIP: {{ $sambutan->extras['nip'] ?? '-' }}</div>
            </div>
        </div>

        <div class="fade-in fade-in-delay-1">
            <i class="fas fa-quote-left quote-icon"></i>
            <h2 style="font-size: 32px; color: #1f2937; margin-bottom: 25px; line-height: 1.3;">
                {{ $sambutan->title }}
            </h2>
            
            <div class="sambutan-text">
                {!! $sambutan->content ?? 'Konten sambutan belum tersedia.' !!}
            </div>

            <div style="margin-top: 40px; border-top: 2px solid #eee; padding-top: 20px;">
                {{-- <img src="{{ asset('image/signature.png') }}" alt="Tanda Tangan" style="height: 60px; display: block; margin-bottom: 10px; opacity: 0.7;"> --}}
                <strong>Kepala Sekolah SMK MARHAS</strong>
            </div>
        </div>
    </div>
</section>
    
    <div style="margin-top: 80px;"></div>

    <section class="section-content">
        <div class="container fade-in">
            <h2 style="text-align: center; margin-bottom: 50px; color: #1f2937;">Dewan Guru & Staf <span class="text-primary">SMK MARHAS</span></h2>
            
            <div class="teachers-grid">
                <!-- Teacher 1 -->
                <div class="teacher-card">
                    <div class="teacher-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="teacher-info">
                        <div class="teacher-name">Nama Guru 1, S.Pd.</div>
                        <div class="teacher-role">Wakil Kepala Sekolah Kurikulum</div>
                    </div>
                </div>

                <!-- Teacher 2 -->
                <div class="teacher-card">
                    <div class="teacher-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="teacher-info">
                        <div class="teacher-name">Nama Guru 2, M.Kom.</div>
                        <div class="teacher-role">Kepala Program Keahlian</div>
                    </div>
                </div>

                <!-- Teacher 3 -->
                <div class="teacher-card">
                    <div class="teacher-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="teacher-info">
                        <div class="teacher-name">Nama Guru 3, S.T.</div>
                        <div class="teacher-role">Koordinator Kesiswaan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
</script>
@endpush