<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

    <h2>Register Guru</h2>

    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register.proses') }}">
        @csrf

        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>NIP:</label><br>
        <input type="text" name="nip" value="{{ old('nip') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <label>Mata Pelajaran:</label><br>
        <select name="id_mata_pelajaran">
            <option value="">-- Pilih --</option>
            @foreach($mataPelajaran as $mapel)
                <option value="{{ $mapel->id }}">
                    {{ $mapel->name ?? $mapel->name }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Daftar</button>
    </form>

    <br>
    <a href="{{ route('login') }}">Login</a>

</body>
</html>