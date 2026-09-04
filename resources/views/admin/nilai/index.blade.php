@extends('layout')

@section('content')

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="space-y-1.5">

            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1.5">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="hover:text-orange-600 transition">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <span class="text-slate-300">/</span>
                    </li>

                    <li class="font-medium text-slate-800">
                        Nilai Siswa
                    </li>
                </ol>
            </nav>

            <div>
                <h2 class="text-2xl font-extrabold text-slate-800">
                    Data Nilai Akademik Siswa
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Pantau dan tinjau rekapitulasi nilai dan rata-rata
                    dari seluruh mata pelajaran yang diikuti siswa.
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
        STAT CARDS
    ========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- TOTAL SISWA --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-400">
                    Total Data Siswa
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($totalSiswa) }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Siswa Terdaftar
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-blue-50
                        flex items-center justify-center text-blue-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 14l9-5-9-5-9 5 9 5z"/>

                </svg>

            </div>
        </div>


        {{-- RATA-RATA KESELURUHAN --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>

                <p class="text-xs font-medium text-slate-400">
                    Rata-rata Keseluruhan
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($rataRataKeseluruhan, 2) }}
                </h3>

                <p class="text-[11px] text-emerald-500 font-semibold mt-0.5">
                    Nilai Akademik
                </p>

            </div>

            <div class="w-11 h-11 rounded-xl bg-emerald-50
                        flex items-center justify-center text-emerald-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>

                </svg>

            </div>

        </div>


        {{-- NILAI TERTINGGI --}}
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>

                <p class="text-xs font-medium text-slate-400">
                    Nilai Rata-rata Tertinggi
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($rataRataTertinggi, 2) }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Siswa dengan rata-rata tertinggi
                </p>

            </div>

            <div class="w-11 h-11 rounded-xl bg-amber-50
                        flex items-center justify-center text-amber-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z"/>

                </svg>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- =====================================================
            FILTER
        ====================================================== --}}
        <div class="lg:col-span-3 bg-white p-5 rounded-2xl
                    border border-slate-100 shadow-sm space-y-4">

            <div class="flex items-center justify-between pb-3 border-b border-slate-100">

                <div class="flex items-center space-x-2">

                    <svg class="w-4 h-4 text-orange-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                    </svg>

                    <span class="font-bold text-slate-800 text-sm">
                        Filter Data Nilai
                    </span>

                </div>

                <a href="{{ route('admin.nilai.index') }}"
                   class="text-xs text-orange-600 hover:underline font-semibold">

                    Reset

                </a>

            </div>


            {{-- FORM FILTER --}}
            <form method="GET"
                  action="{{ route('admin.nilai.index') }}"
                  class="space-y-4">

                {{-- SEARCH --}}
                <div class="space-y-1.5">

                    <label class="text-xs font-bold text-slate-700">
                        Cari Siswa
                    </label>

                    <div class="relative">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama siswa..."
                            class="w-full text-xs pl-8 pr-3 py-2.5
                                   bg-slate-50 border border-slate-200
                                   rounded-xl focus:outline-none
                                   focus:ring-1 focus:ring-orange-500">

                        <svg class="w-4 h-4 text-slate-400
                                    absolute left-2.5 top-3"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>

                        </svg>

                    </div>

                </div>


                {{-- KELAS --}}
                <div class="space-y-1.5">

                    <label class="text-xs font-bold text-slate-700">
                        Kelas
                    </label>

                    <select
                        name="kelas"
                        class="w-full text-xs px-3 py-2.5
                               bg-slate-50 border border-slate-200
                               rounded-xl focus:outline-none
                               focus:ring-1 focus:ring-orange-500
                               text-slate-600">

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach($daftarKelas as $kelas)

                            <option
                                value="{{ $kelas }}"
                                {{ request('kelas') == $kelas ? 'selected' : '' }}>

                                {{ $kelas }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PER PAGE --}}
                <div class="space-y-1.5">

                    <label class="text-xs font-bold text-slate-700">
                        Data Per Halaman
                    </label>

                    <select
                        name="per_page"
                        class="w-full text-xs px-3 py-2.5
                               bg-slate-50 border border-slate-200
                               rounded-xl focus:outline-none
                               focus:ring-1 focus:ring-orange-500
                               text-slate-600">

                        @foreach([10, 25, 50, 100] as $jumlah)

                            <option
                                value="{{ $jumlah }}"
                                {{ request('per_page', 10) == $jumlah ? 'selected' : '' }}>

                                {{ $jumlah }} / halaman

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="w-full mt-2 bg-orange-500
                           hover:bg-orange-600 text-white
                           text-xs font-semibold py-2.5
                           rounded-xl shadow-sm transition-all
                           flex items-center justify-center
                           space-x-1.5">

                    <svg class="w-3.5 h-3.5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011 1v2.586a1 1 0 00.293.707l6.414 6.414A1 1 0 0111 15v6l2-2 2 2v-6a1 1 0 01.293-.707l6.414-6.414A1 1 0 0022 7.586V5a1 1 0 00-1-1H3z"/>

                    </svg>

                    <span>
                        Terapkan Filter
                    </span>

                </button>

            </form>

        </div>


        {{-- =====================================================
            TABLE
        ====================================================== --}}
        <div class="lg:col-span-9 bg-white rounded-2xl
                    border border-slate-100 shadow-sm
                    overflow-hidden flex flex-col">


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full text-left text-xs">

                    <thead>

                        <tr class="bg-amber-50/40 border-b border-slate-100
                                   text-slate-500 font-semibold">

                            <th class="py-3 px-4 pl-5">
                                No
                            </th>

                            <th class="py-3 px-4">
                                Nama Siswa
                            </th>

                            <th class="py-3 px-4">
                                NIS
                            </th>

                            <th class="py-3 px-4">
                                Kelas
                            </th>

                            <th class="py-3 px-4">
                                Jumlah Mapel
                            </th>

                            <th class="py-3 px-4 text-center">
                                Rata-rata
                            </th>

                            <th class="py-3 px-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse($siswaPaginate as $index => $siswa)

                            <tr class="hover:bg-slate-50/50 transition">

                                {{-- NOMOR --}}
                                <td class="py-4 px-4 pl-5
                                           text-slate-500 font-medium">

                                    {{ $siswaPaginate->firstItem() + $index }}

                                </td>


                                {{-- NAMA --}}
                                <td class="py-4 px-4">

                                    <div class="font-bold text-slate-800">

                                        {{ $siswa['name'] }}

                                    </div>

                                </td>


                                {{-- NIS --}}
                                <td class="py-4 px-4 text-slate-600">

                                    {{ $siswa['nis'] ?? '-' }}

                                </td>


                                {{-- KELAS --}}
                                <td class="py-4 px-4 font-medium text-slate-600">

                                    {{ $siswa['kelas'] ?? '-' }}

                                </td>


                                {{-- JUMLAH MAPEL --}}
                                <td class="py-4 px-4">

                                    <div class="space-y-1.5 max-w-[220px]">

                                        <div class="flex items-center justify-between">

                                            @if($siswa['lengkap'])

                                                <span class="inline-flex items-center
                                                             px-2 py-0.5 rounded-full
                                                             text-[10px] font-bold
                                                             bg-emerald-50 text-emerald-700
                                                             border border-emerald-200">

                                                    {{ $siswa['jumlah_mapel_diikuti'] }}
                                                    dari
                                                    {{ $totalMapel }}
                                                    Mapel Selesai

                                                </span>

                                            @else

                                                <span class="inline-flex items-center
                                                             px-2 py-0.5 rounded-full
                                                             text-[10px] font-bold
                                                             bg-amber-50 text-amber-700
                                                             border border-amber-200">

                                                    {{ $siswa['jumlah_mapel_diikuti'] }}
                                                    dari
                                                    {{ $totalMapel }}
                                                    Mapel

                                                </span>

                                            @endif


                                            <span class="text-[10px]
                                                         font-semibold
                                                         text-slate-500">

                                                {{ $siswa['progress'] }}%

                                            </span>

                                        </div>


                                        {{-- PROGRESS BAR --}}
                                        <div class="w-full bg-slate-100
                                                    rounded-full h-2 overflow-hidden">

                                            <div
                                                class="
                                                    h-full rounded-full
                                                    transition-all duration-500
                                                    {{ $siswa['lengkap']
                                                        ? 'bg-emerald-500'
                                                        : 'bg-amber-500' }}
                                                "
                                                style="width: {{ min($siswa['progress'], 100) }}%">
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- RATA-RATA --}}
                                <td class="py-4 px-4 text-center">

                                    @if(!is_null($siswa['rata_rata']))

                                        <span class="font-extrabold
                                                     text-orange-600 text-sm">

                                            {{ number_format($siswa['rata_rata'], 2) }}

                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="py-4 px-4 text-center">

                                    <div class="flex items-center justify-center">

                                        <a
                                            href="{{ route('admin.nilai.show', $siswa['id']) }}"
                                            title="Lihat Detail Nilai"
                                            class="w-7 h-7 rounded-lg
                                                   bg-orange-50 text-orange-600
                                                   hover:bg-orange-100
                                                   flex items-center justify-center
                                                   border border-orange-200
                                                   transition-colors">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                            </svg>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="py-12 text-center">

                                    <div class="flex flex-col
                                                items-center justify-center">

                                        <div class="w-12 h-12 rounded-full
                                                    bg-slate-100
                                                    flex items-center
                                                    justify-center mb-3">

                                            <svg class="w-6 h-6 text-slate-400"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                                            </svg>

                                        </div>

                                        <p class="text-sm font-semibold
                                                  text-slate-500">

                                            Belum ada data siswa

                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">

                                            Tidak ditemukan data sesuai filter.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                PAGINATION
            ================================================== --}}
            @if($siswaPaginate->hasPages() || $siswaPaginate->total() > 0)

                <div class="p-4 border-t border-slate-100
                            flex flex-col sm:flex-row
                            items-center justify-between
                            text-xs text-slate-500 gap-3">

                    {{-- INFO --}}
                    <div>

                        @if($siswaPaginate->total() > 0)

                            Menampilkan

                            <span class="font-semibold text-slate-700">
                                {{ $siswaPaginate->firstItem() }}
                            </span>

                            -

                            <span class="font-semibold text-slate-700">
                                {{ $siswaPaginate->lastItem() }}
                            </span>

                            dari

                            <span class="font-semibold text-slate-700">
                                {{ $siswaPaginate->total() }}
                            </span>

                            data siswa

                        @else

                            Tidak ada data siswa

                        @endif

                    </div>


                    {{-- PAGINATION --}}
                    <div>

                        {{ $siswaPaginate->onEachSide(1)->links() }}

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
        RANKING SISWA
    ========================================================== --}}
    <div class="bg-white rounded-2xl border border-slate-100
                shadow-sm overflow-hidden">

        <div class="p-5 border-b border-slate-100">

            <div class="flex items-center space-x-2">

                <div class="w-8 h-8 rounded-lg bg-amber-100
                            flex items-center justify-center
                            text-amber-600">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z"/>

                    </svg>

                </div>

                <div>

                    <h3 class="font-bold text-slate-800 text-sm">
                        Peringkat Siswa
                    </h3>

                    <p class="text-[11px] text-slate-400">
                        Berdasarkan rata-rata nilai seluruh mata pelajaran
                    </p>

                </div>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead>

                    <tr class="bg-slate-50 border-b border-slate-100
                               text-slate-500 font-semibold">

                        <th class="py-3 px-5">
                            Rank
                        </th>

                        <th class="py-3 px-4">
                            Nama Siswa
                        </th>

                        <th class="py-3 px-4">
                            Kelas
                        </th>

                        <th class="py-3 px-4 text-center">
                            Rata-rata
                        </th>

                        <th class="py-3 px-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($topSiswa as $index => $ranking)

                        @php

                            $rank = $index + 1;

                            $rankClass = match(true) {

                                $rank === 1 =>
                                    'font-bold text-orange-600',

                                $rank === 2 =>
                                    'font-bold text-slate-600',

                                $rank === 3 =>
                                    'font-bold text-amber-600',

                                default =>
                                    'font-medium text-slate-600',

                            };

                        @endphp


                        <tr class="hover:bg-slate-50/50 transition">

                            <td class="py-3 px-5 {{ $rankClass }}">

                                #{{ $rank }}

                            </td>


                            <td class="py-3 px-4 font-semibold text-slate-800">

                                {{ $ranking['nama'] }}

                            </td>


                            <td class="py-3 px-4 text-slate-600">

                                {{ $ranking['kelas'] }}

                            </td>


                            <td class="py-3 px-4 text-center">

                                <span class="font-extrabold text-orange-600">

                                    {{ number_format($ranking['rata_rata'], 2) }}

                                </span>

                            </td>


                            <td class="py-3 px-4 text-center">

                                <a
                                    href="{{ route('admin.nilai.show', $ranking['id']) }}"
                                    title="Lihat Detail"
                                    class="inline-flex w-7 h-7 rounded-lg
                                           bg-orange-50 text-orange-600
                                           hover:bg-orange-100
                                           items-center justify-center
                                           border border-orange-200">

                                    <svg class="w-3.5 h-3.5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                    </svg>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="py-8 text-center text-slate-400">

                                Belum ada data ranking siswa.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection