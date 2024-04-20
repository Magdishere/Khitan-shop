@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Products</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Products</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">PRODUCTS TABLE</h4>

                        <div class="mb-3 mb-xl-0">
                                <a class="btn add-btn" href="{{route('admin-products.create')}}"><i class="fa fa-plus"></i> Add Product</a>

                            <div class="btn-group dropdown">
                                <button type="button" class="btn add-btn">14 Aug 2019</button>
                                <button type="button"  class="btn add-btn dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                                    <a class="dropdown-item" href="#">2015</a>
                                    <a class="dropdown-item" href="#">2016</a>
                                    <a class="dropdown-item" href="#">2017</a>
                                    <a class="dropdown-item" href="#">2018</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">All Products</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Product Name</th>
                                    <th class="wd-20p border-bottom-0">Slug</th>
                                    <th class="wd-15p border-bottom-0">Price</th>
                                    <th class="wd-10p border-bottom-0">SKU</th>
                                    <th class="wd-25p border-bottom-0">Quantity</th>
                                    <th class="wd-25p border-bottom-0">Category</th>
                                    <th class="wd-25p border-bottom-0">Image</th>
                                    <th class="wd-25p border-bottom-0">Featured</th>
                                    <th class="wd-25p border-bottom-0">Short Description</th>
                                    <th class="wd-25p border-bottom-0">Description</th>
                                    <th class="wd-25p border-bottom-0">All Images</th>
                                    <th class="wd-25p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->slug}}</td>
                                    <td>{{$product->regular_price}}
                                        {{ App\Sale\Sale::calculateDiscountedPrice($product->id)}}
                                    </td>
                                    <td>{{$product->SKU}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>Category</td>
                                    <td><img src="{{ asset('../admin-assets/uploads/images/products/' . $product->image) }}" alt="Slide Image" style="max-width: 50px;"></td>
                                    <td>{{$product->featured}}</td>
                                    <td>{{$product->short_description}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->name}}</td>
                                    <td class="text-center">
                                        <a class="modal-effect btn btn-sm btn-warning" href="{{route('admin-products.edit', $product->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$product->id}}"><i class="fa fa-trash"></i>Delete</a>
                                    </td>
                            </tr>
                            @include('Back.Products.delete')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
