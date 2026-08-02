<?php

namespace App\Filament\Resources\PurchaseResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required()
                    ->default(1),

                Forms\Components\TextInput::make('cost_price')
                    ->prefix('$')
                    ->required()
                    ->extraAlpineAttributes([
                        'x-mask:dynamic' => "\$money(\$input, ',', '.', 0)",
                    ])
                    ->dehydrateStateUsing(fn($state) => (int) str_replace('.', '', $state)),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Product'),
                Tables\Columns\TextColumn::make('quantity')->alignCenter(),
                Tables\Columns\TextColumn::make('cost_price')->money('USD', divideBy: 100),
                Tables\Columns\TextColumn::make('subtotal')->money('USD', divideBy: 100),
            ])
            ->filters([])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
