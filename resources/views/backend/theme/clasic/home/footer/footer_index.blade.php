@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Footer Banner
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('footer_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Footer Banner</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="my-2">
                        @if (checkUserType() == 0)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFooter">
                                <i class="fas fa-plus-circle"></i> Create Footer
                            </button>
                        @endif
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap border border-b-2">SL</th>
                                <th class="whitespace-nowrap border border-b-2">Backgrund Image</th>
                                <th class="whitespace-nowrap border border-b-2">Footer Header</th>
                                <th class="whitespace-nowrap border border-b-2">Footer Content</th>
                                <th class="whitespace-nowrap border border-b-2">Status</th>
                                @if (checkUserType() == 0)
                                    <th class="whitespace-nowrap border border-b-2">Action</th>
                                @endif
                            </tr>
                        </thead>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($footers as $item)
                            <tbody>
                                <td>{{ $sl++ }}</td>
                                <td><img width='170px' src="{{ $item->footer_backgroud }}" alt="footer bg"></td>
                                <td style="width: 25%">{{ $item->footer_header }}</td>
                                <td style="width: 25%">{{ $item->footer_content }}</td>
                                <td>
                                    @if ($item->active_status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inctive</span>
                                    @endif
                                </td>
                                @if (checkUserType() == 0)
                                    <td>
                                        @if ($item->active_status == 1)
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('footer-inactive/' . $item->id) }}"><i
                                                    class="fas fa-arrow-down"></i></a>
                                        @else
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('footer-active/' . $item->id) }}"><i
                                                    class="fas fa-arrow-up"></i></a>
                                        @endif
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#editFooter{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a id="delete" class="btn btn-danger btn-sm"
                                            href="{{ url('footer-delete/' . $item->id) }}"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                @endif

                            </tbody>
                            <!-- Modal for update edit -->
                            <div class="modal fade" id="editFooter{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-success">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Footer Content</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">
                                                <!-- form start -->
                                                <form role="form" method="POST" action="{{ route('update_footer') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="footer_header">Footer Header</label>
                                                            <button type="button" style="float: right; border-radius: 3px;"
                                                                class="btn-success" data-toggle="modal"
                                                                data-target=".footer_title">Preview
                                                            </button>
                                                            <input class="form-control" id="footer_header"
                                                                name="footer_header" type="text"
                                                                placeholder="Enter Footer Header" data-validation='required'
                                                                value="{{ $item->footer_header }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="footer_content">Footer Content</label>
                                                            <button type="button" style="float: right; border-radius: 3px;"
                                                                class="btn-success" data-toggle="modal"
                                                                data-target=".footer_description">Preview
                                                            </button>
                                                            <textarea class="form-control" id="footer_content" name="footer_content" type="text"
                                                                placeholder="Enter Footer Content"
                                                                data-validation='required'>{{ $item->footer_content }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <p class="text-danger">Note: Footer Background Image size
                                                                must be (1920 x 500)</p>
                                                            <button type="button" style="float: right; border-radius: 3px;"
                                                                class="btn-success" data-toggle="modal"
                                                                data-target=".footer_banner">Preview
                                                            </button>
                                                            <label for="footer_backgroud">Footer Background Image</label>
                                                            <input id="inputImgEdit" onchange="previewEdit()"
                                                                class="form-control" name="footer_backgroud" type="file"
                                                                data-validation='required'
                                                                value="{{ $item->footer_backgroud }}">
                                                        </div>

                                                        <div>
                                                            <input type="hidden" name="old_img"
                                                                value="{{ $item->footer_backgroud }}">
                                                            <p id="para">Old Image</p>
                                                            <img width="250px" id="old_img"
                                                                style=" border: 2px solid gray; padding: 20px;"
                                                                class="old_img"
                                                                src="{{ asset($item->footer_backgroud) }}"
                                                                alt="old image">

                                                            <span>
                                                                <img src="" id="reviewImgEdit">
                                                            </span>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit"
                                                                class="btn btn-block btn-primary align-top">
                                                                Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- Modal for insert -->
    <div class="modal fade" id="createFooter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Footer Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('store_footer') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="footer_header">Footer Header</label>
                                    <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                        data-toggle="modal" data-target=".footer_title">Preview
                                    </button>
                                    <input class="form-control" id="footer_header" name="footer_header" type="text"
                                        placeholder="Enter Footer Header" data-validation='required'
                                        value="{{ old('footer_header') }}">
                                </div>
                                <div class="form-group">
                                    <label for="footer_content">Footer Content</label>
                                    <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                        data-toggle="modal" data-target=".footer_description">Preview
                                    </button>
                                    <textarea class="form-control" id="footer_content" name="footer_content" type="text"
                                        placeholder="Enter Footer Content"
                                        data-validation='required'>{{ old('footer_content') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <p class="text-danger">Note: Footer Background Image size must be (1920 x 500)</p>

                                    <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                        data-toggle="modal" data-target=".footer_banner">Preview
                                    </button>
                                    <label for="footer_backgroud">Footer Background Image</label>
                                    <input name="footer_backgroud" class="form-control" id="inputImg" onchange="preview()"
                                        type="file" data-validation='required' value="{{ old('footer_backgroud') }}">
                                </div>

                                <div>
                                    <span>
                                        <img src="" id="reviewImg">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary align-top">
                                        Insert</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


    @include('backend/theme/clasic/include/modal_photos/modal')
    <script>
        // insert preview script
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
                document.getElementById("reviewImg").style.cssText = `
                            border: 2px solid gray;
                            padding: 20px;
                            `;
            }
        }
    </script>
    {{-- edit preview script --}}
    <script>
        function previewEdit() {
            const file = document.querySelector('#inputImgEdit').files[0];
            const reader = new FileReader();
            reader.addEventListener("load", function(e) {
                $('#reviewImgEdit').attr('src', e.target.result).width(250).height(180);
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                document.querySelector("#old_img").removeAttribute('src');
                document.querySelector("#old_img").removeAttribute('alt');
                document.querySelector("#old_img").removeAttribute('style');
                document.querySelector('#para').innerHTML = 'New image';
                document.getElementById("reviewImgEdit").style.cssText = `
                        border: 2px solid gray;
                        padding: 20px;
                        `;
            }
        }
    </script>
@endsection
