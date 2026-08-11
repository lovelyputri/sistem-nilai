@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BREADCRUMB & PAGE HEADER -->
        <div class="space-y-1.5">
            <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1.5">
                    <li><a href="#" class="hover:text-orange-600">Dashboard</a></li>
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
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">3</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">Disetujui</p>
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">7</h3>
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
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">1</h3>
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
                    <h3 class="text-2xl font-bold text-slate-800 mt-1">11</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Guru</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- LAYOUT: FILTER SIDEBAR (3 COLS) & FULL TABLE (9 COLS) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR (Di sebelah kiri) -->
            <div class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <button class="text-xs text-orange-600 hover:underline font-semibold">Reset</button>
                </div>

                <!-- Cari Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru</label>
                    <div class="relative">
                        <input type="text" placeholder="Cari nama, NIP, atau email..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Status</option>
                        <option>Menunggu</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                    </select>
                </div>

                <!-- Tanggal Pengajuan -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Tanggal Pengajuan</label>
                    <input type="date" class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-600 focus:outline-none">
                </div>

                <button class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>

            <!-- FULL TABLE CONTENT (9 cols) -->
            <div class="lg:col-span-9 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Search Bar di atas tabel -->
                    <div class="p-4 border-b border-slate-100">
                        <div class="relative w-full">
                            <input type="text" placeholder="Cari nama guru, NIP, atau email..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                            <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

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
                                <!-- Row 1 -->
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4 pl-5 text-slate-500 font-medium">1</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">AS</div>
                                            <div>
                                                <p class="font-bold text-slate-800">Ahmad Santoso</p>
                                                <p class="text-[11px] text-slate-400">Matematika</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 font-medium">198505152010011002</td>
                                    <td class="py-3 px-4 text-slate-600">ahmad.santoso@gmail.com</td>
                                    <td class="py-3 px-4 text-slate-600">25 Jul 2026<br><span class="text-[10px] text-slate-400">10:23 WIB</span></td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button class="px-3 py-1 bg-orange-50 hover:bg-orange-100 text-orange-600 font-semibold rounded-lg text-[11px] border border-orange-200 inline-flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>Periksa</span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4 pl-5 text-slate-500 font-medium">2</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">SN</div>
                                            <div>
                                                <p class="font-bold text-slate-800">Siti Nurhaliza</p>
                                                <p class="text-[11px] text-slate-400">Bahasa Indonesia</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 font-medium">199002102015032001</td>
                                    <td class="py-3 px-4 text-slate-600">siti.nurhaliza@gmail.com</td>
                                    <td class="py-3 px-4 text-slate-600">24 Jul 2026<br><span class="text-[10px] text-slate-400">15:45 WIB</span></td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button class="px-3 py-1 bg-orange-50 hover:bg-orange-100 text-orange-600 font-semibold rounded-lg text-[11px] border border-orange-200 inline-flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>Periksa</span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4 pl-5 text-slate-500 font-medium">3</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">DP</div>
                                            <div>
                                                <p class="font-bold text-slate-800">Dimas Pratama</p>
                                                <p class="text-[11px] text-slate-400">IPA</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 font-medium">199103202016041005</td>
                                    <td class="py-3 px-4 text-slate-600">dimas.pratama@gmail.com</td>
                                    <td class="py-3 px-4 text-slate-600">24 Jul 2026<br><span class="text-[10px] text-slate-400">09:12 WIB</span></td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-amber-50 text-amber-700 border border-amber-200">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button class="px-3 py-1 bg-orange-50 hover:bg-orange-100 text-orange-600 font-semibold rounded-lg text-[11px] border border-orange-200 inline-flex items-center space-x-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>Periksa</span>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4 pl-5 text-slate-500 font-medium">4</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">NA</div>
                                            <div>
                                                <p class="font-bold text-slate-800">Nabila Azzahra</p>
                                                <p class="text-[11px] text-slate-400">Bahasa Inggris</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 font-medium">199304152017052003</td>
                                    <td class="py-3 px-4 text-slate-600">nabila.azzahra@gmail.com</td>
                                    <td class="py-3 px-4 text-slate-600">23 Jul 2026<br><span class="text-[10px] text-slate-400">16:30 WIB</span></td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600 border border-emerald-200">
                                            Disetujui
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center text-slate-400">-</td>
                                </tr>

                                <!-- Row 5 -->
                                <tr class="hover:bg-slate-50/50">
                                    <td class="py-3 px-4 pl-5 text-slate-500 font-medium">5</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">RM</div>
                                            <div>
                                                <p class="font-bold text-slate-800">Rudi Maulana</p>
                                                <p class="text-[11px] text-slate-400">Informatika</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 font-medium">198912242014031004</td>
                                    <td class="py-3 px-4 text-slate-600">rudi.maulana@gmail.com</td>
                                    <td class="py-3 px-4 text-slate-600">23 Jul 2026<br><span class="text-[10px] text-slate-400">11:05 WIB</span></td>
                                    <td class="py-3 px-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 text-rose-600 border border-rose-200">
                                            Ditolak
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center text-slate-400">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        Menampilkan 1 - 5 dari 11 data
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 disabled:opacity-40">&lt;</button>
                            <button class="w-7 h-7 rounded-lg bg-orange-500 text-white font-semibold flex items-center justify-center shadow-sm">1</button>
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50">2</button>
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50">3</button>
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
