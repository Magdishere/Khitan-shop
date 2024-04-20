<div class="row">
    <div class="col-lg-3 col-md-3">
        <ul class="nav nav-tabs" role="tablist" id="productTabs">
            @foreach($product->images as $index => $image)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" data-toggle="tab" href="#tabs-{{ $index + 1 }}" role="tab" >
                        <div class="product__thumb__pic set-bg" data-setbg="{{ asset('admin-assets/uploads/images/products/' . $image->image_path) }} " style="border-radius:5px; text-decoration:none;">
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-lg-6 col-md-9">
        <div class="tab-content">
            @foreach($product->images as $index => $image)
                <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="tabs-{{ $index + 1 }}" role="tabpanel">
                    <div class="product__details__pic__item">
                        <img src="{{ asset('admin-assets/uploads/images/products/' . $image->image_path) }}" style="border-radius:5px;" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
