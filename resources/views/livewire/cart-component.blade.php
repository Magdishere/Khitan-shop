
<div>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Cart::instance('cart')->count() == 0)
                                <tr>
                                    <td colspan="5" class="text-center">No Items in the Cart</td>
                                </tr>
                                @else
                                @foreach(Cart::instance('cart')->content() as $item)

                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="img/shopping-cart/cart-1.jpg" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->model->name}}</h6>
                                            <div class="shop__sidebar__color">
                                                <label class="c-{{ $item->model->id }}" for="sp-{{ $item->model->id }}" style="background: {{ $item->options['color'] ?? '-' }}">
                                                    <input type="radio" wire:model="selectedColor" value="">
                                                </label>
                                            </div>
                                            <h6> Size: {{ $item->options['size'] ?? '-' }}</h6>

                                            <h5>{{$item->regular_price}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity text-center">
                                            <div class="pro-qty-2">
                                                <a href="#" class="fa fa-angle-left inc qtybtn" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{$item->qty}}</span>
                                                <a href="#" class="fa fa-angle-right inc qtybtn" wire:click.prevent="increaseQuantity('{{$item->rowId}}')"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="product__cart__item">
                                        <img src="{{ asset('../admin-assets/uploads/images/products/' . $item->model->image) }}">
                                    </td>
                                    <td class="cart__price text-center">${{ $item->price }}</td>
                                    <td class="action cart__close" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="removeFromCart('{{$item->rowId}}')"><i class="fa fa-close"></i></a></td>

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
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4 class="order__title">Your order</h4>
                        <div class="checkout__order__products">Product <span>Total</span></div>
                        <ul class="checkout__total__products">
                            @foreach(Cart::instance('cart')->content() as $item)
                            <li>{{$item->name}}<span>${{$item->price}}</span></li>
                            @endforeach
                        </ul>
                        @php
                            $subtotal = floatval(preg_replace('/[^0-9\.]/', '', Cart::subtotal())) + 5.00; // Retrieve subtotal and convert to float
                        @endphp

                        <ul class="checkout__total__all">
                            <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                            <li>Shipping <span>${{ 5.00 }}</span></li>
                            <li>Total <span>${{ number_format($subtotal, 2) }}</span></li>
                        </ul>

                        <!-- Add Cupons Section -->
                        <form class="coupon_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" wire:model="couponCode" placeholder="Write your coupon">
                                </div>
                                <div class="col-md-6 px-lg-5">
                                    <button class="coupon_btn" type="button">Apply</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
