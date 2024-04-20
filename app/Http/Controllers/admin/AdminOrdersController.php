<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PriorityQueue;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        return view('Back.Orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($id);

        // Return the edit view with the order data
        return view('Back.Orders.edit', compact('order'));
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
        // Find the order by its ID
        $order = Order::findOrFail($id);

        // Validate the incoming request data
        $request->validate([
            'status' => 'required|in:ordered,delivered,canceled',
        ]);

        // Update the order status
        $order->update(['status' => $request->status]);

        // Redirect back to the index page with a success message
        toastr()->addSuccess('Status Updated Successfully.');
        return redirect()->route('admin-orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $id = $request->order_id;
        $order = Order::where('id', $id)->first();

        $id_page = $request->id_page;

        if (!$id_page == 2) {
            $order->forceDelete();
            toastr()->addSuccess('Order Deleted Successfully.');

        } else {

            $order->delete();
            toastr()->addSuccess('Order Archived Successfully.');
        }

        return redirect()->route('admin-orders.index');

    }

    public function getOrdersByStatus($status)
    {
        $orders = Order::where('status', $status)->get();
        return view('Back.Orders.ordersByStatus', compact('orders', 'status'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function processOrders()
    {
        $priorityQueue = new PriorityQueue();

        // Fetch a batch of orders from the database and insert into the priority queue.
        $orders = Order::where('status', 'pending')->get();

        foreach ($orders as $order) {
            $priorityQueue->insert($order);
        }

        // Process orders based on priority.
        while (!empty($priorityQueue)) {
            $maxPriorityOrder = $priorityQueue->extractMax();

            // Simulate processing the order (e.g., updating the order status).
            $this->processOrder($maxPriorityOrder);

            // Perform other processing tasks related to $maxPriorityOrder.
            $this->sendConfirmationEmail($maxPriorityOrder);
            $this->updateInventory($maxPriorityOrder);
        }

        return response()->json(['message' => 'Orders processed successfully']);
    }



    protected function processOrder($order)
    {
        // Simulate processing the order by updating its status to 'processed' in the database.
        $order->update(['status' => 'processed']);

        // You can add additional processing logic based on your application's requirements.
    }

    protected function sendConfirmationEmail($order)
    {
        // Simulate sending a confirmation email to the customer.
        // Add your email sending logic here.
        // For example, you might use Laravel's built-in Mail facade.
    }

    protected function updateInventory($order)
    {
        // Simulate updating the inventory based on the processed order.
        // Add your inventory update logic here.
        // For example, you might decrement the quantity of products in stock.
    }
}
