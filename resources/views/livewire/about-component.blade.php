

   <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>About Us</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>About Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item shadowfilter">
                    <img  src="{{asset('assets/img/icon/blackheart.png')}}" style="width: 50px; height:50px; display:block; margin:auto;">
                    <h4 class="text-center mt-2">Who We Are ?</h4>
                    <p>We are passionate artisans, crafting intricate and unique handmade crochet creations. Our commitment to quality and creativity sets us apart in the world of crochet design.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item shadowfilter">
                    <img class="" src="{{asset('assets/img/icon/question.png')}}" style="width: 50px; height:50px; display:block; margin:auto;">
                    <h4 class="text-center mt-2">What We Do ?</h4>
                    <p>In the realm of handmade crochet, we bring artistry to life. Crafting cozy blankets, stylish accessories, and bespoke pieces, our hands weave warmth and beauty into every stitch.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="about__item shadowfilter">
                    <img class="" src="{{asset('assets/img/icon/candidates.png')}}" style="width: 50px; height:50px; display:block; margin:auto;">
                    <h4 class="text-center mt-2">Why Choose Us ?</h4>
                    <p>Explore the allure of our handmade crochet items, where each piece is intricately crafted with dedication and a personal touch. Choose us as your destination for unique handcrafted crochet creations.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="about__pic">
                    <img src="{{asset('assets/img/about/a.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Team Section Begin -->
<section class="team spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Our Crochet Threads</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($strings as $string)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team__item">
                    <img src="{{asset('admin-assets/uploads/images/strings/' . $string['image'])}}" alt="">
                    <h4>{{$string->brand}} - {{$string->color}}</h4>
                    <span>{{$string->length}} - {{$string->material}} - {{$string->weight}}Kg</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Team Section End -->


