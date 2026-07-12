<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('product_image')
                    ->label('Foto Produk')
                    ->disk('public'), // 🛠️ WAJIB: Kunci mutlak ke disk public
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
                Action::make('duplicate')
                    ->label('Duplicate') // Nama tombol yang muncul
                    ->icon('heroicon-o-document-duplicate') // Ikon lembaran ganda
                    ->color('warning') // Warna tombol (oranye/kuning)
                    ->requiresConfirmation() // Memunculkan popup konfirmasi sebelum duplikasi
                    ->modalHeading('Duplikasi Data')
                    ->modalDescription('Apakah Anda yakin ingin menggandakan data ini?')
                    ->modalSubmitActionLabel('Ya, Duplikat')
                    ->action(function (Model $record) {
                        // 1. Replicate: Menyalin seluruh data baris tersebut kecuali ID dan Timestamps
                        $duplicate = $record->replicate();
                        // 2. Modifikasi (Opsional): Menambahkan kata ' (Copy)' di belakang nama agar tidak kembar
                        if (isset($duplicate->product_name)) {
                            $duplicate->product_name = $duplicate->product_name . ' (Copy)';
                        }
                        // 3. Simpan data baru tersebut ke database
                        $duplicate->save();
                        // 4. Memunculkan notifikasi sukses pop-up hijau di kanan atas
                        Notification::make()
                            ->title('Data Berhasil Diduplikasi')
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->actions([
                // 🛠️ BUNGKUS SEMUA TOMBOL DENGAN ACTIONGROUP
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    ReplicateAction::make()
                        ->label('Duplicate'), // Mengubah teks tombol duplikat jika diperlukan
                ])
                    ->label('') // Teks utama pada tombol dropdown (bisa dikosongkan jika hanya ingin ikon)
                    ->icon('heroicon-m-ellipsis-vertical') // Mengubah ikon menjadi titik tiga vertikal yang ringkas
                    ->color('gray') // Mengubah warna tombol dropdown
                    ->button(), // Membuat bentuknya menjadi tombol (opsional, jika dihapus akan berupa tautan teks biasa)
            ])
        ;
    }
}
