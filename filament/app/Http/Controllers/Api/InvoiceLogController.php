<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvoiceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceLogController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input Data
        $validated = $request->validate([
            'RequestStatus' => 'nullable|string',
            'VendInvoiceInfoTable_Num' => 'required|string',
            'VendInvoiceInfoTable_dataAreaId' => 'required|string',
            'VendInvoiceInfoTable_InvoiceAccount' => 'required|string',
            'VendInvoiceInfoTable_PurchName' => 'required|string',
            'VendInvoiceInfoTable_PurchId' => 'required|string',
            'VendInvoiceInfoTable_ReceivedDate' => 'required|string', // Validasi string dulu untuk dikonversi
            'VendInvoiceInfoTable_DocumentDate' => 'required|string',
            'VendInvoiceInfoTable_ImportedAmount' => 'required|numeric',
            'LastMatchVariance' => 'nullable|string',
            'MatchApproved' => 'nullable|string',
            'packingSlipId' => 'nullable|string',
            'VendInvoiceInfoTable_KREInvoiceApprovalStatus' => 'nullable|string',
            'VendInvoiceInfoTable_KRECSA' => 'nullable|string',
            'VendInvoiceInfoTable_KREPurchPoolId' => 'nullable|string',
            'VendInvoiceInfoTable_KREIntercoSalesInv' => 'nullable|string',
            'VendInvoiceInfoTable_KRETaxIDNTaxNum' => 'nullable|string',
            'VendInvoiceInfoTable_KREIsTotalUpdated' => 'nullable|string',
            'VendInvoiceInfoTable_KREIsSplitInvoice' => 'nullable|string',
            'VendInvoiceInfoTable_KREIsSplitInvoiceReturn' => 'nullable|string',
            'VendInvoiceInfoTable_createdDateTime' => 'required|string',
            'VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime' => 'required|string',
        ]);

        // 2. Konversi Format Tanggal bawaan Payload ke Format Database (Y-m-d)
        $validated['VendInvoiceInfoTable_ReceivedDate'] = Carbon::createFromFormat('m/d/Y', $validated['VendInvoiceInfoTable_ReceivedDate'])->format('Y-m-d');
        $validated['VendInvoiceInfoTable_DocumentDate'] = Carbon::createFromFormat('m/d/Y', $validated['VendInvoiceInfoTable_DocumentDate'])->format('Y-m-d');

        // 3. Konversi Format Waktu/Jam (m/d/Y g:i:s A) ke Format Database (Y-m-d H:i:s)
        $validated['VendInvoiceInfoTable_createdDateTime'] = Carbon::createFromFormat('m/d/Y g:i:s A', $validated['VendInvoiceInfoTable_createdDateTime'])->format('Y-m-d H:i:s');
        $validated['VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime'] = Carbon::createFromFormat('m/d/Y g:i:s A', $validated['VendInvoiceInfoTable_RKGReadytoPostCreatedDateTime'])->format('Y-m-d H:i:s');

        // 4. Simpan Data Baru Ke Database
        $invoice = InvoiceLog::create($validated);

        // 5. Kembalikan Response JSON Sukses
        return response()->json([
            'success' => true,
            'message' => 'Vendor invoice data successfully imported.',
            'data' => $invoice
        ], 201);
    }
}
