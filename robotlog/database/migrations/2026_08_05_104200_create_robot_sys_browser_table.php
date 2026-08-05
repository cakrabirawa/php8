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
        Schema::create('robot_sys_browser', function (Blueprint $table) {
            $table->id();
            $table->dateTime('timestamp');
            $table->boolean('automatic_transaction')->default(false); // Menggunakan boolean untuk status transaksi otomatis
            $table->string('batch_job_id')->nullable();
            $table->text('caption')->nullable(); // Menggunakan text karena caption biasanya berpotensi panjang
            $table->string('invoice_no')->nullable();
            $table->string('company')->nullable();
            $table->string('server_id')->nullable();
            $table->string('status')->nullable(); // Misal: 'Success', 'Failed', 'Pending'
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps(); // Menyediakan kolom created_at dan updated_at bawaan Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_sys_browser');
    }
};
