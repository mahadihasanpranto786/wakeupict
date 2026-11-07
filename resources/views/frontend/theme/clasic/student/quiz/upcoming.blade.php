@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Upcoming Examinations — Wake Up ICT')
@section('page_title', 'Upcoming Exams')
@section('page_crumb', 'Examination Schedule')

@push('css')
<style>
    @keyframes floatSlow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(3deg); }
    }
    @keyframes floatReverse {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(14px) rotate(-4deg); }
    }
    .animate-float-slow {
        animation: floatSlow 8s ease-in-out infinite;
    }
    .animate-float-reverse {
        animation: floatReverse 9s ease-in-out infinite;
    }

    .quiz-glass-card {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    .quiz-glass-card:hover {
        transform: translateY(-4px);
    }

    html.light .quiz-heading {
        color: #1d4ed8 !important;
    }
    html.light .quiz-subheading {
        color: #ea580c !important;
    }
    html.light .quiz-card-title {
        color: #0f172a !important;
    }
    html.light .quiz-card-desc {
        color: #475569 !important;
    }
    html.light .quiz-card-surface {
        background-color: rgba(255, 255, 255, 0.9) !important;
        border-color: rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05), 0 4px 6px -2px rgba(15, 23, 42, 0.02) !important;
    }
    html.light .quiz-card-surface:hover {
        border-color: rgba(147, 197, 253, 0.9) !important;
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.12), 0 8px 16px -4px rgba(37, 99, 235, 0.06) !important;
    }
    html.light .quiz-action-btn {
        color: #ffffff !important;
        background-color: #2563eb !important;
    }
    html.light .quiz-action-btn:hover {
        background-color: #1d4ed8 !important;
    }

    html.dark .quiz-heading {
        color: #60a5fa !important;
    }
    html.dark .quiz-subheading {
        color: #fb923c !important;
    }
    html.dark .quiz-card-title {
        color: #ffffff !important;
    }
    html.dark .quiz-card-desc {
        color: #94a3b8 !important;
    }
    html.dark .quiz-card-surface {
        background-color: rgba(15, 23, 42, 0.85) !important;
        border-color: rgba(30, 41, 59, 0.9) !important;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.4) !important;
    }
    html.dark .quiz-card-surface:hover {
        border-color: rgba(59, 130, 246, 0.5) !important;
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.25) !important;
    }
    html.dark .quiz-action-btn {
        color: #ffffff !important;
        background-color: #2563eb !important;
    }
    html.dark .quiz-action-btn:hover {
        background-color: #1d4ed8 !important;
    }
</style>
@endpush

@section('content')
<!-- Full-Wrapper Container spanning edge-to-edge -->
<div class="-m-4 sm:-m-8 p-4 sm:p-8 min-h-[calc(100vh-5rem)] relative overflow-hidden max-w-full">

    <!-- Ambient Atmosphere Aura spanning entire canvas from sidebar to right edge -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-16 -left-20 w-[620px] sm:w-[750px] h-[620px] sm:h-[750px] bg-gradient-to-br from-blue-400/30 via-indigo-400/20 to-transparent rounded-full blur-[130px]"></div>
        <div class="absolute -top-10 -right-20 w-[600px] sm:w-[720px] h-[600px] sm:h-[720px] bg-gradient-to-bl from-amber-300/30 via-orange-300/20 to-transparent rounded-full blur-[140px]"></div>
        <div class="absolute -left-20 bottom-10 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-blue-500/15 rounded-full blur-[140px]"></div>
    </div>

    <!-- Floating 3D Geometric Frosted Prism -->
    <div class="hidden lg:block absolute left-4 top-[280px] pointer-events-none animate-float-slow -z-10 opacity-70">
        <svg width="85" height="85" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-[0_15px_25px_rgba(37,99,235,0.25)]">
            <defs>
                <linearGradient id="prismUpcomingGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#93c5fd" stop-opacity="0.85" />
                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.3" />
                </linearGradient>
                <linearGradient id="prismUpcomingGrad2" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#60a5fa" stop-opacity="0.9" />
                    <stop offset="100%" stop-color="#1d4ed8" stop-opacity="0.5" />
                </linearGradient>
            </defs>
            <polygon points="50,15 90,65 50,85" fill="url(#prismUpcomingGrad1)" />
            <polygon points="50,15 10,65 50,85" fill="url(#prismUpcomingGrad2)" />
        </svg>
    </div>

    <!-- Central Inner Content with Generous Responsive Width -->
    <div class="w-full max-w-[1600px] mx-auto space-y-10 relative z-10">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-slate-800/80">
            <div class="max-w-2xl space-y-2">
                <div class="quiz-subheading text-xs sm:text-sm font-extrabold uppercase tracking-widest flex items-center gap-2">
                    <span>Certification Assessment Schedule</span>
                </div>
                <h1 class="quiz-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Upcoming Examinations
                </h1>
                <p class="quiz-card-desc text-xs sm:text-sm lg:text-base leading-relaxed max-w-xl">
                    Official certification assessments and NCTB board-standard model examinations scheduled for your coaching batch.
                </p>
            </div>

            <a href="{{ route('student.quiz.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/90 dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200 hover:border-blue-400 transition-all shadow-sm self-start sm:self-auto">
                <i class="fa fa-pencil text-blue-600"></i>
                <span>All Practice Quizzes</span>
            </a>
        </div>

        @if($exams->count() > 0)
            <div class="space-y-6 relative z-10">
                @foreach($exams as $exam)
                    @php
                        $isUpcoming = $exam->isUpcoming();
                        $isLiveNow = $exam->isLiveNow();
                        $isExpired = $exam->isExpired();
                        $remainingDays = $exam->getRemainingDaysCount();
                        $remainingHuman = $exam->getRemainingTimeForHumans();
                    @endphp
                    <div class="quiz-glass-card quiz-card-surface rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 border @if($isUpcoming) border-amber-300/80 dark:border-amber-700/60 @elseif($isLiveNow) border-emerald-300/80 dark:border-emerald-700/60 @endif"
                         @if($isUpcoming && $exam->start_time) data-countdown-start="{{ $exam->start_time->toIso8601String() }}" data-exam-id="{{ $exam->id }}" @endif>
                        
                        <div class="space-y-3.5 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                @if($isUpcoming)
                                    <span class="px-3 py-1 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-700 dark:text-amber-300 font-mono text-[11px] font-extrabold flex items-center gap-1.5 shadow-xs">
                                        <i class="fa fa-calendar-check-o text-amber-600 dark:text-amber-400"></i>
                                        <span>নির্ধারিত পরীক্ষা (Scheduled Live Exam)</span>
                                    </span>
                                    <span class="px-3 py-1 rounded-full bg-indigo-500/15 border border-indigo-500/30 text-indigo-700 dark:text-indigo-300 font-mono text-[11px] font-extrabold flex items-center gap-1.5 shadow-xs">
                                        <i class="fa fa-hourglass-start animate-pulse text-indigo-600 dark:text-indigo-400"></i>
                                        <span class="remaining-text-{{ $exam->id }}">শুরু হতে বাকি: {{ $remainingHuman }}</span>
                                    </span>
                                @elseif($isLiveNow)
                                    <span class="px-3 py-1 rounded-full bg-rose-500/15 border border-rose-500/30 text-rose-600 dark:text-rose-400 font-mono text-[11px] font-extrabold flex items-center gap-1.5 shadow-xs">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
                                        </span>
                                        <span>লাইভ পরীক্ষা চলমান (LIVE NOW)</span>
                                    </span>
                                @elseif($isExpired)
                                    <span class="px-3 py-1 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-mono text-[11px] font-bold">
                                        <i class="fa fa-calendar-times-o mr-1"></i> সময় সমাপ্ত (Exam Closed)
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 font-mono text-[10px] font-bold uppercase">
                                        Formal Exam
                                    </span>
                                @endif

                                <span class="px-2.5 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold">
                                    {{ $exam->class_level ?: 'Course Certification' }}
                                </span>
                            </div>

                            <h3 class="quiz-card-title text-xl sm:text-2xl font-bold tracking-tight">
                                {{ $exam->title }}
                            </h3>

                            <p class="quiz-card-desc text-xs sm:text-sm max-w-3xl leading-relaxed">
                                {{ $exam->description ?: 'Formal examination requiring strict time management and complete syllabus coverage.' }}
                            </p>

                            <!-- Scheduled Date & Remaining Countdown Banner on the Quiz Card itself -->
                            @if($exam->start_time)
                                <div class="p-3.5 sm:p-4 rounded-2xl @if($isUpcoming) bg-amber-50/90 dark:bg-amber-950/40 border border-amber-200/90 dark:border-amber-800/60 @elseif($isLiveNow) bg-emerald-50/90 dark:bg-emerald-950/40 border border-emerald-200/90 dark:border-emerald-800/60 @else bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 @endif flex flex-wrap items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl @if($isUpcoming) bg-amber-500/20 text-amber-700 dark:text-amber-300 @elseif($isLiveNow) bg-emerald-500/20 text-emerald-700 dark:text-emerald-300 @else bg-slate-200 dark:bg-slate-800 text-slate-600 @endif flex items-center justify-center text-lg font-bold">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div>
                                            <span class="text-[10px] uppercase tracking-wider text-slate-500 dark:text-slate-400 font-bold block">
                                                পরীক্ষা শুরুর তারিখ ও সময় (Scheduled Start Date)
                                            </span>
                                            <span class="text-sm font-extrabold text-slate-900 dark:text-white">
                                                {{ $exam->start_time->format('d M Y, h:i A') }} <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">({{ \App\model\LmsQuiz::toBengaliNumber($exam->start_time->format('d/m/Y h:i A')) }})</span>
                                            </span>
                                        </div>
                                    </div>

                                    @if($isUpcoming)
                                        <div class="flex items-center gap-2">
                                            <div class="px-3 py-1.5 rounded-xl bg-amber-600 text-white font-extrabold text-xs shadow-sm flex items-center gap-1.5">
                                                <i class="fa fa-hourglass-half"></i>
                                                <span class="live-counter-{{ $exam->id }}">
                                                    @if($remainingDays > 0)
                                                        শুরু হতে বাকি: {{ \App\model\LmsQuiz::toBengaliNumber($remainingDays) }} দিন ({{ $remainingDays }} Days)
                                                    @else
                                                        {{ $remainingHuman }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    @elseif($isLiveNow)
                                        <div class="flex items-center gap-2">
                                            <div class="px-3 py-1.5 rounded-xl bg-emerald-600 text-white font-extrabold text-xs shadow-sm flex items-center gap-1.5">
                                                <i class="fa fa-check-circle"></i>
                                                <span>পরীক্ষা শুরু হয়েছে — অংশ নিতে পারেন</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-500 dark:text-slate-400 pt-1">
                                <span><i class="fa fa-clock-o text-blue-600 mr-1"></i> {{ $exam->duration_minutes }} Minutes</span>
                                <span><i class="fa fa-question-circle text-indigo-500 mr-1"></i> {{ $exam->questions->count() }} Questions</span>
                                <span><i class="fa fa-trophy text-amber-500 mr-1"></i> {{ (int)$exam->total_marks }} Total Marks (Pass: {{ (int)$exam->pass_marks }})</span>
                                @if($exam->max_attempts > 0)
                                    <span><i class="fa fa-repeat text-teal-600 mr-1"></i> সর্বোচ্চ {{ $exam->max_attempts }} বার পরীক্ষা</span>
                                @else
                                    <span><i class="fa fa-infinity text-teal-600 mr-1"></i> আনলিমিটেড চেষ্টা</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row md:flex-col items-stretch sm:items-center md:items-end gap-3 shrink-0 self-stretch md:self-center">
                            @if($isUpcoming)
                                <!-- Locked Button until start date -->
                                <button type="button" disabled 
                                        class="px-6 py-3.5 rounded-2xl font-extrabold text-xs uppercase tracking-wider bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-300 dark:border-slate-700 flex items-center justify-center gap-2 cursor-not-allowed shadow-none"
                                        title="পরীক্ষা শুরুর তারিখের পূর্বে অংশগ্রহণ করা যাবে না">
                                    <i class="fa fa-lock text-sm"></i>
                                    <span>@if($remainingDays > 0) {{ \App\model\LmsQuiz::toBengaliNumber($remainingDays) }} দিন বাকি (Locked) @else শুরু হতে বাকি (Locked) @endif</span>
                                </button>
                                <a href="{{ route('student.quiz.lobby', $exam->id) }}" 
                                   class="px-5 py-2.5 rounded-xl border border-blue-200 dark:border-blue-800 bg-blue-50/80 dark:bg-blue-950/50 hover:bg-blue-100 dark:hover:bg-blue-900/60 text-blue-700 dark:text-blue-300 font-bold text-xs flex items-center justify-center gap-1.5 transition-all text-center">
                                    <i class="fa fa-info-circle"></i>
                                    <span>লবি ও কাউন্টডাউন দেখুন</span>
                                </a>
                            @elseif($isExpired)
                                <button type="button" disabled 
                                        class="px-6 py-3.5 rounded-2xl font-extrabold text-xs uppercase tracking-wider bg-slate-200 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-300 dark:border-slate-700 flex items-center justify-center gap-2 cursor-not-allowed">
                                    <i class="fa fa-times-circle text-sm"></i>
                                    <span>সময় শেষ (Closed)</span>
                                </button>
                                <a href="{{ route('student.quiz.lobby', $exam->id) }}" 
                                   class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-300 font-bold text-xs flex items-center justify-center gap-1.5 transition-all text-center">
                                    <i class="fa fa-history"></i>
                                    <span>ফলাফল ও হিস্ট্রি</span>
                                </a>
                            @elseif($exam->questions->count() > 0)
                                <a href="{{ route('student.quiz.lobby', $exam->id) }}" 
                                   class="quiz-action-btn px-7 py-3.5 rounded-2xl font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 hover:scale-105">
                                    <i class="fa fa-play text-[10px]"></i>
                                    <span>পরীক্ষায় অংশ নিন (Enter Exam Hall)</span>
                                </a>
                            @else
                                <span class="px-5 py-3 rounded-2xl font-bold text-xs bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800 flex items-center justify-center gap-2">
                                    <i class="fa fa-clock-o"></i> প্রশ্ন প্রস্তুত হচ্ছে
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="quiz-card-surface rounded-3xl p-12 text-center max-w-lg mx-auto border relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center mx-auto mb-4 text-2xl border border-blue-500/20">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">No Scheduled Examinations</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                    You do not have any upcoming formal exams scheduled right now. You can prepare by taking practice tests.
                </p>
                <a href="{{ route('student.quiz.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-blue-600 text-white font-bold text-xs uppercase tracking-wider shadow-md hover:bg-blue-700 transition-all">
                    <span>Explore Practice Quizzes</span>
                </a>
            </div>
        @endif

    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        function toBngNum(num) {
            return String(num).replace(/[0-9]/g, function(d) { return bengaliDigits[d]; });
        }

        var cards = document.querySelectorAll('[data-countdown-start]');
        if (!cards.length) return;

        function updateTickers() {
            var now = new Date().getTime();
            var needsReload = false;

            cards.forEach(function(card) {
                var startStr = card.getAttribute('data-countdown-start');
                var examId = card.getAttribute('data-exam-id');
                if (!startStr) return;

                var targetTime = new Date(startStr).getTime();
                var diff = targetTime - now;

                if (diff <= 0) {
                    needsReload = true;
                    return;
                }

                var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                var counterEl = document.querySelector('.live-counter-' + examId);
                var remTextEl = document.querySelector('.remaining-text-' + examId);

                var parts = [];
                if (days > 0) parts.push(toBngNum(days) + ' দিন (' + days + 'd)');
                if (hours > 0) parts.push(toBngNum(hours) + ' ঘণ্টা (' + hours + 'h)');
                if (days === 0 && minutes > 0) parts.push(toBngNum(minutes) + ' মিনিট (' + minutes + 'm)');
                if (days === 0 && hours === 0) parts.push(toBngNum(seconds) + ' সেকেন্ড (' + seconds + 's)');

                var displayText = 'শুরু হতে বাকি: ' + parts.join(' ');
                if (counterEl) counterEl.textContent = displayText;
                if (remTextEl) remTextEl.textContent = displayText;
            });

            if (needsReload) {
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            }
        }

        updateTickers();
        setInterval(updateTickers, 1000);
    });
</script>
@endpush
