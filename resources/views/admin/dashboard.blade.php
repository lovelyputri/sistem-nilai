<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Admin</h2>

<h3>Statistik</h3>
<ul>
    <li>Total Guru: {{ $statistik['total_guru'] }}</li>
    <li>Total Mata Pelajaran: {{ $statistik['total_mata_pelajaran'] }}</li>
    <li>Total Siswa: {{ $statistik['total_siswa'] }}</li>
    <li>Total Nilai: {{ $statistik['total_nilai'] }}</li>
</ul>

<h3>5 Siswa Terbaru</h3>
<table border="1">
    <tr>
        <th>Nama</th>
        <th>Nilai</th>
    </tr>
    @foreach($siswa as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>
                @foreach($s->nilai as $n)
                    {{ $n->nilai }} ({{ $n->mataPelajaran->name ?? $n->mataPelajaran->nama }})<br>
                @endforeach
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>