<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Guru | Sistem Nilai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        /* ========== SEMUA STYLE TETAP SAMA PERSIS SEPERTI ASLINYA ========== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #EA580C;
            --primary-dark: #C2410C;
            --primary-light: #FFEDD5;
            --white: #FFFFFF;
            --text-dark: #1C1917;
            --text-muted: #78716C;
            --border: #F3F4F6;
            --bg-body: #FAFAFA;
            --success: #10B981;
            --success-light: #D1FAE5;
            --info: #0EA5E9;
            --warning: #F59E0B;
            --danger: #EF4444;
            --accent: #8B5CF6;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .logo { display: flex; align-items: center; gap: 1rem; }
        .logo-box {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);
        }

        .logo-text h2 { font-size: 18px; font-weight: 800; color: var(--text-dark); line-height: 1; }
        .logo-text p { font-size: 11px; font-weight: 600; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; }

        .nav-menu { display: flex; list-style: none; gap: 0.5rem; background: #F3F4F6; padding: 0.4rem; border-radius: 14px; }
        .nav-link {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.6rem 1.2rem; border-radius: 10px;
            color: var(--text-muted); text-decoration: none;
            font-weight: 600; font-size: 13.5px; transition: all 0.25s ease;
        }
        .nav-link svg { width: 18px; height: 18px; stroke-width: 2.2; }
        .nav-link:hover { color: var(--primary); background: var(--white); }
        .nav-link.active { background: var(--white); color: var(--primary); box-shadow: 0 2px 8px rgba(0,0,0,0.05); }

        .user-section { display: flex; align-items: center; gap: 1.5rem; }
        .user-profile {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding-right: 1.5rem;
            border-right: 1px solid var(--border);
        }        
        .avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: var(--primary-light); color: var(--primary);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; border: 2px solid var(--white); outline: 2px solid var(--primary-light);
        }

        .btn-logout {
            display: flex; align-items: center; gap: 8px;
            background: transparent; color: var(--danger); border: 2px solid transparent;
            padding: 0.6rem 1rem; border-radius: 12px; font-weight: 700; font-size: 13px;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-logout:hover { background: #FEF2F2; border-color: #FEE2E2; }

        /* --- CONTENT --- */
        .container {padding: 2rem; max-width: 95%; width: 100%; margin: 0 auto;}

        /* --- ENHANCED WELCOME BANNER --- */
        .welcome-banner {
            background: linear-gradient(120deg, #FFF7ED 0%, #FFEDD5 100%);
            border-radius: 28px;
            padding: 2.5rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            border: 1px solid #FED7AA;
            box-shadow: 0 10px 30px rgba(234, 88, 12, 0.08);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: ''; position: absolute; right: -5%; top: -50%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%; pointer-events: none;
        }

        .welcome-text { position: relative; z-index: 1; }
        .welcome-text h1 { 
            font-size: 32px; font-weight: 800; 
            color: var(--primary-dark); 
            letter-spacing: -0.5px; margin-bottom: 0.5rem; 
        }
        .welcome-text p { 
            color: #9A3412; font-size: 16px; font-weight: 500; 
        }
        .welcome-date {
            display: inline-block; margin-top: 1rem;
            background: var(--white); color: var(--primary);
            padding: 0.4rem 1rem; border-radius: 20px;
            font-size: 12px; font-weight: 700;
            box-shadow: 0 2px 10px rgba(234,88,12,0.1);
        }

        .welcome-illustration svg {
            width: 140px; height: auto;
            position: relative; z-index: 1;
            filter: drop-shadow(0 10px 15px rgba(234,88,12,0.2));
        }

        /* --- STATS CARDS --- */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2.5rem;
        }
        .stat-card-modern {
            background: var(--white); border-radius: 24px; padding: 1.5rem;
            border: 1px solid var(--border); position: relative; overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card-modern:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.05); }
        
        .stat-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
        }
        .stat-card-modern h3 { font-size: 14px; color: var(--text-muted); font-weight: 600; margin-bottom: 0.5rem; }
        .stat-card-modern .value { font-size: 26px; font-weight: 800; color: var(--text-dark); display: flex; align-items: baseline; gap: 5px; }
        .stat-card-modern .trend { font-size: 12px; font-weight: 700; padding: 2px 8px; border-radius: 20px; margin-left: 10px; }
        
        .bg-orange { background: #FFF7ED; color: #EA580C; }
        .bg-blue { background: #F0F9FF; color: #0EA5E9; }
        .bg-green { background: #F0FDF4; color: #10B981; }
        .bg-purple { background: #F5F3FF; color: #8B5CF6; }

        /* --- DASHBOARD LAYOUT --- */
        .main-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
        
        .glass-card {
            background: var(--white); border-radius: 28px; border: 1px solid var(--border);
            padding: 2rem; margin-bottom: 1.5rem;
        }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .card-title { display: flex; align-items: center; gap: 0.75rem; font-size: 18px; font-weight: 700; }

        .btn-primary {
            background: var(--primary); color: white; border: none;
            padding: 0.75rem 1.25rem; border-radius: 14px;
            font-weight: 700; font-size: 14px; cursor: pointer;
            display: flex; align-items: center; gap: 8px;
            transition: all 0.2s; box-shadow: 0 4px 12px rgba(234, 88, 12, 0.2);
        }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(234, 88, 12, 0.3); }

        /* --- TABLE --- */
        .table-wrapper { overflow-x: auto; }
        .custom-table { width: 100%; border-collapse: separate; border-spacing: 0 0.75rem; }
        .custom-table th { padding: 1rem; text-align: left; color: var(--text-muted); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
        .custom-table tr td { background: var(--bg-body); padding: 1rem; transition: all 0.2s ease; vertical-align: middle; }
        .custom-table tr td:first-child { border-radius: 16px 0 0 16px; }
        .custom-table tr td:last-child { border-radius: 0 16px 16px 0; }
        .custom-table tr:hover td { background: #F3F4F6; transform: scale(1.01); }

        .badge-nilai {
            display: inline-block; width: 45px; text-align: center;
            padding: 6px 0; border-radius: 8px; font-weight: 800; font-size: 14px;
        }
        .nilai-tinggi { background: var(--success-light); color: var(--success); }
        .nilai-sedang { background: #FEF3C7; color: var(--warning); }
        .nilai-kurang { background: #FEE2E2; color: var(--danger); }

        .btn-detail {
            background: transparent; color: var(--info); border: 1px solid var(--info); 
            padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 12px;
            cursor: pointer; transition: all 0.2s;
        }
        .btn-detail:hover { background: var(--info); color: white; }

        /* --- SIDEBAR RANKING --- */
        .champion-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 30px; padding: 2rem; color: white; position: relative;
            box-shadow: 0 20px 40px rgba(234, 88, 12, 0.25);
            overflow: visible;
            margin-top: 15px;
        }
        .champion-card::before {
            content: ''; position: absolute; top: -10%; left: -10%; width: 150px; height: 150px;
            background: rgba(255, 255, 255, 0.1); border-radius: 50%;
        }
        
        .crown-icon {
            position: absolute; 
            top: -25px; 
            right: -15px; 
            transform: rotate(15deg);
            background: linear-gradient(135deg, #FBBF24, #F59E0B);
            padding: 12px; 
            border-radius: 50%; 
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.5);
            border: 4px solid var(--bg-body);
            display: flex; align-items: center; justify-content: center;
            z-index: 10;
        }
        
        .champion-info { text-align: center; margin-top: 0.5rem; }
        .champion-avatar {
            width: 90px; height: 90px; border-radius: 50%; border: 5px solid rgba(255,255,255,0.3);
            margin: 0 auto 1.5rem; background: var(--white); display: flex; align-items: center; justify-content: center;
            font-size: 36px; color: var(--primary); font-weight: 900;
        }
        .score-pill {
            background: rgba(255,255,255,0.15); backdrop-filter: blur(5px);
            padding: 1rem; border-radius: 20px; display: flex; justify-content: space-around; margin-top: 1.5rem;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .btn-rapor {
            width: 100%; margin-top: 1.5rem; background: var(--white); color: var(--primary-dark); 
            border: none; padding: 1rem; border-radius: 18px; font-weight: 800; font-size: 13px; 
            cursor: pointer; transition: 0.3s;
        }
        .btn-rapor:hover { background: var(--primary-light); transform: translateY(-2px); }

        @media (max-width: 1024px) {
            .main-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .user-profile { border-right: none; padding-right: 0; }
            .btn-logout span { display: none; }
            .welcome-illustration { display: none; }
        }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .welcome-banner { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-box">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            </div>
            <div class="logo-text">
                <h2>EDUGRADES</h2>
                <p>Teacher Portal</p>
            </div>
        </div>

        <ul class="nav-menu">
            <li><a href="#" class="nav-link active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a></li>
            <li><a href="#" class="nav-link" onclick="goToInputPage()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                Input Nilai
            </a></li>
        </ul>

        <div class="user-section">
            <div class="user-profile">
                <div class="avatar">{{ substr($guru->name, 0, 1) }}</div>
                <div style="text-align: right;">
                    <p style="font-size: 13px; font-weight: 800;">{{ $guru->name }}</p>
                    <p style="font-size: 11px; color: var(--text-muted);">
                        {{ $mataPelajaran->name ?? 'Tidak diketahui' }}
                    </p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="container">
        
        <!-- WELCOME BANNER -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Halo, {{ $guru->name }}! 👋</h1>
                <p style="font-size: 11px; color: var(--text-muted);">
                    {{ $mataPelajaran->name ?? 'Tidak diketahui' }}
                </p>
                <div class="welcome-date">
                    <svg style="display:inline; vertical-align:middle; margin-right:4px;" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span id="currentDate"></span>
                </div>
            </div>
            <div class="welcome-illustration">
                <svg viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20,130 Q50,80 100,100 T180,50" fill="none" stroke="#EA580C" stroke-width="8" stroke-linecap="round"/>
                    <circle cx="180" cy="50" r="12" fill="#F59E0B" />
                    <rect x="30" y="40" width="40" height="40" rx="10" fill="#FFEDD5" />
                    <rect x="40" y="50" width="20" height="20" rx="5" fill="#EA580C" />
                    <polygon points="120,20 140,60 100,60" fill="#FFEDD5" opacity="0.8"/>
                </svg>
            </div>
        </div>

        <!-- STATS CARDS DARI DATA ASLI -->
        <div class="stats-grid">
            <div class="stat-card-modern">
                <div class="stat-icon bg-orange">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3>Total Siswa</h3>
                <div class="value">{{ $totalSiswa }} <span class="trend bg-green">Aktif</span></div>
            </div>

            <div class="stat-card-modern">
                <div class="stat-icon bg-blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3>Sudah Diinput</h3>
                <div class="value">{{ $sudahDiinput }} <span class="trend bg-orange">/ {{ $totalSiswa }}</span></div>
            </div>

            <div class="stat-card-modern">
                <div class="stat-icon bg-green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <h3>Lulus KKM</h3>
                <div class="value">95% <span class="trend bg-blue">Tinggi</span></div>
            </div>

            <div class="stat-card-modern">
                <div class="stat-icon bg-purple">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <h3>Belum Diinput</h3>
                <div class="value">{{ $totalSiswa - $sudahDiinput }} <span class="trend bg-purple">Sisa</span></div>
            </div>
        </div>

        <div class="main-grid">
            
            <div class="content-left">
                <!-- CHART -->
                <div class="glass-card">
                    <div class="card-header">
                        <div class="card-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                            Tren Nilai Semester
                        </div>
                        <select style="border:none; font-weight: 700; color: var(--primary); outline: none; cursor:pointer; background: transparent;">
                            <option>Semester Ganjil 2024</option>
                            <option>Semester Genap 2024</option>
                        </select>
                    </div>
                    <canvas id="nilaiChart" height="100"></canvas>
                </div>

                <!-- DAFTAR NILAI DARI DATABASE -->
                <div class="glass-card">
                    <div class="card-header" style="margin-bottom: 1rem;">
                        <div class="card-title">Daftar Nilai Kelas</div>
                        <button class="btn-primary" onclick="goToInputPage()">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Input Nilai
                        </button>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <input type="text" id="searchInput" placeholder="Cari siswa berdasarkan nama atau NIS..." style="width: 100%; padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid var(--border); font-size: 13px; outline: none; background: #F9FAFB;">
                    </div>

                    <div class="table-wrapper">
                        <table class="custom-table" id="nilaiTable">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th style="text-align: center;">Nilai</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilaiDiinput as $nilai)
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="width: 36px; height: 36px; border-radius: 10px; background: #FFEDD5; color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px;">
                                                {{ substr($nilai->siswa->name ?? '??', 0, 2) }}
                                            </div>
                                            <div>
                                                <p style="font-weight: 700; font-size: 14px;">{{ $nilai->siswa->name ?? 'Tidak diketahui' }}</p>
                                                <p style="font-size: 12px; color: var(--text-muted);">NIS: {{ $nilai->siswa->nis ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $nilaiValue = $nilai->nilai ?? 0;
                                            $nilaiClass = $nilaiValue >= 85 ? 'nilai-tinggi' : ($nilaiValue >= 70 ? 'nilai-sedang' : 'nilai-kurang');
                                        @endphp
                                        <span class="badge-nilai {{ $nilaiClass }}">{{ $nilaiValue }}</span>
                                    </td>
                                    <td style="text-align: center;">
                                        @php
                                            $statusNilai = $nilaiValue >= 75 ? 'Lulus' : 'Remedial';
                                            $statusClass = $nilaiValue >= 75 ? 'nilai-tinggi' : 'nilai-kurang';
                                        @endphp
                                        <span class="badge-nilai {{ $statusClass }}" style="width: auto; padding: 6px 12px;">{{ $statusNilai }}</span>
                                    </td>
                                    <td style="text-align: right;">
                                        <button class="btn-detail" onclick="detailNilai({{ $nilai->id }})">Lihat Detail</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem;">
                                        <p style="color: var(--text-muted);">Belum ada data nilai yang diinput.</p>
                                        <button class="btn-primary" style="margin-top: 1rem;" onclick="goToInputPage()">Input Nilai Sekarang</button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="content-right">
                <!-- SISWA TERBAIK (RANKING) -->
                @php
                    $topStudent = $nilaiDiinput->sortByDesc('nilai')->first();
                @endphp
                <div class="champion-card">
                    <div class="crown-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7z"/><path d="M12 17H12.01"/></svg>
                    </div>
                    
                    <p style="font-size: 11px; font-weight: 700; opacity: 0.9; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 5px; text-align: center;">Peringkat 1 Kelas</p>
                    
                    <div class="champion-info">
                        <div class="champion-avatar">{{ strtoupper(substr(optional($topStudent->siswa)->name ?? 'SN', 0, 2)) }}</div>
                        <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">{{ optional($topStudent->siswa)->name ?? 'Belum Ada Data' }}</h2>
                        <p style="opacity: 0.9; font-size: 13px; margin-top: 4px; font-weight: 500;">
                            {{ $topStudent->siswa->kelas ?? 'Kelas tidak diketahui' }}
                        </p>
                        
                        <div class="score-pill">
                            <div>
                                <small style="display:block; opacity: 0.8; font-size: 9px; text-transform: uppercase; font-weight: 700;">Nilai Tertinggi</small>
                                <span style="font-size: 24px; font-weight: 900;">{{ optional($topStudent)->nilai ?? '-' }}</span>
                            </div>
                            <div style="border-left: 1px solid rgba(255,255,255,0.3); padding-left: 20px;">
                                <small style="display:block; opacity: 0.8; font-size: 9px; text-transform: uppercase; font-weight: 700;">Rata-rata Kelas</small>
                                <span style="font-size: 24px; font-weight: 900;">{{ round($nilaiDiinput->avg('nilai'), 1) ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <button class="btn-rapor" onclick="lihatRapor({{ $topStudent->id ?? 0 }})">
                        Lihat Rapor Lengkap
                    </button>
                </div>

                <!-- SISWA BERPRESTASI LAINNYA -->
                <div class="glass-card" style="margin-top: 1.5rem;">
                    <h3 style="font-size: 15px; font-weight: 800; margin-bottom: 1.5rem;">Siswa Berprestasi Lainnya</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        @foreach($nilaiDiinput->sortByDesc('nilai')->skip(1)->take(3) as $index => $nilai)
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="font-weight: 800; color: #9CA3AF; background: #F3F4F6; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">{{ $index + 2 }}</span>
                                <span style="font-weight: 600; font-size: 14px;">{{ $nilai->siswa->name ?? 'Tidak diketahui' }}</span>
                            </div>
                            <span style="font-weight: 800; font-size: 14px; color: var(--primary);">{{ $nilai->nilai }}</span>
                        </div>
                        @endforeach
                        @if($nilaiDiinput->count() <= 1)
                        <p style="text-align: center; color: var(--text-muted); padding: 1rem;">Belum ada data prestasi lainnya</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Set tanggal dinamis
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').innerText = new Date().toLocaleDateString('id-ID', dateOptions);

        // Fungsi navigasi
        function goToInputPage() {
            window.location.href = "{{ route('guru.nilai.store') }}";
        }

        function detailNilai(id) {
            window.location.href = "/guru/nilai/" + id;
        }

        function lihatRapor(id) {
            window.location.href = "/guru/rapor/" + id;
        }

        // Filter pencarian
        document.getElementById('searchInput')?.addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#nilaiTable tbody tr');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Setup Chart.js
        const ctx = document.getElementById('nilaiChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(234, 88, 12, 0.2)');
        gradient.addColorStop(1, 'rgba(234, 88, 12, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Nilai Rata-rata',
                    data: [75, 78, 85, 82, 88, 91],
                    borderColor: '#EA580C',
                    borderWidth: 4,
                    pointBackgroundColor: '#EA580C',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#F3F4F6' }, ticks: { font: { weight: 'bold' } } },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
</body>
</html>