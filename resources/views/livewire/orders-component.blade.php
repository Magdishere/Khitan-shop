
<div>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>My Orders</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>My Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Full Address</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No orders available.</td>
                                    </tr>
                                @else
                                @foreach($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center"><a href="{{ route('order.details', ['id' => $order->id]) }}">{{ $order->firstname }} {{ $order->lastname }}</a></td>
                                    <td class="text-center">${{ $order->subtotal }}</td>
                                    <td class="text-center">${{ $order->discount }}</td>
                                    <td class="text-center">${{ $order->total }}</td>
                                    <td class="text-center">
                                        @if ($order->status == 'delivered')
                                            <strong class="text-success">{{ strtoupper($order->status) }}</strong>
                                        @elseif($order->status == 'canceled')
                                            <strong class="text-danger">{{ strtoupper($order->status) }}</strong>
                                        @else
                                            <strong class="text-warning">{{ strtoupper($order->status) }}</strong>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $order->country }} - {{ $order->state }} - {{ $order->city }} - {{ $order->street_address }}</td>
                                    <td class="text-center">{{ $order->email}}</td>
                                    <td class="text-center">{{ $order->zipcode}}-{{$order->mobile}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="/shop">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="{{route('checkouts')}}"> Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
