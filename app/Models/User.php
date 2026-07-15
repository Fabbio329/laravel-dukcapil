<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Biodata
    public function biodata()
    {
        return $this->hasOne(Biodata::class, 'user_id');
    }

    // Relasi ke Pengajuan
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'user_id');
    }

    // Cek Apakah Admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Cek Apakah Warga
    public function isWarga(): bool
    {
        return $this->role === 'warga';
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}