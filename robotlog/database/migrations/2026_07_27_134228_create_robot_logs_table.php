<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('robot_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('timestamp');
            $table->string('automatic_transaction', 5); // ON / OFF
            $table->string('batch_job_id');
            $table->string('caption');
            $table->string('company');
            $table->string('invoice_no');
            $table->string('server_id');
            $table->string('status'); // ERROR / SUCCESS
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps(); // Menambahkan created_at dan updated_at bawaan laravel
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('robot_logs');
    }
};
