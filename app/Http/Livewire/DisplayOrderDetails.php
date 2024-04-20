<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class DisplayOrderDetails extends Component
{


    public $orderId;

    public function mount($id)
    {
        $this->orderId = $id;
    }

    public function render()
    {
        $order = Order::with('orderItems')->findOrFail($this->orderId);
        return view('livewire.display-order-details', ['order' => $order]);
    }
}
