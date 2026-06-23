<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Navigasi Dinamis SPA (Single Page Application)
|--------------------------------------------------------------------------
*/

function getSpaView(Request $request, $viewName, $pageTitle)
{
    if ($request->header('X-Injected-Page')) {
        return view('pages.' . $viewName);
    }
    return view('welcome', [
        'pageView' => 'pages.' . $viewName,
        'pageTitle' => $pageTitle
    ]);
}

// ==========================================
// 1. GRUP ROUTE MENU UTAMA
// ==========================================

Route::get('/', [TicketController::class, 'listView']);

Route::get('/calendar', function (Request $request) {
    return getSpaView($request, 'calendar', 'Calendar - TailAdmin');
});

// ==========================================
// 2. GRUP ROUTE SUPPORT TICKET (Diubah Menggunakan Controller)
// ==========================================

Route::get('/ticket-list', [TicketController::class, 'listView']);

Route::get('/ticket-reply', [TicketController::class, 'replyView']);

Route::post('/ticket-reply/{id}', [TicketController::class, 'storeReply']);
