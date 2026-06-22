<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    public function run(): void
    {
    $salesSectionId = DB::table('sections')
        ->where('name', 'Sales')
        ->value('id');

    DB::table('jobs')->insert([
        'section_id' => $salesSectionId,
        'name' => 'Sales Superintendent',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    }
}
