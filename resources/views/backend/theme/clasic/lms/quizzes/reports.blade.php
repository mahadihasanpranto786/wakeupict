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

    <!-- Filters Card -->
    <div class="card card-outline card-primary shadow-sm border-0 mb-3">
        <div class="card-header bg-white py-3 border-bottom">
            <form action="{{ route('admin.quizzes.reports') }}" method="GET" class="row align-items-center">
                <!-- Search by Student Name / Phone / ID -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control" placeholder="শিক্ষার্থীর নাম, মোবাইল বা রোল..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Filter by Course -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="course_id" class="form-control form-control-sm" onchange="this.form.submit()">
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
                    <select name="quiz_id" class="form-control form-control-sm" onchange="this.form.submit()">
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
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- ফলাফল স্ট্যাটাস --</option>
                        <option value="graded" {{ request('status') == 'graded' ? 'selected' : '' }}>মূল্যায়িত (Graded)</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>জমা দেওয়া হয়েছে</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>চলমান (In Progress)</option>
                    </select>
                </div>

                <!-- Reset Filter Button -->
                <div class="col-md-1 text-md-right">
                    @if(request()->hasAny(['search', 'course_id', 'quiz_id', 'status', 'set']))
                        <a href="{{ route('admin.quizzes.reports') }}" class="btn btn-sm btn-outline-danger" title="ফিল্টার রিসেট করুন">
                            <i class="fas fa-sync"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th>শিক্ষার্থীর তথ্য</th>
                        <th>কুইজ ও কোর্স</th>
                        <th class="text-center">সেট</th>
                        <th class="text-center">প্রাপ্ত নম্বর</th>
                        <th class="text-center">নেগেটিভ কর্তন</th>
                        <th class="text-center">শতকরা</th>
                        <th class="text-center">সময়</th>
                        <th class="text-center">ফলাফল</th>
                        <th class="text-center">জমার তারিখ</th>
                        <th class="text-center" style="width: 120px;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attempts as $attempt)
                        @php
                            $isPassed = $attempt->isPassed();
                        @endphp
                        <tr>
                            <td class="text-center text-muted text-sm">{{ $loop->iteration + ($attempts->currentPage() - 1) * $attempts->perPage() }}</td>
                            <td>
                                <div class="font-weight-bold text-dark font-size-14">
                                    <i class="fas fa-user-circle text-muted mr-1"></i>
                                    {{ $attempt->student ? $attempt->student->name : 'N/A' }}
                                </div>
                                <div class="text-xs text-muted mt-0.5">
                                    <span class="mr-2"><i class="fas fa-phone mr-1"></i> {{ $attempt->student ? $attempt->student->phone : 'N/A' }}</span>
                                    @if($attempt->student && $attempt->student->student_id_code)
                                        <span class="badge badge-light border text-xs">{{ $attempt->student->student_id_code }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark text-sm">{{ $attempt->quiz ? $attempt->quiz->title : 'N/A' }}</div>
                                <div class="text-xs text-primary font-weight-semibold">
                                    <i class="fas fa-graduation-cap mr-1"></i>
                                    {{ $attempt->quiz && $attempt->quiz->course ? $attempt->quiz->course->course_title : 'General' }}
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-light border font-weight-bold px-2 py-1">
                                    {{ $attempt->question_set ?: 'Set A' }}
                                    ({{ \App\model\LmsQuiz::getBengaliSetCode($attempt->question_set) }})
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="font-weight-bold {{ $isPassed ? 'text-success' : 'text-danger' }}" style="font-size: 1.1rem;">
                                    {{ (float)$attempt->score }}
                                </span>
                                <span class="text-xs text-muted">/ {{ (float)$attempt->total_marks }}</span>
                            </td>
                            <td class="text-center text-sm text-danger font-weight-semibold">
                                {{ (float)$attempt->negative_marks_deducted > 0 ? '-' . (float)$attempt->negative_marks_deducted : '০.০০' }}
                            </td>
                            <td class="text-center font-weight-bold">
                                <span class="badge {{ $attempt->percentage >= 80 ? 'badge-success' : ($attempt->percentage >= 50 ? 'badge-info' : 'badge-danger') }} px-2 py-1 text-xs">
                                    {{ (float)$attempt->percentage }}%
                                </span>
                            </td>
                            <td class="text-center text-xs font-mono text-muted">
                                <i class="far fa-clock mr-1"></i> {{ $attempt->formatted_time_spent }}
                            </td>
                            <td class="text-center">
                                @if($attempt->status === 'graded')
                                    @if($isPassed)
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> উত্তীর্ণ (Pass)</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> অনুত্তীর্ণ (Fail)</span>
                                    @endif
                                @elseif($attempt->status === 'submitted')
                                    <span class="badge badge-warning px-2 py-1"><i class="fas fa-hourglass-half mr-1"></i> মূল্যায়নাধীন</span>
                                @else
                                    <span class="badge badge-secondary px-2 py-1"><i class="fas fa-spinner fa-spin mr-1"></i> চলমান</span>
                                @endif
                            </td>
                            <td class="text-center text-xs text-muted">
                                {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M, Y h:i A') : $attempt->updated_at->format('d M, Y') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.quizzes.attempt-detail', $attempt->id) }}" class="btn btn-sm btn-outline-primary shadow-sm font-weight-bold" title="বিস্তারিত উত্তরপত্র ও মূল্যায়ন দেখুন">
                                    <i class="fas fa-eye mr-1"></i> রেজাল্ট
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-5 text-muted">
                                <i class="fas fa-clipboard-list fa-3x mb-3 text-secondary d-block"></i>
                                <h5>কোনো শিক্ষার্থীর পরীক্ষার ফলাফল পাওয়া যায়নি!</h5>
                                <p class="text-xs text-muted">শিক্ষার্থীরা অনলাইন বা ওএমআর কুইজে অংশগ্রহণ করলে তাদের রেজাল্ট স্বয়ংক্রিয়ভাবে এখানে তালিকাভুক্ত হবে।</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($attempts->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $attempts->firstItem() }} থেকে {{ $attempts->lastItem() }} (মোট {{ $attempts->total() }}টি ফলাফল)</span>
                    {{ $attempts->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
