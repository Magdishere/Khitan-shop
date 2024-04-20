



    <a href="/cart"><img src="{{asset('assets/img/icon/cart.png')}}" alt="">
        @if(Cart::instance('cart')->count() > 0)
        <span class="blue">{{Cart::count()}}</span>
        @endif
    </a>

