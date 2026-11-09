@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'পরীক্ষার ফলাফল ও মূল্যায়ন বিবরণী: ' . ($quiz ? $quiz->title : 'Assessment') . ' — Wake Up ICT')
@section('page_title', 'পরীক্ষার ফলাফল বিবরণী')
@section('page_crumb', 'ফলাফল ও ওএমআর মূল্যায়ন')

@section('content')
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
    $grade = $attempt->getGrade();
    if (!$isPassed || $grade === 'F') {
        $grade = 'F';
        $gradeColor = 'text-rose-600 dark:text-rose-400';
        $gradeBg = 'bg-rose-500/10 border-rose-500/30 text-rose-600 dark:text-rose-400';
    } elseif ($grade === 'A+' || $grade === 'A') {
        $gradeColor = 'text-emerald-600 dark:text-emerald-400';
        $gradeBg = 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 dark:text-emerald-400';
    } elseif ($grade === 'A-') {
        $gradeColor = 'text-blue-600 dark:text-blue-400';
        $gradeBg = 'bg-blue-500/10 border-blue-500/30 text-blue-600 dark:text-blue-400';
    } else {
        $gradeColor = 'text-amber-600 dark:text-amber-400';
        $gradeBg = 'bg-amber-500/10 border-amber-500/30 text-amber-600 dark:text-amber-400';
    }

    $assignedSet = $attempt->question_set ?: (($quiz && $quiz->question_set) ? $quiz->question_set : 'Set A');
    $bngSet = \App\model\LmsQuiz::getBengaliSetCode($assignedSet);
    $subjectCode = ($quiz && $quiz->subject_code) ? $quiz->subject_code : '101';
    $codeDigits = str_split((string)$subjectCode);
@endphp

<div class="w-full space-y-6 pb-12 print:p-0 print:max-w-none print:space-y-3">

    <!-- Top Action & Navigation HUD (Hidden in Print) -->
    <div class="flex flex-wrap items-center justify-between gap-3 print:hidden">
        <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors shadow-sm">
            <i class="fa fa-arrow-left"></i>
            <span>সকল পরীক্ষার তালিকায় ফিরে যান</span>
        </a>

        <div class="flex items-center gap-2">
            <!-- All Results Archive Link -->
            <a href="{{ route('student.results.index') }}" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-600 transition-colors shadow-sm flex items-center gap-1.5">
                <i class="fa fa-history text-slate-400"></i>
                <span>ফলাফল আর্কাইভ</span>
            </a>

            <!-- Retake This Exam with exact submitted questions -->
            @if($quiz && method_exists($quiz, 'canAttempt') && $quiz->canAttempt($student->id))
                <form id="form-retake-exam" action="{{ route('student.quiz.retake', $attempt->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="button" onclick="confirmRetakeExam()" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-all shadow-md flex items-center gap-1.5 cursor-pointer" title="এই সেটের প্রশ্নগুলো নিয়ে পুনরায় পরীক্ষা দিন">
                        <i class="fa fa-repeat"></i>
                        <span>পুনরায় পরীক্ষা দিন (Retake)</span>
                    </button>
                </form>
            @endif

            @if(!empty($practiceProgress) || ($quiz && $quiz->quiz_type === 'practice'))
                <form id="form-fresh-practice-1" action="{{ route('student.practice.start') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="question_count" value="{{ min(20, $totalQ > 0 ? $totalQ : 20) }}">
                    <button type="button" onclick="confirmFreshPractice('form-fresh-practice-1')" class="px-4 py-2 rounded-xl btn-brand-primary font-bold text-xs transition-all shadow-md flex items-center gap-1.5 cursor-pointer">
                        <i class="fa fa-refresh"></i>
                        <span>পরবর্তী নতুন প্রশ্নে প্র্যাকটিস</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(!empty($practiceProgress))
    <!-- Question Bank Smart Rotation Progress Card (Hidden in Print) -->
    <div class="rounded-3xl bg-gradient-to-br from-blue-600 via-indigo-600 to-violet-700 text-white p-5 sm:p-6 shadow-xl relative overflow-hidden print:hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
            <div class="space-y-1.5 max-w-xl">
                <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-white/20 text-[11px] font-black uppercase tracking-wider">
                    <i class="fa fa-refresh"></i>
                    <span>স্মার্ট প্রশ্ন ব্যাংক প্র্যাকটিস অগ্রগতি</span>
                    <span class="bg-amber-400 text-slate-950 px-2 py-0.2 rounded-full font-black">Cycle #{{ $practiceProgress['current_cycle'] }}</span>
                </div>
                <h3 class="text-xl sm:text-2xl font-black">
                    প্রশ্ন ব্যাংক কভারেজ: {{ $practiceProgress['coverage_pct'] }}% সম্পন্ন
                </h3>
                <p class="text-blue-100 text-xs sm:text-sm">
                    মোট {{ number_format($practiceProgress['total_questions']) }}টি প্রশ্নের মধ্যে {{ number_format($practiceProgress['attempted_questions']) }}টি প্রশ্ন সমাধান করেছেন। বাকি রয়েছে {{ number_format($practiceProgress['remaining_questions']) }}টি আনসিন প্রশ্ন।
                </p>
            </div>

            <div class="flex items-center gap-3">
                <form id="form-fresh-practice-2" action="{{ route('student.practice.start') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_count" value="20">
                    <button type="button" onclick="confirmFreshPractice('form-fresh-practice-2')" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-400 hover:bg-amber-500 text-slate-950 font-black text-xs sm:text-sm shadow-lg transition-transform hover:scale-105 cursor-pointer">
                        <i class="fa fa-play-circle text-base"></i>
                        <span>পরবর্তী ২০টি ফ্রেশ প্রশ্ন দিন</span>
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </form>

                <a href="{{ route('student.practice.index') }}" class="inline-flex items-center gap-1.5 px-4 py-3 rounded-xl bg-white/15 hover:bg-white/25 text-white font-bold text-xs transition-colors">
                    <i class="fa fa-dashboard"></i>
                    <span>ড্যাশবোর্ড</span>
                </a>
            </div>
        </div>

        <div class="relative z-10 mt-4 pt-4 border-t border-white/20">
            <div class="w-full h-3 bg-black/25 rounded-full overflow-hidden p-0.5 border border-white/20">
                <div class="h-full bg-gradient-to-r from-[#F26522] via-[#FB923C] to-[#FED7AA] rounded-full transition-all duration-700 shadow-md"
                     style="width: {{ max(3, min(100, $practiceProgress['coverage_pct'])) }}%"></div>
            </div>
        </div>
    </div>
    @endif

    <!-- ========================================================================= -->
    <!-- OFFICIAL BANGLADESHI BOARD EXAMINATION RESULT & OMR EVALUATION TRANSCRIPT -->
    <!-- ========================================================================= -->
    <div class="board-paper-card rounded-3xl bg-white dark:bg-slate-900/95 border-2 border-slate-300 dark:border-slate-700/80 p-5 sm:p-8 shadow-xl relative overflow-hidden print:border print:p-4 print:shadow-none">
        
        <!-- Top Security & Serial Strip -->
        <div class="flex items-center justify-between text-[11px] font-mono text-slate-600 dark:text-slate-400 border-b border-slate-200 dark:border-slate-800 pb-2 mb-4">
            <span class="font-bold tracking-wider">শালিখ / WUICT • মূল্যায়ন কপি</span>
            <span class="font-bold text-xs">সিরিয়াল: ২৫৬/২০২৬</span>
            <span>নথি নং: ১২৯২/২০২৬</span>
        </div>

        <!-- Official Board Header -->
        <div class="text-center space-y-1.5 pb-4 border-b-2 border-slate-900 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">
                    {{ $quiz->board_name ?: 'ঢাকা মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড' }}
                </span>
                
                <!-- Official Subject Code & Set Box -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 text-xs font-mono">
                        <span class="text-[11px] text-slate-600 dark:text-slate-400 font-semibold">বিষয় কোড:</span>
                        <div class="inline-flex border border-slate-800 dark:border-slate-600 rounded overflow-hidden">
                            @foreach($codeDigits as $digit)
                                <span class="w-5 h-6 bg-slate-50 dark:bg-slate-800 flex items-center justify-center font-bold text-slate-900 dark:text-white border-r last:border-r-0 border-slate-800 dark:border-slate-600 text-xs">
                                    {{ $digit }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-1 text-xs font-mono">
                        <span class="text-[11px] text-slate-600 dark:text-slate-400 font-semibold">সেট:</span>
                        <span class="w-6 h-6 border-2 border-slate-900 dark:border-slate-400 rounded bg-slate-100 dark:bg-slate-800 font-black text-slate-950 dark:text-white flex items-center justify-center text-xs">
                            {{ $bngSet }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Central Bengali Title -->
            <h1 class="text-lg sm:text-2xl font-black text-slate-950 dark:text-white tracking-wide">
                বহুনির্বাচনি অভীক্ষার ফলাফল ও ওএমআর মূল্যায়ন বিবরণী
            </h1>
            <h2 class="text-sm sm:text-base font-bold text-slate-800 dark:text-slate-200">
                {{ $quiz->course ? $quiz->course->course_title : $quiz->title }}
            </h2>
            <p class="text-xs text-slate-600 dark:text-slate-400 font-serif">
                [জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB) মূল্যায়ন নীতিমালা অনুযায়ী প্রকাশিত]
            </p>
        </div>

        <!-- Student & Examination Meta Grid Table -->
        <div class="my-4 p-3.5 sm:p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-xs">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 font-serif text-slate-800 dark:text-slate-200">
                <div>
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">পরীক্ষার্থীর নাম :</span>
                    <strong class="text-slate-950 dark:text-white font-bold">{{ $student->name }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">রোল / শিক্ষার্থী কোড :</span>
                    <strong class="font-mono text-slate-950 dark:text-white font-bold">{{ $student->student_id_code }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">পরীক্ষার তারিখ (BD Time) :</span>
                    <strong class="font-mono">{{ $attempt->submitted_at ? $attempt->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $attempt->updated_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">ব্যয়িত সময় :</span>
                    <strong class="font-mono">{{ $attempt->formatted_time_spent }} মিনিট</strong>
                </div>
                <div class="col-span-2 sm:col-span-4 pt-2 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between text-xs font-bold text-slate-700 dark:text-slate-300">
                    <span>পূর্ণমান (Total Marks): <strong class="text-blue-600 dark:text-blue-400 font-mono">{{ $toBng($attemptTotalMarks) }}</strong> (প্রতি প্রশ্নে {{ $toBng($markPerQuestion) }} নম্বর)</span>
                    <span>পাস মার্ক (Pass Mark): <strong class="text-emerald-600 dark:text-emerald-400 font-mono">{{ $toBng($attemptPassMarks) }}</strong></span>
                </div>
            </div>
        </div>

        <!-- Official Marks & Result Summary Scoreboard -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2.5 my-4 font-mono text-center">
            
            <!-- 1. Total Questions -->
            <div class="p-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <span class="text-[10px] uppercase text-slate-500 dark:text-slate-400 block mb-0.5">মোট প্রশ্ন</span>
                <span class="text-base sm:text-lg font-black text-slate-900 dark:text-white">{{ $toBng($totalQ) }}</span>
                <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-semibold">পূর্ণমান: {{ $toBng($attemptTotalMarks) }}</span>
            </div>

            <!-- 2. Correct -->
            <div class="p-3 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-800/60 shadow-sm">
                <span class="text-[10px] uppercase text-emerald-700 dark:text-emerald-400 block mb-0.5 font-bold">সঠিক উত্তর</span>
                <span class="text-base sm:text-lg font-black text-emerald-600 dark:text-emerald-400">{{ $toBng($correctCount) }}</span>
                <span class="text-[10px] text-emerald-600/80 block">+{{ $toBng($correctCount) }} নম্বর</span>
            </div>

            <!-- 3. Incorrect -->
            <div class="p-3 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-300 dark:border-rose-800/60 shadow-sm">
                <span class="text-[10px] uppercase text-rose-700 dark:text-rose-400 block mb-0.5 font-bold">ভুল উত্তর</span>
                <span class="text-base sm:text-lg font-black text-rose-600 dark:text-rose-400">{{ $toBng($incorrectCount) }}</span>
                <span class="text-[10px] text-rose-600/80 block">
                    @if($attempt->negative_marks_deducted > 0)
                        -{{ $toBng(number_format($attempt->negative_marks_deducted, 2)) }} কাটা
                    @else
                        ০ কর্তন
                    @endif
                </span>
            </div>

            <!-- 4. Skipped -->
            <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 shadow-sm">
                <span class="text-[10px] uppercase text-slate-500 dark:text-slate-400 block mb-0.5">উত্তরহীন</span>
                <span class="text-base sm:text-lg font-black text-slate-700 dark:text-slate-300">{{ $toBng($unansweredCount) }}</span>
                <span class="text-[10px] text-slate-400 block">বাদ দেওয়া</span>
            </div>

            <!-- 5. Net Score -->
            <div class="p-3 rounded-2xl bg-slate-900 dark:bg-white text-white dark:text-slate-950 border border-slate-900 shadow-md">
                <span class="text-[10px] uppercase text-slate-300 dark:text-slate-600 block mb-0.5 font-bold">প্রাপ্ত নম্বর</span>
                <div class="text-base sm:text-lg font-black leading-tight">
                    {{ $toBng(number_format($attempt->score, 2)) }}
                </div>
                <span class="text-[10px] text-slate-300 dark:text-slate-600 block">হার: {{ $toBng($attempt->percentage) }}%</span>
            </div>

            <!-- 6. Grade & Status -->
            <div class="p-3 rounded-2xl {{ $isPassed ? 'bg-emerald-500/10 border border-emerald-500/30' : 'bg-rose-500/10 border border-rose-500/30' }} shadow-sm">
                <span class="text-[10px] uppercase {{ $isPassed ? 'text-emerald-700 dark:text-emerald-400' : 'text-rose-700 dark:text-rose-400' }} block mb-0.5 font-bold">গ্রেড ও ফলাফল</span>
                <div class="text-base sm:text-lg font-black {{ $isPassed ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                    {{ $grade }}
                </div>
                <span class="text-[10px] font-bold uppercase {{ $isPassed ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} block">
                    {{ $isPassed ? 'উত্তীর্ণ (Assessment Passed)' : 'অনুত্তীর্ণ (Assessment Not Passed)' }}
                </span>
                <span class="text-[10px] text-slate-500 dark:text-slate-400 block mt-0.5 font-medium">পাস মার্ক: {{ $toBng($attemptPassMarks) }}</span>
            </div>

        </div>

        <!-- ========================================================================= -->
        <!-- 1-GLANCE OMR MATRIX (১ নজরে ওএমআর উত্তরপত্র বিশ্লেষণ ম্যাট্রিক্স) -->
        <!-- Reduces scroll need by 80%: Instant visual summary + click-to-jump -->
        <!-- ========================================================================= -->
        <div class="my-5 p-4 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">
                        ১ নজরে ওএমআর উত্তরপত্র বিশ্লেষণ ম্যাট্রিক্স
                    </h3>
                    <span class="text-[11px] text-slate-500 dark:text-slate-400 hidden sm:inline font-mono">
                        (যেকোনো নম্বরে ক্লিক করে সরাসরি সেই প্রশ্নে চলে যান)
                    </span>
                </div>
                
                <!-- Quick Legend -->
                <div class="flex items-center gap-3 text-[11px] font-mono text-slate-600 dark:text-slate-400">
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 rounded-full bg-emerald-600 inline-block"></span> সঠিক
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 rounded-full bg-rose-600 inline-block"></span> ভুল
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span> উত্তর দেওয়া হয়নি
                    </span>
                </div>
            </div>

            <!-- Compact OMR Bubbles Grid -->
            <div class="grid grid-cols-5 sm:grid-cols-10 lg:grid-cols-12 gap-1.5 sm:gap-2 pt-3 font-mono text-xs">
                @foreach($questions as $idx => $q)
                    @php
                        $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
                        $selectedIds = $ans ? $ans->selected_option_ids_array : [];
                        $isCorrect = $ans ? $ans->is_correct : false;
                        $isAnswered = !empty($selectedIds);

                        // Find student option letter and correct option letter
                        $studentOptLetter = '-';
                        $correctOptLetter = '';
                        foreach($q->options as $oIdx => $opt) {
                            if ($opt->is_correct) {
                                $correctOptLetter = \App\model\LmsQuestion::getBengaliOptionLetter($oIdx);
                            }
                            if (in_array($opt->id, $selectedIds)) {
                                $studentOptLetter = \App\model\LmsQuestion::getBengaliOptionLetter($oIdx);
                            }
                        }

                        $matrixColor = 'bg-amber-300 dark:bg-amber-500/30 text-amber-950 dark:text-amber-200 border-amber-400 font-bold';
                        $matrixBadge = '-';
                        if ($isAnswered && $isCorrect) {
                            $matrixColor = 'bg-emerald-600 text-white border-emerald-600 font-bold shadow-sm';
                            $matrixBadge = '✓';
                        } elseif ($isAnswered && !$isCorrect) {
                            $matrixColor = 'bg-rose-600 text-black border-rose-600 font-extrabold shadow-sm';
                            $matrixBadge = '✗';
                        }
                    @endphp

                    <a href="#question-card-{{ $q->id }}" 
                       title="প্রশ্ন {{ $toBng($idx + 1) }}: {{ $isCorrect ? 'সঠিক' : ($isAnswered ? 'ভুল (আপনার উত্তর: '.$studentOptLetter.', সঠিক: '.$correctOptLetter.')' : 'উত্তর দেওয়া হয়নি') }}"
                       class="p-1 sm:p-1.5 rounded-xl border flex flex-col items-center justify-center transition-all hover:scale-105 {{ $matrixColor }}">
                        <span class="text-[11px] leading-tight font-bold">{{ $toBng($idx + 1) }}</span>
                        <span class="text-[10px] leading-none opacity-90">
                            {{ $isAnswered ? $studentOptLetter . ' ' . $matrixBadge : '-' }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <!-- ========================================================================= -->
    <!-- RESULT RELEASE POLICY LOCK NOTICE (IF POLICY IS RESTRICTED) -->
    <!-- ========================================================================= -->
    @if(!empty($resultsLocked))
        <div class="student-card rounded-3xl bg-white dark:bg-slate-900 border border-amber-300 dark:border-amber-500/40 p-6 sm:p-8 text-center space-y-4 shadow-lg">
            <div class="w-16 h-16 rounded-2xl bg-amber-500/10 text-amber-500 border border-amber-500/20 flex items-center justify-center mx-auto text-2xl">
                <i class="fa fa-shield"></i>
            </div>
            <div class="space-y-1">
                <h3 class="text-base sm:text-lg font-bold text-slate-950 dark:text-white">উত্তরপত্র ও বিস্তারিত সমাধান সংরক্ষিত রয়েছে</h3>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-lg mx-auto leading-relaxed">
                    {{ $resultsLockedMessage ?: 'পরীক্ষার নীতিমালা অনুযায়ী নির্ধারিত সময়ের পর সঠিক উত্তর ও পূর্ণাঙ্গ ব্যাখ্যা উন্মুক্ত করা হবে।' }}
                </p>
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-mono text-xs">
                <i class="fa fa-info-circle text-amber-500"></i> আপনার মূল প্রাপ্ত নম্বর ও ফলাফল নিরাপদে সংরক্ষিত রয়েছে।
            </div>
        </div>
    @else

        <!-- ========================================================================= -->
        <!-- QUESTION REVIEW FILTER CONTROLS BAR (PREVENTS EXCESSIVE SCROLLING) -->
        <!-- ========================================================================= -->
        <div class="sticky top-16 z-20 student-card rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 p-3 shadow-md backdrop-blur-xl flex flex-wrap items-center justify-between gap-3 print:hidden">
            
            <!-- Filter Tabs: All, Wrong, Correct, Unanswered -->
            <div class="inline-flex rounded-xl p-1 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs font-semibold">
                <button type="button" onclick="filterQuestions('all')" id="btn-filter-all" class="px-3 py-1.5 rounded-lg transition-all font-bold bg-white dark:bg-slate-800 text-slate-950 dark:text-white shadow-sm flex items-center gap-1.5">
                    <span>সব প্রশ্ন</span>
                    <span class="px-1.5 py-0.2 rounded-full bg-slate-200 dark:bg-slate-700 text-[10px] font-mono">{{ $totalQ }}</span>
                </button>
                <button type="button" onclick="filterQuestions('wrong')" id="btn-filter-wrong" class="px-3 py-1.5 rounded-lg transition-all text-rose-600 dark:text-rose-400 hover:text-rose-700 flex items-center gap-1.5">
                    <i class="fa fa-times-circle"></i>
                    <span>ভুল উত্তর</span>
                    <span class="px-1.5 py-0.2 rounded-full bg-rose-100 dark:bg-rose-950 text-rose-600 dark:text-rose-300 text-[10px] font-mono font-bold">{{ $incorrectCount }}</span>
                </button>
                <button type="button" onclick="filterQuestions('correct')" id="btn-filter-correct" class="px-3 py-1.5 rounded-lg transition-all text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 flex items-center gap-1.5">
                    <i class="fa fa-check-circle"></i>
                    <span>সঠিক উত্তর</span>
                    <span class="px-1.5 py-0.2 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-600 dark:text-emerald-300 text-[10px] font-mono font-bold">{{ $correctCount }}</span>
                </button>
                <button type="button" onclick="filterQuestions('unanswered')" id="btn-filter-unanswered" class="px-3 py-1.5 rounded-lg transition-all text-slate-600 dark:text-slate-400 hover:text-slate-800 flex items-center gap-1.5">
                    <span>উত্তরহীন</span>
                    <span class="px-1.5 py-0.2 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-mono">{{ $unansweredCount }}</span>
                </button>
            </div>

            <!-- View Options: 2-Column Grid vs 1-Column List & Toggle All Explanations -->
            <div class="flex items-center gap-2">
                <!-- Toggle All Explanations Button -->
                <button type="button" onclick="toggleAllExplanations()" id="btn-toggle-all-exp" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-300 hover:border-emerald-500 hover:text-emerald-600 transition-colors flex items-center gap-1.5">
                    <i class="fa fa-lightbulb-o text-amber-500"></i>
                    <span id="text-toggle-all-exp">সকল ব্যাখ্যা খুলুন</span>
                </button>

                <!-- Grid/List View Switcher -->
                <div class="hidden sm:inline-flex rounded-xl p-1 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs font-semibold">
                    <button type="button" onclick="setQuestionLayout('2-col')" id="btn-layout-2col" title="২-কলাম বোর্ড ভিউ (কম স্ক্রোলিং)" class="px-2.5 py-1 rounded-lg transition-all bg-white dark:bg-slate-800 text-slate-950 dark:text-white shadow-sm font-bold flex items-center gap-1">
                        <i class="fa fa-th-large"></i>
                        <span>২-কলাম</span>
                    </button>
                    <button type="button" onclick="setQuestionLayout('1-col')" id="btn-layout-1col" title="১-কলাম তালিকা ভিউ" class="px-2.5 py-1 rounded-lg transition-all text-slate-500 dark:text-slate-400 hover:text-slate-800 flex items-center gap-1">
                        <i class="fa fa-bars"></i>
                        <span>১-কলাম</span>
                    </button>
                </div>
            </div>

        </div>

        <!-- ========================================================================= -->
        <!-- COMPACT 2-COLUMN BOARD EXAM QUESTION EVALUATION SHEET -->
        <!-- Arranged in 2-column grid so student never has to scroll endlessly -->
        <!-- ========================================================================= -->
        <div id="questions-container" class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start print:grid-cols-2 print:gap-3">
            @php
                $activeResultSection = null;
            @endphp
            @foreach($questions as $index => $q)
                @php
                    $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
                    $selectedIds = $ans ? $ans->selected_option_ids_array : [];
                    $qType = isset($q->question_type) ? $q->question_type : 'mcq';
                    $secTitle = isset($q->section_title) ? $q->section_title : null;
                    $secInstr = isset($q->section_instructions) ? $q->section_instructions : null;
                    $isPending = $ans && $ans->grading_status === 'pending_review';
                    $isAnswered = !empty($selectedIds) || ($ans && (!empty($ans->text_answer) || !empty($ans->cq_answers)));
                    $isCorrect = $ans ? (bool)$ans->is_correct : false;

                    $filterType = 'unanswered';
                    if ($isAnswered) {
                        $filterType = $isPending ? 'pending' : ($isCorrect ? 'correct' : 'wrong');
                    }

                    // Border & Header Styling based on correctness
                    // User directive: "correct ans hoile green color , wrong ans korle red color, r kno ans na korle yello color hbe"
                    if ($isPending) {
                        $cardBorder = 'border-2 border-amber-400 dark:border-amber-500/70 shadow-sm';
                        $accentBar = 'border-left: 3px solid #f59e0b !important;';
                        $pillBadge = '<span class="px-2.5 py-1 rounded-full border border-amber-500 text-amber-700 dark:text-amber-400 text-[11px] font-bold bg-amber-50/60 dark:bg-amber-950/40"><i class="fa fa-clock-o mr-0.5"></i> পর্যালোচনাধীন</span>';
                    } elseif ($isAnswered && $isCorrect) {
                        $cardBorder = 'border-2 border-emerald-500 dark:border-emerald-500/70 shadow-sm';
                        $accentBar = 'border-left: 3px solid #16a34a !important;';
                        $pillBadge = '<span class="px-2.5 py-1 rounded-full border border-emerald-600 text-emerald-600 dark:text-emerald-400 text-[11px] font-bold bg-emerald-50/60 dark:bg-emerald-950/40"><i class="fa fa-check mr-0.5"></i> সঠিক উত্তর (+'.(float)$q->marks.')</span>';
                    } elseif ($isAnswered && !$isCorrect) {
                        $neg = (float)($q->negative_marks ?: (($quiz && $quiz->negative_marks) ? $quiz->negative_marks : 0.0));
                        $cardBorder = 'border-2 border-rose-500 dark:border-rose-500/70 shadow-sm';
                        $accentBar = 'border-left: 3px solid #dc2626 !important;';
                        $pillBadge = '<span class="px-2.5 py-1 rounded-full border border-rose-600 text-rose-600 dark:text-rose-400 text-[11px] font-bold bg-rose-50/60 dark:bg-rose-950/40"><i class="fa fa-times mr-0.5"></i> ভুল উত্তর' . ($neg > 0 ? " (-{$neg})" : ' (০)') . '</span>';
                    } else {
                        $cardBorder = 'border-2 border-amber-400 dark:border-amber-400/70 shadow-sm';
                        $accentBar = 'border-left: 3px solid #f59e0b !important;';
                        $pillBadge = '<span class="px-2.5 py-1 rounded-full border border-amber-500 text-amber-800 dark:text-amber-300 text-[11px] font-bold bg-amber-50/60 dark:bg-amber-950/40"><i class="fa fa-exclamation-circle mr-0.5"></i> উত্তর দেওয়া হয়নি</span>';
                    }
                @endphp

                <!-- Section Divider if Section changed -->
                @if(!empty($secTitle) && $secTitle !== $activeResultSection)
                    @php $activeResultSection = $secTitle; @endphp
                    <div class="col-span-1 md:col-span-2 p-3 rounded-2xl bg-slate-100 dark:bg-slate-950/90 border-2 border-slate-300 dark:border-slate-700 text-center font-serif shadow-sm my-2">
                        <h4 class="font-bold text-slate-950 dark:text-white text-sm sm:text-base">{{ $secTitle }}</h4>
                        @if(!empty($secInstr))
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">[{{ $secInstr }}]</p>
                        @endif
                    </div>
                @endif

                <!-- Single Question Evaluation Card -->
                <div id="question-card-{{ $q->id }}" 
                     data-filter-type="{{ $filterType }}"
                     class="question-eval-card rounded-2xl bg-white dark:bg-slate-900 {{ $cardBorder }} p-4 hover:shadow-md transition-all flex flex-col h-full scroll-mt-36 print:shadow-none print:border print:p-3">
                    
                    <!-- Question Header: Number, Marks & Status Badge -->
                    <div class="flex items-center justify-between pb-2 mb-2.5 border-b border-slate-100 dark:border-slate-800 text-xs">
                        <div class="flex items-center gap-2">
                            <span style="{{ $accentBar }}" class="pl-2 text-xs font-semibold text-slate-700 dark:text-slate-300">
                                প্রশ্ন {{ $toBng($index + 1) }}
                            </span>
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-mono uppercase bg-slate-100 dark:bg-slate-800 text-slate-500 border border-slate-200 dark:border-slate-700">
                                {{ $qType }}
                            </span>
                        </div>
                        <div>
                            {!! $pillBadge !!}
                        </div>
                    </div>

                    <!-- Stimulus Context (if present) -->
                    @if(!empty($q->stimulus))
                        <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/80 border-l-4 border-emerald-600 text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-serif mb-2.5">
                            <div class="font-bold text-[10px] uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-0.5">
                                নিচের উদ্দীপকটি পড়ুন :
                            </div>
                            {!! nl2br(e($q->stimulus)) !!}
                        </div>
                    @endif

                    <!-- Question Prompt Text -->
                    <div class="text-sm sm:text-base font-bold text-slate-900 dark:text-white leading-relaxed mb-3">
                        {{ $q->question_text }}
                    </div>

                    <!-- TYPE 1: MCQ Options (Matching Screenshot 2x2 Grid) -->
                    @if(in_array($qType, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']) || ($qType === 'true_false' && count($q->options) > 0))
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 mb-3 text-xs sm:text-sm">
                            @foreach($q->options as $optIdx => $opt)
                                @php
                                    $wasSelected = in_array($opt->id, $selectedIds);
                                    $isOfficialCorrect = (bool)$opt->is_correct;
                                    $optLetter = chr(65 + $optIdx);

                                    // Default unselected styling
                                    $boxStyle = 'background-color: #ffffff; border: 1.5px solid #cbd5e1; color: #0f172a; border-radius: 8px;';
                                    $optIcon = '<span class="w-3.5 h-3.5 rounded-full border border-slate-400 inline-block mr-1.5 shrink-0"></span>';
                                    $badgeHtml = '';

                                    // Directive: "correct ans hoile green color , wrong ans korle red color, r kno ans na korle yello color hbe"
                                    if ($isOfficialCorrect) {
                                        // Green color for correct answer
                                        $boxStyle = 'background-color: #f0fdf4 !important; border: 2px solid #16a34a !important; color: #0f172a !important; font-weight: 700; border-radius: 8px;';
                                        $optIcon = '<i class="fa fa-check-circle mr-1.5 shrink-0" style="color: #16a34a !important; font-size: 14px;"></i>';
                                        $badgeHtml = '<span class="badge text-white font-bold flex items-center gap-1" style="background-color: #16a34a !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fa fa-check"></i> সঠিক</span>';
                                        if ($wasSelected) {
                                            $badgeHtml = '<span class="badge text-white font-bold flex items-center gap-1 mr-1" style="background-color: #15803d !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fa fa-user"></i> আপনার পছন্দ</span>' . $badgeHtml;
                                        }
                                    } elseif ($wasSelected && !$isOfficialCorrect) {
                                        // Red color for student's wrong answer
                                        $boxStyle = 'background-color: #fef2f2 !important; border: 2px solid #dc2626 !important; color: #0f172a !important; font-weight: 700; border-radius: 8px;';
                                        $optIcon = '<i class="fa fa-times-circle mr-1.5 shrink-0" style="color: #dc2626 !important; font-size: 14px;"></i>';
                                        $badgeHtml = '<span class="badge text-white font-bold flex items-center gap-1" style="background-color: #dc2626 !important; color: #ffffff !important; padding: 3px 7px; font-size: 10px; border-radius: 4px;"><i class="fa fa-times"></i> আপনার ভুল উত্তর</span>';
                                    }
                                @endphp
                                <div class="p-2.5 rounded-lg flex items-center justify-between gap-1.5 h-full transition-all shadow-xs" style="{{ $boxStyle }}">
                                    <div class="flex items-center gap-1.5 min-w-0">
                                        <span class="font-bold shrink-0" style="color: #0f172a !important;">{{ $optLetter }}.</span>
                                        <div class="flex items-center min-w-0">
                                            {!! $optIcon !!}
                                            <span class="font-bold truncate leading-tight" style="color: #0f172a !important;">{{ $opt->option_text }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0 ml-1">
                                        {!! $badgeHtml !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    <!-- TYPE 2: True/False Review -->
                    @elseif($qType === 'true_false')
                        @php
                            $stVal = $ans ? ($ans->text_answer ?: 'উত্তর দেওয়া হয়নি') : 'উত্তর দেওয়া হয়নি';
                            $expVal = $q->correct_answer_text ?: 'সত্য';
                        @endphp
                        <div class="space-y-2 mb-3 text-xs font-serif">
                            <div class="p-2.5 rounded-lg border {{ $isCorrect ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-400' : 'bg-rose-50 dark:bg-rose-950/30 border-rose-400' }} flex items-center justify-between">
                                <div>
                                    <span class="text-slate-500 block text-[10px]">আপনার প্রদত্ত উত্তর:</span>
                                    <strong class="{{ $isCorrect ? 'text-emerald-700 dark:text-emerald-300' : 'text-rose-700 dark:text-rose-300' }}">{{ $stVal }}</strong>
                                </div>
                                <div>
                                    <span class="text-slate-500 block text-[10px]">বোর্ড সঠিক উত্তর:</span>
                                    <strong class="text-emerald-700 dark:text-emerald-400">{{ $expVal }}</strong>
                                </div>
                            </div>
                        </div>

                    <!-- TYPE 3: Fill in Blanks Review -->
                    @elseif(in_array($qType, ['fill_blanks', 'fill_in_the_blanks']))
                        @php
                            $stVal = $ans ? ($ans->text_answer ?: 'উত্তর দেওয়া হয়নি') : 'উত্তর দেওয়া হয়নি';
                            $expVal = $q->correct_answer_text;
                        @endphp
                        <div class="space-y-2 mb-3 text-xs font-serif">
                            <div class="p-2.5 rounded-lg border {{ $isCorrect ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-400' : 'bg-rose-50 dark:bg-rose-950/30 border-rose-400' }} space-y-1">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-500 text-[10px]">আপনার প্রদত্ত শব্দ:</span>
                                    <strong class="{{ $isCorrect ? 'text-emerald-700 dark:text-emerald-300' : 'text-rose-700 dark:text-rose-300' }}">{{ $stVal }}</strong>
                                </div>
                                <div class="flex justify-between items-center border-t border-slate-200 dark:border-slate-800/80 pt-1">
                                    <span class="text-slate-500 text-[10px]">বোর্ড গ্রহণযোগ্য উত্তর:</span>
                                    <strong class="text-emerald-700 dark:text-emerald-400">{{ $expVal }}</strong>
                                </div>
                            </div>
                        </div>

                    <!-- TYPE 4: Creative Question (CQ) Review -->
                    @elseif(in_array($qType, ['creative', 'cq']))
                        @php
                            $subq = !empty($q->cq_subquestions) ? (is_array($q->cq_subquestions) ? $q->cq_subquestions : json_decode($q->cq_subquestions, true)) : [];
                            $cqAns = $ans && $ans->cq_answers ? (is_array($ans->cq_answers) ? $ans->cq_answers : json_decode($ans->cq_answers, true)) : [];
                        @endphp
                        <div class="space-y-2 mb-3 text-xs font-serif">
                            @foreach($subq as $subKey => $subData)
                                @php
                                    $sLabel = isset($subData['label']) ? $subData['label'] : $subKey;
                                    $sText = isset($subData['text']) ? $subData['text'] : '';
                                    $sVal = isset($cqAns[$subKey]) ? $cqAns[$subKey] : 'উত্তর দেওয়া হয়নি';
                                @endphp
                                <div class="p-2 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
                                    <div class="font-bold text-slate-800 dark:text-slate-200">({{ $sLabel }}) {{ $sText }}</div>
                                    <div class="mt-1 text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-900 p-1.5 rounded border border-slate-200 dark:border-slate-800 font-sans">
                                        {{ $sVal }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    <!-- TYPE 5: Short Answer / Translation Review -->
                    @else
                        @php
                            $stVal = $ans ? ($ans->text_answer ?: 'উত্তর দেওয়া হয়নি') : 'উত্তর দেওয়া হয়নি';
                            $expVal = $q->correct_answer_text ?: 'শিক্ষক কর্তৃক মূল্যায়ন সাপেক্ষে';
                        @endphp
                        <div class="space-y-2 mb-3 text-xs font-serif">
                            <div class="p-2.5 rounded-lg bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 space-y-1">
                                <div>
                                    <span class="text-slate-500 block text-[10px]">আপনার উত্তর:</span>
                                    <div class="font-sans text-slate-800 dark:text-slate-200 mt-0.5">{{ $stVal }}</div>
                                </div>
                                @if(!empty($expVal))
                                    <div class="border-t border-slate-200 dark:border-slate-800 pt-1 mt-1">
                                        <span class="text-slate-500 block text-[10px]">আদর্শ / রেফারেন্স উত্তর:</span>
                                        <div class="font-sans text-emerald-700 dark:text-emerald-400 font-medium">{{ $expVal }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Explanation Box (Matching Screenshot Blue Box) -->
                    @if($q->hasEducationalExplanation() || $q->explanation)
                        @php
                            $cTitle = $q->getEffectiveConceptTitle();
                            $cExp = $q->getEffectiveConceptExplanation();
                            $cStep = $q->getEffectiveStepByStepSolution();
                            $cRules = $q->getEffectiveImportantRules();
                            $cWrong = $q->getEffectiveWhyOtherOptionsWrong();
                            $cMistakes = $q->getEffectiveCommonMistakes();
                            $cMemory = $q->getEffectiveMemoryAid();
                        @endphp
                        <div class="p-3.5 rounded-xl text-sm mt-auto shadow-none" style="background-color: #f8fafc !important; border: 2px solid #0284c7 !important; border-radius: 8px;">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-2 pb-1.5 border-b" style="border-color: #e0f2fe !important;">
                                <div class="font-bold flex items-center gap-1.5" style="color: #0369a1 !important; font-size: 0.95rem;">
                                    <span>💡</span> <span>মূল কনসেপ্ট ও সঠিক উত্তরের যুক্তি:</span>
                                    @if($cTitle)
                                        <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">({{ $cTitle }})</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 text-[11px]">
                                    <span class="text-xs font-bold text-sky-800">কনসেপ্টভিত্তিক বিশদ ব্যাখ্যা ও শিখন</span>
                                    @if($q->explanation_status === 'verified')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-900 font-bold text-[10px]" style="color: #000000 !important; font-weight: 800;">
                                            <i class="fa fa-check-circle text-emerald-600"></i> যাচাইকৃত (Verified by ICT Faculty)
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="font-medium text-slate-900 leading-relaxed text-sm space-y-1.5" style="color: #0f172a !important;">
                                @if($q->explanation)
                                    <div>{!! nl2br(e($q->explanation)) !!}</div>
                                @endif
                                @if($cExp)
                                    <div>{!! nl2br(e($cExp)) !!}</div>
                                @endif
                                @if($cStep)
                                    <div class="text-xs text-indigo-900 pt-1"><strong>সমাধান ধাপ:</strong> {!! nl2br(e($cStep)) !!}</div>
                                @endif
                                @if($cRules)
                                    <div class="text-xs text-amber-900 pt-1"><strong>নিয়মাবলী:</strong> {!! nl2br(e($cRules)) !!}</div>
                                @endif
                                @if($cWrong)
                                    <div class="text-xs text-rose-900 pt-1"><strong>ভুল হওয়ার কারণ:</strong> {!! nl2br(e($cWrong)) !!}</div>
                                @endif
                            </div>
                            @if($cMistakes || $cMemory)
                                <div class="mt-2 pt-2 border-t flex flex-wrap gap-2 text-xs" style="border-color: #e2e8f0 !important; color: #334155 !important;">
                                    @if($cMistakes)
                                        <div class="inline-flex items-center gap-1 text-amber-800">
                                            <i class="fa fa-exclamation-triangle text-amber-600"></i> <strong>সতর্কতা:</strong> {!! e($cMistakes) !!}
                                        </div>
                                    @endif
                                    @if($cMemory)
                                        <div class="inline-flex items-center gap-1 text-slate-700">
                                            <i class="fa fa-key text-info"></i> <strong>মনে রাখার শর্টকাট:</strong> {{ $cMemory }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            @endforeach
        </div>

        <!-- Bottom Paper Footer Strip -->
        <div class="mt-8 pt-4 border-t border-slate-200 dark:border-slate-800 text-center text-xs font-serif text-slate-500 dark:text-slate-400">
            [ ওএমআর উত্তরপত্র মূল্যায়ন সমাপ্ত — Wake Up ICT পরীক্ষা ও পরীক্ষণ সেল ]
        </div>

    @endif

</div>

<!-- Interactive Filtering & Layout JavaScript -->
<script>
    // 1. Filter Questions: 'all', 'wrong', 'correct', 'unanswered'
    function filterQuestions(type) {
        var cards = document.querySelectorAll('.question-eval-card');
        var btnAll = document.getElementById('btn-filter-all');
        var btnWrong = document.getElementById('btn-filter-wrong');
        var btnCorrect = document.getElementById('btn-filter-correct');
        var btnUnans = document.getElementById('btn-filter-unanswered');

        // Reset button active classes
        [btnAll, btnWrong, btnCorrect, btnUnans].forEach(function(btn) {
            if (!btn) return;
            btn.classList.remove('bg-white', 'dark:bg-slate-800', 'shadow-sm', 'font-bold');
        });

        // Set active button
        var activeBtn = btnAll;
        if (type === 'wrong') activeBtn = btnWrong;
        else if (type === 'correct') activeBtn = btnCorrect;
        else if (type === 'unanswered') activeBtn = btnUnans;

        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'dark:bg-slate-800', 'shadow-sm', 'font-bold');
        }

        // Show/Hide question cards
        cards.forEach(function(card) {
            var cardType = card.getAttribute('data-filter-type');
            if (type === 'all' || cardType === type) {
                card.classList.remove('hidden');
                card.classList.add('block');
            } else {
                card.classList.add('hidden');
                card.classList.remove('block');
            }
        });
    }

    // 2. Toggle Individual Question Explanation
    function toggleExplanation(qId) {
        var box = document.getElementById('explanation-box-' + qId);
        var btnText = document.getElementById('exp-btn-text-' + qId);
        if (!box) return;

        if (box.classList.contains('hidden')) {
            box.classList.remove('hidden');
            if (btnText) btnText.innerHTML = 'ব্যাখ্যা লুকান &uarr;';
        } else {
            box.classList.add('hidden');
            if (btnText) btnText.innerHTML = 'ব্যাখ্যা ও সমাধান দেখুন &darr;';
        }
    }

    // 3. Toggle All Explanations at once
    var allExplanationsOpen = false;
    function toggleAllExplanations() {
        var boxes = document.querySelectorAll('.explanation-content');
        var toggleText = document.getElementById('text-toggle-all-exp');
        allExplanationsOpen = !allExplanationsOpen;

        boxes.forEach(function(box) {
            if (allExplanationsOpen) {
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        });

        var btnTexts = document.querySelectorAll('[id^="exp-btn-text-"]');
        btnTexts.forEach(function(bt) {
            bt.innerHTML = allExplanationsOpen ? 'ব্যাখ্যা লুকান &uarr;' : 'ব্যাখ্যা ও সমাধান দেখুন &darr;';
        });

        if (toggleText) {
            toggleText.innerText = allExplanationsOpen ? 'সকল ব্যাখ্যা লুকান' : 'সকল ব্যাখ্যা খুলুন';
        }
    }

    // 4. Switch Question Layout: '2-col' vs '1-col'
    var pendingResultFormId = null;

    function confirmRetakeExam() {
        pendingResultFormId = 'form-retake-exam';
        var iconWrap = document.getElementById('modal-action-icon-wrap');
        var icon = document.getElementById('modal-action-icon');
        var title = document.getElementById('modal-action-title');
        var desc = document.getElementById('modal-action-desc');
        var btn = document.getElementById('btn-proceed-result-action');

        if (iconWrap) iconWrap.className = "w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 flex items-center justify-center mx-auto text-2xl";
        if (icon) icon.className = "fa fa-repeat";
        if (title) title.innerText = "পুনরায় পরীক্ষা শুরু করতে প্রস্তুত?";
        if (desc) desc.innerText = "এই সেটের প্রশ্নগুলো নিয়ে একটি নতুন প্রচেষ্টা (Retake Attempt) শুরু হবে। আপনার পূর্ববর্তী ফলাফল সুরক্ষিত থাকবে।";
        if (btn) {
            btn.className = "w-1/2 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md cursor-pointer";
            btn.innerText = "হ্যাঁ, পুনরায় পরীক্ষা দিন";
        }

        var modal = document.getElementById('result-action-confirm-modal');
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            if (confirm('আপনি কি এই পরীক্ষাটি পুনরায় শুরু করতে চান?')) {
                var f = document.getElementById(pendingResultFormId);
                if (f) f.submit();
            }
        }
    }

    function confirmFreshPractice(formId) {
        pendingResultFormId = formId;
        var iconWrap = document.getElementById('modal-action-icon-wrap');
        var icon = document.getElementById('modal-action-icon');
        var title = document.getElementById('modal-action-title');
        var desc = document.getElementById('modal-action-desc');
        var btn = document.getElementById('btn-proceed-result-action');

        if (iconWrap) iconWrap.className = "w-16 h-16 rounded-2xl bg-orange-500/10 text-orange-600 dark:text-orange-400 border border-orange-500/20 flex items-center justify-center mx-auto text-2xl";
        if (icon) icon.className = "fa fa-refresh";
        if (title) title.innerText = "পরবর্তী নতুন প্রশ্নে প্র্যাকটিস শুরু করবেন?";
        if (desc) desc.innerText = "স্মার্ট প্রশ্ন ব্যাংক থেকে আপনার এখনো সমাধান না করা আনসিন প্রশ্নগুলোর রোটেশন নিয়ে নতুন অনুশীলন পরীক্ষা শুরু হবে।";
        if (btn) {
            btn.className = "w-1/2 py-3 rounded-xl btn-brand-primary font-black text-xs uppercase tracking-wider transition-all shadow-md cursor-pointer";
            btn.innerText = "হ্যাঁ, নতুন প্র্যাকটিস শুরু করুন";
        }

        var modal = document.getElementById('result-action-confirm-modal');
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            if (confirm('আপনি কি পরবর্তী নতুন প্রশ্নে অনুশীলন শুরু করতে চান?')) {
                var f = document.getElementById(pendingResultFormId);
                if (f) f.submit();
            }
        }
    }

    function closeResultActionModal() {
        var modal = document.getElementById('result-action-confirm-modal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        pendingResultFormId = null;
    }

    function proceedResultAction() {
        if (pendingResultFormId) {
            var btn = document.getElementById('btn-proceed-result-action');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-1"></i> শুরু হচ্ছে...';
            }
            var form = document.getElementById(pendingResultFormId);
            if (form) form.submit();
        }
    }

    function setQuestionLayout(layout) {
        var container = document.getElementById('questions-container');
        var btn2Col = document.getElementById('btn-layout-2col');
        var btn1Col = document.getElementById('btn-layout-1col');
        if (!container) return;

        if (layout === '2-col') {
            container.className = "grid grid-cols-1 md:grid-cols-2 gap-4 items-start print:grid-cols-2 print:gap-3";
            if (btn2Col) btn2Col.className = "px-2.5 py-1 rounded-lg transition-all bg-white dark:bg-slate-800 text-slate-950 dark:text-white shadow-sm font-bold flex items-center gap-1";
            if (btn1Col) btn1Col.className = "px-2.5 py-1 rounded-lg transition-all text-slate-500 dark:text-slate-400 hover:text-slate-800 flex items-center gap-1";
        } else {
            container.className = "space-y-4 print:space-y-3";
            if (btn1Col) btn1Col.className = "px-2.5 py-1 rounded-lg transition-all bg-white dark:bg-slate-800 text-slate-950 dark:text-white shadow-sm font-bold flex items-center gap-1";
            if (btn2Col) btn2Col.className = "px-2.5 py-1 rounded-lg transition-all text-slate-500 dark:text-slate-400 hover:text-slate-800 flex items-center gap-1";
        }
    }

    // Strict Print Prevention & Keyboard Shortcut Disabling for Quiz Exam
    window.print = function() {
        return false;
    };
    window.addEventListener('beforeprint', function(e) {
        e.preventDefault();
    });
    window.addEventListener('keydown', function(e) {
        const isCtrl = e.ctrlKey || e.metaKey;
        const key = (e.key || '').toLowerCase();
        if (isCtrl && (key === 'p' || key === 's')) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    });
</script>

<style>
    @media print {
        html, body {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            overflow: hidden !important;
        }
    }
</style>
<!-- Retake & Fresh Practice Confirmation Modal -->
<div id="result-action-confirm-modal" style="display: none; z-index: 9999999; background-color: rgba(15, 23, 42, 0.85);" class="fixed inset-0 backdrop-blur-md items-center justify-center p-4">
    <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 text-center relative z-10">
        <div id="modal-action-icon-wrap" class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 flex items-center justify-center mx-auto text-2xl">
            <i id="modal-action-icon" class="fa fa-repeat"></i>
        </div>
        
        <div class="space-y-2">
            <h3 class="text-lg font-black text-slate-900 dark:text-white" id="modal-action-title">
                পুনরায় পরীক্ষা দিন
            </h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-medium" id="modal-action-desc">
                আপনি কি নিশ্চিতভাবে এই পরীক্ষাটি পুনরায় শুরু করতে চান?
            </p>
        </div>

        <div class="flex items-center justify-center gap-3 pt-1">
            <button type="button" onclick="closeResultActionModal()" class="w-1/2 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs transition-colors cursor-pointer">
                বাতিল (Cancel)
            </button>
            <button type="button" id="btn-proceed-result-action" onclick="proceedResultAction()" class="w-1/2 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md cursor-pointer">
                হ্যাঁ, নিশ্চিত
            </button>
        </div>
    </div>
</div>
@endsection
