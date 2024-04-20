<div>
@if($bannerSale)
    <section class="product spad" id="sales-section">
        <div class="container">
            <div class="row">
                @foreach($bannerSale as $banners)
                    <div class="col-lg-6 col-md-6 col-sm-12 pb-1">
                        <div class="d-flex mb-4 align-items-center text-center">
                            <a href="{{route('sale.product', ['id'=>$banners->id])}}">
                                <img class="sales-images-banner" src="{{asset($banners->banner)}} ">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
</div>
