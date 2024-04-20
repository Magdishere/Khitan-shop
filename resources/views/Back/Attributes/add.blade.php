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
                        <h4 class="content-title mb-0 my-auto">Add Attributes </h4>
                        <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Attributes</span>
                    </div>
                </div>
            </div>
            <!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add an Attribute</h4>
                            <form action="{{ route('admin-attributes.store') }}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-home"></i>Attribute Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="attribute_name_en">Attribute Name (English)</label>
                                                <input class="form-control" type="text" name="name_en" id="attribute_name_en" value="{{ old('name_en') }}" required>
                                                @error("name_en")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="attribute_name_ar">Attribute Name (Arabic)</label>
                                                <input class="form-control" type="text" name="name_ar" id="attribute_name_ar" value="{{ old('name_ar') }}" required>
                                                @error("name_ar")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="options_list">
                                        <h4 class="form-section"><i class="ft-home"></i>Options Details</h4>
                                        <div id="optionTemplate" class="col-md-12">
                                            <!-- Option Template Content -->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <input type="file" name="option_image[]" class="file-upload custom-file-input" id="input_option_image1" onchange="previewFile(1)">
                                                        <label class="border-0 mb-0 cursor" for="option_image1">
                                                            <img src="{{ asset('admin-assets/img/camera-icon.png') }}" id="img_option_image1" alt="img" class="img-option-image-class img-fluid" style="width: 50px; height: 50px">
                                                            <span id="img_here1"></span>
                                                            <img src="{{ asset('admin-assets/img/camera-icon.png') }}" id="img_op" alt="img" class="provider-rest-img d-none" style="width: 50px; height: 50px">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('option_image.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-11">
                                                        <div class="input-group">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="option_name_en1">Option Name (English)</label>
                                                                    <input class="form-control" type="text" name="option_name_en[]" value="{{ old('option_name.en') }}" required>
                                                                    @error("option_name_en.*")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="option_name_ar1">Option Name (Arabic)</label>
                                                                    <input class="form-control" type="text" name="option_name_ar[]" value="{{ old('option_name.ar') }}" required>
                                                                    @error("option_name_ar.*")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="input-group-append m-5">
                                                                <a href="#" class="header-icons" onclick="removeOption(1)">
                                                                    <i class="header-icons fe fe-x"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @error("option_name_en.*")
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#" id="moreOptions">More Options +</a>
                                        </div>
                                    </div>

                                    <ul class="pro-submit" style="list-style:none;">
                                        <li>
                                            <button type="submit" class="btn" style="background-color: black; color:pink;">Save Attribute</button>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            let optionCounter = 2;

            $('a#moreOptions').click(function (e) {
                e.preventDefault();
                optionCounter++;
                addOptionFields(optionCounter);
            });
        });

        function addOptionFields(counter) {
            let clone = $('#optionTemplate').clone();
            clone.attr('id', 'optionSet' + counter);

            // Update IDs and attributes accordingly for the cloned elements
            clone.find('.file-upload').attr('id', 'input_option_image' + counter).attr('onchange', 'previewFile(' + counter + ')');
            clone.find('.img-option-image-class').attr('id', 'img_option_image' + counter);
            clone.find('.option-name-en').attr('id', 'option_name_en' + counter);
            clone.find('.option-name-ar').attr('id', 'option_name_ar' + counter);
            clone.find('.img-here').attr('id', 'img_here' + counter);

            clone.find('.input-group-append').attr('onclick', 'removeOption(' + counter + ')');
            clone.removeClass('d-none');

            $('#options_list').append(clone);
        }

        function removeOption(counter) {
            $('#optionSet' + counter).remove();
        }

        function previewFile(counter) {
            var input = document.getElementById('input_option_image' + counter);
            var img = document.getElementById('img_option_image' + counter);
            var imgHere = document.getElementById('img_here' + counter);

            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                img.src = reader.result;
                imgHere.innerHTML = 'New Image Selected';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        function triggerInput(counter) {
            $('#input_option_image' + counter).click();
        }
    </script>
@endsection
