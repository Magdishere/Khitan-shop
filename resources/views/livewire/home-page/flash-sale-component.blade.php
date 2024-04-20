<div>
    @if($flashSale)

    <section class="product spad">
        <div class="container">
            <header class="row" style="color:#000000;background:rgba(215, 128, 147, 0.795);">
                <div class="col-md-6">
                    <h3 class="-m -fs20 -elli mt-2" style="color: #000000; font-style:italic; font-weight:bold;  text-transform: uppercase;">{{$flashSale->name}}, Up to {{$flashSale->value}}%.</h3>

                </div>
                <div class="col-md-6" style="font-size: 24px; margin-top:3px;  text-transform: uppercase; text-align: right;">
                    Hurry Up:
                    <time id="countdownTimer" class="-b -ws-p" datetime="{{$flashSale->start_date}}" data-cd="true">{{$flashSale->start_date}}</time>
                    <a href="{{route('sale.product', ['id'=>$flashSale->id])}}" class="-df -i-ctr -upp -m -mls -pvxs" style="color: #d78093; ">  ->
                        <svg style="fill:#FFFFFF;" viewBox="0 0 24 24" class="ic" width="24" height="24">
                            <use xlink:href="https://www.jumia.com.eg/assets_he/images/i-icons.a66628fd.svg#arrow-right"></use></svg>
                    </a>
                </div>
            </header>
            <div class="row" style="background-color:rgba(215, 128, 147, 0.3);  ">
                <div class="col-md-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                        <!-- Carousel indicators -->


                        <ol class="carousel-indicators">
                            @if($flashSale == 'category')
                                @php
                                    $categoryProducts = \App\Models\admin\Product::where('category_id', $flashSale->categories->first()->id)->get();
                                @endphp
                                @foreach($categoryProducts->chunk(3) as $key => $chunk)
                                    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                                @endforeach
                            @elseif($flashSale == 'product')
                                @foreach($flashSale->products->chunk(3) as $key => $chunk)
                                    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
                                @endforeach
                            @endif
                        </ol>
                        <!-- Wrapper for carousel items -->
                        <div class="carousel-inner">
                            @php
                                $items = Cart::instance('wishlist')->content()->pluck('id');
                            @endphp
                            @if($flashSale->target_type == 'product')
                            @foreach($flashSale->products->chunk(3) as $key => $chunk)
                                <div class="item carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <div class="row product__filter">
                                        @foreach($chunk as $product)
                                            <div class="col-lg-6 col-md-6 col-sm-6">
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
                                                            <span class="text-1000 fw-bold">

                                                                <del>${{ $product['regular_price'] + (new \App\Models\admin\Product())->getDefaultSizePrice($product) }}</del>
                                </span>
                                                            <span class="text-1000" style="font-weight: bold;">${{ App\Sale\Sale::calculateDiscountedPrice($product['id'])}}</span>
                                                        @else
                                                            <span class="text-1000" style="font-weight: bold;">${{$product['regular_price']}}</span>
                                                        @endif


                                                        <div class="product__color__select">
                                                            @foreach($product->attributeOptions as $options)
                                                                @if($options->attribute->name == 'color')
                                                                    @foreach($options->translations as $translation)
                                                                        @if($translation->locale == app()->getLocale())
                                                                            <label class="{{ ($selectedColors[$product->id] === $translation->value || ($selectedColors[$product->id] === null && $options->pivot->is_default === 1)) ? 'active ' . $translation->value : $translation->value  }}" for="{{ 'pc-' . $product->id . '-' . $translation->value }}" style="background: {{ $translation->value }}">
                                                                                <input type="radio" id="{{ 'pc-' . $product->id . '-' . $translation->value }}" wire:model="selectedColors.{{ $product->id }}" value="{{ $translation->value }}">
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            @elseif($flashSale->target_type == 'category')
                                @php
                                    $categoryProducts = \App\Models\admin\Product::where('category_id', $flashSale->categories->first()->id)->get();
                                @endphp
                                @foreach($categoryProducts ->chunk(3) as $key => $chunk)
                                <div class="item carousel-item {{$key == 0 ? 'active' : ''}}">
                                    <div class="row product__filter">
                                        @foreach($chunk as $product)
                                            <div class="col-lg-4 col-md-6 col-sm-6">
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
                                                        <div class="rating">

                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>

                                                        @if (App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
                                                            <span class="text-1000 fw-bold">
                                                            <del>${{ $product['regular_price'] + (new \App\Models\admin\Product())->getDefaultSizePrice($product) }}</del>
                                                                                            </span>
                                                            <span class="text-1000" style="font-weight: bold;">${{ App\Sale\Sale::calculateDiscountedPrice($product['id'])}}</span>
                                                        @else
                                                            <span class="text-1000" style="font-weight: bold;">${{$product['regular_price']}}</span>
                                                        @endif


                                                        <div class="product__color__select">
                                                            @foreach($product->attributeOptions as $options)
                                                                @if($options->attribute->name == 'color')
                                                                    @foreach($options->translations as $translation)
                                                                        @if($translation->locale == app()->getLocale())
                                                                            <label class="{{ ($selectedColors[$product->id] === $translation->value || ($selectedColors[$product->id] === null && $options->pivot->is_default === 1)) ? 'active ' . $translation->value : $translation->value  }}" for="{{ 'pc-' . $product->id . '-' . $translation->value }}" style="background: {{ $translation->value }}">
                                                                                <input type="radio" id="{{ 'pc-' . $product->id . '-' . $translation->value }}" wire:model="selectedColors.{{ $product->id }}" value="{{ $translation->value }}">
                                                                            </label>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- Carousel controls -->
                        <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <footer class="row" style="background: rgba(215, 128, 147, 0.795); color: #000000;">
                <div class="col-md-6">
                    <h5 class="-m -fs20 -elli mt-2" style="font-style:italic; font-weight:bold; text-transform: uppercase;">High Quality Products</h5>

                </div>
                <div class="col-md-6" style="font-size: 24px; margin-top:3px; text-transform: uppercase; text-align: right;">
                    <h5 class="-m -fs20 -elli mt-1" style="font-style:italic; font-weight:bold; text-transform: uppercase;">P.S: Limited Quantity!</h5>
                </div>
            </footer>
        </div>
    </section>
    @endif
</div>
