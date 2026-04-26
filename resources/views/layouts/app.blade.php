<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Nilai')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- CSS sederhana --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }
        .navbar {
            background: #2c2c2c;
            color: white;
            padding: 15px;
        }
        .container {
            padding: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .btn {
            background: #8B5E3C;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover {
            background: #6f472d;
        }
        .alert {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }
        .alert-success {
            background: #d4edda;
        }
        .alert-error {
            background: #f8d7da;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <strong>Sistem Nilai</strong>
    </div>

    <div class="container">
        
        {{-- Notifikasi --}}
        @if(session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Konten --}}
        @yield('content')

    </div>

</body>
</html>