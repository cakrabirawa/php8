<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Dynamics365Service
{
    // Token disimpan dalam 1 file agar bisa dipakai ulang lintas proses selama masih valid
    private string $tokenFile = 'app/d365_token.json';

    /**
     * Mengambil Access Token dari Dynamics 365, memakai token dari file jika masih valid.
     */
    public function getAccessToken(): ?string
    {
        $cached = $this->readTokenFile();

        if ($cached && $cached['expires_at'] > time()) {
            return $cached['access_token'];
        }

        return $this->requestNewToken();
    }

    private function readTokenFile(): ?array
    {
        $path = storage_path($this->tokenFile);

        if (! File::exists($path)) {
            return null;
        }

        $data = json_decode(File::get($path), true);

        if (! is_array($data) || empty($data['access_token']) || empty($data['expires_at'])) {
            return null;
        }

        return $data;
    }

    private function writeTokenFile(string $accessToken, int $expiresAt): void
    {
        $path = storage_path($this->tokenFile);

        File::ensureDirectoryExists(dirname($path));
        File::put($path, json_encode([
            'access_token' => $accessToken,
            'expires_at' => $expiresAt,
        ]));
    }

    private function requestNewToken(): ?string
    {
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
                $accessToken = $data['access_token'] ?? null;

                if (! $accessToken) {
                    return null;
                }

                // Token Microsoft biasanya berlaku 60 menit, beri buffer 10 menit
                $expiresAt = time() + (50 * 60);
                $this->writeTokenFile($accessToken, $expiresAt);

                return $accessToken;
            }

            Log::error('Gagal mengambil Token Dynamics 365. Response: '.$response->body());

            return null;

        } catch (\Exception $e) {
            Log::error('Error saat request Token Dynamics 365: '.$e->getMessage());

            return null;
        }
    }
}

