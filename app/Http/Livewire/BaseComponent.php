<?php

namespace App\Http\Livewire;

use App\Models\admin\Product;
use App\Services\CartService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
    use WithPagination;
    public $selectedColors = [];
    public $selectedSize = [];

    public $min_value = 10;
    public $max_value = 1000;
    public $min_price;
    public $max_price;
    public $categoryInputs = [];

    public $pageSize = 9;

    public $orderBy = 'featured';
    protected $listeners = ['sortBy'];


    public function setPriceRange($min, $max)
    {
        $this->min_price = $min;
        $this->max_price = $max;
    }

    public function addToCart($product_id, $product_name, $product_price)
    {
        $selectedColor = $this->selectedColors[$product_id] ?? null;
        $selectedSize = $this->selectedSize[$product_id] ?? null;

        $cartService = app(CartService::class);
        $cartService->addToCart($product_id, $product_name, $product_price, $selectedColor, $selectedSize);

        $this->emitTo('cart-icon-component', 'refreshComponent');

    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrder($order)
    {
        $this->orderBy = $order;
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
