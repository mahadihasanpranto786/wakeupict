@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')


    <!--========================== Services Section ============================-->
    <section class="pt-5 mt-5">
        <div class="py-4 container">
            <h1 class="mb-3 text-center">{{ $courses->course_title }}</h1>
            <p class="text-muted">{!! $courses->long_description !!}</p>
            <hr class="my-4">
        </div>
    </section>

    <section class="course__details">
        <div class="container">
            <div class="course__details__need mb-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-5">
                            <h3 class="mb-3">আপনার জন্য কোর্সটি কেন গুরুত্বপূর্ণ ?</h3>
                            <p class="text-muted">{!! $courses->importents !!}</p>
                        </div>
                        <div class="mb-3">
                            <h3>কোর্সের বিষয়বস্তু:</h3>
                            <div id="accordion">
                                @foreach ($Courseitem as $item)
                                    @if ($item->course_order == 1)
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#collapseOne{{ $item->id }}" aria-expanded="true"
                                                        aria-controls="collapseOne{{ $item->id }}">
                                                        {{ $item->item_title }}
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne{{ $item->id }}" class="collapse show"
                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body text-muted">
                                                    {!! $item->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse"
                                                        data-target="#collapseOne{{ $item->id }}" aria-expanded="true"
                                                        aria-controls="collapseOne{{ $item->id }}">

                                                        {{ $item->item_title }}


                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne{{ $item->id }}" class="collapse"
                                                aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body text-muted">
                                                    {!! $item->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <img src="{{ URL::asset($courses->image) }}" style="height: 200px; width: 100%;"
                                class="img-fluid" alt="">
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><i class="fa fa-money text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp; কোর্স এর মূল্য: ৳ {{ $courses->price }}/-</li>
                            <li class="list-group-item"><i class="fa fa-calendar text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp; কোর্স এর সময়কাল: {{ $courses->time_line }}</li>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($course_members as $member)
                                <li class="list-group-item"><i class="fa fa-user text-success" aria-hidden="true"></i>
                                    &nbsp;&nbsp; কোর্সে এর প্রশিক্ষক: {{ $sl++ }}. <a href="">
                                        {{ App\User::find($member->member_id)->name }}
                                    </a></li>
                            @endforeach

                            <li class="list-group-item"><i class="fa fa-users text-success" aria-hidden="true"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp; প্রতি ব্যাচে শিক্ষার্থী সংখ্যা: {{ $courses->student_quantity }}
                            </li>

                            {{-- course fassility --}}
                            @foreach ($course_fassilities as $item)
                                <li class="list-group-item"><i class="fa fa-question-circle text-success"
                                        aria-hidden="true"></i>
                                    &nbsp;&nbsp; {{ $item->title }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ url('training/' . $courses->course_slug . '/student-registration') }}"><button
                                type="button" class="btn btn-success d-block my-4 font-weight-bold"><i
                                    class="fas fa-user-graduate"></i>
                                Register For This Course</button></a>
                    </div>

                </div>
            </div>
            <div class="course__details__purpose">
                <div class="row">
                    <div class="mb-5 mx-2">
                        <h3 class="mb-3">কোর্স শেষ করার পর আমি কী করতে পারব?</h3>
                        <p class="text-muted">{!! $courses->future_of_this_course !!}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="mx-2 mb-5">
                        <h3 class="mb-3">{{ $courses->course_title }} এর ভবিষ্যৎ সম্ভাবনা</h3>
                        <p class="text-muted">{!! $courses->possibilities_of_this_course !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============= Other Courses ========== -->
        <div class="course__details__other__courses">
            <div class="container">
                <h3 class="mb-4">Other courses available on Wake Up ICT:</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($moreCourses as $course)
                        <a style="text-decoration: none; color:black"
                            href="{{ url('training/' . $course->course_slug) }}">
                            <div class="item">
                                <div style="height: 600px;" class="card pb-5">
                                    <img style="height: 300px;" src="{{ URL::asset($course->image) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $course->course_title }}</h5>
                                        <p class="card-text">{!! $course->short_description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
