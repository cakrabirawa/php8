<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sections')->insert([
            'name' => 'Sales',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
