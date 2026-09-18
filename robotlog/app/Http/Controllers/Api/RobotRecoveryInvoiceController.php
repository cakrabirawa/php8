<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotRecoveryInvoice;
use App\Traits\EmailNotificationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function updateRecoveryStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'invoice_no' => 'required|string|max:100',
            'company' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $invoiceNo = $request->input('invoice_no');
        $company = $request->input('company');

        $updated = RobotRecoveryInvoice::where('invoice_no', $invoiceNo)
            ->where('company', $company)
            ->where('status', 'READY TO RECOVERY')
            ->update([
                'status' => 'RECOVERY ON PROGRESS',
                // 'recovery_attempt' => DB::raw('recovery_attempt + 1'),
            ]);
        // Kirim Email pemberitahuan Recover akan di jalankan
        $emailService = new EmailNotificationService;
        $recoverAttempCount = RobotRecoveryInvoice::query()
            ->where('invoice_no', $invoiceNo)
            ->where('company', $company)
            ->count();
        $recovery_attempt = RobotRecoveryInvoice::query()
            ->where('invoice_no', $invoiceNo)
            ->where('company', $company)
            ->value('recovery_attempt');
        $sMsg = 'Recovery attempt #' . $recoverAttempCount . ' for invoice ' . $invoiceNo . ' is being processed.';
        $emailService->sendEmail('#' . $recoverAttempCount . ' Recovery Invoice ' . $invoiceNo, $sMsg);
        // --------------------------------------------------
        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Status recovery berhasil diperbarui.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status recovery. Pastikan invoice ada dan berstatus READY TO RECOVERY.',
            ], 404);
        }
    }

    public function getNeedRecovery(Request $request): JsonResponse
    {
        $validator = Validator::make($request->query(), [
            'company' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $query = RobotRecoveryInvoice::query()
            ->select(['company', 'invoice_no'])
            ->where(['status' => 'READY TO RECOVERY', 'company' => $request->query('company')]);

        $records = $query
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data status ERROR.',
            'data' => $records,
            'meta' => [
                'total' => $records->count(),
            ],
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

            $currentData = RobotRecoveryInvoice::query()
                ->where(['invoice_no' => $validated['invoice_no'], 'company' => $validated['company']])
                ->whereIn('status', ['READY TO RECOVERY', 'RECOVERY ON PROGRESS'])
                ->first();
            if (!$currentData) {
                $validated['status'] = 'READY TO RECOVERY';
                $validated['recovery_attempt'] = 1;
                // Jika DATA BARU: Buat records baru dengan nilai input awal
                $invoice = RobotRecoveryInvoice::create($validated);
                $message = 'Invoice baru berhasil disimpan.';
                $statusCode = 201; // Created
            } else {
                $message = 'Invoice sudah ada dan berstatus READY TO RECOVERY.';
                $statusCode = 200; // OK
                $invoice = $currentData;
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
