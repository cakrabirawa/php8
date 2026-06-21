<?php

use Illuminate\Support\Facades\Route;

// 1. Rute Halaman Utama & Akses URL Langsung (Mengembalikan layout penuh)
Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/products', function () {
    return view('dashboard');
});

Route::get('/active-orders', function () {
    return view('dashboard');
});


// 2. Rute Khusus untuk Fetch API (Hanya mengembalikan potongan HTML)
Route::get('/ajax/page/{name}', function ($name) {
    $targetPath = "partials.{$name}";

    if (view()->exists($targetPath)) {
        return view($targetPath);
    }

    return response('Halaman tidak ditemukan', 404);
});
