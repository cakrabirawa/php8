<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel yang perlu kolom `deleted_at` untuk mendukung SoftDeletes
     * di semua model (User, Supplier, Category, MemberType, Customer,
     * Product, Purchase, PurchaseItem, StockAdjustment, Promotion,
     * Expense, ExpenseCategory, Sale, SaleItem, ProfitLossSnapshot).
     */
    private array $tables = [
        'users',
        'suppliers',
        'categories',
        'member_types',
        'customers',
        'products',
        'purchases',
        'purchase_items',
        'stock_adjustments',
        'promotions',
        'expenses',
        'expense_categories',
        'sales',
        'sale_items',
        'profit_loss_snapshots',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (! Schema::hasColumn($table, 'deleted_at')) {
                    $blueprint->softDeletes();
                }
            });
        }

        // ---------------------------------------------------------------
        // Catatan penting soal kolom UNIQUE + SoftDeletes:
        //
        // Kolom `products.barcode` dan `categories.name` (unique) akan
        // tetap dianggap "terpakai" oleh baris yang sudah di-soft-delete,
        // karena baris itu masih ada secara fisik di tabel — hanya
        // `deleted_at`-nya terisi. Ini bisa membuat re-create data dengan
        // barcode/nama yang sama gagal walau data lamanya "sudah dihapus"
        // secara tampilan.
        //
        // SQLite tidak mendukung partial/conditional unique index secara
        // native lewat Blueprint bawaan Laravel, jadi ada dua opsi:
        //
        // 1) (Direkomendasikan untuk fase development ini) Biarkan unique
        //    index apa adanya, dan tangani di level validasi Filament
        //    dengan `->unique(ignoreRecord: true, modifyRuleUsing: fn ($rule)
        //    => $rule->withoutTrashed())` — supaya user diberi pesan error
        //    yang jelas, dan sediakan tombol "Restore" di halaman Trashed
        //    alih-alih user membuat data baru dengan barcode yang sama.
        //
        // 2) Untuk production di atas MySQL/PostgreSQL, unique index bisa
        //    diganti jadi composite unique (barcode, deleted_at) via raw
        //    SQL, atau pakai partial index (PostgreSQL: `WHERE deleted_at
        //    IS NULL`) supaya barcode yang sudah "dihapus" bisa dipakai
        //    ulang oleh produk baru.
        // ---------------------------------------------------------------
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (Schema::hasColumn($table, 'deleted_at')) {
                    $blueprint->dropSoftDeletes();
                }
            });
        }
    }
};
