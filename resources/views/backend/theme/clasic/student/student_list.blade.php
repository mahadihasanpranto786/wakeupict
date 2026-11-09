@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Student Directory — Applied Students
@endsection
{{-- menu active start --}}
@section('student_active', 'menu-open')
@section('menu_active_active', 'active')
@section('student_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <style>
        .card-footer .pagination {
            margin-bottom: 0 !important;
            margin-left: auto !important;
            justify-content: flex-end !important;
            float: right;
        }
        .bg-rose-600, .bg-emerald-100 {
            color: #000000 !important;
            font-weight: 800 !important;
        }
    </style>
    <div class="content-wrapper-inner p-3">

        <!-- Unified Student Management Navigation Tabs -->
        @include('backend.theme.clasic.student.include.student_directory_nav')

        <div class="card shadow-sm border-0 rounded-lg">
            <!-- Header Bar -->
            <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex align-items-center flex-wrap">
                    <h4 class="font-weight-bold mb-0 text-dark mr-3" style="font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', sans-serif;">
                        <i class="fas fa-user-edit text-primary mr-2"></i> List Of Applied Students
                    </h4>
                    <span class="badge badge-primary px-3 py-2 font-weight-bold shadow-sm" style="font-size: 13px;">
                        <i class="fas fa-users mr-1"></i> Total Applied Students: {{ $students->total() }}
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

                <div class="mt-2 mt-sm-0">
                    @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                        <a href="{{ route('insert-student') }}" class="btn btn-primary font-weight-bold shadow-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Insert Student
                        </a>
                    @endif
                </div>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="card-body bg-light py-2 border-bottom">
                <form action="{{ route('students-list') }}" method="GET" class="form-row align-items-center justify-content-end">
                    <div class="col-md-4 col-sm-6 my-1">
                        <select name="course_id" class="form-control" onchange="this.form.submit()">
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
                    <div class="col-md-4 col-sm-6 my-1">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search"
                                value="{{ request('search') }}"
                                placeholder="Phone, Name, or Email" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if(request('course_id') || request('search'))
                        <div class="col-auto my-1">
                            <a href="{{ route('students-list') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times mr-1"></i> Reset
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Bulk Actions Toolbar (Hidden by default, shown on select) -->
            <form id="bulkStudentDeleteForm" action="{{ route('admin.students.bulk-delete') }}" method="POST">
                @csrf
                <input type="hidden" name="delete_type" id="bulkStudentDeleteType" value="soft">
                <div id="bulkActionBar" class="card-header bg-dark text-white py-2 px-3 d-none align-items-center justify-content-between flex-wrap">
                    <div class="my-1">
                        <span class="font-weight-bold text-white">
                            <i class="fas fa-check-square mr-1 text-warning"></i>
                            <span id="selectedCount" class="badge badge-warning text-dark font-weight-bold px-2 py-1">0</span>
                            Students Selected
                        </span>
                    </div>
                    <div class="d-flex align-items-center flex-wrap my-1" style="gap: 8px;">
                        <button type="button" class="btn btn-warning btn-sm font-weight-bold text-dark" onclick="triggerStudentBulk('soft')">
                            <i class="fas fa-user-slash mr-1"></i> Soft Delete (নিষ্ক্রিয় করুন)
                        </button>
                        <button type="button" class="btn btn-danger btn-sm font-weight-bold text-white" onclick="triggerStudentBulk('permanent')">
                            <i class="fas fa-trash-alt mr-1"></i> Permanent Delete (চিরতরে মুছে ফেলুন)
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table Content -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 35px;" class="text-center">
                                    <input type="checkbox" id="selectAllStudents" title="Select All Students">
                                </th>
                                <th style="width: 4%">SL</th>
                                <th>Student Details</th>
                                <th>Reg Number</th>
                                <th>Batch No:</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Course Applied</th>
                                <th style="width: 17%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($students as $index => $student)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $student->id }}" class="student-checkbox" form="bulkStudentDeleteForm">
                                    </td>
                                    <td>{{ $students->firstItem() ? ($students->firstItem() + $index) : ($index + 1) }}</td>
                                    <td>
                                        <div class="font-weight-bold text-dark">{{ $student->student_name }}</div>
                                        <div class="text-xs text-muted mt-0.5">
                                            @if($student->registration_status === 'approved')
                                                <span class="badge badge-success px-1.5 py-0.5">Approved</span>
                                            @elseif($student->registration_status === 'rejected')
                                                <span class="badge badge-danger px-1.5 py-0.5">Rejected</span>
                                            @else
                                                <span class="badge badge-warning text-dark px-1.5 py-0.5">Pending</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light border text-primary font-mono font-weight-bold" style="font-size: 13px;">
                                            {{ $student->registration_number ?: 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($student->batch_id == null || !$student->batch)
                                            <span class="badge badge-secondary">New Student</span>
                                        @else
                                            <span class="badge badge-info font-weight-bold">{{ $student->batch->batch_number }}</span>
                                            <small class="d-block text-muted">Code: {{ $student->batch->batch_code }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="tel:{{ $student->personal_call_no }}" class="text-dark font-weight-bold">
                                            {{ $student->personal_call_no }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($student->email)
                                            <a href="mailto:{{ $student->email }}" class="text-muted small">
                                                {{ $student->email }}
                                            </a>
                                        @else
                                            <span class="text-muted small">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $coursesList = $student->courses_list;
                                        @endphp
                                        @if($coursesList->count() > 0)
                                            <div class="d-flex flex-column" style="gap: 3px;">
                                                @foreach($coursesList as $cItem)
                                                    <span class="badge badge-light border text-dark p-1 text-left font-weight-bold" style="white-space: normal; font-size: 11px;">
                                                        <i class="fas fa-book text-primary mr-1"></i>{{ $cItem['title'] }}
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

                                    <td>
                                        <div class="d-flex align-items-center" style="gap: 4px;">
                                            {{-- Details Modal Trigger --}}
                                            <button type="button" title="View Full Student Details" class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#studentModal{{ $student->id }}">
                                                <i class="fas fa-eye"></i> Details
                                            </button>

                                            {{-- Edit --}}
                                            @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                                                <a title="Edit Student" class="btn btn-primary btn-sm" href="{{ url('student-edit/' . $student->id) }}">
                                                    <i class="fas fa-pencil-alt text-white"></i>
                                                </a>
                                            @endif

                                            {{-- Delete Dropdown (Soft vs Permanent) --}}
                                            @if ((checkUserType() == 0 && $Delete_Admitted_Student != 0) || Auth::user()->type == 'Admin')
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-danger btn-sm dropdown-toggle font-weight-bold" type="button" id="deleteMenu{{ $student->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Delete Options">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right shadow-lg p-2" aria-labelledby="deleteMenu{{ $student->id }}" style="min-width: 220px;">
                                                        <div class="dropdown-header font-weight-bold text-dark px-2 py-1 border-bottom mb-1">
                                                            <i class="fas fa-trash text-danger mr-1"></i> Delete Options
                                                        </div>
                                                        <!-- Soft Delete -->
                                                        <a class="dropdown-item py-2 px-2 rounded font-weight-bold text-dark" href="{{ url('delete-student/' . $student->id . '?type=soft') }}" onclick="return confirm('Are you sure you want to SOFT DELETE (deactivate) this student? Portal access will be closed.')">
                                                            <i class="fas fa-user-slash text-warning mr-2"></i> Soft Delete (নিষ্ক্রিয়)
                                                        </a>
                                                        <div class="dropdown-divider my-1"></div>
                                                        <!-- Permanent Delete Trigger -->
                                                        <a class="dropdown-item py-2 px-2 rounded font-weight-bold text-danger" href="#" data-toggle="modal" data-target="#permDeleteModal{{ $student->id }}">
                                                            <i class="fas fa-trash-alt text-danger mr-2"></i> Permanent Delete (চিরতরে)
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- Permanent Deletion Modal -->
                                                <div class="modal fade" id="permDeleteModal{{ $student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                                    Are you sure you want to PERMANENTLY delete student: <span class="text-danger">{{ $student->student_name }}</span>?
                                                                </p>
                                                                <div class="alert alert-warning text-xs mb-0">
                                                                    <i class="fas fa-info-circle mr-1"></i> <strong>Cascaded Deletion Notice:</strong> This will permanently delete:
                                                                    <ul class="mb-0 mt-1 pl-3 font-weight-bold">
                                                                        <li>Student Master Record &amp; Photos</li>
                                                                        <li>Student Portal Account &amp; Credentials</li>
                                                                        <li>All LMS Course Enrollments &amp; Quiz Attempts</li>
                                                                        <li>Linked Admission &amp; Payment Records</li>
                                                                    </ul>
                                                                    <strong class="text-danger d-block mt-2">Warning: This action CANNOT be undone!</strong>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer py-2 bg-light d-flex justify-content-between">
                                                                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                                                                <a href="{{ url('delete-student/' . $student->id . '?type=permanent') }}" class="btn btn-danger font-weight-bold">
                                                                    <i class="fas fa-trash-alt mr-1"></i> Yes, Permanently Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- ============================================================= -->
                                <!-- COMPREHENSIVE STUDENT INFORMATION MODAL -->
                                <!-- ============================================================= -->
                                <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel{{ $student->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                        <div class="modal-content shadow-lg border-0">
                                            <!-- Modal Header -->
                                            <div class="modal-header bg-dark text-white py-3">
                                                <div class="d-flex align-items-center">
                                                    @if ($student->student_photo && file_exists(public_path($student->student_photo)))
                                                        <img src="{{ asset($student->student_photo) }}" alt="{{ $student->student_name }}" class="rounded-circle mr-3 border border-light" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        <div class="rounded-circle mr-3 d-flex align-items-center justify-content-center bg-primary text-white font-weight-bold" style="width: 50px; height: 50px; font-size: 20px;">
                                                            {{ mb_substr($student->student_name, 0, 1, 'utf-8') }}
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h5 class="modal-title font-weight-bold mb-0" id="studentModalLabel{{ $student->id }}">
                                                            {{ $student->student_name }}
                                                        </h5>
                                                        <div class="text-xs text-light mt-1">
                                                            <span class="badge badge-light text-dark font-mono font-weight-bold">Reg: {{ $student->registration_number ?: 'N/A' }}</span>
                                                            @if($student->registration_status === 'approved')
                                                                <span class="badge badge-success ml-1">Portal Approved</span>
                                                            @elseif($student->registration_status === 'rejected')
                                                                <span class="badge badge-danger ml-1">Rejected</span>
                                                            @else
                                                                <span class="badge badge-warning text-dark ml-1">Pending Verification</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body p-4" style="background-color: #f8fafc; font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', sans-serif;">

                                                <!-- SECTION 1: ACADEMIC & BATCH DETAILS -->
                                                <div class="card border-0 shadow-sm mb-3">
                                                    <div class="card-header bg-white py-2 font-weight-bold text-primary">
                                                        <i class="fas fa-graduation-cap mr-1"></i> Academic &amp; Batch Information
                                                    </div>
                                                    <div class="card-body py-2">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Official Registration Number:</span>
                                                                <strong class="font-mono text-primary font-weight-bold" style="font-size: 15px;">
                                                                    {{ $student->registration_number ?: 'N/A' }}
                                                                </strong>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Batch Number &amp; Code:</span>
                                                                @if($student->batch)
                                                                    <span class="badge badge-info">{{ $student->batch->batch_number }}</span>
                                                                    <span class="badge badge-light border font-mono">Code: {{ $student->batch->batch_code }}</span>
                                                                    <small class="d-block text-muted mt-1">
                                                                        Duration: {{ $student->batch->start_date ? date('d M, Y', strtotime($student->batch->start_date)) : 'N/A' }} — {{ $student->batch->end_date ? date('d M, Y', strtotime($student->batch->end_date)) : 'N/A' }}
                                                                    </small>
                                                                @else
                                                                    <span class="text-muted">Not Assigned Yet</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <span class="text-muted small d-block mb-1">Applied Course(s):</span>
                                                                @if($coursesList->count() > 0)
                                                                    <div class="d-flex flex-wrap" style="gap: 6px;">
                                                                        @foreach($coursesList as $c)
                                                                            <span class="badge badge-light border text-dark px-2 py-1 font-weight-bold">
                                                                                <i class="fas fa-check-circle text-success mr-1"></i> {{ $c['title'] }}
                                                                                @if(!empty($c['price']))
                                                                                    <span class="text-muted ml-1">(৳{{ number_format($c['price']) }})</span>
                                                                                @endif
                                                                            </span>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <span class="text-muted">None</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SECTION 1.5: PORTAL ACCESS & LOGIN CREDENTIALS -->
                                                @php
                                                    $studentAcc = $student->account ?: \App\model\StudentAccount::where('student_id', $student->id)
                                                        ->orWhere('phone', $student->personal_call_no)
                                                        ->orWhere('registration_number', $student->registration_number)
                                                        ->first();
                                                    $rawPhoneDigits = preg_replace('/[^0-9]/', '', (string)$student->personal_call_no);
                                                    $defaultPhonePass = strlen($rawPhoneDigits) >= 6 ? substr($rawPhoneDigits, -6) : '123456';
                                                    $displayPass = $studentAcc && !empty($studentAcc->plain_password) ? $studentAcc->plain_password : $defaultPhonePass;
                                                @endphp
                                                <div class="card border-0 shadow-sm mb-3" style="background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); border: 1px solid #FDE68A !important;">
                                                    <div class="card-header bg-transparent py-2 font-weight-bold text-dark d-flex align-items-center justify-content-between">
                                                        <span><i class="fas fa-key mr-1 text-warning"></i> স্টুডেন্ট পোর্টাল লগইন ও পাসওয়ার্ড (Portal Credentials)</span>
                                                        @if($studentAcc && $studentAcc->registration_status === 'approved')
                                                            <span class="badge badge-success px-2 py-1">Portal Active</span>
                                                        @elseif($studentAcc && $studentAcc->registration_status === 'rejected')
                                                            <span class="badge badge-danger px-2 py-1">Rejected</span>
                                                        @else
                                                            <span class="badge badge-warning text-dark px-2 py-1 font-weight-bold">Pending Verification</span>
                                                        @endif
                                                    </div>
                                                    <div class="card-body py-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block font-weight-bold">Login Username / Reg No:</span>
                                                                <span class="font-mono font-weight-bold text-primary" style="font-size: 14px;">
                                                                    {{ $student->registration_number ?: ($studentAcc ? $studentAcc->registration_number : $student->personal_call_no) }}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-3 mb-2">
                                                                <span class="text-muted small d-block font-weight-bold">Login Phone:</span>
                                                                <span class="font-mono font-weight-bold text-dark" style="font-size: 14px;">
                                                                    {{ $student->personal_call_no }}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-5 mb-2">
                                                                <span class="text-muted small d-block font-weight-bold">Student Password (পাসওয়ার্ড):</span>
                                                                <div class="input-group input-group-sm">
                                                                    <input type="password" id="studentModalPass{{ $student->id }}" class="form-control font-mono font-weight-bold bg-white text-dark" value="{{ $displayPass }}" readonly style="font-size: 13px; letter-spacing: 1px;">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="btn btn-dark" onclick="togglePassView('studentModalPass{{ $student->id }}', this)" title="Show / Hide Password">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-warning font-weight-bold text-dark" onclick="copyPassVal('studentModalPass{{ $student->id }}', this)" title="Copy Password">
                                                                            <i class="fas fa-copy"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted d-block mt-1 font-sans">
                                                                    <i class="fas fa-info-circle mr-1 text-warning"></i>{{ $studentAcc && !empty($studentAcc->plain_password) ? 'স্টুডেন্টের নিজস্ব সেট করা পাসওয়ার্ড' : 'প্রাথমিক ডিফল্ট পাসওয়ার্ড (মোবাইল নম্বরের শেষ ৬ ডিজিট)' }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SECTION 2: PERSONAL & GUARDIAN DETAILS -->
                                                <div class="card border-0 shadow-sm mb-3">
                                                    <div class="card-header bg-white py-2 font-weight-bold text-dark">
                                                        <i class="fas fa-user mr-1 text-info"></i> Personal &amp; Family Details
                                                    </div>
                                                    <div class="card-body py-2">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Father's Name:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->fathers_name ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Mother's Name:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->mothers_name ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">Gender:</span>
                                                                <span class="font-weight-bold text-dark">{{ ucfirst($student->gander) ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">Date of Birth:</span>
                                                                <span class="font-weight-bold text-dark">
                                                                    {{ $student->date_of_birth ? date('d M, Y', strtotime($student->date_of_birth)) : 'N/A' }}
                                                                </span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">Age:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->age ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">Religion:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->religion ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">Nationality:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->nationality ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-4 mb-2">
                                                                <span class="text-muted small d-block">NID / Birth Reg No:</span>
                                                                <span class="font-mono font-weight-bold text-dark">{{ $student->national_id_no ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Occupation:</span>
                                                                <span class="font-weight-bold text-dark">{{ $student->occupation ?: 'N/A' }}</span>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Submitted On:</span>
                                                                <span class="text-dark font-weight-bold">
                                                                    {{ $student->created_at ? $student->created_at->format('d M, Y h:i A') : 'N/A' }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SECTION 3: CONTACT & ADDRESS -->
                                                <div class="card border-0 shadow-sm mb-3">
                                                    <div class="card-header bg-white py-2 font-weight-bold text-dark">
                                                        <i class="fas fa-map-marker-alt mr-1 text-danger"></i> Contact &amp; Address Information
                                                    </div>
                                                    <div class="card-body py-2">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Personal Phone:</span>
                                                                <a href="tel:{{ $student->personal_call_no }}" class="font-weight-bold text-primary font-mono" style="font-size: 14px;">
                                                                    <i class="fas fa-phone mr-1"></i> {{ $student->personal_call_no }}
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Guardian Phone:</span>
                                                                @if($student->guardian_call_no)
                                                                    <a href="tel:{{ $student->guardian_call_no }}" class="font-weight-bold text-dark font-mono">
                                                                        <i class="fas fa-phone-alt mr-1"></i> {{ $student->guardian_call_no }}
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted">N/A</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <span class="text-muted small d-block">Email Address:</span>
                                                                @if($student->email)
                                                                    <a href="mailto:{{ $student->email }}" class="font-weight-bold text-dark">
                                                                        <i class="fas fa-envelope mr-1 text-muted"></i> {{ $student->email }}
                                                                    </a>
                                                                @else
                                                                    <span class="text-muted">N/A</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Present Address:</span>
                                                                <p class="mb-0 text-dark small font-weight-bold">{{ $student->present_address ?: 'N/A' }}</p>
                                                            </div>
                                                            <div class="col-md-6 mb-2">
                                                                <span class="text-muted small d-block">Permanent Address:</span>
                                                                <p class="mb-0 text-dark small font-weight-bold">{{ $student->permanent_address ?: 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- SECTION 4: EDUCATIONAL QUALIFICATIONS -->
                                                <div class="card border-0 shadow-sm mb-3">
                                                    <div class="card-header bg-white py-2 font-weight-bold text-dark">
                                                        <i class="fas fa-university mr-1 text-success"></i> Educational Qualifications
                                                    </div>
                                                    <div class="card-body py-2">
                                                        @php
                                                            $qData = !empty($student->qualifications_data) ? (is_array($student->qualifications_data) ? $student->qualifications_data : json_decode($student->qualifications_data, true)) : null;
                                                        @endphp

                                                        @if(!empty($qData) && is_array($qData))
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-bordered mb-0">
                                                                    <thead class="bg-light">
                                                                        <tr>
                                                                            <th>Exam / Degree</th>
                                                                            <th>Board / Institute</th>
                                                                            <th>Roll / Reg</th>
                                                                            <th>Passing Year</th>
                                                                            <th>Result / GPA</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($qData as $qItem)
                                                                            <tr>
                                                                                <td class="font-weight-bold">{{ $qItem['exam'] ?? $qItem['degree'] ?? 'N/A' }}</td>
                                                                                <td>{{ $qItem['board'] ?? $qItem['institute'] ?? 'N/A' }}</td>
                                                                                <td>{{ $qItem['roll'] ?? $qItem['reg'] ?? '-' }}</td>
                                                                                <td>{{ $qItem['year'] ?? $qItem['passing_year'] ?? '-' }}</td>
                                                                                <td><span class="badge badge-success">{{ $qItem['result'] ?? $qItem['gpa'] ?? '-' }}</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="text-muted small d-block">Degree / Qualification:</span>
                                                                    <span class="font-weight-bold text-dark">{{ $student->educational_qualification ?: 'N/A' }}</span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <span class="text-muted small d-block">Result / GPA:</span>
                                                                    <span class="badge badge-success">{{ $student->result ?: 'N/A' }}</span>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <span class="text-muted small d-block">Passing Year:</span>
                                                                    <span class="font-weight-bold text-dark">{{ $student->passing_year ?: 'N/A' }}</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Modal Footer Actions -->
                                            <div class="modal-footer bg-white border-top py-2 d-flex justify-content-between">
                                                <div>
                                                    <a href="{{ url('student-view/' . $student->id) }}" target="_blank" class="btn btn-outline-dark btn-sm font-weight-bold">
                                                        <i class="fas fa-print mr-1"></i> Print Admission Slip
                                                    </a>
                                                    @if ((checkUserType() == 0 && $Add_student != 0) || Auth::user()->type == 'Admin')
                                                        <a href="{{ url('student-edit/' . $student->id) }}" class="btn btn-primary btn-sm font-weight-bold ml-1">
                                                            <i class="fas fa-edit mr-1"></i> Edit Student
                                                        </a>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /MODAL -->

                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-users-slash fa-3x mb-2 d-block"></i>
                                        No applied students found matching the criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bottom Pagination Footer (Image 4 Requirement) -->
            @if($students->hasPages())
                <div class="card-footer bg-white py-3 border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                        <div class="small text-muted font-sans font-weight-bold my-1">
                            Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} applied students
                        </div>
                        <div class="ml-auto my-1 text-right">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        function togglePassView(id, btn) {
            var input = document.getElementById(id);
            var icon = btn.querySelector('i');
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                if (icon) icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                if (icon) icon.className = 'fas fa-eye';
            }
        }

        function copyPassVal(id, btn) {
            var input = document.getElementById(id);
            if (!input) return;
            var originalType = input.type;
            input.type = 'text';
            input.select();
            input.setSelectionRange(0, 99999);
            document.execCommand('copy');
            input.type = originalType;
            var icon = btn.querySelector('i');
            if (icon) {
                var oldClass = icon.className;
                icon.className = 'fas fa-check text-success';
                setTimeout(function() {
                    icon.className = oldClass;
                }, 1500);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('selectAllStudents');
            var checkboxes = document.querySelectorAll('.student-checkbox');
            var bulkBar = document.getElementById('bulkActionBar');
            var countSpan = document.getElementById('selectedCount');

            function updateBulkBar() {
                var checked = document.querySelectorAll('.student-checkbox:checked');
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

            window.triggerStudentBulk = function(type) {
                var form = document.getElementById('bulkStudentDeleteForm');
                var typeInput = document.getElementById('bulkStudentDeleteType');
                var checked = document.querySelectorAll('.student-checkbox:checked');

                if (checked.length === 0) {
                    alert('Please select at least one student!');
                    return;
                }

                typeInput.value = type;

                if (type === 'permanent') {
                    if (confirm('CRITICAL WARNING: You are about to PERMANENTLY DELETE ' + checked.length + ' student(s) and ALL their related accounts, payments, and enrollments!\n\nThis action CANNOT be undone. Proceed?')) {
                        form.submit();
                    }
                } else {
                    if (confirm('Are you sure you want to SOFT DELETE (deactivate) ' + checked.length + ' student(s)?')) {
                        form.submit();
                    }
                }
            };
        });
    </script>
@endsection
