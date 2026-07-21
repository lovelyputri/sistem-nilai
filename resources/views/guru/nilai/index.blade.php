<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Nilai Oranye | EDUGRADES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #EA580C;
            --primary-dark: #C2410C;
            --primary-light: #FFEDD5;
            --white: #FFFFFF;
            --text-dark: #1C1917;
            --text-muted: #78716C;
            --border: #F3F4F6;
            --bg-body: #FAFAFA;
            --slate-50: #FFF7ED;
            --slate-100: #FFEDD5;
            --slate-200: #FED7AA;
            --slate-500: #9A3412;
            --slate-800: #431407;
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --info: #3B82F6;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
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

        /* --- HEADER & CONTROLS --- */
        .page-header-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .page-header {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .page-header h1 { font-size: 28px; font-weight: 800; color: var(--primary-dark); }
        .page-header p { color: var(--slate-500); font-size: 15px; font-weight: 500; }

        /* --- CLASS SELECTOR --- */
        .class-selector-wrapper {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .label-select {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .custom-select {
            appearance: none;
            background-color: var(--white);
            border: 2px solid var(--slate-200);
            border-radius: 12px;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23EA580C' stroke-width='3'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1.2rem;
            transition: all 0.2s ease;
            min-width: 220px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .custom-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        /* --- CARD --- */
        .glass-card {
            background: var(--white);
            border-radius: 20px;
            border: 2px solid var(--slate-200);
            box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.1);
            overflow: hidden;
        }

        /* --- TABLE --- */
        .table-container { overflow-x: auto; }
        .input-table { width: 100%; border-collapse: collapse; }
        .input-table th { 
            background: var(--primary-light); 
            padding: 1.25rem 1.5rem; 
            text-align: left; 
            font-size: 12px; 
            font-weight: 700;
            color: var(--primary-dark);
            text-transform: uppercase;
            border-bottom: 2px solid var(--slate-200);
        }
        .input-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--slate-100); }

        .student-info { display: flex; align-items: center; gap: 12px; }
        .student-avatar {
            width: 40px; height: 40px; border-radius: 12px;
            background: var(--primary-light); color: var(--primary);
            display: flex; align-items: center; justify-content: center; font-weight: 800;
            border: 1px solid var(--slate-200);
        }

        /* ===== KOLOM NILAI (READ-ONLY) ===== */
        .nilai-display {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 60px;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 18px;
            background: #F3F4F6;
            color: var(--text-dark);
            border: 2px solid #E5E7EB;
            transition: all 0.3s ease;
        }

        .nilai-display.excellent {
            background: #ECFDF5;
            border-color: #10B981;
            color: #065F46;
        }

        .nilai-display.good {
            background: #EFF6FF;
            border-color: #3B82F6;
            color: #1E3A8A;
        }

        .nilai-display.pass {
            background: #FFFBEB;
            border-color: #F59E0B;
            color: #92400E;
        }

        .nilai-display.fail {
            background: #FEF2F2;
            border-color: #EF4444;
            color: #991B1B;
        }

        .nilai-display.empty {
            background: #F3F4F6;
            border-color: #D1D5DB;
            color: #9CA3AF;
        }

        /* ===== KOLOM KETERANGAN ===== */
        .keterangan-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .keterangan-icon {
            font-size: 20px;
            line-height: 1;
        }

        .keterangan-text {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            background: var(--slate-50);
            color: var(--slate-500);
            min-height: 38px;
            display: flex;
            align-items: center;
            border: 2px solid #E5E7EB;
        }

        .keterangan-text.excellent {
            background: #ECFDF5;
            border-color: #10B981;
            color: #065F46;
        }

        .keterangan-text.good {
            background: #EFF6FF;
            border-color: #3B82F6;
            color: #1E3A8A;
        }

        .keterangan-text.pass {
            background: #FFFBEB;
            border-color: #F59E0B;
            color: #92400E;
        }

        .keterangan-text.fail {
            background: #FEF2F2;
            border-color: #EF4444;
            color: #991B1B;
        }

        .keterangan-text.empty {
            background: #F3F4F6;
            border-color: #D1D5DB;
            color: #9CA3AF;
            font-style: italic;
        }

        /* --- BADGE --- */
        .badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            display: inline-block;
            min-width: 85px;
            text-align: center;
        }
        .badge-success { background: #dcfce7; color: #15803d; }
        .badge-danger { background: #fee2e2; color: #b91c1c; }
        .badge-muted { background: var(--slate-100); color: var(--slate-500); }
        .badge-warning { background: #fef3c7; color: #92400e; }

        /* --- ACTION BUTTONS --- */
        .btn-action {
            padding: 8px 14px;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            font-size: 12px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        .btn-edit {
            background: var(--primary-light);
            color: var(--primary-dark);
            border: 2px solid var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
            border: 2px solid #fca5a5;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-action:active {
            transform: scale(0.95);
        }

        .action-group {
            display: flex;
            gap: 6px;
        }

        /* --- FOOTER --- */
        .footer-actions {
            margin-top: 2rem;
            padding: 1.5rem 2rem;
            background: var(--primary-dark);
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 10px 30px rgba(234, 88, 12, 0.2);
        }

        .btn-main {
            padding: 0.8rem 1.8rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-save { background: white; color: var(--primary-dark); }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.2); }

        /* Custom Toast Notification */
        #toast {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #1C1917;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            display: none;
            z-index: 2000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state svg {
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .page-header-container { flex-direction: column; align-items: stretch; }
            .navbar { padding: 0.75rem 1rem; }
            .nav-menu { display: none; }
            .footer-actions { flex-direction: column; gap: 1.5rem; text-align: center; }
            .footer-actions > div { flex-direction: column; gap: 1rem; }
            .keterangan-container { min-width: 150px; }
            .action-group { flex-direction: column; gap: 4px; }
            .btn-action { justify-content: center; }
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
            <li>
                <a href="{{ route('guru.dashboard') }}" 
                class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('guru.nilai.index') }}" 
                class="nav-link {{ request()->routeIs('guru.nilai.index') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                    </svg>
                    Input Nilai
                </a>
            </li>
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
        <div class="page-header-container">
            <div class="page-header">
                <h1>Daftar Nilai Siswa</h1>
                <p id="currentMapel">Matematika - Semester Ganjil 2023/2024</p>
            </div>

            <!-- DROP DOWN KELAS -->
            <div class="class-selector-wrapper">
                <label class="label-select">Pilih Kelas :</label>
                <select class="custom-select"
                        onchange="window.location.href='?kelas=' + this.value">
                    <option value="">Pilih Kelas</option>
                    @foreach($daftarKelas as $kelas)
                        <option value="{{ $kelas }}"
                            {{ $kelasTerpilih == $kelas ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="glass-card">
            <div class="table-container">
                <table class="input-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Siswa</th>
                            <th width="120">Nilai</th>
                            <th width="140">Status</th>
                            <th>Keterangan</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="studentBody">
                        @forelse($siswa as $index => $item)
                            @php
                                $nilai = $item->nilai->first();
                                $score = $nilai->nilai ?? null;

                                if ($score === null) {
                                    $status = 'Kosong';
                                    $badgeClass = 'badge-muted';
                                    $keterangan = 'Belum ada nilai';
                                    $keteranganClass = 'empty';
                                    $icon = '⚪';
                                    $nilaiClass = 'empty';
                                    $displayValue = '-';
                                } elseif ($score >= 90) {
                                    $status = 'Sangat Baik';
                                    $badgeClass = 'badge-success';
                                    $keterangan = 'Luar biasa, penguasaan materi sempurna! 🏆';
                                    $keteranganClass = 'excellent';
                                    $icon = '🌟';
                                    $nilaiClass = 'excellent';
                                    $displayValue = $score;
                                } elseif ($score >= 80) {
                                    $status = 'Baik';
                                    $badgeClass = 'badge-success';
                                    $keterangan = 'Sangat baik, pertahankan performa! 👍';
                                    $keteranganClass = 'good';
                                    $icon = '📈';
                                    $nilaiClass = 'good';
                                    $displayValue = $score;
                                } elseif ($score >= 75) {
                                    $status = 'Tuntas';
                                    $badgeClass = 'badge-warning';
                                    $keterangan = 'Lulus KKM, tingkatkan lagi! 💪';
                                    $keteranganClass = 'pass';
                                    $icon = '✅';
                                    $nilaiClass = 'pass';
                                    $displayValue = $score;
                                } elseif ($score >= 50) {
                                    $status = 'Remedial';
                                    $badgeClass = 'badge-danger';
                                    $keterangan = 'Memerlukan bimbingan tambahan. 📚';
                                    $keteranganClass = 'fail';
                                    $icon = '⚠️';
                                    $nilaiClass = 'fail';
                                    $displayValue = $score;
                                } else {
                                    $status = 'Remedial';
                                    $badgeClass = 'badge-danger';
                                    $keterangan = 'Sangat kurang, perlu bimbingan intensif! 🔴';
                                    $keteranganClass = 'fail';
                                    $icon = '🚨';
                                    $nilaiClass = 'fail';
                                    $displayValue = $score;
                                }
                            @endphp

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; color: var(--slate-800);">
                                                {{ $item->name }}
                                            </div>
                                            <div style="font-size: 11px; color: var(--slate-500);">
                                                NIS: {{ $item->nis }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="nilai-display {{ $nilaiClass }}">
                                        {{ $displayValue }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="keterangan-container">
                                        <span class="keterangan-icon">{{ $icon }}</span>
                                        <div class="keterangan-text {{ $keteranganClass }}">
                                            {{ $keterangan }}
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="action-group">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('guru.nilai.edit', $item->id) }}" 
                                           class="btn-action btn-edit">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form method="POST" action="{{ route('guru.nilai.destroy', $item->id) }}" 
                                              style="display: inline;"
                                              onsubmit="return confirm('⚠️ Yakin ingin menghapus data nilai {{ $item->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#D1D5DB" stroke-width="1.5">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                                        </svg>
                                        <h3>Tidak ada siswa di kelas ini</h3>
                                        <p>Silahkan pilih kelas lain atau tambahkan siswa terlebih dahulu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer-actions">
            <div style="display: flex; gap: 3rem;">
                <div>
                    <p style="font-size: 11px; color: var(--slate-200); text-transform: uppercase; letter-spacing: 1px;">Rata-rata Kelas</p>
                    <p id="avgDisplay" style="font-size: 28px; font-weight: 800;">
                        @php
                            $avg = $siswa->avg(function($item) {
                                return $item->nilai->first()->nilai ?? null;
                            });
                        @endphp
                        {{ $avg ? number_format($avg, 1) : '0.0' }}
                    </p>
                </div>
                <div>
                    <p style="font-size: 11px; color: var(--slate-200); text-transform: uppercase; letter-spacing: 1px;">Siswa Terinput</p>
                    <p id="countDisplay" style="font-size: 28px; font-weight: 800;">
                        @php
                            $terinput = $siswa->filter(function($item) {
                                return $item->nilai->first() && $item->nilai->first()->nilai !== null;
                            })->count();
                        @endphp
                        {{ $terinput }} / {{ $siswa->count() }}
                    </p>
                </div>
            </div>
            <a href="{{ route('guru.nilai.create') }}" class="btn-main btn-save">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
                Tambah Nilai Baru
            </a>
        </div>
    </div>

    <div id="toast"></div>

    <script>
        // Toast notification
        function showToast(msg) {
            const toast = document.getElementById('toast');
            toast.innerText = msg;
            toast.style.display = 'block';
            toast.style.transform = 'translateY(20px)';
            toast.style.opacity = '0';
            setTimeout(() => {
                toast.style.transform = 'translateY(0)';
                toast.style.opacity = '1';
            }, 50);
            
            setTimeout(() => {
                toast.style.transform = 'translateY(20px)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300);
            }, 3000);
        }

        // Tampilkan toast jika ada session message
        @if(session('success'))
            showToast('✅ {{ session('success') }}');
        @endif

        @if(session('error'))
            showToast('❌ {{ session('error') }}');
        @endif

        // Konfirmasi hapus dengan toast
        document.querySelectorAll('form[action*="destroy"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('⚠️ Yakin ingin menghapus data nilai ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>