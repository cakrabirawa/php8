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
        // Mendefinisikan nama tabel 'robot_postings'
        Schema::create('robot_postings', function (Blueprint $table) {
            $table->id();

            // Kolom Integer & String Utama
            $table->integer('index_baris')->nullable();

            // invoice_no diberi INDEX karena menjadi kunci pencarian relasi (invoice_no di RobotLog)
            $table->string('invoice_no')->unique()->index();

            $table->string('company')->nullable()->index();
            $table->string('invoice_account')->nullable();
            $table->string('name')->nullable();
            $table->string('purchase_order')->nullable();

            // Kolom status akhir hasil pengecekan
            $table->string('final_status', 50)->nullable();
            $table->timestamp('final_status_checked_date')->nullable();

            // Kolom attempt
            $table->integer('posting_attempt')->default(0);
            $table->integer('recovery_attempt')->default(0);

            $table->boolean('sent_email_to_support_status')->nullable();
            $table->timestamp('sent_email_to_support_date')->nullable();

            // Timestamps bawaan Laravel (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('robot_postings');
    }
};
