<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->disk('public'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Jabatan')
                    ->badge()
                    ->color('success')
                    ->searchable(),
                TextColumn::make('tokens_count')
                    ->label('API Token')
                    ->counts('tokens')
                    ->badge()
                    ->color('info'),
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
                    Action::make('generate_token')
                        ->label('Generate Token')
                        ->icon('heroicon-o-arrow-path')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Generate API Token Baru')
                        ->modalDescription('Apakah Anda yakin ingin membuat token baru untuk user ini? Token lama akan tetap aktif.')
                        ->action(function (?User $record) {
                            if (! $record) {
                                return;
                            }
                            $tokenName = $record->name . '-Token-' . now()->format('Ymd');
                            $token = $record->createToken($tokenName)->plainTextToken;
                            Notification::make()
                                ->title('Sukses Generate Token!')
                                ->body("Salin Token Anda Sekarang:\n\n **{$token}** \n\n*Token tidak akan ditampilkan lagi setelah jendela ini ditutup demi keamanan.*")
                                ->persistent()
                                ->send();
                        }),
                    Action::make('revoke_all_tokens')
                        ->label('Revoke All Token')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Revoke Semua Token API')
                        ->modalDescription('Apakah Anda yakin ingin menghapus seluruh token API aktif untuk user ini? Seluruh integrasi pihak ketiga yang menggunakan token user ini akan langsung terputus secara permanen.')
                        ->modalSubmitActionLabel('Ya, Hapus Semua')
                        ->modalCancelActionLabel('Batal')
                        ->action(function (?User $record) {
                            if (! $record) {
                                return;
                            }
                            $record->tokens()->delete();
                            Notification::make()
                                ->title('Seluruh Token Berhasil Dihapus')
                                ->body("Semua akses API untuk user **{$record->name}** telah dinonaktifkan.")
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
