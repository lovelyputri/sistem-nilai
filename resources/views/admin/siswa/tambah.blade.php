Tidak bisa kita ketahui, bahkan CCTV- CCTV-nya Juga enggak ada, jadi untuk mencari jejak-jejaknya pun Mm.@extends('layout')

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
            Tambah Siswa
        </span>

    </nav>


    {{-- PAGE HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-2 mb-1">

                <span class="w-1.5 h-6 rounded-full bg-orange-500"></span>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Tambah Siswa Baru
                </h1>

            </div>

            <p class="text-sm text-slate-500">
                Lengkapi informasi siswa untuk menambahkan data baru.
            </p>
        </div>


        <a href="{{ route('admin.siswa.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-slate-200 bg-white
                  text-xs font-semibold text-slate-600
                  hover:bg-slate-50
                  hover:border-slate-300
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


    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())

        <div class="mb-5 bg-red-50 border border-red-200
                    rounded-2xl p-4">

            <div class="flex items-center gap-2 mb-2">

                <svg class="w-5 h-5 text-red-500"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v4m0 4h.01
                             M10.29 3.86l-7.82 14
                             A2 2 0 004.2 21h15.6
                             a2 2 0 001.73-3.14l-7.82-14
                             a2 2 0 00-3.46 0z"/>

                </svg>

                <p class="text-sm font-bold text-red-700">
                    Data belum dapat disimpan
                </p>

            </div>

            <ul class="list-disc list-inside text-xs text-red-600 space-y-1">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form action="{{ route('admin.siswa.store') }}"
          method="POST">

        @csrf


        {{-- ================= IDENTITAS ================= --}}
        <section class="bg-white border border-slate-200
                        rounded-2xl shadow-sm overflow-hidden mb-5">

            <div class="px-5 sm:px-6 py-4
                        bg-orange-50/70
                        border-b border-orange-100">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
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

                        <h2 class="text-sm font-bold text-slate-800">
                            Identitas Siswa
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Informasi identitas utama siswa.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- Nama --}}
                    <div class="sm:col-span-2">

                        <label for="name"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Nama Lengkap
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap siswa"
                               required
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500
                                      transition">

                    </div>


                    {{-- NIS --}}
                    <div>

                        <label for="nis"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            NIS
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               id="nis"
                               name="nis"
                               value="{{ old('nis') }}"
                               placeholder="Contoh: 2024001"
                               required
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500
                                      transition">

                    </div>


                    {{-- NISN --}}
                    <div>

                        <label for="nisn"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            NISN

                        </label>

                        <input type="text"
                               id="nisn"
                               name="nisn"
                               value="{{ old('nisn') }}"
                               placeholder="Masukkan NISN"
                               maxlength="20"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500
                                      transition">

                    </div>


                    {{-- NIK --}}
                    <div class="sm:col-span-2">

                        <label for="nik"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            NIK

                        </label>

                        <input type="text"
                               id="nik"
                               name="nik"
                               value="{{ old('nik') }}"
                               placeholder="Masukkan NIK"
                               maxlength="20"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500
                                      transition">

                    </div>

                </div>

            </div>

        </section>


        {{-- ================= DATA PRIBADI ================= --}}
        <section class="bg-white border border-slate-200
                        rounded-2xl shadow-sm overflow-hidden mb-5">

            <div class="px-5 sm:px-6 py-4
                        border-b border-slate-100">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-orange-100 text-orange-600
                                flex items-center justify-center">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 7a4 4 0 118 0
                                     M6 21v-2a6 6 0 0112 0v2
                                     M12 11v5
                                     M9 14h6"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Data Pribadi
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Informasi pribadi siswa.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- Jenis Kelamin --}}
                    <div>

                        <label for="jenis_kelamin"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Jenis Kelamin

                        </label>

                        <select id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="w-full px-4 py-2.5 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2 focus:ring-orange-500/20
                                       focus:border-orange-500">

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option value="L"
                                {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="P"
                                {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>

                    </div>


                    {{-- Agama --}}
                    <div>

                        <label for="agama"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Agama

                        </label>

                        <select id="agama"
                                name="agama"
                                class="w-full px-4 py-2.5 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2 focus:ring-orange-500/20
                                       focus:border-orange-500">

                            <option value="">
                                Pilih agama
                            </option>

                            @foreach (['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)

                                <option value="{{ $agama }}"
                                    {{ old('agama') === $agama ? 'selected' : '' }}>

                                    {{ $agama }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Tempat Lahir --}}
                    <div>

                        <label for="tempat_lahir"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Tempat Lahir

                        </label>

                        <input type="text"
                               id="tempat_lahir"
                               name="tempat_lahir"
                               value="{{ old('tempat_lahir') }}"
                               placeholder="Contoh: Banyuwangi"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>


                    {{-- Tanggal Lahir --}}
                    <div>

                        <label for="tanggal_lahir"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Tanggal Lahir

                        </label>

                        <input type="date"
                               id="tanggal_lahir"
                               name="tanggal_lahir"
                               value="{{ old('tanggal_lahir') }}"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>


                    {{-- Alamat --}}
                    <div class="sm:col-span-2">

                        <label for="alamat"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Alamat

                        </label>

                        <textarea id="alamat"
                                  name="alamat"
                                  rows="3"
                                  placeholder="Masukkan alamat lengkap siswa"
                                  class="w-full px-4 py-2.5 rounded-xl
                                         border border-slate-200
                                         text-sm text-slate-700
                                         placeholder:text-slate-400
                                         focus:outline-none
                                         focus:ring-2 focus:ring-orange-500/20
                                         focus:border-orange-500
                                         resize-none">{{ old('alamat') }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- ================= AKADEMIK ================= --}}
        <section class="bg-white border border-slate-200
                        rounded-2xl shadow-sm overflow-hidden mb-5">

            <div class="px-5 sm:px-6 py-4
                        border-b border-slate-100">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
                                bg-orange-100 text-orange-600
                                flex items-center justify-center">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 14l9-5-9-5-9 5 9 5z
                                     M5 12v5a7 7 0 0014 0v-5"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Akademik
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Informasi pendidikan dan kelas siswa.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- Kelas --}}
                    <div>

                        <label for="kelas"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Kelas
                            <span class="text-red-500">*</span>

                        </label>

                        <select id="kelas"
                                name="kelas"
                                required
                                class="w-full px-4 py-2.5 rounded-xl
                                       border border-slate-200
                                       bg-white
                                       text-sm text-slate-700
                                       focus:outline-none
                                       focus:ring-2 focus:ring-orange-500/20
                                       focus:border-orange-500">

                            <option value="">
                                Pilih kelas
                            </option>

                            @foreach ($daftarKelas as $kelas)

                                <option value="{{ $kelas }}"
                                    {{ old('kelas') === $kelas ? 'selected' : '' }}>

                                    {{ $kelas }}

                                </option>

                            @endforeach

                        </select>

                        @if ($daftarKelas->isEmpty())

                            <p class="text-xs text-slate-400 mt-1.5">
                                Belum ada kelas yang tersedia.
                            </p>

                        @endif

                    </div>


                    {{-- Jurusan --}}
                    <div>

                        <label for="jurusan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Jurusan

                        </label>

                        <input type="text"
                               id="jurusan"
                               name="jurusan"
                               value="{{ old('jurusan') }}"
                               placeholder="Contoh: RPL"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>


                    {{-- Angkatan --}}
                    <div>

                        <label for="angkatan"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Angkatan

                        </label>

                        <input type="text"
                               id="angkatan"
                               name="angkatan"
                               value="{{ old('angkatan') }}"
                               placeholder="Contoh: 2026"
                               maxlength="10"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>


                    {{-- Tahun Masuk --}}
                    <div>

                        <label for="tahun_masuk"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Tahun Masuk

                        </label>

                        <input type="number"
                               id="tahun_masuk"
                               name="tahun_masuk"
                               value="{{ old('tahun_masuk') }}"
                               placeholder="Contoh: 2026"
                               min="2000"
                               max="2100"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>

                </div>

            </div>

        </section>


        {{-- ================= KONTAK ================= --}}
        <section class="bg-white border border-slate-200
                        rounded-2xl shadow-sm overflow-hidden mb-5">

            <div class="px-5 sm:px-6 py-4
                        border-b border-slate-100">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
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
                                     A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1
                                     C9.716 21 3 14.284 3 6V5z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-800">
                            Informasi Kontak
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Informasi kontak siswa.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- No HP --}}
                    <div>

                        <label for="no_hp"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Nomor HP

                        </label>

                        <input type="text"
                               id="no_hp"
                               name="no_hp"
                               value="{{ old('no_hp') }}"
                               placeholder="Contoh: 081234567890"
                               maxlength="20"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>


                    {{-- Email --}}
                    <div>

                        <label for="email"
                               class="block text-sm font-semibold text-slate-700 mb-2">

                            Email

                        </label>

                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Contoh: siswa@email.com"
                               class="w-full px-4 py-2.5 rounded-xl
                                      border border-slate-200
                                      text-sm text-slate-700
                                      placeholder:text-slate-400
                                      focus:outline-none
                                      focus:ring-2 focus:ring-orange-500/20
                                      focus:border-orange-500">

                    </div>

                </div>

            </div>

        </section>


        {{-- ================= STATUS ================= --}}
        <!-- <section class="bg-white border border-slate-200
                        <!-- rounded-2xl shadow-sm overflow-hidden mb-5">

            <div class="px-5 sm:px-6 py-4
                        border-b border-slate-100">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl
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

                        <h2 class="text-sm font-bold text-slate-800">
                            Status Siswa
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Tentukan status siswa saat ini.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <select id="status"
                        name="status"
                        class="w-full px-4 py-2.5 rounded-xl
                               border border-slate-200
                               bg-white
                               text-sm text-slate-700
                               focus:outline-none
                               focus:ring-2 focus:ring-orange-500/20
                               focus:border-orange-500">

                    <option value="aktif"
                        {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif"
                        {{ old('status') === 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>

            </div>

        </section> -->


        {{-- ================= FOOTER ================= --}}
        <div class="bg-white border border-slate-200
                    rounded-2xl shadow-sm p-4">

            <div class="flex flex-col-reverse sm:flex-row
                        sm:items-center sm:justify-between gap-3">

                <div>

                    <p class="text-sm font-semibold text-slate-700">
                        Simpan data siswa
                    </p>

                    <p class="text-xs text-slate-400 mt-0.5">
                        Pastikan informasi yang dimasukkan sudah benar.
                    </p>

                </div>


                <div class="flex flex-col sm:flex-row gap-2">

                    <a href="{{ route('admin.siswa.index') }}"
                       class="inline-flex items-center justify-center gap-2
                              px-4 py-2.5 rounded-xl
                              border border-slate-200 bg-white
                              text-sm font-semibold text-slate-600
                              hover:bg-slate-50
                              transition">

                        Batal

                    </a>


                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   px-5 py-2.5 rounded-xl
                                   bg-orange-600 text-white
                                   text-sm font-semibold
                                   hover:bg-orange-700
                                   active:bg-orange-800
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-orange-500/30
                                   transition">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7"/>

                        </svg>

                        Simpan Siswa

                    </button>

                </div>

            </div>

        </div>

    </form>

</main>

@endsection