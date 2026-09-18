<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotIsALive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RobotIsAliveController extends Controller
{
  public function store(Request $request): JsonResponse
  {
    // 1. Validasi input langsung di sini
    $validated = $request->validate([
      'robot_name' => 'required|string|max:255',
      'robot_last_activity_at' => 'required|date_format:Y-m-d H:i:s',
    ]);

    // 2. Hitung selisih waktu
    $lastActivity = Carbon::createFromFormat('Y-m-d H:i:s', $validated['robot_last_activity_at']);
    $now = Carbon::now();
    $diffHuman = $lastActivity->diffForHumans($now);

    // 3. Simpan ke database (Timpa jika robot_name sama)
    $robot = RobotIsALive::updateOrCreate(
      ['robot_name' => $validated['robot_name']],
      [
        'robot_last_activity_at' => $validated['robot_last_activity_at'],
        'robot_diff_time_current' => $diffHuman
      ]
    );

    return response()->json([
      'status' => 'success',
      'message' => 'Robot data saved successfully.',
      'data' => $robot
    ], 200);
  }
}
