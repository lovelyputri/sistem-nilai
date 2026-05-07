<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Guru | Sistem Nilai Guru</title>
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
            max-width: 1400px;
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

        /* Alert / Info Box */
        .info-box {
            background: rgba(59, 130, 246, 0.1);
            border-left: 4px solid var(--info);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-box svg {
            width: 22px;
            height: 22px;
            stroke: var(--info);
        }

        .info-box .count {
            font-weight: 700;
            font-size: 18px;
            color: var(--info);
        }

        /* Alert Message */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-left: 4px solid var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid var(--danger);
            color: var(--danger);
        }

        /* Table Styles */
        .card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border);
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
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
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: var(--bg-light);
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .badge-mapel {
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit, .btn-delete, .btn-confirm, .btn-reject {
            padding: 0.3rem 0.75rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit {
            background: rgba(249, 115, 22, 0.1);
            color: var(--primary);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .btn-confirm {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .btn-reject {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .btn-edit:hover, .btn-delete:hover, .btn-confirm:hover, .btn-reject:hover {
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state svg {
            margin: 0 auto 1rem;
            display: block;
            opacity: 0.5;
        }

        .empty-state p {
            color: var(--text-muted);
            margin-bottom: 1rem;
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
                <a href="{{ route('admin.guru.index') }}" class="nav-link active">
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
        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1>👨‍🏫 Kelola Guru</h1>
        </div>

        <!-- SESSION MESSAGES -->
        @if(session('sukses'))
        <div class="alert alert-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('sukses') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- INFO BOX - MENUNGGU KONFIRMASI -->
        @if($waitingTeacher > 0)
        <div class="info-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>Terdapat <span class="count">{{ $waitingTeacher }}</span> guru yang menunggu konfirmasi akun.</span>
        </div>
        @endif

        <!-- TABLE GURU -->
        <div class="card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Mata Pelajaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $g)
                    <tr>
                        <td>
                            <strong>{{ $g->name }}</strong>
                        </td>
                        <td>{{ $g->email }}</td>
                        <td>{{ $g->nip ?? '-' }}</td>
                        <td>
                            @if($g->mataPelajaran && $g->mataPelajaran->count() > 0)
                                @foreach($g->mataPelajaran as $mapel)
                                    <span class="badge badge-mapel">
                                        {{ $mapel->name }}
                                    </span>
                                @endforeach
                            @else
                                <span style="color: var(--text-muted); font-size: 13px;">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusClass = '';
                                $statusText = '';
                                if($g->status == 'aktif') {
                                    $statusClass = 'badge-active';
                                    $statusText = 'Aktif';
                                } elseif($g->status == 'menunggu') {
                                    $statusClass = 'badge-pending';
                                    $statusText = 'Menunggu';
                                } elseif($g->status == 'ditolak') {
                                    $statusClass = 'badge-rejected';
                                    $statusText = 'Ditolak';
                                } else {
                                    $statusClass = 'badge-pending';
                                    $statusText = ucfirst($g->status ?? 'Menunggu');
                                }
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                        </td>
                        <td class="action-buttons">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.guru.edit', $g->id) }}" class="btn-edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                    <path d="M17 3l4 4-7 7H10v-4l7-7z"/>
                                    <path d="M4 20h16"/>
                                </svg>
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form method="POST" action="{{ route('admin.guru.destroy', $g->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru {{ $g->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>

                            <!-- Tombol Terima/Tolak untuk status menunggu -->
                            @if($g->status == 'menunggu')
                                <a href="{{ route('admin.guru.confirm', $g->id) }}" class="btn-confirm" onclick="return confirm('Terima pendaftaran guru {{ $g->name }}?')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                    Terima
                                </a>
                                <a href="{{ route('admin.guru.reject', $g->id) }}" class="btn-reject" onclick="return confirm('Tolak pendaftaran guru {{ $g->name }}?')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                    Tolak
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <p>Belum ada data guru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>`