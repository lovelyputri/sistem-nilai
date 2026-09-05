@extends('layout')

@section('content')

<div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

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

                    <li class="font-medium text-slate-800">
                        Siswa
                    </li>

                </ol>
            </nav>

            <div>
                <h2 class="text-2xl font-extrabold text-slate-800">
                    Kelola Siswa
                </h2>

                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola data seluruh siswa terdaftar, NIS dan kelas.
                </p>
            </div>

        </div>

        {{-- Tambah --}}
        <a href="{{ route('admin.siswa.create') }}"
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
                      d="M12 4v16M4 12h16"/>

            </svg>

            <span>Tambah Siswa</span>

        </a>

    </div>


    {{-- FLASH SUCCESS --}}
    @if(session('sukses'))

        <div class="flex items-center gap-3
                    bg-emerald-50 border border-emerald-200
                    text-emerald-700
                    px-4 py-3 rounded-xl text-xs">

            <svg class="w-5 h-5 shrink-0"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M5 13l4 4L19 7"/>

            </svg>

            <span>{{ session('sukses') }}</span>

        </div>

    @endif


    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- Total --}}
        <div class="bg-white p-5 rounded-2xl
                    border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-400">
                    Total Siswa
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $totalSiswa }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Siswa Terdaftar
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl
                        bg-emerald-50
                        flex items-center justify-center
                        text-emerald-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 14l9-5-9-5-9 5 9 5z"/>

                </svg>

            </div>

        </div>


        {{-- Aktif --}}
        <div class="bg-white p-5 rounded-2xl
                    border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-400">
                    Siswa Aktif
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $totalSiswaAktif }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    dari {{ $totalSiswa }} Terdaftar
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl
                        bg-blue-50
                        flex items-center justify-center
                        text-blue-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>

                </svg>

            </div>

        </div>


        {{-- Kelas --}}
        <div class="bg-white p-5 rounded-2xl
                    border border-slate-100 shadow-sm
                    flex items-center justify-between">

            <div>
                <p class="text-xs font-medium text-slate-400">
                    Total Kelas Aktif
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $totalKelas }}
                </h3>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Rombongan Belajar
                </p>
            </div>

            <div class="w-11 h-11 rounded-xl
                        bg-orange-50
                        flex items-center justify-center
                        text-orange-500">

                <svg class="w-6 h-6"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>

                </svg>

            </div>

        </div>

    </div>


    {{-- FILTER + TABLE --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- FILTER --}}
        <form method="GET"
              action="{{ route('admin.siswa.index') }}"
              class="lg:col-span-3
                     bg-white p-5 rounded-2xl
                     border border-slate-100
                     shadow-sm space-y-4">

            <div class="flex items-center justify-between
                        pb-3 border-b border-slate-100">

                <div class="flex items-center space-x-2">

                    <svg class="w-4 h-4 text-orange-500"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                    </svg>

                    <span class="font-bold text-slate-800 text-sm">
                        Filter Siswa
                    </span>

                </div>

                <a href="{{ route('admin.siswa.index') }}"
                   class="text-xs text-orange-600
                          hover:underline font-semibold">

                    Reset

                </a>

            </div>


            {{-- Search --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Cari Siswa
                </label>

                <div class="relative">

                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Nama atau NIS..."
                           class="w-full text-xs
                                  pl-8 pr-3 py-2.5
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
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0
                                 7 7 0 0114 0z"/>

                    </svg>

                </div>

            </div>


            {{-- Kelas --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Kelas
                </label>

                <select name="kelas"
                        class="w-full text-xs px-3 py-2.5
                               bg-slate-50
                               border border-slate-200
                               rounded-xl
                               focus:outline-none
                               focus:ring-1
                               focus:ring-orange-500
                               text-slate-600">

                    <option value="">
                        Semua Kelas
                    </option>

                    @foreach($daftarKelas as $kelas)

                        <option value="{{ $kelas }}"
                            {{ $kelasTerpilih == $kelas ? 'selected' : '' }}>

                            {{ $kelas }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Status --}}
            <div class="space-y-1.5">

                <label class="text-xs font-bold text-slate-700">
                    Status
                </label>

                <select name="status"
                        class="w-full text-xs px-3 py-2.5
                               bg-slate-50
                               border border-slate-200
                               rounded-xl
                               focus:outline-none
                               focus:ring-1
                               focus:ring-orange-500
                               text-slate-600">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="aktif"
                        {{ $statusTerpilih == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="lulus"
                        {{ $statusTerpilih == 'lulus' ? 'selected' : '' }}>
                        Lulus / Alumni
                    </option>

                </select>

            </div>


            <input type="hidden"
                   name="per_page"
                   value="{{ request('per_page', 10) }}">


            <button type="submit"
                    class="w-full mt-2
                           bg-orange-500 hover:bg-orange-600
                           text-white text-xs font-semibold
                           py-2.5 rounded-xl
                           shadow-sm transition-all
                           flex items-center justify-center
                           space-x-1.5">

                <svg class="w-3.5 h-3.5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>

                </svg>

                <span>Terapkan Filter</span>

            </button>

        </form>


        {{-- TABLE --}}
        <div class="lg:col-span-9
                    bg-white rounded-2xl
                    border border-slate-100
                    shadow-sm overflow-hidden
                    flex flex-col justify-between">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-xs">

                    <thead>

                        <tr class="bg-amber-50/40
                                   border-b border-slate-100
                                   text-slate-500 font-semibold">

                            <th class="py-3 px-4 pl-5">
                                No
                            </th>

                            <th class="py-3 px-4">
                                Nama Siswa
                            </th>

                            <th class="py-3 px-4">
                                NIS
                            </th>

                            <th class="py-3 px-4">
                                Kelas
                            </th>

                            <th class="py-3 px-4">
                                Status
                            </th>

                            <th class="py-3 px-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @forelse($siswa as $index => $s)

                            @php
                                $inisial = collect(explode(' ', $s->name))
                                    ->map(fn($kata) => strtoupper(substr($kata, 0, 1)))
                                    ->take(2)
                                    ->implode('');
                            @endphp

                            <tr class="hover:bg-slate-50/50">

                                {{-- NO --}}
                                <td class="py-3.5 px-4 pl-5
                                           text-slate-500 font-medium">

                                    {{ $siswa->firstItem() + $index }}

                                </td>


                                {{-- NAMA --}}
                                <td class="py-3.5 px-4">

                                    <div class="flex items-center space-x-3">

                                        <div class="w-8 h-8 rounded-full
                                                    bg-emerald-100
                                                    text-emerald-700
                                                    overflow-hidden
                                                    shrink-0
                                                    flex items-center
                                                    justify-center
                                                    font-bold text-xs">

                                            {{ $inisial }}

                                        </div>

                                        <p class="font-bold text-slate-800">
                                            {{ $s->name }}
                                        </p>

                                    </div>

                                </td>


                                {{-- NIS --}}
                                <td class="py-3.5 px-4
                                           text-slate-600 font-medium">

                                    {{ $s->nis }}

                                </td>


                                {{-- KELAS --}}
                                <td class="py-3.5 px-4
                                           font-semibold text-slate-700">

                                    {{ $s->kelas }}

                                </td>


                                {{-- STATUS --}}
                                <td class="py-3.5 px-4">

                                    @if($s->status === 'aktif')

                                        <span class="inline-flex items-center
                                                     px-2 py-0.5
                                                     rounded-full
                                                     text-[11px] font-medium
                                                     bg-emerald-50
                                                     text-emerald-600">

                                            <span class="w-1.5 h-1.5
                                                         rounded-full
                                                         bg-emerald-500
                                                         mr-1.5">
                                            </span>

                                            Aktif

                                        </span>

                                    @else

                                        <span class="inline-flex items-center
                                                     px-2 py-0.5
                                                     rounded-full
                                                     text-[11px] font-medium
                                                     bg-slate-100
                                                     text-slate-500">

                                            <span class="w-1.5 h-1.5
                                                         rounded-full
                                                         bg-slate-400
                                                         mr-1.5">
                                            </span>

                                            Lulus

                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="py-3.5 px-4 text-center">

                                    <div class="flex items-center
                                                justify-center space-x-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.siswa.show', ['siswa' => $s->id]) }}"
                                           title="Lihat Detail"
                                           class="w-7 h-7 rounded-lg
                                                  bg-orange-50
                                                  text-orange-600
                                                  hover:bg-orange-100
                                                  flex items-center justify-center
                                                  border border-orange-200
                                                  transition-colors">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0
                                                         3 3 0 016 0z"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M2.458 12C3.732 7.943
                                                         7.523 5 12 5
                                                         c4.478 0
                                                         8.268 2.943
                                                         9.542 7
                                                         -1.274 4.057
                                                         -5.064 7
                                                         -9.542 7
                                                         -4.477 0
                                                         -8.268-2.943
                                                         -9.542-7z"/>

                                            </svg>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.siswa.edit', ['siswa' => $s->id]) }}"
                                           title="Edit"
                                           class="w-7 h-7 rounded-lg
                                                  bg-amber-50
                                                  text-amber-600
                                                  hover:bg-amber-100
                                                  flex items-center justify-center
                                                  border border-amber-200
                                                  transition-colors">

                                            <svg class="w-3.5 h-3.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11
                                                         a2 2 0 002 2h11
                                                         a2 2 0 002-2v-5
                                                         m-1.414-9.414
                                                         a2 2 0 112.828 2.828
                                                         L11.828 15H9v-2.828
                                                         l8.586-8.586z"/>

                                            </svg>

                                        </a>


                                        {{-- DELETE --}}
                                        <form action="{{ route('admin.siswa.destroy', ['siswa' => $s->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Hapus data siswa {{ $s->name }}?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Hapus"
                                                    class="w-7 h-7 rounded-lg
                                                           bg-rose-50
                                                           text-rose-600
                                                           hover:bg-rose-100
                                                           flex items-center justify-center
                                                           border border-rose-200
                                                           transition-colors">

                                                <svg class="w-3.5 h-3.5"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     viewBox="0 0 24 24">

                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M19 7l-.867 12.142
                                                             A2 2 0 0116.138 21
                                                             H7.862
                                                             a2 2 0 01-1.995-1.858
                                                             L5 7
                                                             m5 4v6m4-6v6
                                                             m1-10V4a1 1 0 00-1-1h-4
                                                             a1 1 0 00-1 1v3
                                                             M4 7h16"/>

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="py-10 text-center
                                           text-slate-400">

                                    Tidak ada data siswa yang ditemukan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            <div class="p-4 border-t border-slate-100
                        flex flex-col sm:flex-row
                        items-center justify-between
                        text-xs text-slate-500 gap-3">

                <div>

                    @if($siswa->total() > 0)

                        Menampilkan
                        {{ $siswa->firstItem() }}
                        -
                        {{ $siswa->lastItem() }}
                        dari
                        {{ $siswa->total() }}
                        data

                    @else

                        Tidak ada data

                    @endif

                </div>


                <div class="flex items-center space-x-3">

                    <div class="flex items-center space-x-1">

                        {{-- Previous --}}
                        <a href="{{ $siswa->previousPageUrl() ?? '#' }}"
                           class="w-7 h-7 rounded-lg
                                  border border-slate-200
                                  flex items-center justify-center
                                  hover:bg-slate-50
                                  {{ $siswa->onFirstPage()
                                      ? 'opacity-40 pointer-events-none'
                                      : '' }}">

                            &lt;

                        </a>


                        {{-- Pages --}}
                        @if($siswa->lastPage() > 1)

                            @foreach(range(1, $siswa->lastPage()) as $page)

                                <a href="{{ $siswa->url($page) }}"
                                   class="w-7 h-7 rounded-lg
                                          flex items-center justify-center
                                          font-semibold
                                          {{ $page == $siswa->currentPage()
                                              ? 'bg-orange-500 text-white shadow-sm'
                                              : 'border border-slate-200 hover:bg-slate-50 text-slate-600' }}">

                                    {{ $page }}

                                </a>

                            @endforeach

                        @endif


                        {{-- Next --}}
                        <a href="{{ $siswa->nextPageUrl() ?? '#' }}"
                           class="w-7 h-7 rounded-lg
                                  border border-slate-200
                                  flex items-center justify-center
                                  hover:bg-slate-50
                                  {{ $siswa->hasMorePages()
                                      ? ''
                                      : 'opacity-40 pointer-events-none' }}">

                            &gt;

                        </a>

                    </div>


                    {{-- PER PAGE --}}
                    <form method="GET"
                          action="{{ route('admin.siswa.index') }}">

                        <input type="hidden"
                               name="kelas"
                               value="{{ $kelasTerpilih }}">

                        <input type="hidden"
                               name="search"
                               value="{{ $search }}">

                        <input type="hidden"
                               name="status"
                               value="{{ $statusTerpilih }}">

                        <select name="per_page"
                                onchange="this.form.submit()"
                                class="text-xs bg-slate-50
                                       border border-slate-200
                                       rounded-xl px-2.5 py-1.5
                                       text-slate-600
                                       focus:outline-none">

                            <option value="10"
                                {{ request('per_page', 10) == 10 ? 'selected' : '' }}>
                                10 / halaman
                            </option>

                            <option value="25"
                                {{ request('per_page') == 25 ? 'selected' : '' }}>
                                25 / halaman
                            </option>

                            <option value="50"
                                {{ request('per_page') == 50 ? 'selected' : '' }}>
                                50 / halaman
                            </option>

                        </select>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection