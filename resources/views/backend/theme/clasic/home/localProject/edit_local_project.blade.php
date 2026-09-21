@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Our Local Projects
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('local_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Local Projects</h3>
            <a class="float-right" href="{{ route('local-project') }}">
                <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i>
                    Add Local Project</button>
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Alt</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach ($localProjects as $local)
                                <tr>
                                    <td> {{ $serial++ }}</td>

                                    <td>
                                        <img width="100px" src="{{ URL::asset($local->image) }}" alt="image">
                                    </td>
                                    <td>{{ $local->image_alt }}
                                    </td>
                                    <td>
                                        @if ($local->active_local == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- status --}}
                                        @if ($local->active_local == 1)
                                            <button title="Inactive" class="btn btn-danger btn-sm"> <a
                                                    class="flex items-center "
                                                    href="{{ url('local-inactive/' . $local->id) }}"> <i
                                                        class="fas fa-arrow-circle-down text-white"></i></a>
                                            </button>
                                        @else
                                            <button title="Active" class="btn btn-success btn-sm"> <a
                                                    class="flex items-center "
                                                    href="{{ url('local-active/' . $local->id) }}"> <i
                                                        class="fas fa-arrow-circle-up text-white"></i></a>
                                            </button>
                                        @endif
                                        {{-- edit --}}

                                        <button title="Edit" class="btn btn-primary btn-sm"> <a class="flex items-center "
                                                href="{{ url('local-project-edit/' . $local->id) }}"><i
                                                    class="fas fa-pencil-alt text-white"></i>
                                            </a>
                                        </button>
                                        {{-- delete --}}
                                        <button title="Delete" class="btn btn-danger btn-sm"><a class="flex items-center "
                                                id="delete" href="{{ url('local-project-delete/' . $local->id) }}"><i
                                                    class="fas fa-trash  text-white"></i></a>
                                        </button>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 id="insert_head" class="card-title text-center">Edit International Work</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('update-local-project') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="id" name="id" value="{{ $localProject->id }}">
                            <div class="card-body">
                                <div class="form-group">

                                    <label for="blog_id">Select Blog</label>
                                    <a href="javascript:;" data-toggle="modal" data-target="#one_blog"
                                        style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                    <select name="blog_id" data-validation='required' class="form-control select2"
                                        style="width: 100%;">
                                        <option label="Choose one blog" selected disabled>Select One</option>
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}"
                                                {{ $blog->id == $localProject->blog_id ? 'selected' : '' }}>
                                                {{ $blog->blog_title }}</option>
                                        @endforeach
                                    </select>
                                    @error('blog_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="inputImg">Upload Image</label>
                                    <a href="javascript:;" data-toggle="modal" data-target="#local_image"
                                        style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                    <input type="file" class="form-control" id="inputImg" onchange="preview()"
                                        name="image">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="hidden" name="old_img" value="{{ $localProject->image }}">
                                    <p id="para">Old Image</p>
                                    <img width="150px" id="old_img" style=" border: 2px solid gray; padding: 20px;"
                                        class="old_img" src="{{ asset($localProject->image) }}" alt="old image">

                                    <span>
                                        <img src="" id="reviewImg">
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="image_alt">Image Alt</label>
                                    <input class="form-control" id="image_alt" name="image_alt" type="text"
                                        placeholder="Enter image alt" data-validation='required'
                                        value="{{ $localProject->image_alt }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary align-top">
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                $('#reviewImg').attr('src', e.target.result).width(150).height(150);

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
