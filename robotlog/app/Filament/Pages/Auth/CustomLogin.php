<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as FilamentBaseLogin;
use Filament\Schemas\Schema; // <-- Gunakan Schema terbaru, bukan Form
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Session;

class CustomLogin extends FilamentBaseLogin
{
    public string $securityQuestion = '';

    public function mount(): void
    {
        parent::mount();

        $this->generateSecurityChallenge();
    }

    // Mengubah Judul Utama Halaman Login
    public function getHeading(): string
    {
        return 'Selamat Datang';
    }

    // Mengubah Sub-judul Halaman Login
    public function getSubheading(): string
    {
        return 'Silakan masuk ke panel admin sistem';
    }

    /**
     * Override fungsi form menggunakan arsitektur Schema terbaru
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),

                TextInput::make('security_answer')
                    ->label('Validasi Keamanan Sistem')
                    ->prefix(fn(): string => $this->securityQuestion)
                    ->placeholder('Masukkan hasil perhitungan')
                    ->numeric()
                    ->required()
                    ->rules([
                        function (): \Closure {
                            return function (string $attribute, mixed $value, \Closure $fail): void {
                                $expected = Session::get('login_security_answer');

                                if ((string) $value !== (string) $expected) {
                                    $this->generateSecurityChallenge();
                                    $fail('Jawaban validasi keamanan tidak benar. Silakan coba soal baru.');
                                }
                            };
                        },
                    ])
                    ->validationMessages([
                        'required' => 'Jawaban validasi keamanan wajib diisi.',
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Alamat Email Pengguna')
            ->email()
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    protected function generateSecurityChallenge(): void
    {
        $operations = ['+', '-', '*', '/'];
        $operation = $operations[array_rand($operations)];

        $left = 0;
        $right = 0;
        $answer = 0;

        if ($operation === '+') {
            $left = random_int(1, 99);
            $right = random_int(1, 99);
            $answer = $left + $right;
        }

        if ($operation === '-') {
            $left = random_int(2, 99);
            $right = random_int(1, $left - 1);
            $answer = $left - $right;
        }

        if ($operation === '*') {
            $left = random_int(1, 12);
            $right = random_int(1, 12);
            $answer = $left * $right;
        }

        if ($operation === '/') {
            $right = random_int(1, 12);
            $answer = random_int(1, 12);
            $left = $right * $answer;
        }

        $symbol = $operation === '*' ? '×' : ($operation === '/' ? '÷' : $operation);

        $this->securityQuestion = $left . ' ' . $symbol . ' ' . $right . ' = ?';
        Session::put('login_security_answer', (string) $answer);
    }
}
