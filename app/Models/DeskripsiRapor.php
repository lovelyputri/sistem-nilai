<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeskripsiRapor extends Model
{
    protected $table = 'deskripsi_rapor';

    protected $fillable = [
        'id_user',
        'id_siswa',
        'id_mata_pelajaran',
        'predikat',
        'deskripsi',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa'
        );
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(
            MataPelajaran::class,
            'id_mata_pelajaran'
        );
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user'
        );
    }
}
