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

    $assignedSet = $attempt->question_set ?: ($quiz->question_set ?: 'Set A');
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
                            <span class="font-weight-bold text-dark ml-1">{{ $quiz->title }}</span>
                        </div>
                        <div class="col-sm-6 mb-1">
                            <span class="text-muted">কোর্স / বিষয়:</span>
                            <span class="font-weight-bold text-primary ml-1">{{ $quiz->course ? $quiz->course->course_title : 'General' }}</span>
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

    <!-- Questions & Student Answers Sheet -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="card-title font-weight-bold text-dark mb-0">
                <i class="fas fa-tasks text-primary mr-2"></i> প্রশ্নপত্র ও শিক্ষার্থীর উত্তরপত্র বিশদ মূল্যায়ন (Answer Sheet)
            </h5>
            <span class="badge badge-light border text-xs">মোট প্রশ্ন: {{ $totalQ }}টি</span>
        </div>
        <div class="card-body p-4">
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
                        $neg = (float)($q->negative_marks ?: ($quiz->negative_marks ?: 0.0));
                        $statusBadge = 'badge-danger';
                        $statusText = 'ভুল উত্তর' . ($neg > 0 ? " (-{$neg})" : '');
                    }
                @endphp

                <div class="card border mb-3 shadow-none {{ $ans && $ans->is_correct ? 'border-success' : ($ans && $ans->is_correct === false ? 'border-danger' : 'border-secondary') }}">
                    <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <span class="badge badge-dark mr-1">প্রশ্ন {{ $index + 1 }}</span>
                            <span class="badge badge-light border text-xs text-uppercase">{{ $qType }}</span>
                        </div>
                        <div>
                            <span class="badge {{ $statusBadge }} px-2 py-1 text-xs font-weight-bold">{{ $statusText }}</span>
                        </div>
                    </div>
                    <div class="card-body p-3">
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

                                        $optClass = 'border-light bg-light text-dark';
                                        $optIcon = '<i class="far fa-circle text-muted mr-1"></i>';

                                        if ($isCorrectOption && $isStudentChoice) {
                                            $optClass = 'border-success bg-success text-white font-weight-bold';
                                            $optIcon = '<i class="fas fa-check-circle mr-1"></i>';
                                        } elseif ($isCorrectOption) {
                                            $optClass = 'border-success bg-light text-success font-weight-bold';
                                            $optIcon = '<i class="fas fa-check mr-1 text-success"></i>';
                                        } elseif ($isStudentChoice) {
                                            $optClass = 'border-danger bg-danger text-white font-weight-bold';
                                            $optIcon = '<i class="fas fa-times-circle mr-1"></i>';
                                        }
                                    @endphp
                                    <div class="col-md-6 mb-2">
                                        <div class="p-2.5 rounded border {{ $optClass }} d-flex align-items-center text-sm">
                                            <span class="mr-2 font-weight-bold">{{ chr(65 + $optIdx) }}.</span>
                                            <span class="flex-grow-1">{!! $optIcon !!} {{ $opt->option_text }}</span>
                                            @if($isStudentChoice)
                                                <span class="badge badge-light text-dark text-xs ml-1 font-weight-bold">শিক্ষার্থীর পছন্দ</span>
                                            @endif
                                            @if($isCorrectOption)
                                                <span class="badge badge-success text-xs ml-1 font-weight-bold">সঠিক উত্তর</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @elseif($qType === 'true_false')
                            <div class="p-2.5 bg-light rounded border text-sm mb-2">
                                <div><strong>শিক্ষার্থীর প্রদত্ত উত্তর:</strong> <span class="font-weight-bold {{ $ans && $ans->is_correct ? 'text-success' : 'text-danger' }}">{{ $ans ? ($ans->text_answer ?: 'কোনো উত্তর দেওয়া হয়নি') : 'কোনো উত্তর দেওয়া হয়নি' }}</span></div>
                                <div class="mt-1"><strong>প্রত্যাশিত সঠিক উত্তর:</strong> <span class="font-weight-bold text-success">{{ $q->correct_answer_text ?: ($q->getFormattedCorrectAnswer() ?: 'N/A') }}</span></div>
                            </div>
                        @elseif($qType === 'fill_blanks')
                            <div class="p-2.5 bg-light rounded border text-sm mb-2">
                                <div><strong>শিক্ষার্থীর লিখিত উত্তর:</strong> <span class="font-weight-bold {{ $ans && $ans->is_correct ? 'text-success' : 'text-danger' }}">{{ $ans && $ans->text_answer ? $ans->text_answer : 'ফাঁকা রাখা হয়েছিল' }}</span></div>
                                <div class="mt-1"><strong>প্রত্যাশিত শব্দ / ক্লু:</strong> <span class="font-weight-bold text-success">{{ $q->correct_answer_text }}</span></div>
                            </div>
                        @elseif($ans && (!empty($ans->text_answer) || !empty($ans->cq_answers)))
                            <div class="p-2.5 bg-light rounded border text-sm mb-2">
                                <div><strong>শিক্ষার্থীর লিখিত উত্তর:</strong></div>
                                <div class="p-2 bg-white rounded border mt-1 text-dark">{{ $ans->text_answer ?: json_encode($ans->cq_answers, JSON_UNESCAPED_UNICODE) }}</div>
                            </div>
                        @endif

                        <!-- Explanation / Conceptual Logic -->
                        @if($q->hasEducationalExplanation())
                            <div class="p-3 bg-light border border-info rounded mt-2 text-xs">
                                <div class="font-weight-bold text-primary mb-1">
                                    <i class="fas fa-graduation-cap mr-1"></i> মূল কনসেপ্ট ও সঠিক উত্তরের যুক্তি:
                                </div>
                                <div class="text-dark mb-1">
                                    {{ $q->getEffectiveConceptExplanation() ?: $q->explanation }}
                                </div>
                                @if($q->getEffectiveMemoryAid())
                                    <div class="text-muted mt-1">
                                        <i class="fas fa-lightbulb text-warning mr-1"></i> <strong>মনে রাখার শর্টকাট:</strong> {{ $q->getEffectiveMemoryAid() }}
                                    </div>
                                @endif
                            </div>
                        @elseif($q->explanation)
                            <div class="p-2.5 bg-light border rounded mt-2 text-xs text-muted">
                                <strong>ব্যাখ্যা:</strong> {{ $q->explanation }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <p>এই পরীক্ষায় কোনো প্রশ্ন বা স্ন্যাপশট পাওয়া যায়নি।</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
