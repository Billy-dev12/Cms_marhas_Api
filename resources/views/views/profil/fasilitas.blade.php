@extends('layouts.frontend')

@section('title', 'Detail Fasilitas - SMK MARHAS Margahayu')

@section('content')
<style>


    .fasilitas-detail-section {
        padding: 60px 64px;
        background: #fff;
    }

    .feature-item {
        display: flex;
        gap: 50px;
        margin-bottom: 80px;
        align-items: center;
    }

    .feature-item:nth-child(even) {
        flex-direction: row-reverse;
    }

    .feature-image {
        flex: 1;
        height: 350px;
        background: #f4f4f4;
        border-radius: 30px;
        overflow: hidden;
        /* box-shadow: 0 20px 40px rgba(0,0,0,0.1); */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-image i {
        font-size: 80px;
        color: var(--primary-color);
        opacity: 0.3;
    }

    .feature-content {
        flex: 1;
    }

    .feature-content h2 {
        font-size: 28px;
        color: #1f2937;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .feature-content h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary-color);
    }

    .feature-item:nth-child(even) .feature-content h2::after {
        left: auto;
        right: 0;
    }

    .feature-item:nth-child(even) .feature-content {
        text-align: right;
    }

    .spec-list {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .spec-list li {
        padding: 10px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #555;
    }

    .feature-item:nth-child(even) .spec-list li {
        flex-direction: row-reverse;
    }

    .spec-list i {
        color: var(--primary-color);
    }

    /* Mobile Responsive - Specific Layouts */
    @media (max-width: 900px) {
        .fasilitas-detail-section { padding: 40px 20px; }
        
        /* Lab Komputer (1st item) - Image Left, Text Right */
        .feature-item:nth-child(1) {
            flex-direction: row;
            gap: 20px;
        }
        .feature-item:nth-child(1) .feature-image {
            width: 45%;
            height: 200px;
        }
        .feature-item:nth-child(1) .feature-content {
            width: 55%;
            text-align: left;
        }
        .feature-item:nth-child(1) .feature-content h2::after {
            left: 0;
        }
        .feature-item:nth-child(1) .spec-list li {
            flex-direction: row;
        }
        
        /* Bengkel (2nd item) - Image Right, Text Left */
        .feature-item:nth-child(2) {
            flex-direction: row-reverse;
            gap: 20px;
        }
        .feature-item:nth-child(2) .feature-image {
            width: 45%;
            height: 200px;
        }
        .feature-item:nth-child(2) .feature-content {
            width: 55%;
            text-align: left;
        }
        .feature-item:nth-child(2) .feature-content h2::after {
            left: 0;
        }
        .feature-item:nth-child(2) .spec-list li {
            flex-direction: row;
        }
        
        /* Ruang Kelas (3rd item) - Image Left, Text Right */
        .feature-item:nth-child(3) {
            flex-direction: row;
            gap: 20px;
        }
        .feature-item:nth-child(3) .feature-image {
            width: 45%;
            height: 200px;
        }
        .feature-item:nth-child(3) .feature-content {
            width: 55%;
            text-align: left;
        }
        .feature-item:nth-child(3) .feature-content h2::after {
            left: 0;
        }
        .feature-item:nth-child(3) .spec-list li {
            flex-direction: row;
        }
    }

    .facilities-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 40px;
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

    /* Hover Overlay */
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
    .facility-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .facility-modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        max-width: 1200px;
        width: 100%;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        position: relative;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        background: white;
        border: none;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        z-index: 10;
        /* box-shadow: 0 2px 10px rgba(0,0,0,0.2); */
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: var(--primary-color);
        color: white;
        transform: rotate(90deg);
    }

    .modal-left {
        flex: 1;
        padding: 50px;
        overflow-y: auto;
    }

    .modal-left h3 {
        font-size: 32px;
        color: #1f2937;
        margin-bottom: 10px;
    }

    .modal-left .category {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 20px;
        display: block;
    }

    .modal-left .description {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }

    .modal-left .spec-list {
        margin-top: 20px;
    }

    .modal-right {
        flex: 1;
        background: #f8f8f8;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 50px;
        position: relative;
    }

    .carousel-container {
        width: 100%;
        height: 400px;
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        /* box-shadow: 0 10px 30px rgba(0,0,0,0.2); */
    }

    .carousel-slide {
        display: none;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        background: #e0e0e0;
    }

    .carousel-slide.active {
        display: flex;
    }

    .carousel-slide i {
        font-size: 80px;
        color: var(--primary-color);
        opacity: 0.3;
    }

    .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .carousel-nav:hover {
        background: var(--primary-color);
        color: white;
    }

    .carousel-prev {
        left: 10px;
    }

    .carousel-next {
        right: 10px;
    }

    .carousel-indicators {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #ccc;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .indicator.active {
        background: var(--primary-color);
        width: 30px;
        border-radius: 6px;
    }

    /* Responsive Modal */
    @media (max-width: 900px) {
        .modal-content {
            flex-direction: column;
            max-height: 95vh;
        }
        
        .modal-left, .modal-right {
            padding: 30px;
        }
        
        .carousel-container {
            height: 250px;
        }
    }

    /* Responsive Grid - 2 Columns on Mobile */
    @media (max-width: 900px) {
        .facilities-grid-4 { 
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .facility-box {
            padding: 25px 15px;
        }
        .facility-box i {
            font-size: 32px;
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
        ['label' => 'Fasilitas Detail', 'url' => null],
    ],
    'heading' => '<span class="highlight">SMK MARHAS Margahayu</span> Fasilitas Detail'
])

<section class="fasilitas-detail-section">
    @foreach($saranas->take(3) as $sarana)
    <div class="feature-item fade-in">
        <div class="feature-image">
            @if($sarana->media->first())
                <img src="{{ asset('storage/' . $sarana->media->first()->file_path) }}" style="width:100%; height:100%; object-fit:cover;">
            @else
                <i class="fas fa-building"></i>
            @endif
        </div>
        <div class="feature-content">
            <span class="text-primary" style="font-weight: 700; font-size: 14px;">{{ $sarana->extras['kategori'] ?? 'FASILITAS' }}</span>
            <h2>{{ $sarana->title }}</h2>
            <p>{{ Str::limit(strip_tags($sarana->content), 150) }}</p>
            <ul class="spec-list">
                @if(isset($sarana->extras['spesifikasi']) && is_array($sarana->extras['spesifikasi']))
                    @foreach(array_slice($sarana->extras['spesifikasi'], 0, 4) as $spec)
                        <li><i class="fas fa-check-circle"></i> {{ $spec }}</li>
                    @endforeach
                @elseif(isset($sarana->extras['inventaris']) && is_array($sarana->extras['inventaris']))
                    @foreach(array_slice($sarana->extras['inventaris'], 0, 4) as $item)
                        <li><i class="fas fa-check-circle"></i> {{ $item['nama_alat'] ?? '' }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    @endforeach
</section>

<section class="fasilitas-detail-section" style="background: #fcfcfc; padding-top: 0;">
    <div class="fade-in" style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-size: 28px; color: #1f2937;">Fasilitas <span class="text-primary">Pendukung Lainnya</span></h2>
        <div style="width: 50px; height: 3px; background: var(--primary-color); margin: 15px auto;"></div>
    </div>

    <div class="facilities-grid-4">
        @foreach($saranas->skip(3) as $sarana)
        <div class="facility-box fade-in" data-facility="{{ $sarana->id }}">
            @if($sarana->media->first())
                <img src="{{ asset('storage/' . $sarana->media->first()->file_path) }}" style="width: 50px; height: 50px; object-fit: cover; margin-bottom: 15px; border-radius: 10px;">
            @else
                <i class="fas fa-building"></i>
            @endif
            <h4>{{ $sarana->title }}</h4>
            <p>{{ Str::limit(strip_tags($sarana->content), 80) }}</p>
        </div>
        @endforeach
    </div>
</section>

<!-- Modal for Facility Details -->
<div class="facility-modal" id="facilityModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        
        <div class="modal-left">
            <span class="category" id="modalCategory">KATEGORI</span>
            <h3 id="modalTitle">Judul Fasilitas</h3>
            <div class="description" id="modalDescription">
                Deskripsi lengkap fasilitas akan muncul di sini.
            </div>
            <ul class="spec-list" id="modalSpecs">
                <!-- Specs will be populated by JavaScript -->
            </ul>
        </div>
        
        <div class="modal-right">
            <div class="carousel-container">
                <div class="carousel-slide active">
                    <i class="fas fa-image"></i>
                </div>
                <div class="carousel-slide">
                    <i class="fas fa-image"></i>
                </div>
                <div class="carousel-slide">
                    <i class="fas fa-image"></i>
                </div>
                <button class="carousel-nav carousel-prev" onclick="changeSlide(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-nav carousel-next" onclick="changeSlide(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="carousel-indicators">
                <div class="indicator active" onclick="goToSlide(0)"></div>
                <div class="indicator" onclick="goToSlide(1)"></div>
                <div class="indicator" onclick="goToSlide(2)"></div>
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

    // Facility Data
    // Facility Data
    const facilityData = {
        @foreach($saranas as $sarana)
        '{{ $sarana->id }}': {
            category: '{{ $sarana->extras['kategori'] ?? "FASILITAS" }}',
            title: {!! json_encode($sarana->title) !!},
            description: {!! json_encode($sarana->content) !!},
            specs: [
                @if(isset($sarana->extras['spesifikasi']) && is_array($sarana->extras['spesifikasi']))
                    @foreach($sarana->extras['spesifikasi'] as $spec)
                        '{{ $spec }}',
                    @endforeach
                @elseif(isset($sarana->extras['inventaris']) && is_array($sarana->extras['inventaris']))
                    @foreach($sarana->extras['inventaris'] as $item)
                        '{{ $item['nama_alat'] ?? "" }} ({{ $item['jumlah'] ?? "" }})',
                    @endforeach
                @endif
            ],
            gallery: [
                @foreach($sarana->media as $media)
                    '{{ asset("storage/" . $media->file_path) }}',
                @endforeach
            ]
        },
        @endforeach
    };

    // Current slide index
    let currentSlide = 0;

    // Open Modal
    function openModal(facilityId) {
        const data = facilityData[facilityId];
        if (!data) return;

        // Populate modal content
        document.getElementById('modalCategory').textContent = data.category;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDescription').innerHTML = data.description; // Use innerHTML

        // Populate specs
        const specsList = document.getElementById('modalSpecs');
        specsList.innerHTML = '';
        if (data.specs && data.specs.length > 0) {
            data.specs.forEach(spec => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="fas fa-check-circle"></i> ${spec}`;
                specsList.appendChild(li);
            });
        } else {
            specsList.innerHTML = '<li>Tidak ada spesifikasi detail.</li>';
        }

        // Populate Carousel
        const carouselContainer = document.querySelector('.carousel-container');
        // Remove existing slides but keep nav buttons if they are inside
        // Actually, the HTML structure has nav buttons inside .carousel-container
        // So we should only remove .carousel-slide elements
        const oldSlides = carouselContainer.querySelectorAll('.carousel-slide');
        oldSlides.forEach(slide => slide.remove());
        
        // Also update indicators
        const indicatorsContainer = document.querySelector('.carousel-indicators');
        indicatorsContainer.innerHTML = '';

        if (data.gallery && data.gallery.length > 0) {
            data.gallery.forEach((imgUrl, index) => {
                // Create Slide
                const slide = document.createElement('div');
                slide.className = `carousel-slide ${index === 0 ? 'active' : ''}`;
                slide.innerHTML = `<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover;">`;
                
                // Insert slide before the nav buttons (which are at the end of container in HTML? No, nav buttons are after slides)
                // Let's append to container and then make sure nav buttons are on top or re-appended?
                // The nav buttons are absolute positioned, so order in DOM matters for z-index if not specified, but they have z-index: 2.
                // So appending slides might cover them if z-index is issue, but slides are relative/absolute?
                // Slides are flex items in the container?
                // CSS: .carousel-slide { display: none; width: 100%; height: 100%; ... }
                // .carousel-container { position: relative; ... }
                // So slides take full space.
                // We should insert slides at the beginning of the container to be safe.
                carouselContainer.insertBefore(slide, carouselContainer.firstChild);

                // Create Indicator
                const indicator = document.createElement('div');
                indicator.className = `indicator ${index === 0 ? 'active' : ''}`;
                indicator.onclick = () => goToSlide(index);
                indicatorsContainer.appendChild(indicator);
            });
        } else {
            // Fallback if no images
            const slide = document.createElement('div');
            slide.className = 'carousel-slide active';
            slide.innerHTML = '<i class="fas fa-image"></i>';
            carouselContainer.insertBefore(slide, carouselContainer.firstChild);
        }

        // Reset carousel
        currentSlide = 0;
        // updateCarousel(); // No need to call this as we manually set active class

        // Show modal
        document.getElementById('facilityModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Close Modal
    function closeModal() {
        document.getElementById('facilityModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Change Slide
    function changeSlide(direction) {
        const slides = document.querySelectorAll('.carousel-slide');
        currentSlide += direction;
        
        if (currentSlide >= slides.length) currentSlide = 0;
        if (currentSlide < 0) currentSlide = slides.length - 1;
        
        updateCarousel();
    }

    // Go to Specific Slide
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }

    // Update Carousel
    function updateCarousel() {
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.indicator');
        
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentSlide);
        });
        
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }

    // Add click event to facility boxes
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.facility-box').forEach(box => {
            box.addEventListener('click', function() {
                const facilityId = this.getAttribute('data-facility');
                openModal(facilityId);
            });
        });

        // Close modal when clicking outside
        document.getElementById('facilityModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
@endpush