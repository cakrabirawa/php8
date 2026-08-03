<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceProcessRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function store(InvoiceProcessRequest $request): JsonResponse
    {
        // Mengambil semua data yang sudah tervalidasi
        $validated = $request->validated();

        try {
            $invoice = Invoice::create([
                'index_baris'                       => $validated['index_baris'],
                'invoice_number'                    => $validated['Invoice'],
                'company'                           => $validated['Company'],
                'invoice_account'                   => $validated['Invoice account'],
                'name'                              => $validated['Name'],
                'purchase_order'                    => $validated['Purchase order'],
                'invoice_received_date'             => Carbon::createFromFormat('n/j/Y', $validated['Invoice received date']),
                'imported_invoice_amount'           => $validated['Imported invoice amount'],
                'last_match_status'                 => $validated['Last match status'],
                'variance_approved'                 => $validated['Variance approved'] ?? null,
                'product_receipt'                   => $validated['Product receipt'],
                'c_status'                          => $validated['(C) Status'],
                'c_ca_csa_number'                   => $validated['(C) CA/CSA number'] ?? null,
                'c_pool'                            => $validated['(C) Pool'],
                'c_intercompany_sales_invoice'      => $validated['(C) Intercompany sales invoice'] ?? null,
                'c_tax_invoice_number'              => $validated['(C) Tax invoice number'],
                'c_is_total_updated'                => $validated['(C) is total updated'] ?? null,
                'c_is_split_invoice'                => $validated['(C) is split invoice'] ?? null,
                'c_is_split_invoice_return'         => $validated['(C) is split invoice return'] ?? null,
                'created_date_and_time'             => Carbon::createFromFormat('n/j/Y g:i:s A', $validated['Created date and time']),
                'c_ready_to_post_created_datetime'  => Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime']),
            ]);
            Log::info('Invoice API Payload:', $validated);

            return response()->json([
                'success' => true,
                'message' => 'Data invoice berhasil diproses.',
                'data' => [
                    'invoice_number' => $validated['Invoice'],
                    'index_baris' => $validated['index_baris']
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
