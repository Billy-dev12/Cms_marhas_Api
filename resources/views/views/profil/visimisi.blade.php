@extends('layouts.frontend')

@section('title', 'Visi & Misi - SMK MARHAS Margahayu')

@section('content')
    @include('partials.hero-section', [
        'breadcrumbs' => [
            ['label' => 'Beranda', 'url' => route('views.beranda')],
            ['label' => 'Profil', 'url' => null],
            ['label' => 'Visi & Misi', 'url' => null],
        ],
        'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Visi & Misi'
    ])

<style>
    /* --- VISI MISI CONTAINER --- */
    .visimisi-container {
        padding: 80px 64px;
        background: #fff;
    }

    .visimisi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* --- VISI SECTION --- */
    .visi-card {
        padding: 50px;
        background: var(--green-lightest);
        border-radius: 30px;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .visi-card h2 {
        font-size: 36px;
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 800;
    }

    .visi-text {
        font-size: 20px;
        line-height: 1.6;
        color: #1f2937;
        font-style: italic;
        font-weight: 500;
    }

    /* --- MISI SECTION --- */
    .misi-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .misi-card {
        background: white;
        padding: 30px;
        border-radius: 20px;
        transition: all 0.3s ease;
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .misi-card:hover {
        transform: translateX(10px);
    }

    .misi-number {
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 20px;
        flex-shrink: 0;
    }

    .misi-card h3 {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
        margin: 0;
        flex: 1;
    }

    .section-label {
        font-weight: 700;
        color: var(--primary-color);
        letter-spacing: 2px;
        font-size: 14px;
        margin-bottom: 10px;
        display: block;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .visimisi-container { 
            padding: 40px 20px; 
        }
        
        .visimisi-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .visi-card { 
            padding: 30px 20px; 
        }
        
        .visi-card h2 { 
            font-size: 28px; 
        }
        
        .visi-text { 
            font-size: 16px; 
        }
        
        .misi-card {
            padding: 20px;
            flex-direction: row; /* Fixed in previous step */
            align-items: flex-start;
            text-align: left;
        }
        
        .misi-card h3 {
            font-size: 14px;
        }
        
        .misi-number {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
    }
</style>

<section class="visimisi-container">
    <div class="visimisi-grid">
        <!-- VISI - Left Side -->
        <div class="visi-card fade-in">
            <span class="section-label">{{ $profil->extras['subtitle'] ?? 'OUR VISION' }}</span>
            <h2>VISI</h2>
            <div class="visi-text">
                {!! $profil->content ?? 'Visi belum tersedia.' !!}
            </div>
        </div>

        <!-- MISI - Right Side -->
        <div class="fade-in">
            <span class="section-label">OUR MISSION</span>
            <h2 style="font-size: 36px; color: var(--primary-color); margin-bottom: 20px; font-weight: 800;">MISI</h2>
            
            <div class="misi-container">
                @if(isset($profil->extras['points']) && is_array($profil->extras['points']))
                    @foreach($profil->extras['points'] as $index => $point)
                        <div class="misi-card">
                            <div class="misi-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3>{{ $point['text'] ?? '' }}</h3>
                        </div>
                    @endforeach
                @else
                    <p>Misi belum tersedia.</p>
                @endif
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