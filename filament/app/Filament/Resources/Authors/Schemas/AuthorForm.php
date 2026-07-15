<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                DatePicker::make('dob')->label('Tanggal Lahir')->required(),
                TextInput::make('email')->required()->email(),
                Repeater::make('phones')
                    ->relationship() // Membaca otomatis relasi phones() di model Author
                    ->label('Daftar Nomor Telepon')
                    ->schema([
                        Grid::make([
                            'default' => 2, // Membagi form baris menjadi 2 kolom simetris
                        ])
                            ->schema([
                                TextInput::make('phone_number')
                                    ->label('Nomor Telepon')
                                    ->tel()
                                    ->required()
                                    ->placeholder('Contoh: 08123456789'),

                                Select::make('label')
                                    ->label('Tipe Kontak')
                                    ->options([
                                        'wa' => 'WhatsApp',
                                        'rumah' => 'Rumah',
                                        'kantor' => 'Kantor',
                                    ])->required(),
                            ]),
                    ])
                    ->addActionLabel('Tambah Baris Nomor')
                    ->reorderable(false) // Mematikan drag agar mirip tabel kaku yang rapi
                    ->deletable(true)    // Menyediakan tombol tempat sampah untuk hapus per baris
                    // Fitur Advance: Tombol "Hapus Semua" di pojok kanan atas label judul
                    ->hintAction(
                        Action::make('clearAll')
                            ->label('Hapus Semua')
                            ->color('danger')
                            ->icon('heroicon-m-trash')
                            ->requiresConfirmation() // Menampilkan dialog pop-up konfirmasi
                            ->action(function (Repeater $component) {
                                $component->state([]); // Mengosongkan data array form
                            })
                    )
                    ->columnSpanFull()
                    ->minItems(1) // Memaksa minimal harus ada 1 baris input data
                    ->required()
                    ->validationMessages([
                        'required' => 'Daftar nomor telepon tidak boleh kosong, silakan isi minimal satu.',
                        'min' => 'Wajib memasukkan minimal :min nomor telepon sebelum menyimpan.',
                    ])
            ]);
    }
}
