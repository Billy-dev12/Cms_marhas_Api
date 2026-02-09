@php
    $personel = $record->extras['personel'] ?? [];
    
    // Organize personnel by hierarchy
    $kepala = collect($personel)->firstWhere('jabatan', 'Kepala Sekolah');
    $wakil = collect($personel)->filter(fn($p) => $p['jabatan'] === 'Wakil Kepala Sekolah')->values();
    $bendahara = collect($personel)->firstWhere('jabatan', 'Bendahara');
    $sekretaris = collect($personel)->firstWhere('jabatan', 'Sekretaris');
    $guru = collect($personel)->filter(fn($p) => $p['jabatan'] === 'Guru')->values();
    $staff = collect($personel)->filter(fn($p) => $p['jabatan'] === 'Staff')->values();
@endphp

<div class="p-6 space-y-8">
    {{-- Image Section --}}
    @if($record->image)
        <div class="flex justify-center mb-6">
            <img src="{{ asset('storage/' . $record->image->file_path) }}" 
                 alt="Bagan Struktur" 
                 class="max-w-full h-auto rounded-lg shadow-lg border-2 border-gray-200 dark:border-gray-700">
        </div>
    @endif

    {{-- Hierarchical Organization Chart --}}
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 rounded-xl p-8 border border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 text-center">Struktur Organisasi</h3>
        
        {{-- Level 1: Kepala Sekolah --}}
        @if($kepala)
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-xl p-6 min-w-[280px] text-center transform hover:scale-105 transition-transform">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 overflow-hidden border-2 border-white/30">
                            @if(!empty($kepala['foto']))
                                <img src="{{ asset('storage/' . $kepala['foto']) }}" alt="{{ $kepala['nama'] }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                </svg>
                            @endif
                        </div>
                        <h4 class="font-bold text-lg mb-1">{{ $kepala['nama'] }}</h4>
                        <p class="text-sm opacity-90 font-medium mb-2">{{ $kepala['jabatan'] }}</p>
                        @if(!empty($kepala['nip']))
                            <p class="text-xs opacity-75">NIP: {{ $kepala['nip'] }}</p>
                        @endif
                    </div>
                    {{-- Connector line down --}}
                    @if($wakil->count() > 0 || $bendahara || $sekretaris)
                        <div class="absolute left-1/2 -bottom-8 w-0.5 h-8 bg-gray-400 dark:bg-gray-600 -ml-px"></div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Level 2: Wakil, Bendahara, Sekretaris --}}
        @if($wakil->count() > 0 || $bendahara || $sekretaris)
            <div class="relative mb-8">
                {{-- Horizontal connector --}}
                <div class="absolute top-0 left-1/4 right-1/4 h-0.5 bg-gray-400 dark:bg-gray-600"></div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8">
                    {{-- Wakil Kepala --}}
                    @foreach($wakil as $w)
                        <div class="flex flex-col items-center">
                            <div class="absolute -top-8 w-0.5 h-8 bg-gray-400 dark:bg-gray-600"></div>
                            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow-lg p-5 w-full text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 overflow-hidden border-2 border-white/30">
                                    @if(!empty($w['foto']))
                                        <img src="{{ asset('storage/' . $w['foto']) }}" alt="{{ $w['nama'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="font-bold mb-1">{{ $w['nama'] }}</h4>
                                <p class="text-xs opacity-90 mb-1">{{ $w['jabatan'] }}</p>
                                @if(!empty($w['nip']))
                                    <p class="text-xs opacity-75">NIP: {{ $w['nip'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    {{-- Bendahara --}}
                    @if($bendahara)
                        <div class="flex flex-col items-center">
                            <div class="absolute -top-8 w-0.5 h-8 bg-gray-400 dark:bg-gray-600"></div>
                            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-5 w-full text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 overflow-hidden border-2 border-white/30">
                                    @if(!empty($bendahara['foto']))
                                        <img src="{{ asset('storage/' . $bendahara['foto']) }}" alt="{{ $bendahara['nama'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/>
                                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="font-bold mb-1">{{ $bendahara['nama'] }}</h4>
                                <p class="text-xs opacity-90 mb-1">{{ $bendahara['jabatan'] }}</p>
                                @if(!empty($bendahara['nip']))
                                    <p class="text-xs opacity-75">NIP: {{ $bendahara['nip'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Sekretaris --}}
                    @if($sekretaris)
                        <div class="flex flex-col items-center">
                            <div class="absolute -top-8 w-0.5 h-8 bg-gray-400 dark:bg-gray-600"></div>
                            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-lg shadow-lg p-5 w-full text-center transform hover:scale-105 transition-transform">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 overflow-hidden border-2 border-white/30">
                                    @if(!empty($sekretaris['foto']))
                                        <img src="{{ asset('storage/' . $sekretaris['foto']) }}" alt="{{ $sekretaris['nama'] }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                                <h4 class="font-bold mb-1">{{ $sekretaris['nama'] }}</h4>
                                <p class="text-xs opacity-90 mb-1">{{ $sekretaris['jabatan'] }}</p>
                                @if(!empty($sekretaris['nip']))
                                    <p class="text-xs opacity-75">NIP: {{ $sekretaris['nip'] }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Level 3: Guru dan Staff --}}
        @if($guru->count() > 0 || $staff->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                {{-- Guru --}}
                @if($guru->count() > 0)
                    <div>
                        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 text-center">Tim Pengajar</h4>
                        <div class="space-y-3">
                            @foreach($guru as $g)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden border border-teal-200 dark:border-teal-800">
                                            @if(!empty($g['foto']))
                                                <img src="{{ asset('storage/' . $g['foto']) }}" alt="{{ $g['nama'] }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h5 class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $g['nama'] }}</h5>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $g['jabatan'] }}</p>
                                            @if(!empty($g['nip']))
                                                <p class="text-xs text-gray-400 dark:text-gray-500">NIP: {{ $g['nip'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Staff --}}
                @if($staff->count() > 0)
                    <div>
                        <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 text-center">Tim Administrasi</h4>
                        <div class="space-y-3">
                            @foreach($staff as $s)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center flex-shrink-0 overflow-hidden border border-indigo-200 dark:border-indigo-800">
                                            @if(!empty($s['foto']))
                                                <img src="{{ asset('storage/' . $s['foto']) }}" alt="{{ $s['nama'] }}" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h5 class="font-semibold text-gray-900 dark:text-white text-sm truncate">{{ $s['nama'] }}</h5>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $s['jabatan'] }}</p>
                                            @if(!empty($s['nip']))
                                                <p class="text-xs text-gray-400 dark:text-gray-500">NIP: {{ $s['nip'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    {{-- Additional Content --}}
    @if(!empty($record->content))
        <div class="prose dark:prose-invert max-w-none p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Keterangan Tambahan</h4>
            {!! $record->content !!}
        </div>
    @endif
</div>