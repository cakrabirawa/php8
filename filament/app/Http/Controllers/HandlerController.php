<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandlerController extends Controller
{
    public function process(Request $request)
    {
        // Inisialisasi Handler bawaan paket Stimulsoft
        $handler = new \Stimulsoft\StiHandler();

        // Menggunakan kurung kurawal string untuk mengunci properti dinamis tanpa memicu error IDE
        $handler->{'onRegisterData'} = function ($event) {
            // Tempat menyuntikkan data dinamis dari Database Laravel 13 Anda
            // Contoh: $event->data->registerData('KoneksiKu', 'Produk', \App\Models\Product::all());

            return \Stimulsoft\StiResult::getSuccess();
        };

        return $handler->process();
    }
}
