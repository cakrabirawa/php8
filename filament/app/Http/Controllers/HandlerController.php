<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stimulsoft\Laravel\StiHandler;
use Stimulsoft\StiResult;

class HandlerController extends Controller
{
    public function process(Request $request)
    {
        // Inisialisasi handler otomatis dari Stimulsoft
        $handler = new StiHandler();

        // Event saat komponen meminta data atau memuat file laporan (.mrt)
        $handler->onRegisterData = function ($event) {
            // Anda bisa menyuntikkan koneksi database Laravel atau JSON data di sini
            return StiResult::success();
        };

        // Memproses permintaan Ajax secara real-time
        return $handler->process();
    }
}
