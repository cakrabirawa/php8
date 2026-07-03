<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SeedChecklistTemplates extends Command
{
    protected $signature = 'checklist:seed';
    protected $description = 'Seed checklist templates from JSON file';

    public function handle()
    {
        
        $path = storage_path('app/private/checklist_templates.json');

        if (!file_exists($path)) {
            $this->error('❌ File tidak ditemukan: ' . $path);
            return;
        }

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        if (!$data) {
            $this->error('❌ JSON tidak valid!');
            return;
        }

        DB::table('checklist_templates')->truncate();

        foreach ($data as $item) {

            DB::table('checklist_templates')->insert([
                'month' => $item['month'],
                'week' => $item['week'],
                'template_json' => json_encode([
                    'title' => $item['title'],
                    'items' => $item['items'] ?? [],
                    'mandatory_tasks' => $item['mandatory_tasks'] ?? [],
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('✅ Checklist templates berhasil di-import dari JSON!');
    }
}