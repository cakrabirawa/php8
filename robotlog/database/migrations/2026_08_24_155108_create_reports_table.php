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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('sql_queries'); // Menyimpan array text SQL (lebih dari 1 statement)
            $table->json('parameters');  // Menyimpan struktur field parameter (nama, tipe, default)
            $table->string('mrt_file');  // Path file .mrt yang diupload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
