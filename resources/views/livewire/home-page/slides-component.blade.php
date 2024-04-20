<div>
    <!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach($slides as $slide)
        <div class="hero__items set-bg" style="background-image: url('{{ asset('admin-assets/uploads/images/slides/' . $slide['image']) }}')">
            <div class="hero__overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h2 style="color: #d78093;">{{$slide->title}}</h2>
                            <p class="slide-text">{{$slide->description}}</p>
                            <a href="{{route('shop')}}" class="primary-btn slide-btn" style="background-color: transparent;">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a class="socialmedia-btn" href="#"><i class="fa fa-facebook"></i></a>
                                <a class="socialmedia-btn" href="#"><i class="fa fa-instagram"></i></a>
                                <a class="socialmedia-btn" href="#"><i class="fa fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->
</div>
