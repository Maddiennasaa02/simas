<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            // Info Umum
            $table->string('npsn', 20)->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->enum('status_sekolah', ['Negeri', 'Swasta'])->nullable();
            $table->enum('jenjang', ['SD', 'SMP', 'SMA', 'SMK'])->nullable();
            $table->year('tahun_berdiri')->nullable();
            // Kontak
            $table->string('telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('website')->nullable();
            $table->string('nama_kepala_sekolah')->nullable();
            $table->string('nip_kepala_sekolah', 30)->nullable();
            // Logo & Identitas
            $table->string('logo')->nullable();
            $table->string('nama_singkat', 50)->nullable();
            $table->string('slogan')->nullable();
            // Akreditasi
            $table->enum('akreditasi', ['A', 'B', 'C', 'Belum Terakreditasi'])->nullable();
            $table->year('tahun_akreditasi')->nullable();
            $table->string('nomor_sk_akreditasi', 100)->nullable();
            $table->decimal('nilai_akreditasi', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};