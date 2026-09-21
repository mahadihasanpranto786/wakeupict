@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Development Project
@endsection
{{-- menu active start --}}

@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('project_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('update-development-project') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <a type="button" data-toggle="modal" data-target="#development_title"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                value="{{ $project->title }}" data-validation='required'>
                            @error('title')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="blog_id">Select Blog</label>
                            <a type="button" data-toggle="modal" data-target="#one_blog"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                            <select name="blog_id" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option label="Choose one blog" selected disabled>Select One</option>
                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}"
                                        {{ $blog->id == $project->blog_id ? 'selected' : '' }}>{{ $blog->blog_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('blog_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="logo">Select Logo</label>
                            <a type="button" data-toggle="modal" data-target="#development_logo"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                            <select name="logo" data-validation='required' class="form-control select2"
                                style="width: 100%;">
                                <option label="Choose Logo" selected disabled>Select One</option>
                                @foreach ($icons as $icon)
                                    <option value="{{ $icon->icon }}"
                                        {{ $icon->icon == $project->logo ? 'selected' : '' }}
                                        data-icon="{{ $icon->icon }}">{{ $icon->icon }}
                                    </option>
                                @endforeach
                            </select>
                            @error('logo')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputImg">Upload Image</label>
                            <a type="button" data-toggle="modal" data-target="#development_image"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>

                            <input type="file" class="form-control" name="image" id="inputImg" onchange="preview()"
                                placeholder="image" value="{{ $project->image }}">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="old_img" value="{{ $project->image }}">
                            <p id="para">Old Image</p>
                            <img width="250px" id="old_img" style=" border: 2px solid gray; padding: 20px;"
                                class="old_img" src="{{ asset($project->image) }}" alt="old image">

                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>


                        <div class="form-group">
                            <label for="image_alt">Image alt</label>
                            <input type="text" name="image_alt" id="image_alt" class="form-control"
                                placeholder="Enter Image Alt" value="{{ $project->image_alt }}" data-validation='required'>
                            @error('image_alt')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="description">Description</label>
                            <a type="button" data-toggle="modal" data-target="#development_description"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                            <textarea type="text" name="description" class="form-control textarea" cols="30" rows="3">{{ $project->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- /.card-body -->

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
    <script>
        function preview() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#reviewImg').attr('src', e.target.result).width(250).height(180);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                document.querySelector("#old_img").removeAttribute('src');
                document.querySelector("#old_img").removeAttribute('alt');
                document.querySelector("#old_img").removeAttribute('style');
                document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("reviewImg").style.cssText = `
                        border: 2px solid gray;
                        padding: 20px;
                        `;
            }
        }
    </script>

@endsection
