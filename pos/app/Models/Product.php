<?php

namespace App\Models;

use App\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Blameable, HasFactory, SoftDeletes;

    protected $fillable = [
        'barcode',
        'name',
        'category_id',
        'stock',
        'cost_price',
        'selling_price',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
            'cost_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'is_active' => 'boolean',
            'deleted_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function purchaseItems(): HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function stockAdjustments(): HasMany
    {
        return $this->hasMany(StockAdjustment::class);
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    /*
    |--------------------------------------------------------------------
    | Business logic helpers
    |--------------------------------------------------------------------
    */

    /**
     * Currently active promotion for this product (if any), used by the
     * cashier scan flow to apply the "Diskon Ganda" (promo + member) logic.
     */
    public function activePromotion(): ?Promotion
    {
        return $this->promotions()
            ->where('is_active', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->latest('start_date')
            ->first();
    }

    /**
     * Selling price after applying the active per-item promo (if any),
     * before any member-tier discount is applied.
     */
    public function getPriceAfterPromoAttribute(): float
    {
        $promo = $this->activePromotion();

        if (! $promo) {
            return (float) $this->selling_price;
        }

        if ($promo->discount_type === Promotion::TYPE_PERCENTAGE) {
            $discount = ((float) $this->selling_price) * ((float) $promo->discount_value / 100);
        } else {
            $discount = (float) $promo->discount_value;
        }

        return max(0, (float) $this->selling_price - $discount);
    }

    protected static function booted(): void
    {
        static::creating(function ($product) {
            // 1. Cek apakah ada barcode yang diinput oleh user/system
            if (!empty($product->barcode)) {

                // 2. Periksa apakah barcode tersebut sudah ada di database
                // Kita pakai "withTrashed()" karena model Anda menggunakan SoftDeletes
                $isDuplicate = static::withTrashed()->where('barcode', $product->barcode)->exists();

                // 3. Jika duplikat, paksa ganti barcodenya menggunakan format dmyHis + angka acak
                if ($isDuplicate) {
                    do {
                        $newBarcode = now()->format('dmyHis') . rand(10, 99);
                        // Terus mengulang acakan jika kode dmyHis yang dihasilkan masih bentrok
                    } while (static::withTrashed()->where('barcode', $newBarcode)->exists());

                    $product->barcode = $newBarcode;
                }
            } else {
                // Jika user memang mengosongkan barcode sejak awal
                $product->barcode = now()->format('dmyHis') . rand(10, 99);
            }
        });
    }
}
