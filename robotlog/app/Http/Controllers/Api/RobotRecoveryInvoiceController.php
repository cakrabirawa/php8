<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotRecoveryInvoice;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RobotRecoveryInvoiceController extends Controller
{
    public function getReadyToRecoveryBatches(): JsonResponse
    {
        $batches = RobotRecoveryInvoice::where('status', 'READY TO RECOVERY')->get();

        return response()->json([
            'success' => true,
            'data' => $batches,
        ], 200);
    }

    /**
     * Menyimpan invoice baru atau memperbarui data yang sudah ada.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // 1. Hapus aturan 'unique' agar request dengan invoice_no yang sama lolos validasi
            $validated = $request->validate([
                'invoice_no' => 'required|string|max:100',
                'company' => 'required|string|max:50',
            ]);

            // 2. Cari data berdasarkan invoice_no
            $invoice = RobotRecoveryInvoice::where('invoice_no', $validated['invoice_no'])/* ->where('status', 'READY TO RECOVERY') */
                ->first();

            if ($invoice) {
                RobotRecoveryInvoice::where('invoice_no', $validated['invoice_no'])
                    ->where('status', 'READY TO RECOVERY')
                    ->where('company', $validated['company'])
                    ->update([
                        'status' => 'RECOVERING',
                        'recovery_attempt' => DB::raw('recovery_attempt + 1'),
                    ]);
                $message = 'Invoice sudah ada, status berhasil diperbarui.';
                $statusCode = 200; // OK
            } else {
                $validated['status'] = 'READY TO RECOVERY';
                $validated['recover_attempt'] = 1;
                // Jika DATA BARU: Buat records baru dengan nilai input awal
                $invoice = RobotRecoveryInvoice::create($validated);

                $message = 'Invoice baru berhasil disimpan.';
                $statusCode = 201; // Created
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $invoice->refresh(), // Refresh untuk mengambil nilai terbaru dari database
            ], $statusCode);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses data invoice.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
