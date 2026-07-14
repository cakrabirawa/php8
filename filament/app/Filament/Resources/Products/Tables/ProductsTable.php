<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Category;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product_image')
                    ->label('Foto Produk')
                    ->disk('public'),
                TextColumn::make('product_name')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable()
                    ->html()
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('price')
                    ->money('idr', true)
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->default('-') // Jika kosong, tampilkan tanda strip
                    ->color('gray'),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->formatStateUsing(function ($state, Product $record) {
                        if (! $record->category) {
                            return '-';
                        }
                        $paths = [];
                        $currentCategory = $record->category;
                        while ($currentCategory) {
                            $paths[] = $currentCategory->name;
                            $currentCategory = $currentCategory->parent;
                        }
                        $orderedPaths = array_reverse($paths);
                        return implode(' ➔ ', $orderedPaths);
                    })
                    ->html()
                    ->wrap(),
                TextColumn::make('creator.name')
                    ->label('Dibuat Oleh')
                    ->placeholder('Sistem / Anonim')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updater.name')
                    ->label('Diubah Terakhir Oleh')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->humanFormat(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->humanFormat(),
            ])
            ->filters([
                //
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
                            if (isset($duplicate->product_name)) {
                                $duplicate->product_name = $duplicate->product_name . ' (Copy)';
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
            ->defaultSort('created_at', 'desc')
            ->striped()
        ;
    }
}
