<?php

namespace App\Sale\Strategies\interfaces;


use Illuminate\Http\Request;

interface CategorySaleStrategyInterface
{
    public function checkExistingCategorySale($request);
}
