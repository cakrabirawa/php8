<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotJobCount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RobotJobCountController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // 1. Validasi Payload sesuai format data yang masuk
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date'   => 'required|date_format:Y-m-d H:i:s|after_or_equal:start_date',
            'duration'   => 'required|string|max:50',
            'timestamp'  => 'required|date_format:Y-m-d H:i:s',
            'count'      => 'required|integer|min:0',
            'entity'     => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan error 422
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. LOGIKA BARU: Cek dan hapus data lama jika entity sudah ada
        $entityName = $request->input('entity');

        // Menghapus semua record lama yang memiliki nama entity yang sama
        RobotJobCount::where('entity', $entityName)->delete();

        // 3. Simpan data baru ke Database
        $log = RobotJobCount::create($request->only([
            'start_date',
            'end_date',
            'duration',
            'timestamp',
            'count',
            'entity',
        ]));

        // 4. Kembalikan Response Sukses 201
        return response()->json([
            'success' => true,
            'message' => "Data lama untuk entity '{$entityName}' berhasil dihapus dan data baru telah disimpan!",
            'data'    => $log
        ], 201);
    }
}
