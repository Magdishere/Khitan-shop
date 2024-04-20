<div>
    <section class="product spad">
        <div class="container">
            <div class="row mt-20">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li data-filter=".best_sellers">Best Sellers</li>
                        <li class="active" data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @php
                    $items = Cart::instance('wishlist')->content()->pluck('id');
                @endphp
                @foreach($mostOrderedProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix best_sellers">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('admin-assets/uploads/images/products/' . $product['image']) }}" style="background-image: url({{ asset('admin-assets/uploads/images/products/' . $product['image']) }})">
                            <span class="label">Trending</span>
                            <ul class="product__hover">

                                <livewire:home-page.add-to-wishlist-component :product="$product" :items="$items" wire:key="{{ $product->id }}" />

                                <li><a href="{{route('product.details', ['slug'=>$product->slug])}}"><img class="p_details" src="{{asset('assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product->name}}</h6>
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
                @foreach($lproducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('admin-assets/uploads/images/products/' . $product['image']) }}" style="background-image: url({{ asset('admin-assets/uploads/images/products/' . $product['image']) }})">
                            <span class="label">New</span>
                            <ul class="product__hover">

                                <livewire:home-page.add-to-wishlist-component :product="$product" :items="$items" wire:key="{{ $product->id }}" />

                                <li><a href=""><img src="{{asset('assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a>
                                </li>
                                <li><a href="{{route('product.details', ['slug'=>$product->slug])}}"><img class="p_details" src="{{asset('assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product->name}}</h6>
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
                @foreach($sproducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('admin-assets/uploads/images/products/' . $product['image']) }}" style="background-image: url({{ asset('admin-assets/uploads/images/products/' . $product['image']) }})">
                            <span class="label">Sale</span>
                            <ul class="product__hover">

                                <livewire:home-page.add-to-wishlist-component :product="$product" :items="$items" wire:key="{{ $product->id }}" />

                                <li><a href=""><img src="{{asset('assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a>
                                </li>
                                <li><a href="{{route('product.details', ['slug'=>$product->slug])}}"><img class="p_details" src="{{asset('assets/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product->name}}</h6>
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
    </section>
</div>
