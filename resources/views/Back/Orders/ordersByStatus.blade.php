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
                <h4 class="content-title mb-0 my-auto">Orders</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ ucfirst($status) }} Orders</span>
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
                        <h4 class="card-title mg-b-0">ORDERS TABLE</h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">{{ ucfirst($status) }} Orders</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example">
                            <thead class="">
                                <tr>
                                    <th class="wd-5p border-bottom-0 text-center">#</th>
                                    <th class="wd-15p border-bottom-0 text-center">Client</th>
                                    <th class="wd-10p border-bottom-0 text-center">Subtotal</th>
                                    <th class="wd-10p border-bottom-0 text-center">Discount</th>
                                    <th class="wd-10p border-bottom-0 text-center">Total</th>
                                    <th class="wd-10p border-bottom-0 text-center">Status</th>
                                    <th class="wd-10p border-bottom-0 text-center">Full Address</th>
                                    <th class="wd-10p border-bottom-0 text-center">Email</th>
                                    <th class="wd-10p border-bottom-0 text-center">Phone Number</th>
                                    <th class="wd-10p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $order->firstname }} {{ $order->lastname }}</td>
                                    <td class="text-center">${{ $order->subtotal }}</td>
                                    <td class="text-center">${{ $order->discount }}</td>
                                    <td class="text-center">${{ $order->total }}</td>
                                    <td class="text-center
                                        @if($order->status == 'delivered')
                                            text-success
                                        @elseif($order->status == 'canceled')
                                            text-danger
                                        @else
                                            text-warning
                                        @endif">
                                        <strong>{{ strtoupper($order->status) }}</strong>
                                    </td>
                                    <td class="text-center">{{ $order->country }} - {{ $order->state }} - {{ $order->city }} - {{ $order->street_address }}</td>
                                    <td class="text-center">{{ $order->email}}</td>
                                    <td class="text-center">{{ $order->zipcode}}-{{$order->mobile}}</td>
                                    <td class="text-center">
                                        <a class="modal-effect btn btn-sm btn-warning" data-effect="effect-scale" data-toggle="modal" href="#edit{{$order->id}}"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-toggle="modal" href="#delete{{ $order->id }}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @include('Back.Orders.edit')
                                @include('Back.Orders.delete')
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

