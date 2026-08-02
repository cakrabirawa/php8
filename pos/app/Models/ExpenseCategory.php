<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * migration tambahan yang diperlukan:
 *
 * Schema::create('expense_categories', function (Blueprint $table) {
 *     $table->id();
 *     $table->string('name')->unique();
 *     $table->foreignId('created_by')->constrained('users');
 *     $table->timestamps();
 * });
 *
 * Schema::table('expenses', function (Blueprint $table) {
 *     $table->foreignId('expense_category_id')
 *           ->nullable()
 *           ->after('title')
 *           ->constrained('expense_categories')
 *           ->nullOnDelete();
 * });
 */
class ExpenseCategory extends Model
{
    use HasCreator, HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
