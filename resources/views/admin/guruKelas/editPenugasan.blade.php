@extends('layout')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | DATA AWAL PENUGASAN
    |--------------------------------------------------------------------------
    */

    $guruAwal = $guru->firstWhere(
        'id',
        $penugasan->id_user
    );

    /*
     * Karena guru_kelas tidak menyimpan id_mata_pelajaran,
     * maka mapel awal mengikuti mapel yang dimiliki guru tersebut.
     */
    $mapelAwal = $guruAwal
        ? $guruAwal->mataPelajaran->pluck('id')->values()->toArray()
        : [];

@endphp


<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-4">

        <a href="{{ route('admin.dashboard') }}"
           class="hover:text-slate-600 transition-colors">

            Dashboard

        </a>

        <i data-lucide="chevron-right"
           class="w-3.5 h-3.5">
        </i>

        <a href="{{ route('admin.guru.index') }}"
           class="hover:text-slate-600 transition-colors">

            Guru

        </a>

        <i data-lucide="chevron-right"
           class="w-3.5 h-3.5">
        </i>

        <span class="text-orange-600 font-semibold">

            Edit Penugasan

        </span>

    </nav>


    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">

        <div>

            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">

                Edit Penugasan Guru

            </h1>

            <p class="text-sm text-slate-500 mt-1">

                Perbarui guru, mata pelajaran, dan kelas yang ditugaskan.

            </p>

        </div>


        <a href="{{ route('admin.guruKelas.daftarKelas') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl border border-slate-200
                  bg-white text-slate-700 hover:bg-slate-50
                  font-semibold text-sm shadow-sm transition-all">

            <i data-lucide="arrow-left"
               class="w-4 h-4">
            </i>

            Kembali ke Daftar

        </a>

    </div>


    {{-- Validation Error --}}
    @if ($errors->any())

        <div class="mb-6 p-4 rounded-xl
                    bg-red-50 border border-red-200
                    text-red-700">

            <div class="flex items-center gap-2
                        font-semibold mb-2 text-red-800">

                <i data-lucide="alert-circle"
                   class="w-5 h-5">
                </i>

                <span>

                    Terdapat kesalahan pada form:

                </span>

            </div>


            <ul class="list-disc list-inside space-y-1 text-xs">

                @foreach ($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- ERROR NOTIFICATION --}}
    @if (session('error'))

        <div id="errorNotification"
             class="fixed top-5 right-5 z-[9999]
                    w-[calc(100%-2rem)] max-w-sm
                    bg-white border border-red-200
                    rounded-2xl shadow-2xl p-4">

            <div class="flex items-start gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-red-100 text-red-600
                            flex items-center justify-center
                            shrink-0">

                    <i data-lucide="alert-circle"
                       class="w-5 h-5">
                    </i>

                </div>


                <div class="flex-1 min-w-0">

                    <h3 class="font-bold text-red-700 text-sm">

                        Penugasan Tidak Dapat Diperbarui

                    </h3>


                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">

                        {{ session('error') }}

                    </p>

                </div>


                <button type="button"
                        id="closeErrorNotification"
                        class="text-slate-400 hover:text-slate-600 transition-colors">

                    <i data-lucide="x"
                       class="w-4 h-4">
                    </i>

                </button>

            </div>


            <div class="mt-3 h-1 bg-red-100 rounded-full overflow-hidden">

                <div id="notificationProgress"
                     class="h-full bg-red-500 rounded-full"
                     style="width:100%;">

                </div>

            </div>

        </div>

    @endif


    {{-- SUCCESS NOTIFICATION --}}
    @if (session('success'))

        <div id="successNotification"
             class="fixed top-5 right-5 z-[9999]
                    w-[calc(100%-2rem)] max-w-sm
                    bg-white border border-emerald-200
                    rounded-2xl shadow-2xl p-4">

            <div class="flex items-start gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-emerald-100 text-emerald-600
                            flex items-center justify-center
                            shrink-0">

                    <i data-lucide="check-circle"
                       class="w-5 h-5">
                    </i>

                </div>


                <div class="flex-1 min-w-0">

                    <h3 class="font-bold text-emerald-700 text-sm">

                        Berhasil

                    </h3>


                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">

                        {{ session('success') }}

                    </p>

                </div>


                <button type="button"
                        id="closeSuccessNotification"
                        class="text-slate-400 hover:text-slate-600 transition-colors">

                    <i data-lucide="x"
                       class="w-4 h-4">
                    </i>

                </button>

            </div>

        </div>

    @endif


    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">


        {{-- Card Header --}}
        <div class="px-6 py-4
                    bg-slate-50/80
                    border-b border-slate-100">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-lg
                            bg-orange-100 text-orange-600
                            flex items-center justify-center">

                    <i data-lucide="clipboard-edit"
                       class="w-5 h-5">
                    </i>

                </div>


                <div>

                    <h2 class="text-base font-bold text-slate-800">

                        Formulir Edit Penugasan Guru

                    </h2>

                    <p class="text-xs text-slate-400">

                        Perbarui guru, mata pelajaran, dan kelas.

                    </p>

                </div>

            </div>

        </div>


        {{-- FORM --}}
        <form method="POST"
              action="{{ route('admin.guruKelas.updatePenugasan', $penugasan->id) }}"
              id="penugasanForm"
              class="p-6 sm:p-8 space-y-6">

            @csrf

            @method('PUT')


            {{-- ========================================= --}}
            {{-- GURU --}}
            {{-- ========================================= --}}

            <div class="space-y-1.5">

                <label for="id_user"
                       class="block text-xs font-bold
                              text-slate-700
                              uppercase tracking-wider">

                    Guru

                    <span class="text-red-500">*</span>

                </label>


                <div class="relative">

                    <span class="absolute inset-y-0 left-0
                                 pl-3.5 flex items-center
                                 pointer-events-none
                                 text-slate-400">

                        <i data-lucide="user"
                           class="w-4 h-4">
                        </i>

                    </span>


                    <select name="id_user"
                            id="id_user"
                            required
                            class="w-full pl-10 pr-10 py-3
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm text-slate-800
                                   focus:bg-white
                                   focus:border-orange-500
                                   focus:ring-4
                                   focus:ring-orange-500/10
                                   outline-none
                                   appearance-none
                                   transition-all">

                        <option value="">

                            -- Pilih Guru --

                        </option>


                        @foreach ($guru as $g)

                            <option value="{{ $g->id }}"
                                {{ old('id_user', $penugasan->id_user) == $g->id ? 'selected' : '' }}>

                                {{ $g->name }}

                                @if ($g->nip)

                                    — {{ $g->nip }}

                                @endif

                            </option>

                        @endforeach

                    </select>


                    <span class="absolute inset-y-0 right-0
                                 pr-3.5 flex items-center
                                 pointer-events-none
                                 text-slate-400">

                        <i data-lucide="chevron-down"
                           class="w-4 h-4">
                        </i>

                    </span>

                </div>


                @error('id_user')

                    <p class="text-xs text-red-500 mt-1">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- MATA PELAJARAN --}}
            {{-- ========================================= --}}

            <div id="mapelSection"
                 class="space-y-2 hidden">

                <div class="flex items-center justify-between">

                    <label class="block text-xs font-bold
                                  text-slate-700
                                  uppercase tracking-wider">

                        Mata Pelajaran

                        <span class="text-red-500">*</span>

                    </label>


                    <span class="text-[11px] text-slate-400">

                        Bisa pilih beberapa

                    </span>

                </div>


                {{-- Container Mapel --}}
                <div id="mapelContainer"
                     class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                </div>


                {{-- Empty --}}
                <p id="mapelEmpty"
                   class="hidden text-xs text-red-500 mt-1">

                    Guru ini belum memiliki mata pelajaran.

                </p>


                @error('id_mata_pelajaran')

                    <p class="text-xs text-red-500 mt-1">

                        {{ $message }}

                    </p>

                @enderror


                @error('id_mata_pelajaran.*')

                    <p class="text-xs text-red-500 mt-1">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- KELAS --}}
            {{-- ========================================= --}}

            <div class="space-y-1.5">

                <label for="kelas"
                       class="block text-xs font-bold
                              text-slate-700
                              uppercase tracking-wider">

                    Kelas

                    <span class="text-red-500">*</span>

                </label>


                <div class="relative">

                    <span class="absolute inset-y-0 left-0
                                 pl-3.5 flex items-center
                                 pointer-events-none
                                 text-slate-400">

                        <i data-lucide="school"
                           class="w-4 h-4">
                        </i>

                    </span>


                    <select name="kelas"
                            id="kelas"
                            required
                            class="w-full pl-10 pr-10 py-3
                                   bg-slate-50
                                   border border-slate-200
                                   rounded-xl
                                   text-sm text-slate-800
                                   focus:bg-white
                                   focus:border-orange-500
                                   focus:ring-4
                                   focus:ring-orange-500/10
                                   outline-none
                                   appearance-none
                                   transition-all">

                        <option value="">

                            -- Pilih Kelas --

                        </option>


                        @foreach ($kelas as $k)

                            <option value="{{ $k }}"
                                {{ old('kelas', $penugasan->kelas) == $k ? 'selected' : '' }}>

                                {{ $k }}

                            </option>

                        @endforeach

                    </select>


                    <span class="absolute inset-y-0 right-0
                                 pr-3.5 flex items-center
                                 pointer-events-none
                                 text-slate-400">

                        <i data-lucide="chevron-down"
                           class="w-4 h-4">
                        </i>

                    </span>

                </div>


                @error('kelas')

                    <p class="text-xs text-red-500 mt-1">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- ========================================= --}}
            {{-- INFORMATION --}}
            {{-- ========================================= --}}

            <div id="informationBox"
                 class="p-4 rounded-xl
                        bg-amber-50
                        border border-amber-200
                        flex items-start gap-3
                        text-amber-900">

                <i data-lucide="info"
                   class="w-5 h-5 text-amber-600
                          shrink-0 mt-0.5">
                </i>


                <p id="informationText"
                   class="text-xs leading-relaxed">

                    Pilih guru terlebih dahulu.
                    Sistem akan menampilkan mata pelajaran
                    yang terhubung dengan guru tersebut.

                </p>

            </div>


            {{-- ========================================= --}}
            {{-- PREVIEW PENUGASAN --}}
            {{-- ========================================= --}}

            <div id="assignmentPreview"
                 class="hidden p-4 rounded-xl
                        bg-orange-50
                        border border-orange-200">

                <div class="flex items-start gap-3">

                    <div class="w-9 h-9 rounded-lg
                                bg-orange-100
                                text-orange-600
                                flex items-center
                                justify-center
                                shrink-0">

                        <i data-lucide="clipboard-check"
                           class="w-4 h-4">
                        </i>

                    </div>


                    <div class="flex-1 min-w-0">

                        <p class="text-[11px] font-bold
                                  uppercase tracking-wider
                                  text-orange-600">

                            Ringkasan Penugasan

                        </p>


                        <p id="previewText"
                           class="text-sm font-semibold
                                  text-slate-700 mt-1">

                        </p>

                    </div>

                </div>

            </div>


            {{-- ========================================= --}}
            {{-- ACTION --}}
            {{-- ========================================= --}}

            <div class="pt-4 border-t border-slate-100
                        flex flex-col-reverse
                        sm:flex-row
                        justify-end gap-3">


                {{-- RESET --}}
                <button type="button"
                        id="resetButton"
                        class="w-full sm:w-auto
                               px-5 py-2.5
                               rounded-xl
                               border border-slate-200
                               bg-white
                               hover:bg-slate-50
                               text-slate-600
                               font-semibold text-sm
                               transition-all
                               flex items-center
                               justify-center gap-2">

                    <i data-lucide="rotate-ccw"
                       class="w-4 h-4">
                    </i>

                    Kembalikan Data

                </button>


                {{-- SUBMIT --}}
                <button type="submit"
                        id="submitButton"
                        class="w-full sm:w-auto
                               px-6 py-2.5
                               rounded-xl
                               bg-orange-500
                               hover:bg-orange-600
                               active:bg-orange-700
                               text-white
                               font-semibold text-sm
                               shadow-md
                               shadow-orange-500/25
                               transition-all
                               flex items-center
                               justify-center gap-2">

                    <i data-lucide="save"
                       class="w-4 h-4">
                    </i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</main>


{{-- ========================================= --}}
{{-- LUCIDE --}}
{{-- ========================================= --}}

<script src="https://unpkg.com/lucide@latest"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    lucide.createIcons();


    // =========================================
    // ELEMENT
    // =========================================

    const guruSelect =
        document.getElementById('id_user');

    const kelasSelect =
        document.getElementById('kelas');

    const mapelSection =
        document.getElementById('mapelSection');

    const mapelContainer =
        document.getElementById('mapelContainer');

    const mapelEmpty =
        document.getElementById('mapelEmpty');

    const resetButton =
        document.getElementById('resetButton');

    const assignmentPreview =
        document.getElementById('assignmentPreview');

    const previewText =
        document.getElementById('previewText');

    const informationText =
        document.getElementById('informationText');


    // =========================================
    // DATA GURU + MATA PELAJARAN
    // =========================================

    const guruMapel = {

        @foreach ($guru as $g)

            "{{ $g->id }}": [

                @foreach ($g->mataPelajaran as $mapel)

                    {
                        id: "{{ $mapel->id }}",
                        name: @json($mapel->name),
                        kode: @json($mapel->kode)
                    },

                @endforeach

            ],

        @endforeach

    };


    // =========================================
    // DATA AWAL EDIT
    // =========================================

    const initialGuru =
        @json(old('id_user', $penugasan->id_user));


    const initialKelas =
        @json(old('kelas', $penugasan->kelas));


    /*
     * Jika form sebelumnya gagal validasi,
     * gunakan old input.
     *
     * Jika tidak ada old input,
     * gunakan semua mapel yang dimiliki guru awal.
     */
    const initialMapel =
        @json(
            old(
                'id_mata_pelajaran',
                $mapelAwal
            )
        );


    // =========================================
    // UPDATE MATA PELAJARAN
    // =========================================

    function updateMataPelajaran(
        selectedMapel = []
    ) {

        const guruId =
            guruSelect.value;


        mapelContainer.innerHTML = '';

        mapelSection.classList.add('hidden');

        mapelEmpty.classList.add('hidden');

        assignmentPreview.classList.add('hidden');


        // =====================================
        // BELUM PILIH GURU
        // =====================================

        if (!guruId) {

            informationText.textContent =
                'Pilih guru terlebih dahulu. Sistem akan menampilkan mata pelajaran yang terhubung dengan guru tersebut.';

            return;

        }


        const daftarMapel =
            guruMapel[guruId] || [];


        mapelSection.classList.remove('hidden');


        // =====================================
        // GURU BELUM PUNYA MAPEL
        // =====================================

        if (daftarMapel.length === 0) {

            mapelEmpty.classList.remove('hidden');

            informationText.textContent =
                'Guru yang dipilih belum memiliki mata pelajaran. Tambahkan mata pelajaran guru terlebih dahulu.';

            return;

        }


        // =====================================
        // INFORMATION
        // =====================================

        informationText.textContent =
            'Pilih satu atau beberapa mata pelajaran yang akan ditugaskan kepada guru pada kelas yang dipilih.';


        // =====================================
        // TAMPILKAN MAPEL
        // =====================================

        daftarMapel.forEach(function (mapel) {

            const label =
                document.createElement('label');


            label.className =
                'relative cursor-pointer group';


            // =====================================
            // CHECKBOX
            // =====================================

            const checkbox =
                document.createElement('input');


            checkbox.type =
                'checkbox';


            checkbox.name =
                'id_mata_pelajaran[]';


            checkbox.value =
                mapel.id;


            checkbox.className =
                'peer sr-only';


            // =====================================
            // CHECK MAPEL AWAL
            // =====================================

            if (
                selectedMapel
                    .map(String)
                    .includes(String(mapel.id))
            ) {

                checkbox.checked =
                    true;

            }


            // =====================================
            // CARD
            // =====================================

            const card =
                document.createElement('div');


            card.className = `
                p-4 rounded-xl
                border border-slate-200
                bg-slate-50
                transition-all
                peer-checked:border-orange-500
                peer-checked:bg-orange-50
                peer-checked:ring-4
                peer-checked:ring-orange-500/10
                group-hover:border-orange-300
            `;


            card.innerHTML = `

                <div class="flex items-center gap-3">

                    {{-- ICON --}}
                    <div class="
                        w-10 h-10
                        rounded-xl
                        bg-white
                        border border-slate-200
                        text-slate-400
                        flex items-center
                        justify-center
                        shrink-0
                    ">

                        <i data-lucide="book-open"
                           class="w-5 h-5">
                        </i>

                    </div>


                    {{-- NAMA MAPEL --}}
                    <div class="flex-1 min-w-0">

                        <p class="
                            text-sm font-semibold
                            text-slate-700
                        ">

                            ${mapel.name}

                        </p>


                        ${
                            mapel.kode
                            ? `
                                <p class="
                                    text-[11px]
                                    text-slate-400
                                    mt-0.5
                                ">

                                    Kode: ${mapel.kode}

                                </p>
                            `
                            : ''
                        }

                    </div>


                    {{-- CHECKBOX VISUAL --}}
                    <div class="
                        w-5 h-5
                        rounded-md
                        border-2
                        border-slate-300
                        flex items-center
                        justify-center
                        transition-all
                    ">

                        <i data-lucide="check"
                           class="
                               w-3.5 h-3.5
                               text-white
                               opacity-0
                           ">
                        </i>

                    </div>

                </div>

            `;


            label.appendChild(checkbox);

            label.appendChild(card);

            mapelContainer.appendChild(label);


            // =====================================
            // CHECKBOX CHANGE
            // =====================================

            checkbox.addEventListener(
                'change',
                function () {

                    updateCheckboxVisual(
                        checkbox,
                        card
                    );

                    updatePreview();

                }
            );


            // =====================================
            // INITIAL VISUAL
            // =====================================

            updateCheckboxVisual(
                checkbox,
                card
            );

        });


        lucide.createIcons();

        updatePreview();

    }


    // =========================================
    // CHECKBOX VISUAL
    // =========================================

    function updateCheckboxVisual(
        checkbox,
        card
    ) {

        const checkBoxVisual =
            card.querySelector(
                '.w-5.h-5'
            );


        const checkIcon =
            card.querySelector(
                '[data-lucide="check"]'
            );


        if (
            checkbox.checked
        ) {

            card.classList.remove(
                'border-slate-200',
                'bg-slate-50'
            );

            card.classList.add(
                'border-orange-500',
                'bg-orange-50',
                'ring-4',
                'ring-orange-500/10'
            );


            if (checkBoxVisual) {

                checkBoxVisual.classList.remove(
                    'border-slate-300'
                );

                checkBoxVisual.classList.add(
                    'border-orange-500',
                    'bg-orange-500'
                );

            }


            if (checkIcon) {

                checkIcon.classList.remove(
                    'opacity-0'
                );

                checkIcon.classList.add(
                    'opacity-100'
                );

            }

        } else {

            card.classList.remove(
                'border-orange-500',
                'bg-orange-50',
                'ring-4',
                'ring-orange-500/10'
            );

            card.classList.add(
                'border-slate-200',
                'bg-slate-50'
            );


            if (checkBoxVisual) {

                checkBoxVisual.classList.remove(
                    'border-orange-500',
                    'bg-orange-500'
                );

                checkBoxVisual.classList.add(
                    'border-slate-300'
                );

            }


            if (checkIcon) {

                checkIcon.classList.remove(
                    'opacity-100'
                );

                checkIcon.classList.add(
                    'opacity-0'
                );

            }

        }

    }


    // =========================================
    // UPDATE PREVIEW
    // =========================================

    function updatePreview() {

        const guruOption =
            guruSelect.options[
                guruSelect.selectedIndex
            ];


        const selectedMapels =
            document.querySelectorAll(
                'input[name="id_mata_pelajaran[]"]:checked'
            );


        const kelas =
            kelasSelect.value;


        // =====================================
        // BELUM LENGKAP
        // =====================================

        if (
            !guruOption ||
            !guruOption.value ||
            selectedMapels.length === 0 ||
            !kelas
        ) {

            assignmentPreview.classList.add(
                'hidden'
            );

            return;

        }


        // =====================================
        // GURU
        // =====================================

        const guruName =
            guruOption.textContent.trim();


        // =====================================
        // DAFTAR MAPEL
        // =====================================

        const daftarMapel =
            guruMapel[guruSelect.value] || [];


        const namaMapel = [];


        selectedMapels.forEach(
            function (checkbox) {

                const mapel =
                    daftarMapel.find(
                        function (item) {

                            return String(item.id)
                                === String(checkbox.value);

                        }
                    );


                if (mapel) {

                    namaMapel.push(
                        mapel.name
                    );

                }

            }
        );


        if (namaMapel.length === 0) {

            assignmentPreview.classList.add(
                'hidden'
            );

            return;

        }


        // =====================================
        // PREVIEW
        // =====================================

        previewText.innerHTML = `

            <div class="space-y-2">

                <div>

                    <span class="text-slate-800">

                        ${guruName}

                    </span>


                    <span class="text-orange-500 mx-1">

                        →

                    </span>


                    <span class="text-slate-800">

                        ${kelas}

                    </span>

                </div>


                <div class="flex flex-wrap gap-2">

                    ${namaMapel.map(
                        function (nama) {

                            return `

                                <span class="
                                    inline-flex
                                    items-center
                                    px-2.5 py-1
                                    rounded-lg
                                    bg-orange-100
                                    text-orange-700
                                    text-xs
                                    font-semibold
                                ">

                                    ${nama}

                                </span>

                            `;

                        }
                    ).join('')}

                </div>

            </div>

        `;


        assignmentPreview.classList.remove(
            'hidden'
        );


        lucide.createIcons();

    }


    // =========================================
    // GURU DIPILIH
    // =========================================

    if (guruSelect) {

        guruSelect.addEventListener(
            'change',
            function () {

                /*
                 * Kalau guru diganti,
                 * mapel baru dimulai kosong.
                 */
                updateMataPelajaran([]);

            }
        );

    }


    // =========================================
    // KELAS DIPILIH
    // =========================================

    if (kelasSelect) {

        kelasSelect.addEventListener(
            'change',
            updatePreview
        );

    }


    // =========================================
    // RESET
    // =========================================

    if (resetButton) {

        resetButton.addEventListener(
            'click',
            function () {

                /*
                 * Kembalikan guru
                 */
                guruSelect.value =
                    initialGuru;


                /*
                 * Kembalikan kelas
                 */
                kelasSelect.value =
                    initialKelas;


                /*
                 * Kembalikan mapel
                 */
                updateMataPelajaran(
                    initialMapel
                );


                informationText.textContent =
                    'Pilih satu atau beberapa mata pelajaran yang akan ditugaskan kepada guru pada kelas yang dipilih.';


                lucide.createIcons();

            }
        );

    }


    // =========================================
    // INITIAL LOAD
    // =========================================

    /*
     * Guru dan kelas sudah otomatis
     * mengambil data penugasan lama.
     */

    guruSelect.value =
        initialGuru;


    kelasSelect.value =
        initialKelas;


    /*
     * Tampilkan mapel guru lama
     * dan centang mapel awal.
     */

    updateMataPelajaran(
        initialMapel
    );


    // =========================================
    // ERROR NOTIFICATION
    // =========================================

    const errorNotification =
        document.getElementById(
            'errorNotification'
        );


    const closeErrorNotification =
        document.getElementById(
            'closeErrorNotification'
        );


    if (errorNotification) {

        if (closeErrorNotification) {

            closeErrorNotification.addEventListener(
                'click',
                function () {

                    errorNotification.remove();

                }
            );

        }


        setTimeout(
            function () {

                if (errorNotification) {

                    errorNotification.remove();

                }

            },
            4000
        );

    }


    // =========================================
    // ERROR PROGRESS
    // =========================================

    const notificationProgress =
        document.getElementById(
            'notificationProgress'
        );


    if (notificationProgress) {

        notificationProgress.style.transition =
            'width 4s linear';


        setTimeout(
            function () {

                notificationProgress.style.width =
                    '0%';

            },
            50
        );

    }


    // =========================================
    // SUCCESS NOTIFICATION
    // =========================================

    const successNotification =
        document.getElementById(
            'successNotification'
        );


    const closeSuccessNotification =
        document.getElementById(
            'closeSuccessNotification'
        );


    if (successNotification) {

        if (closeSuccessNotification) {

            closeSuccessNotification.addEventListener(
                'click',
                function () {

                    successNotification.remove();

                }
            );

        }


        setTimeout(
            function () {

                if (successNotification) {

                    successNotification.remove();

                }

            },
            4000
        );

    }

});

</script>


<style>

@keyframes slideIn {

    from {

        opacity: 0;

        transform:
            translateX(30px);

    }

    to {

        opacity: 1;

        transform:
            translateX(0);

    }

}


#mapelSection {

    animation:
        slideIn
        0.25s
        ease-out;

}


#assignmentPreview {

    animation:
        slideIn
        0.25s
        ease-out;

}

</style>


@endsection