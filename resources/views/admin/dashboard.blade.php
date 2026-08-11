@extends('layout')
@section('content')

    <!-- UTAMA CONTENT CONTAINER -->
    <div class="w-full mx-auto px-4 lg:px-8 py-5 flex-grow space-y-5">

        <!-- BANNER SELAMAT DATANG -->
        <div class="relative bg-gradient-to-r from-orange-50 via-orange-50/40 to-amber-50/60 rounded-2xl p-6 lg:px-8 lg:py-6 border border-orange-100/80 flex flex-col md:flex-row items-center justify-between overflow-hidden shadow-sm">
            <div class="z-10 space-y-1.5 max-w-2xl">
                <h2 class="text-xl lg:text-2xl font-bold text-slate-800 flex items-center gap-2">
                    Selamat datang, Administrator! <span class="inline-block text-xl">👋</span>
                </h2>
                <p class="text-xs lg:text-sm text-slate-500 font-normal">
                    Pantau dan kelola seluruh aktivitas akademik dari satu tempat.
                </p>
            </div>

            <div class="mt-4 md:mt-0 relative flex items-center justify-end shrink-0 pr-4">
                <div class="w-64 h-24 flex items-center justify-center relative">
                    <svg class="w-16 h-20 absolute -left-2 bottom-0" viewBox="0 0 100 120" fill="none">
                        <path d="M35 85 L65 85 L60 115 L40 115 Z" fill="#F97316"/>
                        <path d="M30 85 L70 85 L70 90 L30 90 Z" fill="#EA580C"/>
                        <path d="M50 85 Q 20 60 25 35 Q 45 45 50 85 Z" fill="#10B981"/>
                        <path d="M50 85 Q 80 60 75 35 Q 55 45 50 85 Z" fill="#059669"/>
                        <path d="M50 85 Q 50 20 50 15 Q 60 40 50 85 Z" fill="#34D399"/>
                    </svg>
                    <div class="bg-white rounded-lg shadow-md border border-slate-200 p-2.5 w-44 space-y-2 ml-10">
                        <div class="flex items-center space-x-1.5 border-b border-slate-100 pb-1">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                        </div>
                        <div class="flex space-x-2 items-center">
                            <div class="w-7 h-7 rounded bg-orange-100 flex items-center justify-center">
                                <div class="w-3 h-3 border-2 border-orange-500 rounded-full"></div>
                            </div>
                            <div class="space-y-1 flex-1">
                                <div class="h-1.5 bg-slate-200 rounded w-full"></div>
                                <div class="h-1.5 bg-slate-100 rounded w-2/3"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center">
                            <div class="w-8 h-8 rounded-full border-4 border-orange-500 border-t-amber-400"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5 METRIC CARDS ATAS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Card 1: Total Guru -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                />
                            </svg>
                        </div>

                        <span class="text-xs font-semibold text-slate-500">
                            Total Guru
                        </span>
                    </div>

                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">
                            {{ $statistik['total_guru'] }}
                        </span>

                        <span class="text-[11px] text-slate-400 font-normal">
                            Guru Aktif
                        </span>
                    </div>
                </div>

                <div class="mt-3 flex items-center justify-between">
                    <a
                        href="{{ route('admin.guru.index') }}"
                        class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1"
                    >
                        Lihat Detail &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 2: Total Siswa -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Total Siswa</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistik['total_siswa'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Siswa Terdaftar</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.siswa.index') }}" class="text-xs font-semibold text-emerald-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 3: Mata Pelajaran -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Mata Pelajaran</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistik['total_mata_pelajaran'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Mata Pelajaran</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.mapel.index') }}" class="text-xs font-semibold text-amber-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 4: Total Nilai -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Total Nilai</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistik['total_nilai'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Data Nilai</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.nilai.index') }}" class="text-xs font-semibold text-blue-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>

            <!-- Card 5: Rata-rata Nilai -->
            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center text-purple-500 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-slate-500">Rata-rata Nilai</span>
                    </div>
                    <div class="mt-2 flex items-baseline space-x-2">
                        <span class="text-2xl font-extrabold text-slate-800">{{ $statistikNilai['rata_rata'] }}</span>
                        <span class="text-[11px] text-slate-400 font-normal">Keseluruhan</span>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <a href="{{ route('admin.nilai.index') }}" class="text-xs font-semibold text-purple-500 hover:underline flex items-center gap-1">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- ROW 2: RINGKASAN NILAI, DONUT CHART & TABEL RANKING SISWA -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-stretch">

            <!-- Card 1: Ringkasan Nilai & Bar Chart (4 cols) -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm">Ringkasan Nilai</h3>
                        </div>
                        <div class="relative">
                            <form method="GET">
                                <select name="semester"
                                    onchange="this.form.submit()"
                                    class="border border-slate-200 px-2 py-1 rounded text-xs bg-white focus:outline-none">
                                    <option value="all" {{ request('semester') == 'all' ? 'selected' : '' }}>
                                        Semua Semester
                                    </option>
                                    <option value="ganjil" {{ request('semester') == 'ganjil' ? 'selected' : '' }}>
                                        Semester Ganjil
                                    </option>
                                    <option value="genap" {{ request('semester') == 'genap' ? 'selected' : '' }}>
                                        Semester Genap
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 mb-5">
                        <div class="bg-emerald-50/60 p-2.5 rounded-lg border border-emerald-100/80 text-center">
                            <p class="text-[11px] font-medium text-emerald-600">Nilai Tertinggi</p>
                            <p class="text-xl font-bold text-emerald-600 mt-0.5">{{ $statistikNilai['nilai_tertinggi'] }}</p>
                            <p class="text-[10px] text-emerald-500">Siswa</p>
                        </div>
                        <div class="bg-rose-50/60 p-2.5 rounded-lg border border-rose-100/80 text-center">
                            <p class="text-[11px] font-medium text-rose-600">Nilai Terendah</p>
                            <p class="text-xl font-bold text-rose-600 mt-0.5">{{ $statistikNilai['nilai_terendah'] }}</p>
                            <p class="text-[10px] text-rose-500">Siswa</p>
                        </div>
                        <div class="bg-sky-50/60 p-2.5 rounded-lg border border-sky-100/80 text-center">
                            <p class="text-[11px] font-medium text-sky-600">Rata-rata Nilai</p>
                            <p class="text-xl font-bold text-sky-600 mt-0.5">{{ $statistikNilai['rata_rata'] }}</p>
                            <p class="text-[10px] text-sky-500">Keseluruhan</p>
                        </div>
                        <div class="bg-purple-50/60 p-2.5 rounded-lg border border-purple-100/80 text-center">
                            <p class="text-[11px] font-medium text-purple-600">Siswa dengan Nilai</p>
                            <p class="text-xl font-bold text-purple-600 mt-0.5">{{ $statistikNilai['total_siswa_punya_nilai'] }}</p>
                            <p class="text-[10px] text-purple-500">Siswa</p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-bold text-slate-800 mb-3">Distribusi Nilai</h4>
                        <div class="relative pt-6 pb-2 border-b border-slate-200">
                            <div class="absolute inset-0 flex flex-col justify-between text-[10px] text-slate-300 pointer-events-none pb-5">
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">80</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">60</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">40</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">20</span><div class="w-full border-t border-slate-100 border-dashed"></div></div>
                                <div class="flex items-center space-x-2"><span class="w-4 text-right">0</span><div class="w-full border-t border-slate-200"></div></div>
                            </div>

                            <div class="flex items-end justify-between pl-6 pr-2 h-36 relative z-10 space-x-2">
                                @forelse($distribusiNilai as $rentang)
                                    <div class="flex-1 flex flex-col items-center justify-end h-full">
                                        <span class="text-[10px] font-bold text-slate-700 mb-1">{{ $rentang['total'] }}</span>
                                        <div class="w-full max-w-[28px] bg-orange-500 rounded-t-sm" style="height: {{ $rentang['total'] > 0 ? round(($rentang['total'] / $maxDistribusi) * 90) : 2 }}%;"></div>
                                        <span class="text-[10px] text-slate-400 mt-2 font-medium">{{ $rentang['label'] }}</span>
                                    </div>
                                @empty
                                    <p class="w-full text-center text-[11px] text-slate-400">Belum ada data nilai</p>
                                @endforelse
                            </div>
                        </div>
                        <p class="text-center text-[10px] text-slate-400 mt-2 font-medium">Rentang Nilai</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Nilai per Mata Pelajaran Donut Chart (4 cols) -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Nilai per Mata Pelajaran</h3>
                    </div>

                    <!-- Donut Chart & Total Nilai di Bawahnya -->
                    @php
                        $donutColors = ['#3b82f6','#1d4ed8','#60a5fa','#38bdf8','#0284c7','#0369a1','#f97316','#ea580c','#c2410c','#f59e0b','#d97706','#b45309','#10b981','#059669','#047857','#8b5cf6','#7c3aed','#6d28d9','#ec4899','#db2777','#14b8a6','#0d9488','#64748b'];
                        $circumference = 2 * M_PI * 38;
                        $cumulative = 0;
                    @endphp
                    <div class="flex flex-col items-center justify-center my-3">
                        <div class="relative w-32 h-32 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="38" stroke="#f1f5f9" stroke-width="12" fill="none" />
                                @forelse($nilaiPerMapel as $index => $mapel)
                                    @php
                                        $dash = ($mapel['persentase'] / 100) * $circumference;
                                        $gap = $circumference - $dash;
                                        $offset = -$cumulative;
                                        $color = $donutColors[$index % count($donutColors)];
                                    @endphp
                                    <circle cx="50" cy="50" r="38" stroke="{{ $color }}" stroke-width="12" fill="none" stroke-dasharray="{{ round($dash, 2) }} {{ round($gap, 2) }}" stroke-dashoffset="{{ round($offset, 2) }}" />
                                    @php $cumulative += $dash; @endphp
                                @empty
                                @endforelse
                            </svg>
                        </div>
                        <div class="text-center mt-2">
                            <span class="text-base font-extrabold text-slate-800 leading-tight">{{ number_format($statistik['total_nilai'], 0, ',', '.') }}</span>
                            <span class="text-[10px] text-slate-400 font-medium block">Total Nilai</span>
                        </div>
                    </div>

                    <!-- Scrollable List Mata Pelajaran -->
                    <div class="space-y-1.5 text-xs max-h-48 overflow-y-auto pr-1 border border-slate-100 rounded-lg p-2 bg-slate-50/50">
                        @forelse($nilaiPerMapel as $index => $mapel)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1.5">
                                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $donutColors[$index % count($donutColors)] }};"></span>
                                    <span class="text-slate-600 text-[11px]">{{ $mapel['nama'] }}</span>
                                </div>
                                <span class="text-[11px] font-semibold text-slate-500">{{ $mapel['total'] }} ({{ $mapel['persentase'] }}%)</span>
                            </div>
                        @empty
                            <p class="text-center text-[11px] text-slate-400 py-2">Belum ada data nilai</p>
                        @endforelse
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 mt-3">
                    <a href="{{ route('admin.nilai.index') }}" class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 3: Tabel 10 Peringkat Siswa (4 cols) - Sempurna tanpa space kosong -->
            <div class="lg:col-span-4 bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded bg-amber-100 flex items-center justify-center text-amber-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v2M19 3v2M10 21h4M12 17v4M6 8h12a2 2 0 012 2v1a6 6 0 01-12 0v-1a2 2 0 012-2z"/></svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm">10 Peringkat Siswa</h3>
                        </div>
                    </div>

                    <div class="overflow-x-auto h-[350px] overflow-y-auto pr-1">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 border-b border-slate-100 sticky top-0 bg-white z-10">
                                    <th class="pb-2.5 font-medium">Rank</th>
                                    <th class="pb-2.5 font-medium">Nama Siswa</th>
                                    <th class="pb-2.5 font-medium">Kelas</th>
                                    <th class="pb-2.5 font-medium">Rata-rata</th>
                                    <th class="pb-2.5 font-medium text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                @forelse($topSiswa as $index => $siswa)
                                    @php
                                        $rank = $index + 1;
                                        $rankClass = match(true) {
                                            $rank === 1 => 'font-bold text-orange-600',
                                            $rank === 2 => 'font-bold text-slate-600',
                                            $rank === 3 => 'font-bold text-amber-600',
                                            default => 'font-medium text-slate-600',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="py-2.5 {{ $rankClass }}">#{{ $rank }}</td>
                                        <td class="py-2.5 font-medium text-slate-800">{{ $siswa['nama'] }}</td>
                                        <td class="py-2.5">{{ $siswa['kelas'] }}</td>
                                        <td class="py-2.5 font-semibold">{{ number_format($siswa['rata_rata'], 2) }}</td>
                                        <td class="py-2.5 text-center">
                                            <button class="w-5 h-5 rounded-full border border-orange-200 text-orange-500 flex items-center justify-center hover:bg-orange-50 mx-auto">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 text-center text-slate-400">Belum ada data nilai siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 mt-2">
                    <a href="{{ route('admin.siswa.index') }}" class="text-xs font-semibold text-orange-500 hover:underline flex items-center gap-1">
                        Lihat Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- ROW 3: AKTIVITAS TERBARU & STATISTIK KELAS -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            <!-- Aktivitas Terbaru (6 cols) -->
            <div class="lg:col-span-6 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Aktivitas Terbaru</h3>
                    </div>
                </div>

                <div class="space-y-3.5">
                    @forelse($aktivitasTerbaru as $aktivitas)
                        <div class="flex items-start space-x-3">
                            @if($aktivitas['type'] === 'nilai')
                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-800 font-medium leading-snug">
                                        <span class="font-semibold text-slate-900">{{ $aktivitas['nama'] }}</span> mendapat nilai baru untuk mata pelajaran <span class="font-semibold text-slate-900">{{ $aktivitas['mapel'] }}</span>
                                    </p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $aktivitas['waktu'] }}</p>
                                </div>
                            @else
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-800 font-medium leading-snug">
                                        <span class="font-semibold text-slate-900">Siswa {{ $aktivitas['nama'] }}</span> diperbarui datanya
                                    </p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $aktivitas['waktu'] }}</p>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-4">Belum ada aktivitas terbaru</p>
                    @endforelse
                </div>
            </div>

            <!-- Statistik Kelas (6 cols) -->
            <div class="lg:col-span-6 bg-white p-5 rounded-xl border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded bg-orange-100 flex items-center justify-center text-orange-600">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-sm">Statistik Kelas</h3>
                    </div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-orange-50/50 p-3 rounded-xl border border-orange-100">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">{{ $statistikKelas['total'] }}</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Total Kelas</p>
                        <p class="text-[10px] text-slate-400">Kelas Aktif</p>
                    </div>

                    <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">{{ $statistikKelas['x'] }}</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas X</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>

                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">{{ $statistikKelas['xi'] }}</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas XI</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>

                    <div class="bg-purple-50/50 p-3 rounded-xl border border-purple-100">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-xl font-extrabold text-slate-800">{{ $statistikKelas['xii'] }}</p>
                        <p class="text-[11px] font-semibold text-slate-600 mt-0.5">Kelas XII</p>
                        <p class="text-[10px] text-slate-400">Kelas</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

 @endsection
