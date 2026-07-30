<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvoiceLog;
use Illuminate\Http\Request;

class InvoiceLogController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input payload
        $validated = $request->validate([
            'invoice_no' => 'required|string',
            'status' => 'required|string',
            'time_stamp' => 'required|date_format:Y-m-d H:i:s',
        ]);

        // Simpan ke database
        $log = InvoiceLog::create($validated);

        // Kembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Invoice log berhasil disimpan.',
            'data' => [
                'id' => $log->id,
                'invoice_no' => $log->invoice_no,
                'status' => $log->status,
                'time_stamp' => $log->time_stamp->toDateTimeString(),
            ]
        ], 21);
    }
}
