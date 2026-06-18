<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']);
            $table->tinyInteger('jam_ke');           // urutan jam pelajaran (1, 2, 3, ...)
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('ruangan')->nullable();
            $table->string('semester')->default('1');  // 1 atau 2
            $table->string('tahun_ajaran');             // contoh: 2024/2025
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();

            // Tidak boleh dobel: kelas + hari + jam_ke + semester + tahun_ajaran
            $table->unique(
                ['kelas_id', 'hari', 'jam_ke', 'semester', 'tahun_ajaran'],
                'unique_jadwal_kelas'
            );
        });
    }

    public function down(): void { Schema::dropIfExists('jadwal_pelajaran'); }
};