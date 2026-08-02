<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barcode')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->searchable(),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cost_price')
                    ->money()
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->money()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('creator.name')
                    ->label('Creator'),
                TextColumn::make('updater.name')
                    ->label('Updater'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
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
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
