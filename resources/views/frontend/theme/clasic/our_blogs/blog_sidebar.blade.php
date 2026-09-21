<div class="col-md-4">
    <div class="mb-5">
        <h5 class="mb-3">Categories</h5>
        <ul class="list-group">
            @foreach ($blogCategory as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    @php
                        $cat_slug = str_replace(' ', '-', $category->category_name);
                        $catUnderBlog = countBlogCategry($category->category_name);
                    @endphp
                    {{-- <a href="{{ route('blog-category-details', [$cat_slug]) }}"
                        class="text-dark">{{ $category->category_name }}</a> --}}

                    <a href="{{ url('our-blogs/' . $cat_slug) }}"
                        class="text-dark">{{ $category->category_name }}</a>
                    <span class="badge badge-warning badge-pill">
                        {{ $catUnderBlog }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class=" mb-5">
        <h5 class="mb-3">Recent Posts</h5>
        @foreach ($resentBlogs as $blog)
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                @php
                    // $blog_slug = str_replace(' ', '-', $blog->blog_title);
                    $blog_slug = $blog->slug_title;
                @endphp
                <a href="{{ url('our-blogs/' . $blog_slug) }}" class="text-dark">{{ $blog->blog_title }}</a>
            </li>
        @endforeach

        </ul>
    </div>
    <div class="mb-5">
        <h5 class="mb-3">Archives</h5>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center ">
                <a href="" class="text-dark">Graphic Design</a>
                <span class="badge badge-warning badge-pill">09</span>
            </li>
        </ul>
    </div>
</div>
