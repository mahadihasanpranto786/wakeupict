@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Self-Paced Practice Tests — Wake Up ICT')
@section('page_title', 'Practice Tests')
@section('page_crumb', 'Practice Mode')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-refresh text-brand-primary"></i>
                <span>Practice Tests & Mock Drills</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Unlimited retakes with instant explanations to master concepts at your own pace.
            </p>
        </div>
        <a href="{{ route('student.results.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-bar-chart"></i>
            <span>My Results History</span>
        </a>
    </div>

    @if($quizzes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-[11px] font-semibold">
                                {{ $quiz->class_level ?: 'Self Practice' }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan font-mono text-[10px] font-bold">
                                Unlimited Attempts
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $quiz->title }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $quiz->description ?: 'Practice test with answers and educational explanations.' }}
                        </p>

                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 pt-2 border-t border-slate-800/60">
                            <span><i class="fa fa-question-circle mr-1"></i> {{ $quiz->questions->count() }} Questions</span>
                            <span><i class="fa fa-clock-o mr-1"></i> {{ $quiz->duration_minutes }} Mins</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-800/80">
                        <a href="{{ route('student.quiz.lobby', $quiz->id) }}" class="w-full justify-center px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                            <i class="fa fa-play"></i>
                            <span>Start Practice Session</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $quizzes->links() }}
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <h3 class="text-base font-bold text-white mb-2">No Practice Sets Available</h3>
            <p class="text-xs text-slate-400">All available assessments will appear here.</p>
        </div>
    @endif

</div>
@endsection
