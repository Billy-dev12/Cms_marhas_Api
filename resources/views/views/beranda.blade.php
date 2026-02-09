@extends('layouts.frontend')

@section('content')

  <style>
    /* --- RESET & GLOBAL --- */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: white;
      color: #3c3c3c;
      overflow-x: hidden;
    }

    :root {
      /* Mengganti Warna Merah LPK menjadi Hijau Sekolah */
      --primary-color: #15803d;
      /* Hijau Tua Formal */
      --hover-color: #14532d;
      /* Hijau Lebih Tua */
      --accent-yellow: #facc15;
      /* Kuning untuk Highlight */
      --light-gray: #f6f6f6;
      --text-gray: #767676;
      --footer-dark: #1E1E1E;
      --footer-darker: #111111;
      /* Variasi warna hijau untuk kotak gambar */
      --green-light: #4ade80;
      --green-medium: #22c55e;
      --green-dark: #15803d;
      --green-darker: #14532d;
      --green-lightest: #dcfce7;
    }

    .container {
      max-width: 1440px;
      margin: 0 auto;
      background: white;
      position: relative;
    }

    /* --- COMPONENTS --- */
    .btn-primary {
      background: var(--primary-color);
      color: white;
      font-weight: 600;
      font-size: 14px;
      border: none;
      border-radius: 7px;
      cursor: pointer;
      padding: 12px 24px;
      transition: all 0.3s ease;
      display: inline-block;
      text-align: center;
      text-decoration: none;
    }

    .btn-primary:hover {
      background: var(--hover-color);
      transform: translateY(-2px);
      /* box-shadow: 0 4px 8px rgba(21, 128, 61, 0.3); */
    }

    .btn-secondary {
      background: #ffffff;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      font-weight: 600;
      font-size: 14px;
      border-radius: 7px;
      cursor: pointer;
      padding: 10px 22px;
      transition: all 0.3s ease;
      display: inline-block;
      text-align: center;
      text-decoration: none;
    }

    .btn-secondary:hover {
      background: var(--primary-color);
      color: white;
    }

    .top-bar {
      background: var(--light-gray);
      padding: 10px 64px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      border-bottom: none;
      position: relative;
      z-index: 1001;
      /* Higher than navbar if we want it to stay on top if we reverse scroll, but mostly irrelevant if it scrolls away. Actually if navbar is sticky top 0, it will cover top bar content if top bar was fixed? No, top bar is static. */
    }

    .top-info {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .top-info span {
      position: relative;
      padding-right: 20px;
    }

    .top-info span:not(:last-child)::after {
      content: "";
      position: absolute;
      right: 0;
      top: -2px;
      height: 20px;
      width: 1px;
      background: #ccc;
    }

    .top-social {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .social-circles {
      display: flex;
      gap: 12px;
    }

    .social-circle {
      width: 32px;
      height: 32px;
      background: var(--primary-color);
      border-radius: 50%;
      cursor: pointer;
      transition: transform 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
      text-decoration: none;
    }

    .social-circle:hover {
      transform: scale(1.15);
      background: var(--hover-color);
    }

    /* --- NAVBAR --- */
    .navbar {
      padding: 15px 64px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      /* box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); */
      transition: all 0.3s ease;
    }

    .logo img {
      height: 60px;
      /* Diperbesar sedikit untuk logo sekolah */
      width: auto;
    }

    .nav-links {
      display: flex;
      gap: 30px;
      align-items: center;
    }

    .nav-item {
      font-size: 16px;
      font-weight: 600;
      color: black;
      text-decoration: none;
      transition: color 0.3s;
      position: relative;
    }

    .nav-item:hover {
      color: var(--primary-color);
    }

    /* Highlight Menu PPDB */
    .nav-item.highlight {
      background: var(--primary-color);
      color: white !important;
      padding: 8px 20px;
      border-radius: 20px;
    }

    .nav-item.highlight:hover {
      background: var(--hover-color);
    }

    /* --- DROPDOWN MENU --- */
    .dropdown {
      position: relative;
      cursor: pointer;
    }

    .dropdown-menu {
      position: absolute;
      top: 100%;
      left: 0;
      background: white;
      border-radius: 12px;
      /* box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); */
      min-width: 240px;
      z-index: 1000;
      padding: 0 10px;
      margin-top: 10px;

      /* Smooth Animation */
      max-height: 0;
      opacity: 0;
      overflow: hidden;
      visibility: hidden;
      transition: all 0.4s ease-in-out;
    }

    .dropdown.active .dropdown-menu,
    .dropdown:hover .dropdown-menu {
      max-height: 400px;
      opacity: 1;
      visibility: visible;
      padding: 10px;
    }

    .dropdown-item {
      padding: 12px 16px;
      border-radius: 8px;
      color: #3c3c3c;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .dropdown-item:hover {
      background: var(--light-gray);
      color: var(--primary-color);
    }

    .dropdown-icon {
      color: var(--primary-color);
      font-size: 14px;
    }

    .nav-line {
      height: 4px;
      background: linear-gradient(to right, var(--primary-color), #4ade80);
      width: 100%;
    }

    /* --- HERO SECTION --- */
    .hero-wrapper {
      position: relative;
    }

    .hero-bg {
      background: var(--primary-color);
      height: 600px;
      width: 100%;
    }

    /* --- HERO SLIDER --- */
    .hero-slider {
      position: relative;
      height: 550px;
      overflow: hidden;
    }

    .slider-container {
      display: flex;
      height: 100%;
      position: relative;
    }

    .slide {
      width: 100%;
      height: 100%;
      flex-shrink: 0;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
      /* Mengganti gambar dengan warna hijau polos */
      background: var(--primary-color);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .slide.active {
      opacity: 1;
    }

    /* Overlay Gelap untuk Slider agar tulisan terbaca (Opsional jika gambar terang) */
    .slide::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.3);
      /* Gelap transparan */
      z-index: 1;
    }

    /* --- ANIMASI SOBEK --- */
    .slide::after {
      content: "";
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 50px;
      background: white;
      clip-path: polygon(0 50%, 100% 0, 100% 100%, 0% 100%);
      z-index: 2;
    }

    /* --- SLIDER NAVIGATION --- */
    .slider-nav {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 10px;
      z-index: 10;
    }

    .slider-dot {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: all 0.3s;
    }

    .slider-dot.active {
      background: white;
      transform: scale(1.2);
    }

    /* --- WELCOME CONTAINER --- */
    .welcome-container {
      margin-top: -50px;
      /* Overlap ke atas */
      padding: 40px 64px;
      position: relative;
      z-index: 10;
      background: transparent;
    }

    .hero-text-overlay {
      position: absolute;
      top: 50%;
      left: 64px;
      transform: translateY(-50%);
      z-index: 5;
      color: white;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      max-width: 600px;
    }

    .hero-stats-grid {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 50px;
      margin-top: 20px;
      background: white;
      padding: 40px;
      border-radius: 20px;
      /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); */
    }

    .program-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .program-item-row {
      display: flex;
      align-items: center;
      background: #efefef;
      padding: 15px;
      border-radius: 8px;
      gap: 15px;
    }

    .p-dot {
      width: 24px;
      height: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      background: var(--primary-color);
      border-radius: 50%;
      font-size: 12px;
      font-weight: 700;
    }

    .p-text {
      font-size: 15px;
      font-weight: 600;
      color: #555;
    }

    .hero-cards-row {
      display: flex;
      gap: 20px;
      justify-content: flex-start;
    }

    .card-placeholder {
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--green-medium);
      border-radius: 14px;
      height: 200px;
      width: 100%;
      min-width: 150px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      color: white;
      text-align: center;
      font-weight: 600;
      padding: 0;
      transition: transform 0.3s;
      overflow: hidden;
      position: relative;
      /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
    }

    .card-label {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      padding: 10px;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      font-size: 14px;
    }

    .card-placeholder:hover {
      transform: scale(1.05);
    }

    /* --- PROFILE SECTION --- */
    .section-content {
      padding: 60px 64px;
    }

    .profile-layout {
      display: flex;
      gap: 50px;
      align-items: center;
      margin-bottom: 80px;
    }

    .profile-image-placeholder {
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--primary-color);
      width: 400px;
      height: 350px;
      border-radius: 44px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 80px;
    }

    .profile-info {
      flex: 1;
    }

    .section-title {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #333;
    }

    .divider-v {
      width: 4px;
      height: 34px;
      background: var(--primary-color);
      border-radius: 4px;
    }

    .text-primary {
      color: var(--primary-color);
    }

    .profile-desc {
      font-size: 16px;
      line-height: 1.8;
      color: #555;
      margin-bottom: 30px;
      text-align: justify;
    }

    .stats-row {
      display: flex;
      align-items: center;
      gap: 30px;
    }

    .big-number {
      font-size: 60px;
      font-weight: 700;
      color: var(--primary-color);
      line-height: 1;
    }

    .stats-text div:first-child {
      font-size: 18px;
      font-weight: 700;
      color: #3c3c3c;
    }

    .stats-text div:last-child {
      font-size: 14px;
      font-weight: 500;
      color: #767676;
    }

    /* --- BENEFITS PILL --- */
    .benefits-pill {
      background: #f0fdf4;
      /* Hijau sangat muda */
      border: 1px solid #dcfce7;
      border-radius: 42px;
      padding: 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 80px;
    }

    .benefit-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .b-item {
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 600;
      color: #444;
      font-size: 16px;
    }

    .b-dot {
      width: 20px;
      height: 20px;
      background: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 12px;
      font-weight: 700;
    }

    .contact-info-box h3 {
      font-size: 20px;
      color: #166534;
      margin-bottom: 5px;
      font-weight: 700;
    }

    .contact-info-box p {
      font-size: 18px;
      color: #555;
    }

    /* --- PROGRAMS GRID --- */
    .programs-header {
      text-align: center;
      margin-bottom: 50px;
    }

    .programs-header h2 {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 15px;
      color: #1f2937;
    }

    .programs-header p {
      max-width: 600px;
      margin: 0 auto;
      color: var(--text-gray);
      font-size: 16px;
    }

    .program-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      margin-bottom: 100px;
    }

    .program-card {
      background: white;
      border-radius: 20px;
      /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); */
      position: relative;
      transition: transform 0.3s;
      overflow: hidden;
      display: flex;
      height: 220px;
      border: 1px solid #eee;
    }

    .program-card:hover {
      transform: translateY(-5px);
      /* box-shadow: 0 10px 25px rgba(21, 128, 61, 0.15); */
      border-color: var(--primary-color);
    }

    .pc-image-box {
      width: 40%;
      height: 100%;
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--green-medium);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 40px;
    }

    .pc-image-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
      /* Menyembunyikan gambar */
    }

    .card-content {
      padding: 25px;
      width: 60%;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .pc-title {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 10px;
      color: #1f2937;
    }

    .pc-desc {
      font-size: 14px;
      color: var(--text-gray);
      line-height: 1.5;
      margin-bottom: 20px;
    }

    .pc-arrow {
      position: absolute;
      bottom: 20px;
      right: 20px;
      width: 40px;
      height: 40px;
      background: var(--light-gray);
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary-color);
      transition: all 0.3s;
    }

    .program-card:hover .pc-arrow {
      background: var(--primary-color);
      color: white;
    }

    /* --- DREAM SECTION --- */
    .dream-layout {
      display: flex;
      gap: 50px;
      align-items: flex-start;
      margin-bottom: 100px;
    }

    .dream-content {
      flex: 1;
      padding-top: 20px;
    }

    .dream-subtitle {
      font-size: 18px;
      color: var(--primary-color);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .dream-title {
      font-size: 42px;
      margin: 15px 0;
      line-height: 1.2;
      font-weight: 800;
      color: #1f2937;
    }

    .dream-tagline {
      font-size: 20px;
      color: var(--text-gray);
      margin-bottom: 40px;
      font-weight: 500;
    }

    .dream-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .db-row {
      display: flex;
      gap: 15px;
    }

    .db-item {
      padding: 12px 20px;
      border-radius: 8px;
      color: white;
      display: flex;
      align-items: center;
      font-size: 14px;
      min-width: 200px;
      font-weight: 500;
    }

    .db-dot {
      width: 16px;
      height: 16px;
      background: white;
      border-radius: 50%;
      margin-right: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: var(--primary-color);
    }

    .bg-light-green {
      background: #4ade80;
      /* Hijau Muda */
      color: #064e3b;
    }

    .bg-dark-green {
      background: var(--primary-color);
    }

    .dream-image-placeholder {
      flex: 1;
      height: 400px;
      border-radius: 20px;
      position: relative;
      overflow: hidden;
      /* box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); */
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--primary-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 80px;
    }

    /* --- GALLERY (FIXED) --- */
    .gallery-section {
      text-align: left;
      /* Aligned left for header */
      padding-bottom: 100px;
    }

    .gallery-layout-row {
      display: grid;
      grid-template-columns: 1.2fr 1.2fr;
      /* Balanced width to fit embed */
      gap: 40px;
      align-items: start;
      margin-top: 40px;
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      /* 3 Columns */
      gap: 15px;
    }

    .gallery-item {
      height: 150px;
      /* Smaller height */
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--green-lightest);
      border-radius: 12px;
      transition: transform 0.3s;
      overflow: hidden;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--green-dark);
      font-size: 30px;
    }

    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
      /* Menyembunyikan gambar */
    }

    .gallery-item:hover {
      transform: scale(1.05);
      z-index: 2;
      /* box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); */
    }

    .instagram-feed-container {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 16px;
      overflow: hidden;
      height: 100%;
      min-height: 480px;
      /* Match approximate height of 2 rows of gallery + gap */
      display: flex;
      flex-direction: column;
    }

    .instagram-header {
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      ;
      padding: 15px;
      color: white;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 16px;
    }

    .instagram-embed-placeholder {
      flex: 1;
      background: #fafafa;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      text-align: center;
      color: #888;
    }

    @media (max-width: 900px) {
      .gallery-layout-row {
        grid-template-columns: 1fr;
        /* Stack on mobile */
      }

      .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
        /* Keep 3 cols or switch to 2? 3 is barely usable on very small screens, maybe 2. */
      }
    }

    @media (max-width: 600px) {
      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        /* 2 cols on mobile */
      }
    }

    /* --- FOOTER --- */
    .footer {
      background-color: var(--footer-dark);
      color: white;
      padding: 80px 0 30px;
    }

    .footer-content {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 50px;
      margin-bottom: 50px;
    }

    .footer-logo {
      display: flex;
      align-items: center;
      gap: 15px;
      font-size: 24px;
      font-weight: 700;
      color: white;
      margin-bottom: 20px;
    }

    .footer-logo img {
      height: 50px;
    }

    .footer-social {
      display: flex;
      gap: 15px;
      margin-top: 25px;
    }

    .footer-social a {
      width: 40px;
      height: 40px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 18px;
      transition: all 0.3s;
      text-decoration: none;
    }

    .footer-social a:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
    }

    .footer-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 25px;
      color: white;
      position: relative;
      padding-bottom: 10px;
    }

    .footer-title::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 40px;
      height: 3px;
      background: var(--primary-color);
    }

    .footer-list {
      list-style: none;
    }

    .footer-list li {
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-list i {
      color: var(--primary-color);
      font-size: 12px;
    }

    .footer-list a {
      color: #aaa;
      text-decoration: none;
      transition: color 0.3s;
      font-size: 15px;
    }

    .footer-list a:hover {
      color: var(--primary-color);
    }

    .footer-bottom {
      border-top: 1px solid #333;
      padding-top: 25px;
      text-align: center;
      font-size: 14px;
      color: #888;
    }

    /* --- WHATSAPP FLOATING BUTTON --- */
    .whatsapp-float {
      position: fixed;
      width: 60px;
      height: 60px;
      bottom: 40px;
      right: 40px;
      background-color: #25d366;
      color: #FFF;
      border-radius: 50px;
      text-align: center;
      font-size: 30px;
      /* box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.4); */
      z-index: 1000;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
    }

    .whatsapp-float:hover {
      transform: scale(1.1);
      background-color: #128C7E;
    }

    /* --- SCROLL ANIMATIONS --- */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .fade-in-delay-1 {
      transition-delay: 0.2s;
    }

    .fade-in-delay-2 {
      transition-delay: 0.4s;
    }

    .fade-in-delay-3 {
      transition-delay: 0.6s;
    }

    .fade-in-delay-4 {
      transition-delay: 0.8s;
    }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 1200px) {
      .container {
        max-width: 100%;
      }

      .program-grid {
        grid-template-columns: 1fr;
      }

      .program-card {
        height: auto;
      }

      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 900px) {

      .top-bar,
      .navbar {
        padding: 15px 20px;
        flex-direction: column;
        gap: 15px;
      }

      .nav-links {
        display: none;
      }

      .welcome-container {
        padding: 20px;
        margin-top: -100px;
      }

      .hero-stats-grid {
        grid-template-columns: 1fr;
        padding: 20px;
      }

      .hero-cards-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
      }

      .profile-layout {
        flex-direction: column;
        text-align: center;
      }

      .profile-image-placeholder {
        width: 100%;
        height: 300px;
      }

      .section-title {
        justify-content: center;
      }

      .stats-row {
        justify-content: center;
        flex-direction: column;
      }

      .benefits-pill {
        flex-direction: column;
        text-align: center;
        border-radius: 20px;
      }

      .dream-layout {
        flex-direction: column-reverse;
      }

      .dream-image-placeholder {
        width: 100%;
        height: 250px;
      }

      .footer-content {
        grid-template-columns: repeat(1, 1fr);
        gap: 30px;
      }

      .footer {
        padding: 40px 20px;
      }
    }

    @media (max-width: 600px) {
      .gallery-grid {
        grid-template-columns: 1fr;
      }

      .hero-bg {
        height: 300px;
      }

      .hero-text-overlay {
        left: 20px;
        top: 40%;
      }

      .hero-text-overlay h1 {
        font-size: 24px;
      }
    }

    /* --- BACK TO TOP --- */
    #backToTop {
      position: fixed;
      bottom: 30px;
      left: 30px;
      z-index: 999;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: var(--primary-color);
      color: white;
      cursor: pointer;
      width: 50px;
      height: 50px;
      padding: 0;
      border-radius: 50%;
      display: none;
      /* Hidden by default */
      align-items: center;
      justify-content: center;
      /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); */
      transition: transform 0.3s, background-color 0.3s;
    }

    #backToTop:hover {
      background-color: var(--hover-color);
      transform: translateY(-5px);
    }

    #backToTop:hover {
      background-color: var(--hover-color);
      transform: translateY(-5px);
    }

    /* --- PRELOADER --- */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: opacity 0.5s ease;
    }

    .preloader-content {
      text-align: center;
    }

    .preloader-logo {
      width: 80px;
      height: auto;
      animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
      0% {
        transform: scale(0.95);
        opacity: 0.7;
      }

      50% {
        transform: scale(1.05);
        opacity: 1;
      }

      100% {
        transform: scale(0.95);
        opacity: 0.7;
      }
    }

    /* --- MOBILE SPECIFIC STYLES (ADAPTED) --- */
    /* Mobile Top Bar */
    .mobile-top-bar {
      display: none;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background: var(--light-gray);
      font-size: 14px;
    }

    .mobile-help {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #333;
    }

    .mobile-help i {
      color: var(--primary-color);
    }

    .mobile-contact {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--primary-color);
      font-weight: 600;
    }

    /* Mobile Welcome */
    .mobile-welcome {
      display: none;
      text-align: center;
      padding: 20px;
    }

    .mobile-welcome h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .mobile-welcome p {
      color: #767676;
      margin-bottom: 20px;
    }

    .mobile-program-btn {
      background: var(--primary-color);
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 7px;
      padding: 12px 24px;
      margin-bottom: 20px;
      cursor: pointer;
      width: 100%;
      text-align: center;
      text-decoration: none;
      display: block;
    }

    .mobile-program-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 30px;
    }

    .mobile-program-item {
      display: flex;
      align-items: center;
      background: #efefef;
      padding: 15px;
      border-radius: 8px;
      gap: 15px;
    }

    .mobile-program-dot {
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      background: var(--primary-color);
      border-radius: 50%;
      font-size: 12px;
      font-weight: 700;
    }

    .mobile-program-text {
      font-size: 14px;
      font-weight: 600;
      color: #555;
    }

    /* Mobile Image Gallery (Welcome) */
    .mobile-image-gallery {
      display: none;
      margin-bottom: 30px;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      padding: 0 20px;
    }

    /* Mengganti background gambar dengan warna hijau polos untuk mobile gallery */
    .mobile-image-gallery>div {
      background: var(--green-medium);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 24px;
    }

    .mobile-image-gallery img {
      width: 100%;
      height: 100px;
      object-fit: cover;
      border-radius: 14px;
      display: none;
      /* Menyembunyikan gambar */
    }

    /* Mobile Profile Section */
    .mobile-profile {
      display: none;
      padding: 20px;
    }

    .mobile-profile-title {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
    }

    .mobile-profile-desc {
      font-size: 16px;
      line-height: 1.6;
      color: #555;
      margin-bottom: 20px;
    }

    .mobile-stats {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      margin-bottom: 20px;
    }

    .mobile-big-number {
      font-size: 60px;
      font-weight: 700;
      /* Bold for consistency */
      color: var(--primary-color);
      line-height: 1;
    }

    .mobile-stats-text {
      display: flex;
      flex-direction: column;
    }

    .mobile-stats-text div:first-child {
      font-size: 16px;
      font-weight: 600;
      color: #333;
    }

    .mobile-stats-text div:last-child {
      font-size: 14px;
      font-weight: 600;
      color: #767676;
    }

    .mobile-exp-badge {
      background: white;
      padding: 5px 15px;
      border-radius: 9px;
      /* box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1); */
      font-size: 10px;
      color: #767676;
      font-weight: 600;
    }

    .mobile-profile-image {
      margin-top: 20px;
      width: 100%;
      border-radius: 14px;
      overflow: hidden;
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--primary-color);
      height: 200px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 60px;
    }

    .mobile-profile-image img {
      width: 100%;
      height: auto;
      display: none;
      /* Menyembunyikan gambar */
    }

    /* Mobile Benefits Pill */
    .mobile-benefits {
      display: none;
      background: #f0fdf4;
      border-radius: 20px;
      padding: 20px;
      margin-bottom: 30px;
      border: 1px solid #dcfce7;
    }

    .mobile-benefits-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
      text-align: center;
      color: #166534;
    }

    .mobile-benefit-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 20px;
    }

    .mobile-benefit-item {
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 600;
      color: #444;
      font-size: 16px;
    }

    .mobile-benefit-dot {
      width: 18px;
      height: 18px;
      background: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 12px;
      font-weight: 700;
    }

    .mobile-contact-info {
      text-align: center;
    }

    .mobile-contact-info h3 {
      font-size: 18px;
      color: #166534;
      margin-bottom: 5px;
    }

    .mobile-contact-info p {
      font-size: 16px;
      color: #555;
    }

    /* Mobile Programs Section */
    .mobile-programs {
      display: none;
      padding: 20px;
    }

    .mobile-programs-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .mobile-programs-header h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .mobile-programs-header p {
      color: var(--text-gray);
      font-size: 14px;
    }

    .mobile-program-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
    }

    .mobile-program-card {
      background: white;
      border-radius: 14px;
      /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
      overflow: hidden;
      position: relative;
    }

    /* Mengganti background gambar dengan warna hijau polos untuk mobile program card */
    .mobile-program-card>div:first-child {
      background: var(--green-medium);
      height: 120px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 30px;
    }

    .mobile-program-card img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      display: none;
      /* Menyembunyikan gambar */
    }

    .mobile-program-card-content {
      padding: 15px;
    }

    .mobile-program-card-title {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .mobile-program-card-desc {
      font-size: 12px;
      color: var(--text-gray);
      margin-bottom: 10px;
    }

    .mobile-program-card-arrow {
      position: absolute;
      bottom: 10px;
      right: 10px;
      width: 30px;
      height: 30px;
      background: var(--primary-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }

    /* Mobile Dream Section - FIXED */
    .mobile-dream {
      display: none;
      padding: 20px;
      background: #f9fafb;
      border-radius: 15px;
      margin-bottom: 30px;
    }

    .mobile-dream-content {
      text-align: center;
      margin-bottom: 20px;
    }

    .mobile-dream-subtitle {
      font-size: 18px;
      color: var(--primary-color);
      font-weight: 700;
      margin-bottom: 10px;
    }

    .mobile-dream-title {
      font-size: 24px;
      margin: 10px 0;
      line-height: 1.2;
      font-weight: 800;
      color: #1f2937;
    }

    .mobile-dream-tagline {
      font-size: 16px;
      color: var(--text-gray);
      margin-bottom: 20px;
    }

    .mobile-dream-buttons {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin-bottom: 20px;
    }

    .mobile-db-item {
      padding: 12px 10px;
      border-radius: 8px;
      color: white;
      display: flex;
      align-items: center;
      font-size: 13px;
      background: var(--primary-color);
      /* Simplified green */
      justify-content: center;
    }

    .mobile-db-item.light {
      background: var(--green-medium);
      color: white;
    }

    .mobile-db-dot {
      width: 16px;
      height: 16px;
      background: white;
      border-radius: 50%;
      margin-right: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: var(--primary-color);
    }

    .mobile-dream-image {
      position: relative;
      margin-bottom: 20px;
      /* Mengganti background gambar dengan warna hijau polos */
      background: var(--primary-color);
      height: 180px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 60px;
    }

    .mobile-dream-image img {
      width: 100%;
      height: auto;
      border-radius: 14px;
      display: none;
      /* Menyembunyikan gambar */
    }

    .mobile-dream-box {
      background: var(--primary-color);
      color: white;
      padding: 15px;
      border-radius: 14px;
      text-align: center;
      margin-top: -30px;
      position: relative;
      z-index: 1;
    }

    .mobile-dream-box-title {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 5px;
    }

    .mobile-dream-box-desc {
      font-size: 14px;
    }

    /* Mobile Gallery Section */
    .mobile-gallery {
      display: none;
      padding: 20px;
    }

    .mobile-gallery-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .mobile-gallery-header h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .mobile-gallery-header p {
      color: #767676;
      font-weight: 600;
      font-size: 14px;
    }

    .mobile-gallery-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
    }

    /* Mengganti background gambar dengan warna hijau polos untuk mobile gallery */
    .mobile-gallery-item {
      height: 150px;
      border-radius: 10px;
      overflow: hidden;
      background: var(--green-lightest);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--green-dark);
      font-size: 30px;
    }

    .mobile-gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: none;
      /* Menyembunyikan gambar */
    }

    /* Mobile Footer */
    .mobile-footer {
      display: none;
      background-color: var(--footer-dark);
      color: white;
      padding: 30px 20px;
    }

    .mobile-footer-logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-size: 18px;
      font-weight: 700;
      color: white;
      margin-bottom: 15px;
    }

    .mobile-footer-logo img {
      height: 40px;
    }

    .mobile-footer-desc {
      text-align: center;
      color: #ccc;
      font-size: 14px;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    .mobile-footer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    .mobile-footer-social a {
      color: white;
      font-size: 20px;
      background: rgba(255, 255, 255, 0.1);
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      text-decoration: none;
    }

    .mobile-footer-links {
      display: flex;
      justify-content: space-around;
      margin-bottom: 30px;
    }

    .mobile-footer-column h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 15px;
      color: white;
    }

    .mobile-footer-list {
      list-style: none;
    }

    .mobile-footer-list li {
      margin-bottom: 10px;
    }

    .mobile-footer-list a {
      color: #ccc;
      text-decoration: none;
      font-size: 14px;
    }

    .mobile-footer-bottom {
      border-top: 1px solid #333;
      padding-top: 15px;
      text-align: center;
      font-size: 12px;
      color: #999;
    }

    /* Improved Mobile Navigation Styles (Accordions) */
    .mobile-dropdown {
      position: relative;
    }

    .mobile-dropdown-toggle {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }

    .mobile-dropdown-toggle i {
      transition: transform 0.3s;
    }

    .mobile-dropdown.active .mobile-dropdown-toggle i {
      transform: rotate(180deg);
    }

    .mobile-dropdown-menu {
      /* Smooth Animation Setup */
      display: block;
      /* Keep structure but hide visually */
      max-height: 0;
      opacity: 0;
      overflow: hidden;
      margin-top: 0;
      padding-top: 0;
      padding-bottom: 0;
      padding-left: 15px;
      /* Indent */

      background: #f9f9f9;
      border-radius: 8px;
      transition: all 0.4s ease-in-out;
      visibility: hidden;
    }

    .mobile-dropdown-menu a {
      /* Fix layout inside block container if needed */
      display: block;
    }

    .mobile-dropdown.active .mobile-dropdown-menu {
      /* Expanded State */
      max-height: 500px;
      /* Sufficient height for content */
      opacity: 1;
      margin-top: 5px;
      padding-top: 5px;
      padding-bottom: 5px;
      visibility: visible;
    }

    .mobile-dropdown-item {
      padding: 10px 15px;
      font-size: 14px;
      color: #555;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.2s;
    }

    /* --- MOBILE MEDIA QUERY OVERRIDES --- */
    @media (max-width: 900px) {
      /* Hide Desktop Elements */
      .top-bar,
      .navbar .nav-links,
      /* Hide desktop links only, keep navbar for sticky header */
      .welcome-container,
      .section-content,
      .footer,
      /* .whatsapp-float removed from here to show on mobile */
      .hero-wrapper

      /* Hide desktop slider */
        {
        display: none;
      }



      /* Navbar Adjustments */
      .navbar {
        padding: 15px 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        /* Space between logo and hamburger */
        align-items: center;
        height: 80px;
        position: sticky;
        top: 0;
        z-index: 1000;
        background: white;
        /* Ensure white background */
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); */
        /* Ensure shadow */
      }

      .logo img {
        height: 40px;
      }

      .mobile-menu-toggle {
        display: flex;
        /* Force Show */
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--primary-color);
        cursor: pointer;
      }

      /* Show Mobile Elements */
      .mobile-top-bar {
        display: flex;
      }

      .mobile-welcome {
        display: block;
      }

      .mobile-image-gallery {
        display: grid;
      }

      .mobile-profile {
        display: block;
      }

      .mobile-benefits {
        display: block;
      }

      .mobile-programs {
        display: block;
      }

      .mobile-dream {
        display: block;
      }

      .mobile-gallery {
        display: block;
      }

      .mobile-footer {
        display: block;
      }

      /* Mobile Menu Drawer Adjustments */
      .mobile-menu {
        display: block;
        /* Ensure the structure exists */
        right: -300px;
        /* Start hidden */
      }

      .mobile-menu.active {
        right: 0;
      }
    }

    /* --- MOBILE MENU STYLES --- */
    .mobile-menu-toggle {
      display: none;
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 24px;
      color: var(--primary-color);
      cursor: pointer;
      z-index: 1001;
    }

    .mobile-menu-overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(5px);
      /* iOS Glass effect */
      -webkit-backdrop-filter: blur(5px);
      z-index: 1000;
      transition: opacity 0.5s ease;
      opacity: 0;
    }

    .mobile-menu-overlay.active {
      display: block;
      opacity: 1;
    }

    .mobile-menu {
      display: none;
      position: fixed;
      top: 0;
      right: -320px;
      /* Fully hide */
      width: 300px;
      /* Slightly wider for better spacing */
      height: 100%;
      /* Full height */
      background: rgba(255, 255, 255, 0.95);
      /* Slight transparency */
      /* box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15); */
      /* Softer, deeper shadow */
      z-index: 1001;
      padding: 30px 25px;
      /* More breathing room */
      overflow-y: auto;
      transition: right 0.8s cubic-bezier(0.22, 1, 0.36, 1);
      /* "Pelan" & Smooth (Ease Out Quart/Quint feel) */
      border-top-left-radius: 40px;
      /* iPhone-like rounded corner */
      border-bottom-left-radius: 40px;
      /* Balanced look */
      /* No border-radius on right side as it touches screen edge */
    }

    .mobile-menu.active {
      right: 0;
      display: block;
    }

    .mobile-menu-overlay.active {
      display: block;
    }

    .mobile-menu-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 1px solid #eee;
    }

    .mobile-nav-links {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .mobile-nav-item {
      font-size: 16px;
      font-weight: 600;
      color: #333;
      text-decoration: none;
      padding: 10px;
      border-radius: 5px;
    }

    .mobile-nav-item:hover {
      background: var(--light-gray);
      color: var(--primary-color);
    }

    @media (max-width: 900px) {
      .mobile-menu-toggle {
        display: block;
      }
    }

    SMK MARHAS MARGAHAYU Kab. Bandung,
    Jawa Barat adm.smkmarhas@gmail.com Ikuti Kami: Logo SMK MARHAS Beranda Profil Kejuruan Akademik Berita Galeri BKK SPMB Kontak Kurikulum Pembelajaran Penerapan Kurikulum Merdeka yang berpusat pada peserta didik dan terkoneksi dengan dunia industri. Prinsip Pembelajaran Kurikulum Merdeka Pembelajaran intrakurikuler yang beragam di mana konten akan lebih optimal agar peserta didik memiliki cukup waktu untuk mendalami konsep. Link & Match Penyelarasan kurikulum sekolah dengan kebutuhan IDUKA (Industri, Dunia Usaha, dan Dunia Kerja). Teaching Factory Model pembelajaran berbasis produk (barang/jasa) melalui sinergi sekolah dengan industri. Struktur Kurikulum KELOMPOK MATA PELAJARAN RINCIAN MATERI / MUATAN A. Muatan Nasional Wajib ditempuh seluruh jurusan Pendidikan Agama dan Budi Pekerti Pendidikan Pancasila dan Kewarganegaraan Bahasa Indonesia Matematika Sejarah Indonesia Bahasa Inggris B. Muatan Kewilayahan Muatan Lokal Jawa Barat Seni Budaya Pendidikan Jasmani, Olahraga, dan Kesehatan Bahasa Sunda C. Muatan Kejuruan Sesuai Konsentrasi Keahlian Dasar Program Keahlian: Fisika, Kimia, Gambar Teknik (Tergantung Jurusan) Konsentrasi Keahlian: • Teknik Pemesinan (Bubut, Frais, CNC) • PPLG (Coding, Database, Web) Produk Kreatif dan Kewirausahaan Praktik Kerja Lapangan (PKL) Dokumen Akademik Struktur Kurikulum Lengkap Dokumen detail pembagian jam pelajaran per semester tahun ajaran 2025/2026. Unduh PDF Panduan Akademik & Tata Tertib Buku saku siswa mengenai peraturan akademik dan tata tertib sekolah. Unduh PDF 22 Dec 2025UAS Ujian Akhir Semester (UAS) Tahun Ajaran 2025/2026 Kampus SMK MARHAS 08 Dec 2025Wisuda Wisuda & Pelepasan Siswa Kelas XII Angkatan 2025 Hotel Sutan Raja 31 May 2025PPDB Penerimaan Peserta Didik Baru (PPDB) Gelombang 1 Sekretariat PPDB 15 Jan 2026Kunjungan Kunjungan Industri Jurusan PPLG ke Gameloft Indonesia Yogyakarta 20 Jan 2026Lomba Turnamen Futsal Antar Pelajar Se-Bandung Raya GOR Saparua Bandung 25 Jan 2026Workshop Workshop "Digital Marketing" untuk Kelas XI Bisnis Daring Lab Komputer 1 22 Dec 2025UAS Ujian Akhir Semester (UAS) Tahun Ajaran 2025/2026 Kampus SMK MARHAS 08 Dec 2025Wisuda Wisuda & Pelepasan Siswa Kelas XII Angkatan 2025 Hotel Sutan Raja 31 May 2025PPDB Penerimaan Peserta Didik Baru (PPDB) Gelombang 1 Sekretariat PPDB 15 Jan 2026Kunjungan Kunjungan Industri Jurusan PPLG ke Gameloft Indonesia Yogyakarta 20 Jan 2026Lomba Turnamen Futsal Antar Pelajar Se-Bandung Raya GOR Saparua Bandung 25 Jan 2026Workshop Workshop "Digital Marketing" untuk Kelas XI Bisnis Daring Lab Komputer 1 Logo Sekolah SMK MARHAS Sekolah Menengah Kejuruan Pusat Keunggulan yang mencetak lulusan kompeten, berakhlak mulia, dan berdaya saing global. Jurusan Teknik Pemesinan Rekayasa Perangkat Lunak Informasi Profil Sekolah Info SPMB Kontak Kami Hubungi Kami Jl. Terusan Kopo No.385/299, Margahayu, Kab. Bandung (022) 5410926 adm.smkmarhas@gmail.com © 2025 SMK MARHAS Margahayu. All Rights Reserved.
  </style>
  <div class="hero-wrapper">
    <div class="hero-slider" id="heroSlider">
      <div class="slider-container" id="sliderContainer">
        @foreach($sliders as $index => $slider)
          <div class="slide {{ $index == 0 ? 'active' : '' }}"
            style="background-image: url('{{ asset('storage/' . ($slider->image->file_path ?? '')) }}'); background-size: cover; background-position: center;">
            <div class="hero-text-overlay fade-in">
              <h1 style="font-size: 40px; font-weight: 800; margin-bottom: 10px;">{!! $slider->title !!}</h1>
              @if($slider->subtitle)
                <p style="font-size: 18px; font-weight: 500;">{{ $slider->subtitle }}</p>
              @endif
              @if($slider->link)
                <a href="{{ $slider->link }}" class="btn-primary" style="margin-top: 20px;">Selengkapnya</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      <div class="slider-nav">
        @foreach($sliders as $index => $slider)
          <div class="slider-dot {{ $index == 0 ? 'active' : '' }}" data-slide="{{ $index }}"></div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="welcome-container">
    <div class="hero-stats-grid">
      <div class="fade-in fade-in-delay-1">
        <h2 style="font-size: 24px; margin-bottom: 15px; color: #333;">Kenapa Harus <br><span class="text-primary">SMK
            MARHAS?</span></h2>
        <div class="program-list">
          <div class="program-item-row">
            <div class="p-dot"><i class="fas fa-check"></i></div>
            <div class="p-text">Kurikulum Berbasis Industri</div>
          </div>
          <div class="program-item-row">
            <div class="p-dot"><i class="fas fa-check"></i></div>
            <div class="p-text">Fasilitas Praktik Lengkap</div>
          </div>
          <div class="program-item-row">
            <div class="p-dot"><i class="fas fa-check"></i></div>
            <div class="p-text">Penyaluran Kerja (BKK)</div>
          </div>
        </div>
        <a href="#" class="btn-primary" style="margin-top: 20px; width: 100%;">DAFTAR SPMB SEKARANG</a>
      </div>

      <div class="hero-cards-row fade-in fade-in-delay-2">
        <a href="#ekstrakurikuler" class="card-placeholder" style="text-decoration: none;">
          <div class="card-label">Ekstrakurikuler</div>
        </a>
        <a href="#prestasi" class="card-placeholder" style="text-decoration: none;">
          <div class="card-label">Prestasi Siswa</div>
        </a>
        <a href="#mitra" class="card-placeholder" style="text-decoration: none;">
          <div class="card-label">Mitra Industri</div>
        </a>
      </div>
    </div>
  </div>

  <!-- Prestasi Section -->
  <div id="prestasi" class="section-content">
    <div class="programs-header fade-in">
      <h2>Prestasi Siswa</h2>
      <p>Kebanggaan Sekolah Kami</p>
    </div>
    <div class="news-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
      @foreach($achievements as $achievement)
        <div class="news-card"
          style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
          <div class="news-image" style="height: 200px; background: #eee; position: relative;">
            @if($achievement->image)
              <img src="{{ asset('storage/' . $achievement->image->file_path) }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div
                style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--light-gray); color: #ccc;">
                <i class="fas fa-trophy" style="font-size: 40px;"></i>
              </div>
            @endif
          </div>
          <div class="news-content" style="padding: 20px;">
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 5px;">{{ $achievement->title }}</h3>
            <p style="font-size: 14px; color: #666; margin-bottom: 5px;">{{ $achievement->winner_name }} -
              {{ $achievement->rank }}</p>
            <p style="font-size: 12px; color: #999;">{{ $achievement->level }} |
              {{ \Carbon\Carbon::parse($achievement->date_achieved)->format('d M Y') }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Ekstrakurikuler Section -->
  <div id="ekstrakurikuler" class="section-content" style="background: #f9fafb; padding-top: 50px; padding-bottom: 50px;">
    <div class="programs-header fade-in">
      <h2>Ekstrakurikuler</h2>
      <p>Wadah Pengembangan Bakat & Minat</p>
    </div>
    <div class="program-grid">
      @foreach($ekstrakurikulers as $ekskul)
        <div class="program-card">
          <div class="pc-image-box" style="height: 180px;">
            @if($ekskul->image)
              <img src="{{ asset('storage/' . $ekskul->image->file_path) }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div
                style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #eee;">
                <i class="fas fa-users" style="font-size: 40px; color: #ccc;"></i>
              </div>
            @endif
          </div>
          <div class="card-content">
            <h3 class="pc-title">{{ $ekskul->title }}</h3>
            <div class="pc-desc"
              style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
              {!! strip_tags($ekskul->content) !!}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Mitra Section -->
  <div id="mitra" class="section-content">
    <div class="programs-header fade-in">
      <h2>Mitra Industri</h2>
      <p>Kerjasama Dunia Usaha & Dunia Industri</p>
    </div>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; align-items: center;">
      @foreach($mitras as $mitra)
        <div
          style="width: 150px; height: 100px; display: flex; align-items: center; justify-content: center; transition: 0.3s; cursor: pointer;">
          @if($mitra->image)
            <img src="{{ asset('storage/' . $mitra->image->file_path) }}" alt="{{ $mitra->title }}"
              style="max-width: 100%; max-height: 100%; object-fit: contain;">
          @else
            <span>{{ $mitra->title }}</span>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  <!-- Mobile Welcome Section -->
  <div class="mobile-welcome fade-in">
    <div class="mobile-hero-image"
      style="margin-bottom: 20px; border-radius: 12px; overflow: hidden; /* box-shadow: 0 4px 12px rgba(0,0,0,0.1); */">
      @if($sliders->count() > 0)
        <div class="mobile-slider" style="position: relative; width: 100%; height: 100%;">
          @foreach($sliders as $slider)
            <div class="mobile-slide" style="display: {{ $loop->first ? 'block' : 'none' }}; width: 100%; height: 100%;">
              @if($slider->image)
                <img src="{{ asset('storage/' . $slider->image->file_path) }}" alt="{{ $slider->title }}"
                  style="width: 100%; height: 100%; object-fit: cover;">
              @endif
              <div class="mobile-slide-content"
                style="position: absolute; bottom: 20px; left: 20px; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                <h2 style="font-size: 24px; margin-bottom: 5px;">{{ $slider->title }}</h2>
                <p style="font-size: 14px;">{{ $slider->description }}</p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div
          style="width: 100%; height: 100%; background: #ddd; display: flex; align-items: center; justify-content: center;">
          <p>No sliders available</p>
        </div>
      @endif
    </div>
    <h1>Selamat Datang di<br>SMK MARHAS</h1>
    <p>Pusat Keunggulan, Mencetak Generasi Kompeten.</p>
    <a href="#" class="mobile-program-btn">DAFTAR PPDB SEKARANG</a>
    <div class="mobile-program-list">
      <div class="mobile-program-item">
        <div class="mobile-program-dot"><i class="fas fa-check"></i></div>
        <div class="mobile-program-text">Kurikulum Industri</div>
      </div>
      <div class="mobile-program-item">
        <div class="mobile-program-dot"><i class="fas fa-check"></i></div>
        <div class="mobile-program-text">Fasilitas Lengkap</div>
      </div>
      <div class="mobile-program-item">
        <div class="mobile-program-dot"><i class="fas fa-check"></i></div>
        <div class="mobile-program-text">Siap Kerja</div>
      </div>
    </div>
  </div>

  <!-- Mobile Image Gallery -->
  <div class="mobile-image-gallery fade-in fade-in-delay-1">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <div class="section-content">
    <div class="profile-layout">
      <div class="profile-image-placeholder" style="overflow: hidden; background: none;">
        @if($sambutan && $sambutan->media->first())
          <img src="{{ asset('storage/' . $sambutan->media->first()->file_path) }}" alt="Kepala Sekolah"
            style="width: 100%; height: 100%; object-fit: cover; border-radius: 44px;">
        @else
          <div
            style="width: 100%; height: 100%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; border-radius: 44px;">
            <i class="fas fa-user-tie" style="color: white; font-size: 80px;"></i>
          </div>
        @endif
      </div>
      <div class="profile-info">
        <div class="section-title">
          <div class="divider-v"></div>
          SAMBUTAN KEPALA SEKOLAH
        </div>
        <h2 style="font-size: 36px; margin-bottom: 20px; color: #1f2937;">
          {{ $sambutan->title ?? 'Membangun Generasi Unggul' }}
        </h2>
        <div class="profile-desc">
          @if($sambutan)
            {!! Str::limit(strip_tags($sambutan->content), 300) !!}
          @else
            <p>Sambutan belum tersedia.</p>
          @endif
        </div>

        <div class="stats-row">
          <div class="stat-item">
            <div class="big-number">2</div>
            <div class="stats-text">
              <div>Kampus</div>
              <div>Terintegrasi</div>
            </div>
          </div>
          <div class="stat-item">
            <div class="big-number">5</div>
            <div class="stats-text">
              <div>Program</div>
              <div>Keahlian</div>
            </div>
          </div>
          <div class="stat-item">
            <div class="big-number">50+</div>
            <div class="stats-text">
              <div>Mitra</div>
              <div>Industri</div>
            </div>
          </div>
        </div>

        <a href="{{ route('views.sambutan') }}" class="btn-primary" style="margin-top: 30px;">Baca Selengkapnya <i
            class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
      </div>
    </div>

    <div class="benefits-pill fade-in fade-in-delay-3">
      <div class="contact-info-box">
        <h3>Penerimaan Siswa Baru</h3>
        <p>Tahun Ajaran 2025/2026 Telah Dibuka!</p>
      </div>

      <div class="benefit-list">
        <div class="b-item">
          <div class="b-dot"><i class="fas fa-check"></i></div>Terakreditasi "A"
        </div>
        <div class="b-item">
          <div class="b-dot"><i class="fas fa-check"></i></div>Guru Sertifikasi
        </div>
        <div class="b-item">
          <div class="b-dot"><i class="fas fa-check"></i></div>Lingkungan Asri
        </div>
      </div>

      <a href="#" class="btn-primary">INFO LENGKAP</a>
    </div>

    <div class="programs-header fade-in">
      <h2>Kompetensi Keahlian</h2>
      <p class="fade-in fade-in-delay-1">Pilih jurusan sesuai minat dan bakatmu untuk masa depan gemilang</p>
    </div>

    <div class="program-grid">
      @foreach($kejuruans as $kejuruan)
        @php
          $routeName = match ($kejuruan->slug) {
            'teknik-pemesinan' => 'views.mesin',
            'pplg' => 'views.pplg',
            default => 'views.beranda'
          };
        @endphp
        <div class="program-card">
          <div class="pc-image-box" style="position: relative; background: #f0fdf4;">
            @if($kejuruan->media->first())
              <img src="{{ asset('storage/' . $kejuruan->media->first()->file_path) }}" alt="{{ $kejuruan->nama }}"
                style="display: block; width: 100%; height: 100%; object-fit: cover;">
            @else
              <i class="fas fa-cogs" style="color: var(--primary-color);"></i>
            @endif

            @if($kejuruan->ikon)
              <div
                style="position: absolute; bottom: 10px; right: 10px; width: 40px; height: 40px; background: white; border-radius: 50%; padding: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <img src="{{ asset('storage/' . $kejuruan->ikon) }}" alt="Icon"
                  style="display: block; width: 100%; height: 100%; object-fit: contain;">
              </div>
            @endif
          </div>
          <div class="card-content">
            <h3 class="pc-title">{{ $kejuruan->nama }}</h3>
            <div class="pc-desc"
              style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
              {!! strip_tags($kejuruan->deskripsi) !!}
            </div>
            <a href="{{ route($routeName) }}" class="pc-arrow"><i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      @endforeach
    </div>

    <div class="dream-layout">
      <div class="dream-content">
        <div class="dream-subtitle fade-in">{{ $visimisi->extras['subtitle'] ?? 'Visi Kami' }}</div>
        <h2 class="dream-title fade-in">{{ $visimisi->title ?? 'BMW: Bekerja, Melanjutkan, Wirausaha' }}</h2>
        <div class="dream-tagline fade-in fade-in-delay-1">
          {{ $visimisi->extras['tagline'] ?? 'Siapkan Masa Depanmu di Sini' }}
        </div>

        <div class="dream-buttons">
          @if(isset($visimisi->extras['points']) && is_array($visimisi->extras['points']))
            <div class="db-row fade-in fade-in-delay-2" style="flex-wrap: wrap;">
              @foreach($visimisi->extras['points'] as $point)
                <div class="db-item {{ $point['color'] ?? 'bg-light-green' }}">
                  <div class="db-dot"><i class="fas fa-star"></i></div>{{ $point['text'] ?? '' }}
                </div>
              @endforeach
            </div>
          @else
            <!-- Fallback if no points defined -->
            <div class="db-row fade-in fade-in-delay-2">
              <div class="db-item bg-light-green">
                <div class="db-dot"><i class="fas fa-star"></i></div>Pendidikan Karakter
              </div>
              <div class="db-item bg-dark-green">
                <div class="db-dot"><i class="fas fa-star"></i></div>Siap Kerja
              </div>
            </div>
          @endif
        </div>
      </div>

      <div class="dream-image-placeholder fade-in fade-in-delay-2" style="background: none;">
        @if($visimisi && $visimisi->image)
          <img src="{{ asset('storage/' . $visimisi->image->file_path) }}" alt="Visi Misi"
            style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
        @else
          <div
            style="width: 100%; height: 100%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; border-radius: 20px; color: white; font-size: 80px;">
            <i class="fas fa-bullseye"></i>
          </div>
        @endif
      </div>
    </div>

    <!-- Redundant Gallery Section Removed -->

    <!-- News Section -->
    <div class="news-section section-content" style="padding-top: 0;">
      <div class="programs-header fade-in">
        <h2>Berita Terbaru</h2>
        <p>Informasi terkini seputar kegiatan sekolah</p>
      </div>
      <div class="news-grid"
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
        @foreach($news as $item)
          <div class="news-card"
            style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.3s;">
            <div class="news-image" style="height: 200px; background: #eee; position: relative;">
              @if($item->image)
                <img src="{{ asset('storage/' . $item->image->file_path) }}"
                  style="width: 100%; height: 100%; object-fit: cover;">
              @else
                <div
                  style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--light-gray); color: #ccc;">
                  <i class="fas fa-newspaper" style="font-size: 40px;"></i>
                </div>
              @endif
              <div
                style="position: absolute; top: 10px; right: 10px; background: var(--primary-color); color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: 600;">
                {{ $item->created_at->format('d M Y') }}
              </div>
            </div>
            <div class="news-content" style="padding: 20px;">
              <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 10px; line-height: 1.4;">
                {{ Str::limit($item->title, 50) }}
              </h3>
              <div style="font-size: 14px; color: #666; margin-bottom: 15px; line-height: 1.6;">
                {!! Str::limit(strip_tags($item->content), 100) !!}
              </div>
              <a href="#"
                style="color: var(--primary-color); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                Baca Selengkapnya <i class="fas fa-arrow-right" style="font-size: 12px;"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="gallery-layout-row">
      <!-- Left: Gallery Grid (6 Images) -->
      <div class="gallery-col-left fade-in fade-in-delay-2">
        <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
          @foreach($latestGalleries as $gallery)
            <div class="gallery-item" style="position: relative; overflow: hidden; border-radius: 8px; cursor: pointer; aspect-ratio: 1/1;">
              @if($gallery->media->first())
                <img src="{{ asset('storage/' . $gallery->media->first()->file_path) }}" alt="{{ $gallery->title }}"
                  style="display: block; width: 100%; height: 100%; object-fit: cover;">
              @else
                <div style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-images" style="font-size: 20px; color: #ccc;"></i>
                </div>
              @endif
              
               <div class="gallery-overlay" style="position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 10px; color: white;">
                <h3 style="font-size: 12px; font-weight: 700; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $gallery->title }}</h3>
              </div>
            </div>
          @endforeach
        </div>
        <div style="margin-top: 20px; text-align: left;">
          <a href="#" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Lihat Seluruh
            Galeri
            &rarr;</a>
        </div>
      </div>

      <!-- Right: Instagram Embed -->
      <div class="gallery-col-right fade-in fade-in-delay-3">
        <div class="instagram-feed-container">
          <div class="instagram-header">
            <i class="fab fa-instagram" style="font-size: 24px;"></i>
            <span>@marhasupdate</span>
          </div>

          <!-- 
                                        IMPORTANT: To display a LIVE updating Instagram feed, you must use a widget service 
                                        because Instagram does not allow direct iframes of profiles.

                                        1. Go to a free widget provider (e.g., SnapWidget.com, Elfsight.com, or Juicer.io).
                                        2. Connect the @marhasupdate account.
                                        3. Generate the "Grid" or "Feed" widget code.
                                        4. Paste the <iframe> or <script> code below, replacing the placeholder.
                                    -->

          <div style="flex: 1; background: white;">
            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-fb119548-bf6e-4761-bc38-991156fdb61e" data-elfsight-app-lazy></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Mobile Profile Section -->
  <div class="mobile-profile fade-in">
    <h2 class="mobile-profile-title">{{ $schoolProfile->title ?? 'Profil SMK MARHAS' }}</h2>
    <div class="mobile-profile-desc">
      {!! $schoolProfile->content ?? 'SMK MARHAS Margahayu adalah lembaga pendidikan kejuruan yang berdedikasi tinggi dalam mencetak lulusan yang siap kerja, cerdas, dan berakhlak mulia.' !!}
    </div>

    <div class="mobile-stats">
      <div class="mobile-big-number">20+</div>
      <div class="mobile-stats-text">
        <div>SMK MARHAS</div>
        <div>Pusat Keunggulan</div>
      </div>
      <div class="mobile-exp-badge">Tahun Pengalaman</div>
    </div>

    <div class="mobile-profile-image">
      @if($sambutan && $sambutan->media->first())
        <img src="{{ asset('storage/' . $sambutan->media->first()->file_path) }}" alt="Kepala Sekolah"
          style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
      @else
        <div
          style="width: 100%; height: 100%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; border-radius: 50%;">
          <i class="fas fa-user-tie" style="color: white; font-size: 40px;"></i>
        </div>
      @endif
    </div>
  </div>

  <!-- Mobile Benefits Section -->
  <div class="mobile-benefits fade-in">
    <h3 class="mobile-benefits-title">PENERIMAAN SISWA BARU</h3>
    <div class="mobile-benefit-list">
      <div class="mobile-benefit-item">
        <div class="mobile-benefit-dot"><i class="fas fa-check"></i></div>
        <div>Terakreditasi "A"</div>
      </div>
      <div class="mobile-benefit-item">
        <div class="mobile-benefit-dot"><i class="fas fa-check"></i></div>
        <div>Guru Sertifikasi</div>
      </div>
      <div class="mobile-benefit-item">
        <div class="mobile-benefit-dot"><i class="fas fa-check"></i></div>
        <div>Lingkungan Asri</div>
      </div>
    </div>
    <div class="mobile-contact-info">
      <h3>Tahun Ajaran 2025/2026</h3>
      <p>Telah Dibuka!</p>
    </div>
  </div>

  <!-- Mobile Programs Section -->
  <div class="mobile-programs fade-in">
    <div class="mobile-programs-header">
      <h2>Kompetensi Keahlian</h2>
      <p>Pilih jurusan sesuai minat dan bakatmu</p>
    </div>
    <div class="mobile-program-grid">
      @foreach($kejuruans as $kejuruan)
        @php
          $routeName = match ($kejuruan->slug) {
            'teknik-pemesinan' => 'views.mesin',
            'pplg' => 'views.pplg',
            default => 'views.beranda'
          };
        @endphp
        <div class="mobile-program-card fade-in fade-in-delay-1">
          <div style="height: 120px; overflow: hidden; border-radius: 12px 12px 0 0;">
            @if($kejuruan->media->first())
              <img src="{{ asset('storage/' . $kejuruan->media->first()->file_path) }}" alt="{{ $kejuruan->nama }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div
                style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-cogs" style="color: #ccc; font-size: 30px;"></i>
              </div>
            @endif
          </div>
          <div class="mobile-program-card-content">
            <h3 class="mobile-program-card-title">{{ $kejuruan->nama }}</h3>
            <div class="mobile-program-card-desc"
              style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
              {!! strip_tags($kejuruan->deskripsi) !!}
            </div>
            <a href="{{ route($routeName) }}" class="mobile-program-card-arrow">
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Mobile Dream Section - FIXED -->
  <div class="mobile-dream fade-in">
    <div class="mobile-dream-content">
      <div class="mobile-dream-subtitle">{{ $visimisi->extras['subtitle'] ?? 'Visi Kami' }}</div>
      <h2 class="mobile-dream-title">{{ $visimisi->title ?? 'BMW: Bekerja, Melanjutkan, Wirausaha' }}</h2>
      <div class="mobile-dream-tagline">{{ $visimisi->extras['tagline'] ?? 'Siapkan Masa Depanmu di Sini' }}</div>
    </div>
    <div class="mobile-dream-buttons">
      @if(isset($visimisi->extras['points']) && is_array($visimisi->extras['points']))
        @foreach($visimisi->extras['points'] as $point)
          <div class="mobile-db-item {{ $point['color'] == 'bg-light-green' ? 'light' : '' }}">
            <div class="mobile-db-dot"><i class="fas fa-star"></i></div>
            {{ $point['text'] ?? '' }}
          </div>
        @endforeach
      @else
        <div class="mobile-db-item light">
          <div class="mobile-db-dot"><i class="fas fa-star"></i></div>
          Pendidikan Karakter
        </div>
        <div class="mobile-db-item">
          <div class="mobile-db-dot"><i class="fas fa-star"></i></div>
          Siap Kerja
        </div>
        <div class="mobile-db-item light">
          <div class="mobile-db-dot"><i class="fas fa-star"></i></div>
          Disiplin Tinggi
        </div>
        <div class="mobile-db-item">
          <div class="mobile-db-dot"><i class="fas fa-star"></i></div>
          Kompeten
        </div>
      @endif
    </div>
    <div class="mobile-dream-image fade-in fade-in-delay-1" style="background: none;">
      @if($visimisi && $visimisi->image)
        <img src="{{ asset('storage/' . $visimisi->image->file_path) }}" alt="Visi Misi"
          style="display: block; width: 100%; height: 100%; object-fit: cover; border-radius: 14px;">
      @else
        <div
          style="width: 100%; height: 100%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; border-radius: 14px; color: white; font-size: 60px;">
          <i class="fas fa-bullseye"></i>
        </div>
      @endif
    </div>
    <div class="mobile-dream-box">
      <h3 class="mobile-dream-box-title">SMK MARHAS</h3>
      <p class="mobile-dream-box-desc">Mencetak Generasi Kompeten dan Berkarakter</p>
    </div>
  </div>

  <!-- Mobile Gallery Section -->
  <div class="mobile-gallery fade-in">
    <div class="mobile-gallery-header">
      <h2>Galeri Kegiatan</h2>
      <p>Dokumentasi aktivitas siswa</p>
    </div>
    <div class="mobile-gallery-grid">
      @foreach($latestGalleries as $gallery)
        <div class="mobile-gallery-item fade-in fade-in-delay-{{ $loop->iteration }}" style="position: relative; margin-bottom: 15px;">
          @if($gallery->media->first())
            <img src="{{ asset('storage/' . $gallery->media->first()->file_path) }}" alt="{{ $gallery->title }}"
              style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
          @else
             <div style="width: 100%; height: 150px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                <i class="fas fa-images" style="font-size: 30px; color: #ccc;"></i>
             </div>
          @endif
          <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 10px; border-radius: 0 0 8px 8px;">
             <h3 style="color: white; font-size: 14px; margin: 0; font-weight: 600;">{{ $gallery->title }}</h3>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  </div>

  <!-- Mobile Prestasi Section -->
  <div class="mobile-programs fade-in">
    <div class="mobile-programs-header">
      <h2>Prestasi Siswa</h2>
      <p>Kebanggaan Sekolah Kami</p>
    </div>
    <div class="mobile-program-grid">
      @foreach($achievements as $achievement)
        <div class="mobile-program-card fade-in fade-in-delay-1">
          <div style="height: 120px; overflow: hidden; border-radius: 12px 12px 0 0;">
            @if($achievement->image)
              <img src="{{ asset('storage/' . $achievement->image->file_path) }}" alt="{{ $achievement->title }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div
                style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-trophy" style="color: #ccc; font-size: 30px;"></i>
              </div>
            @endif
          </div>
          <div class="mobile-program-card-content">
            <h3 class="mobile-program-card-title">{{ $achievement->title }}</h3>
            <p class="mobile-program-card-desc">{{ $achievement->winner_name }} - {{ $achievement->rank }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Mobile Ekstrakurikuler Section -->
  <div class="mobile-programs fade-in">
    <div class="mobile-programs-header">
      <h2>Ekstrakurikuler</h2>
      <p>Wadah Pengembangan Bakat</p>
    </div>
    <div class="mobile-program-grid">
      @foreach($ekstrakurikulers as $ekskul)
        <div class="mobile-program-card fade-in fade-in-delay-1">
          <div style="height: 120px; overflow: hidden; border-radius: 12px 12px 0 0;">
            @if($ekskul->image)
              <img src="{{ asset('storage/' . $ekskul->image->file_path) }}" alt="{{ $ekskul->title }}"
                style="width: 100%; height: 100%; object-fit: cover;">
            @else
              <div
                style="width: 100%; height: 100%; background: #eee; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-users" style="color: #ccc; font-size: 30px;"></i>
              </div>
            @endif
          </div>
          <div class="mobile-program-card-content">
            <h3 class="mobile-program-card-title">{{ $ekskul->title }}</h3>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Mobile Mitra Section -->
  <div class="mobile-benefits fade-in">
    <h3 class="mobile-benefits-title">Mitra Industri</h3>
    <div style="display: flex; flex-wrap: wrap; gap: 15px; justify-content: center; margin-top: 20px;">
      @foreach($mitras as $mitra)
        <div
          style="width: 100px; height: 60px; display: flex; align-items: center; justify-content: center; background: white; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
          @if($mitra->image)
            <img src="{{ asset('storage/' . $mitra->image->file_path) }}" alt="{{ $mitra->title }}"
              style="max-width: 80%; max-height: 80%; object-fit: contain;">
          @else
            <span style="font-size: 10px; text-align: center;">{{ $mitra->title }}</span>
          @endif
        </div>
      @endforeach
    </div>
  </div>
@endsection