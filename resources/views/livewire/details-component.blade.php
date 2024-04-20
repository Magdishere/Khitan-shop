<div>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Product Details</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>{{$product->name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <livewire:products-images-details :product="$product" />
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    @php
                        $items = Cart::instance('wishlist')->content()->pluck('id');
                    @endphp
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$product->name}}</h4>
                            <livewire:reviews-component :productId="$product->id" />

                            <livewire:product-attributes :product="$product" />

                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </div>

                            <livewire:details-product-wishlist-button :product="$product" :items="$items" wire:key="{{ $product->id }}" />

                            <div class="product__details__last__option">
                                <ul>
                                    <li><span>SKU:</span> {{$product->SKU}}</li>
                                    <li><span>Category:</span> {{$product->category->name}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p>{{$product->description}}</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
            @php
            $items = Cart::instance('wishlist')->content()->pluck('id');
            @endphp
            @foreach($rproducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('admin-assets/uploads/images/products/' . $product['image']) }}" style="background-image: url({{ asset('admin-assets/uploads/images/products/' . $product['image']) }})">
                            <ul class="product__hover">
                                <li>
                            @if($items->contains($product->id))
                                <a href="#" class="add-cart" wire:click.prevent="removeFromWishlist('{{ $product['id'] }}')"><img class="heart" src="{{asset('assets/img/icon/heart.png')}}" alt=""></a>
                            @else
                                @if (App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
                                    <a href="#" class="add-cart" wire:click.prevent="addToWishlist('{{ $product['id'] }}', '{{ $product['name'] }}', {{ App\Sale\Sale::calculateDiscountedPrice($product['id']) }})"><img src="{{asset('assets/img/icon/heart.png')}}" alt=""></a>
                                @else
                                    <a href="#" class="add-cart" wire:click.prevent="addToWishlist('{{ $product['id'] }}', '{{ $product['name'] }}', {{$product['regular_price']}})"><img src="{{asset('assets/img/icon/heart.png')}}" alt=""></a>
                                @endif
                            @endif
                                </li>
                                <li><a href=""><img src="{{asset('assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a>
                                </li>
                                <li><a href="{{route('product.details', ['slug'=>$product->slug])}}"><img class="p_details" src="{{asset('assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product['name']}}</h6>
                            @if (App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
                                <a href="#" class="add-cart" wire:click.prevent="addToCart('{{ $product['id'] }}', '{{ $product['name'] }}', {{ App\Sale\Sale::calculateDiscountedPrice($product['id']) }})"                                            >+ Add To Cart</a>
                            @else
                                <a href="#" class="add-cart" wire:click.prevent="addToCart('{{ $product['id'] }}', '{{ $product['name'] }}', {{$product['regular_price']}})"                                            >+ Add To Cart</a>
                            @endif

                            <livewire:reviews-component :productId="$product->id" />

                            @if (App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
                            <span class="text-1000 fw-bold"><del>${{$product['regular_price']}}</del></span>
                            <span class="text-1000" style="font-weight: bold;">${{ App\Sale\Sale::calculateDiscountedPrice($product['id'])}}</span>
                            @else
                                <span class="text-1000" style="font-weight: bold;">${{$product['regular_price']}}</span>
                            @endif

                            <div class="product__color__select">
                                <label for="pc-4">
                                    <input type="radio" id="pc-4">
                                </label>
                                <label class="active black" for="pc-5">
                                    <input type="radio" id="pc-5">
                                </label>
                                <label class="grey" for="pc-6">
                                    <input type="radio" id="pc-6">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->
</div>
