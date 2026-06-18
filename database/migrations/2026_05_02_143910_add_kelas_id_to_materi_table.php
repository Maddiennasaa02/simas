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
        if (!Schema::hasColumn('materi', 'kelas_id')) {
            Schema::table('materi', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->after('mata_pelajaran_id')
                    ->nullable() // Biar aman dari error data kosong tadi
                    ->constrained('kelas')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            //
        });
    }
};
