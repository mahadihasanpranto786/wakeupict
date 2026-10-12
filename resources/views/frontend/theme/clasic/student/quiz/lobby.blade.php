@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', $quiz->title . ' — Exam Lobby — Wake Up ICT')
@section('page_title', 'Assessment Lobby')
@section('page_crumb', $quiz->title)

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Back Navigation -->
    <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
        <i class="fa fa-arrow-left"></i>
        <span>Back to Assessments</span>
    </a>

    <!-- Exam Hero Card -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl relative overflow-hidden space-y-6">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-brand-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="space-y-3 relative z-10">
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-xs font-semibold">
                    {{ $quiz->class_level ?: ($quiz->course ? $quiz->course->course_title : 'General Training') }}
                </span>
                <span class="px-3 py-1 rounded-full bg-slate-800/60 border border-slate-700/60 text-slate-300 font-mono text-xs uppercase">
                    {{ $quiz->quiz_type }}
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-tight">
                {{ $quiz->title }}
            </h1>

            <p class="text-sm text-slate-300 leading-relaxed max-w-3xl">
                {{ $quiz->description ?: 'Read all questions carefully and ensure you submit before the timer expires.' }}
            </p>
        </div>

        <!-- KPI Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 relative z-10 pt-2">
            <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800 text-center font-mono">
                <span class="text-xs text-slate-400 block mb-1">Time Limit</span>
                <span class="text-xl font-black text-white">{{ $quiz->duration_minutes }} Mins</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800 text-center font-mono">
                <span class="text-xs text-slate-400 block mb-1">Total Questions</span>
                <span class="text-xl font-black text-brand-cyan">{{ $quiz->questions->count() }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800 text-center font-mono">
                <span class="text-xs text-slate-400 block mb-1">Total Marks</span>
                <span class="text-xl font-black text-brand-primary">{{ (int)$quiz->total_marks }}</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800 text-center font-mono">
                <span class="text-xs text-slate-400 block mb-1">Pass Marks</span>
                <span class="text-xl font-black text-amber-400">{{ (int)$quiz->pass_marks }}</span>
            </div>
        </div>

        <!-- Instructions Box -->
        <div class="p-5 rounded-2xl bg-slate-950/50 border border-slate-800/80 space-y-3 relative z-10">
            <h3 class="text-xs font-mono uppercase tracking-wider text-brand-primary font-bold flex items-center gap-2">
                <i class="fa fa-info-circle"></i>
                <span>Important Exam Instructions & Regulations</span>
            </h3>
            <ul class="text-xs text-slate-300 space-y-1.5 list-disc list-inside leading-relaxed">
                <li>Once you start, the server countdown timer runs continuously and cannot be paused.</li>
                <li>Your selected answers are automatically saved in real time as you make your choices.</li>
                <li>Do not reload or close your browser tab during the test. If you navigate away, the timer will still run.</li>
                <li>When the timer reaches zero, all answered questions are automatically submitted and graded.</li>
                <li>Review the question palette on the right to verify that all questions have been answered before submitting.</li>
            </ul>
        </div>

        <!-- Start Assessment CTA -->
        <div class="pt-4 border-t border-slate-800/80 flex flex-wrap items-center justify-between gap-4 relative z-10">
            <div class="text-xs font-mono text-slate-400">
                <span>Attempts: </span>
                <strong class="text-white">{{ $attempts->count() }}</strong>
                @if($quiz->max_attempts > 0)
                    <span> of {{ $quiz->max_attempts }} allowed</span>
                @else
                    <span> (Unlimited practice)</span>
                @endif
            </div>

            @if($activeAttempt)
                <a href="{{ route('student.quiz.take', $activeAttempt->id) }}" class="px-8 py-3.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                    <i class="fa fa-play"></i>
                    <span>Resume In-Progress Exam</span>
                </a>
            @elseif($canAttempt)
                <form action="{{ route('student.quiz.start', $quiz->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-8 py-3.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                        <i class="fa fa-play"></i>
                        <span>Start Assessment Now</span>
                    </button>
                </form>
            @else
                <button disabled class="px-6 py-3 rounded-xl bg-slate-800 text-slate-500 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                    <i class="fa fa-ban mr-1"></i> Maximum Attempts Reached
                </button>
            @endif
        </div>
    </div>

    <!-- Prior Attempt History on this Quiz -->
    @if($attempts->count() > 0)
        <div class="space-y-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa fa-history text-brand-primary"></i>
                <span>Your Previous Attempts</span>
            </h2>

            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 overflow-hidden backdrop-blur-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] border-b border-slate-800">
                            <tr>
                                <th class="p-3.5">Attempt #</th>
                                <th class="p-3.5">Date & Time</th>
                                <th class="p-3.5">Score</th>
                                <th class="p-3.5">Percentage</th>
                                <th class="p-3.5">Status</th>
                                <th class="p-3.5 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-slate-300">
                            @foreach($attempts as $att)
                                <tr class="hover:bg-slate-850/40 transition-colors">
                                    <td class="p-3.5 font-bold text-white">#{{ $att->attempt_number }}</td>
                                    <td class="p-3.5 text-slate-400">{{ $att->created_at->format('M d, Y h:i A') }}</td>
                                    <td class="p-3.5 font-bold {{ $att->isPassed() ? 'text-brand-primary' : 'text-rose-400' }}">
                                        {{ $att->score }} / {{ (int)$quiz->total_marks }}
                                    </td>
                                    <td class="p-3.5">{{ $att->percentage }}%</td>
                                    <td class="p-3.5">
                                        @if($att->status === 'in_progress')
                                            <span class="px-2 py-0.5 rounded bg-amber-500/10 text-amber-400 text-[10px] font-bold">In Progress</span>
                                        @elseif($att->isPassed())
                                            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[10px] font-bold">Passed</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 text-[10px] font-bold">Failed</span>
                                        @endif
                                    </td>
                                    <td class="p-3.5 text-right">
                                        <a href="{{ route('student.quiz.results', $att->id) }}" class="text-brand-primary hover:underline font-semibold">
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
