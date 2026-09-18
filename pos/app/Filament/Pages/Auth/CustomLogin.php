<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as FilamentBaseLogin;
use Filament\Schemas\Schema; // <-- Gunakan Schema terbaru, bukan Form
use Filament\Schemas\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;

class CustomLogin extends FilamentBaseLogin
{
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

                // Menyisipkan Slider Captcha kustom ke dalam barisan komponen schema
                ViewField::make('captcha_unlocked')
                    ->view('filament.components.slider-captcha')
                    ->columnSpanFull()
                    ->rules(['required', 'accepted']) // Wajib bernilai '1' (digeser sukses)
                    ->validationMessages([
                        'accepted' => 'Verifikasi keamanan wajib dipilih dengan benar.',
                    ]),
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
}
