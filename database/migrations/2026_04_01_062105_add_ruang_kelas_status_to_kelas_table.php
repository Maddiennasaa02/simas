<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('ruang_kelas')->nullable()->after('kapasitas');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('ruang_kelas');
        });
    }

    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['ruang_kelas', 'status']);
        });
    }
};