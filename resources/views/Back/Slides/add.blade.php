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
							<h4 class="content-title mb-0 my-auto">Add Slide</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Slides</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Slide</h4>
                            <form action="{{route('admin-slides.store')}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Slide Image</label>
                                    <input type="file" name="image" id="image" accept="image/*" >
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i>Slide Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Title
                                                </label>
                                                <input class="form-control" type="text" name="title_en" id="title_en" value="{{ old('name.en') }}" required>
                                                @error("title_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">العنوان
                                                </label>
                                                <input class="form-control" type="text" name="title_ar" id="title_ar" value="{{ old('name.ar') }}" required>
                                                @error("title_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Description
                                                </label>
                                                <input class="form-control" type="text" name="description_en" id="description_en" value="{{ old('name.en') }}" required>
                                                @error("description_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">الوصف
                                                </label>
                                                <input class="form-control" type="text" name="description_ar" id="description_ar" value="{{ old('name.ar') }}" required>
                                                @error("description_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Button Content
                                                </label>
                                                <input class="form-control" type="text" name="link_en" id="link_en" value="{{ old('name.en') }}" required>
                                                @error("link_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">محتوى الزر
                                                </label>
                                                <input class="form-control" type="text" name="link_ar" id="link_ar" value="{{ old('name.ar') }}" required>
                                                @error("link_ar")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <ul class="pro-submit" style="list-style:none;">
                                    <li>
                                        <button type="submit"  class="btn" style="background-color: black; color:pink;">Save Slide</button>
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
