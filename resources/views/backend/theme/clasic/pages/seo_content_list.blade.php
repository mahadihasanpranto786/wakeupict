@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    SEO Content Details
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('seo_pages', 'menu-open')

@section('menu_active_seo', 'active bg-info')

@section('pages_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">

                        @foreach ($single_content as $content)
                            {{ $content->page_name }} Details:
                        @endforeach
                    </h3>
                    <div class="float-right">
                        <a class="flex items-center  btn btn-secondary" href="{{ url('pages-seo') }}"><i
                                class="fas fa-list"></i>
                            Pages List
                        </a>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">

                            @foreach ($single_content as $content)
                                @if ($content->title != null)
                                    <!-- BEGIN: Blog Layout -->
                                    <div class="">
                                        <div class="p-5">
                                            <div class="">
                                                <img alt="Content Image!" class="rounded-md" height="250px"
                                                    width="350px" src="{{ asset($content->image) }}">
                                            </div><br>
                                            <div class="font-weight-bold">OG
                                                URL:{{ $content->og_url }}</div><br>
                                            <div class="font-weight-bold"> Title:
                                                {{ $content->title }}</div><br>
                                            <div class="font-weight-bold">
                                                <strong>Description:</strong>
                                                {!! $content->description !!}
                                            </div><br>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div class="font-weight-bold"> <strong>OG Site
                                                                Name:</strong>
                                                            {{ $content->og_site_name }}</div><br>
                                                        <div class="font-weight-bold"> <strong>OG
                                                                Type:</strong>
                                                            {{ $content->og_type }}
                                                        </div><br>
                                                        <div class="font-weight-bold"> <strong>OG Image
                                                                Width:</strong>
                                                            {{ $content->og_image_width }}</div><br>
                                                        <div class="font-weight-bold"> <strong>OG Image
                                                                Height:</strong>
                                                            {{ $content->og_image_height }}</div><br>
                                                        <div class="font-weight-bold"> <strong>OG
                                                                Locale:</strong>
                                                            {{ $content->og_locale }}</div><br>


                                                        <div class="font-weight-bold"> <strong>Link
                                                                Canonical:</strong>
                                                            {{ $content->link_canonical }}</div><br>
                                                        <div class="font-weight-bold"> <strong>MS
                                                                Validate:</strong>
                                                            {{ $content->msvalidate }}</div><br>

                                                    </td>
                                                    <td>
                                                        <div class="font-weight-bold"> <strong>Article
                                                                Publisher:</strong>
                                                            {{ $content->article_publisher }}</div><br>
                                                        <div class="font-weight-bold"> <strong>Article
                                                                Modified
                                                                Time:</strong> {{ $content->article_modified_time }}
                                                        </div><br>
                                                        <div class="font-weight-bold"> <strong>Twitter
                                                                Card:</strong>
                                                            {{ $content->twitter_card }}</div><br>
                                                        <div class="font-weight-bold"> <strong>Twitter
                                                                Label 1:</strong>
                                                            {{ $content->twitter_label1 }} </div><br>
                                                        <div class="font-weight-bold"> <strong>Twitter
                                                                Data 1:</strong>
                                                            {{ $content->twitter_data1 }}</div><br>
                                                        <div class="font-weight-bold"> <strong>Google
                                                                Site
                                                                Varification:</strong>
                                                            {{ $content->google_site_verification }}</div><br>


                                                    </td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                @else
                                    <div class=" col-span-6 md:col-span-6 xl:col-span-4 box">
                                        <h1 class="badge bg-danger text-lg text-center">
                                            This Page Has No Content Yet. Please Insert!
                                        </h1>
                                    </div>
                                @endif
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
