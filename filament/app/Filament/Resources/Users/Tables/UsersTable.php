<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TExtColumn::make('groupUser.name')
                    ->label('Group User')
                    ->default('-') // Jika kosong, tampilkan tanda strip
                    ->color('gray'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Jabatan')
                    ->badge() // Berbentuk badge indah warna hijau zamrud (emerald) Anda
                    ->color('success')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('duplicate')
                    ->label('Duplicate') // Nama tombol yang muncul
                    ->icon('heroicon-o-document-duplicate') // Ikon lembaran ganda
                    ->color('warning') // Warna tombol (oranye/kuning)
                    ->requiresConfirmation() // Memunculkan popup konfirmasi sebelum duplikasi
                    ->modalHeading('Duplikasi Data')
                    ->modalDescription('Apakah Anda yakin ingin menggandakan data ini?')
                    ->modalSubmitActionLabel('Ya, Duplikat')
                    ->action(function (Model $record) {
                        // 1. Replicate: Menyalin seluruh data baris tersebut kecuali ID dan Timestamps
                        $duplicate = $record->replicate();
                        // 2. Modifikasi (Opsional): Menambahkan kata ' (Copy)' di belakang nama agar tidak kembar
                        if (isset($duplicate->product_name)) {
                            $duplicate->product_name = $duplicate->product_name . ' (Copy)';
                        }
                        if ($duplicate->getAttribute('email') !== null) {
                            // Memecah email menjadi: 'ado' dan '@gramedia.com'
                            $emailParts = explode('@', $record->email);

                            // Menggabungkan kembali dengan teks tambahan unik: 'ado-copy-171822@gramedia.com'
                            $uniqueSuffix = '-copy-' . time(); // Menggunakan timestamp waktu agar selalu unik
                            $newEmail = $emailParts[0] . $uniqueSuffix . '@' . ($emailParts[1] ?? 'example.com');

                            $duplicate->setAttribute('email', $newEmail);
                        }
                        // 3. Simpan data baru tersebut ke database
                        $duplicate->save();
                        $roles = $record->roles->pluck('name')->toArray();
                        $duplicate->assignRole($roles);
                        // 4. Memunculkan notifikasi sukses pop-up hijau di kanan atas
                        Notification::make()
                            ->title('Data Berhasil Diduplikasi')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->striped()
        ;
    }
}
