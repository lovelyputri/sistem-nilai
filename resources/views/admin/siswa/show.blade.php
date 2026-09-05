@extends('layout')

@section('content')

<main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-5 overflow-x-auto whitespace-nowrap">

        <a href="{{ route('admin.dashboard') }}"
           class="hover:text-orange-600 transition-colors">
            Dashboard
        </a>

        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>

        <a href="{{ route('admin.siswa.index') }}"
           class="hover:text-orange-600 transition-colors">
            Kelola Siswa
        </a>

        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5l7 7-7 7"/>
        </svg>

        <span class="text-orange-600">
            Detail Siswa
        </span>

    </nav>


    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-1.5 h-6 rounded-full bg-orange-500"></span>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Detail Siswa
                </h1>
            </div>

            <p class="text-sm text-slate-500">
                Informasi lengkap mengenai data siswa.
            </p>
        </div>

        <a href="{{ route('admin.siswa.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-slate-200 bg-white
                  text-xs font-semibold text-slate-600
                  hover:bg-slate-50 hover:border-slate-300
                  transition">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Kembali
        </a>

    </div>


    {{-- PROFILE HERO --}}
    <div class="relative overflow-hidden rounded-2xl bg-white
                border border-slate-200 shadow-sm mb-5">

        {{-- Orange background --}}
        <div class="h-28 sm:h-32 bg-gradient-to-r from-orange-600 via-orange-500 to-amber-400 relative overflow-hidden">

            <div class="absolute -right-8 -top-16 w-44 h-44
                        rounded-full bg-white/10"></div>

            <div class="absolute right-20 -bottom-20 w-40 h-40
                        rounded-full bg-white/10"></div>

            <div class="absolute left-1/3 -top-16 w-32 h-32
                        rounded-full bg-white/5"></div>

        </div>


        <div class="px-5 sm:px-7 pb-6">

            <div class="flex flex-col sm:flex-row sm:items-end gap-4 -mt-12 relative">

                {{-- FOTO / AVATAR --}}
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl
                            bg-white p-1.5 shadow-md shrink-0">

                    @if ($siswa->foto)

                        <img src="{{ asset('storage/' . $siswa->foto) }}"
                             alt="{{ $siswa->name }}"
                             class="w-full h-full object-cover rounded-xl">

                    @else

                        <div class="w-full h-full rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <span class="text-3xl sm:text-4xl font-bold">
                                {{ strtoupper(substr($siswa->name, 0, 1)) }}
                            </span>

                        </div>

                    @endif

                </div>


                {{-- NAMA --}}
                <div class="flex-1 min-w-0 sm:pb-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <h2 class="text-xl sm:text-2xl font-bold text-slate-800 truncate">
                            {{ $siswa->name }}
                        </h2>

                        @if ($siswa->status === 'aktif')

                            <span class="inline-flex items-center gap-1.5
                                         px-2.5 py-1 rounded-lg
                                         bg-emerald-50 border border-emerald-200
                                         text-[11px] font-bold text-emerald-600">

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Aktif

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5
                                         px-2.5 py-1 rounded-lg
                                         bg-slate-100 border border-slate-200
                                         text-[11px] font-bold text-slate-500">

                                {{ ucfirst($siswa->status ?? 'Tidak diketahui') }}

                            </span>

                        @endif

                    </div>

                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-xs text-slate-500">

                        <span>
                            NIS: <strong class="text-slate-700">{{ $siswa->nis }}</strong>
                        </span>

                        @if ($siswa->nisn)
                            <span>
                                NISN: <strong class="text-slate-700">{{ $siswa->nisn }}</strong>
                            </span>
                        @endif

                        <span>
                            {{ $siswa->kelas }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- QUICK INFO --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-6">

                <div class="rounded-xl bg-orange-50 border border-orange-100 px-4 py-3">
                    <p class="text-[10px] uppercase tracking-wide font-bold text-orange-400">
                        Kelas
                    </p>

                    <p class="text-sm font-bold text-slate-700 mt-0.5">
                        {{ $siswa->kelas ?: '-' }}
                    </p>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">
                    <p class="text-[10px] uppercase tracking-wide font-bold text-slate-400">
                        Jurusan
                    </p>

                    <p class="text-sm font-bold text-slate-700 mt-0.5">
                        {{ $siswa->jurusan ?: '-' }}
                    </p>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">
                    <p class="text-[10px] uppercase tracking-wide font-bold text-slate-400">
                        Angkatan
                    </p>

                    <p class="text-sm font-bold text-slate-700 mt-0.5">
                        {{ $siswa->angkatan ?: '-' }}
                    </p>
                </div>

                <div class="rounded-xl bg-slate-50 border border-slate-200 px-4 py-3">
                    <p class="text-[10px] uppercase tracking-wide font-bold text-slate-400">
                        Tahun Masuk
                    </p>

                    <p class="text-sm font-bold text-slate-700 mt-0.5">
                        {{ $siswa->tahun_masuk ?: '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- CONTENT GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">


        {{-- LEFT / MAIN --}}
        <div class="lg:col-span-2 space-y-5">


            {{-- IDENTITAS --}}
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 py-4 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0
                                         4 4 0 018 0z
                                         M12 14a7 7 0 00-7 7h14
                                         a7 7 0 00-7-7z"/>
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Identitas Siswa
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Data identitas utama siswa
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5">

                        {{-- Nama --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                Nama Lengkap
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->name ?: '-' }}
                            </p>
                        </div>


                        {{-- NIS --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                NIS
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->nis ?: '-' }}
                            </p>
                        </div>


                        {{-- NISN --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                NISN
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->nisn ?: '-' }}
                            </p>
                        </div>


                        {{-- NIK --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                NIK
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->nik ?: '-' }}
                            </p>
                        </div>


                        {{-- Jenis Kelamin --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                Jenis Kelamin
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                @if ($siswa->jenis_kelamin === 'L')
                                    Laki-laki
                                @elseif ($siswa->jenis_kelamin === 'P')
                                    Perempuan
                                @else
                                    -
                                @endif
                            </p>
                        </div>


                        {{-- Agama --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                Agama
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->agama ?: '-' }}
                            </p>
                        </div>


                        {{-- Tempat Lahir --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                Tempat Lahir
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->tempat_lahir ?: '-' }}
                            </p>
                        </div>


                        {{-- Tanggal Lahir --}}
                        <div>
                            <p class="text-[11px] font-semibold text-slate-400 mb-1">
                                Tanggal Lahir
                            </p>

                            <p class="text-sm font-semibold text-slate-700">
                                {{ $siswa->tanggal_lahir?->translatedFormat('d F Y') ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </section>


            {{-- ALAMAT --}}
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 py-4 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17.657 16.657L13.414 21
                                         a2 2 0 01-2.828 0l-4.243-4.343
                                         a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0
                                         3 3 0 016 0z"/>
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Alamat
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Alamat tempat tinggal siswa
                            </p>
                        </div>

                    </div>

                </div>

                <div class="p-5 sm:p-6">

                    <p class="text-sm leading-6 text-slate-600">
                        {{ $siswa->alamat ?: 'Alamat belum diisi.' }}
                    </p>

                </div>

            </section>


            {{-- AKADEMIK --}}
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 sm:px-6 py-4 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
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
                                      d="M5 12v5a7 7 0 0014 0v-5"/>
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Informasi Akademik
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Informasi pendidikan siswa
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5 sm:p-6">

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-3.5">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Kelas
                            </p>
                            <p class="text-sm font-bold text-slate-700 mt-1">
                                {{ $siswa->kelas ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-3.5">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Jurusan
                            </p>
                            <p class="text-sm font-bold text-slate-700 mt-1">
                                {{ $siswa->jurusan ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-3.5">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Angkatan
                            </p>
                            <p class="text-sm font-bold text-slate-700 mt-1">
                                {{ $siswa->angkatan ?: '-' }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-200 p-3.5">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Tahun Masuk
                            </p>
                            <p class="text-sm font-bold text-slate-700 mt-1">
                                {{ $siswa->tahun_masuk ?: '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </section>

        </div>


        {{-- RIGHT SIDEBAR --}}
        <div class="space-y-5">


            {{-- KONTAK --}}
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 5a2 2 0 012-2h3.28
                                         a1 1 0 01.948.684l1.498 4.493
                                         a1 1 0 01-.502 1.21l-2.257 1.13
                                         a11.042 11.042 0 005.502 5.502
                                         l1.13-2.257a1 1 0 011.21-.502l4.493 1.498
                                         A1 1 0 0121 15.72V19a2 2 0 01-2 2
                                         h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Kontak
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Informasi yang dapat dihubungi
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5 space-y-4">

                    {{-- HP --}}
                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-lg bg-slate-100
                                    flex items-center justify-center shrink-0">

                            <svg class="w-4 h-4 text-slate-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 18h.01M8 21h8
                                         a2 2 0 002-2V5
                                         a2 2 0 00-2-2H8
                                         a2 2 0 00-2 2v14
                                         a2 2 0 002 2z"/>
                            </svg>

                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Nomor HP
                            </p>

                            <p class="text-sm font-semibold text-slate-700 break-all">
                                {{ $siswa->no_hp ?: '-' }}
                            </p>
                        </div>

                    </div>


                    {{-- EMAIL --}}
                    <div class="flex items-start gap-3">

                        <div class="w-8 h-8 rounded-lg bg-slate-100
                                    flex items-center justify-center shrink-0">

                            <svg class="w-4 h-4 text-slate-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 8l9 6 9-6
                                         M5 5h14a2 2 0 012 2v10
                                         a2 2 0 01-2 2H5
                                         a2 2 0 01-2-2V7
                                         a2 2 0 012-2z"/>
                            </svg>

                        </div>

                        <div class="min-w-0">
                            <p class="text-[10px] font-semibold text-slate-400">
                                Email
                            </p>

                            <p class="text-sm font-semibold text-slate-700 break-all">
                                {{ $siswa->email ?: '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </section>


            {{-- STATUS --}}
            <section class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-100">

                    <div class="flex items-center gap-3">

                        <div class="w-9 h-9 rounded-xl
                                    bg-orange-100 text-orange-600
                                    flex items-center justify-center">

                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4
                                         M12 22a10 10 0 100-20
                                         10 10 0 000 20z"/>
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-800">
                                Status Siswa
                            </h3>

                            <p class="text-[11px] text-slate-400">
                                Status siswa saat ini
                            </p>
                        </div>

                    </div>

                </div>


                <div class="p-5">

                    @if ($siswa->status === 'aktif')

                        <div class="rounded-xl bg-emerald-50
                                    border border-emerald-200 p-4">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-full bg-emerald-100
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5 text-emerald-600"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>

                                </div>

                                <div>
                                    <p class="text-sm font-bold text-emerald-700">
                                        Siswa Aktif
                                    </p>

                                    <p class="text-[11px] text-emerald-600 mt-0.5">
                                        Masih terdaftar sebagai siswa aktif.
                                    </p>
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="rounded-xl bg-slate-50
                                    border border-slate-200 p-4">

                            <div class="flex items-center gap-3">

                                <div class="w-9 h-9 rounded-full bg-slate-100
                                            flex items-center justify-center">

                                    <svg class="w-5 h-5 text-slate-500"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>

                                </div>

                                <div>
                                    <p class="text-sm font-bold text-slate-700">
                                        {{ ucfirst($siswa->status ?? 'Tidak diketahui') }}
                                    </p>

                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        Status siswa saat ini.
                                    </p>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>

            </section>


            {{-- DATA SISTEM --}}
            <section class="bg-slate-50 border border-slate-200 rounded-2xl p-5">

                <div class="flex items-center gap-2 mb-4">

                    <svg class="w-4 h-4 text-slate-400"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4l3 2
                                 M21 12a9 9 0 11-18 0
                                 9 9 0 0118 0z"/>
                    </svg>

                    <h3 class="text-xs font-bold text-slate-600">
                        Informasi Data
                    </h3>

                </div>

                <div class="space-y-3 text-xs">

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-slate-400">
                            ID Siswa
                        </span>

                        <span class="font-semibold text-slate-600">
                            #{{ $siswa->id }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-slate-400">
                            Ditambahkan
                        </span>

                        <span class="font-semibold text-slate-600 text-right">
                            {{ $siswa->created_at?->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <span class="text-slate-400">
                            Diperbarui
                        </span>

                        <span class="font-semibold text-slate-600 text-right">
                            {{ $siswa->updated_at?->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>

                </div>

            </section>

        </div>

    </div>


    {{-- FOOTER ACTION --}}
    <div class="mt-5 bg-white border border-slate-200
                rounded-2xl shadow-sm p-4">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>
                <p class="text-sm font-semibold text-slate-700">
                    Kelola data siswa
                </p>

                <p class="text-xs text-slate-400 mt-0.5">
                    Perbarui informasi siswa jika terdapat perubahan data.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">

                <a href="{{ route('admin.siswa.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-4 py-2.5 rounded-xl
                          border border-slate-200 bg-white
                          text-xs font-semibold text-slate-600
                          hover:bg-slate-50 transition">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>

                    Kembali
                </a>


                <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-2.5 rounded-xl
                          bg-orange-600 text-white
                          text-xs font-bold
                          hover:bg-orange-700
                          active:bg-orange-800
                          transition">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11
                                 a2 2 0 002 2h11
                                 a2 2 0 002-2v-5
                                 M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1
                                 1-4 9.5-9.5z"/>
                    </svg>

                    Edit Data
                </a>

            </div>

        </div>

    </div>

</main>

@endsection