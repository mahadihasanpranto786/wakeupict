@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')

    @if (!empty($banner->image))
        <!--========================== Header ============================-->
        <section id="header" style="background-image: url('{{ URL::asset($banner->image) }}');"
            class="jumbotron jumbotron-fluid text-white d-flex justify-content-center align-items-center mt-5">
            <div class="container text-center mt-5">
                <div class="header-background p-4 mt-5">
                    <h1 class="display-4 text-uppercase "></h1>
                    <h2 class="text-uppercase ">{{ $banner->banner_title }}</h2>
                    <p class="d-none d-sm-block text-uppercase">{!! $banner->banner_description !!}</p>
                    <p id="service"></p>
                </div>
            </div>
        </section>

        <!--========================== Services Section ============================-->
        <section class="text-center py-4">
            <div class="container">
                <h1>{{ $banner->body_title }}</h1>
                <p>{!! $banner->body_description !!}</p>
                <hr>
            </div>
        </section>
    @endif
    <section class="wict__services__head">

    </section>
    <section class="wict__services">
        <div class="container">
            <div class="row text-center">

                @foreach ($courseData as $content)
                    <div class="col-md-6 my-3">
                        <div class="card wict__services__others">
                            <a href="{{ 'training/' . $content->course_slug }}" class="text-white">
                                <img class="card-img-top" class="course_img" src="{{ URL::asset($content->image) }}"
                                    alt="{{ $content->image_alt }}">
                                <div class="card-body">
                                    <h5 class="card-title"> {{ $content->course_title }}</h5>
                                    <p class="card-text">{!! $content->short_description !!}</p>
                                    <p class="card-text p-0 m-0">
                                        {!! $content->course_content !!}
                                    </p>
                                </div>
                                <a href="{{ 'training/' . $content->course_slug }}"><button type="button"
                                        class="btn btn-warning btn-lg d-inline-block">View
                                        Details </button></a>
                                <div class="card-footer text-muted">
                                    <h4 class="pt-2 text-white">{{ $content->price }} TK</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </section>
@endsection
