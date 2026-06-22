<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminHrSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin HR',
            'email' => 'adminhr',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
