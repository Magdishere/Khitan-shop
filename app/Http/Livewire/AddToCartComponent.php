<?php

namespace App\Http\Livewire;

use App\Services\CartService;
use Livewire\Component;

class AddToCartComponent extends Component
{

    public $product;
    public $items;

    protected $listeners = ['favoriteToggled' => 'refreshComponent']; // Update the listener here

    public function mount($product, $items)
    {
        $this->product = $product;
        $this->items = $items;
    }

    public function refreshComponent()
    {
        // Manually refresh the current component
        $this->emit('refreshComponent');
    }

    public function addToCart($product_id, $product_name, $product_price)
    {
        $selectedColor = $this->selectedColors[$product_id] ?? null;
        $selectedSize = $this->selectedSize[$product_id] ?? null;

        $cartService = app(CartService::class);
        $cartService->addToCart($product_id, $product_name, $product_price, $selectedColor, $selectedSize);

        $this->emitTo('cart-icon-component', 'refreshComponent');

    }
    public function render()
    {
        return view('livewire.add-to-cart-component');
    }
}
