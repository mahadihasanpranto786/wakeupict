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
                            <span class="text-muted">জমার সময়:</span>
                            <span class="text-dark ml-1">{{ $attempt->submitted_at ? $attempt->submitted_at->format('d M, Y h:i A') : $attempt->updated_at->format('d M, Y') }}</span>
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
    <!-- Questions & Student Answers Sheet -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title font-weight-bold text-dark mb-0">
                <i class="fas fa-tasks text-primary mr-2"></i> প্রশ্নপত্র ও শিক্ষার্থীর উত্তরপত্র বিশদ মূল্যায়ন (Answer Sheet)
            </h5>
            <span class="badge badge-light border text-xs">মোট প্রশ্ন: {{ $totalQ }}টি</span>
        </div>
        <div class="card-body p-4">
            <div class="row">
                @forelse($questions as $index => $q)
                    @php
                        $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
                        $selectedIds = $ans ? $ans->selected_option_ids_array : [];
                        $qType = $q->question_type;

                        $statusBadge = 'badge-secondary';
                        $statusText = 'অনুত্তর (Not Answered)';
                        if ($ans && $ans->grading_status === 'pending_review') {
                            $statusBadge = 'badge-warning';
                            $statusText = 'মূল্যায়নাধীন (Pending Review)';
                        } elseif ($ans && $ans->is_correct === true) {
                            $statusBadge = 'badge-success';
                            $statusText = 'সঠিক উত্তর (+'.(float)$q->marks.')';
                        } elseif ($ans && $ans->is_correct === false) {
                            $neg = (float)($q->negative_marks ?: (($quiz && $quiz->negative_marks) ? $quiz->negative_marks : 0.0));
                            $statusBadge = 'badge-danger';
                            $statusText = 'ভুল উত্তর' . ($neg > 0 ? " (-{$neg})" : '');
                        }
                    @endphp

                    <div class="col-12 col-lg-6 d-flex flex-column mb-3">
                        <div class="card border shadow-none flex-fill h-100 mb-0 {{ $ans && $ans->is_correct ? 'border-success' : ($ans && $ans->is_correct === false ? 'border-danger' : 'border-secondary') }}">
                            <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center flex-wrap">
                                <div>
                                    <span class="badge badge-dark mr-1">প্রশ্ন {{ $index + 1 }}</span>
                                    <span class="badge badge-light border text-xs text-uppercase">{{ $qType }}</span>
                                </div>
                                <div>
                                    <span class="badge {{ $statusBadge }} px-2 py-1 text-xs font-weight-bold">{{ $statusText }}</span>
                                </div>
                            </div>
                            <div class="card-body p-3 d-flex flex-column">
                                <!-- Question Text -->
                                <div class="font-weight-bold text-dark mb-3" style="font-size: 1.05rem;">
                                    {{ $q->question_text }}
                                </div>

                                <!-- MCQ Options -->
                                @if($q->options && $q->options->count() > 0)
                                    <div class="row">
                                        @foreach($q->options as $optIdx => $opt)
                                            @php
                                                $isStudentChoice = in_array($opt->id, $selectedIds);
                                                $isCorrectOption = (bool)$opt->is_correct;

                                                // High-contrast, crystal clear styling guaranteed for light and dark surfaces
                                                $boxStyle = 'background-color: #ffffff !important; border: 1.5px solid #cbd5e1 !important; color: #0f172a !important;';
                                                $optIcon = '<i class="far fa-circle mr-1.5 text-muted"></i>';

                                                if ($isCorrectOption && $isStudentChoice) {
                                                    $boxStyle = 'background-color: #ecfdf5 !important; border: 2px solid #F26522 !important; color: #0f172a !important; font-weight: 700;';
                                                    $optIcon = '<i class="fas fa-check-circle mr-1.5 text-success font-weight-bold" style="color: #F26522 !important;"></i>';
                                                } elseif ($isCorrectOption) {
                                                    $boxStyle = 'background-color: #f0fdf4 !important; border: 2px solid #F26522 !important; color: #0f172a !important; font-weight: 700;';
                                                    $optIcon = '<i class="fas fa-check-circle mr-1.5 text-success font-weight-bold" style="color: #F26522 !important;"></i>';
                                                } elseif ($isStudentChoice) {
                                                    $boxStyle = 'background-color: #fef2f2 !important; border: 2px solid #dc2626 !important; color: #0f172a !important; font-weight: 700;';
                                                    $optIcon = '<i class="fas fa-times-circle mr-1.5 text-danger font-weight-bold" style="color: #dc2626 !important;"></i>';
                                                }
                                            @endphp
                                            <div class="col-12 col-sm-6 mb-2.5">
                                                <div class="p-2 rounded shadow-sm d-flex align-items-center text-sm h-100" style="{{ $boxStyle }}">
                                                    <span class="mr-2 font-weight-bold text-dark" style="color: #0f172a !important;">{{ chr(65 + $optIdx) }}.</span>
                                                    <span class="flex-grow-1 font-weight-bold text-dark" style="color: #0f172a !important;">{!! $optIcon !!} {{ $opt->option_text }}</span>
                                                    @if($isStudentChoice)
                                                        <span class="badge text-white text-xs ml-1 font-weight-bold shadow-sm" style="background-color: {{ $isCorrectOption ? '#F26522' : '#dc2626' }} !important; padding: 3px 6px;">
                                                            <i class="fas fa-user-check mr-1"></i> পছন্দ
                                                        </span>
                                                    @endif
                                                    @if($isCorrectOption)
                                                        <span class="badge text-white text-xs ml-1 font-weight-bold shadow-sm" style="background-color: #F26522 !important; padding: 3px 6px;">
                                                            <i class="fas fa-check mr-1"></i> সঠিক
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @elseif($qType === 'true_false')
                                    <div class="p-3 bg-white rounded border-2 text-sm mb-2 shadow-sm" style="border-color: #cbd5e1 !important; color: #0f172a !important;">
                                        <div class="mb-1.5"><strong class="text-dark" style="color: #0f172a !important;">শিক্ষার্থীর প্রদত্ত উত্তর:</strong> <span class="font-weight-bold {{ $ans && $ans->is_correct ? 'text-success' : 'text-danger' }}" style="font-size: 1rem;">{{ $ans ? ($ans->text_answer ?: 'কোনো উত্তর দেওয়া হয়নি') : 'কোনো উত্তর দেওয়া হয়নি' }}</span></div>
                                        <div><strong class="text-dark" style="color: #0f172a !important;">প্রত্যাশিত সঠিক উত্তর:</strong> <span class="font-weight-bold text-success" style="color: #F26522 !important; font-size: 1rem;"><i class="fas fa-check-circle mr-1"></i> {{ $q->correct_answer_text ?: ($q->getFormattedCorrectAnswer() ?: 'N/A') }}</span></div>
                                    </div>
                                @elseif($qType === 'fill_blanks')
                                    <div class="p-3 bg-white rounded border-2 text-sm mb-2 shadow-sm" style="border-color: #cbd5e1 !important; color: #0f172a !important;">
                                        <div class="mb-1.5"><strong class="text-dark" style="color: #0f172a !important;">শিক্ষার্থীর লিখিত উত্তর:</strong> <span class="font-weight-bold {{ $ans && $ans->is_correct ? 'text-success' : 'text-danger' }}" style="font-size: 1rem;">{{ $ans && $ans->text_answer ? $ans->text_answer : 'ফাঁকা রাখা হয়েছিল' }}</span></div>
                                        <div><strong class="text-dark" style="color: #0f172a !important;">প্রত্যাশিত শব্দ / ক্লু:</strong> <span class="font-weight-bold text-success" style="color: #F26522 !important; font-size: 1rem;"><i class="fas fa-check-circle mr-1"></i> {{ $q->correct_answer_text }}</span></div>
                                    </div>
                                @elseif($ans && (!empty($ans->text_answer) || !empty($ans->cq_answers)))
                                    <div class="p-3 bg-white rounded border-2 text-sm mb-2 shadow-sm" style="border-color: #cbd5e1 !important; color: #0f172a !important;">
                                        <div><strong class="text-dark" style="color: #0f172a !important;">শিক্ষার্থীর লিখিত উত্তর:</strong></div>
                                        <div class="p-2.5 bg-light rounded border mt-1.5 text-dark font-weight-bold" style="color: #0f172a !important;">{{ $ans->text_answer ?: json_encode($ans->cq_answers, JSON_UNESCAPED_UNICODE) }}</div>
                                    </div>
                                @endif

                                <!-- Explanation / Conceptual Logic (High-Contrast Guaranteed) -->
                                @if($q->hasEducationalExplanation())
                                    <div class="p-3 rounded mt-auto text-sm shadow-sm" style="background-color: #f8fafc !important; border: 2px solid #0284c7 !important;">
                                        <div class="font-weight-bold mb-1.5" style="color: #0369a1 !important; font-size: 0.95rem;">
                                            <i class="fas fa-lightbulb mr-1.5 text-warning"></i> মূল কনসেপ্ট ও সঠিক উত্তরের যুক্তি:
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
                                @elseif($q->explanation)
                                    <div class="p-3 rounded mt-auto text-sm shadow-sm" style="background-color: #f8fafc !important; border: 2px solid #0284c7 !important;">
                                        <strong style="color: #0369a1 !important;"><i class="fas fa-info-circle mr-1"></i> ব্যাখ্যা:</strong>
                                        <span class="font-weight-bold ml-1" style="color: #0f172a !important;">{{ $q->explanation }}</span>
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
</script>
@endsection
