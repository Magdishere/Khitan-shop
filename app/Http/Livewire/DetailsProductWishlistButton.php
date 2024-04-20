<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsProductWishlistButton extends Component
{
    public $product;
    public $items;

    protected $listeners = ['favoriteToggled' => 'refreshComponent']; // Update the listener here

    public function mount($product, $items)
    {
        $this->product = $product;
        $this->items = $items;
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate("App\Models\admin\Product");
        $this->emit('details-component');
        $this->emit('refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $item) {
            if ($item->id == $product_id) {
                Cart::instance('wishlist')->remove($item->rowId);

                $this->emit('favoriteToggled', $item->slug);
                // Manually trigger a refresh for the current component
                $this->refreshComponent();
            }
        }
    }

    public function refreshComponent()
    {
        // Manually refresh the current component
        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.details-product-wishlist-button');
    }
}
