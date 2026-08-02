<?php

namespace App\Models;

use App\Models\Concerns\HasCreator;
use App\Observers\StockAdjustmentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(StockAdjustmentObserver::class)]
class StockAdjustment extends Model
{
    use HasCreator, HasFactory, SoftDeletes;

    public const TYPE_LOST        = 'lost';
    public const TYPE_DAMAGED     = 'damaged';
    public const TYPE_CORRECTION  = 'correction';

    protected $fillable = [
        'product_id',
        'adjustment_quantity',
        'type',
        'notes',
        'adjustment_date',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'adjustment_quantity' => 'integer',
            'adjustment_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
