@extends('layoutGuru')

@section('title', 'Rapot Siswa')

@section('content')

<div class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>

            <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">

                <a
                    href="{{ route('guru.dashboard') }}"
                    class="hover:text-orange-600 transition"
                >
                    Dashboard
                </a>

                <span>/</span>

                <a
                    href="{{ route('guru.rapot.index') }}"
                    class="hover:text-orange-600 transition"
                >
                    Rapot
                </a>

                <span>/</span>

                <span class="text-slate-500">
                    Detail
                </span>

            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Rapot Siswa
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Rekap hasil belajar siswa.
            </p>

        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('guru.rapot.index', ['kelas' => $siswa->kelas]) }}"
                class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 text-sm font-semibold hover:border-orange-300 hover:text-orange-600 transition"
            >
                ← Kembali
            </a>

            <button
                onclick="window.print()"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-orange-500 text-white text-sm font-semibold hover:bg-orange-600 transition"
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
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z"
                    />
                </svg>

                Cetak
            </button>

        </div>

    </div>

    <div id="rapot" class="space-y-6">

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6">

            <div class="text-center border-b border-slate-200 pb-5">

                <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider">
                    Pemerintah Kabupaten
                </p>

                <h2 class="text-xl font-bold text-slate-800 mt-1">
                    SMK MUHAMMADIYAH 6 ROGOJAMPI
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Laporan Hasil Belajar Peserta Didik
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Tahun Pelajaran 2026/2027
                </p>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-3 mt-6 text-sm">

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Nama</span>
                    <strong class="text-slate-700">
                        {{ $siswa->name }}
                    </strong>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Kelas</span>
                    <strong class="text-slate-700">
                        {{ $siswa->kelas }}
                    </strong>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">NIS</span>
                    <strong class="text-slate-700">
                        {{ $siswa->nis ?? '-' }}
                    </strong>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">NISN</span>
                    <strong class="text-slate-700">
                        {{ $siswa->nisn ?? '-' }}
                    </strong>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Semester</span>
                    <strong class="text-slate-700">
                        Ganjil
                    </strong>
                </div>

                <div class="flex justify-between gap-4">
                    <span class="text-slate-400">Tahun Pelajaran</span>
                    <strong class="text-slate-700">
                        2026/2027
                    </strong>
                </div>

            </div>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <h3 class="font-bold text-slate-800">
                    Nilai Akademik
                </h3>

                <p class="text-xs text-slate-400 mt-1">
                    Rekap nilai seluruh mata pelajaran.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[650px]">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-400">
                                No
                            </th>

                            <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                                Mata Pelajaran
                            </th>

                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-400">
                                Nilai
                            </th>

                            <th class="px-5 py-3 text-center text-xs font-bold uppercase tracking-wide text-slate-400">
                                Predikat
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($nilai as $item)

                            <tr class="hover:bg-orange-50/30 transition">

                                <td class="px-5 py-4 text-center text-sm text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-5 py-4">

                                    <p class="text-sm font-semibold text-slate-800">
                                        {{ $item['mapel'] }}
                                    </p>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        {{ $item['kode'] }}
                                    </p>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="text-lg font-bold text-orange-600">
                                        {{ $item['nilai'] }}
                                    </span>

                                </td>

                                <td class="px-5 py-4 text-center">

                                    <span class="inline-flex px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold">
                                        {{ $item['predikat'] }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="p-5 bg-orange-50/50 border-t border-orange-100">

                <div class="flex items-center justify-between">

                    <span class="text-sm font-semibold text-slate-600">
                        Rata-rata Nilai
                    </span>

                    <span class="text-2xl font-bold text-orange-600">
                        {{ $rataRata }}
                    </span>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-100">

                    <h3 class="font-bold text-slate-800">
                        Kehadiran
                    </h3>

                </div>

                <div class="p-5 space-y-3">

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-500">
                            Sakit
                        </span>

                        <span class="font-bold text-slate-700">
                            {{ $kehadiran['sakit'] }} hari
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-500">
                            Izin
                        </span>

                        <span class="font-bold text-slate-700">
                            {{ $kehadiran['izin'] }} hari
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-500">
                            Tanpa Keterangan
                        </span>

                        <span class="font-bold text-slate-700">
                            {{ $kehadiran['tanpa_keterangan'] }} hari
                        </span>
                    </div>

                </div>

            </div>

            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

                <div class="px-5 py-4 border-b border-slate-100">

                    <h3 class="font-bold text-slate-800">
                        Ekstrakurikuler
                    </h3>

                </div>

                <div class="p-5 space-y-3">

                    @foreach($ekstrakurikuler as $item)

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $item['nama'] }}
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $item['keterangan'] }}
                                </p>

                            </div>

                            <span class="shrink-0 px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold">
                                {{ $item['predikat'] }}
                            </span>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">

                <h3 class="font-bold text-slate-800">
                    Catatan Wali Kelas
                </h3>

            </div>

            <div class="p-5">

                <p class="text-sm leading-6 text-slate-600">
                    {{ $catatan }}
                </p>

            </div>

        </div>

        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wide text-orange-500">
                        Status
                    </p>

                    <p class="text-xl font-bold text-orange-700 mt-1">
                        {{ $status }}
                    </p>

                </div>

                <div class="text-sm text-orange-700">
                    Rata-rata akhir:
                    <strong class="text-lg ml-1">
                        {{ $rataRata }}
                    </strong>
                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 pt-8">

            <div class="text-center">

                <p class="text-sm text-slate-500">
                    Orang Tua/Wali
                </p>

                <div class="h-20"></div>

                <p class="text-sm font-semibold text-slate-700">
                    ______________________
                </p>

            </div>

            <div class="text-center">

                <p class="text-sm text-slate-500">
                    Wali Kelas
                </p>

                <div class="h-20"></div>

                <p class="text-sm font-semibold text-slate-700">
                    ______________________
                </p>

            </div>

        </div>

    </div>

</div>

<style>
    @media print {
        body {
            background: white !important;
        }

        nav,
        header,
        aside,
        button,
        a {
            display: none !important;
        }

        #rapot {
            max-width: 100% !important;
        }

        #rapot > div {
            box-shadow: none !important;
            border: 1px solid #e2e8f0 !important;
            break-inside: avoid;
        }
    }
</style>

@endsection
