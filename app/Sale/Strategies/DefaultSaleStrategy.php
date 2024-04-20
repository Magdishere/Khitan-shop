<?php

namespace App\Sale\Strategies;

class DefaultSaleStrategy implements SaleStrategyInterface {
    public function calculateDiscount($regularPrice, $discountValue) {
        return $regularPrice;
    }
}
