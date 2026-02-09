@extends('layouts.frontend')

@section('title', 'Ekstrakurikuler - SMK MARHAS Margahayu')

@section('content')
<style>


    /* --- EKSTRAKULIKULER GRID --- */
    .ekstra-section {
        padding: 80px 64px;
        background: #fff;
    }

    .ekstra-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 50px;
    }

    .ekstra-card {
        background: #fff;
        border-radius: 20px;
        padding: 35px 25px;
        text-align: center;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        /* box-shadow: 0 5px 15px rgba(0,0,0,0.02); */
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    /* Hover Overlay - Slide from Bottom */
    .ekstra-card::after {
        content: 'Lihat Detail';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 0;
        background: rgba(21, 128, 61, 0.95);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        transition: height 0.3s ease;
        z-index: 2;
    }

    .ekstra-card:hover::after {
        height: 100%;
    }

    .ekstra-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary-color);
        /* box-shadow: 0 15px 30px rgba(21, 128, 61, 0.1); */
    }

    /* Modal Styles */
    .ekstra-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
    }

    .ekstra-modal.active {
        display: flex;
    }

    .modal-content-ekstra {
        background: white;
        border-radius: 25px;
        max-width: 900px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-close-ekstra {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        background: white;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        z-index: 10;
        /* box-shadow: 0 4px 15px rgba(0,0,0,0.2); */
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-close-ekstra:hover {
        background: var(--primary-color);
        color: white;
        transform: rotate(90deg);
    }

    .modal-header-ekstra {
        background: linear-gradient(135deg, var(--primary-color), #16a34a);
        padding: 50px 40px 40px;
        text-align: center;
        color: white;
        border-radius: 25px 25px 0 0;
    }

    .modal-header-ekstra .ekstra-icon-large {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 45px;
        color: white;
    }

    .modal-header-ekstra h2 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .modal-header-ekstra .tag-kategori {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }

    .modal-body-ekstra {
        padding: 40px;
    }

    .modal-section {
        margin-bottom: 35px;
    }

    .modal-section h3 {
        font-size: 22px;
        color: #1f2937;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-section h3 i {
        color: var(--primary-color);
    }

    .modal-section p {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        text-align: justify;
    }

    .social-links {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 20px;
        background: #f3f4f6;
        border-radius: 12px;
        text-decoration: none;
        color: #1f2937;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px);
    }

    .social-link i {
        font-size: 20px;
    }

    .photo-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .photo-item {
        aspect-ratio: 1;
        background: #f0f0f0;
        border-radius: 15px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 40px;
    }

    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .info-list {
        list-style: none;
        padding: 0;
    }

    .info-list li {
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #555;
    }

    .info-list li i {
        color: var(--primary-color);
        width: 20px;
    }

    /* Responsive Modal */
    @media (max-width: 900px) {
        .modal-content-ekstra {
            max-height: 95vh;
        }
        
        .modal-header-ekstra {
            padding: 40px 25px 30px;
        }
        
        .modal-header-ekstra .ekstra-icon-large {
            width: 80px;
            height: 80px;
            font-size: 35px;
        }
        
        .modal-header-ekstra h2 {
            font-size: 24px;
        }
        
        .modal-body-ekstra {
            padding: 25px;
        }
        
        .photo-gallery {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        
        .social-links {
            flex-direction: column;
        }
        
        .social-link {
            width: 100%;
            justify-content: center;
        }
    }

    .ekstra-icon {
        width: 80px;
        height: 80px;
        background: var(--green-lightest);
        color: var(--primary-color);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 30px;
        transition: 0.3s;
    }

    .ekstra-card:hover .ekstra-icon {
        background: var(--primary-color);
        color: #fff;
    }

    .ekstra-card h3 {
        font-size: 19px;
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .ekstra-card p {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.6;
        display: none;
    }

    .tag-kategori {
        display: inline-block;
        padding: 4px 12px;
        background: #f3f4f6;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        color: #4b5563;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {

        
        .ekstra-section { 
            padding: 40px 20px; 
        }
        
        .ekstra-grid { 
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .ekstra-card {
            padding: 25px 15px;
        }
        
        .ekstra-icon {
            width: 70px;
            height: 70px;
            font-size: 28px;
        }
        
        .ekstra-card h3 {
            font-size: 15px;
            margin-bottom: 0;
        }
        
        .ekstra-card p {
            display: none;
        }
        
        .tag-kategori {
            font-size: 9px;
            padding: 3px 8px;
        }
    }
</style>

@include('partials.hero-section', [
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('views.beranda')],
        ['label' => 'Profil', 'url' => null],
        ['label' => 'Ekstrakurikuler', 'url' => null],
    ],
    'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Ekstrakurikuler'
])

<section class="ekstra-section">
    <div class="fade-in" style="text-align: center; max-width: 700px; margin: 0 auto;">
        <span class="section-badge">PENGEMBANGAN DIRI</span>
        <h2 style="font-size: 32px; color: #1f2937; margin-top: 10px;">EKSTRAKURIKULER</h2>
        <p style="color: #666; margin-top: 15px;">Wadah bagi siswa untuk mengeksplorasi bakat, mengasah kepemimpinan, dan meraih prestasi di luar bidang akademik.</p>
    </div>

    <div class="ekstra-grid">
        @foreach($ekstrakurikulers as $ekstra)
        <div class="ekstra-card fade-in" data-ekstra="{{ $ekstra->id }}">
            <span class="tag-kategori">{{ $ekstra->extras['kategori'] ?? 'Umum' }}</span>
            <div class="ekstra-icon">
                @if($ekstra->media->first())
                    <img src="{{ asset('storage/' . $ekstra->media->first()->file_path) }}" alt="{{ $ekstra->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 15px;">
                @else
                    <i class="fas fa-users"></i>
                @endif
            </div>
            <h3>{{ $ekstra->title }}</h3>
            <p>{{ Str::limit(strip_tags($ekstra->content), 100) }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Modal for Ekstrakurikuler Details -->
<div class="ekstra-modal" id="ekstraModal">
    <div class="modal-content-ekstra">
        <button class="modal-close-ekstra" onclick="closeEkstraModal()">&times;</button>
        
        <div class="modal-header-ekstra">
            <div class="ekstra-icon-large" id="modalIconLarge">
                <i class="fas fa-users"></i>
            </div>
            <span class="tag-kategori" id="modalKategori">Kategori</span>
            <h2 id="modalTitle">Nama Ekstrakurikuler</h2>
        </div>
        
        <div class="modal-body-ekstra">
            <!-- Deskripsi -->
            <div class="modal-section">
                <h3><i class="fas fa-info-circle"></i> Tentang</h3>
                <p id="modalDeskripsi">Deskripsi lengkap ekstrakurikuler akan muncul di sini.</p>
            </div>

            <!-- Informasi -->
            <div class="modal-section">
                <h3><i class="fas fa-calendar-alt"></i> Informasi</h3>
                <ul class="info-list" id="modalInfo">
                    <!-- Will be populated by JavaScript -->
                </ul>
            </div>

            <!-- Social Media -->
            <div class="modal-section">
                <h3><i class="fas fa-share-alt"></i> Sosial Media</h3>
                <div class="social-links" id="modalSocial">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>

            <!-- Galeri Foto -->
            <div class="modal-section">
                <h3><i class="fas fa-images"></i> Galeri Foto</h3>
                <div class="photo-gallery" id="modalGallery">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Intersection Observer for fade-in animations
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

    // Ekstrakurikuler Data
    // Ekstrakurikuler Data
    const ekstraData = {
        @foreach($ekstrakurikulers as $ekstra)
        '{{ $ekstra->id }}': {
            kategori: '{{ $ekstra->extras['kategori'] ?? "Umum" }}',
            nama: {!! json_encode($ekstra->title) !!},
            icon: '{{ $ekstra->media->first() ? asset("storage/" . $ekstra->media->first()->file_path) : "fas fa-users" }}',
            is_image: {{ $ekstra->media->first() ? 'true' : 'false' }},
            deskripsi: {!! json_encode($ekstra->content) !!},
            jadwal: '{{ $ekstra->extras['jadwal'] ?? "-" }}',
            pembina: '{{ $ekstra->extras['pembina'] ?? "-" }}',
            tempat: '{{ $ekstra->extras['tempat'] ?? "-" }}',
            peserta: '{{ $ekstra->extras['peserta'] ?? "-" }}',
            sosmed: {
                instagram: '{{ $ekstra->extras['instagram'] ?? "" }}',
                youtube: '{{ $ekstra->extras['youtube'] ?? "" }}',
                tiktok: '{{ $ekstra->extras['tiktok'] ?? "" }}',
                email: '{{ $ekstra->extras['email'] ?? "" }}'
            },
            gallery: [
                @foreach($ekstra->media as $media)
                    '{{ asset("storage/" . $media->file_path) }}',
                @endforeach
            ]
        },
        @endforeach
    };

    // Open Modal
    function openEkstraModal(ekstraId) {
        const data = ekstraData[ekstraId];
        if (!data) return;

        // Set header
        const iconContainer = document.getElementById('modalIconLarge');
        if (data.is_image) {
            iconContainer.innerHTML = `<img src="${data.icon}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">`;
        } else {
            iconContainer.innerHTML = `<i class="${data.icon}"></i>`;
        }
        
        document.getElementById('modalKategori').textContent = data.kategori;
        document.getElementById('modalTitle').textContent = data.nama;
        
        // Set deskripsi
        document.getElementById('modalDeskripsi').innerHTML = data.deskripsi; // Use innerHTML for HTML content

        // Set info list
        const infoList = document.getElementById('modalInfo');
        infoList.innerHTML = `
            <li><i class="fas fa-clock"></i> <strong>Jadwal:</strong> ${data.jadwal}</li>
            <li><i class="fas fa-user-tie"></i> <strong>Pembina:</strong> ${data.pembina}</li>
            <li><i class="fas fa-map-marker-alt"></i> <strong>Tempat:</strong> ${data.tempat}</li>
            <li><i class="fas fa-users"></i> <strong>Peserta:</strong> ${data.peserta}</li>
        `;

        // Set social media
        const socialContainer = document.getElementById('modalSocial');
        socialContainer.innerHTML = '';
        if (data.sosmed.instagram) {
            socialContainer.innerHTML += `<a href="${data.sosmed.instagram}" target="_blank" class="social-link"><i class="fab fa-instagram"></i> Instagram</a>`;
        }
        if (data.sosmed.youtube) {
            socialContainer.innerHTML += `<a href="${data.sosmed.youtube}" target="_blank" class="social-link"><i class="fab fa-youtube"></i> YouTube</a>`;
        }
        if (data.sosmed.tiktok) {
            socialContainer.innerHTML += `<a href="${data.sosmed.tiktok}" target="_blank" class="social-link"><i class="fab fa-tiktok"></i> TikTok</a>`;
        }
        if (data.sosmed.email) {
            socialContainer.innerHTML += `<a href="${data.sosmed.email}" class="social-link"><i class="fas fa-envelope"></i> Email</a>`;
        }

        // Set photo gallery
        const gallery = document.getElementById('modalGallery');
        if (gallery) {
            gallery.innerHTML = '';
            if (data.gallery && data.gallery.length > 0) {
                data.gallery.forEach(imgUrl => {
                    gallery.innerHTML += `<div class="photo-item"><img src="${imgUrl}" alt="Gallery Image"></div>`;
                });
            } else {
                gallery.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #777;">Tidak ada foto tambahan.</p>';
            }
        }

        // Show modal
        document.getElementById('ekstraModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Modal
    function closeEkstraModal() {
        document.getElementById('ekstraModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Add click event to ekstra cards
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.ekstra-card').forEach(card => {
            card.addEventListener('click', function() {
                const ekstraId = this.getAttribute('data-ekstra');
                openEkstraModal(ekstraId);
            });
        });

        // Close modal when clicking outside
        document.getElementById('ekstraModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEkstraModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEkstraModal();
            }
        });
    });
</script>
@endpush