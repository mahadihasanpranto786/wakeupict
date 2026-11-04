@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'পরীক্ষা কক্ষ: ' . $quiz->title . ' — Wake Up ICT')
@section('page_title', 'লাইভ পরীক্ষা কক্ষ')
@section('page_crumb', $quiz->title)

@section('content')
@php
    $totalCount = $questions->count();
    $bngDigits = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
    $toBng = function($num) use ($bngDigits) {
        return strtr((string)$num, $bngDigits);
    };

    $currentViewMode = $attempt->view_mode ?: ($quiz->view_mode ?: 'all_questions');
    $assignedSet = $attempt->question_set ?: ($quiz->question_set ?: 'Set A');
    $bngSet = \App\model\LmsQuiz::getBengaliSetCode($assignedSet);
    $subjectCode = $quiz->subject_code ?: '101';
    $codeDigits = str_split((string)$subjectCode);

    $answeredCount = 0;
    $unansweredCount = 0;
    $flaggedCount = count($flaggedQuestionIds ?: []);

    foreach ($questions as $q) {
        $ans = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
        if ($ans && (!empty($ans->selected_option_ids_array) || !empty($ans->text_answer) || !empty($ans->cq_answers))) {
            $answeredCount++;
        } else {
            $unansweredCount++;
        }
    }
@endphp

<style>
    /* Strict Exam Security & Copy Protection */
    .exam-secure-zone,
    #exam-container {
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
        -webkit-touch-callout: none !important;
    }
    .exam-secure-zone input[type="text"],
    .exam-secure-zone textarea {
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
        user-select: text !important;
    }
    @keyframes pulse-subtle {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.03); }
    }
    .pulse-subtle {
        animation: pulse-subtle 2s infinite ease-in-out;
    }
    .bg-rose-600, [class*="bg-rose-600"],
    .bg-emerald-100, [class*="bg-emerald-100"] {
        color: #000000 !important;
        font-weight: 800 !important;
    }
</style>

<div class="max-w-6xl mx-auto space-y-5 exam-secure-zone" id="exam-container">

    <!-- Sticky Exam HUD Bar -->
    <div class="student-card rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 p-3.5 sm:p-4 sticky top-16 z-30 backdrop-blur-xl shadow-lg transition-all">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            
            <!-- Exam Title & Set Badge -->
            <div class="flex items-center gap-3 min-w-0">
                <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                <div class="truncate">
                    <div class="flex items-center gap-2">
                        <h1 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white truncate">
                            {{ $quiz->title }}
                        </h1>
                        <span class="px-2 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 font-mono text-xs font-bold shrink-0">
                            সেট: {{ $bngSet }} ({{ $assignedSet }})
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-[11px] font-mono text-slate-500 dark:text-slate-400 mt-0.5">
                        <span>প্রশ্ন: {{ $toBng($totalCount) }}টি</span>
                        <span>&bull;</span>
                        <span id="connection-status" class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                            <i class="fa fa-circle text-[8px]"></i> অনলাইন (সংযুক্ত)
                        </span>
                        <span>&bull;</span>
                        <span id="autosave-status" class="text-slate-500 dark:text-slate-400 flex items-center gap-1">
                            <i class="fa fa-lock text-[10px]"></i> উত্তর সুরক্ষিত
                        </span>
                    </div>
                </div>
            </div>

            <!-- Controls: View Mode Switcher, Timer & Actions -->
            <div class="flex flex-wrap items-center gap-2.5 sm:gap-3 shrink-0">
                
                <!-- View Mode Toggle -->
                <div class="inline-flex rounded-xl p-1 bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs font-semibold">
                    <button type="button" onclick="switchViewMode('all_questions')" id="btn-mode-all" class="px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 {{ $currentViewMode == 'all_questions' ? 'bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' }}">
                        <i class="fa fa-file-text-o"></i>
                        <span class="hidden sm:inline">বোর্ড পেপার</span>
                        <span class="sm:hidden">সকল</span>
                    </button>
                    <button type="button" onclick="switchViewMode('one_by_one')" id="btn-mode-single" class="px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 {{ $currentViewMode == 'one_by_one' ? 'bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm font-bold' : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200' }}">
                        <i class="fa fa-clone"></i>
                        <span class="hidden sm:inline">১টি করে</span>
                        <span class="sm:hidden">১টি</span>
                    </button>
                </div>

                <!-- Fullscreen Toggle -->
                <button type="button" onclick="toggleFullScreen()" title="ফুলস্ক্রিন মোড" class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 hover:text-emerald-500 dark:hover:text-emerald-400 transition-colors flex items-center justify-center text-xs">
                    <i class="fa fa-arrows-alt" id="fullscreen-icon"></i>
                </button>

                <!-- Live Countdown Timer -->
                <div id="timer-box" class="px-3.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 font-mono text-sm sm:text-base font-black flex items-center gap-2 text-slate-900 dark:text-white transition-all">
                    <i class="fa fa-clock-o text-emerald-600 dark:text-emerald-400"></i>
                    <span id="exam-timer">--:--</span>
                </div>

                <!-- Submit Button -->
                <button type="button" id="btn-submit-exam-top" onclick="confirmSubmitExam()" class="px-4 sm:px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-1.5 cursor-pointer relative z-40 select-none">
                    <i class="fa fa-check-circle"></i>
                    <span>জমা দিন</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Live Alerts Banner (For 10m, 5m, 1m, 10s warnings) -->
    <div id="time-alert-banner" class="hidden rounded-2xl p-3 text-xs font-semibold text-center transition-all animate-bounce"></div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        <!-- ========================================================================= -->
        <!-- Center / Left: Questions Stream (8 cols) -->
        <!-- ========================================================================= -->
        <div class="lg:col-span-8 space-y-6">

            <!-- MODE A: ALL QUESTIONS VIEW (AUTHENTIC BANGLADESHI BOARD EXAM PAPER) -->
            <div id="view-all-questions" class="{{ $currentViewMode == 'all_questions' ? 'block' : 'hidden' }} space-y-6">

                <!-- Bangladeshi Board Exam Official Printed Paper Frame -->
                <div class="board-paper-card rounded-3xl bg-white dark:bg-slate-900/90 border-2 border-slate-300 dark:border-slate-700/80 p-5 sm:p-8 shadow-xl relative overflow-hidden">
                    
                    <!-- Top Corner Authentication Header -->
                    <div class="flex items-center justify-between text-[11px] font-mono text-slate-600 dark:text-slate-400 border-b border-slate-200 dark:border-slate-800 pb-2 mb-4">
                        <span class="font-bold tracking-wider">শালিখ / WUICT</span>
                        <span class="font-bold text-xs">২৫৬</span>
                        <span>১২৯২/২০২৬</span>
                    </div>

                    <!-- Board Exam Official Center Header -->
                    <div class="text-center space-y-1 pb-4 border-b-2 border-slate-900 dark:border-slate-700">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-700 dark:text-slate-300">{{ $quiz->board_name ?: 'ঢাকা শিক্ষা বোর্ড' }}</span>
                            
                            <!-- Official Subject Code & Set Box Table -->
                            <div class="flex items-center gap-3">
                                <!-- Subject Code -->
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

                                <!-- Set Code Box -->
                                <div class="flex items-center gap-1 text-xs font-mono">
                                    <span class="text-[11px] text-slate-600 dark:text-slate-400 font-semibold">সেট:</span>
                                    <span class="w-6 h-6 border-2 border-slate-900 dark:border-slate-400 rounded bg-slate-100 dark:bg-slate-800 font-black text-slate-950 dark:text-white flex items-center justify-center text-xs">
                                        {{ $bngSet }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Central Bangla Headings -->
                        <h2 class="text-lg sm:text-xl font-black text-slate-950 dark:text-white tracking-wide">
                            বহুনির্বাচনি অভীক্ষা
                        </h2>
                        <h3 class="text-sm sm:text-base font-bold text-slate-800 dark:text-slate-200">
                            {{ $quiz->course ? $quiz->course->course_title : $quiz->title }}
                        </h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 font-medium">
                            [২০২৬ সালের সিলেবাস অনুযায়ী]
                        </p>
                        <div class="flex items-center justify-center gap-6 text-xs font-bold text-slate-700 dark:text-slate-300 pt-1 font-mono">
                            <span>সময় — {{ $toBng($quiz->duration_minutes) }} মিনিট</span>
                            <span>|</span>
                            <span>পূর্ণমান — {{ $toBng((int)$quiz->total_marks) }}</span>
                        </div>
                    </div>

                    <!-- Official Board Notice -->
                    <div class="p-3 my-4 rounded-xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 text-[11px] leading-relaxed text-slate-700 dark:text-slate-300">
                        <strong class="text-slate-900 dark:text-white">[বিশেষ দ্রষ্টব্য:</strong>
                        সরবরাহকৃত বহুনির্বাচনি অভীক্ষার উত্তরপত্রে প্রশ্নের ক্রমিক নম্বরের বিপরীতে প্রদত্ত বর্ণসংবলিত বৃত্তসমূহ হতে সঠিক/সর্বোৎকৃষ্ট উত্তরের বৃত্তটি বল পয়েন্ট কলম দ্বারা সম্পূর্ণ ভরাট কর। প্রতিটি প্রশ্নের মান ১। সকল প্রশ্নের উত্তর দিতে হবে।]
                        <div class="mt-1 text-center font-bold text-rose-600 dark:text-rose-400">
                            প্রশ্নপত্রে কোনো প্রকার দাগ/চিহ্ন দেয়া যাবে না।
                        </div>
                    </div>

                    <!-- Negative Marking Notice Banner (if applicable) -->
                    @if($quiz->negative_marks > 0)
                        <div class="p-2.5 mb-5 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-300 dark:border-amber-800/60 text-center font-mono text-xs font-bold text-amber-900 dark:text-amber-300">
                            <i class="fa fa-exclamation-triangle mr-1"></i>
                            প্রতি প্রশ্নের মান ১ ও ভুল উত্তরের জন্য {{ $toBng(number_format($quiz->negative_marks, 2)) }} নম্বর কাটা যাবে।
                        </div>
                    @endif

                    <!-- Continuous Questions Stream -->
                    <div class="space-y-6 pt-2">
                        @php
                            $activeSectionTitle = null;
                        @endphp
                        @foreach($questions as $index => $q)
                            @php
                                $secTitle = isset($q->section_title) ? $q->section_title : null;
                                $secInstr = isset($q->section_instructions) ? $q->section_instructions : null;
                                $qType = isset($q->question_type) ? $q->question_type : 'mcq';
                                $savedAns = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
                                $savedOptionIds = $savedAns ? $savedAns->selected_option_ids_array : [];
                                $savedTextAns = $savedAns ? (string)$savedAns->text_answer : '';
                                $savedCqAns = $savedAns && $savedAns->cq_answers ? (is_array($savedAns->cq_answers) ? $savedAns->cq_answers : json_decode($savedAns->cq_answers, true)) : [];
                                $isFinalized = $savedAns ? (bool)$savedAns->is_finalized : false;
                                $isFlagged = in_array($q->id, $flaggedQuestionIds ?: []);
                            @endphp

                            <!-- Bangladeshi Board Exam Section Header Banner -->
                            @if(!empty($secTitle) && $secTitle !== $activeSectionTitle)
                                @php $activeSectionTitle = $secTitle; @endphp
                                <div class="my-6 p-3.5 sm:p-4 rounded-2xl bg-slate-100 dark:bg-slate-950/90 border-2 border-slate-300 dark:border-slate-700 text-center space-y-1 shadow-sm">
                                    <h4 class="text-base sm:text-lg font-black text-slate-950 dark:text-white font-serif tracking-wide">
                                        {{ $secTitle }}
                                    </h4>
                                    @if(!empty($secInstr))
                                        <p class="text-xs text-slate-600 dark:text-slate-400 font-serif font-medium">
                                            [{{ $secInstr }}]
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <div id="q-item-{{ $q->id }}" class="border-b border-slate-200 dark:border-slate-800/80 pb-6 last:border-b-0 space-y-3 scroll-mt-36 transition-all {{ $isFinalized ? 'opacity-95' : '' }}">
                                
                                <!-- Stimulus Context (if present) -->
                                @if(!empty($q->stimulus))
                                    <div class="p-3.5 rounded-xl bg-slate-100 dark:bg-slate-950/80 border-l-4 border-emerald-600 text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-serif">
                                        <div class="font-bold text-[11px] uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-1">
                                            নিচের উদ্দীপকটি পড়ুন :
                                        </div>
                                        {!! nl2br(e($q->stimulus)) !!}
                                    </div>
                                @endif

                                <!-- Question Header & Prompt -->
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-2.5 flex-1">
                                        <span class="font-black text-slate-950 dark:text-white text-sm sm:text-base shrink-0 font-serif">
                                            {{ $toBng($index + 1) }}।
                                        </span>
                                        <div class="text-sm sm:text-base font-semibold text-slate-900 dark:text-slate-100 leading-relaxed font-serif">
                                            {!! nl2br(e($q->question_text)) !!}
                                        </div>
                                    </div>

                                    <!-- Flag Button & Status Badge -->
                                    <div class="flex items-center gap-2 shrink-0">
                                        <button type="button" onclick="toggleFlagQuestion({{ $q->id }})" title="পরবর্তীতে পর্যালোচনার জন্য চিহ্নিত করুন" class="p-1.5 rounded-lg border text-xs transition-colors {{ $isFlagged ? 'bg-amber-100 dark:bg-amber-950/60 border-amber-400 text-amber-600' : 'border-slate-200 dark:border-slate-800 text-slate-400 hover:text-amber-500' }}">
                                            <i class="fa {{ $isFlagged ? 'fa-flag' : 'fa-flag-o' }}" id="flag-icon-{{ $q->id }}"></i>
                                        </button>

                                        @if($isFinalized)
                                            <span class="px-2 py-0.5 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-[10px] font-mono font-bold text-slate-600 dark:text-slate-300 flex items-center gap-1">
                                                <i class="fa fa-lock text-emerald-500"></i> লকড
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- TYPE 1: MCQ & Objective Options -->
                                @if(in_array($qType, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']) || ($qType === 'true_false' && count($q->options) > 0))
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 pt-1">
                                        @foreach($q->options as $optIdx => $opt)
                                            @php
                                                $isSelected = in_array($opt->id, $savedOptionIds);
                                                $bngLetter = \App\model\LmsQuestion::getBengaliOptionLetter($optIdx);
                                            @endphp

                                            <label id="opt-label-{{ $q->id }}-{{ $opt->id }}" class="flex items-start gap-2.5 p-2.5 rounded-xl border-2 transition-all cursor-pointer select-none group {{ $isSelected ? ($isFinalized ? 'bg-emerald-50 dark:bg-emerald-950/30 border-emerald-500 text-slate-900 dark:text-emerald-200 font-bold shadow-sm' : 'bg-emerald-50/80 dark:bg-emerald-950/20 border-emerald-500 text-slate-950 dark:text-white font-bold') : ($isFinalized ? 'bg-slate-50 dark:bg-slate-950/40 border-slate-200 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 cursor-not-allowed opacity-60' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800/80 hover:border-emerald-400 dark:hover:border-slate-600 text-slate-800 dark:text-slate-200') }}">
                                                
                                                <input 
                                                    type="radio" 
                                                    name="q_ans_{{ $q->id }}" 
                                                    value="{{ $opt->id }}"
                                                    {{ $isSelected ? 'checked' : '' }}
                                                    {{ $isFinalized ? 'disabled' : '' }}
                                                    onchange="handleSelectAnswer({{ $q->id }}, {{ $opt->id }}, 'all_questions')"
                                                    class="sr-only">

                                                <!-- High-Contrast Checkbox / Selection Box Indicator -->
                                                <span id="check-icon-{{ $q->id }}-{{ $opt->id }}" class="w-5 h-5 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 {{ $isSelected ? 'bg-emerald-600 border-emerald-600 text-white shadow-sm ring-2 ring-emerald-500/30' : 'border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 text-transparent group-hover:border-emerald-500' }}">
                                                    <i class="fa fa-check text-[10px] font-bold"></i>
                                                </span>

                                                <!-- Bengali Option Letter Bubble -->
                                                <span id="bubble-{{ $q->id }}-{{ $opt->id }}" class="w-6 h-6 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold transition-all {{ $isSelected ? 'border-emerald-600 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-900 dark:text-emerald-200' : 'border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 group-hover:border-emerald-500' }}">
                                                    {{ $bngLetter }}
                                                </span>

                                                <span class="text-xs sm:text-sm pt-0.5 leading-snug flex-1 text-slate-900 dark:text-slate-100">
                                                    {{ $opt->option_text }}
                                                </span>

                                                @if($isSelected && $isFinalized)
                                                    <i class="fa fa-lock text-emerald-600 dark:text-emerald-400 text-xs mt-1 shrink-0"></i>
                                                @endif
                                            </label>
                                        @endforeach
                                    </div>

                                <!-- TYPE 2: True / False (সত্য/মিথ্যা) -->
                                @elseif($qType === 'true_false')
                                    @php
                                        $currentTf = mb_strtolower(trim($savedTextAns), 'UTF-8');
                                        $isTrue = in_array($currentTf, ['true', '1', 'স', 'সত্য', 't']);
                                        $isFalse = in_array($currentTf, ['false', '0', 'মি', 'মিথ্যা', 'f']);
                                    @endphp
                                    <div class="flex flex-wrap items-center gap-3 pt-1">
                                        <button type="button" 
                                                onclick="handleTextAnswer({{ $q->id }}, 'সত্য', false)"
                                                {{ $isFinalized ? 'disabled' : '' }}
                                                class="px-5 py-2.5 rounded-xl border-2 font-bold text-xs font-serif transition-all flex items-center gap-2 {{ $isTrue ? 'bg-emerald-600 border-emerald-600 text-white shadow-md' : 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:border-emerald-500' }}">
                                            <i class="fa {{ $isTrue ? 'fa-check-circle' : 'fa-circle-o' }}"></i>
                                            <span>সত্য (স)</span>
                                        </button>
                                        <button type="button" 
                                                onclick="handleTextAnswer({{ $q->id }}, 'মিথ্যা', false)"
                                                {{ $isFinalized ? 'disabled' : '' }}
                                                class="px-5 py-2.5 rounded-xl border-2 font-bold text-xs font-serif transition-all flex items-center gap-2 {{ $isFalse ? 'bg-rose-600 border-rose-600 text-white shadow-md' : 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:border-rose-500' }}">
                                            <i class="fa {{ $isFalse ? 'fa-times-circle' : 'fa-circle-o' }}"></i>
                                            <span>মিথ্যা (মি)</span>
                                        </button>
                                    </div>

                                <!-- TYPE 3: Fill in the Blanks (সঠিক শব্দ দিয়ে শূন্যস্থান পূরণ) -->
                                @elseif(in_array($qType, ['fill_blanks', 'fill_in_the_blanks']))
                                    <div class="space-y-2 pt-1">
                                        @if(!empty($q->hints))
                                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-serif font-bold">
                                                <i class="fa fa-info-circle"></i>
                                                <span>সম্ভাব্য শব্দ / ক্লু: <strong>{{ $q->hints }}</strong></span>
                                            </div>
                                        @endif
                                        <div class="flex items-center gap-3 max-w-md">
                                            <input type="text" 
                                                   id="text-ans-{{ $q->id }}"
                                                   name="text_ans_{{ $q->id }}"
                                                   value="{{ $savedTextAns }}"
                                                   {{ $isFinalized ? 'disabled' : '' }}
                                                   onblur="handleTextAnswer({{ $q->id }}, this.value, false)"
                                                   placeholder="সঠিক শব্দ / উত্তরটি লিখুন..."
                                                   class="flex-1 px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-sm focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">
                                            @if(!$isFinalized)
                                                <button type="button" onclick="handleTextAnswer({{ $q->id }}, document.getElementById('text-ans-{{ $q->id }}').value, false)" class="px-4 py-2.5 rounded-xl bg-slate-900 dark:bg-slate-800 hover:bg-emerald-600 text-white text-xs font-bold transition-all">
                                                    সংরক্ষণ
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                <!-- TYPE 4: Creative Question (সৃজনশীল প্রশ্ন - CQ ক, খ, গ, ঘ) -->
                                @elseif(in_array($qType, ['creative', 'cq']))
                                    @php
                                        $subq = !empty($q->cq_subquestions) ? (is_array($q->cq_subquestions) ? $q->cq_subquestions : json_decode($q->cq_subquestions, true)) : [];
                                        if (empty($subq)) {
                                            $subq = [
                                                'ka' => ['label' => 'ক', 'text' => 'জ্ঞানমূলক প্রশ্ন', 'marks' => 1],
                                                'kha' => ['label' => 'খ', 'text' => 'অনুধাবনমূলক প্রশ্ন', 'marks' => 2],
                                                'ga' => ['label' => 'গ', 'text' => 'প্রয়োগমূলক প্রশ্ন', 'marks' => 3],
                                                'gha' => ['label' => 'ঘ', 'text' => 'উচ্চতর দক্ষতামূলক প্রশ্ন', 'marks' => 4],
                                            ];
                                        }
                                    @endphp
                                    <div class="space-y-4 pt-2">
                                        @foreach($subq as $subKey => $subData)
                                            @php
                                                $sLabel = isset($subData['label']) ? $subData['label'] : $subKey;
                                                $sText = isset($subData['text']) ? $subData['text'] : '';
                                                $sMarks = isset($subData['marks']) ? $subData['marks'] : 1;
                                                $sVal = isset($savedCqAns[$subKey]) ? $savedCqAns[$subKey] : '';
                                            @endphp
                                            <div class="p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 space-y-2">
                                                <div class="flex items-center justify-between text-xs font-serif font-bold">
                                                    <span class="text-slate-900 dark:text-white">
                                                        ({{ $sLabel }}) {{ $sText }}
                                                    </span>
                                                    <span class="px-2 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-mono text-[11px]">
                                                        মান: {{ $toBng($sMarks) }}
                                                    </span>
                                                </div>
                                                <textarea 
                                                    id="cq-ans-{{ $q->id }}-{{ $subKey }}"
                                                    name="cq_ans_{{ $q->id }}_{{ $subKey }}"
                                                    rows="2"
                                                    {{ $isFinalized ? 'disabled' : '' }}
                                                    onblur="handleCqAnswer({{ $q->id }}, '{{ $subKey }}', this.value)"
                                                    placeholder="({{ $sLabel }})-এর উত্তর লিখুন..."
                                                    class="w-full px-3.5 py-2 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-xs leading-relaxed focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">{{ $sVal }}</textarea>
                                            </div>
                                        @endforeach
                                    </div>

                                <!-- TYPE 5: Short Answer / Translation / Descriptive -->
                                @else
                                    <div class="space-y-2 pt-1">
                                        <textarea 
                                            id="text-ans-{{ $q->id }}"
                                            name="text_ans_{{ $q->id }}"
                                            rows="3"
                                            {{ $isFinalized ? 'disabled' : '' }}
                                            onblur="handleTextAnswer({{ $q->id }}, this.value, false)"
                                            placeholder="{{ $qType === 'translation' ? 'Translate into English...' : 'সংক্ষেপে আপনার সঠিক উত্তর লিখুন...' }}"
                                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-sm leading-relaxed focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">{{ $savedTextAns }}</textarea>
                                        @if(!$isFinalized)
                                            <div class="flex justify-end">
                                                <button type="button" onclick="handleTextAnswer({{ $q->id }}, document.getElementById('text-ans-{{ $q->id }}').value, false)" class="px-4 py-1.5 rounded-xl bg-slate-900 dark:bg-slate-800 hover:bg-emerald-600 text-white text-xs font-bold transition-all">
                                                    সংরক্ষণ
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <!-- Irreversible Locking Notice in All-Questions Mode -->
                                <div id="locked-notice-{{ $q->id }}" class="{{ $isFinalized ? 'flex' : 'hidden' }} items-center gap-1.5 pt-1.5 text-[11px] font-mono text-emerald-700 dark:text-emerald-400 font-semibold">
                                    <i class="fa fa-lock text-emerald-600"></i>
                                    <span>উত্তর সফলভাবে লক ও সংরক্ষিত হয়েছে। (পরিবর্তনযোগ্য নয়)</span>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <!-- Bottom of Paper -->
                    <div class="mt-8 pt-4 border-t border-slate-300 dark:border-slate-700 text-center text-xs font-serif text-slate-500 dark:text-slate-400">
                        [ প্রশ্নপত্র সমাপ্ত — সকল উত্তর সাবমিট করার পর ফলাফল প্রকাশিত হবে ]
                    </div>
                </div>
            </div>

            <!-- MODE B: ONE-BY-ONE VIEW (SINGLE QUESTION CARD WITH DRAFT & SUBMIT ANSWER) -->
            <div id="view-one-by-one" class="{{ $currentViewMode == 'one_by_one' ? 'block' : 'hidden' }} space-y-6">
                
                @foreach($questions as $index => $q)
                    @php
                        $savedAns = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
                        $savedOptionIds = $savedAns ? $savedAns->selected_option_ids_array : [];
                        $isFinalized = $savedAns ? (bool)$savedAns->is_finalized : false;
                        $isFlagged = in_array($q->id, $flaggedQuestionIds ?: []);
                        $hasDraft = !empty($savedOptionIds) && !$isFinalized;
                    @endphp

                    <div id="single-card-{{ $index }}" class="single-q-slide {{ $index === 0 ? 'block' : 'hidden' }} board-paper-card rounded-3xl bg-white dark:bg-slate-900 border-2 border-slate-300 dark:border-slate-800 p-6 sm:p-8 shadow-xl space-y-6">
                        
                        <!-- Top HUD for Single Card -->
                        <div class="flex items-center justify-between pb-3 border-b border-slate-200 dark:border-slate-800 text-xs font-mono">
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-slate-900 text-white dark:bg-emerald-500 dark:text-slate-950 font-bold">
                                    প্রশ্ন {{ $toBng($index + 1) }} / {{ $toBng($totalCount) }}
                                </span>
                                <span class="text-slate-500 dark:text-slate-400">
                                    সেট: {{ $bngSet }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2">
                                <button type="button" onclick="toggleFlagQuestion({{ $q->id }})" class="px-2.5 py-1 rounded-lg border text-xs font-sans transition-colors {{ $isFlagged ? 'bg-amber-100 dark:bg-amber-950/60 border-amber-400 text-amber-600' : 'border-slate-200 dark:border-slate-800 text-slate-400 hover:text-amber-500' }}">
                                    <i class="fa {{ $isFlagged ? 'fa-flag' : 'fa-flag-o' }} mr-1"></i>
                                    <span>{{ $isFlagged ? 'চিহ্নিত' : 'চিহ্নিত করুন' }}</span>
                                </button>
                                
                                <span id="single-lock-badge-{{ $q->id }}" class="px-2.5 py-1 rounded-full font-bold text-[11px] {{ $isFinalized ? 'bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 border border-emerald-300' : ($hasDraft ? 'bg-blue-100 dark:bg-blue-950/40 text-blue-600 border border-blue-300' : 'bg-slate-100 dark:bg-slate-800 text-slate-500') }}">
                                    <i class="fa {{ $isFinalized ? 'fa-lock' : ($hasDraft ? 'fa-pencil' : 'fa-circle-o') }} mr-1"></i>
                                    {{ $isFinalized ? 'লকড' : ($hasDraft ? 'ড্রাফট (অনিশ্চিত)' : 'অনুর্ত্তীর্ণ') }}
                                </span>
                            </div>
                        </div>

                        <!-- Stimulus Context (if present) -->
                        @if(!empty($q->stimulus))
                            <div class="p-4 rounded-2xl bg-slate-100 dark:bg-slate-950 border-l-4 border-emerald-600 text-xs text-slate-800 dark:text-slate-200 leading-relaxed font-serif">
                                <div class="font-bold text-[11px] uppercase tracking-wider text-emerald-700 dark:text-emerald-400 mb-1">
                                    নিচের উদ্দীপকটি পড়ুন :
                                </div>
                                {!! nl2br(e($q->stimulus)) !!}
                            </div>
                        @endif

                        <!-- Question Prompt -->
                        <div class="text-base sm:text-lg font-bold text-slate-950 dark:text-white leading-relaxed font-serif">
                            <span class="text-emerald-700 dark:text-emerald-400 mr-1">{{ $toBng($index + 1) }}।</span>
                            {!! nl2br(e($q->question_text)) !!}
                        </div>

                        <!-- TYPE 1: MCQ Options -->
                        @php
                            $qType = isset($q->question_type) ? $q->question_type : 'mcq';
                            $savedTextAns = $savedAns ? (string)$savedAns->text_answer : '';
                            $savedCqAns = $savedAns && $savedAns->cq_answers ? (is_array($savedAns->cq_answers) ? $savedAns->cq_answers : json_decode($savedAns->cq_answers, true)) : [];
                        @endphp
                        @if(in_array($qType, ['mcq', 'mcq_single', 'mcq_multi', 'multiple_choice']) || ($qType === 'true_false' && count($q->options) > 0))
                            <div class="space-y-3 pt-2">
                                @foreach($q->options as $optIdx => $opt)
                                    @php
                                        $isSelected = in_array($opt->id, $savedOptionIds);
                                        $bngLetter = \App\model\LmsQuestion::getBengaliOptionLetter($optIdx);
                                    @endphp

                                    <label id="single-opt-label-{{ $q->id }}-{{ $opt->id }}" class="flex items-start gap-3.5 p-4 rounded-2xl border-2 transition-all cursor-pointer select-none group {{ $isSelected ? ($isFinalized ? 'bg-emerald-50 dark:bg-emerald-950/40 border-emerald-500 font-bold' : 'bg-blue-50 dark:bg-blue-950/40 border-blue-500 font-bold') : ($isFinalized ? 'bg-slate-50 dark:bg-slate-950/30 border-slate-200 dark:border-slate-800/80 text-slate-400 cursor-not-allowed opacity-60' : 'bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 hover:border-blue-400 dark:hover:border-slate-700 text-slate-800 dark:text-slate-200') }}">
                                        
                                        <input 
                                            type="radio" 
                                            name="single_ans_{{ $q->id }}" 
                                            value="{{ $opt->id }}"
                                            {{ $isSelected ? 'checked' : '' }}
                                            {{ $isFinalized ? 'disabled' : '' }}
                                            onchange="handleSelectAnswer({{ $q->id }}, {{ $opt->id }}, 'one_by_one')"
                                            class="sr-only">

                                        <!-- High-Contrast Checkbox / Selection Box Indicator -->
                                        <span id="single-check-icon-{{ $q->id }}-{{ $opt->id }}" class="w-6 h-6 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 {{ $isSelected ? ($isFinalized ? 'bg-emerald-600 border-emerald-600 text-white shadow-sm ring-2 ring-emerald-500/30' : 'bg-blue-600 border-blue-600 text-white shadow-sm ring-2 ring-blue-500/30') : 'border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 text-transparent group-hover:border-blue-500' }}">
                                            <i class="fa fa-check text-xs font-bold"></i>
                                        </span>

                                        <!-- Bengali Option Letter Bubble -->
                                        <span id="single-bubble-{{ $q->id }}-{{ $opt->id }}" class="w-7 h-7 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold transition-all {{ $isSelected ? ($isFinalized ? 'bg-emerald-100 dark:bg-emerald-900/50 border-emerald-500 text-emerald-900 dark:text-emerald-200' : 'bg-blue-100 dark:bg-blue-900/50 border-blue-500 text-blue-900 dark:text-blue-200') : 'border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 group-hover:border-blue-500' }}">
                                            {{ $bngLetter }}
                                        </span>

                                        <span class="text-sm pt-0.5 leading-relaxed flex-1 text-slate-900 dark:text-slate-100">
                                            {{ $opt->option_text }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>

                        <!-- TYPE 2: True/False -->
                        @elseif($qType === 'true_false')
                            @php
                                $currentTf = mb_strtolower(trim($savedTextAns), 'UTF-8');
                                $isTrue = in_array($currentTf, ['true', '1', 'স', 'সত্য', 't']);
                                $isFalse = in_array($currentTf, ['false', '0', 'মি', 'মিথ্যা', 'f']);
                            @endphp
                            <div class="flex flex-wrap items-center gap-4 pt-3">
                                <button type="button" 
                                        onclick="handleTextAnswer({{ $q->id }}, 'সত্য', false)"
                                        {{ $isFinalized ? 'disabled' : '' }}
                                        class="flex-1 p-4 rounded-2xl border-2 font-bold text-sm font-serif transition-all flex items-center justify-center gap-2 {{ $isTrue ? 'bg-emerald-600 border-emerald-600 text-white shadow-lg' : 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:border-emerald-500' }}">
                                    <i class="fa {{ $isTrue ? 'fa-check-circle' : 'fa-circle-o' }} text-base"></i>
                                    <span>সত্য (স)</span>
                                </button>
                                <button type="button" 
                                        onclick="handleTextAnswer({{ $q->id }}, 'মিথ্যা', false)"
                                        {{ $isFinalized ? 'disabled' : '' }}
                                        class="flex-1 p-4 rounded-2xl border-2 font-bold text-sm font-serif transition-all flex items-center justify-center gap-2 {{ $isFalse ? 'bg-rose-600 border-rose-600 text-white shadow-lg' : 'border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 hover:border-rose-500' }}">
                                    <i class="fa {{ $isFalse ? 'fa-times-circle' : 'fa-circle-o' }} text-base"></i>
                                    <span>মিথ্যা (মি)</span>
                                </button>
                            </div>

                        <!-- TYPE 3: Fill in Blanks -->
                        @elseif(in_array($qType, ['fill_blanks', 'fill_in_the_blanks']))
                            <div class="space-y-3 pt-2">
                                @if(!empty($q->hints))
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-xs font-serif font-bold">
                                        <i class="fa fa-info-circle"></i>
                                        <span>ক্লু / সম্ভাব্য বিকল্প: <strong>{{ $q->hints }}</strong></span>
                                    </div>
                                @endif
                                <input type="text" 
                                       id="single-text-ans-{{ $q->id }}"
                                       value="{{ $savedTextAns }}"
                                       {{ $isFinalized ? 'disabled' : '' }}
                                       onblur="handleTextAnswer({{ $q->id }}, this.value, false)"
                                       placeholder="সঠিক শব্দ / উত্তরটি লিখুন..."
                                       class="w-full px-4 py-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-base focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">
                            </div>

                        <!-- TYPE 4: Creative Question (CQ) -->
                        @elseif(in_array($qType, ['creative', 'cq']))
                            @php
                                $subq = !empty($q->cq_subquestions) ? (is_array($q->cq_subquestions) ? $q->cq_subquestions : json_decode($q->cq_subquestions, true)) : [];
                                if (empty($subq)) {
                                    $subq = [
                                        'ka' => ['label' => 'ক', 'text' => 'জ্ঞানমূলক প্রশ্ন', 'marks' => 1],
                                        'kha' => ['label' => 'খ', 'text' => 'অনুধাবনমূলক প্রশ্ন', 'marks' => 2],
                                        'ga' => ['label' => 'গ', 'text' => 'প্রয়োগমূলক প্রশ্ন', 'marks' => 3],
                                        'gha' => ['label' => 'ঘ', 'text' => 'উচ্চতর দক্ষতামূলক প্রশ্ন', 'marks' => 4],
                                    ];
                                }
                            @endphp
                            <div class="space-y-4 pt-2">
                                @foreach($subq as $subKey => $subData)
                                    @php
                                        $sLabel = isset($subData['label']) ? $subData['label'] : $subKey;
                                        $sText = isset($subData['text']) ? $subData['text'] : '';
                                        $sMarks = isset($subData['marks']) ? $subData['marks'] : 1;
                                        $sVal = isset($savedCqAns[$subKey]) ? $savedCqAns[$subKey] : '';
                                    @endphp
                                    <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-950/60 border border-slate-200 dark:border-slate-800 space-y-2">
                                        <div class="flex items-center justify-between text-xs font-serif font-bold">
                                            <span class="text-slate-900 dark:text-white font-bold">({{ $sLabel }}) {{ $sText }}</span>
                                            <span class="px-2 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 font-mono text-[11px]">মান: {{ $toBng($sMarks) }}</span>
                                        </div>
                                        <textarea 
                                            rows="2"
                                            {{ $isFinalized ? 'disabled' : '' }}
                                            onblur="handleCqAnswer({{ $q->id }}, '{{ $subKey }}', this.value)"
                                            placeholder="({{ $sLabel }})-এর উত্তর লিখুন..."
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-xs leading-relaxed focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">{{ $sVal }}</textarea>
                                    </div>
                                @endforeach
                            </div>

                        <!-- TYPE 5: Short Answer / Translation / Descriptive -->
                        @else
                            <div class="space-y-2 pt-2">
                                <textarea 
                                    id="single-text-ans-{{ $q->id }}"
                                    rows="4"
                                    {{ $isFinalized ? 'disabled' : '' }}
                                    onblur="handleTextAnswer({{ $q->id }}, this.value, false)"
                                    placeholder="{{ $qType === 'translation' ? 'Translate into English...' : 'সংক্ষেপে আপনার সঠিক উত্তর লিখুন...' }}"
                                    class="w-full px-4 py-3 rounded-2xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-serif text-sm leading-relaxed focus:ring-2 focus:ring-emerald-500 {{ $isFinalized ? 'bg-slate-100 dark:bg-slate-800 cursor-not-allowed' : '' }}">{{ $savedTextAns }}</textarea>
                            </div>
                        @endif

                        <!-- Single Card Action Bar -->
                        <div class="pt-5 border-t border-slate-200 dark:border-slate-800 flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <button type="button" onclick="navigateSingle({{ $index - 1 }})" {{ $index === 0 ? 'disabled' : '' }} class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 font-semibold text-xs transition-colors {{ $index === 0 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200' }}">
                                    &larr; পূর্ববর্তী প্রশ্ন
                                </button>
                                <button type="button" onclick="navigateSingle({{ $index + 1 }})" {{ $index === $totalCount - 1 ? 'disabled' : '' }} class="px-4 py-2 rounded-xl border border-slate-300 dark:border-slate-700 font-semibold text-xs transition-colors {{ $index === $totalCount - 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200' }}">
                                    পরবর্তী প্রশ্ন &rarr;
                                </button>
                            </div>

                            <!-- Submit Single Question Answer (Finalizes & Locks) -->
                            <div>
                                @if($isFinalized)
                                    <div class="text-xs font-mono text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1.5">
                                        <i class="fa fa-lock"></i>
                                        <span>উত্তর লকড করা হয়েছে</span>
                                    </div>
                                @else
                                    <button type="button" id="btn-submit-single-{{ $q->id }}" onclick="finalizeSingleAnswer({{ $q->id }})" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                        <i class="fa fa-check"></i>
                                        <span>উত্তর নিশ্চিত ও লক করুন</span>
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>

        <!-- ========================================================================= -->
        <!-- Right: Question Palette & Real-Time Stats (4 cols) -->
        <!-- ========================================================================= -->
        <div class="lg:col-span-4 space-y-4">
            
            <div class="student-card rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 backdrop-blur-xl shadow-xl sticky top-36 space-y-5">
                
                <!-- Palette Header & Stats -->
                <div>
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white flex items-center justify-between">
                        <span>প্রশ্ন নেভিগেশন প্যালেট</span>
                        <span id="answered-counter-badge" class="text-xs font-mono text-emerald-600 dark:text-emerald-400 font-bold">
                            {{ $toBng($answeredCount) }} / {{ $toBng($totalCount) }} সম্পন্ন
                        </span>
                    </h3>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">যেকোনো নম্বরে ক্লিক করে সরাসরি সেই প্রশ্নে চলে যান।</p>
                </div>

                <!-- Palette Metric Badges -->
                <div class="grid grid-cols-3 gap-2 text-center text-xs font-mono">
                    <div class="p-2 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block">লকড / সম্পন্ন</span>
                        <span id="stat-answered" class="text-sm font-bold text-emerald-600 dark:text-emerald-400">{{ $answeredCount }}</span>
                    </div>
                    <div class="p-2 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block">অনুর্ত্তীর্ণ</span>
                        <span id="stat-unanswered" class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $unansweredCount }}</span>
                    </div>
                    <div class="p-2 rounded-xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/40">
                        <span class="text-[10px] text-slate-500 dark:text-slate-400 block">চিহ্নিত (Flag)</span>
                        <span id="stat-flagged" class="text-sm font-bold text-amber-600 dark:text-amber-400">{{ $flaggedCount }}</span>
                    </div>
                </div>

                <!-- Palette Numbers Grid -->
                <div class="grid grid-cols-5 gap-2 font-mono text-xs max-h-72 overflow-y-auto p-1">
                    @foreach($questions as $idx => $q)
                        @php
                            $savedAns = isset($existingAnswers[$q->id]) ? $existingAnswers[$q->id] : null;
                            $hasAnswer = $savedAns && (!empty($savedAns->selected_option_ids_array) || !empty($savedAns->text_answer) || !empty($savedAns->cq_answers));
                            $isFinalized = $savedAns && $savedAns->is_finalized;
                            $isFlagged = in_array($q->id, $flaggedQuestionIds ?: []);

                            $btnClass = 'bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-600 dark:text-slate-400 hover:border-slate-500';
                            if ($isFinalized) {
                                $btnClass = 'bg-emerald-600 text-white font-bold shadow-sm';
                            } elseif ($hasAnswer) {
                                $btnClass = 'bg-blue-600 text-white font-bold';
                            }
                        @endphp
                        <button 
                            type="button"
                            onclick="jumpToQuestion({{ $idx }}, {{ $q->id }})" 
                            id="pal-btn-{{ $q->id }}"
                            class="h-9 rounded-xl flex items-center justify-center font-bold transition-all relative {{ $btnClass }}">
                            <span>{{ $idx + 1 }}</span>
                            @if($isFlagged)
                                <span id="pal-flag-dot-{{ $q->id }}" class="w-2 h-2 rounded-full bg-amber-400 absolute top-1 right-1"></span>
                            @else
                                <span id="pal-flag-dot-{{ $q->id }}" class="hidden w-2 h-2 rounded-full bg-amber-400 absolute top-1 right-1"></span>
                            @endif
                        </button>
                    @endforeach
                </div>

                <!-- Legend -->
                <div class="pt-3 border-t border-slate-200 dark:border-slate-800/80 space-y-2 text-[11px] font-mono text-slate-600 dark:text-slate-400">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-600"></span>
                            <span>লকড উত্তর</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-blue-600"></span>
                            <span>ড্রাফট পছন্দ</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-slate-300 dark:bg-slate-800 border"></span>
                            <span>অনুর্ত্তীর্ণ</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                            <span>রিভিউ চিহ্নিত</span>
                        </div>
                    </div>
                </div>

                <!-- Complete & Submit Action in Sidebar -->
                <div class="pt-3 border-t border-slate-200 dark:border-slate-800/80">
                    <button type="button" id="btn-submit-exam-palette" onclick="confirmSubmitExam()" class="w-full py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-wider transition-all shadow-lg flex items-center justify-center gap-2 active:scale-95 cursor-pointer select-none">
                        <i class="fa fa-flag-checkered text-sm"></i>
                        <span>পরীক্ষা সমাপ্ত ও জমা দিন</span>
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- Hidden Form for Final Submission -->
    <form id="final-submit-form" action="{{ route('student.quiz.submit', $attempt->id) }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="time_spent_seconds" id="input-final-time-spent" value="{{ $attempt->time_spent_seconds }}">
    </form>

</div>

<!-- Submission Confirmation Modal -->
<div id="submit-modal" style="display: none; z-index: 999999;" class="fixed inset-0 bg-slate-950/85 backdrop-blur-md items-center justify-center p-4">
    <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 text-center">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 flex items-center justify-center mx-auto text-2xl">
            <i class="fa fa-question-circle"></i>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-950 dark:text-white">আপনি কি পরীক্ষা সমাপ্ত করতে প্রস্তুত?</h3>
            <div id="modal-summary-box" class="p-3 my-3 rounded-xl bg-slate-100 dark:bg-slate-950 font-mono text-xs text-slate-700 dark:text-slate-300 space-y-1 text-left">
                <!-- Dynamically populated -->
            </div>
            <p class="text-xs text-rose-600 dark:text-rose-400 leading-relaxed font-semibold">
                সতর্কতা: একবার জমা দিলে আপনার উত্তরপত্র স্বয়ংক্রিয়ভাবে মূল্যায়িত হবে এবং পুনরায় পরীক্ষা দেওয়া যাবে না।
            </p>
        </div>
        <div class="flex items-center justify-center gap-3 pt-2">
            <button type="button" onclick="closeSubmitModal()" class="px-5 py-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-semibold text-xs transition-colors">
                পরীক্ষায় ফিরে যান
            </button>
            <button type="button" id="btn-final-confirm-submit" onclick="executeFinalSubmit()" class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md cursor-pointer">
                হ্যাঁ, নিশ্চিতভাবে জমা দিন
            </button>
        </div>
    </div>
</div>

<!-- Strict Anti-Cheating & Exam Security Floating Toaster -->
<div id="security-warning-toast" class="fixed top-20 right-4 sm:right-6 z-50 max-w-md w-full pointer-events-none transition-all duration-300 transform -translate-y-4 opacity-0">
    <div id="sec-toast-card" class="pointer-events-auto rounded-2xl bg-slate-900/95 dark:bg-white/95 text-white dark:text-slate-900 p-4 shadow-2xl border-2 border-amber-400 dark:border-amber-500 backdrop-blur-xl flex items-start gap-3">
        <!-- Toast Icon -->
        <div id="sec-toast-icon-wrap" class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 dark:text-amber-600 flex items-center justify-center shrink-0 text-lg">
            <i id="sec-toast-icon" class="fa fa-exclamation-triangle"></i>
        </div>
        <!-- Toast Content -->
        <div class="flex-grow min-w-0">
            <div class="flex items-center justify-between gap-2 mb-1">
                <span id="sec-toast-badge" class="px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-950 font-bold">
                    সতর্কবার্তা ১
                </span>
                <span class="text-[10px] font-mono text-slate-400 dark:text-slate-500" id="sec-toast-time"></span>
            </div>
            <h4 id="sec-toast-title" class="text-xs sm:text-sm font-bold leading-snug">
                অনাকাঙ্ক্ষিত নিরাপত্তা কার্যকলাপ সনাক্ত হয়েছে!
            </h4>
            <p id="sec-toast-desc" class="text-[11px] text-slate-300 dark:text-slate-600 mt-0.5 leading-normal">
                ট্যাব পরিবর্তন বা কপি করার চেষ্টা রেকর্ড করা হয়েছে।
            </p>
        </div>
        <!-- Close Button -->
        <button type="button" onclick="hideSecurityToast()" class="text-slate-400 hover:text-white dark:hover:text-slate-900 text-xs p-1 rounded-lg">
            <i class="fa fa-times"></i>
        </button>
    </div>
</div>

<!-- Exam Controller Script -->
<script>
    // Immediate check if exam attempt was already completed (prevents Back button timer restart)
    if (window.sessionStorage && window.sessionStorage.getItem('exam_completed_{{ $attempt->id }}') === '1') {
        window.location.replace("{{ route('student.quiz.results', $attempt->id) }}");
    }

    window.addEventListener('pageshow', function (event) {
        if (event.persisted || (window.performance && window.performance.navigation && window.performance.navigation.type === 2)) {
            window.location.replace("{{ route('student.quiz.results', $attempt->id) }}");
        }
    });

    var remainingSeconds = {{ $secondsRemaining }};
    var timerElement = document.getElementById('exam-timer');
    var timerBox = document.getElementById('timer-box');
    var alertBanner = document.getElementById('time-alert-banner');
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var saveUrl = "{{ route('student.quiz.save-answer', $attempt->id) }}";
    var flagUrl = "{{ route('student.quiz.toggle-flag', $attempt->id) }}";
    var switchModeUrl = "{{ route('student.quiz.switch-view-mode', $attempt->id) }}";
    var totalQuestions = {{ $totalCount }};
    var secondsElapsed = {{ $attempt->time_spent_seconds ?: 0 }};
    var activeViewMode = "{{ $currentViewMode }}";
    var activeSingleIndex = 0;
    var draftSelections = {}; // question_id -> option_id for draft states

    // 1. Authoritative Server Timer with Audio/Visual alerts
    var alerted10m = false;
    var alerted5m = false;
    var alerted1m = false;
    var alerted10s = false;

    function updateTimer() {
        if (remainingSeconds <= 0) {
            timerElement.innerText = "০০:০০";
            timerBox.className = "px-3.5 py-1.5 rounded-xl bg-rose-500/20 border border-rose-500 text-rose-500 font-mono text-sm sm:text-base font-black flex items-center gap-2";
            executeFinalSubmit();
            return;
        }

        var hours = Math.floor(remainingSeconds / 3600);
        var minutes = Math.floor((remainingSeconds % 3600) / 60);
        var seconds = remainingSeconds % 60;

        var display = (hours > 0 ? (hours < 10 ? "0" + hours : hours) + ":" : "") + 
                      (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                      (seconds < 10 ? "0" + seconds : seconds);

        // Convert to Bengali digits for display
        var bngDigits = {'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯',':':':'};
        var bngDisplay = display.split('').map(function(c) { return bngDigits[c] || c; }).join('');
        timerElement.innerText = bngDisplay;

        // Threshold alerts (10m, 5m, 1m, 10s)
        if (remainingSeconds <= 600 && remainingSeconds > 300 && !alerted10m) {
            alerted10m = true;
            showAlertToast("সতর্কতা: পরীক্ষার সময় ১০ মিনিট বাকি রয়েছে।", "amber");
        } else if (remainingSeconds <= 300 && remainingSeconds > 60 && !alerted5m) {
            alerted5m = true;
            timerBox.className = "px-3.5 py-1.5 rounded-xl bg-amber-500/20 border border-amber-500 text-amber-600 dark:text-amber-400 font-mono text-sm sm:text-base font-black flex items-center gap-2 animate-pulse";
            showAlertToast("জরুরি: পরীক্ষার আর মাত্র ৫ মিনিট বাকি রয়েছে!", "amber");
        } else if (remainingSeconds <= 60 && remainingSeconds > 10 && !alerted1m) {
            alerted1m = true;
            timerBox.className = "px-3.5 py-1.5 rounded-xl bg-rose-500/20 border border-rose-500 text-rose-600 dark:text-rose-400 font-mono text-sm sm:text-base font-black flex items-center gap-2 animate-pulse";
            showAlertToast("সতর্কতা: আর মাত্র ১ মিনিট বাকি! সময় শেষ হলে পরীক্ষা স্বয়ংক্রিয়ভাবে জমা হবে।", "rose");
        } else if (remainingSeconds <= 10 && !alerted10s) {
            alerted10s = true;
            showAlertToast("চূড়ান্ত সতর্কতা: শেষ ১০ সেকেন্ড!", "rose");
        }

        remainingSeconds--;
        secondsElapsed++;
        document.getElementById('input-final-time-spent').value = secondsElapsed;
    }

    function showAlertToast(msg, color) {
        if (!alertBanner) return;
        alertBanner.innerText = msg;
        alertBanner.className = "rounded-2xl p-3 text-xs font-bold text-center transition-all animate-bounce " + 
            (color === 'rose' ? 'bg-rose-500 text-white' : 'bg-amber-500 text-slate-950');
        alertBanner.classList.remove('hidden');
        setTimeout(function() {
            alertBanner.classList.add('hidden');
        }, 7000);
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // 2. Select Option Handler
    // In ALL QUESTIONS VIEW: immediately finalizes and locks the question!
    // In ONE-BY-ONE VIEW: sets draft state; button finalizes and locks.
    // 2. Select Option Handler
    // In ALL QUESTIONS VIEW: immediately finalizes and locks the question!
    // In ONE-BY-ONE VIEW: sets draft state; button finalizes and locks.
    function handleSelectAnswer(questionId, optionId, viewMode) {
        draftSelections[questionId] = optionId;

        if (viewMode === 'all_questions') {
            // Immediate lock and finalize!
            lockAndSaveAnswer(questionId, optionId, true, 'all_questions');
        } else {
            // One-by-One mode: mark as draft
            var palBtn = document.getElementById('pal-btn-' + questionId);
            if (palBtn && !palBtn.classList.contains('bg-emerald-600')) {
                palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-blue-600 text-white shadow-sm relative";
            }
            var singleBadge = document.getElementById('single-lock-badge-' + questionId);
            if (singleBadge) {
                singleBadge.innerHTML = '<i class="fa fa-pencil mr-1"></i> ড্রাফট (অনিশ্চিত)';
                singleBadge.className = "px-2.5 py-1 rounded-full font-bold text-[11px] bg-blue-100 dark:bg-blue-950/40 text-blue-600 border border-blue-300";
            }
            // Update labels styling in single view
            updateSingleViewStyles(questionId, optionId, false);
            // Autosave as draft
            lockAndSaveAnswer(questionId, optionId, false, 'one_by_one');
        }
    }

    function finalizeSingleAnswer(questionId) {
        var optId = draftSelections[questionId];
        if (!optId) {
            // Try to find checked input in single card
            var checked = document.querySelector('input[name="single_ans_' + questionId + '"]:checked');
            if (checked) {
                optId = checked.value;
            }
        }

        if (!optId) {
            showAlertToast("অনুগ্রহ করে উত্তর নিশ্চিত করার আগে একটি অপশন নির্বাচন করুন।", "amber");
            return;
        }

        var btn = document.getElementById('btn-submit-single-' + questionId);
        if (btn) {
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> নিশ্চিত হচ্ছে...';
            btn.disabled = true;
        }

        lockAndSaveAnswer(questionId, optId, true, 'one_by_one');
    }

    var cqAnswersState = {}; // question_id -> { subKey: textVal }

    function handleTextAnswer(questionId, textVal, shouldFinalize) {
        textVal = (textVal || '').trim();
        var palBtn = document.getElementById('pal-btn-' + questionId);
        if (textVal !== '') {
            if (palBtn && !palBtn.classList.contains('bg-emerald-600')) {
                palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-blue-600 text-white shadow-sm relative";
            }
        }
        updateCounters();

        var autoStatus = document.getElementById('autosave-status');
        if (autoStatus) autoStatus.innerHTML = '<i class="fa fa-spinner fa-spin text-[10px]"></i> সংরক্ষণ হচ্ছে...';

        fetch(saveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                question_id: questionId,
                text_answer: textVal,
                action: shouldFinalize ? 'finalize' : 'save',
                finalize: shouldFinalize,
                view_mode: activeViewMode,
                time_spent_seconds: secondsElapsed
            })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'success') {
                if (autoStatus) autoStatus.innerHTML = '<i class="fa fa-lock text-[10px]"></i> উত্তর সংরক্ষিত';
                if (data.is_finalized) {
                    if (palBtn) palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-emerald-600 text-white shadow-sm relative";
                }
                updateCounters();
            }
        })
        .catch(function(err) {
            console.error('Save text answer error:', err);
        });
    }

    function handleCqAnswer(questionId, subKey, textVal) {
        if (!cqAnswersState[questionId]) {
            cqAnswersState[questionId] = {};
        }
        cqAnswersState[questionId][subKey] = textVal;

        var palBtn = document.getElementById('pal-btn-' + questionId);
        if (palBtn && !palBtn.classList.contains('bg-emerald-600')) {
            palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-blue-600 text-white shadow-sm relative";
        }
        updateCounters();

        var autoStatus = document.getElementById('autosave-status');
        if (autoStatus) autoStatus.innerHTML = '<i class="fa fa-spinner fa-spin text-[10px]"></i> সংরক্ষণ হচ্ছে...';

        fetch(saveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                question_id: questionId,
                cq_answers: cqAnswersState[questionId],
                action: 'save',
                finalize: false,
                view_mode: activeViewMode,
                time_spent_seconds: secondsElapsed
            })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'success') {
                if (autoStatus) autoStatus.innerHTML = '<i class="fa fa-lock text-[10px]"></i> সৃজনশীল উত্তর সংরক্ষিত';
                updateCounters();
            }
        })
        .catch(function(err) {
            console.error('Save CQ answer error:', err);
        });
    }

    function lockAndSaveAnswer(questionId, optionId, shouldFinalize, mode) {
        mode = mode || activeViewMode;
        var autoStatus = document.getElementById('autosave-status');
        if (autoStatus) {
            autoStatus.innerHTML = '<i class="fa fa-spinner fa-spin text-[10px]"></i> সংরক্ষণ হচ্ছে...';
        }

        fetch(saveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                question_id: questionId,
                selected_option_ids: [parseInt(optionId)],
                action: shouldFinalize ? 'finalize' : 'save',
                finalize: shouldFinalize,
                view_mode: mode,
                time_spent_seconds: secondsElapsed
            })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'success') {
                if (autoStatus) {
                    autoStatus.innerHTML = '<i class="fa fa-lock text-[10px]"></i> উত্তর সুরক্ষিত';
                }

                if (data.is_finalized) {
                    // Lock options in both views
                    applyLockToQuestion(questionId, optionId);
                }
                updateCounters();
            } else if (data.code === 'LOCKED') {
                showAlertToast(data.message || 'এই প্রশ্নের উত্তর ইতিমধ্যে লক করা হয়েছে।', "amber");
                applyLockToQuestion(questionId, optionId);
            } else if (data.code === 'EXPIRED') {
                alert('সময় শেষ! পরীক্ষা সমাপ্ত করা হচ্ছে।');
                executeFinalSubmit();
            }
        })
        .catch(function(err) {
            console.error('Save answer error:', err);
            var conn = document.getElementById('connection-status');
            if (conn) {
                conn.innerHTML = '<i class="fa fa-exclamation-triangle text-[8px]"></i> পুনঃসংযোগ হচ্ছে...';
                conn.className = "text-amber-500 font-semibold flex items-center gap-1";
            }
        });
    }

    function applyLockToQuestion(questionId, selectedOptionId) {
        // 1. In ALL QUESTIONS VIEW: Lock inputs & update OMR bubble & check-icon
        var allInputs = document.querySelectorAll('input[name="q_ans_' + questionId + '"]');
        allInputs.forEach(function(inp) {
            inp.disabled = true;
            var lbl = document.getElementById('opt-label-' + questionId + '-' + inp.value);
            var chk = document.getElementById('check-icon-' + questionId + '-' + inp.value);
            var bubble = document.getElementById('bubble-' + questionId + '-' + inp.value);
            if (lbl) {
                if (parseInt(inp.value) === parseInt(selectedOptionId)) {
                    lbl.className = "flex items-start gap-2.5 p-2.5 rounded-xl border-2 transition-all cursor-not-allowed select-none bg-emerald-50 dark:bg-emerald-950/30 border-emerald-500 text-slate-900 dark:text-emerald-200 font-bold shadow-sm";
                    if (chk) {
                        chk.className = "w-5 h-5 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 bg-emerald-600 border-emerald-600 text-white shadow-sm ring-2 ring-emerald-500/30";
                    }
                    if (bubble) {
                        bubble.className = "w-6 h-6 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold border-emerald-600 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-900 dark:text-emerald-200";
                    }
                } else {
                    lbl.className = "flex items-start gap-2.5 p-2.5 rounded-xl border-2 transition-all select-none bg-slate-50 dark:bg-slate-950/40 border-slate-200 dark:border-slate-800/80 text-slate-400 dark:text-slate-500 cursor-not-allowed opacity-60";
                    if (chk) {
                        chk.className = "w-5 h-5 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-900 text-transparent";
                    }
                }
            }
        });

        // Reveal locked notification in all questions view
        var lockedNotice = document.getElementById('locked-notice-' + questionId);
        if (lockedNotice) {
            lockedNotice.classList.remove('hidden');
            lockedNotice.classList.add('flex');
        }

        // 2. In ONE-BY-ONE VIEW: Lock inputs & check-icon
        var singleInputs = document.querySelectorAll('input[name="single_ans_' + questionId + '"]');
        singleInputs.forEach(function(inp) {
            inp.disabled = true;
            var lbl = document.getElementById('single-opt-label-' + questionId + '-' + inp.value);
            var chk = document.getElementById('single-check-icon-' + questionId + '-' + inp.value);
            var b = document.getElementById('single-bubble-' + questionId + '-' + inp.value);
            if (lbl) {
                if (parseInt(inp.value) === parseInt(selectedOptionId)) {
                    lbl.className = "flex items-start gap-3.5 p-4 rounded-2xl border-2 transition-all cursor-not-allowed select-none bg-emerald-50 dark:bg-emerald-950/40 border-emerald-500 font-bold";
                    if (chk) {
                        chk.className = "w-6 h-6 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 bg-emerald-600 border-emerald-600 text-white shadow-sm ring-2 ring-emerald-500/30";
                    }
                    if (b) {
                        b.className = "w-7 h-7 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold bg-emerald-100 dark:bg-emerald-900/50 border-emerald-500 text-emerald-900 dark:text-emerald-200";
                    }
                } else {
                    lbl.className = "flex items-start gap-3.5 p-4 rounded-2xl border-2 transition-all select-none bg-slate-50 dark:bg-slate-950/30 border-slate-200 dark:border-slate-800/80 text-slate-400 cursor-not-allowed opacity-60";
                    if (chk) {
                        chk.className = "w-6 h-6 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-900 text-transparent";
                    }
                }
            }
        });

        var singleBadge = document.getElementById('single-lock-badge-' + questionId);
        if (singleBadge) {
            singleBadge.innerHTML = '<i class="fa fa-lock mr-1"></i> লকড';
            singleBadge.className = "px-2.5 py-1 rounded-full font-bold text-[11px] bg-emerald-100 dark:bg-emerald-950/40 text-emerald-600 border border-emerald-300";
        }

        var singleBtn = document.getElementById('btn-submit-single-' + questionId);
        if (singleBtn) {
            singleBtn.parentElement.innerHTML = '<div class="text-xs font-mono text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1.5"><i class="fa fa-lock"></i><span>উত্তর লকড করা হয়েছে</span></div>';
        }

        // 3. Update Palette Button to Green (Locked)
        var palBtn = document.getElementById('pal-btn-' + questionId);
        if (palBtn) {
            palBtn.className = "h-9 rounded-xl flex items-center justify-center font-bold transition-all bg-emerald-600 text-white shadow-sm relative";
        }
    }

    // Dynamic Network Status Listeners
    window.addEventListener('online', function() {
        var conn = document.getElementById('connection-status');
        if (conn) {
            conn.innerHTML = '<i class="fa fa-circle text-[8px]"></i> অনলাইন (সংযুক্ত)';
            conn.className = "text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1";
        }
    });

    window.addEventListener('offline', function() {
        var conn = document.getElementById('connection-status');
        if (conn) {
            conn.innerHTML = '<i class="fa fa-exclamation-triangle text-[8px]"></i> অফলাইন (সংযোগ বিচ্ছিন্ন)';
            conn.className = "text-rose-500 font-semibold flex items-center gap-1";
        }
    });

    function updateSingleViewStyles(questionId, selectedOptionId, isFinalized) {
        var singleInputs = document.querySelectorAll('input[name="single_ans_' + questionId + '"]');
        singleInputs.forEach(function(inp) {
            var lbl = document.getElementById('single-opt-label-' + questionId + '-' + inp.value);
            var chk = document.getElementById('single-check-icon-' + questionId + '-' + inp.value);
            var b = document.getElementById('single-bubble-' + questionId + '-' + inp.value);
            if (lbl && b) {
                if (parseInt(inp.value) === parseInt(selectedOptionId)) {
                    lbl.className = "flex items-start gap-3.5 p-4 rounded-2xl border-2 transition-all cursor-pointer select-none bg-blue-50 dark:bg-blue-950/40 border-blue-500 font-bold";
                    if (chk) chk.className = "w-6 h-6 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 bg-blue-600 border-blue-600 text-white shadow-sm ring-2 ring-blue-500/30";
                    if (b) b.className = "w-7 h-7 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold bg-blue-100 dark:bg-blue-900/50 border-blue-500 text-blue-900 dark:text-blue-200";
                } else {
                    lbl.className = "flex items-start gap-3.5 p-4 rounded-2xl border-2 transition-all cursor-pointer select-none bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 hover:border-blue-400 text-slate-800 dark:text-slate-200";
                    if (chk) chk.className = "w-6 h-6 rounded-md border-2 flex items-center justify-center shrink-0 text-xs transition-all mt-0.5 border-slate-400 dark:border-slate-500 bg-white dark:bg-slate-800 text-transparent";
                    if (b) b.className = "w-7 h-7 rounded-full border flex items-center justify-center shrink-0 font-serif text-xs font-bold border-slate-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300";
                }
            }
        });
    }

    // 3. Question Flagging / Bookmarking
    function toggleFlagQuestion(questionId) {
        fetch(flagUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ question_id: questionId })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'success') {
                var flagDot = document.getElementById('pal-flag-dot-' + questionId);
                var flagIcon = document.getElementById('flag-icon-' + questionId);
                if (data.is_flagged) {
                    if (flagDot) flagDot.classList.remove('hidden');
                    if (flagIcon) {
                        flagIcon.className = "fa fa-flag text-amber-500";
                    }
                } else {
                    if (flagDot) flagDot.classList.add('hidden');
                    if (flagIcon) {
                        flagIcon.className = "fa fa-flag-o";
                    }
                }
                var statFlag = document.getElementById('stat-flagged');
                if (statFlag) statFlag.innerText = data.flagged_count;
            }
        });
    }

    // 4. View Mode Switcher
    function switchViewMode(mode) {
        activeViewMode = mode;
        var allDiv = document.getElementById('view-all-questions');
        var singleDiv = document.getElementById('view-one-by-one');
        var btnAll = document.getElementById('btn-mode-all');
        var btnSingle = document.getElementById('btn-mode-single');

        if (mode === 'all_questions') {
            allDiv.classList.remove('hidden');
            singleDiv.classList.add('hidden');
            btnAll.className = "px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm font-bold";
            btnSingle.className = "px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200";
        } else {
            allDiv.classList.add('hidden');
            singleDiv.classList.remove('hidden');
            btnSingle.className = "px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm font-bold";
            btnAll.className = "px-2.5 sm:px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200";
            navigateSingle(activeSingleIndex);
        }

        // Notify server of view mode preference
        fetch(switchModeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ view_mode: mode })
        });
    }

    // 5. Single Question Navigation
    function navigateSingle(index) {
        if (index < 0 || index >= totalQuestions) return;
        activeSingleIndex = index;

        var slides = document.querySelectorAll('.single-q-slide');
        slides.forEach(function(s, i) {
            if (i === index) {
                s.classList.remove('hidden');
                s.classList.add('block');
            } else {
                s.classList.add('hidden');
                s.classList.remove('block');
            }
        });
    }

    // Jump from Palette
    function jumpToQuestion(index, questionId) {
        if (activeViewMode === 'one_by_one') {
            navigateSingle(index);
        } else {
            var el = document.getElementById('q-item-' + questionId);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    }

    // 6. Counters Updater
    function updateCounters() {
        var btns = document.querySelectorAll('[id^="pal-btn-"]');
        var answered = Array.from(btns).filter(function(b) {
            return b.classList.contains('bg-emerald-600') || b.classList.contains('bg-blue-600');
        }).length;
        var unanswered = totalQuestions - answered;

        var statAns = document.getElementById('stat-answered');
        var statUnans = document.getElementById('stat-unanswered');
        var badge = document.getElementById('answered-counter-badge');

        if (statAns) statAns.innerText = answered;
        if (statUnans) statUnans.innerText = unanswered;
        if (badge) badge.innerText = toBengaliDigits(answered) + " / " + toBengaliDigits(totalQuestions) + " সম্পন্ন";
    }

    function toBengaliDigits(num) {
        var b = {'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};
        return String(num).split('').map(function(c) { return b[c] || c; }).join('');
    }

    // 7. Fullscreen Toggle
    function toggleFullScreen() {
        var icon = document.getElementById('fullscreen-icon');
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(function(err) {});
            if (icon) icon.className = "fa fa-compress";
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
                if (icon) icon.className = "fa fa-arrows-alt";
            }
        }
    }

    // 8. Submission Modal
    function confirmSubmitExam() {
        try {
            var btns = document.querySelectorAll('[id^="pal-btn-"]');
            var lockedCount = 0;
            var draftCount = 0;
            if (btns && btns.length) {
                for (var i = 0; i < btns.length; i++) {
                    var b = btns[i];
                    if (b.classList.contains('bg-emerald-600')) lockedCount++;
                    else if (b.classList.contains('bg-blue-600')) draftCount++;
                }
            }
            var answeredTotal = lockedCount + draftCount;
            var totQ = typeof totalQuestions !== 'undefined' ? totalQuestions : (btns ? btns.length : 0);
            var unans = Math.max(0, totQ - answeredTotal);

            var box = document.getElementById('modal-summary-box');
            if (box) {
                box.innerHTML = 
                    '<div class="flex justify-between py-1 border-b border-slate-200 dark:border-slate-800"><span>মোট প্রশ্ন:</span><strong class="text-slate-900 dark:text-white">' + toBengaliDigits(totQ) + ' টি</strong></div>' +
                    '<div class="flex justify-between py-1 border-b border-slate-200 dark:border-slate-800 text-emerald-600"><span>উত্তর নিশ্চিত/লকড:</span><strong>' + toBengaliDigits(lockedCount) + ' টি</strong></div>' +
                    (draftCount > 0 ? '<div class="flex justify-between py-1 border-b border-slate-200 dark:border-slate-800 text-blue-600"><span>ড্রাফট (জমা দিলে নিশ্চিত হবে):</span><strong>' + toBengaliDigits(draftCount) + ' টি</strong></div>' : '') +
                    '<div class="flex justify-between py-1 text-rose-500 font-bold"><span>উত্তর বাকি (অনুর্ত্তীর্ণ):</span><strong>' + toBengaliDigits(unans) + ' টি</strong></div>';
            }
        } catch (err) {
            console.error('Submit modal count summary calculation error:', err);
        }

        var modal = document.getElementById('submit-modal');
        if (modal) {
            modal.style.setProperty('display', 'flex', 'important');
            modal.style.setProperty('z-index', '999999', 'important');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            if (confirm('আপনি কি নিশ্চিতভাবে এই পরীক্ষাটি জমা দিতে চান?')) {
                executeFinalSubmit();
            }
        }
    }

    function closeSubmitModal() {
        var modal = document.getElementById('submit-modal');
        if (modal) {
            modal.style.setProperty('display', 'none', 'important');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function executeFinalSubmit() {
        isSubmitting = true;
        if (window.sessionStorage) {
            window.sessionStorage.setItem('exam_completed_{{ $attempt->id }}', '1');
        }
        var form = document.getElementById('final-submit-form');
        if (!form) {
            console.error('Final submit form not found.');
            return;
        }

        var confirmBtn = document.getElementById('btn-final-confirm-submit');
        if (confirmBtn) {
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<i class="fa fa-spinner fa-spin mr-1"></i> জমা হচ্ছে...';
        }

        // Harvest all text answers from page
        try {
            var textInputs = document.querySelectorAll('input[id^="text-ans-"], textarea[id^="text-ans-"], input[id^="single-text-ans-"], textarea[id^="single-text-ans-"]');
            textInputs.forEach(function(inp) {
                var qId = inp.id.replace('single-text-ans-', '').replace('text-ans-', '');
                if (qId && inp.value.trim() !== '') {
                    var hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = 'text_answers[' + qId + ']';
                    hidden.value = inp.value.trim();
                    form.appendChild(hidden);
                }
            });

            // Harvest all CQ answers
            if (typeof cqAnswersState !== 'undefined') {
                for (var qId in cqAnswersState) {
                    for (var subKey in cqAnswersState[qId]) {
                        var hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = 'cq_answers[' + qId + '][' + subKey + ']';
                        hidden.value = cqAnswersState[qId][subKey];
                        form.appendChild(hidden);
                    }
                }
            }
        } catch (e) {
            console.warn('Harvest error:', e);
        }

        if (typeof HTMLFormElement !== 'undefined' && HTMLFormElement.prototype.submit) {
            HTMLFormElement.prototype.submit.call(form);
        } else {
            form.submit();
        }
    }

    // =========================================================================
    // STRICT ANTI-CHEATING & EXAM SECURITY SYSTEM
    // =========================================================================
    var securityViolationCount = {{ (int)($attempt->security_violations_count ?: 0) }};
    var recordViolationUrl = "{{ route('student.quiz.record-violation', $attempt->id) }}";
    var isSubmitting = false;
    var lastViolationTime = 0;
    var blurTimestamp = 0;

    function isInputField(target) {
        if (!target) return false;
        var tag = target.tagName ? target.tagName.toLowerCase() : '';
        return tag === 'input' || tag === 'textarea';
    }

    // 1. Copy Protection (Block contextmenu, copy, cut, paste outside inputs)
    // Directive: Right-click is blocked silently without triggering or saving warning alerts
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    document.addEventListener('copy', function(e) {
        e.preventDefault();
        triggerSecurityViolation('copy_attempt', 'প্রশ্ন বা টেক্সট কপি করার চেষ্টা');
    });

    document.addEventListener('cut', function(e) {
        e.preventDefault();
        triggerSecurityViolation('cut_attempt', 'টেক্সট কাট করার চেষ্টা');
    });

    document.addEventListener('paste', function(e) {
        if (!isInputField(e.target)) {
            e.preventDefault();
            triggerSecurityViolation('paste_attempt', 'অননুমোদিত পেস্ট করার চেষ্টা');
        }
    });

    document.addEventListener('selectstart', function(e) {
        if (!isInputField(e.target)) {
            e.preventDefault();
        }
    });

    // 2. Keyboard Restrictions (Ctrl+C, Ctrl+V, Ctrl+U, Ctrl+P, Ctrl+S, F12, DevTools)
    document.addEventListener('keydown', function(e) {
        if (isSubmitting) return;

        var key = e.key ? e.key.toLowerCase() : '';
        var isCtrl = e.ctrlKey || e.metaKey;

        // F12
        if (e.keyCode === 123 || e.key === 'F12') {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('dev_tools', 'F12 ডেভেলপার টুলস খোলার চেষ্টা');
            return;
        }

        // Ctrl + Shift + I/J/C (DevTools inspect)
        if (isCtrl && e.shiftKey && (key === 'i' || key === 'j' || key === 'c')) {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('dev_tools', 'Ctrl+Shift+' + key.toUpperCase() + ' ডেভেলপার কনসোল খোলার চেষ্টা');
            return;
        }

        // Ctrl + U (View source)
        if (isCtrl && key === 'u') {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('restricted_shortcut', 'Ctrl+U পেজ সোর্স দেখার চেষ্টা');
            return;
        }

        // Ctrl + P (Print)
        if (isCtrl && key === 'p') {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('restricted_shortcut', 'Ctrl+P প্রিন্ট ডায়ালগ খোলার চেষ্টা');
            return;
        }

        // Ctrl + S (Save page)
        if (isCtrl && key === 's') {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('restricted_shortcut', 'Ctrl+S পেজ সেভ করার চেষ্টা');
            return;
        }

        // Ctrl + C (Copy)
        if (isCtrl && key === 'c') {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('restricted_shortcut', 'Ctrl+C কপি শর্টকাট ব্যবহারের চেষ্টা');
            return;
        }

        // Ctrl + V (Paste outside inputs)
        if (isCtrl && key === 'v' && !isInputField(e.target)) {
            e.preventDefault();
            e.stopPropagation();
            triggerSecurityViolation('restricted_shortcut', 'Ctrl+V পেস্ট শর্টকাট ব্যবহারের চেষ্টা');
            return;
        }
    });

    // 3. Tab Switching & Window Focus Detection
    document.addEventListener('visibilitychange', function() {
        if (isSubmitting) return;
        if (document.hidden) {
            blurTimestamp = Date.now();
        } else {
            if (blurTimestamp > 0) {
                var diffMs = Date.now() - blurTimestamp;
                blurTimestamp = 0;
                if (diffMs > 800) {
                    var diffSec = Math.max(1, Math.round(diffMs / 1000));
                    triggerSecurityViolation('tab_switch', 'ব্রাউজার ট্যাব পরিবর্তন বা মিনিমাইজ করা হয়েছিল (' + diffSec + ' সেকেন্ড)');
                }
            }
        }
    });

    window.addEventListener('blur', function() {
        if (isSubmitting) return;
        if (!blurTimestamp) {
            blurTimestamp = Date.now();
        }
    });

    window.addEventListener('focus', function() {
        if (isSubmitting) return;
        if (blurTimestamp > 0) {
            var diffMs = Date.now() - blurTimestamp;
            blurTimestamp = 0;
            if (diffMs > 1200) {
                var diffSec = Math.max(1, Math.round(diffMs / 1000));
                triggerSecurityViolation('window_blur', 'উইন্ডো ফোকাস হারিয়েছে (' + diffSec + ' সেকেন্ড)');
            }
        }
    });

    // 4. Trigger Security Violation Handler
    function triggerSecurityViolation(type, details) {
        if (isSubmitting) return;
        var now = Date.now();
        if (now - lastViolationTime < 1800) {
            // Debounce within 1.8 seconds
            return;
        }
        lastViolationTime = now;

        securityViolationCount++;

        // Render modal UI based on warning tier
        renderSecurityWarningModal(securityViolationCount, type, details);

        // Gentle audio alert
        try {
            var AudioContext = window.AudioContext || window.webkitAudioContext;
            if (AudioContext) {
                var ctx = new AudioContext();
                var osc = ctx.createOscillator();
                var gain = ctx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(securityViolationCount >= 3 ? 550 : 440, ctx.currentTime);
                gain.gain.setValueAtTime(0.15, ctx.currentTime);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start();
                osc.stop(ctx.currentTime + 0.25);
            }
        } catch (e) {}

        // Post to backend asynchronously
        fetch(recordViolationUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                violation_type: type,
                details: details
            })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data && data.warning_count) {
                securityViolationCount = data.warning_count;
                updateSecurityBadgeTier(securityViolationCount);
            }
        })
        .catch(function(err) {
            console.warn('Violation logging network notice:', err);
        });
    }

    var secToastTimer = null;

    function renderSecurityWarningModal(count, type, details) {
        // Alias to toaster
        showSecurityToast(count, type, details);
    }

    function showSecurityToast(count, type, details) {
        var toast = document.getElementById('security-warning-toast');
        var card = document.getElementById('sec-toast-card');
        var iconWrap = document.getElementById('sec-toast-icon-wrap');
        var icon = document.getElementById('sec-toast-icon');
        var badge = document.getElementById('sec-toast-badge');
        var title = document.getElementById('sec-toast-title');
        var desc = document.getElementById('sec-toast-desc');
        var time = document.getElementById('sec-toast-time');

        if (!toast) return;

        var typeNames = {
            'tab_switch': 'ট্যাব পরিবর্তন (Tab Switch)',
            'window_blur': 'উইন্ডো ফোকাস হারানো (Window Blur)',
            'right_click': 'মাউসের রাইট ক্লিক (Context Menu)',
            'copy_attempt': 'কপি করার চেষ্টা (Copy Protection)',
            'cut_attempt': 'কাট করার চেষ্টা (Cut Protection)',
            'paste_attempt': 'পেস্ট করার চেষ্টা (Paste Protection)',
            'restricted_shortcut': 'নিষিদ্ধ কিবোর্ড শর্টকাট (Shortcut Blocked)',
            'dev_tools': 'ডেভেলপার টুলস / F12 (DevTools Blocked)'
        };

        var label = typeNames[type] || 'নিরাপত্তা নিয়ম লঙ্ঘন';
        if (time) time.innerText = new Date().toLocaleTimeString('bn-BD');

        if (count <= 1) {
            card.className = "pointer-events-auto rounded-2xl bg-slate-900/95 dark:bg-white/95 text-white dark:text-slate-900 p-4 shadow-2xl border-2 border-amber-400 dark:border-amber-500 backdrop-blur-xl flex items-start gap-3";
            iconWrap.className = "w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 dark:text-amber-600 flex items-center justify-center shrink-0 text-lg";
            icon.className = "fa fa-exclamation-triangle";
            badge.className = "px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-950 font-bold";
            badge.innerText = "সতর্কবার্তা ১";
            title.innerText = "অনাকাঙ্ক্ষিত কার্যকলাপ সনাক্ত হয়েছে!";
            desc.innerText = label + " — " + (details || 'পরীক্ষা চলাকালীন ট্যাব পরিবর্তন বা কপি নিষিদ্ধ।');
        } else if (count === 2) {
            card.className = "pointer-events-auto rounded-2xl bg-slate-900/95 dark:bg-white/95 text-white dark:text-slate-900 p-4 shadow-2xl border-2 border-orange-500 dark:border-orange-500 backdrop-blur-xl flex items-start gap-3";
            iconWrap.className = "w-10 h-10 rounded-xl bg-orange-500/20 text-orange-400 dark:text-orange-600 flex items-center justify-center shrink-0 text-lg";
            icon.className = "fa fa-shield-alt";
            badge.className = "px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-orange-500 text-white font-bold";
            badge.innerText = "২য় কড়া সতর্কতা";
            title.innerText = "দ্বিতীয়বার নিরাপত্তা নিয়ম লঙ্ঘন সনাক্ত!";
            desc.innerText = label + " — অডিট লগে রেকর্ড করা হচ্ছে। পরীক্ষা স্বাভাবিকভাবে চলমান।";
        } else {
            card.className = "pointer-events-auto rounded-2xl bg-slate-900/95 dark:bg-white/95 text-white dark:text-slate-900 p-4 shadow-2xl border-2 border-rose-500 dark:border-rose-500 backdrop-blur-xl flex items-start gap-3";
            iconWrap.className = "w-10 h-10 rounded-xl bg-rose-500/20 text-rose-400 dark:text-rose-600 flex items-center justify-center shrink-0 text-lg pulse-subtle";
            icon.className = "fa fa-ban";
            badge.className = "px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-rose-600 text-white font-bold";
            badge.innerText = "গুরুতর সতর্কতা #" + toBengaliDigits(count);
            title.innerText = "গুরুতর নিরাপত্তা নিয়ম লঙ্ঘন রেকর্ড হচ্ছে!";
            desc.innerText = label + " — আপনার আইপি ও সকল কার্যকলাপ অ্যাডমিন রিপোর্টে সংরক্ষিত হচ্ছে।";
        }

        // Show toast with slide-in animation
        toast.classList.remove('opacity-0', '-translate-y-4');
        toast.classList.add('opacity-100', 'translate-y-0');

        // Auto-dismiss after 6 seconds
        clearTimeout(secToastTimer);
        secToastTimer = setTimeout(function() {
            hideSecurityToast();
        }, 6000);
    }

    function hideSecurityToast() {
        var toast = document.getElementById('security-warning-toast');
        if (toast) {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-4');
        }
    }

    function updateSecurityBadgeTier(count) {
        var badge = document.getElementById('sec-toast-badge');
        if (badge && count >= 3) {
            badge.innerText = "গুরুতর সতর্কতা #" + toBengaliDigits(count);
        }
    }

    function acknowledgeSecurityWarning() {
        hideSecurityToast();
    }

    // Direct event listener binding for submit buttons as bulletproof safety net
    window.addEventListener('DOMContentLoaded', function() {
        var topBtn = document.getElementById('btn-submit-exam-top');
        if (topBtn) {
            topBtn.addEventListener('click', function(e) {
                e.preventDefault();
                confirmSubmitExam();
            });
        }
        var palBtn = document.getElementById('btn-submit-exam-palette');
        if (palBtn) {
            palBtn.addEventListener('click', function(e) {
                e.preventDefault();
                confirmSubmitExam();
            });
        }
    });
</script>
@endsection
