@extends('layouts.master')
@section('css')
    <style>
        .hidden {
            display: none !important;
        }
    </style>
@endsection
@section('page-header')
    <div class="main-panel">
        <div class="content-wrapper">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="my-auto">
                    <div class="d-flex">
                        <h4 class="content-title mb-0 my-auto">Add Product</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Products</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Product</h4>
                            <form action="{{route('admin-products.store')}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Main Image</label>
                                    <input type="file" name="product_image" class="file-upload custom-file-input hidden" id="input_scr" onchange="previewFile()" hidden>
                                    <label class="border-0 mb-0 cursor" for="restaurant-logo">
                                        <img src="{{asset('admin-assets/img/camera-icon.png')}}" id="img_scr" alt="img" class="img-fluid" style="width: 130px; height: 130px">
                                        <span id="img_here"></span>
                                        <img src="{{asset('admin-assets/img/camera-icon.png')}}" id="img_scr" alt="img" class="provider-rest-img d-none" style="width: 130px; height: 130px">

                                        <span class="file-custom"></span>
                                    </label>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                    </div>
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Images</label>
                                    <input type="file" name="product_images[]" id="product_images" class="" accept="image/*" multiple>
                                    @error('photo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Product name in English
                                                </label>
                                                <input type="text" id="name_en"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('name_en')}}"
                                                       name="name_en">
                                                @error("name_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Product name in Arabic
                                                </label>
                                                <input type="text" id="name_ar"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('name_ar')}}"
                                                       name="name_ar">
                                                @error("name_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Slug
                                                </label>
                                                <input type="text" id="slug"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('slug')}}"
                                                       name="slug">
                                                @error("slug")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Price
                                                </label>
                                                <input type="text" id="regular_price"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('regular_price')}}"
                                                       name="regular_price">
                                                @error("regular_price")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> SKU
                                                </label>
                                                <input type="text" id="SKU"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('SKU')}}"
                                                       name="SKU">
                                                @error("SKU")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> quantity
                                                </label>
                                                <input type="number" id="quantity"
                                                       class="form-control"
                                                       placeholder="  "
                                                       value="{{old('quantity')}}"
                                                       name="quantity">
                                                @error("quantity")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            @foreach(json_decode($attributes, true) as $attribute)
                                                @if($attribute['name'] !== null)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">{{$attribute['name']}}</label>
                                                            <select class="js-example-basic-multiple" name="attribute_options[]" multiple="multiple" {{ isset($attribute['select_attributes']) ? $attribute['select_attributes'] : '' }}>
                                                                @foreach($attribute['options'] as $option)
                                                                    <option value="{{ $option['id'] }}" {{ isset($option['attributes']) ? $option['attributes'] : '' }}>
                                                                        {{ $option['translations'][0]['value'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> short description in English</label>
                                                <input type="text" id="short_description_en"
                                                        class="form-control"
                                                        placeholder="  "
                                                        name="short_description_en">
                                                @error("short_description_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> short description in Arabic
                                                </label>
                                                <input type="text" id="short_description_ar"
                                                          class="form-control"
                                                          placeholder="  "
                                                          name="short_description_ar">
                                                @error("short_description_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Description in English </label>
                                                <input type="text" id="description_en"
                                                       class="form-control"
                                                       placeholder="  "
                                                          name="description_en">
                                                @error("description_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> Description in Arabic </label>
                                                <input type="text" id="description_ar"
                                                       class="form-control"
                                                       placeholder="  "
                                                          name="description_ar">
                                                @error("description_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> stock status
                                                </label>
                                                <select name="stock_status" class="select2 form-control">
                                                    <optgroup label="stock status">
                                                                 <option value="Available">Available</option>
                                                                 <option value="Not Available">Not Available</option>
                                                    </optgroup>
                                                </select>
                                                @error('stock_status')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> category
                                                </label>
                                                <select name="category_id" class="select2 form-control">
                                                    <optgroup label="stock status">
                                                         @if($categories && $categories -> count() > 0)
                                                             @foreach($categories as $category)
                                                                 <option
                                                                     value="{{$category -> id }}">{{$category -> name }}</option>
                                                             @endforeach
                                                         @endif
                                                    </optgroup>
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <ul class="pro-submit" style="list-style:none;">
                                    <li>
                                        <button type="submit"  class="btn " style="background-color: black; color:pink;">Add Product</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- content-wrapper ends -->
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('input:radio[name="type"]').change(function () {
                if (this.checked && this.value == '2') {
                    $('#cats_list').removeClass('hidden');
                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
        });
    </script>


<script>
    let input = document.getElementById("input_scr");
    let img = document.getElementById("img_scr");
    img.onclick = function (){
        input.click();
    }
</script>

@stop
