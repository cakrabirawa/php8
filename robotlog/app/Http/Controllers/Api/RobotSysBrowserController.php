<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobLog;
use App\Models\RobotPosting;
use App\Models\RobotRecoveryInvoice;
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

        $insertedCount = $updatedCount = $skippedCount = 0;
        $savedLogs = [];
        $clean = fn($value): ?string => is_null($value) ? null : trim((string) $value);

        $START1 = '(C) Recover pending vendor invoice Robot';
        $START2 = 'Purchase invoice Robot';

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
            DB::transaction(function () use ($items, &$insertedCount, &$updatedCount, &$skippedCount, &$savedLogs, $clean, $convertToWib, $emailService, $START1, $START2) {
                $dearUser = 'Dear User,<br /><br />';
                $nLimit = 3;
                foreach ($items as $item) {
                    $captionText = $clean($item['caption'] ?? null);
                    if (str_starts_with($captionText, $START1) || str_starts_with($captionText, $START2)) {
                        $batchJobId = $clean($item['batchJobId'] ?? null);
                        $currentStatus = Str::upper($clean($item['status'] ?? null));
                        $invoiceNo = $type = null;
                        //--------------------------------------------------------------------------------------------------------------
                        if (str_starts_with($captionText, $START1)) {
                            $invoiceNo = filled($captionText) ? $clean(Str::after(Str::upper($captionText), Str::upper($START1))) : null;
                            $type = 'RECOVERING';
                        } elseif (str_starts_with($captionText, $START2)) {
                            $invoiceNo = filled($captionText) ? $clean(Str::after(Str::upper($captionText), Str::upper($START2))) : null;
                            $type = 'POSTING';
                        }
                        //--------------------------------------------------------------------------------------------------------------
                        if (blank($invoiceNo)) {
                            $skippedCount++;
                        }
                        //--------------------------------------------------------------------------------------------------------------
                        $timestamp = Carbon::now('Asia/Jakarta')->toDateTimeString();
                        $startDate = $convertToWib($item['startDateTime'] ?? null);
                        $endDate = $convertToWib($item['endDateTime'] ?? null);
                        //--------------------------------------------------------------------------------------------------------------
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
                                'type' => $type,
                            ]
                        );
                        //--------------------------------------------------------------------------------------------------------------
                        if ($log->wasRecentlyCreated) {
                            $insertedCount++;
                        } else {
                            $updatedCount++;
                        }
                        //--------------------------------------------------------------------------------------------------------------
                        $hasSentEmail = RobotSysBrowser::query()
                            ->where(['batch_job_id' => $batchJobId])
                            ->whereNotNull('send_notif_status')
                            ->first();
                        //--------------------------------------------------------------------------------------------------------------
                        if (! $hasSentEmail) {
                            if ($type === 'POSTING') {
                                $robotPosting = RobotPosting::query()->where('invoice_no', $invoiceNo)->first();
                                if ($robotPosting) {
                                    $start = Carbon::parse($startDate);
                                    $end = Carbon::parse($endDate);
                                    $diff = $start->diffAsCarbonInterval($end)->forHumans(['short' => false]);
                                    if ($currentStatus === 'ERROR') {
                                        $rowAffected = RobotPosting::query()->where('invoice_no', $invoiceNo)->increment('recovery_attempt');
                                        if ($rowAffected > 0) {
                                            Log::alert('==================' . $robotPosting->recovery_attempt);
                                            Log::info('Increment Recovery Berhasil: ' . $invoiceNo . ' => ' . $robotPosting->recovery_attempt);
                                            $sMsg = $dearUser . 'Terjadi kegagalan dalam pemrosesan Robot Posting dengan Invoice No <b>' . $invoiceNo . '</b> di Batch Job Id <b>' . $batchJobId . '</b>. Durasi ' . $diff . '.<br />';
                                            if ($robotPosting->recovery_attempt <= $nLimit) {
                                                $robotPosting = RobotPosting::query()->where('invoice_no', $invoiceNo)->first();
                                                $sMsg .= 'Proses recovery ke <b># ' . $robotPosting->recovery_attempt . '</b> akan segera dilakukan !';
                                                RobotPosting::query()
                                                    ->where(['invoice_no' => $invoiceNo])
                                                    ->update([
                                                        'final_status' => '# ' . $robotPosting->recovery_attempt . ' RECOVERY',
                                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                    ]);
                                                // Log::alert('==================123');
                                                RobotRecoveryInvoice::create([
                                                    'invoice_no' => $invoiceNo,
                                                    'recovery_attempt' => $robotPosting->recovery_attempt,
                                                    'status' => 'READY TO RECOVERY',
                                                    'company' => $clean($item['company'] ?? null),
                                                ]);
                                                // Log::alert('==================321');
                                            } else {
                                                $sMsg .= 'Proses recovery telah mencapai batas maksimal yaitu <b>' . $nLimit . '</b> kali dan tidak dapat dilakukan lagi. Status Invoice akan dibuat menjadi <b>Failed to Post</b>. Mohon lakukan pengecekan manual di aplikasi Dynamics 365.';
                                                $sMsg .= '<br /><br />Berikut Error Logs terkait:<br />';
                                                $sError = RobotJobLog::select('info')
                                                    ->where(['invoice_no' => $invoiceNo])
                                                    ->pluck('info')
                                                    ->implode("\n");
                                                $sMsg .= nl2br($sError);
                                                Log::warning("Invoice {$invoiceNo} Update menjadi Failed to Post");
                                                RobotPosting::query()
                                                    ->where(['invoice_no' => $invoiceNo])
                                                    ->update([
                                                        'final_status' => 'FAILED TO POST',
                                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                    ]);
                                                $token = (new Dynamics365Service)->getAccessToken();
                                                if ($token) {
                                                    $d365Url = config('services.d365.update_failed_to_post_url');
                                                    $response = Http::withoutVerifying()->withToken($token)->post($d365Url, [
                                                        'data' => [
                                                            'company' => $clean($item['company'] ?? null),
                                                            'invoiceNumber' => $invoiceNo,
                                                            'invoiceApprovalStatus' => 7,
                                                        ],
                                                    ]);
                                                    Log::info('D365 Update Failed to Post Response: ' . $response->body());
                                                } else {
                                                    Log::error("Gagal mendapatkan token D365 untuk invoice {$invoiceNo}");
                                                }
                                            }

                                            $sMsg .= '<br /><br />Sent from ' . env('APP_NAME') . ' @ ' . Carbon::now('Asia/Jakarta')->toDateTimeString() . '<br />Robot Posting Invoice Automation Application (C) System IT Departement 2026';
                                            $emailService->sendEmail('#' . $robotPosting->recovery_attempt . ' Recovery Invoice ' . $invoiceNo . ' (' . $batchJobId . ')', $sMsg);
                                            RobotSysBrowser::query()
                                                ->where(['invoice_no' => $invoiceNo, 'batch_job_id' => $batchJobId])->update([
                                                    'send_notif_status' => 'SENT',
                                                    'send_notif_status_timestamp' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                ]);
                                            Log::info("Email notifikasi recovery telah dikirim untuk invoice: {$invoiceNo}");
                                        } else {
                                            Log::error("Gagal melakukan recovery: Invoice No {$invoiceNo} tidak ditemukan pada tabel robot_postings.");
                                            RobotSysBrowser::query()
                                                ->where(['batch_job_id' => $batchJobId])->update([
                                                    'send_notif_status' => 'SKIPPED',
                                                    'send_notif_status_timestamp' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                ]);
                                        }
                                    } elseif ($currentStatus === 'ENDED') {
                                        $token = (new Dynamics365Service)->getAccessToken();
                                        // Log::info('Token: '.$token);
                                        if ($token) {
                                            $d365Url = config('services.d365.check_vendor_open_invoice_url');
                                            $response = Http::withoutVerifying()->withToken($token)->post($d365Url, [
                                                'data' => [
                                                    'company' => $clean($item['company'] ?? null),
                                                    'invoiceNumber' => $invoiceNo,
                                                ],
                                            ]);
                                            Log::info('D365 Check Vendor Open Invoice Response: ' . $response->body());
                                            $status = $response->json('Status');
                                            if ($status === 'Success') {
                                                Log::info("Vendor Open Invoice check successful for invoice {$invoiceNo}");
                                                RobotPosting::query()
                                                    ->where(['invoice_no' => $invoiceNo])
                                                    ->update([
                                                        'final_status' => 'POSTING SUCCESS',
                                                        'final_status_checked_date' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                    ]);
                                                RobotSysBrowser::query()
                                                    ->where(['invoice_no' => $invoiceNo, 'batch_job_id' => $batchJobId])->update([
                                                        'send_notif_status' => 'SENT',
                                                        'send_notif_status_timestamp' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                                    ]);
                                                $sMsg = $dearUser . 'Posting berhasil dan sudah melalui pengecekan ketersedian data pada Vendor Open Invoice List untuk Invoice No <b>' . $invoiceNo . '</b> pada Batch Job Id (<b>' . $batchJobId . '</b>). Durasi ' . $diff . '.<br />Untuk memastikan hal tersebut silahkan cek pada aplikasi Dynamics 365.';
                                                $sMsg .= '<br /><br />Sent from ' . env('APP_NAME') . ' @ ' . Carbon::now('Asia/Jakarta')->toDateTimeString() . '<br />Robot Posting Invoice Automation Application (C) System IT Departement 2026';
                                                $emailService->sendEmail(
                                                    'Posting Invoice ' . $invoiceNo . ' (' . $batchJobId . ')',
                                                    $sMsg
                                                );
                                            } else {
                                                $sMsg = $dearUser . 'Proses posting untuk Invoice No <b>' . $invoiceNo . '</b> pada Batch Job Id (<b>' . $batchJobId . '</b>) dengan durasi ' . $diff . ' sudah berakhir, namun invoice tersebut tidak ditemukan pada Vendor Open Invoice List. Silahkan cek lebih lanjut pada aplikasi Dynamics 365.';
                                                $sMsg .= '<br /><br />Sent from ' . env('APP_NAME') . ' @ ' . Carbon::now('Asia/Jakarta')->toDateTimeString() . '<br />Robot Posting Invoice Automation Application (C) System IT Departement 2026';
                                                $emailService->sendEmail(
                                                    'Vendor Open Invoice Check Failed for Invoice ' . $invoiceNo . ' (' . $batchJobId . ')',
                                                    $sMsg,
                                                );
                                                Log::error("Vendor Open Invoice check failed for invoice {$invoiceNo}");
                                            }
                                        } else {
                                            Log::error("Gagal mendapatkan token D365 untuk invoice {$invoiceNo}");
                                        }
                                    }
                                } else {
                                    Log::error("Invoice {$invoiceNo} tidak ditemukan pada tabel robot_postings.");
                                    RobotSysBrowser::query()
                                        ->where(['batch_job_id' => $batchJobId])->update([
                                            'send_notif_status' => 'SKIPPED',
                                            'send_notif_status_timestamp' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                                        ]);
                                }
                            } elseif ($type === 'RECOVERING') {
                                // Log::info("Processing recovery for invoice {$invoiceNo}");
                                if ($currentStatus === 'ENDED') {
                                    $robotRecoverCreatedDate = RobotRecoveryInvoice::query()->select('created_at')
                                        ->where(['invoice_no' => $invoiceNo, 'company' => $clean($item['company'] ?? null), 'status' => 'RECOVERY ON PROGRESS'])
                                        ->value('created_at');
                                    // Log::info("Robot recovery created date for invoice {$invoiceNo}: {$robotRecoverCreatedDate}");
                                    // Log::info("Robot batch end date for invoice {$invoiceNo}: {$endDate}");
                                    if (Carbon::parse($endDate)->gt(Carbon::parse($robotRecoverCreatedDate))) {
                                        RobotRecoveryInvoice::query()
                                            ->where(['invoice_no' => $invoiceNo, 'company' => $clean($item['company'] ?? null), 'status' => 'RECOVERY ON PROGRESS', 'created_at' => $robotRecoverCreatedDate])
                                            ->update([
                                                'status' => 'RECOVERY DONE',
                                            ]);
                                    }
                                } else {
                                    // RobotSysBrowser::query()
                                    //     ->where(['batch_job_id' => $batchJobId])
                                    //     ->update([
                                    //         'status' => $currentStatus,
                                    //     ]);
                                }
                            }
                        }
                        $savedLogs[] = $log;
                    }
                }
            });

            return response()->json([
                'success' => true,
                'message' => "Proses log selesai. Berhasil menambahkan {$insertedCount} data baru, memperbarui {$updatedCount} data lama, dan melewati {$skippedCount} data tanpa nomor invoice.",
                'data' => $savedLogs,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan robot sys browser.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
