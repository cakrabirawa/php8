<?php

namespace App\Filament\Resources\RobotPostings\Tables;

use App\Models\RobotPosting;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class RobotPostingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->addSelect([
                '*',
                'last_sys_browser_status' => DB::table('robot_sys_browser')
                    ->select('status')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_sys_browser_batch_id' => DB::table('robot_sys_browser')
                    ->select('batch_job_id')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_sys_browser_timestamp' => DB::table('robot_sys_browser')
                    ->select('timestamp')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('id', 'desc')
                    ->limit(1),
                'last_job_error_details_log' => DB::table('robot_job_logs')
                    ->select('info')
                    ->whereRaw('upper(TRIM(invoice_no)) = upper(TRIM(robot_postings.invoice_number))')
                    ->orderBy('robot_job_logs.id', 'desc')
                    ->limit(1),
            ]))
            ->modifyQueryUsing(fn ($query) => $query->withCount([
                'robotLogs as total_errors' => fn ($q) => $q->where('status', 'ERROR'),
            ]))
            ->columns([
                TextColumn::make('invoice_number')->label('Invoice No')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage(fn (string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->action(
                        Action::make('viewErrors')
                            ->modalHeading(fn (RobotPosting $record) => "Daftar Error - Invoice: {$record->invoice_number}")
                            ->modalWidth('5xl')
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                            ->modalContent(fn (RobotPosting $record) => view('filament.pages.actions.error-logs-table', [
                                'errors' => $record->robotLogs()->where('status', 'ERROR')->orderBy('timestamp', 'desc')->get(),
                            ]))
                    ),
                TextColumn::make('last_sys_browser_status')
                    ->stickyable()
                    ->label('Last Batch Status')
                    ->badge()
                    ->color(fn (string $state): string => match (strtoupper(trim($state))) {
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
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'success'),
                TextColumn::make('last_sys_browser_batch_id')
                    ->label('Last Batch Job Id')
                    ->copyable()
                    ->copyMessage(fn (string $state): string => "Teks '{$state}' berhasil disalin!")
                    ->copyMessageDuration(1500)
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereIn('invoice_number', function ($sub) use ($search) {
                            $sub->select('invoice_no')
                                ->from('robot_sys_browser')
                                ->where('batch_job_id', 'like', "%{$search}%");
                        });
                    }),
                TextColumn::make('last_sys_browser_timestamp')
                    ->label('Time Stamp')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable(),
                TextColumn::make('last_job_error_details_log')
                    ->label('Last Error Details')
                    ->limit(100)
                    ->wrap()
                    ->tooltip(fn ($state) => $state)
                    ->sortable()
                    // Karena ini kolom virtual hasil subquery, pencarian harus diarahkan ke tabel aslinya lewat join manual
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereIn('invoice_number', function ($sub) use ($search) {
                            $sub->select('b.invoice_no')
                                ->from('robot_job_logs as l')
                                ->join('robot_sys_browser as b', 'l.batch_job_id', '=', 'b.batch_job_id')
                                ->where('l.info', 'like', "%{$search}%");
                        });
                    })
                    ->stickyable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('invoice_account')->label('Invoice Account')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('posting_attempt')->label('Attempt Posting')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('recovery_attempt')->label('Attempt Recovery')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('final_status')->label('Final Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('final_status_checked_date')->label('Final Status Checked Date')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('d/m/y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('status', 'desc')
            ->striped()
            ->stickyableColumns();
    }
}
