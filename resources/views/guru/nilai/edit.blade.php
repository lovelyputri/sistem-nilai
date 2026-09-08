@extends('layoutGuru')

@section('title', 'Edit Nilai')

@section('content')

<div class="w-full max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="mb-6">

        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">

            <a href="{{ route('guru.dashboard') }}" class="hover:text-orange-600">
                Dashboard
            </a>

            <span>/</span>

            <a href="{{ route('guru.nilai.index') }}" class="hover:text-orange-600">
                Nilai
            </a>

            <span>/</span>

            <span class="text-slate-500">
                Edit
            </span>

        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            Edit Nilai
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Perbarui nilai siswa.
        </p>

    </div>

    @if($errors->any())

        <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-700">

            <ul class="text-xs space-y-1">

                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('guru.nilai.update', $nilai->id) }}"
        method="POST"
        class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 sm:p-6"
    >

        @csrf
        @method('PUT')

        <div class="space-y-5">

            <div>

                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">
                    Siswa
                </label>

                <div class="mt-2 px-4 py-3 rounded-xl bg-slate-50 border border-slate-200">

                    <p class="text-sm font-bold text-slate-800">
                        {{ $nilai->siswa->name ?? '-' }}
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        NIS: {{ $nilai->siswa->nis ?? '-' }}
                        ·
                        Kelas {{ $nilai->siswa->kelas ?? '-' }}
                    </p>

                </div>

            </div>

            <div>

                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">
                    Mata Pelajaran
                </label>

                <div class="mt-2 px-4 py-3 rounded-xl bg-slate-50 border border-slate-200">

                    <p class="text-sm font-bold text-slate-800">
                        {{ $nilai->mataPelajaran->name ?? '-' }}
                    </p>

                    @if($nilai->mataPelajaran?->kode)

                        <p class="text-xs text-slate-400 mt-1">
                            {{ $nilai->mataPelajaran->kode }}
                        </p>

                    @endif

                </div>

            </div>

            <div>

                <label
                    for="nilai"
                    class="block text-sm font-bold text-slate-700 mb-2"
                >
                    Nilai
                </label>

                <input
                    type="number"
                    id="nilai"
                    name="nilai"
                    value="{{ old('nilai', $nilai->nilai) }}"
                    min="0"
                    max="100"
                    step="0.01"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                >

            </div>

            <div class="flex justify-end gap-3 pt-2">

                <a
                    href="{{ route('guru.nilai.show', $nilai->id_siswa) }}"
                    class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold transition"
                >
                    Simpan Perubahan
                </button>

            </div>

        </div>

    </form>

</div>

@endsection