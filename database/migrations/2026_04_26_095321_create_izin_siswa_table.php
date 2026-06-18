<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('izin_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->foreignId('wali_murid_id')->nullable()->constrained('wali_murid')->nullOnDelete();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('jenis', ['sakit', 'izin', 'dispensasi'])->default('izin');
            $table->text('keterangan');
            $table->string('lampiran')->nullable();   // file surat dokter, dll
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('catatan_guru')->nullable(); // catatan dari wali kelas
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diproses_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('izin_siswa'); }
};