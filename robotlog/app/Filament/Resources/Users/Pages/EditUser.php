<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function afterSave(): void
    {
        $user = $this->getRecord(); // Mengambil data user yang baru disimpan

        // Jika user yang diedit adalah akun yang sedang login saat ini
        if ($user->id === Auth::id()) {
            // CARA TERBAIK: Login ulang paksa di latar belakang 
            // untuk memperbarui session cookie yang baru di browser
            Auth::login($user);
        }
    }
}
