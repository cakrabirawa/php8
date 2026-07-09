<?php

declare(strict_types=1);

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Blog\Livewire\Admin\Dashboard;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //
    }

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        // Admin Livewire components
        Livewire::component('blog::admin.dashboard', Dashboard::class);
        Livewire::component('blog::components.article-datatable', ArticleDatatable::class);
    }
}
