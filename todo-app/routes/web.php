<?php

<<<<<<< HEAD
<<<<<<< HEAD
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Daftar rute URL untuk aplikasi Todo List
Route::get('/', [TodoController::class, 'index']);
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
=======
=======
use App\Http\Controllers\AuthController;
>>>>>>> 11266874e457e8aa5c7ba122a9776c5d5ff5d8ee
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
Route::get('/analytics', function (Request $request) {
    return getSpaView($request, 'pages.analytics', 'Calendar - TailAdmin');
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
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
>>>>>>> 7a30939db2bc84ce8be9732e460d94b3990ff5ef
