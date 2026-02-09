@extends('layouts.frontend')

@section('title', 'Kalender Akademik 2026 - SMK MARHAS')

@section('content')
@php
    // --- KONFIGURASI DATA KALENDER (PHP SERVER SIDE) ---
    $startYear = 2026;
    $startDate = \Carbon\Carbon::create($startYear, 1, 1);
    $endDate = \Carbon\Carbon::create($startYear, 12, 31);
    
    // DATA EVENT (YYYY-MM-DD)
    $events = [
        "2026-01-01" => ["title" => "Tahun Baru Masehi", "desc" => "Libur Nasional Tahun Baru 2026.", "type" => "red"],
        "2026-01-05" => ["title" => "Hari Pertama Sekolah", "desc" => "Awal Semester Genap. Seluruh siswa wajib hadir.", "type" => "green"],
        "2026-01-26" => ["title" => "Mulai PKL Tahap 2", "desc" => "Pelepasan siswa kelas XI untuk PKL.", "type" => "white"],
        "2026-02-17" => ["title" => "Isra Mi'raj", "desc" => "Libur Peringatan Isra Mi'raj Nabi Muhammad SAW.", "type" => "red"],
        "2026-02-23" => ["title" => "PTS Genap", "desc" => "Penilaian Tengah Semester Genap dimulai.", "type" => "green"],
        "2026-03-11" => ["title" => "Libur Awal Puasa", "desc" => "Perkiraan libur awal Puasa Ramadhan 1447 H.", "type" => "red"],
        "2026-04-10" => ["title" => "Cuti Bersama", "desc" => "Cuti Bersama Hari Raya Idul Fitri.", "type" => "red"],
        "2026-04-11" => ["title" => "Idul Fitri 1447 H", "desc" => "Hari Raya Idul Fitri 1 Syawal 1447 H.", "type" => "red"],
        "2026-05-01" => ["title" => "Hari Buruh", "desc" => "Libur Nasional Hari Buruh Internasional.", "type" => "red"],
        "2026-05-14" => ["title" => "Kenaikan Isa Almasih", "desc" => "Libur Nasional Kenaikan Isa Almasih.", "type" => "red"],
        "2026-06-01" => ["title" => "Hari Lahir Pancasila", "desc" => "Libur Nasional Hari Lahir Pancasila.", "type" => "red"],
        "2026-06-15" => ["title" => "PAT Genap", "desc" => "Penilaian Akhir Tahun (PAT) Semester Genap.", "type" => "green"],
        "2026-06-27" => ["title" => "Pembagian Rapor", "desc" => "Pembagian Rapor Semester Genap.", "type" => "white"],
        // Tambahkan data lainnya di sini secara manual
    ];
@endphp

<style>
    .kalender-wrapper {
        background-color: #f8fafc;
        padding: 50px 0;
        font-family: 'Inter', sans-serif;
        min-height: 80vh;
    }

    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title h1 {
        font-size: 2.5rem;
        color: #1e293b;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .page-title p {
        color: #64748b;
        font-size: 1.1rem;
    }

    /* CALENDAR YEAR GRID */
    .year-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 Months per row on Desktop */
        gap: 30px;
    }

    /* MONTH CARD */
    .month-card {
        background: white;
        border-radius: 16px;
        /* box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); */
        padding: 24px;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s ease;
    }

    .month-card:hover {
        transform: translateY(-5px);
        /* box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.025); */
    }

    .month-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        text-align: center;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }

    /* DAYS GRID */
    .days-header, .days-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        text-align: center;
    }

    .days-header div {
        font-size: 0.75rem;
        font-weight: 600;
        color: #94a3b8;
        padding-bottom: 10px;
    }

    .day-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        font-weight: 500;
        color: #334155;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    /* Sunday Red Text */
    .day-cell:nth-child(7n+1) { /* Assuming grid starts Sunday */
        color: #ef4444;
    }

    .day-cell:not(.empty):hover {
        background-color: #f1f5f9;
        font-weight: 700;
    }

    .day-cell.today {
        border: 2px solid #3b82f6;
    }

    /* EVENT INDICATORS */
    .has-event::after {
        content: '';
        position: absolute;
        bottom: 4px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
    }

    .event-red { background-color: #fee2e2; color: #b91c1c; }
    .event-red::after { background-color: #ef4444; }

    .event-green { background-color: #dcfce7; color: #15803d; }
    .event-green::after { background-color: #22c55e; }
    
    .event-white { background-color: #f3f4f6; color: #1f2937; } /* Normal event */

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .year-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
        .year-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="kalender-wrapper">
    <div class="container-custom">
        <div class="page-title fade-in">
            <h1>Kalender Akademik 2026</h1>
            <p>Agenda Kegiatan Semester Genap & Ganjil</p>
        </div>

        <div class="year-grid fade-in">
            @for ($m = 1; $m <= 12; $m++)
                @php
                    $dt = \Carbon\Carbon::create($startYear, $m, 1);
                    $monthName = $dt->translatedFormat('F');
                    $daysInMonth = $dt->daysInMonth;
                    $firstDayOfWeek = $dt->dayOfWeek; // 0 (Sunday) to 6 (Saturday)
                @endphp

                <div class="month-card">
                    <div class="month-name">{{ $monthName }}</div>
                    
                    <div class="days-header">
                        <div>Min</div>
                        <div>Sen</div>
                        <div>Sel</div>
                        <div>Rab</div>
                        <div>Kam</div>
                        <div>Jum</div>
                        <div>Sab</div>
                    </div>

                    <div class="days-grid">
                        {{-- Empty cells before 1st of month --}}
                        @for ($i = 0; $i < $firstDayOfWeek; $i++)
                            <div class="day-cell empty"></div>
                        @endfor

                        {{-- Days of Month --}}
                        @for ($d = 1; $d <= $daysInMonth; $d++)
                            @php
                                $currentDate = \Carbon\Carbon::create($startYear, $m, $d);
                                $dateString = $currentDate->format('Y-m-d');
                                $isWeekend = ($currentDate->dayOfWeek == 0); // Sunday
                                
                                $cellClass = '';
                                $eventTitle = '';
                                $eventDesc = 'Tidak ada agenda khusus.';
                                $eventCategory = '';

                                // Check Events
                                if (isset($events[$dateString])) {
                                    $ev = $events[$dateString];
                                    $cellClass = 'has-event event-' . $ev['type'];
                                    $eventTitle = $ev['title'];
                                    $eventDesc = $ev['desc'];
                                    
                                    if ($ev['type'] == 'red') $eventCategory = 'Libur Nasional';
                                    elseif ($ev['type'] == 'green') $eventCategory = 'Agenda Sekolah';
                                    else $eventCategory = 'Info Penting';

                                } elseif ($isWeekend) {
                                    $cellClass = 'is-weekend'; // Just color text red via CSS
                                    $eventTitle = 'Minggu';
                                    $eventCategory = 'Libur Akhir Pekan';
                                }

                                // Escape for JS
                                $safeTitle = addslashes($eventTitle ?: 'Normal');
                                $safeDesc = addslashes($eventDesc);
                                $safeCat = addslashes($eventCategory ?: 'Hari Biasa');
                                $displayDate = $currentDate->translatedFormat('l, d F Y');
                            @endphp

                            <div class="day-cell {{ $cellClass }} {{ $dateString == date('Y-m-d') ? 'today' : '' }}"
                                 onclick="openModal('{{ $displayDate }}', '{{ $safeTitle }}', '{{ $safeCat }}', '{{ $safeDesc }}')">
                                {{ $d }}
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection