<?php
namespace App\Sale\Strategies;

class BogoSaleStrategy implements SaleStrategyInterface {
    public function calculateDiscount($regularPrice, $discountValue) {
        // For simplicity, let's assume $discountValue represents the "buy X get Y free" pattern
        list($buyCount, $freeCount) = explode(';', $discountValue);

        // Calculate the total price considering the free items
        $totalItemCount = $buyCount + $freeCount;
        $unitPrice = $regularPrice / $totalItemCount;
        $discountedPrice = $buyCount * $unitPrice;

        return $discountedPrice;
    }
}
