@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Add New About Card Details
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('about_page', 'menu-open')

@section('menu_active_about', 'active bg-info')

@section('about_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <h3> Add Details For {{ $about->name }}</h3>
    <form action="{{ route('store-page-seo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="{{ $about->id }}">

                        <div class="form-group">
                            <label for="joining_date">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" class="form-control"
                                placeholder="Joining Date" value="{{ old('date') }}">
                            @error('date')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="project_lenght">Project Length</label>
                            <input type="text" name="project_lenght" id="project_lenght" class=" form-control"
                                placeholder="Project Length" value="{{ old('project_lenght') }}">
                            @error('project_lenght')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_locale">OG Locale</label>
                            <input type="text" name="og_locale" id="og_locale" class=" form-control"
                                placeholder="og:locale" value="{{ old('og_locale') }}">
                            @error('link_canonical')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_type">OG Type</label>
                            <input type="text" name="og_type" id="og_type" class=" form-control" placeholder="og:type"
                                value="{{ old('og_type') }}">
                            @error('og_type')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_url">OG URL</label>
                            <input type="text" name="og_url" id="og_url" class=" form-control" placeholder="og:url"
                                value="{{ old('og_url') }}">
                            @error('og_url')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_site_name">OG Side Name</label>
                            <input type="text" name="og_site_name" id="og_site_name" class=" form-control"
                                placeholder="og:site_name" value="{{ old('og_site_name') }}">
                            @error('og_site_name')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="msvalidate">MS Validate</label>
                            <input type="text" name="msvalidate" id="msvalidate" class=" form-control"
                                placeholder="og:site_name" value="{{ old('msvalidate') }}">
                            @error('msvalidate')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="textarea form-control" cols="30"
                                rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="article_publisher">Article Publisher</label>
                            <input type="text" name="article_publisher" id="article_publisher" class=" form-control"
                                placeholder="og:publisher" value="{{ old('article_publisher') }}">
                            @error('article_publisher')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="article_modified_time">Article Modified Time</label>
                            <input type="date" name="article_modified_time" class="form-control" data-single-mode="true"
                                value="{{ old('article_modified_time') }}">

                            {{-- <input type="date" name="article_modified_time" id="article_modified_time"
                           class=" form-control hasDatepicker"
                           placeholder="og:site_name"> --}}
                            @error('article_modified_time')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="og_image_width">OG Image Width</label>
                            <input type="number" name="og_image_width" id="og_image_width" class=" form-control"
                                placeholder="og:image:width" value="{{ old('og_image_width') }}">
                            @error('og_image_width')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="og_image_height">OG Image Height</label>
                            <input type="number" name="og_image_height" id="og_image_height" class=" form-control"
                                placeholder="og:image:height" value="{{ old('og_image_height') }}">
                            @error('og_image_height')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_card">Twitter Card</label>
                            <input type="text" name="twitter_card" id="twitter_card" class=" form-control"
                                placeholder="twitter:card" value="{{ old('twitter_card') }}">
                            @error('twitter_card')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_label1">Twitter Label 1</label>
                            <input type="text" name="twitter_label1" id="twitter_label1" class=" form-control"
                                placeholder="twitter:label1" value="{{ old('twitter_label1') }}">
                            @error('twitter_label1')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_data1">Twitter Data 1</label>
                            <input type="text" name="twitter_data1" id="twitter_data1" class=" form-control"
                                placeholder="twitter:label1" value="{{ old('twitter_data1') }}">
                            @error('twitter_data1')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="google_site_verification">Google Side Varification</label>
                            <input type="text" name="google_site_verification" id="google_site_verification"
                                class=" form-control" placeholder="twitter:label1"
                                value="{{ old('google_site_verification') }}">
                            @error('google_site_verification')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="inputImg">Upload Image</label>


                            <input type="file" class="form-control" name="image" id="inputImg" onchange="preview()"
                                placeholder="image" value="{{ old('image') }}">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </div>
                </div>
            </div>
    </form>

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
    <script>
        function countChars(obj) {
            var maxLength = 56;
            var strLength = obj.value.length;
            var charRemain = (maxLength - strLength);

            if (charRemain < 0) {
                document.getElementById("charNum").innerHTML = '<span style="color: red;">You have exceeded the limit of ' +
                    maxLength + ' characters</span>';
            } else {
                document.getElementById("charNum").innerHTML = charRemain + ' characters remaining';
            }
        }
    </script>
@endsection
