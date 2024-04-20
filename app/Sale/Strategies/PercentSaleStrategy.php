<?php
namespace App\Sale\Strategies;

use SplObserver;
use SplSubject;

class PercentSaleStrategy implements SaleStrategyInterface {
    public function calculateDiscount($regularPrice, $discountValue) {
        $discountAmount = ($regularPrice * $discountValue) / 100;
        return $regularPrice - $discountAmount;
    }
}
