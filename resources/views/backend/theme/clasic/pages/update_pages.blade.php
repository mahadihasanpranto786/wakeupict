@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Update SEO Content
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('seo_pages', 'menu-open')

@section('menu_active_seo', 'active bg-info')

@section('pages_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <h3>{{ $pages->page_name }}</h3>
    <form action="{{ route('store-page-seo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id" value="{{ $pages->id }}">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input onkeyup="countChars(this);" type="text" name="title" id="title" class="form-control"
                                placeholder="Title" value="{{ $pages->title }}">
                            <p id="charNum">56 characters remaining</p>
                            @error('title')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link_canonical">Link Canonical</label>
                            <input type="text" name="link_canonical" id="link_canonical" class=" form-control"
                                placeholder="Link Canonical" value="{{ $pages->link_canonical }}">
                            @error('link_canonical')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_locale">OG Locale</label>
                            <input type="text" name="og_locale" id="og_locale" class=" form-control"
                                placeholder="og:locale" value="{{ $pages->og_locale }}">
                            @error('link_canonical')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_type">OG Type</label>
                            <input type="text" name="og_type" id="og_type" class=" form-control" placeholder="og:type"
                                value="{{ $pages->og_type }}">
                            @error('og_type')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_url">OG URL</label>
                            <input type="text" name="og_url" id="og_url" class=" form-control" placeholder="og:url"
                                value="{{ $pages->og_url }}">
                            @error('og_url')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="og_site_name">OG Side Name</label>
                            <input type="text" name="og_site_name" id="og_site_name" class=" form-control"
                                placeholder="og:site_name" value="{{ $pages->og_site_name }}">
                            @error('og_site_name')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="msvalidate">MS Validate</label>
                            <input type="text" name="msvalidate" id="msvalidate" class=" form-control"
                                placeholder="og:site_name" value="{{ $pages->msvalidate }}">
                            @error('msvalidate')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="textarea form-control" cols="30"
                                rows="4">{{ $pages->description }}</textarea>
                            @error('description')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label for="article_publisher">Article Publisher</label>
                            <input type="text" name="article_publisher" id="article_publisher" class=" form-control"
                                placeholder="og:publisher" value="{{ $pages->article_publisher }}">
                            @error('article_publisher')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="article_modified_time">Article Modified Time</label>
                            <input type="date" name="article_modified_time" class="form-control" data-single-mode="true"
                                value="{{ $pages->article_modified_time }}">

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
                                placeholder="og:image:width" value="{{ $pages->og_image_width }}">
                            @error('og_image_width')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="og_image_height">OG Image Height</label>
                            <input type="number" name="og_image_height" id="og_image_height" class=" form-control"
                                placeholder="og:image:height" value="{{ $pages->og_image_height }}">
                            @error('og_image_height')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_card">Twitter Card</label>
                            <input type="text" name="twitter_card" id="twitter_card" class=" form-control"
                                placeholder="twitter:card" value="{{ $pages->twitter_card }}">
                            @error('twitter_card')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_label1">Twitter Label 1</label>
                            <input type="text" name="twitter_label1" id="twitter_label1" class=" form-control"
                                placeholder="twitter:label1" value="{{ $pages->twitter_label1 }}">
                            @error('twitter_label1')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="twitter_data1">Twitter Data 1</label>
                            <input type="text" name="twitter_data1" id="twitter_data1" class=" form-control"
                                placeholder="twitter:label1" value="{{ $pages->twitter_data1 }}">
                            @error('twitter_data1')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="google_site_verification">Google Side Varification</label>
                            <input type="text" name="google_site_verification" id="google_site_verification"
                                class=" form-control" placeholder="twitter:label1"
                                value="{{ $pages->google_site_verification }}">
                            @error('google_site_verification')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="inputImg">Upload Image</label>


                            <input type="file" class="form-control" name="image" id="inputImg" onchange="preview()"
                                placeholder="image" value="{{ $pages->image }}">

                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <input type="hidden" name="old_img" value="{{ $pages->image }}">
                            <p id="para">Old Image</p>
                            <img width="250px" id="old_img" style=" border: 2px solid gray; padding: 20px;"
                                class="old_img" src="{{ asset($pages->image) }}" alt="old image">

                            <span>
                                <img src="" id="reviewImg">
                            </span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary">
                            Insert</button>
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
