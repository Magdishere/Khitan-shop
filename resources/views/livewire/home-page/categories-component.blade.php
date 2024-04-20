<div>
    <section class="product spad">
        <div class="container-fluid">
            <div class="container">
                <div class="owl-carousel categories-carousel">
                    @foreach($categories as $category)
                    <div class="category-item">
                        <div class="circle-container">
                            <img src="{{ asset('admin-assets/uploads/images/categories/' . $category->image_path) }}" alt="Category Logo" class="img-inside-circle">
                        </div>
                        <h5 class="text-center pt-5 cat-name-text">
                            <a href="{{ route('category', ['id' => $category->id]) }}" class="cat-name-text">{{ $category->name }}</a> <!-- Link to the category route with the category ID -->
                        </h5>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
