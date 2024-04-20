<?php

namespace App\Sale\Strategies\interfaces;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

interface ImageSaleStrategyInterface
{
    public function validateBannerPosition($request, $activeSales);
}
