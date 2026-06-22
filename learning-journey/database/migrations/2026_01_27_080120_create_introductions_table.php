<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('introductions', function (Blueprint $table) {
            $table->id();

            // Relasi ke employees
            $table->string('nik')->unique();

            // ===== FGD SCORES =====
            $table->tinyInteger('fgd_analytic_score')->nullable();
            $table->tinyInteger('fgd_business_score')->nullable();
            $table->tinyInteger('fgd_leadership_score')->nullable();

            // ===== INTERVIEW SCORES =====
            $table->tinyInteger('interview_analytic_score')->nullable();
            $table->tinyInteger('interview_business_score')->nullable();
            $table->tinyInteger('interview_leadership_score')->nullable();

            // ===== NOTES =====
            $table->text('fgd_note')->nullable();
            $table->text('interview_note')->nullable();

            // ===== ADDITIONAL =====
            $table->string('mcu')->nullable();
            $table->string('psikotes')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('pic')->nullable();

            $table->timestamps();

            // Optional foreign key (kalau employee_id di employees)
            // $table->foreign('nik')->references('employee_id')->on('employees')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('introductions');
    }
};
