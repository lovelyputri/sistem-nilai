<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Sistem Nilai Guru - Teacher Portal')
    </title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>

        :root {
            --primary: #f97316;
            --text-dark: #1e293b;
        }

        * {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #faf8f5;
            overflow-x: hidden;
        }

        /*
        |--------------------------------------------------------------------------
        | MOBILE MENU
        |--------------------------------------------------------------------------
        */

        #mobileMenu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transform: translateY(-8px);

            transition:
                max-height 0.25s ease,
                opacity 0.2s ease,
                transform 0.25s ease;
        }

        #mobileMenu.show-menu {
            max-height: 700px;
            opacity: 1;
            transform: translateY(0);
        }

        /*
        |--------------------------------------------------------------------------
        | PREVENT MOBILE MENU FLASH
        |--------------------------------------------------------------------------
        */

        @media (min-width: 768px) {

            #mobileMenu {
                display: none !important;
            }

        }

    </style>

    @stack('styles')

</head>


<body class="text-slate-800 antialiased min-h-screen flex flex-col">


    <!-- ========================================================= -->
    <!-- HEADER -->
    <!-- ========================================================= -->

    <header class="sticky top-0 z-50 bg-white border-b border-slate-100 shadow-sm">

        <div class="w-full px-4 sm:px-6 lg:px-8">

            <div class="min-h-[64px] flex items-center justify-between gap-3">


                <!-- ================================================= -->
                <!-- LOGO -->
                <!-- ================================================= -->

                <div class="flex items-center gap-3 min-w-0">

                    <div
                        class="w-10 h-10 flex-shrink-0 rounded-xl
                               bg-gradient-to-br from-orange-500 to-orange-600
                               flex items-center justify-center
                               text-white shadow-md shadow-orange-500/30"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>

                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>

                        </svg>

                    </div>


                    <div class="min-w-0">

                        <h1
                            class="font-extrabold text-slate-800
                                   text-sm sm:text-base
                                   leading-tight tracking-tight"
                        >
                            EDUGRADES
                        </h1>

                        <p
                            class="text-[9px] sm:text-[10px]
                                   font-bold text-orange-600
                                   uppercase tracking-wider"
                        >
                            Teacher Portal
                        </p>

                    </div>

                </div>


                <!-- ================================================= -->
                <!-- DESKTOP NAVIGATION -->
                <!-- ================================================= -->

                <nav class="hidden md:flex items-center gap-1 lg:gap-1.5">


                    {{-- Dashboard --}}

                    <a
                        href="{{ route('guru.dashboard') }}"
                        class="flex items-center gap-2
                               px-3 py-2
                               rounded-lg
                               text-sm
                               whitespace-nowrap
                               transition-colors duration-200
                               {{ request()->routeIs('guru.dashboard')
                                   ? 'font-bold text-orange-600 bg-orange-50/80'
                                   : 'font-medium text-slate-600 hover:text-orange-600 hover:bg-orange-50/60' }}"
                    >

                        <svg
                            class="w-4 h-4
                                   {{ request()->routeIs('guru.dashboard')
                                       ? 'text-orange-500'
                                       : 'text-slate-400' }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />

                        </svg>

                        <span>
                            Dashboard
                        </span>

                    </a>


                    {{-- Siswa --}}

                    <a
                        href="{{ route('guru.siswa.index') }}"
                        class="flex items-center gap-2
                               px-3 py-2
                               rounded-lg
                               text-sm
                               whitespace-nowrap
                               transition-colors duration-200
                               {{ request()->routeIs('guru.siswa.*')
                                   ? 'font-bold text-orange-600 bg-orange-50/80'
                                   : 'font-medium text-slate-600 hover:text-orange-600 hover:bg-orange-50/60' }}"
                    >

                        <svg
                            class="w-4 h-4
                                   {{ request()->routeIs('guru.siswa.*')
                                       ? 'text-orange-500'
                                       : 'text-slate-400' }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            />

                        </svg>

                        <span>
                            Siswa
                        </span>

                    </a>


                    {{-- Input Nilai --}}

                    <a
                        href="{{ route('guru.rapot.index') }}"
                        class="flex items-center gap-2
                               px-3 py-2
                               rounded-lg
                               text-sm
                               whitespace-nowrap
                               transition-colors duration-200
                               {{ request()->routeIs('guru.nilai.*')
                                   ? 'font-bold text-orange-600 bg-orange-50/80'
                                   : 'font-medium text-slate-600 hover:text-orange-600 hover:bg-orange-50/60' }}"
                    >

                        <svg
                            class="w-4 h-4
                                   {{ request()->routeIs('guru.nilai.*')
                                       ? 'text-orange-500'
                                       : 'text-slate-400' }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707 0.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 01-2 2h-1.586a1 1 0 01-.707-.293L15 16H9"
                            />

                        </svg>

                        <span>
                            Input Nilai
                        </span>

                    </a>


                    {{-- Rapor --}}
                    {{-- Sementara belum ada route --}}

                    <a
                        href="{{ route('guru.rapot.index') }}"
                        onclick="return false;"
                        class="flex items-center gap-2
                               px-3 py-2
                               rounded-lg
                               text-sm
                               whitespace-nowrap
                               font-medium
                               text-slate-600
                               hover:text-orange-600
                               hover:bg-orange-50/60
                               transition-colors duration-200"
                    >

                        <svg
                            class="w-4 h-4 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 2h9l5 5v15a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M14 2v6h6M8 13h8M8 17h5"
                            />

                        </svg>

                        <span>
                            Rapor
                        </span>

                    </a>

                </nav>


                <!-- ================================================= -->
                <!-- DESKTOP PROFILE -->
                <!-- ================================================= -->

                <div class="hidden md:flex items-center gap-3 shrink-0">

                    <div
                        class="flex items-center gap-2.5
                               pr-3
                               border-r border-slate-200"
                    >

                        <div
                            class="w-9 h-9 rounded-full
                                   overflow-hidden
                                   border-2 border-orange-100
                                   shadow-sm
                                   flex-shrink-0
                                   bg-white
                                   flex items-center justify-center"
                        >

                            <span class="text-xs font-extrabold text-orange-600">

                                {{ strtoupper(
                                    substr(
                                        auth()->user()->name ?? 'GU',
                                        0,
                                        2
                                    )
                                ) }}

                            </span>

                        </div>


                        <div class="hidden lg:block text-left leading-tight">

                            <p class="text-xs font-bold text-slate-800">

                                {{ auth()->user()->name ?? 'Guru' }}

                            </p>

                            <p class="text-[11px] text-slate-400">

                                Guru

                            </p>

                        </div>

                    </div>


                    {{-- Logout --}}

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="flex items-center gap-1.5
                                   px-3 py-2
                                   rounded-lg
                                   text-xs font-semibold
                                   text-rose-600
                                   bg-rose-50
                                   hover:bg-rose-100
                                   transition-colors duration-200"
                        >

                            <svg
                                class="w-3.5 h-3.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />

                            </svg>

                            <span class="hidden lg:inline">
                                Logout
                            </span>

                        </button>

                    </form>

                </div>


                <!-- ================================================= -->
                <!-- MOBILE PROFILE + HAMBURGER -->
                <!-- ================================================= -->

                <div class="flex md:hidden items-center gap-2 shrink-0">

                    {{-- Avatar --}}

                    <div
                        class="w-9 h-9 rounded-full
                               overflow-hidden
                               border-2 border-orange-100
                               shadow-sm
                               bg-white
                               flex items-center justify-center"
                    >

                        <span class="text-[10px] font-extrabold text-orange-600">

                            {{ strtoupper(
                                substr(
                                    auth()->user()->name ?? 'GU',
                                    0,
                                    2
                                )
                            ) }}

                        </span>

                    </div>


                    {{-- Hamburger --}}

                    <button
                        id="menuButton"
                        type="button"
                        aria-label="Buka menu"
                        aria-expanded="false"
                        class="w-10 h-10
                               rounded-lg
                               flex items-center justify-center
                               text-slate-600
                               hover:bg-orange-50
                               hover:text-orange-600
                               transition-colors duration-200"
                    >

                        <svg
                            id="menuOpenIcon"
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />

                        </svg>


                        <svg
                            id="menuCloseIcon"
                            class="hidden w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />

                        </svg>

                    </button>

                </div>

            </div>


            <!-- ===================================================== -->
            <!-- MOBILE MENU -->
            <!-- ===================================================== -->

            <div id="mobileMenu">

                <div class="border-t border-slate-100 pt-3 pb-4">

                    <div class="space-y-1">


                        {{-- Dashboard --}}

                        <a
                            href="{{ route('guru.dashboard') }}"
                            class="flex items-center gap-3
                                   px-3 py-2.5
                                   rounded-lg
                                   text-sm
                                   transition-colors duration-200
                                   {{ request()->routeIs('guru.dashboard')
                                       ? 'font-bold text-orange-600 bg-orange-50/80'
                                       : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}"
                        >

                            <svg
                                class="w-5 h-5
                                       {{ request()->routeIs('guru.dashboard')
                                           ? 'text-orange-500'
                                           : 'text-slate-400' }}"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />

                            </svg>

                            <span>
                                Dashboard
                            </span>

                        </a>


                        {{-- Siswa --}}

                        <a
                            href="{{ route('guru.siswa.index') }}"
                            class="flex items-center gap-3
                                   px-3 py-2.5
                                   rounded-lg
                                   text-sm
                                   transition-colors duration-200
                                   {{ request()->routeIs('guru.siswa.*')
                                       ? 'font-bold text-orange-600 bg-orange-50/80'
                                       : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}"
                        >

                            <svg
                                class="w-5 h-5
                                       {{ request()->routeIs('guru.siswa.*')
                                           ? 'text-orange-500'
                                           : 'text-slate-400' }}"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656-.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                />

                            </svg>

                            <span>
                                Siswa
                            </span>

                        </a>


                        {{-- Input Nilai --}}

                        <a
                            href="{{ route('guru.nilai.index') }}"
                            class="flex items-center gap-3
                                   px-3 py-2.5
                                   rounded-lg
                                   text-sm
                                   transition-colors duration-200
                                   {{ request()->routeIs('guru.nilai.*')
                                       ? 'font-bold text-orange-600 bg-orange-50/80'
                                       : 'font-medium text-slate-600 hover:bg-orange-50 hover:text-orange-600' }}"
                        >

                            <svg
                                class="w-5 h-5
                                       {{ request()->routeIs('guru.nilai.*')
                                           ? 'text-orange-500'
                                           : 'text-slate-400' }}"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707 0.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 01-2 2h-1.586a1 1 0 01-1.707-.293L15 16H9"
                                />

                            </svg>

                            <span>
                                Input Nilai
                            </span>

                        </a>


                        {{-- Rapor --}}
                        {{-- Sementara belum ada route --}}

                        <a
                            href="#"
                            onclick="return false;"
                            class="flex items-center gap-3
                                   px-3 py-2.5
                                   rounded-lg
                                   text-sm
                                   font-medium
                                   text-slate-600
                                   hover:bg-orange-50
                                   hover:text-orange-600
                                   transition-colors duration-200"
                        >

                            <svg
                                class="w-5 h-5 text-slate-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 2h9l5 5v15a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 2v6h6M8 13h8M8 17h5"
                                />

                            </svg>

                            <span>
                                Rapor
                            </span>

                        </a>


                        <!-- Separator -->

                        <div class="border-t border-slate-100 my-2"></div>


                        <!-- ================================================= -->
                        <!-- USER INFO -->
                        <!-- ================================================= -->

                        <div class="flex items-center gap-3 px-3 py-2.5">

                            <div
                                class="w-9 h-9 rounded-full
                                       border-2 border-orange-100
                                       bg-white
                                       flex items-center justify-center"
                            >

                                <span class="text-[10px] font-extrabold text-orange-600">

                                    {{ strtoupper(
                                        substr(
                                            auth()->user()->name ?? 'GU',
                                            0,
                                            2
                                        )
                                    ) }}

                                </span>

                            </div>


                            <div class="leading-tight min-w-0">

                                <p class="text-xs font-bold text-slate-800 truncate">

                                    {{ auth()->user()->name ?? 'Guru' }}

                                </p>

                                <p class="text-[11px] text-slate-400 truncate">

                                    {{ auth()->user()->email ?? 'Guru' }}

                                </p>

                            </div>

                        </div>


                        <!-- ================================================= -->
                        <!-- LOGOUT -->
                        <!-- ================================================= -->

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                            class="pt-1"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="w-full
                                       flex items-center justify-center
                                       gap-2
                                       px-3 py-2.5
                                       rounded-lg
                                       text-xs font-semibold
                                       text-rose-600
                                       bg-rose-50
                                       hover:bg-rose-100
                                       transition-colors duration-200"
                            >

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                    />

                                </svg>

                                <span>
                                    Logout
                                </span>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </header>


    <!-- ========================================================= -->
    <!-- CONTENT -->
    <!-- ========================================================= -->

    <main
        class="w-full min-w-0 mx-auto
               px-4 sm:px-6 lg:px-8
               py-5
               flex-grow"
    >

        @yield('content')

    </main>


    <!-- ========================================================= -->
    <!-- FOOTER -->
    <!-- ========================================================= -->

    <footer
        class="mt-auto
               bg-white
               border-t border-slate-100
               py-3
               px-4 sm:px-6 lg:px-8
               text-xs text-slate-400"
    >

        <div
            class="w-full
                   flex flex-col
                   sm:flex-row
                   items-center
                   justify-between
                   gap-2
                   text-center sm:text-left"
        >

            <p>
                &copy; {{ date('Y') }} Sistem Nilai Guru. All rights reserved.
            </p>

            <p class="font-medium text-slate-400">
                Versi 1.0.0
            </p>

        </div>

    </footer>


    <!-- ========================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ========================================================= -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const menuButton =
                document.getElementById('menuButton');

            const mobileMenu =
                document.getElementById('mobileMenu');

            const menuOpenIcon =
                document.getElementById('menuOpenIcon');

            const menuCloseIcon =
                document.getElementById('menuCloseIcon');


            if (
                menuButton &&
                mobileMenu &&
                menuOpenIcon &&
                menuCloseIcon
            ) {

                menuButton.addEventListener(
                    'click',
                    function () {

                        const isOpen =
                            menuButton.getAttribute(
                                'aria-expanded'
                            ) === 'true';


                        if (isOpen) {

                            mobileMenu.classList.remove(
                                'show-menu'
                            );

                            menuOpenIcon.classList.remove(
                                'hidden'
                            );

                            menuCloseIcon.classList.add(
                                'hidden'
                            );

                            menuButton.setAttribute(
                                'aria-expanded',
                                'false'
                            );

                        } else {

                            mobileMenu.classList.add(
                                'show-menu'
                            );

                            menuOpenIcon.classList.add(
                                'hidden'
                            );

                            menuCloseIcon.classList.remove(
                                'hidden'
                            );

                            menuButton.setAttribute(
                                'aria-expanded',
                                'true'
                            );

                        }

                    }
                );

            }


            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth >= 768) {

                        mobileMenu?.classList.remove(
                            'show-menu'
                        );

                        menuOpenIcon?.classList.remove(
                            'hidden'
                        );

                        menuCloseIcon?.classList.add(
                            'hidden'
                        );

                        menuButton?.setAttribute(
                            'aria-expanded',
                            'false'
                        );

                    }

                }
            );

        });

    </script>


    {{-- Script dari halaman seperti Chart.js dashboard --}}
    @stack('scripts')

</body>

</html>
