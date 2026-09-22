@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach


@section('maincontent')
    <div>
        @if (!empty($homeSlider->slider_image))
            <div id="carouselExampleControls" class="carousel slide wict__main__slider" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 slider__image__mod" src="{{ URL::asset($homeSlider->slider_image) }}"
                            alt="{{ $homeSlider->slider_alt }}">
                    </div>
                    @foreach ($homeSliders as $slider)
                        @if ($homeSlider->slider_alt != $slider->slider_alt)
                            <div class="carousel-item ">
                                <img class="d-block w-100" src="{{ URL::asset($slider->slider_image) }}"
                                    alt="{{ $slider->slider_alt }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif

        {{-- ++++++++++++++++++++++++++++++ out national work ++++++++++++++++++++++++++++++++++ --}}
        <section id="goal" class="m-3">
            <div class="container">
                <header class="section-header mb-5">
                    <h1 class="text-center font-weight-bold">{{ $nationalWorkHeader->title }}</h1>
                    <div class="row mb-5" style="margin: 0 auto; width: 200px;">
                        <span class="left_bottom_border"></span>
                        <span class="left_bottom_border"></span>
                    </div>
                    <p class="text-center">{!! $nationalWorkHeader->description !!}</p>
                </header>
                <div class="row goal-cols">
                    @foreach ($nationalWork as $project)
                        <div class="col-md-4 wow fadeInUp">
                            <div class="goal-col shadow p-3 mb-5 bg-white rounded border">
                                <div class="img">
                                    <img src="{{ URL::asset($project->image) }}" alt="{{ $project->image_alt }}"
                                        class="img-fluid">
                                    <div class="icon"><i class="{{ $project->logo }}" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @php
                                    $blog_slug = App\model\Blog::find($project->blog_id)->slug_title;
                                @endphp
                                <h2 class="title"><a href="{{ url('our-blogs/' . $blog_slug) }}">{{ $project->title }}</a>
                                </h2>
                                <p>
                                    {!! $project->description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--========================== Our Goal Section / Our International Works ============================-->
        <section id="goal" class="m-3">
            <div class="container">
                <header class="section-header mb-5">
                    <h1 class="text-center font-weight-bold">{{ $internationalProjectHeader->title }}</h1>
                    <div class="row mb-5" style="margin: 0 auto; width: 200px;">
                        <span class="left_bottom_border"></span>
                        <span class="left_bottom_border"></span>
                    </div>
                    <p class="text-center">{!! $internationalProjectHeader->description !!}</p>
                </header>
                <div class="row goal-cols">
                    @foreach ($internationalWorks as $work)
                        <div class="col-md-4 wow fadeInUp mb-3">
                            @php
                                $blog_slug = App\model\Blog::find($work->blog_id)->slug_title;
                            @endphp
                            <a href="{{ url('our-blogs/' . $blog_slug) }}">
                                <img src="{{ URL::asset($work->image) }}"
                                    class="img-fluid shadow p-3 bg-white rounded border"
                                    style="filter: drop-shadow(10px 10px 4px #e2e2e2);" alt="{{ $work->image_alt }}">
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!--========================== Our Goal Section / Our Local Projects ============================-->
        <section id="goal" class="m-3">
            <div class="container">
                <header class="section-header mb-5">
                    <h1 class="text-center font-weight-bold">{{ $localProjectHeader->title }}</h1>
                    <div class="row mb-5" style="margin: 0 auto; width: 200px;">
                        <span class="left_bottom_border"></span>
                        <span class="left_bottom_border"></span>
                    </div>
                    <p class="text-center">{!! $localProjectHeader->description !!}</p>
                </header>
                <div class="row goal-cols">
                    @foreach ($localProjects as $local)
                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
                            @php
                                $blog_slug = App\model\Blog::find($local->blog_id)->slug_title;
                            @endphp
                            <a href="{{ url('our-blogs/' . $blog_slug) }}">
                                <img src="{{ URL::asset($local->image) }}"
                                    class="img-fluid shadow p-3 mb-5 bg-white rounded border"
                                    style="filter: drop-shadow(10px 10px 4px #e2e2e2);" alt="{{ $local->image_alt }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!--========================== Our Goal Section / Our On going Development============================-->
        <section id="goal" class="m-3">
            <div class="container">
                <header class="section-header mb-5">
                    <h1 class="text-center font-weight-bold">{{ $developmentProjectHeader->title }}</h1>
                    <div class="row mb-5" style="margin: 0 auto; width: 200px;">
                        <span class="left_bottom_border"></span>
                        <span class="left_bottom_border"></span>
                    </div>
                    <p class="text-center">{!! $developmentProjectHeader->description !!}</p>
                </header>
                <div class="row goal-cols">
                    @foreach ($projects as $project)
                        <div class="col-md-4 wow fadeInUp">
                            <div class="goal-col shadow p-3 mb-5 bg-white rounded border">
                                <div class="img">
                                    <img src="{{ URL::asset($project->image) }}" alt="{{ $project->image_alt }}"
                                        class="img-fluid">
                                    <div class="icon"><i class="{{ $project->logo }}" aria-hidden="true"></i>
                                    </div>
                                </div>
                                @php
                                    $blog_slug = App\model\Blog::find($project->blog_id)->slug_title;
                                @endphp
                                <h2 class="title"><a
                                        href="{{ url('our-blogs/' . $blog_slug) }}">{{ $project->title }}</a>
                                </h2>
                                <p>
                                    {!! $project->description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-343NCHFV71"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-343NCHFV71');
        </script>


    </div>
@endsection
