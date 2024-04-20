
<div>
<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p class="cashondevilery">Cash on delivery, we delivery all over Lebanon.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                        @guest <!-- Check if the user is a guest (not logged in) -->
                        <a href="{{ route('login') }}" class="logout-btn-style">Sign in</a>
                        @else <!-- If the user is logged in, show the user's name and logout link -->
                            <a href="#" class="pulse-link" style="color: #d78093;">{{ Auth::user()->name }}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn-style">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                        </div>
                        <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul>
                                <li>USD</li>
                                <li>EUR</li>
                                <li>USD</li>
                            </ul>
                        </div>
                        <div class="header__top__hover music-div">
                            <a id="musicButton" href="#">

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <img src="{{asset('../assets/img/khitan.png')}}" style="height:50px; padding-left:60px;">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="{{route('about-us')}}">About Us</a></li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    @livewire('cart-icon-component')
                    @livewire('wishlist-icon-component')
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
</div>


