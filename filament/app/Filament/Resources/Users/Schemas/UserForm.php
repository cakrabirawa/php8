<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

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
                Select::make('group_user_id')
                    ->label('Group User')
                    ->relationship('groupUser', 'name') // 'groupUser' adalah nama fungsi relasi di Model, 'name' adalah kolom yang mau ditampilkan
                    ->searchable() // Membuat pilihan bisa dicari teksnya
                    ->preload() // Memuat data di awal agar cepat saat diklik
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                // --- KOLOM PASSWORD UTAMA ---
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable() // Menambahkan ikon mata untuk melihat password saat diketik
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->dehydrated(fn(?string $state) => filled($state))
                    ->dehydrateStateUsing(fn(string $state) => Hash::make($state)),
                // --- KOLOM RE-ENTER PASSWORD (KONFIRMASI) ---
                TextInput::make('password_confirmation')
                    ->label('Re-enter Password')
                    ->password()
                    ->revealable() // Menambahkan ikon mata juga di sini
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    // Validasi: Harus sama persis dengan isi field 'password' di atas
                    ->same('password')
                    // Menolak data ini dikirim ke database karena kita hanya butuh untuk validasi saja
                    ->dehydrated(false)
                    ->validationMessages([
                        'same' => 'Konfirmasi password tidak cocok dengan password utama.',
                    ]),
                Select::make('roles')
                    ->label('Jabatan / Role')
                    ->relationship('roles', 'name') // Menghubungkan ke relasi 'roles' bawaan Spatie
                    ->preload() // Memuat semua daftar role di awal agar cepat saat diklik
                    ->searchable() // Mengaktifkan kolom pencarian di dalam dropdown
                    ->required() // Wajib diisi agar user baru pasti punya hak akses
                    // Hapus baris di bawah ini jika 1 user HANYA BOLEH memiliki 1 jabatan saja
                    ->multiple(),
            ])->columns(3);
    }
}
