<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotSysBrowser;
use Illuminate\Http\JsonResponse;
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
            '*.TimeStamp' => 'nullable|date_format:Y-m-d H:i:s',
            '*.AutomaticTransaction' => 'nullable|string|in:ON,OFF',
            '*.BatchJobId' => 'nullable|string',
            '*.Caption' => 'nullable|string',
            '*.Company' => 'nullable|string',
            '*.ServerId' => 'nullable|string',
            '*.Status' => 'nullable|string',
            '*.StartDate' => 'nullable|date_format:Y-m-d H:i:s',
            '*.EndDate' => 'nullable|date_format:Y-m-d H:i:s',
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

    public function getExecutingCount(Request $request): JsonResponse
    {
        // 1. Validasi input query parameter 'company'
        $validator = Validator::make($request->query(), [
            'company' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter tidak valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        $company = trim($request->query('company'));

        // 2. Hitung jumlah batch_job_id berdasarkan kondisi status dan company
        // Menggunakan Str::lower atau langsung menyamakan case jika database bersifat case-insensitive
        $count = RobotSysBrowser::where('company', $company)
            ->where(function ($query) {
                // Menjaga kecocokan teks jika robot mengirimkan variasi huruf besar/kecil
                $query->where('status', 'EXECUTING')
                    ->orWhere('status', 'executing');
            })
            ->count('batch_job_id'); // Menghitung total data unik/baris berdasarkan batch_job_id

        // 3. Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => "Berhasil mengambil data untuk company: {$company}",
            'data' => [
                'company' => $company,
                'status' => 'EXECUTING',
                'executing_count' => $count
            ]
        ], 200);
    }
}
