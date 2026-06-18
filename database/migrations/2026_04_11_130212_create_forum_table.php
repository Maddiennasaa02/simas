<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forum', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('set null');
            $table->enum('untuk', ['semua', 'kelas'])->default('semua');
            $table->boolean('is_pinned')->default(false);
            $table->timestamps();
        });

        Schema::create('forum_komentar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forum_id')->constrained('forum')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_komentar');
        Schema::dropIfExists('forum');
    }
};
