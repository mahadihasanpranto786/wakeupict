@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Insert Home Slider
@endsection
{{-- menu active start --}}

@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('home_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('create-slider') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">

                            <label for="title">Upload Image</label>
                            <a type="button" data-toggle="modal" data-target="#slider_image"
                                style="float: right; border-radius: 3px;" class="btn-success text-white">Preview</a>
                            <input type="file" class="form-control" name="slider_image" id="inputImg"
                                data-validation='required' onchange="preview()" placeholder="image"
                                value="{{ old('slider_image') }}">

                            @error('slider_image')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>


                        <div>
                            <label for="slider_alt">Image alt</label>
                            <input type="text" name="slider_alt" id="slider_alt" class="form-control"
                                placeholder="Enter Image Alt" value="{{ old('slider_alt') }}" data-validation='required'>
                            @error('slider_alt')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- /.card-body -->

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
