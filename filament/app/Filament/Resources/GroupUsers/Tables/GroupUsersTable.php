<?php

namespace App\Filament\Resources\GroupUsers\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class GroupUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Group User Name')
                    ->searchable()
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
                        if (isset($duplicate->name)) {
                            $duplicate->name = $duplicate->name . ' (Copy)';
                        }
                        // 3. Simpan data baru tersebut ke database
                        $duplicate->save();
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
