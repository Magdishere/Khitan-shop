<div>
    <style>
        nav svg{

            height: 20px;
        }
        nav .hidden{
            display: block;
        }

    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Blog
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="container bg-white pt-5">
                        <div class="row blog-item px-3 pb-20">
                            @foreach($posts as $post)
                            <div class="col-md-6">
                                <img class="img-fluid mb-25 mb-md-0" src="{{asset('assets/imgs/blog/')}}/{{$post->image_path}}" alt="Image">
                            </div>
                            <div class="col-md-6">
                                <h2 class="mt-md-4 mb-2 py-2 bg-white font-weight-bold">{{$post->title}}</h2>
                                <div class="d-flex mb-3">
                                    <small class="mr-2 text-muted"><i class="fa fa-calendar-alt"></i> {{$post->created_at}}</small>
                                    <small class="mr-2 text-muted"><i class="fa fa-folder"></i> {{$post->user->name}}</small>
                                    {{-- <small class="mr-2 text-muted"><i class="fa fa-comments"></i> 15 Comments</small> --}}
                                </div>
                                <p>
                                    {{$post->description}}
                                </p>
                                <a class="btn btn-md p-2" href="">Read More  <i class="fa fa-angle-right"></i></a>
                            </div>
                            @endforeach
                        </div>
                        <div class="row px-3 pb-5">
                            <nav aria-label="Page navigation">
                              <ul class="pagination m-0 mx-3">
                                <li class="page-item disabled">
                                  <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

