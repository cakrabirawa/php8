<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RobotJobLogController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi input JSON
        $validator = Validator::make($request->all(), [
            'start_date'          => 'required|date_format:Y-m-d H:i:s',
            'end_date'            => 'required|date_format:Y-m-d H:i:s',
            'duration'            => 'required|string',
            'job_id'              => 'required|string',
            'timestamp_extracted' => 'required|date_format:Y-m-d H:i:s',
            'dialog_title'        => 'required|string',
            'error_details_log'   => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. Insert data ke database
        $jobLog = RobotJobLog::create($request->all());

        // 3. Kembalikan response sukses beserta data yang baru disimpan
        return response()->json([
            'success' => true,
            'message' => 'Data log berhasil disimpan',
            'data'    => $jobLog
        ], 201);
    }
}
