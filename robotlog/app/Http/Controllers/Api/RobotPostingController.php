<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RobotPosting; // 1. PERBAIKAN: Import model yang benar di sini
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class RobotPostingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // 2. PERBAIKAN: Lakukan validasi skema array payload API agar method validated() bisa bekerja
        $validated = $request->validate([
            'Invoice' => 'required|string',
            'index_baris' => 'nullable',
            'Company' => 'nullable',
            'Invoice account' => 'nullable',
            'Name' => 'nullable',
            'Purchase order' => 'nullable',
            'Invoice received date' => 'nullable',
            'Imported invoice amount' => 'nullable',
            'Last match status' => 'nullable',
            'Variance approved' => 'nullable',
            'Product receipt' => 'nullable',
            '(C) Status' => 'nullable',
            '(C) CA/CSA number' => 'nullable',
            '(C) Pool' => 'nullable',
            '(C) Intercompany sales invoice' => 'nullable',
            '(C) Tax invoice number' => 'nullable',
            '(C) is total updated' => 'nullable',
            '(C) is split invoice' => 'nullable',
            '(C) is split invoice return' => 'nullable',
            'Created date and time' => 'nullable',
            '(C) Ready to Post Created DateTime' => 'nullable',
        ]);

        try {
            // Log payload setelah divalidasi dengan aman
            Log::info('Invoice API Payload:', $validated);

            // 3. PERBAIKAN: Mengamankan parsing tanggal Carbon agar tidak crash saat nilai null/kosong
            $invoiceReceivedDate = !empty($validated['Invoice received date'])
                ? Carbon::createFromFormat('n/j/Y', $validated['Invoice received date'])
                : null;

            $createdDateTime = !empty($validated['Created date and time'])
                ? Carbon::createFromFormat('n/j/Y g:i:s A', $validated['Created date and time'])
                : null;

            $readyToPostDateTime = !empty($validated['(C) Ready to Post Created DateTime'])
                ? Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime'])
                : null;

            if ($readyToPostDateTime) {
                // Mengantisipasi format yang mungkin bervariasi atau butuh penyesuaian khusus
                $readyToPostDateTime = Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime']);
            }

            // Eksekusi pencarian atau pembuatan data baru di database
            $invoice = RobotPosting::firstOrCreate(
                [
                    'invoice_number' => $validated['Invoice'],
                ],
                [
                    'index_baris'                       => $validated['index_baris'] ?? null,
                    'company'                           => $validated['Company'] ?? null,
                    'invoice_account'                   => $validated['Invoice account'] ?? null,
                    'name'                              => $validated['Name'] ?? null,
                    'purchase_order'                    => $validated['Purchase order'] ?? null,
                    'invoice_received_date'             => $invoiceReceivedDate,
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
                    'created_date_and_time'             => $createdDateTime,
                    'c_ready_to_post_created_datetime'  => $readyToPostDateTime,
                    'attempt_posting'                   => 1,
                ]
            );

            $invoice->increment('attempt_posting');

            $isWasRecentlyCreated = $invoice->wasRecentlyCreated;

            return response()->json([
                'success' => true,
                'message' => $isWasRecentlyCreated ? 'Data invoice berhasil diproses.' : 'Data invoice sudah ada, tidak di-insert kembali.',
                'data' => [
                    'invoice_number' => $validated['Invoice'],
                    'index_baris' => $validated['index_baris'] ?? null,
                    'inserted' => $isWasRecentlyCreated
                ]
            ], $isWasRecentlyCreated ? 201 : 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFinalStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string',
            'company' => 'required|string',
            'final_status' => 'nullable|string|max:255',
        ]);

        $company = $validated['company'];
        $invoice_number = $validated['invoice_number'];

        if (blank($company)) {
            return response()->json([
                'success' => false,
                'message' => 'Payload company wajib diisi.',
            ], 422);
        }

        $finalStatus = $validated['final_status'] ?? 'Checked';

        $affectedRows = RobotPosting::query()
            ->whereRaw('upper(TRIM(invoice_number)) = upper(TRIM(?))', [$invoice_number], 'and')
            ->whereRaw('upper(TRIM(company)) = upper(TRIM(?))', [$company], 'and')
            ->update([
                'final_status' => $finalStatus,
                'final_status_checked_date' => now(),
            ]);

        if ($affectedRows === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data RobotPosting tidak ditemukan untuk invoice_number {' . $invoice_number . '} dan company {' . $company . '} tersebut.',
                'data' => [
                    'invoice_number' => $validated['invoice_number'],
                    'company' => $company,
                ],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Final status berhasil diperbarui.',
            'data' => [
                'invoice_number' => $validated['invoice_number'],
                'company' => $company,
                'final_status' => $finalStatus,
                'updated_rows' => $affectedRows,
                'final_status_checked_date' => now()->toDateTimeString(),
            ],
        ]);
    }
}
