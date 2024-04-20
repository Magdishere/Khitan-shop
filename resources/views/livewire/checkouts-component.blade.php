<div>
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Check Out</h4>
                            <div class="breadcrumb__links">
                                <a href="./index.html">Home</a>
                                <a href="./shop.html">Shop</a>
                                <span>Check Out</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
        @if(Session::has('message'))
        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
        @endif
        <!-- Checkout Section Begin -->
        <section class="checkout spad">
            <div class="container">
                <div class="checkout__form">
                    <form method="POST" wire:submit.prevent="placeOrder">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                                <h6 class="checkout__title">Billing Details</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Fist Name<span>*</span></p>
                                            <input type="text"  name="firstname" placeholder="First name" wire:model='firstname'>
                                            @error('firstname')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Last Name<span>*</span></p>
                                            <input type="text"  name="lastname" placeholder="Last name" wire:model='lastname'>
                                            @error('lastname')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Country<span>*</span></p>
                                    <input type="text" name="country"  placeholder="Lebanon" wire:model="country">
                                    @error('country')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="checkout__input">
                                    <p>City/Village<span>*</span></p>
                                    <input type="text" name="city"  placeholder="Beirut" wire:model="city">
                                    @error('city')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input type="text" name="street_address" placeholder="Street, building, floor,..." class="checkout__input__add" wire:model="street_address">
                                    @error('street_address')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="checkout__input">
                                    <p>State/Governorate<span>*</span></p>
                                    <input type="text" name="state"  placeholder="North Lebanon" wire:model="state">
                                    @error('state')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="checkout__input">
                                    <p>Postcode / ZIP<span>*</span></p>
                                    <input type="text" name="zipcode"  placeholder="+961..." wire:model="zipcode">
                                    @error('zipcode')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Phone<span>*</span></p>
                                            <input type="phone" name="mobile"  placeholder="71-xxxxxx" wire:model="mobile">
                                            @error('mobile')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            <input type="email" name="email"  placeholder="something@example.com" wire:model="email">
                                            @error('email')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @guest
                                    <div class="checkout__input">
                                        <p>Account Password<span>*</span></p>
                                        <input type="password" name="password" placeholder="Your password" wire:model="password">
                                    </div>
                                @endguest
                                <div class="checkout__input">
                                    <p>Order notes<span>*</span></p>
                                    <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
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
                                    <ul class="checkout__total__all">
                                        <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                        <li>Shipping <span>${{ 5.00 }}</span></li>
                                        <li>Total <span>${{ Cart::subtotal() + 5.00 }}</span></li>
                                    </ul>
                                    <div class="checkout__input__checkbox">
                                        <label for="acc-or">
                                            Create an account?
                                            <input type="checkbox" id="acc-or">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            Check Payment
                                            <input type="checkbox" id="payment">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            Paypal
                                            <input type="checkbox" id="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <button type="submit" class="site-btn">PLACE ORDER</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
</div>
