<?php

namespace App\Http\Livewire;

use App\Models\admin\Product;
use App\Models\admin\ProductAttributeOption;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProductAttributes extends BaseComponent
{
    public $product;
    public $selectedColors = [];
    public $selectedSize = [];
    public $calculatedPrice;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function updatedSelectedColor()
    {
        $this->calculatePrice();
    }

    public function updatedSelectedSize()
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {

        // $basePrice = $this->product->regular_price;
        $colorPrice = $this->selectedColors ? $this->selectedColors : 0;

        $sizePrice = 0;

        //
        if (!empty($this->selectedSize)) {
            $sizePriceQuery = "
            SELECT pa.price
            FROM product_attribute_options pa
            JOIN attribute_options ao ON pa.attribute_option_id = ao.id
            JOIN attribute_option_translations aot ON ao.id = aot.attribute_option_id
            WHERE pa.product_id = :productId
            AND aot.locale = 'en'
            AND aot.value = :sizeValue
            LIMIT 1
        ";

            $sizePriceModel = DB::select($sizePriceQuery, [
                'productId' => $this->product->id,
                'sizeValue' => current($this->selectedSize)
            ]);

            if (!empty($sizePriceModel)) {
                $sizePrice = floatval($sizePriceModel[0]->price);
            }
        }


        $totalPrice = $sizePrice;
        $this->calculatedPrice = $totalPrice;
    }
    public function render()
    {
        return view('livewire.product-attributes');
    }
}
