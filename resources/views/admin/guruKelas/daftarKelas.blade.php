@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BREADCRUMB, HEADER & TOMBOL TAMBAH PENUGASAN -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-1.5">
                <nav class="flex text-xs text-slate-400" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1.5">
                        <li><a href="#" class="hover:text-orange-600">Dashboard</a></li>
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
            <div>
                <a href="#" class="inline-flex items-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-orange-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Penugasan</span>
                </a>
            </div>
        </div>

        <!-- LAYOUT: FILTER DI KIRI (3 cols) & TABEL DI KANAN (9 cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- FILTER SIDEBAR DI KIRI -->
            <div class="lg:col-span-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <span class="font-bold text-slate-800 text-sm">Filter</span>
                    </div>
                    <button class="text-xs text-orange-600 hover:underline font-semibold">Reset</button>
                </div>

                <!-- Pilih Guru -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Pilih Guru</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Guru</option>
                        <option>Ahmad Santoso</option>
                        <option>Siti Nurhaliza</option>
                        <option>Dimas Pratama</option>
                    </select>
                </div>

                <!-- Cari Guru / Kelas / Mapel -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Cari Guru / Kelas / Mapel</label>
                    <div class="relative">
                        <input type="text" placeholder="Ketik nama, mapel, kelas..." class="w-full text-xs pl-8 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Status</label>
                    <select class="w-full text-xs px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-1 focus:ring-orange-500 text-slate-600">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Non Aktif</option>
                    </select>
                </div>

                <button class="w-full mt-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold py-2.5 rounded-xl shadow-sm transition-all flex items-center justify-center space-x-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </div>

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
                                <th class="py-3 px-4 text-center">Jumlah Kelas</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">1</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">AS</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Ahmad Santoso</p>
                                            <p class="text-[11px] text-slate-400">NIP. 198505152010011002</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-sky-50 text-sky-600 border border-sky-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Matematika</span>
                                        <span class="bg-purple-50 text-purple-600 border border-purple-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Informatika</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">3</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">2</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">SN</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Siti Nurhaliza</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199002102015032001</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Bahasa Indonesia</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 2</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">2</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">3</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">DP</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Dimas Pratama</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199103202016041005</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-amber-50 text-amber-600 border border-amber-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">IPA</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">1</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">4</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">NA</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Nabila Azzahra</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199304152017052003</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-purple-50 text-purple-600 border border-purple-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Bahasa Inggris</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">2</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">5</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">RM</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Rizky Maulana</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199507252018061004</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-orange-50 text-orange-600 border border-orange-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">IPS</span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 1</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XII RPL 2</span>
                                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">XI RPL 1</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">3</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 6 -->
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 pl-5 text-slate-500 font-medium">6</td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-slate-200 overflow-hidden shrink-0 flex items-center justify-center font-bold text-slate-600 text-xs">DL</div>
                                        <div>
                                            <p class="font-bold text-slate-800">Dewi Lestari</p>
                                            <p class="text-[11px] text-slate-400">NIP. 199308202019072005</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="flex items-center space-x-1.5 flex-wrap gap-y-1">
                                        <span class="bg-teal-50 text-teal-600 border border-teal-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">PKn</span>
                                        <span class="bg-indigo-50 text-indigo-600 border border-indigo-100 px-2.5 py-0.5 rounded-md text-[11px] font-medium">Sosiologi</span>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2.5 py-0.5 rounded-md text-[11px] font-medium">X RPL 1</span>
                                </td>
                                <td class="py-3.5 px-4 text-center font-bold text-slate-800">1</td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Aktif
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center border border-amber-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                                        <button class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center border border-rose-200 transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- TABLE FOOTER / PAGINATION -->
                <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                    <div>
                        Menampilkan 1 - 6 dari 6 data
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 disabled:opacity-40">&lt;</button>
                            <button class="w-7 h-7 rounded-lg bg-orange-500 text-white font-semibold flex items-center justify-center shadow-sm">1</button>
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
