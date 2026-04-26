@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Nilai</h2>

    <p><strong>Mapel:</strong> {{ $mataPelajaran->nama }}</p>

    <form action="{{ route('guru.nilai.selectClass') }}" method="POST">
        @csrf
        <select name="kelas">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($daftarKelas as $kelas)
                <option value="{{ $kelas }}">{{ $kelas }}</option>
            @endforeach
        </select>
        <button type="submit">Tampilkan</button>
    </form>

    <hr>

    @isset($siswa)
    <table border="1" cellpadding="8">
        <tr>
            <th>Nama</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>

        @foreach ($siswa as $s)
        <tr>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->nilai->first()->nilai ?? '-' }}</td>
            <td>
                <form action="{{ route('guru.nilai.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_siswa" value="{{ $s->id }}">
                    <input type="number" name="nilai" placeholder="0-100">
                    <button type="submit">Simpan</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    @endisset
</div>
@endsection