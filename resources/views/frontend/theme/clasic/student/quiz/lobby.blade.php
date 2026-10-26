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
                <span class="text-xl font-black text-amber-500">{{ (int)$quiz->pass_marks }}</span>
            </div>
        </div>

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
                   class="px-8 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-blue-600/25 flex items-center gap-2 hover:scale-105">
                    <i class="fa fa-play"></i>
                    <span>Resume In-Progress Exam</span>
                </a>
            @elseif($canAttempt)
                <form action="{{ route('student.quiz.start', $quiz->id) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="px-8 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-blue-600/25 flex items-center gap-2 hover:scale-105">
                        <i class="fa fa-play"></i>
                        <span>Start Assessment Now</span>
                    </button>
                </form>
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
                                        <a href="{{ route('student.quiz.results', $att->id) }}" class="text-blue-600 hover:underline font-bold">
                                            Review Sheet &rarr;
                                        </a>
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
@endsection
