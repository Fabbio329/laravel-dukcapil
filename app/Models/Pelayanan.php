<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanans';
    protected $fillable = ['nama_layanan'];

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'pelayanan_id');
    }
}