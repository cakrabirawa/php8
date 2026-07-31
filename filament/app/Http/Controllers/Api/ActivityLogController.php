<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Http\Resources\ActivityLogResource;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    // Mengambil semua log
    public function index()
    {
        $logs = ActivityLog::latest()->get();
        return ActivityLogResource::collection($logs);
    }

    // Menyimpan log baru lewat API
    public function store(Request $request)
    {
        $validated = $request->validate([
            'data.start_date' => 'required|date',
            'data.end_date' => 'required|date',
            'data.duration' => 'required|string',
            'data.timestamp' => 'required|date',
            'data.count' => 'required|integer',
            'data.entity' => 'required|string',
        ]);

        // Mengambil data dari dalam key 'data'
        $data = $validated['data'];

        // Hapus semua baris data lama yang memiliki entity yang sama
        ActivityLog::where('entity', $data['entity'])->delete();

        // Insert data baru ke database
        $log = ActivityLog::create($data);

        return new ActivityLogResource($log);
    }
}
