<h2>Tambah Guru</h2>

<form method="POST" action="{{ route('admin.guru.store') }}">
@csrf

Nama: <input type="text" name="name"><br>
Email: <input type="email" name="email"><br>
NIP: <input type="text" name="nip"><br>
Password: <input type="password" name="password"><br>
Konfirmasi: <input type="password" name="password_confirmation"><br>

Mata Pelajaran:
<select name="id_mata_pelajaran">
    @foreach($mataPelajaran as $m)
        <option value="{{ $m->id }}">{{ $m->name ?? $m->nama }}</option>
    @endforeach
</select>

<button type="submit">Simpan</button>
</form>