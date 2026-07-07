<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminMenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Default
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@spa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
        ]);

        // 2. Data Menu Utama & Sub-Menu Bertingkat
        $dashboardId = DB::table('menus')->insertGetId([
            'name' => 'Dashboard',
            'route_name' => 'admin.dashboard',
            'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>',
            'parent_id' => null,
            'order_no' => 1
        ]);

        $systemId = DB::table('menus')->insertGetId([
            'name' => 'Konfigurasi Sistem',
            'route_name' => null,
            'icon' => '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>',
            'parent_id' => null,
            'order_no' => 2
        ]);

        // Sub-menus terikat ke induknya ($systemId)
        $userMenuId = DB::table('menus')->insertGetId([
            'name' => 'Manajemen User',
            'route_name' => 'admin.users',
            'icon' => null,
            'parent_id' => $systemId,
            'order_no' => 1
        ]);

        $accessMenuId = DB::table('menus')->insertGetId([
            'name' => 'Hak Akses Menu',
            'route_name' => 'admin.access',
            'icon' => null,
            'parent_id' => $systemId,
            'order_no' => 2
        ]);

        // 3. Daftarkan Hak Akses Awal untuk Admin
        foreach ([$dashboardId, $systemId, $userMenuId, $accessMenuId] as $id) {
            DB::table('role_menu')->insert(['role' => 'admin', 'menu_id' => $id]);
        }
    }
}
