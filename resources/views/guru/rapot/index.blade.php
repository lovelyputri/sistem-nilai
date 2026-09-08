@extends('layoutGuru')

@section('title', 'Rapot Siswa')

@section('content')

<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
                <a href="{{ route('guru.dashboard') }}" class="hover:text-orange-600 transition">
                    Dashboard
                </a>
                <span>/</span>
                <span class="text-slate-500">
                    Rapot
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Rapot Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Lihat dan kelola rapot siswa berdasarkan kelas.
            </p>
        </div>

    </div>

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-5 mb-6">

        <div class="flex flex-col lg:flex-row lg:items-end gap-4">

            <div class="flex-1">

                <label
                    for="kelas"
                    class="block text-sm font-bold text-slate-700 mb-2"
                >
                    Pilih Kelas
                </label>

                <select
                    id="kelas"
                    onchange="pilihKelas(this)"
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-700 focus:outline-none focus:border-orange-400 focus:ring-4 focus:ring-orange-100"
                >

                    <option value="">
                        Pilih kelas terlebih dahulu
                    </option>

                    @foreach($kelasGuru as $kelas)

                        <option
                            value="{{ $kelas }}"
                            @selected($kelasTerpilih == $kelas)
                        >
                            {{ $kelas }}
                        </option>

                    @endforeach

                </select>

                <p class="text-[11px] text-slate-400 mt-2">
                    Hanya kelas yang ditugaskan admin kepada Anda yang tersedia.
                </p>

            </div>

        </div>

    </div>

    @if($kelasTerpilih)

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                <div>
                    <h2 class="font-bold text-slate-800">
                        Daftar Siswa
                    </h2>

                    <p class="text-xs text-slate-400 mt-1">
                        Kelas {{ $kelasTerpilih }}
                    </p>
                </div>

                <span class="px-3 py-1.5 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold">
                    {{ $siswa->count() }} Siswa
                </span>

            </div>

            @if($siswa->count())

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[700px]">

                        <thead class="bg-slate-50">

                            <tr>

                                <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                    No
                                </th>

                                <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                    Siswa
                                </th>

                                <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                    NIS
                                </th>

                                <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                    NISN
                                </th>

                                <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-400">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach($siswa as $item)

                                <tr class="hover:bg-orange-50/30 transition">

                                    <td class="px-5 py-4 text-sm text-slate-500">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($item->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <p class="text-sm font-semibold text-slate-800">
                                                    {{ $item->name }}
                                                </p>

                                                <p class="text-xs text-slate-400">
                                                    {{ $item->kelas }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $item->nis ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4 text-sm text-slate-600">
                                        {{ $item->nisn ?? '-' }}
                                    </td>

                                    <td class="px-5 py-4">

                                        <div class="flex justify-center">

                                            <a
                                                href="{{ route('guru.rapot.show', $item->id) }}"
                                                class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold hover:bg-orange-100 transition"
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
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.46 12C3.73 7.94 7.52 5 12 5s8.27 2.94 9.54 7c-1.27 4.06-5.06 7-9.54 7s-8.27-2.94-9.54-7z"
                                                    />
                                                </svg>

                                                Lihat Rapot
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="py-12 text-center">

                    <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">
                        <svg
                            class="w-7 h-7"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3l7.82-14a2 2 0 00-3.42 0z"
                            />
                        </svg>
                    </div>

                    <p class="font-semibold text-slate-700">
                        Belum ada siswa
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Tidak terdapat siswa pada kelas ini.
                    </p>

                </div>

            @endif

        </div>

    @else

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm py-16 text-center">

            <div class="w-16 h-16 mx-auto rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center mb-4">

                <svg
                    class="w-8 h-8"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7h18M5 7v12h14V7M9 7V4h6v3"
                    />
                </svg>

            </div>

            <p class="font-semibold text-slate-700">
                Pilih kelas terlebih dahulu
            </p>

            <p class="text-xs text-slate-400 mt-1">
                Pilih kelas untuk melihat daftar siswa dan rapot.
            </p>

        </div>

    @endif

</div>

<script>
    function pilihKelas(select) {
        const url = new URL("{{ route('guru.rapot.index') }}");

        if (select.value) {
            url.searchParams.set('kelas', select.value);
        }

        window.location.href = url.toString();
    }
</script>

@endsection
