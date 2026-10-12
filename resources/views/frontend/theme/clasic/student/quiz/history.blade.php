@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Examination & Quiz Results History — Wake Up ICT')
@section('page_title', 'Results History')
@section('page_crumb', 'Performance Records')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-bar-chart text-brand-primary"></i>
                <span>Examination & Quiz Results Archive</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Historical record of all your completed online assessments, board practice drills, and certifications.
            </p>
        </div>
        <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 text-xs font-bold uppercase tracking-wider transition-all shadow-glow-emerald self-start sm:self-auto">
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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 font-mono">
            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <span class="text-xs text-slate-400 uppercase block mb-1">Total Attempts</span>
                <span class="text-2xl font-black text-white">{{ $totalAttempts }}</span>
            </div>
            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <span class="text-xs text-slate-400 uppercase block mb-1">Passed Assessments</span>
                <span class="text-2xl font-black text-emerald-400">{{ $passedAttempts }}</span>
            </div>
            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <span class="text-xs text-slate-400 uppercase block mb-1">Average Percentage</span>
                <span class="text-2xl font-black text-brand-cyan">{{ $avgPct }}%</span>
            </div>
            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <span class="text-xs text-slate-400 uppercase block mb-1">Top Score</span>
                <span class="text-2xl font-black text-amber-400">{{ $maxScore }}</span>
            </div>
        </div>

        <!-- History Records Table -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden backdrop-blur-xl shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono">
                    <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] border-b border-slate-800">
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
                    <tbody class="divide-y divide-slate-800/60 text-slate-300">
                        @foreach($attempts as $att)
                            @php
                                $q = $att->quiz;
                                $passed = $att->isPassed();
                            @endphp
                            <tr class="hover:bg-slate-850/40 transition-colors">
                                <td class="p-4 font-bold text-white max-w-xs truncate">
                                    {{ $q ? $q->title : 'Assessment #' . $att->quiz_id }}
                                </td>
                                <td class="p-4 text-slate-400">
                                    {{ $q ? ($q->class_level ?: 'Professional') : '-' }}
                                </td>
                                <td class="p-4 text-slate-400">
                                    {{ $att->submitted_at ? $att->submitted_at->format('M d, Y h:i A') : $att->created_at->format('M d, Y') }}
                                </td>
                                <td class="p-4 font-bold {{ $passed ? 'text-brand-primary' : 'text-rose-400' }}">
                                    {{ $att->score }} / {{ (int)$att->total_marks }}
                                </td>
                                <td class="p-4">
                                    {{ $att->percentage }}%
                                </td>
                                <td class="p-4">
                                    @if($passed)
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold">
                                            Passed
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-[10px] font-bold">
                                            Failed
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('student.quiz.results', $att->id) }}" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-brand-primary hover:text-slate-950 text-slate-300 text-xs font-semibold transition-all">
                                        Review Sheet &rarr;
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-800/60">
                {{ $attempts->links() }}
            </div>
        </div>

    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-bar-chart"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Results Recorded Yet</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                You haven't completed any online quizzes or examinations yet. Once you submit an assessment, your score and detailed review will appear here.
            </p>
            <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <span>Explore Assessments</span>
            </a>
        </div>
    @endif

</div>
@endsection
