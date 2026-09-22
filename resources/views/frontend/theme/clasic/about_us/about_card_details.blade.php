@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('maincontent')
    <div class="row">
        @push('css')
            <link rel="stylesheet" href="{{ asset('about_us_details') }}/vendors/linericon/style.css">
            <link rel="stylesheet" href="{{ asset('about_us_details') }}/css/style.css">
            <link rel="stylesheet" href="{{ asset('about_us_details') }}/css/responsive.css">

            <style>
                .media-body {
                    -webkit-box-flex: 1;
                    -ms-flex: 1;
                    margin-top: 21px;
                    flex: 1;
                }

                .home_banner_area {
                    background: rgb(240, 103, 37);
                    background: linear-gradient(90deg, rgba(240, 103, 37, 0.6418942577030813) 0%, rgba(240, 103, 37, 1) 100%);
                }

                .tabs_inner .tab-content .tab-pane .list:before {
                    content: "";
                    height: 84%;
                    width: 5px;
                    background: rgba(0, 0, 0, 0.2);
                    position: absolute;
                    left: 46%;
                    transform: translateX(-50%);
                    top: 75px;
                }
                .key {
                    display: flex;
                    align-items: center;
                    padding: 10px;
                    margin: 5px;
                    border-radius: 5px;
                }

                .key img {
                    margin-right: 10px;
                }
            </style>
        @endpush
        <div class="col-12">
            <!--================Home Banner Area =================-->
            <section class="home_banner_area">
                <div class="container box_1620">
                    <div class="banner_inner d-flex align-items-center">
                        <div class="banner_content">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-5">
                                    <img width="100%" class="pr-3" src="{{ asset($about->image) }}" alt="">
                                    <div class="my-4">
                                        <h3>
                                            <b>Love To Work With:</b>
                                        </h3>

                                        <ul class="list-unstyled d-flex flex-wrap">
                                            @foreach ($about->assign_stacks as $stack)
                                                <li class="key">
                                                    <img width="40" src="{{ asset($stack->stack->logo) }}" alt="Laravel Logo">
                                                    {{ $stack->stack->name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-7">
                                    <div class="personal_text">
                                        <h3>{{ $about->name }}</h3>
                                        <h4>{{ $about->designation }}</h4>
                                        @php
                                            if ($about->singleAboutDetail) {
                                                $joining_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->joining_date)->format('F Y') : null;
                                                $end_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->end_date)->format('F Y') : null;
                                            }
                                        @endphp

                                        @if ($about->singleAboutDetail)
                                            <ul class="list basic_info">
                                                <li><i class="fa fa-calendar" style="font-size:24px"></i>
                                                    {{ $about->singleAboutDetail->employee_type }} : {{ $joining_date }}
                                                    -
                                                    {{ $about->singleAboutDetail->currently_working_status == 1 ? 'Present' : $end_date }}
                                                </li>
                                                {{-- <li><a href="#"><i class="lnr lnr-envelope"></i> businessplan@donald</a>
                                            </li> --}}
                                            </ul>
                                            <br>
                                            <br>
                                            <h4>Description: </h4>
                                            <p>{!! $about->singleAboutDetail->description !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================End Home Banner Area =================-->

            <!--================My Tabs Area =================-->
            @if (count($about->projects) > 0)
                
            <section class="mytabs_area p_120">
                <div class="container">
                    <div class="tabs_inner">
                        <h2 class="text-center text-dark">Projects</h2>

                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <ul class="list">
                                    @foreach ($about->projects as $project)
                                        @php
                                            $start_date = $project ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : '';
                                            $end_date = $project ? \Carbon\Carbon::parse($project->end_date)->format('M Y') : '';
                                            $is_checked = $project->currently_working_status;
                                        @endphp
                                        <li>
                                            <span></span>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <p>{{ $start_date }} to
                                                        {{ $is_checked == 1 ? 'Present' : $end_date }}</p>
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{ $project->project_title }}</h4>
                                                    <p>{{ $project->short_description }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.card -->
            @endif
        </div>
        <!-- /.col -->
    </div>
@endsection
