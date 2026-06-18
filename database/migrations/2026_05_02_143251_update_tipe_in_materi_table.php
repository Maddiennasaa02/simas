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
        Schema::table('materi', function (Blueprint $table) {
            // Kita ubah kolom 'tipe' supaya nerima opsi baru
            $table->enum('tipe', ['file', 'link', 'video', 'materi', 'tugas', 'uts', 'uas'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            // Balikin ke asal kalau di-rollback (sesuai migrasi awalmu)
            $table->enum('tipe', ['materi', 'tugas', 'uts', 'uas'])->change();
        });
    }
};
