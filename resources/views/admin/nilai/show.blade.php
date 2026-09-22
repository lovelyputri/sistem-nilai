@extends('layout')

@section('content')

<main class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

{{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600 transition">
                Dashboard
            </a>

            <span>/</span>

            <a href="{{ route('admin.nilai.index') }}" class="hover:text-orange-600 transition">
                Kelola Nilai
            </a>

            <span>/</span>

            <span class="text-slate-500">Detail Siswa</span>
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
            Detail Nilai Siswa
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Informasi lengkap nilai akademik siswa
        </p>
    </div>

    <a href="{{ route('admin.nilai.index') }}"
       class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
              bg-white border border-slate-200 text-slate-600 text-sm font-semibold
              hover:border-orange-300 hover:text-orange-600 hover:bg-orange-50 transition">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="17"
             height="17"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"/>
        </svg>

        Kembali
    </a>
</div>


{{-- INFORMASI SISWA --}}
<div class="bg-white border border-orange-100 rounded-2xl shadow-sm overflow-hidden mb-6">

    <div class="p-5 sm:p-6">

        <div class="flex flex-col md:flex-row md:items-center gap-5">

            {{-- AVATAR --}}
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600
                        flex items-center justify-center text-white text-2xl font-bold shadow-sm shrink-0">

                {{ strtoupper(substr($siswa->name ?? 'S', 0, 1)) }}

            </div>

            {{-- DATA SISWA --}}
            <div class="flex-1 min-w-0">

                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">

                    <h2 class="text-xl font-bold text-slate-800 truncate">
                        {{ $siswa->name ?? '-' }}
                    </h2>

                    <span class="inline-flex w-fit items-center px-2.5 py-1 rounded-lg
                                 bg-orange-50 text-orange-600 text-xs font-semibold">
                        {{ $siswa->kelas ?? 'Kelas belum tersedia' }}
                    </span>

                </div>

                <div class="flex flex-wrap gap-x-5 gap-y-2 mt-2 text-sm text-slate-500">

                    <div class="flex items-center gap-1.5">
                        <svg width="16" height="16" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16v16H4z"/>
                            <path d="M8 8h8M8 12h8M8 16h5"/>
                        </svg>

                        NIS: <span class="font-medium text-slate-700">
                            {{ $siswa->nis ?? '-' }}
                        </span>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <svg width="16" height="16" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 5h16v14H4z"/>
                            <path d="M8 9h8M8 13h5"/>
                        </svg>

                        Total Mapel:
                        <span class="font-medium text-slate-700">
                            {{ $totalMapel }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>


{{-- STATISTIK --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

    {{-- JUMLAH NILAI --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

        <div class="flex items-center justify-between mb-4">

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Nilai Terisi
                </p>

                <p class="text-3xl font-bold text-slate-800 mt-1">
                    {{ $jumlahNilai }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

                <svg width="21" height="21" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19V5"/>
                    <path d="M4 19h16"/>
                    <path d="m7 15 3-4 3 2 5-7"/>
                </svg>

            </div>

        </div>

        <p class="text-xs text-slate-400">
            Dari {{ $totalMapel }} mata pelajaran
        </p>

    </div>


    {{-- RATA-RATA --}}
    <div class="bg-white border border-orange-200 rounded-2xl p-5 shadow-sm">

        <div class="flex items-center justify-between mb-4">

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Rata-rata
                </p>

                <p class="text-3xl font-bold text-orange-600 mt-1">
                    {{ $rataRata !== null ? number_format($rataRata, 2) : '-' }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">

                <svg width="21" height="21" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2v20"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7H14a3.5 3.5 0 0 1 0 7H6"/>
                </svg>

            </div>

        </div>

        <p class="text-xs font-medium text-orange-600">

            @if($rataRata !== null)

                @if($rataRata >= 85)
                    Sangat Baik
                @elseif($rataRata >= 70)
                    Baik
                @elseif($rataRata >= 60)
                    Cukup
                @else
                    Perlu Bimbingan
                @endif

            @else
                Belum ada nilai
            @endif

        </p>

    </div>


    {{-- PROGRESS --}}
    @php
        $progress = $totalMapel > 0
            ? round(($jumlahNilai / $totalMapel) * 100)
            : 0;
    @endphp

    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">

        <div class="flex items-center justify-between mb-4">

            <div>
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                    Progress
                </p>

                <p class="text-3xl font-bold text-slate-800 mt-1">
                    {{ $progress }}%
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

                <svg width="21" height="21" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 6 9 17l-5-5"/>
                </svg>

            </div>

        </div>

        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">

            <div class="h-full bg-gradient-to-r from-orange-500 to-orange-400 rounded-full transition-all"
                 style="width: {{ min($progress, 100) }}%">
            </div>

        </div>

    </div>

</div>


{{-- NILAI YANG SUDAH DIISI --}}
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">

    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">

        <div>

            <h3 class="font-bold text-slate-800">
                Nilai yang Sudah Diisi
            </h3>

            <p class="text-xs text-slate-400 mt-1">
                Daftar nilai yang telah diberikan oleh guru
            </p>

        </div>

        <span class="px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-bold">
            {{ $jumlahNilai }} Nilai
        </span>

    </div>


    @if($siswa->nilai->count() > 0)

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
                            Kategori
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-400">
                            Guru
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-400">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @foreach($siswa->nilai as $n)

                        @php
                            $nilai = $n->nilai;

                            if ($nilai >= 85) {
                                $kategori = 'A · Sangat Baik';
                                $badge = 'bg-emerald-50 text-emerald-700';
                            } elseif ($nilai >= 70) {
                                $kategori = 'B · Baik';
                                $badge = 'bg-blue-50 text-blue-700';
                            } elseif ($nilai >= 60) {
                                $kategori = 'C · Cukup';
                                $badge = 'bg-amber-50 text-amber-700';
                            } else {
                                $kategori = 'D · Kurang';
                                $badge = 'bg-red-50 text-red-700';
                            }
                        @endphp

                        <tr class="hover:bg-orange-50/40 transition">

                            <td class="px-5 py-4">

                                <div class="font-semibold text-sm text-slate-800">
                                    {{ $n->mataPelajaran->name ?? '-' }}
                                </div>

                                @if($n->mataPelajaran?->kode)
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        {{ $n->mataPelajaran->kode }}
                                    </div>
                                @endif

                            </td>

                            <td class="px-5 py-4 text-center">

                                <span class="text-lg font-bold text-slate-800">
                                    {{ $nilai }}
                                </span>

                            </td>

                            <td class="px-5 py-4">

                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $badge }}">
                                    {{ $kategori }}
                                </span>

                            </td>

                            <td class="px-5 py-4">

                                <span class="text-sm text-slate-600">
                                    {{ $n->guru->name ?? '-' }}
                                </span>

                            </td>

                            <td class="px-5 py-4 text-right">

                                <form action="{{ route('admin.nilai.destroy', $n->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus nilai ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center justify-center w-9 h-9
                                                   rounded-lg text-red-500 bg-red-50
                                                   hover:bg-red-100 transition"
                                            title="Hapus nilai">

                                        <svg width="17" height="17" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18"/>
                                            <path d="M8 6V4h8v2"/>
                                            <path d="M19 6l-1 14H6L5 6"/>
                                            <path d="M10 11v5M14 11v5"/>
                                        </svg>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="px-6 py-12 text-center">

            <div class="w-14 h-14 mx-auto rounded-2xl bg-orange-50
                        text-orange-500 flex items-center justify-center mb-4">

                <svg width="26" height="26" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v4"/>
                    <path d="M12 17h.01"/>
                    <circle cx="12" cy="12" r="10"/>
                </svg>

            </div>

            <h4 class="font-semibold text-slate-700">
                Belum ada nilai
            </h4>

            <p class="text-sm text-slate-400 mt-1">
                Belum ada nilai yang diberikan untuk siswa ini.
            </p>

        </div>

    @endif

</div>


{{-- MATA PELAJARAN BELUM DIISI --}}
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">

    <div class="px-5 py-4 border-b border-slate-100">

        <h3 class="font-bold text-slate-800">
            Mata Pelajaran Belum Diisi
        </h3>

        <p class="text-xs text-slate-400 mt-1">
            Mata pelajaran yang belum memiliki nilai untuk siswa ini
        </p>

    </div>

    <div class="p-5">

        @if($mataPelajaranBelumDiisi->count() > 0)

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

                @foreach($mataPelajaranBelumDiisi as $m)

                    <div class="flex items-center gap-3 p-3 rounded-xl
                                bg-red-50 border border-red-100">

                        <div class="w-9 h-9 rounded-lg bg-white text-red-500
                                    flex items-center justify-center shrink-0">

                            <svg width="17" height="17" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 8v4M12 16h.01"/>
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-semibold text-red-700 truncate">
                                {{ $m->name }}
                            </p>

                            @if($m->kode)
                                <p class="text-xs text-red-400 mt-0.5">
                                    {{ $m->kode }}
                                </p>
                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="py-6 text-center">

                <div class="w-12 h-12 mx-auto rounded-xl bg-emerald-50
                            text-emerald-600 flex items-center justify-center mb-3">

                    <svg width="23" height="23" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 6 9 17l-5-5"/>
                    </svg>

                </div>

                <p class="font-semibold text-slate-700">
                    Semua mata pelajaran sudah terisi
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Tidak ada nilai yang masih kosong.
                </p>

            </div>

        @endif

    </div>

</div>


{{-- RINGKASAN --}}
<div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-5 sm:p-6 text-white shadow-sm">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">

        <div>

            <p class="text-orange-100 text-xs font-semibold uppercase tracking-wide">
                Ringkasan Akademik
            </p>

            <h3 class="text-xl font-bold mt-1">
                {{ $jumlahNilai }} dari {{ $totalMapel }} mata pelajaran telah dinilai
            </h3>

            <p class="text-sm text-orange-100 mt-1">
                Progress pengisian nilai siswa saat ini mencapai {{ $progress }}%.
            </p>

        </div>

        <div class="w-20 h-20 rounded-full border-4 border-white/30
                    flex items-center justify-center shrink-0">

            <span class="text-xl font-bold">
                {{ $progress }}%
            </span>

        </div>

    </div>

</div>

</main>

@endsection
