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
							<h4 class="content-title mb-0 my-auto">Add Coupon</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / Coupons</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a Coupon</h4>
                            <form action="{{route('admin-coupons.store')}}" method="POST" class="form-sample" enctype="multipart/form-data">
                                @csrf

                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-home"></i>Coupon Details</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Code
                                                </label>
                                                <input class="form-control" type="text" name="code" id="code" placeholder="Enter Coupon Code" value="{{ old('code') }}" required>
                                                @error("code")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Discount
                                                </label>
                                                <input class="form-control" type="number" name="discount" id="discount" placeholder="Add Discount Value" value="{{ old('discount') }}" required>
                                                @error("discount")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Number of Uses
                                                </label>
                                                <input class="form-control" type="number" name="uses" id="uses" placeholder="Enter # of Uses" value="{{ old('uses') }}" required>
                                                @error("uses")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Max # of Uses
                                                </label>
                                                <input class="form-control" type="number" name="max_uses" id="max_uses" placeholder="Max Number of Uses" value="{{ old('max_uses') }}" required>
                                                @error("max_uses")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Max Value
                                                </label>
                                                <input class="form-control" type="text" name="max_value" placeholder="Enter Max Value" id="max_value" value="{{ old('max_value') }}" required>
                                                @error("max_value")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1">Expiary Date
                                                </label>
                                                <input class="form-control" type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" required>
                                                @error("expires_at")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                <ul class="pro-submit" style="list-style:none;">
                                    <li>
                                        <button type="submit"  class="btn" style="background-color: black; color:pink;">Save Coupon</button>
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
