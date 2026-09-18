<?php

namespace App\Traits;

use App\Jobs\SendEmailNotificationJob;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    public function sendEmail(string $subject = 'Subject', string $html = 'HTML Content'): bool
    {
        try {
            // Mengirim proses ke antrean (background process)
            SendEmailNotificationJob::dispatch($subject, $html);

            // Selalu return true karena job sudah berhasil masuk antrean
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal memasukkan email ke queue: '.$e->getMessage());

            return false;
        }
    }
}
