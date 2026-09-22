@extends('layout')

@section('content')
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Breadcrumb Trail -->
    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-4">
        <a href="{{ route('admin.dashboard') }}"
           class="hover:text-slate-600 transition-colors">
            Dashboard
        </a>

        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>

        <a href="{{ route('admin.guru.index') }}"
           class="hover:text-slate-600 transition-colors">
            Guru
        </a>

        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>

        <span class="text-orange-600 font-semibold">
            Edit Guru
        </span>
    </nav>


    <!-- Page Title Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Edit Data Guru
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi akun pendidik dalam portal sistem nilai sekolah.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.guru.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 font-semibold text-sm shadow-sm transition-all">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>

                Kembali ke Daftar
            </a>
        </div>
    </div>


    <!-- Global Error Banner -->
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">

            <div class="flex items-center gap-2 font-semibold mb-2 text-red-800">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>

                <span>
                    Terdapat beberapa kesalahan pengisian form:
                </span>
            </div>

            <ul class="list-disc list-inside space-y-1 text-xs">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    <!-- Main Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


        <!-- Card Header -->
        <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-100 flex items-center gap-3">

            <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                <i data-lucide="user-cog" class="w-4 h-4"></i>
            </div>

            <div>
                <h2 class="text-base font-bold text-slate-800">
                    Formulir Edit Data Guru
                </h2>

                <p class="text-xs text-slate-400">
                    Perbarui data guru di bawah ini lalu simpan perubahan.
                </p>
            </div>

        </div>


        <!-- FORM -->
        <form id="formEditGuru"
              method="POST"
              action="{{ route('admin.guru.update', $guru->id) }}"
              class="p-6 sm:p-8 space-y-6">

            @csrf
            @method('PUT')


            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <!-- Nama Lengkap -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Nama Lengkap
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </span>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $guru->name) }}"
                            placeholder="Contoh: Budi Santoso, S.Pd."
                            required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all">

                    </div>

                    @error('name')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Email -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Alamat Email
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $guru->email) }}"
                            placeholder="guru@sekolah.sch.id"
                            required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all">

                    </div>

                    @error('email')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- NIP -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        NIP (Nomor Induk Pegawai)
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="id-card" class="w-4 h-4"></i>
                        </span>

                        <input
                            type="text"
                            name="nip"
                            value="{{ old('nip', $guru->nip) }}"
                            placeholder="198203152008011002"
                            required
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all">

                    </div>

                    @error('nip')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Mata Pelajaran -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Mata Pelajaran Utama
                        <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                        </span>

                        <select
                            name="id_mata_pelajaran"
                            required
                            class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none appearance-none transition-all">

                            <option value="">
                                -- Pilih Mata Pelajaran --
                            </option>

                            @if(isset($mataPelajaran))

                                @foreach($mataPelajaran as $m)

                                    <option
                                        value="{{ $m->id }}"
                                        {{ old(
                                            'id_mata_pelajaran',
                                            $guru->id_mata_pelajaran ?? ($guru->mataPelajaran->first()->id ?? null)
                                        ) == $m->id ? 'selected' : '' }}>

                                        {{ $m->name ?? $m->nama }}

                                    </option>

                                @endforeach

                            @endif

                        </select>


                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="chevron-down" class="w-4 h-4"></i>
                        </span>

                    </div>

                    @error('id_mata_pelajaran')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Password -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Kata Sandi
                        <span class="text-slate-400 font-normal lowercase">
                            (opsional)
                        </span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                        </span>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Kosongkan jika tidak ingin diubah"
                            autocomplete="new-password"
                            class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all">


                        <button
                            type="button"
                            onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">

                            <i
                                data-lucide="eye"
                                id="password-icon"
                                class="w-4 h-4">
                            </i>

                        </button>

                    </div>

                    @error('password')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <!-- Password Confirmation -->
                <div class="space-y-1.5">

                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Konfirmasi Kata Sandi
                        <span class="text-slate-400 font-normal lowercase">
                            (opsional)
                        </span>
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </span>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="Ulangi kata sandi baru"
                            autocomplete="new-password"
                            class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all">


                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">

                            <i
                                data-lucide="eye"
                                id="password_confirmation-icon"
                                class="w-4 h-4">
                            </i>

                        </button>

                    </div>

                    @error('password_confirmation')
                        <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                            <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            <!-- Informational Note -->
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-3 text-amber-900">

                <i
                    data-lucide="info"
                    class="w-5 h-5 text-blue-600 shrink-0 mt-0.5">
                </i>

                <p class="text-xs leading-relaxed">
                    Biarkan bidang
                    <strong>Kata Sandi</strong>
                    dan
                    <strong>Konfirmasi Kata Sandi</strong>
                    kosong jika Anda tidak ingin mengubah kata sandi guru.
                </p>

            </div>


            <!-- Buttons -->
            <div class="pt-4 border-t border-slate-100 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">

                <!-- RESET -->
                <button
                    type="button"
                    onclick="resetFormGuru()"
                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-600 font-semibold text-sm transition-all flex items-center justify-center gap-2">

                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>

                    Reset Form

                </button>


                <!-- SAVE -->
                <button
                    type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 active:bg-orange-700 text-white font-semibold text-sm shadow-md shadow-orange-500/25 transition-all flex items-center justify-center gap-2">

                    <i data-lucide="save" class="w-4 h-4"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</main>


<!-- ========================================================= -->
<!-- LUCIDE -->
<!-- ========================================================= -->

<script src="https://unpkg.com/lucide@latest"></script>


<script>

    /*
    |--------------------------------------------------------------------------
    | Render Lucide Icons
    |--------------------------------------------------------------------------
    */

    function renderIcons() {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    }


    /*
    |--------------------------------------------------------------------------
    | DOM READY
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        renderIcons();

    });


    /*
    |--------------------------------------------------------------------------
    | Toggle Password
    |--------------------------------------------------------------------------
    */

    function togglePassword(id) {

        const input = document.getElementById(id);
        const icon = document.getElementById(id + '-icon');

        if (!input || !icon) {
            return;
        }


        if (input.type === 'password') {

            input.type = 'text';

            icon.setAttribute(
                'data-lucide',
                'eye-off'
            );

        } else {

            input.type = 'password';

            icon.setAttribute(
                'data-lucide',
                'eye'
            );

        }


        renderIcons();

    }


    /*
    |--------------------------------------------------------------------------
    | RESET FORM GURU
    |--------------------------------------------------------------------------
    */

    function resetFormGuru() {

        const form = document.getElementById('formEditGuru');

        if (!form) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Kembalikan semua input ke nilai awal
        |--------------------------------------------------------------------------
        */

        form.reset();


        /*
        |--------------------------------------------------------------------------
        | Password harus selalu kosong
        |--------------------------------------------------------------------------
        */

        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');


        if (password) {

            password.value = '';
            password.type = 'password';

        }


        if (passwordConfirmation) {

            passwordConfirmation.value = '';
            passwordConfirmation.type = 'password';

        }


        /*
        |--------------------------------------------------------------------------
        | Kembalikan icon password
        |--------------------------------------------------------------------------
        */

        const passwordIcon = document.getElementById('password-icon');
        const confirmationIcon = document.getElementById('password_confirmation-icon');


        if (passwordIcon) {

            passwordIcon.setAttribute(
                'data-lucide',
                'eye'
            );

        }


        if (confirmationIcon) {

            confirmationIcon.setAttribute(
                'data-lucide',
                'eye'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Render ulang icon
        |--------------------------------------------------------------------------
        */

        renderIcons();

    }

</script>


@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {

            lucide.createIcons();

        }

    });

</script>

@endpush

@endsection