@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Create About
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('about_page', 'menu-open')

@section('menu_active_about', 'active bg-info')

@section('about_create_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('store-who-we-are') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label><a href="javascript:;" data-toggle="modal"
                                data-target="#about_name" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="name" id="name" data-validation='required' class="form-control"
                                placeholder="Enter name" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="designation">Designation</label><a href="javascript:;" data-toggle="modal"
                                data-target="#designation_about" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="text" name="designation" id="designation" class="form-control"
                                placeholder="Enter designation" value="{{ old('designation') }}">
                            @error('designation')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image_alt">Image Alt</label>
                            <input type="text" name="image_alt" id="image_alt" class="form-control"
                                placeholder="Enter Image alt" value="{{ old('image_alt') }}" data-validation='required'>
                            @error('image_alt')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="image">Image</label><a href="javascript:;" data-toggle="modal"
                                data-target="#about_image" style="float: right; border-radius: 3px;"
                                class="btn-success">Preview</a>
                            <input type="file" name="image" id="inputImg" data-validation='required' onchange="preview()"
                                class="form-control" placeholder="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                Insert</button>
                        </div>
                </form>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
    <script>
        function preview() {
            const file = document.querySelector('#inputImg').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
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
@endsection
