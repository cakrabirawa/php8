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
            // firstOrCreate( [Kriteria Pencarian], [Data Tambahan Jika Tidak Ditemukan] )
            $invoice = Invoice::firstOrCreate(
                [
                    'invoice_number' => $validated['Invoice'], // Cek apakah nomor ini sudah ada
                ],
                [
                    'index_baris'                       => $validated['index_baris'] ?? null,
                    'company'                           => $validated['Company'] ?? null,
                    'invoice_account'                   => $validated['Invoice account'] ?? null,
                    'name'                              => $validated['Name'] ?? null,
                    'purchase_order'                    => $validated['Purchase order'] ?? null,
                    'invoice_received_date'             => Carbon::createFromFormat('n/j/Y', $validated['Invoice received date'] ?? null),
                    'imported_invoice_amount'           => $validated['Imported invoice amount'] ?? null,
                    'last_match_status'                 => $validated['Last match status'] ?? null,
                    'variance_approved'                 => $validated['Variance approved'] ?? null,
                    'product_receipt'                   => $validated['Product receipt'] ?? null,
                    'c_status'                          => $validated['(C) Status'] ?? null,
                    'c_ca_csa_number'                   => $validated['(C) CA/CSA number'] ?? null,
                    'c_pool'                            => $validated['(C) Pool'] ?? null,
                    'c_intercompany_sales_invoice'      => $validated['(C) Intercompany sales invoice'] ?? null,
                    'c_tax_invoice_number'              => $validated['(C) Tax invoice number'] ?? null,
                    'c_is_total_updated'                => $validated['(C) is total updated'] ?? null,
                    'c_is_split_invoice'                => $validated['(C) is split invoice'] ?? null,
                    'c_is_split_invoice_return'         => $validated['(C) is split invoice return'] ?? null,
                    'created_date_and_time'             => Carbon::createFromFormat('n/j/Y g:i:s A', $validated['Created date and time'] ?? null),
                    'c_ready_to_post_created_datetime'  => Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime'] ?? null),
                ]
            );

            Log::info('Invoice API Payload:', $validated);

            // Cek apakah data baru saja dibuat atau mengambil data lama
            $isWasRecentlyCreated = $invoice->wasRecentlyCreated;

            return response()->json([
                'success' => true,
                'message' => $isWasRecentlyCreated ? 'Data invoice berhasil diproses.' : 'Data invoice sudah ada, tidak di-insert kembali.',
                'data' => [
                    'invoice_number' => $validated['Invoice'],
                    'index_baris' => $validated['index_baris'],
                    'inserted' => $isWasRecentlyCreated // true jika insert baru, false jika data duplikat
                ]
            ], $isWasRecentlyCreated ? 201 : 200); // Response 201 untuk data baru, 200 untuk data yang sudah ada

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
