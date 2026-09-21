@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Admited Students List
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')

@section('menu_active_active', 'active')

@section('admited_student_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        List Of Admited Students</h3>

                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @if (checkUserType() == 0)
                                    <a href="{{ route('insert-student') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i>Insert
                                            Student
                                        </button>
                                    </a>
                                @endif
                                @if (!empty($studentInfo))
                                    <div>
                                        <div class="col-md-8 offset-2">
                                            <table class="table table-striped border border-secondary">
                                                <thead>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Course Name</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th id="courseName">: {{ $studentInfo['courseName'] }}
                                                                </th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Batch Number</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th> : {{ $studentInfo['batchNong'] }}</th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Total Student</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th id="totalStuent">: {{ $studentInfo['totalStudent'] }}
                                                                </th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Total Amount</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th id="totalAmount">:
                                                                    {{ $studentInfo['total_course_after_discount'] }} TK
                                                                </th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Total Paid Amount</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th id="totalPaid">:
                                                                    {{ $studentInfo['totalPaid'] }} TK</th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <th scope="col">Total Due Amount</th>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <th id="totalDue">:
                                                                    {{ $studentInfo['totalDue'] }} TK</th>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                @if (empty($studentInfo))
                                    <div class="col-md-4 bg-light float-right">
                                        <div>
                                            <form action="{{ route('search-admitted-student') }}" method="GET">
                                                @csrf
                                                <div class="input-group input-group-sm">
                                                    <input class="form-control bg-light" type="number" name="search"
                                                        placeholder="Enter Student Number" aria-label="Search">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-navbar" type="submit">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if (empty($searchNumber) == empty($studentInfo))
                                <div class="float-right my-1">
                                    <a href="{{ route('print-all-student') }}" title="Print All Student"
                                        class="btn btn-light btn-sm"><i class="fas fa-print"></i></a>
                                </div>
                            @elseif (!empty($studentInfo))
                                <div class="float-right my-1">
                                    <form action="{{ route('course-and-batch-wise-student-print') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $studentInfo['course_id'] }}">
                                        <input type="hidden" name="batch_id" value="{{ $studentInfo['batch_id'] }}">
                                        <button type="submit" title="Print course and batch wise student"
                                            class="btn btn-light btn-sm"><i class="fas fa-print"></i></button>
                                    </form>

                                </div>
                            @else
                                <div class="float-right my-1">
                                    <a href="{{ url('print-searched-student/' . $searchNumber) }}"
                                        title="Print searched Student" class="btn btn-light btn-sm"><i
                                            class="fas fa-print"></i></a>
                                </div>
                            @endif
                            @if (!empty($searchNumber))
                                <div>
                                    <h2><i>Searched Number : {{ $searchNumber }}</i> </h2>
                                </div>
                            @endif

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Student Info</th>
                                        <th>Payment Info</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = ($students->currentpage() - 1) * $students->perpage() + 1;
                                    @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                @if ($student->student_photo == null)
                                                    New Registered
                                                @else
                                                    <img src="{{ URL::asset($student->student_photo) }}"
                                                        alt="student photo" height="70" width="70">
                                                @endif
                                            </td>
                                            <td>
                                                <strong>Name: </strong> {{ $student->student_name }} <br>

                                                <strong>Phone: </strong> {{ $student->personal_call_no }} <br>

                                                <strong>Email: </strong> {{ $student->email }} <br>

                                                <strong>Education: </strong>
                                                {{ $student->educational_qualification }}<br>

                                                <strong>Batch No: </strong> {{ $student->batch->batch_number }}<br>
                                                <strong>Student Type: </strong> {{ $student->student_type }}
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <a class="flex items-center btn btn-info btn-sm mx-1"
                                                        href="{{ url('paid-details/' . $student->id) }}"><i
                                                            class="fas fa-eye text-white"></i>
                                                        Payment Info</a>
                                                    @if (checkUserType() == 0)
                                                        <a class="flex items-center btn btn-success btn-sm"
                                                            href="{{ url('student-payment/' . $student->id) }}"><i
                                                                class="fab fa-paypal text-white"></i>
                                                            Payment</a>
                                                    @endif
                                                </div><br>
                                                <strong>Course: </strong>
                                                {{ App\model\Course::find($student->course_id)->course_title }}<br>
                                                <strong>Course Fee: </strong>
                                                {{ $student->course_fee }} TK<br>
                                                @if ($student->course_fee != $student->course_after_discount)
                                                    <strong>Course After Discount: </strong>
                                                    {{ $student->course_after_discount }} TK<br>
                                                @endif
                                                <strong>Paid: </strong>
                                                @php
                                                    $payment = App\model\StudentPayment::where('student_id', $student->id)->sum('paid');
                                                    $return = App\model\StudentPayment::where('student_id', $student->id)->sum('return_money');
                                                    $paidTotal = (int) $payment - (int) $return;
                                                    $totalDue = (int) $student->course_after_discount - (int) $paidTotal;
                                                @endphp
                                                {{ $payment }} TK<br>
                                                @if ($return != 0)
                                                    <strong>Return: </strong>
                                                    {{ $return }} TK<br>
                                                @endif
                                                <strong>Due: </strong>
                                                {{ $totalDue }}TK<br>

                                            </td>
                                            <td class="border">
                                                <div class="d-flex">
                                                    {{-- edit --}}
                                                    @if (checkUserType() == 0)
                                                        <a title="Edit Student"
                                                            class="btn btn-primary btn-sm flex items-center "
                                                            href="{{ url('admited-student-edit/' . $student->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                        {{-- delete --}}
                                                        <a title="Delete Student"
                                                            class="btn btn-danger btn-sm flex items-center " id="delete"
                                                            href="{{ url('admited-delete-student/' . $student->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    @endif
                                                    {{-- student invoice --}}
                                                    <a title="Print" class="btn btn-info btn-sm flex items-center "
                                                        href="{{ url('admited-student-view/' . $student->id) }}">
                                                        <i class="fas fa-eye text-white"></i>
                                                    </a>

                                                    {{-- view --}}
                                                    <a title="View" class="btn btn-dark btn-sm flex items-center "
                                                        href="{{ url('admited-student-print/' . $student->id) }}">
                                                        <i class="fas fa-print text-white"></i>
                                                    </a>

                                                </div>

                                                {{-- <div class="mt-1"> --}}
                                                {{-- active status --}}
                                                {{-- @if ($student->active_status == 1)
                                                        <a title="Inactive"
                                                            class="btn btn-danger btn-sm flex items-center text-white"
                                                            href="{{ url('admitted-student-inactive/' . $student->id) }}">
                                                            Inacive</a>
                                                    @else
                                                        <a title="Active"
                                                            class="btn btn-success btn-sm flex items-center text-white"
                                                            href="{{ url('admitted-student-active/' . $student->id) }}">
                                                            Active</a>

                                                    @endif
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right mx-4">

                            {{ $students->appends(Request::except('page'))->links() }}
                            {{-- {{ $students->links() }} --}}
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
