<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/animate.css') }}">
    <!-- <link rel="stylesheet" href="css/animate.css"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/custom/custom.css') }}">
    {{-- magnific-popup --}}
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/popup/magnific-popup.css') }}">
    {{-- carouse --}}
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/OwlCarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('frontend/plugins/OwlCarousel/owl.theme.default.min.css') }}">
    <!-- fab icon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ URL::asset('frontend/image/wakeupict-fabicon.png') }}" />
    {{-- tostr notification --}}
    <link rel="stylesheet" href="{{ URL::asset('admin/css/toastr/toastr.min.css') }}">
    {{-- student form links start --}}
    <!-- Icons font CSS-->
    <link href="{{ URL::asset('frontend/student/vendor/mdi-font/css/material-design-iconic-font.min.css') }}"
        rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link rel="stylesheet" href="{{ URL::asset('frontend/fonts/google-font-poppings.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/datepicker/datepicker.css') }}">
    <!-- Main CSS-->
    <link href="{{ URL::asset('frontend/student/css/main.css') }}" rel="stylesheet" media="all">
    {{-- student form links end --}}



    <title> @yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <link rel="canonical" href="@yield('link_canonical')" />
    <meta property="og:locale" content="@yield('og_locale')" />
    <meta property="og:type" content="@yield('og_type')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="@yield('og_url')" />
    <meta property="og:site_name" content="@yield('og_site_name')" />
    <meta property="article:publisher" content="@yield('article_publisher')" />
    <meta property="article:modified_time" content="@yield('article_modified_time')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:width" content="@yield('og_image_width')" />
    <meta property="og:image:height" content="@yield('og_image_height')" />
    <meta name="twitter:card" content="@yield('twitter_card')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="@yield('image')" />
    <meta name="twitter:label1" content="@yield('twitter_label1')" />
    <meta name="twitter:data1" content="@yield('twitter_data1')" />
    <meta name="msvalidate.01" content="@yield('msvalidate')" />
    <meta name="google-site-verification" content="@yield('google_site_verification')" />

    @stack('css')
</head>
<style>
    .ex1 {
        opacity: 0;
    }

    .ex1 span {
        position: relative;
        top: 10px;
        left: 10px;
        opacity: 0;
    }

    .ex2 {
        opacity: 0;
    }

    .ex2 span {
        position: relative;
        left: -10px;
        opacity: 0;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
</style>

<body>

    <!--========================== navigation panel / secondary Menu ============================-->

    @include('frontend.theme.clasic.include.header')
    {{-- main content --}}
    @yield('maincontent')
    <!--========================== Footer ============================-->

    @include('frontend.theme.clasic.include.footer')

    <!-- for use offline we use this code -->
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                showButtonPanel: true,
                showTodayButton: true,
                setDate: new Date(),
                showAnim: 'slide',
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
            });
        })
    </script>
    <script type="text/javascript" src="{{ URL::asset('frontend/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('frontend/plugins/OwlCarousel/owl.carousel.min.js') }}"></script>

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
    <script type="text/javascript" src="{{ URL::asset('frontend/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('frontend/plugins/Particels/jquery.particles.min.js') }}"></script>

    <script>
        /* Apply plugin to a div */
        $(document).ready(function() {
            $('.canvas').particles({
                connectParticles: true,
                color: '#ffffff',
                size: 3,
                maxParticles: 40,
                speed: 1.8
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(window).width() < 840 && $(".js-slidein").removeClass("js-slidein"), $(".js-slidein").each(function(
                i) {
                var s = $(this).offset().top;
                $(window).scrollTop() + $(window).height() > s && $(this).removeClass("js-slidein")
            }), $(window).scroll(function() {
                $(".js-slidein").each(function(i) {
                    var s = $(this).offset().top + $(this).outerHeight() / 3;
                    $(window).scrollTop() + $(window).height() > s && $(this).addClass(
                        "js-slidein-visible")
                })
            })
        });
    </script>

    <script>
        (function(a) {
            a.fn.textyle = function(b) {
                var g = this;
                var d = g.contents();
                var f = {
                    duration: 400,
                    delay: 100,
                    easing: "swing",
                    callback: null
                };
                var c = a.extend(f, b);
                d.each(function() {
                    var h = a(this);
                    if (this.nodeType === 3) {
                        e(h)
                    }
                });

                function e(h) {
                    h.replaceWith(h.text().replace(/(\S)/g, "<span>$1</span>"))
                }
                return this.each(function() {
                    var h = g.children().length;
                    g.css("opacity", 1);
                    for (var j = 0; j < h; j++) {
                        g.children("span:eq(" + j + ")").delay(c.delay * j).animate({
                            opacity: 1,
                            top: 0,
                            left: 0
                        }, c.duration, c.easing, c.callback)
                    }
                })
            }
        }(jQuery));
    </script>
    <script>
        $(window).on('load', function() {
            //simple use
            $('.ex1').textyle();
            //you can select options or add callback
            $('.ex2').textyle({
                duration: 400,
                delay: 100,
                easing: 'swing',
                callback: function() {
                    $(this).css({
                        color: 'coral',
                        transition: '1s',
                    });
                    $('.desc').css('opacity', 1);
                }
            });
        });
    </script>
    {{-- notification alert --}}
    <script src="{{ URL::asset('admin/js/toastr.min.js') }}"></script>

    <script src="{{ URL::asset('admin/sweetalert/sweetalert.min.js') }}"></script>

    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}")
        </script>
    @elseif (!empty(Session::get('error')))
        <script>
            toastr.error("{{ Session::get('error') }}")
        </script>
    @endif
    {{-- form validation --}}
    <script src="{{ URL::asset('common/jquery.form-validation.min.js') }}"></script>
    <script>
        $.validate({
            lang: 'en'
        });
    </script>
    <script src="{{ URL::asset('frontend/js/smooth-scroll.polyfills.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ URL::asset('frontend/custom/custom.js') }}"></script>
    <script>
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 300
        });
    </script>
    {{-- magnific-popup --}}
    <script type="text/javascript" src="{{ URL::asset('frontend/plugins/popup/jquery.magnific-popup.js') }}"></script>

    @yield('script')

</body>

</html>
