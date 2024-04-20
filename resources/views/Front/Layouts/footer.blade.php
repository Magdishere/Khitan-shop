

    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="/"><img  class="" src="{{asset('assets/img/khitan_logo1.png')}}" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <div class="hero__social">
                            <a class="socialmedia-btn" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="socialmedia-btn" href="https://www.instagram.com/khitan_lb2/"><i class="fa fa-instagram"></i></a>
                            <a class="socialmedia-btn" href="https://wa.me/70366100"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="{{route('shop')}}">Shopping Page</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#sales-section">Sales</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivery</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | This website was made by <a href="https://aymasolutions.ayahosni.com" target="_blank">AYMA Solutions</a>
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('assets/js/mixitup.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script>


    $(document).ready(function(){
        // Event delegation for dynamically added elements
        $(".header__menu ul li").on("click", "li", function(){


            // Remove active class from all anchor tags within the header__menu
            $(".header__menu li").removeClass("active");
            // Add active class to the clicked anchor tag
            $(this).addClass("active");
        });
    });


    </script>
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
    </script>
<script>

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

    <script>
        // **************************************** count sales ********************************************


        function countdown() {
            var daysElement = document.getElementById('days');
            var hoursElement = document.getElementById('hours');
            var minutesElement = document.getElementById('minutes');
            var secondsElement = document.getElementById('seconds');

            var days = parseInt(daysElement.innerHTML);
            var hours = parseInt(hoursElement.innerHTML);
            var minutes = parseInt(minutesElement.innerHTML);
            var seconds = parseInt(secondsElement.innerHTML);

            var totalSeconds = (days * 24 * 60 * 60) + (hours * 60 * 60) + (minutes * 60) + seconds;

            if (totalSeconds <= 0) {
                // Countdown is finished, do something here
                return;
            }

            totalSeconds--;
            days = Math.floor(totalSeconds / (24 * 60 * 60));
            hours = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
            minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
            seconds = totalSeconds % 60;

            daysElement.innerHTML = days;
            hoursElement.innerHTML = hours;
            minutesElement.innerHTML = minutes;
            secondsElement.innerHTML = seconds;

            setTimeout(countdown, 1000);
        }

        countdown();

    </script>



    @livewireScripts
</body>

</html>
