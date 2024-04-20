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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="attribute_name_en">Choose a product</label>
                                                <select name="product_id" class="form-control" required>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error("product_id")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="attribute_option_id">Attribute:</label>
                                                <select name="attribute_option_id" class="form-control" required>
                                                    @foreach($attributeOptions as $attributeOption)
                                                        <option value="{{ $attributeOption->id }}">{{ $attributeOption->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error("attribute_option_id")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Price:</label>
                                                <input type="text" name="price" class="form-control" required>
                                                @error("price")
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_default">Is Default:</label>
                                        <input type="checkbox" name="is_default" class="form-check-input">
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
