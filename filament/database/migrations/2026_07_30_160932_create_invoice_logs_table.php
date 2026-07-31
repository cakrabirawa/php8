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
        Schema::create('invoice_logs', function (Blueprint $table) {
            $table->id();
            $table->string('RequestStatus')->nullable();
            $table->string('VendInvoiceInfoTable_Num');
            $table->string('VendInvoiceInfoTable_dataAreaId');
            $table->string('VendInvoiceInfoTable_InvoiceAccount');
            $table->string('VendInvoiceInfoTable_PurchName');
            $table->string('VendInvoiceInfoTable_PurchId');
            $table->date('VendInvoiceInfoTable_ReceivedDate');
            $table->date('VendInvoiceInfoTable_DocumentDate');
            $table->decimal('VendInvoiceInfoTable_ImportedAmount', 15, 2)->default(0.00);
            $table->string('LastMatchVariance')->nullable();
            $table->string('MatchApproved')->nullable(); // Menampung nilai seperti "on"
            $table->string('packingSlipId')->nullable();
            $table->string('VendInvoiceInfoTable_KREInvoiceApprovalStatus')->nullable();
            $table->string('VendInvoiceInfoTable_KRECSA')->nullable();
            $table->string('VendInvoiceInfoTable_KREPurchPoolId')->nullable();
            $table->string('VendInvoiceInfoTable_KREIntercoSalesInv')->nullable();
            $table->string('VendInvoiceInfoTable_KRETaxIDNTaxNum')->nullable();
            $table->string('VendInvoiceInfoTable_KREIsTotalUpdated')->nullable();
            $table->string('VendInvoiceInfoTable_KREIsSplitInvoice')->nullable();
            $table->string('VendInvoiceInfoTable_KREIsSplitInvoiceReturn')->nullable();
            $table->dateTime('VendInvoiceInfoTable_createdDateTime');
            $table->dateTime('VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_logs');
    }
};
