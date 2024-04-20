
<div>

    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Wishlist</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Wishlist</span>
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
                            <tr style="text-center">
                                <th class="text-center">Product</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Total</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (Cart::instance('wishlist')->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">No Items in the Wishlist</td>
                            </tr>
                        @else
                            @foreach(Cart::instance('wishlist')->content() as $item)
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="img/shopping-cart/cart-1.jpg" alt="">
                                    </div>
                                    <div class="product__cart__item__text text-center">
                                        <a class="name-product-wishlist" href="{{ route('product.details', ['slug' => $item->model->slug]) }}">{{$item->model->name}}</a>
                                    </div>
                                </td>
                                <td class="product__cart__item text-center">
                                    <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                        <img class="image-product-wishlist" src="{{ asset('../admin-assets/uploads/images/products/' . $item->model->image) }}" alt="">
                                    </a>
                                </td>
                                <td class="cart__price text-center">${{ $item->price }}</td>
                                <td class="action cart__close text-center" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="removeFromWishlist('{{$item->rowId}}')"><i class="fa fa-close"></i></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/shop"><i class="fa fa-plus"></i> Add To Wishlist</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#" wire:click.prevent="addToCartAll"><i class="fa fa-plus"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
