@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Blog Content
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('blog_active', 'menu-open')

@section('menu_active_blog', 'active bg-info')

@section('blog_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <form action="{{ route('update-blog-content') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="blog_id" value="{{ $blogContent->id }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_content_title" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Course Title"
                                value="{{ $blogContent->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-none">
                            <label for="templete_name">Templete Name</label>
                            <input type="text" name="templete_name" id="templete_name" class="form-control"
                                placeholder="Course Title" value="{{ $blogContent->templete_name }}">
                            @error('templete_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order">Content Order</label>
                            <input type="numbar" name="order" id="order" data-validation='required' class="form-control"
                                placeholder="Course Title" value="{{ $blogContent->order }}">
                            @error('order')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <a href="javascript:;" data-toggle="modal" id="preview_img_single"
                                data-target="#blog_content_file" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>

                            <a href="javascript:;" data-toggle="modal" id="preview_img_multiple"
                                data-target="#blog_content_file_multiple" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="file" id="inputImg" onchange="preview()" class="form-control"
                                value="{{ $blogContent->file }}">
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="old_img" value="{{ asset($blogContent->file) }}">
                        <input type="hidden" name="old_img_1" value="{{ asset($blogContent->file_1) }}">
                        <input type="hidden" name="old_img_2" value="{{ asset($blogContent->file_2) }}">
                        <div class="form-group">
                            <p id="para">Old Image</p>
                            <img width="250px" name="preview_img" id="preview_img"
                                style=" border: 2px solid gray; padding: 20px;" class="old_img"
                                src="{{ asset($blogContent->file) }}" alt="old image">

                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>


                        <div class="form-group" id="file_other">
                            <label for="file_1" class="form-label">File 1</label><a href="javascript:;"
                                data-toggle="modal" data-target="#file_1" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="file_1" id="inputImg1" onchange="blog_prview_1()"
                                class="form-control" placeholder="Course Title" value="{{ $blogContent->file_1 }}">

                        </div>
                        <div class="form-group">
                            <span>
                                <img src="" id="imgBlog1">
                            </span>
                        </div>
                        <div class="form-group" id="file_other_2">
                            <label for="file_2" class="form-label">File 2</label><a href="javascript:;"
                                data-toggle="modal" data-target="#file_2" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="file_2" id="inputImg2" onchange="blog_prview_2()"
                                class="form-control" placeholder="Course Title" value="{{ $blogContent->file_2 }}">
                        </div>
                        <div class="form-group">
                            <span>
                                <img src="" id="imgBlog2">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Content Design</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_content_design" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <select id="content_design" name="content_design" data-validation='required'
                                class="form-control select2" style="width: 100%;">
                                <option label="Choose one" selected disabled>Select One</option>
                                <option value="Left side"
                                    {{ 'Left side' == $blogContent->content_design ? 'selected' : '' }}>
                                    Left
                                    side
                                </option>
                                <option value="Right side"
                                    {{ 'Right side' == $blogContent->content_design ? 'selected' : '' }}>
                                    Right side</option>
                                <option value="Middle" {{ 'Middle' == $blogContent->content_design ? 'selected' : '' }}>
                                    Middle</option>
                                <option value="Top Three"
                                    {{ 'Top Three' == $blogContent->content_design ? 'selected' : '' }}>
                                    Top Three</option>
                                <option value="Right Three"
                                    {{ 'Right Three' == $blogContent->content_design ? 'selected' : '' }}>
                                    Right Three</option>
                            </select>
                            @error('content_design')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Content Design</label><a href="javascript:;" data-toggle="modal"
                                data-target="#blog_content_design" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <select name="file_type" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option label="Choose one" selected disabled>Select One</option>
                                <option value="Image" {{ 'Image' == $blogContent->file_type ? 'selected' : '' }}>
                                    Image
                                </option>
                                <option value="Video" {{ 'Video' == $blogContent->file_type ? 'selected' : '' }}>
                                    Video
                                </option>
                            </select>
                            @error('file_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image_alt">Image Alt</label>
                            <input type="numbar" name="image_alt" id="image_alt" data-validation='required'
                                class="form-control py-3 px-4 box pr-10 placeholder-theme-13 select2-show-search"
                                placeholder="Course Title" value="{{ $blogContent->image_alt }}">
                            @error('image_alt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea type="text" name="short_description" class="form-control textarea" cols="30"
                                rows="3">{{ $blogContent->short_description }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary">
                        Update</button>
                </div>
            </div>
        </div>
        @include('backend/theme/clasic/include/modal_photos/modal')
    </form>

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#file_other, #file_other_2, #imgBlog1, #imgBlog2, #preview_img_multiple").hide().css("padding", 0);
            value = $('#content_design').val();

            if (value == 'Top Three' || value == 'Right Three') {
                $("#file_other, #file_other_2,  #imgBlog1, #imgBlog2, #preview_img_multiple").show();
                $("#preview_img_single").hide();
            } else {
                $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
            }

            $('#content_design').change(function() {
                value = $(this).val();
                if (value == 'Top Three' || value == 'Right Three') {
                    $("#file_other, #file_other_2,  #imgBlog1, #imgBlog2, #preview_img_multiple").show();
                    $("#preview_img_single").hide();
                } else {
                    $("#file_other, #file_other_2, #imgBlog1, #imgBlog2").hide().css("padding", 0);
                }
            });
        })
    </script>
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
                document.querySelector("#preview_img").removeAttribute('src');
                document.querySelector("#preview_img").removeAttribute('alt');
                document.querySelector("#preview_img").removeAttribute('style');
                document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("reviewImg").style.cssText = `
                                border: 2px solid gray;
                                padding: 20px;
                                `;
            }
        }


        function blog_prview_1() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg1').files[0];

            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                var previewImg = $('#imgBlog1').attr('src', e.target.result).width(250).height(180);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        function blog_prview_2() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg2').files[0];

            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                var previewImg = $('#imgBlog2').attr('src', e.target.result).width(250).height(180);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
