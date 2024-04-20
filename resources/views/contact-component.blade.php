<!-- Contact Section Begin -->
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a rel="nofollow">@lang('messages.Home')</a>
            <span></span> @lang('messages.Contact Us')
        </div>
    </div>
</div>

<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>@lang('messages.Phone')</h4>
                    <p>+961 81-447-729</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>@lang('messages.Address')</h4>
                    <p>Beshmezzine - El Koura, Lebanon</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>@lang('messages.Open time')</h4>
                    <p>10:00 am to 23:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>@lang('messages.Email')</h4>
                    <p>christina.makhlouf34@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23482.270873743813!2d35.671224076665!3d33.58442550408972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151d5a40da94c159%3A0xbfdf9ad71a15b16!2sBeshmezzine%2C%20Lebanon!5e0!3m2!1sen!2sus!4v1632071401915!5m2!1sen!2sus"
        height="500" style="border:0;"
        allowfullscreen="" aria-hidden="false" tabindex="0">
    </iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>@lang('messages.Beshmezzine')</h4>
            <ul>
                <li>@lang('messages.Phone'): +961 76326960</li>
                <li>Add: Beshmezzine, AL Koura</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>@lang('messages.Leave Message')</h2>
                </div>
            </div>
        </div>
        <form action="#">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="@lang('messages.Your name')">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="@lang('messages.Your Email')">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="@lang('messages.Your message')"></textarea>
                    <button type="submit" class="site-btn">@lang('messages.SEND MESSAGE')</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->
