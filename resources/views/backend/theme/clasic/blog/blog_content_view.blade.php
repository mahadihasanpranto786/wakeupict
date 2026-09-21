@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    View Blog Content
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('blog_active', 'menu-open')

@section('menu_active_blog', 'active bg-info')

@section('blog_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        {{ $blogContent->title }} Details:
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">

                            <!-- BEGIN: Blog Layout -->
                            <div class="">
                                <div class="p-3">
                                    <div class="">
                                        <strong>Content File:</strong> <br>
                                        @if ($blogContent->file_1 != null)
                                            <img alt=" Content Image!" class="rounded-md" height="230px" width="320px"
                                                src="{{ URL::asset($blogContent->file) }}">
                                            <img alt=" Content Image!" class="rounded-md" height="230px" width="320px"
                                                src="{{ URL::asset($blogContent->file_1) }}">
                                            <img alt=" Content Image!" class="rounded-md" height="230px" width="320px"
                                                src="{{ URL::asset($blogContent->file_2) }}">
                                        @elseif($blogContent->file == null)
                                        @else
                                            <img alt=" Content Image!" class="rounded-md" height="250px" width="350px"
                                                src="{{ URL::asset($blogContent->file) }}">
                                        @endif

                                    </div>
                                    <hr>
                                    <div><strong>Title: </strong> {{ $blogContent->title }}</div>
                                    <hr>
                                    <div><strong>Image alt: </strong>
                                        {{ $blogContent->image_alt }}</div>
                                    <hr>
                                    <div>
                                        <strong> Content Design: </strong>
                                        {{ $blogContent->content_design }}
                                    </div>
                                    <hr>
                                    <div>
                                        <strong>File Type: </strong>
                                        {{ $blogContent->file_type }}
                                    </div>
                                    <hr>
                                    <div>
                                        <strong>Ordering Number: </strong>
                                        {{ $blogContent->order }}
                                    </div>
                                    <hr>
                                    <div>
                                        <strong>Description: </strong>
                                        {!! $blogContent->short_description !!}
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection
