@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- BREADCRUMB & PAGE HEADER -->
        <div class="space-y-1.5">
            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1.5">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a></li>
                    <li><span class="text-slate-300">/</span></li>
                    <li><span class="text-slate-600">Guru</span></li>
                    <li><span class="text-slate-300">/</span></li>
                    <li class="font-medium text-slate-800">Verifikasi Guru</li>
                </ol>
            </nav>
            <div>
                <h2 class="text-2xl font-extrabold text-slate-800">Verifikasi Guru</h2>
                <p class="text-xs text-slate-500 mt-0.5">Periksa dan verifikasi data guru yang baru mendaftar ke dalam sistem.</p>
            </div>
        </div>

        <!-- 4 STAT CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Menunggu Verifikasi -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Menunggu Verifikasi</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['menunggu'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Disetujui / Aktif</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['disetujui'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Ditolak</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['ditolak'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Total Pengajuan -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Total Pengajuan</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $statistik['total_guru'] }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- LAYOUT: FILTER SIDEBAR (3 COLS) & FULL TABLE (9 COLS) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR -->
            <form action="{{ route('admin.guruKelas.index') }}" method="GET"
                  class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <a href="{{ route('admin.guruKelas.index') }}" class="text-xs text-orange-600 hover:underline font-semibold">Reset</a>
                </div>

                <!-- Cari Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Cari nama, NIP, atau email..."
                               class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select name="status" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option value="">Semua Status</option>
                        <option value="menunggu" @selected($status === 'menunggu')>Menunggu</option>
                        <option value="aktif"    @selected($status === 'aktif')>Disetujui</option>
                        <option value="ditolak"  @selected($status === 'ditolak')>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </form>

            <!-- FULL TABLE CONTENT (9 cols) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Tabel Data Verifikasi Guru -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                    <th class="py-3 px-4 pl-5">No</th>
                                    <th class="py-3 px-4">Guru</th>
                                    <th class="py-3 px-4">NIP</th>
                                    <th class="py-3 px-4">Email</th>
                                    <th class="py-3 px-4">Tanggal Daftar</th>
                                    <th class="py-3 px-4">Status</th>
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

                                        $statusMap = [
                                            'aktif'    => ['label' => 'Disetujui', 'bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-200'],
                                            'menunggu' => ['label' => 'Menunggu',  'bg' => 'bg-amber-50',   'text' => 'text-amber-700',   'border' => 'border-amber-200'],
                                            'ditolak'  => ['label' => 'Ditolak',   'bg' => 'bg-rose-50',    'text' => 'text-rose-700',    'border' => 'border-rose-200'],
                                        ];
                                        $st = $statusMap[$g->status] ?? ['label' => ucfirst($g->status), 'bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'border' => 'border-slate-200'];

                                        $mapelNama = $g->mataPelajaran->pluck('name')->implode(', ') ?: '-';
                                    @endphp
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="py-3 px-4 pl-5 text-slate-500 font-medium">{{ $guru->firstItem() + $loop->index }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 rounded-full bg-slate-200 shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">
                                                    {{ $initials ?: '-' }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800">{{ $g->name }}</p>
                                                    <p class="text-[11px] text-slate-400">{{ $mapelNama }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-slate-600 font-medium">{{ $g->nip ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-600">{{ $g->email }}</td>
                                        <td class="py-3 px-4 text-slate-600">
                                            {{ $g->created_at ? $g->created_at->format('d M Y') : '-' }}<br>
                                            <span class="text-[10px] text-slate-400">{{ $g->created_at ? $g->created_at->format('H:i') . ' WIB' : '' }}</span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium border {{ $st['bg'] }} {{ $st['text'] }} {{ $st['border'] }}">
                                                {{ $st['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-center">
                                            <div class="flex items-center justify-center space-x-1.5">
                                                @if ($g->status === 'menunggu')
                                                    <a href="{{ route('admin.guru.confirm', $g->id) }}"
                                                       title="Konfirmasi"
                                                       onclick="return confirm('Konfirmasi akun guru {{ $g->name }}?')"
                                                       class="px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 font-semibold rounded-lg text-[11px] border border-emerald-200 inline-flex items-center space-x-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                        <span>Setujui</span>
                                                    </a>
                                                    <a href="{{ route('admin.guru.reject', $g->id) }}"
                                                       title="Tolak"
                                                       onclick="return confirm('Tolak akun guru {{ $g->name }}?')"
                                                       class="px-2.5 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold rounded-lg text-[11px] border border-rose-200 inline-flex items-center space-x-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                        <span>Tolak</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.guru.edit', $g->id) }}"
                                                       title="Edit"
                                                       class="px-3 py-1 bg-orange-50 hover:bg-orange-100 text-orange-600 font-semibold rounded-lg text-[11px] border border-orange-200 inline-flex items-center space-x-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        <span>Lihat</span>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-10 px-4 text-center text-slate-400">
                                            @if ($search || $status)
                                                Tidak ada guru yang cocok dengan filter.
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
