<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateApiKey extends Command
{
    // Perintah yang akan diketik di terminal
    protected $signature = 'api:generate-key {name=Client-External}';
    protected $description = 'Membuat Bearer Token Sanctum baru untuk mengamankan API Monitoring';

    public function handle()
    {
        $clientName = $this->argument('name');

        // 1. Cari atau buat User khusus penampung token di database
        $user = User::firstOrCreate(
            ['email' => 'robot.monitoring@system.local'],
            [
                'name' => 'Robot Monitoring System',
                'password' => bcrypt(Str::random(32)), // Password acak tidak terpakai
            ]
        );

        // 2. Generate token Sanctum baru untuk klien tersebut
        $tokenResult = $user->createToken($clientName);

        $this->info("====================================================");
        $this->info(" BERHASIL MEMBUAT API KEY / BEARER TOKEN ");
        $this->info("====================================================");
        $this->comment("Nama Klien : {$clientName}");
        $this->comment("Token Anda : {$tokenResult->plainTextToken}");
        $this->info("====================================================");
        $this->warn("PERINGATAN: Salin token di atas sekarang! Token ini tidak akan ditampilkan lagi demi keamanan.");
    }
}
