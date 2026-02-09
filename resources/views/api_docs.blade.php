<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Explorer & Manual Book</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Highlight.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Fira Code', 'monospace'],
                    },
                    colors: {
                        gray: {
                            850: '#1f2937',
                            900: '#111827',
                            950: '#030712',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #111827;
        }

        ::-webkit-scrollbar-thumb {
            background: #374151;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4b5563;
        }

        /* Syntax Highlighting Overrides */
        .json-key {
            color: #9cdcfe;
        }

        .json-string {
            color: #ce9178;
        }

        .json-number {
            color: #b5cea8;
        }

        .json-boolean {
            color: #569cd6;
        }

        .hljs {
            background: #0d1117 !important;
            padding: 1.5rem !important;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body
    class="bg-gray-950 text-gray-200 font-sans h-screen flex flex-col md:flex-row overflow-hidden selection:bg-indigo-500/30">

    <!-- Mobile Header -->
    <div class="md:hidden flex items-center justify-between p-4 bg-gray-900 border-b border-gray-800 z-20">
        <div>
            <h1 class="text-lg font-bold text-white tracking-tight">API Explorer</h1>
            <p class="text-xs text-gray-500">Live Documentation</p>
        </div>
        <button onclick="toggleSidebar()"
            class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black/60 z-30 hidden md:hidden backdrop-blur-sm transition-opacity"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-40 w-72 bg-gray-900 border-r border-gray-800 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col shadow-2xl md:shadow-none">
        <!-- Sidebar Header -->
        <div class="hidden md:flex p-6 border-b border-gray-800 flex-col">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white tracking-tight">API Explorer</h1>
                    <p class="text-xs text-indigo-400 font-medium mt-0.5">Live Documentation</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-8">

            <!-- PROFIL SEKOLAH -->
            <div>
                <div class="px-3 mb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Profil Sekolah
                </div>
                <div class="space-y-1">

                    <button onclick="fetchApi('/api/profiles?type=profil', 'Profil Sekolah'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-teal-500 group-hover:shadow-[0_0_8px_rgba(20,184,166,0.5)] transition-shadow"></span>
                        Profil Sekolah
                    </button>

                    <button onclick="fetchApi('/api/profiles?type=sejarah', 'Sejarah Sekolah'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-gray-500 group-hover:shadow-[0_0_8px_rgba(107,114,128,0.5)] transition-shadow"></span>
                        Sejarah
                    </button>

                    <button onclick="fetchApi('/api/profiles?type=visi_misi', 'Visi & Misi'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-rose-500 group-hover:shadow-[0_0_8px_rgba(244,63,94,0.5)] transition-shadow"></span>
                        Visi & Misi
                    </button>

                    <button
                        onclick="fetchApi('/api/profiles?type=struktur', 'Struktur Organisasi'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-indigo-500 group-hover:shadow-[0_0_8px_rgba(99,102,241,0.5)] transition-shadow"></span>
                        Struktur Organisasi
                    </button>

                    <button
                        onclick="fetchApi('/api/profiles?type=sambutan', 'Sambutan Kepala Sekolah'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-blue-500 group-hover:shadow-[0_0_8px_rgba(59,130,246,0.5)] transition-shadow"></span>
                        Sambutan
                    </button>

                </div>
            </div>

            <!-- AKADEMIK -->
            <div>
                <div class="px-3 mb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Akademik
                </div>
                <div class="space-y-1">

                    <button onclick="fetchApi('/api/kejuruans', 'Daftar Jurusan'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-purple-500 group-hover:shadow-[0_0_8px_rgba(168,85,247,0.5)] transition-shadow"></span>
                        Jurusan
                    </button>

                    <button onclick="fetchApi('/api/profiles?type=kurikulum', 'Kurikulum'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-yellow-500 group-hover:shadow-[0_0_8px_rgba(234,179,8,0.5)] transition-shadow"></span>
                        Kurikulum
                    </button>

                    <button
                        onclick="fetchApi('/api/profiles?type=ekstrakurikuler', 'Ekstrakurikuler'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-fuchsia-500 group-hover:shadow-[0_0_8px_rgba(217,70,239,0.5)] transition-shadow"></span>
                        Ekstrakurikuler
                    </button>

                    <button onclick="fetchApi('/api/achievements', 'Prestasi Siswa'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-orange-500 group-hover:shadow-[0_0_8px_rgba(249,115,22,0.5)] transition-shadow"></span>
                        Prestasi
                    </button>

                </div>
            </div>

            <!-- FASILITAS & MEDIA -->
            <div>
                <div class="px-3 mb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Fasilitas & Media
                </div>
                <div class="space-y-1">

                    <button
                        onclick="fetchApi('/api/profiles?type=sarana', 'Sarana & Prasarana'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-lime-500 group-hover:shadow-[0_0_8px_rgba(132,204,22,0.5)] transition-shadow"></span>
                        Sarana & Prasarana
                    </button>

                    <button onclick="fetchApi('/api/news', 'Berita Sekolah'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-amber-500 group-hover:shadow-[0_0_8px_rgba(245,158,11,0.5)] transition-shadow"></span>
                        Berita
                    </button>

                    <button onclick="fetchApi('/api/galleries', 'Galeri Foto'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-pink-500 group-hover:shadow-[0_0_8px_rgba(236,72,153,0.5)] transition-shadow"></span>
                        Galeri
                    </button>

                    <button onclick="fetchApi('/api/sliders', 'Slider Banner'); closeSidebarOnMobile()"
                        class="nav-item w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-800 hover:text-white hover:shadow-lg transition-all duration-200 flex items-center gap-3 group border border-transparent hover:border-gray-700">
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-cyan-500 group-hover:shadow-[0_0_8px_rgba(6,182,212,0.5)] transition-shadow"></span>
                        Slider
                    </button>

                </div>
            </div>

        </nav>



        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-gray-800 bg-gray-900/50 backdrop-blur">
            <a href="/"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-950">

        <!-- Main Header -->
        <header
            class="hidden md:flex items-center justify-between px-8 py-5 border-b border-gray-800 bg-gray-900/30 backdrop-blur-md">
            <div>
                <h2 id="page-title" class="text-lg font-bold text-white">Pilih API di menu sebelah kiri</h2>
                <div id="endpoint-url" class="text-xs text-gray-500 font-mono mt-1 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span>
                    <span>Ready</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="flex bg-gray-900 border border-gray-800 rounded-lg p-1">
                    <span
                        class="px-3 py-1 bg-gray-800 text-emerald-400 text-xs font-bold rounded shadow-sm border border-gray-700/50">GET</span>
                    <span class="px-3 py-1 text-gray-400 text-xs font-medium border border-transparent">PUBLIC</span>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col lg:flex-row overflow-hidden">

            <!-- Response Viewer -->
            <div class="flex-1 p-4 md:p-8 overflow-y-auto relative">
                <!-- Mobile Status Badge -->
                <div class="lg:hidden mb-4 flex justify-end">
                    <div class="bg-gray-900 border border-gray-800 rounded-lg p-1 flex">
                        <span
                            class="px-3 py-1 bg-gray-800 text-emerald-400 text-xs font-bold rounded shadow-sm">GET</span>
                        <span
                            class="px-3 py-1 text-gray-400 text-xs font-medium border border-transparent">PUBLIC</span>
                    </div>
                </div>

                <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wide flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                            Live Response
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">JSON Output</p>
                    </div>
                    <button onclick="copyResponse()"
                        class="group flex items-center gap-2 px-3 py-2 bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-lg text-xs font-medium text-gray-300 transition-all active:scale-95">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-400 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                            </path>
                        </svg>
                        Copy JSON
                    </button>
                </div>

                <div class="relative group rounded-xl border border-gray-800 bg-gray-900/50 shadow-2xl overflow-hidden">
                    <div
                        class="absolute top-0 right-0 p-2 opacity-50 group-hover:opacity-100 transition-opacity pointer-events-none">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/20 border border-green-500/50"></div>
                        </div>
                    </div>
                    <pre class="font-mono text-sm"><code id="json-response" class="language-json block min-h-[400px] p-4 md:p-6 text-gray-300">
// Silakan pilih menu di samping untuk melihat data...
                    </code></pre>
                </div>
            </div>

            <!-- Documentation / Notes -->
            <aside
                class="w-full lg:w-96 border-t lg:border-t-0 lg:border-l border-gray-800 bg-gray-900/40 p-6 lg:p-8 overflow-y-auto">
                <div class="sticky top-0">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="p-2 bg-indigo-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-white">Panduan Penggunaan</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="p-4 rounded-xl bg-gray-800/50 border border-gray-700/50">
                            <p class="text-sm text-gray-300 leading-relaxed">
                                Halaman ini menampilkan data mentah (<span class="text-indigo-400 font-mono">raw
                                    data</span>) yang diambil langsung dari database melalui API endpoint.
                            </p>
                        </div>

                        <div>
                            <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Integrasi
                                Frontend</h4>
                            <div
                                class="bg-[#0d1117] rounded-xl p-4 border border-gray-800 shadow-inner overflow-x-auto">
                                <code class="text-xs text-gray-300 font-mono block whitespace-pre">
<span class="text-purple-400">fetch</span>(<span class="text-green-400">'/api/endpoint'</span>)
  .<span class="text-blue-400">then</span>(<span class="text-orange-400">res</span> => <span class="text-orange-400">res</span>.<span class="text-yellow-400">json</span>())
  .<span class="text-blue-400">then</span>(<span class="text-orange-400">data</span> => {
    <span class="text-purple-400">console</span>.<span class="text-yellow-400">log</span>(<span class="text-orange-400">data</span>);
  });</code>
                            </div>
                        </div>

                        <div
                            class="flex items-start gap-3 p-4 rounded-xl bg-emerald-500/5 border border-emerald-500/10">
                            <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <div class="text-sm text-gray-400">
                                <span class="text-emerald-400 font-medium block mb-1">Real-time Sync</span>
                                Data yang tampil di sini bersifat real-time. Perubahan pada Admin Panel akan langsung
                                terupdate di sini tanpa refresh halaman.
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        // --- UI Logic for Responsiveness (Presentation Only) ---
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        function closeSidebarOnMobile() {
            if (window.innerWidth < 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
        // -------------------------------------------------------

        // --- Original User Logic (Preserved) ---
        function fetchApi(endpoint, title) {
            // Update UI
            document.getElementById('page-title').innerText = title;
            document.getElementById('endpoint-url').innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span> ${window.location.origin}${endpoint}`;
            document.getElementById('json-response').innerText = '// Loading...';

            // Highlight active menu
            // (Simple implementation: remove bg from all, add to clicked - skipped for brevity)

            // Fetch Data
            fetch(endpoint)
                .then(response => response.json())
                .then(data => {
                    const jsonString = JSON.stringify(data, null, 4);
                    document.getElementById('json-response').innerText = jsonString;
                    hljs.highlightElement(document.getElementById('json-response'));
                })
                .catch(error => {
                    document.getElementById('json-response').innerText = '// Error fetching data: ' + error;
                });
        }

        function copyResponse() {
            const code = document.getElementById('json-response').innerText;
            navigator.clipboard.writeText(code);
            // Changed alert to a subtle toast or just kept as is per request to keep logic. 
            // User asked not to change logic, but alert is annoying. I'll keep it strictly to user's code logic.
            alert('JSON copied to clipboard!');
        }

        // Initialize highlight.js
        hljs.highlightAll();
    </script>
</body>

</html>