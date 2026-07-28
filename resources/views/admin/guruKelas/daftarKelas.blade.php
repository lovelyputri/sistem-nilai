<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Nilai Guru - Kelola Guru Kelas</title>
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
                    <a href="#" class="flex items-center space-x-2 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Guru Dropdown Menu (Active) -->
                <div class="relative group py-2">
                    <button class="flex items-center space-x-1 px-3 py-1.5 text-sm font-bold text-orange-600 bg-orange-50/80 rounded-lg">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Guru</span>
                        <svg class="w-3.5 h-3.5 text-orange-500 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 hidden group-hover:block transition-all z-50">
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">Kelola Guru</a>
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">Verifikasi Guru</a>
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-orange-600 bg-orange-50">Kelola Guru Kelas</a>
                    </div>
                </div>

                <!-- Siswa -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    <span>Siswa</span>
                </a>

                <!-- Mata Pelajaran -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Mata Pelajaran</span>
                </a>

                <!-- Nilai -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600 transition-colors">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Nilai</span>
                </a>
            </nav>

            <!-- Profil Administrator & Tombol Keluar -->
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

                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="w-full max-w-[1600px] mx-auto px-4 lg:px-8 py-6 flex-grow space-y-6">

        <!-- BREADCRUMB, HEADER & TOMBOL TAMBAH PENUGASAN -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1.5">
                <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="#" class="hover:text-orange-600">Dashboard</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li><span class="text-slate-600">Guru</span></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="font-medium text-slate-800">Kelola Guru Kelas</li>
                    </ol>
                </nav>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Kelola Guru Kelas</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola penugasan guru ke kelas. Satu guru dapat mengajar lebih dari satu mata pelajaran dan beberapa kelas.</p>
                </div>
            </div>
            <div>
                <a href="#" class="inline-flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Penugasan</span>
                </a>
            </div>
        </div>

        <!-- LAYOUT: FILTER DI KIRI (3 cols) & TABEL DI KANAN (9 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- FILTER SIDEBAR DI KIRI -->
            <div class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <button class="text-xs text-orange-600 hover:underline font-semibold">Reset</button>
                </div>

                <!-- Pilih Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Pilih Guru</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Guru</option>
                        <option>Ahmad Santoso</option>
                        <option>Siti Nurhaliza</option>
                        <option>Dimas Pratama</option>
                    </select>
                </div>

                <!-- Cari Guru / Kelas / Mapel -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru / Kelas / Mapel</label>
                    <div class="relative">
                        <input type="text" placeholder="Ketik nama, mapel, kelas..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Non Aktif</option>
                    </select>
                </div>

                <button class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>

            <!-- TABLE CONTENT DI KANAN (9 cols) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                <th class="py-3 px-4 pl-5">No</th>
                                <th class="py-3 px-4">Guru</th>
                                <th class="py-3 px-4">Mata Pelajaran</th>
                                <th class="py-3 px-4">Kelas</th>
                                <th class="py-3 px-4 text-center">Jumlah Kelas</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">1</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">AS</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Ahmad Santoso</p>
                                            <p class="text-[11px] text-slate-400">NIP. 198505152010011002</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-sky-50 text-sky-600 border border-sky-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Matematika</span>
                                        <span class="bg-purple-50 text-purple-600 border border-purple-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Informatika</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">3</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">2</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">SN</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Siti Nurhaliza</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199002102015032001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Bahasa Indonesia</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 2</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">2</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">3</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">DP</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Dimas Pratama</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199103202016041005</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-amber-50 text-amber-600 border border-amber-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">IPA</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">1</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">4</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">NA</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Nabila Azzahra</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199304152017052003</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-purple-50 text-purple-600 border border-purple-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Bahasa Inggris</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">2</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">5</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">RM</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Rizky Maulana</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199507252018061004</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-orange-50 text-orange-600 border border-orange-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">IPS</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">3</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 6 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">6</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">DL</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Dewi Lestari</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199308202019072005</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-teal-50 text-teal-600 border border-teal-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">PKn</span>
                                        <span class="bg-indigo-50 text-indigo-600 border border-indigo-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Sosiologi</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">1</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        Menampilkan 1 - 6 dari 6 data
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 disabled:opacity-40">&lt;</button>
                            <button class="w-7 h-7 rounded-lg bg-orange-500 text-white font-semibold flex items-center justify-center shadow-sm">1</button>
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50">&gt;</button>
                        </div>
                        <div>
                            <select class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-2.5 py-1.5 text-slate-600 focus:outline-none">
                                <option>10 / halaman</option>
                                <option>25 / halaman</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="mt-auto bg-white border-t border-slate-100 py-3.5 px-4 lg:px-8 text-xs text-slate-400">
        <div class="w-full max-w-[1600px] mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; 2024 EDUGRADES. All rights reserved.</p>
            <p class="font-semibold text-slate-400">Versi 1.0.0</p>
        </div>
    </footer>

</body>
</html>