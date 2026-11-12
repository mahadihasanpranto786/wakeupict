@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Student Registration Verification & Portal Access Control')

@section('student_active', 'menu-open')
@section('menu_active_active', 'active')
@section('registration_verification_active', 'active')

@section('maincontant')
<style>
    .card-footer .pagination {
        margin-bottom: 0 !important;
        margin-left: auto !important;
        justify-content: flex-end !important;
        float: right;
    }
    .custom-select, .form-control {
        min-width: 120px;
    }
    .bg-rose-600, .bg-emerald-100 {
        color: #000000 !important;
        font-weight: 800 !important;
    }
</style>
<div class="content-wrapper-inner p-3">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="font-weight-bold mb-1">
                <i class="fas fa-user-check text-primary mr-2"></i> Registration Verification &amp; Access Control
            </h3>
            <p class="text-muted small mb-0 font-sans">
                Manage dynamic registration approvals, portal access controls, and restricted verification requests.
            </p>
        </div>
    </div>

    <!-- Notifications Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- SECTION 8: 6 Registration Statistics Cards -->
    <div class="row">
        <!-- Total Registrations -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-primary" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Total Reg.</div>
                        <div class="h3 font-weight-bold text-dark mb-0">{{ number_format($totalRegistrations) }}</div>
                    </div>
                    <div class="bg-primary-light rounded-circle p-2 text-primary">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Registrations -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-warning" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Pending</div>
                        <div class="h3 font-weight-bold text-warning mb-0">{{ number_format($pendingRegistrations) }}</div>
                    </div>
                    <div class="bg-warning-light rounded-circle p-2 text-warning">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approved Registrations -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-success" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Approved</div>
                        <div class="h3 font-weight-bold text-success mb-0">{{ number_format($approvedRegistrations) }}</div>
                    </div>
                    <div class="bg-success-light rounded-circle p-2 text-success">
                        <i class="fas fa-check-double fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rejected Registrations -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-danger" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Rejected</div>
                        <div class="h3 font-weight-bold text-danger mb-0">{{ number_format($rejectedRegistrations) }}</div>
                    </div>
                    <div class="bg-danger-light rounded-circle p-2 text-danger">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Requests -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-info" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Verify Logs</div>
                        <div class="h3 font-weight-bold text-info mb-0">{{ number_format($verificationRequests) }}</div>
                    </div>
                    <div class="bg-info-light rounded-circle p-2 text-info">
                        <i class="fas fa-search fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blocked Verification Requests -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm rounded-lg bg-white p-3 h-100 border-left border-dark" style="border-left-width: 4px !important;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-uppercase text-muted small font-weight-bold">Blocked Reqs</div>
                        <div class="h3 font-weight-bold text-danger mb-0">{{ number_format($blockedVerificationRequests) }}</div>
                    </div>
                    <div class="bg-dark-light rounded-circle p-2 text-danger">
                        <i class="fas fa-user-lock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs between Registrations & Verification Requests -->
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-bold" id="pills-registrations-tab" data-toggle="pill" href="#pills-registrations" role="tab">
                <i class="fas fa-list-alt mr-1"></i> Student Registrations &amp; Approvals
                @if($pendingRegistrations > 0)
                    <span class="badge badge-warning ml-1">{{ $pendingRegistrations }} Pending</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="pills-verification-logs-tab" data-toggle="pill" href="#pills-verification-logs" role="tab">
                <i class="fas fa-shield-alt mr-1"></i> Verification Requests &amp; Blocked Audits
                @if($blockedVerificationRequests > 0)
                    <span class="badge badge-danger ml-1">{{ $blockedVerificationRequests }} Blocked</span>
                @endif
            </a>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">

        <!-- ========================================================================= -->
        <!-- TAB 1: STUDENT REGISTRATIONS -->
        <!-- ========================================================================= -->
        <div class="tab-pane fade show active" id="pills-registrations" role="tabpanel">
            <div class="card shadow-sm border-0 rounded-lg">

                <!-- Filter & Search Bar -->
                <div class="card-header bg-white py-3 border-bottom">
                    <form method="GET" action="{{ route('admin.registration.verifications') }}">
                        <div class="row align-items-end">
                            <!-- Search Box -->
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Search Student</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                                    </div>
                                    <input type="text" name="search" class="form-control" placeholder="Reg No, Student Name, Phone..." value="{{ request('search') }}">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-xl-2 col-lg-4 col-md-3 col-6 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Approval Status</label>
                                <select name="status" class="form-control custom-select">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <!-- Year Filter -->
                            <div class="col-xl-2 col-lg-4 col-md-3 col-6 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Year</label>
                                <select name="year" class="form-control custom-select">
                                    <option value="">All Years</option>
                                    @foreach($years as $yr)
                                        <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Course Filter -->
                            <div class="col-xl-2 col-lg-5 col-md-6 col-12 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Course</label>
                                <select name="course_id" class="form-control custom-select">
                                    <option value="">All Courses</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                            {{ $c->course_title }} ({{ $c->course_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Batch Filter -->
                            <div class="col-xl-2 col-lg-5 col-md-4 col-8 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Batch</label>
                                <select name="batch_id" class="form-control custom-select">
                                    <option value="">All Batches</option>
                                    @foreach($batches as $b)
                                        <option value="{{ $b->id }}" {{ request('batch_id') == $b->id ? 'selected' : '' }}>
                                            Batch-Code-{{ $b->batch_code ?: $b->batch_number }} [{{ $b->academic_year ?: date('Y') }}]
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-xl-1 col-lg-2 col-md-2 col-4 mb-2 d-flex">
                                <button type="submit" class="btn btn-warning btn-block font-weight-bold text-dark shadow-sm" title="Filter Records">
                                    <i class="fas fa-filter"></i>
                                </button>
                                @if(request()->hasAny(['search', 'status', 'year', 'course_id', 'batch_id']))
                                    <a href="{{ route('admin.registration.verifications') }}" class="btn btn-outline-secondary ml-1" title="Reset Filters">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Content -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 text-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 3%">#</th>
                                    <th>Student Details</th>
                                    <th>Registration Number</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Submitted On</th>
                                    <th>Portal Status</th>
                                    <th style="width: 18%">Verification Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrations as $index => $item)
                                    @php
                                        $primaryCourse = $item->course;
                                        $primaryBatch = $item->batch;
                                    @endphp
                                    <tr>
                                        <td>{{ $registrations->total() - (($registrations->firstItem() ?? 1) - 1) - $index }}</td>
                                        <td>
                                            <div class="font-weight-bold text-dark">{{ $item->name }}</div>
                                            <div class="small text-muted">
                                                <i class="fas fa-phone mr-1"></i> <a href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                                                @if($item->email)
                                                    <span class="mx-1">|</span> <i class="fas fa-envelope mr-1"></i> {{ $item->email }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-mono font-weight-bold text-primary" style="font-size: 14px;">
                                                {{ $item->registration_number ?: 'N/A' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($primaryCourse)
                                                <span class="font-weight-bold">{{ $primaryCourse->course_title }}</span>
                                                <span class="badge badge-light font-mono ml-1">{{ $primaryCourse->course_code }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($primaryBatch)
                                                <span class="badge badge-secondary font-mono">{{ $primaryBatch->batch_number }}</span>
                                                <small class="d-block text-muted">Code: {{ $primaryBatch->batch_code }}</small>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ $item->created_at ? $item->created_at->format('d M, Y') : 'N/A' }}</div>
                                            <small class="text-muted">{{ $item->created_at ? $item->created_at->format('h:i A') : '' }}</small>
                                        </td>
                                        <td>
                                            @if($item->registration_status === 'approved')
                                                <span class="badge badge-success px-2 py-1">
                                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                                </span>
                                                @if($item->verified_at)
                                                    <small class="d-block text-muted mt-1 font-sans">
                                                        By: {{ $item->verifiedBy ? $item->verifiedBy->name : 'Admin' }} ({{ $item->verified_at->format('d M') }})
                                                    </small>
                                                @endif
                                            @elseif($item->registration_status === 'rejected')
                                                <span class="badge badge-danger px-2 py-1">
                                                    <i class="fas fa-ban mr-1"></i> Rejected
                                                </span>
                                                @if($item->rejection_reason)
                                                    <small class="d-block text-danger mt-1 font-italic" title="{{ $item->rejection_reason }}">
                                                        {{ Str::limit($item->rejection_reason, 25) }}
                                                    </small>
                                                @endif
                                            @else
                                                <span class="badge badge-warning px-2 py-1 text-dark">
                                                    <i class="fas fa-clock mr-1"></i> Pending Verification
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                @if($item->registration_status !== 'approved')
                                                    <!-- Approve Button -->
                                                    <form method="POST" action="{{ route('admin.registrations.approve', $item->id) }}" class="d-inline" onsubmit="return confirm('Approve {{ $item->name }} ({{ $item->registration_number }}) and grant student portal access?')">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm font-weight-bold" title="Approve Student Portal Access">
                                                            <i class="fas fa-check mr-1"></i> Approve
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($item->registration_status !== 'rejected')
                                                    <!-- Reject Button (Modal Trigger) -->
                                                    <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold ml-1" data-toggle="modal" data-target="#rejectModal{{ $item->id }}" title="Reject Registration">
                                                        <i class="fas fa-times mr-1"></i> Reject
                                                    </button>
                                                @endif

                                                <!-- Details & Password Modal Trigger -->
                                                <button type="button" class="btn btn-outline-info btn-sm font-weight-bold ml-1" data-toggle="modal" data-target="#infoModal{{ $item->id }}" title="View Credentials & Password">
                                                    <i class="fas fa-eye mr-1"></i> Details
                                                </button>
                                            </div>

                                            <!-- Student Info & Credentials Modal -->
                                            <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content shadow-lg border-0 text-left">
                                                        <div class="modal-header bg-dark text-white py-3">
                                                            <h5 class="modal-title font-weight-bold">
                                                                <i class="fas fa-user-circle mr-1 text-warning"></i> {{ $item->name }}
                                                            </h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body p-4 text-left" style="background-color: #F8FAFC;">
                                                            <!-- Login Credentials Highlight Box -->
                                                            <div class="p-3 rounded-lg mb-3" style="background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); border: 1px solid #FDE68A;">
                                                                <h6 class="font-weight-bold text-dark mb-2">
                                                                    <i class="fas fa-key text-warning mr-1"></i> স্টুডেন্ট পোর্টাল লগইন ও পাসওয়ার্ড (Portal Credentials)
                                                                </h6>
                                                                <div class="mb-2">
                                                                    <span class="small text-muted d-block font-weight-bold">Registration / Student ID:</span>
                                                                    <strong class="font-mono text-primary" style="font-size: 15px;">{{ $item->registration_number ?: 'N/A' }}</strong>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <span class="small text-muted d-block font-weight-bold">Login Phone Number:</span>
                                                                    <strong class="font-mono text-dark" style="font-size: 14px;">{{ $item->phone }}</strong>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <span class="small text-muted d-block font-weight-bold">Student Password (পাসওয়ার্ড):</span>
                                                                    <div class="input-group input-group-sm mt-1">
                                                                        <input type="password" id="verifyModalPass{{ $item->id }}" class="form-control font-mono font-weight-bold bg-white text-dark" value="{{ $item->display_password }}" readonly style="font-size: 14px; letter-spacing: 1px;">
                                                                        <div class="input-group-append">
                                                                            <button type="button" class="btn btn-dark" onclick="togglePassView('verifyModalPass{{ $item->id }}', this)" title="Show / Hide Password">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            <button type="button" class="btn btn-warning font-weight-bold text-dark" onclick="copyPassVal('verifyModalPass{{ $item->id }}', this)" title="Copy Password">
                                                                                <i class="fas fa-copy"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <small class="text-muted d-block mt-1 font-sans">
                                                                        <i class="fas fa-info-circle mr-1 text-warning"></i>{{ !empty($item->plain_password) ? 'স্টুডেন্টের নিজস্ব সেট করা পাসওয়ার্ড' : 'প্রাথমিক ডিফল্ট পাসওয়ার্ড (মোবাইল নম্বরের শেষ ৬ ডিজিট)' }}
                                                                    </small>
                                                                </div>
                                                            </div>

                                                            <!-- Other info -->
                                                            <div class="card border-0 shadow-sm p-3 bg-white">
                                                                <p class="mb-1 small"><strong>Course:</strong> {{ $primaryCourse ? $primaryCourse->course_title : 'N/A' }}</p>
                                                                <p class="mb-1 small"><strong>Batch:</strong> {{ $primaryBatch ? $primaryBatch->batch_number . ' (Code: ' . $primaryBatch->batch_code . ')' : 'N/A' }}</p>
                                                                <p class="mb-1 small"><strong>Email:</strong> {{ $item->email ?: 'N/A' }}</p>
                                                                <p class="mb-0 small"><strong>Registered On:</strong> {{ $item->created_at ? $item->created_at->format('d M, Y h:i A') : 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light py-2">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rejection Modal -->
                                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{ route('admin.registrations.reject', $item->id) }}">
                                                            @csrf
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title font-weight-bold">
                                                                    <i class="fas fa-user-times mr-1"></i> Reject Registration: {{ $item->name }}
                                                                </h5>
                                                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-muted small">
                                                                    Rejecting this registration will block this student from accessing the student dashboard.
                                                                </p>
                                                                <div class="form-group">
                                                                    <label for="reason{{ $item->id }}" class="font-weight-bold">Reason for Rejection <span class="text-danger">*</span></label>
                                                                    <textarea name="rejection_reason" id="reason{{ $item->id }}" class="form-control" rows="3" required placeholder="e.g. Invalid documents, phone number not reachable, unpaid admission fee..."></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger font-weight-bold">Confirm Rejection</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-3x mb-2 d-block"></i>
                                            No student registrations found matching the criteria.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                @if($registrations->hasPages())
                    <div class="card-footer bg-white py-3 border-top">
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <div class="small text-muted font-sans font-weight-bold my-1">
                                Showing {{ $registrations->firstItem() }} to {{ $registrations->lastItem() }} of {{ $registrations->total() }} registrations
                            </div>
                            <div class="ml-auto my-1 d-flex justify-content-end align-items-center pagination-right-align">
                                {{ $registrations->links() }}
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- TAB 2: VERIFICATION REQUESTS & BLOCKED AUDITS -->
        <!-- ========================================================================= -->
        <div class="tab-pane fade" id="pills-verification-logs" role="tabpanel">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title font-weight-bold mb-0 text-dark">
                        <i class="fas fa-history text-info mr-2"></i> Registration Number Verification Audit Trail
                    </h5>
                    <p class="text-muted small mb-0 mt-1 font-sans">
                        Students who attempted to retrieve their forgotten registration number. Requests with 3+ attempts are restricted and require Admin Approval.
                    </p>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0 text-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Phone Number</th>
                                    <th>Batch Code</th>
                                    <th>IP Address</th>
                                    <th>Attempts</th>
                                    <th>Status</th>
                                    <th>Timestamp</th>
                                    <th>Admin Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($verificationLogs as $vIdx => $vLog)
                                    <tr>
                                        <td>{{ $verificationLogs->total() - (($verificationLogs->firstItem() ?? 1) - 1) - $vIdx }}</td>
                                        <td>
                                            <strong class="font-mono text-dark">{{ $vLog->phone }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-light font-mono">{{ $vLog->batch_code }}</span>
                                        </td>
                                        <td>
                                            <span class="font-mono text-muted small">{{ $vLog->ip_address }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $vLog->attempts_count >= 3 ? 'badge-danger' : 'badge-secondary' }} font-weight-bold">
                                                {{ $vLog->attempts_count }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($vLog->status === 'success')
                                                <span class="badge badge-success">Success</span>
                                            @elseif($vLog->status === 'blocked')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-lock mr-1"></i> Blocked (Limit Exceeded)
                                                </span>
                                            @elseif($vLog->status === 'admin_approved')
                                                <span class="badge badge-primary">
                                                    <i class="fas fa-check-circle mr-1"></i> Admin Approved
                                                </span>
                                            @elseif($vLog->status === 'admin_rejected')
                                                <span class="badge badge-dark">
                                                    <i class="fas fa-ban mr-1"></i> Admin Rejected
                                                </span>
                                            @else
                                                <span class="badge badge-warning text-dark">{{ ucfirst($vLog->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{ $vLog->created_at ? $vLog->created_at->format('d M, Y') : 'N/A' }}</div>
                                            <small class="text-muted">{{ $vLog->created_at ? $vLog->created_at->format('h:i A') : '' }}</small>
                                        </td>
                                        <td>
                                            <small class="text-muted font-italic">{{ $vLog->admin_notes ?: '-' }}</small>
                                        </td>
                                        <td>
                                            @if($vLog->status === 'blocked')
                                                <div class="btn-group btn-group-sm">
                                                    <!-- Approve Blocked Request -->
                                                    <form method="POST" action="{{ route('admin.verification.request.approve', $vLog->id) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm font-weight-bold" title="Unblock and Approve Retrieval">
                                                            <i class="fas fa-unlock mr-1"></i> Approve
                                                        </button>
                                                    </form>

                                                    <!-- Reject Blocked Request -->
                                                    <form method="POST" action="{{ route('admin.verification.request.reject', $vLog->id) }}" class="d-inline ml-1">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger btn-sm font-weight-bold" title="Reject Request">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted small">No action needed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            No verification request logs found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($verificationLogs->hasPages())
                    <div class="card-footer bg-white py-3 border-top">
                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                            <div class="small text-muted font-sans font-weight-bold my-1">
                                Showing {{ $verificationLogs->firstItem() }} to {{ $verificationLogs->lastItem() }} of {{ $verificationLogs->total() }} audit entries
                            </div>
                            <div class="ml-auto my-1 text-right">
                                {{ $verificationLogs->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

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
            icon.className = 'fas fa-eye';
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
</script>
@endsection

