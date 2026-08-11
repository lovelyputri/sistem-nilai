<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajarans';

    protected $fillable = [
        'name',
        'kode',
        'keterangan'
    ];

    public function gurus(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'guru_mapel',
            'id_mata_pelajaran',
            'id_user'
        )->where('users.role', 'guru'); // qualify kolom 'role' dengan nama tabel
                                        // supaya tidak ambigu saat dipakai di withCount()
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_mata_pelajaran');
    }
}
