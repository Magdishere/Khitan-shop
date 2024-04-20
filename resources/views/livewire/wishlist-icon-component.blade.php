


    <a href="/wishlist"><img src="{{asset('assets/img/icon/heart.png')}}" style="width: 20px;" alt="">
        @if(Cart::instance('wishlist')->count() > 0)
        <span class="wishlist-icon-num">{{Cart::instance('wishlist')->count()}}</span>
        @endif
    </a>
