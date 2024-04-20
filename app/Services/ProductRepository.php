<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

class ProductRepository
{
    public static function sortBy($query, $sorting)
    {
        $currentLocale = App::getLocale();

        switch ($sorting) {
            case 'date':
                return $query->orderBy('created_at', 'DESC');
            case 'price':
                return $query->orderBy('regular_price', 'ASC');
            case 'price-desc':
                return $query->orderBy('regular_price', 'DESC');
            case 'alphabet':
                return $query->join('product_translations as p', 'p.product_id', '=', 'products.id')
                    ->where('locale', $currentLocale)
                    ->orderBy('p.name', 'ASC')
                    ->get();

            case 'alphabet-desc':
                return $query->join('product_translations as p', 'p.product_id', '=', 'products.id')
                    ->where('locale', $currentLocale)
                    ->orderBy('p.name', 'DESC')
                    ->get();
            default:
                return $query->orderBy('created_at', 'ASC');
        }
    }
}
