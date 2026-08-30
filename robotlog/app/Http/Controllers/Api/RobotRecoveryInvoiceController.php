<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotRecoveryInvoice;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Request;

class RobotRecoveryInvoiceController extends Controller
{
    /**
     * Menyimpan invoice baru atau memperbarui data yang sudah ada.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // 1. Hapus aturan 'unique' agar request dengan invoice_no yang sama lolos validasi
            $validated = $request->validate([
                'invoice_no'       => 'required|string|max:100',
                'recovery_attempt' => 'required|integer|min:0',
            ]);

            // 2. Cari data berdasarkan invoice_no
            $invoice = RobotRecoveryInvoice::where('invoice_no', $validated['invoice_no'])->first();

            if ($invoice) {
                // Jika DATA SUDAH ADA: Naikkan nilai recovery_attempt yang lama sebanyak +1
                $invoice->increment('recovery_attempt');

                // (Opsional) Jika Anda ingin menjumlahkan nilai lama dengan nilai input baru:
                // $invoice->increment('recovery_attempt', $validated['recovery_attempt']);

                $message = 'Invoice sudah ada, recovery_attempt berhasil ditambahkan.';
                $statusCode = 200; // OK
            } else {
                // Jika DATA BARU: Buat records baru dengan nilai input awal
                $invoice = RobotRecoveryInvoice::create($validated);

                $message = 'Invoice baru berhasil disimpan.';
                $statusCode = 201; // Created
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $invoice->refresh() // Refresh untuk mengambil nilai terbaru dari database
            ], $statusCode);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses data invoice.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
