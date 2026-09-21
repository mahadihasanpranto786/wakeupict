@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    About HR Card List
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('about_page', 'menu-open')

@section('menu_active_about', 'active bg-info')

@section('about_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-2">
                                @if (checkUserType() == 0)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#createAbout">
                                        <i class="fas fa-plus-circle"></i> Create About HR Card
                                    </button>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Info </th>
                                        <th>Iamge Alt</th>
                                        <th>Status</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = ($abouts->currentPage() - 1) * $abouts->perPage() + 1;
                                    @endphp
                                    @foreach ($abouts as $about)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="100px" src="{{ URL::asset($about->image) }}" alt="loading">
                                            </td>
                                            <td>
                                                <b>Name:</b> {{ $about->name }} <br>
                                                <b>Slug:</b> {{ $about->slug }} <br>
                                                <b>Designation:</b> {{ $about->designation }} <br>
                                                <b>Type:</b>
                                                @if ($about->type == 'employee')
                                                    Employee
                                                @else
                                                    Chairman
                                                @endif <br>
                                            </td>
                                            <td>{{ $about->image_alt }}
                                            </td>
                                            <td>
                                                @if ($about->active_who == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- view --}}
                                                        <a title="Inactive"
                                                            class="flex items-center btn btn-info btn-sm"
                                                            href="{{ url('who-we-are-list/' . $about->id) }}">
                                                            <i class="fas fa-eye text-white"></i>
                                                        </a>
                                                        {{-- status --}}
                                                        @if ($about->active_who == 1)
                                                            <a title="Inactive"
                                                                class="flex items-center btn btn-danger btn-sm"
                                                                href="{{ url('about-inactive/' . $about->id) }}">
                                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                            </a>
                                                        @else
                                                            <a title="Active"
                                                                class="flex items-center btn btn-success btn-sm"
                                                                href="{{ url('about-active/' . $about->id) }}"> <i
                                                                    class="fas fa-arrow-circle-up text-white"></i>
                                                            </a>
                                                        @endif

                                                        {{-- edit --}}

                                                        <button title="Edit" type="button" class="btn btn-primary  btn-sm"
                                                            data-toggle="modal" data-target="#editAbout{{ $about->id }}">
                                                            <i class="fas fa-pencil-alt text-white"></i>
                                                        </button>
                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ 'who-we-are-delete/' . $about->id }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                        
                                                        @if ($about->is_intern == 1)
                                                            <a title="Employee"
                                                                class="flex items-center btn btn-secondary btn-sm"
                                                                href="{{ url('about-employee/' . $about->id) }}">
                                                                Employee
                                                            </a>
                                                        @elseif($about->is_intern == 0)
                                                            <a title="Intern"
                                                                class="flex items-center btn btn-info btn-sm"
                                                                href="{{ url('about-intern/' . $about->id) }}"> 
                                                                Intern
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>

                                        <!-- Modal for insert -->
                                        <div class="modal fade" id="editAbout{{ $about->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-success">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit About Hr Card
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-primary">
                                                            <!-- form start -->
                                                            <div class="card">
                                                                <form action="{{ route('update-who-we-are') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $about->id }}">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".about_name">Preview
                                                                            </button>
                                                                            <input type="text" name="name" id="name"
                                                                                data-validation='required'
                                                                                class="form-control"
                                                                                placeholder="Enter name"
                                                                                value="{{ $about->name }}">
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="slug">Slug</label>
                                                                            </button>
                                                                            <input type="text" name="slug" id="slug"
                                                                                data-validation='required'
                                                                                class="form-control"
                                                                                placeholder="Enter name"
                                                                                value="{{ $about->slug }}">
                                                                            @error('name')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="designation">Designation</label>

                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target="#designation_about">Preview
                                                                            </button>
                                                                            <input type="text" name="designation"
                                                                                id="designation" class="form-control"
                                                                                placeholder="Enter designation"
                                                                                value="{{ $about->designation }}">
                                                                            @error('designation')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="type">Select Type</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target="#designation_about">Preview
                                                                            </button>
                                                                            <select name="type" class="custom-select"
                                                                                data-validation='required'>
                                                                                <option selected>Select Type</option>
                                                                                <option value="employee"
                                                                                    {{ $about->type == 'employee' ? 'selected' : '' }}>
                                                                                    Employee</option>
                                                                                <option value="chairman"
                                                                                    {{ $about->type == 'chairman' ? 'selected' : '' }}>
                                                                                    Chairman</option>
                                                                            </select>
                                                                            @error('type')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="image_alt">Image Alt</label>
                                                                            <input type="text" name="image_alt"
                                                                                id="image_alt" class="form-control"
                                                                                placeholder="Enter Image alt"
                                                                                value="{{ $about->image_alt }}"
                                                                                data-validation='required'>
                                                                            @error('image_alt')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="image">Image</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target="#about_image">Preview
                                                                            </button>
                                                                            <input type="file" name="image" id="inputImg"
                                                                                onchange="preview()" class="form-control"
                                                                                placeholder="image"
                                                                                value="{{ $about->image }}">
                                                                            @error('image')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <input type="hidden" name="old_img"
                                                                                value="{{ $about->image }}">
                                                                            <p id="para">Old Image</p>
                                                                            <img width="250px" id="old_img"
                                                                                style=" border: 2px solid gray; padding: 20px;"
                                                                                class="old_img"
                                                                                src="{{ asset($about->image) }}"
                                                                                alt="old image">

                                                                            <span>
                                                                                <img src="" id="reviewImg">
                                                                            </span>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-block btn-block btn-primary">
                                                                                Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @include('backend/theme/clasic/include/modal_photos/modal') --}}
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-right my-3">
                                {{ $abouts->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <!-- Modal for insert -->
    <div class="modal fade" id="createAbout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Insert About Hr Card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- form start -->

                        <div class="card">
                            <form action="{{ route('store-who-we-are') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label> <button type="button"
                                            style="float: right; border-radius: 3px;" class="btn-success"
                                            data-toggle="modal" data-target=".about_name">Preview
                                        </button>
                                        <input type="text" name="name" id="name" data-validation='required'
                                            class="form-control" placeholder="Enter name" value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal"
                                            data-target="#designation_about">Preview
                                        </button>
                                        <input type="text" name="designation" id="designation" class="form-control"
                                            placeholder="Enter designation" value="{{ old('designation') }}">
                                        @error('designation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="image_alt">Image Alt</label>
                                        <input type="text" name="image_alt" id="image_alt" class="form-control"
                                            placeholder="Enter Image alt" value="{{ old('image_alt') }}"
                                            data-validation='required'>
                                        @error('image_alt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="type">Select Type</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal"
                                            data-target="#designation_about">Preview
                                        </button>
                                        <select name="type" class="custom-select" data-validation='required'>
                                            <option selected>Select Type</option>
                                            <option value="employee">Employee</option>
                                            <option value="chairman">Chairman</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="image">Image</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target="#about_image">Preview
                                        </button>
                                        <input type="file" name="image" id="inputImgInsert" data-validation='required'
                                            onchange="previewInsert()" class="form-control" placeholder="image"
                                            value="{{ old('image') }}">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <span>
                                            <img src="" id="reviewImgInsert">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-block btn-primary">
                                            Insert</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('backend/theme/clasic/include/modal_photos/modal')

    {{-- update script --}}
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

    {{-- insert script --}}
    <script>
        function previewInsert() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#inputImgInsert').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#reviewImgInsert').attr('src', e.target.result).width(250).height(180);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
                document.getElementById("reviewImgInsert").style.cssText = `
                        border: 2px solid gray;
                        padding: 20px;
                        `;
            }
        }
    </script>
@endsection
