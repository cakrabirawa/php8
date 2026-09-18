<?php

namespace App\Filament\Resources\RobotLogs\Pages;

use App\Filament\Resources\RobotLogs\RobotLogResource;
use App\Http\Controllers\Api\MonitoringController;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ListRobotLogs extends ListRecords
{
    protected static string $resource = RobotLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    public function fetchMonitoringDataAPI($batchJobId): string
    {
        try {
            $response = Http::withToken('7|87WjNjTa3vqyutEHO7I2XrpBAOPSYNiOjy51uzHWb72799fb')
                ->timeout(5)
                ->get('http://localhost:8000/api/monitoring', [
                    'batch_job_id' => $batchJobId,
                ]);

            if ($response->successful()) {
                return json_encode($response->json(), JSON_PRETTY_PRINT);
            }
            return 'Gagal mengambil data dari server. Status: ' . $response->status();
        } catch (\Exception $e) {
            return 'Koneksi ke server API terputus atau timeout.';
        }
    }

    public function fetchMonitoringDataLocal($batchJobId): string
    {
        try {
            $data = DB::table('robot_logs')
                ->where('batch_job_id', $batchJobId)
                ->first();
            if (! $data) {
                return json_encode([
                    'status' => 'not_found',
                    'message' => "Data monitoring dengan Batch Job ID #{$batchJobId} tidak ditemukan di sistem internal."
                ], JSON_PRETTY_PRINT);
            }
            return json_encode($data, JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Gagal membaca data dari database internal: ' . $e->getMessage()
            ], JSON_PRETTY_PRINT);
        }
    }
}
