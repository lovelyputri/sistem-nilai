<h2>Edit Siswa</h2>

<form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}">
@csrf
@method('PUT')

Nama: <input type="text" name="name" value="{{ $siswa->name }}"><br>
NIS: <input type="text" name="nis" value="{{ $siswa->nis }}"><br>
Kelas: <input type="text" name="kelas" value="{{ $siswa->kelas }}"><br>

<button type="submit">Update</button>
</form>