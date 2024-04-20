<?php

namespace App\Sale\Strategies\interfaces;

use Illuminate\Http\Request;

interface ProductCategoryCheckStrategyInterface
{
    public function checkProductsInSameCategory($request);
}
