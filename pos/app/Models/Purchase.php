<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use Blameable, HasFactory, SoftDeletes;

    protected $fillable = [
        'purchase_number',
        'supplier_id',
        'grand_total',
        'purchase_date',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'grand_total' => 'decimal:2',
            'purchase_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
