<?php

namespace App\Sale\Strategies;

use App\Models\Sale;
use App\Sale\Strategies\interfaces\CategorySaleStrategyInterface;

class CategorySaleStrategy implements CategorySaleStrategyInterface
{
    public function checkExistingCategorySale($request)
    {
        $saleId = $request->input('sale_id');

        // Check if there is another sale in the same category
        $existingCategorySale = Sale::where('target_type', 'category')
            ->activeSales();
             // Exclude the sale with the given ID if $saleId is not null
            if ($saleId !== null) {
                $existingCategorySale->where('id', '!=', $saleId);
            }

            $existingCategorySale = $existingCategorySale->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->first();

        if ($existingCategorySale) {
            // There is another sale in the same category, prevent creation
            throw new \Exception('There is already an active sale in the same category.');
        }
    }

}
