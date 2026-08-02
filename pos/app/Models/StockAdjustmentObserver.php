<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\StockAdjustment;
use Illuminate\Support\Facades\DB;

/**
 * Keeps product stock in sync whenever a manual stock adjustment
 * (opname, barang hilang/rusak, atau koreksi manual) is recorded.
 *
 * The `adjustment_quantity` column already carries its own sign
 * (positive to add stock, negative to subtract), so the observer simply
 * applies that signed delta to the product's stock in real time.
 */
class StockAdjustmentObserver
{
    public function created(StockAdjustment $stockAdjustment): void
    {
        $this->applyDelta($stockAdjustment->product_id, $stockAdjustment->adjustment_quantity);
    }

    public function updated(StockAdjustment $stockAdjustment): void
    {
        if (! $stockAdjustment->wasChanged('adjustment_quantity')) {
            return;
        }

        $original = (int) $stockAdjustment->getOriginal('adjustment_quantity');
        $delta = $stockAdjustment->adjustment_quantity - $original;

        $this->applyDelta($stockAdjustment->product_id, $delta);
    }

    public function deleted(StockAdjustment $stockAdjustment): void
    {
        // Reverse the original adjustment.
        $this->applyDelta($stockAdjustment->product_id, -1 * $stockAdjustment->adjustment_quantity);
    }

    /**
     * Fires when a soft-deleted StockAdjustment is restored — re-apply
     * the original adjustment.
     */
    public function restored(StockAdjustment $stockAdjustment): void
    {
        $this->applyDelta($stockAdjustment->product_id, $stockAdjustment->adjustment_quantity);
    }

    private function applyDelta(int $productId, int $delta): void
    {
        if ($delta === 0) {
            return;
        }

        DB::transaction(function () use ($productId, $delta) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($productId);

            if (! $product) {
                return;
            }

            if ($delta > 0) {
                $product->increment('stock', $delta);
            } else {
                $product->decrement('stock', abs($delta));
            }
        });
    }
}
