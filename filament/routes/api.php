<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\JobLogController;
use App\Http\Controllers\Api\MonitoringController;
use App\Http\Controllers\Api\RobotLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::post('/robot-logs', [RobotLogController::class, 'store']);
    Route::post('/job-logs', [JobLogController::class, 'store']);
    Route::get('/activity-logs', [ActivityLogController::class, 'index']);
    Route::post('/activity-logs', [ActivityLogController::class, 'store']);
});
