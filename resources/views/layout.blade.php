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

        /* Animasi mobile menu */
        #mobileMenu {
            transition: all 0.25s ease;
        }

        #mobileMenu.hidden-menu {
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
        }

        #mobileMenu.show-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* Animasi dropdown guru mobile */
        #mobileGuruMenu {
            transition: all 0.2s ease;
        }

        .rotate-arrow {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- ========================================================= -->
    <!-- HEADER / NAVBAR -->
    <!-- ========================================================= -->
    <header class="sticky top-0 z-30 bg-white border-b border-slate-100 shadow-sm px-4 lg:px-8 py-3">

        <div class="w-full mx-auto flex items-center justify-between gap-3">

            <!-- ================================================= -->
            <!-- LOGO -->
            <!-- ================================================= -->
            <div class="flex items-center space-x-3 min-w-0">

                <div class="w-10 h-10 flex-shrink-0 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white shadow-md shadow-orange-500/30">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>

                    </svg>
                </div>

                <div class="min-w-0">
                    <h1 class="font-extrabold text-slate-800 text-base leading-tight tracking-tight">
                        EDUGRADES
                    </h1>

                    <p class="text-[10px] font-bold text-orange-600 uppercase tracking-wider">
                        Teacher Portal
                    </p>
                </div>

            </div>


            <!-- ================================================= -->
            <!-- DESKTOP NAVIGATION -->
            <!-- Tetap sama seperti style sebelumnya -->
            <!-- ================================================= -->
            <nav class="hidden md:flex items-center space-x-1 lg:space-x-3">

                <!-- Dashboard -->
                <div class="relative py-2">

                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center space-x-2 px-3 py-1.5 text-sm rounded-lg transition-colors
                       {{ request()->routeIs('admin.dashboard')
                            ? 'font-bold text-orange-600 bg-orange-50/80'
                            : 'font-medium text-slate-600 hover:text-orange-600' }}">

                        <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-orange-500' : 'text-slate-400' }}"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>

                        </svg>

                        <span>Dashboard</span>
                    </a>

                </div>


                <!-- Guru Dropdown -->
                @php
                    $guruAktif = request()->routeIs('admin.guru.*') ||
                                 request()->routeIs('admin.guruKelas.*');
                @endphp

                <div class="relative group py-2">

                    <button type="button"
                            class="flex items-center space-x-1 px-3 py-1.5 text-sm rounded-lg transition-colors
                            {{ $guruAktif
                                ? 'font-bold text-orange-600 bg-orange-50/80'
                                : 'font-medium text-slate-600 hover:text-orange-600' }}">

                        <svg class="w-4 h-4 {{ $guruAktif ? 'text-orange-500' : 'text-slate-400 group-hover:text-orange-500' }}"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>

                        </svg>

                        <span>Guru</span>

                        <svg class="w-3.5 h-3.5 ml-0.5 transition-transform group-hover:rotate-180 {{ $guruAktif ? 'text-orange-500' : 'text-slate-400 group-hover:text-orange-500' }}"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </button>


                    <!-- Dropdown Guru Desktop -->
                    <div class="absolute left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-100 py-1.5 hidden group-hover:block transition-all z-50">

                        <a href="{{ route('admin.guru.index') }}"
                           class="flex items-center px-4 py-2 text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guru.index')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-700' }}">
                            Kelola Guru
                        </a>

                        {{-- <a href="{{ route('admin.guruKelas.index') }}"
                           class="flex items-center px-4 py-2 text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guruKelas.index')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-700' }}">
                            Verifikasi Guru
                        </a> --}}

                        <a href="{{ route('admin.guruKelas.daftarKelas') }}"
                           class="flex items-center px-4 py-2 text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guruKelas.daftarKelas')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-700' }}">
                            Kelola Guru Kelas
                        </a>

                    </div>

                </div>


                <!-- Siswa -->
                <a href="{{ route('admin.siswa.index') }}"
                   class="flex items-center space-x-1.5 px-3 py-1.5 text-sm rounded-lg transition-colors
                   {{ request()->routeIs('admin.siswa.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:text-orange-600' }}">

                    <svg class="w-4 h-4 {{ request()->routeIs('admin.siswa.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 14l9-5-9-5-9 5 9 5z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>

                    </svg>

                    <span>Siswa</span>

                </a>


                <!-- Mata Pelajaran -->
                <a href="{{ route('admin.mapel.index') }}"
                   class="flex items-center space-x-1.5 px-3 py-1.5 text-sm rounded-lg transition-colors
                   {{ request()->routeIs('admin.mapel.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:text-orange-600' }}">

                    <svg class="w-4 h-4 {{ request()->routeIs('admin.mapel.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>

                    </svg>

                    <span>Mata Pelajaran</span>

                </a>


                <!-- Nilai -->
                <a href="{{ route('admin.nilai.index') }}"
                   class="flex items-center space-x-1.5 px-3 py-1.5 text-sm rounded-lg transition-colors
                   {{ request()->routeIs('admin.nilai.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:text-orange-600' }}">

                    <svg class="w-4 h-4 {{ request()->routeIs('admin.nilai.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>

                    </svg>

                    <span>Nilai</span>

                </a>

            </nav>


            <!-- ================================================= -->
            <!-- PROFILE + LOGOUT DESKTOP -->
            <!-- ================================================= -->
            <div class="hidden sm:flex items-center space-x-3">

                <div class="flex items-center space-x-2.5 pr-3 border-r border-slate-200">

                    <div class="w-9 h-9 rounded-full bg-orange-500 text-white font-semibold text-sm flex items-center justify-center shadow-sm">
                        A
                    </div>

                    <div class="hidden lg:block text-left leading-tight">

                        <p class="text-xs font-bold text-slate-800">
                            Administrator
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Admin
                        </p>

                    </div>

                </div>


                <!-- Logout -->
                <form action="{{ route('logout') ?? '#' }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition-colors">

                        <svg class="w-3.5 h-3.5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>

                        </svg>

                        <span class="hidden lg:inline">
                            Logout
                        </span>

                    </button>

                </form>

            </div>


            <!-- ================================================= -->
            <!-- MOBILE: PROFILE + HAMBURGER -->
            <!-- ================================================= -->
            <div class="flex md:hidden items-center gap-2">

                <!-- Avatar -->
                <div class="w-9 h-9 rounded-full bg-orange-500 text-white font-semibold text-sm flex items-center justify-center shadow-sm">
                    A
                </div>


                <!-- Hamburger -->
                <button id="menuButton"
                        type="button"
                        aria-label="Buka menu"
                        aria-expanded="false"
                        class="w-10 h-10 rounded-lg flex items-center justify-center text-slate-600 hover:bg-orange-50 hover:text-orange-600 transition-colors">

                    <!-- Icon hamburger -->
                    <svg id="menuOpenIcon"
                         class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>


                    <!-- Icon close -->
                    <svg id="menuCloseIcon"
                         class="hidden w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>

                    </svg>

                </button>

            </div>

        </div>


        <!-- ===================================================== -->
        <!-- MOBILE NAVIGATION -->
        <!-- ===================================================== -->
        <div id="mobileMenu"
             class="md:hidden hidden-menu mt-3 border-t border-slate-100 pt-3">

            <div class="space-y-1">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                   {{ request()->routeIs('admin.dashboard')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}">

                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>

                    </svg>

                    <span>Dashboard</span>

                </a>


                <!-- Guru Mobile -->
                <div>

                    <button id="mobileGuruButton"
                            type="button"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-colors
                            {{ $guruAktif
                                ? 'font-bold text-orange-600 bg-orange-50/80'
                                : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}">

                        <div class="flex items-center gap-3">

                            <svg class="w-5 h-5 {{ $guruAktif ? 'text-orange-500' : 'text-slate-400' }}"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>

                            </svg>

                            <span>Guru</span>

                        </div>

                        <svg id="mobileGuruArrow"
                             class="w-4 h-4 transition-transform {{ $guruAktif ? 'rotate-arrow text-orange-500' : 'text-slate-400' }}"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>

                        </svg>

                    </button>


                    <!-- Submenu Guru Mobile -->
                    <div id="mobileGuruMenu"
                         class="{{ $guruAktif ? '' : 'hidden' }} ml-4 mt-1 pl-4 border-l-2 border-orange-100 space-y-1">

                        <a href="{{ route('admin.guru.index') }}"
                           class="block px-3 py-2 rounded-lg text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guru.index')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-600' }}">
                            Kelola Guru
                        </a>

                        {{-- <a href="{{ route('admin.guruKelas.index') }}"
                           class="block px-3 py-2 rounded-lg text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guruKelas.index')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-600' }}">
                            Verifikasi Guru
                        </a> --}}

                        <a href="{{ route('admin.guruKelas.daftarKelas') }}"
                           class="block px-3 py-2 rounded-lg text-xs font-medium hover:bg-orange-50 hover:text-orange-600
                           {{ request()->routeIs('admin.guruKelas.daftarKelas')
                                ? 'text-orange-600 bg-orange-50/60'
                                : 'text-slate-600' }}">
                            Kelola Guru Kelas
                        </a>

                    </div>

                </div>


                <!-- Siswa -->
                <a href="{{ route('admin.siswa.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                   {{ request()->routeIs('admin.siswa.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}">

                    <svg class="w-5 h-5 {{ request()->routeIs('admin.siswa.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 14l9-5-9-5-9 5 9 5z"/>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>

                    </svg>

                    <span>Siswa</span>

                </a>


                <!-- Mata Pelajaran -->
                <a href="{{ route('admin.mapel.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                   {{ request()->routeIs('admin.mapel.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}">

                    <svg class="w-5 h-5 {{ request()->routeIs('admin.mapel.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>

                    </svg>

                    <span>Mata Pelajaran</span>

                </a>


                <!-- Nilai -->
                <a href="{{ route('admin.nilai.index') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors
                   {{ request()->routeIs('admin.nilai.*')
                        ? 'font-bold text-orange-600 bg-orange-50/80'
                        : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}">

                    <svg class="w-5 h-5 {{ request()->routeIs('admin.nilai.*') ? 'text-orange-500' : 'text-slate-400' }}"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>

                    </svg>

                    <span>Nilai</span>

                </a>


                <!-- Garis pemisah -->
                <div class="border-t border-slate-100 my-2"></div>


                <!-- Info Admin -->
                <div class="flex items-center gap-3 px-3 py-2.5">

                    <div class="w-9 h-9 rounded-full bg-orange-500 text-white font-semibold text-sm flex items-center justify-center shadow-sm">
                        A
                    </div>

                    <div class="leading-tight">

                        <p class="text-xs font-bold text-slate-800">
                            Administrator
                        </p>

                        <p class="text-[11px] text-slate-400">
                            Admin
                        </p>

                    </div>

                </div>


                <!-- Logout Mobile -->
                <form action="{{ route('logout') ?? '#' }}"
                      method="POST"
                      class="pt-1">

                    @csrf

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-lg text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition-colors">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>

                        </svg>

                        <span>Logout</span>

                    </button>

                </form>

            </div>

        </div>

    </header>


    <!-- ========================================================= -->
    <!-- CONTENT -->
    <!-- ========================================================= -->
    <main class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow">
        @yield('content')
    </main>


    <!-- ========================================================= -->
    <!-- FOOTER -->
    <!-- ========================================================= -->
    <footer class="mt-auto bg-white border-t border-slate-100 py-3 px-4 lg:px-8 text-xs text-slate-400">

        <div class="w-full mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">

            <p>
                &copy; 2024 Sistem Nilai Guru. All rights reserved.
            </p>

            <p class="font-medium text-slate-400">
                Versi 1.0.0
            </p>

        </div>

    </footer>


    <!-- ========================================================= -->
    <!-- JAVASCRIPT RESPONSIVE NAVBAR -->
    <!-- ========================================================= -->
    <script>

        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        const menuOpenIcon = document.getElementById('menuOpenIcon');
        const menuCloseIcon = document.getElementById('menuCloseIcon');


        /*
         * Buka / tutup mobile navbar
         */
        menuButton.addEventListener('click', function () {

            const isOpen = menuButton.getAttribute('aria-expanded') === 'true';

            if (isOpen) {

                mobileMenu.classList.remove('show-menu');
                mobileMenu.classList.add('hidden-menu');

                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 200);

                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');

                menuButton.setAttribute('aria-expanded', 'false');

            } else {

                mobileMenu.classList.remove('hidden');

                /*
                 * Delay kecil supaya animasi bekerja
                 */
                requestAnimationFrame(() => {
                    mobileMenu.classList.remove('hidden-menu');
                    mobileMenu.classList.add('show-menu');
                });

                menuOpenIcon.classList.add('hidden');
                menuCloseIcon.classList.remove('hidden');

                menuButton.setAttribute('aria-expanded', 'true');
            }

        });


        /*
         * Dropdown Guru Mobile
         */
        const mobileGuruButton = document.getElementById('mobileGuruButton');
        const mobileGuruMenu = document.getElementById('mobileGuruMenu');
        const mobileGuruArrow = document.getElementById('mobileGuruArrow');


        mobileGuruButton.addEventListener('click', function () {

            mobileGuruMenu.classList.toggle('hidden');

            mobileGuruArrow.classList.toggle('rotate-arrow');

        });


        /*
         * Jika layar kembali ke desktop,
         * tutup mobile menu otomatis.
         */
        window.addEventListener('resize', function () {

            if (window.innerWidth >= 768) {

                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show-menu');
                mobileMenu.classList.add('hidden-menu');

                menuOpenIcon.classList.remove('hidden');
                menuCloseIcon.classList.add('hidden');

                menuButton.setAttribute('aria-expanded', 'false');

            }

        });

    </script>

</body>
</html>
