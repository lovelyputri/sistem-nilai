@extends('layoutGuru')

@section('title', 'Input Nilai')

@section('content')

<div class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
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
                Input Nilai
            </span>
        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            Input Nilai Siswa
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Masukkan nilai siswa sesuai mata pelajaran dan kelas yang Anda ampu.
        </p>
    </div>

    <a
        href="{{ route('guru.nilai.index') }}"
        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-semibold text-slate-600 hover:text-orange-600 hover:border-orange-200 transition"
    >
        ← Kembali
    </a>

</div>


@if($errors->any())

    <div class="mb-5 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-700">

        <p class="text-xs font-bold mb-1">
            Terdapat kesalahan:
        </p>

        <ul class="text-xs space-y-1">
            @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


<form
    action="{{ route('guru.nilai.store') }}"
    method="POST"
    class="space-y-5"
>

    @csrf


    {{-- MATA PELAJARAN --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">

        <label
            for="id_mata_pelajaran"
            class="block text-sm font-bold text-slate-700 mb-2"
        >
            Mata Pelajaran
        </label>

        <select
            id="id_mata_pelajaran"
            name="id_mata_pelajaran"
            required
            onchange="ubahMapel(this)"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
        >

            <option value="">
                Pilih mata pelajaran
            </option>

            @foreach($mataPelajarans as $mapel)

                <option
                    value="{{ $mapel->id }}"
                    @selected(old('id_mata_pelajaran', request('id_mata_pelajaran', $mapelGuru?->id)) == $mapel->id)
                >
                    {{ $mapel->name }}

                    @if($mapel->kode)
                        — {{ $mapel->kode }}
                    @endif
                </option>

            @endforeach

        </select>

        <p class="text-[11px] text-slate-400 mt-2">
            Mata pelajaran yang tersedia hanya yang menjadi bidang Anda.
        </p>

    </div>


    {{-- KELAS --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">

        <label
            for="kelas"
            class="block text-sm font-bold text-slate-700 mb-2"
        >
            Kelas
        </label>

        <select
            id="kelas"
            name="kelas"
            required
            onchange="pilihKelas(this)"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
        >

            <option value="">
                Pilih kelas terlebih dahulu
            </option>

            @foreach($kelasGuru as $kelas)

                <option
                    value="{{ $kelas }}"
                    @selected($kelasTerpilih == $kelas)
                >
                    Kelas {{ $kelas }}
                </option>

            @endforeach

        </select>

        <p class="text-[11px] text-slate-400 mt-2">
            Pilih kelas terlebih dahulu untuk menampilkan siswa.
        </p>

    </div>


    {{-- SISWA --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="text-sm font-bold text-slate-800">
                Siswa
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Pilih siswa dari kelas yang telah dipilih.
            </p>

        </div>


        <div class="p-5">

            <label
                for="id_siswa"
                class="block text-xs font-bold text-slate-700 mb-2"
            >
                Nama Siswa
            </label>


            @if(!$kelasTerpilih)

                <select
                    id="id_siswa"
                    disabled
                    class="w-full px-4 py-3 rounded-xl bg-slate-100 border border-slate-200 text-sm text-slate-400 cursor-not-allowed"
                >

                    <option>
                        Pilih kelas terlebih dahulu
                    </option>

                </select>

                <p class="text-[11px] text-slate-400 mt-2">
                    Daftar siswa akan muncul setelah kelas dipilih.
                </p>


            @else

                <select
                    id="id_siswa"
                    name="id_siswa"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                >

                    <option value="">
                        Pilih siswa
                    </option>

                    @foreach($siswa as $item)

                        <option
                            value="{{ $item->id }}"
                            @selected(old('id_siswa') == $item->id)
                        >
                            {{ $item->name }}
                            — NIS: {{ $item->nis ?? '-' }}
                        </option>

                    @endforeach

                </select>


                @if($siswa->isEmpty())

                    <p class="text-xs text-red-500 mt-2">
                        Semua siswa di kelas ini sudah memiliki nilai untuk mata pelajaran yang dipilih.
                    </p>

                @else

                    <p class="text-[11px] text-slate-400 mt-2">
                        Menampilkan {{ $siswa->count() }} siswa dari kelas {{ $kelasTerpilih }}.
                    </p>

                @endif

            @endif

        </div>

    </div>


    {{-- NILAI --}}
    <div class="bg-white rounded-2xl border border-orange-100 shadow-sm p-5">

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
            value="{{ old('nilai') }}"
            min="0"
            max="100"
            step="0.01"
            required
            placeholder="Masukkan nilai 0 - 100"
            class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
        >

        <p class="text-[11px] text-slate-400 mt-2">
            Nilai harus berada di antara 0 sampai 100.
        </p>

    </div>


    {{-- BUTTON --}}
    <div class="flex justify-end gap-3">

        <a
            href="{{ route('guru.nilai.index') }}"
            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-semibold transition"
        >
            Batal
        </a>

        <button
            type="submit"
            @disabled(!$kelasTerpilih || $siswa->isEmpty())
            class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold transition disabled:bg-slate-300 disabled:cursor-not-allowed"
        >
            Simpan Nilai
        </button>

    </div>

</form>

</div>

<script>
    function pilihKelas(select) {
        const url = new URL("{{ route('guru.nilai.create') }}");
        const mapel = document.getElementById('id_mata_pelajaran').value;

        if (select.value) {
            url.searchParams.set('kelas', select.value);
        }

        if (mapel) {
            url.searchParams.set('id_mata_pelajaran', mapel);
        }

        window.location.href = url.toString();
    }

    function ubahMapel(select) {
        const url = new URL("{{ route('guru.nilai.create') }}");
        const kelas = document.getElementById('kelas').value;

        if (select.value) {
            url.searchParams.set('id_mata_pelajaran', select.value);
        }

        if (kelas) {
            url.searchParams.set('kelas', kelas);
        }

        window.location.href = url.toString();
    }
</script>

@endsection
