@extends('layoutGuru')

@section('title', 'Predikat & Deskripsi Rapor')

@section('content')

<div class="w-full mx-auto px-3 sm:px-4 lg:px-8 py-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="mb-6">

        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">

            <a
                href="{{ route('guru.dashboard') }}"
                class="hover:text-orange-600 transition"
            >
                Dashboard
            </a>

            <span>/</span>

            <span class="text-slate-500">
                Predikat & Deskripsi
            </span>

        </div>


        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Predikat & Deskripsi Rapor
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Kelola predikat dan deskripsi siswa berdasarkan nilai
            yang telah tersedia.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- SUCCESS --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div
            class="mb-5 flex items-start gap-3
                   rounded-xl border border-green-200
                   bg-green-50 px-4 py-3
                   text-sm text-green-700"
        >

            <svg
                class="w-5 h-5 flex-shrink-0 mt-0.5"
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

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- ERROR --}}
    {{-- ========================================================= --}}

    @if($errors->any())

        <div
            class="mb-5 rounded-xl border border-red-200
                   bg-red-50 px-4 py-3
                   text-sm text-red-700"
        >

            <div class="flex items-start gap-3">

                <svg
                    class="w-5 h-5 flex-shrink-0 mt-0.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.72 3h17.62a2 2 0 001.72-3l-8.82-15a2 2 0 00-3.42 0z"
                    />

                </svg>


                <ul class="list-disc pl-4 space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- CARD DAFTAR SISWA --}}
    {{-- ========================================================= --}}

    <div
        class="bg-white border border-slate-200
               rounded-2xl shadow-sm p-5 sm:p-6"
    >

        {{-- ===================================================== --}}
        {{-- HEADER CARD --}}
        {{-- ===================================================== --}}

        <div
            class="flex flex-col
                   sm:flex-row
                   sm:items-end
                   sm:justify-between
                   gap-5"
        >

            <div>

                <div class="flex items-center gap-2">

                    <div
                        class="w-9 h-9
                               rounded-lg
                               bg-orange-50
                               flex items-center
                               justify-center"
                    >

                        <svg
                            class="w-5 h-5 text-orange-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-10a4 4 0 100-8 4 4 0 000 8zm7-3a3 3 0 110-6 3 3 0 010 6zm0 4a4 4 0 014 4v1"
                            />

                        </svg>

                    </div>


                    <div>

                        <h2 class="text-base font-semibold text-slate-800">
                            Daftar Siswa
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Kelola predikat dan deskripsi berdasarkan nilai siswa.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- DROPDOWN KELAS --}}
            {{-- ================================================= --}}

            <form
                method="GET"
                action="{{ route('guru.rapot.predikat.index') }}"
                class="w-full sm:w-72"
            >

                <label
                    for="kelas"
                    class="flex items-center gap-1.5
                           text-xs font-bold
                           text-slate-700 mb-2"
                >

                    <svg
                        class="w-3.5 h-3.5 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 7h18M5 7v13a1 1 0 001 1h12a1 1 0 001-1V7M9 11v6m6-6v6M8 7l1-3h6l1 3"
                        />

                    </svg>

                    Pilih Kelas

                </label>


                <div class="relative">

                    <select
                        id="kelas"
                        name="kelas"
                        onchange="this.form.submit()"
                        class="appearance-none
                               w-full h-11
                               rounded-xl
                               border border-slate-300
                               bg-slate-50
                               px-4 pr-11
                               text-sm font-semibold
                               text-slate-700
                               shadow-sm
                               cursor-pointer
                               outline-none
                               transition
                               hover:border-slate-400
                               hover:bg-white
                               focus:border-orange-500
                               focus:bg-white
                               focus:ring-4
                               focus:ring-orange-500/10"
                    >

                        <option value="">
                            Pilih kelas
                        </option>

                        @foreach($daftarKelas as $kelas)

                            <option
                                value="{{ $kelas }}"
                                @selected($kelasTerpilih === $kelas)
                            >
                                {{ $kelas }}
                            </option>

                        @endforeach

                    </select>


                    <div
                        class="pointer-events-none
                               absolute inset-y-0 right-0
                               flex items-center
                               pr-4"
                    >

                        <svg
                            class="w-4 h-4 text-orange-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />

                        </svg>

                    </div>

                </div>

            </form>

        </div>


        {{-- ===================================================== --}}
        {{-- LEGEND STATUS --}}
        {{-- ===================================================== --}}

        @if($kelasTerpilih && $daftarSiswa->count())

            <div
                class="mt-5
                       flex flex-wrap
                       items-center gap-x-5 gap-y-2
                       border-t border-slate-100
                       pt-4"
            >

                <span class="text-xs font-semibold text-slate-500">
                    Status deskripsi:
                </span>


                <div class="inline-flex items-center gap-2">

                    <span
                        class="w-2 h-2 rounded-full bg-green-500"
                    ></span>

                    <span class="text-xs text-slate-500">
                        Lengkap
                    </span>

                </div>


                <div class="inline-flex items-center gap-2">

                    <span
                        class="w-2 h-2 rounded-full bg-amber-500"
                    ></span>

                    <span class="text-xs text-slate-500">
                        Sebagian
                    </span>

                </div>


                <div class="inline-flex items-center gap-2">

                    <span
                        class="w-2 h-2 rounded-full bg-slate-300"
                    ></span>

                    <span class="text-xs text-slate-500">
                        Belum diisi
                    </span>

                </div>

            </div>

        @endif


        {{-- ===================================================== --}}
        {{-- TABLE SISWA --}}
        {{-- ===================================================== --}}

        @if($kelasTerpilih)

            @if($daftarSiswa->count())

                <div
                    class="mt-5
                           overflow-x-auto
                           rounded-xl
                           border border-slate-100"
                >

                    <table class="w-full text-sm">

                        <thead>

                            <tr
                                class="bg-slate-50
                                       border-b border-slate-200
                                       text-left"
                            >

                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           whitespace-nowrap"
                                >
                                    No
                                </th>


                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           whitespace-nowrap"
                                >
                                    Nama Siswa
                                </th>


                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           whitespace-nowrap"
                                >
                                    NIS
                                </th>


                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           whitespace-nowrap"
                                >
                                    Kelas
                                </th>


                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           whitespace-nowrap"
                                >
                                    Status Deskripsi
                                </th>


                                <th
                                    class="px-4 py-3
                                           text-xs font-bold
                                           text-slate-500
                                           text-right
                                           whitespace-nowrap"
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($daftarSiswa as $index => $item)

                                <tr
                                    class="hover:bg-orange-50/40
                                           transition"
                                >

                                    {{-- NO --}}

                                    <td
                                        class="px-4 py-3
                                               text-slate-500"
                                    >
                                        {{ $index + 1 }}
                                    </td>


                                    {{-- NAMA --}}

                                    <td
                                        class="px-4 py-3
                                               font-semibold
                                               text-slate-800
                                               whitespace-nowrap"
                                    >
                                        {{ $item->name }}
                                    </td>


                                    {{-- NIS --}}

                                    <td
                                        class="px-4 py-3
                                               text-slate-600
                                               whitespace-nowrap"
                                    >
                                        {{ $item->nis }}
                                    </td>


                                    {{-- KELAS --}}

                                    <td
                                        class="px-4 py-3
                                               text-slate-600
                                               whitespace-nowrap"
                                    >
                                        {{ $item->kelas }}
                                    </td>


                                    {{-- STATUS --}}

                                    <td class="px-4 py-3">

                                        @if($item->total_nilai > 0)

                                            @if(
                                                $item->total_deskripsi >=
                                                $item->total_nilai
                                            )

                                                <div
                                                    class="inline-flex
                                                           items-center
                                                           gap-2"
                                                >

                                                    <span
                                                        class="w-2 h-2
                                                               rounded-full
                                                               bg-green-500"
                                                    ></span>

                                                    <span
                                                        class="text-xs
                                                               font-semibold
                                                               text-green-700"
                                                    >
                                                        Lengkap
                                                    </span>

                                                    <span
                                                        class="text-xs
                                                               text-slate-400"
                                                    >
                                                        {{ $item->total_deskripsi }}/{{ $item->total_nilai }}
                                                        mapel
                                                    </span>

                                                </div>

                                            @elseif($item->total_deskripsi > 0)

                                                <div
                                                    class="inline-flex
                                                           items-center
                                                           gap-2"
                                                >

                                                    <span
                                                        class="w-2 h-2
                                                               rounded-full
                                                               bg-amber-500"
                                                    ></span>

                                                    <span
                                                        class="text-xs
                                                               font-semibold
                                                               text-amber-700"
                                                    >
                                                        Sebagian
                                                    </span>

                                                    <span
                                                        class="text-xs
                                                               text-slate-400"
                                                    >
                                                        {{ $item->total_deskripsi }}/{{ $item->total_nilai }}
                                                        mapel
                                                    </span>

                                                </div>

                                            @else

                                                <div
                                                    class="inline-flex
                                                           items-center
                                                           gap-2"
                                                >

                                                    <span
                                                        class="w-2 h-2
                                                               rounded-full
                                                               bg-slate-300"
                                                    ></span>

                                                    <span
                                                        class="text-xs
                                                               font-semibold
                                                               text-slate-500"
                                                    >
                                                        Belum diisi
                                                    </span>

                                                </div>

                                            @endif

                                        @else

                                            <span
                                                class="text-xs
                                                       text-slate-400"
                                            >
                                                Belum ada nilai
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}

                                    <td
                                        class="px-4 py-3
                                               text-right"
                                    >

                                        <a
                                            href="{{ route(
                                                'guru.rapot.predikat.index',
                                                [
                                                    'kelas' => $kelasTerpilih,
                                                    'siswa' => $item->id,
                                                ]
                                            ) }}"
                                            class="inline-flex
                                                   items-center
                                                   gap-1.5
                                                   rounded-lg
                                                   bg-orange-50
                                                   px-3 py-2
                                                   text-xs font-semibold
                                                   text-orange-600
                                                   hover:bg-orange-100
                                                   transition
                                                   whitespace-nowrap"
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
                                                    d="M15 12H3m12 0l-4-4m4 4l-4 4m6-9h1a2 2 0 012 2v10a2 2 0 01-2 2H8a2 2 0 01-2-2v-1"
                                                />

                                            </svg>

                                            Kelola

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                {{-- ================================================= --}}
                {{-- TIDAK ADA SISWA --}}
                {{-- ================================================= --}}

                <div class="mt-6 py-10 text-center">

                    <div
                        class="mx-auto w-12 h-12
                               rounded-xl bg-slate-50
                               flex items-center justify-center"
                    >

                        <svg
                            class="w-6 h-6 text-slate-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656.126-1.283.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"
                            />

                        </svg>

                    </div>

                    <h3
                        class="mt-4 font-semibold
                               text-slate-800"
                    >
                        Belum Ada Siswa
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Tidak ada siswa aktif pada kelas ini.
                    </p>

                </div>

            @endif

        @else

            {{-- ================================================= --}}
            {{-- BELUM PILIH KELAS --}}
            {{-- ================================================= --}}

            <div class="mt-6 py-10 text-center">

                <div
                    class="mx-auto w-12 h-12
                           rounded-xl bg-orange-50
                           flex items-center justify-center"
                >

                    <svg
                        class="w-6 h-6 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 7h18M5 7v13a1 1 0 001 1h12a1 1 0 001-1V7M9 11v6m6-6v6M8 7l1-3h6l1 3"
                        />

                    </svg>

                </div>

                <h3
                    class="mt-4 font-semibold
                           text-slate-800"
                >
                    Pilih Kelas Terlebih Dahulu
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    Pilih kelas untuk menampilkan daftar siswa.
                </p>

            </div>

        @endif

    </div>


    {{-- ========================================================= --}}
    {{-- SISWA TERPILIH --}}
    {{-- ========================================================= --}}

    @if($siswa)

        <div
            class="mt-5 bg-white border border-slate-200
                   rounded-2xl shadow-sm p-5 sm:p-6"
        >

            {{-- ================================================= --}}
            {{-- IDENTITAS SISWA --}}
            {{-- ================================================= --}}

            <div
                class="flex flex-col
                       sm:flex-row
                       sm:items-center
                       sm:justify-between
                       gap-4"
            >

                <div>

                    <p
                        class="text-xs font-semibold
                               text-orange-600 uppercase
                               tracking-wide"
                    >
                        Siswa Terpilih
                    </p>

                    <h2
                        class="mt-1 text-lg font-bold
                               text-slate-800"
                    >
                        {{ $siswa->name }}
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">

                        NIS {{ $siswa->nis }}

                        <span class="mx-1">
                            •
                        </span>

                        {{ $siswa->kelas }}

                    </p>

                </div>


                <a
                    href="{{ route(
                        'guru.rapot.predikat.index',
                        ['kelas' => $kelasTerpilih]
                    ) }}"
                    class="inline-flex
                           items-center
                           justify-center
                           rounded-lg
                           border border-slate-200
                           px-3 py-2
                           text-xs font-semibold
                           text-slate-600
                           hover:bg-slate-50
                           transition"
                >
                    Kembali ke Daftar Siswa
                </a>

            </div>


            {{-- ================================================= --}}
            {{-- PILIH MAPEL --}}
            {{-- ================================================= --}}

            <div class="mt-7">

                <form
                    method="GET"
                    action="{{ route('guru.rapot.predikat.index') }}"
                >

                    <input
                        type="hidden"
                        name="kelas"
                        value="{{ $kelasTerpilih }}"
                    >

                    <input
                        type="hidden"
                        name="siswa"
                        value="{{ $siswa->id }}"
                    >


                    <label
                        for="mapel_id"
                        class="flex items-center gap-1.5
                               text-sm font-bold
                               text-slate-700 mb-2"
                    >

                        <svg
                            class="w-4 h-4 text-orange-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"
                            />

                        </svg>

                        Mata Pelajaran

                    </label>


                    @if($daftarMapel->count())

                        <div class="w-full sm:max-w-lg">

                            <div class="relative">

                                <select
                                    id="mapel_id"
                                    name="mapel_id"
                                    onchange="this.form.submit()"
                                    class="appearance-none
                                           w-full h-12
                                           rounded-xl
                                           border-2
                                           border-slate-300
                                           bg-slate-50
                                           px-4 pr-12
                                           text-sm font-semibold
                                           text-slate-700
                                           shadow-sm
                                           cursor-pointer
                                           outline-none
                                           transition
                                           hover:border-slate-400
                                           hover:bg-white
                                           focus:border-orange-500
                                           focus:bg-white
                                           focus:ring-4
                                           focus:ring-orange-500/10"
                                >

                                    <option value="">
                                        Pilih mata pelajaran
                                    </option>

                                    @foreach($daftarMapel as $mapel)

                                        <option
                                            value="{{ $mapel->id }}"
                                            @selected(
                                                (string) $mapelTerpilih ===
                                                (string) $mapel->id
                                            )
                                        >
                                            {{ $mapel->name }}
                                        </option>

                                    @endforeach

                                </select>


                                <div
                                    class="pointer-events-none
                                           absolute inset-y-0 right-0
                                           flex items-center
                                           pr-4"
                                >

                                    <svg
                                        class="w-5 h-5
                                               text-orange-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        />

                                    </svg>

                                </div>

                            </div>


                            <div
                                class="flex items-start gap-2
                                       mt-2.5"
                            >

                                <svg
                                    class="w-3.5 h-3.5
                                           text-slate-400
                                           mt-0.5
                                           flex-shrink-0"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                                    />

                                </svg>

                                <p class="text-xs text-slate-400">
                                    Hanya mata pelajaran yang sudah memiliki
                                    nilai untuk siswa ini yang ditampilkan.
                                </p>

                            </div>

                        </div>

                    @else

                        <div
                            class="rounded-xl border
                                   border-amber-200
                                   bg-amber-50
                                   px-4 py-3
                                   text-sm text-amber-700"
                        >
                            Siswa ini belum memiliki nilai dari
                            mata pelajaran yang Anda ampu.
                        </div>

                    @endif

                </form>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- DETAIL NILAI + DESKRIPSI --}}
        {{-- ========================================================= --}}

        @if($nilai && $mataPelajaran)

            <div
                class="mt-5 grid
                       grid-cols-1
                       lg:grid-cols-3
                       gap-5"
            >

                {{-- ================================================= --}}
                {{-- INFORMASI NILAI --}}
                {{-- ================================================= --}}

                <div
                    class="bg-white border border-slate-200
                           rounded-2xl shadow-sm p-5"
                >

                    <div
                        class="flex items-center
                               justify-between mb-5"
                    >

                        <h2
                            class="font-semibold
                                   text-slate-800"
                        >
                            Informasi Nilai
                        </h2>


                        <span
                            class="inline-flex
                                   items-center
                                   rounded-lg
                                   bg-orange-50
                                   px-2.5 py-1
                                   text-xs font-bold
                                   text-orange-700"
                        >
                            {{ $predikat }}
                        </span>

                    </div>


                    <div class="space-y-4">

                        <div>

                            <p class="text-xs text-slate-400">
                                Nama Siswa
                            </p>

                            <p
                                class="text-sm font-semibold
                                       text-slate-800 mt-1"
                            >
                                {{ $siswa->name }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                NIS
                            </p>

                            <p class="text-sm text-slate-700 mt-1">
                                {{ $siswa->nis }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                Kelas
                            </p>

                            <p class="text-sm text-slate-700 mt-1">
                                {{ $siswa->kelas }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                Mata Pelajaran
                            </p>

                            <p
                                class="text-sm font-semibold
                                       text-slate-800 mt-1"
                            >
                                {{ $mataPelajaran->name }}
                            </p>

                        </div>


                        <div
                            class="pt-3
                                   border-t
                                   border-slate-100"
                        >

                            <p class="text-xs text-slate-400">
                                Nilai
                            </p>

                            <p
                                class="text-3xl font-bold
                                       text-orange-600 mt-1"
                            >
                                {{ number_format($nilai->nilai, 0) }}
                            </p>

                        </div>


                        <div>

                            <p class="text-xs text-slate-400">
                                Predikat
                            </p>

                            <span
                                class="inline-flex mt-2
                                       items-center
                                       justify-center
                                       min-w-10
                                       rounded-lg
                                       bg-orange-50
                                       px-3 py-1.5
                                       text-sm font-bold
                                       text-orange-700"
                            >
                                {{ $predikat }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- DESKRIPSI --}}
                {{-- ================================================= --}}

                <div class="lg:col-span-2">

                    <div
                        class="bg-white border border-slate-200
                               rounded-2xl shadow-sm
                               p-5 sm:p-6"
                    >

                        <div
                            class="flex flex-col
                                   sm:flex-row
                                   sm:items-start
                                   sm:justify-between
                                   gap-3 mb-5"
                        >

                            <div>

                                <div
                                    class="flex items-center
                                           gap-2"
                                >

                                    <h2
                                        class="text-base
                                               font-semibold
                                               text-slate-800"
                                    >
                                        Deskripsi Kompetensi
                                    </h2>


                                    @if($deskripsiTersimpan)

                                        <span
                                            class="inline-flex
                                                   items-center
                                                   gap-1
                                                   rounded-md
                                                   bg-green-50
                                                   px-2 py-1
                                                   text-[11px]
                                                   font-semibold
                                                   text-green-700"
                                        >

                                            <span
                                                class="w-1.5 h-1.5
                                                       rounded-full
                                                       bg-green-500"
                                            ></span>

                                            Tersimpan

                                        </span>

                                    @endif

                                </div>


                                <p
                                    class="text-xs text-slate-500
                                           mt-1"
                                >

                                    @if($deskripsiTersimpan)

                                        Deskripsi yang tersimpan dapat
                                        diedit dan diperbarui.

                                    @else

                                        Deskripsi dibuat otomatis berdasarkan
                                        predikat nilai dan masih dapat diedit.

                                    @endif

                                </p>

                            </div>


                            @if($template)

                                <span
                                    class="inline-flex
                                           self-start
                                           rounded-lg
                                           bg-slate-100
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-slate-600"
                                >

                                    Template:
                                    {{ $template->nama }}

                                </span>

                            @endif

                        </div>


                        {{-- ================================================= --}}
                        {{-- FORM DESKRIPSI --}}
                        {{-- ================================================= --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'guru.rapot.predikat.store'
                            ) }}"
                        >

                            @csrf


                            <input
                                type="hidden"
                                name="kelas"
                                value="{{ $kelasTerpilih }}"
                            >


                            <input
                                type="hidden"
                                name="id_siswa"
                                value="{{ $siswa->id }}"
                            >


                            <input
                                type="hidden"
                                name="id_mata_pelajaran"
                                value="{{ $mataPelajaran->id }}"
                            >


                            {{-- DESKRIPSI --}}

                            <div>

                                <label
                                    for="deskripsi"
                                    class="block text-sm
                                           font-semibold
                                           text-slate-700 mb-2"
                                >
                                    Deskripsi
                                </label>


                                <textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="8"
                                    maxlength="2000"
                                    required
                                    class="w-full rounded-xl
                                           border border-slate-200
                                           bg-white
                                           px-4 py-3
                                           text-sm
                                           leading-6
                                           text-slate-700
                                           outline-none
                                           resize-y
                                           transition
                                           focus:border-orange-500
                                           focus:ring-4
                                           focus:ring-orange-500/10"
                                >{{ old('deskripsi', $deskripsi) }}</textarea>


                                <div
                                    class="flex flex-col
                                           sm:flex-row
                                           sm:justify-between
                                           gap-1 mt-2"
                                >

                                    <p class="text-xs text-slate-400">
                                        Guru dapat menyesuaikan isi
                                        deskripsi sebelum menyimpannya.
                                    </p>


                                    <p
                                        id="counter"
                                        class="text-xs text-slate-400
                                               sm:text-right"
                                    >
                                        0 / 2000
                                    </p>

                                </div>

                            </div>


                            {{-- ================================================= --}}
                            {{-- TEMPLATE INFO --}}
                            {{-- ================================================= --}}

                            <div
                                class="mt-4 rounded-xl
                                       bg-slate-50
                                       border border-slate-100
                                       px-4 py-3"
                            >

                                <div
                                    class="flex items-center
                                           justify-between
                                           gap-3"
                                >

                                    <p
                                        class="text-xs font-semibold
                                               text-slate-600"
                                    >
                                        Template menggunakan data:
                                    </p>

                                    <span
                                        class="text-[11px]
                                               text-slate-400"
                                    >
                                        Otomatis
                                    </span>

                                </div>


                                <div
                                    class="flex flex-wrap
                                           gap-2 mt-2"
                                >

                                    <span
                                        class="rounded-md
                                               bg-white
                                               border border-slate-200
                                               px-2.5 py-1
                                               text-xs
                                               text-slate-600"
                                    >
                                        Nama siswa
                                    </span>


                                    <span
                                        class="rounded-md
                                               bg-white
                                               border border-slate-200
                                               px-2.5 py-1
                                               text-xs
                                               text-slate-600"
                                    >
                                        Mata pelajaran
                                    </span>


                                    <span
                                        class="rounded-md
                                               bg-white
                                               border border-slate-200
                                               px-2.5 py-1
                                               text-xs
                                               text-slate-600"
                                    >
                                        Predikat {{ $predikat }}
                                    </span>

                                </div>

                            </div>


                            {{-- ================================================= --}}
                            {{-- ACTION --}}
                            {{-- ================================================= --}}

                            <div
                                class="mt-6
                                       flex flex-col-reverse
                                       sm:flex-row
                                       sm:justify-end
                                       gap-3"
                            >

                                {{-- HAPUS --}}
                                @if($deskripsiTersimpan)

                                    <button
                                        type="button"
                                        onclick="confirmDeleteDeskripsi()"
                                        class="inline-flex
                                               items-center
                                               justify-center
                                               rounded-xl
                                               border border-red-200
                                               bg-red-50
                                               px-5 py-2.5
                                               text-sm font-semibold
                                               text-red-600
                                               hover:bg-red-100
                                               transition"
                                    >

                                        <svg
                                            class="w-4 h-4 mr-2"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13M10 11v5m4-5v5"
                                            />

                                        </svg>

                                        Hapus Deskripsi

                                    </button>

                                @endif


                                {{-- SIMPAN / UPDATE --}}

                                <button
                                    type="submit"
                                    class="inline-flex
                                           items-center
                                           justify-center
                                           rounded-xl
                                           bg-orange-600
                                           px-5 py-2.5
                                           text-sm font-semibold
                                           text-white
                                           hover:bg-orange-700
                                           transition"
                                >

                                    <svg
                                        class="w-4 h-4 mr-2"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        @if($deskripsiTersimpan)

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />

                                        @else

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14M12 5l7 7-7 7"
                                            />

                                        @endif

                                    </svg>


                                    @if($deskripsiTersimpan)

                                        Perbarui Deskripsi

                                    @else

                                        Simpan Deskripsi

                                    @endif

                                </button>

                            </div>

                        </form>


                        {{-- ================================================= --}}
                        {{-- FORM DELETE TERPISAH --}}
                        {{-- ================================================= --}}

                        @if($deskripsiTersimpan)

                            <form
                                id="delete-deskripsi-form"
                                method="POST"
                                action="{{ route(
                                    'guru.rapot.predikat.destroy',
                                    $deskripsiTersimpan->id
                                ) }}"
                                class="hidden"
                            >

                                @csrf

                                @method('DELETE')

                            </form>

                        @endif

                    </div>

                </div>

            </div>


        @elseif($daftarMapel->count())

            {{-- ================================================= --}}
            {{-- BELUM PILIH MAPEL --}}
            {{-- ================================================= --}}

            <div
                class="mt-5 bg-white
                       border border-slate-200
                       rounded-2xl
                       p-8 text-center"
            >

                <div
                    class="mx-auto w-12 h-12
                           rounded-xl bg-orange-50
                           flex items-center
                           justify-center"
                >

                    <svg
                        class="w-6 h-6 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M9 12h6m-6 4h4m-8-8h10M6 3h9l4 4v14H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                        />

                    </svg>

                </div>


                <h3
                    class="mt-4 font-semibold
                           text-slate-800"
                >
                    Pilih Mata Pelajaran
                </h3>


                <p class="mt-1 text-sm text-slate-500">
                    Pilih mata pelajaran yang sudah memiliki nilai
                    untuk membuat atau mengubah deskripsi rapor.
                </p>

            </div>

        @endif

    @endif

</div>


{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const textarea =
        document.getElementById('deskripsi');

    const counter =
        document.getElementById('counter');


    if (textarea && counter) {

        function updateCounter()
        {
            counter.textContent =
                textarea.value.length + ' / 2000';
        }


        textarea.addEventListener(
            'input',
            updateCounter
        );


        updateCounter();

    }

});


/*
|--------------------------------------------------------------------------
| KONFIRMASI HAPUS
|--------------------------------------------------------------------------
*/

function confirmDeleteDeskripsi()
{
    const confirmed = confirm(
        'Apakah Anda yakin ingin menghapus deskripsi rapor ini?\n\n' +
        'Nilai siswa tidak akan terhapus.'
    );

    if (confirmed) {

        const form =
            document.getElementById(
                'delete-deskripsi-form'
            );

        if (form) {
            form.submit();
        }
    }
}

</script>

@endsection
