@extends('layout')

@section('title', 'Preview Rapor')

@section('content')

<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">

{{-- HEADER HALAMAN --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

    <div>

        <div class="flex items-center gap-2 text-sm text-slate-400 mb-3">

            <a href="{{ route('admin.rapor.index') }}"
               class="hover:text-orange-600">
                Ekspor Rapor
            </a>

            <span>/</span>

            <span>Preview</span>

        </div>

        <h1 class="text-2xl font-bold text-slate-800">
            Preview Rapor
        </h1>

        <p class="text-sm text-slate-500 mt-2">
            Periksa data rapor sebelum mengunduh PDF.
        </p>

    </div>


    <div class="flex items-center gap-3">

        <a href="{{ route('admin.rapor.index', ['kelas' => $siswa->kelas]) }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">

            Kembali

        </a>


        <a href="{{ route('admin.rapor.export', [
                'kelas' => $siswa->kelas,
                'id_siswa' => $siswa->id
            ]) }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold transition">

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 3v12m0 0l4-4m-4 4l-4-4M5 21h14"/>

            </svg>

            Export PDF

        </a>

    </div>

</div>


{{-- =========================================================
     RAPOR
========================================================== --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 max-w-7xl mx-auto">


    {{-- =====================================================
         KOP SEKOLAH
    ====================================================== --}}

    <div class="w-full text-center mb-5">

        <div class="flex justify-center mb-2">

            <img src="{{ asset('images/SMUHERO_logo.png') }}"
                 alt="Logo SMK Muhammadiyah 6 Rogojampi"
                 class="w-[63px] h-[63px] object-contain">

        </div>


        <div class="text-[17px] font-bold tracking-wide uppercase text-orange-800">
            SMK MUHAMMADIYAH 6 ROGOJAMPI
        </div>


        <div class="mt-1 text-[10px] font-bold tracking-wide uppercase text-slate-600">
            LAPORAN HASIL BELAJAR PESERTA DIDIK
        </div>


        <div class="mt-2 text-sm font-bold tracking-widest text-slate-900">
            RAPOR
        </div>


        <div class="mt-3 border-b-2 border-orange-700"></div>

        <div class="mt-[2px] border-b border-stone-300"></div>

    </div>


    {{-- =====================================================
         IDENTITAS SISWA
    ====================================================== --}}

    <div class="mt-6 mb-7">

        <div class="mb-3 pb-1 border-b-2 border-orange-600 text-[11px] font-bold text-orange-800">
            A. IDENTITAS PESERTA DIDIK
        </div>


        <table class="w-full border-collapse text-[13px]">

            <tbody>

                {{-- BARIS 1 --}}
                <tr>

                    <td class="w-[18%] py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Nama
                    </td>

                    <td class="w-[2%] py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="w-[30%] py-1.5 text-slate-900 align-top">
                        {{ $siswa->name ?? '-' }}
                    </td>


                    <td class="w-[18%] py-1.5 pr-2 font-bold text-slate-600 align-top">
                        NIS
                    </td>

                    <td class="w-[2%] py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="w-[30%] py-1.5 text-slate-900 align-top">
                        {{ $siswa->nis ?? '-' }}
                    </td>

                </tr>


                {{-- BARIS 2 --}}
                <tr>

                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        NISN
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->nisn ?? '-' }}
                    </td>


                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Kelas
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->kelas ?? '-' }}
                    </td>

                </tr>


                {{-- BARIS 3 --}}
                <tr>

                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Jurusan
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->jurusan ?? '-' }}
                    </td>


                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Tahun Masuk
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->tahun_masuk ?? '-' }}
                    </td>

                </tr>


                {{-- BARIS 4 --}}
                <tr>

                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Tempat, Tanggal Lahir
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">

                        @if ($siswa->tempat_lahir)
                            {{ $siswa->tempat_lahir }},
                        @endif

                        @if ($siswa->tanggal_lahir)
                            {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}
                        @else
                            -
                        @endif

                    </td>


                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Agama
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->agama ?? '-' }}
                    </td>

                </tr>


                {{-- BARIS 5 --}}
                <tr>

                    <td class="py-1.5 pr-2 font-bold text-slate-600 align-top">
                        Alamat
                    </td>

                    <td class="py-1.5 text-center font-bold text-orange-700 align-top">
                        :
                    </td>

                    <td colspan="4"
                        class="py-1.5 text-slate-900 align-top">
                        {{ $siswa->alamat ?? '-' }}
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    {{-- =====================================================
         HASIL BELAJAR
    ====================================================== --}}

    <div class="mb-7">

        <div class="mb-3 pb-1 border-b-2 border-orange-600 text-[11px] font-bold text-orange-800">
            B. HASIL BELAJAR
        </div>


        <div class="overflow-x-auto">

            <table class="w-full border-collapse table-fixed text-[12px]">

                <thead>

                    <tr>

                        <th class="w-[6%] border border-slate-300 px-2 py-2 text-center font-bold bg-orange-50 text-orange-800">
                            No
                        </th>

                        <th class="w-[25%] border border-slate-300 px-2 py-2 text-center font-bold bg-orange-50 text-orange-800">
                            Mata Pelajaran
                        </th>

                        <th class="w-[11%] border border-slate-300 px-2 py-2 text-center font-bold bg-orange-50 text-orange-800">
                            Nilai
                        </th>

                        <th class="w-[12%] border border-slate-300 px-2 py-2 text-center font-bold bg-orange-50 text-orange-800">
                            Predikat
                        </th>

                        <th class="w-[46%] border border-slate-300 px-2 py-2 text-center font-bold bg-orange-50 text-orange-800">
                            Deskripsi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($dataNilai as $index => $item)

                        <tr class="{{ $index % 2 === 1 ? 'bg-stone-50' : 'bg-white' }}">

                            {{-- NO --}}
                            <td class="border border-slate-300 px-2 py-2 text-center text-slate-900 align-middle">
                                {{ $index + 1 }}
                            </td>


                            {{-- MATA PELAJARAN --}}
                            <td class="border border-slate-300 px-2 py-2 text-slate-900 align-middle">
                                {{ $item['mata_pelajaran'] ?? '-' }}
                            </td>


                            {{-- NILAI --}}
                            <td class="border border-slate-300 px-2 py-2 text-center text-slate-900 align-middle">
                                @if ($item['nilai'] !== null)
                                    {{ $item['nilai'] }}
                                @else
                                    -
                                @endif
                            </td>


                            {{-- PREDIKAT --}}
                            <td class="border border-slate-300 px-2 py-2 text-center text-slate-900 align-middle">
                                {{ $item['predikat'] ?? '-' }}
                            </td>


                            {{-- DESKRIPSI --}}
                            <td class="border border-slate-300 px-2 py-2 text-left leading-5 text-slate-900 align-middle">
                                {{ $item['deskripsi'] ?? '-' }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="border border-slate-300 px-4 py-8 text-center text-slate-500">

                                Belum terdapat data mata pelajaran.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- =====================================================
         RINGKASAN NILAI
    ====================================================== --}}

    <div class="mb-5">

        <div class="mb-3 pb-1 border-b-2 border-orange-600 text-[11px] font-bold text-orange-800">
            C. RINGKASAN NILAI
        </div>


        <table class="w-full border-collapse text-[12px]">

            <tbody>

                <tr>

                    <td class="w-[25%] border border-slate-300 px-3 py-2.5 bg-orange-50 font-bold text-orange-800">
                        Rata-rata Nilai
                    </td>

                    <td class="w-[25%] border border-slate-300 px-3 py-2.5 text-center font-bold text-slate-900 bg-white">
                        {{ $rataRata !== null
                            ? number_format($rataRata, 2, ',', '.')
                            : '-' }}
                    </td>

                    <td class="w-[25%] border border-slate-300 px-3 py-2.5 bg-orange-50 font-bold text-orange-800">
                        Jumlah Mata Pelajaran
                    </td>

                    <td class="w-[25%] border border-slate-300 px-3 py-2.5 text-center font-bold text-slate-900 bg-white">
                        {{ $dataNilai->count() }}
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    {{-- =====================================================
         CATATAN
    ====================================================== --}}

    <div class="mt-4 px-3 py-2.5 border-l-[3px] border-orange-600 bg-orange-50 text-[11px] leading-5 text-slate-500">

        <strong class="text-orange-800">
            Catatan:
        </strong>

        Nilai pada rapor merupakan nilai yang telah diberikan
        oleh guru mata pelajaran. Predikat dan deskripsi hasil
        belajar ditampilkan berdasarkan data yang telah dibuat
        oleh guru.

    </div>


    {{-- =====================================================
         TANDA TANGAN
    ====================================================== --}}

    <div class="mt-14">

        <div class="grid grid-cols-2 gap-10 text-sm">


            {{-- ORANG TUA / WALI MURID --}}
            <div class="text-center text-slate-600">

                <div>
                    Mengetahui,
                </div>

                <div class="mt-1 font-bold text-slate-800">
                    Orang Tua/Wali Murid
                </div>

                <div class="h-[60px]"></div>

                <div class="font-bold text-slate-900 underline">
                    ______________________
                </div>

            </div>


            {{-- WALI KELAS --}}
            <div class="text-center text-slate-600">

                <div>
                    Mengetahui,
                </div>

                <div class="mt-1 font-bold text-slate-800">
                    Wali Kelas
                </div>

                <div class="h-[60px]"></div>

                <div class="font-bold text-slate-900 underline">
                    ______________________
                </div>

            </div>

        </div>


        {{-- KEPALA SEKOLAH --}}
        <div class="text-center mt-7 text-sm text-slate-600">

            <div>
                Mengetahui,
            </div>

            <div class="mt-1 font-bold text-slate-800">
                Kepala Sekolah
            </div>

            <div class="h-[60px]"></div>

            <div class="font-bold text-slate-900 underline">
                ______________________
            </div>

        </div>

    </div>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="mt-7 pt-2 border-t border-slate-200 text-center text-[10px] text-slate-400">

        Dokumen ini dibuat melalui sistem EDUGRADES —
        SMK MUHAMMADIYAH 6 ROGOJAMPI

    </div>

</div>


</div>

@endsection
