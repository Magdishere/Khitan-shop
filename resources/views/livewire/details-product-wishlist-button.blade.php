<div class="product__details__btns__option">
    @if($items->contains($product->id))
        <a href="#" style="color:#eb3ba7;" wire:click.prevent="removeFromWishlist('{{ $product['id'] }}')"><i class="fa fa-heart"></i> Remove from wishlist</a>
    @else
        @if(App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
            <a href="#" wire:click.prevent="addToWishlist('{{ $product['id'] }}', '{{ $product['name'] }}', {{ App\Sale\Sale::calculateDiscountedPrice($product['id']) }})"><i class="fa fa-heart"></i> add to wishlist</a>
        @else
            <a href="#" wire:click.prevent="addToWishlist('{{ $product['id'] }}', '{{ $product['name'] }}', '{{ $product['regular_price']}}')"><i class="fa fa-heart"></i> add to wishlist</a>
        @endif
    @endif
</div>
