<?php

namespace App\Console\Commands;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GrantAllPermissionsToUser extends Command
{
    // Ini adalah nama perintah CLI yang akan Anda ketik nanti
    protected $signature = 'user:grant-all {email : Email dari user yang ingin diberikan akses}';

    protected $description = 'Memasukkan semua permission dari resource Filament dan memberikannya ke user';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("User dengan email {$email} tidak ditemukan!");
            return Command::FAILURE;
        }

        $this->info('Memindai semua resource Filament...');

        // 1. Buat role super_admin jika belum ada
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // 2. Ambil semua resource Filament aktif
        $resources = Filament::getResources();
        $count = 0;

        foreach ($resources as $resource) {
            $modelName = strtolower(class_basename($resource::getModel()));
            $actions = ['view_any', 'view', 'create', 'update', 'delete', 'restore', 'force_delete'];

            foreach ($actions as $action) {
                $permissionName = "{$action}_{$modelName}";

                // Buat permission di database Spatie via CLI logic
                Permission::firstOrCreate(['name' => $permissionName]);

                // Berikan ke role
                $role->givePermissionTo($permissionName);
                $count++;
            }
        }

        // 3. Pasangkan role ke user
        $user->assignRole($role);

        // 4. Bersihkan cache otomatis
        $this->call('filament:optimize');
        // $this->call('filament:clear-cached-navigation');

        $this->info("Sukses! {$count} permission berhasil dibuat dan diberikan ke {$email} sebagai super_admin.");
        return Command::SUCCESS;
    }
}
