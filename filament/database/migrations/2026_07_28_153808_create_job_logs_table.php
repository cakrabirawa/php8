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
        Schema::create('job_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('duration');
            $table->string('job_id');
            $table->dateTime('timestamp_extracted');
            $table->string('dialog_title');
            $table->text('error_details_log'); // Menggunakan text karena log bisa sangat panjang
            $table->timestamps(); // Menambahkan created_at dan updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_logs');
    }
};
