@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BREADCRUMB & HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1.5">
                <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="#" class="hover:text-orange-600">Dashboard</a></li>
                        <li><span class="text-slate-300">/</span></li>
                        <li class="font-medium text-slate-800">Nilai Siswa</li>
                    </ol>
                </nav>
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-800">Data Nilai Akademik Siswa</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau dan tinjau rekapitulasi nilai dan rata-rata dari seluruh mata pelajaran yang diikuti siswa.</p>
                </div>
            </div>
        </div>

        <!-- STAT CARDS NILAI -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Total Data Siswa</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">256</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Siswa Terdaftar</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Rata-rata Keseluruhan</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">78.45</h3>
                    <p class="text-[11px] text-emerald-500 font-semibold mt-0.5">Standar Baik</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Nilai Rata-rata Tertinggi</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">98.50</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Predikat A+</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z"/></svg>
                </div>
            </div>
        </div>

        <!-- LAYOUT: FILTER DI KIRI (3 cols) & TABEL NILAI DI KANAN (9 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR DI KIRI -->
            <div class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter Data Nilai</span>
                    </div>
                    <button class="text-xs text-orange-600 hover:underline font-semibold">Reset</button>
                </div>

                <!-- Cari Siswa -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Siswa</label>
                    <div class="relative">
                        <input type="text" placeholder="Nama siswa..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Pilih Kelas -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Kelas</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Kelas</option>
                        <option>X-1</option>
                        <option>X-2</option>
                        <option>XI-1</option>
                        <option>XI-2</option>
                        <option>XII-1</option>
                    </select>
                </div>

                <button class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>

            <!-- TABLE CONTENT NILAI DI KANAN (9 cols - Desain Kolom Mapel Diikuti Baru yang Lebih Interaktif) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-amber-50/40 border-b border-slate-100 text-slate-500 font-semibold">
                                <th class="py-3 px-4 pl-5">No</th>
                                <th class="py-3 px-4">Nama Siswa</th>
                                <th class="py-3 px-4">Kelas</th>
                                <th class="py-3 px-4">Jumlah Mapel Diikuti</th>
                                <th class="py-3 px-4 text-center">Rata-rata Keseluruhan</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-4 px-4 pl-5 text-slate-500 font-medium">1</td>
                                <td class="py-4 px-4 font-bold text-slate-800">Ahmad Fauzan</td>
                                <td class="py-4 px-4 font-medium text-slate-600">X-1</td>
                                <td class="py-4 px-4">
                                    <div class="space-y-1.5 max-w-[220px]">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                3 dari 3 Mapel Selesai
                                            </span>
                                            <span class="text-[10px] font-semibold text-slate-500">100%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                            <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center font-extrabold text-orange-600 text-sm">87.5</td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <button title="Lihat Detail Nilai Mapel" class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-4 px-4 pl-5 text-slate-500 font-medium">2</td>
                                <td class="py-4 px-4 font-bold text-slate-800">Siti Nurhaliza</td>
                                <td class="py-4 px-4 font-medium text-slate-600">X-2</td>
                                <td class="py-4 px-4">
                                    <div class="space-y-1.5 max-w-[220px]">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                3 dari 3 Mapel Selesai
                                            </span>
                                            <span class="text-[10px] font-semibold text-slate-500">100%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                            <div class="bg-emerald-500 h-full rounded-full transition-all duration-500" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center font-extrabold text-orange-600 text-sm">90.3</td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <button title="Lihat Detail Nilai Mapel" class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-4 px-4 pl-5 text-slate-500 font-medium">3</td>
                                <td class="py-4 px-4 font-bold text-slate-800">Dimas Pratama</td>
                                <td class="py-4 px-4 font-medium text-slate-600">XI-1</td>
                                <td class="py-4 px-4">
                                    <div class="space-y-1.5 max-w-[220px]">
                                        <div class="flex items-center justify-between">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                2 dari 3 Mapel Selesai
                                            </span>
                                            <span class="text-[10px] font-semibold text-slate-500">67%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                            <div class="bg-amber-500 h-full rounded-full transition-all duration-500" style="width: 66.6%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center font-extrabold text-orange-600 text-sm">77.6</td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <button title="Lihat Detail Nilai Mapel" class="w-7 h-7 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 flex items-center justify-center border border-orange-200 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        Menampilkan 1 - 3 dari 256 data siswa
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 disabled:opacity-40">&lt;</button>
                            <button class="w-7 h-7 rounded-lg bg-orange-500 text-white font-semibold flex items-center justify-center shadow-sm">1</button>
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50">2</button>
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50">&gt;</button>
                        </div>
                        <div>
                            <select class="text-xs bg-slate-50 border border-slate-200 rounded-xl px-2.5 py-1.5 text-slate-600 focus:outline-none">
                                <option>10 / halaman</option>
                                <option>25 / halaman</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
