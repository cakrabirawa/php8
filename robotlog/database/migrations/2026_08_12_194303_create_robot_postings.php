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
            
            // invoice_number diberi INDEX karena menjadi kunci pencarian relasi (invoice_no di RobotLog)
            $table->string('invoice_number')->unique()->index();
            
            $table->string('company')->nullable();
            $table->string('invoice_account')->nullable();
            $table->string('name')->nullable();
            $table->string('purchase_order')->nullable();
            
            // Kolom Tanggal & Waktu (Sesuai properti $casts di Model)
            $table->date('invoice_received_date')->nullable();
            $table->datetime('created_date_and_time')->nullable();
            $table->datetime('c_ready_to_post_created_datetime')->nullable();
            
            // Kolom Finansial / Nominal Uang
            $table->decimal('imported_invoice_amount', 15, 2)->nullable();
            
            // Kolom Status & Kategori Tambahan
            $table->string('last_match_status')->nullable();
            $table->string('variance_approved')->nullable();
            $table->string('product_receipt')->nullable();
            $table->string('c_status')->nullable();
            $table->string('c_ca_csa_number')->nullable();
            $table->string('c_pool')->nullable();
            $table->string('c_intercompany_sales_invoice')->nullable();
            $table->string('c_tax_invoice_number')->nullable();
            
            // Kolom Flag / Indikator (Bisa string atau boolean, diset nullable sesuai payload API Anda)
            $table->string('c_is_total_updated')->nullable();
            $table->string('c_is_split_invoice')->nullable();
            $table->string('c_is_split_invoice_return')->nullable();
            
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
