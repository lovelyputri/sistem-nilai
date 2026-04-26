<h2>Detail Nilai: {{ $siswa->name }}</h2>

<p>Rata-rata: {{ $rataRata }}</p>

<h3>Nilai:</h3>
<ul>
@foreach($siswa->nilai as $n)
    <li>
        {{ $n->mataPelajaran->name ?? $n->mataPelajaran->nama }}
        : {{ $n->nilai }}
    </li>
@endforeach
</ul>

<h3>Belum Diisi:</h3>
<ul>
@foreach($mataPelajaranBelumDiisi as $m)
    <li>{{ $m->name ?? $m->nama }}</li>
@endforeach
</ul>