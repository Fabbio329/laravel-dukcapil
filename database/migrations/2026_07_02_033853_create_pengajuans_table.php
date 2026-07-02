<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id('id_pengajuan'); 
            $table->string('nik_pemohon', 16); 
            $table->enum('jenis_layanan', ['KTP Baru', 'KK', 'Akta']);
            $table->enum('status', ['Pending', 'Diproses', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('catatan_petugas')->nullable();
            $table->timestamp('tanggal_submit')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
