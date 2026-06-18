<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuan_layanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // yang mengajukan
            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->nullOnDelete();
            $table->enum('jenis', [
                'mutasi_masuk', 'mutasi_keluar',
                'surat_keterangan', 'surat_aktif',
                'cetak_nisn', 'cek_pip',
                'izin_penelitian', 'izin_pkl',
                'lainnya'
            ]);
            $table->string('keperluan');
            $table->text('keterangan')->nullable();
            $table->string('lampiran')->nullable();     // file pendukung
            $table->string('no_pengajuan')->unique();   // nomor tiket
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->string('file_hasil')->nullable();   // file output (surat jadi, dll)
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('pengajuan_layanan'); }
};