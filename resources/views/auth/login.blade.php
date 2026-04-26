<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Nilai Guru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #EA580C; /* Soft Orange darkish */
            --primary-light: #F97316; 
            --white: #FFFFFF;
            --text-dark: #431407; 
            --text-muted: #9A3412;
            --border: #FED7AA;
            --input-bg: #FFFFFF;
        }
        body { font-family: 'Roboto', sans-serif; background: var(--white); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }
        .container { display: flex; min-height: 100vh; width: 100%; position: relative; }
        
        /* IMAGE PANEL - Soft Orange */
        .image-panel {
            width: 50%;
            background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 3rem; position: relative; overflow: hidden;
            /* Animation from Right (100%) to Left (0) */
            animation: slideToLeft 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            z-index: 2;
        }
        
        @keyframes slideToLeft {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        /* Abstract Floating Shapes (Effects/Icons) */
        .bg-shape {
            position: absolute; opacity: 0.15; pointer-events: none;
            color: var(--primary); z-index: 1;
        }
        .shape-1 { top: 15%; left: 15%; width: 80px; height: 80px; animation: floatAnim 6s ease-in-out infinite; }
        .shape-2 { bottom: 10%; right: 10%; width: 120px; height: 120px; animation: floatAnim 8s ease-in-out infinite reverse; }
        .shape-3 { top: 25%; right: 15%; width: 60px; height: 60px; animation: floatAnim 5s ease-in-out infinite 1s; opacity: 0.2; }
        .shape-4 { bottom: 25%; left: 10%; width: 50px; height: 50px; animation: floatAnim 7s ease-in-out infinite 2s; }

        @keyframes floatAnim {
            0% { transform: translateY(0px) rotate(0deg) scale(1); }
            50% { transform: translateY(-20px) rotate(10deg) scale(1.05); }
            100% { transform: translateY(0px) rotate(0deg) scale(1); }
        }

        .brand { position: absolute; top: 3rem; left: 3rem; display: flex; align-items: center; gap: 1rem; z-index: 2; }
        .brand-icon {
            width: 44px; height: 44px; background: rgba(234, 88, 12, 0.1); border-radius: 12px;
            display: flex; justify-content: center; align-items: center; backdrop-filter: blur(10px); border: 1px solid rgba(234, 88, 12, 0.2);
        }
        .brand-icon svg { width: 22px; height: 22px; stroke: var(--primary); }
        .brand-text { display: flex; flex-direction: column; line-height: 1.2; }
        .brand-text span:first-child { font-size: 13px; font-weight: 700; color: var(--primary); letter-spacing: 1px; text-transform: uppercase;}
        .brand-text span:last-child { font-size: 15px; font-weight: 700; color: var(--text-dark); }
        
        .illustration { width: 100%; max-width: 460px; display: block; margin: 0 auto; z-index: 2; position: relative; filter: drop-shadow(0 15px 25px rgba(234,88,12,0.15)); mix-blend-mode: multiply; }
        
        .hero-text { text-align: center; margin-top: 3rem; z-index: 2; position: relative;}
        .hero-text h1 { font-size: 28px; font-weight: 700; color: var(--text-dark); margin-bottom: 0.5rem; letter-spacing: -0.5px;}
        .hero-text p { font-size: 15px; color: #9A3412; font-weight: 400; opacity: 0.9;}

        /* RIGHT PANEL: FORM */
        .form-panel {
            width: 50%; display: flex; justify-content: center; align-items: center; padding: 2rem;
            position: relative; background: var(--white); z-index: 1;
            /* Animation from Left (-100%) to Right (0) */
            animation: slideToRight 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        @keyframes slideToRight {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        .form-container { width: 100%; max-width: 400px; }
        
        .tabs { display: flex; gap: 8px; background: #FFF7ED; padding: 6px; border-radius: 14px; margin-bottom: 2.5rem; border: 1px solid #FFEDD5; }
        .tab {
            flex: 1; text-align: center; padding: 10px 16px; border-radius: 10px; font-size: 14px; font-weight: 600;
            color: var(--text-muted); text-decoration: none; transition: all 0.3s ease;
        }
        .tab:hover { color: var(--text-dark); }
        .tab.active { background: var(--white); color: var(--primary); box-shadow: 0 4px 10px rgba(234,88,12,0.08); }

        .form-header { margin-bottom: 2rem; }
        .form-header h2 { font-size: 26px; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-dark); letter-spacing: -0.5px;}
        .form-header p { font-size: 14.5px; color: var(--text-muted); line-height: 1.5; }

        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 0.6rem; color: var(--text-dark); }
        .input-wrapper { position: relative; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #FDBA74; display: flex; }
        .input-icon svg { width: 18px; height: 18px; }
        
        .form-control {
            width: 100%; padding: 13px 16px 13px 44px; background: var(--input-bg); border: 1.5px solid var(--border);
            border-radius: 12px; font-family: inherit; font-size: 14px; color: var(--text-dark); transition: all 0.25s ease;
        }
        .form-control::placeholder { color: #FDBA74; }
        .form-control:focus { outline: none; border-color: var(--primary-light); background: var(--white); box-shadow: 0 0 0 4px rgba(249,115,22,0.12); }
        
        .pwd-toggle { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #FDBA74; transition: color 0.2s; }
        .pwd-toggle:hover { color: var(--primary-light); }
        .pwd-toggle svg { width: 18px; height: 18px; }

        .form-options { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-size: 13.5px; color: var(--text-muted); cursor: pointer; font-weight: 500;}
        .checkbox-label input { width: 16px; height: 16px; accent-color: var(--primary-light); border-radius: 4px; border: 1.5px solid var(--border); cursor: pointer;}
        .text-link { font-size: 14px; color: var(--primary-light); font-weight: 600; text-decoration: none; transition: color 0.2s;}
        .text-link:hover { color: var(--primary); text-decoration: underline; }

        .btn {
            display: block; width: 100%; padding: 14px; background: var(--primary-light); color: var(--white);
            border: none; border-radius: 12px; font-size: 15px; font-weight: 600; font-family: inherit; cursor: pointer;
            text-align: center; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(249,115,22,0.25);
        }
        .btn:hover { background: var(--primary); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(234,88,12,0.3); }

        .alt-action { text-align: center; margin-top: 2rem; font-size: 14px; color: var(--text-muted); }

        .alert { padding: 1rem; border-radius: 12px; font-size: 14px; margin-bottom: 2rem; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5;}
        .alert svg { width: 20px; height: 20px; flex-shrink: 0; }
        .alert-error { background: #FEF2F2; color: #991B1B; border: 1px solid #F87171; }
        .alert-error ul { margin-left: 20px; margin-top: 4px; list-style-type: disc;}
        .alert-success { background: #F0FDF4; color: #166534; border: 1px solid #86EFAC; }

        @media (max-width: 900px) {
            .container { display: flex; flex-direction: column; justify-content: center; }
            .image-panel { display: none; }
            .form-panel { width: 100%; min-height: 100vh; animation: none; transform: none; padding: 2rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- IMAGE PANEL (LEFT) -->
        <div class="image-panel">
            <!-- Background Shape Effects -->
            <svg class="bg-shape shape-1" viewBox="0 0 24 24" fill="currentColor">
                <circle cx="12" cy="12" r="10"/>
            </svg>
            <svg class="bg-shape shape-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="4"/>
            </svg>
            <svg class="bg-shape shape-3" viewBox="0 0 24 24" fill="currentColor">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            <svg class="bg-shape shape-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>

            <div class="brand">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"/>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                    </svg>
                </div>
                <div class="brand-text">
                    <span>Sistem Nilai</span>
                    <span>Portal Guru</span>
                </div>
            </div>
            
            <img class="illustration" src="{{ asset('images/teacher.png') }}" alt="Guru mengelola nilai">
            
            <div class="hero-text">
                <h1>Selamat Datang</h1>
                <p>Kelola nilai akademik siswa dalam satu platform ringkas.</p>
            </div>
        </div>

        <!-- FORM PANEL (RIGHT) -->
        <div class="form-panel">
            <div class="form-container">
                <div class="tabs">
                    <a href="{{ route('login') }}" class="tab active">Masuk</a>
                    <a href="{{ route('register') }}" class="tab">Pendaftaran</a>
                </div>

                <div class="form-header">
                    <h2>Akses Akun</h2>
                    <p>Silakan masuk untuk melanjutkan ke dasbor Anda.</p>
                </div>

                @if(session('sukses'))
                    <div class="alert alert-success">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <div>{{ session('sukses') }}</div>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-error">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.proses') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="nama.guru@sekolah.id" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="pwd-toggle" onclick="togglePassword('password')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eye-password"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Biar tetap masuk
                        </label>
                        <a href="#" class="text-link">Lupa sandi?</a>
                    </div>

                    <button type="submit" class="btn">Masuk Sistem</button>
                </form>

                <div class="alt-action">
                    Belum terdaftar? <a href="{{ route('register') }}" class="text-link">Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            const el = document.getElementById(id);
            const icon = document.getElementById('eye-' + id);
            if (el.type === 'password') {
                el.type = 'text';
                icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
            } else {
                el.type = 'password';
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
            }
        }
    </script>
</body>
</html>