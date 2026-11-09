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
    <style>
        .pagination {
            margin-bottom: 0 !important;
            justify-content: flex-end !important;
        }
        .bg-rose-600, .bg-emerald-100 {
            color: #000000 !important;
            font-weight: 800 !important;
        }
    </style>
    <div class="p-3">
        @include('backend.theme.clasic.student.include.student_directory_nav')
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2 d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex align-items-center flex-wrap p-2">
                        <h3 class="card-title font-weight-bold mb-0 text-dark mr-2">
                            <i class="fas fa-user-check text-success mr-1"></i> List Of Admitted Students
                        </h3>
                        <span class="badge badge-success px-3 py-2 font-weight-bold shadow-sm" style="font-size: 13px;">
                            <i class="fas fa-users mr-1"></i> Total Admitted Students: {{ $students->total() }}
                        </span>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-1">
                                @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
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

                            <!-- Bulk Actions Toolbar (Hidden by default, shown on select) -->
                            <form id="bulkAdmitedDeleteForm" action="{{ route('admin.admited-students.bulk-delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="delete_type" id="bulkAdmitedDeleteType" value="soft">
                                <div id="bulkAdmitedActionBar" class="card-header bg-dark text-white py-2 px-3 d-none align-items-center justify-content-between flex-wrap my-2 rounded">
                                    <div class="my-1">
                                        <span class="font-weight-bold text-white">
                                            <i class="fas fa-check-square mr-1 text-warning"></i>
                                            <span id="selectedAdmitedCount" class="badge badge-warning text-dark font-weight-bold px-2 py-1">0</span>
                                            Admitted Students Selected
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap my-1" style="gap: 8px;">
                                        <button type="button" class="btn btn-warning btn-sm font-weight-bold text-dark" onclick="triggerAdmitedBulk('soft')">
                                            <i class="fas fa-user-slash mr-1"></i> Soft Delete (নিষ্ক্রিয় করুন)
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm font-weight-bold text-white" onclick="triggerAdmitedBulk('permanent')">
                                            <i class="fas fa-trash-alt mr-1"></i> Permanent Delete (চিরতরে মুছে ফেলুন)
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 35px;" class="text-center">
                                            <input type="checkbox" id="selectAllAdmited" title="Select All Admitted Students">
                                        </th>
                                        <th>SL</th>
                                        <th>Photo</th>
                                        <th>Student Info</th>
                                        <th>Payment Info</th>
                                        <th class="text-center" style="width: 17%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = ($students->currentpage() - 1) * $students->perpage() + 1;
                                    @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="ids[]" value="{{ $student->id }}" class="admited-checkbox" form="bulkAdmitedDeleteForm">
                                            </td>
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
                                                <div class="d-flex align-items-center" style="gap: 4px;">
                                                    @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                                                        {{-- edit --}}
                                                        <a title="Edit Student"
                                                            class="btn btn-primary btn-sm"
                                                            href="{{ url('admited-student-edit/' . $student->id) }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    @endif

                                                    {{-- Delete Dropdown (Soft vs Permanent) --}}
                                                    @if ((checkUserType() == 0 && $Delete_Admitted_Student != 0) || Auth::user()->type == 'Admin')
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-danger btn-sm dropdown-toggle font-weight-bold" type="button" id="deleteAdmitedMenu{{ $student->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Delete Options">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right shadow-lg p-2" aria-labelledby="deleteAdmitedMenu{{ $student->id }}" style="min-width: 220px;">
                                                                <div class="dropdown-header font-weight-bold text-dark px-2 py-1 border-bottom mb-1">
                                                                    <i class="fas fa-trash text-danger mr-1"></i> Delete Options
                                                                </div>
                                                                <!-- Soft Delete -->
                                                                <a class="dropdown-item py-2 px-2 rounded font-weight-bold text-dark" href="{{ url('admited-delete-student/' . $student->id . '?type=soft') }}" onclick="return confirm('Are you sure you want to SOFT DELETE (deactivate) this admitted student? Payments and portal access will be marked inactive.')">
                                                                    <i class="fas fa-user-slash text-warning mr-2"></i> Soft Delete (নিষ্ক্রিয়)
                                                                </a>
                                                                <div class="dropdown-divider my-1"></div>
                                                                <!-- Permanent Delete Trigger -->
                                                                <a class="dropdown-item py-2 px-2 rounded font-weight-bold text-danger" href="#" data-toggle="modal" data-target="#permDeleteAdmitedModal{{ $student->id }}">
                                                                    <i class="fas fa-trash-alt text-danger mr-2"></i> Permanent Delete (চিরতরে)
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <!-- Permanent Deletion Modal -->
                                                        <div class="modal fade" id="permDeleteAdmitedModal{{ $student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content border-danger shadow-lg">
                                                                    <div class="modal-header bg-danger text-white py-3">
                                                                        <h5 class="modal-title font-weight-bold">
                                                                            <i class="fas fa-exclamation-triangle mr-1"></i> Permanent Delete Confirmation
                                                                        </h5>
                                                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body p-4 text-left font-sans">
                                                                        <p class="font-weight-bold text-dark mb-2">
                                                                            Are you sure you want to PERMANENTLY delete admitted student: <span class="text-danger">{{ $student->student_name }}</span>?
                                                                        </p>
                                                                        <div class="alert alert-warning text-xs mb-0">
                                                                            <i class="fas fa-info-circle mr-1"></i> <strong>Cascaded Deletion Notice:</strong> This action will permanently remove:
                                                                            <ul class="mb-0 mt-1 pl-3 font-weight-bold">
                                                                                <li>Admitted Student Master Record</li>
                                                                                <li>All Student Payments &amp; Accounts Income</li>
                                                                                <li>Student Portal Account &amp; LMS Course Enrollments</li>
                                                                                <li>Applied Student Profile</li>
                                                                            </ul>
                                                                            <strong class="text-danger d-block mt-2">Warning: All payment histories will be permanently wiped out!</strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer py-2 bg-light d-flex justify-content-between">
                                                                        <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                                                                        <a href="{{ url('admited-delete-student/' . $student->id . '?type=permanent') }}" class="btn btn-danger font-weight-bold">
                                                                            <i class="fas fa-trash-alt mr-1"></i> Yes, Permanently Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    {{-- student invoice --}}
                                                    <a title="View" class="btn btn-info btn-sm"
                                                        href="{{ url('admited-student-view/' . $student->id) }}">
                                                        <i class="fas fa-eye text-white"></i>
                                                    </a>

                                                    {{-- print --}}
                                                    <a title="Print" class="btn btn-dark btn-sm"
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('selectAllAdmited');
            var checkboxes = document.querySelectorAll('.admited-checkbox');
            var bulkBar = document.getElementById('bulkAdmitedActionBar');
            var countSpan = document.getElementById('selectedAdmitedCount');

            function updateBulkBar() {
                var checked = document.querySelectorAll('.admited-checkbox:checked');
                if (checked.length > 0) {
                    bulkBar.classList.remove('d-none');
                    bulkBar.classList.add('d-flex');
                    countSpan.innerText = checked.length;
                } else {
                    bulkBar.classList.remove('d-flex');
                    bulkBar.classList.add('d-none');
                    countSpan.innerText = '0';
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(function(cb) {
                        cb.checked = selectAll.checked;
                    });
                    updateBulkBar();
                });
            }

            checkboxes.forEach(function(cb) {
                cb.addEventListener('change', updateBulkBar);
            });

            window.triggerAdmitedBulk = function(type) {
                var form = document.getElementById('bulkAdmitedDeleteForm');
                var typeInput = document.getElementById('bulkAdmitedDeleteType');
                var checked = document.querySelectorAll('.admited-checkbox:checked');

                if (checked.length === 0) {
                    alert('Please select at least one admitted student!');
                    return;
                }

                typeInput.value = type;

                if (type === 'permanent') {
                    if (confirm('CRITICAL WARNING: You are about to PERMANENTLY DELETE ' + checked.length + ' admitted student(s) and ALL their related payments, income, and accounts!\n\nThis action CANNOT be undone. Proceed?')) {
                        form.submit();
                    }
                } else {
                    if (confirm('Are you sure you want to SOFT DELETE (deactivate) ' + checked.length + ' admitted student(s)?')) {
                        form.submit();
                    }
                }
            };
        });
    </script>
@endsection
