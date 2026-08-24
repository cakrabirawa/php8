<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:halo {nama}')]
#[Description('Command description')]
class HelloWorldConsole extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Mengambil nilai argumen 'nama' yang diinput pengguna
        $namaPengguna = $this->argument('nama');

        // Menampilkan teks output berwarna hijau di terminal
        $this->info("Halo, {$namaPengguna}! Selamat datang di Laravel Console.");

        $makanan = $this->ask('Apa makanan favoritmu?');
        $this->info("Wah, kamu suka makan {$makanan}!");

        $password = $this->secret('Masukkan PIN Anda:');
        $this->info("Wah, password anda ini {$password}!");

        if ($this->confirm('Apakah Anda ingin melanjutkan proses ini?')) {
            $this->info('Proses dilanjutkan.');
        }

        $opsi = $this->choice('Pilih role Anda:', ['Admin', 'User'], 1);
        $this->info("Wah, user anda adalah {$opsi}!");

        return Command::SUCCESS;
    }
}
