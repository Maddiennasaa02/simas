<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->nullable()->constrained('siswa')->nullOnDelete(); // null = prestasi sekolah
            $table->string('nama_lomba');
            $table->string('penyelenggara');
            $table->enum('tingkat', ['sekolah', 'kecamatan', 'kota', 'provinsi', 'nasional', 'internasional']);
            $table->enum('juara', ['1', '2', '3', 'harapan_1', 'harapan_2', 'harapan_3', 'finalis', 'peserta']);
            $table->date('tanggal');
            $table->string('bidang')->nullable();         // akademik, olahraga, seni, dll
            $table->string('foto')->nullable();           // dokumentasi piala/sertifikat
            $table->text('keterangan')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('prestasi'); }
};