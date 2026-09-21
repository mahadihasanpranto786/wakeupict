@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Edit Contact
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('active_contact', 'side-menu--active')

@section('contact', 'side-menu__sub-open bg-info')

@section('contact_list', 'side-menu--active')
{{-- menu active end --}}

@section('maincontant')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Update Contacts
        </h2>
    </div>

    <form action="{{ route('edit-contact') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: pages Content -->
            <input type="hidden" name="id" id="id" value="{{ $contact->id }}">
            <div class="intro-y col-span-12 lg:col-span-6">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13 select2-show-search"
                        placeholder="Course Title" value="{{ $contact->name }}">
                    @error('name')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13 select2-show-search"
                        placeholder="Course Title" value="{{ $contact->phone }}">
                    @error('phone')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>


            </div>

            <div class="intro-y col-span-12 lg:col-span-6">

                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13 select2-show-search"
                        placeholder="Course Title" value="{{ $contact->email }}">
                    @error('email')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="website">Website</label><a href="javascript:;" data-toggle="modal"
                        data-target="#website_main" style="float: right; border-radius: 3px;"
                        class="btn-success">Preview</a>
                    <input type="text" name="website" id="website_edit"
                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13 select2-show-search"
                        placeholder="Slug Title" value="{{ $contact->website }}">
                    @error('website')
                        <span class="text-theme-6">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </div>

        <div>
            <label for="message">Short Description</label>
            <textarea type="text" name="message" class="intro-y editor form-control py-3 px-4 box pr-10 placeholder-theme-13"
                cols="30" rows="4">{{ $contact->message }}</textarea>
            @error('message')
                <span class="text-theme-6">{{ $message }}</span>
            @enderror
        </div>

        <button class="btn btn-primary  mt-5">Submit</button>

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
