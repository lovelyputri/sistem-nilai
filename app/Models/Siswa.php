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
        'kelas',
    ];

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_siswa');
    }

    // menghitung rata rata nilai pada siswa secara otomatis
    public function getRataRataAtrribute(): float|null
    {
        $totalMapel = MataPelajaran::count();

        if ($totalMapel === 0) {
            return null;
        }

        $totalNilai = $this->nilai()->sum('nilai');
        $jumlahNilai = $this->nilai()->count();

        if ($jumlahNilai === 0) {
            return null;
        }

        return round($totalNilai / $totalMapel, 2);
    }

    // pengecekan apakah nilai siswa sudah lengkap semua mapel
    public function getLengkapAttribute(): bool 
    {
        $totalMapel = MataPelajaran::count();
        return $this->nilai()->count() >= $totalMapel;
    }
}
