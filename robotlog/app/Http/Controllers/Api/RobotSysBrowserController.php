<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotSysBrowser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RobotSysBrowserController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi mendukung Array of Objects (*.)
        $validator = Validator::make($request->all(), [
            '*.TimeStamp' => 'required|date_format:Y-m-d H:i:s',
            '*.AutomaticTransaction' => 'required|string|in:ON,OFF',
            '*.BatchJobId' => 'required|string',
            '*.Caption' => 'required|string',
            '*.Company' => 'required|string',
            '*.ServerId' => 'required|string',
            '*.Status' => 'required|string',
            '*.StartDate' => 'required|date_format:Y-m-d H:i:s',
            '*.EndDate' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal pada beberapa data.',
                'errors' => $validator->errors()
            ], 422);
        }

        $insertedCount = 0;
        $updatedCount = 0;
        $skippedCount = 0; // Tambahan statistik data yang dilewati
        $savedLogs = [];

        // 2. Gunakan Database Transaction agar proses massal aman
        DB::transaction(function () use ($request, &$insertedCount, &$updatedCount, &$skippedCount, &$savedLogs) {
            foreach ($request->all() as $item) {
                $captionText = $item['Caption'];
                $invoiceNo = trim(Str::after(Str::upper($captionText), 'PURCHASE INVOICE'));
                $batchJobId = $item['BatchJobId'];

                // KONDISI BARU: Jika invoiceNo kosong, lewati data ini dan lanjut ke data berikutnya
                // if (empty($invoiceNo)) {
                //     $skippedCount++;
                //     continue;
                // }

                // Cek apakah data sudah ada sebelumnya untuk menghitung statistik log
                $existingData = RobotSysBrowser::where('batch_job_id', $batchJobId)->first();

                // === LOGIKA UPDATE OR CREATE ===
                $log = RobotSysBrowser::updateOrCreate(
                    ['batch_job_id' => $batchJobId], // Kunci unik pencarian
                    [
                        'timestamp' => trim($item['TimeStamp']),
                        'automatic_transaction' => trim($item['AutomaticTransaction']),
                        'caption' => trim($captionText),
                        'invoice_no' => trim($invoiceNo),
                        'company' => trim($item['Company']),
                        'server_id' => trim($item['ServerId']),
                        'status' => trim($item['Status']),
                        'start_date' => trim($item['StartDate']),
                        'end_date' => trim($item['EndDate']),
                    ]
                );

                if ($existingData) {
                    $updatedCount++;
                } else {
                    $insertedCount++;
                }

                $savedLogs[] = $log;
            }
        });

        return response()->json([
            'success' => true,
            'message' => "Proses log selesai. Berhasil menambahkan {$insertedCount} data baru, memperbarui {$updatedCount} data lama, dan melewati {$skippedCount} data tanpa nomor invoice.",
            'data' => $savedLogs
        ], 200);
    }
}
