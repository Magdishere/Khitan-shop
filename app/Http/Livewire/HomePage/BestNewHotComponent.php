<?php

namespace App\Http\Livewire\HomePage;

use App\Http\Livewire\BaseComponent;
use App\Models\admin\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BestNewHotComponent extends BaseComponent
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
        $sproducts = Product::with('sales')->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $fproducts = Product::where('featured', 1)->inRandomOrder()->get()->take(8);

        $topProductIds = DB::table('order_items')
            ->select('product_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->take(6)
            ->pluck('product_id');

        // Then, retrieve the corresponding products using the retrieved product IDs
        $mostOrderedProducts = Product::whereIn('id', $topProductIds)->get();

        return view('livewire.home-page.best-new-hot-component',
        [
            'lproducts' => $lproducts,
            'fproducts' => $fproducts,
            'sproducts' => $sproducts,
            'mostOrderedProducts' => $mostOrderedProducts
        ]);
    }
}
