<?php

namespace App\Http\Livewire;

use App\Models\admin\Category;
use App\Models\admin\Product;
use App\Models\admin\Slides;
use App\Models\HomeSlider;

use App\Models\Sale;
use App\Services\TimeService;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HomeComponent extends BaseComponent
{


    protected $listeners = ['refreshComponent' => '$refresh', 'colorSelected' => 'updateSelectedColors'];

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

        return view('livewire.home-component');
    }
}
