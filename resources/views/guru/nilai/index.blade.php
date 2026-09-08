@extends('layoutGuru')

@section('content')

<div class="w-full mx-auto px-3 sm:px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- FLASH MESSAGES --}}
    @if (session('success'))
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
            <svg class="w-5 h-5 shrink-0 mt-0.5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 11-18 0z"/>
            </svg>

            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold">
            <svg class="w-5 h-5 shrink-0 mt-0.5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 9v3m0 4h.01M10.29 3.86l-8.48 14.7A1 1 0 002.7 20h18.6a1 1 0 00.87-1.44L13.7 3.86a1 1 0 00-1.73 0z"/>
            </svg>

            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="space-y-1.5 min-w-0">

            <nav class="flex text-xs text-slate-400"
                 aria-label="Breadcrumb">

                <ol class="inline-flex items-center gap-1.5 whitespace-nowrap">

                    <li>
                        <a href="{{ route('guru.dashboard') }}"
                           class="hover:text-orange-600 transition">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <span class="text-slate-300">/</span>
                    </li>

                    <li class="font-semibold text-slate-800">
                        Nilai Siswa
                    </li>

                </ol>

            </nav>

            <div>

                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800">
                    Data Nilai Siswa
                </h2>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Kelola nilai siswa pada mata pelajaran
                    {{ $mapelGuru?->name ?? 'yang Anda ajar' }}.
                </p>

            </div>

        </div>

        <a href="{{ route('guru.nilai.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold shadow-sm transition-all shrink-0">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            <span>Tambah Nilai</span>

        </a>

    </div>


    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- SUDAH DINILAI --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-slate-400">
                        Sudah Dinilai
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ number_format($jumlahSudahDinilai) }}
                    </h3>

                    <p class="text-[11px] text-emerald-500 font-semibold mt-0.5">
                        {{ $persentasePenilaian }}% dari seluruh siswa
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 11-18 0z"/>
                    </svg>

                </div>

            </div>

        </div>


        {{-- BELUM DINILAI --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-slate-400">
                        Belum Dinilai
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ number_format($jumlahBelumDinilai) }}
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Siswa belum memiliki nilai
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 11-18 0z"/>
                    </svg>

                </div>

            </div>

        </div>


        {{-- RATA-RATA --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-4">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-slate-400">
                        Rata-rata Nilai
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ $rataRataKeseluruhan !== null ? number_format($rataRataKeseluruhan, 2) : '-' }}
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Dari nilai yang sudah diinput
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">

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

        </div>

    </div>


    {{-- FILTER + TABLE --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6 items-start">

        {{-- FILTER --}}
        <div class="lg:col-span-3 bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-3 pb-3 border-b border-slate-100">

                <div class="flex items-center gap-2 min-w-0">

                    <svg class="w-4 h-4 text-orange-500 shrink-0"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>

                    <span class="font-bold text-slate-800 text-sm truncate">
                        Filter Data Nilai
                    </span>

                </div>

                @if($search || $kelasTerpilih)

                    <a href="{{ route('guru.nilai.index') }}"
                       class="text-xs text-orange-600 hover:text-orange-700 hover:underline font-semibold shrink-0">
                        Reset
                    </a>

                @endif

            </div>


            <form method="GET"
                  action="{{ route('guru.nilai.index') }}"
                  class="space-y-4 mt-4">

                {{-- SEARCH --}}
                <div class="space-y-1.5">

                    <label for="search"
                           class="text-xs font-bold text-slate-700">
                        Cari Siswa
                    </label>

                    <div class="relative">

                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>

                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ $search }}"
                               placeholder="Nama / NIS / NISN..."
                               class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition">

                    </div>

                </div>


                {{-- KELAS --}}
                <div class="space-y-1.5">

                    <label for="kelas"
                           class="text-xs font-bold text-slate-700">
                        Kelas
                    </label>

                    <select id="kelas"
                            name="kelas"
                            class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 text-slate-600">

                        <option value="">
                            Semua Kelas
                        </option>

                        @foreach ($daftarKelas as $kelas)

                            <option value="{{ $kelas }}"
                                @selected($kelasTerpilih == $kelas)>
                                {{ $kelas }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PER PAGE --}}
                <div class="space-y-1.5">

                    <label for="per_page"
                           class="text-xs font-bold text-slate-700">
                        Data Per Halaman
                    </label>

                    <select id="per_page"
                            name="per_page"
                            class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 text-slate-600">

                        @foreach ([10, 25, 50] as $jumlah)

                            <option value="{{ $jumlah }}"
                                @selected((int) $perPage === $jumlah)>
                                {{ $jumlah }} / halaman
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center gap-1.5">

                    <svg class="w-3.5 h-3.5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L2.293 7.293A1 1 0 012 6.586V4a1 1 0 011-1z"/>
                    </svg>

                    <span>
                        Terapkan Filter
                    </span>

                </button>

            </form>

        </div>


        {{-- DATA NILAI --}}
        <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            {{-- TABLE HEADER --}}
            <div class="px-4 sm:px-5 py-4 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                    <div>

                        <h3 class="text-sm font-bold text-slate-800">
                            Rekap Nilai Siswa
                        </h3>

                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Menampilkan {{ $siswaPaginate->total() }} data siswa.
                        </p>

                    </div>

                    @if($kelasTerpilih)

                        <span class="inline-flex items-center w-fit px-3 py-1.5 rounded-lg bg-orange-50 text-orange-600 text-[11px] font-semibold">
                            Kelas {{ $kelasTerpilih }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- DESKTOP TABLE --}}
            <div class="hidden md:block w-full">

                <table class="w-full table-fixed text-left text-xs">

                    <thead>

                        <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">

                            <th class="w-[5%] py-3 px-2 text-center">
                                No
                            </th>

                            <th class="w-[24%] py-3 px-2">
                                Nama Siswa
                            </th>

                            <th class="w-[12%] py-3 px-2">
                                NIS
                            </th>

                            <th class="w-[9%] py-3 px-2">
                                Kelas
                            </th>

                            <th class="w-[12%] py-3 px-2 text-center">
                                Nilai
                            </th>

                            <th class="w-[15%] py-3 px-2">
                                Status
                            </th>

                            <th class="w-[23%] py-3 px-2 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse($siswaPaginate as $index => $item)

                            <tr class="hover:bg-slate-50/60 transition-colors">

                                {{-- NO --}}
                                <td class="py-4 px-2 text-center text-slate-500 font-medium">
                                    {{ $siswaPaginate->firstItem() + $index }}
                                </td>


                                {{-- NAMA --}}
                                <td class="py-4 px-2">

                                    <div class="flex items-center gap-2.5 min-w-0">

                                        <div class="w-8 h-8 shrink-0 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-[11px]">
                                            {{ strtoupper(substr($item['name'], 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="font-bold text-slate-800 truncate"
                                               title="{{ $item['name'] }}">
                                                {{ $item['name'] }}
                                            </p>

                                            <p class="text-[10px] text-slate-400 truncate">
                                                {{ $item['nisn'] ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- NIS --}}
                                <td class="py-4 px-2 text-slate-600">
                                    {{ $item['nis'] ?? '-' }}
                                </td>


                                {{-- KELAS --}}
                                <td class="py-4 px-2">

                                    <span class="inline-flex px-2 py-1 rounded-lg bg-slate-100 text-slate-600 text-[10px] font-semibold">
                                        {{ $item['kelas'] ?? '-' }}
                                    </span>

                                </td>


                                {{-- NILAI --}}
                                <td class="py-4 px-2 text-center">

                                    @if($item['nilai'] !== null)

                                        <span class="text-sm font-extrabold text-orange-600">
                                            {{ number_format($item['nilai'], 0) }}
                                        </span>

                                    @else

                                        <span class="text-slate-400">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td class="py-4 px-2">

                                    @if($item['nilai'] === null)

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-semibold">

                                            <svg class="w-3 h-3"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 11-18 0z"/>
                                            </svg>

                                            Belum Dinilai

                                        </span>

                                    @elseif($item['nilai'] >= 75)

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-semibold">

                                            <svg class="w-3 h-3"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 11-18 0z"/>
                                            </svg>

                                            {{ $item['status'] }}

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 text-red-700 text-[10px] font-semibold">

                                            <svg class="w-3 h-3"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 9v3m0 4h.01M10.29 3.86l-8.48 14.7A1 1 0 002.7 20h18.6a1 1 0 00.87-1.44L13.7 3.86a1 1 0 00-1.73 0z"/>
                                            </svg>

                                            {{ $item['status'] }}

                                        </span>

                                    @endif

                                </td>

                                {{-- AKSI --}}
                                <td class="py-4 px-2">

                                    <div class="flex items-center justify-center gap-1.5">

                                        {{-- VIEW / DETAIL --}}
                                        <a href="{{ route('guru.nilai.show', $item['id']) }}"
                                        title="Lihat Detail"
                                        class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">

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
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7z"/>

                                            </svg>

                                        </a>


                                        {{-- EDIT --}}
                                        @if(!empty($item['nilai_id']))

                                            <a href="{{ route('guru.nilai.edit', $item['nilai_id']) }}"
                                            title="Edit Nilai"
                                            class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">

                                                <svg class="w-3.5 h-3.5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>

                                                </svg>

                                            </a>

                                        @endif

                                    </div>

                                </td>
                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mb-3">

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

                                        <p class="text-sm font-semibold text-slate-500">
                                            Data siswa tidak ditemukan
                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Coba ubah kata pencarian atau filter kelas.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- MOBILE CARDS --}}
            <div class="md:hidden divide-y divide-slate-100">

                @forelse($siswaPaginate as $index => $item)

                    <div class="p-4">

                        <div class="flex items-start gap-3">

                            {{-- AVATAR --}}
                            <div class="w-9 h-9 shrink-0 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($item['name'], 0, 1)) }}
                            </div>


                            {{-- DATA --}}
                            <div class="flex-1 min-w-0">

                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <p class="text-sm font-bold text-slate-800 truncate">
                                            {{ $item['name'] }}
                                        </p>

                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            NIS: {{ $item['nis'] ?? '-' }}
                                        </p>

                                    </div>

                                    <div class="flex items-center gap-1.5 shrink-0">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('guru.nilai.show', $item['id']) }}"
                                           title="Lihat Detail"
                                           class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">

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
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                            </svg>

                                        </a>

                                        {{-- EDIT --}}
                                        @if(!empty($item['nilai_id']))

                                            <a href="{{ route('guru.nilai.edit', $item['nilai_id']) }}"
                                               title="Edit Nilai"
                                               class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">

                                                <svg class="w-3.5 h-3.5"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>

                                                </svg>

                                            </a>

                                        @endif

                                    </div>

                                </div>


                                {{-- KELAS --}}
                                <div class="mt-3">

                                    <span class="inline-flex px-2 py-1 rounded-lg bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-600">
                                        Kelas {{ $item['kelas'] ?? '-' }}
                                    </span>

                                </div>


                                {{-- NILAI + STATUS --}}
                                <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">

                                    <div>

                                        <span class="text-[10px] text-slate-400 block">
                                            Nilai
                                        </span>

                                        @if($item['nilai'] !== null)

                                            <span class="text-sm font-extrabold text-orange-600">
                                                {{ number_format($item['nilai'], 0) }}
                                            </span>

                                        @else

                                            <span class="text-xs text-slate-400">
                                                -
                                            </span>

                                        @endif

                                    </div>

                                    @if($item['nilai'] === null)

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-semibold">
                                            Belum Dinilai
                                        </span>

                                    @elseif($item['nilai'] >= 75)

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-[10px] font-semibold">
                                            {{ $item['status'] }}
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-red-50 text-red-700 text-[10px] font-semibold">
                                            {{ $item['status'] }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="py-12 px-5 text-center">

                        <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 flex items-center justify-center mb-3">

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

                        <p class="text-sm font-semibold text-slate-500">
                            Data siswa tidak ditemukan
                        </p>

                        <p class="text-xs text-slate-400 mt-1">
                            Coba ubah kata pencarian atau filter kelas.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- PAGINATION --}}
            @if($siswaPaginate->total() > 0)

                <div class="px-4 sm:px-5 py-4 border-t border-slate-100">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <p class="text-xs text-slate-500">

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

                            siswa

                        </p>

                        @if($siswaPaginate->hasPages())

                            <div class="w-full sm:w-auto overflow-hidden">

                                {{ $siswaPaginate->onEachSide(1)->links() }}

                            </div>

                        @endif

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- RANKING KELAS --}}
    @if($kelasTerpilih && $rankingSiswa->isNotEmpty())

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            {{-- HEADER RANKING --}}
            <div class="px-4 sm:px-5 py-4 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div>

                        <div class="flex items-center gap-2">

                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center">

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

                            <h3 class="text-sm font-bold text-slate-800">
                                Peringkat Kelas {{ $kelasTerpilih }}
                            </h3>

                        </div>

                        <p class="text-[11px] text-slate-400 mt-1">
                            Berdasarkan nilai {{ $mapelGuru?->name ?? '-' }}.
                        </p>

                    </div>

                    <span class="inline-flex w-fit px-3 py-1.5 rounded-lg bg-orange-50 text-orange-600 text-[11px] font-semibold">
                        {{ $rankingSiswa->count() }} Siswa
                    </span>

                </div>

            </div>


            {{-- RANKING --}}
            <div class="divide-y divide-slate-100">

                @foreach($rankingSiswa as $index => $item)

                    <div class="px-4 sm:px-5 py-4 hover:bg-slate-50/60 transition-colors">

                        <div class="flex items-center gap-3">

                            {{-- NOMOR PERINGKAT --}}
                            <div class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-sm font-extrabold
                                {{ $index === 0
                                    ? 'bg-amber-100 text-amber-600'
                                    : ($index === 1
                                        ? 'bg-slate-100 text-slate-600'
                                        : ($index === 2
                                            ? 'bg-orange-50 text-orange-600'
                                            : 'bg-slate-50 text-slate-500')) }}">

                                {{ $index + 1 }}

                            </div>


                            {{-- IDENTITAS --}}
                            <div class="flex-1 min-w-0">

                                <p class="text-xs sm:text-sm font-bold text-slate-800 truncate">
                                    {{ $item['name'] }}
                                </p>

                                <div class="flex flex-wrap items-center gap-2 mt-1">

                                    <span class="text-[10px] text-slate-400">
                                        NIS: {{ $item['nis'] ?? '-' }}
                                    </span>

                                </div>

                            </div>


                            {{-- NILAI --}}
                            <div class="text-right shrink-0">

                                <p class="text-[10px] text-slate-400">
                                    Nilai
                                </p>

                                <p class="text-sm sm:text-base font-extrabold text-orange-600">
                                    {{ number_format($item['nilai'], 0) }}
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @elseif($kelasTerpilih)

        {{-- KELAS DIPILIH TAPI BELUM ADA NILAI --}}

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 text-center">

            <div class="w-12 h-12 mx-auto rounded-xl bg-slate-100 flex items-center justify-center mb-3">

                <svg class="w-6 h-6 text-slate-400"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v2m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"/>

                </svg>

            </div>

            <p class="text-sm font-semibold text-slate-600">
                Belum ada siswa dengan nilai
            </p>

            <p class="text-xs text-slate-400 mt-1">
                Peringkat kelas {{ $kelasTerpilih }} belum dapat ditampilkan.
            </p>

        </div>

    @endif

</div>

@endsection
