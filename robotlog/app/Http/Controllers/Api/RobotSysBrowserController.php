<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotLog;
use App\Models\RobotSysBrowser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RobotSysBrowserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'TimeStamp' => 'required|date_format:Y-m-d H:i:s',
            'AutomaticTransaction' => 'required|string|in:ON,OFF',
            'BatchJobId' => 'required|string',
            'Caption' => 'required|string',
            'Company' => 'required|string',
            'ServerId' => 'required|string',
            'Status' => 'required|string',
            'StartDate' => 'required|date_format:Y-m-d H:i:s',
            'EndDate' => 'required|date_format:Y-m-d H:i:s',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $captionText = $request->input('Caption');
        $invoiceNo = trim(Str::after($captionText, 'PURCHASE INVOICE'));
        $batchJobId = $request->input('BatchJobId');

        // Jika invoice_no dan batch_job_id sudah ada, tidak perlu insert
        if (
            $invoiceNo !== '' && RobotSysBrowser::where('invoice_no', $invoiceNo)
            ->where('batch_job_id', $batchJobId)
            ->exists()
        ) {
            $existing = RobotSysBrowser::where('invoice_no', $invoiceNo)
                ->where('batch_job_id', $batchJobId)
                ->first();

            return response()->json([
                'success' => true,
                'message' => 'Data sudah ada. Tidak perlu disimpan.',
                'data' => $existing
            ], 200);
        }

        $log = RobotSysBrowser::create([
            'timestamp' => $request->input('TimeStamp'),
            'automatic_transaction' => $request->input('AutomaticTransaction'),
            'batch_job_id' => $batchJobId,
            'caption' => $request->input('Caption'),
            'invoice_no' => $invoiceNo,
            'company' => $request->input('Company'),
            'server_id' => $request->input('ServerId'),
            'status' => $request->input('Status'),
            'start_date' => $request->input('StartDate'),
            'end_date' => $request->input('EndDate'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data log robot berhasil disimpan.',
            'data' => $log
        ], 210);
    }
}
