<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Guru - Portal Administrasi</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #f97316;
            --text-dark: #1e293b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #faf8f5;
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- HEADER / NAVBAR -->
    <header class="sticky top-0 z-30 bg-white border-b border-slate-100 shadow-sm px-4 lg:px-8 py-3">
        <div class="w-full max-w-[1600px] mx-auto flex items-center justify-between">
            
            <!-- Logo & Portal Branding -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-extrabold text-slate-800 text-base leading-tight tracking-tight">EDUGRADES</h1>
                    <p class="text-[10px] font-bold text-orange-600 uppercase tracking-wider">Teacher Portal</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-3">
                <!-- Dashboard -->
                <div class="relative py-2">
                    <a href="{{ route('admin.dashboard') }}"class="flex items-center space-x-2 px-3 py-1.5 text-sm font-bold text-orange-600 bg-orange-50/80 rounded-lg">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Guru Dropdown Menu -->
                <div class="relative group py-2">
                    <button class="flex items-center space-x-1 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Guru</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-orange-500 ml-0.5 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Sub-menu Dropdown Guru -->
                    <div class="absolute left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 hidden group-hover:block transition-all z-50">
                        <a href="{{ route('admin.guruKelas.index') }}" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">
                            Kelola Guru
                        </a>
                        <a href="{{ route('admin.guru.index') }}" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">
                            Verifikasi Guru
                        </a>
                        <a href="{{ route('admin.guruKelas.daftarKelas') }}" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">
                            Kelola Guru Kelas
                        </a>
                    </div>
                </div>

                <!-- Siswa Menu -->
                <a href="{{ route('admin.siswa.index') }}" 
                   class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    <span>Siswa</span>
                </a>

                <!-- Mata Pelajaran Menu -->
                <a href="{{ route('admin.mapel.index') }}" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Mata Pelajaran</span>
                </a>

                <!-- Nilai Menu -->
                <a href="{{ route('admin.nilai.index') }}" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Nilai</span>
                </a>
            </nav>

            <!-- Profil Administrator & Tombol Logout -->
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-2.5 pr-3 border-r border-slate-200">
                    <div class="w-9 h-9 rounded-full bg-orange-500 text-white font-semibold text-sm flex items-center justify-center shadow-sm">
                        A
                    </div>
                    <div class="hidden sm:block text-left leading-tight">
                        <p class="text-xs font-bold text-slate-800">Administrator</p>
                        <p class="text-[11px] text-slate-400">Admin</p>
                    </div>
                </div>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') ?? '#' }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- UTAMA CONTENT CONTAINER -->
    <main class="w-full max-w-[1600px] mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BANNER SELAMAT DATANG -->
        <div class="relative bg-gradient-to-r from-orange-50 via-orange-50/40 to-amber-50/60 rounded-2xl p-6 lg:px-8 lg:py-6 border border-orange-100/80 flex flex-col md:flex-row items-center justify-between overflow-hidden shadow-sm">
            <div class="z-10 space-y-1.5 max-w-2xl">
                <h2 class="text-xl lg:text-2xl font-bold text-slate-800 flex items-center gap-2">
                    Selamat datang, Administrator! <span class="inline-block text-xl">👋</span>
                </h2>
                <p class="text-xs lg:text-sm text-slate-500 font-normal">
                    Pantau dan kelola seluruh aktivitas akademik dari satu tempat.
                </p>
            </div>
            
            <div class="mt-4 md:mt-0 relative flex items-center justify-end shrink-0 pr-4">
                <div class="w-64 h-24 flex items-center justify-center relative">
                    <svg class="w-16 h-20 absolute -left-2 bottom-0" viewBox="0 0 100 120" fill="none">
                        <path d="M35 85 L65 85 L60 115 L40 115 Z" fill="#F97316"/>
                        <path d="M30 85 L70 85 L70 90 L30 90 Z" fill="#EA580C"/>
                        <path d="M50 85 Q 20 60 25 35 Q 45 45 50 85 Z" fill="#10B981"/>
                        <path d="M50 85 Q 80 60 75 35 Q 55 45 50 85 Z" fill="#059669"/>
                        <path d="M50 85 Q 50 20 50 15 Q 60 40 50 85 Z" fill="#34D399"/>
                    </svg>
                    <div class="bg-white rounded-lg shadow-md border border-slate-200 p-2.5 w-44 space-y-2 ml-10">
                        <div class="flex items-center space-x-1.5 border-b border-slate-100 pb-1">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="flex space-x-2 items-center">
                            <div class="w-7 h-7 rounded bg-orange-100 flex items-center justify-center">
                                <div class="w-3 h-3 border-2 border-orange-500 rounded-full"></div>
                            </div>
                            <div class="space-y-1 flex-1">
                                <div class="h-1.5 bg-slate-200 rounded w-full"></div>
                                <div class="h-1.5 bg-slate-100 rounded w-2/3"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-8 h-8 rounded-full border-4 border-orange-500 border-t-amber-400"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5 METRIC CARDS ATAS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Card 1: Total Guru -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold text-slate-500">
                            Total Guru
                        </span>
                    </div>

                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">
                            {{ $statistik['total_guru'] }}
                        </span>

                        <span class="text-[11px] text-slate-400 font-normal">
                            Guru Aktif
                        </span>
                    </div>
                </div>

                <div class="mt-3 flex items-center justify-between">
                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1"
                    >
                        Lihat Detail &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 2: Total Siswa -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Total Siswa</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistik['total_siswa'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Siswa Terdaftar</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.siswa.index') }}" class="text-xs font-semibold text-emerald-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 3: Mata Pelajaran -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Mata Pelajaran</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">15</span>
                        <span class="text-[11px] text-slate-400 font-normal">Mata Pelajaran</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.mapel.index') }}" class="text-xs font-semibold text-amber-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 4: Total Nilai -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Total Nilai</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistik['total_nilai'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Data Nilai</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.nilai.index') }}" class="text-xs font-semibold text-blue-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 5: Rata-rata Nilai -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center text-purple-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Rata-rata Nilai</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistikNilai['rata_rata'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Keseluruhan</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.nilai.index') }}" class="text-xs font-semibold text-purple-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- ROW 2: RINGKASAN NILAI, DONUT CHART & TABEL RANKING SISWA -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">
            
            <!-- Card 1: Ringkasan Nilai & Bar Chart (4 cols) -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm">Ringkasan Nilai</h3>
                        </div>
                        <div class="flex items-center space-x-1 border border-slate-200 px-2 py-0.5 rounded text-xs text-slate-600 bg-white">
                            <span class="text-[11px]">Tahun Ajaran</span>
                            <span class="font-semibold text-[11px]">2024/2025</span>
                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 mb-5">
                        <div class="bg-emerald-50/60 p-2.5 rounded-lg border border-emerald-100/80 text-center">
                            <p class="text-[11px] font-medium text-emerald-600">Nilai Tertinggi</p>
                            <p class="text-xl font-bold text-emerald-600 mt-0.5">100</p>
                            <p class="text-[10px] text-emerald-500">Siswa</p>
                        </div>
                        <div class="bg-rose-50/60 p-2.5 rounded-lg border border-rose-100/80 text-center">
                            <p class="text-[11px] font-medium text-rose-600">Nilai Terendah</p>
                            <p class="text-xl font-bold text-rose-600 mt-0.5">20</p>
                            <p class="text-[10px] text-rose-500">Siswa</p>
                        </div>
                        <div class="bg-sky-50/60 p-2.5 rounded-lg border border-sky-100/80 text-center">
                            <p class="text-[11px] font-medium text-sky-600">Rata-rata Nilai</p>
                            <p class="text-xl font-bold text-sky-600 mt-0.5">78.45</p>
                            <p class="text-[10px] text-sky-500">Keseluruhan</p>
                        </div>
                        <div class="bg-purple-50/60 p-2.5 rounded-lg border border-purple-100/80 text-center">
                            <p class="text-[11px] font-medium text-purple-600">Siswa dengan Nilai</p>
                            <p class="text-xl font-bold text-purple-600 mt-0.5">256</p>
                            <p class="text-[10px] text-purple-500">Siswa</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-800 mb-3">Distribusi Nilai</h4>
                        <div class="relative pt-6 pb-2 border-b border-slate-200">
                            <div class="absolute inset-0 flex flex-col justify-between text-[10px] text-slate-300 pointer-events-none pb-5">
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">80</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">60</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">40</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">20</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">0</span><div class="w-full border-t border-slate-200"></div></div>
                            </div>

                            <div class="flex items-end justify-between pl-6 pr-2 h-36 relative z-10 space-x-2">
                                <div class="flex-1 flex flex-col items-center justify-end h-full">
                                    <span class="text-[10px] font-bold text-slate-700 mb-1">5</span>
                                    <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: 8%;"></div>
                                    <span class="text-[10px] text-slate-400 mt-2 font-medium">0 - 20</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-end h-full">
                                    <span class="text-[10px] font-bold text-slate-700 mb-1">18</span>
                                    <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: 22%;"></div>
                                    <span class="text-[10px] text-slate-400 mt-2 font-medium">21 - 40</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-end h-full">
                                    <span class="text-[10px] font-bold text-slate-700 mb-1">45</span>
                                    <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: 48%;"></div>
                                    <span class="text-[10px] text-slate-400 mt-2 font-medium">41 - 60</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-end h-full">
                                    <span class="text-[10px] font-bold text-slate-700 mb-1">112</span>
                                    <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: 90%;"></div>
                                    <span class="text-[10px] text-slate-400 mt-2 font-medium">61 - 80</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center justify-end h-full">
                                    <span class="text-[10px] font-bold text-slate-700 mb-1">76</span>
                                    <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: 68%;"></div>
                                    <span class="text-[10px] text-slate-400 mt-2 font-medium">81 - 100</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-[10px] text-slate-400 mt-2 font-medium">Rentang Nilai</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Nilai per Mata Pelajaran Donut Chart (4 cols) -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Nilai per Mata Pelajaran</h3>
                    </div>

                    <!-- Donut Chart & Total Nilai di Bawahnya -->
                    <div class="flex flex-col items-center justify-center my-3">
                        <div class="relative w-32 h-32 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="38" stroke="#f1f5f9" stroke-width="12" fill="none" />
                                <circle cx="50" cy="50" r="38" stroke="#3b82f6" stroke-width="12" fill="none" stroke-dasharray="25 214" stroke-dashoffset="0" />
                                <circle cx="50" cy="50" r="38" stroke="#1d4ed8" stroke-width="12" fill="none" stroke-dasharray="15 224" stroke-dashoffset="-25" />
                                <circle cx="50" cy="50" r="38" stroke="#60a5fa" stroke-width="12" fill="none" stroke-dasharray="12 227" stroke-dashoffset="-40" />
                                <circle cx="50" cy="50" r="38" stroke="#38bdf8" stroke-width="12" fill="none" stroke-dasharray="11 228" stroke-dashoffset="-52" />
                                <circle cx="50" cy="50" r="38" stroke="#0284c7" stroke-width="12" fill="none" stroke-dasharray="10 229" stroke-dashoffset="-63" />
                                <circle cx="50" cy="50" r="38" stroke="#0369a1" stroke-width="12" fill="none" stroke-dasharray="9 230" stroke-dashoffset="-73" />
                                <circle cx="50" cy="50" r="38" stroke="#f97316" stroke-width="12" fill="none" stroke-dasharray="9 230" stroke-dashoffset="-82" />
                                <circle cx="50" cy="50" r="38" stroke="#ea580c" stroke-width="12" fill="none" stroke-dasharray="9 230" stroke-dashoffset="-91" />
                                <circle cx="50" cy="50" r="38" stroke="#c2410c" stroke-width="12" fill="none" stroke-dasharray="8 231" stroke-dashoffset="-100" />
                                <circle cx="50" cy="50" r="38" stroke="#f59e0b" stroke-width="12" fill="none" stroke-dasharray="8 231" stroke-dashoffset="-108" />
                                <circle cx="50" cy="50" r="38" stroke="#d97706" stroke-width="12" fill="none" stroke-dasharray="8 231" stroke-dashoffset="-116" />
                                <circle cx="50" cy="50" r="38" stroke="#b45309" stroke-width="12" fill="none" stroke-dasharray="7 232" stroke-dashoffset="-124" />
                                <circle cx="50" cy="50" r="38" stroke="#10b981" stroke-width="12" fill="none" stroke-dasharray="7 232" stroke-dashoffset="-131" />
                                <circle cx="50" cy="50" r="38" stroke="#059669" stroke-width="12" fill="none" stroke-dasharray="7 232" stroke-dashoffset="-138" />
                                <circle cx="50" cy="50" r="38" stroke="#047857" stroke-width="12" fill="none" stroke-dasharray="6 233" stroke-dashoffset="-145" />
                                <circle cx="50" cy="50" r="38" stroke="#8b5cf6" stroke-width="12" fill="none" stroke-dasharray="6 233" stroke-dashoffset="-151" />
                                <circle cx="50" cy="50" r="38" stroke="#7c3aed" stroke-width="12" fill="none" stroke-dasharray="6 233" stroke-dashoffset="-157" />
                                <circle cx="50" cy="50" r="38" stroke="#6d28d9" stroke-width="12" fill="none" stroke-dasharray="5 234" stroke-dashoffset="-163" />
                                <circle cx="50" cy="50" r="38" stroke="#ec4899" stroke-width="12" fill="none" stroke-dasharray="5 234" stroke-dashoffset="-168" />
                                <circle cx="50" cy="50" r="38" stroke="#db2777" stroke-width="12" fill="none" stroke-dasharray="5 234" stroke-dashoffset="-173" />
                                <circle cx="50" cy="50" r="38" stroke="#14b8a6" stroke-width="12" fill="none" stroke-dasharray="5 234" stroke-dashoffset="-178" />
                                <circle cx="50" cy="50" r="38" stroke="#0d9488" stroke-width="12" fill="none" stroke-dasharray="4 235" stroke-dashoffset="-183" />
                                <circle cx="50" cy="50" r="38" stroke="#64748b" stroke-width="12" fill="none" stroke-dasharray="56 183" stroke-dashoffset="-187" />
                            </svg>
                        </div>
                        <div class="text-center mt-2">
                            <span class="text-base font-extrabold text-slate-800 leading-tight">1.248</span>
                            <span class="text-[10px] text-slate-400 font-medium block">Total Nilai</span>
                        </div>
                    </div>

                    <!-- Scrollable List 24 Mata Pelajaran -->
                    <div class="space-y-1.5 text-xs max-h-48 overflow-y-auto pr-1 border border-slate-100 rounded-lg p-2 bg-slate-50/50">
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-blue-500"></span><span class="text-slate-600 text-[11px]">Matematika</span></div><span class="text-[11px] font-semibold text-slate-500">95 (7.6%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-blue-700"></span><span class="text-slate-600 text-[11px]">Bahasa Indonesia</span></div><span class="text-[11px] font-semibold text-slate-500">80 (6.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-blue-400"></span><span class="text-slate-600 text-[11px]">Bahasa Inggris</span></div><span class="text-[11px] font-semibold text-slate-500">70 (5.6%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-sky-400"></span><span class="text-slate-600 text-[11px]">IPA</span></div><span class="text-[11px] font-semibold text-slate-500">65 (5.2%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-sky-600"></span><span class="text-slate-600 text-[11px]">IPS</span></div><span class="text-[11px] font-semibold text-slate-500">60 (4.8%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-sky-700"></span><span class="text-slate-600 text-[11px]">PKn</span></div><span class="text-[11px] font-semibold text-slate-500">55 (4.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-orange-500"></span><span class="text-slate-600 text-[11px]">Seni Budaya</span></div><span class="text-[11px] font-semibold text-slate-500">55 (4.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-orange-600"></span><span class="text-slate-600 text-[11px]">PJOK</span></div><span class="text-[11px] font-semibold text-slate-500">50 (4.0%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-orange-700"></span><span class="text-slate-600 text-[11px]">Informatika</span></div><span class="text-[11px] font-semibold text-slate-500">48 (3.8%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-amber-500"></span><span class="text-slate-600 text-[11px]">Sejarah</span></div><span class="text-[11px] font-semibold text-slate-500">48 (3.8%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-amber-600"></span><span class="text-slate-600 text-[11px]">Ekonomi</span></div><span class="text-[11px] font-semibold text-slate-500">45 (3.6%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-amber-700"></span><span class="text-slate-600 text-[11px]">Sosiologi</span></div><span class="text-[11px] font-semibold text-slate-500">42 (3.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span><span class="text-slate-600 text-[11px]">Geografi</span></div><span class="text-[11px] font-semibold text-slate-500">40 (3.2%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-emerald-600"></span><span class="text-slate-600 text-[11px]">Kimia</span></div><span class="text-[11px] font-semibold text-slate-500">40 (3.2%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-emerald-700"></span><span class="text-slate-600 text-[11px]">Fisika</span></div><span class="text-[11px] font-semibold text-slate-500">38 (3.0%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-purple-500"></span><span class="text-slate-600 text-[11px]">Biologi</span></div><span class="text-[11px] font-semibold text-slate-500">38 (3.0%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-purple-600"></span><span class="text-slate-600 text-[11px]">PAI</span></div><span class="text-[11px] font-semibold text-slate-500">35 (2.8%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-purple-700"></span><span class="text-slate-600 text-[11px]">Bahasa Arab</span></div><span class="text-[11px] font-semibold text-slate-500">35 (2.8%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-pink-500"></span><span class="text-slate-600 text-[11px]">Kewirausahaan</span></div><span class="text-[11px] font-semibold text-slate-500">30 (2.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-pink-600"></span><span class="text-slate-600 text-[11px]">Seni Musik</span></div><span class="text-[11px] font-semibold text-slate-500">30 (2.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-teal-500"></span><span class="text-slate-600 text-[11px]">TIK</span></div><span class="text-[11px] font-semibold text-slate-500">30 (2.4%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-teal-600"></span><span class="text-slate-600 text-[11px]">Bahasa Mandarin</span></div><span class="text-[11px] font-semibold text-slate-500">25 (2.0%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-slate-500"></span><span class="text-slate-600 text-[11px]">Bahasa Jepang</span></div><span class="text-[11px] font-semibold text-slate-500">25 (2.0%)</span></div>
                        <div class="flex items-center justify-between"><div class="flex items-center space-x-1.5"><span class="w-2 h-2 rounded-full bg-slate-700"></span><span class="text-slate-600 text-[11px]">Seni Rupa</span></div><span class="text-[11px] font-semibold text-slate-500">24 (1.9%)</span></div>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 mt-3">
                    <a href="#" class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 3: Tabel 10 Peringkat Siswa (4 cols) - Sempurna tanpa space kosong -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded bg-amber-100 flex items-center justify-center text-amber-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z"/></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm">10 Peringkat Siswa</h3>
                        </div>
                        <a href="#" class="px-2.5 py-1 border border-orange-500 text-orange-500 text-xs rounded-full font-medium hover:bg-orange-50">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="overflow-x-auto h-[350px] overflow-y-auto pr-1">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 border-b border-slate-100 sticky top-0 bg-white z-10">
                                    <th class="pb-2.5 font-medium">Rank</th>
                                    <th class="pb-2.5 font-medium">Nama Siswa</th>
                                    <th class="pb-2.5 font-medium">Kelas</th>
                                    <th class="pb-2.5 font-medium">Rata-rata</th>
                                    <th class="pb-2.5 font-medium text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr>
                                    <td class="py-2.5 font-bold text-orange-600">#1</td>
                                    <td class="py-2.5 font-medium text-slate-800">Rizky Maulana</td>
                                    <td class="py-2.5">XII-1</td>
                                    <td class="py-2.5 font-semibold">98.50</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-bold text-slate-600">#2</td>
                                    <td class="py-2.5 font-medium text-slate-800">Siti Nurhaliza</td>
                                    <td class="py-2.5">X-2</td>
                                    <td class="py-2.5 font-semibold">97.20</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-bold text-amber-600">#3</td>
                                    <td class="py-2.5 font-medium text-slate-800">Ahmad Fauzan</td>
                                    <td class="py-2.5">X-1</td>
                                    <td class="py-2.5 font-semibold">96.10</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#4</td>
                                    <td class="py-2.5 font-medium text-slate-800">Nabila Azzahra</td>
                                    <td class="py-2.5">XI-2</td>
                                    <td class="py-2.5 font-semibold">95.40</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#5</td>
                                    <td class="py-2.5 font-medium text-slate-800">Dimas Pratama</td>
                                    <td class="py-2.5">XI-1</td>
                                    <td class="py-2.5 font-semibold">94.80</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#6</td>
                                    <td class="py-2.5 font-medium text-slate-800">Dewi Lestari</td>
                                    <td class="py-2.5">X-1</td>
                                    <td class="py-2.5 font-semibold">93.50</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#7</td>
                                    <td class="py-2.5 font-medium text-slate-800">Fajar Hidayat</td>
                                    <td class="py-2.5">XII-1</td>
                                    <td class="py-2.5 font-semibold">92.90</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#8</td>
                                    <td class="py-2.5 font-medium text-slate-800">Putri Rahmawati</td>
                                    <td class="py-2.5">XI-1</td>
                                    <td class="py-2.5 font-semibold">91.75</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#9</td>
                                    <td class="py-2.5 font-medium text-slate-800">Eko Prasetyo</td>
                                    <td class="py-2.5">X-2</td>
                                    <td class="py-2.5 font-semibold">90.50</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2.5 font-medium text-slate-600">#10</td>
                                    <td class="py-2.5 font-medium text-slate-800">Maya Sari</td>
                                    <td class="py-2.5">XI-2</td>
                                    <td class="py-2.5 font-semibold">89.90</td>
                                    <td class="py-2.5 text-center">
                                        <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 mt-2">
                    <a href="#" class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- ROW 3: AKTIVITAS TERBARU & STATISTIK KELAS -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            <!-- Aktivitas Terbaru (6 cols) -->
            <div class="lg:col-span-6 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Aktivitas Terbaru</h3>
                    </div>
                    <a href="#" class="px-2.5 py-1 border border-orange-500 text-orange-500 text-xs rounded-full font-medium hover:bg-orange-50">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3.5">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-800 font-medium leading-snug">
                                <span class="font-semibold text-slate-900">Administrator</span> menambahkan mata pelajaran baru <span class="font-semibold text-slate-900">"Informatika"</span>
                            </p>
                            <p class="text-[11px] text-slate-400 mt-0.5">2 menit yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-800 font-medium leading-snug">
                                <span class="font-semibold text-slate-900">Guru Budi Santoso</span> menginput nilai untuk mata pelajaran <span class="font-semibold text-slate-900">Matematika kelas X-1</span>
                            </p>
                            <p class="text-[11px] text-slate-400 mt-0.5">15 menit yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-800 font-medium leading-snug">
                                <span class="font-semibold text-slate-900">Siswa Dimas Pratama</span> diperbarui datanya
                            </p>
                            <p class="text-[11px] text-slate-400 mt-0.5">1 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Kelas (6 cols) -->
            <div class="lg:col-span-6 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Statistik Kelas</h3>
                    </div>
                    <a href="#" class="px-2.5 py-1 border border-orange-500 text-orange-500 text-xs rounded-full font-medium hover:bg-orange-50">
                        Lihat Semua
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-orange-50/50 p-3 rounded-xl border border-orange-100">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">12</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Total Kelas</p>
                        <p class="text-[10px] text-slate-400">Kelas Aktif</p>
                    </div>

                    <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">8</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas X</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>

                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">3</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas XI</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>

                    <div class="bg-purple-50/50 p-3 rounded-xl border border-purple-100">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">1</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas XII</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="mt-auto bg-white border-t border-slate-100 py-3 px-4 lg:px-8 text-xs text-slate-400">
        <div class="w-full max-w-[1600px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; 2024 Sistem Nilai Guru. All rights reserved.</p>
            <p class="font-medium text-slate-400">Versi 1.0.0</p>
        </div>
    </footer>

</body>
</html>