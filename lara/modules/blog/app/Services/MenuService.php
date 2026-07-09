<?php

declare(strict_types=1);

namespace Modules\Blog\Services;

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
        $menu = (new AdminMenuItem())->setAttributes([
            'label' => __('Blog'),
            'icon' => 'lucide:box',
            'route' => route('admin.blog.dashboard'),
            'active' => Route::is('admin.blog.*'),
            'id' => 'blog',
            'priority' => 50,
            'permissions' => [],
        ]);

        // Articles submenu
        $menu->setChildren([
            (new AdminMenuItem())->setAttributes([
                'label' => __('Articles'),
                'icon' => '',
                'route' => route('admin.blog.articles.index'),
                'active' => Route::is('admin.blog.articles.*'),
                'id' => 'blog-articles',
                'permissions' => [],
            ]),
        ]);

        return $menu;
    }
}
