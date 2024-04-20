<?php
namespace App\Sale\Strategies;

interface SaleStrategyInterface {
    public function calculateDiscount($regularPrice, $discountValue);
}
