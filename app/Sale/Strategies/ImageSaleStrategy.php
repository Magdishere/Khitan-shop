<?php

namespace App\Sale\Strategies;

use App\Models\Sale;
use App\Sale\Strategies\interfaces\SaleStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ImageSaleStrategy extends SaleStrategy implements SaleStrategyInterface
{
    public function validateBannerPosition($request, $activeSales)
    {
        // Check a position of image  if the sale banner_type is image //
        // Check if all active sales have positions 1, 2, 3, or 4
        $validPositions = [1, 2, 3, 4];
        $activePositions = $activeSales->pluck('position')->toArray();

        if (empty(array_diff($validPositions, $activePositions))) {
            // If all positions 1, 2, 3, 4 are taken, create a new sale with position 0
            $request->merge(['position' => 0]);
        }

        // Validate the request to ensure the position is unique
        $request->validate([
            'position' => [
                'required',
                'integer',
                Rule::notIn($activePositions),
            ],
        ]);
    }

    private function prepareSaleData(Request $request, $filePath)
    {
        $saleData = [
            'name' => $request->name,
            'type' => $request->type,
            'value' => $request->value,
            'position' => $this->calculatePosition($request),
            'banner' => $filePath,
            'banner_type' => $request->banner_type,
            'target_type' => $this->calculateTargetType($request),
            'start_date' => $this->parseDate($request->starts_date),
            'end_date' => $this->parseDate($request->ends_date),
            'is_active' => $request->has('is_active'),
            'is_flash_sale' => $request->has('is_flash_sale'),
        ];

        return $saleData;
    }


    private function calculatePosition(Request $request)
    {
        // Your logic to calculate position based on conditions
        return $request->banner_type == 'countdown' ? 0 : $request->position;
    }


    public function storeSale($request, $filePath)
    {
        if ($request->banner_type == 'image') {
            $this->validateBannerPosition($request, Sale::activeSales()->get());
        }
        $saleData = $this->prepareSaleData($request, $filePath);

        $sale = Sale::create($saleData);

        $this->attachSaleRelationships($sale, $request);
    }

    public function updateSale($sale, $request, $filePath)
    {
        if ($request->banner_type == 'image') {
            $this->validateBannerPosition($request, Sale::activeSales()->where('id', '!=', $sale->id)->get());
        }

        $saleData = $this->prepareSaleData($request, $filePath);

        $sale->update($saleData);

        $this->attachSaleRelationships($sale, $request);
    }


}
