<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Livewire\Admin\Dashboard;

Route::middleware(['auth', 'verified'])
    ->prefix('admin/blog')
    ->as('admin.blog.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.blog.dashboard'));
        Route::get('dashboard', Dashboard::class)->name('dashboard');
    

        Route::resource('articles', ArticleController::class);
    });
