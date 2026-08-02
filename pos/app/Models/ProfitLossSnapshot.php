<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * migration tambahan yang diperlukan:
 *
 * Schema::create('profit_loss_snapshots', function (Blueprint $table) {
 *     $table->id();
 *     $table->date('period_start');
 *     $table->date('period_end');
 *     $table->decimal('gross_revenue', 14, 2);
 *     $table->decimal('total_cost', 14, 2);
 *     $table->decimal('gross_profit', 14, 2);
 *     $table->decimal('total_expenses', 14, 2);
 *     $table->decimal('net_profit', 14, 2);
 *     $table->timestamp('locked_at');
 *     $table->foreignId('created_by')->constrained('users');
 *     $table->timestamps();
 *     $table->unique(['period_start', 'period_end']);
 * });
 *
 * Kegunaan tabel ini: begitu sebuah periode (misal bulan Januari) "ditutup"
 * oleh admin, angka Rugi Laba-nya dibekukan di sini. Laporan untuk periode
 * yang sudah closed akan dibaca dari snapshot ini (bukan dihitung ulang),
 * sehingga tidak berubah lagi walau ada transaksi lama yang diedit/dihapus
 * setelah periode ditutup — sesuai prinsip akuntansi bahwa laporan yang
 * sudah closed harus immutable.
 */
class ProfitLossSnapshot extends Model
{
    use HasCreator, HasFactory, SoftDeletes;

    protected $fillable = [
        'period_start',
        'period_end',
        'gross_revenue',
        'total_cost',
        'gross_profit',
        'total_expenses',
        'net_profit',
        'locked_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'period_start' => 'date',
            'period_end' => 'date',
            'gross_revenue' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'gross_profit' => 'decimal:2',
            'total_expenses' => 'decimal:2',
            'net_profit' => 'decimal:2',
            'locked_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
