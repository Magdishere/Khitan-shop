

<div>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form wire:submit.prevent="search">
                            <input type="text" wire:model="search" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach($categories as $category)
                                                    <li>
                                                        <input type="checkbox" wire:model="categoryInputs" value="{{$category->id}}">
                                                        {{$category->name}}
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="#" wire:click.prevent="setPriceRange(1, 50)">$1.00 - $50.00</a></li>
                                                <li><a href="#" wire:click.prevent="setPriceRange(50, 100)">$50.00 - $100.00</a></li>
                                                <li><a href="#" wire:click.prevent="setPriceRange(100, 150)">$100.00 - $150.00</a></li>
                                                <li><a href="#" wire:click.prevent="setPriceRange(150, 200)">$150.00 - $200.00</a></li>
                                                <li><a href="#" wire:click.prevent="setPriceRange(200, 250)">$200.00 - $250.00</a></li>
                                                <li><a href="#" wire:click.prevent="setPriceRange(250, 1000)">250.00+</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                @if ($products->total() > 0)
                                    <p>We found {{$products->total()}} products for you!</p>
                                @else
                                    <p>Sorry, no products found.</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by:</p>
                                <select wire:model="orderBy">
                                    <option value="featured">Featured</option>
                                    <option value="bestseller">Best selling</option>
                                    <option value="alphabet">Alphabetically, A-Z</option>
                                    <option value="alphabet-desc">Alphabetically, Z-A</option>
                                    <option value="price">Price, low to high</option>
                                    <option value="price-desc">Price, high to low</option>
                                    <option value="date-desc">Date new to old</option>
                                    <option value="date">Date old to new</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    @php
                        $items = Cart::instance('wishlist')->content()->pluck('id');
                    @endphp
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">

                                <div class="product__item__pic set-bg" style="background-image: url({{ asset('admin-assets/uploads/images/products/' . $product['image']) }})">
                                    <ul class="product__hover">

                                        <livewire:home-page.add-to-wishlist-component :product="$product" :items="$items" wire:key="{{ $product->id }}" />

                                        <li><a href=""><img src="{{asset('assets/img/icon/compare.png')}}" alt=""> <span>Compare</span></a>
                                        </li>
                                        <li><a href="{{route('product.details', ['slug'=>$product->slug])}}"><img class="p_details" src="{{asset('assets/img/icon/search.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$product['name']}}</h6>

                                    <livewire:add-to-cart-component :product='$product' :items='$items' wire:key="{{ $product->id }}">

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


                <div class="row">
                    <div class="col-lg-12">
                        <!-- Product Pagination -->
                        <div class="product__pagination">
                            {{ $products->links() }}
                        </div>
                        <!-- End Product Pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
