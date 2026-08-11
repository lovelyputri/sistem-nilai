<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuruKelas extends Model
{
    protected $table = 'guru_kelas';

    protected $fillable = [
        'id_user',
        'kelas',
    ];

    public function guruKelas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
