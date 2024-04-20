<?php
namespace App\Sale\Strategies;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Sale\Strategies\interfaces\SaleStrategyInterface;

class FlashSaleStrategy extends SaleStrategy implements SaleStrategyInterface
{
    private function deactivateFlashSales(Request $request)
    {
        if ($request->is_flash_sale) {
            Sale::where('is_flash_sale', true)->update([
                'is_active' => false,
            ]);
        }
    }

    private function prepareSaleData(Request $request)
    {
        $saleData = [
            'name' => $request->name,
            'type' => $request->type,
            'value' => $request->value,
            'position' => 0,
            'banner' => null,
            'banner_type' => 'none',
            'target_type' => $this->calculateTargetType($request),
            'start_date' => $this->parseDate($request->starts_date),
            'end_date' => $this->parseDate($request->ends_date),
            'is_active' => $request->has('is_active'),
            'is_flash_sale' => $request->has('is_flash_sale'),
        ];

        return $saleData;
    }

    public function storeSale($request, $filePath)
    {
        $this->deactivateFlashSales($request);

        $saleData = $this->prepareSaleData($request);

        $sale = Sale::create($saleData);

        $this->attachSaleRelationships($sale, $request);
    }

    public function updateSale($sale, $request, $filePath)
    {
        $this->deactivateFlashSales($request);

        $saleData = $this->prepareSaleData($request);

        $sale->update($saleData);

        $this->attachSaleRelationships($sale, $request);
    }


}
