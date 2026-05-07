<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin | Sistem Nilai Guru</title>
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
            max-width: 1200px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Welcome Section */
        .welcome-section {
            background: linear-gradient(135deg, var(--white) 0%, #FFF7ED 100%);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border);
        }

        .welcome-section h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .welcome-section p {
            color: var(--text-muted);
            font-size: 15px;
        }

        /* Stats Cards - 4 Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            animation: slideUp 0.5s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-light), var(--primary));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(234, 88, 12, 0.08);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stat-icon svg {
            width: 26px;
            height: 26px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Stats Nilai Cards */
        .stats-nilai-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-nilai-card {
            background: var(--white);
            border-radius: 16px;
            padding: 1rem;
            border: 1px solid var(--border);
            text-align: center;
        }

        .stat-nilai-card .label {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .stat-nilai-card .value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Table Styles */
        .card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .btn-add {
            background: var(--primary-light);
            color: var(--white);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 1rem 1.5rem;
            background: var(--bg-light);
            color: var(--text-dark);
            font-weight: 600;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
        }

        .data-table td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 14px;
        }

        .data-table tr:hover {
            background: var(--bg-light);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin: 0.2rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-view, .btn-edit {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-view {
            background: rgba(59, 130, 246, 0.1);
            color: #2563EB;
        }

        .btn-edit {
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary);
        }

        .btn-view:hover, .btn-edit:hover {
            transform: translateY(-1px);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .stats-nilai-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .stats-nilai-grid {
                grid-template-columns: 1fr;
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
            .data-table th, .data-table td {
                padding: 0.75rem 1rem;
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
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
                <a href="{{ route('admin.nilai.index') }}" class="nav-link">
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
        <!-- WELCOME SECTION -->
        <div class="welcome-section">
            <h2>Selamat datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h2>
            <p>Pantau dan kelola seluruh aktivitas akademik dari satu tempat. Berikut ringkasan data sistem Anda hari ini.</p>
        </div>

        <!-- STATISTICS CARDS - 4 CARDS -->
        <div class="stats-grid">
            <div class="stat-card" onclick="window.location='{{ route('admin.guru.index') }}'">
                <div class="stat-icon" style="background: rgba(234, 88, 12, 0.1);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($statistik['total_guru'] ?? 0) }}</div>
                <div class="stat-label">Total Guru</div>
            </div>

            <div class="stat-card" onclick="window.location='{{ route('admin.siswa.index') }}'">
                <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($statistik['total_siswa'] ?? 0) }}</div>
                <div class="stat-label">Total Siswa</div>
            </div>

            <div class="stat-card" onclick="window.location='{{ route('admin.guru.index') }}'">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--warning)" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($statistik['total_mata_pelajaran'] ?? 0) }}</div>
                <div class="stat-label">Mata Pelajaran</div>
            </div>

            <div class="stat-card" onclick="window.location='{{ route('admin.nilai.index') }}'">
                <div class="stat-icon" style="background: rgba(59, 130, 246, 0.1);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--info)" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($statistik['total_nilai'] ?? 0) }}</div>
                <div class="stat-label">Total Nilai</div>
            </div>
        </div>

        <!-- STATISTIK NILAI RINGKASAN -->
        <div class="stats-nilai-grid">
            <div class="stat-nilai-card">
                <div class="label">📊 Rata-rata Nilai</div>
                <div class="value">{{ number_format($statistikNilai['rata_rata'] ?? 0, 2) }}</div>
            </div>
            <div class="stat-nilai-card">
                <div class="label">🏆 Nilai Tertinggi</div>
                <div class="value">{{ number_format($statistikNilai['nilai_tertinggi'] ?? 0) }}</div>
            </div>
            <div class="stat-nilai-card">
                <div class="label">📉 Nilai Terendah</div>
                <div class="value">{{ number_format($statistikNilai['nilai_terendah'] ?? 0) }}</div>
            </div>
            <div class="stat-nilai-card">
                <div class="label">👨‍🎓 Siswa dengan Nilai</div>
                <div class="value">{{ number_format($statistikNilai['total_siswa_punya_nilai'] ?? 0) }}</div>
            </div>
        </div>

        <!-- RECENT STUDENTS TABLE -->
        <div class="card">
            <div class="card-header">
                <h3>📋 5 Siswa Terbaru</h3>
                <a href="{{ route('admin.siswa.index') }}" class="btn-add">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Kelola Siswa
                </a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Nilai Akademik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $s)
                    <tr>
                        <td><strong>{{ $s->name }}</strong> @if($s->nisn) <span style="font-size: 11px; color: var(--text-muted);">({{ $s->nisn }})</span> @endif</td>
                        <td>
                            @if($s->nilai->count() > 0)
                                @foreach($s->nilai as $n)
                                    <span class="badge">
                                        {{ $n->mataPelajaran->name ?? $n->mataPelajaran->nama ?? '-' }}: {{ $n->nilai }}
                                    </span>
                                @endforeach
                            @else
                                <span class="badge" style="background:#FEE2E2; color:#DC2626;">Belum ada nilai</span>
                            @endif
                        </td>
                        <td class="action-buttons">
                            <a href="{{ route('admin.siswa.edit', $s->id) }}" class="btn-edit">Edit</a>
                            <a href="{{ route('admin.nilai.show', $s->id) }}" class="btn-view">Lihat Nilai</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Belum ada data siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>