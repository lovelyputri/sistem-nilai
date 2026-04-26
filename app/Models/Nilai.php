<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $table = 'nilais';

    protected $fillable = [
        'id_siswa',
        'id_mata_pelajaran',
        'id_user',
        'nilai',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function mataPelajaran(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
