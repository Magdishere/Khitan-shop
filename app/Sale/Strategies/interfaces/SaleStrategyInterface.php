<?php

namespace App\Sale\Strategies\interfaces;

use Illuminate\Http\Request;

interface SaleStrategyInterface
{
    public function storeSale($request, $filePath);
    public function updateSale($sale, $request, $filePath);
}
