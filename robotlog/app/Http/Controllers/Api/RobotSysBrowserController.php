<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobLog;
use App\Models\RobotPosting;
use App\Models\RobotSysBrowser;
use App\Traits\Dynamics365Service;
use App\Traits\EmailNotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RobotSysBrowserController extends Controller
{
    public function store(Request $request)
    {
        $payload = $request->all();
        $items = array_is_list($payload) ? $payload : [$payload];

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
                'errors' => $validator->errors(),
            ], 422);
        }

        $insertedCount = 0;
        $updatedCount = 0;
        $skippedCount = 0;
        $savedLogs = [];
        $clean = fn ($value): ?string => is_null($value) ? null : trim((string) $value);

        $emailService = new EmailNotificationService;

        $convertToWib = function ($value) use ($clean) {
            $cleaned = $clean($value);
            if (blank($cleaned)) {
                return null;
            }
            try {
                return Carbon::parse($cleaned)->setTimezone('Asia/Jakarta')->toDateTimeString();
            } catch (\Throwable $e) {
                return null;
            }
        };

        try {
            DB::transaction(function () use ($items, &$insertedCount, &$updatedCount, &$skippedCount, &$savedLogs, $clean, $convertToWib, $emailService) {
                // RobotSysBrowser::query()->delete();
                foreach ($items as $item) {
                    $captionText = $clean($item['caption'] ?? null);
                    $batchJobId = $clean($item['batchJobId'] ?? null);
                    $currentStatus = Str::upper($clean($item['status'] ?? null));
                    $invoiceNo = null;
                    if (filled($captionText)) {
                        $invoiceNo = $clean(Str::after(Str::upper($captionText), 'PURCHASE INVOICE ROBOT'));
                    }
                    $timestamp = Carbon::now('Asia/Jakarta')->toDateTimeString();
                    $startDate = $convertToWib($item['startDateTime'] ?? null);
                    $endDate = $convertToWib($item['endDateTime'] ?? null);
                    $log = RobotSysBrowser::updateOrCreate(
                        ['batch_job_id' => $batchJobId],
                        [
                            'timestamp' => $timestamp,
                            'caption' => $captionText,
                            'invoice_no' => $invoiceNo,
                            'company' => $clean($item['company'] ?? null),
                            'status' => $currentStatus,
                            'start_date' => $startDate,
                            'end_date' => $endDate,
                        ]
                    );
                    if ($log->wasRecentlyCreated) {
                        Log::info('Data ini baru saja di-CREATE (Insert baru).');
                    } else {
                        Log::info('Data ini baru saja di-UPDATE.');
                    }
                    $hasSentEmail = RobotSysBrowser::query()
                        ->where(['batch_job_id' => $batchJobId])
                        ->whereNotNull('send_notif_status')
                        ->first();
                    if (! $hasSentEmail) {
                        if ($currentStatus === 'ERROR') {
                            $b = RobotPosting::query()->where('invoice_number', $invoiceNo)->increment('attempt_recovery');
                            Log::info('Increment Recovery: '.$invoiceNo.' => '.$b);
                            $iIncrement = RobotPosting::select('attempt_recovery')->where('invoice_number', $invoiceNo)->first();
                            $sMsg = 'Terjadi kegagalan dalam pemrosesan Robot Posting dengan Invoice No <b>'.$invoiceNo.'</b> di Batch Job Id <b>'.$batchJobId.'</b>. <br />';
                            if ($iIncrement && $iIncrement->attempt_recovery <= 3) {
                                $sMsg .= 'Proses recovery ke <b>#'.$iIncrement->attempt_recovery.'</b> akan segera dilakukan !';
                                // Update final_status = RECOVERY dan final_status_checked_date = timestamp saat ini
                                RobotPosting::query()
                                    ->where(['invoice_number' => $invoiceNo])
                                    ->update([
                                        'final_status' => '#'.$iIncrement->attempt_recovery.' RECOVERY',
                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                    ]);
                            } else {
                                $sMsg .= 'Proses recovery telah mencapai batas maksimal dan tidak dapat dilakukan lagi. Status Invoice akan dibuat menjadi <b>Failed to Post</b>. Mohon lakukan pengecekan manual.';
                                $sMsg .= '<br /><br />Berikut Error Logs terkait:<br />';
                                $sError = RobotJobLog::select('info')
                                    ->where(['batch_job_id' => $batchJobId, 'invoice_no' => $invoiceNo])
                                    ->pluck('info')
                                    ->implode("\n");
                                $sMsg .= nl2br($sError);
                            }
                            $sMsg .= '<br /><br />Sent from '.env('APP_NAME').' @ '.Carbon::now('Asia/Jakarta')->toDateTimeString();
                            $b = $emailService->sendEmail(
                                '#'.$iIncrement->attempt_recovery.' Recovery Invoice '.$invoiceNo.' ('.$batchJobId.')',
                                $sMsg,
                            );
                            if ($b) {
                                $b = RobotSysBrowser::query()
                                    ->where(['invoice_no' => $invoiceNo, 'batch_job_id' => $batchJobId])->update([
                                        'send_notif_status' => 'SENT',
                                        'send_notif_status_timestamp' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                    ]);
                                Log::info($b);
                                Log::info("Email notifikasi recovery telah dikirim untuk invoice: {$invoiceNo}");
                            }
                            if ($iIncrement->attempt_recovery > 3) {
                                Log::warning("Invoice {$invoiceNo} Update menjadi Failed to Post");
                                // Update final_status = FAILED TO POST dan final_status_checked_date = timestamp saat ini
                                RobotPosting::query()
                                    ->where(['invoice_number' => $invoiceNo])
                                    ->update([
                                        'final_status' => 'FAILED TO POST',
                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                    ]);

                                $token = (new Dynamics365Service)->getAccessToken();
                                if ($token) {
                                    $d365Url = env('D365_UPDATE_FAILED_TO_POST_URL');
                                    $response = Http::withoutVerifying()->withToken($token)->post($d365Url, [
                                        'data' => [
                                            'company' => $clean($item['company'] ?? null),
                                            'invoiceNumber' => $invoiceNo,
                                            'invoiceApprovalStatus' => 7,
                                        ],
                                    ]);
                                    Log::info('D365 Update Failed to Post Response: '.$response->body());
                                } else {
                                    Log::error("Gagal mendapatkan token D365 untuk invoice {$invoiceNo}");
                                }
                            }
                        } else {
                            if ($currentStatus === 'ENDED') {
                                RobotPosting::query()
                                    ->where(['invoice_number' => $invoiceNo])
                                    ->update([
                                        'final_status' => 'POSTING SUCCESS',
                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                    ]);
                                $sMsg = 'Posting berhasil dan sudah melalui pengecekan ketersedian data pada Vendor Open Invoice List untuk invoice '.$invoiceNo.' pada job ('.$batchJobId.')<br />Untuk memastikan hal tersebut silahkan cek pada aplikasi Dynamics 365.';
                                $sMsg .= '<br /><br />Sent from '.env('APP_NAME').' @ '.Carbon::now('Asia/Jakarta')->toDateTimeString();
                                $b = $emailService->sendEmail(
                                    'Posting Invoice '.$invoiceNo.' ('.$batchJobId.')',
                                    $sMsg,
                                );
                            }
                        }
                    }
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
            'data' => $savedLogs,
        ], 200);
    }

    public function getExecutingCount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->query(), [
            'company' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Parameter tidak valid.',
                'errors' => $validator->errors(),
            ], 422);
        }
        $company = trim($request->query('company'));
        $count = RobotSysBrowser::query()
            ->where('company', $company)
            ->whereIn('status', ['EXECUTING', 'executing'])
            ->count();

        return response()->json([
            'success' => true,
            'message' => "Berhasil mengambil data untuk company: {$company}",
            'data' => [
                'company' => $company,
                'status' => 'EXECUTING',
                'executing_count' => $count,
            ],
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
            ->whereDoesntHave('robotJobLogs')
            ->whereIn('status', ['ERROR', 'error']);

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
