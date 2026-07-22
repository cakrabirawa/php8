<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
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
                    ->humanFormat()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->humanFormat()
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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('duplicate')
                        ->label('Duplicate')
                        ->icon('heroicon-o-document-duplicate')
                        ->color(Color::Amber)
                        ->requiresConfirmation()
                        ->modalHeading('Duplikasi Data')
                        ->modalDescription('Apakah Anda yakin ingin menggandakan data ini ? File duplikat akan dibuat dengan nama baru.')
                        ->modalSubmitActionLabel('Ya, Gandakan')
                        ->modalCancelActionLabel('Batal')
                        ->action(function (Model $record): void {
                            $duplicate = $record->replicate();
                            if (isset($duplicate->name)) {
                                $duplicate->name = $duplicate->name . ' (Copy)';
                            }
                            if ($duplicate->getAttribute('email') !== null) {
                                $emailParts = explode('@', $record->email);
                                $uniqueSuffix = '-copy-' . time(); // Menggunakan timestamp waktu agar selalu unik
                                $newEmail = $emailParts[0] . $uniqueSuffix . '@' . ($emailParts[1] ?? 'example.com');

                                $duplicate->setAttribute('email', $newEmail);
                            }
                            $duplicate->save();
                            $roles = $record->roles->pluck('name')->toArray();
                            $duplicate->assignRole($roles);
                            Notification::make()
                                ->title('Data Berhasil Diduplikasi')
                                ->success()
                                ->send();
                        }),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->label('')
                    ->iconButton()
                    ->tooltip('Opsi Data')
                    ->color('gray'),
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
