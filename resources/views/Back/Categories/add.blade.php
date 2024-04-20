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
							<h4 class="content-title mb-0 my-auto">Add Category </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Categories</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Category</h4>
                            <form action="{{route('Admin-Categories.store')}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input type="file" name="category_image" class="file-upload custom-file-input hidden" id="input_scr" onchange="previewFile()" hidden>
                                    <label class="border-0 mb-0 cursor" for="restaurant-logo">
                                        <img src="{{asset('admin-assets/img/camera-icon.png')}}" id="img_scr" alt="img" class="img-fluid" style="width: 130px; height: 130px">
                                        <span id="img_here"></span>
                                        <img src="{{asset('admin-assets/img/camera-icon.png')}}" id="img_scr" alt="img" class="provider-rest-img d-none" style="width: 130px; height: 130px">

                                        <span class="file-custom"></span>
                                    </label>
                                    @error('category_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i>Category Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Category Name
                                                </label>
                                                <input class="form-control" type="text" name="name_en" id="name_en" value="{{ old('name.en') }}" required>
                                                @error("name_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">اسم القسم
                                                </label>
                                                <input class="form-control" type="text" name="name_ar" id="name_ar" value="{{ old('name.ar') }}" required>
                                                @error("name_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="projectinput1">Slug
                                            </label>
                                            <input type="text" id="name"
                                                class="form-control"
                                                placeholder="  "
                                                value="{{old('slug')}}"
                                                name="slug">
                                            @error("slug")
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div>
                                        <input type="radio" name="type" id="radio2" class="radio" value="1" checked/>
                                        <label for="radio2">Main Category</label>
                                    </div>
                                    @error("type")
                                    <span class="text-danger">{{$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <div>
                                        <input type="radio" name="type" id="radio3" class="radio" value="2"/>
                                        <label for="radio3">Sub-category</label>
                                        @error("type")
                                        <span class="text-danger">{{$message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                    <div class="row hidden" id="cats_list" >
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">Select Main Category
                                                </label>
                                                <select name="parent_id" class="select2 form-control">
                                                    <optgroup label="Please Select Main Category">
                                                        @if($categories && $categories -> count() > 0)
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{$category -> id }}">{{$category -> name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error('parent_id')
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>


                                <ul class="pro-submit" style="list-style:none;">
                                    <li>
                                        <button type="submit"  class="btn" style="background-color: black; color:pink;">Save Category</button>
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
