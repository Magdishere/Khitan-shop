<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class OrdersComponent extends Component
{

    public $order_id;

    public function deleteOrder(){

        $order= Order::find($this->order_id);
        $order->delete();
        session()->flash('message', 'Order deleted successfully');
    }

    public function render()
    {

        $orders= Order::orderBy('created_at', 'DESC')->paginate();
        return view('livewire.admin.orders-component',['orders' => $orders]);
    }
}
