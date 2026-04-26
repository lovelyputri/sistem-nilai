@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Nilai</h2>

    <p><strong>Siswa:</strong> {{ $nilai->siswa->nama }}</p>
    <p><strong>Mapel:</strong> {{ $nilai->mataPelajaran->nama }}</p>

    <form action="{{ route('guru.nilai.update', $nilai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="number" name="nilai" value="{{ $nilai->nilai }}">

        <button type="submit">Update</button>
    </form>
</div>
@endsection