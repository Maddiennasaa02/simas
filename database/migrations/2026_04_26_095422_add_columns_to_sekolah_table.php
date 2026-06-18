<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Tambahan kolom ke tabel sekolah yang sudah ada
     * (jalankan setelah migrasi sekolah awal)
     */
    public function up(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            if (!Schema::hasColumn('sekolah', 'foto_kepsek'))
                $table->string('foto_kepsek')->nullable()->after('nip_kepala_sekolah');

            if (!Schema::hasColumn('sekolah', 'sambutan_kepsek'))
                $table->text('sambutan_kepsek')->nullable()->after('foto_kepsek');

            if (!Schema::hasColumn('sekolah', 'latitude'))
                $table->decimal('latitude', 10, 7)->nullable()->after('provinsi');

            if (!Schema::hasColumn('sekolah', 'longitude'))
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            if (!Schema::hasColumn('sekolah', 'facebook'))
                $table->string('facebook')->nullable()->after('longitude');

            if (!Schema::hasColumn('sekolah', 'instagram'))
                $table->string('instagram')->nullable()->after('facebook');

            if (!Schema::hasColumn('sekolah', 'youtube'))
                $table->string('youtube')->nullable()->after('instagram');

            if (!Schema::hasColumn('sekolah', 'tahun_ajaran_aktif'))
                $table->string('tahun_ajaran_aktif')->nullable()->after('tahun_berdiri');

            if (!Schema::hasColumn('sekolah', 'semester_aktif'))
                $table->string('semester_aktif')->nullable()->after('tahun_ajaran_aktif');
        });
    }

    public function down(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->dropColumn([
                'foto_kepsek', 'sambutan_kepsek', 'website', 'kode_pos',
                'kelurahan', 'kecamatan', 'kota', 'provinsi',
                'latitude', 'longitude',
                'facebook', 'instagram', 'youtube',
                'tahun_berdiri', 'tahun_ajaran_aktif', 'semester_aktif',
            ]);
        });
    }
};