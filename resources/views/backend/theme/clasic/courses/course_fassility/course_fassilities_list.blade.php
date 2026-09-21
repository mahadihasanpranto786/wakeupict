@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Course Fassilities List
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

                        Course Fassilities List</h3>


                    <a href="{{ route('courses-list') }}" class="btn btn-secondary  float-right mx-1"><i
                            class="fas fa-arrow-left"></i>Course List</a>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if (checkUserType() == 0)
                                <button type="button" class="btn btn-primary my-2" data-toggle="modal"
                                    data-target="#courer_facilities_add">
                                    <i class="fas fa-plus-circle"></i> Add Course Fassility
                                </button>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>কোর্সের নাম</th>
                                        <th>টাইটেল</th>
                                        <th>কোর্স সিরিয়াল নংঃ</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($course_fassilities as $item)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                {{ App\model\Course::find($item->course_id)->course_title }} </td>
                                            <td>{{ $item->title }} </td>
                                            <td>{{ $item->fassility_order }}
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td class="border">
                                                    <div>

                                                        {{-- edit --}}

                                                        <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('course-fassility_edit/' . $item->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>

                                                        <button title="Delete" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-course-fassility/' . $item->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>


                                                    </div>

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        {{-- course facilities add --}}
        <div class="modal fade" id="courer_facilities_add" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h1 class="text-center"> Add Course Fassilities</h1> <br>
                        </div>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-lg font-medium mr-auto">

                        </h2>
                        <form action="{{ route('store-course-fassility') }}" method="POST">
                            @csrf
                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">


                                <div class="col-span-12 sm:col-span-12">
                                    <input type="hidden" name="course_id" value="{{ $courses->id }}">
                                    <label for="title">টাইটেল</label>
                                    <a href="javascript:;" data-toggle="modal" data-target="#course_fassility_title"
                                        style="float: right; border-radius: 3px;" class="btn-success">Preview</a>
                                    <input type="text" name="title" id="title"
                                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13"
                                        placeholder="Title" value="{{ old('title') }}">
                                    @error('title')
                                        <span class="text-theme-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-12">
                                    <label for="fassility_order">কোর্স সিরিয়াল নংঃ</label>
                                    <input type="number" name="fassility_order" id="fassility_order"
                                        class="intro-y form-control py-3 px-4 box pr-10 placeholder-theme-13"
                                        placeholder="Course Order" value="{{ old('fassility_order') }}">
                                    @error('fassility_order')
                                        <span class="text-theme-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> <!-- END: Modal Body -->
                            <!-- BEGIN: Modal Footer -->
                            <div class="modal-footer text-right">
                                <button type="submit" class="btn btn-primary btn-block w-20">Insert</button>

                            </div> <!-- END: Modal Footer -->
                        </form>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


                @include('backend/theme/clasic/include/modal_photos/modal')
            </div>
        @endsection
