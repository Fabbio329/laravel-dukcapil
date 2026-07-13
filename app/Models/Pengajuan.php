<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';
    protected $fillable = ['user_id', 'pelayanan_id', 'status'];

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

    public function validasi()
    {
        return $this->hasOne(Validasi::class, 'pengajuan_id');
    }
}