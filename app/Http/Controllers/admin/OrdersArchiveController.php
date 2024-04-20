<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::onlyTrashed()->get();
        return view('Back.Orders.archived_orders', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = $request->order_id;
        $flight = Order::withTrashed()->where('id', $id)->restore();
        toastr()->addSuccess('Order Unarchived Successfully.');
        return redirect()->route('admin-orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $order = Order::withTrashed()->where('id',$request->order_id)->first();
        $order->forceDelete();
        toastr()->addSuccess('Order Deleted Successfully.');
        return redirect()->route('admin-orders.index');
    }
}
