@extends('layouts.master')
@section('title')
    {{trans('admin-assets/main-sidebar_trans.Cars Models')}}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('admin-assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    {{-- <style>
        .btn-section{
            background-color: #F77D0A !important;
            color: #2B2E4A !important;
        }
    </style> --}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Sales</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ All Sales</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a class="btn" style="background-color: black; color:pink;" href="{{route('admin-sales.create')}}"><i class="fa fa-plus"></i> Add Sale</a>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">SALES TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Type</th>
                                    <th class="wd-20p border-bottom-0">Name</th>
                                    <th class="wd-15p border-bottom-0">Start Date</th>
                                    <th class="wd-15p border-bottom-0">End Date</th>
                                    <th class="wd-10p border-bottom-0">Banner</th>
                                    <th class="wd-10p border-bottom-0">Position</th>
                                    <th class="wd-10p border-bottom-0">Flash Sale</th>
                                    <th class="wd-10p border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $sale->target_type }}</td>
                                        <td>{{$sale->name}}</td>
                                        <td>{{$sale->start_date}}</td>
                                        <td>{{$sale->end_date}}</td>
                                        <td><image src="{{$sale->banner}}"></image></td>
                                        <td>{{$sale->position }}</td>
                                        <td>{{$sale->isFlashSaleActive() }}</td>
                                        <td>{{$sale->isActive() }}</td>
                                        <td></td>
                                        <td class="text-center">
                                            <a class="modal-effect btn btn-sm btn-warning" href="{{route('admin-sales.edit', $sale->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete"><i class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @include('Back.Sales.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

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
