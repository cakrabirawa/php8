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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Kolom barcode biasanya unik dan bisa berupa string angka/huruf
            $table->string('barcode')->unique()->nullable();
            $table->string('name');

            // Relasi ke tabel categories (category_id)
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade'); // Jika kategori dihapus, produk terkait ikut terhapus (bisa diganti set null jika nullable)

            // Kolom stock di-cast sebagai integer, kita beri nilai default 0
            $table->integer('stock')->default(0);

            // Kolom harga pokok (cost_price) dan harga jual (selling_price) menggunakan desimal 2 angka di belakang koma
            // Panjang total 12 digit (bisa menampung hingga ratusan miliar rupiah)
            $table->decimal('cost_price', 12, 2)->default(0.00);
            $table->decimal('selling_price', 12, 2)->default(0.00);

            // Status aktif menggunakan boolean dengan nilai default true (aktif)
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('products');
    }
};
