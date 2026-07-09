<?php

declare(strict_types=1);

namespace Modules\Blog\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('blog::layouts.admin')]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('blog::livewire.admin.dashboard');
    }
}
