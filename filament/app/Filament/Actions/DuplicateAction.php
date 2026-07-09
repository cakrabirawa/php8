<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class DuplicateAction
{
    public static function make(): Action
    {
        return Action::make('duplicate')
            ->label('Duplicate')
            ->icon('heroicon-o-document-duplicate')
            ->color('warning')
            ->requiresConfirmation()
            ->modalHeading('Duplikasi Data')
            ->modalDescription('Apakah Anda yakin ingin menggandakan data ini?')
            ->action(function (Model $record) {
                // 1. Replicate data bawaan tabel apa saja
                $duplicate = $record->replicate();

                // 2. Otomatis deteksi & ubah kolom 'name' jika tabel tersebut memilikinya
                if ($duplicate->getAttribute('name') !== null) {
                    $duplicate->setAttribute('name', $record->name . ' (Copy)');
                }

                // 3. KHUSUS TABEL USER: Otomatis buat email unik jika kolom email ada
                if ($duplicate->getAttribute('email') !== null) {
                    $emailParts = explode('@', $record->email);
                    $newEmail = $emailParts[0] . '-copy-' . time() . '@' . ($emailParts[1] ?? 'example.com');
                    $duplicate->setAttribute('email', $newEmail);
                }

                // 4. Simpan ke database
                $duplicate->save();

                // 5. KHUSUS TABEL USER (Spatie): Otomatis salin role jika ada relasi roles
                if (method_exists($record, 'roles') && $record->roles()->exists()) {
                    $roles = $record->roles->pluck('name')->toArray();
                    $duplicate->assignRole($roles);
                }

                // 6. Tampilkan notifikasi sukses melayang
                Notification::make()
                    ->title('Data Berhasil Diduplikasi')
                    ->success()
                    ->send();
            });
    }
}
