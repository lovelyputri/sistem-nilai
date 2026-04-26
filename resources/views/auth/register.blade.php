<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Sistem Nilai Guru</title>
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
        /* Swap order for register page */
        .container { display: flex; min-height: 100vh; width: 100%; flex-direction: row-reverse; position: relative;}
        
        /* IMAGE PANEL - Now on the Right */
        .image-panel {
            width: 50%;
            background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            padding: 3rem; position: relative; overflow: hidden;
            /* Animation comes from Left (-100%) to Right (0) */
            animation: slideToRightAnim 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            z-index: 2;
        }

        @keyframes slideToRightAnim {
            0% { transform: translateX(-100%); opacity: 0; }
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

        /* FORM PANEL - Now on the Left */
        .form-panel {
            width: 50%; display: flex; justify-content: center; align-items: center; padding: 2rem;
            position: relative; background: var(--white); z-index: 1;
            /* Animation comes from Right (100%) to Left (0) */
            animation: slideToLeftAnim 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
        }

        @keyframes slideToLeftAnim {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        .form-container { width: 100%; max-width: 420px; }
        
        .tabs { display: flex; gap: 8px; background: #FFF7ED; padding: 6px; border-radius: 14px; margin-bottom: 2rem; border: 1px solid #FFEDD5; }
        .tab {
            flex: 1; text-align: center; padding: 10px 16px; border-radius: 10px; font-size: 14px; font-weight: 600;
            color: var(--text-muted); text-decoration: none; transition: all 0.3s ease;
        }
        .tab:hover { color: var(--text-dark); }
        .tab.active { background: var(--white); color: var(--primary); box-shadow: 0 4px 10px rgba(234,88,12,0.08); }

        .form-header { margin-bottom: 1.5rem; }
        .form-header h2 { font-size: 26px; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-dark); letter-spacing: -0.5px;}
        .form-header p { font-size: 14.5px; color: var(--text-muted); line-height: 1.5; }

        .info-box { background: #FFF7ED; border: 1.5px solid var(--border); border-radius: 12px; padding: 12px 14px; font-size: 13px; color: var(--text-dark); margin-bottom: 1.5rem; display: flex; gap: 10px; align-items: flex-start; }
        .info-box svg { width: 18px; height: 18px; flex-shrink: 0; margin-top: 1px; color: var(--primary-light); }

        /* Inputs */
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-group { margin-bottom: 1.1rem; }
        .form-group label { display: block; font-size: 13.5px; font-weight: 600; margin-bottom: 0.6rem; color: var(--text-dark); }
        .input-wrapper { position: relative; }
        .input-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #FDBA74; display: flex; }
        .input-icon svg { width: 17px; height: 17px; }
        
        .form-control {
            width: 100%; padding: 11.5px 16px 11.5px 42px; background: var(--input-bg); border: 1.5px solid var(--border);
            border-radius: 10px; font-family: inherit; font-size: 14px; color: var(--text-dark); transition: all 0.25s ease;
        }
        .form-control::placeholder { color: #FDBA74; }
        .form-control:focus { outline: none; border-color: var(--primary-light); background: var(--white); box-shadow: 0 0 0 4px rgba(249,115,22,0.12); }
        
        select.form-control { cursor: pointer; appearance: none; }
        .select-wrapper { position: relative; }
        .select-wrapper::after { content: ''; position: absolute; right: 16px; top: 50%; transform: translateY(-50%); width: 0; height: 0; border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 5px solid #FDBA74; pointer-events: none; }

        .pwd-toggle { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #FDBA74; transition: color 0.2s; }
        .pwd-toggle:hover { color: var(--primary-light); }
        .pwd-toggle svg { width: 17px; height: 17px; }

        .btn {
            display: block; width: 100%; padding: 14px; background: var(--primary-light); color: var(--white);
            border: none; border-radius: 10px; font-size: 15px; font-weight: 600; font-family: inherit; cursor: pointer;
            text-align: center; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(249,115,22,0.2); margin-top: 0.5rem;
        }
        .btn:hover { background: var(--primary); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(234,88,12,0.25); }

        .alt-action { text-align: center; margin-top: 2rem; font-size: 14px; color: var(--text-muted); }
        .text-link { font-size: 14px; color: var(--primary-light); font-weight: 600; text-decoration: none; transition: color 0.2s;}
        .text-link:hover { color: var(--primary); text-decoration: underline; }

        .alert { padding: 1rem; border-radius: 12px; font-size: 14px; margin-bottom: 2rem; display: flex; align-items: flex-start; gap: 12px; line-height: 1.5;}
        .alert svg { width: 20px; height: 20px; flex-shrink: 0; }
        .alert-error { background: #FEF2F2; color: #991B1B; border: 1px solid #F87171; }
        .alert-error ul { margin-left: 20px; margin-top: 4px; list-style-type: disc;}
        .alert-success { background: #F0FDF4; color: #166534; border: 1px solid #86EFAC; }

        @media (max-width: 900px) {
            .container { display: flex; flex-direction: column; justify-content: center; }
            .image-panel { display: none; }
            .form-panel { width: 100%; min-height: 100vh; animation: none; transform: none; padding: 2rem; }
            .form-row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- IMAGE PANEL (Now on Right visually via flex-direction: row-reverse) -->
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
                <h1>Pendaftaran Terpadu</h1>
                <p>Bergabunglah dan kelola nilai siswa secara efisien.</p>
            </div>
        </div>

        <!-- FORM PANEL (Now on Left) -->
        <div class="form-panel">
            <div class="form-container">
                <div class="tabs">
                    <a href="{{ route('login') }}" class="tab">Masuk</a>
                    <a href="{{ route('register') }}" class="tab active">Pendaftaran</a>
                </div>

                <div class="form-header">
                    <h2>Registrasi Akun</h2>
                    <p>Lengkapi formulir untuk verifikasi akun pendidik Anda.</p>
                </div>

                <div class="info-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Akun baru akan membutuhkan tahap verifikasi dari administrator untuk dapat diakses penuh.</span>
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

                <form method="POST" action="{{ route('register.proses') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Sesuai KTP" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP Tenaga Pendidik</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                </span>
                                <input type="text" id="nip" name="nip" class="form-control" placeholder="No. Induk (NIP)" value="{{ old('nip') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email Aktif</label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="email@sekolah.id" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_mata_pelajaran">Mata Pelajaran Diampu</label>
                        <div class="input-wrapper select-wrapper">
                            <span class="input-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            </span>
                            <select id="id_mata_pelajaran" name="id_mata_pelajaran" class="form-control" required>
                                <option value="">-- Pilih Spesialisasi --</option>
                                @foreach($mataPelajaran as $mapel)
                                    <option value="{{ $mapel->id }}" {{ old('id_mata_pelajaran') == $mapel->id ? 'selected' : '' }}>
                                        {{ $mapel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </span>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Sandi baru" required>
                                <button type="button" class="pwd-toggle" onclick="togglePassword('password')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eye-password"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Sandi</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi sandi" required>
                                <button type="button" class="pwd-toggle" onclick="togglePassword('password_confirmation')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eye-password_confirmation"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn">Ajukan Pendaftaran</button>
                </form>

                <div class="alt-action">
                    Sudah memiliki akun aktif? <a href="{{ route('login') }}" class="text-link">Masuk ruang guru</a>
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