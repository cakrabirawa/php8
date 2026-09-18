<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SendEmailNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Tentukan jumlah percobaan jika API gagal merespons
    public $tries = 3;

    protected $subject;

    protected $html;

    /**
     * Pasing data subject dan html melalui constructor
     */
    public function __construct(string $subject, string $html)
    {
        $this->subject = $subject;
        $this->html = $html;
    }

    /**
     * Logika pengiriman email dieksekusi di sini oleh worker
     */
    public function handle(): void
    {
        try {
            $response = Http::withoutVerifying()
                ->withToken(config('services.api_email.token'))
                ->post(config('services.api_email.url'), [
                    'to' => config('services.api_email.to'),
                    'subject' => $this->subject,
                    'text' => Str::of($this->html)->stripTags(),
                    'html' => $this->html,
                ]);

            if ($response->successful()) {
                Log::info('Queue Email Berhasil: '.$response->body());

                return;
            }

            // Jika gagal, lempar exception agar job bisa dicoba lagi (retry)
            throw new \Exception('API Gagal: '.$response->body());
        } catch (\Exception $e) {
            Log::error('Error di Queue API Email: '.$e->getMessage());

            // Melemparkan exception memberi tahu queue bahwa job ini gagal dan butuh retry
            throw $e;
        }
    }
}
