@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', $quiz->title . ' — Exam Lobby — Wake Up ICT')
@section('page_title', 'Assessment Lobby')
@section('page_crumb', $quiz->title)

@push('css')
<style>
    .quiz-glass-card {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
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
        box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05) !important;
    }
    html.light .quiz-card-inner {
        background-color: rgba(248, 250, 252, 0.8) !important;
        border-color: rgba(226, 232, 240, 0.8) !important;
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
    html.dark .quiz-card-inner {
        background-color: rgba(3, 7, 18, 0.6) !important;
        border-color: rgba(30, 41, 59, 0.8) !important;
    }
</style>
@endpush

@section('content')
<div class="relative w-full max-w-5xl mx-auto space-y-8 overflow-hidden py-4 sm:py-6">

    <!-- Ambient Aura -->
    <div class="absolute -left-28 top-10 w-96 sm:w-[500px] h-96 sm:h-[500px] bg-gradient-to-br from-blue-400/25 via-indigo-400/20 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute -right-28 top-28 w-96 sm:w-[480px] h-96 sm:h-[480px] bg-gradient-to-bl from-amber-300/25 via-orange-300/15 to-transparent rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Back Navigation -->
    <a href="{{ route('student.quiz.index') }}" 
       class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-blue-600 dark:hover:text-white transition-colors">
        <i class="fa fa-arrow-left"></i>
        <span>Back to Assessments</span>
    </a>

    <!-- Exam Hero Card -->
    <div class="quiz-glass-card quiz-card-surface rounded-3xl p-6 sm:p-9 border relative overflow-hidden space-y-6">

        <div class="space-y-3 relative z-10">
            <div class="flex flex-wrap items-center gap-2">
                @if($quiz->isUpcoming())
                    <span class="px-3 py-1 rounded-full bg-amber-500/15 border border-amber-500/30 text-amber-700 dark:text-amber-300 font-mono text-xs font-extrabold flex items-center gap-1.5 shadow-xs">
                        <i class="fa fa-calendar-check-o text-amber-600 dark:text-amber-400"></i>
                        <span>নির্ধারিত লাইভ পরীক্ষা (Scheduled Exam)</span>
                    </span>
                    <span class="px-3 py-1 rounded-full bg-indigo-500/15 border border-indigo-500/30 text-indigo-700 dark:text-indigo-300 font-mono text-xs font-extrabold flex items-center gap-1.5 shadow-xs">
                        <i class="fa fa-hourglass-start animate-pulse text-indigo-600 dark:text-indigo-400"></i>
                        <span>শুরু হতে বাকি: {{ $quiz->getRemainingTimeForHumans() }}</span>
                    </span>
                @elseif($quiz->isLiveNow() && $quiz->quiz_type === 'exam')
                    <span class="px-3 py-1 rounded-full bg-rose-500/15 border border-rose-500/30 text-rose-600 dark:text-rose-400 font-mono text-xs font-extrabold flex items-center gap-1.5 shadow-xs">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
                        </span>
                        <span>লাইভ পরীক্ষা চলমান (LIVE NOW)</span>
                    </span>
                @elseif($quiz->isExpired())
                    <span class="px-3 py-1 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-mono text-xs font-bold">
                        <i class="fa fa-calendar-times-o mr-1"></i> সময় সমাপ্ত (Closed)
                    </span>
                @endif
                <span class="px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 font-mono text-xs font-bold">
                    {{ $quiz->class_level ?: ($quiz->course ? $quiz->course->course_title : 'General Training') }}
                </span>
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-mono text-xs font-bold uppercase">
                    {{ $quiz->quiz_type }}
                </span>
            </div>

            <h1 class="quiz-card-title text-2xl sm:text-3xl font-extrabold tracking-tight leading-tight">
                {{ $quiz->title }}
            </h1>

            <p class="quiz-card-desc text-sm leading-relaxed max-w-3xl">
                {{ $quiz->description ?: 'Read all questions carefully and ensure you submit before the timer expires. Your score and performance breakdown will be generated immediately.' }}
            </p>
        </div>

        <!-- KPI Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 relative z-10 pt-2">
            <div class="quiz-card-inner p-4 rounded-2xl border text-center font-mono">
                <span class="text-xs text-slate-500 dark:text-slate-400 block mb-1 font-sans">Time Limit</span>
                <span class="text-xl font-black text-slate-900 dark:text-white">{{ $quiz->duration_minutes }} Mins</span>
            </div>
            <div class="quiz-card-inner p-4 rounded-2xl border text-center font-mono">
                <span class="text-xs text-slate-500 dark:text-slate-400 block mb-1 font-sans">Total Questions</span>
                <span class="text-xl font-black text-blue-600 dark:text-blue-400">{{ $quiz->questions->count() }}</span>
            </div>
            <div class="quiz-card-inner p-4 rounded-2xl border text-center font-mono">
                <span class="text-xs text-slate-500 dark:text-slate-400 block mb-1 font-sans">Total Marks</span>
                <span class="text-xl font-black text-emerald-600 dark:text-emerald-400">{{ (int)$quiz->total_marks }}</span>
            </div>
            <div class="quiz-card-inner p-4 rounded-2xl border text-center font-mono">
                <span class="text-xs text-slate-500 dark:text-slate-400 block mb-1 font-sans">Pass Marks</span>
                <span class="text-xl font-black text-amber-500">{{ (float)$quiz->pass_marks }}</span>
            </div>
        </div>

        @if($quiz->isUpcoming())
            <!-- Dedicated Live Countdown Box for Upcoming Scheduled Exam -->
            <div class="rounded-3xl p-6 sm:p-8 bg-gradient-to-br from-amber-500/10 via-orange-500/10 to-indigo-500/10 border-2 border-amber-500/30 text-center space-y-4 relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 text-amber-800 dark:text-amber-200 font-extrabold text-xs uppercase tracking-wider">
                    <i class="fa fa-calendar-check-o text-amber-600 dark:text-amber-400"></i>
                    <span>নির্ধারিত লাইভ পরীক্ষা (Scheduled Live Exam)</span>
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">
                    পরীক্ষা শুরু হতে বাকি (Time Remaining Until Start)
                </h2>
                <div class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 font-bold">
                    নির্ধারিত শুরুর সময়: <span class="text-blue-600 dark:text-blue-400 font-mono text-sm sm:text-base">{{ $quiz->start_time->format('d M Y, h:i A') }}</span> ({{ \App\model\LmsQuiz::toBengaliNumber($quiz->start_time->format('d/m/Y h:i A')) }})
                </div>

                <!-- Real-Time Countdown Blocks -->
                <div class="grid grid-cols-4 gap-2 sm:gap-4 max-w-lg mx-auto pt-2" id="lobbyCountdownGrid" data-countdown-target="{{ $quiz->start_time->toIso8601String() }}">
                    <div class="p-3 sm:p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-amber-600 dark:text-amber-400 font-mono" id="lobbyDays">00</div>
                        <div class="text-[10px] sm:text-xs text-slate-600 dark:text-slate-300 uppercase font-bold mt-1">দিন (Days)</div>
                    </div>
                    <div class="p-3 sm:p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-amber-600 dark:text-amber-400 font-mono" id="lobbyHours">00</div>
                        <div class="text-[10px] sm:text-xs text-slate-600 dark:text-slate-300 uppercase font-bold mt-1">ঘণ্টা (Hours)</div>
                    </div>
                    <div class="p-3 sm:p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-amber-600 dark:text-amber-400 font-mono" id="lobbyMins">00</div>
                        <div class="text-[10px] sm:text-xs text-slate-600 dark:text-slate-300 uppercase font-bold mt-1">মিনিট (Mins)</div>
                    </div>
                    <div class="p-3 sm:p-4 rounded-2xl bg-white/95 dark:bg-slate-900/95 border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="text-2xl sm:text-4xl font-black text-rose-600 dark:text-rose-400 font-mono" id="lobbySecs">00</div>
                        <div class="text-[10px] sm:text-xs text-slate-600 dark:text-slate-300 uppercase font-bold mt-1">সেকেন্ড (Secs)</div>
                    </div>
                </div>

                <p class="text-xs text-slate-600 dark:text-slate-300 max-w-lg mx-auto font-medium">
                    নির্ধারিত তারিখ ও সময়ের পূর্বে এই পরীক্ষায় অংশগ্রহণ করা সম্ভব নয়। কাউন্টডাউন শেষ হওয়া মাত্রই পেজটি স্বয়ংক্রিয়ভাবে উন্মুক্ত হবে।
                </p>
            </div>
        @endif

        <!-- Instructions Box -->
        <div class="quiz-card-inner p-5 sm:p-6 rounded-2xl border space-y-3 relative z-10">
            <h3 class="text-xs font-mono uppercase tracking-wider text-orange-600 dark:text-orange-400 font-bold flex items-center gap-2">
                <i class="fa fa-info-circle"></i>
                <span>Important Exam Instructions & Regulations</span>
            </h3>
            <ul class="text-xs text-slate-600 dark:text-slate-300 space-y-1.5 list-disc list-inside leading-relaxed">
                <li>Once you start, the server countdown timer runs continuously and cannot be paused.</li>
                <li>Your selected answers are automatically saved in real time as you make your choices.</li>
                <li>Do not reload or close your browser tab during the test. If you navigate away, the timer will still run.</li>
                <li>When the timer reaches zero, all answered questions are automatically submitted and graded.</li>
                <li>Review the question palette on the right to verify that all questions have been answered before submitting.</li>
            </ul>
        </div>

        <!-- Start Assessment CTA -->
        <div class="pt-4 border-t border-slate-200 dark:border-slate-800/80 flex flex-wrap items-center justify-between gap-4 relative z-10">
            <div class="text-xs font-mono text-slate-500 dark:text-slate-400">
                <span>Attempts: </span>
                <strong class="text-slate-900 dark:text-white font-bold">{{ $attempts->count() }}</strong>
                @if($quiz->max_attempts > 0)
                    <span> of {{ $quiz->max_attempts }} allowed</span>
                @else
                    <span> (Unlimited practice)</span>
                @endif
            </div>

            @if($activeAttempt)
                <a href="{{ route('student.quiz.take', $activeAttempt->id) }}" 
                   class="px-8 py-3.5 rounded-2xl btn-brand-primary font-bold text-xs uppercase tracking-wider transition-all shadow-lg flex items-center gap-2 hover:scale-105">
                    <i class="fa fa-play"></i>
                    <span>Resume In-Progress Exam</span>
                </a>
            @elseif($canAttempt)
                @if($quiz->questions->count() > 0 || ($quiz->paper_id && $quiz->paper && $quiz->paper->items()->count() > 0))
                    <form id="start-exam-form-main" action="{{ route('student.quiz.start', $quiz->id) }}" method="POST">
                        @csrf
                        <button type="button" onclick="confirmStartExam('start-exam-form-main', '{{ addslashes($quiz->title) }}', '{{ $quiz->duration_minutes }}', '{{ $quiz->total_questions ? $toBng($quiz->total_questions) . 'টি' : 'নির্ধারিত' }}')"
                                class="px-8 py-3.5 rounded-2xl btn-brand-primary font-bold text-xs uppercase tracking-wider transition-all shadow-lg flex items-center gap-2 hover:scale-105">
                            <i class="fa fa-play"></i>
                            <span>Start Assessment Now</span>
                        </button>
                    </form>
                @elseif($attempts->count() > 0)
                    <form id="retake-exam-form-lobby" action="{{ route('student.quiz.retake', $attempts->first()->id) }}" method="POST">
                        @csrf
                        <button type="button" onclick="confirmStartExam('retake-exam-form-lobby', '{{ addslashes($quiz->title) }} (পুনঃপরীক্ষা)', '{{ $quiz->duration_minutes }}', 'পূর্ববর্তী সেট')"
                                class="px-8 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-emerald-600/25 flex items-center gap-2 hover:scale-105">
                            <i class="fa fa-repeat"></i>
                            <span>পূর্ববর্তী প্রশ্নে পুনরায় পরীক্ষা দিন (Retake Exam)</span>
                        </button>
                    </form>
                @elseif($quiz->quiz_type === 'practice')
                    <form id="practice-exam-form-lobby" action="{{ route('student.practice.start') }}" method="POST">
                        @csrf
                        <button type="button" onclick="confirmStartExam('practice-exam-form-lobby', '{{ addslashes($quiz->title) }} (অনুশীলন)', '{{ $quiz->duration_minutes }}', '{{ $quiz->total_questions ? $toBng($quiz->total_questions) . 'টি' : 'অনুশীলন প্রশ্ন' }}')"
                                class="px-8 py-3.5 rounded-2xl btn-brand-primary font-bold text-xs uppercase tracking-wider transition-all shadow-lg flex items-center gap-2 hover:scale-105">
                            <i class="fa fa-play"></i>
                            <span>Start Assessment Now (অনুশীলন পরীক্ষা)</span>
                        </button>
                    </form>
                @else
                    <button type="button" disabled class="px-8 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-500 font-bold text-xs uppercase tracking-wider cursor-not-allowed flex items-center gap-2">
                        <i class="fa fa-clock-o"></i>
                        <span>প্রশ্ন প্রস্তুত হচ্ছে (No Questions Yet)</span>
                    </button>
                @endif
            @elseif($quiz->isUpcoming())
                <button type="button" disabled class="px-8 py-3.5 rounded-2xl bg-amber-100 dark:bg-amber-950/70 text-amber-800 dark:text-amber-300 border border-amber-300 dark:border-amber-700 font-extrabold text-xs uppercase tracking-wider cursor-not-allowed flex items-center gap-2 shadow-xs" title="নির্ধারিত সময়ের পূর্বে পরীক্ষা শুরু করা যাবে না">
                    <i class="fa fa-lock text-sm"></i>
                    <span>পরীক্ষা শুরুর অপেক্ষা (Locked Until Scheduled Start)</span>
                </button>
            @elseif($quiz->isExpired())
                <button type="button" disabled class="px-6 py-3.5 rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-500 font-bold text-xs uppercase tracking-wider cursor-not-allowed flex items-center gap-2">
                    <i class="fa fa-times-circle text-sm"></i>
                    <span>সময় সমাপ্ত (Exam Deadline Ended)</span>
                </button>
            @else
                <button disabled class="px-6 py-3 rounded-2xl bg-slate-200 dark:bg-slate-800 text-slate-400 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                    <i class="fa fa-ban mr-1"></i> Maximum Attempts Reached
                </button>
            @endif
        </div>
    </div>

    <!-- Prior Attempt History on this Quiz -->
    @if($attempts->count() > 0)
        <div class="space-y-4">
            <h2 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i class="fa fa-history text-blue-600"></i>
                <span>Your Previous Attempts</span>
            </h2>

            <div class="quiz-glass-card quiz-card-surface rounded-2xl border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-100/80 dark:bg-slate-950/80 text-slate-500 dark:text-slate-400 uppercase text-[10px] border-b border-slate-200 dark:border-slate-800">
                            <tr>
                                <th class="p-3.5">Attempt #</th>
                                <th class="p-3.5">Date & Time</th>
                                <th class="p-3.5">Score</th>
                                <th class="p-3.5">Percentage</th>
                                <th class="p-3.5">Status</th>
                                <th class="p-3.5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800/60 text-slate-700 dark:text-slate-300">
                            @foreach($attempts as $att)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-850/40 transition-colors">
                                    <td class="p-3.5 font-bold text-slate-900 dark:text-white">#{{ $att->attempt_number }}</td>
                                    <td class="p-3.5 text-slate-500 dark:text-slate-400">{{ $att->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="p-3.5 font-bold {{ $att->isPassed() ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                        {{ $att->score }} / {{ (int)$quiz->total_marks }}
                                    </td>
                                    <td class="p-3.5">{{ $att->percentage }}%</td>
                                    <td class="p-3.5">
                                        @if($att->status === 'in_progress')
                                            <span class="px-2 py-0.5 rounded bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[10px] font-bold">In Progress</span>
                                        @elseif($att->isPassed())
                                            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold">Passed</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-600 dark:text-rose-400 text-[10px] font-bold">Failed</span>
                                        @endif
                                    </td>
                                    <td class="p-3.5 text-right">
                                        <div class="flex items-center justify-end gap-2.5">
                                            <a href="{{ route('student.quiz.results', $att->id) }}" class="text-blue-600 hover:underline font-bold text-xs">
                                                Review Sheet &rarr;
                                            </a>
                                            <form id="retake-att-form-{{ $att->id }}" action="{{ route('student.quiz.retake', $att->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="button" onclick="confirmStartExam('retake-att-form-{{ $att->id }}', '{{ addslashes($quiz->title) }} (পুনঃপরীক্ষা #{{ $att->attempt_number }})', '{{ $quiz->duration_minutes }}', 'পূর্ববর্তী সেট')" class="text-emerald-600 hover:text-emerald-700 hover:underline font-bold text-xs flex items-center gap-1 cursor-pointer" title="এই প্রশ্নে পুনরায় পরীক্ষা দিন">
                                                    <i class="fa fa-repeat"></i> পুনরায়
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</div>

    <!-- Exam Start Confirmation Modal -->
    <div id="exam-start-confirm-modal" class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md hidden items-center justify-center p-4">
        <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-5 text-center">
            <!-- Icon -->
            <div class="w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20 flex items-center justify-center mx-auto text-3xl">
                <i class="fa fa-play-circle"></i>
            </div>

            <div>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                    পরীক্ষা শুরু নিশ্চিতকরণ
                </span>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mt-2.5">
                    আপনি কি পরীক্ষা শুরু করতে প্রস্তুত?
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-300 mt-1 leading-relaxed">
                    "শুরু করুন" চাপার সাথে সাথেই আপনার পরীক্ষার সার্ভার কাউন্টডাউন টাইমার চালু হয়ে যাবে।
                </p>

                <!-- Exam Specs Card -->
                <div class="p-3.5 my-3 rounded-2xl bg-slate-100 dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 text-xs space-y-1.5 text-left font-mono">
                    <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                        <span class="text-slate-500 dark:text-slate-400">পরীক্ষার নাম:</span>
                        <strong class="text-slate-900 dark:text-white truncate max-w-[200px]" id="start-confirm-title">{{ $quiz->title }}</strong>
                    </div>
                    <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                        <span class="text-slate-500 dark:text-slate-400">সময়সীমা:</span>
                        <strong class="text-emerald-600 dark:text-emerald-400" id="start-confirm-duration">{{ $quiz->duration_minutes }} মিনিট</strong>
                    </div>
                    <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                        <span class="text-slate-500 dark:text-slate-400">মোট প্রশ্ন:</span>
                        <strong class="text-slate-900 dark:text-white" id="start-confirm-questions">{{ $quiz->total_questions ? $toBng($quiz->total_questions) . 'টি' : 'নির্ধারিত' }}</strong>
                    </div>
                    <div class="flex justify-between items-center text-slate-700 dark:text-slate-300">
                        <span class="text-slate-500 dark:text-slate-400">পাস মার্ক:</span>
                        <strong class="text-blue-600 dark:text-blue-400">{{ (float)$quiz->pass_marks }}</strong>
                    </div>
                </div>

                <p class="text-[11px] text-rose-600 dark:text-rose-400 font-semibold leading-normal">
                    ⚠️ সতর্কতা: পরীক্ষা চলাকালীন ব্রাউজার বন্ধ বা ট্যাব পরিবর্তন করবেন না।
                </p>
            </div>

            <div class="flex items-center justify-center gap-3 pt-1">
                <button type="button" onclick="closeStartConfirmModal()" class="w-1/2 py-3 rounded-xl bg-slate-200 dark:bg-slate-800 hover:bg-slate-300 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs transition-colors">
                    বাতিল (Cancel)
                </button>
                <button type="button" onclick="proceedStartExam()" class="w-1/2 py-3 rounded-xl btn-brand-primary font-black text-xs uppercase tracking-wider transition-all shadow-md">
                    হ্যাঁ, শুরু করুন &rarr;
                </button>
            </div>
        </div>
    </div>

    <script>
        var pendingStartFormId = null;

        function confirmStartExam(formId, title, duration, questions) {
            pendingStartFormId = formId;
            var tEl = document.getElementById('start-confirm-title');
            var dEl = document.getElementById('start-confirm-duration');
            var qEl = document.getElementById('start-confirm-questions');
            if (tEl) tEl.innerText = title;
            if (dEl) dEl.innerText = duration + ' মিনিট';
            if (qEl) qEl.innerText = questions;

            var modal = document.getElementById('exam-start-confirm-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeStartConfirmModal() {
            var modal = document.getElementById('exam-start-confirm-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            pendingStartFormId = null;
        }

        function proceedStartExam() {
            if (pendingStartFormId) {
                var form = document.getElementById(pendingStartFormId);
                if (form) {
                    form.submit();
                }
            }
        }

        // Live Countdown Ticker for Lobby
        document.addEventListener('DOMContentLoaded', function() {
            var grid = document.getElementById('lobbyCountdownGrid');
            if (!grid) return;

            var targetStr = grid.getAttribute('data-countdown-target');
            if (!targetStr) return;

            var targetTime = new Date(targetStr).getTime();
            var bngDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            function toBngNum(num) {
                var pad = (num < 10 ? '0' : '') + num;
                return pad.replace(/[0-9]/g, function(d) { return bngDigits[d]; });
            }

            function updateLobbyTicker() {
                var now = new Date().getTime();
                var diff = targetTime - now;

                if (diff <= 0) {
                    var daysEl = document.getElementById('lobbyDays');
                    var hoursEl = document.getElementById('lobbyHours');
                    var minsEl = document.getElementById('lobbyMins');
                    var secsEl = document.getElementById('lobbySecs');
                    if (daysEl) daysEl.innerText = '০০';
                    if (hoursEl) hoursEl.innerText = '০০';
                    if (minsEl) minsEl.innerText = '০০';
                    if (secsEl) secsEl.innerText = '০০';

                    setTimeout(function() {
                        window.location.reload();
                    }, 1200);
                    return;
                }

                var days = Math.floor(diff / (1000 * 60 * 60 * 24));
                var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                var secs = Math.floor((diff % (1000 * 60)) / 1000);

                var daysEl = document.getElementById('lobbyDays');
                var hoursEl = document.getElementById('lobbyHours');
                var minsEl = document.getElementById('lobbyMins');
                var secsEl = document.getElementById('lobbySecs');

                if (daysEl) daysEl.innerText = toBngNum(days);
                if (hoursEl) hoursEl.innerText = toBngNum(hours);
                if (minsEl) minsEl.innerText = toBngNum(mins);
                if (secsEl) secsEl.innerText = toBngNum(secs);
            }

            updateLobbyTicker();
            setInterval(updateLobbyTicker, 1000);
        });
    </script>
@endsection
