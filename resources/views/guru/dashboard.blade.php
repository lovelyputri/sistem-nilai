@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Guru</h2>

    <div>
        <p><strong>Nama:</strong> {{ $guru->name }}</p>
        <p><strong>Mata Pelajaran:</strong> {{ $mataPelajaran->nama ?? '-' }}</p>
    </div>

    <hr>

    <div>
        <p>Total Siswa: {{ $totalSiswa }}</p>
        <p>Nilai Diinput: {{ $sudahDiinput }}</p>
    </div>

    <hr>

    <h4>Nilai Terbaru</h4>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nama Siswa</th>
            <th>Mapel</th>
            <th>Nilai</th>
        </tr>

        @foreach ($nilaiDiinput as $n)
        <tr>
            <td>{{ $n->siswa->nama }}</td>
            <td>{{ $n->mataPelajaran->nama }}</td>
            <td>{{ $n->nilai }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection