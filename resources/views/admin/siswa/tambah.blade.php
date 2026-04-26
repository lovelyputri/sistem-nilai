<h2>Tambah Siswa</h2>

<form method="POST" action="{{ route('admin.siswa.store') }}">
@csrf

Nama: <input type="text" name="name"><br>
NIS: <input type="text" name="nis"><br>
Kelas: <input type="text" name="kelas"><br>

<button type="submit">Simpan</button>
</form>