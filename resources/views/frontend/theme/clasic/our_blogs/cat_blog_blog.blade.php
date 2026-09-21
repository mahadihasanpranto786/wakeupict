@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')


    <!--========================== Blog Content ============================-->


    <section id="our__blogs" class="mt-5 pt-5">
        <div class="my-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-md-6 mb-3">
                                <div class="card" style="height: 670px">
                                    <img src="{{ URL::asset($blog->blog_image) }}" class="card-img-top"
                                        alt="{{ $blog->image_alt }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $blog->blog_title }}</h5>
                                        <p class="card-text">{!! $blog->short_description !!}</p>

                                        <p class="card-text"><small
                                                class="text-muted">{{ $blog->update_time }}</small>
                                        </p>
                                        <p class="card-text float-right"><small class="btn btn-sm btn-warning"><a
                                                    href="{{ 'blog-details/' . $blog->id . '/' . $blog->blog_title }}"
                                                    class="text-dark">Read
                                                    More</a></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                @include('frontend.theme.clasic.our_blogs.blog_sidebar')

            </div>
        </div>
    </section>

    <!--========================== Blog Content ============================-->




    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('frontend') }}/plugins/OwlCarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    {{-- <script>
    var scroll = new SmoothScroll('a[href*="#"]', {
        speed: 300
    });
</script> --}}
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    // nav: true
                },
                600: {
                    items: 2,
                    // nav: false
                },
                1000: {
                    items: 3,
                    // nav: true,
                    loop: false
                }
            }
        })
    </script>

@endsection
