@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Coupons</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Coupons</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">COUPONS TABLE</h4>
                        <a class="btn add-btn"  href="{{route('admin-coupons.create')}}"><i class="fa fa-plus"></i> Add Coupon</a>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">All Coupons</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0 text-center">#</th>
                                    <th class="wd-20p border-bottom-0 text-center">Code</th>
                                    <th class="wd-15p border-bottom-0 text-center">Discount</th>
                                    <th class="wd-20p border-bottom-0 text-center">Max Value</th>
                                    <th class="wd-15p border-bottom-0 text-center"># of uses</th>
                                    <th class="wd-10p border-bottom-0 text-center">Max Uses</th>
                                    <th class="wd-10p border-bottom-0 text-center">Expiray Date</th>
                                    <th class="wd-10p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">{{ $coupon->code }}</td>
                                        <td class="text-center">{{ $coupon->discount }}</td>
                                        <td class="text-center">{{ $coupon->max_value }}</td>
                                        <td class="text-center">{{ $coupon->uses }}</td>
                                        <td class="text-center">{{ $coupon->max_uses }}</td>
                                        <td class="text-center">{{ $coupon->expires_at }}</td>
                                        <td class="text-center" class="text-center">
                                            <a class="modal-effect btn btn-sm btn-warning" href="{{route('admin-coupons.edit', $coupon->id)}}"><i class="fa fa-edit"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$coupon->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @include('Back.Coupons.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    })
</script>
@endsection
