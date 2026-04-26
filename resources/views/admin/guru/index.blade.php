<h2>Data Guru</h2>

<a href="{{ route('admin.guru.create') }}">Tambah Guru</a>

<p>Menunggu Konfirmasi: {{ $waitingTeacher }}</p>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($guru as $g)
<tr>
    <td>{{ $g->name }}</td>
    <td>{{ $g->email }}</td>
    <td>{{ $g->status }}</td>
    <td>
        <a href="{{ route('admin.guru.edit', $g->id) }}">Edit</a>

        <form method="POST" action="{{ route('admin.guru.destroy', $g->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>

        @if($g->status == 'menunggu')
            <a href="{{ route('admin.guru.confirm', $g->id) }}">Terima</a>
            <a href="{{ route('admin.guru.reject', $g->id) }}">Tolak</a>
        @endif
    </td>
</tr>
@endforeach
</table>