<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// Daftar rute URL untuk aplikasi Todo List
Route::get('/', [TodoController::class, 'index']);
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
