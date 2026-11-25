<style>
    .exam-tree-children {
        position: relative;
        margin-left: 18px;
        padding-left: 22px;
        border-left: 2px solid #CBD5E1;
    }
    .exam-tree-node {
        position: relative;
    }
    .exam-tree-node::before {
        content: '';
        position: absolute;
        left: -22px;
        top: 20px;
        width: 18px;
        height: 2px;
        background-color: #CBD5E1;
    }
    .exam-tree-node:last-child::after {
        content: '';
        position: absolute;
        left: -24px;
        top: 22px;
        bottom: 0;
        width: 4px;
        background-color: #F8FAFC;
    }
    .exam-tree-dot {
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        display: inline-block;
        flex-shrink: 0;
    }
</style>

@if(($activeTab ?? 'attempts') === 'exams')
    @if(isset($liveExamDiagrams) && $liveExamDiagrams->count() > 0)
        @include('backend.theme.clasic.lms.quizzes.partials.live_exam_tree')
    @else
        <div class="card border shadow-sm p-5 text-center mb-4 bg-white">
            <i class="fas fa-bolt fa-3x text-muted mb-2"></i>
            <h5 class="font-weight-bold text-dark">কোনো লাইভ এক্সামের ফলাফল পাওয়া যায়নি।</h5>
        </div>
    @endif
@endif

@if(($activeTab ?? 'attempts') === 'attempts' && isset($liveExamDiagrams) && $liveExamDiagrams->count() > 0)
    @include('backend.theme.clasic.lms.quizzes.partials.live_exam_tree')
@endif

@if(($activeTab ?? 'attempts') === 'practice')
    @if(isset($practiceUserTrees) && $practiceUserTrees->count() > 0)
        <div id="practice-user-tree-section" class="mb-4">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                <div>
                    <h4 class="font-weight-bold mb-0" style="color: #0F172A;">
                        <i class="fas fa-flask text-info mr-2"></i> অনুশীলন পরীক্ষা: শিক্ষার্থীভিত্তিক প্যারেন্ট-চাইল্ড ট্রি (User Practice Tree)
                    </h4>
                    <p class="text-muted text-xs mb-0">
                        প্রতিটি শিক্ষার্থীর নাম মাত্র ১ বার দেখাবে এবং তার সব অনুশীলন পরীক্ষার ফলাফল তার অধীনে প্যারেন্ট-চাইল্ড ট্রি আকারে সাজানো থাকবে।
                    </p>
                </div>
                <div class="d-flex align-items-center" style="gap: 8px;">
                    <span class="badge badge-info px-3 py-2 font-weight-bold">
                        মোট শিক্ষার্থী: {{ $practiceUserTrees->count() }} জন
                    </span>
                    <span class="badge badge-secondary px-3 py-2 font-weight-bold">
                        মোট অনুশীলন: {{ $practiceUserTrees->sum('total_attempts') }} বার
                    </span>
                </div>
            </div>

            <div class="card border shadow-sm rounded-lg overflow-hidden" style="background: #F8FAFC; border-color: #CBD5E1 !important;">
                <div class="card-body p-3">
                    @foreach($practiceUserTrees as $pIdx => $pt)
                        @php
                            $initPractice = $pt->initial_attempt;
                            $bestPractice = $pt->best_attempt;
                            $hasAnyPass = $pt->passed_count > 0;
                            $prevScore = (float)$initPractice->score;
                        @endphp
                        <div class="bg-white border rounded-lg p-3 mb-2.5 shadow-xs" style="border-color: {{ $hasAnyPass ? '#86EFAC' : '#FCA5A5' }} !important;">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="d-flex align-items-center flex-wrap" style="gap: 8px;">
                                    <span class="badge badge-secondary font-mono">{{ $pIdx + 1 }}</span>
                                    <span class="exam-tree-dot" style="background: {{ $hasAnyPass ? '#16A34A' : '#DC2626' }};"></span>
                                    <span class="font-weight-bold text-sm" style="color: #0F172A;">
                                        {{ $pt->student ? $pt->student->name : 'N/A' }}
                                    </span>
                                    @if($pt->student && $pt->student->student_id_code)
                                        <span class="badge badge-light border font-mono text-xs">{{ $pt->student->student_id_code }}</span>
                                    @endif
                                    <span class="text-xs text-muted">{{ $pt->student ? $pt->student->phone : '' }}</span>
                                    @if($pt->student)
                                        <a href="{{ route('admin.quizzes.reports.student-tree', $pt->student->id) }}" class="btn btn-xs btn-outline-secondary font-weight-bold" title="সম্পূর্ণ ইতিহাস ট্রি">
                                            <i class="fas fa-sitemap"></i> সব ফলাফল
                                        </a>
                                    @endif
                                </div>

                                <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                    <span class="badge badge-info px-2 py-1 text-xs">
                                        মোট অনুশীলন: {{ $pt->total_attempts }} বার
                                    </span>
                                    <span class="badge bg-emerald-100 px-2 py-1 text-xs" style="color: #000000 !important;">
                                        পাস: {{ $pt->passed_count }}
                                    </span>
                                    <span class="badge badge-danger px-2 py-1 text-xs">
                                        ফেল: {{ $pt->failed_count }}
                                    </span>
                                    <span class="text-xs font-weight-bold" style="color: #334155;">
                                        সেরা: <strong style="color: #0F172A;">{{ (float)$bestPractice->score }}/{{ (float)$bestPractice->total_marks }}</strong> (গড়: {{ $pt->avg_pct }}%)
                                    </span>
                                </div>
                            </div>

                            <div class="exam-tree-children mt-2.5">
                                @foreach($pt->attempts as $aIdx => $pAtt)
                                    @php
                                        $pStats = $pAtt->getBreakdownStats();
                                        $pPassed = $pAtt->isPassed();
                                        $delta = $aIdx > 0 ? round((float)$pAtt->score - $prevScore, 2) : 0;
                                        $prevScore = (float)$pAtt->score;
                                    @endphp
                                    <div class="exam-tree-node d-flex flex-wrap align-items-center justify-content-between py-2 px-3 mb-2 rounded border bg-white" style="border-color: {{ $pPassed ? '#BBF7D0' : '#FECACA' }} !important;">
                                        <div class="d-flex flex-wrap align-items-center" style="gap: 8px;">
                                            <span class="exam-tree-dot" style="background: {{ $pPassed ? '#16A34A' : '#DC2626' }};"></span>
                                            @if($aIdx === 0)
                                                <span class="badge badge-dark text-xs">প্র্যাকটিস #1 (মূল)</span>
                                            @else
                                                <span class="badge badge-info text-xs">প্র্যাকটিস #{{ $aIdx + 1 }}</span>
                                            @endif
                                            <span class="text-xs font-weight-bold" style="color: #334155;">
                                                {{ $pAtt->quiz ? $pAtt->quiz->title : 'Practice' }}
                                            </span>
                                            <span class="font-weight-bold text-xs {{ $pPassed ? 'text-success' : 'text-danger' }}">
                                                {{ (float)$pAtt->score }}/{{ (float)$pAtt->total_marks }} ({{ (float)$pAtt->percentage }}%)
                                                @if($aIdx > 0 && $delta > 0)
                                                    <span class="text-success">(+{{ $delta }})</span>
                                                @elseif($aIdx > 0 && $delta < 0)
                                                    <span class="text-danger">({{ $delta }})</span>
                                                @endif
                                            </span>
                                            <span class="badge {{ $pPassed ? 'badge-success' : 'badge-danger' }} text-xs">
                                                {{ $pPassed ? 'Pass' : 'Fail' }}
                                            </span>
                                            <span class="text-xs" style="color: #475569;">
                                                উত্তর: <strong>{{ $pStats['answered'] }}/{{ $pStats['total'] }}</strong> &bull;
                                                সঠিক: <strong class="text-success">{{ $pStats['correct'] }}</strong> &bull;
                                                ভুল: <strong class="text-danger">{{ $pStats['wrong'] }}</strong> &bull;
                                                বাকি: <strong>{{ $pStats['unanswered'] }}</strong>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center" style="gap: 8px;">
                                            <span class="text-xs text-muted font-mono">
                                                {{ $pAtt->submitted_at ? $pAtt->submitted_at->timezone('Asia/Dhaka')->format('d M, h:i A') : $pAtt->created_at->timezone('Asia/Dhaka')->format('d M, h:i A') }}
                                            </span>
                                            <a href="{{ route('admin.quizzes.attempt-detail', $pAtt->id) }}" class="btn btn-xs btn-outline-primary font-weight-bold">
                                                <i class="fas fa-eye mr-1"></i> উত্তরপত্র
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="card border shadow-sm p-5 text-center mb-4 bg-white">
            <i class="fas fa-flask fa-3x text-muted mb-2"></i>
            <h5 class="font-weight-bold text-dark">কোনো অনুশীলন পরীক্ষার ফলাফল পাওয়া যায়নি।</h5>
        </div>
    @endif
@endif

@if(($activeTab ?? 'attempts') === 'attempts')
    <div class="card card-outline card-primary shadow-sm border-0 mb-3">
        <!-- Bulk Action Bar for Selected Results -->
        <div id="bulkActionBar" class="card-header bg-light border-bottom py-2" style="display: none;">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center my-1">
                    <span class="badge badge-primary px-2.5 py-1 text-sm font-weight-bold mr-2">
                        <i class="fas fa-check-square mr-1"></i> <span id="selectedCountText">০</span> টি ফলাফল নির্বাচিত
                    </span>
                    <span class="text-xs text-muted">একসাথে একাধিক ফলাফল ডিলিট করতে পাশের বাটন ব্যবহার করুন।</span>
                </div>
                <div class="my-1">
                    <button type="button" class="btn btn-sm btn-danger font-weight-bold shadow-sm" onclick="executeBulkDelete()">
                        <i class="fas fa-trash-alt mr-1"></i> নির্বাচিত ফলাফল মুছুন (Bulk Delete)
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary ml-1" onclick="clearAllSelections()">
                        বাতিল
                    </button>
                </div>
            </div>
        </div>

        <form id="bulkResetViolationsForm" action="{{ route('admin.quizzes.reports.bulk-reset-violations') }}" method="POST" style="display: none;">
            @csrf
            <div id="bulkResetInputsContainer"></div>
        </form>
        <form id="bulkDeleteForm" action="{{ route('admin.quizzes.reports.bulk-delete') }}" method="POST">
            @csrf
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">
                        <tr>
                            <th class="text-center" style="width: 48px;">
                                <input type="checkbox" id="selectAllCheckbox" class="adm-checkbox" title="সবগুলো একসাথে নির্বাচন করুন">
                            </th>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>শিক্ষার্থীর তথ্য</th>
                            <th>কুইজ ও কোর্স</th>
                            <th class="text-center">সেট</th>
                            <th class="text-center">প্রাপ্ত নম্বর</th>
                            <th class="text-center">নেগেটিভ কর্তন</th>
                            <th class="text-center">শতকরা</th>
                            <th class="text-center">সময়</th>
                            <th class="text-center">ফলাফল</th>
                            <th class="text-center" style="width: 120px;">নিরাপত্তা অডিট</th>
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
                                <td class="text-center">
                                    <input type="checkbox" name="attempt_ids[]" value="{{ $attempt->id }}" class="attempt-checkbox adm-checkbox" title="অ্যাটেম্পট #{{ $attempt->id }} নির্বাচন করুন">
                                </td>
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
                                    <div class="font-weight-bold text-dark text-sm">
                                        {{ $attempt->quiz ? $attempt->quiz->title : 'N/A' }}
                                        @if($attempt->quiz && $attempt->quiz->quiz_type === 'exam')
                                            <span class="badge badge-danger ml-1 text-xs">লাইভ এক্সাম</span>
                                        @elseif($attempt->quiz && $attempt->quiz->quiz_type === 'practice')
                                            <span class="badge badge-info ml-1 text-xs">অনুশীলন</span>
                                        @else
                                            <span class="badge badge-secondary ml-1 text-xs">কুইজ</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-primary font-weight-semibold">
                                        <i class="fas fa-graduation-cap mr-1"></i>
                                        {{ $attempt->quiz && $attempt->quiz->course ? $attempt->quiz->course->course_title : 'General' }}
                                    </div>
                                    @php
                                        $retakes = $attempt->retakes ?: collect();
                                        $retakeCount = $retakes->count();
                                        $allChain = collect([$attempt])->concat($retakes);
                                        $passedInChain = $allChain->first(function($a) { return $a->isPassed(); });
                                    @endphp
                                    @if($retakeCount > 0)
                                        <div class="mt-1">
                                            <button type="button" class="btn btn-xs btn-outline-info font-weight-bold py-0 px-2" onclick="toggleAdminRetakes({{ $attempt->id }})" id="admin-retake-btn-{{ $attempt->id }}">
                                                <i class="fas fa-sitemap mr-1"></i> {{ $retakeCount }}টি রিটেক <i class="fas fa-chevron-down ml-0.5"></i>
                                            </button>
                                            @if($passedInChain)
                                                <span class="badge badge-success px-1.5 py-0.5 ml-1 text-xs"><i class="fas fa-check-circle mr-0.5"></i> {{ $passedInChain->attempt_number }}ম বারে উত্তীর্ণ</span>
                                            @else
                                                <span class="badge badge-warning text-dark px-1.5 py-0.5 ml-1 text-xs">পুনঃচেষ্টা চলমান</span>
                                            @endif
                                        </div>
                                    @endif
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
                                    <span class="badge {{ $attempt->percentage >= 100 ? 'badge-success' : ($attempt->percentage >= 50 ? 'badge-info' : 'badge-danger') }} px-2 py-1 text-xs">
                                        {{ (float)$attempt->percentage }}%
                                    </span>
                                </td>
                                <td class="text-center text-xs font-mono text-muted">
                                    <i class="far fa-clock mr-1"></i> {{ $attempt->formatted_time_spent }}
                                </td>
                                <td class="text-center">
                                    @if($attempt->status === 'graded')
                                        @if($isPassed)
                                            <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> উত্তীর্ণ (Passed)</span>
                                        @else
                                            <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> অনুত্তীর্ণ (Fail)</span>
                                        @endif
                                    @elseif($attempt->status === 'submitted')
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-hourglass-half mr-1"></i> মূল্যায়নাধীন</span>
                                    @elseif($attempt->status === 'timed_out' || ($attempt->started_at && $attempt->quiz && \Carbon\Carbon::now()->greaterThan($attempt->started_at->copy()->addMinutes($attempt->quiz->duration_minutes + 2))))
                                        <span class="badge badge-secondary px-2 py-1 font-weight-bold" style="background-color: #64748b; color: #ffffff;" title="নির্ধারিত পরীক্ষার সময় পার হয়েছে">
                                            <i class="far fa-clock mr-1"></i> সময় সমাপ্ত (Timed Out)
                                        </span>
                                    @else
                                        <span class="badge badge-info px-2 py-1 font-weight-bold" style="background-color: #0284c7; color: #ffffff;">
                                            <i class="fas fa-edit mr-1"></i> চলমান (In Progress)
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(($attempt->security_violations_count ?: 0) == 0)
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-shield-alt mr-1"></i> ক্লিন (Clean)</span>
                                    @else
                                        <button type="button"
                                                class="btn btn-xs {{ $attempt->security_violations_count >= 3 ? 'btn-danger' : 'btn-warning' }} font-weight-bold"
                                                onclick="openViolationAuditModal({{ $attempt->id }}, '{{ addslashes($attempt->student ? $attempt->student->name : 'N/A') }}', {{ (int)$attempt->security_violations_count }}, {{ json_encode($attempt->security_violations_log ?: []) }})"
                                                title="নিরাপত্তা লঙ্ঘন অডিট লগ দেখুন">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> {{ $attempt->security_violations_count }}টি লঙ্ঘন
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center text-xs text-muted">
                                    {{ $attempt->submitted_at ? $attempt->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $attempt->updated_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.quizzes.attempt-detail', $attempt->id) }}" class="btn btn-outline-primary font-weight-bold" title="বিস্তারিত উত্তরপত্র ও মূল্যায়ন দেখুন">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="এই শিক্ষার্থীর ফলাফল মুছে ফেলুন" onclick="confirmSingleDelete({{ $attempt->id }}, '{{ addslashes($attempt->student ? $attempt->student->name : 'শিক্ষার্থী') }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            @if($retakeCount > 0)
                                <tr id="admin-retakes-{{ $attempt->id }}" class="d-none" style="background-color: #f8fafc;">
                                    <td colspan="12" class="p-3">
                                        <div class="border rounded bg-white p-3 shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                                                <span class="font-weight-bold text-xs text-primary">
                                                    <i class="fas fa-sitemap mr-1"></i> পুনঃপরীক্ষা ও প্রচেষ্টার ধারাবাহিক ট্র্যাকিং হিস্টোরি (Parent-Child Chain)
                                                </span>
                                                <span class="text-xs text-muted">
                                                    মোট অংশগ্রহণ: {{ $retakeCount + 1 }} বার | {{ $passedInChain ? '১০০% সফল উত্তীর্ণ' : '১০০% অর্জনের চেষ্টা চলছে' }}
                                                </span>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered text-center text-xs mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th>চেষ্টা ক্রম</th>
                                                            <th>তারিখ ও সময় (BD Time)</th>
                                                            <th>প্রাপ্ত নম্বর (Score)</th>
                                                            <th>প্রশ্ন বিশ্লেষণ (উত্তর / সঠিক / ভুল / বাকি)</th>
                                                            <th>শতকরা (Pct)</th>
                                                            <th>নেগেটিভ কর্তন</th>
                                                            <th>ফলাফল</th>
                                                            <th>অ্যাকশন</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($allChain as $idx => $sub)
                                                            @php
                                                                $subPassed = $sub->isPassed();
                                                                $subStats = $sub->getBreakdownStats();
                                                            @endphp
                                                            <tr class="{{ $subPassed ? 'table-success' : '' }}">
                                                                <td class="font-weight-bold">
                                                                    @if($idx === 0)
                                                                        <span class="badge badge-secondary">মূল পরীক্ষা (#1)</span>
                                                                    @else
                                                                        <span class="badge badge-info">পুনঃপরীক্ষা #{{ $idx }} (Attempt #{{ $sub->attempt_number }})</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $sub->submitted_at ? $sub->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $sub->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
                                                                </td>
                                                                <td class="font-weight-bold {{ $subPassed ? 'text-success' : 'text-danger' }}">
                                                                    {{ (float)$sub->score }} / {{ (float)$sub->total_marks }}
                                                                </td>
                                                                <td>
                                                                    <span class="badge badge-light border">উত্তর: {{ $subStats['answered'] }}/{{ $subStats['total'] }}</span>
                                                                    <span class="badge bg-emerald-100" style="color: #000000 !important;">সঠিক: {{ $subStats['correct'] }}</span>
                                                                    <span class="badge badge-danger">ভুল: {{ $subStats['wrong'] }}</span>
                                                                    <span class="badge badge-warning text-dark">বাকি: {{ $subStats['unanswered'] }}</span>
                                                                </td>
                                                                <td class="font-weight-bold">
                                                                    {{ (float)$sub->percentage }}%
                                                                </td>
                                                                <td class="text-danger font-weight-semibold">
                                                                    {{ (float)$sub->negative_marks_deducted > 0 ? '-' . (float)$sub->negative_marks_deducted : '০.০০' }}
                                                                </td>
                                                                <td>
                                                                    @if($subPassed)
                                                                        <span class="badge badge-success px-2 py-0.5"><i class="fas fa-check-circle mr-1"></i> উত্তীর্ণ (Passed)</span>
                                                                    @else
                                                                        <span class="badge badge-danger px-2 py-0.5"><i class="fas fa-times-circle mr-1"></i> অনুত্তীর্ণ (Fail)</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group btn-group-xs">
                                                                        <a href="{{ route('admin.quizzes.attempt-detail', $sub->id) }}" class="btn btn-xs btn-outline-primary font-weight-bold" title="বিস্তারিত উত্তরপত্র দেখুন">
                                                                            <i class="fas fa-eye mr-1"></i> Review
                                                                        </a>
                                                                        <button type="button" class="btn btn-xs btn-outline-danger" title="শুধু এই প্রচেষ্টার ফলাফল মুছুন" onclick="confirmSingleDelete({{ $sub->id }}, '{{ addslashes($attempt->student ? $attempt->student->name : 'শিক্ষার্থী') }}')">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-5 text-muted">
                                    <i class="fas fa-clipboard-list fa-3x mb-3 text-secondary d-block"></i>
                                    <h5>কোনো শিক্ষার্থীর পরীক্ষার ফলাফল পাওয়া যায়নি!</h5>
                                    <p class="text-xs text-muted">শিক্ষার্থীরা অনলাইন বা ওএমআর কুইজে অংশগ্রহণ করলে তাদের রেজাল্ট স্বয়ংক্রিয়ভাবে এখানে তালিকাভুক্ত হবে।</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        @if($attempts->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <span class="text-xs text-muted">দেখাচ্ছে {{ $attempts->firstItem() }} থেকে {{ $attempts->lastItem() }} (মোট {{ $attempts->total() }}টি ফলাফল)</span>
                    {{ $attempts->links() }}
                </div>
            </div>
        @endif
    </div>
@endif
