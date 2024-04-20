@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Slides</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Slides</span>
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
                        <h4 class="card-title mg-b-0">SLIDES TABLE</h4>
                        <a class="btn add-btn"  href="{{route('admin-slides.create')}}"><i class="fa fa-plus"></i> Add Slide</a>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">All Slides</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0 text-center">#</th>
                                    <th class="wd-15p border-bottom-0 text-center">Slide Image</th>
                                    <th class="wd-20p border-bottom-0 text-center">Slide Title</th>
                                    <th class="wd-15p border-bottom-0 text-center">Description</th>
                                    <th class="wd-10p border-bottom-0 text-center">Link</th>
                                    <th class="wd-10p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slides as $slide)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center"><img src="{{ asset('../admin-assets/uploads/images/slides/' . $slide->image) }}" alt="Slide Image" style="max-width: 50px;"></td>
                                        <td class="text-center">{{ $slide->title }}</td>
                                        <td class="text-center">{{ $slide->description }}</td>
                                        <td class="text-center">{{ $slide->link }}</td>
                                        <td class="text-center" class="text-center">
                                            <a class="modal-effect btn btn-sm btn-warning" href="{{route('admin-slides.edit', $slide->id)}}"><i class="fa fa-edit"></i>Edit</a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$slide->id}}"><i class="fa fa-trash"></i>Delete</a>
                                        </td>
                                    </tr>
                                    @include('Back.Slides.delete')
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
