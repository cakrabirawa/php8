<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Infolists\Components\TableEntry;
use Illuminate\Support\HtmlString;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->dehydrated(fn(?string $state) => filled($state))
                    ->dehydrateStateUsing(fn(string $state) => Hash::make($state)),
                TextInput::make('password_confirmation')
                    ->label('Re-enter Password')
                    ->password()
                    ->revealable()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->same('password')
                    ->dehydrated(false)
                    ->validationMessages([
                        'same' => 'Konfirmasi password tidak cocok dengan password utama.',
                    ]),
                Select::make('roles')
                    ->label('Jabatan / Role')
                    ->relationship('roles', 'name')
                    ->preload()
                    ->searchable()
                    ->required()
                    ->multiple(),
                FileUpload::make('avatar_url')
                    ->label('Foto Profil (Avatar)')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->maxSize(1024)
                    ->columnSpanFull(),
                ViewField::make('active_tokens')
                    ->label('Active Tokens')
                    ->columnSpanFull()
                    ->view('filament.components.token-table')

            ])->columns(2);
    }
}
