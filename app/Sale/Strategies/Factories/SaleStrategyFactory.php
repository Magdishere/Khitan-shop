<?php

namespace App\Sale\Strategies\Factories;

use App\Sale\Strategies\FlashSaleStrategy;
use App\Sale\Strategies\ImageSaleStrategy;

class SaleStrategyFactory {
    public static function create($request)
    {
        if ($request->is_flash_sale) {
            return new FlashSaleStrategy();
        } elseif ($request->banner_type === 'image' || 'countdown') {
            return new ImageSaleStrategy();
        }
        /*elseif ($request->banner_type === 'countdown') {
            return new CountdownSaleStrategy();
        }*/
        else {
            throw new \InvalidArgumentException("Invalid sale type");
        }
    }
}
