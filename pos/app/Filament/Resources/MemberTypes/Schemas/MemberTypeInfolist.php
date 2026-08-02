<?php

namespace App\Filament\Resources\MemberTypes\Schemas;

use App\Models\MemberType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MemberTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('discount_percentage')
                    ->numeric(),
                TextEntry::make('creator.name')
                    ->label('Creator')
                    ->placeholder('-'),
                TextEntry::make('updater.name')
                    ->label('Updater')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn(MemberType $record): bool => $record->trashed()),
            ]);
    }
}
