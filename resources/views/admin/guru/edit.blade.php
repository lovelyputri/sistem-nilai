<h2>Edit Guru</h2>

<form method="POST" action="{{ route('admin.guru.update', $guru->id) }}">
@csrf
@method('PUT')

Nama: 
<input type="text" name="name" value="{{ $guru->name }}"><br>

Email: 
<input type="email" name="email" value="{{ $guru->email }}"><br>

NIP: 
<input type="text" name="nip" value="{{ $guru->nip }}"><br>

Password (opsional): 
<input type="password" name="password"><br>

Konfirmasi Password: 
<input type="password" name="password_confirmation"><br>

Mata Pelajaran:
<select name="id_mata_pelajaran">
    @foreach($mataPelajaran as $m)
        <option value="{{ $m->id }}"
            {{ $guru->mataPelajaran->contains($m->id) ? 'selected' : '' }}>
            {{ $m->name ?? $m->nama }}
        </option>
    @endforeach
</select>

<br><br>
<button type="submit">Update</button>
</form>