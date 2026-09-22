@extends('layout')

@section('content')

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- ========================================================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ========================================================= --}}

    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700
                    text-xs font-semibold px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-700
                    text-xs font-semibold px-4 py-3 rounded-xl">
            {{ session('error') }}
        </div>
    @endif


    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        {{-- TITLE --}}
        <div class="space-y-1.5">

            {{-- Breadcrumb --}}
            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1.5">

                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="hover:text-orange-600 transition-colors">
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <span class="text-slate-300">/</span>
                    </li>

                    <li>
                        <span class="text-slate-600">
                            Guru
                        </span>
                    </li>

                    <li>
                        <span class="text-slate-300">/</span>
                    </li>

                    <li class="font-medium text-slate-800">
                        Kelola Guru Kelas
                    </li>

                </ol>
            </nav>

            {{-- Title --}}
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800">
                    Kelola Guru Kelas
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola penugasan guru ke kelas. Satu guru dapat mengajar
                    lebih dari satu mata pelajaran dan beberapa kelas.
                </p>
            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- ACTION BUTTONS --}}
        {{-- ===================================================== --}}

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">

            {{-- Tambah Mata Pelajaran --}}
            <a href="{{ route('admin.guruKelas.tambahMapel') }}"
               class="inline-flex items-center justify-center gap-2
                      bg-white hover:bg-orange-50
                      text-orange-600 text-xs font-semibold
                      px-4 py-2.5 rounded-xl
                      border border-orange-200
                      transition-all">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>

                </svg>

                <span>
                    Tambah Mata Pelajaran
                </span>

            </a>


            {{-- Tambah Penugasan --}}
            <a href="{{ route('admin.guruKelas.tambahPenugasan') }}"
               class="inline-flex items-center justify-center gap-2
                      bg-orange-500 hover:bg-orange-600
                      text-white text-xs font-semibold
                      px-4 py-2.5 rounded-xl
                      shadow-md shadow-orange-500/20
                      transition-all">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2.5"
                          d="M12 4v16m8-8H4"/>

                </svg>

                <span>
                    Tambah Penugasan
                </span>

            </a>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">


        {{-- ===================================================== --}}
        {{-- FILTER --}}
        {{-- ===================================================== --}}

        <form action="{{ route('admin.guruKelas.daftarKelas') }}"
              method="GET"
              class="lg:col-span-3 bg-white p-5 rounded-2xl
                     border border-slate-100 shadow-sm space-y-4">

            {{-- Filter Header --}}
            <div class="flex items-center justify-between
                        pb-3 border-b border-slate-100">

                <div class="flex items-center gap-2">

                    <svg class="w-4 h-4 text-orange-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 00-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                    </svg>

                    <span class="font-bold text-slate-800 text-sm">
                        Filter
                    </span>

                </div>

                <a href="{{ route('admin.guruKelas.daftarKelas') }}"
                   class="text-xs text-orange-600
                          hover:underline font-semibold">
                    Reset
                </a>

            </div>


            {{-- Pilih Guru --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Pilih Guru
                </label>

                <select name="guru_id"
                        class="w-full text-xs px-3 py-2.5
                               bg-slate-50 border border-slate-200
                               rounded-xl focus:outline-none
                               focus:ring-1 focus:ring-orange-500
                               text-slate-600">

                    <option value="">
                        Semua Guru
                    </option>

                    @foreach ($guruOptions as $g)

                        @if ($g->status === 'aktif')

                            <option value="{{ $g->id }}"
                                    @selected($guruId == $g->id)>
                                {{ $g->name }}
                            </option>

                        @endif

                    @endforeach

                </select>

            </div>


            {{-- Search --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Cari Guru / Kelas
                </label>

                <div class="relative">

                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Ketik nama atau kelas..."
                           class="w-full text-xs pl-8 pr-3 py-2.5
                                  bg-slate-50
                                  border border-slate-200
                                  rounded-xl
                                  focus:outline-none
                                  focus:ring-1
                                  focus:ring-orange-500">

                    <svg class="w-4 h-4 text-slate-400
                                absolute left-2.5 top-3"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0a7 7 0 0114 0z"/>

                    </svg>

                </div>

            </div>


            {{-- Filter Button --}}
            <button type="submit"
                    class="w-full mt-2
                           bg-orange-500 hover:bg-orange-600
                           text-white text-xs font-semibold
                           py-2.5 rounded-xl
                           shadow-sm transition-all
                           flex items-center justify-center gap-1.5">

                <svg class="w-3.5 h-3.5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 00-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                </svg>

                <span>
                    Terapkan Filter
                </span>

            </button>

        </form>


        {{-- ===================================================== --}}
        {{-- TABLE --}}
        {{-- ===================================================== --}}

        <div class="lg:col-span-9
                    bg-white rounded-2xl
                    border border-slate-100
                    shadow-sm overflow-hidden
                    flex flex-col justify-between">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-xs">

                    {{-- TABLE HEADER --}}
                    <thead>
                        <tr class="bg-amber-50/40
                                   border-b border-slate-100
                                   text-slate-500
                                   font-semibold">

                            <th class="py-3 px-4 pl-5">
                                No
                            </th>

                            <th class="py-3 px-4">
                                Guru
                            </th>

                            <th class="py-3 px-4">
                                Mata Pelajaran
                            </th>

                            <th class="py-3 px-4">
                                Kelas
                            </th>

                            <th class="py-3 px-4 text-center">
                                Jumlah Kelas
                            </th>

                            <th class="py-3 px-4 text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @php
                            $mapelColors = [
                                'sky',
                                'purple',
                                'emerald',
                                'amber',
                                'orange',
                                'teal',
                                'indigo',
                                'rose',
                            ];
                        @endphp


                        @forelse ($guru as $g)

                            @php
                                $initials = collect(
                                    explode(' ', trim($g->name))
                                )
                                ->filter()
                                ->map(
                                    fn ($word) => strtoupper(
                                        substr($word, 0, 1)
                                    )
                                )
                                ->take(2)
                                ->implode('');

                                $daftarMapel = $g->mataPelajaran ?? collect();
                                $daftarKelas = $g->kelas ?? collect();
                            @endphp


                            <tr class="hover:bg-slate-50/50 transition-colors">


                                {{-- NO --}}
                                <td class="py-3.5 px-4 pl-5
                                           text-slate-500 font-medium">

                                    {{ $guru->firstItem() + $loop->index }}

                                </td>


                                {{-- GURU --}}
                                <td class="py-3.5 px-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-full
                                                    bg-orange-100 shrink-0
                                                    flex items-center justify-center
                                                    font-bold text-orange-600
                                                    text-xs">

                                            {{ $initials ?: '-' }}

                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-800">
                                                {{ $g->name }}
                                            </p>

                                            <p class="text-[11px] text-slate-400">
                                                NIP. {{ $g->nip ?? '-' }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- MATA PELAJARAN --}}
                                <td class="py-3.5 px-4">

                                    @if ($daftarMapel->isEmpty())

                                        <span class="text-slate-400 text-[11px]">
                                            -
                                        </span>

                                    @else

                                        <div class="flex items-center
                                                    flex-wrap gap-1.5">

                                            @foreach ($daftarMapel->take(2) as $idx => $mapel)

                                                @php
                                                    $color = $mapelColors[
                                                        $idx % count($mapelColors)
                                                    ];
                                                @endphp

                                                <span class="bg-{{ $color }}-50
                                                             text-{{ $color }}-600
                                                             border border-{{ $color }}-100
                                                             px-2.5 py-0.5
                                                             rounded-md
                                                             text-[11px]
                                                             font-medium">

                                                    {{ $mapel->name }}

                                                </span>

                                            @endforeach


                                            @if ($daftarMapel->count() > 2)

                                                <span class="bg-slate-100
                                                             text-slate-500
                                                             px-1.5 py-0.5
                                                             rounded
                                                             text-[10px]
                                                             font-semibold">

                                                    +{{ $daftarMapel->count() - 2 }}

                                                </span>

                                            @endif

                                        </div>

                                    @endif

                                </td>


                                {{-- KELAS --}}
                                <td class="py-3.5 px-4">

                                    @if ($daftarKelas->isEmpty())

                                        <span class="text-slate-400 text-[11px]">
                                            Belum ditugaskan
                                        </span>

                                    @else

                                        <div class="flex items-center
                                                    flex-wrap gap-1.5">

                                            @foreach ($daftarKelas->take(3) as $k)

                                                <span class="bg-slate-100
                                                             text-slate-600
                                                             border border-slate-200
                                                             px-2.5 py-0.5
                                                             rounded-md
                                                             text-[11px]
                                                             font-medium">

                                                    {{ $k->kelas }}

                                                </span>

                                            @endforeach


                                            @if ($daftarKelas->count() > 3)

                                                <span class="bg-slate-100
                                                             text-slate-500
                                                             px-1.5 py-0.5
                                                             rounded
                                                             text-[10px]
                                                             font-semibold">

                                                    +{{ $daftarKelas->count() - 3 }}

                                                </span>

                                            @endif

                                        </div>

                                    @endif

                                </td>


                                {{-- JUMLAH KELAS --}}
                                <td class="py-3.5 px-4
                                           text-center
                                           font-bold text-slate-800">

                                    {{ $daftarKelas->count() }}

                                </td>


                                {{-- AKSI --}}
                                <td class="py-3.5 px-4 text-center">

                                    <div class="flex items-center
                                                justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.guruKelas.editPenugasan', $g->id) }}"
                                           class="w-7 h-7 rounded-lg
                                                  bg-amber-50 text-amber-600
                                                  hover:bg-amber-100
                                                  flex items-center justify-center
                                                  border border-amber-200
                                                  transition-colors"
                                           title="Edit Guru">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>

                                            </svg>

                                        </a>


                                        {{-- DELETE --}}
                                        @if ($daftarKelas->isNotEmpty())

                                            <form action="{{ route('admin.guruKelas.destroy', $daftarKelas->first()->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus penugasan kelas pertama guru {{ $g->name }}?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="w-7 h-7 rounded-lg
                                                               bg-rose-50 text-rose-600
                                                               hover:bg-rose-100
                                                               flex items-center justify-center
                                                               border border-rose-200
                                                               transition-colors"
                                                        title="Hapus Penugasan Kelas">

                                                    <svg class="w-3.5 h-3.5"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v-6m1-3V4a1 1 0 01-1 1v3M4 7h16"/>

                                                    </svg>

                                                </button>

                                            </form>

                                        @else

                                            <span class="w-7 h-7
                                                         flex items-center
                                                         justify-center
                                                         text-slate-300"
                                                  title="Tidak ada penugasan">

                                                <svg class="w-3.5 h-3.5"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v-6m1-3V4a1 1 0 01-1 1v3M4 7h16"/>

                                                </svg>

                                            </span>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="py-10 px-4 text-center text-slate-400">

                                    @if ($search || $guruId)

                                        Tidak ada guru aktif yang cocok dengan filter.

                                    @else

                                        Belum ada guru aktif yang memiliki penugasan.

                                    @endif

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================================================= --}}
            {{-- PAGINATION --}}
            {{-- ================================================= --}}

            <div class="p-4 border-t border-slate-100
                        flex flex-col sm:flex-row
                        items-center justify-between
                        text-xs text-slate-500 gap-3">

                <div>

                    @if ($guru->total() > 0)

                        Menampilkan
                        {{ $guru->firstItem() }}
                        -
                        {{ $guru->lastItem() }}
                        dari
                        {{ $guru->total() }}
                        data

                    @else

                        Menampilkan 0 dari 0 data

                    @endif

                </div>


                <div>
                    {{ $guru->onEachSide(1)->links() }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection