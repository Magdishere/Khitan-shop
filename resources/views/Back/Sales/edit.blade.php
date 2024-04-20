@extends('layouts.master')
@section('css')
    <style>
        .hidden {
            display: none !important;
        }

        input[type=checkbox] {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .checklabel {
            cursor: pointer;
            text-indent: -9999px;
            width: 100px;
            height: 50px;
            background: grey;
            display: block;
            border-radius: 100px;
            position: relative;
        }

        .checklabel:after {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            width: 45px;
            height: 40px;
            background: #fff;
            border-radius: 90px;
            transition: 0.3s;
        }

        input:checked + .checklabel {
            background: rgba(253, 45, 125, 0.6);
        }

        input:checked + .checklabel:after {
            left: calc(100% - 5px);
            transform: translateX(-100%);
        }

        .checklabel:active:after {
            width: 130px;
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
                        <h4 class="content-title mb-0 my-auto">Edit Sales</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Sales</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Sale</h4>
                            <form  id="form" action="{{route('admin-sales.update', $saleId)}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="sale_id" id="sale_id" class="form-control" value="{{$sale->id}}" hidden>
                                        </div>
                                    </div>

                                    <label>Sales Image</label>
                                    <input type="file" name="banner" id="banner" accept="image/*" onchange="previewImage(this)">
                                    @error('banner')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                        <img id="image-preview" style="width: 150px; height: 100px" alt="No Image">

                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i>Sales Details</h4>
                                    <div class="form-group row">
                                        <label class="col-2 col-form-label" for="choose-for-category">Category Or Product</label>
                                    </div>
                                    <!-- Update the radio inputs with the new name -->

                                        <div class="col-md-3">
                                            <div>
                                                <input type="radio"  name="sale_type" id="radio2" class="radio" value="1" {{ $sale->target_type === 'category' ? 'checked' : '' }} />
                                                <label for="radio2">For Category</label>
                                            </div>
                                            @error("sale_type")
                                            <span class="text-danger">{{$message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <div>
                                                <input type="radio" name="sale_type" id="radio3" class="radio" value="2" {{ $sale->target_type === 'product' ? 'checked' : '' }} />
                                                <label for="radio3">For product</label>
                                                @error("sale_type")
                                                <span class="text-danger">{{$message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    <div class="form-group row" id="for-category" >
                                        <label class="col-2 col-form-label" for="choose-for-category">Category</label>
                                        <div class="col-10">
                                            <select multiple name="category_id[]" id="choose-for-category" class="filter-multi-select">
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $associatedIds) ? 'selected' : '' }}>
                                                        <img src="{{ asset('../admin-assets/uploads/images/products/' . $category->image) }}" alt="Sales Image" style="max-width: 50px;">

                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row hidden" id="for-product">
                                        <label class="col-2 col-form-label" for="choose-for-product">Products</label>
                                        <div class="col-10">
                                            <select multiple name="product_id[]" id="choose-for-product" class="filter-multi-select">
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ in_array($product->id, $associatedIds) ? 'selected' : '' }}>
                                                        <img src="{{ asset('../admin-assets/uploads/images/products/' . $product->image) }}" alt="Sales Image" style="max-width: 50px;">

                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Name
                                                </label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{$sale->name}}" required>
                                                @error("name")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Type</label>
                                                <select name="type" class="form-control">
                                                    <option value="fixed" {{ $sale->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                                    <option value="percent" {{ $sale->type == 'percent' ? 'selected' : '' }}>Percent</option>
                                                </select>
                                                @error("name")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Value</label>
                                                <input type="number" name="value" id="value" class="form-control" value="{{ $sale->value }}" required>
                                                @error("value")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Position</label>
                                                <select name="position" class="form-control">
                                                    @for($i = 0; $i <= 4; $i++)
                                                        <option value="{{ $i }}" {{ $sale->position == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error("position")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Start Date</label>
                                                <input type="datetime-local" name="starts_date" id="starts_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($sale->start_date)) }}" required>
                                                @error("starts_date")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">End Date</label>
                                                <input type="datetime-local" name="ends_date" id="ends_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($sale->end_date)) }}" required>
                                                @error("ends_date")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Flash Sale</label>
                                                <input name="is_flash_sale" type="checkbox" id="flash_sale" />
                                                <label class="checklabel" for="flash_sale">Toggle</label>
                                                @error("is_flash_sale")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Active</label>
                                                <input name="is_active" type="checkbox" id="is_active" checked/>
                                                <label class="checklabel" for="is_active">Toggle</label>
                                                @error("is_active")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label for="banner_type">Select Banner Type</label>
                                    <select name="banner_type" id="banner_type" class="form-control">
                                        <option value="countdown" {{ $sale->banner_type === 'countdown' ? 'selected' : '' }}>Countdown Banner</option>
                                        <option value="image" {{ $sale->banner_type === 'image' ? 'selected' : '' }}>Image Banner</option>
                                    </select>
                                </div>


                                    <ul class="pro-submit" style="list-style:none;">
                                        <li>
                                            <button type="submit"  class="btn" style="background-color: black; color:pink;">Save Sales</button>
                                        </li>
                                    </ul>
                                </div>
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
    <script>
        $(document).ready(function () {
            function handleRadioChange() {
                if ($('#radio3').is(':checked')) {
                    $('#for-category').addClass('hidden');
                    $('#for-product').removeClass('hidden');
                } else {
                    $('#for-category').removeClass('hidden');
                    $('#for-product').addClass('hidden');
                }
            }

            handleRadioChange();

            $('input:radio[name="sale_type"]').change(handleRadioChange);
        });

    </script>


    <script>
        function previewImage(input) {
            var preview = document.getElementById('image-preview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        }
    </script>

    <script>
        // Use the plugin once the DOM has been loaded.
        $(function () {
            // Apply the plugin
            var notifications = $('#notifications');
            $('#choose-for-product').on("optionselected", function(e) {
                createNotification("selected", e.detail.label);
            });
            $('#choose-for-product').on("optiondeselected", function(e) {
                createNotification("deselected", e.detail.label);
            });
            function createNotification(event,label) {
                var n = $(document.createElement('span'))
                    .text(event + ' ' + label + "  ")
                    .addClass('notification')
                    .appendTo(notifications)
                    .fadeOut(3000, function() {
                        n.remove();
                    });
            }

            var getJson = function (b) {
                var result = $.fn.filterMultiSelect.applied
                    .map((e) => JSON.parse(e.getSelectedOptionsAsJson(b)))
                    .reduce((prev,curr) => {
                        prev = {
                            ...prev,
                            ...curr,
                        };
                        return prev;
                    });
                return result;
            }
            $('#jsonbtn2').click((e) => {
                var b = false;
                $('#jsonresult2').text(JSON.stringify(getJson(b),null,"  "));
            });
            $('#form').on('keypress keyup', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
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
