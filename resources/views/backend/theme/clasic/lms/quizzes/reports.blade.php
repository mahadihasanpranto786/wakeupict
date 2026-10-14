@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'কুইজ ও পরীক্ষার ফলাফল রিপোর্ট — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_quiz_active', 'active')

@section('maincontant')
    <!-- Header -->
    <div class="content-header p-0 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.5rem;">
                        <i class="fas fa-chart-line text-primary mr-2"></i> কুইজ ও পরীক্ষার পারফরম্যান্স রিপোর্ট
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        শিক্ষার্থীদের অনলাইন ও অফলাইন পরীক্ষার ফলাফল, সেট ভিত্তিক নম্বর ও পারফরম্যান্স বিশ্লেষণ করুন।
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary shadow-sm mr-1">
                        <i class="fas fa-arrow-left mr-1"></i> কুইজ তালিকায় ফিরে যান
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card card-outline card-primary shadow-sm border-0 mb-3">
        <div class="card-header bg-white py-3 border-bottom">
            <form action="{{ route('admin.quizzes.reports') }}" method="GET" class="row align-items-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <select name="quiz_id" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল কুইজ / পরীক্ষা --</option>
                        @foreach($quizzes as $q)
                            <option value="{{ $q->id }}" {{ request('quiz_id') == $q->id ? 'selected' : '' }}>
                                {{ $q->title }} ({{ $q->course ? $q->course->course_title : 'General' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="set" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল প্রশ্ন সেট --</option>
                        <option value="Set A" {{ request('set') == 'Set A' ? 'selected' : '' }}>সেট ক (Set A)</option>
                        <option value="Set B" {{ request('set') == 'Set B' ? 'selected' : '' }}>সেট খ (Set B)</option>
                        <option value="Set C" {{ request('set') == 'Set C' ? 'selected' : '' }}>সেট গ (Set C)</option>
                        <option value="Set D" {{ request('set') == 'Set D' ? 'selected' : '' }}>সেট ঘ (Set D)</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">-- সকল স্ট্যাটাস --</option>
                        <option value="graded" {{ request('status') == 'graded' ? 'selected' : '' }}>মূল্যায়িত (Graded)</option>
                        <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>জমা দেওয়া হয়েছে</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>চলমান (In Progress)</option>
                    </select>
                </div>
                <div class="col-md-2 text-md-right">
                    @if(request()->hasAny(['quiz_id', 'set', 'status']))
                        <a href="{{ route('admin.quizzes.reports') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-sync mr-1"></i> রিসেট ফিল্টার
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
                        <th>শিক্ষার্থী</th>
                        <th>কুইজ ও বিষয়</th>
                        <th class="text-center">সেট</th>
                        <th class="text-center">প্রাপ্ত নম্বর</th>
                        <th class="text-center">নেগেটিভ কর্তন</th>
                        <th class="text-center">শতকরা</th>
                        <th class="text-center">সময়</th>
                        <th class="text-center">স্ট্যাটাস</th>
                        <th class="text-center">জমার তারিখ</th>
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
                                <div class="font-weight-bold text-dark">{{ $attempt->student ? $attempt->student->name : 'N/A' }}</div>
                                <div class="text-xs text-muted">
                                    <i class="fas fa-phone mr-1"></i> {{ $attempt->student ? $attempt->student->phone : 'N/A' }}
                                </div>
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark text-sm">{{ $attempt->quiz ? $attempt->quiz->title : 'N/A' }}</div>
                                <div class="text-xs text-primary">
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
                                <span class="font-weight-bold {{ $isPassed ? 'text-success' : 'text-danger' }}" style="font-size: 1.05rem;">
                                    {{ (float)$attempt->score }}
                                </span>
                                <span class="text-xs text-muted">/ {{ (float)$attempt->total_marks }}</span>
                            </td>
                            <td class="text-center text-sm text-danger font-weight-semibold">
                                {{ (float)$attempt->negative_marks_deducted > 0 ? '-' . (float)$attempt->negative_marks_deducted : '০.০০' }}
                            </td>
                            <td class="text-center font-weight-bold">
                                {{ (float)$attempt->percentage }}%
                            </td>
                            <td class="text-center text-xs font-mono text-muted">
                                {{ $attempt->formatted_time_spent }}
                            </td>
                            <td class="text-center">
                                @if($isPassed)
                                    <span class="badge badge-success px-2 py-1">উত্তীর্ণ (Passed)</span>
                                @else
                                    <span class="badge badge-danger px-2 py-1">অনুত্তীর্ণ (Failed)</span>
                                @endif
                            </td>
                            <td class="text-center text-xs text-muted">
                                {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M, Y h:i A') : $attempt->updated_at->format('d M, Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="fas fa-clipboard-list fa-3x mb-3 text-secondary d-block"></i>
                                কোনো পরীক্ষার ফলাফল বা প্রচেষ্টা পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($attempts->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $attempts->firstItem() }} থেকে {{ $attempts->lastItem() }} (মোট {{ $attempts->total() }})</span>
                    {{ $attempts->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection
