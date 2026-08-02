<?php

namespace App\Models;

use App\Observers\PurchaseItemObserver;
use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(PurchaseItemObserver::class)]
class PurchaseItem extends Model
{
    use Blameable, HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'cost_price',
        'subtotal',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'cost_price' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'deleted_at' => 'datetime',
        ];
    }

    public function purchase(): BelongsTo
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
