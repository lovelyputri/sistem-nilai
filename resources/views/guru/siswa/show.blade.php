@extends('layoutGuru')

@section('title', 'Detail Siswa - Teacher Portal')

@section('content')

<div class="w-full max-w-6xl mx-auto space-y-5">
{{-- BREADCRUMB --}}
<nav class="flex items-center gap-2 text-xs font-medium text-slate-400">

    <a
        href="{{ route('guru.dashboard') }}"
        class="hover:text-orange-600 transition-colors"
    >
        Dashboard
    </a>

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
            d="M9 5l7 7-7 7"
        />
    </svg>

    <a
        href="{{ route('guru.siswa.index') }}"
        class="hover:text-orange-600 transition-colors"
    >
        Siswa
    </a>

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
            d="M9 5l7 7-7 7"
        />
    </svg>

    <span class="text-slate-600">
        Detail Siswa
    </span>

</nav>


{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

    <div>

        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-800">
            Detail Siswa
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Informasi lengkap mengenai data siswa.
        </p>

    </div>

    <a
        href="{{ route('guru.siswa.index') }}"
        class="inline-flex items-center justify-center gap-2
               px-4 py-2.5
               rounded-xl
               bg-white
               border border-slate-200
               text-sm font-semibold
               text-slate-600
               hover:bg-orange-50
               hover:text-orange-600
               hover:border-orange-200
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
                d="M10 19l-7-7m0 0l7-7m-7 7h18"
            />
        </svg>

        Kembali

    </a>

</div>


{{-- PROFILE HERO --}}
<div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl shadow-sm overflow-hidden">

    <div class="p-5 sm:p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-5">

            {{-- FOTO --}}
            <div
                class="w-24 h-24 sm:w-28 sm:h-28
                       rounded-2xl
                       bg-white/20
                       border border-white/30
                       p-1
                       flex-shrink-0"
            >

                <div
                    class="w-full h-full
                           rounded-xl
                           bg-white
                           overflow-hidden
                           flex items-center justify-center"
                >

                    @if($siswa->foto)

                        <img
                            src="{{ asset('storage/' . $siswa->foto) }}"
                            alt="{{ $siswa->name }}"
                            class="w-full h-full object-cover"
                        >

                    @else

                        <span class="text-3xl font-extrabold text-orange-600">

                            {{ strtoupper(
                                substr($siswa->name ?? 'S', 0, 2)
                            ) }}

                        </span>

                    @endif

                </div>

            </div>


            {{-- INFORMASI UTAMA --}}
            <div class="flex-1 min-w-0 text-white">

                <div class="flex flex-wrap items-center gap-2 mb-2">

                    <span
                        class="inline-flex items-center
                               px-2.5 py-1
                               rounded-full
                               bg-white/20
                               border border-white/30
                               text-[11px]
                               font-bold"
                    >
                        {{ strtoupper($siswa->status ?? 'aktif') }}
                    </span>

                </div>

                <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                    {{ $siswa->name }}
                </h1>

                <div class="flex flex-wrap items-center gap-x-5 gap-y-2 mt-3 text-sm text-orange-50">

                    <div class="flex items-center gap-2">

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
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293 0V19a2 2 0 01-2 2h-1.586a1 1 0 01-.707-.293L15 16H9"
                            />
                        </svg>

                        <span>
                            NIS: {{ $siswa->nis ?? '-' }}
                        </span>

                    </div>

                    <div class="flex items-center gap-2">

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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        <span>
                            NISN: {{ $siswa->nisn ?? '-' }}
                        </span>

                    </div>

                    <div class="flex items-center gap-2">

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
                                d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"
                            />
                        </svg>

                        <span>
                            Kelas: {{ $siswa->kelas ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- QUICK INFORMATION --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3">

    <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm">

        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
            Kelas
        </p>

        <p class="text-sm font-extrabold text-slate-800 mt-1">
            {{ $siswa->kelas ?? '-' }}
        </p>

    </div>


    <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm">

        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
            Jurusan
        </p>

        <p class="text-sm font-extrabold text-slate-800 mt-1">
            {{ $siswa->jurusan ?? '-' }}
        </p>

    </div>


    <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm">

        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
            Angkatan
        </p>

        <p class="text-sm font-extrabold text-slate-800 mt-1">
            {{ $siswa->angkatan ?? '-' }}
        </p>

    </div>


    <div class="bg-white border border-slate-100 rounded-xl p-4 shadow-sm">

        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wide">
            Tahun Masuk
        </p>

        <p class="text-sm font-extrabold text-slate-800 mt-1">
            {{ $siswa->tahun_masuk ?? '-' }}
        </p>

    </div>

</div>


{{-- DATA GRID --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

    {{-- IDENTITAS --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="text-sm font-extrabold text-slate-800">
                Identitas Siswa
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Informasi identitas pribadi siswa.
            </p>

        </div>


        <div class="p-5 space-y-4">

            <div>

                <p class="text-xs text-slate-400 mb-1">
                    Nama Lengkap
                </p>

                <p class="text-sm font-semibold text-slate-700">
                    {{ $siswa->name ?? '-' }}
                </p>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        NIS
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->nis ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        NISN
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->nisn ?? '-' }}
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        NIK
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->nik ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Jenis Kelamin
                    </p>

                    <p class="text-sm font-semibold text-slate-700">

                        @if($siswa->jenis_kelamin === 'L')
                            Laki-laki
                        @elseif($siswa->jenis_kelamin === 'P')
                            Perempuan
                        @else
                            -
                        @endif

                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Tempat Lahir
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->tempat_lahir ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Tanggal Lahir
                    </p>

                    <p class="text-sm font-semibold text-slate-700">

                        @if($siswa->tanggal_lahir)

                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}

                        @else

                            -

                        @endif

                    </p>

                </div>

            </div>


            <div>

                <p class="text-xs text-slate-400 mb-1">
                    Agama
                </p>

                <p class="text-sm font-semibold text-slate-700">
                    {{ $siswa->agama ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- AKADEMIK --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="text-sm font-extrabold text-slate-800">
                Informasi Akademik
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Informasi pendidikan siswa.
            </p>

        </div>


        <div class="p-5 space-y-4">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Kelas
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->kelas ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Jurusan
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->jurusan ?? '-' }}
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Angkatan
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->angkatan ?? '-' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Tahun Masuk
                    </p>

                    <p class="text-sm font-semibold text-slate-700">
                        {{ $siswa->tahun_masuk ?? '-' }}
                    </p>

                </div>

            </div>


            <div>

                <p class="text-xs text-slate-400 mb-1">
                    Status Siswa
                </p>

                @if(($siswa->status ?? '') === 'aktif')

                    <span
                        class="inline-flex items-center gap-1.5
                               px-2.5 py-1
                               rounded-full
                               bg-emerald-50
                               border border-emerald-200
                               text-emerald-700
                               text-xs font-bold"
                    >

                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                        Aktif

                    </span>

                @else

                    <span
                        class="inline-flex items-center gap-1.5
                               px-2.5 py-1
                               rounded-full
                               bg-slate-50
                               border border-slate-200
                               text-slate-600
                               text-xs font-bold"
                    >

                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                        {{ ucfirst($siswa->status ?? 'Tidak tersedia') }}

                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- ALAMAT --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="text-sm font-extrabold text-slate-800">
                Alamat
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Informasi alamat tempat tinggal siswa.
            </p>

        </div>


        <div class="p-5">

            <div class="flex items-start gap-3">

                <div
                    class="w-9 h-9 rounded-lg
                           bg-orange-50
                           text-orange-600
                           flex items-center justify-center
                           flex-shrink-0"
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
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>

                </div>


                <div>

                    <p class="text-xs text-slate-400 mb-1">
                        Alamat Lengkap
                    </p>

                    <p class="text-sm font-medium text-slate-700 leading-relaxed">
                        {{ $siswa->alamat ?? 'Alamat belum tersedia.' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- KONTAK --}}
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="text-sm font-extrabold text-slate-800">
                Informasi Kontak
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Informasi komunikasi siswa.
            </p>

        </div>


        <div class="p-5 space-y-4">

            <div class="flex items-center gap-3">

                <div
                    class="w-9 h-9 rounded-lg
                           bg-orange-50
                           text-orange-600
                           flex items-center justify-center
                           flex-shrink-0"
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
                            d="M3 5a2 2 0 012-2h3.28a2 2 0 011.94 1.515l.82 3.28a2 2 0 01-.57 1.95l-2.2 2.2a16.02 16.02 0 006.82 6.82l2.2-2.2a2 2 0 011.95-.57l3.28.82A2 2 0 0121 18.72V22a2 2 0 01-2 2C9.61 24 0 14.39 0 2a2 2 0 012-2h3z"
                        />
                    </svg>

                </div>


                <div class="min-w-0">

                    <p class="text-xs text-slate-400">
                        Nomor HP
                    </p>

                    <p class="text-sm font-semibold text-slate-700 truncate">
                        {{ $siswa->no_hp ?? '-' }}
                    </p>

                </div>

            </div>


            <div class="flex items-center gap-3">

                <div
                    class="w-9 h-9 rounded-lg
                           bg-orange-50
                           text-orange-600
                           flex items-center justify-center
                           flex-shrink-0"
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
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>

                </div>


                <div class="min-w-0">

                    <p class="text-xs text-slate-400">
                        Email
                    </p>

                    <p class="text-sm font-semibold text-slate-700 truncate">
                        {{ $siswa->email ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- DATA SISTEM --}}
<div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

    <div class="px-5 py-4 border-b border-slate-100">

        <h3 class="text-sm font-extrabold text-slate-800">
            Data Sistem
        </h3>

        <p class="text-xs text-slate-400 mt-1">
            Informasi pencatatan data siswa dalam sistem.
        </p>

    </div>


    <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-4">

        <div>

            <p class="text-xs text-slate-400 mb-1">
                Data Dibuat
            </p>

            <p class="text-sm font-semibold text-slate-700">

                @if($siswa->created_at)
                    {{ $siswa->created_at->format('d M Y, H:i') }}
                @else
                    -
                @endif

            </p>

        </div>


        <div>

            <p class="text-xs text-slate-400 mb-1">
                Terakhir Diperbarui
            </p>

            <p class="text-sm font-semibold text-slate-700">

                @if($siswa->updated_at)
                    {{ $siswa->updated_at->format('d M Y, H:i') }}
                @else
                    -
                @endif

            </p>

        </div>

    </div>

</div>


{{-- READ ONLY NOTICE --}}
<div
    class="flex items-start gap-3
           bg-orange-50
           border border-orange-100
           rounded-xl
           px-4 py-3"
>

    <svg
        class="w-5 h-5 text-orange-500 flex-shrink-0 mt-0.5"
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


    <div>

        <p class="text-xs font-extrabold text-orange-800">
            Mode Tampilan
        </p>

        <p class="text-xs text-orange-700 mt-0.5 leading-relaxed">
            Guru hanya dapat melihat informasi siswa.
            Perubahan atau pengelolaan data siswa dilakukan oleh Admin.
        </p>

    </div>

</div>


{{-- FOOTER ACTION --}}
<div class="flex justify-start pt-1 pb-3">

    <a
        href="{{ route('guru.siswa.index') }}"
        class="inline-flex items-center gap-2
               px-4 py-2.5
               rounded-xl
               bg-orange-600
               text-white
               text-sm font-semibold
               hover:bg-orange-700
               transition-colors duration-200
               shadow-sm shadow-orange-500/20"
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
                d="M10 19l-7-7m0 0l7-7m-7 7h18"
            />
        </svg>

        Kembali ke Data Siswa

    </a>

</div>

</div>

@endsection
