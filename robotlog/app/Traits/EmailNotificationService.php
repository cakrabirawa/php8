<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class EmailNotificationService
{
    public function sendEmail(string $invoiceNo, string $subject = 'Subject', string $html = 'HTML Content'): bool
    {
        try {
            $response = Http::withoutVerifying()->withToken(config('services.api_email.token'))
                ->post(config('services.api_email.url'), [
                    'to'      => config('services.api_email.to'),
                    'subject' => $subject,
                    'text'    => Str::of($html)->stripTags(),
                    'html'    => $html,
                ]);

            if ($response->successful()) {
                Log::info($response->body());
                return true;
            }

            Log::error('Gagal mengirim email recovery: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('Error saat memanggil API Email: ' . $e->getMessage());
            return false;
        }
    }
}
