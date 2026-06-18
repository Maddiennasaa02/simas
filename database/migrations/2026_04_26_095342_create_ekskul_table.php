<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Daftar ekstrakulikuler
        Schema::create('ekskul', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('hari')->nullable();              // Senin, Selasa, dll
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->foreignId('pembina_id')->nullable()->constrained('guru')->nullOnDelete();
            $table->integer('kuota')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Anggota ekstrakulikuler
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekskul_id')->constrained('ekskul')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('tahun_ajaran');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            $table->unique(['ekskul_id', 'siswa_id', 'tahun_ajaran']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekskul_siswa');
        Schema::dropIfExists('ekskul');
    }
};