@extends('layout')

@section('content')

<main class="w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-5">

        <a href="{{ route('admin.dashboard') }}"
           class="hover:text-orange-600 transition-colors">
            Dashboard
        </a>

        <span class="text-slate-300">/</span>

        <a href="{{ route('admin.mapel.index') }}"
           class="hover:text-orange-600 transition-colors">
            Mata Pelajaran
        </a>

        <span class="text-slate-300">/</span>

        <span class="text-slate-700">
            Detail
        </span>

    </nav>

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">
                Detail Mata Pelajaran
            </h1>

            <p class="text-xs text-slate-500 mt-1">
                Informasi lengkap mata pelajaran dan guru pengampu.
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a href="{{ route('admin.mapel.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-xs font-semibold hover:bg-slate-50 transition-colors">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>

                Kembali
            </a>

            <!-- <a href="{{ route('admin.mapel.index', $mataPelajaran->id) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 text-white text-xs font-semibold shadow-md shadow-orange-500/20 transition-colors">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>

                Edit
            </a> -->

        </div>

    </div>

    {{-- Informasi Utama --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

        {{-- Nama Mapel --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-5">

            <div class="flex items-start gap-4">

                <div class="w-12 h-12 shrink-0 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="text-xs text-slate-400 font-medium mb-1">
                        Nama Mata Pelajaran
                    </p>

                    <h2 class="text-xl font-extrabold text-slate-800 break-words">
                        {{ $mataPelajaran->name }}
                    </h2>

                    <span class="inline-flex items-center mt-2 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-bold font-mono">
                        {{ $mataPelajaran->kode }}
                    </span>

                </div>

            </div>

        </div>

        {{-- Jumlah Guru --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium text-slate-400">
                        Guru Pengampu
                    </p>

                    <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                        {{ $mataPelajaran->gurus->count() }}
                    </h3>

                    <p class="text-[11px] text-slate-400 mt-1">
                        Guru terdaftar
                    </p>
                </div>

                <div class="w-11 h-11 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">

                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>

                </div>

            </div>

        </div>

    </div>

    {{-- Detail Mata Pelajaran --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden mb-5">

        <div class="px-5 py-4 border-b border-slate-100 bg-amber-50/40">

            <h2 class="text-sm font-bold text-slate-800">
                Informasi Mata Pelajaran
            </h2>

            <p class="text-[11px] text-slate-400 mt-0.5">
                Detail informasi mata pelajaran.
            </p>

        </div>

        <div class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Kode --}}
                <div>
                    <p class="text-[11px] font-semibold text-slate-400 mb-1">
                        Kode Mata Pelajaran
                    </p>

                    <p class="text-sm font-bold text-slate-800 font-mono">
                        {{ $mataPelajaran->kode }}
                    </p>
                </div>

                {{-- Nama --}}
                <div>
                    <p class="text-[11px] font-semibold text-slate-400 mb-1">
                        Nama Mata Pelajaran
                    </p>

                    <p class="text-sm font-bold text-slate-800">
                        {{ $mataPelajaran->name }}
                    </p>
                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2">

                    <p class="text-[11px] font-semibold text-slate-400 mb-1">
                        Keterangan
                    </p>

                    @if($mataPelajaran->keterangan)
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $mataPelajaran->keterangan }}
                        </p>
                    @else
                        <p class="text-sm text-slate-400 italic">
                            Belum ada keterangan.
                        </p>
                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- Daftar Guru --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 bg-amber-50/40">

            <div>
                <h2 class="text-sm font-bold text-slate-800">
                    Guru Pengampu
                </h2>

                <p class="text-[11px] text-slate-400 mt-0.5">
                    Daftar guru yang mengampu mata pelajaran ini.
                </p>
            </div>

            <span class="inline-flex w-fit items-center px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-[11px] font-bold">
                {{ $mataPelajaran->gurus->count() }} Guru
            </span>

        </div>

        <div class="overflow-x-auto">

            @if($mataPelajaran->gurus->count() > 0)

                <table class="w-full min-w-[600px] text-left text-xs">

                    <thead>
                        <tr class="border-b border-slate-100 text-slate-500 font-semibold">

                            <th class="py-3 px-5">
                                No
                            </th>

                            <th class="py-3 px-4">
                                Nama Guru
                            </th>

                            <th class="py-3 px-4">
                                NIP
                            </th>

                            <th class="py-3 px-4">
                                Email
                            </th>

                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($mataPelajaran->gurus as $index => $guru)

                            <tr class="hover:bg-slate-50/50 transition-colors">

                                <td class="py-3.5 px-5 text-slate-400 font-medium">
                                    {{ $index + 1 }}
                                </td>

                                <td class="py-3.5 px-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($guru->name ?? 'G', 0, 1)) }}
                                        </div>

                                        <span class="font-bold text-slate-800">
                                            {{ $guru->name }}
                                        </span>

                                    </div>

                                </td>

                                <td class="py-3.5 px-4 font-mono text-slate-600">
                                    {{ $guru->nip ?? '-' }}
                                </td>

                                <td class="py-3.5 px-4 text-slate-500">
                                    {{ $guru->email ?? '-' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="py-12 px-5 text-center">

                    <div class="w-12 h-12 mx-auto rounded-xl bg-slate-50 text-slate-300 flex items-center justify-center mb-3">

                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                        </svg>

                    </div>

                    <p class="text-sm font-semibold text-slate-600">
                        Belum ada guru pengampu
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Belum ada guru yang ditugaskan pada mata pelajaran ini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection