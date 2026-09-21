@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Service Page Banner
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('service_page', 'menu-open')

@section('menu_active_service', 'active bg-info')

@section('service_banner', 'active')
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
                                        data-target="#createBanner">
                                        <i class="fas fa-plus-circle"></i>Add Service Page Banner
                                    </button>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image Info</th>
                                        <th style="width: 22%">Title Info</th>
                                        <th style="width: 33%">Description Info</th>
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
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="200px" src="{{ URL::asset($banner->image) }}" alt="loading">
                                                <br>
                                                <b>Image alt :</b>({{ $banner->image_alt }})
                                            </td>
                                            <td>
                                                <div class="border border-success">
                                                    <u><b>Banner Title: </b></u> {{ $banner->banner_title }}
                                                </div><br>
                                                <div class="border border-danger">
                                                    <u><b>Body Title: </b></u> {{ $banner->body_title }}
                                                </div>
                                            </td>
                                            <td>

                                                <div class="border border-success">
                                                    <u><b>Banner Description: </b></u>
                                                    {!! $banner->banner_description !!}
                                                </div><br>
                                                <div class="border border-danger">
                                                    <u><b>Body Description: </b></u>
                                                    {!! $banner->body_description !!}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($banner->active_status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- status --}}
                                                        @if ($banner->active_status == 1)
                                                            <a title="Inactive"
                                                                class="flex items-center btn btn-danger btn-sm"
                                                                href="{{ url('service-banner-inactive/' . $banner->id) }}">
                                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                            </a>
                                                        @else
                                                            <a title="Active"
                                                                class="flex items-center btn btn-success btn-sm"
                                                                href="{{ url('service-banner-active/' . $banner->id) }}">
                                                                <i class="fas fa-arrow-circle-up text-white"></i>
                                                            </a>
                                                        @endif
                                                        {{-- edit --}}

                                                        <button title="Edit" type="button" class="btn btn-primary  btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editBanner{{ $banner->id }}">
                                                            <i class="fas fa-pencil-alt text-white"></i>
                                                        </button>
                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('service-banner-delete/' . $banner->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>

                                        <!-- Modal for edit -->

                                        <div class="modal fade" id="editBanner{{ $banner->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-success">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Tranning
                                                            Page Banner</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-primary">
                                                            <!-- form start -->
                                                            <div class="card">
                                                                <form action="{{ route('service_banner_update') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $banner->id }}">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="banner_title">Banner Title</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".training_title">Preview
                                                                            </button>
                                                                            <input type="text" name="banner_title"
                                                                                id="banner_title" data-validation='required'
                                                                                class="form-control"
                                                                                placeholder="Enter banner title"
                                                                                value="{{ $banner->banner_title }}">
                                                                            @error('banner_title')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="banner_description">Banner
                                                                                Description</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".banner_desc">Preview
                                                                            </button>
                                                                            <textarea type="text" name="banner_description" id="banner_description" class="form-control textarea"
                                                                                placeholder="Enter banner description">{{ $banner->banner_description }}</textarea>
                                                                            @error('banner_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="body_title">Body Title</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".bodytitle">Preview
                                                                            </button>
                                                                            <input type="text" name="body_title"
                                                                                id="body_title" data-validation='required'
                                                                                class="form-control"
                                                                                placeholder="Enter body title"
                                                                                value="{{ $banner->body_title }}">
                                                                            @error('body_title')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="body_description">Body
                                                                                Description</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".bodyDesc">Preview
                                                                            </button>
                                                                            <textarea type="text" name="body_description" id="body_description" class="form-control textarea"
                                                                                placeholder="Enter body_description">{{ $banner->body_description }}</textarea>
                                                                            @error('body_description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">

                                                                            <p class="text-danger">Note: Footer
                                                                                Background Image size must be (1350 x 420)
                                                                            </p>

                                                                            <label for="image">Banner Background</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target=".banner_photo">Preview
                                                                            </button>
                                                                            <input type="file" name="image" id="inputImg"
                                                                                data-validation='required'
                                                                                onchange="preview()" class="form-control"
                                                                                placeholder="image"
                                                                                value="{{ old('image') }}">
                                                                            @error('image')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <input type="hidden" name="old_img"
                                                                                value="{{ $banner->image }}">
                                                                            <p id="para">Old Image</p>
                                                                            <img width="250px" id="old_img"
                                                                                style=" border: 2px solid gray; padding: 20px;"
                                                                                class="old_img"
                                                                                src="{{ asset($banner->image) }}"
                                                                                alt="old image">

                                                                            <span>
                                                                                <img src="" id="reviewImg">
                                                                            </span>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="image_alt">Image Alt</label>
                                                                            <input type="text" name="image_alt"
                                                                                id="image_alt" class="form-control"
                                                                                placeholder="Enter Image alt"
                                                                                value="{{ $banner->image_alt }}"
                                                                                data-validation='required'>
                                                                            @error('image_alt')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <button type="submit"
                                                                                class="btn btn-block btn-primary">
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
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="float-right my-3">
                                {{ $banners->links() }}
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

    <div class="modal fade" id="createBanner" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Service Page Banner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- form start -->
                        <div class="card">
                            <form action="{{ route('service_banner_store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="banner_title">Banner Title</label>

                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target=".training_title">Preview
                                        </button>
                                        <input type="text" name="banner_title" id="banner_title" data-validation='required'
                                            class="form-control" placeholder="Enter banner title"
                                            value="{{ old('banner_title') }}">
                                        @error('banner_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="banner_description">Banner Description</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target=".banner_desc">Preview
                                        </button>
                                        <textarea type="text" name="banner_description" id="banner_description" class="form-control textarea"
                                            placeholder="Enter banner description">{{ old('banner_description') }}</textarea>
                                        @error('banner_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="body_title">Body Title</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target=".bodytitle">Preview
                                        </button>
                                        <input type="text" name="body_title" id="body_title" data-validation='required'
                                            class="form-control" placeholder="Enter body title"
                                            value="{{ old('body_title') }}">
                                        @error('body_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="body_description">Body Description</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target=".bodyDesc">Preview
                                        </button>
                                        <textarea type="text" name="body_description" id="body_description" class="form-control textarea"
                                            placeholder="Enter body_description">{{ old('body_description') }}</textarea>
                                        @error('body_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <p class="text-danger">Note: Footer
                                            Background Image size must be (1350 x 420)
                                        </p>

                                        <label for="image">Banner Background</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target=".banner_photo">Preview
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
                                        <label for="image_alt">Image Alt</label>
                                        <input type="text" name="image_alt" id="image_alt" class="form-control"
                                            placeholder="Enter Image alt" value="{{ old('image_alt') }}"
                                            data-validation='required'>
                                        @error('image_alt')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-primary">
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

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $("button[data-dismiss='modal2']").click(function() {
            $('.training_title, .banner_desc, .bodytitle, .bodyDesc, .banner_photo').modal('hide');
            $('body').css("overflow", "hidden");
            $(".modal-open .modal").css("overflow-x", "hidden").css("overflow-y", "auto");
        });
    </script>
@endsection
