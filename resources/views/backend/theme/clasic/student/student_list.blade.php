@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    List Of Applied Student
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('student_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        List Of Applied Student</h3>

                </div>

                @php
                    $Add_student = 0;
                    $Delete_Admitted_Student = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 76) {
                            $Add_student = 76;
                        } elseif ($roll->module_id == 77) {
                            $Delete_Admitted_Student = 77;
                        }
                    }
                @endphp
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('insert-student') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Insert
                                            Student
                                        </button>
                                    </a>
                                @endif
                                <div class="col-md-8 float-right">
                                    <form action="{{ route('students-list') }}" method="GET" class="d-flex flex-wrap justify-content-end align-items-center" style="gap: 8px;">
                                        <div style="min-width: 200px;">
                                            <select name="course_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                                <option value="">-- All Courses (সকল কোর্স) --</option>
                                                @if(isset($allCourses))
                                                    @foreach($allCourses as $cOption)
                                                        <option value="{{ $cOption->id }}" {{ request('course_id') == $cOption->id ? 'selected' : '' }}>
                                                            {{ $cOption->course_title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm" style="width: 220px;">
                                            <input class="form-control bg-light" type="text" name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Phone, Name or Email" aria-label="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if(request('course_id') || request('search'))
                                            <a href="{{ route('students-list') }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-times"></i> Reset
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        {{-- <th>Photo</th> --}}
                                        <th>Student Name</th>
                                        <th>Batch No:</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Course</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            {{-- <td>
                                                @if ($student->student_photo == null)
                                                    New Registered
                                                @else
                                                    <img src="{{ URL::asset($student->student_photo) }}" alt="student photo" height="70"
                                                        width="70">
                                                @endif
                    
                                            </td> --}}
                                            <td>
                                                <div class="font-weight-bold text-dark">{{ $student->student_name }}</div>
                                                <div class="text-xs text-muted mt-0.5">
                                                    <span class="badge badge-light border">1 Student Account</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($student->batch_id == null)
                                                    <span class="badge bg-success">New Student</span>
                                                @else
                                                    {{ $student->batch->batch_number }}
                                                @endif

                                            </td>
                                            <td>
                                                {{ $student->personal_call_no }} </td>
                                            <td>{{ $student->email }} </td>
                                            <td>
                                                @php
                                                    $coursesList = $student->courses_list;
                                                @endphp
                                                @if($coursesList->count() > 0)
                                                    <div class="d-flex flex-column" style="gap: 3px;">
                                                        @foreach($coursesList as $cItem)
                                                            <span class="badge badge-info p-1 text-left font-weight-bold" style="white-space: normal; font-size: 11px;">
                                                                <i class="fas fa-book-reader mr-1"></i>{{ $cItem['title'] }}
                                                            </span>
                                                        @endforeach
                                                        @if($coursesList->count() > 1)
                                                            <span class="badge badge-secondary p-0.5 text-xs font-weight-bold" style="font-size: 10px;">
                                                                {{ $coursesList->count() }} Courses Applied
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-muted text-xs">N/A</span>
                                                @endif
                                            </td>

                                            <td class="border">
                                                <div class="d-flex">
                                                    {{-- edit --}}
                                                    @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                                                        <a title="Edit Student"
                                                            class="btn btn-primary btn-sm flex items-center "
                                                            href="{{ url('student-edit/' . $student->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    @endif
                                                    @if ((checkUserType() == 0 && $Delete_Admitted_Student != 0) || Auth::user()->type == 'Admin')
                                                        {{-- delete --}}
                                                        <a title="Delete Student"
                                                            class="btn btn-danger btn-sm flex items-center " id="delete"
                                                            href="{{ url('delete-student/' . $student->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    @endif

                                                    @if (checkUserType() == 0)
                                                        {{-- student invoice --}}
                                                        {{-- <button title="Print" class="btn btn-dark align-top"> <a class="flex items-center"
                                                            href={{ url('student-print/' . $student->id) }}> <i data-feather="printer"
                                                                class="w-4 h-4 mr-1 text-white"></i>
                                                        </a></button> --}}
                                                        {{-- view --}}

                                                        <a title="View" class="btn btn-primary btn-sm flex items-center "
                                                            href="{{ url('student-view/' . $student->id) }}"><i
                                                                class="fas fa-eye text-white"></i>
                                                        </a>
                                                    @endif
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $students->links() }}
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
