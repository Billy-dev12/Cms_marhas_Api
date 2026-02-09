<style>
    /* --- HERO & BREADCRUMB STYLES --- */
    .hero-wrapper { 
        position: relative; 
    }
    
    .hero-bg {
        background: url('{{ asset("image/hero-bg.jpg") }}') no-repeat center center;
        background-size: cover;
        height: 250px;
        width: 100%;
        background-color: var(--primary-color);
    }

    .mobile-hero {
        display: none;
        height: 141px;
        width: 100%;
        overflow: hidden;
    }

    .mobile-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- DESKTOP BREADCRUMB --- */
    .breadcrumb {
        background: white;
        border-radius: 16px;
        /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); */
        padding: 24px 32px;
        margin: -40px auto 40px;
        width: 90%;
        max-width: 1200px;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 10;
        gap: 20px;
    }

    .breadcrumb-item { 
        display: flex; 
        align-items: center; 
        gap: 8px; /* Adjusted gap */
        font-weight: 500; 
        color: #3c3c3c; 
        font-size: 14px; 
    }
    
    .breadcrumb-dot { 
        width: 10px; 
        height: 10px; 
        border-radius: 50%; 
        background: var(--primary-color); 
        flex-shrink: 0; 
        margin-right: 4px;
    }

    .breadcrumb-link {
        color: #3c3c3c;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb-link:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }
    
    .breadcrumb-title { 
        font-size: 16px; 
        font-weight: 600; 
        color: #3c3c3c; 
        flex: 1; 
    }

    .breadcrumb-title .highlight {
        color: var(--primary-color);
        font-weight: 700;
    }

    .breadcrumb-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        font-size: 14px;
        white-space: nowrap;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .breadcrumb-btn:hover {
        background: var(--hover-color);
        color: white;
    }

    /* --- MOBILE BREADCRUMB --- */
    .mobile-breadcrumb {
        display: none;
        background: white;
        border-radius: 16px;
        /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); */
        padding: 15px;
        margin: -20px 20px 20px;
        position: relative;
        z-index: 10;
    }

    .mobile-breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #3c3c3c;
        font-size: 14px;
        margin-bottom: 10px;
        flex-wrap: wrap; /* Allow wrapping on small screens */
    }

    .mobile-breadcrumb-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary-color);
        flex-shrink: 0;
        margin-right: 4px;
    }

    .mobile-breadcrumb-title {
        font-size: 16px;
        font-weight: 600;
        color: #3c3c3c;
        margin-bottom: 15px;
    }

    .mobile-breadcrumb-title .highlight {
        color: var(--primary-color);
        font-weight: 700;
    }

    .mobile-breadcrumb-btn {
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        font-size: 14px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }

    .mobile-breadcrumb-btn:hover {
        background: var(--hover-color);
        color: white;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .hero-wrapper, .hero-bg, .breadcrumb { 
            display: none; 
        }
        
        .mobile-hero, .mobile-breadcrumb { 
            display: block; 
        }
    }
</style>

<!-- Desktop Hero -->
<div class="hero-wrapper">
    <div class="hero-bg" @if(isset($heroImage)) style="background-image: url('{{ $heroImage }}')" @endif></div>
</div>

<!-- Mobile Hero -->
<div class="mobile-hero">
    <img src="{{ $heroImageMobile ?? asset('image/12.jpg') }}" alt="Hero Image">
</div>

<!-- Desktop Breadcrumb -->
<div class="breadcrumb fade-in">
    <div class="breadcrumb-item">
        <div class="breadcrumb-dot"></div>
        @foreach($breadcrumbs as $crumb)
            @if(!$loop->first) <span>/</span> @endif
            @if(!empty($crumb['url']))
                <a href="{{ $crumb['url'] }}" class="breadcrumb-link">{{ $crumb['label'] }}</a>
            @else
                <span>{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </div>
    <div class="breadcrumb-title">
        {!! $heading !!}
    </div>
    <a href="{{ route('bkk.registrasi') }}" class="breadcrumb-btn" style="text-decoration:none">
        Daftar SPMB
    </a>
</div>

<!-- Mobile Breadcrumb -->
<div class="mobile-breadcrumb fade-in">
    <div class="mobile-breadcrumb-item">
        <div class="mobile-breadcrumb-dot"></div>
        @foreach($breadcrumbs as $crumb)
            @if(!$loop->first) <span>/</span> @endif
            @if(!empty($crumb['url']))
                <a href="{{ $crumb['url'] }}" class="breadcrumb-link">{{ $crumb['label'] }}</a>
            @else
                <span>{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </div>
    <div class="mobile-breadcrumb-title">
        {!! $heading !!}
    </div>
    <a href="{{ route('bkk.registrasi') }}" class="mobile-breadcrumb-btn" style="text-decoration:none">
        <i class="fas fa-edit"></i> Daftar SPMB
    </a>
</div>
