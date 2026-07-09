<?php

declare(strict_types=1);

namespace Modules\Blog\Services;

use App\Enums\Hooks\AdminFilterHook;
use App\Enums\Hooks\PermissionFilterHook;
use App\Support\Facades\Hook;

class ModuleService
{
    public function __construct(
        private readonly MenuService $menuService
    ) {
    }

    /**
     * Bootstrap the module services.
     */
    public function bootstrap(): void
    {
        // Register sidebar menu
        Hook::addFilter(AdminFilterHook::ADMIN_MENU_GROUPS_BEFORE_SORTING, [$this->menuService, 'addMenu']);

        // Register permissions
        Hook::addFilter(PermissionFilterHook::PERMISSION_GROUPS, [$this, 'addPermissions']);
    }

    /**
     * Add module permissions to the permission groups.
     */
    public function addPermissions(array $groups): array
    {
        return array_merge($groups, $this->getPermissions());
    }

    /**
     * Get the module permission definitions.
     * Add permissions here when needed, e.g.:
     * ['group_name' => 'blog', 'permissions' => ['blog.dashboard', 'blog.settings']]
     */
    public static function getPermissions(): array
    {
        return [];
    }
}
