<?php

use App\Http\Controllers\Api\ActivityLogController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\InvoiceLogController;
use App\Http\Controllers\Api\JobLogController;
use App\Http\Controllers\Api\MonitoringController;
use App\Http\Controllers\Api\RobotController;
use App\Http\Controllers\Api\RobotSysBrowserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/robot-sys-browser', [RobotSysBrowserController::class, 'store']);
    Route::post('/job-logs', [JobLogController::class, 'store']);
    Route::post('/activity-logs', [ActivityLogController::class, 'store']);
    Route::post('/invoice-logs', [InvoiceLogController::class, 'store']);
    Route::post('/robots/activity', [RobotController::class, 'store']);
    Route::post('/invoices', [InvoiceController::class, 'store']);

    Route::get('/monitoring', [MonitoringController::class, 'index']);
    Route::get('/activity-logs', [ActivityLogController::class, 'index']);
});
