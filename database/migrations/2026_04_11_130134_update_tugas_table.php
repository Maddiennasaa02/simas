<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('judul')->after('id');
            $table->text('deskripsi')->nullable()->after('judul');
            $table->string('file')->nullable()->after('deskripsi');
            $table->foreignId('mata_pelajaran_id')->after('file')->constrained('mata_pelajaran')->onDelete('cascade');
            $table->foreignId('kelas_id')->after('mata_pelajaran_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('guru_id')->after('kelas_id')->constrained('guru')->onDelete('cascade');
            $table->datetime('deadline')->nullable()->after('guru_id');
            $table->enum('status', ['aktif', 'selesai', 'draft'])->default('aktif')->after('deadline');
        });
    }

    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['mata_pelajaran_id', 'kelas_id', 'guru_id']);
            $table->dropColumn(['judul', 'deskripsi', 'file', 'mata_pelajaran_id', 'kelas_id', 'guru_id', 'deadline', 'status']);
        });
    }
};
