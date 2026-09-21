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
                    <div class="card bg-danger text-white">
                        <div class="card-body"><strong>Sorry!</strong> This Category Has No Blog Yet!</div>
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
