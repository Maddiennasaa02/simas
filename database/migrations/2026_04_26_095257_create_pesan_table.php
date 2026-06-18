<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('penerima_id')->constrained('users')->onDelete('cascade');
            $table->string('subjek')->nullable();
            $table->text('isi');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('pesan')->nullOnDelete(); // untuk reply
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('pesan'); }
};