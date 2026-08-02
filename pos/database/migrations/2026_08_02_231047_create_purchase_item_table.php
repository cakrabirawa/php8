<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id')
                ->constrained('purchases')
                ->onDelete('cascade'); // Jika pembelian dihapus, itemnya ikut terhapus

            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('restrict'); // Mencegah produk dihapus jika ada riwayat beli

            $table->integer('quantity')->default(1);
            $table->decimal('cost_price', 15, 2)->default(0.00);
            $table->decimal('subtotal', 15, 2)->default(0.00);

            // Kolom dari Trait Blameable
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};
