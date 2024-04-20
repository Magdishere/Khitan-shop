
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-sm-15">
                <div class="toggle_info">
                    <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
                </div>
                <div class="panel-collapse collapse login_form" id="loginform">
                    <div class="panel-body">
                        <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Username Or Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="login_footer form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                        <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                    </div>
                                </div>
                                <a href="#">Forgot password?</a>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-md" name="login">Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="toggle_info">
                    <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                </div>
                <div class="panel-collapse collapse coupon_form " id="coupon">
                    <div class="panel-body">
                        <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" placeholder="Enter Coupon Code...">
                            </div>
                            <div class="form-group">
                                <button class="btn  btn-md" name="login">Apply Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="placeOrder">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-25">
                        <h4>Billing Details</h4>
                    </div>
                        <div class="form-group">
                            <label for="firstname">First Name<span>*</span></label>
                            <input type="text"  name="firstname" placeholder="First name" wire:model='firstname'>
                            @error('firstname')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name<span>*</span></label>
                            <input  type="text" name="lastname" value="" placeholder="Your last name" wire:model="lastname">
                            @error('lastname')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address:</label>
                            <input type="email" name="email" value="" placeholder="Type your email" wire:model="email">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile">Phone number<span>*</span></label>
                            <input type="tel" name="mobile" value="" placeholder="10 digits format" wire:model="mobile">
                            @error('mobile')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="line1">Line1:</label>
                            <input type="text" name="line1" value="" placeholder="Street at apartment number" wire:model="line1">
                            @error('line1')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="line1">Line2:</label>
                            <input type="text" name="line1" value="" placeholder="Street at apartment number" wire:model="line2">
                            @error('line2')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">Country<span>*</span></label>
                            <input type="text" name="country" value="" placeholder="Lebanon" wire:model="country">
                            @error('country')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zipcode">Postcode / ZIP:</label>
                            <input type="tel" name="zipcode" value="" placeholder="Your postal code" wire:model="zipcode">
                            @error('zipcode')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="province">Province<span>*</span></label>
                            <input type="text" name="province" value="" placeholder="City name" wire:model="province">
                            @error('province')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city">Town / City<span>*</span></label>
                            <input type="text" name="city" value="" placeholder="City name" wire:model="city">

                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                </div>
                            </div>
                        </div>
                        <div id="collapsePassword" class="form-group create-account collapse in">
                            <input required="" type="password" placeholder="Password" name="password">
                        </div>
                        {{-- <div class="ship_detail">
                            <div class="form-group">
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="differentaddress">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="differentaddress"><span>Ship to a different address?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseAddress" class="different_address collapse in">
                                <div class="form-group">
                                    <input type="text" required="" name="fname" placeholder="First name *">
                                </div>
                                <div class="form-group">
                                    <input type="text" required="" name="lname" placeholder="Last name *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="cname" placeholder="Company Name">
                                </div>
                                <div class="form-group">
                                    <div class="custom_select">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_address" required="" placeholder="Address *">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="billing_address2" required="" placeholder="Address line2">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="city" placeholder="City / Town *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="state" placeholder="State / County *">
                                </div>
                                <div class="form-group">
                                    <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                                </div>
                            </div>
                        </div> --}}
                        <div class="mb-20">
                            <h5>Additional information</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Order notes"></textarea>
                        </div>
                        <button type="submit">Place your order</button>
                </div>
            </div>
        </form>
    </div>
</section>
