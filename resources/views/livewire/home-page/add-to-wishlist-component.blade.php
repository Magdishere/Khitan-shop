
<div>
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
</div>
