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
        --danger: #EF4444;
        --info: #3B82F6;
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

    .mapel-badge {
        background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
        padding: 0.5rem 1.5rem;
        border-radius: 40px;
        border: 1px solid var(--border);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .mapel-badge span:first-child {
        font-size: 14px;
        color: var(--text-muted);
    }

    .mapel-badge span:last-child {
        font-weight: 700;
        color: var(--primary);
    }

    /* Filter Box */
    .filter-box {
        background: var(--white);
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .filter-box label {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        color: var(--text-dark);
        background: var(--white);
        cursor: pointer;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-light);
    }

    .btn-filter {
        background: var(--primary-light);
        color: var(--white);
        padding: 0.5rem 1rem;
        border-radius: 10px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: var(--primary);
    }

    /* Stat Card */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: var(--white);
        border-radius: 16px;
        padding: 1rem 1.25rem;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .stat-card .stat-label {
        font-size: 12px;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .stat-card .stat-unit {
        font-size: 12px;
        color: var(--text-muted);
        margin-left: 0.25rem;
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
        min-width: 600px;
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

    /* Badge Nilai dengan Warna */
    .badge-nilai {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        text-align: center;
        min-width: 110px;
    }

    .badge-nilai.bagus {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .badge-nilai.remidi {
        background: rgba(245, 158, 11, 0.15);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .badge-nilai.kkn {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-nilai.belum {
        background: rgba(156, 163, 175, 0.15);
        color: #6B7280;
        border: 1px solid rgba(156, 163, 175, 0.3);
    }

    /* Badge Kelas */
    .badge-kelas {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: rgba(249, 115, 22, 0.1);
        color: var(--primary);
    }

    /* Button Update */
    .btn-update {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--primary-light);
        color: var(--white);
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-update:hover {
        background: var(--primary);
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

    /* Footer Info */
    .footer-info {
        margin-top: 1rem;
        text-align: center;
        font-size: 12px;
        color: var(--text-muted);
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .footer-info span {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-content {
            padding: 1rem;
        }
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .filter-box {
            flex-direction: column;
            align-items: stretch;
        }
        .stat-grid {
            grid-template-columns: 1fr;
        }
        .footer-info {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
</style>

<div class="main-content">
    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1>📝 Input Nilai Siswa</h1>
        <div class="mapel-badge">
            <span>Mata Pelajaran:</span>
            <span>{{ $mataPelajaran->name }}</span>
        </div>
    </div>

    <!-- SESSION MESSAGES -->
    @if(session('success'))
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- FILTER BY KELAS -->
    <div class="filter-box">
        <label>Pilih Kelas:</label>
        <select id="filterKelas" class="filter-select">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($daftarKelas as $kelas)
                <option value="{{ $kelas }}" {{ ($kelasTerpilih ?? '') == $kelas ? 'selected' : '' }}>
                    Kelas {{ $kelas }}
                </option>
            @endforeach
        </select>
        <button class="btn-filter" onclick="applyFilter()">Tampilkan</button>
    </div>

    <!-- STATISTIK CARDS -->
    @if(!empty($kelasTerpilih) && isset($siswa) && count($siswa) > 0)
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-label">TOTAL SISWA</div>
            <div class="stat-value">{{ count($siswa) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">SUDAH DINILAI</div>
            <div class="stat-value">
                {{ $siswa->filter(fn($s) => optional($s->nilai->first())->nilai)->count() }}
                <span class="stat-unit">/ {{ count($siswa) }}</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">RATA-RATA KELAS</div>
            <div class="stat-value">
                @php
                    $rata = $siswa->avg(fn($s) => optional($s->nilai->first())->nilai);
                @endphp
                {{ $rata ? number_format($rata, 2) : '-' }}
            </div>
        </div>
    </div>
    @endif

    <!-- TABLE NILAI -->
    <div class="card">
        <table class="data-table" id="nilaiTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Nilai Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($kelasTerpilih) && isset($siswa) && count($siswa) > 0)
                    @forelse ($siswa as $index => $s)
                    @php 
                        $nilaiAktif = optional($s->nilai->first())->nilai;
                        
                        function getNilaiBadgeClass($nilai) {
                            if ($nilai === null) return 'belum';
                            if ($nilai >= 75) return 'bagus';
                            if ($nilai >= 60) return 'remidi';
                            return 'kkn';
                        }
                        
                        function getNilaiLabel($nilai) {
                            if ($nilai === null) return 'Belum dinilai';
                            if ($nilai >= 75) return '✅ ' . number_format($nilai, 0);
                            if ($nilai >= 60) return '⚠️ ' . number_format($nilai, 0) . ' (Remidi)';
                            return '❌ ' . number_format($nilai, 0) . ' (KKN)';
                        }
                        
                        $badgeClass = getNilaiBadgeClass($nilaiAktif);
                        $nilaiLabel = getNilaiLabel($nilaiAktif);
                    @endphp
                    <tr data-kelas="{{ $s->kelas ?? $kelasTerpilih }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $s->name }}</strong>
                        </td>
                        <td>{{ $s->nis ?? '-' }}</td>
                        <td>
                            <span class="badge-kelas">{{ $s->kelas ?? $kelasTerpilih }}</span>
                        </td>
                        <td>
                            <span class="badge-nilai {{ $badgeClass }}">
                                {{ $nilaiLabel }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('guru.nilai.edit', $s->id) }}" class="btn-update">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                                </svg>
                                Update Nilai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                            <p>Belum ada data siswa</p>
                        </td>
                    </tr>
                    @endforelse
                @else
                <tr>
                    <td colspan="6" class="empty-state">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="48" height="48">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <p>Silakan pilih kelas terlebih dahulu</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- FOOTER INFO + LEGEND WARNA -->
    <div class="footer-info">
        <span style="color: #10B981;">Hijau</span> = Bagus (≥75)</span>
        <span style="color: #F59E0B;">Kuning</span> = Remidi (60-74)</span>
        <span style="color: #EF4444;">Merah</span> = KKN (≤59)</span>
        <span style="color: #6B7280;">Abu-abu</span> = Belum dinilai</span>
    </div>
</div>

<script>
    function applyFilter() {
        const kelas = document.getElementById('filterKelas').value;
        if (kelas) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("guru.nilai.selectClass") }}';
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'kelas';
            input.value = kelas;
            form.appendChild(csrf);
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection