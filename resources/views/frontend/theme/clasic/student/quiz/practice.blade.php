@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Question Bank Unlimited Practice & Rotation — Wake Up ICT')
@section('page_title', 'Question Bank Practice')
@section('page_crumb', 'Practice & Rotation')

@push('css')
<style>
    .hud-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .hud-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.08);
    }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto pb-10">

    <!-- Active In-Progress Practice Banner -->
    @if(!empty($activePracticeAttempt))
    <div class="rounded-2xl p-4 sm:p-5 bg-gradient-to-r from-amber-500/15 via-orange-500/10 to-amber-500/15 border-2 border-amber-400 dark:border-amber-500/40 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-amber-400 text-slate-950 flex items-center justify-center text-lg font-black shadow-md shadow-amber-500/30 flex-shrink-0 animate-bounce">
                <i class="fa fa-clock-o"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-amber-400 text-slate-950 font-black uppercase tracking-wider">চলমান পরীক্ষা</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-semibold">শুরু: {{ $activePracticeAttempt->started_at ? $activePracticeAttempt->started_at->diffForHumans() : 'এখনই' }}</span>
                </div>
                <h4 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white mt-0.5">
                    আপনার একটি অনুশীলন পরীক্ষা ইতিমধ্যে শুরু করা রয়েছে
                </h4>
                <p class="text-xs text-slate-600 dark:text-slate-300">
                    {{ $activePracticeAttempt->quiz ? $activePracticeAttempt->quiz->title : 'প্র্যাকটিস টেস্ট' }} • মোট {{ $activePracticeAttempt->total_questions }} প্রশ্ন
                </p>
            </div>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <a href="{{ route('student.quiz.take', $activePracticeAttempt->id) }}" 
               class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl btn-brand-primary text-white font-extrabold text-sm transition-all">
                <span>পরীক্ষায় ফিরে যান</span>
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endif

    <!-- Clean Page Hero & Rotation Cycle Banner -->
    <div class="rounded-2xl bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white p-5 sm:p-7 shadow-md relative overflow-hidden border border-slate-800">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div class="space-y-2 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-xs font-bold text-blue-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Smart Question Bank Rotation</span>
                    <span class="bg-emerald-500 text-slate-950 px-2 py-0.5 rounded-full text-[10px] font-black">Cycle #{{ $progress['current_cycle'] }}</span>
                </div>
                <h1 class="text-xl sm:text-3xl font-black tracking-tight text-white">
                    স্মার্ট প্রশ্ন ব্যাংক প্র্যাকটিস ও রোটেশন
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    ১,০০০+ প্রশ্ন ব্যাংকের প্রতিটি প্রশ্ন কোনো পুনরাবৃত্তি ছাড়াই ধারাবাহিকভাবে কভার করুন। সম্পূর্ণ প্রশ্ন শেষ হলে স্বয়ংক্রিয়ভাবে পরবর্তী সাইকেল শুরু হবে।
                </p>
            </div>

            <!-- Cycle Badge Box -->
            <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-xl p-3.5 sm:p-4 flex items-center gap-3.5 self-start lg:self-center shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-amber-400 text-slate-950 flex items-center justify-center font-black text-xl shadow-md">
                    <i class="fa fa-refresh"></i>
                </div>
                <div>
                    <div class="text-[10px] font-bold uppercase tracking-wider text-blue-200">বর্তমান রোটেশন সাইকেল</div>
                    <div class="text-xl sm:text-2xl font-black text-white">সাইকেল #{{ $progress['current_cycle'] }}</div>
                    <div class="text-xs text-emerald-300 font-semibold">
                        {{ $progress['coverage_pct'] }}% প্রশ্ন ব্যাংক সম্পন্ন
                    </div>
                </div>
            </div>
        </div>

        <!-- Bank Coverage Progress Bar -->
        <div class="mt-5 pt-4 border-t border-white/10">
            <div class="flex items-center justify-between text-xs font-bold mb-1.5">
                <span class="text-slate-300 flex items-center gap-1.5">
                    <i class="fa fa-database text-amber-400"></i>
                    <span>প্রশ্ন ব্যাংক কভারেজ অগ্রগতি (Question Bank Coverage)</span>
                </span>
                <span class="text-amber-300 font-extrabold text-xs sm:text-sm">
                    {{ $progress['attempted_questions'] }} / {{ $progress['total_questions'] }} টি ({{ $progress['coverage_pct'] }}%)
                </span>
            </div>
            <div class="w-full h-2.5 bg-black/30 rounded-full overflow-hidden p-0.5 border border-white/10">
                <div class="h-full bg-gradient-to-r from-[#F26522] via-[#FB923C] to-[#FED7AA] rounded-full transition-all duration-700"
                     style="width: {{ max(2, min(100, $progress['coverage_pct'])) }}%"></div>
            </div>
        </div>
    </div>

    <!-- 5 Clean HUD Metric Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 sm:gap-4">
        <!-- Metric 1: Total Questions -->
        <div class="hud-card rounded-2xl p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">মোট প্রশ্ন</span>
                <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                    <i class="fa fa-database"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-slate-900 dark:text-white">
                {{ number_format($progress['total_questions']) }}
            </div>
            <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                Total in Question Bank
            </div>
        </div>

        <!-- Metric 2: Attempted Questions -->
        <div class="hud-card rounded-2xl p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">অনুশীলনকৃত</span>
                <div class="w-7 h-7 rounded-lg bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-emerald-600 dark:text-emerald-400">
                {{ number_format($progress['attempted_questions']) }}
            </div>
            <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                Attempted in Cycle #{{ $progress['current_cycle'] }}
            </div>
        </div>

        <!-- Metric 3: Remaining Questions -->
        <div class="hud-card rounded-2xl p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">অবশিষ্ট প্রশ্ন</span>
                <div class="w-7 h-7 rounded-lg bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs">
                    <i class="fa fa-hourglass-half"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-amber-600 dark:text-amber-400">
                {{ number_format($progress['remaining_questions']) }}
            </div>
            <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                Remaining Unseen
            </div>
        </div>

        <!-- Metric 4: Total Exams Completed -->
        <div class="hud-card rounded-2xl p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">পরীক্ষা সম্পন্ন</span>
                <div class="w-7 h-7 rounded-lg bg-violet-50 dark:bg-violet-900/40 text-violet-600 dark:text-violet-400 flex items-center justify-center text-xs">
                    <i class="fa fa-graduation-cap"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-violet-600 dark:text-violet-400">
                {{ number_format($progress['total_exams_completed']) }}
            </div>
            <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                Exams Completed
            </div>
        </div>

        <!-- Metric 5: Coverage & Accuracy -->
        <div class="hud-card col-span-2 md:col-span-1 rounded-2xl p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
            <div class="flex items-center justify-between mb-1.5">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400">সঠিকতার হার</span>
                <div class="w-7 h-7 rounded-lg bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs">
                    <i class="fa fa-bullseye"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-blue-600 dark:text-blue-400">
                {{ $progress['accuracy_pct'] }}%
            </div>
            <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 mt-0.5">
                Accuracy Rate
            </div>
        </div>
    </div>

    <!-- Practice Exam Launchpad Card -->
    <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 sm:p-7 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-slate-100 dark:border-slate-800">
            <div>
                <span class="text-[11px] font-bold text-brand-primary uppercase tracking-wider">Interactive Test Generator</span>
                <h3 class="text-lg sm:text-xl font-black text-slate-900 dark:text-white mt-0.5">
                    নতুন অনুশীলন পরীক্ষা শুরু করুন (Start Rotated Exam)
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                    ক্যাটাগরি এবং প্রশ্নের অপশন নির্বাচন করে পরীক্ষা শুরু করুন। সিস্টেমে এখনও দেখা হয়নি এমন প্রশ্ন অগ্রাধিকার পাবে।
                </p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($practiceSettings['attempt_limit_type'] === 'single')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-amber-700 dark:text-amber-300 text-xs font-bold">
                        <i class="fa fa-lock"></i>
                        <span>একক পরীক্ষা (Single Attempt — ১ বার)</span>
                    </span>
                @elseif($practiceSettings['attempt_limit_type'] === 'custom')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-blue-700 dark:text-blue-300 text-xs font-bold">
                        <i class="fa fa-hourglass-end"></i>
                        <span>সর্বোচ্চ {{ $practiceSettings['max_attempts'] }} বার (সম্পন্ন: {{ $completedPracticeAttempts }})</span>
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-xs font-bold">
                        <i class="fa fa-infinity"></i>
                        <span>আনলিমিটেড অ্যাটেম্পট</span>
                    </span>
                @endif
            </div>
        </div>

        @if($isAttemptLimitReached)
        <div class="mt-5 p-4 rounded-xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800/60 flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-sm flex-shrink-0 mt-0.5">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div>
                <h4 class="text-sm font-bold text-amber-900 dark:text-amber-200">
                    অনুশীলন পরীক্ষার নির্ধারিত সীমা সম্পন্ন হয়েছে
                </h4>
                <p class="text-xs text-amber-800 dark:text-amber-300 mt-0.5">
                    অ্যাডমিন কর্তৃক এই অনুশীলন পরীক্ষা
                    @if($practiceSettings['attempt_limit_type'] === 'single')
                        <strong>একক অ্যাটেম্পট (Single Attempt)</strong> হিসেবে নির্ধারিত রয়েছে এবং আপনি ইতিমধ্যে ১টি পরীক্ষা সম্পন্ন করেছেন।
                    @else
                        সর্বোচ্চ <strong>{{ $practiceSettings['max_attempts'] }} টি</strong> পরীক্ষা হিসেবে নির্ধারিত এবং আপনি সবগুলো সম্পন্ন করেছেন।
                    @endif
                    পুনরায় অনুশীলনের জন্য অ্যাডমিনের সাথে যোগাযোগ করুন।
                </p>
            </div>
        </div>
        @endif

        <!-- Launch Form -->
        <form id="form-practice-start" action="{{ route('student.practice.start') }}" method="POST" onsubmit="return handlePracticeFormSubmit(event)" class="mt-5 space-y-5">
            @csrf

            <div class="grid grid-cols-1 {{ $practiceSettings['view_mode'] === 'student_choice' ? 'md:grid-cols-3' : 'md:grid-cols-2' }} gap-5">
                <!-- Select Category -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        ১. বিষয় বা অধ্যায় নির্বাচন করুন
                    </label>
                    @if($practiceSettings['allow_category_choice'])
                    <select name="category" {{ $isAttemptLimitReached ? 'disabled' : '' }} class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                        <option value="" {{ empty($selectedCategory) ? 'selected' : '' }}>
                            সব বিষয় মিলিয়ে (সম্পূর্ণ প্রশ্ন ব্যাংক: {{ $progress['total_questions'] }} টি)
                        </option>
                        @foreach($progress['categories'] as $cat)
                        <option value="{{ $cat['name'] }}" {{ $selectedCategory === $cat['name'] ? 'selected' : '' }}>
                            {{ $cat['name'] }} ({{ $cat['total'] }} টি প্রশ্ন — অবশিষ্ট {{ $cat['remaining'] }} টি)
                        </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 font-medium">
                        নির্দিষ্ট বিষয়ে দুর্বলতা কাটাতে ক্যাটাগরি সিলেক্ট করতে পারেন।
                    </p>
                    @else
                    <div class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-sm flex items-center justify-between">
                        <span>সব বিষয় মিলিয়ে (সম্পূর্ণ প্রশ্ন ব্যাংক)</span>
                        <span class="text-[10px] uppercase font-black px-2 py-0.5 rounded bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300">
                            {{ $progress['total_questions'] }} টি প্রশ্ন
                        </span>
                    </div>
                    <input type="hidden" name="category" value="">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 font-medium">
                        সম্পূর্ণ প্রশ্ন ব্যাংক থেকে স্বয়ংক্রিয় রোটেশন পদ্ধতিতে প্রশ্ন সিলেক্ট হবে।
                    </p>
                    @endif
                </div>

                <!-- Select Question Count & Duration Tier -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        ২. প্রশ্নের সংখ্যা ও সময় (Questions & Time)
                    </label>
                    @php
                        $selectedTier = null;
                        if (!empty($practiceSettings['tiers'])) {
                            foreach ($practiceSettings['tiers'] as $t) {
                                if ((int)\App\Services\PracticeQuestionRotationService::toEnglishDigits($t['questions']) === (int)$practiceSettings['question_count']) {
                                    $selectedTier = $t;
                                    break;
                                }
                            }
                            if (!$selectedTier) {
                                $selectedTier = $practiceSettings['tiers'][0];
                            }
                        }
                        $firstPassMark = $selectedTier ? (float)\App\Services\PracticeQuestionRotationService::toEnglishDigits($selectedTier['pass_marks'] ?? round($selectedTier['questions'] * 0.4, 1)) : 6.0;
                    @endphp
                    <select name="question_count" id="tierSelect" {{ $isAttemptLimitReached ? 'disabled' : '' }} onchange="syncPracticeTier(this)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                        @foreach($practiceSettings['tiers'] as $tier)
                        @php
                            $tQ = (int)\App\Services\PracticeQuestionRotationService::toEnglishDigits($tier['questions']);
                            $tD = (int)\App\Services\PracticeQuestionRotationService::toEnglishDigits($tier['duration']);
                            $tP = (float)\App\Services\PracticeQuestionRotationService::toEnglishDigits($tier['pass_marks'] ?? round($tQ * 0.4, 1));
                        @endphp
                        <option value="{{ $tQ }}" data-duration="{{ $tD }}" data-pass-marks="{{ $tP }}" {{ $tQ === (int)$practiceSettings['question_count'] ? 'selected' : '' }}>
                            {{ $tier['label'] }}
                        </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="duration_minutes" id="practice_duration_minutes" value="{{ (int)\App\Services\PracticeQuestionRotationService::toEnglishDigits($practiceSettings['duration_minutes']) }}">
                    <input type="hidden" name="pass_marks" id="practice_pass_marks" value="{{ $firstPassMark }}">
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 font-medium flex items-center gap-1.5">
                        <i class="fa fa-clock-o text-blue-500"></i>
                        <span>প্রশ্নের সংখ্যার সাথে পরীক্ষার সময়সীমা ও নির্ধারিত পাস মার্ক স্বয়ংক্রিয়ভাবে কার্যকর হবে (প্রতি প্রশ্ন: {{ (float)\App\Services\PracticeQuestionRotationService::toEnglishDigits($practiceSettings['mark_per_question'] ?? 1) }} নম্বর)।</span>
                    </p>
                </div>

                <!-- Interface Mode (ONLY shown if admin configured student_choice) -->
                @if($practiceSettings['view_mode'] === 'student_choice')
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        ৩. ইন্টারফেস মোড (Exam Layout)
                    </label>
                    <select name="view_mode" {{ $isAttemptLimitReached ? 'disabled' : '' }} class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white font-semibold text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer">
                        <option value="all_questions" selected>সব প্রশ্ন একসাথে (Full Paper View)</option>
                        <option value="one_by_one">একটি করে প্রশ্ন (Step-by-Step Focus Mode)</option>
                    </select>
                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 font-medium">
                        আপনার পছন্দ অনুযায়ী যেকোনো সময় লেআউট বেছে নিতে পারেন।
                    </p>
                </div>
                @else
                <input type="hidden" name="view_mode" value="{{ $practiceSettings['view_mode'] }}">
                @endif
            </div>

            <!-- Submit Action Bar -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
                <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                    <i class="fa fa-shield text-blue-500"></i>
                    <span>পরীক্ষা শেষে তাৎক্ষণিক ব্যাখ্যা সহ ফলাফল ও উত্তরপত্র দেখতে পাবেন।</span>
                </div>

                @if($isAttemptLimitReached)
                <button type="button" disabled
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-bold text-sm cursor-not-allowed shadow-none">
                    <i class="fa fa-lock"></i>
                    <span>পরীক্ষার সীমা শেষ (Attempt Limit Reached)</span>
                </button>
                @else
                <button type="button" onclick="confirmPracticeStart(event)" id="btn-practice-start-trigger" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-xl btn-brand-primary font-black text-sm transition-all hover:scale-[1.01] cursor-pointer">
                    <i class="fa fa-play-circle text-base"></i>
                    <span>পরীক্ষা শুরু করুন (Start Exam)</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </button>
                @endif
            </div>
        </form>
    </div>

    <!-- Category-Wise Practice Cards Grid -->
    <div class="space-y-3.5">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-lg font-black text-slate-900 dark:text-white">
                    বিষয়ভিত্তিক প্রশ্ন ব্যাংক অগ্রগতি (Category-Wise Coverage)
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    প্রতিটি বিষয়ের মোট প্রশ্ন ও আপনার অগ্রগতি পর্যবেক্ষণ করে কাঙ্ক্ষিত বিষয়ের কুইজ শুরু করুন।
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @forelse($progress['categories'] as $categoryItem)
            <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-slate-800/40 border border-slate-200/80 dark:border-slate-800 hover:border-blue-300 dark:hover:border-blue-700 transition-all flex flex-col justify-center">
                <div class="flex items-center justify-between gap-2 mb-1.5">
                    <div class="flex items-center gap-2 truncate">
                        <span class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate">
                            {{ $categoryItem['name'] }}
                        </span>
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300">
                            C#{{ $categoryItem['cycle'] }}
                        </span>
                    </div>
                    <span class="text-xs font-black text-emerald-600 dark:text-emerald-400 shrink-0">
                        {{ $categoryItem['coverage_pct'] }}% সম্পন্ন
                    </span>
                </div>

                <div class="w-full h-2 bg-slate-200/80 dark:bg-slate-700 rounded-full overflow-hidden mb-1.5">
                    <div class="h-full bg-gradient-to-r from-[#F26522] to-[#FB923C] rounded-full transition-all" style="width: {{ $categoryItem['coverage_pct'] }}%"></div>
                </div>

                <div class="flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400 font-medium">
                    <span>মোট: <strong class="text-slate-800 dark:text-slate-200 font-bold">{{ $categoryItem['total'] }}</strong> | সম্পন্ন: <strong class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $categoryItem['attempted'] }}</strong></span>
                    <span>অবশিষ্ট: <strong class="text-amber-600 dark:text-amber-400 font-bold">{{ $categoryItem['remaining'] }}</strong> টি</span>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-6 text-xs text-slate-400">
                কোনো বিষয়ভিত্তিক ক্যাটাগরি তথ্য পাওয়া যায়নি।
            </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Practice Exam History Table -->
    <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm space-y-3.5">
        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 dark:border-slate-800">
            <div>
                <h3 class="text-sm sm:text-base font-black text-slate-900 dark:text-white">
                    সর্বশেষ অনুশীলন পরীক্ষার ইতিহাস (Recent Practice Attempts)
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">
                    আপনার সম্পন্ন করা অনুশীলন পরীক্ষার ফলাফল ও উত্তরপত্র পর্যালোচনা।
                </p>
            </div>
            <a href="{{ route('student.results.index') }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">
                সকল ফলাফল দেখুন &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[11px]">
                        <th class="py-2.5 px-3 font-bold"># অ্যাটেম্পট</th>
                        <th class="py-2.5 px-3 font-bold">কুইজ শিরোনাম / বিষয়</th>
                        <th class="py-2.5 px-3 font-bold text-center">মোট প্রশ্ন</th>
                        <th class="py-2.5 px-3 font-bold text-center">স্কোর</th>
                        <th class="py-2.5 px-3 font-bold text-center">শতাংশ</th>
                        <th class="py-2.5 px-3 font-bold text-center">সময়</th>
                        <th class="py-2.5 px-3 font-bold text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($recentAttempts as $attempt)
                    <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 transition-colors">
                        <td class="py-3 px-3 font-bold text-slate-900 dark:text-white">
                            #{{ $attempt->attempt_number }}
                        </td>
                        <td class="py-3 px-3">
                            <div class="font-bold text-slate-900 dark:text-white">{{ $attempt->quiz ? $attempt->quiz->title : 'স্মার্ট প্র্যাকটিস' }}</div>
                            <div class="text-[10px] text-slate-500 dark:text-slate-400">{{ $attempt->started_at ? $attempt->started_at->format('d M, Y h:i A') : '—' }}</div>
                        </td>
                        <td class="py-3 px-3 text-center font-bold text-slate-700 dark:text-slate-300">
                            {{ $attempt->total_questions }}
                        </td>
                        <td class="py-3 px-3 text-center">
                            <span class="font-extrabold text-blue-600 dark:text-blue-400">{{ $attempt->score }}</span>
                            <span class="text-slate-400">/ {{ (int)$attempt->total_marks }}</span>
                        </td>
                        <td class="py-3 px-3 text-center">
                            @php
                                $pct = $attempt->total_marks > 0 ? round(($attempt->score / $attempt->total_marks) * 100, 1) : 0;
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-black {{ $pct >= 50 ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-300' : 'bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-300' }}">
                                {{ $pct }}%
                            </span>
                        </td>
                        <td class="py-3 px-3 text-center text-slate-500 dark:text-slate-400 text-[11px]">
                            @if($attempt->submitted_at && $attempt->started_at)
                                {{ $attempt->started_at->diffInMinutes($attempt->submitted_at) }} মিনিট
                            @else
                                —
                            @endif
                        </td>
                        <td class="py-3 px-3 text-right">
                            <a href="{{ route('student.quiz.results', $attempt->id) }}" 
                               class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-950/50 hover:bg-blue-600 hover:text-white text-blue-700 dark:text-blue-300 font-bold transition-all text-xs">
                                <i class="fa fa-file-text-o"></i>
                                <span>উত্তরপত্র</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-slate-400 text-xs">
                            এখনও কোনো অনুশীলন পরীক্ষা দেওয়া হয়নি। উপরের বাটন থেকে প্রথম পরীক্ষাটি শুরু করুন!
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- Practice Exam Start Confirmation Modal -->
<div id="practice-start-confirm-modal" style="display: none; z-index: 9999999; background-color: rgba(15, 23, 42, 0.85);" class="fixed inset-0 backdrop-blur-md items-center justify-center p-4">
    <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 text-center relative z-10">
        <div class="w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 flex items-center justify-center mx-auto text-2xl">
            <i class="fa fa-play-circle"></i>
        </div>
        
        <div class="space-y-2">
            <h3 class="text-lg font-black text-slate-900 dark:text-white">
                অনুশীলন পরীক্ষা শুরু করতে প্রস্তুত?
            </h3>
            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                পরীক্ষা শুরু করার পর টাইমার স্বয়ংক্রিয়ভাবে চালু হবে এবং আপনার নির্বাচিত বিষয়ের প্রশ্নপত্র লোড হবে।
            </p>

            <div class="p-3.5 my-3 rounded-2xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 text-xs space-y-1.5 text-left font-mono">
                <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                    <span class="text-slate-500 dark:text-slate-400">নির্বাচিত বিষয়:</span>
                    <strong class="text-slate-900 dark:text-white truncate max-w-[200px]" id="modal-confirm-category">সব বিষয় মিলিয়ে</strong>
                </div>
                <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                    <span class="text-slate-500 dark:text-slate-400">প্রশ্নের সংখ্যা:</span>
                    <strong class="text-emerald-600 dark:text-emerald-400" id="modal-confirm-qcount">১০ টি প্রশ্ন</strong>
                </div>
            </div>

            <p class="text-[11px] text-amber-600 dark:text-amber-400 font-semibold leading-normal">
                💡 পরীক্ষা সম্পন্ন করে তাৎক্ষণিক ওএমআর শিট ও বিস্তারিত ব্যাখ্যা দেখতে পারবেন।
            </p>
        </div>

        <div class="flex items-center justify-center gap-3 pt-1">
            <button type="button" onclick="closePracticeConfirmModal()" class="w-1/2 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs transition-colors cursor-pointer">
                বাতিল (Cancel)
            </button>
            <button type="button" id="btn-modal-confirm-start" onclick="proceedPracticeStart()" class="w-1/2 py-3 rounded-xl btn-brand-primary font-black text-xs uppercase tracking-wider transition-all shadow-md cursor-pointer">
                হ্যাঁ, শুরু করুন &rarr;
            </button>
        </div>
    </div>
</div>

<script>
function syncPracticeTier(select) {
    if (!select) return;
    var opt = select.options[select.selectedIndex];
    if (!opt) return;
    var d = opt.getAttribute('data-duration');
    var p = opt.getAttribute('data-pass-marks');
    var dInput = document.getElementById('practice_duration_minutes');
    var pInput = document.getElementById('practice_pass_marks');
    if (dInput && d !== null && d !== '') dInput.value = d;
    if (pInput && p !== null && p !== '') pInput.value = p;
}

var practiceConfirmed = false;

function handlePracticeFormSubmit(e) {
    if (!practiceConfirmed) {
        if (e && e.preventDefault) e.preventDefault();
        confirmPracticeStart(e);
        return false;
    }
    return true;
}

function confirmPracticeStart(e) {
    if (e && e.preventDefault) e.preventDefault();
    if (e && e.stopPropagation) e.stopPropagation();

    var form = document.getElementById('form-practice-start');
    if (!form) return;

    var catSelect = form.querySelector('select[name="category"]');
    var qSelect = form.querySelector('select[name="question_count"]');

    var catText = catSelect && catSelect.selectedIndex >= 0 ? catSelect.options[catSelect.selectedIndex].text : 'সব বিষয় মিলিয়ে';
    var qText = qSelect && qSelect.selectedIndex >= 0 ? qSelect.options[qSelect.selectedIndex].text : '১০ টি প্রশ্ন';

    var cEl = document.getElementById('modal-confirm-category');
    var qEl = document.getElementById('modal-confirm-qcount');
    if (cEl) cEl.innerText = catText.split('(')[0].trim();
    if (qEl) qEl.innerText = qText;

    var modal = document.getElementById('practice-start-confirm-modal');
    if (modal) {
        modal.style.setProperty('display', 'flex', 'important');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        if (confirm('আপনি কি অনুশীলন পরীক্ষা শুরু করতে প্রস্তুত?')) {
            practiceConfirmed = true;
            form.submit();
        }
    }
}

function closePracticeConfirmModal() {
    var modal = document.getElementById('practice-start-confirm-modal');
    if (modal) {
        modal.style.setProperty('display', 'none', 'important');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

function proceedPracticeStart() {
    practiceConfirmed = true;
    var select = document.getElementById('tierSelect');
    if (select) syncPracticeTier(select);
    var btn = document.getElementById('btn-modal-confirm-start');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-1"></i> পরীক্ষা শুরু হচ্ছে...';
    }
    var form = document.getElementById('form-practice-start');
    if (form) form.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('tierSelect');
    if (select) {
        syncPracticeTier(select);
        select.addEventListener('change', function() { syncPracticeTier(this); });
        select.addEventListener('input', function() { syncPracticeTier(this); });
    }
});
</script>
@endsection