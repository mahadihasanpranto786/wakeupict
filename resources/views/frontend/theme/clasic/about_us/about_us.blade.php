@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
    @push('css')
        <style>
            h5.card-title {
                color: black;
            }

            p.card-text {
                color: black;
            }
        </style>
    @endpush
    <div>
        <!--========================== Header ============================-->

        @if (!empty($banner->image))
            <section style="background-image: url('{{ URL::asset($banner->image) }}');" id="header"
                class="jumbotron jumbotron-fluid text-white d-flex justify-content-center align-items-center mt-5">
                <div class="container text-center mt-5">
                    <div class="header-background p-4 mt-5">
                        <h1 class="display-4 text-uppercase"></h1>
                        <h2 class="text-uppercase ">{{ $banner->title }}</h2>
                        <p class="d-none d-sm-block text-uppercase">{!! $banner->description !!}</p>
                        <p id="service"></p>
                    </div>
                </div>
            </section>
        @endif


        <!--==========================  About  ============================-->

        <div class="container">
            @if (!empty($history->image))
                <section class="py-4 my-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="font-weight-bold mb-4">{{ $history->title }}</h4>
                            <p class="text-justify text-muted">{!! $history->description !!}</p>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ URL::asset($history->image) }}" class="img-fluid" alt="{{ $history->image_alt }}">
                        </div>
                    </div>
                </section>
            @endif
        </div>

        <!--========================== Footer ============================-->
        <section class="wict__team">
            <header class="section-header mb-5">
                <h1 class="text-center font-weight-bold">Wake Up ICT Team</h1>
                <div class="row mb-5" style="margin: 0 auto; width: 200px;">
                    <span class="left_bottom_border"></span>
                    <span class="left_bottom_border"></span>
                </div>
                <p class="text-center"></p>
            </header>

            <div class="container">
                @if (!empty($chairmanSir->image))
                    <div class="row mb-5">
                        <div class="col-lg-4 col-md-4 col-sm-1"></div>
                        <div class="col-lg-4 col-md-4 col-sm-10 mb-5">
                            <div class="card wict__team__chairman">
                                <img src="{{ URL::asset($chairmanSir->image) }}" class="card-img-top"
                                    alt="{{ $chairmanSir->image_alt }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $chairmanSir->name }}</h5>
                                    <p class="card-text">{{ $chairmanSir->designation }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-1"></div>
                    </div>
                @endif
                <div class="row">
                    @push('css')
                        <style>
                            .img_div {
                                position: relative;
                            }

                            .logo_part {
                                position: absolute;
                                top: 0;
                                left: 0;
                                display: flex;
                                padding: 0;
                                flex-direction: column;
                                width: 40px;
                                list-style: none;
                                background: #000000;
                                justify-content: space-around;
                                align-items: center;
                                height: 100%;
                            }

                            .logo_part li img {
                                width: 25px;
                                height: 25px;
                            }
                        </style>
                    @endpush
                    @foreach ($abouts as $about)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <a href="{{ $about->slug == null ? '#' : url('members/' . $about->slug) }}">
                                <div class="card wict__team__employee">
                                    <div class="img_div">
                                        <img src="{{ URL::asset($about->image) }}" class="card-img-top"
                                            alt="{{ $about->image_alt }}">
                                        {{-- <ul class="logo_part">
                                            @foreach ($about->stacks as $item)
                                                <li>
                                                    <img src="{{ asset($item->logo) }}" alt="">
                                                </li>
                                            @endforeach
                                        </ul> --}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $about->name }}</h5>
                                        <p class="card-text">{{ $about->designation }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center p-5">Our Interns</h3>
                <div class="row">
                    @foreach ($interns as $intern)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <a href="{{ $intern->slug == null ? '#' : url('members/' . $intern->slug) }}">
                                <div class="card wict__team__employee">
                                    <img src="{{ URL::asset($intern->image) }}" class="card-img-top"
                                        alt="{{ $intern->image_alt }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $intern->name }}</h5>
                                        <p class="card-text">{{ $intern->designation }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center p-5">Our Former Employees</h3>
                <div class="row">
                    @foreach ($oldEmployees as $about)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <a href="{{ $about->slug == null ? '#' : url('members/' . $about->slug) }}">
                                <div class="card wict__team__employee">
                                    <img src="{{ URL::asset($about->image) }}" class="card-img-top"
                                        alt="{{ $about->image_alt }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $about->name }}</h5>
                                        <p class="card-text">{{ $about->designation }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="container">
            <section class="py-4">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="font-weight-bold">Are you Dedicated, Hardworking, and Fun? Join Us!</h4>
                        <p class="text-justify text-muted">Wake Up ICT Academy is an accomplished training and service
                            providing company that gives high quality, professional, and innovative services to customers.
                            We pride ourselves on viably constructing organizations by empowering client encounters over all
                            stages.
                        </p>
                    </div>
            </section>
        </div>

        <!--========================== Footer ============================-->
    </div>
@endsection
