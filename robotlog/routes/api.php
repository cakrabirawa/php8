<?php

use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\InvoiceLogController;
use App\Http\Controllers\Api\JobLogController;
use App\Http\Controllers\Api\MonitoringController;
use App\Http\Controllers\Api\RobotController;
use App\Http\Controllers\Api\RobotIsAliveController;
use App\Http\Controllers\Api\RobotJobCountController;
use App\Http\Controllers\Api\RobotSysBrowserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/robot-sys-browser', [RobotSysBrowserController::class, 'store']);
    Route::post('/robot-job-count', [RobotJobCountController::class, 'store']);
    Route::post('/robot-is-alive', [RobotIsAliveController::class, 'store']);
});
