<?php

declare(strict_types=1);

namespace Modules\Test\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Test\Livewire\Admin\Dashboard;

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
        Livewire::component('test::admin.dashboard', Dashboard::class);
    }
}
