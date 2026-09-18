<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLog extends Model
{
    protected $fillable = [
        'RequestStatus',
        'VendInvoiceInfoTable_Num',
        'VendInvoiceInfoTable_dataAreaId',
        'VendInvoiceInfoTable_InvoiceAccount',
        'VendInvoiceInfoTable_PurchName',
        'VendInvoiceInfoTable_PurchId',
        'VendInvoiceInfoTable_ReceivedDate',
        'VendInvoiceInfoTable_DocumentDate',
        'VendInvoiceInfoTable_ImportedAmount',
        'LastMatchVariance',
        'MatchApproved',
        'packingSlipId',
        'VendInvoiceInfoTable_KREInvoiceApprovalStatus',
        'VendInvoiceInfoTable_KRECSA',
        'VendInvoiceInfoTable_KREPurchPoolId',
        'VendInvoiceInfoTable_KREIntercoSalesInv',
        'VendInvoiceInfoTable_KRETaxIDNTaxNum',
        'VendInvoiceInfoTable_KREIsTotalUpdated',
        'VendInvoiceInfoTable_KREIsSplitInvoice',
        'VendInvoiceInfoTable_KREIsSplitInvoiceReturn',
        'VendInvoiceInfoTable_createdDateTime',
        'VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime',
    ];

    protected $casts = [
        'VendInvoiceInfoTable_ReceivedDate' => 'date',
        'VendInvoiceInfoTable_DocumentDate' => 'date',
        'VendInvoiceInfoTable_ImportedAmount' => 'decimal:2',
        'VendInvoiceInfoTable_createdDateTime' => 'datetime',
        'VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime' => 'datetime',
    ];
}
