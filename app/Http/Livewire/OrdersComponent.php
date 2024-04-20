<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrdersComponent extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('livewire.orders-component', ['orders' => $orders]);
    }
}
