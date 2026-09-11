<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Dynamics365Service
{
    /**
     * Mengambil Access Token dari Dynamics 365 dengan sistem Caching.
     */
    public function getAccessToken(): ?string
    {
        // Menyimpan token di cache selama 50 menit (Token Microsoft biasanya berlaku 60 menit)
        return Cache::remember('d365_access_token', 50 * 60, function () {
            try {
                $url = config('services.d365.token_url');

                // Melakukan POST request dengan format Form URL Encoded ke Microsoft Azure
                $response = Http::asForm()->withoutVerifying()->post($url, [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('services.d365.client_id'),
                    'client_secret' => config('services.d365.client_secret'),
                    'resource' => config('services.d365.resource_url'),
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Mengembalikan access_token string murni
                    return $data['access_token'] ?? null;
                }

                Log::error('Gagal mengambil Token Dynamics 365. Response: '.$response->body());

                return null;

            } catch (\Exception $e) {
                Log::error('Error saat request Token Dynamics 365: '.$e->getMessage());

                return null;
            }
        });
    }
}
