<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->enum('kategori', [
                'upacara', 'penilaian', 'perpisahan',
                'libur', 'ppdb', 'ekskul', 'rapat', 'lainnya'
            ])->default('lainnya');
            $table->enum('sasaran', ['semua', 'guru', 'siswa', 'wali_murid'])->default('semua');
            $table->boolean('is_published')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('kegiatan'); }
};