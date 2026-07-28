<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar & Footer - Sistem Nilai Guru</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #faf8f5;
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- HEADER / NAVBAR -->
    <header class="sticky top-0 z-30 bg-white border-b border-slate-100 shadow-sm px-4 lg:px-8 py-2.5">
        <div class="w-full max-w-[1600px] mx-auto flex items-center justify-between">
            <!-- Logo & Portal Branding -->
            <a href="{{ url('/admin/dashboard') }}" class="flex shrink-0 items-center gap-3 text-decoration-none">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-700 rounded-xl flex items-center justify-center text-white shadow-md shadow-orange-600/30 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <div class="hidden sm:block leading-tight">
                    <h1 class="text-sm font-extrabold text-slate-800 lg:text-base tracking-tight">EDUGRADES</h1>
                    <p class="text-[10px] font-semibold text-orange-600 uppercase tracking-wider">Teacher Portal</p>
                </div>
            </a>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-3">
                <!-- Dashboard -->
                <div class="relative py-2">
                    <a href="#" class="flex items-center space-x-2 px-3 py-1.5 text-sm font-bold text-orange-600">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-orange-500 rounded-full"></div>
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
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">Kelola Guru</a>
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">Verifikasi Guru</a>
                        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-slate-700 hover:bg-orange-50 hover:text-orange-600">Kelola Guru Kelas</a>
                    </div>
                </div>

                <!-- Siswa Menu -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>Siswa</span>
                </a>

                <!-- Mata Pelajaran Menu -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span>Mata Pelajaran</span>
                </a>

                <!-- Nilai Menu -->
                <a href="#" class="flex items-center space-x-1.5 px-3 py-1.5 text-sm font-medium text-slate-600 hover:text-orange-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span>Nilai</span>
                </a>
            </nav>

            <!-- Profil Administrator & Tombol Keluar -->
            <div class="flex items-center space-x-3">
                <!-- Avatar User -->
                <div class="flex items-center space-x-2.5">
                    <div class="w-9 h-9 rounded-full bg-orange-500 text-white font-semibold text-sm flex items-center justify-center shadow-inner">
                        A
                    </div>
                    <div class="hidden sm:block text-left leading-tight">
                        <p class="text-xs font-bold text-slate-800">Administrator</p>
                        <p class="text-[11px] text-slate-400">Admin</p>
                    </div>
                </div>

                <!-- Tombol Keluar (Logout) -->
                <form action="{{ route('logout') }}" method="POST" class="inline pl-2 border-l border-slate-200">
                    <button type="submit" class="flex items-center space-x-1.5 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold rounded-lg transition-colors border border-rose-200" title="Keluar Sistem">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span class="hidden md:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- KONTEN UTAMA KOSONG -->
    <main class="w-full max-w-[1600px] mx-auto px-4 lg:px-8 py-10 flex-grow text-center text-slate-400 text-sm">
        <p>[ Area Konten Utama ]</p>
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