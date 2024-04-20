<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutComponent extends Component
{
    public $ship_to_different;

    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    public $s_firstname;
    public $s_lastname;
    public $s_mobile;
    public $s_email;
    public $s_line1;
    public $s_line2;
    public $s_city;
    public $s_province;
    public $s_country;
    public $s_zipcode;

    public function updated($field)
    {
        $this->validateOnly($field,[
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
        ]);
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'country' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
        ]);

        dd($this->createOrder());

    }

    private function createOrder()
    {
        try {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = session()->get('checkout')['subtotal'];
            $order->discount = session()->get('checkout')['discount'];
            $order->total = session()->get('checkout')['total'];
            $order->firstname = $this->firstname;
            $order->lastname = $this->lastname;
            $order->country = $this->country;
            $order->city = $this->city;
            $order->street_address = $this->street_address;
            $order->state = $this->state;
            $order->zipcode = $this->zipcode;
            $order->mobile = $this->mobile;
            $order->email = $this->email;
            $order->status = 'ordered';
            $order->is_shipping_different = $this->ship_to_different ?1:0;
            $order->save();

            foreach(Cart::instance('cart')->content() as $item)
            {
                $orderItem =new OrderItem();
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $item->id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->qty;
                $orderItem->save();


            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $exception;
        }
    }

    public function render()
    {
        return view('livewire.checkout-component');
    }
}
