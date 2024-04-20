<?php
namespace App\Sale\Strategies;


class SaleCalculator {
    private $strategy;

    public function __construct(SaleStrategyInterface $strategy) {
        $this->strategy = $strategy;
    }

    public function calculateDiscountedPrice($regularPrice, $discountValue) {
        return $this->strategy->calculateDiscount($regularPrice, $discountValue);
    }
}
