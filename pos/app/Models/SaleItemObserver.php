<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * Keeps product stock in sync whenever a cashier transaction is recorded.
 *
 * Business rules implemented here:
 *  - Every new SaleItem decreases the parent Product's stock by the sold
 *    quantity, in real time, as soon as the cashier finalizes the cart.
 *  - Stock is locked (SELECT ... FOR UPDATE) during the decrement so
 *    concurrent cashier sessions scanning the same barcode can't oversell.
 *  - Updating or deleting a SaleItem (e.g. a void/return) re-applies the
 *    stock delta so the ledger stays consistent.
 */
class SaleItemObserver
{
    public function created(SaleItem $saleItem): void
    {
        DB::transaction(function () use ($saleItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($saleItem->product_id);

            if (! $product) {
                return;
            }

            if ($product->stock < $saleItem->quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak cukup untuk produk: {$product->name}.",
                ]);
            }

            $product->decrement('stock', $saleItem->quantity);
        });
    }

    public function updated(SaleItem $saleItem): void
    {
        if (! $saleItem->wasChanged('quantity')) {
            return;
        }

        DB::transaction(function () use ($saleItem) {
            $original = $saleItem->getOriginal('quantity');
            $delta = $saleItem->quantity - $original; // positive = sold more

            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($saleItem->product_id);

            if ($product) {
                $product->decrement('stock', $delta);
            }
        });
    }

    public function deleted(SaleItem $saleItem): void
    {
        DB::transaction(function () use ($saleItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($saleItem->product_id);

            if ($product) {
                // A voided/deleted sale item returns the stock.
                $product->increment('stock', $saleItem->quantity);
            }
        });
    }

    /**
     * Fires when a soft-deleted SaleItem is restored — the sale is
     * "un-voided", so the stock must be sold (decremented) again.
     */
    public function restored(SaleItem $saleItem): void
    {
        DB::transaction(function () use ($saleItem) {
            /** @var Product $product */
            $product = Product::query()->lockForUpdate()->find($saleItem->product_id);

            if ($product) {
                $product->decrement('stock', $saleItem->quantity);
            }
        });
    }
}
