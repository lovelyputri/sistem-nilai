<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">


<title>Rapor - {{ $siswa->name }}</title>

<style>
    @page {
        size: A4 portrait;
        margin: 24px 30px 28px 30px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        color: #263238;
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
    }

    .watermark {
        position: fixed;
        top: 31%;
        left: 0;
        width: 100%;
        z-index: 0;
        text-align: center;
    }

    .watermark img {
        width: 285px;
        height: 285px;
        opacity: 0.055;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    /* =========================================================
       KOP SEKOLAH
    ========================================================= */

    .kop {
        width: 100%;
        margin-bottom: 16px;
        text-align: center;
    }

    .logo-header {
        width: 63px;
        height: 63px;
        margin-bottom: 5px;
    }

    .school-name {
        color: #9a3412;
        font-size: 17px;
        font-weight: bold;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .school-subtitle {
        margin-top: 4px;
        color: #475569;
        font-size: 9.5px;
        font-weight: bold;
        letter-spacing: 0.2px;
        text-transform: uppercase;
    }

    .report-title {
        margin-top: 7px;
        color: #111827;
        font-size: 14px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .kop-line {
        margin-top: 9px;
        border-bottom: 2px solid #9a3412;
    }

    .kop-line-thin {
        margin-top: 2px;
        border-bottom: 1px solid #d6d3d1;
    }

    /* =========================================================
       IDENTITAS
    ========================================================= */

    .identity-wrapper {
        width: 100%;
        margin-top: 14px;
        margin-bottom: 17px;
    }

    .identity-title,
    .section-title {
        margin-bottom: 8px;
        padding-bottom: 4px;
        border-bottom: 2px solid #ea580c;
        color: #9a3412;
        font-size: 11px;
        font-weight: bold;
    }

    .identity-table {
        width: 100%;
        border-collapse: collapse;
    }

    .identity-table td {
        padding: 4px 5px;
        vertical-align: top;
    }

    .identity-label {
        width: 18%;
        color: #475569;
        font-weight: bold;
    }

    .identity-colon {
        width: 2%;
        color: #9a3412;
        font-weight: bold;
        text-align: center;
    }

    .identity-value {
        width: 30%;
        color: #111827;
    }

    .identity-label-right {
        width: 18%;
        color: #475569;
        font-weight: bold;
    }

    .identity-value-right {
        width: 32%;
        color: #111827;
    }

    /* =========================================================
       TABEL NILAI
    ========================================================= */

    .nilai-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .nilai-table th {
        padding: 7px 5px;
        border: 1px solid #cbd5e1;
        background-color: #fff7ed;
        color: #9a3412;
        font-size: 8.8px;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }

    .nilai-table td {
        padding: 7px 5px;
        border: 1px solid #cbd5e1;
        background-color: rgba(255, 255, 255, 0.94);
        color: #181c22;
        font-size: 8.8px;
        font-weight: normal;
        vertical-align: middle;
    }

    .nilai-table tbody tr:nth-child(even) td {
        background-color: #fafafa;
    }

    .nilai-table .no {
        width: 6%;
        text-align: center;
    }

    .nilai-table .mapel {
        width: 25%;
    }

    .nilai-table .nilai {
        width: 11%;
        text-align: center;
    }

    .nilai-table .predikat {
        width: 12%;
        text-align: center;
    }

    .nilai-table .deskripsi {
        width: 46%;
        line-height: 1.45;
        text-align: left;
    }

    .nilai-table tr {
        page-break-inside: avoid;
    }

    .nilai-kosong {
        color: #94a3b8;
    }

    /* =========================================================
       RINGKASAN
    ========================================================= */

    .summary-wrapper {
        width: 100%;
        margin-top: 16px;
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .summary-table td {
        padding: 8px 7px;
        border: 1px solid #cbd5e1;
    }

    .summary-label {
        width: 25%;
        background-color: #fff7ed;
        color: #9a3412;
        font-weight: bold;
    }

    .summary-value {
        width: 25%;
        background-color: #ffffff;
        color: #111827;
        font-weight: bold;
        text-align: center;
    }

    /* =========================================================
       CATATAN
    ========================================================= */

    .note {
        margin-top: 11px;
        padding: 7px 9px;
        border-left: 3px solid #ea580c;
        background-color: #fff7ed;
        color: #64748b;
        font-size: 8.5px;
        line-height: 1.5;
    }

    .note strong {
        color: #9a3412;
    }

    /* =========================================================
       TANDA TANGAN
    ========================================================= */

    .signature-wrapper {
        width: 100%;
        margin-top: 36px;
        page-break-inside: avoid;
    }

    .signature-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .signature-table td {
        padding: 0 15px;
        border: none;
        color: #475569;
        text-align: center;
        vertical-align: top;
    }

    .signature-top {
        width: 50%;
    }

    .signature-bottom {
        width: 100%;
        padding-top: 27px !important;
    }

    .signature-role {
        margin-top: 3px;
        color: #1e293b;
        font-weight: bold;
    }

    .signature-space {
        height: 60px;
    }

    .signature-name {
        color: #111827;
        font-weight: bold;
        text-decoration: underline;
        white-space: nowrap;
    }

    /* =========================================================
       FOOTER
    ========================================================= */

    .footer {
        margin-top: 18px;
        padding-top: 6px;
        border-top: 1px solid #e2e8f0;
        color: #94a3b8;
        font-size: 7.5px;
        text-align: center;
    }
</style>

</head>

<body>

@php
    $logoPath = public_path('public/images/SMUHERO_logo.png');

    $logoBase64 = null;

    if (file_exists($logoPath)) {
        $logoBase64 =
            'data:image/png;base64,' .
            base64_encode(file_get_contents($logoPath));
    }
@endphp

@if ($logoBase64)
    <div class="watermark">
        <img
            src="{{ $logoBase64 }}"
            alt="Watermark Logo"
        >
    </div>
@endif


<div class="content">

    {{-- KOP SEKOLAH --}}

    <div class="kop">

        @if ($logoBase64)
            <img
                src="{{ $logoBase64 }}"
                alt="Logo SMK Muhammadiyah 6 Rogojampi"
                class="logo-header"
            >
        @endif

        <div class="school-name">
            SMK MUHAMMADIYAH 6 ROGOJAMPI
        </div>

        <div class="school-subtitle">
            LAPORAN HASIL BELAJAR PESERTA DIDIK
        </div>

        <div class="report-title">
            RAPOR
        </div>

        <div class="kop-line"></div>
        <div class="kop-line-thin"></div>

    </div>


    {{-- IDENTITAS SISWA --}}

    <div class="identity-wrapper">

        <div class="identity-title">
            A. IDENTITAS PESERTA DIDIK
        </div>

        <table class="identity-table">

            <tr>
                <td class="identity-label">Nama</td>
                <td class="identity-colon">:</td>
                <td class="identity-value">
                    {{ $siswa->name ?? '-' }}
                </td>

                <td class="identity-label-right">NIS</td>
                <td class="identity-colon">:</td>
                <td class="identity-value-right">
                    {{ $siswa->nis ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="identity-label">NISN</td>
                <td class="identity-colon">:</td>
                <td class="identity-value">
                    {{ $siswa->nisn ?? '-' }}
                </td>

                <td class="identity-label-right">Kelas</td>
                <td class="identity-colon">:</td>
                <td class="identity-value-right">
                    {{ $siswa->kelas ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="identity-label">Jurusan</td>
                <td class="identity-colon">:</td>
                <td class="identity-value">
                    {{ $siswa->jurusan ?? '-' }}
                </td>

                <td class="identity-label-right">Tahun Masuk</td>
                <td class="identity-colon">:</td>
                <td class="identity-value-right">
                    {{ $siswa->tahun_masuk ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="identity-label">
                    Tempat, Tanggal Lahir
                </td>

                <td class="identity-colon">:</td>

                <td class="identity-value">

                    @if ($siswa->tempat_lahir)
                        {{ $siswa->tempat_lahir }},
                    @endif

                    @if ($siswa->tanggal_lahir)
                        {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}
                    @else
                        -
                    @endif

                </td>

                <td class="identity-label-right">
                    Agama
                </td>

                <td class="identity-colon">:</td>

                <td class="identity-value-right">
                    {{ $siswa->agama ?? '-' }}
                </td>
            </tr>

            <tr>
                <td class="identity-label">
                    Alamat
                </td>

                <td class="identity-colon">:</td>

                <td
                    class="identity-value"
                    colspan="4"
                >
                    {{ $siswa->alamat ?? '-' }}
                </td>
            </tr>

        </table>

    </div>


    {{-- HASIL BELAJAR --}}

    <div class="section-title">
        B. HASIL BELAJAR
    </div>

    <table class="nilai-table">

        <thead>

            <tr>

                <th class="no">
                    No
                </th>

                <th class="mapel">
                    Mata Pelajaran
                </th>

                <th class="nilai">
                    Nilai
                </th>

                <th class="predikat">
                    Predikat
                </th>

                <th class="deskripsi">
                    Deskripsi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse ($dataNilai as $index => $item)

                <tr>

                    <td class="no">
                        {{ $index + 1 }}
                    </td>

                    <td class="mapel">
                        {{ $item['mata_pelajaran'] ?? '-' }}
                    </td>

                    <td class="nilai">

                        @if ($item['nilai'] !== null)
                            {{ $item['nilai'] }}
                        @else
                            <span class="nilai-kosong">
                                -
                            </span>
                        @endif

                    </td>

                    <td class="predikat">
                        {{ $item['predikat'] ?? '-' }}
                    </td>

                    <td class="deskripsi">
                        {{ $item['deskripsi'] ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="5"
                        style="padding: 15px; text-align: center;"
                    >
                        Belum terdapat data mata pelajaran.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- RINGKASAN NILAI --}}

    <div class="summary-wrapper">

        <div class="section-title">
            C. RINGKASAN NILAI
        </div>

        <table class="summary-table">

            <tr>

                <td class="summary-label">
                    Rata-rata Nilai
                </td>

                <td class="summary-value">
                    {{ $rataRata !== null
                        ? number_format($rataRata, 2, ',', '.')
                        : '-' }}
                </td>

                <td class="summary-label">
                    Jumlah Mata Pelajaran
                </td>

                <td class="summary-value">
                    {{ $dataNilai->count() }}
                </td>

            </tr>

        </table>

    </div>


    {{-- CATATAN --}}

    <div class="note">

        <strong>Catatan:</strong>

        Nilai pada rapor merupakan nilai yang telah diberikan
        oleh guru mata pelajaran. Predikat dan deskripsi hasil
        belajar ditampilkan berdasarkan data yang telah dibuat
        oleh guru.

    </div>


    {{-- TANDA TANGAN --}}

    <div class="signature-wrapper">

        <table class="signature-table">

            <tr>

                <td class="signature-top">

                    <div>
                        Mengetahui,
                    </div>

                    <div class="signature-role">
                        Orang Tua/Wali Murid
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-name">
                        ______________________
                    </div>

                </td>


                <td class="signature-top">

                    <div>
                        Mengetahui,
                    </div>

                    <div class="signature-role">
                        Wali Kelas
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-name">
                        ______________________
                    </div>

                </td>

            </tr>


            <tr>

                <td
                    colspan="2"
                    class="signature-bottom"
                >

                    <div>
                        Mengetahui,
                    </div>

                    <div class="signature-role">
                        Kepala Sekolah
                    </div>

                    <div class="signature-space"></div>

                    <div class="signature-name">
                        ______________________
                    </div>

                </td>

            </tr>

        </table>

    </div>


    {{-- FOOTER --}}

    <div class="footer">
        Dokumen ini dibuat melalui sistem EDUGRADES —
        SMK MUHAMMADIYAH 6 ROGOJAMPI
    </div>

</div>


</body>

</html>
