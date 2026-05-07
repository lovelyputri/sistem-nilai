<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Nilai | Sistem Nilai Guru</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #EA580C;
            --primary-light: #F97316;
            --white: #FFFFFF;
            --text-dark: #431407;
            --text-muted: #9A3412;
            --border: #FED7AA;
            --bg-light: #FFF7ED;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --info: #3B82F6;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* NAVBAR STYLES */
        .navbar {
            background: var(--white);
            padding: 0.75rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(234, 88, 12, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 22px;
            height: 22px;
            stroke: var(--primary);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-text span:first-child {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .logo-text span:last-child {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .nav-link svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
        }

        .nav-link:hover {
            background: var(--bg-light);
            color: var(--primary);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
            color: var(--primary);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            color: #DC2626;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            background: rgba(220, 38, 38, 0.05);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(220, 38, 38, 0.1);
        }

        /* MAIN CONTENT */
        .main-content {
            padding: 2rem;
            max-width: 1000px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .btn-back {
            background: var(--white);
            color: var(--text-muted);
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid var(--border);
        }

        .btn-back:hover {
            background: var(--bg-light);
            color: var(--primary);
            border-color: var(--primary-light);
        }

        /* Info Cards */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--border);
            text-align: center;
        }

        .info-card .label {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .info-card .value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .info-card .sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        /* Progress Circle */
        .progress-circle {
            width: 100px;
            height: 100px;
            margin: 0 auto 1rem;
            position: relative;
        }

        .progress-circle svg {
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 8;
        }

        .progress-circle .bg {
            stroke: var(--border);
        }

        .progress-circle .fill {
            stroke: var(--primary);
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 0.5s ease;
        }

        .progress-circle .text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Cards */
        .card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            background: var(--bg-light);
        }

        .card-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-header h3 svg {
            width: 20px;
            height: 20px;
            stroke: var(--primary);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Nilai */
        .nilai-table {
            width: 100%;
            border-collapse: collapse;
        }

        .nilai-table th {
            text-align: left;
            padding: 0.75rem 0;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
        }

        .nilai-table td {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        .nilai-table tr:last-child td {
            border-bottom: none;
        }

        .nilai-value {
            font-weight: 700;
            color: var(--text-dark);
        }

        .nilai-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .nilai-badge.a {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .nilai-badge.b {
            background: rgba(59, 130, 246, 0.1);
            color: var(--info);
        }

        .nilai-badge.c {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .nilai-badge.d {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
        }

        .empty-state svg {
            margin: 0 auto 1rem;
            display: block;
            opacity: 0.5;
        }

        .empty-state p {
            color: var(--text-muted);
        }

        /* List Belum Diisi */
        .mapel-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .mapel-item {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            .navbar {
                padding: 0.75rem 1rem;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            .nav-menu {
                order: 3;
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
            }
            .info-cards {
                grid-template-columns: 1fr;
            }
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="7"/>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
                </svg>
            </div>
            <div class="logo-text">
                <span>Sistem Nilai</span>
                <span>Portal Guru</span>
            </div>
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-7H9v7H5a2 2 0 0 1-2-2z"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.guru.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Kelola Guru</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.siswa.index') }}" class="nav-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <span>Kelola Siswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.nilai.index') }}" class="nav-link active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    <span>Kelola Nilai</span>
                </a>
            </li>
        </ul>

        <div class="user-info">
            <span class="user-name">{{ Auth::user()->name ?? 'Admin' }}</span>
            <div class="user-avatar">
                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1>📋 Detail Nilai Siswa</h1>
            <a href="{{ route('admin.nilai.index') }}" class="btn-back">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <!-- INFO CARDS -->
        <div class="info-cards">
            <div class="info-card">
                <div class="label">Nama Siswa</div>
                <div class="value">{{ $siswa->name }}</div>
                <div class="sub">NIS: {{ $siswa->nis ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="label">Kelas</div>
                <div class="value">{{ $siswa->kelas ?? '-' }}</div>
                <div class="sub">Total Mapel: {{ $totalMapel }}</div>
            </div>
            <div class="info-card">
                <div class="label">Rata-rata Nilai</div>
                <div class="value">{{ number_format($rataRata, 2) }}</div>
                <div class="sub">
                    @php
                        if($rataRata >= 85) {
                            echo '✨ Sangat Baik';
                        } elseif($rataRata >= 70) {
                            echo '👍 Baik';
                        } elseif($rataRata >= 60) {
                            echo '📖 Cukup';
                        } else {
                            echo '⚠️ Perlu Bimbingan';
                        }
                    @endphp
                </div>
            </div>
        </div>

        <!-- NILAI YANG SUDAH DIISI -->
        <div class="card">
            <div class="card-header">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    Nilai yang Sudah Diisi
                </h3>
            </div>
            <div class="card-body">
                @if($siswa->nilai->count() > 0)
                    <table class="nilai-table">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswa->nilai as $n)
                                @php
                                    $nilai = $n->nilai;
                                    if($nilai >= 85) {
                                        $kategori = 'A (Sangat Baik)';
                                        $badgeClass = 'a';
                                    } elseif($nilai >= 70) {
                                        $kategori = 'B (Baik)';
                                        $badgeClass = 'b';
                                    } elseif($nilai >= 60) {
                                        $kategori = 'C (Cukup)';
                                        $badgeClass = 'c';
                                    } else {
                                        $kategori = 'D (Kurang)';
                                        $badgeClass = 'd';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $n->mataPelajaran->name ?? $n->mataPelajaran->nama }}</td>
                                    <td class="nilai-value">{{ $nilai }}</td>
                                    <td><span class="nilai-badge {{ $badgeClass }}">{{ $kategori }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <p>Belum ada nilai yang diisi</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- MATA PELAJARAN BELUM DIISI -->
        <div class="card">
            <div class="card-header">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Mata Pelajaran Belum Diisi
                </h3>
            </div>
            <div class="card-body">
                @if($mataPelajaranBelumDiisi->count() > 0)
                    <div class="mapel-list">
                        @foreach($mataPelajaranBelumDiisi as $m)
                            <span class="mapel-item">{{ $m->name ?? $m->nama }}</span>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <p>Semua mata pelajaran sudah terisi! ✅</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- PROGRESS SUMMARY -->
        <div class="card">
            <div class="card-header">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Ringkasan Progress
                </h3>
            </div>
            <div class="card-body">
                @php
                    $jumlahTerisi = $siswa->nilai->count();
                    $progress = $totalMapel > 0 ? round(($jumlahTerisi / $totalMapel) * 100) : 0;
                @endphp
                <div style="text-align: center;">
                    <div style="font-size: 48px; font-weight: 700; color: var(--text-dark);">{{ $progress }}%</div>
                    <div style="color: var(--text-muted); margin-top: 0.5rem;">
                        {{ $jumlahTerisi }} dari {{ $totalMapel }} mata pelajaran terisi
                    </div>
                    <div class="progress-bar" style="margin-top: 1rem; height: 10px;">
                        <div class="progress-fill" style="width: {{ $progress }}%; height: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>