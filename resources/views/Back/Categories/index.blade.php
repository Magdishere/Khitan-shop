@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Categories</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ All Categories</span>
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
                        <h4 class="card-title mg-b-0">CATEGORIES TABLE</h4>
                        <a class="btn add-btn"  href="{{route('Admin-Categories.create')}}"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">All Categories</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-bordered">
                            <thead class="">
                                <tr>
                                    <th class="wd-15p border-bottom-0 text-center">#</th>
                                    <th class="wd-15p border-bottom-0 text-center">Category Image</th>
                                    <th class="wd-20p border-bottom-0 text-center">Name</th>
                                    <th class="wd-15p border-bottom-0 text-center">Slug</th>
                                    <th class="wd-15p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center"><img src="{{ asset('../admin-assets/uploads/images/categories/' . $category->image_path) }}" alt="Category Image" style="max-width: 50px;"></td>
                                        <td class="text-center">{{$category->name}}</td>
                                        <td class="text-center">{{$category->slug}}</td>
                                        <td class="text-center">
                                            <a class="modal-effect btn btn-sm btn-warning" href="{{route('Admin-Categories.edit', $category->id)}}"><i class="fa fa-edit"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$category->id}}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @include('Back.Categories.delete')
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
@endsection
