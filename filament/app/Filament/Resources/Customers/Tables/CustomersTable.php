<?php

namespace App\Filament\Resources\Customers\Tables;

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

class CustomersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
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
            ])->defaultSort('created_at', 'desc')
            ->striped()
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
                            $duplicate->save();
                            Notification::make()
                                ->title('Berhasil diduplikasi')
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
        ;
    }
}
