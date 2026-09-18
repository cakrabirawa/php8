<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotPosting;
use Carbon\Carbon; // 1. PERBAIKAN: Import model yang benar di sini
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RobotPostingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // 2. PERBAIKAN: Lakukan validasi skema array payload API agar method validated() bisa bekerja
        $validated = $request->validate([
            'Invoice' => 'required|string',
            'Company' => 'nullable',
            'Invoice account' => 'nullable',
            'Name' => 'nullable',
            'Purchase order' => 'nullable',
        ]);

        try {
            // Log payload setelah divalidasi dengan aman
            Log::info('Invoice API Payload:', $validated);

            // 3. PERBAIKAN: Mengamankan parsing tanggal Carbon agar tidak crash saat nilai null/kosong
            $invoiceReceivedDate = ! empty($validated['Invoice received date'])
                ? Carbon::createFromFormat('n/j/Y', $validated['Invoice received date'])
                : null;

            $createdDateTime = ! empty($validated['Created date and time'])
                ? Carbon::createFromFormat('n/j/Y g:i:s A', $validated['Created date and time'])
                : null;

            $readyToPostDateTime = ! empty($validated['(C) Ready to Post Created DateTime'])
                ? Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime'])
                : null;

            if ($readyToPostDateTime) {
                // Mengantisipasi format yang mungkin bervariasi atau butuh penyesuaian khusus
                $readyToPostDateTime = Carbon::createFromFormat('n/j/Y g:i:s A', $validated['(C) Ready to Post Created DateTime']);
            }

            // Eksekusi pencarian atau pembuatan data baru di database
            $invoice = RobotPosting::firstOrCreate(
                [
                    'invoice_no' => $validated['Invoice'],
                ],
                [
                    'company' => $validated['Company'] ?? null,
                    'invoice_account' => $validated['Invoice account'] ?? null,
                    'name' => $validated['Name'] ?? null,
                    'purchase_order' => $validated['Purchase order'] ?? null,
                    'posting_attempt' => 0,
                ]
            );

            $invoice->increment('posting_attempt');

            $isWasRecentlyCreated = $invoice->wasRecentlyCreated;

            return response()->json([
                'success' => true,
                'message' => $isWasRecentlyCreated ? 'Data invoice berhasil diproses.' : 'Data invoice sudah ada, tidak di-insert kembali.',
                'data' => [
                    'invoice_no' => $validated['Invoice'],
                    'index_baris' => $validated['index_baris'] ?? null,
                    'inserted' => $isWasRecentlyCreated,
                ],
            ], $isWasRecentlyCreated ? 201 : 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateFinalStatus(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'invoice_no' => 'required|string',
            'company' => 'required|string',
            'final_status' => 'nullable|string|max:255',
        ]);

        $company = $validated['company'];
        $invoice_no = $validated['invoice_no'];

        if (blank($company)) {
            return response()->json([
                'success' => false,
                'message' => 'Payload company wajib diisi.',
            ], 422);
        }

        $finalStatus = $validated['final_status'] ?? 'Checked';

        $affectedRows = RobotPosting::query()
            ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(?))', [$invoice_no], 'and')
            ->whereRaw('upper(TRIM(company)) = upper(TRIM(?))', [$company], 'and')
            ->update([
                'final_status' => $finalStatus,
                'final_status_checked_date' => now(),
            ]);

        if ($affectedRows === 0) {
            return response()->json([
                'success' => false,
                'message' => 'Data RobotPosting tidak ditemukan untuk invoice_no {'.$invoice_no.'} dan company {'.$company.'} tersebut.',
                'data' => [
                    'invoice_no' => $validated['invoice_no'],
                    'company' => $company,
                ],
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Final status berhasil diperbarui.',
            'data' => [
                'invoice_no' => $validated['invoice_no'],
                'company' => $company,
                'final_status' => $finalStatus,
                'updated_rows' => $affectedRows,
                'final_status_checked_date' => now()->toDateTimeString(),
            ],
        ]);
    }
}
