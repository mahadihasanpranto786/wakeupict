@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    About Page History
@endsection
{{-- menu active start --}}

@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('about_page', 'menu-open')

@section('menu_active_about', 'active bg-info')

@section('about_history', 'active')
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
                                        <i class="fas fa-plus-circle"></i>Add About Page History
                                    </button>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image Info</th>
                                        <th style="width: 22%">Title </th>
                                        <th style="width: 33%">Description</th>
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
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="100px" src="{{ URL::asset($history->image) }}" alt="loading">
                                                <br>
                                                <b>Image alt :</b>({{ $history->image_alt }})
                                            </td>
                                            <td>
                                                {{ $history->title }}
                                            </td>
                                            <td>{!! $history->description !!}
                                            </td>
                                            <td>
                                                @if ($history->active_status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- status --}}
                                                        @if ($history->active_status == 1)
                                                            <a title="Inactive"
                                                                class="flex items-center btn btn-danger btn-sm"
                                                                href="{{ url('history-inactive/' . $history->id) }}">
                                                                <i class="fas fa-arrow-circle-down text-white"></i>
                                                            </a>
                                                        @else
                                                            <a title="Active"
                                                                class="flex items-center btn btn-success btn-sm"
                                                                href="{{ url('history-active/' . $history->id) }}"> <i
                                                                    class="fas fa-arrow-circle-up text-white"></i>
                                                            </a>
                                                        @endif
                                                        {{-- edit --}}

                                                        <button title="Edit" type="button" class="btn btn-primary  btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editHistory{{ $history->id }}">
                                                            <i class="fas fa-pencil-alt text-white"></i>
                                                        </button>
                                                        {{-- delete --}}
                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('history-delete/' . $history->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>

                                        <!-- Modal for insert -->
                                        <div class="modal fade" id="editHistory{{ $history->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  bg-success">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit About Page
                                                            History</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card card-primary">
                                                            <!-- form start -->

                                                            <div class="card">
                                                                <form action="{{ route('history_update') }}" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $history->id }}">
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                            <label for="title">Title</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target="#history_title">Preview
                                                                            </button>
                                                                            <input type="text" name="title" id="title"
                                                                                data-validation='required'
                                                                                class="form-control"
                                                                                placeholder="Enter title"
                                                                                value="{{ $history->title }}">
                                                                            @error('title')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="description">Description</label>
                                                                            <button type="button"
                                                                                style="float: right; border-radius: 3px;"
                                                                                class="btn-success" data-toggle="modal"
                                                                                data-target="#history_desc">Preview
                                                                            </button>
                                                                            <textarea type="text" name="description" id="description" class="form-control textarea"
                                                                                placeholder="Enter description">{{ $history->description }}</textarea>
                                                                            @error('description')
                                                                                <span
                                                                                    class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="image_alt">Image Alt</label>
                                                                            <input type="text" name="image_alt"
                                                                                id="image_alt" class="form-control"
                                                                                placeholder="Enter Image alt"
                                                                                value="{{ $history->image_alt }}"
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
                                                                                data-target="#history_photo">Preview
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
                                                                                value="{{ $history->image }}">
                                                                            <p id="para">Old Image</p>
                                                                            <img width="250px" id="old_img"
                                                                                style=" border: 2px solid gray; padding: 20px;"
                                                                                class="old_img"
                                                                                src="{{ asset($history->image) }}"
                                                                                alt="old image">

                                                                            <span>
                                                                                <img src="" id="reviewImg">
                                                                            </span>
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
                                {{ $histories->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Insert About Page History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- form start -->

                        <div class="card">
                            <form action="{{ route('history_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>

                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target="#history_title">Preview
                                        </button>
                                        <input type="text" name="title" id="title" data-validation='required'
                                            class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target="#history_desc">Preview
                                        </button>
                                        <textarea type="text" name="description" id="description" class="form-control textarea"
                                            placeholder="Enter description">{{ old('description') }}</textarea>
                                        @error('description')
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
                                        <label for="image">Image</label>
                                        <button type="button" style="float: right; border-radius: 3px;"
                                            class="btn-success" data-toggle="modal" data-target="#history_photo">Preview
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
            $('#history_photo').modal('hide');
            $('body').css("overflow", "hidden");
            $(".modal-open .modal").css("overflow-x", "hidden").css("overflow-y", "auto");
        });
    </script>
@endsection
