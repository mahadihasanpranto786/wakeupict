@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    SEO Content Details
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('course_active', 'menu-open')

@section('menu_active_course', 'active bg-info')

@section('course_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">

                        @foreach ($courses as $content)
                            {{ $content->course_title }} Details:
                        @endforeach
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">

                            @foreach ($courses as $course)
                                <!-- BEGIN: Blog Layout -->
                                <div class="">
                                    <div class="p-3">
                                        <div class="">
                                            <strong> Course Thumbnail:</strong> <br>
                                            <img alt=" Content Image!" class="rounded-md" height="250px" width="350px"
                                                src="{{ URL::asset($content->image) }}">
                                        </div>
                                        <hr>
                                        <div><strong class="font-weight-bold">Course Time
                                                Line:</strong> {{ $content->time_line }}</div>
                                        <hr>
                                        <div><strong class="font-weight-bold"> Student
                                                Quantity:</strong>
                                            {{ $content->student_quantity }}</div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Course Price:</strong>
                                            {{ $content->price }}
                                        </div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Short
                                                Description:</strong>
                                            {!! $content->short_description !!}
                                        </div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Long
                                                Description:</strong>
                                            {!! $content->long_description !!}
                                        </div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Importents:</strong>
                                            {!! $content->importents !!}
                                        </div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Future Of This
                                                Course:</strong>
                                            {!! $content->future_of_this_course !!}
                                        </div>
                                        <hr>
                                        <div>
                                            <strong class="font-weight-bold">Possibilities Of This
                                                Course:</strong>
                                            {!! $content->possibilities_of_this_course !!}
                                        </div>
                                        <hr>


                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection
