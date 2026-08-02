<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_number')->unique();

            // Relasi supplier (asumsi nama tabel: suppliers)
            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
                ->onDelete('set null');

            $table->decimal('grand_total', 15, 2)->default(0.00);
            $table->date('purchase_date');

            // Kolom dari Trait Blameable (created_by & updated_by)
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
