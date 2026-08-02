<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\PurchaseItem;
use Illuminate\Support\Facades\DB;

/**
 * Keeps product stock and cost_price (HPP) in sync whenever goods are
 * received (Purchases module).
 *
 * Business rules implemented here:
 *  - Every new PurchaseItem increases the parent Product's stock by the
 *    received quantity.
 *  - The Product's cost_price is overwritten with the latest purchase
 *    cost_price, so it always reflects the most recent buying price
 *    (real-time HPP tracking), even when the same product is sourced
 *    from different suppliers at different prices.
 *  - Updating or deleting a PurchaseItem reverses/re-applies the stock
 *    delta so the ledger stays consistent if a receipt is corrected.
 *  - PurchaseItem uses SoftDeletes: the `deleted()` event below still
 *    fires on a soft delete (it just checks a WHERE, model row stays),
 *    so soft-deleting a receipt line correctly reverses the stock it
 *    added. If the line is later restored via restoreQuietly-free
 *    `restore()`, the `restored()` handler re-applies the stock.
 */
class PurchaseItemObserver
{
    public function created(PurchaseItem $purchaseItem): void
    {
        DB::transaction(function () use ($purchaseItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($purchaseItem->product_id);

            if (! $product) {
                return;
            }

            $product->increment('stock', $purchaseItem->quantity);

            // Latest purchase cost becomes the new HPP basis.
            $product->update([
                'cost_price' => $purchaseItem->cost_price,
            ]);
        });
    }

    public function updated(PurchaseItem $purchaseItem): void
    {
        if (! $purchaseItem->wasChanged('quantity')) {
            return;
        }

        DB::transaction(function () use ($purchaseItem) {
            $original = $purchaseItem->getOriginal('quantity');
            $delta = $purchaseItem->quantity - $original;

            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($purchaseItem->product_id);

            if ($product) {
                $product->increment('stock', $delta);
            }
        });
    }

    public function deleted(PurchaseItem $purchaseItem): void
    {
        DB::transaction(function () use ($purchaseItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($purchaseItem->product_id);

            if ($product) {
                $product->decrement('stock', $purchaseItem->quantity);
            }
        });
    }

    /**
     * Fires when a soft-deleted PurchaseItem is restored — re-apply the
     * stock it originally contributed.
     */
    public function restored(PurchaseItem $purchaseItem): void
    {
        DB::transaction(function () use ($purchaseItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($purchaseItem->product_id);

            if ($product) {
                $product->increment('stock', $purchaseItem->quantity);
            }
        });
    }
}
