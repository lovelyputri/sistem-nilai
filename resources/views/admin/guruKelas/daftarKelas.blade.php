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

        <!-- BREADCRUMB, HEADER & TOMBOL TAMBAH PENUGASAN -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1.5">
                <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-orange-600">Dashboard</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li><span class="text-slate-600">Guru</span></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="font-medium text-slate-800">Kelola Guru Kelas</li>
                    </ol>
                </nav>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Kelola Guru Kelas</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola penugasan guru ke kelas. Satu guru dapat mengajar lebih dari satu mata pelajaran dan beberapa kelas.</p>
                </div>
            </div>

            <!-- Modal Tambah Penugasan -->
            <div x-data="{ open: false }">
                <button @click="open = true"
                        class="inline-flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Penugasan</span>
                </button>

                <!-- Modal Overlay -->
                <div x-show="open" x-transition
                     class="fixed inset-0 bg-black/40 z-50 flex items-center justify-center p-4"
                     @click.self="open = false">
                    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 space-y-4" @click.stop>
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-800 text-sm">Tambah Penugasan Guru</h3>
                            <button @click="open = false" class="text-slate-400 hover:text-slate-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <form action="{{ route('admin.guruKelas.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700">Pilih Guru</label>
                                <select name="id_user" required
                                        class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($guruOptions as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-slate-700">Pilih Kelas</label>
                                <select name="kelas" required
                                        class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelasOptions as $kelas)
                                        <option value="{{ $kelas }}">{{ $kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-2 flex justify-end space-x-2">
                                <button type="button" @click="open = false"
                                        class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 text-xs font-semibold text-white bg-orange-500 hover:bg-orange-600 rounded-xl shadow-sm transition-all">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- LAYOUT: FILTER DI KIRI (3 cols) & TABEL DI KANAN (9 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR DI KIRI -->
            <form action="{{ route('admin.guruKelas.daftarKelas') }}" method="GET"
                  class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <a href="{{ route('admin.guruKelas.daftarKelas') }}" class="text-xs text-orange-600 hover:underline font-semibold">Reset</a>
                </div>

                <!-- Pilih Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Pilih Guru</label>
                    <select name="guru_id" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option value="">Semua Guru</option>
                        @foreach ($guruOptions as $g)
                            <option value="{{ $g->id }}" @selected($guruId == $g->id)>{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Cari Guru / Kelas / Mapel -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru / Kelas</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search }}"
                               placeholder="Ketik nama atau kelas..."
                               class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select name="status" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option value="">Semua Status</option>
                        <option value="aktif"    @selected($statusFilter === 'aktif')>Aktif</option>
                        <option value="menunggu" @selected($statusFilter === 'menunggu')>Menunggu</option>
                        <option value="ditolak"  @selected($statusFilter === 'ditolak')>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </form>

            <!-- TABLE CONTENT DI KANAN (9 cols) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                <th class="py-3 px-4 pl-5">No</th>
                                <th class="py-3 px-4">Guru</th>
                                <th class="py-3 px-4">Mata Pelajaran</th>
                                <th class="py-3 px-4">Kelas</th>
                                <th class="py-3 px-4 text-center">Jml Kelas</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @php
                                $mapelColors = ['sky', 'purple', 'emerald', 'amber', 'orange', 'teal', 'indigo', 'rose'];
                            @endphp
                            @forelse ($guru as $g)
                                @php
                                    $initials = collect(explode(' ', trim($g->name)))
                                        ->filter()
                                        ->map(fn ($w) => strtoupper(substr($w, 0, 1)))
                                        ->take(2)
                                        ->implode('');

                                    $statusMap = [
                                        'aktif'    => ['label' => 'Aktif',    'class' => 'bg-emerald-50 text-emerald-600'],
                                        'menunggu' => ['label' => 'Menunggu', 'class' => 'bg-amber-50 text-amber-600'],
                                        'ditolak'  => ['label' => 'Ditolak',  'class' => 'bg-rose-50 text-rose-600'],
                                    ];
                                    $st = $statusMap[$g->status] ?? ['label' => ucfirst($g->status), 'class' => 'bg-slate-100 text-slate-600'];

                                    $daftarMapel = $g->mataPelajaran ?? collect();
                                    $daftarKelas = $g->kelas ?? collect();
                                @endphp
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">{{ $guru->firstItem() + $loop->index }}</td>
                                    <td class="py-3.5 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-9 h-9 rounded-full bg-slate-200 shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">
                                                {{ $initials ?: '-' }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-800">{{ $g->name }}</p>
                                                <p class="text-[11px] text-slate-400">NIP. {{ $g->nip ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if ($daftarMapel->isEmpty())
                                            <span class="text-slate-400 text-[11px]">-</span>
                                        @else
                                            <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                                @foreach ($daftarMapel->take(2) as $idx => $mapel)
                                                    @php $c = $mapelColors[$idx % count($mapelColors)]; @endphp
                                                    <span class="bg-{{ $c }}-50 text-{{ $c }}-600 border border-{{ $c }}-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">
                                                        {{ $mapel->name }}
                                                    </span>
                                                @endforeach
                                                @if ($daftarMapel->count() > 2)
                                                    <span class="bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded text-[10px] font-semibold">
                                                        +{{ $daftarMapel->count() - 2 }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4">
                                        @if ($daftarKelas->isEmpty())
                                            <span class="text-slate-400 text-[11px]">Belum ditugaskan</span>
                                        @else
                                            <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                                @foreach ($daftarKelas->take(3) as $k)
                                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">
                                                        {{ $k->kelas }}
                                                    </span>
                                                @endforeach
                                                @if ($daftarKelas->count() > 3)
                                                    <span class="bg-slate-100 text-slate-500 px-1.5 py-0.5 rounded text-[10px] font-semibold">
                                                        +{{ $daftarKelas->count() - 3 }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-center font-bold text-slate-800">{{ $daftarKelas->count() }}</td>
                                    <td class="py-3.5 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium {{ $st['class'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                {{ $g->status === 'aktif' ? 'bg-emerald-500' : ($g->status === 'menunggu' ? 'bg-amber-500' : 'bg-rose-500') }}">
                                            </span>
                                            {{ $st['label'] }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            {{-- Hapus penugasan kelas (hapus semua relasi kelas guru ini) --}}
                                            @foreach ($daftarKelas as $k)
                                                <form action="{{ route('admin.guruKelas.destroy', $k->id) }}" method="POST"
                                                      onsubmit="return confirm('Hapus penugasan {{ $g->name }} dari kelas {{ $k->kelas }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- Hidden submit, only shown via button below --}}
                                                </form>
                                            @endforeach

                                            {{-- Tombol Edit → ke halaman edit guru --}}
                                            <a href="{{ route('admin.guru.edit', $g->id) }}"
                                               class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"
                                               title="Edit Guru">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>

                                            {{-- Hapus semua penugasan kelas guru ini --}}
                                            @if ($daftarKelas->isNotEmpty())
                                                <form action="{{ route('admin.guruKelas.destroy', $daftarKelas->first()->id) }}" method="POST"
                                                      onsubmit="return confirm('Hapus penugasan kelas pertama guru {{ $g->name }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"
                                                            title="Hapus Penugasan Kelas">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="w-7 h-7 flex items-center justify-center text-slate-300" title="Tidak ada penugasan">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 px-4 text-center text-slate-400">
                                        @if ($search || $guruId || $statusFilter)
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
