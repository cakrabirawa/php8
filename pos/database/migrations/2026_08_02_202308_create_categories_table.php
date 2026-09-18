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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Relasi ke tabel users (created_by)
            // Menggunakan foreignId agar tipe datanya otomatis sama dengan id milik users
            // onDelete('set null') digunakan agar jika user dihapus, data kategori tidak ikut hilang (opsional, bisa diganti cascade)
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); // Wajib ditambahkan karena model menggunakan SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
