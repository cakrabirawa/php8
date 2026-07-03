<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompetencySeeder extends Seeder
{
    public function run(): void
    {
        $competencies = [
            'Analytical Thinking',
            'Business Planning',
            'Agile Decision Making',
            'Stakeholder Engagement',
            'Culture Building',
        ];

        foreach ($competencies as $name) {
            DB::table('competencies')->updateOrInsert(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                ]
            );
        }
    }
}