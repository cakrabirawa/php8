<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('groupUser.name')
                    ->label('Group User')
                    ->default('-')
                    ->color('gray'),
                TextEntry::make('roles.name')
                    ->label('Jabatan / Role')
                    ->default('-')
                    ->color('gray'),
                TextEntry::make('email')
                    ->label('Email address'),
                ImageEntry::make('avatar_url')
                    ->label('Foto Profil (Avatar)')
                    ->circular() // Mengunci bentuk preview menjadi lingkaran bulat rapi
                    ->disk('public') // Memastikan membaca dari disk storage/public
                    ->visibility('public')
                    ->columnSpanFull(),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-')
            ]);
    }
}
