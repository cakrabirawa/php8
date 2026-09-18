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
        Schema::create('member_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // Kolom desimal dengan 2 angka di belakang koma (contoh: 12.50 untuk 12.5%)
            // Kita beri nilai default 0.00 agar tidak bernilai null secara tidak sengaja
            $table->decimal('discount_percentage', 5, 2)->default(0.00);

            // Relasi ke tabel users (created_by)
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->timestamps();
            $table->softDeletes(); // Wajib ada karena model menggunakan SoftDeletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_types');
    }
};
