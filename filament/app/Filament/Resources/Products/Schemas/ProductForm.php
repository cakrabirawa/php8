<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Set;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('price')
                    ->label('Price')
                    ->prefix('Rp')
                    ->mask(RawJs::make(<<<'JS'
        $money($input, '.', ',')
    JS))
                    ->stripCharacters('.')
                    ->required(),
                // Select::make('category_id')
                //     ->label('Kategori')
                //     ->relationship('category', 'name') // 'category' adalah nama fungsi relasi di Model, 'name' adalah kolom yang mau ditampilkan
                //     ->searchable() // Membuat pilihan bisa dicari teksnya
                //     ->preload() // Memuat data di awal agar cepat saat diklik
                //     ->required(),
                SelectTree::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name', 'parent_id') // Sesuaikan nama relasi di model Anda
                    ->placeholder('Pilih kategori atau sub-kategori...')
                    ->enableBranchNode()
                    ->withCount() // Opsional: Menampilkan jumlah item di dalam kategori tersebut
                    ->searchable(), // Opsional: Mempermudah pencarian
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori')
                    ->searchable()
                    ->preload()
                    // 💡 Tambahkan tombol aksi pencarian di sebelah dropdown
                    ->suffixAction(
                        Action::make('lookupKategori')
                            ->icon('heroicon-m-magnifying-glass')
                            ->tooltip('Cari Kategori via Tabel')
                            ->modalHeading('Pilih Kategori Produk')
                            ->modalWidth('4xl') // Membuat ukuran modal pop-up lebar
                            // Masukkan tabel pencarian ke dalam modal
                            ->schema([
                                Grid::make(1)->schema([
                                    // Menggunakan komponen repeater atau radio tabel kustom
                                    Radio::make('selected_id')
                                        ->label('Pilih salah satu kategori di bawah ini:')
                                        ->options(Category::all()->pluck('name', 'id'))
                                        ->descriptions(Category::all()->mapWithKeys(function ($item) {
                                            return [$item->id => $item->parent ? "Induk: {$item->parent->name}" : 'Kategori Utama'];
                                        })->toArray())
                                        ->required(),
                                ])
                            ])
                            // Ketika admin memilih di modal dan klik tombol "Pilih"
                            ->action(function (array $data, Set $set) {
                                $set('category_id', $data['selected_id']);
                            })
                    ),
                RichEditor::make('description')
                    ->columnSpanFull()
                    ->maxLength(255),
                FileUpload::make('product_image')
                    ->label('Foto Produk (Avatar)')
                    ->image() // Hanya gambar
                    ->avatar() // Bentuk lingkaran estetik
                    ->disk('public') // 🛠️ WAJIB: Kunci mutlak ke disk public
                    ->directory('products')
                    ->visibility('public')
                    ->maxSize(1024) // Maksimal 1 MB
                    ->imageEditor()
                    ->circleCropper()
                    ->columnSpanFull(),
            ]);
    }
}
