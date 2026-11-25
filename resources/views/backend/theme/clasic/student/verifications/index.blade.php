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
                    <form id="reg-filter-form" method="GET" action="{{ route('admin.registration.verifications') }}">
                        <div class="row align-items-end">
                            <!-- Search Box -->
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Search Student</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light">
                                            <i id="reg-search-icon" class="fas fa-search text-muted"></i>
                                            <i id="reg-search-spinner" class="fas fa-spinner fa-spin text-primary d-none"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="reg-live-search" name="search" class="form-control" placeholder="Reg No, Student Name, Phone..." value="{{ request('search') }}" autocomplete="off">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="col-xl-2 col-lg-4 col-md-3 col-6 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Approval Status</label>
                                <select id="reg-filter-status" name="status" class="form-control custom-select">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <!-- Year Filter -->
                            <div class="col-xl-2 col-lg-4 col-md-3 col-6 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Year</label>
                                <select id="reg-filter-year" name="year" class="form-control custom-select">
                                    <option value="">All Years</option>
                                    @foreach($years as $yr)
                                        <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Course Filter -->
                            <div class="col-xl-2 col-lg-5 col-md-6 col-12 mb-2">
                                <label class="small text-muted font-weight-bold mb-1">Course</label>
                                <select id="reg-filter-course" name="course_id" class="form-control custom-select">
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
                                <select id="reg-filter-batch" name="batch_id" class="form-control custom-select">
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
                                <a href="{{ route('admin.registration.verifications') }}" id="reg-reset-btn" class="btn btn-outline-secondary ml-1 {{ request()->hasAny(['search', 'status', 'year', 'course_id', 'batch_id']) ? '' : 'd-none' }}" title="Reset Filters">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="registrations-table-container">
                    @include('backend.theme.clasic.student.verifications.partials.registrations_table')
                </div>

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
                                        <td>{{ ($verificationLogs->firstItem() ?? 1) + $vIdx }}</td>
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

    (function() {
        var form = document.getElementById('reg-filter-form');
        var searchInput = document.getElementById('reg-live-search');
        var tableContainer = document.getElementById('registrations-table-container');
        var resetBtn = document.getElementById('reg-reset-btn');
        var searchIcon = document.getElementById('reg-search-icon');
        var searchSpinner = document.getElementById('reg-search-spinner');

        if (!form || !tableContainer) return;

        var debounceTimer = null;
        var activeController = null;
        var baseUrl = form.getAttribute('action');

        function toggleResetVisibility() {
            if (!resetBtn) return;
            var hasFilter = false;
            var fields = form.querySelectorAll('input[name], select[name]');
            fields.forEach(function(el) {
                if (el.value && el.value.trim() !== '') {
                    hasFilter = true;
                }
            });
            resetBtn.classList.toggle('d-none', !hasFilter);
        }

        function setLoading(isLoading) {
            if (searchIcon && searchSpinner) {
                searchIcon.classList.toggle('d-none', isLoading);
                searchSpinner.classList.toggle('d-none', !isLoading);
            }
            tableContainer.style.opacity = isLoading ? '0.6' : '1';
        }

        function buildQueryUrl(pageUrl) {
            var urlObj = new URL(pageUrl || baseUrl, window.location.origin);
            if (!pageUrl) {
                var formData = new FormData(form);
                formData.forEach(function(val, key) {
                    if (val && val.toString().trim() !== '') {
                        urlObj.searchParams.set(key, val.toString().trim());
                    }
                });
            }
            return urlObj;
        }

        function fetchRegistrations(pageUrl) {
            if (activeController) {
                activeController.abort();
            }
            activeController = new AbortController();

            var cleanUrl = buildQueryUrl(pageUrl);
            var ajaxUrl = new URL(cleanUrl.toString());
            ajaxUrl.searchParams.set('ajax', '1');

            setLoading(true);
            toggleResetVisibility();

            fetch(ajaxUrl.toString(), {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                signal: activeController.signal
            })
            .then(function(res) {
                if (!res.ok) throw new Error('Network error');
                return res.json();
            })
            .then(function(data) {
                if (data && typeof data.html === 'string') {
                    tableContainer.innerHTML = data.html;
                    window.history.replaceState({}, '', cleanUrl.toString());
                }
            })
            .catch(function(err) {
                if (err.name !== 'AbortError') {
                    console.error('Live search error:', err);
                }
            })
            .finally(function() {
                setLoading(false);
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    fetchRegistrations(null);
                }, 250);
            });
        }

        form.querySelectorAll('select').forEach(function(sel) {
            sel.addEventListener('change', function() {
                fetchRegistrations(null);
            });
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            clearTimeout(debounceTimer);
            fetchRegistrations(null);
        });

        if (resetBtn) {
            resetBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (searchInput) searchInput.value = '';
                form.querySelectorAll('select').forEach(function(sel) {
                    sel.value = '';
                });
                fetchRegistrations(null);
            });
        }

        tableContainer.addEventListener('click', function(e) {
            var link = e.target.closest('.pagination a');
            if (link && link.getAttribute('href')) {
                e.preventDefault();
                fetchRegistrations(link.getAttribute('href'));
            }
        });
    })();
</script>
@endsection

