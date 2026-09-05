@extends('layout')

@section('content')

<div class="w-full mx-auto px-3 sm:px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="flex items-start gap-3 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
            <svg class="w-5 h-5 shrink-0 mt-0.5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="space-y-1.5 min-w-0">

            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">

                <ol class="inline-flex items-center gap-1.5">

                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="hover:text-orange-600 transition-colors">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <span class="text-slate-300">/</span>
                    </li>

                    <li class="font-semibold text-slate-800">
                        Mata Pelajaran
                    </li>

                </ol>

            </nav>

            <div>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800">
                    Kelola Mata Pelajaran
                </h2>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Kelola daftar mata pelajaran kurikulum dan penugasan bidang studi.
                </p>
            </div>

        </div>

        <div class="w-full sm:w-auto">

            <a href="{{ route('admin.mapel.create') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2.5"
                          d="M12 4v16m8-8H4"/>
                </svg>

                <span>Tambah Mata Pelajaran</span>

            </a>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

        {{-- TOTAL MAPEL --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-slate-400">
                        Total Mata Pelajaran
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ $totalMapel }}
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Bidang Studi
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
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>

                </div>

            </div>

        </div>

        {{-- TOTAL GURU --}}
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm">

            <div class="flex items-center justify-between gap-3">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-slate-400">
                        Total Guru Pengampu
                    </p>

                    <h3 class="text-2xl font-bold text-slate-800 mt-1">
                        {{ $totalGuruPengampu }}
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-0.5">
                        Guru Terdaftar Mengampu
                    </p>

                </div>

                <div class="w-11 h-11 shrink-0 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500">

                    <svg class="w-6 h-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>

                </div>

            </div>

        </div>

    </div>

    {{-- FILTER + TABLE --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6 items-start">

        {{-- FILTER --}}
        <form method="GET"
              action="{{ route('admin.mapel.index') }}"
              class="lg:col-span-3 bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">

            <div class="flex items-center justify-between gap-3 pb-3 border-b border-slate-100">

                <div class="flex items-center gap-2 min-w-0">

                    <svg class="w-4 h-4 text-orange-500 shrink-0"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707L13 17l-4 4v-6.586a1 1 0 00-.293-.707L2.293 7.293A1 1 0 002 6.586V4a1 1 0 011-1z"/>
                    </svg>

                    <span class="font-bold text-slate-800 text-sm truncate">
                        Filter Mata Pelajaran
                    </span>

                </div>

                <a href="{{ route('admin.mapel.index') }}"
                   class="text-xs text-orange-600 hover:text-orange-700 hover:underline font-semibold shrink-0">
                    Reset
                </a>

            </div>

            {{-- SEARCH --}}
            <div class="space-y-1.5">

                <label for="search"
                       class="text-xs font-bold text-slate-700">
                    Cari Mapel
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
                           placeholder="Nama atau kode mapel..."
                           class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition">

                </div>

            </div>

            {{-- KODE --}}
            <div class="space-y-1.5">

                <label for="kode"
                       class="text-xs font-bold text-slate-700">
                    Kode Mapel
                </label>

                <div class="relative">

                    <select id="kode"
                            name="kode"
                            class="w-full text-xs pl-3 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 appearance-none text-slate-600 cursor-pointer">

                        <option value="">
                            Semua Kode
                        </option>

                        @foreach ($daftarKode as $kode)

                            <option value="{{ $kode }}"
                                @selected($kodeTerpilih == $kode)>
                                {{ $kode }}
                            </option>

                        @endforeach

                    </select>

                    <svg class="w-4 h-4 text-slate-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>

                </div>

            </div>

            {{-- PER PAGE --}}
            <div class="space-y-1.5">

                <label for="per_page"
                       class="text-xs font-bold text-slate-700">
                    Data Per Halaman
                </label>

                <select id="per_page"
                        name="per_page"
                        class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 text-slate-600 cursor-pointer">

                    <option value="10" @selected((int) request('per_page', 10) === 10)>
                        10 Data
                    </option>

                    <option value="25" @selected((int) request('per_page', 10) === 25)>
                        25 Data
                    </option>

                    <option value="50" @selected((int) request('per_page', 10) === 50)>
                        50 Data
                    </option>

                </select>

            </div>

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center gap-1.5">

                <svg class="w-3.5 h-3.5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707L13 17l-4 4v-6.586a1 1 0 00-.293-.707L2.293 7.293A1 1 0 002 6.586V4a1 1 0 011-1z"/>
                </svg>

                <span>Terapkan Filter</span>

            </button>

        </form>

        {{-- TABLE --}}
        <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-4 sm:px-5 py-4 border-b border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                    <div>
                        <h3 class="text-sm font-bold text-slate-800">
                            Daftar Mata Pelajaran
                        </h3>

                        <p class="text-[11px] text-slate-400 mt-0.5">
                            Menampilkan {{ $mataPelajarans->total() }} data.
                        </p>
                    </div>

                    @if ($search !== '' || $kodeTerpilih)

                        <a href="{{ route('admin.mapel.index') }}"
                           class="text-xs font-semibold text-orange-500 hover:text-orange-600">
                            Hapus Filter
                        </a>

                    @endif

                </div>

            </div>

            {{-- TABLE TANPA SCROLL --}}
            <div class="w-full">

                <table class="w-full table-fixed text-left">

                    <thead>

                        <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">

                            <th class="w-[7%] py-3 px-2 sm:px-3 text-[10px] sm:text-[11px]">
                                No
                            </th>

                            <th class="w-[14%] py-3 px-2 sm:px-3 text-[10px] sm:text-[11px]">
                                Kode
                            </th>

                            <th class="w-[22%] py-3 px-2 sm:px-3 text-[10px] sm:text-[11px]">
                                Nama
                            </th>

                            <th class="w-[28%] py-3 px-2 sm:px-3 text-[10px] sm:text-[11px]">
                                Keterangan
                            </th>

                            <th class="w-[14%] py-3 px-2 sm:px-3 text-center text-[10px] sm:text-[11px]">
                                Guru
                            </th>

                            <th class="w-[15%] py-3 px-2 sm:px-3 text-center text-[10px] sm:text-[11px]">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse ($mataPelajarans as $index => $mapel)

                            <tr class="hover:bg-slate-50/70 transition-colors">

                                {{-- NO --}}
                                <td class="py-3 px-2 sm:px-3 text-slate-500 font-medium text-[10px] sm:text-xs">
                                    {{ $mataPelajarans->firstItem() + $index }}
                                </td>

                                {{-- KODE --}}
                                <td class="py-3 px-2 sm:px-3">

                                    <span class="inline-flex items-center max-w-full px-1.5 sm:px-2 py-1 rounded-md sm:rounded-lg bg-orange-50 text-orange-600 border border-orange-100 font-mono font-bold text-[9px] sm:text-[11px] truncate">
                                        {{ $mapel->kode }}
                                    </span>

                                </td>

                                {{-- NAMA --}}
                                <td class="py-3 px-2 sm:px-3 font-bold text-slate-800">

                                    <p class="text-[10px] sm:text-xs truncate"
                                       title="{{ $mapel->name }}">
                                        {{ $mapel->name }}
                                    </p>

                                </td>

                                {{-- KETERANGAN --}}
                                <td class="py-3 px-2 sm:px-3 text-slate-500">

                                    <p class="text-[9px] sm:text-[11px] truncate"
                                       title="{{ $mapel->keterangan }}">
                                        {{ $mapel->keterangan ?: '-' }}
                                    </p>

                                </td>

                                {{-- GURU --}}
                                <td class="py-3 px-2 sm:px-3 text-center">

                                    <span class="inline-flex items-center justify-center min-w-[24px] sm:min-w-[30px] px-1.5 sm:px-2 py-1 rounded-md bg-slate-50 border border-slate-200 font-bold text-slate-700 text-[9px] sm:text-[11px]">

                                        {{ $mapel->gurus_count ?? 0 }}

                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="py-3 px-2 sm:px-3">

                                    <div class="flex items-center justify-center gap-1">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.mapel.show', $mapel->id) }}"
                                           title="Detail"
                                           aria-label="Detail {{ $mapel->name }}"
                                           class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors shrink-0">

                                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5"
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
                                        <a href="{{ route('admin.mapel.edit', $mapel->id) }}"
                                           title="Edit"
                                           aria-label="Edit {{ $mapel->name }}"
                                           class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors shrink-0">

                                            <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>

                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('admin.mapel.destroy', $mapel->id) }}"
                                              method="POST"
                                              class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus"
                                                    aria-label="Hapus {{ $mapel->name }}"
                                                    onclick="return confirm('Yakin ingin menghapus mata pelajaran {{ $mapel->name }}?')"
                                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors shrink-0">

                                                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="py-10 px-4 text-center">

                                    <div class="flex flex-col items-center">

                                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-400 flex items-center justify-center mb-3">

                                            <svg class="w-6 h-6"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>

                                        </div>

                                        <p class="text-sm font-bold text-slate-700">
                                            Tidak ada data
                                        </p>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Tidak ada mata pelajaran yang sesuai dengan filter.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="p-4 border-t border-slate-100">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <div class="text-xs text-slate-500">

                        @if ($mataPelajarans->total() > 0)

                            Menampilkan
                            <span class="font-semibold text-slate-700">
                                {{ $mataPelajarans->firstItem() }}
                            </span>
                            -
                            <span class="font-semibold text-slate-700">
                                {{ $mataPelajarans->lastItem() }}
                            </span>
                            dari
                            <span class="font-semibold text-slate-700">
                                {{ $mataPelajarans->total() }}
                            </span>
                            data

                        @else

                            Tidak ada data

                        @endif

                    </div>

                    <div class="flex items-center justify-between gap-3">

                        @if ($mataPelajarans->hasPages())

                            <div class="flex items-center gap-1">

                                {{-- PREVIOUS --}}
                                @if ($mataPelajarans->onFirstPage())

                                    <span class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-300">
                                        &lsaquo;
                                    </span>

                                @else

                                    <a href="{{ $mataPelajarans->previousPageUrl() }}"
                                       class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-xs hover:bg-slate-50">
                                        &lsaquo;
                                    </a>

                                @endif

                                {{-- CURRENT PAGE --}}
                                <span class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center text-xs font-semibold">
                                    {{ $mataPelajarans->currentPage() }}
                                </span>

                                {{-- NEXT --}}
                                @if ($mataPelajarans->hasMorePages())

                                    <a href="{{ $mataPelajarans->nextPageUrl() }}"
                                       class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-xs hover:bg-slate-50">
                                        &rsaquo;
                                    </a>

                                @else

                                    <span class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-300">
                                        &rsaquo;
                                    </span>

                                @endif

                            </div>

                        @endif

                        {{-- PER PAGE --}}
                        <form method="GET"
                              action="{{ route('admin.mapel.index') }}">

                            <input type="hidden" name="search" value="{{ $search }}">
                            <input type="hidden" name="kode" value="{{ $kodeTerpilih }}">

                            <select name="per_page"
                                    onchange="this.form.submit()"
                                    class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-2.5 py-2 text-slate-600 focus:outline-none focus:border-orange-400">

                                <option value="10" @selected((int) request('per_page', 10) === 10)>
                                    10 / halaman
                                </option>

                                <option value="25" @selected((int) request('per_page', 10) === 25)>
                                    25 / halaman
                                </option>

                                <option value="50" @selected((int) request('per_page', 10) === 50)>
                                    50 / halaman
                                </option>

                            </select>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection