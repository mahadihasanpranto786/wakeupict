@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')

    <div>
        @if (!empty($banner->image))
            <!--========================== Header ============================-->
            <section style="background-image: url('{{ URL::asset($banner->image) }}');" id="header"
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
                    @foreach ($services as $service)
                        <div class="col-md-6 my-3">
                            <div class="card wict__services__others">
                                <span class="card-img-top mt-3"><i class="{{ $service->logo }}"
                                        aria-hidden="true"></i></span>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $service->title }}</h5>
                                    <p class="card-text">{!! $service->description !!}</p>
                                    <a href="{{ route('contact-us-page') }}" class="btn btn-success">Get A Quote</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

@endsection
