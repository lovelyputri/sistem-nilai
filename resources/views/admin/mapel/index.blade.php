@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BREADCRUMB, HEADER & TOMBOL TAMBAH MAPEL -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1.5">
                <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="font-medium text-slate-800">Mata Pelajaran</li>
                    </ol>
                </nav>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Kelola Mata Pelajaran</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola daftar mata pelajaran kurikulum dan penugasan bidang studi.</p>
                </div>
            </div>
            <div>
                <a href="{{ route('admin.mapel.index') }}" class="inline-flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Mata Pelajaran</span>
                </a>
            </div>
        </div>

        <!-- STAT CARDS MATA PELAJARAN -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Total Mata Pelajaran</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalMapel }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Bidang Studi</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Total Guru Pengampu</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $totalGuruPengampu }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru Terdaftar Mengampu</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- LAYOUT: FILTER DI KIRI (3 cols) & TABEL MAPEL DI KANAN (9 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR DI KIRI -->
            <form method="GET" action="{{ route('admin.mapel.index') }}" class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter Mata Pelajaran</span>
                    </div>
                    <a href="{{ route('admin.mapel.index') }}" class="text-xs text-orange-600 hover:underline font-semibold">Reset</a>
                </div>

                <!-- Cari Mata Pelajaran -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Mapel</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Nama atau kode mapel..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Pilih Kode Mapel -->
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700">Kode Mapel</label>
                        <div class="relative">
                            <select name="kode" class="w-full text-xs pl-3 pr-8 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 appearance-none text-slate-500 cursor-pointer">
                                <option value="" class="text-slate-500">Semua Kode</option>
                                @foreach($daftarKode as $kode)
                                    <option value="{{ $kode }}" class="text-slate-700" {{ $kodeTerpilih == $kode ? 'selected' : '' }}>
                                        {{ $kode }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Icon Arrow Down Custom -->
                            <svg class="w-4 h-4 text-slate-400 absolute right-2.5 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                <!-- per_page ikut dikirim biar tidak reset saat filter diterapkan -->
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">

                <button type="submit" class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </form>

            <!-- TABLE CONTENT MATA PELAJARAN DI KANAN (9 cols) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                <th class="py-3 px-4 pl-5">No</th>
                                <th class="py-3 px-4">Kode Mapel</th>
                                <th class="py-3 px-4">Nama Mata Pelajaran</th>
                                <th class="py-3 px-4">Keterangan</th>
                                <th class="py-3 px-4 text-center">Jumlah Guru</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($mataPelajarans as $index => $mapel)
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">
                                        {{ $mataPelajarans->firstItem() + $index }}
                                    </td>
                                    <td class="py-3.5 px-4 font-mono font-bold text-slate-700">{{ $mapel->kode }}</td>
                                    <td class="py-3.5 px-4 font-bold text-slate-800">{{ $mapel->name }}</td>
                                    <td class="py-3.5 px-4 text-slate-500">{{ $mapel->keterangan }}</td>
                                    <td class="py-3.5 px-4 text-center font-bold text-slate-800">
                                        {{ $mapel->gurus_count ?? 0 }} Guru
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.mapel.index', $mapel->id) }}" class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></a>
                                            {{-- <a href="{{ route('admin.mapel.edit', $mapel->id) }}" class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></a> --}}
                                            <form action="{{ route('admin.mapel.index', $mapel->id) }}" method="POST" onsubmit="return confirm('Hapus mata pelajaran {{ $mapel->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">
                                        Tidak ada data mata pelajaran yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        @if($mataPelajarans->total() > 0)
                            Menampilkan {{ $mataPelajarans->firstItem() }} - {{ $mataPelajarans->lastItem() }} dari {{ $mataPelajarans->total() }} data
                        @else
                            Tidak ada data
                        @endif
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <a href="{{ $mataPelajarans->previousPageUrl() ?? '#' }}"
                               class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 {{ $mataPelajarans->onFirstPage() ? 'opacity-40 pointer-events-none' : '' }}">&lt;</a>

                            @foreach(range(1, $mataPelajarans->lastPage()) as $page)
                                <a href="{{ $mataPelajarans->url($page) }}"
                                   class="w-7 h-7 rounded-lg flex items-center justify-center font-semibold {{ $page == $mataPelajarans->currentPage() ? 'bg-orange-500 text-white shadow-sm' : 'border border-slate-200 hover:bg-slate-50 text-slate-600' }}">
                                    {{ $page }}
                                </a>
                            @endforeach

                            <a href="{{ $mataPelajarans->nextPageUrl() ?? '#' }}"
                               class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 {{ $mataPelajarans->hasMorePages() ? '' : 'opacity-40 pointer-events-none' }}">&gt;</a>
                        </div>
                        <div>
                            <form method="GET" action="{{ route('admin.mapel.index') }}">
                                <input type="hidden" name="search" value="{{ $search }}">
                                <input type="hidden" name="kode" value="{{ $kodeTerpilih }}">
                                <select name="per_page" onchange="this.form.submit()" class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-2.5 py-1.5 text-slate-600 focus:outline-none">
                                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / halaman</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / halaman</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 / halaman</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
