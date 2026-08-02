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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('member_code')->unique(); // Kode member biasanya unik
            $table->string('name');
            $table->string('phone')->nullable(); // Nomor telepon dibuat nullable jika opsional

            // Relasi ke tabel member_types (member_type_id)
            $table->foreignId('member_type_id')
                ->constrained('member_types')
                ->onDelete('cascade'); // Jika tipe member dihapus, bisa disesuaikan jalurnya

            // Kolom points di-cast sebagai integer, kita beri nilai default 0
            $table->integer('points')->default(0);

            // Relasi ke tabel users (created_by)
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
        Schema::dropIfExists('customers');
    }
};
