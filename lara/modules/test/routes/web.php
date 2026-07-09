<?php

use Illuminate\Support\Facades\Route;
use Modules\Test\Livewire\Admin\Dashboard;

Route::middleware(['auth', 'verified'])
    ->prefix('admin/test')
    ->as('admin.test.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.test.dashboard'));
        Route::get('dashboard', Dashboard::class)->name('dashboard');
    });
