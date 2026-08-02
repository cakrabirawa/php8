<?php

namespace App\Models;

use App\Observers\SaleItemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(SaleItemObserver::class)]
class SaleItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'cost_price',
        'original_price',
        'promo_discount_amount',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'cost_price' => 'decimal:2',
            'original_price' => 'decimal:2',
            'promo_discount_amount' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
