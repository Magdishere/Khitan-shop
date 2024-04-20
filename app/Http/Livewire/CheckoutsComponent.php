<?php

namespace App\Http\Livewire;

use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\AddOrder;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Notification;
class CheckoutsComponent extends Component
{
    public $ship_to_different;

    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $password;
    public $city;
    public $street_address;
    public $state;
    public $country;
    public $zipcode;


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
    $validationRules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'country' => 'required',
        'city' => 'required',
        'street_address' => 'required',
        'state' => 'required',
        'zipcode' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
    ];

    // Add password validation rule only if the user is not authenticated
    if (!Auth::check()) {
        $validationRules['password'] = 'required|min:8';
        $validationRules['email'] = 'unique:users';
    }

    $this->validate($validationRules);

    // Retrieve checkout data from the session
    $cartContent = Cart::instance('cart')->content();

    $order = new Order();
    $order->subtotal = Cart::subtotal();
    $order->discount = $order->discount = $cartContent['discount'] ?? 0;  // Use default value if not set
    $order->total = Cart::total();
    $order->firstname = $this->firstname;
    $order->lastname = $this->lastname;
    $order->mobile = $this->mobile;
    $order->email = $this->email;
    $order->street_address = $this->street_address;
    $order->city = $this->city;
    $order->state = $this->state;
    $order->country = $this->country;
    $order->zipcode = $this->zipcode;
    $order->status = 'ordered';
    $order->is_shipping_different = $this->ship_to_different ? 1 : 0;

    if (Auth::check()) {
        $order->user_id = Auth::user()->id;
    } else {
        $placeholderUser = User::create([
            'name'      => $this->firstname . ' ' . $this->lastname,
            'email'     => $this->email,
            'password'  => bcrypt($this->password),
        ]);
        $order->user_id = $placeholderUser->id;
    }

    $order->save();

    session()->flash('message', 'Order made successfully!');

    foreach (Cart::instance('cart')->content() as $item) {
        $orderItem = new OrderItem();
        $orderItem->product_id = $item->id;
        $orderItem->order_id = $order->id;
        $orderItem->price = $item->price;
        $orderItem->quantity = $item->qty;
        $orderItem->save();
    }

    // Pass the $order instance itself to the notification constructor
    $user = User::first();
    Notification::send($user, new AddOrder($order));
}

    private function createNewUser()
    {
        $user = new User();
        $user->name = $this->firstname . ' ' . $this->lastname;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->save();

        return $user;
    }


    public function render()
    {
        return view('livewire.checkouts-component');
    }
}
