@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
    {{-- blog details --}}
    <section id="blog__details" class="pt-5">
        <div class="___class_+?1___"></div>
        <div class="blog__details_header-second text-white">
            <div class="container">
                <div class="text-center">
                    <h1>{{ $blog->blog_title }} </h1>
                    <p>{!! $blog->short_description !!}</p>
                </div>
            </div>
        </div>
        <div class="blog__details_header-second-img text-center">
            <div class="contailer">
                <img style="border-radius: 10px" src="{{ asset($blog->header_image) }}" alt="{{ $blog->image_alt }}">
            </div>
        </div>
        <!-- Blog Details  -->
        <div class="blog__details__body">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="___class_+?10___">{{ $blog->footer_title }}</h1>
                </div>

                @foreach ($blogContent as $content)
                    <div>
                        @if ($content->content_design == 'Left side')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($content->title)
                                            <div class="top__solid__mark"></div>
                                            <h4>{{ $content->title }}</h4>
                                        @endif
                                        <p>{!! $content->short_description !!}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ URL::asset($content->file) }}">
                                            <img style="border: 1px solid #181717;" src="{{ asset($content->file) }}"
                                                class="img-fluid" alt="{{ $content->image_alt }}">
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @elseif ($content->content_design == 'Right side')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ URL::asset($content->file) }}">
                                            <img style="border: 1px solid #181717;" src="{{ asset($content->file) }}"
                                                class="img-fluid" alt="{{ $content->image_alt }}">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($content->title)
                                            <div class="top__solid__mark"></div>
                                            <h4>{{ $content->title }}</h4>
                                        @endif
                                        <p>{!! $content->short_description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @elseif ($content->content_design == 'Middle')
                            <div class="mb-3">
                                <div class="d-flex justify-content-center middle_content">
                                    <a href="{{ URL::asset($content->file) }}">
                                        <img style="border: 1px solid #181717;" src="{{ asset($content->file) }}"
                                            class="img-fluid" alt="{{ $content->image_alt }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                @if ($content->title)
                                    <div class="top__solid__mark_col4"></div>
                                    <h4>{{ $content->title }}</h4>
                                @endif
                                <p>{!! $content->short_description !!}
                                </p>
                            </div>
                        @elseif ($content->content_design == 'Top Three')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 top_three">
                                        <a href="{{ URL::asset($content->file) }}">
                                            <img style="border: 1px solid #181717;" src="{{ asset($content->file) }}"
                                                class="img-fluid" alt="{{ $content->image_alt }}">
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 top_three">
                                        <a href="{{ URL::asset($content->file_1) }}">
                                            <img style="border: 1px solid #181717;" src="{{ asset($content->file_1) }}"
                                                class="img-fluid" alt="{{ $content->image_alt }}">
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 top_three">
                                        <a href="{{ URL::asset($content->file_2) }}">
                                            <img style="border: 1px solid #181717;" src="{{ asset($content->file_2) }}"
                                                class="img-fluid" alt="{{ $content->image_alt }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    @if ($content->title)
                                        <div class="top__solid__mark"></div>
                                        <h4>{{ $content->title }}</h4>
                                    @endif
                                    <p>{!! $content->short_description !!}
                                    </p>
                                </div>
                            </div>
                        @elseif ($content->content_design == 'Right Three')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        @if ($content->title)
                                            <div class="top__solid__mark"></div>
                                            <h4>{{ $content->title }}</h4>
                                        @endif
                                        <p>{!! $content->short_description !!}</p>
                                    </div>
                                    <div class="col-md-4 justify-content-center mt-4">
                                        <div class="col-sm-6 mt-3 ml-auto right_threee">
                                            <a href="{{ URL::asset($content->file) }}">
                                                <img style="border: 1px solid #181717;" src="{{ asset($content->file) }}"
                                                    class="img-fluid" alt="{{ $content->image_alt }}">
                                            </a>
                                        </div>
                                        <div class="col-md-6 mt-3  ml-auto right_threee">
                                            <a href="{{ URL::asset($content->file_1) }}">
                                                <img style="border: 1px solid #181717;"
                                                    src="{{ asset($content->file_1) }}" class="img-fluid"
                                                    alt="{{ $content->image_alt }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4  mt-4">
                                        <div class="m-3 right_threee">
                                            <a href="{{ URL::asset($content->file_2) }}">
                                                <img style="border: 1px solid #181717;"
                                                    src="{{ asset($content->file_2) }}" class="img-fluid"
                                                    alt="{{ $content->image_alt }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @elseif ($content->content_design == 'Only Text')
                            <div class="mb-3">
                                <div class="row">
                                    <div class="m-3">
                                        @if ($content->title)
                                            <div class="top__solid__mark"></div>
                                            <h4>{{ $content->title }}</h4>
                                        @endif
                                        <p>{!! $content->short_description !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
                <div class="blog__details__body--social">
                    <hr class="mt-5" style="border-top: 3px solid gray">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #3b5998;"><a
                                    href="https://www.facebook.com/wakeupict" target="blank" class="text-white"><i
                                        class="fa fa-facebook-official" aria-hidden="true"></i>
                                    Facebook</a> </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #0077b5;"><a target="blank"
                                    href="https://www.linkedin.com/company/wakeupict/mycompany/" class="text-white"><i
                                        class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    LinkedIn</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #1da1f2;"><a target="blank"
                                    href="https://twitter.com/wakeupict" class="text-white"><i
                                        class="fa fa-twitter-square" aria-hidden="true"></i>
                                    Twitter</a>
                            </div>
                        </div>
                        {{-- <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #bd081c;"><a href="#"
                                    class="text-white"><i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                    Pinterest</a> </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #dd4b39;"><a target="blank"
                                    href="mailto:info@wakeupict.com" title="glorythemes" class="text-white"><i
                                        class="fa fa-envelope" aria-hidden="true"></i> Email</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>

        <!-- Other Blogs slider  -->
        <div class="blog__details__other__blogs">
            <div class="container">
                <h3 class="mb-3">More of our blogs</h3>

                <div class="owl-carousel owl-theme">

                    @foreach ($MoreBlog as $blog)
                        <div class="item">
                            <div class="card" style="height: 670px;">
                                <img src="{{ asset($blog->blog_image) }}" class="card-img-top"
                                    alt="{{ $blog->image_alt }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog->blog_title }}</h5>
                                    <p class="card-text">{!! $blog->short_description !!}</p>

                                    <p class="card-text"><small
                                            class="text-muted">{{ $blog->update_time }}</small>
                                    </p>
                                    <p class="card-text float-right"><small class="btn btn-sm btn-warning"><a
                                                href="{{ url('our-blogs/' . $blog->slug_title) }}"
                                                class="text-dark">Read More</a></small></p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


    </section>
    {{-- carousel --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.col-md-6, .middle_content, .top_three, .right_threee').magnificPopup({
                delegate: 'a',
                type: 'image'
            });
        })
    </script>
@endsection
