<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

function renderAjaxOrView(Request $request, string $viewName)
{
    $view = view($viewName);

    // Validasi AJAX yang kompatibel dengan protokol HTTP Laravel 13
    if ($request->ajax() || $request->hasHeader('X-Requested-With')) {
        return response($view->renderSections()['content'])
            ->header('Content-Type', 'text/html');
    }

    return $view;
}

Route::get('/', function (Request $request) {
    return renderAjaxOrView($request, 'beranda');
});

Route::get('/produk', function (Request $request) {
    return renderAjaxOrView($request, 'produk');
});

Route::get('/pengguna', function (Request $request) {
    return renderAjaxOrView($request, 'pengguna');
});
