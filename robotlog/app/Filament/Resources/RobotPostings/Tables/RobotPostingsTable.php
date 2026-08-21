<?php

namespace App\Filament\Resources\RobotPostings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Filament\Actions\Action;
use \App\Models\RobotPosting;

class RobotPostingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->addSelect([
                '*',
                'last_sys_browser_status' => DB::table('robot_sys_browser')
                    ->select('status')
                    // ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    // Mengambil data paling baru berdasarkan ID terbesar atau start_date terbaru
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_sys_browser_batch_id' => DB::table('robot_sys_browser')
                    ->select('batch_job_id')
                    // ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_sys_browser_timestamp' => DB::table('robot_sys_browser')
                    ->select('timestamp')
                    // ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_job_error_details_log' => DB::table('robot_job_logs')
                    ->select('error_details_log')
                    ->whereRaw('job_id = (SELECT batch_job_id FROM robot_sys_browser WHERE upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number)) ORDER BY id DESC LIMIT 1)')
                    ->orderBy('timestamp_extracted', 'desc')
                    ->limit(1),
            ]))
            ->modifyQueryUsing(fn($query) => $query->withCount([
                'robotLogs as total_errors' => fn($q) => $q->where('status', 'ERROR')
            ]))
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->copyable()
                    ->copyMessage(fn(string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->action(
                        Action::make('viewErrors')
                            ->modalHeading(fn(RobotPosting $record) => "Daftar Error - Invoice: {$record->invoice_number}")
                            ->modalWidth('5xl')  // Ukuran popup lebar agar muat tabel
                            ->modalSubmitAction(false) // Hilangkan tombol "Save/Submit" karena hanya view
                            ->modalCancelActionLabel('Tutup')
                            ->modalContent(fn(RobotPosting $record) => view('filament.pages.actions.error-logs-table', [
                                // Ambil hanya riwayat dengan status ERROR dari invoice terkait
                                'errors' => $record->robotLogs()->where('status', 'ERROR')->orderBy('timestamp', 'desc')->get(),
                            ]))
                    ),
                TextColumn::make('last_sys_browser_status')
                    ->label('Last Status')
                    ->badge()
                    ->color(fn(string $state): string => match (strtoupper(trim($state))) {
                        'ERROR' => 'danger',
                        'ENDED', 'END' => 'success',
                        'EXECUTING' => 'warning',
                        default => 'gray',
                    })
                    ->alignCenter()
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereIn('invoice_number', function ($sub) use ($search) {
                            $sub->select('invoice_no')
                                ->from('robot_sys_browser')
                                ->where('status', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('total_errors')
                    ->label('Total Error Robot')
                    ->badge()
                    ->alignRight()
                    ->color(fn($state) => $state > 0 ? 'danger' : 'success'),
                // 3. Kolom Batch Job ID dari sysbrowser
                TextColumn::make('last_sys_browser_batch_id')
                    ->label('Last Batch Job Id')
                    ->copyable()
                    ->copyMessage(fn(string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereIn('invoice_number', function ($sub) use ($search) {
                            $sub->select('invoice_no')
                                ->from('robot_sys_browser')
                                ->where('batch_job_id', 'like', "%{$search}%");
                        });
                    }),

                // 4. Kolom Timestamp dari sysbrowser
                TextColumn::make('last_sys_browser_timestamp')
                    ->label('Timestamp')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('last_job_error_details_log')
                    ->label('Error Details Log')
                    ->limit(100)
                    ->wrap()
                    ->tooltip(fn($state) => $state)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('invoice_account')->label("Invoice Account")
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('final_status')->label("Final Status")
                    ->searchable(),
                TextColumn::make('final_status_checked_date')->label("Final Status Checked Date")
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
            ->striped()
        ;
    }
}
