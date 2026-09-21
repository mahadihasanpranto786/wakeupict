@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Create Blog
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('blog_active', 'menu-open')

@section('menu_active_blog', 'active bg-info')

@section('create_blog_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <form action="{{ route('store-blog') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="category_id">Category</label> <a href="javascript:;" data-toggle="modal"
                                data-target="#blog_category_count" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <select name="category_id" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option label="Choose one" selected disabled>Select One</option>
                                @foreach ($blogCategory as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="blog_title">Blog Title</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_title_main" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="blog_title" id="blog_title" data-validation='required'
                                class="form-control" placeholder="Enter Blog Title" value="{{ old('blog_title') }}">
                            @error('blog_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image_alt">Image Alt</label>
                            <input type="text" name="image_alt" id="image_alt" data-validation='required'
                                class="form-control" placeholder="Enter Image Alt" value="{{ old('image_alt') }}">
                            @error('image_alt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="headerImg" class="form-label">Header
                                Image</label><a href="javascript:;" data-toggle="modal" data-target="#blog_header_image"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                            <input id="headerImg" onchange="previewheader()" name="header_image" type="file"
                                class="form-control" value="{{ old('header_image') }}">
                            @error('header_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <span>
                                <img src="" id="headerReview">
                            </span>
                        </div>
                        <div class="d-none">
                            <label for="templete_name">Templete Name</label>
                            <input type="text" name="templete_name" id="templete_name" class="form-control"
                                placeholder="Course Title" value="{{ old('templete_name') }}">
                            @error('templete_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="blog_image">Thumbnail</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_thumbnail" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="blog_image" id="inputImg" data-validation='required'
                                onchange="preview()" class="form-control" placeholder="image"
                                value="{{ old('blog_image') }}">
                            @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>



                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug_title">Slug Title(url)</label><a href="javascript:;" data-toggle="modal"
                                data-target="#slug_title_main" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="slug_title" id="slug_title" class="form-control"
                                placeholder="Slug Title" value="{{ old('slug_title') }}" data-validation='required'>
                            @error('slug_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="update_time">Update Time</label><a href="javascript:;" data-toggle="modal"
                                data-target="#updated_time" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="date" name="update_time"
                                class="datepicker form-control py-3 px-4 box pr-10 placeholder-theme-13"
                                data-single-mode="true" placeholder="Update Time" value="{{ old('update_time') }}"
                                data-validation='required'>
                            @error('update_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="footer_title">Footer Title</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_footer_title" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="footer_title" id="footer_title" class="form-control"
                                placeholder="Entar footer Title" value="{{ old('footer_title') }}"
                                data-validation='required'>
                            @error('footer_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="creator_name">Creator Name</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_creator_name" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="creator_name" id="creator_name" class="form-control"
                                placeholder="Enter Crator name" value="{{ old('creator_name') }}"
                                data-validation='required'>
                            @error('creator_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="short_description">Short Description</label><a href="javascript:;"
                                data-toggle="modal" data-target="#blog_short_description"
                                style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                            <textarea type="text" name="short_description" class="textarea form-control" cols="30"
                                rows="3">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary">
                            Insert</button>
                    </div>
                </div>
            </div>
            @include(
                'backend/theme/clasic/include/modal_photos/modal'
            )
    </form>

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        function preview() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#reviewImg').attr('src', e.target.result).width(150).height(150);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                // document.querySelector("#old_img").removeAttribute('src');
                // document.querySelector("#old_img").removeAttribute('alt');
                // document.querySelector("#old_img").removeAttribute('style');
                // document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("reviewImg").style.cssText = `
                            border: 2px solid gray;
                            padding: 20px;
                            `;
            }
        }
    </script>
    <script>
        function previewheader() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#headerImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#headerReview').attr('src', e.target.result).width(150).height(150);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                // document.querySelector("#old_img").removeAttribute('src');
                // document.querySelector("#old_img").removeAttribute('alt');
                // document.querySelector("#old_img").removeAttribute('style');
                // document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("headerReview").style.cssText = `
                    border: 2 px solid gray; padding: 20 px;
                    `;
            }
        }
    </script>
    <script>
        $("#slug_title").blur(function() {

            var slug = $('#slug_title').val();
            // alert(slug);
            // var slug_lowar = slug.toLowerCase();
            const blog_slug = slug.replace(/\s/g, '-');

            if (blog_slug) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    datatype: 'json',

                    url: "{{ url('/blog-slug') }}/" + blog_slug,
                    success: function(data) {
                        if (data == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Your Slug Is Not Unique!',
                            })
                            $('#slug_title').val('');
                        }

                    },

                    error: function(data, textStatus, errorThrown) {
                        console.log(data);
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill the Blog Slug!',
                })
            }
        });
    </script>
@endsection
