<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobLog;
use App\Models\RobotPosting;
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
        $payload = $request->all();
        $items = array_is_list($payload) ? $payload : [$payload];

        // 1. Validasi mendukung array maupun single object payload
        $validator = Validator::make($items, [
            '*.batchJobId' => 'required',
            '*.caption' => 'nullable|string',
            '*.company' => 'required|string',
            '*.status' => 'nullable|string',
            '*.startDateTime' => 'nullable|date',
            '*.endDateTime' => 'nullable|date',
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
        $skippedCount = 0;
        $savedLogs = [];
        $clean = fn($value): ?string => is_null($value) ? null : trim((string) $value);

        try {
            // 2. Gunakan database transaction agar proses massal aman
            DB::transaction(function () use ($items, &$insertedCount, &$updatedCount, &$skippedCount, &$savedLogs, $clean) {
                // Kosongkan tabel sebelum proses isi ulang data batch terbaru.
                RobotSysBrowser::query()->delete();

                foreach ($items as $item) {
                    $captionText = $clean($item['caption'] ?? null);

                    if (blank($captionText) || !Str::startsWith(Str::upper($captionText), 'PURCHASE INVOICE')) {
                        continue;
                    }

                    $batchJobId = $clean($item['batchJobId'] ?? null);

                    $invoiceNo = null;
                    if (filled($captionText)) {
                        $invoiceNo = $clean(Str::after(Str::upper($captionText), 'PURCHASE INVOICE'));
                    }

                    $timestamp = date('Y-m-d H:i:s');

                    $log = RobotSysBrowser::updateOrCreate(
                        ['batch_job_id' => $batchJobId],
                        [
                            'timestamp' => $timestamp,
                            'caption' => $captionText,
                            'invoice_no' => $invoiceNo,
                            'company' => $clean($item['company'] ?? null),
                            'status' => Str::upper($clean($item['status'] ?? null)),
                            'start_date' => $clean($item['startDateTime'] ?? null),
                            'end_date' => $clean($item['endDateTime'] ?? null),
                        ]
                    );

                    // if ($log->wasRecentlyCreated) {
                    //     $insertedCount++;
                    // } else {
                    //     $updatedCount++;
                    // }

                    // // 3. LOGIKA UTAMA: Jika invoice_no ditemukan dan status terakhir belum ENDED, cari di RobotPosting dan increment
                    // if (filled($invoiceNo) && Str::upper((string) $log->status) !== 'ENDED') {
                    //     $robotPosting = RobotPosting::where('invoice_number', $invoiceNo)->first();

                    //     if ($robotPosting) {
                    //         $robotPosting->increment('attempt_posting');
                    //     }
                    // }

                    $savedLogs[] = $log;
                }
            });
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan robot sys browser.',
                'error' => $e->getMessage(),
            ], 500);
        }

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

    public function getErrorBatchJobs(Request $request): JsonResponse
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

        $query = RobotSysBrowser::query()
            ->select(['batch_job_id', 'company', 'invoice_no'])
            ->whereNotIn('batch_job_id', RobotJobLog::query()->select('job_id')->whereNotNull('job_id'))
            ->where(function ($q) {
                $q->where('status', 'ERROR')
                    ->orWhere('status', 'error');
            });

        if ($request->filled('company')) {
            $company = trim((string) $request->query('company'));
            $query->where('company', $company);
        }

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

    public function getEndedBatchJobs(Request $request): JsonResponse
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

        $query = RobotSysBrowser::query()
            ->select(['batch_job_id', 'company', 'invoice_no'])
            ->whereNotIn('batch_job_id', RobotJobLog::query()->select('job_id')->whereNotNull('job_id'))
            ->where(function ($q) {
                $q->where('status', 'ENDED')
                    ->orWhere('status', 'ended');
            });

        if ($request->filled('company')) {
            $company = trim((string) $request->query('company'));
            $query->where('company', $company);
        }

        $records = $query
            ->orderByDesc('id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data status ENDED.',
            'data' => $records,
        ], 200);
    }
}
