<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Textarea;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

// Import Skema dan Layout Filament v4/v5
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\View;

// Import Input Form Field
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

// Import Trait Livewire Forms
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class ArtisanConsole extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cpu-chip';
    protected static string | \UnitEnum | null $navigationGroup = 'Admin';
    protected static ?string $navigationLabel = 'Artisan Generator';
    protected static ?string $title = 'Artisan GUI Generator';
    protected string $view = 'filament.pages.artisan-console';

    // [TAB 1] State Properti untuk Model Generator
    public ?string $modelName = '';
    public bool $migration = false;
    public bool $controller = false;
    public bool $seeder = false;
    public bool $factory = false;
    public bool $resource = false;

    // [TAB 2] State Properti untuk Migration Generator
    public ?string $migrationName = '';

    // [TAB 3] State Properti untuk Filament Resource
    public ?string $resourceModelName = '';
    public bool $generateSoftDeletes = false;
    public bool $generateViewPage = false;
    public bool $generateSimplePage = false;

    // [TAB 4] State Properti untuk Delete Tools
    public ?string $deleteTargetName = '';
    public bool $deleteModelFile = true;
    public bool $deleteFilamentResourceFiles = true;
    public bool $deleteMigrationTable = false;

    public function mount()
    {
        $this->logToTerminal('Sistem GUI Generator siap digunakan.');
    }

    private function logToTerminal(string $message): void
    {
        $timestamp = '[' . now()->format('Y-m-d H:i:s') . ']';

        // Jika terminal masih kosong, langsung isi teksnya. Jika sudah ada, tambahkan ke baris baru (append)
        if (empty($this->terminalOutput) || $this->terminalOutput === 'Belum ada perintah yang dieksekusi.') {
            $this->terminalOutput = "{$timestamp} {$message}";
        } else {
            $this->terminalOutput .= "\n{$timestamp} {$message}";
        }
    }

    // Log Output Terminal Universal
    public ?string $terminalOutput = 'Belum ada perintah yang dieksekusi.';
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Artisan Tools')
                    ->tabs([
                        // --- 1. MODEL GENERATOR ---
                        Tabs\Tab::make('1. Model Generator')
                            ->icon('heroicon-m-cube')
                            ->schema([
                                Section::make('Buat Model Baru (make:model)')
                                    ->schema([
                                        TextInput::make('modelName')
                                            ->label('Nama Model Eloquent')
                                            ->placeholder('Contoh: Product')
                                            ->required(),
                                        Section::make('Opsi Tambahan (Flags)')
                                            ->compact()
                                            ->schema([
                                                Toggle::make('migration')->label('Buat file Database Migration (-m)'),
                                                Toggle::make('controller')->label('Buat file Controller (-c)'),
                                                Toggle::make('seeder')->label('Buat file Database Seeder (-s)'),
                                                Toggle::make('factory')->label('Buat file Model Factory (-f)'),
                                                Toggle::make('resource')->label('Tambahkan opsi --resource pada Controller'),
                                            ])->columns(2),
                                    ]),
                                View::make('filament.components.btn-generate-model'),
                            ]),

                        // --- 2. MIGRATION GENERATOR ---
                        Tabs\Tab::make('2. Migration Generator')
                            ->icon('heroicon-m-circle-stack')
                            ->schema([
                                Section::make('Buat File Migration Kustom (make:migration)')
                                    ->description('Gunakan ini jika hanya ingin menambah kolom atau membuat tabel manual tanpa model.')
                                    ->schema([
                                        TextInput::make('migrationName')
                                            ->label('Nama File Migration')
                                            ->placeholder('Contoh: add_status_to_users_table atau create_logs_table')
                                            ->required(),
                                    ]),
                                View::make('filament.components.btn-generate-model'),
                            ]),

                        // --- 3. FILAMENT RESOURCE ---
                        Tabs\Tab::make('3. Filament Resource')
                            ->icon('heroicon-m-document-text')
                            ->schema([
                                Section::make('Buat Filament Resource Baru (make:filament-resource)')
                                    ->schema([
                                        TextInput::make('resourceModelName')
                                            ->label('Nama Model untuk Resource')
                                            ->placeholder('Contoh: Product (Pastikan model sudah ada)')
                                            ->required(),
                                        Section::make('Opsi Tambahan (Flags Filament)')
                                            ->compact()
                                            ->schema([
                                                Toggle::make('generateSoftDeletes')->label('Aktifkan Soft Deletes (--soft-deletes)'),
                                                Toggle::make('generateViewPage')->label('Buat Halaman View Detail (--view)'),
                                                Toggle::make('generateSimplePage')->label('Gunakan Simple/Modal CRUD (--simple)'),
                                            ])->columns(1),
                                    ]),
                                View::make('filament.components.btn-generate-resource'),
                            ]),

                        // --- 4. DELETE TOOLS ---
                        Tabs\Tab::make('4. Delete Tools')
                            ->icon('heroicon-m-trash')
                            ->schema([
                                Section::make('Hapus Model & Filament Resource')
                                    ->description('PERINGATAN: Fitur ini akan menghapus file fisik secara permanen.')
                                    ->schema([
                                        TextInput::make('deleteTargetName')
                                            ->label('Nama Target (Nama Model)')
                                            ->placeholder('Contoh: Product')
                                            ->required(),
                                        Section::make('Pilih File yang Ingin Dihapus')
                                            ->compact()
                                            ->schema([
                                                Toggle::make('deleteModelFile')->label('Hapus File Model, Controller, Seeder, Factory')->default(true),
                                                Toggle::make('deleteFilamentResourceFiles')->label('Hapus File Filament Resource & Pages Terkait')->default(true),
                                                Toggle::make('deleteMigrationTable')->label('Otomatis Drop Tabel di Database (Jika ada)')->default(false),
                                            ])->columns(1),
                                    ]),
                                View::make('filament.components.btn-delete-tools'),
                            ]),

                        // --- 5. LOG ---
                        Tabs\Tab::make('Logs')
                            ->icon('heroicon-m-archive-box')
                            ->schema([
                                Textarea::make('terminalOutput')
                                    ->label('Log')
                                    ->placeholder('Log Content...')
                                    ->rows(15)
                                    ->extraInputAttributes([
                                        'class' => 'font-mono text-xs bg-gray-950 text-emerald-400 border-gray-800 dark:bg-black dark:border-gray-900 focus:ring-0 leading-relaxed min-h-[350px] resize-y resize-none'
                                    ])
                                // View::make('filament.components.btn-delete-tools'),
                            ]),
                    ]),
            ]);
    }
    // [LOGIKA TAB 1] Eksekusi Pembuat Model
    public function generateModel()
    {
        $this->validateOnly('modelName');
        $command = "make:model " . trim($this->modelName);
        if ($this->migration) $command .= " -m";
        if ($this->controller) $command .= " -c";
        if ($this->seeder) $command .= " -s";
        if ($this->factory) $command .= " -f";
        if ($this->resource) $command .= " --resource";

        try {
            Artisan::call($command);
            $logResult = "Berhasil menjalankan: php artisan " . $command . "\n\nLog Terminal:\n" . (Artisan::output() ?: "File sukses dibuat.");

            if ($this->migration) {
                Artisan::call('migrate --no-interaction');
                $logResult .= "\n\n=========================================\nOTOMATIS MENJALANKAN: php artisan migrate\n=========================================\n\n" . Artisan::output();
            }

            $cleanedLines = collect(explode("\n", $logResult))
                ->map(fn($line) => trim($line))
                ->filter(fn($line) => !empty($line))
                ->implode("\n");
            $formattedLog = "Artisan Output:\n" . $cleanedLines . "\n";
            $this->logToTerminal($formattedLog);

            Notification::make()->title('Proses Generator Sukses!')->success()->send();
            $this->reset(['modelName', 'migration', 'controller', 'seeder', 'factory', 'resource']);
        } catch (\Exception $e) {
            $this->logToTerminal("Gagal: " . $e->getMessage());
            Notification::make()->title('Gagal memproses data')->danger()->send();
        }
    }

    // [LOGIKA TAB 2] Eksekusi Pembuat Migration Baru
    public function generateMigration()
    {
        $this->validateOnly('migrationName');
        $command = "make:migration " . trim($this->migrationName);

        try {
            Artisan::call($command);
            $logResult = "Berhasil menjalankan: php artisan " . $command . "\n\nLog Terminal:\n" . Artisan::output();
            $cleanedLines = collect(explode("\n", $logResult))
                ->map(fn($line) => trim($line))
                ->filter(fn($line) => !empty($line))
                ->implode("\n");
            $formattedLog = "Artisan Output:\n" . $cleanedLines . "\n";
            $this->logToTerminal($formattedLog);

            Notification::make()->title('File Migration Sukses Dibuat!')->success()->send();
            $this->reset(['migrationName']);
        } catch (\Exception $e) {
            $this->logToTerminal("Gagal: " . $e->getMessage());
            Notification::make()->title('Gagal membuat migration')->danger()->send();
        }
    }

    // [LOGIKA TAB 3] Eksekusi Pembuat Filament Resource
    public function generateFilamentResource()
    {
        $this->validateOnly('resourceModelName');
        $command = "make:filament-resource " . trim($this->resourceModelName) . " --no-interaction";
        if ($this->generateSoftDeletes) $command .= " --soft-deletes";
        if ($this->generateViewPage) $command .= " --view";
        if ($this->generateSimplePage) $command .= " --simple";

        try {
            Artisan::call($command);
            $logResult = "Berhasil menjalankan: php artisan " . $command . "\n\nLog Terminal:\n" . (Artisan::output() ?: "Berhasil! File baru telah dibuat.");
            $cleanedLines = collect(explode("\n", $logResult))
                ->map(fn($line) => trim($line))
                ->filter(fn($line) => !empty($line))
                ->implode("\n");
            $formattedLog = "Artisan Output:\n" . $cleanedLines . "\n";
            $this->logToTerminal($formattedLog);
            Notification::make()->title('Proses Generator Sukses!')->success()->send();
            $this->reset(['resourceModelName', 'generateSoftDeletes', 'generateViewPage', 'generateSimplePage']);
        } catch (\Exception $e) {
            $this->logToTerminal("Gagal: " . $e->getMessage());
            Notification::make()->title('Gagal menjalankan perintah')->danger()->send();
        }
    }
    // [LOGIKA TAB 4] Eksekusi Penghapusan Komponen & Database Rollback
    public function deleteComponents()
    {
        $this->validateOnly('deleteTargetName');
        $target = trim($this->deleteTargetName);

        // Transformasi nama string untuk mencakup format Tunggal dan Jamak bawaan Filament
        $singularTarget = str($target)->singular()->studly()->toString();
        $pluralTarget = str($target)->plural()->studly()->toString();

        $this->logToTerminal("Memulai proses pembersihan untuk target: {$singularTarget}=========================================");

        // 1. Drop Tabel Database
        if ($this->deleteMigrationTable) {
            $tableName = str($singularTarget)->snake()->plural()->toString();
            try {
                \Illuminate\Support\Facades\DB::statement("DROP TABLE IF EXISTS {$tableName}");
                \Illuminate\Support\Facades\DB::table('migrations')->where('migration', 'like', "%_create_{$tableName}_table")->delete();
                $this->logToTerminal("[DATABASE] Sukses melakukan DROP TABLE '{$tableName}'");
            } catch (\Exception $e) {
                $this->logToTerminal("[DATABASE ERROR] " . $e->getMessage());
            }
        }

        // 2. Hapus Berkas Model & Pendukung Kode
        if ($this->deleteModelFile) {
            $filesToDelete = [
                app_path("Models/{$singularTarget}.php"),
                app_path("Models/{$pluralTarget}.php"), // Cadangan jika model tersimpan format jamak
                app_path("Http/Controllers/{$singularTarget}Controller.php"),
                app_path("Http/Controllers/{$pluralTarget}Controller.php"),
                database_path("factories/{$singularTarget}Factory.php"),
                database_path("seeders/{$singularTarget}Seeder.php"),
            ];

            $tableName = str($singularTarget)->snake()->plural()->toString();
            $migrationFiles = File::glob(database_path("migrations/*_create_{$tableName}_table.php"));
            if ($migrationFiles) $filesToDelete = array_merge($filesToDelete, $migrationFiles);

            foreach ($filesToDelete as $file) {
                if (File::exists($file)) {
                    File::delete($file);
                    $this->logToTerminal("[DELETED] File dihapus: " . basename($file));
                }
            }
        }

        // 3. Hapus File & Folder Resource Filament (Mendukung Deteksi Folder Jamak/Tunggal Lengkap)
        if ($this->deleteFilamentResourceFiles) {
            // Daftar file utama resource yang mungkin terbentuk
            $possibleFiles = [
                app_path("Filament/Resources/{$singularTarget}Resource.php"),
                app_path("Filament/Resources/{$pluralTarget}Resource.php"),
            ];

            // Daftar seluruh kemungkinan variasi nama folder yang dibuat oleh Filament / Generator
            $possibleFolders = [
                app_path("Filament/Resources/{$singularTarget}Resource"), // Contoh: Equipment3Resource
                app_path("Filament/Resources/{$pluralTarget}Resource"),  // Contoh: Equipment3sResource
                app_path("Filament/Resources/{$pluralTarget}Resources"), // Contoh: Equipment3sResources
                app_path("Filament/Resources/{$pluralTarget}"),           // Contoh Kasus Anda: Equipment3s
                app_path("Filament/Resources/{$singularTarget}"),         // Contoh: Equipment3
            ];

            // Eksekusi Penghapusan File Utama
            foreach ($possibleFiles as $file) {
                if (File::exists($file)) {
                    File::delete($file);
                    $this->logToTerminal("[DELETED] File utama resource dihapus: " . basename($file));
                }
            }

            // Eksekusi Penghapusan Folder Halaman (Pages)
            foreach ($possibleFolders as $folder) {
                if (File::isDirectory($folder)) {
                    File::deleteDirectory($folder);
                    $this->logToTerminal("[DELETED] Folder direktori resource sukses dihancurkan: " . basename($folder));
                }
            }
        }

        $this->logToTerminal("[SELESAI] Semua komponen sukses dibersihkan dari direktori.");

        $this->dispatch('close-modal', id: 'delete-components-modal');

        Notification::make()->title('Komponen Berhasil Dihapus!')->warning()->send();

        // Perbaikan: Reset properti secara aman tanpa menghilangkan state penting jika diperlukan
        $this->reset(['deleteTargetName', 'deleteMigrationTable']);

        // Membersihkan cache manifest agar menu sidebar langsung hilang seketika
        Artisan::call('filament:clear-cached-components');
    }
} // <- Penutup Class Utama Halaman
