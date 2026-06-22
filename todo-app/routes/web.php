<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Fungsi helper dinamis untuk mendeteksi AJAX Fetch atau akses URL langsung
function getSpaView(Request $request, $viewName, $pageTitle)
{
    if ($request->header('X-Injected-Page')) {
        return view('pages.' . $viewName); // Hanya kirim potongan HTML tengah
    }
    return view('welcome', [
        'pageView' => 'pages.' . $viewName,
        'pageTitle' => $pageTitle
    ]); // Kirim layout utuh jika di-refresh penuh
}

Route::get('/', function (Request $request) {
    return getSpaView($request, 'analytics', 'Analytics - TailAdmin');
});

Route::get('/calendar', function (Request $request) {
    return getSpaView($request, 'calendar', 'Calendar - TailAdmin');
});

Route::get('/ticket-list', function (Request $request) {
    return getSpaView($request, 'ticket-list', 'Ticket List - TailAdmin');
});

Route::get('/ticket-reply', function (Request $request) {
    return getSpaView($request, 'ticket-reply', 'Ticket Reply - TailAdmin');
});
