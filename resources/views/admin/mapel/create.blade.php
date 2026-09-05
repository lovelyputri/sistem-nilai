@extends('layout')

@section('content')

<main class="w-full max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-5">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600 transition-colors">
            Dashboard
        </a>
        <span>/</span>
        <a href="{{ route('admin.mapel.index') }}" class="hover:text-orange-600 transition-colors">
            Mata Pelajaran
        </a>
        <span>/</span>
        <span class="text-orange-500 font-semibold">
            Tambah
        </span>
    </nav>

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-slate-800">
            Tambah Mata Pelajaran
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Tambahkan mata pelajaran baru ke dalam sistem.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"/>
                </svg>

                <div>
                    <p class="text-xs font-bold text-red-700">
                        Periksa kembali data yang dimasukkan.
                    </p>

                    @foreach ($errors->all() as $error)
                        <p class="text-xs text-red-600 mt-1">
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <form action="{{ route('admin.mapel.store') }}" method="POST">
            @csrf

            <div class="p-6 space-y-5">

                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-2">
                        Nama Mata Pelajaran
                    </label>

                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Kemuhammadiyahan"
                           autocomplete="off"
                           required
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-700 placeholder-slate-400 outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition">

                    @error('name')
                        <p class="text-xs text-red-500 mt-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="rounded-xl border border-orange-100 bg-orange-50 px-4 py-4">
                    <div class="flex items-start gap-3">

                        <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 3a9 9 0 100 18 9 9 0 000-18z"/>
                        </svg>

                        <div>
                            <p class="text-xs font-bold text-orange-700">
                                Kode dan keterangan dibuat otomatis
                            </p>

                            <p class="text-[11px] text-orange-600 mt-1 leading-relaxed">
                                Sistem akan membuat kode mata pelajaran dan keterangan secara otomatis setelah data disimpan.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">

                <a href="{{ route('admin.mapel.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-100 transition-colors">
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Mata Pelajaran
                </button>

            </div>

        </form>

    </div>

</main>

@endsection