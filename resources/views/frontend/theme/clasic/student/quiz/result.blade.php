@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'পরীক্ষার ফলাফল ও মূল্যায়ন বিবরণী: ' . $quiz->title . ' — Wake Up ICT')
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
    $grade = 'F';
    $gradeColor = 'text-rose-600 dark:text-rose-400';
    $gradeBg = 'bg-rose-500/10 border-rose-500/30 text-rose-600 dark:text-rose-400';
    if ($pct >= 80) {
        $grade = 'A+';
        $gradeColor = 'text-emerald-600 dark:text-emerald-400';
        $gradeBg = 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 dark:text-emerald-400';
    } elseif ($pct >= 70) {
        $grade = 'A';
        $gradeColor = 'text-emerald-600 dark:text-emerald-400';
        $gradeBg = 'bg-emerald-500/10 border-emerald-500/30 text-emerald-600 dark:text-emerald-400';
    } elseif ($pct >= 60) {
        $grade = 'A-';
        $gradeColor = 'text-blue-600 dark:text-blue-400';
        $gradeBg = 'bg-blue-500/10 border-blue-500/30 text-blue-600 dark:text-blue-400';
    } elseif ($pct >= 50) {
        $grade = 'B';
        $gradeColor = 'text-amber-600 dark:text-amber-400';
        $gradeBg = 'bg-amber-500/10 border-amber-500/30 text-amber-600 dark:text-amber-400';
    } elseif ($pct >= 40) {
        $grade = 'C';
        $gradeColor = 'text-amber-600 dark:text-amber-400';
        $gradeBg = 'bg-amber-500/10 border-amber-500/30 text-amber-600 dark:text-amber-400';
    }

    $assignedSet = $attempt->question_set ?: ($quiz->question_set ?: 'Set A');
    $bngSet = \App\model\LmsQuiz::getBengaliSetCode($assignedSet);
    $subjectCode = $quiz->subject_code ?: '101';
    $codeDigits = str_split((string)$subjectCode);
@endphp

<div class="max-w-6xl mx-auto space-y-6 pb-12 print:p-0 print:max-w-none print:space-y-3">

    <!-- Top Action & Navigation HUD (Hidden in Print) -->
    <div class="flex flex-wrap items-center justify-between gap-3 print:hidden">
        <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors shadow-sm">
            <i class="fa fa-arrow-left"></i>
            <span>সকল পরীক্ষার তালিকায় ফিরে যান</span>
        </a>

        <div class="flex items-center gap-2">
            <!-- Print Official Board Result Sheet Button -->
            <button type="button" onclick="window.print()" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-700 dark:text-slate-200 hover:border-emerald-500 hover:text-emerald-600 transition-all shadow-sm flex items-center gap-1.5">
                <i class="fa fa-print text-emerald-600 dark:text-emerald-400"></i>
                <span>প্রিন্ট / PDF সংরক্ষণ</span>
            </button>

            <!-- All Results Archive Link -->
            <a href="{{ route('student.results.index') }}" class="px-4 py-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-xs font-semibold text-slate-700 dark:text-slate-200 hover:text-emerald-600 transition-colors shadow-sm flex items-center gap-1.5">
                <i class="fa fa-history text-slate-400"></i>
                <span>ফলাফল আর্কাইভ</span>
            </a>

            @if($quiz->canAttempt($student->id))
                <form action="{{ route('student.quiz.start', $quiz->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition-all shadow-md flex items-center gap-1.5">
                        <i class="fa fa-repeat"></i>
                        <span>পুনরায় পরীক্ষা দিন</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

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
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">পরীক্ষার তারিখ :</span>
                    <strong class="font-mono">{{ $attempt->submitted_at ? $attempt->submitted_at->format('d M, Y h:i A') : $attempt->updated_at->format('d M, Y') }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 dark:text-slate-400 text-[11px] block">ব্যয়িত সময় :</span>
                    <strong class="font-mono">{{ $attempt->formatted_time_spent }} মিনিট</strong>
                </div>
            </div>
        </div>

        <!-- Official Marks & Result Summary Scoreboard -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2.5 my-4 font-mono text-center">
            
            <!-- 1. Total Questions -->
            <div class="p-3 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <span class="text-[10px] uppercase text-slate-500 dark:text-slate-400 block mb-0.5">মোট প্রশ্ন</span>
                <span class="text-base sm:text-lg font-black text-slate-900 dark:text-white">{{ $toBng($totalQ) }}</span>
                <span class="text-[10px] text-slate-400 block">পূর্ণমান: {{ $toBng((int)$quiz->total_marks) }}</span>
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
                        <span class="w-3 h-3 rounded-full bg-slate-400 dark:bg-slate-700 inline-block"></span> অনুত্তীর্ণ
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

                        $matrixColor = 'bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 border-slate-300 dark:border-slate-700';
                        $matrixBadge = '-';
                        if ($isAnswered && $isCorrect) {
                            $matrixColor = 'bg-emerald-600 text-white border-emerald-600 font-bold shadow-sm';
                            $matrixBadge = '✓';
                        } elseif ($isAnswered && !$isCorrect) {
                            $matrixColor = 'bg-rose-600 text-white border-rose-600 font-bold shadow-sm';
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

                    // Border styling
                    $cardBorder = 'border-slate-200 dark:border-slate-800';
                    $statusHeaderBg = 'bg-slate-100 dark:bg-slate-950 text-slate-600 dark:text-slate-400';
                    $statusBadgeText = 'উত্তর দেওয়া হয়নি';
                    if ($isPending) {
                        $cardBorder = 'border-amber-300 dark:border-amber-800/80 ring-1 ring-amber-500/20';
                        $statusHeaderBg = 'bg-amber-50 dark:bg-amber-950/60 text-amber-800 dark:text-amber-300';
                        $statusBadgeText = 'পর্যালোচনাধীন (ম্যানুয়াল মূল্যায়ন)';
                    } elseif ($isAnswered && $isCorrect) {
                        $cardBorder = 'border-emerald-300 dark:border-emerald-800/80 ring-1 ring-emerald-500/20';
                        $statusHeaderBg = 'bg-emerald-50 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300';
                        $statusBadgeText = 'সঠিক উত্তর (+'.(int)$q->marks.')';
                    } elseif ($isAnswered && !$isCorrect) {
                        $cardBorder = 'border-rose-300 dark:border-rose-800/80 ring-1 ring-rose-500/20';
                        $statusHeaderBg = 'bg-rose-50 dark:bg-rose-950/60 text-rose-800 dark:text-rose-300';
                        $statusBadgeText = 'ভুল উত্তর (০)';
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
                     class="question-eval-card rounded-2xl bg-white dark:bg-slate-900 border-2 {{ $cardBorder }} p-4 shadow-sm hover:shadow-md transition-all space-y-3 scroll-mt-36 print:shadow-none print:border print:p-3">
                    
                    <!-- Question Header: Number, Marks & Status Badge -->
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100 dark:border-slate-800 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg font-mono text-xs font-bold flex items-center justify-center shrink-0 {{ $isPending ? 'bg-amber-500 text-white' : ($isAnswered && $isCorrect ? 'bg-emerald-600 text-white' : ($isAnswered && !$isCorrect ? 'bg-rose-600 text-white' : 'bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300')) }}">
                                {{ $toBng($index + 1) }}
                            </span>
                            <span class="font-bold text-[11px] uppercase tracking-wider {{ $isPending ? 'text-amber-700 dark:text-amber-400' : ($isAnswered && $isCorrect ? 'text-emerald-700 dark:text-emerald-400' : ($isAnswered && !$isCorrect ? 'text-rose-700 dark:text-rose-400' : 'text-slate-500')) }}">
                                {{ $statusBadgeText }}
                            </span>
                        </div>

                        <!-- Jump to Matrix link -->
                        <a href="#exam-container" title="ম্যাট্রিক্সে ফিরে যান" class="text-[11px] text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 print:hidden font-mono">
                            <i class="fa fa-arrow-up"></i>
                        </a>
                    </div>

                    <!-- Stimulus Context (if present) -->
                    @if(!empty($q->stimulus))
                        <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/80 border-l-4 border-emerald-600 text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-serif">
                            <div class="font-bold text-[10px] uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-0.5">
                                নিচের উদ্দীপকটি পড়ুন :
                            </div>
                            {!! nl2br(e($q->stimulus)) !!}
                        </div>
                    @endif

                    <!-- Question Prompt Text -->
                    <div class="text-xs sm:text-sm font-semibold text-slate-900 dark:text-slate-100 leading-relaxed font-serif">
                        <span class="font-bold mr-1">{{ $toBng($index + 1) }}।</span>
                        {!! nl2br(e($q->question_text)) !!}
                    </div>

                    <!-- TYPE 1: MCQ Options Review -->
                    @if(in_array($qType, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']) || ($qType === 'true_false' && count($q->options) > 0))
                        <div class="space-y-1.5 pt-1 text-xs font-serif">
                            @foreach($q->options as $optIdx => $opt)
                                @php
                                    $wasSelected = in_array($opt->id, $selectedIds);
                                    $isOfficialCorrect = (bool)$opt->is_correct;
                                    $bngLetter = \App\model\LmsQuestion::getBengaliOptionLetter($optIdx);

                                    $optBorder = 'border-slate-200 dark:border-slate-800/90 bg-slate-50/50 dark:bg-slate-950/40 text-slate-700 dark:text-slate-300';
                                    $bubbleBg = 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400';
                                    $optBadge = null;

                                    if ($isOfficialCorrect) {
                                        $optBorder = 'border-emerald-500 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-950 dark:text-emerald-200 font-bold';
                                        $bubbleBg = 'bg-emerald-600 border-emerald-600 text-white font-bold ring-2 ring-emerald-500/30';
                                        $optBadge = '<span class="text-[10px] font-mono uppercase tracking-wider text-emerald-600 dark:text-emerald-400 font-bold shrink-0 flex items-center gap-1"><i class="fa fa-check"></i> সঠিক উত্তর</span>';
                                    } elseif ($wasSelected && !$isOfficialCorrect) {
                                        $optBorder = 'border-rose-500 bg-rose-50 dark:bg-rose-950/40 text-rose-950 dark:text-rose-200 font-semibold';
                                        $bubbleBg = 'bg-rose-600 border-rose-600 text-white font-bold';
                                        $optBadge = '<span class="text-[10px] font-mono uppercase tracking-wider text-rose-600 dark:text-rose-400 font-bold shrink-0 flex items-center gap-1"><i class="fa fa-times"></i> আপনার ভুল উত্তর</span>';
                                    }
                                @endphp

                                <div class="p-2 rounded-xl border flex items-center justify-between gap-2.5 transition-all {{ $optBorder }}">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="w-5 h-5 rounded-full border flex items-center justify-center shrink-0 text-[11px] {{ $bubbleBg }}">
                                            ({{ $bngLetter }})
                                        </span>
                                        <span class="truncate leading-tight">{{ $opt->option_text }}</span>
                                    </div>
                                    {!! $optBadge !!}
                                </div>
                            @endforeach
                        </div>

                    <!-- TYPE 2: True/False Review -->
                    @elseif($qType === 'true_false')
                        @php
                            $stVal = $ans ? ($ans->text_answer ?: 'উত্তর দেওয়া হয়নি') : 'উত্তর দেওয়া হয়নি';
                            $expVal = $q->correct_answer_text ?: 'সত্য';
                        @endphp
                        <div class="space-y-2 pt-1 text-xs font-serif">
                            <div class="p-2.5 rounded-xl border {{ $isCorrect ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-400' : 'bg-rose-50 dark:bg-rose-950/30 border-rose-400' }} flex items-center justify-between">
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
                        <div class="space-y-2 pt-1 text-xs font-serif">
                            <div class="p-2.5 rounded-xl border {{ $isCorrect ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-400' : 'bg-rose-50 dark:bg-rose-950/30 border-rose-400' }} space-y-1">
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
                        <div class="space-y-2 pt-1 text-xs font-serif">
                            @foreach($subq as $subKey => $subData)
                                @php
                                    $sLabel = isset($subData['label']) ? $subData['label'] : $subKey;
                                    $sText = isset($subData['text']) ? $subData['text'] : '';
                                    $sVal = isset($cqAns[$subKey]) ? $cqAns[$subKey] : 'উত্তর দেওয়া হয়নি';
                                @endphp
                                <div class="p-2 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800">
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
                        <div class="space-y-2 pt-1 text-xs font-serif">
                            <div class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 space-y-1">
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

                    <!-- Collapsible Concept-Based Explanation & Learning Card -->
                    @if($q->hasEducationalExplanation())
                        @php
                            $cTitle = $q->getEffectiveConceptTitle();
                            $cExp = $q->getEffectiveConceptExplanation();
                            $cStep = $q->getEffectiveStepByStepSolution();
                            $cRules = $q->getEffectiveImportantRules();
                            $cWrong = $q->getEffectiveWhyOtherOptionsWrong();
                            $cMistakes = $q->getEffectiveCommonMistakes();
                            $cMemory = $q->getEffectiveMemoryAid();
                            $relatedQs = $q->getRelatedConceptQuestions(4);
                        @endphp

                        <div class="pt-2">
                            <button type="button" 
                                    onclick="toggleExplanation({{ $q->id }})" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/50 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800 hover:bg-emerald-100 dark:hover:bg-emerald-900/60 transition-colors focus:outline-none print:hidden shadow-xs">
                                <i class="fa fa-graduation-cap text-emerald-600 dark:text-emerald-400"></i>
                                <span id="exp-btn-text-{{ $q->id }}">কনসেপ্টভিত্তিক বিশদ ব্যাখ্যা ও শিখন &darr;</span>
                                @if($cTitle)
                                    <span class="text-[10px] font-normal text-slate-500 dark:text-slate-400 hidden sm:inline">| {{ Str::limit($cTitle, 32) }}</span>
                                @endif
                            </button>

                            <!-- Detailed Concept-Based Explanation Box -->
                            <div id="explanation-box-{{ $q->id }}" class="hidden explanation-content mt-2.5 rounded-2xl bg-slate-50/95 dark:bg-slate-950/90 border-2 border-emerald-500/30 dark:border-emerald-500/20 p-4 sm:p-5 text-xs sm:text-sm font-sans text-slate-800 dark:text-slate-200 leading-relaxed space-y-3.5 print:block shadow-sm">
                                
                                <!-- Header Strip: Concept Title & Faculty Verification Status -->
                                <div class="flex flex-wrap items-center justify-between gap-2.5 pb-3 border-b border-slate-200 dark:border-slate-800">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-7 h-7 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-xs shadow-xs">
                                            <i class="fa fa-lightbulb-o"></i>
                                        </span>
                                        <div>
                                            <div class="text-[10px] uppercase font-mono tracking-wider text-slate-500 dark:text-slate-400">
                                                মূল বিষয়বস্তু ও কনসেপ্ট (Learning Concept)
                                            </div>
                                            <h5 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $cTitle ?: ($q->topic ?: 'তথ্য ও যোগাযোগ প্রযুক্তি — মূল পাঠ্যবিষয়') }}
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1.5 text-[11px]">
                                        @if($q->explanation_status === 'verified')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-950 font-bold border border-emerald-300 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800 text-[11px]" style="color:#000000 !important; font-weight:800;">
                                                <i class="fa fa-check-circle text-emerald-700"></i> যাচাইকৃত (Verified by ICT Faculty)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 text-amber-900 font-bold border border-amber-300 dark:bg-amber-950 dark:text-amber-300 dark:border-amber-800 text-[11px]">
                                                <i class="fa fa-clock-o text-amber-600"></i> পর্যালোচনাধীন (Pending Faculty Review)
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- UNIFIED CONCEPT EXPLANATION PARAGRAPH (এক নজরে সম্পূর্ণ কনসেপ্ট ও মূল ব্যাখ্যা) -->
                                <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xs space-y-3">
                                    <div class="font-bold text-xs sm:text-sm text-emerald-800 dark:text-emerald-400 flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-lg bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-xs">
                                            <i class="fa fa-book"></i>
                                        </span>
                                        <span>মূল কনসেপ্ট ও বিস্তারিত ব্যাখ্যা (Core Concept & Explanation) :</span>
                                    </div>

                                    <!-- The complete comprehensive paragraph -->
                                    <div class="text-slate-800 dark:text-slate-100 text-xs sm:text-sm leading-relaxed space-y-2 font-sans">
                                        @if($q->explanation && $cExp)
                                            <p>
                                                <strong class="text-emerald-700 dark:text-emerald-400 font-semibold">সঠিক উত্তর ও মূল ব্যাখ্যা:</strong> 
                                                {!! nl2br(e($q->explanation)) !!} {!! nl2br(e($cExp)) !!}
                                            </p>
                                        @elseif($q->explanation)
                                            <p>
                                                <strong class="text-emerald-700 dark:text-emerald-400 font-semibold">সঠিক উত্তর ও মূল ব্যাখ্যা:</strong> 
                                                {!! nl2br(e($q->explanation)) !!}
                                            </p>
                                        @elseif($cExp)
                                            <p>
                                                <strong class="text-emerald-700 dark:text-emerald-400 font-semibold">মূল কনসেপ্ট:</strong> 
                                                {!! nl2br(e($cExp)) !!}
                                            </p>
                                        @endif

                                        @if($cStep)
                                            <p class="text-slate-700 dark:text-slate-200">
                                                <strong class="text-indigo-700 dark:text-indigo-400 font-semibold">ধাপ ও সমাধান:</strong> {!! nl2br(e($cStep)) !!}
                                            </p>
                                        @endif

                                        @if($cRules)
                                            <p class="text-slate-700 dark:text-slate-200">
                                                <strong class="text-amber-700 dark:text-amber-400 font-semibold">নিয়মাবলী ও সূত্র:</strong> {!! nl2br(e($cRules)) !!}
                                            </p>
                                        @endif

                                        @if($cWrong)
                                            <p class="text-rose-800 dark:text-rose-300">
                                                <strong class="text-rose-700 dark:text-rose-400 font-semibold">অন্যান্য অপশনগুলো কেন ভুল:</strong> {!! nl2br(e($cWrong)) !!}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Compact Bottom Highlights (Mistakes & Memory Aid) -->
                                    @if($cMistakes || $cMemory)
                                        <div class="pt-3 border-t border-slate-100 dark:border-slate-800/80 flex flex-wrap gap-2 text-xs">
                                            @if($cMistakes)
                                                <div class="inline-flex items-start gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 text-amber-950 dark:text-amber-200 text-xs">
                                                    <i class="fa fa-exclamation-triangle text-amber-600 mt-0.5 shrink-0"></i>
                                                    <span><strong>পরীক্ষার সতর্কতা:</strong> {!! e($cMistakes) !!}</span>
                                                </div>
                                            @endif
                                            @if($cMemory)
                                                <div class="inline-flex items-start gap-1.5 px-3 py-1.5 rounded-xl bg-purple-50 dark:bg-purple-950/40 border border-purple-200 dark:border-purple-900/60 text-purple-950 dark:text-purple-300 text-xs">
                                                    <i class="fa fa-magic text-purple-600 mt-0.5 shrink-0"></i>
                                                    <span><strong>মনে রাখার সহজ কৌশল:</strong> {!! e($cMemory) !!}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <!-- SECTION 8: Related Question Variations & Practice (একই কনসেপ্টের ভিন্নধর্মী প্রশ্ন ও অনুশীলন) -->
                                @if($relatedQs->isNotEmpty())
                                    <div class="p-3.5 rounded-xl bg-white dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 space-y-2.5 shadow-2xs">
                                        <div class="flex items-center justify-between gap-2 flex-wrap">
                                            <div class="font-bold text-xs text-slate-900 dark:text-white flex items-center gap-2">
                                                <span class="w-5 h-5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-[11px]">
                                                    <i class="fa fa-random"></i>
                                                </span>
                                                <span>একই কনসেপ্টের বিভিন্ন ফরম্যাটের প্রশ্ন ও অনুশীলন (Variations & Practice) :</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-emerald-800 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/80 px-2.5 py-0.5 rounded-full border border-emerald-200 dark:border-emerald-800">
                                                {{ $relatedQs->count() }} টি সম্পর্কিত প্রশ্ন
                                            </span>
                                        </div>

                                        <div class="space-y-2 pt-1">
                                            @foreach($relatedQs as $rq)
                                                <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-950 border border-slate-200/90 dark:border-slate-800 hover:border-emerald-400 dark:hover:border-emerald-600 transition-colors flex items-start justify-between gap-3 shadow-2xs">
                                                    <div class="space-y-1.5 flex-1 min-w-0">
                                                        <div class="flex items-center gap-2 flex-wrap">
                                                            @if($rq->question_type === 'true_false')
                                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-900 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-800">
                                                                    সত্য / মিথ্যা (True/False)
                                                                </span>
                                                            @elseif($rq->question_type === 'fill_blanks')
                                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 dark:bg-amber-950 text-amber-900 dark:text-amber-300 border border-amber-300 dark:border-amber-800">
                                                                    শূন্যস্থান পূরণ (Fill in Blanks)
                                                                </span>
                                                            @elseif($rq->question_type === 'short_answer')
                                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-purple-100 dark:bg-purple-950 text-purple-900 dark:text-purple-300 border border-purple-300 dark:border-purple-800">
                                                                    সংক্ষিপ্ত উত্তর (Short Answer)
                                                                </span>
                                                            @else
                                                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-200 dark:bg-slate-800 text-slate-800 dark:text-slate-200 border border-slate-300 dark:border-slate-700">
                                                                    {{ $rq->getTypeLabel() }}
                                                                </span>
                                                            @endif
                                                            <span class="text-slate-900 dark:text-slate-100 font-semibold text-xs sm:text-sm">
                                                                {{ $rq->question_text }}
                                                            </span>
                                                        </div>
                                                        <div class="flex items-center gap-2 flex-wrap text-xs pt-0.5">
                                                            <span class="font-bold text-slate-600 dark:text-slate-400">বোর্ড সঠিক উত্তর :</span>
                                                            <span class="font-bold text-emerald-800 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/60 px-2 py-0.5 rounded-md border border-emerald-200 dark:border-emerald-800">
                                                                {{ $rq->getFormattedCorrectAnswer() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 font-mono shrink-0 bg-white dark:bg-slate-900 px-2 py-1 rounded-md border border-slate-200 dark:border-slate-800">
                                                        #{{ $rq->id }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
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
</script>

<style>
    @media print {
        header, nav, footer, .student-sidebar, .student-header, .print\\:hidden {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            color: #000000 !important;
        }
        .board-paper-card {
            border: 1px solid #000000 !important;
            box-shadow: none !important;
            padding: 10px !important;
        }
        .explanation-content {
            display: block !important;
        }
    }
</style>
@endsection
