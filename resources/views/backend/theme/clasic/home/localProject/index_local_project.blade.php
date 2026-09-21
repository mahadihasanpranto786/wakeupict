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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="my-2">
                        @if (checkUserType() == 0)
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#localProjectHeader">
                                Update Header
                            </button>
                        @endif
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Alt</th>
                                <th>Status</th>
                                @if (checkUserType() == 0)
                                    <th>Action</th>
                                @endif
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
                                    @if (checkUserType() == 0)
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

                                            <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                    class="flex items-center "
                                                    href="{{ url('local-project-edit/' . $local->id) }}"><i
                                                        class="fas fa-pencil-alt text-white"></i>
                                                </a>
                                            </button>
                                            {{-- delete --}}
                                            <button title="Delete" class="btn btn-danger btn-sm"><a
                                                    class="flex items-center " id="delete"
                                                    href="{{ url('local-project-delete/' . $local->id) }}"><i
                                                        class="fas fa-trash  text-white"></i></a>
                                            </button>


                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (checkUserType() == 0)
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 id="insert_head" class="card-title text-center">Insert International Work</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{ route('insert-local-project') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">

                                        <label for="blog_id">Select Blog</label>
                                        <a href="javascript:;" data-toggle="modal" data-target="#one_blog"
                                            style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                        <select name="blog_id" data-validation='required' class="form-control select2"
                                            style="width: 100%;">
                                            <option label="Choose one blog" selected disabled>Select One</option>
                                            @foreach ($blogs as $blog)
                                                <option value="{{ $blog->id }}">{{ $blog->blog_title }}</option>
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
                                            name="image" data-validation='required' value="{{ old('image') }}">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <span>
                                            <img src="" id="reviewImg">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_alt">Image Alt</label>
                                        <input class="form-control" id="image_alt" name="image_alt" type="text"
                                            placeholder="Enter image alt" data-validation='required'
                                            value="{{ old('image_alt') }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary align-top">
                                        Insert</button>
                                </div>
                            </form>
                        </div>
                    </div>

                @endif
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="localProjectHeader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="exampleModalLabel">Update Header of Local Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('local-project-header-update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $localProjectHeader->id }}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                    data-toggle="modal" data-target=".developmentProjecHeaderTitle">Preview
                                </button>
                                <input type="text" class="form-control" name="title" placeholder="Title" id="title"
                                    value="{{ $localProjectHeader->title }}">
                            </div>

                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="description">Description</label>
                                <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                    data-toggle="modal" data-target=".developmentProjectHeaderDescription">Preview
                                </button>
                                <textarea type="text" class="form-control textarea" id="description" name="description"
                                    placeholder="Description">{{ $localProjectHeader->description }}</textarea>
                            </div>

                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
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
@endsection
