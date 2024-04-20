<?php

namespace App\Sale\Strategies;

class FixedSaleStrategy implements SaleStrategyInterface {
    public function calculateDiscount($regularPrice, $discountValue) {
        return $regularPrice - $discountValue;
    }
}
