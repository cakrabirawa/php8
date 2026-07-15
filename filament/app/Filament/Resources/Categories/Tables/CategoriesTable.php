<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Filament\Exports\CustomCsvExport;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.name')
                    ->label('Kategori Induk')
                    ->default('-') // Jika kosong, tampilkan tanda strip
                    ->color('gray'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('hanya_induk')
                    ->label('Hanya Kategori Utama')
                    ->query(fn($query) => $query->whereNull('parent_id')),
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
                    CustomCsvExport::make(),
                ]),
            ])
        ;
    }
}
