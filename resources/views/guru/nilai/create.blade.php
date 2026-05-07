@extends('layouts.app')

@section('title', 'Daftar Nilai')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Nilai Siswa</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahNilai">
                            <i class="fas fa-plus"></i> Tambah Nilai
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('sukses'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('sukses') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tabelNilai">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nilai</th>
                                    <th>Grade</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($nilaiList as $index => $nilai)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nilai->siswa->nis ?? '-' }}</td>
                                        <td>{{ $nilai->siswa->name ?? '-' }}</td>
                                        <td>{{ $nilai->siswa->kelas ?? '-' }}</td>
                                        <td>{{ $nilai->mataPelajaran->name ?? '-' }}</td>
                                        <td>
                                            <strong class="text-primary">{{ $nilai->nilai }}</strong>
                                        </td>
                                        <td>
                                            @php
                                                $grade = '';
                                                $badgeColor = '';
                                                if($nilai->nilai >= 85) {
                                                    $grade = 'A';
                                                    $badgeColor = 'success';
                                                } elseif($nilai->nilai >= 75) {
                                                    $grade = 'B';
                                                    $badgeColor = 'info';
                                                } elseif($nilai->nilai >= 60) {
                                                    $grade = 'C';
                                                    $badgeColor = 'warning';
                                                } else {
                                                    $grade = 'D';
                                                    $badgeColor = 'danger';
                                                }
                                            @endphp
                                            <span class="badge badge-{{ $badgeColor }} badge-pill">{{ $grade }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('nilai.edit', $nilai->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            <i class="fas fa-database"></i> Belum ada data nilai
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Nilai -->
<div class="modal fade" id="modalTambahNilai" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle"></i> Tambah Nilai Baru
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_siswa">Nama Siswa <span class="text-danger">*</span></label>
                        <select name="id_siswa" id="id_siswa" class="form-control @error('id_siswa') is-invalid @enderror" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswaList as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('id_siswa') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->name }} - Kelas {{ $siswa->kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai">Nilai <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="nilai" 
                               id="nilai" 
                               class="form-control @error('nilai') is-invalid @enderror" 
                               placeholder="Masukkan nilai (0-100)"
                               min="0" 
                               max="100" 
                               step="0.01"
                               value="{{ old('nilai') }}"
                               required>
                        <small class="form-text text-muted">Nilai minimal 0 dan maksimal 100</small>
                        @error('nilai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Mata pelajaran akan diambil dari mata pelajaran yang Anda ajar
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table tbody tr:hover {
        background-color: #f5f5f5;
    }
    .badge-pill {
        padding: 5px 12px;
        font-size: 12px;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabelNilai').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[1, 'asc']]
        });
    });
</script>
@endsection