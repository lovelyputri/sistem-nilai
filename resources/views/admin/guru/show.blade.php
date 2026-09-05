@extends('layout')

@section('content')

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- ========================================================= --}}
    {{-- BREADCRUMB + HEADER --}}
    {{-- ========================================================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <nav class="flex text-xs text-slate-400 mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center gap-2">

                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="hover:text-orange-600 transition">
                            Dashboard
                        </a>
                    </li>

                    <li class="text-slate-300">/</li>

                    <li>
                        <a href="{{ route('admin.guru.index') }}"
                           class="hover:text-orange-600 transition">
                            Guru
                        </a>
                    </li>

                    <li class="text-slate-300">/</li>

                    <li>
                        <a href="{{ route('admin.guru.index') }}"
                           class="hover:text-orange-600 transition">
                            Kelola Guru
                        </a>
                    </li>

                    <li class="text-slate-300">/</li>

                    <li class="font-medium text-slate-800">
                        Detail Guru
                    </li>

                </ol>
            </nav>

            <h2 class="text-2xl font-extrabold text-slate-800">
                Detail Guru
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Informasi lengkap data guru dalam sistem.
            </p>
        </div>

        {{-- KEMBALI --}}
        <a href="{{ route('admin.guru.index') }}"
           class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50
                  text-slate-700 text-xs font-semibold px-4 py-2.5 rounded-xl
                  border border-slate-200 shadow-sm transition w-fit">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>

            <span>Kembali</span>

        </a>

    </div>


    {{-- ========================================================= --}}
    {{-- PROFIL GURU --}}
    {{-- ========================================================= --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="p-6 lg:p-7">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">

                {{-- ================================================= --}}
                {{-- PROFIL KIRI --}}
                {{-- ================================================= --}}
                <div class="lg:col-span-7">

                    <div class="flex items-center gap-5">

                        {{-- AVATAR --}}
                        <div class="relative shrink-0">

                            @php
                                $initials = collect(
                                    explode(' ', trim($guru->name ?? ''))
                                )
                                ->filter()
                                ->map(fn ($word) => strtoupper(substr($word, 0, 1)))
                                ->take(2)
                                ->implode('');
                            @endphp

                            <div class="w-24 h-24 rounded-full bg-slate-100
                                        flex items-center justify-center">

                                <span class="text-3xl font-bold text-slate-500">
                                    {{ $initials ?: '-' }}
                                </span>

                            </div>


                            {{-- STATUS --}}
                            @if ($guru->status === 'aktif')

                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2
                                            inline-flex items-center gap-1.5
                                            px-3 py-1 rounded-full
                                            bg-emerald-50 text-emerald-600
                                            border border-emerald-100
                                            text-[11px] font-bold whitespace-nowrap">

                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                    Aktif

                                </div>

                            @elseif ($guru->status === 'menunggu')

                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2
                                            inline-flex items-center gap-1.5
                                            px-3 py-1 rounded-full
                                            bg-amber-50 text-amber-600
                                            border border-amber-100
                                            text-[11px] font-bold whitespace-nowrap">

                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                    Menunggu

                                </div>

                            @elseif ($guru->status === 'ditolak')

                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2
                                            inline-flex items-center gap-1.5
                                            px-3 py-1 rounded-full
                                            bg-rose-50 text-rose-600
                                            border border-rose-100
                                            text-[11px] font-bold whitespace-nowrap">

                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>

                                    Ditolak

                                </div>

                            @else

                                <div class="absolute -bottom-1 left-1/2 -translate-x-1/2
                                            inline-flex items-center gap-1.5
                                            px-3 py-1 rounded-full
                                            bg-slate-100 text-slate-500
                                            text-[11px] font-bold whitespace-nowrap">

                                    {{ ucfirst($guru->status ?? '-') }}

                                </div>

                            @endif

                        </div>


                        {{-- DATA GURU --}}
                        <div class="min-w-0">

                            <h3 class="text-xl lg:text-2xl font-extrabold text-slate-800">
                                {{ $guru->name }}
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                Guru
                            </p>


                            {{-- NIP --}}
                            <div class="flex items-center gap-2 mt-4">

                                <svg class="w-4 h-4 text-slate-400 shrink-0"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 016 0M9 5h6"/>

                                </svg>

                                <span class="text-xs text-slate-500">
                                    NIP
                                </span>

                                <span class="text-xs font-semibold text-slate-700">
                                    {{ $guru->nip ?? '-' }}
                                </span>

                            </div>


                            {{-- EMAIL --}}
                            <div class="flex items-center gap-2 mt-2.5">

                                <svg class="w-4 h-4 text-slate-400 shrink-0"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>

                                </svg>

                                <span class="text-xs text-slate-500">
                                    Email
                                </span>

                                <span class="text-xs font-semibold text-slate-700 break-all">
                                    {{ $guru->email ?? '-' }}
                                </span>

                            </div>


                            {{-- TELEPON --}}
                            <div class="flex items-center gap-2 mt-2.5">

                                <svg class="w-4 h-4 text-slate-400 shrink-0"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>

                                </svg>

                                <span class="text-xs text-slate-500">
                                    No. Telepon
                                </span>

                                <span class="text-xs font-semibold text-slate-700">
                                    {{ $guru->no_telepon ?? $guru->phone ?? '-' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ========================================================= --}}
                {{-- INFORMASI GURU KANAN --}}
                {{-- ========================================================= --}}
                <div class="lg:col-span-5 lg:border-l border-slate-100 lg:pl-8">

                    <div class="space-y-4">

                        {{-- BERGABUNG SEJAK --}}
                        <div class="flex items-start gap-3">

                            <div class="w-8 h-8 rounded-lg bg-emerald-50
                                        flex items-center justify-center
                                        text-emerald-500 shrink-0">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-medium text-slate-500">
                                    Bergabung Sejak
                                </p>

                                <p class="text-xs font-semibold text-slate-700 mt-1">
                                    {{ $guru->created_at?->format('d F Y, H:i') ?? '-' }} WIB
                                </p>

                            </div>

                        </div>


                        {{-- STATUS AKUN --}}
                        <div class="flex items-start gap-3">

                            <div class="w-8 h-8 rounded-lg bg-blue-50
                                        flex items-center justify-center
                                        text-blue-500 shrink-0">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.983 0-5.74 1.09-7.868 2.984A11.954 11.954 0 0012 21a11.954 11.954 0 007.868-15.016z"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-medium text-slate-500">
                                    Status Akun
                                </p>

                                @if ($guru->status === 'aktif')

                                    <span class="inline-flex items-center gap-1.5
                                                mt-1.5 px-2.5 py-1 rounded-full
                                                bg-emerald-50 text-emerald-600
                                                border border-emerald-100
                                                text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Aktif

                                    </span>

                                @elseif ($guru->status === 'menunggu')

                                    <span class="inline-flex items-center gap-1.5
                                                mt-1.5 px-2.5 py-1 rounded-full
                                                bg-amber-50 text-amber-600
                                                border border-amber-100
                                                text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                        Menunggu

                                    </span>

                                @elseif ($guru->status === 'ditolak')

                                    <span class="inline-flex items-center gap-1.5
                                                mt-1.5 px-2.5 py-1 rounded-full
                                                bg-rose-50 text-rose-600
                                                border border-rose-100
                                                text-xs font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>

                                        Ditolak

                                    </span>

                                @else

                                    <span class="inline-flex mt-1.5 px-2.5 py-1 rounded-full
                                                bg-slate-100 text-slate-500
                                                text-xs font-bold">

                                        {{ ucfirst($guru->status ?? '-') }}

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- ROLE PENGGUNA --}}
                        <div class="flex items-start gap-3">

                            <div class="w-8 h-8 rounded-lg bg-purple-50
                                        flex items-center justify-center
                                        text-purple-500 shrink-0">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-medium text-slate-500">
                                    Role Pengguna
                                </p>

                                <p class="text-xs font-semibold text-slate-700 mt-1">
                                    {{ ucfirst($guru->role ?? 'Guru') }}
                                </p>

                            </div>

                        </div>


                        {{-- TERAKHIR DIPERBARUI --}}
                        <div class="flex items-start gap-3">

                            <div class="w-8 h-8 rounded-lg bg-slate-50
                                        flex items-center justify-center
                                        text-slate-500 shrink-0">

                                <svg class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-medium text-slate-500">
                                    Terakhir Diperbarui
                                </p>

                                <p class="text-xs font-semibold text-slate-700 mt-1">
                                    {{ $guru->updated_at?->format('d F Y, H:i') ?? '-' }} WIB
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MAPEL & KELAS --}}
    {{-- ========================================================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">


        {{-- ========================================================= --}}
        {{-- MATA PELAJARAN --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">

                <div class="w-8 h-8 rounded-lg bg-orange-50
                            flex items-center justify-center text-orange-500">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332.477 4.5 1.253"/>

                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-bold text-orange-600">
                        Mata Pelajaran yang Diajar
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Daftar mata pelajaran yang diampu oleh guru ini.
                    </p>

                </div>

            </div>


            <div class="p-5">

                @php
                    $mataPelajaranGuru = $guru->mataPelajaran ?? collect();
                @endphp

                @if ($mataPelajaranGuru->isEmpty())

                    <div class="py-8 text-center">

                        <div class="w-10 h-10 mx-auto rounded-xl bg-slate-50
                                    flex items-center justify-center text-slate-300">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332 0 4.5 1.253"/>

                            </svg>

                        </div>

                        <p class="text-xs text-slate-400 mt-2">
                            Belum ada mata pelajaran.
                        </p>

                    </div>

                @else

                    <div class="space-y-2">

                        @foreach ($mataPelajaranGuru as $mapel)

                            <div class="flex items-center justify-between
                                        p-3 rounded-xl border border-slate-200
                                        bg-white hover:bg-slate-50 transition">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg bg-orange-50
                                                flex items-center justify-center
                                                text-orange-500 shrink-0">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332 0 4.5 1.253"/>

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs font-bold text-slate-700">
                                            {{ $mapel->name ?? '-' }}
                                        </p>

                                        @if (!empty($mapel->kode))

                                            <p class="text-[10px] text-slate-400 mt-0.5">
                                                Kode: {{ $mapel->kode }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                                @if (!empty($mapel->kode))

                                    <span class="bg-orange-50 text-orange-600
                                                 px-2.5 py-1 rounded-lg
                                                 text-[10px] font-bold">

                                        {{ $mapel->kode }}

                                    </span>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- FOOTER --}}
            <div class="px-5 py-4 border-t border-slate-100
                        flex items-center justify-between">

                <div class="flex items-center gap-2">

                    <svg class="w-4 h-4 text-orange-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332 0 4.5 1.253"/>

                    </svg>

                    <span class="text-xs font-bold text-orange-600">
                        Total Mata Pelajaran
                    </span>

                </div>

                <span class="w-10 h-10 rounded-full bg-orange-50
                             flex items-center justify-center
                             text-orange-600 font-bold">

                    {{ $mataPelajaranGuru->count() }}

                </span>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- KELAS --}}
        {{-- ========================================================= --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">

                <div class="w-8 h-8 rounded-lg bg-blue-50
                            flex items-center justify-center text-blue-500">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>

                    </svg>

                </div>

                <div>

                    <h3 class="text-sm font-bold text-blue-600">
                        Kelas yang Diajar
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Daftar kelas yang diajar atau dibimbing oleh guru ini.
                    </p>

                </div>

            </div>


            <div class="p-5">

                @php
                    $kelasGuru = $guru->kelas ?? collect();
                @endphp

                @if ($kelasGuru->isEmpty())

                    <div class="py-8 text-center">

                        <div class="w-10 h-10 mx-auto rounded-xl bg-slate-50
                                    flex items-center justify-center text-slate-300">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>

                            </svg>

                        </div>

                        <p class="text-xs text-slate-400 mt-2">
                            Belum ada kelas.
                        </p>

                    </div>

                @else

                    <div class="space-y-2">

                        @foreach ($kelasGuru as $kelas)

                            <div class="flex items-center gap-3
                                        p-3 rounded-xl border border-slate-200
                                        bg-white hover:bg-slate-50 transition">

                                <div class="w-9 h-9 rounded-lg bg-blue-50
                                            flex items-center justify-center
                                            text-blue-500 shrink-0">

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-xs font-bold text-slate-700">
                                        {{ $kelas->kelas ?? '-' }}
                                    </p>

                                    @if (!empty($kelas->tahun_ajaran))

                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            Tahun Ajaran: {{ $kelas->tahun_ajaran }}
                                        </p>

                                    @else

                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            Kelas yang diajar
                                        </p>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>


            {{-- FOOTER --}}
            <div class="px-5 py-4 border-t border-slate-100
                        flex items-center justify-between">

                <div class="flex items-center gap-2">

                    <svg class="w-4 h-4 text-blue-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>

                    </svg>

                    <span class="text-xs font-bold text-blue-600">
                        Total Kelas
                    </span>

                </div>

                <span class="w-10 h-10 rounded-full bg-blue-50
                             flex items-center justify-center
                             text-blue-600 font-bold">

                    {{ $kelasGuru->count() }}

                </span>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- RINGKASAN --}}
    {{-- ========================================================= --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-5 py-4">

            <div class="flex items-center gap-2">

                <svg class="w-5 h-5 text-emerald-500"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"/>

                </svg>

                <div>

                    <h3 class="text-sm font-bold text-emerald-600">
                        Ringkasan
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Ringkasan informasi mengajar.
                    </p>

                </div>

            </div>

        </div>


        {{-- SUMMARY --}}
        <div class="border-t border-slate-100">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">

                {{-- MAPEL --}}
                <div class="p-5 lg:border-r border-slate-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 rounded-xl bg-emerald-50
                                    flex items-center justify-center
                                    text-emerald-500 shrink-0">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18 5.754 18 7.5 18s3.332 0 4.5 1.253"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                Mata Pelajaran
                            </p>

                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                {{ $mataPelajaranGuru->count() }}
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Mapel
                            </p>

                        </div>

                    </div>

                </div>


                {{-- KELAS --}}
                <div class="p-5 lg:border-r border-slate-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 rounded-xl bg-blue-50
                                    flex items-center justify-center
                                    text-blue-500 shrink-0">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                Kelas yang Diajar
                            </p>

                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                {{ $kelasGuru->count() }}
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Kelas
                            </p>

                        </div>

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="p-5 lg:border-r border-slate-100">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 rounded-xl bg-orange-50
                                    flex items-center justify-center
                                    text-orange-500 shrink-0">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                Status Akun
                            </p>

                            @if ($guru->status === 'aktif')

                                <span class="inline-flex items-center gap-1.5
                                             mt-2 px-3 py-1.5 rounded-full
                                             bg-emerald-50 text-emerald-600
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                    Aktif

                                </span>

                            @elseif ($guru->status === 'menunggu')

                                <span class="inline-flex items-center gap-1.5
                                             mt-2 px-3 py-1.5 rounded-full
                                             bg-amber-50 text-amber-600
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                    Menunggu

                                </span>

                            @elseif ($guru->status === 'ditolak')

                                <span class="inline-flex items-center gap-1.5
                                             mt-2 px-3 py-1.5 rounded-full
                                             bg-rose-50 text-rose-600
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>

                                    Ditolak

                                </span>

                            @else

                                <span class="inline-flex mt-2 px-3 py-1.5
                                             rounded-full bg-slate-100
                                             text-slate-500 text-xs font-bold">

                                    {{ ucfirst($guru->status ?? '-') }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- TOTAL MENGAJAR --}}
                <div class="p-5">

                    <div class="flex items-center gap-4">

                        <div class="w-11 h-11 rounded-xl bg-purple-50
                                    flex items-center justify-center
                                    text-purple-500 shrink-0">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2 2z"/>

                            </svg>

                        </div>

                        <div>

                            <p class="text-xs text-slate-400">
                                Total Mengajar
                            </p>

                            <p class="text-2xl font-bold text-slate-800 mt-1">
                                {{ $kelasGuru->count() }}
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Kelas
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection