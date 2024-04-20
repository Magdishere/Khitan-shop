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
							<h4 class="content-title mb-0 my-auto">Add Thread</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Threads</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Thread</h4>
                            <form action="{{route('admin-strings.store')}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Thread Image</label>
                                    <input type="file" name="image" id="image" accept="image/*" >
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-body">

                                    <h4 class="form-section"><i class="ft-home"></i>Thread Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Brand
                                                </label>
                                                <input class="form-control" type="text" name="brand" id="brand" value="{{ old('brand') }}" required>
                                                @error("brand")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Material
                                                </label>
                                                <input class="form-control" type="text" name="material" id="material" value="{{ old('material') }}" required>
                                                @error("material")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Length
                                                </label>
                                                <input class="form-control" type="text" name="length" id="length" value="{{ old('length') }}" required>
                                                @error("length")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Weight
                                                </label>
                                                <input class="form-control" type="text" name="weight" id="weight" value="{{ old('weight') }}" required>
                                                @error("weight")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="projectinput1">Color
                                                </label>
                                                <input class="form-control" type="text" name="color" id="color" value="{{ old('color') }}" required>
                                                @error("color")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <ul class="pro-submit" style="list-style:none;">
                                    <li>
                                        <button type="submit"  class="btn" style="background-color: black; color:pink;">Save Thread</button>
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
