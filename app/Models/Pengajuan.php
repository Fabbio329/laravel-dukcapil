<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    // WAJIB ADA 'user_id' DI SINI
    protected $fillable = [
        'user_id', 
        'pelayanan_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class, 'pelayanan_id');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPersyaratan::class, 'pengajuan_id');
    }
}