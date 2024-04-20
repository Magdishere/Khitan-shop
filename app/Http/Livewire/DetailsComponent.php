<?php

namespace App\Http\Livewire;

use App\Models\admin\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Livewire;

class DetailsComponent extends Component
{
    public $selectedColors = [];
    public $selectedSizes = [];
    public $slug;
    public $calculatedPrice;
    public $wishlistContent = [];


    protected $listeners = ['refreshComponent' => '$refresh', 'colorSelected' => 'updateSelectedColors'];

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function updateSelectedColors($selectedColors)
    {
        $this->selectedColors = $selectedColors;
    }

    public function store($product_id, $product_name, $product_price){

        Cart::add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item added to the cart');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $rproducts = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::Latest()->take(4)->get();
        return view('livewire.details-component', ['product' => $product ,'rproducts' => $rproducts , 'nproducts' => $nproducts]);
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\admin\Product");
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $item) {
            if ($item->id == $product_id) {
                Cart::instance('wishlist')->remove($item->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');

            }
        }
    }

}
