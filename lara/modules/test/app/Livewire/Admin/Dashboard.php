<?php

declare(strict_types=1);

namespace Modules\Test\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('test::layouts.admin')]
class Dashboard extends Component
{
    public function render(): View
    {
        return view('test::livewire.admin.dashboard');
    }
}
