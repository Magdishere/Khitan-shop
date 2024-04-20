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
                        <h4 class="content-title mb-0 my-auto">Edit Slide</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Slides</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Slide</h4>
                            <form action="{{route('admin-slides.update', $slide->id)}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                @if($slide->exists)
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label>Slide Image</label>
                                    <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(this)">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @if($slide->image)
                                        <img id="image-preview" src="{{ asset('../admin-assets/uploads/images/slides/' . $slide->image) }}" style="width: 150px; height: 100px" alt="Slide Image">
                                    @else
                                        <img id="image-preview" style="width: 150px; height: 100px" alt="No Image">
                                    @endif

                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i>Slide Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Title (English)</label>
                                                <input class="form-control" type="text" name="title_en" id="title_en" value="{{ $slide->translate('en')->title }}" required>
                                                @error("title_en")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Title (Arabic)</label>
                                                <input class="form-control" type="text" name="title_ar" id="title_ar" value="{{ $slide->translate('ar')->title }}" required>
                                                @error("title_ar")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Description
                                                </label>
                                                <input class="form-control" type="text" name="description_en" id="description_en" value="{{ $slide->translate('en')->description }}" required>
                                                @error("description_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">الوصف
                                                </label>
                                                <input class="form-control" type="text" name="description_ar" id="description_ar" value="{{ $slide->translate('ar')->description }}" required>
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
                                                <input class="form-control" type="text" name="link_en" id="link_en" value="{{ $slide->translate('en')->link }}" required>
                                                @error("link_en")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">محتوى الزر
                                                </label>
                                                <input class="form-control" type="text" name="link_ar" id="link_ar" value="{{ $slide->translate('ar')->link }}" required>
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
