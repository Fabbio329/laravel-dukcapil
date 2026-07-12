<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans'; // Mengunci nama tabel bahasa Indonesia
    protected $fillable = ['user_id', 'pelayanan_id', 'status'];

    public function user() { return $this->belongsTo(User::class); }
    public function pelayanan() { return $this->belongsTo(Pelayanan::class); }
    public function dokumen() { return $this->hasMany(DokumenPersyaratan::class); }
}
