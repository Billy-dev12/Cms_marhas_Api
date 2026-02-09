@extends('layouts.frontend')

@section('title', 'Sarana & Prasarana - SMK MARHAS Margahayu')

@section('content')
<style>


    /* --- FACILITIES GRID (MATCHING FASILITAS.BLADE.PHP) --- */
    .facilities-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 50px;
    }

    .facility-box {
        background: #ffffff;
        border: 1px solid #eef2f3;
        padding: 30px 20px;
        border-radius: 15px;
        text-align: center;
        transition: all 0.3s ease;
        /* box-shadow: 0 4px 6px rgba(0,0,0,0.02); */
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    /* Hover Overlay - Slide up from bottom */
    .facility-box::before {
        content: 'Lihat Detail';
        position: absolute;
        bottom: -50px; /* Hidden below */
        left: 0;
        right: 0;
        height: 50px; /* Fixed height for the bar */
        background: rgba(21, 128, 61, 0.95);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        transition: bottom 0.3s ease;
        z-index: 1;
    }

    .facility-box:hover::before {
        bottom: 0; /* Slide up */
    }

    .facility-box:hover {
        transform: translateY(-10px);
        /* box-shadow: 0 10px 20px rgba(21, 128, 61, 0.3); */
    }

    .facility-box i {
        font-size: 35px;
        color: var(--primary-color);
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .facility-box h4 {
        font-size: 16px;
        color: #333;
        font-weight: 700;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .facility-box p {
        font-size: 13px;
        color: #777;
        line-height: 1.5;
        transition: all 0.3s ease;
    }

    /* Modal Styles */
    .sarana-modal {
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

    .sarana-modal.active {
        display: flex;
    }

    .modal-content-sarana {
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

    .modal-close-sarana {
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

    .modal-close-sarana:hover {
        background: var(--primary-color);
        color: white;
        transform: rotate(90deg);
    }

    .modal-header-sarana {
        background: linear-gradient(135deg, var(--primary-color), #16a34a);
        padding: 50px 40px 40px;
        text-align: center;
        color: white;
        border-radius: 25px 25px 0 0;
    }

    .modal-header-sarana .sarana-icon-large {
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

    .modal-header-sarana h2 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .modal-body-sarana {
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
        .modal-content-sarana {
            max-height: 95vh;
        }
        
        .modal-header-sarana {
            padding: 40px 25px 30px;
        }
        
        .modal-header-sarana .sarana-icon-large {
            width: 80px;
            height: 80px;
            font-size: 35px;
        }
        
        .modal-header-sarana h2 {
            font-size: 24px;
        }
        
        .modal-body-sarana {
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

    .sarana-card i {
        font-size: 50px;
        color: white;
        margin-bottom: 20px;
        display: block;
    }

    .sarana-card h3 {
        font-size: 18px;
        color: white;
        margin: 0;
        font-weight: 700;
    }

    /* Hide description on all screens */
    .sarana-card p {
        display: none;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {

        
        .sarana-section { 
            padding: 40px 20px; 
        }
        
        .facilities-grid-4 { 
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .facility-box {
            padding: 25px 15px;
        }
        .facility-box i {
            font-size: 32px;
            margin-bottom: 10px;
        }
        .facility-box h4 {
            font-size: 14px;
            margin-bottom: 0;
        }
        .facility-box p {
            display: none;
        }
    }
</style>

@include('partials.hero-section', [
    'breadcrumbs' => [
        ['label' => 'Beranda', 'url' => route('views.beranda')],
        ['label' => 'Profil', 'url' => null],
        ['label' => 'Sarana & Prasarana', 'url' => null],
    ],
    'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Sarana & Prasarana'
])

<section class="sarana-section">
    <div class="fade-in" style="text-align: center; max-width: 800px; margin: 0 auto 50px;">
        <span class="section-badge">FASILITAS SEKOLAH</span>
        <h2 style="font-size: 32px; color: #1f2937; margin-top: 10px;">Fasilitas Sarana & Prasarana</h2>
        <p style="color: #666; margin-top: 15px;">SMK MARHAS menyediakan berbagai fasilitas lengkap untuk menunjang kegiatan belajar mengajar dan pengembangan diri siswa.</p>
    </div>

    <div class="facilities-grid-4">
        @foreach($saranas as $sarana)
        <div class="facility-box fade-in" data-sarana="{{ $sarana->id }}">
            @if($sarana->media->first())
                <img src="{{ asset('storage/' . $sarana->media->first()->file_path) }}" alt="{{ $sarana->title }}" style="width: 50px; height: 50px; object-fit: cover; margin-bottom: 15px; border-radius: 10px;">
            @else
                <i class="fas fa-building"></i>
            @endif
            <h4>{{ $sarana->title }}</h4>
            <div style="font-size: 13px; color: #777; line-height: 1.5; height: 60px; overflow: hidden;">
                {!! Str::limit(strip_tags($sarana->content), 100) !!}
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Modal for Sarana Details -->
<div class="sarana-modal" id="saranaModal">
    <div class="modal-content-sarana">
        <button class="modal-close-sarana" onclick="closeSaranaModal()">&times;</button>
        
        <div class="modal-header-sarana">
            <div class="sarana-icon-large" id="modalIconLarge">
                <!-- Icon/Image will be set here -->
            </div>
            <h2 id="modalTitle">Nama Fasilitas</h2>
        </div>
        
        <div class="modal-body-sarana">
            <!-- Deskripsi -->
            <div class="modal-section">
                <h3><i class="fas fa-info-circle"></i> Tentang</h3>
                <div id="modalDeskripsi" style="font-size: 16px; line-height: 1.8; color: #555; text-align: justify;"></div>
            </div>

            <!-- Spesifikasi -->
            <div class="modal-section">
                <h3><i class="fas fa-list-check"></i> Spesifikasi & Inventaris</h3>
                <ul class="info-list" id="modalSpecs">
                    <!-- Will be populated by JavaScript -->
                </ul>
            </div>

            <!-- Kontak -->
            <div class="modal-section">
                <h3><i class="fas fa-phone-alt"></i> Informasi Tambahan</h3>
                <div class="social-links" id="modalKontak">
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

    // Sarana Data generated from PHP
    const saranaData = {
        @foreach($saranas as $sarana)
        '{{ $sarana->id }}': {
            nama: {!! json_encode($sarana->title) !!},
            image: '{{ $sarana->media->first() ? asset("storage/" . $sarana->media->first()->file_path) : "" }}',
            deskripsi: {!! json_encode($sarana->content) !!},
            spesifikasi: [
                @if(isset($sarana->extras['luas'])) 'Luas: {{ $sarana->extras['luas'] }} m²', @endif
                @if(isset($sarana->extras['kategori'])) 'Kategori: {{ $sarana->extras['kategori'] }}', @endif
                @if(isset($sarana->extras['inventaris']) && is_array($sarana->extras['inventaris']))
                    @foreach($sarana->extras['inventaris'] as $item)
                        '{{ $item['nama_alat'] ?? "" }}: {{ $item['jumlah'] ?? "" }} unit ({{ $item['kondisi'] ?? "" }})',
                    @endforeach
                @endif
            ],
            gallery: [
                @foreach($sarana->media as $media)
                    '{{ asset("storage/" . $media->file_path) }}',
                @endforeach
            ],
            kontak: {
                // Add contact info if available in extras, otherwise generic
            }
        },
        @endforeach
    };

    // Open Modal
    function openSaranaModal(saranaId) {
        const data = saranaData[saranaId];
        if (!data) return;

        // Set header (Dynamic Title)
        const iconContainer = document.getElementById('modalIconLarge');
        if (data.image) {
            iconContainer.innerHTML = `<img src="${data.image}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">`;
        } else {
            iconContainer.innerHTML = `<i class="fas fa-building"></i>`;
        }
        document.getElementById('modalTitle').textContent = data.nama;
        
        // GENERIC CONTENT (Lorem Ipsum) -> REMOVED, using data.deskripsi
        // Set deskripsi
        document.getElementById('modalDeskripsi').innerHTML = data.deskripsi;

        // Set spesifikasi list
        const specsList = document.getElementById('modalSpecs');
        specsList.innerHTML = '';
        
        if (data.spesifikasi && data.spesifikasi.length > 0) {
            data.spesifikasi.forEach(spec => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="fas fa-check-circle"></i> ${spec}`;
                specsList.appendChild(li);
            });
        } else {
             specsList.innerHTML = '<li>Tidak ada data spesifikasi.</li>';
        }

        // Set kontak (Generic)
        const kontakContainer = document.getElementById('modalKontak');
        kontakContainer.innerHTML = '';
        // Using generic contact info or keeping specific if available? 
        // Request said "satu saja untuk semua", implied fully generic content.
        kontakContainer.innerHTML += `<a href="#" class="social-link"><i class="fas fa-envelope"></i> email@loremipsum.com</a>`;
        kontakContainer.innerHTML += `<a href="#" class="social-link"><i class="fas fa-phone"></i> +62 123 4567 890</a>`;


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
        document.getElementById('saranaModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Modal
    function closeSaranaModal() {
        document.getElementById('saranaModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Add click event to sarana cards
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.facility-box').forEach(card => {
            card.addEventListener('click', function() {
                const saranaId = this.getAttribute('data-sarana');
                openSaranaModal(saranaId);
            });
        });

        // Close modal when clicking outside
        document.getElementById('saranaModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSaranaModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSaranaModal();
            }
        });
    });
</script>
@endpush