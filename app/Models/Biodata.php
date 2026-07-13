<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    // Menghubungkan model secara eksplisit ke tabel fisik di database Anda
    protected $table = 'biodatas';

    // WAJIB DAFTARKAN SEMUA KOLOM INPUT DI SINI
    protected $fillable = [
        'user_id', 
        'nik', 
        'nama', 
        'alamat', 
        'no_hp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}