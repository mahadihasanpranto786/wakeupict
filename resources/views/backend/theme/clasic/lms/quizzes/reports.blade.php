@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'কুইজ ও পরীক্ষার ফলাফল রিপোর্ট — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_reports_active', 'active')

@section('maincontant')
    <!-- Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-chart-line text-primary mr-2"></i> শিক্ষার্থী পরীক্ষার ফলাফল ও মূল্যায়ন রিপোর্ট
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        সকল শিক্ষার্থীর অনলাইন ও অফলাইন পরীক্ষার ফলাফল, প্রশ্নভিত্তিক উত্তরপত্র ও পূর্ণাঙ্গ পারফরম্যান্স বিশ্লেষণ করুন।
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-info shadow-sm mr-1">
                        <i class="fas fa-file-excel mr-1"></i> কুইজ ও এক্সেল আপলোড
                    </a>
                    <a href="{{ route('admin.question-book.index') }}" class="btn btn-outline-primary shadow-sm mr-1">
                        <i class="fas fa-book-open mr-1"></i> প্রশ্ন লাইব্রেরি
                    </a>
                    <button type="button" class="btn btn-primary shadow-sm" onclick="window.print()">
                        <i class="fas fa-print mr-1"></i> রিপোর্ট প্রিন্ট
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary KPI Cards -->
    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white border shadow-sm rounded">
                <div class="inner p-3">
                    <h3 class="text-primary font-weight-bold mb-1">{{ number_format($totalAttempts) }}</h3>
                    <p class="text-muted text-xs text-uppercase font-weight-bold mb-0">মোট পরীক্ষা অংশগ্রহণ (Total Attempts)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-edit text-primary opacity-25" style="font-size: 3rem; position: absolute; right: 15px; top: 15px;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white border shadow-sm rounded">
                <div class="inner p-3">
                    <h3 class="text-success font-weight-bold mb-1">{{ number_format($passedAttempts) }}</h3>
                    <p class="text-muted text-xs text-uppercase font-weight-bold mb-0">উত্তীর্ণ শিক্ষার্থী (Passed)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle text-success opacity-25" style="font-size: 3rem; position: absolute; right: 15px; top: 15px;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white border shadow-sm rounded">
                <div class="inner p-3">
                    <h3 class="text-danger font-weight-bold mb-1">{{ number_format($failedAttempts) }}</h3>
                    <p class="text-muted text-xs text-uppercase font-weight-bold mb-0">পুনঃপরীক্ষা প্রয়োজন (Failed)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times-circle text-danger opacity-25" style="font-size: 3rem; position: absolute; right: 15px; top: 15px;"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-white border shadow-sm rounded">
                <div class="inner p-3">
                    <h3 class="text-info font-weight-bold mb-1">{{ $avgScore }}%</h3>
                    <p class="text-muted text-xs text-uppercase font-weight-bold mb-0">গড় শতকরা স্কোর (Average Score)</p>
                </div>
                <div class="icon">
                    <i class="fas fa-percentage text-info opacity-25" style="font-size: 3rem; position: absolute; right: 15px; top: 15px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Navigation Tabs: All Attempts vs Live Exams vs Practice vs Parent Questions -->
    <ul class="nav nav-pills mb-3 flex-wrap" id="reportsTab" role="tablist">
        <li class="nav-item mb-1">
            <a class="nav-link font-weight-bold {{ ($activeTab ?? 'attempts') === 'attempts' ? 'active bg-primary text-white' : 'text-dark bg-white border' }} shadow-sm mr-2" href="{{ route('admin.quizzes.reports', array_merge(request()->except(['q_page', 'q_search', 'page']), ['tab' => 'attempts'])) }}">
                <i class="fas fa-user-graduate mr-1"></i> সকল ফলাফল (All)
                <span class="badge {{ ($activeTab ?? 'attempts') === 'attempts' ? 'badge-light text-primary' : 'badge-secondary' }} ml-1">{{ number_format($totalAttempts) }}</span>
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link font-weight-bold {{ ($activeTab ?? 'attempts') === 'exams' ? 'active bg-danger text-white' : 'text-dark bg-white border' }} shadow-sm mr-2" href="{{ route('admin.quizzes.reports', array_merge(request()->except(['q_page', 'q_search', 'page']), ['tab' => 'exams'])) }}">
                <i class="fas fa-bolt mr-1"></i> আসন্ন / লাইভ পরীক্ষা (Live Exam)
                <span class="badge {{ ($activeTab ?? 'attempts') === 'exams' ? 'badge-light text-danger' : 'badge-secondary' }} ml-1">{{ number_format($examAttemptsCount ?? 0) }}</span>
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link font-weight-bold {{ ($activeTab ?? 'attempts') === 'practice' ? 'active bg-info text-white' : 'text-dark bg-white border' }} shadow-sm mr-2" href="{{ route('admin.quizzes.reports', array_merge(request()->except(['q_page', 'q_search', 'page']), ['tab' => 'practice'])) }}">
                <i class="fas fa-flask mr-1"></i> অনুশীলন পরীক্ষা (Practice)
                <span class="badge {{ ($activeTab ?? 'attempts') === 'practice' ? 'badge-light text-info' : 'badge-secondary' }} ml-1">{{ number_format($practiceAttemptsCount ?? 0) }}</span>
            </a>
        </li>
        <li class="nav-item mb-1">
            <a class="nav-link font-weight-bold {{ ($activeTab ?? 'attempts') === 'questions' ? 'active bg-primary text-white' : 'text-dark bg-white border' }} shadow-sm" href="{{ route('admin.quizzes.reports', array_merge(request()->except(['page', 'search']), ['tab' => 'questions'])) }}">
                <i class="fas fa-project-diagram mr-1"></i> প্যারেন্ট প্রশ্ন ট্র্যাকিং
                <span class="badge {{ ($activeTab ?? 'attempts') === 'questions' ? 'badge-light text-primary' : 'badge-secondary' }} ml-1">{{ number_format($pqStats->total() ?? 0) }}</span>
            </a>
        </li>
    </ul>
    @if(($activeTab ?? 'attempts') !== 'questions')
    <!-- Top Filter & Live AJAX Search Bar -->
    <div class="card card-outline card-primary shadow-sm border-0 mb-3">
        <div class="card-header bg-white py-3 border-bottom-0">
            <form id="reports-filter-form" action="{{ route('admin.quizzes.reports') }}" method="GET" class="row align-items-center">
                <input type="hidden" name="tab" value="{{ $activeTab ?? 'attempts' }}">
                <!-- Live Search by Student Name / Phone / ID -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light">
                                <i id="reports-search-icon" class="fas fa-search text-muted"></i>
                                <i id="reports-search-spinner" class="fas fa-spinner fa-spin text-primary d-none"></i>
                            </span>
                        </div>
                        <input type="text" id="reports-live-search" name="search" class="form-control" placeholder="শিক্ষার্থীর নাম, মোবাইল বা রোল..." value="{{ request('search') }}" autocomplete="off">
                    </div>
                </div>

                <!-- Filter by Course -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="course_id" class="form-control form-control-sm">
                        <option value="">-- সকল কোর্স / বিষয় --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->course_title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Quiz -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="quiz_id" class="form-control form-control-sm">
                        <option value="">-- সকল কুইজ / পরীক্ষা --</option>
                        @foreach($quizzes as $q)
                            <option value="{{ $q->id }}" {{ request('quiz_id') == $q->id ? 'selected' : '' }}>
                                {{ $q->title }} ({{ $q->course ? $q->course->course_title : 'General' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by Status -->
                <div class="col-md-2 mb-2 mb-md-0">
                    <select name="status" class="form-control form-control-sm">
                        <option value="">-- ফলাফল স্ট্যাটাস --</option>
                        <option value="graded" {{ request('status') == 'graded' ? 'selected' : '' }}>মূল্যায়িত (Graded)</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>জমা দেওয়া হয়েছে</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>চলমান (In Progress)</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-1 text-md-right d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary mr-1" type="submit" title="খুঁজুন"><i class="fas fa-search"></i></button>
                    <a href="{{ route('admin.quizzes.reports', ['tab' => $activeTab ?? 'attempts']) }}" id="reports-reset-btn" class="btn btn-sm btn-outline-danger {{ request()->hasAny(['search', 'course_id', 'quiz_id', 'status', 'set']) ? '' : 'd-none' }}" title="ফিল্টার রিসেট করুন">
                        <i class="fas fa-sync"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Dynamic AJAX Results Container -->
    <div id="reports-results-container">
        @include('backend.theme.clasic.lms.quizzes.partials.reports_results')
    </div>

    <!-- Hidden Single Delete Form -->
    <form id="singleDeleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @endif

    @if(($activeTab ?? 'attempts') === 'questions')
    <!-- Parent Question Analytics & Tracking Card -->
    <div class="card card-outline card-info shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-sitemap text-info mr-2"></i> প্রশ্ন হিস্ট্রি ও মূল (প্যারেন্ট) প্রশ্ন পারফরম্যান্স বিশ্লেষণ
                    </h5>
                    <p class="text-muted text-xs mb-0 mt-1">
                        একই মূল প্রশ্ন একাধিক পরীক্ষায় বা সেটে কতবার এসেছে এবং শিক্ষার্থীরা কতটা সঠিকভাবে উত্তর দিয়েছে তা ট্র্যাক করুন।
                    </p>
                </div>
                <div class="col-md-6 text-md-right">
                    <form action="{{ route('admin.quizzes.reports') }}" method="GET" class="d-inline-block">
                        <input type="hidden" name="tab" value="questions">
                        <div class="input-group input-group-sm" style="max-width: 320px;">
                            <input type="text" name="q_search" class="form-control" placeholder="প্রশ্ন বা টপিক খুঁজুন..." value="{{ request('q_search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit"><i class="fas fa-search"></i> খুঁজুন</button>
                                @if(request('q_search'))
                                    <a href="{{ route('admin.quizzes.reports', ['tab' => 'questions']) }}" class="btn btn-outline-secondary" title="রিসেট"><i class="fas fa-times"></i></a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-striped align-middle mb-0 text-sm">
                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th style="min-width: 280px;">মূল / প্যারেন্ট প্রশ্ন ও ক্যাটাগরি (Parent Question)</th>
                        <th class="text-center" style="width: 140px;">মোট উত্তর প্রদান</th>
                        <th class="text-center" style="width: 100px;">সঠিক</th>
                        <th class="text-center" style="width: 100px;">ভুল</th>
                        <th class="text-center" style="width: 160px;">সাফল্যের হার (%)</th>
                        <th class="text-center" style="width: 130px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pqStats as $pStat)
                        @php
                            $pq = $pStat->parent_question;
                            $accuracy = $pStat->accuracy_rate;
                        @endphp
                        <tr>
                            <td class="text-center text-muted font-weight-bold">{{ $loop->iteration + ($pqStats->currentPage() - 1) * $pqStats->perPage() }}</td>
                            <td>
                                @if($pq)
                                    <div class="font-weight-bold text-dark font-size-14 mb-1">
                                        {{ $pq->question_text }}
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap gap-1 text-xs">
                                        <span class="badge badge-light border mr-1 font-mono">#Q-{{ $pq->id }}</span>
                                        <span class="badge badge-info mr-1">{{ $pq->category ?: 'General' }}</span>
                                        <span class="badge badge-secondary mr-1">{{ $pq->getTypeLabel() }}</span>
                                        @if($pq->difficulty)
                                            <span class="badge badge-light border mr-1">{{ ucfirst($pq->difficulty) }}</span>
                                        @endif
                                        @php
                                            $variantsCount = \App\model\LmsQuestion::where('parent_question_id', $pq->id)->count();
                                        @endphp
                                        @if($variantsCount > 0)
                                            <span class="badge badge-primary font-weight-bold mr-1">
                                                <i class="fas fa-code-branch mr-1"></i> {{ $variantsCount }}টি ভ্যারিয়েন্ট
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-muted font-italic">প্রশ্ন #{{ $pStat->master_question_id }} (আর্কাইভকৃত বা মুছে ফেলা হয়েছে)</div>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="font-weight-bold text-dark" style="font-size: 1.05rem;">{{ number_format($pStat->total_answers_count) }}</span> <span class="text-xs text-muted">বার</span>
                                <div class="text-xs text-muted mt-0.5">({{ $pStat->total_attempts_count }}টি অ্যাটেম্পটে)</div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-success px-2.5 py-1 font-weight-bold text-xs">
                                    <i class="fas fa-check mr-1"></i> {{ number_format($pStat->correct_count) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-danger px-2.5 py-1 font-weight-bold text-xs">
                                    <i class="fas fa-times mr-1"></i> {{ number_format($pStat->incorrect_count) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="progress mr-2 flex-grow-1" style="height: 8px; max-width: 80px;">
                                        <div class="progress-bar {{ $accuracy >= 70 ? 'bg-success' : ($accuracy >= 40 ? 'bg-warning' : 'bg-danger') }}" style="width: {{ $accuracy }}%"></div>
                                    </div>
                                    <span class="font-weight-bold text-xs {{ $accuracy >= 70 ? 'text-success' : ($accuracy >= 40 ? 'text-warning' : 'text-danger') }}">{{ $accuracy }}%</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($pq)
                                    <button type="button" class="btn btn-sm btn-outline-info font-weight-bold shadow-sm" onclick="openParentQuestionModal({{ $pq->id }})">
                                        <i class="fas fa-history mr-1"></i> হিস্ট্রি দেখুন
                                    </button>
                                @else
                                    <span class="text-muted text-xs">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-question-circle fa-3x mb-3 text-muted opacity-50"></i>
                                <p class="font-weight-bold mb-0">কোনো প্রশ্নের উত্তরপত্র বা হিস্ট্রি পাওয়া যায়নি।</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pqStats->hasPages())
        <div class="card-footer bg-white border-top py-3 d-flex justify-content-between align-items-center flex-wrap">
            <div class="text-muted text-xs mb-2 mb-md-0">
                মোট <strong>{{ $pqStats->total() }}</strong> টি প্রশ্নের মধ্যে {{ $pqStats->firstItem() ?? 0 }} - {{ $pqStats->lastItem() ?? 0 }} দেখানো হচ্ছে।
            </div>
            <div>
                {{ $pqStats->links() }}
            </div>
        </div>
        @endif
    </div>
    @endif

    <script>
        function updateBulkBar() {
            var checkboxes = document.querySelectorAll('.attempt-checkbox:checked');
            var count = checkboxes.length;
            var bar = document.getElementById('bulkActionBar');
            var countText = document.getElementById('selectedCountText');
            var selectAll = document.getElementById('selectAllCheckbox');

            if (countText) countText.innerText = count;
            if (bar) {
                bar.style.display = count > 0 ? 'block' : 'none';
            }

            var allBoxes = document.querySelectorAll('.attempt-checkbox');
            if (selectAll && allBoxes.length > 0) {
                selectAll.checked = (checkboxes.length === allBoxes.length);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    var checked = this.checked;
                    document.querySelectorAll('.attempt-checkbox').forEach(function(cb) {
                        cb.checked = checked;
                    });
                    updateBulkBar();
                });
            }

            document.querySelectorAll('.attempt-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateBulkBar);
            });
        });

        function clearAllSelections() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) selectAll.checked = false;
            document.querySelectorAll('.attempt-checkbox').forEach(function(cb) {
                cb.checked = false;
            });
            updateBulkBar();
        }

        
        function executeBulkResetViolations() {
            var checked = document.querySelectorAll('.attempt-checkbox:checked');
            if (checked.length === 0) {
                alert('অনুগ্রহ করে প্রথমে কমপক্ষে একটি ফলাফল নির্বাচন করুন।');
                return;
            }
            if (confirm('আপনি কি নিশ্চিতভাবে নির্বাচিত ' + checked.length + 'টি ফলাফলের সকল নিরাপত্তা লঙ্ঘন রিসেট ও মুছে ফেলতে চান?')) {
                var form = document.getElementById('bulkResetViolationsForm');
                var container = document.getElementById('bulkResetInputsContainer');
                container.innerHTML = '';
                checked.forEach(function(cb) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'attempt_ids[]';
                    input.value = cb.value;
                    container.appendChild(input);
                });
                form.submit();
            }
        }

        function executeBulkDelete() {
            var checked = document.querySelectorAll('.attempt-checkbox:checked');
            if (checked.length === 0) {
                alert('অনুগ্রহ করে প্রথমে কমপক্ষে একটি ফলাফল নির্বাচন করুন।');
                return;
            }

            if (confirm('আপনি কি নিশ্চিতভাবে নির্বাচিত ' + checked.length + 'টি ফলাফল মুছে ফেলতে চান? ফলাফল মুছে ফেললে শিক্ষার্থীরা পুনরায় পরীক্ষায় অংশ নিতে পারবে।')) {
                document.getElementById('bulkDeleteForm').submit();
            }
        }

        function confirmSingleDelete(attemptId, studentName) {
            if (confirm('আপনি কি নিশ্চিতভাবে ' + studentName + '-এর এই পরীক্ষার ফলাফলটি মুছে ফেলতে চান? মুছে ফেললে শিক্ষার্থী পুনরায় পরীক্ষায় অংশগ্রহণ করতে পারবে।')) {
                var form = document.getElementById('singleDeleteForm');
                form.action = '/admin/quizzes/reports/attempt/' + attemptId;
                form.submit();
            }
        }
        function toggleAdminRetakes(id) {
            var row = document.getElementById('admin-retakes-' + id);
            var btn = document.getElementById('admin-retake-btn-' + id);
            if (!row) return;
            if (row.classList.contains('d-none')) {
                row.classList.remove('d-none');
                if (btn && btn.querySelector('.fa-chevron-down')) {
                    btn.querySelector('.fa-chevron-down').className = 'fas fa-chevron-up ml-0.5';
                }
            } else {
                row.classList.add('d-none');
                if (btn && btn.querySelector('.fa-chevron-up')) {
                    btn.querySelector('.fa-chevron-up').className = 'fas fa-chevron-down ml-0.5';
                }
            }
        }

        // Live AJAX Search & Filter on Exam Results & Reports
        (function() {
            var form = document.getElementById('reports-filter-form');
            var searchInput = document.getElementById('reports-live-search');
            var container = document.getElementById('reports-results-container');
            var resetBtn = document.getElementById('reports-reset-btn');
            var searchIcon = document.getElementById('reports-search-icon');
            var searchSpinner = document.getElementById('reports-search-spinner');

            if (!form || !container) return;

            var debounceTimer = null;
            var activeController = null;
            var baseUrl = form.getAttribute('action');

            function toggleReset() {
                if (!resetBtn) return;
                var hasFilter = false;
                form.querySelectorAll('input[name="search"], select[name]').forEach(function(el) {
                    if (el.value && el.value.trim() !== '') hasFilter = true;
                });
                resetBtn.classList.toggle('d-none', !hasFilter);
            }

            function setLoading(isLoading) {
                if (searchIcon && searchSpinner) {
                    searchIcon.classList.toggle('d-none', isLoading);
                    searchSpinner.classList.toggle('d-none', !isLoading);
                }
                container.style.opacity = isLoading ? '0.6' : '1';
            }

            function buildUrl(pageUrl) {
                var urlObj = new URL(pageUrl || baseUrl, window.location.origin);
                if (!pageUrl) {
                    var fd = new FormData(form);
                    fd.forEach(function(val, key) {
                        if (val && val.toString().trim() !== '') {
                            urlObj.searchParams.set(key, val.toString().trim());
                        }
                    });
                }
                return urlObj;
            }

            function fetchReports(pageUrl) {
                if (activeController) activeController.abort();
                activeController = new AbortController();

                var cleanUrl = buildUrl(pageUrl);
                var ajaxUrl = new URL(cleanUrl.toString());
                ajaxUrl.searchParams.set('ajax', '1');

                setLoading(true);
                toggleReset();

                fetch(ajaxUrl.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    signal: activeController.signal
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('Network error');
                    return r.json();
                })
                .then(function(data) {
                    if (data && typeof data.html === 'string') {
                        container.innerHTML = data.html;
                        window.history.replaceState({}, '', cleanUrl.toString());
                    }
                })
                .catch(function(err) {
                    if (err.name !== 'AbortError') console.error('Reports live search error:', err);
                })
                .finally(function() {
                    setLoading(false);
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        fetchReports(null);
                    }, 250);
                });
            }

            form.querySelectorAll('select').forEach(function(sel) {
                sel.addEventListener('change', function() {
                    fetchReports(null);
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimer);
                fetchReports(null);
            });

            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (searchInput) searchInput.value = '';
                    form.querySelectorAll('select').forEach(function(sel) { sel.value = ''; });
                    fetchReports(null);
                });
            }

            container.addEventListener('click', function(e) {
                var link = e.target.closest('.pagination a');
                if (link && link.getAttribute('href')) {
                    e.preventDefault();
                    fetchReports(link.getAttribute('href'));
                }
            });
        })();
    </script>

    <!-- Violation Logs Modal -->
    <div class="modal fade" id="violationAuditModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-dark text-white py-2">
                    <h5 class="modal-title font-weight-bold text-sm" id="violationAuditModalLabel">
                        <i class="fas fa-shield-alt text-warning mr-2"></i> পরীক্ষা নিরাপত্তা অডিট লগ (Anti-Cheating Security Audit)
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 bg-light rounded border">
                        <div>
                            <span class="text-muted text-xs">শিক্ষার্থী:</span>
                            <strong id="violationAuditStudentName" class="text-dark ml-1"></strong>
                        </div>
                        <div>
                            <span class="text-muted text-xs">অ্যাটেম্পট আইডি:</span>
                            <span id="violationAuditAttemptId" class="badge badge-secondary ml-1"></span>
                        </div>
                        <div>
                            <span class="text-muted text-xs">মোট লঙ্ঘন:</span>
                            <span id="violationAuditTotalBadge" class="badge badge-danger ml-1 font-weight-bold"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped text-xs mb-0">
                            <thead class="bg-light font-weight-bold">
                                <tr>
                                    <th style="width: 45px;" class="text-center">#</th>
                                    <th>লঙ্ঘনের ধরন (Violation Type)</th>
                                    <th>বিবরণ (Details)</th>
                                    <th style="width: 150px;">সময় (Timestamp)</th>
                                </tr>
                            </thead>
                            <tbody id="violationAuditTableBody">
                                <!-- Dynamic -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer py-2 justify-content-between">
                    <form id="singleResetViolationsForm" action="" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই শিক্ষার্থীর নিরাপত্তা লঙ্ঘন স্থায়ীভাবে রিসেট করতে চান?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger font-weight-bold shadow-sm">
                            <i class="fas fa-trash-alt mr-1"></i> এই ফলাফলটির লঙ্ঘন রিসেট করুন
                        </button>
                    </form>
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal">বন্ধ করুন</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function escapeHtml(str) {
            if (!str) return '';
            var p = document.createElement('p');
            p.textContent = str;
            return p.innerHTML;
        }

        function openViolationAuditModal(attemptId, studentName, count, logs) {
            document.getElementById('violationAuditStudentName').innerText = studentName;
            document.getElementById('violationAuditAttemptId').innerText = '#' + attemptId;
            document.getElementById('violationAuditTotalBadge').innerText = count + 'টি সনাক্ত';
            var sForm = document.getElementById('singleResetViolationsForm');
            if (sForm) sForm.action = '/admin/quizzes/reports/attempt/' + attemptId + '/reset-violations';
            
            var tbody = document.getElementById('violationAuditTableBody');
            tbody.innerHTML = '';
            
            if (!logs || logs.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-3">কোনো বিস্তারিত রেকর্ড পাওয়া যায়নি।</td></tr>';
            } else {
                logs.forEach(function(item, idx) {
                    var tr = document.createElement('tr');
                    tr.innerHTML = 
                        '<td class="text-center font-weight-bold">' + (idx + 1) + '</td>' +
                        '<td><span class="badge badge-danger text-xs mr-1">' + escapeHtml(item.title || item.violation_type || 'নিরাপত্তা লঙ্ঘন') + '</span></td>' +
                        '<td class="text-muted">' + escapeHtml(item.details || '—') + '</td>' +
                        '<td class="font-mono text-xs text-dark">' + escapeHtml(item.time || '—') + '</td>';
                    tbody.appendChild(tr);
                });
            }
            $('#violationAuditModal').modal('show');
        }
        function toggleAdminRetakes(id) {
            var row = document.getElementById('admin-retakes-' + id);
            var btn = document.getElementById('admin-retake-btn-' + id);
            if (!row) return;
            if (row.classList.contains('d-none')) {
                row.classList.remove('d-none');
                if (btn && btn.querySelector('.fa-chevron-down')) {
                    btn.querySelector('.fa-chevron-down').className = 'fas fa-chevron-up ml-0.5';
                }
            } else {
                row.classList.add('d-none');
                if (btn && btn.querySelector('.fa-chevron-up')) {
                    btn.querySelector('.fa-chevron-up').className = 'fas fa-chevron-down ml-0.5';
                }
            }
        }

        // Live AJAX Search & Filter on Exam Results & Reports
        (function() {
            var form = document.getElementById('reports-filter-form');
            var searchInput = document.getElementById('reports-live-search');
            var container = document.getElementById('reports-results-container');
            var resetBtn = document.getElementById('reports-reset-btn');
            var searchIcon = document.getElementById('reports-search-icon');
            var searchSpinner = document.getElementById('reports-search-spinner');

            if (!form || !container) return;

            var debounceTimer = null;
            var activeController = null;
            var baseUrl = form.getAttribute('action');

            function toggleReset() {
                if (!resetBtn) return;
                var hasFilter = false;
                form.querySelectorAll('input[name="search"], select[name]').forEach(function(el) {
                    if (el.value && el.value.trim() !== '') hasFilter = true;
                });
                resetBtn.classList.toggle('d-none', !hasFilter);
            }

            function setLoading(isLoading) {
                if (searchIcon && searchSpinner) {
                    searchIcon.classList.toggle('d-none', isLoading);
                    searchSpinner.classList.toggle('d-none', !isLoading);
                }
                container.style.opacity = isLoading ? '0.6' : '1';
            }

            function buildUrl(pageUrl) {
                var urlObj = new URL(pageUrl || baseUrl, window.location.origin);
                if (!pageUrl) {
                    var fd = new FormData(form);
                    fd.forEach(function(val, key) {
                        if (val && val.toString().trim() !== '') {
                            urlObj.searchParams.set(key, val.toString().trim());
                        }
                    });
                }
                return urlObj;
            }

            function fetchReports(pageUrl) {
                if (activeController) activeController.abort();
                activeController = new AbortController();

                var cleanUrl = buildUrl(pageUrl);
                var ajaxUrl = new URL(cleanUrl.toString());
                ajaxUrl.searchParams.set('ajax', '1');

                setLoading(true);
                toggleReset();

                fetch(ajaxUrl.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    signal: activeController.signal
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('Network error');
                    return r.json();
                })
                .then(function(data) {
                    if (data && typeof data.html === 'string') {
                        container.innerHTML = data.html;
                        window.history.replaceState({}, '', cleanUrl.toString());
                    }
                })
                .catch(function(err) {
                    if (err.name !== 'AbortError') console.error('Reports live search error:', err);
                })
                .finally(function() {
                    setLoading(false);
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        fetchReports(null);
                    }, 250);
                });
            }

            form.querySelectorAll('select').forEach(function(sel) {
                sel.addEventListener('change', function() {
                    fetchReports(null);
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimer);
                fetchReports(null);
            });

            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (searchInput) searchInput.value = '';
                    form.querySelectorAll('select').forEach(function(sel) { sel.value = ''; });
                    fetchReports(null);
                });
            }

            container.addEventListener('click', function(e) {
                var link = e.target.closest('.pagination a');
                if (link && link.getAttribute('href')) {
                    e.preventDefault();
                    fetchReports(link.getAttribute('href'));
                }
            });
        })();
    </script>

    <!-- Parent Question History Modal -->
    <div class="modal fade" id="parentQuestionHistoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header bg-primary text-white py-2">
                    <h5 class="modal-title font-weight-bold text-sm" id="parentQuestionHistoryModalLabel">
                        <i class="fas fa-project-diagram mr-2"></i> মূল (প্যারেন্ট) প্রশ্ন বিস্তারিত ট্র্যাকিং ও শিক্ষার্থী উত্তর হিস্ট্রি
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div id="pqModalLoading" class="text-center py-4">
                        <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
                        <p class="text-muted text-xs mt-2">তথ্য লোড হচ্ছে...</p>
                    </div>

                    <div id="pqModalContent" style="display: none;">
                        <!-- Question Preview Card -->
                        <div class="p-3 bg-light rounded border mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge badge-primary font-mono" id="pqPreviewCode">#Q-</span>
                                <div>
                                    <span class="badge badge-info mr-1" id="pqPreviewCategory"></span>
                                    <span class="badge badge-secondary mr-1" id="pqPreviewType"></span>
                                    <span class="badge badge-light border" id="pqPreviewVariants"></span>
                                </div>
                            </div>
                            <h5 class="font-weight-bold text-dark mb-3" id="pqPreviewText"></h5>
                            
                            <div id="pqPreviewOptionsContainer" class="row g-2">
                                <!-- Options rendered here -->
                            </div>
                        </div>

                        <!-- Stats KPI Banner -->
                        <div class="row g-2 mb-3 text-center">
                            <div class="col-sm-3 col-6">
                                <div class="p-2 bg-light border rounded">
                                    <div class="text-muted text-xs font-weight-bold">মোট উপস্থিতি</div>
                                    <div class="h5 font-weight-bold mb-0 text-dark" id="pqStatTotal">0</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="p-2 bg-light border rounded">
                                    <div class="text-muted text-xs font-weight-bold">সঠিক উত্তর</div>
                                    <div class="h5 font-weight-bold mb-0 text-success" id="pqStatCorrect">0</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="p-2 bg-light border rounded">
                                    <div class="text-muted text-xs font-weight-bold">ভুল উত্তর</div>
                                    <div class="h5 font-weight-bold mb-0 text-danger" id="pqStatIncorrect">0</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div class="p-2 bg-light border rounded">
                                    <div class="text-muted text-xs font-weight-bold">সাফল্যের হার</div>
                                    <div class="h5 font-weight-bold mb-0 text-primary" id="pqStatRate">0%</div>
                                </div>
                            </div>
                        </div>

                        <!-- Attempts History Table -->
                        <h6 class="font-weight-bold text-dark mb-2">
                            <i class="fas fa-list-alt text-muted mr-1"></i> পরীক্ষাসমূহে এই প্রশ্নের উপস্থিতি ও ফলাফল টাইমলাইন
                        </h6>
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-bordered table-sm table-striped text-xs mb-0">
                                <thead class="bg-light font-weight-bold sticky-top">
                                    <tr>
                                        <th style="width: 45px;" class="text-center">#</th>
                                        <th>শিক্ষার্থী (Student)</th>
                                        <th>পরীক্ষা ও সেট (Quiz & Set)</th>
                                        <th class="text-center" style="width: 100px;">ফলাফল</th>
                                        <th class="text-center" style="width: 90px;">প্রাপ্ত মান</th>
                                        <th style="width: 150px;">তারিখ ও সময়</th>
                                    </tr>
                                </thead>
                                <tbody id="pqHistoryTableBody">
                                    <!-- Dynamic -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2 justify-content-between">
                    <form id="singleResetViolationsForm" action="" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই শিক্ষার্থীর নিরাপত্তা লঙ্ঘন স্থায়ীভাবে রিসেট করতে চান?');">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger font-weight-bold shadow-sm">
                            <i class="fas fa-trash-alt mr-1"></i> এই ফলাফলটির লঙ্ঘন রিসেট করুন
                        </button>
                    </form>
                    <button type="button" class="btn btn-sm btn-secondary font-weight-bold" data-dismiss="modal">বন্ধ করুন</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openParentQuestionModal(questionId) {
            $('#parentQuestionHistoryModal').modal('show');
            document.getElementById('pqModalLoading').style.display = 'block';
            document.getElementById('pqModalContent').style.display = 'none';

            fetch('/admin/quizzes/reports/parent-question/' + questionId + '/history')
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    document.getElementById('pqModalLoading').style.display = 'none';
                    if (!res.success) {
                        alert('প্রশ্ন তথ্য লোড করতে ব্যর্থ হয়েছে');
                        return;
                    }
                    document.getElementById('pqModalContent').style.display = 'block';

                    var q = res.parent_question;
                    document.getElementById('pqPreviewCode').innerText = '#Q-' + q.id;
                    document.getElementById('pqPreviewCategory').innerText = q.category;
                    document.getElementById('pqPreviewType').innerText = q.question_type;
                    document.getElementById('pqPreviewVariants').innerText = q.variants_count > 0 ? (q.variants_count + 'টি ভ্যারিয়েন্ট সংযুক্ত') : 'মূল প্রশ্ন (Original)';
                    document.getElementById('pqPreviewText').innerText = q.question_text;

                    // Render options
                    var optContainer = document.getElementById('pqPreviewOptionsContainer');
                    optContainer.innerHTML = '';
                    if (q.options && q.options.length > 0) {
                        q.options.forEach(function(opt, oIdx) {
                            var col = document.createElement('div');
                            col.className = 'col-sm-6 mb-2';
                            var isCorr = opt.is_correct;
                            col.innerHTML = '<div class="p-2 rounded border ' + (isCorr ? 'bg-success text-white border-success' : 'bg-white text-dark') + ' text-xs font-weight-bold d-flex align-items-center">' +
                                '<span class="badge ' + (isCorr ? 'badge-light text-success' : 'badge-light border') + ' mr-2">' + String.fromCharCode(65 + oIdx) + '</span>' +
                                '<span class="flex-grow-1">' + escapeHtml(opt.option_text) + '</span>' +
                                (isCorr ? '<i class="fas fa-check-circle ml-1"></i>' : '') +
                                '</div>';
                            optContainer.appendChild(col);
                        });
                    }

                    // Stats
                    var total = res.total_appearances || 0;
                    var corr = res.correct_count || 0;
                    var incorr = res.incorrect_count || 0;
                    var rate = total > 0 ? Math.round((corr / total) * 100) : 0;

                    document.getElementById('pqStatTotal').innerText = total + ' বার';
                    document.getElementById('pqStatCorrect').innerText = corr;
                    document.getElementById('pqStatIncorrect').innerText = incorr;
                    document.getElementById('pqStatRate').innerText = rate + '%';

                    // History table
                    var tbody = document.getElementById('pqHistoryTableBody');
                    tbody.innerHTML = '';
                    if (!res.history || res.history.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-3">এই প্রশ্নের অধীনে এখনো কোনো ফলাফল জমা পড়েনি।</td></tr>';
                    } else {
                        res.history.forEach(function(item, idx) {
                            var tr = document.createElement('tr');
                            tr.innerHTML = 
                                '<td class="text-center font-weight-bold">' + (idx + 1) + '</td>' +
                                '<td><strong>' + escapeHtml(item.student_name) + '</strong> <span class="badge badge-light border ml-1">' + escapeHtml(item.student_id_code) + '</span></td>' +
                                '<td>' + escapeHtml(item.quiz_title) + ' <span class="badge badge-light border ml-1">' + escapeHtml(item.set) + '</span></td>' +
                                '<td class="text-center">' + (item.is_correct ? '<span class="badge badge-success px-2 py-0.5 font-weight-bold"><i class="fas fa-check"></i> সঠিক</span>' : '<span class="badge badge-danger px-2 py-0.5 font-weight-bold"><i class="fas fa-times"></i> ভুল</span>') + '</td>' +
                                '<td class="text-center font-mono font-weight-bold">' + item.marks_obtained + '</td>' +
                                '<td class="font-mono text-muted">' + escapeHtml(item.time) + '</td>';
                            tbody.appendChild(tr);
                        });
                    }
                })
                .catch(function(err) {
                    document.getElementById('pqModalLoading').style.display = 'none';
                    alert('ত্রুটি: ' + err);
                });
        }
        function toggleAdminRetakes(id) {
            var row = document.getElementById('admin-retakes-' + id);
            var btn = document.getElementById('admin-retake-btn-' + id);
            if (!row) return;
            if (row.classList.contains('d-none')) {
                row.classList.remove('d-none');
                if (btn && btn.querySelector('.fa-chevron-down')) {
                    btn.querySelector('.fa-chevron-down').className = 'fas fa-chevron-up ml-0.5';
                }
            } else {
                row.classList.add('d-none');
                if (btn && btn.querySelector('.fa-chevron-up')) {
                    btn.querySelector('.fa-chevron-up').className = 'fas fa-chevron-down ml-0.5';
                }
            }
        }

        // Live AJAX Search & Filter on Exam Results & Reports
        (function() {
            var form = document.getElementById('reports-filter-form');
            var searchInput = document.getElementById('reports-live-search');
            var container = document.getElementById('reports-results-container');
            var resetBtn = document.getElementById('reports-reset-btn');
            var searchIcon = document.getElementById('reports-search-icon');
            var searchSpinner = document.getElementById('reports-search-spinner');

            if (!form || !container) return;

            var debounceTimer = null;
            var activeController = null;
            var baseUrl = form.getAttribute('action');

            function toggleReset() {
                if (!resetBtn) return;
                var hasFilter = false;
                form.querySelectorAll('input[name="search"], select[name]').forEach(function(el) {
                    if (el.value && el.value.trim() !== '') hasFilter = true;
                });
                resetBtn.classList.toggle('d-none', !hasFilter);
            }

            function setLoading(isLoading) {
                if (searchIcon && searchSpinner) {
                    searchIcon.classList.toggle('d-none', isLoading);
                    searchSpinner.classList.toggle('d-none', !isLoading);
                }
                container.style.opacity = isLoading ? '0.6' : '1';
            }

            function buildUrl(pageUrl) {
                var urlObj = new URL(pageUrl || baseUrl, window.location.origin);
                if (!pageUrl) {
                    var fd = new FormData(form);
                    fd.forEach(function(val, key) {
                        if (val && val.toString().trim() !== '') {
                            urlObj.searchParams.set(key, val.toString().trim());
                        }
                    });
                }
                return urlObj;
            }

            function fetchReports(pageUrl) {
                if (activeController) activeController.abort();
                activeController = new AbortController();

                var cleanUrl = buildUrl(pageUrl);
                var ajaxUrl = new URL(cleanUrl.toString());
                ajaxUrl.searchParams.set('ajax', '1');

                setLoading(true);
                toggleReset();

                fetch(ajaxUrl.toString(), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    signal: activeController.signal
                })
                .then(function(r) {
                    if (!r.ok) throw new Error('Network error');
                    return r.json();
                })
                .then(function(data) {
                    if (data && typeof data.html === 'string') {
                        container.innerHTML = data.html;
                        window.history.replaceState({}, '', cleanUrl.toString());
                    }
                })
                .catch(function(err) {
                    if (err.name !== 'AbortError') console.error('Reports live search error:', err);
                })
                .finally(function() {
                    setLoading(false);
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function() {
                        fetchReports(null);
                    }, 250);
                });
            }

            form.querySelectorAll('select').forEach(function(sel) {
                sel.addEventListener('change', function() {
                    fetchReports(null);
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                clearTimeout(debounceTimer);
                fetchReports(null);
            });

            if (resetBtn) {
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (searchInput) searchInput.value = '';
                    form.querySelectorAll('select').forEach(function(sel) { sel.value = ''; });
                    fetchReports(null);
                });
            }

            container.addEventListener('click', function(e) {
                var link = e.target.closest('.pagination a');
                if (link && link.getAttribute('href')) {
                    e.preventDefault();
                    fetchReports(link.getAttribute('href'));
                }
            });
        })();
    </script>
@endsection