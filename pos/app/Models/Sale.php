<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasCreator, HasFactory, SoftDeletes;

    public const PAYMENT_CASH     = 'cash';
    public const PAYMENT_QRIS     = 'qris';
    public const PAYMENT_EDC      = 'edc';
    public const PAYMENT_TRANSFER = 'transfer';

    protected $fillable = [
        'invoice_number',
        'customer_id',
        'total_amount',
        'total_cost',
        'promo_discount',
        'member_discount',
        'grand_total',
        'paid_amount',
        'change_amount',
        'payment_method',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'total_amount' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'promo_discount' => 'decimal:2',
            'member_discount' => 'decimal:2',
            'grand_total' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'change_amount' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Gross profit for this single transaction (used to roll up into the
     * company-wide Profit & Loss report): grand_total - total_cost.
     */
    public function getGrossProfitAttribute(): float
    {
        return (float) $this->grand_total - (float) $this->total_cost;
    }
}
