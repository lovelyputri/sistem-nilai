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

    .header-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
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

    /* Button Create */
    .btn-create {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(234, 88, 12, 0.25);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(234, 88, 12, 0.35);
        color: white;
        text-decoration: none;
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
        padding: 0.6rem 2rem 0.6rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        color: var(--text-dark);
        background: var(--white);
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23EA580C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        min-width: 180px;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    .btn-filter {
        background: var(--primary-light);
        color: var(--white);
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: var(--primary);
        transform: translateY(-1px);
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
        color: white;
        text-decoration: none;
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

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.2s ease;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 24px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-muted);
        transition: color 0.2s;
    }

    .modal-close:hover {
        color: var(--danger);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .form-group label .required {
        color: var(--danger);
    }

    .form-input, .form-select {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23EA580C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
    }

    .btn-modal-cancel {
        padding: 0.6rem 1.25rem;
        background: #f3f4f6;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-modal-cancel:hover {
        background: #e5e7eb;
    }

    .btn-modal-save {
        padding: 0.6rem 1.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s;
    }

    .btn-modal-save:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(234, 88, 12, 0.3);
    }

    .alert-info-modal {
        background: rgba(59, 130, 246, 0.1);
        border-radius: 10px;
        padding: 0.75rem;
        font-size: 12px;
        color: var(--info);
        margin-top: 1rem;
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
        .header-actions {
            width: 100%;
            justify-content: space-between;
        }
        .filter-box {
            flex-direction: column;
            align-items: stretch;
        }
        .filter-select {
            width: 100%;
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
        <div class="header-actions">
            <div class="mapel-badge">
                <span>Mata Pelajaran:</span>
                <span>{{ $mataPelajaran->name ?? 'Belum ada mapel' }}</span>
            </div>
            <button class="btn-create" onclick="openCreateModal()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Nilai Baru
            </button>
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

    <!-- FILTER BY KELAS - DIPERBAGUS -->
    <div class="filter-box">
        <label>📚 Filter Kelas:</label>
        <select id="filterKelas" class="filter-select">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($daftarKelas as $kelas)
                <option value="{{ $kelas }}" {{ ($kelasTerpilih ?? '') == $kelas ? 'selected' : '' }}>
                    🏫 Kelas {{ $kelas }}
                </option>
            @endforeach
        </select>
        <button class="btn-filter" onclick="applyFilter()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14" style="display: inline; margin-right: 6px;">
                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
            </svg>
            Tampilkan
        </button>
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
        <span>🟢 <span style="color: #10B981;">Hijau</span> = Bagus (≥75)</span>
        <span>🟡 <span style="color: #F59E0B;">Kuning</span> = Remidi (60-74)</span>
        <span>🔴 <span style="color: #EF4444;">Merah</span> = KKN (≤59)</span>
        <span>⚪ <span style="color: #6B7280;">Abu-abu</span> = Belum dinilai</span>
    </div>
</div>

<!-- MODAL CREATE NILAI -->
<div id="createModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>➕ Tambah Nilai Baru</h3>
            <button class="modal-close" onclick="closeCreateModal()">&times;</button>
        </div>
        <form action="{{ route('guru.nilai.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Siswa <span class="required">*</span></label>
                    <select name="id_siswa" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        @if(!empty($kelasTerpilih) && isset($siswa))
                            @foreach($siswa as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->name }} - Kelas {{ $s->kelas ?? $kelasTerpilih }} | NIS: {{ $s->nis ?? '-' }}
                                </option>
                            @endforeach
                        @else
                            @foreach($allSiswa ?? [] as $s)
                                <option value="{{ $s->id }}">
                                    {{ $s->name }} - Kelas {{ $s->kelas }} | NIS: {{ $s->nis ?? '-' }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Nilai <span class="required">*</span></label>
                    <input type="number" 
                           name="nilai" 
                           class="form-input" 
                           placeholder="Masukkan nilai (0-100)"
                           min="0" 
                           max="100" 
                           step="0.01"
                           required>
                    <small style="color: var(--text-muted); font-size: 11px;">Nilai minimal 0, maksimal 100</small>
                </div>

                <div class="alert-info-modal">
                    <strong>ℹ️ Informasi:</strong> Mata pelajaran akan diambil dari mata pelajaran yang Anda ajar ({{ $mataPelajaran->name ?? '-' }})
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-cancel" onclick="closeCreateModal()">Batal</button>
                <button type="submit" class="btn-modal-save">Simpan Nilai</button>
            </div>
        </form>
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

    function openCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.add('show');
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    function closeCreateModal() {
        const modal = document.getElementById('createModal');
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('createModal');
        if (event.target === modal) {
            closeCreateModal();
        }
    }
</script>
@endsection