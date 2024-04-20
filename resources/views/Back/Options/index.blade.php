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
                            <h4 class="card-title">Attributes and Options</h4>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Attribute ID</th>
                                    <th>Attribute Name (English)</th>
                                    <th>Attribute Name (Arabic)</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(json_decode($attributes, true) as $attribute)
                                    <tr>
                                        <td>{{ $attribute['id'] }}</td>
                                        <td>{{ $attribute['translations'][0]['name'] }}</td>
                                        <td>{{ $attribute['translations'][1]['name'] }}</td>
                                        <td>
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Option ID</th>
                                                    <th>Option Image</th>
                                                    <th>Option Name (English)</th>
                                                    <th>Option Name (Arabic)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($attribute['options'] as $option)
                                                    <tr>
                                                        <td>{{ $option['id'] }}</td>
                                                        <td><img style="width: 40px; height: 40px" src="{{ asset('/admin-assets/uploads/images/options/' . $option['image']) }}" alt="Option Image"></td>
                                                        <td>{{ $option['translations'][0]['value'] }}</td>
                                                        <td>{{ $option['translations'][1]['value'] }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

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
            clone.find('.img-option-image').attr('id', 'img_option_image' + counter).attr('onclick', 'triggerInput(' + counter + ')');
            clone.find('.option-name-en').attr('id', 'option_name_en' + counter);
            clone.find('.option-name-ar').attr('id', 'option_name_ar' + counter);

            clone.find('.file-upload').attr('id', 'input_option_image' + counter);
            clone.find('.img-option-image').attr('id', 'img_option_image' + counter);
            clone.find('.option-name-en').attr('id', 'option_name_en' + counter);
            clone.find('.option-name-ar').attr('id', 'option_name_ar' + counter);

            clone.find('.input-group-append').attr('onclick', 'removeOption(' + counter + ')');
            clone.removeClass('d-none');

            $('#options_list').append(clone);
        }

        function removeOption(counter) {
            $('#optionSet' + counter).remove();
        }
    </script>

    <script>
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
