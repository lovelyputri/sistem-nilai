@extends('layoutGuru')

@section('title', 'Detail Nilai Siswa')

@section('content')

<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>

            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">

                <a href="{{ route('guru.dashboard') }}" class="hover:text-orange-600 transition">
                    Dashboard
                </a>

                <span>/</span>

                <a href="{{ route('guru.nilai.index') }}" class="hover:text-orange-600 transition">
                    Nilai
                </a>

                <span>/</span>

                <span class="text-slate-500">
                    Detail Siswa
                </span>

            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Detail Nilai Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Rekap nilai yang Anda berikan kepada siswa.
            </p>

        </div>

        <a
            href="{{ route('guru.nilai.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm font-semibold hover:border-orange-300 hover:text-orange-600 hover:bg-orange-50 transition"
        >
            ← Kembali
        </a>

    </div>

    {{-- SISWA --}}
    <div class="bg-white border border-orange-100 rounded-2xl shadow-sm overflow-hidden mb-6">

        <div class="p-5 sm:p-6">

            <div class="flex flex-col sm:flex-row sm:items-center gap-5">

                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white text-2xl font-bold shrink-0">
                    {{ strtoupper(substr($siswa->name ?? 'S', 0, 1)) }}
                </div>

                <div class="flex-1">

                    <div class="flex flex-wrap items-center gap-2">

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $siswa->name ?? '-' }}
                        </h2>

                        <span class="px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-semibold">
                            {{ $siswa->kelas ?? '-' }}
                        </span>

                    </div>

                    <div class="flex flex-wrap gap-x-5 gap-y-2 mt-2 text-sm text-slate-500">

                        <span>
                            NIS:
                            <strong class="text-slate-700">
                                {{ $siswa->nis ?? '-' }}
                            </strong>
                        </span>

                        <span>
                            NISN:
                            <strong class="text-slate-700">
                                {{ $siswa->nisn ?? '-' }}
                            </strong>
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- STAT --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Nilai Terisi
            </p>

            <p class="text-3xl font-bold text-slate-800 mt-1">
                {{ $jumlahNilai }}
            </p>

            <p class="text-xs text-slate-400 mt-1">
                Dari {{ $totalMapel }} mata pelajaran
            </p>

        </div>

        <div class="bg-white border border-orange-200 rounded-2xl p-5 shadow-sm">

            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Rata-rata
            </p>

            <p class="text-3xl font-bold text-orange-600 mt-1">
                {{ $rataRata !== null ? number_format($rataRata, 2) : '-' }}
            </p>

            <p class="text-xs text-orange-500 mt-1">
                Rata-rata nilai siswa
            </p>

        </div>

        @php
            $progress = $totalMapel > 0
                ? round(($jumlahNilai / $totalMapel) * 100)
                : 0;
        @endphp

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                Progress
            </p>

            <p class="text-3xl font-bold text-slate-800 mt-1">
                {{ $progress }}%
            </p>

            <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mt-3">

                <div
                    class="h-full bg-orange-500 rounded-full"
                    style="width: {{ min($progress, 100) }}%"
                ></div>

            </div>

        </div>

    </div>

    {{-- NILAI --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100">

            <h3 class="font-bold text-slate-800">
                Nilai Siswa
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Daftar nilai yang telah Anda input.
            </p>

        </div>

        @if($nilai->count())

            <div class="overflow-x-auto">

                <table class="w-full min-w-[650px]">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                Mata Pelajaran
                            </th>

                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-400">
                                Nilai
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                Keterangan
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-400">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($nilai as $item)

                            @php

                                if ($item->nilai >= 85) {
                                    $kategori = 'Sangat Baik';
                                    $badge = 'bg-emerald-50 text-emerald-700';
                                } elseif ($item->nilai >= 75) {
                                    $kategori = 'Baik';
                                    $badge = 'bg-blue-50 text-blue-700';
                                } elseif ($item->nilai >= 60) {
                                    $kategori = 'Cukup';
                                    $badge = 'bg-amber-50 text-amber-700';
                                } else {
                                    $kategori = 'Perlu Bimbingan';
                                    $badge = 'bg-red-50 text-red-700';
                                }

                            @endphp

                            <tr class="hover:bg-orange-50/30 transition">

                                <td class="px-5 py-4">

                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $item->mataPelajaran->name ?? '-' }}
                                    </p>

                                    @if($item->mataPelajaran?->kode)

                                        <p class="text-xs text-slate-400 mt-0.5">
                                            {{ $item->mataPelajaran->kode }}
                                        </p>

                                    @endif

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="text-lg font-bold text-orange-600">
                                        {{ $item->nilai }}
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-bold {{ $badge }}">
                                        {{ $kategori }}
                                    </span>

                                </td>

                                <td class="px-5 py-4">

                                    <div class="flex justify-end gap-2">

                                        <a
                                            href="{{ route('guru.nilai.edit', $item->id) }}"
                                            class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition"
                                            title="Edit"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                            </svg>
                                        </a>

                                        <form
                                            action="{{ route('guru.nilai.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus nilai ini?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-100 transition"
                                                title="Hapus"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V5h6v2m-7 0 1 13h6l1-13"/>
                                                </svg>
                                            </button>

                                        </form>

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

                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"/>
                    </svg>

                </div>

                <p class="font-semibold text-slate-700">
                    Belum ada nilai
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Siswa ini belum memiliki nilai dari Anda.
                </p>

            </div>

        @endif

    </div>

    {{-- BELUM DIISI --}}
    @if($mataPelajaranBelumDiisi->count())

        <div class="mt-6 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <h3 class="font-bold text-slate-800">
                    Mata Pelajaran Belum Diisi
                </h3>

                <p class="text-xs text-slate-400 mt-1">
                    Mata pelajaran yang belum memiliki nilai untuk siswa ini.
                </p>

            </div>

            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

                @foreach($mataPelajaranBelumDiisi as $mapel)

                    <div class="p-3 rounded-xl bg-amber-50 border border-amber-100">

                        <p class="text-sm font-semibold text-amber-700">
                            {{ $mapel->name }}
                        </p>

                        @if($mapel->kode)
                            <p class="text-[10px] text-amber-500 mt-0.5">
                                {{ $mapel->kode }}
                            </p>
                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    @endif

</div>

@endsection