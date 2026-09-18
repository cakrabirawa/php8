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
        Schema::create('robot_is_alive', function (Blueprint $table) {
            $table->id();
            $table->string('robot_name');
            $table->dateTime('robot_last_activity_at');
            $table->string('robot_diff_time_current')->nullable(); // Menggunakan string untuk menyimpan selisih waktu (misal: "5 mins ago" atau "00:05:00")
            $table->timestamps(); // Menyediakan kolom created_at dan updated_at

            // Opsional: Tambahkan index jika tabel ini sering dicari berdasarkan nama robot
            $table->index('robot_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_is_alive');
    }
};
