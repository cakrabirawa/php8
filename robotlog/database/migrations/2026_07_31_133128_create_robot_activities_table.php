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
        Schema::create('robot_activities', function (Blueprint $table) {
            $table->id();
            $table->string('robot_name')->unique(); // Dibuat unik agar bisa mendeteksi nama yang sama
            $table->dateTime('robot_last_activity_at');
            $table->string('robot_diff_time_current'); // Menyimpan hasil selisih waktu terakhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_activities');
    }
};
