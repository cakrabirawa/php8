<?php

declare(strict_types=1);

use App\Services\PermissionService;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        PermissionService::syncPermissionsForRoles([
            [
                'group_name' => 'article',
                'permissions' => [
                    'article.view',
                    'article.create',
                    'article.edit',
                    'article.delete',
                ],
            ],
        ]);
    }

    public function down(): void
    {
        PermissionService::removePermissions([
            'article.view',
            'article.create',
            'article.edit',
            'article.delete',
        ]);
    }
};
