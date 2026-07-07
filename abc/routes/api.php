<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\SpaApiController;
use Illuminate\Support\Facades\Route;

// State Inisialisasi Aplikasi
Route::get('/spa/init', [SpaApiController::class, 'initializeApplication']);

// API Otorisasi Hak Akses
Route::get('/permissions/{role}', [SpaApiController::class, 'getPermissions']);
Route::post('/permissions/save', [SpaApiController::class, 'savePermissions']);

// API Bisnis CRUD User
Route::get('/users/data', [SpaApiController::class, 'getUsers']);
Route::post('/users/store', [SpaApiController::class, 'storeUser']);
Route::put('/users/update/{id}', [SpaApiController::class, 'updateUser']);
Route::delete('/users/delete/{id}', [SpaApiController::class, 'destroyUser']);

// API Otentikasi dan Captcha Slider
Route::get('/captcha/generate', [AuthApiController::class, 'generateCaptcha']);
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout']);
