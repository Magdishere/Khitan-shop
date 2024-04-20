
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Add New Post
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
                                        <span class="text-xl px-2 pt-5 text-bold">Add New Post</span>
                                    </div>

                                <div class="col-md-6">
                                    <a href="{{route('blog')}}" class="btn float-end"><i class="fas fa-arrow-left"></i> All Posts</a>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('message'))
                                    <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                                @endif
                                <form wire:submit.prevent="addPost">

                                    <div class="mb-3 mt-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title" wire:model="title" wire:keyup="generateSlug" />
                                        @error('title')
                                            <p class="text-danger"></p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" name="slug" class="form-control" placeholder="Enter Category Slug" wire:model="slug" />
                                        @error('slug')
                                            <p class="text-danger"></p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" placeholder="Enter Description" class="form-label" wire:model="description"></textarea>
                                        @error('description')
                                            <p class="text-danger"></p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" wire:model="image_path"/>
                                        @error('image_path')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        @if($image_path)
                                            <img src="{{$image_path->temporaryUrl()}}" width="120"/>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn submit-btn float-end"><i class="fa fa-plus"></i> Add Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
