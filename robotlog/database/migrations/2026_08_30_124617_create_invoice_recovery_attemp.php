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
        Schema::create('robot_recovery_invoices', function (Blueprint $table) {
            $table->id(); // Field standar: Primary Key (Big Integer Auto-Increment)
            $table->string('invoice_no', 100)->unique(); // varchar(100) dan ditambahkan unique jika diperlukan
            $table->integer('recovery_attempt')->default(0); // int dengan nama standar (perbaikan typo dari attemp)
            $table->timestamps(); // Field standar: created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_recovery_invoices');
    }
};
