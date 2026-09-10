<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RobotJobLogController extends Controller
{
    public function store(Request $request)
    {
        $inputData = collect($request->all())->map(function ($item) {
            if (isset($item['startDateTime'])) {
                $item['startDateTime'] = Carbon::parse($item['startDateTime'])->format('Y-m-d H:i:s');
            }
            if (isset($item['endDateTime'])) {
                $item['endDateTime'] = Carbon::parse($item['endDateTime'])->format('Y-m-d H:i:s');
            }
            return $item;
        })->toArray();

        // 1. Validasi input JSON
        $validator = Validator::make($request->all(), [
            '*.batchJobId'          => 'required|integer',
            '*.company'             => 'required|string|max:50',
            '*.status'              => 'required|string|max:50',
            '*.caption'             => 'nullable|string',
            '*.startDateTime'       => 'nullable|date',
            '*.endDateTime'         => 'nullable|date',
            '*.info'                => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        // 2. Insert data ke database
        foreach ($validatedData as $item) {
            RobotJobLog::create([
                'batch_job_id'    => $item['batchJobId'], // Petakan camelCase ke snake_case
                'company'         => $item['company'],
                'status'          => $item['status'],
                'caption'         => $item['caption'] ?? null,
                // Ubah format tanggal ke Y-m-d H:i:s sebelum disimpan
                'start_date_time' => isset($item['startDateTime']) ? Carbon::parse($item['startDateTime'])->format('Y-m-d H:i:s') : null,
                'end_date_time'   => isset($item['endDateTime']) ? Carbon::parse($item['endDateTime'])->format('Y-m-d H:i:s') : null,
                'info'            => $item['info'] ?? null,
            ]);
        }

        // 3. Kembalikan response sukses beserta data yang baru disimpan
        return response()->json([
            'success' => true,
            'message' => 'Data log berhasil disimpan',
            // 'data'    => $jobLog
        ], 201);
    }
}
