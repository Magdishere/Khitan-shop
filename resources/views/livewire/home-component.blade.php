<div>

    <livewire:home-page.slides-component />

<!-- Categories Section Begin -->

    <livewire:home-page.categories-component />

<div>
    <section class="product spad">
        <div class="tickerwrapper">
            <ul class='list'>
            <li class='listitem'>
                <span>Free & Fast Shipping</span>
            </li>
            <li class='listitem'>
                <span>High Quality</span>
            </li>
            <li class='listitem'>
                <span>14-Day Return</span>
            </li>
            <li class='listitem'>
                <span>24/7 Support</span>
            </li>
            <li class='listitem'>
                <span>Free & Fast Shipping</span>
            </li>
            <li class='listitem'>
            <span>High Quality</span>
            </li>
            <li class='listitem'>
            <span>14-Day Return</span>
            </li>
            <li class='listitem'>
            <span>24/7 Support</span>
            </li>
            <li class='listitem'>
            <span>Free & Fast Shipping</span>
            </li>
            <li class='listitem'>
            <span>High Quality</span>
            </li>
            <li class='listitem'>
            <span>14-Day Return</span>
            </li>
        </ul>
        </div>
    </section>
</div>
    <livewire:home-page.flash-sale-component />

    <livewire:home-page.best-new-hot-component />

    <livewire:home-page.count-down-component />

    <livewire:home-page.banner-sale-component />



<div>
    <section class="categories spad" style="position: relative; background-image: url('assets/img/model2.jpg'); background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="section-title centered-paragraph" style="position: relative; z-index: 1;">
                    <h2 style="color: #d78093;">Up for Collaboration?</h2>
                    <p class="text-white" style="padding-top: 10px;">Join us as a model and showcase the elegance of our handmade crochet creations, adding warmth and charm to every moment.</p>
                    <a href="https://wa.me/70366100" class="primary-btn slide-btn" style="background-color: transparent;">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="shadow-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 0;"></div>
    </section>
</div>

<div>
<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{asset('assets/img/blog/blog-1.jpg')}}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{asset('assets/img/icon/calendar.png')}}" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{asset('assets/img/blog/blog-2.jpg')}}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{asset('assets/img/icon/calendar.png')}}" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{asset('assets/img/blog/blog-3.jpg')}}"></div>
                    <div class="blog__item__text">
                        <span><img src="{{asset('assets/img/icon/calendar.png')}}" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
</div>

@push('js')
<script>
    // Function to update the countdown timer
    function updateCountdown() {
        // Get the current date and time
        var now = new Date().getTime();

        // Get the start date of the flash sale from the HTML element
        var startDate = new Date(document.getElementById('countdownTimer').getAttribute('datetime')).getTime();

        // Calculate the time remaining in milliseconds
        var timeRemaining = startDate - now;

        // Calculate days, hours, minutes, and seconds
        var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Update the HTML element with the countdown values
        document.getElementById('countdownTimer').innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        // Update the countdown every second
        setTimeout(updateCountdown, 1000);
    }

    // Call the updateCountdown function to start the countdown
    updateCountdown();


    var $tickerWrapper = $(".tickerwrapper");
    var $list = $tickerWrapper.find("ul.list");
    var $clonedList = $list.clone();
    var listWidth = 10;

    $list.find("li").each(function (i) {
        listWidth += $(this, i).outerWidth(true);
    });

    var endPos = $tickerWrapper.width() - listWidth;

    $list.add($clonedList).css({
        "width" : listWidth + "px"
    });

    $clonedList.addClass("cloned").appendTo($tickerWrapper);

    //TimelineMax
    var infinite = new TimelineMax({repeat: -1, paused: true});
    var time = 20;

    infinite

        .fromTo($list, time, {rotation:0.01,x:0}, {force3D:true, x: -listWidth, ease: Linear.easeNone}, 0)
        .fromTo($clonedList, time, {rotation:0.01, x:listWidth}, {force3D:true, x:0, ease: Linear.easeNone}, 0)
        .set($list, {force3D:true, rotation:0.01, x: listWidth})
        .to($clonedList, time, {force3D:true, rotation:0.01, x: -listWidth, ease: Linear.easeNone}, time)
        .to($list, time, {force3D:true, rotation:0.01, x: 0, ease: Linear.easeNone}, time)
        .progress(1).progress(0)
        .play();

    //Pause/Play
    $tickerWrapper.on("mouseenter", function(){
        infinite.pause();
    }).on("mouseleave", function(){
        infinite.play();
    });


    </script>


@endpush
