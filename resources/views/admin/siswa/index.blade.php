<h2>Data Siswa</h2>

<a href="{{ route('admin.siswa.create') }}">Tambah</a>

<table border="1">
<tr>
    <th>Nama</th>
    <th>NIS</th>
    <th>Kelas</th>
    <th>Aksi</th>
</tr>

@foreach($siswa as $s)
<tr>
    <td>{{ $s->name }}</td>
    <td>{{ $s->nis }}</td>
    <td>{{ $s->kelas }}</td>
    <td>
        <a href="{{ route('admin.siswa.edit', $s->id) }}">Edit</a>

        <form method="POST" action="{{ route('admin.siswa.destroy', $s->id) }}">
            @csrf
            @method('DELETE')
            <button>Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>