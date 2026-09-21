@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Course Member
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">


                    <form action="{{ route('update-course-fassility') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- BEGIN: pages Content -->
                        <input type="hidden" name="fassility_id" value="{{ $fassilities->id }}">
                        <div>
                            <label for="title">টাইটেল</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                value="{{ $fassilities->title }}">
                            @error('title')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="fassility_order">কোর্স সিরিয়াল নংঃ</label>
                            <input type="number" name="fassility_order" id="fassility_order" class="form-control"
                                placeholder="Course Order" value="{{ $fassilities->fassility_order }}">
                            @error('fassility_order')
                                <span class="text-theme-6">{{ $message }}</span>
                            @enderror
                        </div>


                        <button class="btn btn-primary  mt-5">Update</button>

                    </form>
                </div>
            </div>
        </div>

        @include('backend/theme/clasic/include/modal_photos/modal')
    </div>
@endsection




@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Update Course Item
@endsection
{{-- menu active start --}}
@section('active_course', 'side-menu--active')

@section('courses', 'side-menu__sub-open')

@section('create_course', 'side-menu--active')
{{-- menu active end --}}

@section('maincontant')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{-- {{ $courses->course_title }} --}}
        </h2>
    </div>

    <form action="{{ route('update-course-fassility') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: pages Content -->
            <input type="hidden" name="fassility_id" value="{{ $fassilities->id }}">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div>
                    <label for="title">টাইটেল</label>
                    <input type="text" name="title" id="title"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13" placeholder="Title"
                        value="{{ $fassilities->title }}">
                    @error('title')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="fassility_order">কোর্স সিরিয়াল নংঃ</label>
                    <input type="number" name="fassility_order" id="fassility_order"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13" placeholder="Course Order"
                        value="{{ $fassilities->fassility_order }}">
                    @error('fassility_order')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="intro-y col-span-12 lg:col-span-6">

                <img style="height: 95%; margin-top: 4%;" src="{{ asset('preview_image') }}/course_fassility_title.png"
                    alt="course fassility">
            </div>
        </div>
        <button class="btn btn-primary  mt-5">Update</button>

    </form>

    </div>
    <!-- END: Content -->
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="side-menu-dark-post.html"
        class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
        <div class="dark-mode-switcher__toggle border"></div>
    </div>
    <!-- END: Dark Mode Switcher-->


    {{-- date picker --}}
    <script type="text/javascript" src="{{ asset('frontend') }}/js/jquery-3.3.1.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


@endsection
