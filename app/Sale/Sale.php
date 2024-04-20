<?php

namespace App\Sale;

use App\Models\Admin\Product;
use App\Sale\Strategies\DefaultSaleStrategy;
use App\Sale\Strategies\SaleCalculator;

class Sale
{
    /**
     * Calculate the discounted price for a given product ID.
     *
     * @param  int  $productId
     * @return float|string  Calculated discounted price or '-' if no valid information is found
     */
    public static function calculateDiscountedPrice($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $discount = self::getDiscountInfo($product);

            if ($discount) {
                $regularPrice = $product->regular_price;
                $strategy = self::getSaleStrategy($discount['type']);

                $calculator = new SaleCalculator($strategy);
                return number_format($calculator->calculateDiscountedPrice($regularPrice, $discount['value']), 2);
            }
        }

        return '-';
    }

    /**
     * Get the discount information for a given product.
     *
     * @param  \App\Models\Admin\Product  $product
     * @return array|null  Discount information or null if not found
     */
    protected static function getDiscountInfo(Product $product)
    {
        $productSale = $product->getActiveSales()->first();

        if ($productSale) {
            return ['type' => $productSale->type, 'value' => $productSale->value];
        }

        $categorySale = $product->category->sales()
            ->activeSales()
            ->first();

        if ($categorySale) {
            return ['type' => $categorySale->type, 'value' => $categorySale->value];
        }

        return null;
    }

    /**
     * Get the sale strategy based on the provided discount type.
     *
     * @param  string  $discountType
     * @return \App\Sale\Strategies\SaleStrategyInterface  Sale strategy instance
     */
    protected static function getSaleStrategy($discountType)
    {
        $strategyClass = 'App\\Sale\\Strategies\\' . ucfirst($discountType) . 'SaleStrategy';
        return class_exists($strategyClass) ? new $strategyClass() : new DefaultSaleStrategy();
    }
}
