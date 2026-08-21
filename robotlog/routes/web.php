<?php

use App\Http\Controllers\HandlerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/avatars/{filename}', function ($filename) {
    $path = 'avatars/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file)->header('Content-Type', $type);
})->name('custom.avatar');
Route::get('/products/{filename}', function ($filename) {
    $path = 'products/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file)->header('Content-Type', $type);
})->name('custom.product_image');
Route::get('/public/robot-error-screenshots/{filename}', function ($filename) {
    $path = 'robot-error-screenshots/' . $filename;

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    $file = Storage::disk('public')->get($path);
    $type = Storage::disk('public')->mimeType($path);

    return response($file)->header('Content-Type', $type);
})->name('robot.error_screenshot');
Route::get('/report-viewer', function () {
    return view('viewer');
});
Route::any('/handler', [HandlerController::class, 'process']);
