@extends('layouts.frontend')

@section('title', 'Struktur Organisasi - SMK MARHAS Margahayu')

@section('content')
<style>
    /* --- STRUCTURE ORGANIZATIONAL CHART --- */
    .structure-section {
        padding: 80px 64px;
        background: #fff;
        text-align: center;
    }

    .org-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 40px;
        margin-top: 50px;
    }

    /* Level 1: Kepala Sekolah */
    .org-card-primary {
        background: var(--primary-color);
        color: white;
        padding: 25px 40px;
        border-radius: 20px;
        /* box-shadow: 0 10px 20px rgba(0,0,0,0.1); */
        width: 100%;
        max-width: 400px;
    }

    /* Level 2: Komite / Kasubag */
    .org-row-secondary {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        width: 100%;
        max-width: 800px;
    }

    /* Level 3: Wakasek */
    .org-row-tertiary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        width: 100%;
        max-width: 1100px;
    }

    .org-card {
        background: white;
        border: 1px solid #e5e7eb;
        padding: 20px;
        border-radius: 15px;
        /* box-shadow: 0 4px 10px rgba(0,0,0,0.05); */
        transition: 0.3s;
    }

    .org-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary-color);
    }

    .role-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--primary-color);
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }

    .staff-name {
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    /* Connector Line (Simple version) */
    .line {
        width: 2px;
        height: 40px;
        background: #ddd;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .org-row-secondary, .org-row-tertiary {
            grid-template-columns: 1fr;
        }
        .structure-section { padding: 40px 20px; }
    }
</style>

@include('partials.hero-section', [
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('views.beranda')],
        ['label' => 'Profil', 'url' => null],
        ['label' => 'Struktur Organisasi', 'url' => null],
    ],
    'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Struktur Organisasi'
])

<section class="structure-section">
    <div class="fade-in">
        <span style="font-weight: 700; color: var(--primary-color); letter-spacing: 2px;">MANAGEMENT</span>
        <h2 style="font-size: 32px; color: #1f2937; margin-top: 10px;">{{ $struktur->title ?? 'Struktur Organisasi' }}</h2>
        <div style="color: #666; margin-top: 10px;">{!! $struktur->content ?? 'Konten belum tersedia.' !!}</div>
    </div>

    <div style="margin-top: 50px; text-align: center;">
        @if($struktur && $struktur->media->first())
            <img src="{{ asset('storage/' . $struktur->media->first()->file_path) }}" 
                 alt="Struktur Organisasi" 
                 style="width: 100%; max-width: 1000px; height: auto; display: block; margin: 0 auto;">
        @else
            <p>Belum ada bagan struktur yang diunggah.</p>
        @endif
    </div>
</section>
@endsection