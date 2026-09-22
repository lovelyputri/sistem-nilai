@extends('layout')

@section('title', 'Ekspor Rapor')

@section('content')

<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-orange-600"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Ekspor Rapor
                </h1>

                <p class="text-sm text-slate-500">
                    Pilih kelas dan siswa untuk melihat serta mengunduh rapor.
                </p>
            </div>
        </div>
    </div>


    {{-- FILTER --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sm:p-6">

        <div class="mb-5">
            <h2 class="text-base font-semibold text-slate-800">
                Pilih Data Rapor
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Pilih kelas terlebih dahulu, kemudian pilih siswa.
            </p>
        </div>

        <form method="GET"
              action="{{ route('admin.rapor.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- KELAS --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kelas
                    </label>

                    <select name="kelas"
                            onchange="this.form.submit()"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 focus:border-orange-500 focus:ring-orange-500">

                        <option value="">
                            Pilih kelas
                        </option>

                        @foreach ($kelasList as $kelas)
                            <option value="{{ $kelas }}"
                                {{ request('kelas') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- SISWA --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Siswa
                    </label>

                    <select name="id_siswa"
                            id="id_siswa"
                            {{ !request('kelas') ? 'disabled' : '' }}
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 disabled:bg-slate-100 disabled:text-slate-400 focus:border-orange-500 focus:ring-orange-500">

                        <option value="">
                            {{ request('kelas')
                                ? 'Pilih siswa'
                                : 'Pilih kelas terlebih dahulu'
                            }}
                        </option>

                        @foreach ($siswaList as $siswa)
                            <option value="{{ $siswa->id }}">
                                {{ $siswa->name }}
                                — {{ $siswa->nis ?? '-' }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="mt-6 flex justify-end">
                <button type="button"
                        onclick="lihatRapor()"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold transition">

                    <svg class="w-4 h-4"
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
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>

                    Lihat Rapor
                </button>
            </div>

        </form>

    </div>


    {{-- INFO --}}
    <div class="mt-5 bg-orange-50 border border-orange-100 rounded-2xl p-4">
        <div class="flex gap-3">

            <svg class="w-5 h-5 text-orange-600 mt-0.5 flex-shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>

            <p class="text-sm text-orange-800 leading-6">
                Rapor mengambil seluruh nilai yang telah tersimpan untuk siswa
                tersebut. Deskripsi yang telah dibuat pada fitur deskripsi rapor
                juga akan ditampilkan secara otomatis.
            </p>

        </div>
    </div>

</div>


<script>
    function lihatRapor() {

        const kelas = @json(request('kelas'));
        const siswa = document.getElementById('id_siswa').value;

        if (!kelas) {
            alert('Silakan pilih kelas terlebih dahulu.');
            return;
        }

        if (!siswa) {
            alert('Silakan pilih siswa terlebih dahulu.');
            return;
        }

        const url = new URL(
            "{{ route('admin.rapor.preview') }}",
            window.location.origin
        );

        url.searchParams.set('kelas', kelas);
        url.searchParams.set('id_siswa', siswa);

        window.location.href = url.toString();
    }
</script>

@endsection
