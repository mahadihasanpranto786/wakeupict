@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Course Lists
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
                        Lists</h3>
                </div>

                @php
                    $Create_course = 0;
                    $Delete_Course = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 49) {
                            $Create_course = 49;
                        } elseif ($roll->module_id == 75) {
                            $Delete_Course = 75;
                        }
                    }
                @endphp
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            @if ((checkUserType() == 0 && $Create_course != 0) || Auth::user()->type == 'Admin')
                                <a href="{{ route('create-course') }}">
                                    <button class="btn btn-primary my-2 align-top"><i class="fas fa-plus-circle"></i>Add
                                        Course
                                    </button>
                                </a>
                            @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Course Title</th>
                                        <th>Time Line</th>
                                        <th>Student Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>{{ $course->course_title }}
                                            </td>
                                            <td>{{ $course->time_line }} </td>
                                            <td>{{ $course->student_quantity }}
                                            </td>
                                            <td>{{ $course->price }} </td>
                                            <td class="border">
                                                <div class="text-center">
                                                    {{-- edit --}}
                                                    @if ((checkUserType() == 0 && $Create_course != 0) || Auth::user()->type == 'Admin')
                                                        <button title="Edit Course" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ url('course-edit/' . $course->id) }}"><i
                                                                    class="fas fa-pencil-alt text-white"></i>
                                                            </a>
                                                        </button>
                                                    @endif

                                                    @if ((checkUserType() == 0 && $Delete_Course != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <button title="Delete Course" class="btn btn-danger btn-sm"><a
                                                                class="flex items-center " id="delete"
                                                                href="{{ url('delete-course/' . $course->id) }}"><i
                                                                    class="fas fa-trash  text-white"></i></a>
                                                        </button>
                                                    @endif


                                                    @if (checkUserType() == 0)
                                                        {{-- view --}}
                                                        <button title="View Course" class="btn btn-info btn-sm"><a
                                                                class="flex items-center "
                                                                href="{{ url('course-view/' . $course->id) }}"><i
                                                                    class="fas fa-eye  text-white"></i></a>
                                                        </button>
                                                    @endif

                                                </div>
                                                @if (checkUserType() == 0)
                                                    <div class="text-center mt-1">
                                                        <button title="Add item" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center"
                                                                href="{{ url('course-items-list/' . $course->id) }}">
                                                                <small class="text-white">Item List</small>
                                                            </a>
                                                        </button>


                                                        <button title="Add member" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center"
                                                                href="{{ url('course-member-list/' . $course->id) }}">
                                                                <small class="text-white">Member</small>
                                                            </a>
                                                        </button>
                                                        <button title="Add Fassilities" class="btn btn-primary btn-sm"> <a
                                                                class="flex items-center"
                                                                href="{{ url('course-fassilities-list/' . $course->id) }}">
                                                                <small class="text-white">Fassilities</small>
                                                            </a>
                                                        </button>
                                                    </div>
                                                @endif
                                            </td>
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
        <!-- /.col -->
    </div>
@endsection
