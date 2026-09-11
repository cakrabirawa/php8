<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendWANotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Tentukan jumlah percobaan jika API gagal merespons
    public $tries = 3;

    protected $message;

    // protected $html;

    /**
     * Pasing data subject dan html melalui constructor
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Logika pengiriman WA dieksekusi di sini oleh worker
     */
    public function handle(): void
    {
        try {
            $response = Http::withoutVerifying()
                ->post(config('services.api_wa.url'), [
                    'phonenumber' => config('services.api_wa.to'),
                    'message' => $this->message,
                    'fromapp' => env('APP_NAME'),
                ]);

            if ($response->successful()) {
                Log::info('Queue WA Berhasil: '.$response->body());

                return;
            }

            // Jika gagal, lempar exception agar job bisa dicoba lagi (retry)
            throw new \Exception('API Gagal: '.$response->body());
        } catch (\Exception $e) {
            Log::error('Error di Queue API WA: '.$e->getMessage());

            // Melemparkan exception memberi tahu queue bahwa job ini gagal dan butuh retry
            throw $e;
        }
    }
}
