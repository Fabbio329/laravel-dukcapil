<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodatas';

    // WAJIB: Daftarkan kolom agar bisa disimpan ke database
    protected $fillable = [
        'user_id',
        'nik',
        'nama',
        'alamat',
        'no_hp',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}