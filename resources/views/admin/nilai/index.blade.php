<h2>Data Nilai</h2>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Rata-rata</th>
    <th>Aksi</th>
</tr>

@foreach($siswa as $s)
<tr>
    <td>{{ $s['nama'] }}</td>
    <td>{{ $s['kelas'] }}</td>
    <td>{{ $s['rata-rata'] }}</td>
    <td>
        <a href="{{ route('admin.nilai.show', $s['id']) }}">Detail</a>
    </td>
</tr>
@endforeach
</table>