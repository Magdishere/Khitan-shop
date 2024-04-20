<style>
    nav svg{
        height: 20px;
    }
    nav .hidden{
        display: block;
    }
    th{
        color: hsl(330, 80%, 61%) !important;
    }
    .edit-link{
        color: hsl(330, 81%, 29%) !important;

    }
</style>
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> All Posts
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header  bg-white rounded-lg">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-xl px-2 text-bold">All Posts</span>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('admin.add.blog.post.add')}}" class="btn float-end"><i class="fa fa-plus"></i> Add New Post</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                <table class="min-w-full">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="py-3 px-6 text-left font-bold text-center ">#</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">Image</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">Title</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">Slug</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">Date</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">User</th>
                                            <th class="py-3 px-6 text-left font-bold text-center ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach($posts as $post)
                                            <tr class="hover:bg-gray-100">
                                                <td class="py-4 px-6 text-center">{{++$i}}</td>
                                                <td class="py-4 px-6 text-center"><img src="{{asset('assets/imgs/blog')}}/{{$post->image_path}}" style="width: 50px;"/></td>
                                                <td class="py-4 px-6 text-center">{{$post->title}}</td>
                                                <td class="py-4 px-6 text-center">{{$post->slug}}</td>
                                                <td class="py-4 px-6 text-center">{{$post->created_at}}</td>
                                                <td class="py-4 px-6 text-center">{{$post->user->name}}</td>
                                                <td class="py-4 px-6 text-center">
                                                    <a href="{{ route('admin.posts.edit', ['post_id' => $post->id])}}" class="edit-link text-bold">Edit</a>
                                                    <a href="#" class="text-danger" onclick="deleteConfirmation({{$post->id}})" style="margin-left: 20px">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{$categories->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Are you sure you want to delete post?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deletePost()">Yes, Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('post_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deletePost(){
            @this.call('deletePost');
            $('#deleteConfirmation').modal('hide');

        }
    </script>
@endpush
