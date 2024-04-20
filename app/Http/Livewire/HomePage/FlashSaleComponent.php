<?php

namespace App\Http\Livewire\HomePage;

use App\Http\Livewire\BaseComponent;
use App\Models\admin\Product;
use Livewire\Component;
use App\Models\Sale;

class FlashSaleComponent extends BaseComponent
{
    public function mount()
    {
        // Initialize selectedColors for each product
        $products = Product::all();
        foreach ($products as $product) {
            $this->selectedColors[$product->id] = null;
        }

    }
    public function render()
    {

        $flashSale = Sale::with('products')
            ->with('categories')
            ->activeFlashSales()
            ->first();

        return view('livewire.home-page.flash-sale-component', ['flashSale' => $flashSale]);
    }
}
