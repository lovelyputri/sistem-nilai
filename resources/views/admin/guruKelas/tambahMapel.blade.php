@extends('layout')

@section('content')

<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ============================================================
         BREADCRUMB
    ============================================================ --}}
    <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-4">

        <a href="{{ route('admin.dashboard') }}"
           class="hover:text-slate-600 transition-colors">
            Dashboard
        </a>

        <i data-lucide="chevron-right"
           class="w-3.5 h-3.5">
        </i>

        <a href="{{ route('admin.guruKelas.daftarKelas') }}"
           class="hover:text-slate-600 transition-colors">
            Guru
        </a>

        <i data-lucide="chevron-right"
           class="w-3.5 h-3.5">
        </i>

        <span class="text-orange-600 font-semibold">
            Tambah Mata Pelajaran
        </span>

    </nav>


    {{-- ============================================================
         PAGE HEADER
    ============================================================ --}}
    <div class="flex flex-col sm:flex-row sm:items-center
                justify-between gap-4 mb-8">

        <div>

            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                Tambah Mata Pelajaran
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Tentukan guru dan mata pelajaran yang akan diajarkan.
            </p>

        </div>


        <a href="{{ route('admin.guruKelas.daftarKelas') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-xl
                  border border-slate-200
                  bg-white text-slate-700
                  hover:bg-slate-50
                  font-semibold text-sm
                  shadow-sm transition-all">

            <i data-lucide="arrow-left"
               class="w-4 h-4">
            </i>

            Kembali ke Daftar

        </a>

    </div>


    {{-- ============================================================
         VALIDATION ERROR
    ============================================================ --}}
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


    {{-- ============================================================
         ERROR NOTIFICATION
    ============================================================ --}}
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
                        Mata Pelajaran Tidak Dapat Ditambahkan
                    </h3>

                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        {{ session('error') }}
                    </p>

                </div>


                <button type="button"
                        id="closeErrorNotification"
                        class="text-slate-400
                               hover:text-slate-600
                               transition-colors">

                    <i data-lucide="x"
                       class="w-4 h-4">
                    </i>

                </button>

            </div>


            <div class="mt-3 h-1
                        bg-red-100
                        rounded-full
                        overflow-hidden">

                <div id="notificationProgress"
                     class="h-full bg-red-500 rounded-full"
                     style="width:100%;">
                </div>

            </div>

        </div>

    @endif


    {{-- ============================================================
         SUCCESS NOTIFICATION
    ============================================================ --}}
    @if (session('success'))

        <div id="successNotification"
             class="fixed top-5 right-5 z-[9999]
                    w-[calc(100%-2rem)] max-w-sm
                    bg-white border border-emerald-200
                    rounded-2xl shadow-2xl p-4">

            <div class="flex items-start gap-3">

                <div class="w-10 h-10 rounded-xl
                            bg-emerald-100
                            text-emerald-600
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
                        class="text-slate-400
                               hover:text-slate-600
                               transition-colors">

                    <i data-lucide="x"
                       class="w-4 h-4">
                    </i>

                </button>

            </div>

        </div>

    @endif


    {{-- ============================================================
         FORM CARD
    ============================================================ --}}
    <div class="bg-white rounded-2xl
                border border-slate-200
                shadow-sm overflow-hidden">


        {{-- ========================================================
             CARD HEADER
        ========================================================= --}}
        <div class="px-6 py-4
                    bg-slate-50/80
                    border-b border-slate-100">

            <div class="flex items-center gap-3">

                <div class="w-9 h-9 rounded-lg
                            bg-orange-100
                            text-orange-600
                            flex items-center justify-center">

                    <i data-lucide="book-plus"
                       class="w-5 h-5">
                    </i>

                </div>


                <div>

                    <h2 class="text-base font-bold text-slate-800">
                        Formulir Mata Pelajaran Guru
                    </h2>

                    <p class="text-xs text-slate-400">
                        Pilih guru dan mata pelajaran yang akan ditambahkan.
                    </p>

                </div>

            </div>

        </div>


        {{-- ========================================================
             FORM
        ========================================================= --}}
        <form method="POST"
              action="{{ route('admin.guruKelas.storeMapel') }}"
              id="mapelForm"
              class="p-6 sm:p-8 space-y-6">

            @csrf


            {{-- ====================================================
                 PILIH GURU
            ==================================================== --}}
            <div class="space-y-1.5">

                <label for="id_user"
                       class="block text-xs font-bold
                              text-slate-700
                              uppercase tracking-wider">

                    Guru

                    <span class="text-red-500">
                        *
                    </span>

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
                                   transition-all">

                        <option value="">
                            -- Pilih Guru --
                        </option>


                        @foreach ($guru as $item)

                            <option value="{{ $item->id }}"
                                {{ old('id_user') == $item->id ? 'selected' : '' }}>

                                {{ $item->name }}

                                @if ($item->nip)
                                    — NIP {{ $item->nip }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                <p class="text-xs text-slate-400 mt-1">
                    Pilih guru yang akan diberikan mata pelajaran.
                </p>


                @error('id_user')

                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- ====================================================
                 MATA PELAJARAN
            ==================================================== --}}
            <div class="space-y-2">

                <div class="flex items-center justify-between">

                    <label class="block text-xs font-bold
                                  text-slate-700
                                  uppercase tracking-wider">

                        Mata Pelajaran

                        <span class="text-red-500">
                            *
                        </span>

                    </label>


                    <span id="jumlahTerpilih"
                          class="text-xs font-semibold
                                 text-orange-600">

                        0 dipilih

                    </span>

                </div>


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}
                @if ($mataPelajaran->isEmpty())

                    <div class="p-6 rounded-xl
                                border border-dashed
                                border-slate-300
                                bg-slate-50
                                text-center">

                        <div class="w-12 h-12 mx-auto
                                    rounded-xl
                                    bg-slate-100
                                    text-slate-400
                                    flex items-center
                                    justify-center">

                            <i data-lucide="book-x"
                               class="w-6 h-6">
                            </i>

                        </div>

                        <p class="text-sm font-semibold
                                  text-slate-600 mt-3">

                            Belum ada mata pelajaran

                        </p>

                        <p class="text-xs text-slate-400 mt-1">

                            Tambahkan mata pelajaran terlebih dahulu.

                        </p>

                    </div>

                @else

                    <div id="mapelContainer"
                         class="grid grid-cols-1
                                sm:grid-cols-2
                                gap-3">


                        @foreach ($mataPelajaran as $mapel)

                            <label class="mapel-item group
                                          relative flex items-center gap-3
                                          p-4 rounded-xl
                                          border border-slate-200
                                          bg-slate-50
                                          hover:border-orange-300
                                          hover:bg-orange-50/50
                                          transition-all cursor-pointer">


                                {{-- CHECKBOX --}}

                                <input type="checkbox"
                                       name="id_mata_pelajaran[]"
                                       value="{{ $mapel->id }}"
                                       data-mapel-id="{{ $mapel->id }}"
                                       data-mapel-kode="{{ $mapel->kode }}"
                                       data-mapel-name="{{ $mapel->name }}"
                                       class="mapel-checkbox
                                              w-4 h-4
                                              rounded
                                              border-slate-300
                                              text-orange-500
                                              focus:ring-orange-500">


                                <div class="flex-1 min-w-0">

                                    <div class="flex items-center gap-2">

                                        <span class="inline-flex
                                                     items-center
                                                     px-2 py-1
                                                     rounded-lg
                                                     bg-orange-100
                                                     text-orange-700
                                                     text-[10px]
                                                     font-bold">

                                            {{ $mapel->kode }}

                                        </span>

                                    </div>


                                    <p class="text-sm font-semibold
                                              text-slate-700 mt-1">

                                        {{ $mapel->name }}

                                    </p>

                                </div>


                                {{-- STATUS SUDAH ADA --}}

                                <span class="mapel-status hidden
                                             shrink-0
                                             px-2 py-1
                                             rounded-lg
                                             bg-slate-200
                                             text-slate-500
                                             text-[10px]
                                             font-bold">

                                    SUDAH ADA

                                </span>

                            </label>

                        @endforeach

                    </div>

                @endif


                @error('id_mata_pelajaran')

                    <p class="text-xs text-red-500 mt-1">
                        {{ $message }}
                    </p>

                @enderror


                <p id="mapelHelp"
                   class="text-xs text-slate-400 mt-1">

                    Pilih satu atau beberapa mata pelajaran.

                </p>

            </div>


            {{-- ====================================================
                 INFORMATION
            ==================================================== --}}
            <div class="p-4 rounded-xl
                        bg-amber-50
                        border border-amber-200
                        flex items-start gap-3
                        text-amber-900">

                <i data-lucide="info"
                   class="w-5 h-5
                          text-amber-600
                          shrink-0 mt-0.5">
                </i>

                <p class="text-xs leading-relaxed">

                    Mata pelajaran yang sudah dimiliki oleh guru
                    akan otomatis ditandai sebagai
                    <strong>Sudah Ada</strong> dan tidak dapat
                    dipilih kembali.

                </p>

            </div>


            {{-- ====================================================
                 PREVIEW
            ==================================================== --}}
            <div id="mapelPreview"
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

                        <p class="text-[11px]
                                  font-bold
                                  uppercase
                                  tracking-wider
                                  text-orange-600">

                            Ringkasan Penugasan

                        </p>


                        <p id="previewGuru"
                           class="text-sm
                                  font-semibold
                                  text-slate-700
                                  mt-1">

                            Pilih guru terlebih dahulu.

                        </p>


                        <div id="previewMapel"
                             class="flex flex-wrap gap-2 mt-3">
                        </div>

                    </div>

                </div>

            </div>


            {{-- ====================================================
                 ACTION
            ==================================================== --}}
            <div class="pt-4
                        border-t border-slate-100
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

                    Reset Form

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

                    Simpan Mata Pelajaran

                </button>

            </div>

        </form>

    </div>

</main>


{{-- ================================================================
     LUCIDE
================================================================ --}}
<script src="https://unpkg.com/lucide@latest"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    lucide.createIcons();


    /* ============================================================
       DATA MAPEL YANG SUDAH DIMILIKI SETIAP GURU
    ============================================================ */

    const guruMapel = @json($guruMapel);


    /* ============================================================
       ELEMENT
    ============================================================ */

    const guruSelect =
        document.getElementById('id_user');

    const mapelCheckboxes =
        document.querySelectorAll('.mapel-checkbox');

    const jumlahTerpilih =
        document.getElementById('jumlahTerpilih');

    const mapelPreview =
        document.getElementById('mapelPreview');

    const previewGuru =
        document.getElementById('previewGuru');

    const previewMapel =
        document.getElementById('previewMapel');

    const resetButton =
        document.getElementById('resetButton');

    const form =
        document.getElementById('mapelForm');


    /* ============================================================
       UPDATE STATUS MAPEL BERDASARKAN GURU
    ============================================================ */

    function updateMapelGuru() {

        if (!guruSelect) {
            return;
        }


        const guruId =
            guruSelect.value;


        /*
        | Ambil daftar mapel yang sudah dimiliki guru
        */
        const sudahAda =
            guruMapel[guruId] || [];


        mapelCheckboxes.forEach(
            function (checkbox) {

                const mapelId =
                    Number(
                        checkbox.dataset.mapelId
                    );


                const label =
                    checkbox.closest(
                        '.mapel-item'
                    );


                const status =
                    label.querySelector(
                        '.mapel-status'
                    );


                /*
                | Jika mapel sudah dimiliki
                */
                if (
                    sudahAda.includes(
                        mapelId
                    )
                ) {

                    checkbox.checked = false;

                    checkbox.disabled = true;


                    status.classList.remove(
                        'hidden'
                    );


                    label.classList.add(
                        'opacity-60',
                        'cursor-not-allowed',
                        'bg-slate-100'
                    );


                    label.classList.remove(
                        'hover:border-orange-300',
                        'hover:bg-orange-50/50'
                    );


                } else {

                    checkbox.disabled = false;


                    status.classList.add(
                        'hidden'
                    );


                    label.classList.remove(
                        'opacity-60',
                        'cursor-not-allowed',
                        'bg-slate-100'
                    );


                    label.classList.add(
                        'hover:border-orange-300',
                        'hover:bg-orange-50/50'
                    );

                }

            }
        );


        updatePreview();

    }


    /* ============================================================
       UPDATE PREVIEW
    ============================================================ */

    function updatePreview() {

        if (!guruSelect) {
            return;
        }


        const guruId =
            guruSelect.value;


        const selectedOption =
            guruSelect.options[
                guruSelect.selectedIndex
            ];


        const guruName =
            selectedOption
                ? selectedOption.text.trim()
                : '';


        const selected =
            Array.from(
                mapelCheckboxes
            ).filter(
                function (checkbox) {

                    return checkbox.checked;

                }
            );


        /*
        | Jumlah
        */
        if (jumlahTerpilih) {

            jumlahTerpilih.textContent =
                selected.length +
                ' dipilih';

        }


        /*
        | Belum lengkap
        */
        if (
            !guruId ||
            selected.length === 0
        ) {

            if (mapelPreview) {

                mapelPreview.classList.add(
                    'hidden'
                );

            }

            return;

        }


        /*
        | Nama guru
        */
        if (previewGuru) {

            previewGuru.textContent =
                guruName;

        }


        /*
        | Bersihkan preview
        */
        if (previewMapel) {

            previewMapel.innerHTML = '';

        }


        /*
        | Buat badge mapel
        */
        selected.forEach(
            function (checkbox) {

                const kode =
                    checkbox.dataset.mapelKode;

                const nama =
                    checkbox.dataset.mapelName;


                const badge =
                    document.createElement(
                        'span'
                    );


                badge.className =
                    'inline-flex items-center gap-1.5 ' +
                    'px-2.5 py-1.5 rounded-lg ' +
                    'bg-white border border-orange-200 ' +
                    'text-orange-700 text-xs font-semibold';


                const kodeSpan =
                    document.createElement(
                        'span'
                    );

                kodeSpan.className =
                    'font-bold';

                kodeSpan.textContent =
                    kode;


                const separator =
                    document.createElement(
                        'span'
                    );

                separator.className =
                    'text-slate-300';

                separator.textContent =
                    '•';


                const namaSpan =
                    document.createElement(
                        'span'
                    );

                namaSpan.textContent =
                    nama;


                badge.appendChild(
                    kodeSpan
                );

                badge.appendChild(
                    separator
                );

                badge.appendChild(
                    namaSpan
                );


                previewMapel.appendChild(
                    badge
                );

            }
        );


        mapelPreview.classList.remove(
            'hidden'
        );

    }


    /* ============================================================
       KETIKA GURU DIGANTI
    ============================================================ */

    if (guruSelect) {

        guruSelect.addEventListener(
            'change',
            function () {

                /*
                | Reset semua pilihan mapel
                */
                mapelCheckboxes.forEach(
                    function (checkbox) {

                        checkbox.checked = false;

                    }
                );


                updateMapelGuru();

            }
        );

    }


    /* ============================================================
       CHECKBOX MAPEL
    ============================================================ */

    mapelCheckboxes.forEach(
        function (checkbox) {

            checkbox.addEventListener(
                'change',
                function () {

                    updatePreview();

                }
            );

        }
    );


    /* ============================================================
       RESET FORM
    ============================================================ */

    if (resetButton) {

        resetButton.addEventListener(
            'click',
            function () {

                /*
                | Reset guru
                */
                if (guruSelect) {

                    guruSelect.value = '';

                }


                /*
                | Reset checkbox
                */
                mapelCheckboxes.forEach(
                    function (checkbox) {

                        checkbox.checked = false;

                        checkbox.disabled = false;


                        const label =
                            checkbox.closest(
                                '.mapel-item'
                            );


                        const status =
                            label.querySelector(
                                '.mapel-status'
                            );


                        status.classList.add(
                            'hidden'
                        );


                        label.classList.remove(
                            'opacity-60',
                            'cursor-not-allowed',
                            'bg-slate-100'
                        );


                        label.classList.add(
                            'hover:border-orange-300',
                            'hover:bg-orange-50/50'
                        );

                    }
                );


                /*
                | Reset jumlah
                */
                if (jumlahTerpilih) {

                    jumlahTerpilih.textContent =
                        '0 dipilih';

                }


                /*
                | Reset preview
                */
                if (mapelPreview) {

                    mapelPreview.classList.add(
                        'hidden'
                    );

                }


                /*
                | Fokus guru
                */
                if (guruSelect) {

                    guruSelect.focus();

                }

            }
        );

    }


    /* ============================================================
       VALIDASI SEBELUM SUBMIT
    ============================================================ */

    if (form) {

        form.addEventListener(
            'submit',
            function (event) {

                const guruId =
                    guruSelect
                        ? guruSelect.value
                        : '';


                const selected =
                    Array.from(
                        mapelCheckboxes
                    ).filter(
                        function (checkbox) {

                            return checkbox.checked;

                        }
                    );


                /*
                | Guru belum dipilih
                */
                if (!guruId) {

                    event.preventDefault();


                    alert(
                        'Silakan pilih guru terlebih dahulu.'
                    );


                    if (guruSelect) {

                        guruSelect.focus();

                    }

                    return;

                }


                /*
                | Mapel belum dipilih
                */
                if (selected.length === 0) {

                    event.preventDefault();


                    alert(
                        'Silakan pilih minimal satu mata pelajaran.'
                    );

                    return;

                }

            }
        );

    }


    /* ============================================================
       ERROR NOTIFICATION
    ============================================================ */

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
            5000
        );

    }


    /* ============================================================
       ERROR PROGRESS
    ============================================================ */

    const notificationProgress =
        document.getElementById(
            'notificationProgress'
        );


    if (notificationProgress) {

        notificationProgress.style.transition =
            'width 5s linear';


        setTimeout(
            function () {

                notificationProgress.style.width =
                    '0%';

            },
            50
        );

    }


    /* ============================================================
       SUCCESS NOTIFICATION
    ============================================================ */

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


    /* ============================================================
       OLD INPUT
       Supaya ketika validasi gagal, mapel yang sebelumnya
       dipilih tetap dicentang jika masih valid.
    ============================================================ */

    const oldMapel =
        @json(old('id_mata_pelajaran', []));


    if (
        Array.isArray(oldMapel) &&
        oldMapel.length > 0
    ) {

        mapelCheckboxes.forEach(
            function (checkbox) {

                const id =
                    String(
                        checkbox.value
                    );


                if (
                    oldMapel
                        .map(String)
                        .includes(id)
                ) {

                    checkbox.checked = true;

                }

            }
        );

    }


    /* ============================================================
       INITIAL STATE
    ============================================================ */

    updateMapelGuru();

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


#mapelPreview {

    animation:
        slideIn
        0.25s
        ease-out;

}


/* ================================================================
   CHECKBOX TERPILIH
================================================================ */

.mapel-item:has(
    input:checked
) {

    border-color:
        rgb(251 146 60);

    background-color:
        rgb(255 247 237);

}


/* ================================================================
   MAPEL DISABLED
================================================================ */

.mapel-item:has(
    input:disabled
) {

    user-select: none;

}

</style>

@endsection