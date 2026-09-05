<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswas';

    protected $fillable = [
        'name',
        'nis',
        'nisn',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'kelas',
        'jurusan',
        'angkatan',
        'tahun_masuk',
        'status',
        'no_hp',
        'email',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke nilai siswa
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    /**
     * Menghitung rata-rata nilai siswa
     */
    public function getRataRataAttribute(): ?float
    {
        $totalMapel = MataPelajaran::count();

        if ($totalMapel === 0) {
            return null;
        }

        $totalNilai = $this->nilai()->sum('nilai');

        return round($totalNilai / $totalMapel, 2);
    }

    /**
     * Mengecek apakah nilai siswa sudah lengkap
     */
    public function getLengkapAttribute(): bool
    {
        $totalMapel = MataPelajaran::count();

        if ($totalMapel === 0) {
            return false;
        }

        return $this->nilai()->count() >= $totalMapel;
    }
}