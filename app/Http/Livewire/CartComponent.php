<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    public $cartContent = [];

    public function mount()
    {
        // Get the cart content and store it in $cartContent
        $this->cartContent = Cart::instance('cart')->content();
    }

    public function applyCouponCode()
    {
        $coupon = Coupon::where('code',$this->couponCode)->where('expiry_date','>=',Carbon::today())->where('cart_value','<=', Cart::instance('cart')->subtotal())->first();
        if (!$coupon) {
            session()->flash('coupon_message','Coupon code is invalid!');
            return;
        }

        session()->put('coupon',[
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value,
            'expiry_date'=> $coupon->expiry_date,
        ]);

    }

    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {

            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = Cart::instance('cart')->subtotal() - $this->discount;
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax') / 100);
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function setAmountForCheckout()
    {
        if (session()->has('coupon'))
        {
            session()->put('checkout',[
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax' => $this->taxAfterDiscount,
                'total' => $this->totalAfterDiscount
            ]);
        }
        else
        {
            session()->put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total()
            ]);
        }
    }
    public function increaseQuantity($rowId)
    {
        // Find the cart item by rowId
        $cartItem = Cart::instance('cart')->get($rowId);

        if ($cartItem) {
            // Increment the quantity by 1
            $newQuantity = $cartItem->qty + 1;

            // Update the cart item with the new quantity
            Cart::instance('cart')->update($rowId, $newQuantity);
        }

        $this->emitTo('cart-icon-component', 'refreshComponent');


        // Refresh the cart content after the update
        $this->cartContent = Cart::instance('cart')->content();
    }

    public function decreaseQuantity($rowId)
{
    // Find the cart item by rowId
    $cartItem = Cart::instance('cart')->get($rowId);

    if ($cartItem) {
        // Decrease the quantity by 1
        $newQuantity = max(0, $cartItem->qty - 1);

        if ($newQuantity == 0) {
            // If the new quantity is 0, remove the item from the cart
            Cart::instance('cart')->remove($rowId);
        } else {
            // Update the cart item with the new quantity
            Cart::instance('cart')->update($rowId, $newQuantity);
        }


        $this->emitTo('cart-icon-component', 'refreshComponent');

    }

    // Refresh the cart content after the update
    $this->cartContent = Cart::instance('cart')->content();

}

    public function removeFromCart($rowId)
    {
        // Remove the entire row (product) from the cart
        Cart::instance('cart')->remove($rowId);

        $this->emitTo('cart-icon-component', 'refreshComponent');

        // Refresh the cart content after the removal
        $this->cartContent = Cart::instance('cart')->content();
    }
    // Create similar methods for removing items and clearing the cart if needed
    public function render()
    {
        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else
            {
                $this->calculateDiscounts();
            }
        }
        $this->setAmountForCheckout();

        return view('livewire.cart-component', [
            'cartContent' => $this->cartContent,
        ]);
    }
}
