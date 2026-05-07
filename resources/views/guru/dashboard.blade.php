@extends('layouts.app')

@section('content')
<style>
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
        --danger: #EF4444;
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

    /* Profile Card */
    .profile-card {
        background: var(--white);
        border-radius: 20px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .profile-info {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .profile-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .profile-label {
        font-size: 12px;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 600;
    }

    .profile-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .mapel-badge {
        background: rgba(234, 88, 12, 0.1);
        color: var(--primary);
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        display: inline-block;
    }

    /* Stats Cards - 3 Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: 20px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
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

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
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

    .progress-bar-custom {
        margin-top: 1rem;
        background: #FED7AA;
        border-radius: 10px;
        height: 6px;
        overflow: hidden;
    }

    .progress-fill {
        background: linear-gradient(90deg, var(--primary-light), var(--primary));
        height: 100%;
        border-radius: 10px;
        transition: width 0.3s ease;
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
        border: none;
        cursor: pointer;
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
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .badge-primary {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .badge-warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .badge-danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--text-muted);
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .profile-info {
            flex-direction: column;
            gap: 0.75rem;
        }
        .data-table th, .data-table td {
            padding: 0.75rem 1rem;
        }
    }
</style>

<div class="main-content">
    <!-- WELCOME SECTION -->
    <div class="welcome-section">
        <h2>Selamat datang, {{ $guru->name }}! 👋</h2>
        <p>Pantau aktivitas mengajar Anda. Berikut ringkasan data pembelajaran Anda hari ini.</p>
    </div>

    <!-- PROFILE CARD -->
    <div class="profile-card">
        <div class="profile-info">
            <div class="profile-item">
                <span class="profile-label">Nama Guru</span>
                <span class="profile-value">{{ $guru->name }}</span>
            </div>
            <div class="profile-item">
                <span class="profile-label">Mata Pelajaran</span>
                <span class="mapel-badge">📚 {{ $mataPelajaran->name ?? 'Belum ditentukan' }}</span>
            </div>
        </div>
    </div>

    <!-- STATISTICS CARDS - 3 CARDS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(234, 88, 12, 0.1);">
                <svg viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" width="26" height="26">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-value">{{ $totalSiswa }}</div>
            <div class="stat-label">Total Siswa</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1);">
                <svg viewBox="0 0 24 24" fill="none" stroke="var(--success)" stroke-width="2" width="26" height="26">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
            </div>
            <div class="stat-value">{{ $sudahDiinput }}</div>
            <div class="stat-label">Nilai Diinput</div>
            <div class="progress-bar-custom">
                <div class="progress-fill" style="width: {{ $totalSiswa > 0 ? ($sudahDiinput / $totalSiswa) * 100 : 0 }}%"></div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1);">
                <svg viewBox="0 0 24 24" fill="none" stroke="var(--warning)" stroke-width="2" width="26" height="26">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 6v6l4 2"/>
                </svg>
            </div>
            <div class="stat-value">{{ $totalSiswa - $sudahDiinput }}</div>
            <div class="stat-label">Belum Dinilai</div>
        </div>
    </div>

    <!-- NILAI TERBARU TABLE -->
    <div class="card">
        <div class="card-header">
            <h3>📋 Nilai Terbaru (5 data terakhir)</h3>
            <a href="{{ url('/guru/nilai/create') }}" class="btn-add">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Input Nilai
            </a>
        </div>

        @if($nilaiDiinput->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Mata Pelajaran</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiDiinput as $index => $n)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $n->siswa->name ?? 'Tidak diketahui' }}</strong></td>
                        <td>{{ $n->mataPelajaran->name ?? '-' }}</td>
                        <td><span style="font-size: 18px; font-weight: 700; color: var(--text-dark);">{{ $n->nilai }}</span></td>
                        <td>
                            @if($n->nilai >= 85)
                                <span class="badge badge-success">🎉 Sangat Baik</span>
                            @elseif($n->nilai >= 70)
                                <span class="badge badge-primary">👍 Baik</span>
                            @elseif($n->nilai >= 60)
                                <span class="badge badge-warning">📖 Cukup</span>
                            @else
                                <span class="badge badge-danger">⚠️ Perbaikan</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($sudahDiinput > 5)
                <div style="padding: 1rem 1.5rem; text-align: center; border-top: 1px solid var(--border);">
                    <a href="{{ url('/guru/nilai') }}" style="color: var(--primary); text-decoration: none; font-weight: 500;">
                        Lihat Semua Nilai ({{ $sudahDiinput }}) →
                    </a>
                </div>
            @endif
        @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <line x1="8" y1="10" x2="16" y2="10"/>
                </svg>
                <p>Belum ada nilai yang diinput</p>
                <a href="{{ url('/guru/nilai/create') }}" class="btn-add" style="margin-top: 1rem; display: inline-flex;">+ Input Nilai Pertama</a>
            </div>
        @endif
    </div>
</div>
@endsection