    <header class="top-bar">
      <div class="top-info">
        <span style="font-weight: 700;">SMK MARHAS MARGAHAYU</span>
        <span>Kab. Bandung, Jawa Barat</span>
        <span><i class="fas fa-envelope"></i> adm.smkmarhas@gmail.com</span>
      </div>
      <div class="top-social">
        <span style="font-weight: 600;">Ikuti Kami:</span>
        <div class="social-circles">
          <a href="https://www.instagram.com/marhasupdate/" class="social-circle" title="Instagram" target="_blank"
            rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
          <a href="https://web.facebook.com/marhas.bisa.9" class="social-circle" title="Facebook" target="_blank"
            rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.youtube.com/channel/UCrakEarZdrp7AVg2sfEMSvQ" class="social-circle" title="YouTube"
            target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube"></i></a>
          <a href="https://www.tiktok.com/@marhasupdate" class="social-circle" title="TikTok" target="_blank"
            rel="noopener noreferrer"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </header>

    <!-- MOBILE TOP BAR -->
    <div class="mobile-top-bar">
      <div class="mobile-help">
        <i class="fas fa-question-circle"></i>
        <span>Butuh Bantuan?</span>
      </div>
      <div class="mobile-contact">
        <i class="fas fa-phone"></i>
        <span>(022) 5410926</span>
      </div>
    </div>

    <nav class="navbar">
      <div class="logo">
        <img src="{{ asset('image/logo.png') }}" alt="Logo SMK MARHAS">
      </div>
      <div class="nav-links">
        <a href="{{ route('views.beranda') }}" class="nav-item">Beranda</a>
        <div class="dropdown">
          <span class="nav-item">Profil <i class="fas fa-chevron-down" style="font-size: 12px;"></i></span>
          <div class="dropdown-menu">
            <a href="{{ route('views.profil_sekolah') }}" class="dropdown-item">Profil Sekolah</a>
            <a href="{{ route('views.sambutan') }}" class="dropdown-item">Sambutan Kepala Sekolah</a>
            <a href="{{ route('views.struktur') }}" class="dropdown-item">Struktur Organisasi</a>
            <a href="{{ route('views.sarana') }}" class="dropdown-item">Sarana & Prasarana</a>
            <a href="{{ route('views.visimisi') }}" class="dropdown-item">Visi Misi</a>
            <a href="{{ route('views.fasilitas') }}" class="dropdown-item">Fasilitas</a>
            <a href="{{ route('views.ekstra') }}" class="dropdown-item">Ekstrakurikuler</a>
          </div>
        </div>
        <div class="dropdown">
          <span class="nav-item">Kejuruan <i class="fas fa-chevron-down" style="font-size: 12px;"></i></span>
          <div class="dropdown-menu">
            <a href="{{ route('views.mesin') }}" class="dropdown-item">Teknik Pemesinan</a>
            <a href="{{ route('views.pplg') }}" class="dropdown-item">Teknik Informatika</a>
          </div>
        </div>
        <div class="dropdown">
          <span class="nav-item">Akademik <i class="fas fa-chevron-down" style="font-size: 12px;"></i></span>
          <div class="dropdown-menu">
            <a href="{{ route('views.kurikulum') }}" class="dropdown-item">Kurikulum</a>
            <a href="{{ route('views.kalender') }}" class="dropdown-item">Kalender Akademik</a>
            <a href="{{ route('views.prestasi') }}" class="dropdown-item">Prestasi</a>
          </div>
        </div>
        <a href="{{ route('views.berita') }}" class="nav-item">Berita</a>
        <a href="{{ route('views.galeri') }}" class="nav-item">Galeri</a>
        <div class="dropdown">
          <span class="nav-item">BKK <i class="fas fa-chevron-down" style="font-size: 12px;"></i></span>
          <div class="dropdown-menu">
            <a href="{{ route('bkk.registrasi') }}" class="dropdown-item">Registrasi Alumni</a>
            <a href="{{ route('bkk.lowongan') }}" class="dropdown-item">Informasi Lowongan Kerja</a>
          </div>
        </div>
        <a href="https://spmb.smkmarhas.sch.id" class="nav-item highlight">SPMB</a>
        <a href="{{ route('views.kontak') }}" class="nav-item">Kontak</a>
      </div>
      <div class="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
      </div>
    </nav>

    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu">
      <div class="mobile-menu-header">
        <div style="font-weight: 700; color: var(--primary-color);">MENU UTAMA</div>
        <div class="mobile-menu-close">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="mobile-nav-links">
        <a href="{{ route('views.beranda') }}" class="mobile-nav-item">Beranda</a>

        <div class="mobile-dropdown mobile-nav-item">
          <div class="mobile-dropdown-toggle">
            <span>Profil</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="mobile-dropdown-menu">
            <a href="{{ route('views.profil_sekolah') }}" class="mobile-dropdown-item">Profil Sekolah</a>
            <a href="{{ route('views.sambutan') }}" class="mobile-dropdown-item">Sambutan Kepala Sekolah</a>
            <a href="{{ route('views.struktur') }}" class="mobile-dropdown-item">Struktur Organisasi</a>
            <a href="{{ route('views.sarana') }}" class="mobile-dropdown-item">Sarana & Prasarana</a>
            <a href="{{ route('views.visimisi') }}" class="mobile-dropdown-item">Visi Misi</a>
            <a href="{{ route('views.fasilitas') }}" class="mobile-dropdown-item">Fasilitas</a>
            <a href="{{ route('views.ekstra') }}" class="mobile-dropdown-item">Ekstrakurikuler</a>
          </div>
        </div>

        <div class="mobile-dropdown mobile-nav-item">
          <div class="mobile-dropdown-toggle">
            <span>Kejuruan</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="mobile-dropdown-menu">
            <a href="{{ route('views.mesin') }}" class="mobile-dropdown-item">Teknik Pemesinan</a>
            <a href="{{ route('views.pplg') }}" class="mobile-dropdown-item">Rekayasa Perangkat Lunak</a>
          </div>
        </div>

        <div class="mobile-dropdown mobile-nav-item">
          <div class="mobile-dropdown-toggle">
            <span>Akademik</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="mobile-dropdown-menu">
            <a href="{{ route('views.kurikulum') }}" class="mobile-dropdown-item">Kurikulum</a>
            <a href="{{ route('views.kalender') }}" class="mobile-dropdown-item">Kalender Akademik</a>
            <a href="{{ route('views.prestasi') }}" class="mobile-dropdown-item">Prestasi</a>
          </div>
        </div>

        <a href="{{ route('views.berita') }}" class="mobile-nav-item">Berita</a>
        <a href="{{ route('views.galeri') }}" class="mobile-nav-item">Galeri</a>

        <div class="mobile-dropdown mobile-nav-item">
          <div class="mobile-dropdown-toggle">
            <span>Bursa Kerja Khusus</span>
            <i class="fas fa-chevron-down"></i>
          </div>
          <div class="mobile-dropdown-menu">
            <a href="{{ route('bkk.registrasi') }}" class="mobile-dropdown-item">Registrasi Alumni</a>
            <a href="{{ route('bkk.lowongan') }}" class="mobile-dropdown-item">Informasi Lowongan Kerja</a>
          </div>
        </div>

        <a href="https://spmb.smkmarhas.sch.id" class="mobile-nav-item highlight" style="color: var(--primary-color);">SPMB</a>
        <a href="{{ route('views.kontak') }}" class="mobile-nav-item">Kontak</a>
      </div>
    </div>