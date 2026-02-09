<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'SMK MARHAS Margahayu - Pusat Keunggulan')</title>
  <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

      .footer-content {
        grid-template-columns: repeat(1, 1fr);
        gap: 30px;
      }

      .footer {
        padding: 40px 20px;
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

    /* --- WAVE ANIMATION --- */
    .loading-dots {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 15px; /* Space between logo and dots */
    }

    .dot {
      width: 12px;
      height: 12px;
      background-color: var(--primary-color);
      border-radius: 50%;
      animation: wave 1.2s infinite ease-in-out;
    }

    .dot:nth-child(1) { animation-delay: -0.4s; }
    .dot:nth-child(2) { animation-delay: -0.3s; }
    .dot:nth-child(3) { animation-delay: -0.2s; }
    .dot:nth-child(4) { animation-delay: -0.1s; }

    @keyframes wave {
      0%, 40%, 100% {
        transform: translateY(0);
      }
      20% {
        transform: translateY(-15px); /* Adjust jump height */
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
      .footer {
        display: none;
      }

      /* Navbar Adjustments */
      .navbar {
        padding: 15px 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        height: 80px;
        position: sticky;
        top: 0;
        z-index: 1000;
        background: white;
        /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); */
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

      .mobile-footer {
        display: block;
      }

      /* Mobile Menu Drawer Adjustments */
      .mobile-menu {
        display: block;
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
      width: 300px;
      height: 100%;
      background: rgba(255, 255, 255, 0.95);
      box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
      z-index: 1001;
      padding: 30px 25px;
      overflow-y: auto;
      transition: right 0.8s cubic-bezier(0.22, 1, 0.36, 1);
      border-top-left-radius: 40px;
      border-bottom-left-radius: 40px;
    }

    .mobile-menu.active {
      right: 0;
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

        /* --- HERO & BREADCRUMB STYLES --- */
    .hero-wrapper {
        position: relative;
    }

    .hero-bg {
        background: url('{{ asset("image/logo.png") }}') no-repeat center center; /* Fallback/Default */
        background-size: cover;
        height: 300px;
        width: 100%;
        background-color: var(--primary-color); /* Fallback color */
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

    /* --- BREADCRUMB --- */
    .breadcrumb {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
        gap: 12px;
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
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 15px;
        margin: -20px 20px 20px;
        position: relative;
        z-index: 10;
    }

    .mobile-breadcrumb-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        color: #3c3c3c;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .mobile-breadcrumb-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--primary-color);
        flex-shrink: 0;
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

    /* --- CONTENT STYLES --- */
    .profile-section {
        padding: 80px 64px;
        background: #fff;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
        margin-bottom: 40px;
        border: 1px solid #f0f0f0;
    }

    .section-badge {
        display: inline-block;
        padding: 8px 20px;
        background: var(--green-lightest);
        color: var(--primary-color);
        border-radius: 50px;
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .content-text {
        font-size: 17px;
        line-height: 1.8;
        color: #555;
        text-align: justify;
    }

    .history-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .image-box {
        background: var(--primary-color);
        border-radius: 25px;
        height: 400px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 50px;
        position: relative;
        overflow: hidden;
    }

    /* --- IDENTITAS TABLE --- */
    .table-identitas {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table-identitas tr {
        border-bottom: 1px solid #eee;
    }

    .table-identitas td {
        padding: 15px;
        font-size: 15px;
    }

    .table-identitas td:first-child {
        font-weight: 700;
        color: #333;
        width: 30%;
        background: #f9fafb;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 900px) {
        .hero-wrapper, .hero-bg, .breadcrumb { display: none; }
        .mobile-hero, .mobile-breadcrumb { display: block; }
        
        .profile-section { padding: 40px 20px; }
        .history-grid { grid-template-columns: 1fr; }
        .image-box { height: 250px; }
        .table-identitas td:first-child { width: 40%; }
    }
  </style>
  @stack('styles')
</head>

<body>
  <!-- PRELOADER -->
  <div id="preloader">
    <div class="preloader-content">
      <img src="{{ asset('image/favicon.png') }}" alt="Loading..." class="preloader-logo">
      <div class="loading-dots">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>
  </div>

  <div class="container">
    @include('partials.header')

    <div class="nav-line"></div>

    @yield('content')
    
    @include('partials.news-ticker')
    @include('partials.footer')

    <a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank">
      <i class="fab fa-whatsapp"></i>
    </a>
    <button id="backToTop" title="Kembali ke Atas">
      <i class="fas fa-arrow-up"></i>
    </button>
  </div>

  <script>
    // --- BACK TO TOP BUTTON ---
    const backToTopButton = document.getElementById("backToTop");

    window.onscroll = function () {
      scrollFunction();
    };

    function scrollFunction() {
      if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        backToTopButton.style.display = "flex";
      } else {
        backToTopButton.style.display = "none";
      }
    }

    if (backToTopButton) {
        backToTopButton.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
        });
    }

    // --- PRELOADER ---
    function hidePreloader() {
      const preloader = document.getElementById("preloader");
      if(preloader && preloader.style.display !== "none" && !preloader.classList.contains('hiding')) {
        preloader.classList.add('hiding');
        preloader.style.opacity = "0";
        setTimeout(() => {
            preloader.style.display = "none";
        }, 500);
      }
    }

    window.addEventListener("load", hidePreloader);
    
    // Force hide after 1 second (1000ms) as requested
    setTimeout(hidePreloader, 1000);

    // --- MOBILE DROPDOWNS (ACCORDION) ---
    const dropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');
    dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        const dropdown = this.closest('.mobile-dropdown');
        const icon = this.querySelector('.fa-chevron-down');

        // Close others if desired, or allow multiple open. Letting multiple open for now.
        dropdown.classList.toggle('active');

        if (icon) {
          if (dropdown.classList.contains('active')) {
            icon.style.transform = 'rotate(180deg)';
          } else {
            icon.style.transform = 'rotate(0deg)';
          }
        }
      });
    });

    // --- SCRIPT JAVASCRIPT STANDAR (TIDAK PERLU DIUBAH) ---

    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function () {
      const menuToggle = document.querySelector('.mobile-menu-toggle');
      const mobileMenu = document.querySelector('.mobile-menu');
      const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
      const mobileMenuClose = document.querySelector('.mobile-menu-close');

      if (menuToggle && mobileMenu && mobileMenuOverlay && mobileMenuClose) {
        menuToggle.addEventListener('click', function () {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
      }
    });

    // Slider
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    
    if (slides.length > 0) {
        let currentSlide = 0;
        const slideInterval = 4000;

        function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        if (slides[index]) slides[index].classList.add('active');
        if (dots[index]) dots[index].classList.add('active');
        currentSlide = index;
        }

        function nextSlide() {
        let nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
        }

        setInterval(nextSlide, slideInterval);

        dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
        });
        });
    }

    // Desktop Dropdown Click Toggles
    const desktopDropdowns = document.querySelectorAll('.nav-links .dropdown');
    desktopDropdowns.forEach(dropdown => {
      const navItem = dropdown.querySelector('.nav-item');

      if(navItem) {
        navItem.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Close other dropdowns
            desktopDropdowns.forEach(otherDropdown => {
            if (otherDropdown !== dropdown) {
                otherDropdown.classList.remove('active');
            }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('active');
        });
      }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.dropdown')) {
        desktopDropdowns.forEach(dropdown => {
          dropdown.classList.remove('active');
        });
      }
    });

    // Scroll Animations
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
  @stack('scripts')
</body>

</html>
