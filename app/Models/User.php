<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'nip',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    //relasi

    public function mataPelajaran(): BelongsToMany
    {
        return $this->belongsToMany(MataPelajaran::class,
        'guru_mapel',
        'id_user',
        'id_mata_pelajaran'
        )->withTimestamps();
    }

    public function nilaiDiinput(): HasMany
    {
        return $this->hasMany(Nilai::class, 'id_user');
    }

    public function isAktif(): bool
    {
        return $this->status === 'aktif';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}

