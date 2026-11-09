@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'শিক্ষার্থীর উত্তরপত্র ও ফলাফল মূল্যায়ন — Wake Up ICT')

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_reports_active', 'active')

@section('maincontant')
@php
    $bngDigits = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
    $toBng = function($num) use ($bngDigits) {
        return strtr((string)$num, $bngDigits);
    };

    $isPassed = $attempt->isPassed();
    $totalQ = $questions->count();
    $correctCount = 0;
    $incorrectCount = 0;
    $unansweredCount = 0;
    $pendingCount = 0;

    foreach ($questions as $q) {
        $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
        if (!$ans || (empty($ans->selected_option_ids_array) && empty($ans->text_answer) && empty($ans->cq_answers))) {
            $unansweredCount++;
        } elseif ($ans->grading_status === 'pending_review') {
            $pendingCount++;
        } elseif ($ans->is_correct) {
            $correctCount++;
        } else {
            $incorrectCount++;
        }
    }

    $pct = $attempt->percentage;
    $grade = 'F';
    $gradeBadge = 'badge-danger';
    if ($pct >= 80) {
        $grade = 'A+';
        $gradeBadge = 'badge-success';
    } elseif ($pct >= 70) {
        $grade = 'A';
        $gradeBadge = 'badge-success';
    } elseif ($pct >= 60) {
        $grade = 'A-';
        $gradeBadge = 'badge-info';
    } elseif ($pct >= 50) {
        $grade = 'B';
        $gradeBadge = 'badge-warning';
    } elseif ($pct >= 40) {
        $grade = 'C';
        $gradeBadge = 'badge-warning';
    }

    $assignedSet = $attempt->question_set ?: (($quiz && $quiz->question_set) ? $quiz->question_set : 'Set A');
@endphp

    <!-- Header Actions -->
    <div class="content-header p-0 mb-3 no-print">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold" style="font-size: 1.4rem;">
                        <i class="fas fa-file-invoice text-primary mr-2"></i> শিক্ষার্থীর পূর্ণাঙ্গ উত্তরপত্র ও ফলাফল বিবরণী
                    </h1>
                    <p class="text-muted text-sm mb-0">
                        {{ $attempt->student ? $attempt->student->name : 'শিক্ষার্থী' }} এর পরীক্ষা মূল্যায়ন ও কনসেপ্ট বিশ্লেষণ।
                    </p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <a href="{{ route('admin.quizzes.reports') }}" class="btn btn-outline-secondary shadow-sm mr-1">
                        <i class="fas fa-arrow-left mr-1"></i> সকল রেজাল্ট তালিকায় ফিরুন
                    </a>
                    <form action="{{ route('admin.quizzes.attempt.destroy', $attempt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই শিক্ষার্থীর পরীক্ষার ফলাফলটি মুছে ফেলতে চান? মুছে ফেললে শিক্ষার্থী পুনরায় এই পরীক্ষায় অংশগ্রহণ করতে পারবে।');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger shadow-sm mr-1" title="এই ফলাফলটি মুছে ফেলুন">
                            <i class="fas fa-trash-alt mr-1"></i> ফলাফল মুছুন
                        </button>
                    </form>
                    <button type="button" class="btn btn-primary shadow-sm" onclick="window.print()">
                        <i class="fas fa-print mr-1"></i> উত্তরপত্র প্রিন্ট করুন
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Student & Exam Information Summary Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <!-- Student Info Left -->
                <div class="col-md-7 border-right-md mb-3 mb-md-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-circle mr-3 bg-primary text-white font-weight-bold d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 50%; font-size: 1.4rem;">
                            {{ $attempt->student ? strtoupper(substr($attempt->student->name, 0, 1)) : 'S' }}
                        </div>
                        <div>
                            <h4 class="font-weight-bold text-dark mb-0">{{ $attempt->student ? $attempt->student->name : 'N/A' }}</h4>
                            <div class="text-muted text-xs">
                                <span><i class="fas fa-phone mr-1"></i> {{ $attempt->student ? $attempt->student->phone : 'N/A' }}</span>
                                @if($attempt->student && $attempt->student->email)
                                    <span class="ml-2"><i class="fas fa-envelope mr-1"></i> {{ $attempt->student->email }}</span>
                                @endif
                                @if($attempt->student && $attempt->student->student_id_code)
                                    <span class="badge badge-light border ml-2">{{ $attempt->student->student_id_code }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row text-sm">
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">কুইজ / পরীক্ষা:</span>
                            <span class="font-weight-bold text-dark ml-1">{{ $quiz ? $quiz->title : ($attempt->quiz_title ?: 'পরীক্ষা / কুইজ') }}</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">কোর্স / বিষয়:</span>
                            <span class="font-weight-bold text-primary ml-1">{{ $quiz && $quiz->course ? $quiz->course->course_title : ($quiz ? 'General' : 'কোর্স অনির্ধারিত') }}</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">প্রশ্ন সেট:</span>
                            <span class="badge badge-light border font-weight-bold ml-1">{{ $assignedSet }} ({{ \App\model\LmsQuiz::getBengaliSetCode($assignedSet) }})</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">সময় ব্যয়:</span>
                            <span class="font-weight-bold text-dark ml-1 font-mono">{{ $attempt->formatted_time_spent }}</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">জমার সময় (BD Time):</span>
                            <span class="text-dark ml-1 font-weight-bold">{{ $attempt->submitted_at ? $attempt->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $attempt->updated_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">প্রচেষ্টা নং:</span>
                            <span class="badge badge-secondary ml-1">#{{ $attempt->attempt_number }}</span>
                        </div>
                    </div>
                </div>

                <!-- Score KPI Right -->
                <div class="col-md-5 text-center">
                    <div class="p-3 bg-light rounded border">
                        <div class="d-flex justify-content-around align-items-center mb-2">
                            <div>
                                <div class="text-xs text-muted text-uppercase font-weight-bold">প্রাপ্ত নম্বর</div>
                                <div class="h2 font-weight-bold mb-0 {{ $isPassed ? 'text-success' : 'text-danger' }}">
                                    {{ (float)$attempt->score }} <span class="text-xs text-muted">/ {{ (float)$attempt->total_marks }}</span>
                                </div>
                            </div>
                            <div class="border-left pl-3">
                                <div class="text-xs text-muted text-uppercase font-weight-bold">গ্রেড</div>
                                <div class="h2 font-weight-bold mb-0"><span class="badge {{ $gradeBadge }} px-3 py-1">{{ $grade }}</span></div>
                            </div>
                            <div class="border-left pl-3">
                                <div class="text-xs text-muted text-uppercase font-weight-bold">শতকরা</div>
                                <div class="h3 font-weight-bold text-primary mb-0">{{ (float)$attempt->percentage }}%</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between text-xs text-muted border-top pt-2 mt-2">
                            <span>সঠিক: <strong class="text-success">{{ $correctCount }}</strong></span>
                            <span>ভুল: <strong class="text-danger">{{ $incorrectCount }}</strong></span>
                            <span>অনুত্তর: <strong class="text-muted">{{ $unansweredCount }}</strong></span>
                            @if((float)$attempt->negative_marks_deducted > 0)
                                <span>নেগেটিভ কর্তন: <strong class="text-danger">-{{ (float)$attempt->negative_marks_deducted }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Security & Anti-Cheating Audit Log Card (Compact Notification Feed) -->
    <div class="card shadow-sm border-0 mb-4" id="violations-audit-card">
        <div class="card-header bg-white py-2.5 px-3 border-bottom d-flex justify-content-between align-items-center flex-wrap" style="gap: 8px;">
            <div class="d-flex align-items-center" style="gap: 8px;">
                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 0.95rem;">
                    <i class="fas fa-shield-alt text-primary mr-1.5"></i> পরীক্ষা নিরাপত্তা ও অখণ্ডতা নিরীক্ষা (Exam Security Audit Feed)
                </h6>
                @if(($attempt->security_violations_count ?: 0) > 0)
                    <span class="badge {{ $attempt->security_violations_count >= 3 ? 'badge-danger' : 'badge-warning' }} px-2 py-0.5 font-weight-bold" style="{{ $attempt->security_violations_count >= 3 ? 'color: #000000 !important; font-weight: 800;' : '' }}">
                        <i class="fas fa-exclamation-triangle mr-1"></i> মোট নিরাপত্তা লঙ্ঘন: {{ $attempt->security_violations_count }}টি
                    </span>
                @else
                    <span class="badge badge-success px-2 py-0.5 font-weight-bold">
                        <i class="fas fa-check-circle mr-1"></i> ক্লিন পরীক্ষা (0 Violation)
                    </span>
                @endif
            </div>

            <div class="d-flex align-items-center" style="gap: 8px;">
                @if(($totalViolations ?? 0) > 0)
                    <span id="violations-loaded-counter" class="badge badge-light border text-muted px-2 py-1 font-mono text-xs">
                        প্রদর্শিত: <strong class="text-dark" id="current-loaded-count">{{ min(10, $totalViolations) }}</strong> / {{ $totalViolations }}টি
                    </span>
                    <button type="button" onclick="confirmResetThisAttemptViolations({{ $attempt->id }})" class="btn btn-xs btn-outline-danger font-weight-bold" title="স্থায়ীভাবে সকল লঙ্ঘন রিসেট করুন">
                        <i class="fas fa-undo-alt mr-1"></i> স্থায়ী রিসেট
                    </button>
                @endif
            </div>
        </div>

        <div class="card-body p-2.5">
            @if(($totalViolations ?? 0) == 0 && empty($attempt->security_violations_log))
                <div class="p-3 bg-light rounded text-success font-weight-bold text-center border text-sm">
                    <i class="fas fa-check-circle mr-1 text-success"></i> কোনো নিরাপত্তা লঙ্ঘন পরিলক্ষিত হয়নি। শিক্ষার্থী সম্পূর্ণ ক্লিন পরিবেশে পরীক্ষা সম্পন্ন করেছেন।
                </div>
            @else
                <div class="p-2 mb-2 bg-light rounded border text-muted d-flex align-items-center justify-content-between" style="font-size: 0.78rem;">
                    <div>
                        <i class="fas fa-info-circle text-info mr-1"></i> <strong>লাইভ অডিট নোটিশ:</strong> স্ক্রল করুন, নিচে নামলে প্রতিবারে ১০টি করে রেকর্ড লোড হবে।
                    </div>
                    <span class="text-muted"><i class="fas fa-mouse text-secondary mr-1"></i> On-Scroll Feed</span>
                </div>

                <!-- Compact Scrollable Notification Container (Max-height ~360px) -->
                <div id="violations-scroll-container" class="pr-1" style="max-height: 360px; overflow-y: auto; scrollbar-width: thin;">
                    <div id="violations-items-list">
                        @foreach($initialViolations as $idx => $v)
                            @php
                                $isDbModel = $v instanceof \App\model\LmsExamViolation;
                                $serial = $idx + 1;
                                $warnCount = $isDbModel ? $v->warning_count : ($v['warning_number'] ?? $serial);
                                $title = $isDbModel ? $v->violation_title : ($v['title'] ?? ($v['violation_type'] ?? 'নিরাপত্তা লঙ্ঘন'));
                                $details = $isDbModel ? ($v->details ?: 'অননুমোদিত কার্যকলাপ সনাক্ত') : ($v['details'] ?? '—');
                                $ip = $isDbModel ? ($v->ip_address ?: '—') : '—';
                                $time = $isDbModel ? ($v->created_at ? $v->created_at->format('d M, Y h:i:s A') : '—') : ($v['time'] ?? '—');
                                $vType = $isDbModel ? $v->violation_type : ($v['violation_type'] ?? 'default');

                                $icon = 'fa-exclamation-triangle';
                                if (strpos($vType, 'tab') !== false || strpos($vType, 'blur') !== false) {
                                    $icon = 'fa-window-restore';
                                } elseif (strpos($vType, 'click') !== false) {
                                    $icon = 'fa-mouse-pointer';
                                } elseif (strpos($vType, 'copy') !== false || strpos($vType, 'cut') !== false || strpos($vType, 'paste') !== false) {
                                    $icon = 'fa-copy';
                                } elseif (strpos($vType, 'shortcut') !== false || strpos($vType, 'key') !== false) {
                                    $icon = 'fa-keyboard';
                                } elseif (strpos($vType, 'dev') !== false) {
                                    $icon = 'fa-code';
                                }
                            @endphp
                            <div class="violation-item p-2 mb-1.5 rounded border bg-white d-flex align-items-center justify-content-between" style="border-color: #e2e8f0; font-size: 0.82rem; transition: background-color 0.2s;">
                                <div class="d-flex align-items-center" style="gap: 10px; min-width: 0;">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 {{ $warnCount >= 3 ? 'bg-danger text-white' : ($warnCount == 2 ? 'bg-warning text-dark' : 'bg-info text-white') }}" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                    <div style="min-width: 0;">
                                        <div class="d-flex align-items-center flex-wrap" style="gap: 5px;">
                                            <span class="badge {{ $warnCount >= 3 ? 'badge-danger' : ($warnCount == 2 ? 'badge-warning' : 'badge-info') }} px-1.5 py-0.5" style="font-size: 0.72rem; {{ $warnCount >= 3 ? 'color: #000000 !important; font-weight: 800;' : '' }}">
                                                #{{ $serial }} সতর্কতা {{ $warnCount }}
                                            </span>
                                            <strong class="text-dark font-weight-bold text-truncate" style="color: #0f172a !important;">{{ $title }}</strong>
                                        </div>
                                        <div class="text-muted text-truncate" style="font-size: 0.75rem; color: #475569 !important; margin-top: 1px;">
                                            {{ $details }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0 ml-2 font-mono" style="font-size: 0.75rem; white-space: nowrap;">
                                    <div class="text-dark font-weight-semibold" style="color: #0f172a !important;">
                                        <i class="fas fa-network-wired text-muted mr-1" style="font-size: 0.7rem;"></i>{{ $ip }}
                                    </div>
                                    <div class="text-muted" style="font-size: 0.7rem;">
                                        <i class="far fa-clock text-muted mr-1"></i>{{ $time }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Spinner Indicator -->
                    <div id="violations-loading-indicator" class="text-center py-2 text-muted text-xs d-none">
                        <i class="fas fa-spinner fa-spin text-primary mr-1"></i> আরো ১০টি লোড হচ্ছে...
                    </div>

                    <!-- End of Feed Indicator -->
                    <div id="violations-end-indicator" class="text-center py-2 text-muted text-xs {{ ($hasMoreViolations ?? false) ? 'd-none' : '' }}">
                        <i class="fas fa-check-circle text-success mr-1"></i> সকল {{ $totalViolations ?? 0 }}টি সতর্কতা লোড হয়েছে
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Questions & Student Answers Sheet (Matching Student Review UI & Colors) -->
    <div class="card shadow-sm border-0 mb-4" id="admin-questions-wrapper">
        <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h5 class="card-title font-weight-bold text-dark mb-0">
                    <i class="fas fa-tasks text-primary mr-2"></i> প্রশ্নপত্র ও শিক্ষার্থীর উত্তরপত্র বিশদ মূল্যায়ন (Answer Sheet)
                </h5>
                <small class="text-muted">প্রতিটি প্রশ্নের শিক্ষার্থীর প্রদত্ত উত্তর ও সঠিক সমাধান বিবরণী</small>
            </div>
            <div class="d-flex align-items-center flex-wrap gap-2">
                <span class="badge badge-light border text-xs px-2.5 py-1.5 font-weight-bold">মোট প্রশ্ন: {{ $totalQ }}টি</span>
            </div>
        </div>
        <div class="card-body p-3 p-md-4">
            
            <!-- Filter Pills & Layout Controls Toolbar -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pb-3 mb-3 border-bottom">
                <!-- Status Filter Pills -->
                <div class="d-flex flex-wrap align-items-center gap-1.5" style="gap: 6px;">
                    <button type="button" onclick="adminFilterQuestions('all')" id="admin-btn-filter-all" class="btn btn-sm btn-primary font-weight-bold shadow-sm d-flex align-items-center" style="border-radius: 10px;">
                        <span>সব প্রশ্ন</span>
                        <span class="badge badge-light text-primary ml-1.5 font-mono">{{ $totalQ }}</span>
                    </button>
                    <button type="button" onclick="adminFilterQuestions('wrong')" id="admin-btn-filter-wrong" class="btn btn-sm btn-outline-danger font-weight-bold d-flex align-items-center" style="border-radius: 10px;">
                        <i class="fas fa-times-circle mr-1"></i>
                        <span>ভুল উত্তর</span>
                        <span class="badge badge-danger ml-1.5 font-mono" style="background-color: #fee2e2; color: #dc2626 !important; font-weight: 800;">{{ $incorrectCount }}</span>
                    </button>
                    <button type="button" onclick="adminFilterQuestions('correct')" id="admin-btn-filter-correct" class="btn btn-sm btn-outline-success font-weight-bold d-flex align-items-center" style="border-radius: 10px;">
                        <i class="fas fa-check-circle mr-1"></i>
                        <span>সঠিক উত্তর</span>
                        <span class="badge badge-success ml-1.5 font-mono" style="background-color: #dcfce7; color: #16a34a !important; font-weight: 800;">{{ $correctCount }}</span>
                    </button>
                    <button type="button" onclick="adminFilterQuestions('unanswered')" id="admin-btn-filter-unanswered" class="btn btn-sm btn-outline-secondary font-weight-bold d-flex align-items-center" style="border-radius: 10px;">
                        <span>উত্তরহীন</span>
                        <span class="badge badge-secondary ml-1.5 font-mono">{{ $unansweredCount }}</span>
                    </button>
                </div>

                <!-- Right View Controls: Search & Toggle Explanations & Layout Switch -->
                <div class="d-flex align-items-center flex-wrap gap-2" style="gap: 8px;">
                    <!-- Real-Time Question Search Filter -->
                    <div class="input-group input-group-sm" style="max-width: 220px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-search text-muted"></i></span>
                        </div>
                        <input type="text" id="admin-question-search" oninput="adminSearchQuestions(this.value)" placeholder="প্রশ্ন অনুসন্ধান..." class="form-control border-left-0" style="border-radius: 0 8px 8px 0; font-size: 12px;">
                    </div>

                    <!-- Toggle All Explanations Button -->
                    <button type="button" onclick="adminToggleAllExplanations()" id="admin-btn-toggle-all-exp" class="btn btn-sm btn-outline-info font-weight-bold d-flex align-items-center" style="border-radius: 10px; font-size: 11px;">
                        <i class="fas fa-lightbulb text-warning mr-1"></i>
                        <span id="admin-text-toggle-all-exp">সকল ব্যাখ্যা খুলুন</span>
                    </button>

                    <!-- 2-Col vs 1-Col Layout Switcher -->
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" onclick="adminSetQuestionLayout('2-col')" id="admin-btn-layout-2col" class="btn btn-light border font-weight-bold active" title="২-কলাম গ্রিড ভিউ" style="border-radius: 8px 0 0 8px;">
                            <i class="fas fa-th-large mr-1"></i> ২-কলাম
                        </button>
                        <button type="button" onclick="adminSetQuestionLayout('1-col')" id="admin-btn-layout-1col" class="btn btn-light border font-weight-bold" title="১-কলাম তালিকা ভিউ" style="border-radius: 0 8px 8px 0;">
                            <i class="fas fa-bars mr-1"></i> ১-কলাম
                        </button>
                    </div>
                </div>
            </div>

            <!-- Questions Grid Container (2-Column on Desktop) -->
            <div class="row" id="admin-questions-container">
                @forelse($questions as $index => $q)
                    @php
                        $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
                        $selectedIds = $ans ? $ans->selected_option_ids_array : [];
                        $qType = $q->question_type;
                        $isPending = $ans && $ans->grading_status === 'pending_review';
                        $isAnswered = !empty($selectedIds) || ($ans && (!empty($ans->text_answer) || !empty($ans->cq_answers)));
                        $isCorrect = $ans ? (bool)$ans->is_correct : false;

                        $filterType = 'unanswered';
                        if ($isAnswered) {
                            $filterType = $isPending ? 'pending' : ($isCorrect ? 'correct' : 'wrong');
                        }

                        // User directive: "correct ans hoile green color , wrong ans korle red color, r kno ans na korle yello color hbe"
                        if ($isPending) {
                            $cardBorder = 'border: 2px solid #f59e0b !important;';
                            $accentBar = 'border-left: 3px solid #f59e0b !important;';
                            $pillBadge = '<span class="badge px-2.5 py-1 font-weight-bold" style="border: 1.5px solid #f59e0b; color: #b45309; background-color: #fffbeb; border-radius: 9999px; font-size: 11px;"><i class="fas fa-clock mr-1"></i> পর্যালোচনাধীন</span>';
                        } elseif ($isAnswered && $isCorrect) {
                            $cardBorder = 'border: 2px solid #22c55e !important;';
                            $accentBar = 'border-left: 3px solid #16a34a !important;';
                            $pillBadge = '<span class="badge px-2.5 py-1 font-weight-bold" style="border: 1.5px solid #16a34a; color: #16a34a; background-color: #f0fdf4; border-radius: 9999px; font-size: 11px;"><i class="fas fa-check mr-1"></i> সঠিক উত্তর (+'.(float)$q->marks.')</span>';
                        } elseif ($isAnswered && !$isCorrect) {
                            $neg = (float)($q->negative_marks ?: (($quiz && $quiz->negative_marks) ? $quiz->negative_marks : 0.0));
                            $cardBorder = 'border: 2px solid #ef4444 !important;';
                            $accentBar = 'border-left: 3px solid #dc2626 !important;';
                            $pillBadge = '<span class="badge px-2.5 py-1 font-weight-bold" style="border: 1.5px solid #dc2626; color: #dc2626; background-color: #fef2f2; border-radius: 9999px; font-size: 11px;"><i class="fas fa-times mr-1"></i> ভুল উত্তর' . ($neg > 0 ? " (-{$neg})" : ' (০)') . '</span>';
                        } else {
                            $cardBorder = 'border: 2px solid #f59e0b !important;';
                            $accentBar = 'border-left: 3px solid #f59e0b !important;';
                            $pillBadge = '<span class="badge px-2.5 py-1 font-weight-bold" style="border: 1.5px solid #f59e0b; color: #b45309; background-color: #fffbeb; border-radius: 9999px; font-size: 11px;"><i class="far fa-circle mr-1"></i> উত্তর দেওয়া হয়নি</span>';
                        }
                    @endphp

                    <div class="col-12 col-lg-6 mb-3 admin-question-col admin-q-card" data-filter-type="{{ $filterType }}" id="admin-q-{{ $q->id }}">
                        <div class="card rounded-2xl h-100 mb-0 shadow-none d-flex flex-column" style="border-radius: 12px !important; {{ $cardBorder }} background-color: #ffffff;">
                            <div class="card-body p-3 p-sm-3.5 d-flex flex-column h-100">
                                
                                <!-- Header Badge & Type Tag -->
                                <div class="d-flex align-items-center justify-content-between pb-2 mb-2.5 border-bottom" style="border-color: #f1f5f9 !important;">
                                    <div class="d-flex align-items-center" style="gap: 8px;">
                                        <span style="{{ $accentBar }} padding-left: 8px; color: #334155; font-size: 13px; font-weight: 700;">
                                            প্রশ্ন {{ $toBng($index + 1) }}
                                        </span>
                                        <span class="badge badge-light border text-uppercase font-mono text-muted" style="font-size: 10px;">{{ $qType }}</span>
                                    </div>
                                    <div>
                                        {!! $pillBadge !!}
                                    </div>
                                </div>

                                <!-- Question Title -->
                                <div class="font-weight-bold mb-3 admin-q-title-text" style="color: #0f172a !important; font-size: 1.02rem; line-height: 1.55;">
                                    {{ $q->question_text }}
                                </div>

                                <!-- Stimulus Context (if present) -->
                                @if(!empty($q->stimulus))
                                    <div class="p-2.5 rounded mb-2.5 text-xs text-dark" style="background-color: #f8fafc; border-left: 4px solid #10b981; line-height: 1.6;">
                                        <div class="font-weight-bold text-success text-uppercase mb-0.5" style="font-size: 10px;">নিচের উদ্দীপকটি পড়ুন :</div>
                                        {!! nl2br(e($q->stimulus)) !!}
                                    </div>
                                @endif

                                <!-- TYPE 1: MCQ Options (Matching Screenshot 2x2 Grid) -->
                                @if($q->options && $q->options->count() > 0)
                                    <div class="row mb-3">
                                        @foreach($q->options as $optIdx => $opt)
                                            @php
                                                $isStudentChoice = in_array($opt->id, $selectedIds);
                                                $isCorrectOption = (bool)$opt->is_correct;
                                                $optLetter = chr(65 + $optIdx);

                                                $boxStyle = 'background-color: #ffffff !important; border: 1.5px solid #cbd5e1 !important; color: #0f172a !important; border-radius: 8px;';
                                                $optIcon = '<i class="far fa-circle mr-1.5 text-muted"></i>';
                                                $badgeHtml = '';

                                                if ($isCorrectOption) {
                                                    $boxStyle = 'background-color: #f0fdf4 !important; border: 2px solid #16a34a !important; color: #0f172a !important; font-weight: 700; border-radius: 8px;';
                                                    $optIcon = '<i class="fas fa-check-circle mr-1.5" style="color: #16a34a !important;"></i>';
                                                    $badgeHtml = '<span class="badge text-white font-weight-bold shadow-sm" style="background-color: #16a34a !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fas fa-check mr-1"></i> সঠিক</span>';
                                                    if ($isStudentChoice) {
                                                        $badgeHtml = '<span class="badge text-white font-weight-bold shadow-sm mr-1" style="background-color: #15803d !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fas fa-user mr-1"></i> পছন্দ</span>' . $badgeHtml;
                                                    }
                                                } elseif ($isStudentChoice && !$isCorrectOption) {
                                                    $boxStyle = 'background-color: #fef2f2 !important; border: 2px solid #dc2626 !important; color: #0f172a !important; font-weight: 700; border-radius: 8px;';
                                                    $optIcon = '<i class="fas fa-times-circle mr-1.5" style="color: #dc2626 !important;"></i>';
                                                    $badgeHtml = '<span class="badge text-white font-weight-bold shadow-sm" style="background-color: #dc2626 !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fas fa-times mr-1"></i> ভুল উত্তর</span>';
                                                }
                                            @endphp

                                            <div class="col-12 col-sm-6 mb-2.5">
                                                <div class="p-2 rounded d-flex align-items-center justify-content-between text-sm h-100" style="{{ $boxStyle }}">
                                                    <div class="d-flex align-items-center min-w-0" style="gap: 6px;">
                                                        <span class="font-weight-bold text-dark shrink-0" style="color: #0f172a !important;">{{ $optLetter }}.</span>
                                                        <span class="font-weight-bold text-dark text-break" style="color: #0f172a !important;">
                                                            {!! $optIcon !!} {{ $opt->option_text }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex align-items-center flex-shrink-0 ml-1" style="gap: 4px;">
                                                        {!! $badgeHtml !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($qType === 'true_false')
                                    <!-- TYPE 2: True / False Review -->
                                    <div class="p-2.5 rounded border mb-3 text-xs" style="border-color: #e2e8f0; background-color: #f8fafc; border-radius: 8px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="text-muted d-block" style="font-size: 10px;">শিক্ষার্থীর প্রদত্ত উত্তর:</span>
                                                <strong class="{{ $isCorrect ? 'text-success' : 'text-danger' }}" style="font-size: 13px;">{{ $ans ? ($ans->text_answer ?: 'উত্তর দেওয়া হয়নি') : 'উত্তর দেওয়া হয়নি' }}</strong>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-muted d-block" style="font-size: 10px;">বোর্ড সঠিক উত্তর:</span>
                                                <strong class="text-success" style="font-size: 13px;"><i class="fas fa-check mr-0.5"></i> {{ $q->correct_answer_text ?: 'সত্য' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @elseif(in_array($qType, ['fill_blanks', 'fill_in_the_blanks']))
                                    <!-- TYPE 3: Fill in Blanks Review -->
                                    <div class="p-2.5 rounded border mb-3 text-xs" style="border-color: #e2e8f0; background-color: #f8fafc; border-radius: 8px;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="text-muted d-block" style="font-size: 10px;">শিক্ষার্থীর লিখিত উত্তর:</span>
                                                <strong class="{{ $isCorrect ? 'text-success' : 'text-danger' }}" style="font-size: 13px;">{{ $ans && $ans->text_answer ? $ans->text_answer : 'ফাঁকা রাখা হয়েছিল' }}</strong>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-muted d-block" style="font-size: 10px;">প্রত্যাশিত শব্দ / ক্লু:</span>
                                                <strong class="text-success" style="font-size: 13px;"><i class="fas fa-check mr-0.5"></i> {{ $q->correct_answer_text }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($ans && (!empty($ans->text_answer) || !empty($ans->cq_answers)))
                                    <!-- TYPE 4: Subjective / CQ -->
                                    <div class="p-2.5 rounded border mb-3 text-xs" style="border-color: #e2e8f0; background-color: #f8fafc; border-radius: 8px;">
                                        <div class="font-weight-bold text-dark mb-1">শিক্ষার্থীর লিখিত উত্তর:</div>
                                        <div class="p-2 bg-white rounded border text-dark font-weight-bold">{{ $ans->text_answer ?: json_encode($ans->cq_answers, JSON_UNESCAPED_UNICODE) }}</div>
                                    </div>
                                @endif

                                <!-- Explanation Box (Matching Screenshot Blue Box) -->
                                @if($q->hasEducationalExplanation() || $q->explanation)
                                    <div class="p-3 rounded mt-auto text-sm shadow-none" style="background-color: #f8fafc !important; border: 2px solid #0284c7 !important; border-radius: 8px;">
                                        <div class="font-weight-bold mb-1.5" style="color: #0369a1 !important; font-size: 0.95rem;">
                                            💡 মূল কনসেপ্ট ও সঠিক উত্তরের যুক্তি:
                                        </div>
                                        <div class="font-weight-medium mb-1.5" style="color: #0f172a !important; line-height: 1.6; font-size: 0.92rem;">
                                            {{ $q->getEffectiveConceptExplanation() ?: $q->explanation }}
                                        </div>
                                        @if($q->getEffectiveMemoryAid())
                                            <div class="mt-2 pt-2 border-top font-weight-semibold" style="border-color: #e2e8f0 !important; color: #334155 !important;">
                                                <i class="fas fa-key text-info mr-1"></i> <strong>মনে রাখার শর্টকাট:</strong> {{ $q->getEffectiveMemoryAid() }}
                                            </div>
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <p>এই পরীক্ষায় কোনো প্রশ্ন বা স্ন্যাপশট পাওয়া যায়নি।</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Hidden Form for Single Attempt Reset Violations -->
    <form id="singleResetForm" action="" method="POST" style="display: none;">
        @csrf
    </form>
@endsection

@section('script')
<script>
    function confirmResetThisAttemptViolations(attemptId) {
        if (confirm('আপনি কি নিশ্চিত যে এই পরীক্ষার সকল নিরাপত্তা লঙ্ঘন (Audit Log) স্থায়ীভাবে মুছে ফেলতে চান? এটি আর ফিরিয়ে আনা যাবে না।')) {
            var form = document.getElementById('singleResetForm');
            form.action = '{{ url("admin/quizzes/reports/attempt") }}/' + attemptId + '/reset-violations';
            form.submit();
        }
    }

    (function() {
        var container = document.getElementById('violations-scroll-container');
        if (!container) return;

        var listEl = document.getElementById('violations-items-list');
        var loadingIndicator = document.getElementById('violations-loading-indicator');
        var endIndicator = document.getElementById('violations-end-indicator');
        var counterEl = document.getElementById('current-loaded-count');

        var isLoading = false;
        var currentPage = 1;
        var hasMore = {{ ($hasMoreViolations ?? false) ? 'true' : 'false' }};
        var totalCount = {{ $totalViolations ?? 0 }};
        var loadedCount = {{ count($initialViolations ?? []) }};
        var violationsDataUrl = '{{ route("admin.quizzes.attempt.violations-data", $attempt->id) }}';

        function getViolationIcon(type) {
            type = (type || '').toLowerCase();
            if (type.indexOf('tab') !== -1 || type.indexOf('blur') !== -1) return 'fa-window-restore';
            if (type.indexOf('click') !== -1) return 'fa-mouse-pointer';
            if (type.indexOf('copy') !== -1 || type.indexOf('cut') !== -1 || type.indexOf('paste') !== -1) return 'fa-copy';
            if (type.indexOf('shortcut') !== -1 || type.indexOf('key') !== -1) return 'fa-keyboard';
            if (type.indexOf('dev') !== -1) return 'fa-code';
            return 'fa-exclamation-triangle';
        }

        function renderItems(items) {
            items.forEach(function(item) {
                var warnCount = item.warning_count || item.serial;
                var badgeClass = warnCount >= 3 ? 'badge-danger' : (warnCount === 2 ? 'badge-warning' : 'badge-info');
                var circleClass = warnCount >= 3 ? 'bg-danger text-white' : (warnCount === 2 ? 'bg-warning text-dark' : 'bg-info text-white');
                var badgeStyle = warnCount >= 3 ? 'color: #000000 !important; font-weight: 800;' : '';
                var iconClass = getViolationIcon(item.type);

                var div = document.createElement('div');
                div.className = 'violation-item p-2 mb-1.5 rounded border bg-white d-flex align-items-center justify-content-between';
                div.style.borderColor = '#e2e8f0';
                div.style.fontSize = '0.82rem';
                div.style.transition = 'background-color 0.2s';

                div.innerHTML = 
                    '<div class="d-flex align-items-center" style="gap: 10px; min-width: 0;">' +
                        '<div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 ' + circleClass + '" style="width: 28px; height: 28px; font-size: 0.75rem;">' +
                            '<i class="fas ' + iconClass + '"></i>' +
                        '</div>' +
                        '<div style="min-width: 0;">' +
                            '<div class="d-flex align-items-center flex-wrap" style="gap: 5px;">' +
                                '<span class="badge ' + badgeClass + ' px-1.5 py-0.5" style="font-size: 0.72rem; ' + badgeStyle + '">' +
                                    '#' + item.serial + ' সতর্কতা ' + warnCount +
                                '</span>' +
                                '<strong class="text-dark font-weight-bold text-truncate" style="color: #0f172a !important;">' + (item.title || 'নিরাপত্তা লঙ্ঘন') + '</strong>' +
                            '</div>' +
                            '<div class="text-muted text-truncate" style="font-size: 0.75rem; color: #475569 !important; margin-top: 1px;">' +
                                (item.details || '—') +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="text-right flex-shrink-0 ml-2 font-mono" style="font-size: 0.75rem; white-space: nowrap;">' +
                        '<div class="text-dark font-weight-semibold" style="color: #0f172a !important;">' +
                            '<i class="fas fa-network-wired text-muted mr-1" style="font-size: 0.7rem;"></i>' + (item.ip_address || '—') +
                        '</div>' +
                        '<div class="text-muted" style="font-size: 0.7rem;">' +
                            '<i class="far fa-clock text-muted mr-1"></i>' + (item.timestamp || '—') +
                        '</div>' +
                    '</div>';

                listEl.appendChild(div);
                loadedCount++;
            });

            if (counterEl) {
                counterEl.innerText = Math.min(loadedCount, totalCount);
            }
        }

        container.addEventListener('scroll', function() {
            if (isLoading || !hasMore) return;
            if (container.scrollTop + container.clientHeight >= container.scrollHeight - 35) {
                loadNextBatch();
            }
        });

        function loadNextBatch() {
            if (isLoading || !hasMore) return;
            isLoading = true;
            if (loadingIndicator) loadingIndicator.classList.remove('d-none');

            var nextPage = currentPage + 1;
            var fetchUrl = violationsDataUrl + '?page=' + nextPage;

            fetch(fetchUrl, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.status === 'success' && res.data && res.data.length > 0) {
                    currentPage = res.current_page;
                    hasMore = res.has_more;
                    renderItems(res.data);
                } else {
                    hasMore = false;
                }
            })
            .catch(function(err) {
                console.error('Error loading violations feed:', err);
                hasMore = false;
            })
            .finally(function() {
                isLoading = false;
                if (loadingIndicator) loadingIndicator.classList.add('d-none');
                if (!hasMore && endIndicator) {
                    endIndicator.classList.remove('d-none');
                }
            });
        }
    })();

    // ==========================================
    // Admin Question Filtering & View Functions
    // ==========================================
    var adminActiveFilter = 'all';

    function adminFilterQuestions(type) {
        adminActiveFilter = type;
        var btnAll = document.getElementById('admin-btn-filter-all');
        var btnWrong = document.getElementById('admin-btn-filter-wrong');
        var btnCorrect = document.getElementById('admin-btn-filter-correct');
        var btnUnans = document.getElementById('admin-btn-filter-unanswered');

        // Reset button classes
        if (btnAll) btnAll.className = 'btn btn-sm btn-outline-primary font-weight-bold d-flex align-items-center';
        if (btnWrong) btnWrong.className = 'btn btn-sm btn-outline-danger font-weight-bold d-flex align-items-center';
        if (btnCorrect) btnCorrect.className = 'btn btn-sm btn-outline-success font-weight-bold d-flex align-items-center';
        if (btnUnans) btnUnans.className = 'btn btn-sm btn-outline-secondary font-weight-bold d-flex align-items-center';

        // Set active class
        if (type === 'all' && btnAll) btnAll.className = 'btn btn-sm btn-primary font-weight-bold shadow-sm d-flex align-items-center';
        else if (type === 'wrong' && btnWrong) btnWrong.className = 'btn btn-sm btn-danger font-weight-bold shadow-sm d-flex align-items-center';
        else if (type === 'correct' && btnCorrect) btnCorrect.className = 'btn btn-sm btn-success font-weight-bold shadow-sm d-flex align-items-center';
        else if (type === 'unanswered' && btnUnans) btnUnans.className = 'btn btn-sm btn-secondary font-weight-bold shadow-sm d-flex align-items-center';

        applyAdminQuestionFilters();
    }

    function adminSearchQuestions(term) {
        applyAdminQuestionFilters();
    }

    function applyAdminQuestionFilters() {
        var searchInput = document.getElementById('admin-question-search');
        var searchTerm = (searchInput ? searchInput.value : '').toLowerCase().trim();
        var cards = document.querySelectorAll('.admin-q-card');

        cards.forEach(function(card) {
            var cardType = card.getAttribute('data-filter-type');
            var matchesType = (adminActiveFilter === 'all' || cardType === adminActiveFilter);
            var matchesSearch = true;
            if (searchTerm !== '') {
                var cardText = (card.innerText || '').toLowerCase();
                matchesSearch = cardText.indexOf(searchTerm) !== -1;
            }

            if (matchesType && matchesSearch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function adminToggleSingleExp(qId) {
        var content = document.getElementById('admin-exp-content-' + qId);
        var icon = document.getElementById('admin-exp-icon-' + qId);
        if (!content) return;
        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            if (icon) icon.className = 'fas fa-chevron-up text-muted';
        } else {
            content.style.display = 'none';
            if (icon) icon.className = 'fas fa-chevron-down text-muted';
        }
    }

    var adminAllExpOpen = false;
    function adminToggleAllExplanations() {
        adminAllExpOpen = !adminAllExpOpen;
        var contents = document.querySelectorAll('.admin-exp-content');
        var icons = document.querySelectorAll('[id^="admin-exp-icon-"]');
        var textEl = document.getElementById('admin-text-toggle-all-exp');

        contents.forEach(function(el) {
            el.style.display = adminAllExpOpen ? 'block' : 'none';
        });
        icons.forEach(function(ic) {
            ic.className = adminAllExpOpen ? 'fas fa-chevron-up text-muted' : 'fas fa-chevron-down text-muted';
        });
        if (textEl) {
            textEl.innerText = adminAllExpOpen ? 'সকল ব্যাখ্যা লুকান' : 'সকল ব্যাখ্যা খুলুন';
        }
    }

    function adminSetQuestionLayout(layout) {
        var cols = document.querySelectorAll('.admin-question-col');
        var btn2Col = document.getElementById('admin-btn-layout-2col');
        var btn1Col = document.getElementById('admin-btn-layout-1col');

        if (layout === '2-col') {
            cols.forEach(function(col) {
                col.classList.remove('col-12');
                col.classList.add('col-12', 'col-lg-6');
            });
            if (btn2Col) btn2Col.classList.add('active');
            if (btn1Col) btn1Col.classList.remove('active');
        } else {
            cols.forEach(function(col) {
                col.classList.remove('col-lg-6');
                col.classList.add('col-12');
            });
            if (btn1Col) btn1Col.classList.add('active');
            if (btn2Col) btn2Col.classList.remove('active');
        }
    }
</script>
@endsection
