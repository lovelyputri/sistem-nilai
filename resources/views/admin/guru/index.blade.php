@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        {{-- FLASH MESSAGE --}}
        @if (session('sukses'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-4 py-3 rounded-xl">
                {{ session('sukses') }}
            </div>
        @endif
        @if (session('gagal'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold px-4 py-3 rounded-xl">
                {{ session('gagal') }}
            </div>
        @endif

        <!-- BREADCRUMB & PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex text-xs text-slate-400 mb-1.5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li><span class="text-slate-600">Guru</span></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="font-medium text-slate-800">Kelola Guru</li>
                    </ol>
                </nav>
                <h2 class="text-2xl font-extrabold text-slate-800">Kelola Guru</h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data guru yang terdaftar dalam sistem.</p>
            </div>
            <div>
                <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Guru</span>
                </a>
            </div>
        </div>

        <!-- 4 STAT CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total Guru -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Total Guru</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['total_guru'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>

            <!-- Card 2: Guru Aktif -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Guru Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['guru_aktif'] }}</h3>
                    <p class="text-[11px] text-emerald-500 font-semibold mt-0.5">{{ $statistik['persentase_aktif'] }}% dari total guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Card 3: Guru Non Aktif -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Guru Non Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['guru_non_aktif'] }}</h3>
                    <p class="text-[11px] text-rose-500 font-semibold mt-0.5">{{ $statistik['persentase_non_aktif'] }}% dari total guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-purple-50 flex items-center justify-center text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                </div>
            </div>

            <!-- Card 4: Rata-rata Mata Pelajaran -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Rata-rata Mata Pelajaran</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['rata_rata_mapel'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">per guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
            </div>
        </div>

        <!-- MAIN LAYOUT: SIDEBAR FILTER (3 COLS) & TABLE CONTENT (9 COLS) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR -->
            <form action="{{ route('admin.guru.index') }}" method="GET"
                  class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <a href="{{ route('admin.guru.index') }}" class="text-xs text-orange-600 hover:underline font-semibold">Reset</a>
                </div>

                <!-- Cari Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari nama, NIP, atau email..."
                               class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <!-- <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select name="status" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option value="">Semua Status</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu</option>
                        <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
                    </select>
                </div> -->

                <!-- Mata Pelajaran -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Mata Pelajaran</label>
                    <select name="mata_pelajaran" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($mataPelajaranOptions as $mapel)
                            <option value="{{ $mapel->id }}" @selected((string) request('mata_pelajaran') === (string) $mapel->id)>
                                {{ $mapel->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </form>

            <!-- TABLE CONTENT -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Tabel Data Guru -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                    <th class="py-3 px-4">No</th>
                                    <th class="py-3 px-4">Nama Guru</th>
                                    <th class="py-3 px-4">NIP</th>
                                    <th class="py-3 px-4">Mata Pelajaran</th>
                                    <th class="py-3 px-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse ($guru as $g)
                                @php
                                    $initials = collect(explode(' ', trim($g->name)))
                                        ->filter()
                                        ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
                                        ->take(2)
                                        ->implode('');

                                    $badgeColors = ['sky', 'emerald', 'amber', 'purple', 'orange', 'teal', 'rose'];
                                    $colorIndex  = $g->id % count($badgeColors);
                                    $badgeColor  = $badgeColors[$colorIndex];

                                    $daftarMapel = $g->mataPelajaran ?? collect();
                                @endphp
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="py-3 px-4 text-slate-500 font-medium">
                                            {{ $guru->firstItem() + $loop->index }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">
                                                    {{ $initials ?: '-' }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800">{{ $g->name }}</p>
                                                    <p class="text-[11px] text-slate-400">{{ $g->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-slate-600 font-medium">{{ $g->nip ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            @if ($daftarMapel->isEmpty())
                                                <span class="text-slate-400 text-[11px]">-</span>
                                            @else
                                                <div class="flex items-center space-x-1.5">
                                                    <span class="bg-{{ $badgeColor }}-50 text-{{ $badgeColor }}-600 border border-{{ $badgeColor }}-100 px-2 py-0.5 rounded text-[11px] font-medium">
                                                        {{ $daftarMapel->first()->name }}
                                                    </span>
                                                    @if ($daftarMapel->count() > 1)
                                                        <span class="bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded text-[10px] font-semibold">
                                                            +{{ $daftarMapel->count() - 1 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center justify-center space-x-1.5">
                                                <a href="{{ route('admin.guru.edit', $g->id) }}"
                                                   title="Edit"
                                                   class="w-7 h-7 rounded-lg bg-slate-50 text-slate-600 hover:bg-amber-50 hover:text-amber-600 flex items-center justify-center border border-slate-200 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                </a>

                                                <a href="{{ route('admin.guru.show', $g->id) }}"
                                                    title="Lihat Detail"
                                                    class="w-7 h-7 rounded-lg bg-slate-50 text-slate-600 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center border border-slate-200 transition-colors">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                    </a>

                                                <form action="{{ route('admin.guru.destroy', $g->id) }}" method="POST"
                                                      onsubmit="return confirm('Hapus akun guru {{ $g->name }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus"
                                                            class="w-7 h-7 rounded-lg bg-slate-50 text-slate-600 hover:bg-rose-50 hover:text-rose-600 flex items-center justify-center border border-slate-200 transition-colors">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 px-4 text-center text-slate-400">
                                        @if (request()->hasAny(['search', 'status', 'mata_pelajaran', 'kelas']))
                                            Tidak ada data guru yang cocok dengan filter.
                                        @else
                                            Belum ada data guru.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        @if ($guru->total() > 0)
                            Menampilkan {{ $guru->firstItem() }} - {{ $guru->lastItem() }} dari {{ $guru->total() }} data
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