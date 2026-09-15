<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateDeskripsi extends Model
{
    protected $table = 'template_deskripsi';

    protected $fillable = [
        'nama',
        'predikat',
        'deskripsi',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];
}
