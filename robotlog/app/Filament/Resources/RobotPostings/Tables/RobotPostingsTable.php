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

class RobotPostingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->addSelect([
                '*',
                'last_sys_browser_status' => DB::table('robot_sys_browser')
                    ->select('status')
                    ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    // Mengambil data paling baru berdasarkan ID terbesar atau start_date terbaru
                    ->orderBy('id', 'desc') 
                    ->limit(1),
                'last_sys_browser_batch_id' => DB::table('robot_sys_browser')
                    ->select('batch_job_id')
                    ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    ->orderBy('id', 'desc') 
                    ->limit(1),

                'last_sys_browser_timestamp' => DB::table('robot_sys_browser')
                    ->select('timestamp')
                    ->whereColumn('invoice_no', 'robot_postings.invoice_number')
                    ->orderBy('id', 'desc') 
                    ->limit(1),
            ]))
            ->columns([
                TextColumn::make('last_sys_browser_status')
                ->label('Last Status')
                ->badge() // Membuat tampilan lebih rapi seperti badge status
                ->color(fn (string $state): string => match (strtoupper(trim($state))) {
                    'ERROR' => 'danger',
                    'ENDED', 'END' => 'success',
                    'EXECUTING' => 'warning',
                    default => 'gray',
                })
                ->sortable()
                ->searchable(query: function (Builder $query, string $search): Builder {
                    // Fitur pencarian kustom agar kolom virtual ini bisa di-search
                    return $query->whereIn('invoice_number', function ($sub) use ($search) {
                        $sub->select('invoice_no')
                            ->from('robot_sys_browser')
                            ->where('status', 'like', "%{$search}%");
                    });
                }),
                // 3. Kolom Batch Job ID dari sysbrowser
                TextColumn::make('last_sys_browser_batch_id')
                    ->label('Batch Job ID')
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
                    ->dateTime() // Format tanggal dan waktu otomatis bawaan Filament
                    ->sortable(),
                TextColumn::make('invoice_number')
                    ->searchable(),
                TextColumn::make('company')
                    ->searchable(),
                TextColumn::make('invoice_account')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('purchase_order')
                    ->searchable(),
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
                // ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ])
        ;
    }
}
