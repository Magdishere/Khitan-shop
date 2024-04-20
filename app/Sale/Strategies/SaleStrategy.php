<?php
namespace App\Sale\Strategies;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleStrategy {

    protected function handleImageUpload(Request $request)
    {
        if ($request->has('banner')) {
            return uploadImage('sales', $request->banner);
        }

        return null;
    }

    protected function calculateTargetType(Request $request)
    {
        return ($request->sale_type == 1) ? 'category' : (($request->sale_type == 2) ? 'product' : null);
    }

    protected function parseDate($dateString)
    {
        return date('Y-m-d H:i:s', strtotime($dateString));
    }

    protected function attachSaleRelationships($sale, $request)
    {
        if ($request->sale_type == 1) {
            // Sale for category
            $sale->categories()->attach($request->input('category_id'));
        } elseif ($request->sale_type == 2) {
            // Remove null values from the product_id array
            $productIds = array_filter($request->input('product_id'));

            // Sale for product only if there are valid product_ids
            if (!empty($productIds)) {
                $sale->products()->attach($productIds);
            }
        }

    }



}
