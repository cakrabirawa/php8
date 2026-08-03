<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('index_baris');
            $table->string('invoice_number');
            $table->string('company');
            $table->string('invoice_account');
            $table->string('name');
            $table->string('purchase_order');
            $table->date('invoice_received_date');
            $table->decimal('imported_invoice_amount', 15, 2)->default(0.00);
            $table->string('last_match_status');
            $table->string('variance_approved')->nullable();
            $table->string('product_receipt');
            $table->string('c_status');
            $table->string('c_ca_csa_number')->nullable();
            $table->string('c_pool');
            $table->string('c_intercompany_sales_invoice')->nullable();
            $table->string('c_tax_invoice_number');
            $table->string('c_is_total_updated')->nullable();
            $table->string('c_is_split_invoice')->nullable();
            $table->string('c_is_split_invoice_return')->nullable();
            $table->dateTime('created_date_and_time');
            $table->dateTime('c_ready_to_post_created_datetime');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
