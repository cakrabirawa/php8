<?php

declare(strict_types=1);

namespace Modules\Test\Services;

use App\Services\MenuService\AdminMenuItem;
use Illuminate\Support\Facades\Route;

class MenuService
{
    /**
     * Add the module menu to the admin sidebar.
     */
    public function addMenu(array $groups): array
    {
        $groups[__('Main')][] = $this->getMenu();

        return $groups;
    }

    /**
     * Get the module menu item.
     */
    public function getMenu(): AdminMenuItem
    {
        return (new AdminMenuItem())->setAttributes([
            'label' => __('Test'),
            'icon' => 'lucide:box',
            'route' => route('admin.test.dashboard'),
            'active' => Route::is('admin.test.*'),
            'id' => 'test',
            'priority' => 50,
            'permissions' => [],
        ]);
    }
}
