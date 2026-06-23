<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

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
Route::get('/', [TicketController::class, 'listView']);
Route::get('/ticket-list', [TicketController::class, 'listView']);
Route::get('/ticket-reply', [TicketController::class, 'replyView']);
Route::post('/ticket-reply/{id}', [TicketController::class, 'storeReply']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/calendar', function (Request $request) {
    return getSpaView($request, 'calendar', 'Calendar - TailAdmin');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome', [
            'pageView' => 'pages.analytics',
            'pageTitle' => 'Analytics - TailAdmin'
        ]);
    });
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
