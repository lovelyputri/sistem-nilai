@extends('layoutGuru')

@section('content')

@php
    $belumDiinput = max($totalSiswa - $sudahDiinput, 0);
@endphp

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- ========================================================= --}}
    {{-- BANNER SELAMAT DATANG --}}
    {{-- ========================================================= --}}

    <div class="relative bg-gradient-to-r from-orange-50 via-orange-50/40 to-amber-50/60 rounded-2xl p-6 lg:px-8 lg:py-6 border border-orange-100/80 flex flex-col md:flex-row items-center justify-between overflow-hidden shadow-sm">
        <div class="z-10 space-y-1.5 max-w-2xl">
            <h2 class="text-xl lg:text-2xl font-bold text-slate-800 flex items-center gap-2">
                Selamat datang, {{ $guru->name }}!
                <span class="inline-block text-xl">👋</span>
            </h2>

            <p class="text-xs lg:text-sm text-slate-500 font-normal">
                Pantau perkembangan nilai dan kelola penilaian siswa dari satu tempat.
            </p>

            @if($mataPelajaran)
                <div class="pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-orange-100 text-[10px] font-semibold text-orange-600 shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332-.477-4.5-1.253" />
                        </svg>
                        {{ $mataPelajaran->name }}
                    </span>
                </div>
            @endif
        </div>

        {{-- Ilustrasi --}}
        <div class="mt-4 md:mt-0 relative flex items-center justify-end shrink-0 pr-4">
            <div class="w-64 h-24 flex items-center justify-center relative">

                {{-- Tanaman --}}
                <svg class="w-16 h-20 absolute -left-2 bottom-0" viewBox="0 0 100 120" fill="none">
                    <path d="M35 85 L65 85 L60 115 L40 115 Z" fill="#F97316" />
                    <path d="M30 85 L70 85 L70 90 L30 90 Z" fill="#EA580C" />
                    <path d="M50 85 Q20 60 25 35 Q45 45 50 85 Z" fill="#10B981" />
                    <path d="M50 85 Q80 60 75 35 Q55 45 50 85 Z" fill="#059669" />
                    <path d="M50 85 Q50 20 50 15 Q60 40 50 85 Z" fill="#34D399" />
                </svg>

                {{-- Mini Dashboard --}}
                <div class="bg-white rounded-lg shadow-md border border-slate-200 p-2.5 w-44 space-y-2 ml-10">
                    <div class="flex items-center space-x-1.5 border-b border-slate-100 pb-1">
                        <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                    </div>

                    <div class="flex space-x-2 items-center">
                        <div class="w-7 h-7 rounded bg-orange-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13" />
                                <circle cx="6" cy="19" r="3" />
                                <circle cx="18" cy="16" r="3" />
                            </svg>
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


    {{-- ========================================================= --}}
    {{-- 5 METRIC CARDS --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">

        {{-- Total Siswa --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm min-h-[145px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <span class="text-xs font-semibold text-slate-500 truncate">
                        Total Siswa
                    </span>
                </div>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-slate-800">
                        {{ number_format($totalSiswa) }}
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Siswa
                    </span>
                </div>
            </div>

            <a href="{{ route('guru.nilai.index') }}"
               class="mt-3 text-xs font-semibold text-emerald-500 hover:underline inline-flex items-center gap-1">
                Kelola Nilai <span>→</span>
            </a>
        </div>


        {{-- Sudah Diinput --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm min-h-[145px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <span class="text-xs font-semibold text-slate-500">
                        Sudah Diinput
                    </span>
                </div>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-slate-800">
                        {{ number_format($sudahDiinput) }}
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Siswa
                    </span>
                </div>
            </div>

            <div class="mt-3">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-[10px] text-slate-400">Progress</span>
                    <span class="text-[10px] font-bold text-blue-500">
                        {{ $persentaseInput }}%
                    </span>
                </div>

                <div class="w-full h-1.5 rounded-full bg-slate-100">
                    <div class="h-1.5 rounded-full bg-blue-500"
                         style="width: {{ min($persentaseInput, 100) }}%;">
                    </div>
                </div>
            </div>
        </div>


        {{-- Belum Diinput --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm min-h-[145px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <span class="text-xs font-semibold text-slate-500">
                        Belum Diinput
                    </span>
                </div>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-slate-800">
                        {{ number_format($belumDiinput) }}
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Siswa
                    </span>
                </div>
            </div>

            <div class="mt-3">
                @if($belumDiinput > 0)
                    <span class="text-xs font-semibold text-amber-500">
                        Masih perlu dinilai
                    </span>
                @else
                    <span class="text-xs font-semibold text-emerald-500">
                        Semua siswa sudah dinilai
                    </span>
                @endif
            </div>
        </div>


        {{-- Total Nilai --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm min-h-[145px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 012-2" />
                        </svg>
                    </div>

                    <span class="text-xs font-semibold text-slate-500">
                        Total Nilai
                    </span>
                </div>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-slate-800">
                        {{ number_format($jumlahNilai) }}
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Data Nilai
                    </span>
                </div>
            </div>

            <a href="{{ route('guru.nilai.index') }}"
               class="mt-3 text-xs font-semibold text-orange-500 hover:underline inline-flex items-center gap-1">
                Lihat Detail <span>→</span>
            </a>
        </div>


        {{-- Rata-rata Nilai --}}
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm min-h-[145px] flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center text-purple-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12h3l3-8 4 16 3-8h5" />
                        </svg>
                    </div>

                    <span class="text-xs font-semibold text-slate-500">
                        Rata-rata Nilai
                    </span>
                </div>

                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-extrabold text-slate-800">
                        {{ number_format($rataRataNilai, 2, ',', '.') }}
                    </span>
                    <span class="text-[11px] text-slate-400">
                        Keseluruhan
                    </span>
                </div>
            </div>

            <div class="mt-3">
                @if($rataRataNilai >= 75)
                    <span class="text-xs font-semibold text-emerald-500">
                        Di atas KKM
                    </span>
                @else
                    <span class="text-xs font-semibold text-rose-500">
                        Di bawah KKM
                    </span>
                @endif
            </div>
        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ROW 2 : TREN NILAI & PERLU PERHATIAN --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

        {{-- Tren Nilai --}}
        <div class="lg:col-span-7 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">
                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-2">

                        <div class="w-7 h-7 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3v18h18" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16l4-5 3 3 5-7" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800 text-sm">
                                Tren Nilai
                            </h3>
                            <p class="text-[10px] text-slate-400 mt-0.5">
                                Perkembangan nilai terbaru
                            </p>
                        </div>

                    </div>

                    <span class="text-[10px] text-slate-400">
                        {{ $jumlahNilai }} data
                    </span>

                </div>
            </div>

            <div class="p-5">
                <div class="relative h-[260px]">

                    @if(count($chartValues) > 0)

                        <canvas id="guruNilaiChart"></canvas>

                    @else

                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">

                            <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center">

                                <svg class="w-5 h-5 text-slate-300"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M3 3v18h18M7 16l4-5 3 3 5-7" />

                                </svg>

                            </div>

                            <p class="text-[11px] font-semibold text-slate-500 mt-2">
                                Belum ada data nilai
                            </p>

                        </div>

                    @endif

                </div>
            </div>

        </div>


        {{-- Perlu Perhatian --}}
        <div class="lg:col-span-5 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-2">

                        <div class="w-7 h-7 rounded-lg bg-rose-100 flex items-center justify-center text-rose-500">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                            </svg>

                        </div>

                        <div>
                            <h3 class="font-bold text-slate-800 text-sm">
                                Perlu Perhatian
                            </h3>

                            <p class="text-[10px] text-slate-400 mt-0.5">
                                Rata-rata nilai terendah
                            </p>
                        </div>

                    </div>

                    <span class="text-[10px] font-semibold text-rose-500">
                        Top 5
                    </span>

                </div>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($siswaPerluPerhatian as $index => $siswa)

                    <div class="px-5 py-3.5 flex items-center gap-3">

                        <div class="w-7 h-7 shrink-0 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center text-[9px] font-extrabold">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <div class="w-8 h-8 shrink-0 rounded-lg bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center text-[9px] font-bold">
                            {{ strtoupper(substr($siswa['nama'], 0, 2)) }}
                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="text-xs font-bold text-slate-800 truncate">
                                {{ $siswa['nama'] }}
                            </p>

                            <p class="text-[9px] text-slate-400 mt-0.5">
                                {{ $siswa['kelas'] }}
                            </p>

                        </div>

                        <div class="text-right shrink-0">

                            <p class="text-sm font-extrabold {{ $siswa['rata_rata'] < 75 ? 'text-rose-500' : 'text-amber-500' }}">
                                {{ number_format($siswa['rata_rata'], 2, ',', '.') }}
                            </p>

                            <p class="text-[8px] text-slate-400">
                                rata-rata
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-12 text-center">

                        <div class="w-10 h-10 mx-auto rounded-lg bg-emerald-50 flex items-center justify-center">

                            <svg class="w-5 h-5 text-emerald-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7" />

                            </svg>

                        </div>

                        <p class="text-xs font-semibold text-slate-600 mt-2">
                            Tidak ada siswa yang perlu perhatian
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ROW 3 : STATISTIK NILAI & PERINGKAT SISWA --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">

        {{-- Statistik Nilai --}}
        <div class="lg:col-span-7 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <div class="flex items-center gap-2">

                    <div class="w-7 h-7 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 3v18h18" />

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M7 16l4-5 3 3 5-7" />

                        </svg>

                    </div>

                    <div>

                        <h3 class="font-bold text-slate-800 text-sm">
                            Statistik Nilai
                        </h3>

                        <p class="text-[10px] text-slate-400 mt-0.5">
                            Ringkasan hasil penilaian siswa
                        </p>

                    </div>

                </div>

            </div>

            <div class="p-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Nilai Tertinggi --}}
                    <div class="p-4 rounded-xl bg-emerald-50/70 border border-emerald-100">

                        <div class="flex items-center justify-between gap-3">

                            <div>
                                <p class="text-[10px] font-semibold text-emerald-600">
                                    Nilai Tertinggi
                                </p>

                                <p class="text-2xl font-extrabold text-slate-800 mt-1">
                                    {{ number_format($nilaiTertinggi, 0) }}
                                </p>
                            </div>

                            <div class="w-9 h-9 rounded-lg bg-white border border-emerald-100 flex items-center justify-center text-emerald-500 shrink-0">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 15l7-7 7 7" />

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Nilai Terendah --}}
                    <div class="p-4 rounded-xl bg-rose-50/70 border border-rose-100">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <p class="text-[10px] font-semibold text-rose-500">
                                    Nilai Terendah
                                </p>

                                <p class="text-2xl font-extrabold text-slate-800 mt-1">
                                    {{ number_format($nilaiTerendah, 0) }}
                                </p>

                            </div>

                            <div class="w-9 h-9 rounded-lg bg-white border border-rose-100 flex items-center justify-center text-rose-500 shrink-0">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7" />

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Lulus --}}
                    <div class="p-4 rounded-xl bg-blue-50/70 border border-blue-100">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <p class="text-[10px] font-semibold text-blue-600">
                                    Lulus KKM
                                </p>

                                <p class="text-2xl font-extrabold text-slate-800 mt-1">
                                    {{ number_format($jumlahLulus) }}
                                </p>

                                <p class="text-[9px] text-slate-400 mt-0.5">
                                    Siswa
                                </p>

                            </div>

                            <div class="w-9 h-9 rounded-lg bg-white border border-blue-100 flex items-center justify-center text-blue-500 shrink-0">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5 13l4 4L19 7" />

                                </svg>

                            </div>

                        </div>

                    </div>


                    {{-- Remedial --}}
                    <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-100">

                        <div class="flex items-center justify-between gap-3">

                            <div>

                                <p class="text-[10px] font-semibold text-amber-600">
                                    Remedial
                                </p>

                                <p class="text-2xl font-extrabold text-slate-800 mt-1">
                                    {{ number_format($jumlahRemedial) }}
                                </p>

                                <p class="text-[9px] text-slate-400 mt-0.5">
                                    Siswa
                                </p>

                            </div>

                            <div class="w-9 h-9 rounded-lg bg-white border border-amber-100 flex items-center justify-center text-amber-500 shrink-0">

                                <svg class="w-5 h-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />

                                </svg>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Persentase Kelulusan --}}
                <div class="mt-5 pt-4 border-t border-slate-100">

                    <div class="flex items-center justify-between mb-2">

                        <div>

                            <p class="text-[10px] font-semibold text-slate-600">
                                Persentase Kelulusan
                            </p>

                            <p class="text-[9px] text-slate-400 mt-0.5">
                                Berdasarkan nilai KKM 75
                            </p>

                        </div>

                        <span class="text-sm font-extrabold text-emerald-600">
                            {{ $persentaseLulus }}%
                        </span>

                    </div>

                    <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">

                        <div class="h-full rounded-full bg-emerald-500"
                             style="width: {{ min($persentaseLulus, 100) }}%;">
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Peringkat Siswa --}}
        <div class="lg:col-span-5 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-2">

                        <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600">

                            <svg class="w-4 h-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z" />

                            </svg>

                        </div>

                        <div>

                            <h3 class="font-bold text-slate-800 text-sm">
                                Peringkat Siswa
                            </h3>

                            <p class="text-[10px] text-slate-400 mt-0.5">
                                Berdasarkan rata-rata nilai
                            </p>

                        </div>

                    </div>

                    <span class="text-[10px] text-slate-400">
                        Top 5
                    </span>

                </div>

            </div>

            <div class="divide-y divide-slate-100">

                @forelse($rankingSiswa->take(5) as $index => $siswa)

                    @php
                        $rank = $index + 1;
                    @endphp

                    <div class="px-5 py-3.5 flex items-center gap-3">

                        <div class="w-7 h-7 shrink-0 rounded-lg flex items-center justify-center text-[9px] font-extrabold
                            {{ $rank === 1
                                ? 'bg-orange-50 text-orange-600'
                                : ($rank === 2
                                    ? 'bg-slate-100 text-slate-600'
                                    : ($rank === 3
                                        ? 'bg-amber-50 text-amber-600'
                                        : 'bg-slate-50 text-slate-400')) }}">

                            {{ $rank }}

                        </div>

                        <div class="w-8 h-8 shrink-0 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-500">
                            {{ strtoupper(substr($siswa['nama'], 0, 2)) }}
                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="text-xs font-bold text-slate-800 truncate">
                                {{ $siswa['nama'] }}
                            </p>

                            <p class="text-[9px] text-slate-400 mt-0.5">
                                {{ $siswa['kelas'] }}
                            </p>

                        </div>

                        <div class="text-right shrink-0">

                            <p class="text-sm font-extrabold text-orange-600">
                                {{ number_format($siswa['rata_rata'], 2, ',', '.') }}
                            </p>

                            <p class="text-[8px] text-slate-400">
                                rata-rata
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-12 text-center">

                        <p class="text-xs font-semibold text-slate-500">
                            Belum ada ranking siswa
                        </p>

                        <p class="text-[10px] text-slate-400 mt-1">
                            Ranking akan muncul setelah nilai tersedia.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ROW 4 : RAPOR & PEMBELAJARAN --}}
    {{-- ========================================================= --}}

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <div class="flex items-center gap-2">

                <div class="w-7 h-7 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 01-2 2h-1.586a1 1 0 01-.707-.293L15 16H9" />

                    </svg>

                </div>

                <div>

                    <h3 class="font-bold text-slate-800 text-sm">
                        Rapor & Pembelajaran
                    </h3>

                    <p class="text-[10px] text-slate-400 mt-0.5">
                        Pengembangan fitur berikutnya
                    </p>

                </div>

            </div>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                {{-- Pencapaian Pembelajaran --}}
                <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 border border-slate-100">

                    <div class="w-9 h-9 shrink-0 rounded-lg bg-white border border-orange-100 text-orange-500 flex items-center justify-center">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 20h9" />

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4z" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-bold text-slate-700">
                            Pencapaian Pembelajaran
                        </p>

                        <p class="text-[9px] text-slate-400 mt-0.5">
                            Deskripsi capaian siswa
                        </p>

                    </div>

                </div>


                {{-- Template Rapor --}}
                <div class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 border border-slate-100">

                    <div class="w-9 h-9 shrink-0 rounded-lg bg-white border border-orange-100 text-orange-500 flex items-center justify-center">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-bold text-slate-700">
                            Template Rapor
                        </p>

                        <p class="text-[9px] text-slate-400 mt-0.5">
                            Template dapat dimodifikasi
                        </p>

                    </div>

                </div>


                {{-- Export Rapor --}}
                <div class="flex items-center gap-3 p-3 rounded-lg bg-orange-50 border border-orange-100">

                    <div class="w-9 h-9 shrink-0 rounded-lg bg-white border border-orange-100 text-orange-500 flex items-center justify-center">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2z" />

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-bold text-slate-700">
                            Export Rapor PDF
                        </p>

                        <p class="text-[9px] text-slate-400 mt-0.5">
                            Siap untuk dicetak
                        </p>

                    </div>

                </div>

            </div>

            <div class="mt-4 pt-4 border-t border-slate-100">

                <p class="text-[9px] leading-5 text-slate-400">
                    Nantinya data nilai dapat digunakan untuk membentuk rapor lengkap dengan
                    identitas sekolah, logo SMUHERO, tabel nilai, deskripsi pembelajaran,
                    dan halaman belakang rapor.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('guruNilaiChart');

    if (!canvas || typeof Chart === 'undefined') {
        return;
    }

    const labels = @json($chartLabels);
    const values = @json($chartValues);

    if (
        !Array.isArray(labels) ||
        !Array.isArray(values) ||
        values.length === 0
    ) {
        return;
    }

    const ctx = canvas.getContext('2d');

    if (!ctx) {
        return;
    }

    const gradient = ctx.createLinearGradient(0, 0, 0, 300);

    gradient.addColorStop(0, 'rgba(249, 115, 22, 0.16)');
    gradient.addColorStop(1, 'rgba(249, 115, 22, 0)');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: labels,

            datasets: [{
                data: values,
                borderColor: '#F97316',
                backgroundColor: gradient,
                borderWidth: 2.5,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointHoverRadius: 5,
                pointBackgroundColor: '#F97316',
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 2
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    backgroundColor: '#1E293B',
                    padding: 9,
                    cornerRadius: 7,
                    displayColors: false,

                    titleFont: {
                        size: 10,
                        weight: '700'
                    },

                    bodyFont: {
                        size: 10,
                        weight: '600'
                    },

                    callbacks: {
                        label: function (context) {
                            return ' Nilai: ' + context.parsed.y;
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: false,
                    suggestedMin: 50,
                    suggestedMax: 100,

                    border: {
                        display: false
                    },

                    grid: {
                        color: '#F1F5F9',
                        drawTicks: false
                    },

                    ticks: {
                        color: '#94A3B8',
                        padding: 8,

                        font: {
                            size: 9,
                            weight: '600'
                        }
                    }
                },

                x: {
                    border: {
                        display: false
                    },

                    grid: {
                        display: false
                    },

                    ticks: {
                        color: '#94A3B8',
                        padding: 8,
                        maxRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 6,

                        font: {
                            size: 8,
                            weight: '600'
                        },

                        callback: function (value) {
                            const label = this.getLabelForValue(value);

                            if (!label) {
                                return '';
                            }

                            return label.length > 9
                                ? label.substring(0, 9) + '…'
                                : label;
                        }
                    }
                }
            }
        }
    });
});
</script>

@endpush