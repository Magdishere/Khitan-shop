@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('admin-assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Reviews</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Reviews</span>
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
                        <h4 class="card-title mg-b-0">REVIEWS TABLE</h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">All Reviews</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0 text-center">#</th>
                                    <th class="wd-20p border-bottom-0 text-center">User</th>
                                    <th class="wd-15p border-bottom-0 text-center">Product</th>
                                    <th class="wd-20p border-bottom-0 text-center">Rating</th>
                                    <th class="wd-20p border-bottom-0 text-center">Comment</th>
                                    <th class="wd-10p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">{{ $review->user->name }}</td>
                                        <td class="text-center">{{ $review->product->name }}</td>
                                        <td class="text-center">{{ $review->rating }}</td>
                                        <td class="text-center">{{ $review->comment }}</td>
                                        <td class="text-center" class="text-center">
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$review->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @include('Back.Reviews.delete')
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

    <!-- Internal Data tables -->
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('admin-assets/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('admin-assets/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('admin-assets/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
