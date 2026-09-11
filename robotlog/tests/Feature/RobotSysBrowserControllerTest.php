<?php

namespace Tests\Feature;

use App\Models\RobotJobLog;
use App\Models\RobotSysBrowser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RobotSysBrowserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_ended_batches_excludes_rows_with_related_job_logs(): void
    {
        RobotSysBrowser::create([
            'timestamp' => now(),
            'batch_job_id' => 'BATCH-1',
            'company' => 'ABC',
            'status' => 'ENDED',
            'invoice_no' => 'INV-001',
        ]);

        RobotJobLog::create([
            'batch_job_id' => 'BATCH-1',
            'company' => 'ABC',
            'status' => 'SUCCESS',
            'caption' => 'done',
        ]);

        RobotSysBrowser::create([
            'timestamp' => now(),
            'batch_job_id' => 'BATCH-2',
            'company' => 'ABC',
            'status' => 'ENDED',
            'invoice_no' => 'INV-002',
        ]);

        $response = $this->getJson('/api/robot-sys-browser/ended-batches?company=ABC');

        $response->assertOk();
        $response->assertJsonPath('success', true);
        $this->assertCount(1, $response->json('data'));
        $this->assertSame('BATCH-2', $response->json('data.0.batch_job_id'));
    }
}
