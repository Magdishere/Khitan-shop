<div>
    @if (App\Sale\Sale::calculateDiscountedPrice($product['id']) != '-')
        <a href="#" class="add-cart" wire:click.prevent="addToCart('{{ $product['id'] }}', '{{ $product['name'] }}', {{ App\Sale\Sale::calculateDiscountedPrice($product['id']) }})"                                            >+ Add To Cart</a>
    @else
        <a href="#" class="add-cart" wire:click.prevent="addToCart('{{ $product['id'] }}', '{{ $product['name'] }}', {{$product['regular_price']}})"                                            >+ Add To Cart</a>
    @endif
</div>
