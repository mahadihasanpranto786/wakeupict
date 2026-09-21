@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
    <style>
        span.help-block.form-error {
            color: red;
        }

    </style>
    <div>
        <!--========================== Header ============================-->

        <section id="header"
            class="jumbotron jumbotron-fluid text-white d-flex justify-content-center align-items-center mt-5">
            <div class="container text-center mt-5">
                <div class="header-background p-4 mt-5">
                    <h1 class="display-4 text-uppercase "></h1>
                    <h2 class="text-uppercase ">Contact Us</h2>
                    <p class="d-none d-sm-block text-uppercase">Get in touch with us for more details...</p>
                    <p id="service"></p>
                </div>
            </div>
        </section>

        <!--========================== Contact Section ============================-->
        <div id="contact" class="container">
            <section class="section-bg wow fadeInUp">
                <div class="section-header">
                    <h1 class="display-5 text-center font-weight-bold">Contact Us</h1>
                    <div class="row mb-5" style="margin: 0 auto; width: 150px;">
                        <span class="left_bottom_border"></span>
                        <span class="left_bottom_border"></span>
                    </div>
                </div>
                <div class="form">
                    <form method="POST" action="{{ route('contact-us-user') }}" enctype="multipart/form-data"
                        class="contactForm">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name*"
                                data-validation="required" />
                            @error('name')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="phone" class="form-control" placeholder="Your Phone*"
                                    data-validation="required" />
                                @error('phone')
                                    <span class="text-theme-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email*"
                                    data-validation="required" />
                                @error('email')
                                    <span class="text-theme-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" onkeyup="countChars(this);" name="message" rows="5"
                                placeholder="Your Message*" data-validation="required"></textarea>

                            <p id="charNum">200 characters remaining</p>
                            @error('message')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-file-container">
                            <input class="input-file" id="my-file" data-validation='required' onchange="preview()"
                                name="image" type="file">
                            <label tabindex="0" for="my-file" class="input-file-trigger">Select a
                                photo...</label>
                            @error('image')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <p class="file-return"></p> --}}
                        <div class="m-2">
                            <span>
                                <img src="" class="border border-info" id="previewImg">
                            </span>
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-warning btn-lg">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <script>
        function countChars(obj) {
            var maxLength = 200;
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
    <script>
        // image preview
        function preview() {
            // const preview = document.querySelector('#imgThambnail');
            const file = document.querySelector('#my-file').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function(e) {
                // convert image file to base64 string
                // preview.src = reader.result;
                $('#previewImg').attr('src', e.target.result).width(150).height(200);

            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
