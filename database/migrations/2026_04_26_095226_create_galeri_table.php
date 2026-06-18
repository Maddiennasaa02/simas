<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe', ['foto', 'video'])->default('foto');
            $table->string('file_path')->nullable();      // path file foto (storage)
            $table->string('url_video')->nullable();      // embed YouTube/link video
            $table->string('thumbnail')->nullable();      // thumbnail untuk video
            $table->string('kategori')->nullable();       // upacara, ekskul, prestasi, dll
            $table->date('tanggal')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('urutan')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('galeri'); }
};