<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Rekap kehadiran bulanan per kelas (untuk laporan kepsek)
        Schema::create('rekap_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->tinyInteger('bulan');     // 1-12
            $table->year('tahun');
            $table->integer('total_hadir')->default(0);
            $table->integer('total_sakit')->default(0);
            $table->integer('total_izin')->default(0);
            $table->integer('total_alpa')->default(0);
            $table->integer('total_hari_efektif')->default(0);
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['kelas_id', 'bulan', 'tahun']);
        });

        // Rekap nilai per semester per kelas (untuk laporan kepsek)
        Schema::create('rekap_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->tinyInteger('semester');   // 1 atau 2
            $table->year('tahun_ajaran_mulai'); // 2024 untuk 2024/2025
            $table->decimal('rata_rata_kelas', 5, 2)->default(0);
            $table->decimal('nilai_tertinggi', 5, 2)->default(0);
            $table->decimal('nilai_terendah', 5, 2)->default(0);
            $table->integer('jumlah_tuntas')->default(0);
            $table->integer('jumlah_tidak_tuntas')->default(0);
            $table->timestamps();

            $table->unique(['kelas_id', 'mata_pelajaran_id', 'semester', 'tahun_ajaran_mulai'], 'unique_rekap_nilai');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekap_nilai');
        Schema::dropIfExists('rekap_kehadiran');
    }
};