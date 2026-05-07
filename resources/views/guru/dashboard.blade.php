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
        min-width: 700px;
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

    /* Input Nilai di Tabel */
    .nilai-input {
        width: 100px;
        padding: 0.5rem 0.75rem;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        font-family: inherit;
        font-size: 14px;
        text-align: center;
        transition: all 0.2s;
    }

    .nilai-input:focus {
        outline: none;
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
    }

    .nilai-input.is-invalid {
        border-color: var(--danger);
        background: rgba(239, 68, 68, 0.05);
    }

    /* Button Save */
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--success);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-save:hover {
        background: #059669;
        transform: translateY(-1px);
    }

    .btn-save:disabled {
        background: #9CA3AF;
        cursor: not-allowed;
        transform: none;
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

    /* Loading Spinner */
    .loading-spinner {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
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
        .nilai-input {
            width: 80px;
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

    <!-- FILTER BY KELAS -->
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

    <!-- TABLE NILAI DENGAN KOLOM CREATE -->
    <div class="card">
        <table class="data-table" id="nilaiTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Nilai Saat Ini</th>
                    <th>Input Nilai Baru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($kelasTerpilih) && isset($siswa) && count($siswa) > 0)
                    @forelse ($siswa as $index => $s)
                    @php 
                        $nilaiAktif = optional($s->nilai->first())->nilai;
                        $nilaiId = optional($s->nilai->first())->id;
                        
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
                    <tr data-siswa-id="{{ $s->id }}" data-nilai-id="{{ $nilaiId }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $s->name }}</strong>
                         </td>
                        <td>{{ $s->nis ?? '-' }}</td>
                        <td>
                            <span class="badge-kelas">{{ $s->kelas ?? $kelasTerpilih }}</span>
                         </td>
                        <td>
                            <span class="badge-nilai {{ $badgeClass }}" id="nilaiDisplay{{ $s->id }}">
                                {{ $nilaiLabel }}
                            </span>
                         </td>
                        <td>
                            <input type="number" 
                                   id="nilaiInput{{ $s->id }}"
                                   class="nilai-input" 
                                   placeholder="0-100"
                                   min="0" 
                                   max="100" 
                                   step="0.01"
                                   value="{{ $nilaiAktif ?? '' }}">
                            <div id="errorMsg{{ $s->id }}" style="font-size: 11px; color: var(--danger); margin-top: 4px; display: none;"></div>
                         </td>
                        <td>
                            @if($nilaiAktif !== null)
                                <button class="btn-update" onclick="updateNilai({{ $s->id }}, {{ $nilaiId }})" id="btnAction{{ $s->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                                    </svg>
                                    Update
                                </button>
                            @else
                                <button class="btn-save" onclick="createNilai({{ $s->id }})" id="btnAction{{ $s->id }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                                    </svg>
                                    Simpan
                                </button>
                            @endif
                         </td>
                     </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="empty-state">
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
                    <td colspan="7" class="empty-state">
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

<script>
    const csrfToken = '{{ csrf_token() }}';
    const mataPelajaranId = {{ $mataPelajaran->id ?? 'null' }};

    function applyFilter() {
        const kelas = document.getElementById('filterKelas').value;
        if (kelas) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("guru.nilai.selectClass") }}';
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = csrfToken;
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

    function createNilai(siswaId) {
        const inputElement = document.getElementById(`nilaiInput${siswaId}`);
        const nilai = inputElement.value;
        const errorMsg = document.getElementById(`errorMsg${siswaId}`);
        const btn = document.getElementById(`btnAction${siswaId}`);
        const originalBtnText = btn.innerHTML;
        
        // Validasi
        if (!nilai) {
            errorMsg.textContent = 'Nilai wajib diisi';
            errorMsg.style.display = 'block';
            inputElement.classList.add('is-invalid');
            return;
        }
        
        const nilaiNum = parseFloat(nilai);
        if (isNaN(nilaiNum) || nilaiNum < 0 || nilaiNum > 100) {
            errorMsg.textContent = 'Nilai harus antara 0-100';
            errorMsg.style.display = 'block';
            inputElement.classList.add('is-invalid');
            return;
        }
        
        errorMsg.style.display = 'none';
        inputElement.classList.remove('is-invalid');
        
        // Loading state
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner"></span> Menyimpan...';
        
        // Kirim request
        fetch('{{ route("guru.nilai.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id_siswa: siswaId,
                nilai: nilaiNum,
                id_mata_pelajaran: mataPelajaranId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update tampilan
                const displaySpan = document.getElementById(`nilaiDisplay${siswaId}`);
                const badgeClass = getNilaiBadgeClass(nilaiNum);
                const nilaiLabel = getNilaiLabel(nilaiNum);
                displaySpan.className = `badge-nilai ${badgeClass}`;
                displaySpan.innerHTML = nilaiLabel;
                
                // Ubah tombol dari Simpan jadi Update
                btn.className = 'btn-update';
                btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                                </svg>
                                Update`;
                
                // Simpan nilai_id ke row
                const row = btn.closest('tr');
                row.setAttribute('data-nilai-id', data.nilai_id);
                
                // Update onclick function
                btn.onclick = function() { updateNilai(siswaId, data.nilai_id); };
                
                // Tampilkan notifikasi
                showNotification('success', data.message);
            } else {
                errorMsg.textContent = data.message || 'Terjadi kesalahan';
                errorMsg.style.display = 'block';
                showNotification('error', data.message || 'Gagal menyimpan nilai');
            }
            btn.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            errorMsg.textContent = 'Gagal menyimpan nilai';
            errorMsg.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = originalBtnText;
            showNotification('error', 'Terjadi kesalahan pada server');
        });
    }
    
    function updateNilai(siswaId, nilaiId) {
        const inputElement = document.getElementById(`nilaiInput${siswaId}`);
        const nilai = inputElement.value;
        const errorMsg = document.getElementById(`errorMsg${siswaId}`);
        const btn = document.getElementById(`btnAction${siswaId}`);
        
        // Validasi
        if (!nilai) {
            errorMsg.textContent = 'Nilai wajib diisi';
            errorMsg.style.display = 'block';
            inputElement.classList.add('is-invalid');
            return;
        }
        
        const nilaiNum = parseFloat(nilai);
        if (isNaN(nilaiNum) || nilaiNum < 0 || nilaiNum > 100) {
            errorMsg.textContent = 'Nilai harus antara 0-100';
            errorMsg.style.display = 'block';
            inputElement.classList.add('is-invalid');
            return;
        }
        
        errorMsg.style.display = 'none';
        inputElement.classList.remove('is-invalid');
        
        // Loading state
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner"></span> Mengupdate...';
        
        // Kirim request update
        fetch(`/guru/nilai/${nilaiId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                nilai: nilaiNum
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update tampilan
                const displaySpan = document.getElementById(`nilaiDisplay${siswaId}`);
                const badgeClass = getNilaiBadgeClass(nilaiNum);
                const nilaiLabel = getNilaiLabel(nilaiNum);
                displaySpan.className = `badge-nilai ${badgeClass}`;
                displaySpan.innerHTML = nilaiLabel;
                
                showNotification('success', data.message);
            } else {
                errorMsg.textContent = data.message || 'Terjadi kesalahan';
                errorMsg.style.display = 'block';
                showNotification('error', data.message || 'Gagal mengupdate nilai');
            }
            btn.disabled = false;
            btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                            </svg>
                            Update`;
        })
        .catch(error => {
            console.error('Error:', error);
            errorMsg.textContent = 'Gagal mengupdate nilai';
            errorMsg.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"/>
                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"/>
                            </svg>
                            Update`;
            showNotification('error', 'Terjadi kesalahan pada server');
        });
    }
    
    function getNilaiBadgeClass(nilai) {
        if (nilai === null) return 'belum';
        if (nilai >= 75) return 'bagus';
        if (nilai >= 60) return 'remidi';
        return 'kkn';
    }
    
    function getNilaiLabel(nilai) {
        if (nilai === null) return 'Belum dinilai';
        if (nilai >= 75) return '✅ ' + Math.round(nilai);
        if (nilai >= 60) return '⚠️ ' + Math.round(nilai) + ' (Remidi)';
        return '❌ ' + Math.round(nilai) + ' (KKN)';
    }
    
    function showNotification(type, message) {
        // Buat alert temporary
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type}`;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.maxWidth = '350px';
        alertDiv.style.animation = 'slideDown 0.3s ease';
        alertDiv.innerHTML = `
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20">
                ${type === 'success' ? 
                    '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>' : 
                    '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'
                }
            </svg>
            <span>${message}</span>
        `;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.remove();
        }, 3000);
    }
</script>
@endsection