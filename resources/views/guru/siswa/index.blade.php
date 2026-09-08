@extends('layoutGuru')

@section('title', 'Data Siswa - Teacher Portal')

@section('content')

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="space-y-1.5">

            {{-- Breadcrumb --}}
            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">

                <ol class="inline-flex items-center space-x-1.5">

                    <li>

                        <a
                            href="{{ route('guru.dashboard') }}"
                            class="hover:text-orange-600 transition-colors"
                        >
                            Dashboard
                        </a>

                    </li>

                    <li>
                        <span class="text-slate-300">
                            /
                        </span>
                    </li>

                    <li class="font-medium text-slate-800">
                        Siswa
                    </li>

                </ol>

            </nav>


            <div>

                <h2 class="text-2xl font-extrabold text-slate-800">
                    Data Siswa
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Informasi siswa yang dapat dilihat oleh guru.
                </p>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STAT CARDS --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">


        {{-- Total Siswa --}}
        <div
            class="bg-white p-5 rounded-2xl
                   border border-slate-100 shadow-sm
                   flex items-center justify-between"
        >

            <div>

                <p class="text-xs font-medium text-slate-400">
                    Total Siswa
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($totalSiswa) }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Siswa terdaftar
                </p>

            </div>


            <div
                class="w-11 h-11 rounded-xl
                       bg-emerald-50
                       flex items-center justify-center
                       text-emerald-500"
            >

                <svg
                    class="w-6 h-6"
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

            </div>

        </div>


        {{-- Siswa Aktif --}}
        <div
            class="bg-white p-5 rounded-2xl
                   border border-slate-100 shadow-sm
                   flex items-center justify-between"
        >

            <div>

                <p class="text-xs font-medium text-slate-400">
                    Siswa Aktif
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($totalSiswaAktif) }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Dari {{ number_format($totalSiswa) }} siswa
                </p>

            </div>


            <div
                class="w-11 h-11 rounded-xl
                       bg-blue-50
                       flex items-center justify-center
                       text-blue-500"
            >

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />

                </svg>

            </div>

        </div>


        {{-- Total Kelas --}}
        <div
            class="bg-white p-5 rounded-2xl
                   border border-slate-100 shadow-sm
                   flex items-center justify-between"
        >

            <div>

                <p class="text-xs font-medium text-slate-400">
                    Total Kelas
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ number_format($totalKelas) }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Rombongan belajar
                </p>

            </div>


            <div
                class="w-11 h-11 rounded-xl
                       bg-orange-50
                       flex items-center justify-center
                       text-orange-500"
            >

                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                    />

                </svg>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- FILTER + TABLE --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- ========================================================= --}}
        {{-- FILTER --}}
        {{-- ========================================================= --}}

        <form
            method="GET"
            action="{{ route('guru.siswa.index') }}"
            class="lg:col-span-3
                   bg-white p-5 rounded-2xl
                   border border-slate-100
                   shadow-sm space-y-4"
        >

            <div
                class="flex items-center justify-between
                       pb-3 border-b border-slate-100"
            >

                <div class="flex items-center space-x-2">

                    <svg
                        class="w-4 h-4 text-orange-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                        />

                    </svg>

                    <span class="font-bold text-slate-800 text-sm">
                        Filter Siswa
                    </span>

                </div>


                <a
                    href="{{ route('guru.siswa.index') }}"
                    class="text-xs text-orange-600
                           hover:underline font-semibold"
                >
                    Reset
                </a>

            </div>


            {{-- Search --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Cari Siswa
                </label>

                <div class="relative">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Nama, NIS atau NISN..."
                        class="w-full text-xs
                               pl-8 pr-3 py-2.5
                               bg-slate-50
                               border border-slate-200
                               rounded-xl
                               focus:outline-none
                               focus:ring-1
                               focus:ring-orange-500
                               focus:border-orange-300"
                    >


                    <svg
                        class="w-4 h-4 text-slate-400
                               absolute left-2.5 top-3"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0
                               7 7 0 0114 0z"
                        />

                    </svg>

                </div>

            </div>


            {{-- Kelas --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Kelas
                </label>

                <select
                    name="kelas"
                    class="w-full text-xs
                           px-3 py-2.5
                           bg-slate-50
                           border border-slate-200
                           rounded-xl
                           focus:outline-none
                           focus:ring-1
                           focus:ring-orange-500
                           text-slate-600"
                >

                    <option value="">
                        Semua Kelas
                    </option>

                    @foreach($daftarKelas as $kelas)

                        <option
                            value="{{ $kelas }}"
                            {{ $kelasTerpilih == $kelas ? 'selected' : '' }}
                        >
                            {{ $kelas }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full text-xs
                           px-3 py-2.5
                           bg-slate-50
                           border border-slate-200
                           rounded-xl
                           focus:outline-none
                           focus:ring-1
                           focus:ring-orange-500
                           text-slate-600"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="aktif"
                        {{ $statusTerpilih == 'aktif' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="lulus"
                        {{ $statusTerpilih == 'lulus' ? 'selected' : '' }}
                    >
                        Lulus / Alumni
                    </option>

                </select>

            </div>


            <input
                type="hidden"
                name="per_page"
                value="{{ $perPage }}"
            >


            <button
                type="submit"
                class="w-full mt-2
                       bg-orange-500 hover:bg-orange-600
                       text-white text-xs font-semibold
                       py-2.5 rounded-xl
                       shadow-sm transition-all
                       flex items-center justify-center
                       space-x-1.5"
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
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                    />

                </svg>

                <span>
                    Terapkan Filter
                </span>

            </button>

        </form>


        {{-- ========================================================= --}}
        {{-- TABLE --}}
        {{-- ========================================================= --}}

        <div
            class="lg:col-span-9
                   bg-white rounded-2xl
                   border border-slate-100
                   shadow-sm overflow-hidden"
        >

            <div class="overflow-x-auto">

                <table class="w-full text-left text-xs">

                    <thead>

                        <tr
                            class="bg-amber-50/40
                                   border-b border-slate-100
                                   text-slate-500 font-semibold"
                        >

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
                                Status
                            </th>

                            <th class="py-3 px-4 text-center">
                                Detail
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse($siswa as $index => $s)

                            @php

                                $inisial = collect(
                                    preg_split('/\s+/', trim($s->name))
                                )
                                ->filter()
                                ->map(
                                    fn ($kata) => strtoupper(
                                        substr($kata, 0, 1)
                                    )
                                )
                                ->take(2)
                                ->implode('');

                            @endphp


                            <tr class="hover:bg-slate-50/50 transition-colors">


                                {{-- NO --}}
                                <td
                                    class="py-3.5 px-4 pl-5
                                           text-slate-500 font-medium"
                                >

                                    {{ $siswa->firstItem() + $index }}

                                </td>


                                {{-- NAMA --}}
                                <td class="py-3.5 px-4">

                                    <div class="flex items-center space-x-3">

                                        <div
                                            class="w-8 h-8 rounded-full
                                                   bg-emerald-100
                                                   text-emerald-700
                                                   overflow-hidden
                                                   shrink-0
                                                   flex items-center
                                                   justify-center
                                                   font-bold text-xs"
                                        >

                                            {{ $inisial ?: '?' }}

                                        </div>


                                        <div class="min-w-0">

                                            <p
                                                class="font-bold text-slate-800
                                                       truncate max-w-[180px]"
                                            >
                                                {{ $s->name }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- NIS --}}
                                <td
                                    class="py-3.5 px-4
                                           text-slate-600 font-medium"
                                >

                                    {{ $s->nis ?: '-' }}

                                </td>


                                {{-- KELAS --}}
                                <td
                                    class="py-3.5 px-4
                                           font-semibold text-slate-700"
                                >

                                    {{ $s->kelas ?: '-' }}

                                </td>


                                {{-- STATUS --}}
                                <td class="py-3.5 px-4">

                                    @if($s->status === 'aktif')

                                        <span
                                            class="inline-flex items-center
                                                   px-2 py-0.5
                                                   rounded-full
                                                   text-[11px] font-medium
                                                   bg-emerald-50
                                                   text-emerald-600"
                                        >

                                            <span
                                                class="w-1.5 h-1.5
                                                       rounded-full
                                                       bg-emerald-500
                                                       mr-1.5"
                                            >
                                            </span>

                                            Aktif

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center
                                                   px-2 py-0.5
                                                   rounded-full
                                                   text-[11px] font-medium
                                                   bg-slate-100
                                                   text-slate-500"
                                        >

                                            <span
                                                class="w-1.5 h-1.5
                                                       rounded-full
                                                       bg-slate-400
                                                       mr-1.5"
                                            >
                                            </span>

                                            {{ ucfirst($s->status ?? 'Tidak diketahui') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- DETAIL --}}
                                <td
                                    class="py-3.5 px-4 text-center"
                                >

                                    <a
                                        href="{{ route('guru.siswa.show', ['siswa' => $s->id]) }}"
                                        title="Lihat Detail"
                                        class="inline-flex items-center
                                               justify-center
                                               w-8 h-8
                                               rounded-lg
                                               bg-orange-50
                                               text-orange-600
                                               hover:bg-orange-100
                                               border border-orange-200
                                               transition-colors"
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
                                                d="M15 12a3 3 0 11-6 0
                                                   3 3 0 016 0z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943
                                                   7.523 5
                                                   12 5
                                                   c4.478 0
                                                   8.268 2.943
                                                   9.542 7
                                                   -1.274 4.057
                                                   -5.064 7
                                                   -9.542 7
                                                   -4.477 0
                                                   -8.268-2.943
                                                   -9.542-7z"
                                            />

                                        </svg>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="py-14 text-center"
                                >

                                    <div
                                        class="w-12 h-12 mx-auto
                                               rounded-xl
                                               bg-slate-50
                                               flex items-center justify-center"
                                    >

                                        <svg
                                            class="w-6 h-6 text-slate-300"
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

                                    </div>

                                    <p
                                        class="text-xs font-semibold
                                               text-slate-600 mt-3"
                                    >
                                        Data siswa tidak ditemukan
                                    </p>

                                    <p
                                        class="text-[10px] text-slate-400 mt-1"
                                    >
                                        Coba ubah kata pencarian atau filter.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ===================================================== --}}
            {{-- PAGINATION --}}
            {{-- ===================================================== --}}

            <div
                class="p-4
                       border-t border-slate-100
                       flex flex-col sm:flex-row
                       items-center justify-between
                       text-xs text-slate-500
                       gap-3"
            >

                <div>

                    @if($siswa->total() > 0)

                        Menampilkan
                        {{ $siswa->firstItem() }}
                        -
                        {{ $siswa->lastItem() }}
                        dari
                        {{ $siswa->total() }}
                        data

                    @else

                        Tidak ada data

                    @endif

                </div>


                <div class="flex items-center gap-3">

                    {{-- Pagination --}}
                    <div class="flex items-center gap-1">

                        {{-- Previous --}}
                        @if($siswa->onFirstPage())

                            <span
                                class="w-7 h-7 rounded-lg
                                       border border-slate-200
                                       flex items-center justify-center
                                       text-slate-300"
                            >
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $siswa->previousPageUrl() }}"
                                class="w-7 h-7 rounded-lg
                                       border border-slate-200
                                       flex items-center justify-center
                                       text-slate-500
                                       hover:bg-slate-50
                                       transition"
                            >
                                ‹
                            </a>

                        @endif


                        {{-- Pages --}}
                        @foreach($siswa->getUrlRange(
                            max(1, $siswa->currentPage() - 2),
                            min($siswa->lastPage(), $siswa->currentPage() + 2)
                        ) as $page => $url)

                            <a
                                href="{{ $url }}"
                                class="w-7 h-7 rounded-lg
                                       flex items-center justify-center
                                       font-semibold
                                       {{ $page == $siswa->currentPage()
                                           ? 'bg-orange-500 text-white shadow-sm'
                                           : 'border border-slate-200 text-slate-600 hover:bg-slate-50' }}"
                            >

                                {{ $page }}

                            </a>

                        @endforeach


                        {{-- Next --}}
                        @if($siswa->hasMorePages())

                            <a
                                href="{{ $siswa->nextPageUrl() }}"
                                class="w-7 h-7 rounded-lg
                                       border border-slate-200
                                       flex items-center justify-center
                                       text-slate-500
                                       hover:bg-slate-50
                                       transition"
                            >
                                ›
                            </a>

                        @else

                            <span
                                class="w-7 h-7 rounded-lg
                                       border border-slate-200
                                       flex items-center justify-center
                                       text-slate-300"
                            >
                                ›
                            </span>

                        @endif

                    </div>


                    {{-- Per Page --}}
                    <form
                        method="GET"
                        action="{{ route('guru.siswa.index') }}"
                    >

                        <input
                            type="hidden"
                            name="search"
                            value="{{ $search }}"
                        >

                        <input
                            type="hidden"
                            name="kelas"
                            value="{{ $kelasTerpilih }}"
                        >

                        <input
                            type="hidden"
                            name="status"
                            value="{{ $statusTerpilih }}"
                        >


                        <select
                            name="per_page"
                            onchange="this.form.submit()"
                            class="text-xs
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   px-2.5 py-1.5
                                   text-slate-600
                                   focus:outline-none"
                        >

                            <option
                                value="10"
                                {{ $perPage == 10 ? 'selected' : '' }}
                            >
                                10 / halaman
                            </option>

                            <option
                                value="25"
                                {{ $perPage == 25 ? 'selected' : '' }}
                            >
                                25 / halaman
                            </option>

                            <option
                                value="50"
                                {{ $perPage == 50 ? 'selected' : '' }}
                            >
                                50 / halaman
                            </option>

                        </select>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection