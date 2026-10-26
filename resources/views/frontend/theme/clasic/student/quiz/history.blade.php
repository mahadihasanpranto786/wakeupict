@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Examination & Quiz Results History — Wake Up ICT')
@section('page_title', 'Results History')
@section('page_crumb', 'Performance Records')

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
</style>
@endpush

@section('content')
<!-- Full-Wrapper Container spanning edge-to-edge -->
<div class="-m-4 sm:-m-8 p-4 sm:p-8 min-h-[calc(100vh-5rem)] relative overflow-hidden">

    <!-- Central Inner Content -->
    <div class="w-full max-w-[1600px] mx-auto space-y-8 relative z-10">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-slate-800/80">
            <div class="max-w-2xl space-y-2">
                <div class="quiz-subheading text-xs sm:text-sm font-extrabold uppercase tracking-widest flex items-center gap-2">
                    <span>Performance Archive</span>
                </div>
                <h1 class="quiz-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Results History
                </h1>
                <p class="quiz-card-desc text-xs sm:text-sm lg:text-base leading-relaxed max-w-xl">
                    Historical record of all your completed online assessments, board practice drills, and certifications.
                </p>
            </div>

            <a href="{{ route('student.quiz.index') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold uppercase tracking-wider transition-all shadow-lg shadow-blue-600/20 hover:scale-105 self-start sm:self-auto">
                <i class="fa fa-pencil"></i>
                <span>Take New Quiz</span>
            </a>
        </div>

        @if($attempts->count() > 0)
            <!-- KPI Cards -->
            @php
                $totalAttempts = $attempts->total();
                $passedAttempts = $attempts->filter(function($a) { return $a->isPassed(); })->count();
                $avgPct = (int) round($attempts->avg('percentage'));
                $maxScore = $attempts->max('score');
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 font-mono">
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Total Attempts</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">{{ $totalAttempts }}</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Passed Assessments</span>
                    <span class="text-2xl font-black text-emerald-600 dark:text-emerald-400">{{ $passedAttempts }}</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Average Percentage</span>
                    <span class="text-2xl font-black text-blue-600 dark:text-blue-400">{{ $avgPct }}%</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Top Score</span>
                    <span class="text-2xl font-black text-amber-500">{{ $maxScore }}</span>
                </div>
            </div>

            <!-- History Records Table -->
            <div class="quiz-glass-card quiz-card-surface rounded-3xl border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-100/80 dark:bg-slate-950/80 text-slate-500 dark:text-slate-400 uppercase text-[10px] border-b border-slate-200 dark:border-slate-800">
                            <tr>
                                <th class="p-4">Assessment Title</th>
                                <th class="p-4">Track / Level</th>
                                <th class="p-4">Completion Date</th>
                                <th class="p-4">Score</th>
                                <th class="p-4">Percentage</th>
                                <th class="p-4">Result</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800/60 text-slate-700 dark:text-slate-300">
                            @foreach($attempts as $att)
                                @php
                                    $q = $att->quiz;
                                    $passed = $att->isPassed();
                                @endphp
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-850/40 transition-colors">
                                    <td class="p-4 font-bold text-slate-900 dark:text-white max-w-xs truncate">
                                        {{ $q ? $q->title : 'Assessment #' . $att->quiz_id }}
                                    </td>
                                    <td class="p-4 text-slate-500 dark:text-slate-400">
                                        {{ $q ? ($q->class_level ?: 'Professional') : '-' }}
                                    </td>
                                    <td class="p-4 text-slate-500 dark:text-slate-400">
                                        {{ $att->submitted_at ? $att->submitted_at->format('M d, Y h:i A') : $att->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="p-4 font-bold {{ $passed ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                        {{ $att->score }} / {{ (int)$att->total_marks }}
                                    </td>
                                    <td class="p-4">
                                        {{ $att->percentage }}%
                                    </td>
                                    <td class="p-4">
                                        @if($passed)
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold">
                                                Passed
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-[10px] font-bold">
                                                Failed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <a href="{{ route('student.quiz.results', $att->id) }}" class="px-3.5 py-1.5 rounded-xl bg-blue-50 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white border border-blue-200 dark:border-blue-900 text-xs font-bold transition-all">
                                            Review Sheet &rarr;
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                    {{ $attempts->links() }}
                </div>
            </div>

        @else
            <div class="quiz-card-surface rounded-3xl p-12 text-center max-w-lg mx-auto border relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center mx-auto mb-4 text-2xl border border-blue-500/20">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">No Results Recorded Yet</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                    You haven't completed any online quizzes or examinations yet. Once you submit an assessment, your score and detailed review will appear here.
                </p>
                <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-blue-600 text-white font-bold text-xs uppercase tracking-wider shadow-md hover:bg-blue-700 transition-all">
                    <span>Explore Assessments</span>
                </a>
            </div>
        @endif

    </div>

</div>
@endsection
