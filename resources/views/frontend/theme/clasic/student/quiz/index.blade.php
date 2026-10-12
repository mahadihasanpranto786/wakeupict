@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Online Quizzes & Assessments — Wake Up ICT')
@section('page_title', 'Online Quizzes')
@section('page_crumb', 'Quizzes & Practice Tests')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header & Action -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-pencil-square-o text-brand-primary"></i>
                <span>Online Quizzes & Assessments</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Evaluate your knowledge with chapter-wise quizzes, practice exams, and NCTB Academic ICT mock tests.
            </p>
        </div>

        <!-- Filter & Search -->
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('student.quiz.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold {{ !request('class') && !request('type') ? 'bg-brand-primary text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-300 hover:text-white' }} transition-colors">
                All Tests
            </a>
            <a href="{{ route('student.quiz.index', ['class' => 'Class 6-7']) }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold {{ request('class') == 'Class 6-7' ? 'bg-brand-primary text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-300 hover:text-white' }} transition-colors">
                Class 6–7 ICT
            </a>
            <a href="{{ route('student.quiz.index', ['class' => 'Class 8-10']) }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold {{ request('class') == 'Class 8-10' ? 'bg-brand-primary text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-300 hover:text-white' }} transition-colors">
                Class 8–10 ICT
            </a>
            <a href="{{ route('student.quiz.index', ['class' => 'Professional']) }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold {{ request('class') == 'Professional' ? 'bg-brand-primary text-slate-950 font-bold' : 'bg-slate-900 border border-slate-800 text-slate-300 hover:text-white' }} transition-colors">
                Professional
            </a>
        </div>
    </div>

    <!-- Quizzes Grid -->
    @if($quizzes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
                @php
                    $stat = isset($attemptStats[$quiz->id]) ? $attemptStats[$quiz->id] : ['count' => 0, 'best_score' => null, 'passed' => false];
                    $hasPassed = $stat['passed'];
                    $attemptCount = $stat['count'];
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    
                    <div class="space-y-3">
                        <!-- Top Badges -->
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-[11px] font-semibold">
                                {{ $quiz->class_level ?: ($quiz->course ? $quiz->course->course_title : 'General ICT') }}
                            </span>

                            @if($hasPassed)
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                    <i class="fa fa-check-circle"></i> Passed
                                </span>
                            @elseif($attemptCount > 0)
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                    <i class="fa fa-repeat"></i> {{ $attemptCount }} Attempt(s)
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan font-mono text-[10px] font-bold">
                                    New
                                </span>
                            @endif
                        </div>

                        <!-- Title -->
                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $quiz->title }}
                        </h3>

                        <!-- Description -->
                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $quiz->description ?: 'Comprehensive assessment aligned with curriculum syllabus standards.' }}
                        </p>

                        <!-- Assessment Meta Items -->
                        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-slate-800/60 text-center font-mono">
                            <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800/80">
                                <span class="text-[10px] text-slate-500 block">Questions</span>
                                <span class="text-xs font-bold text-white">{{ $quiz->questions->count() }}</span>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800/80">
                                <span class="text-[10px] text-slate-500 block">Time</span>
                                <span class="text-xs font-bold text-white">{{ $quiz->duration_minutes }}m</span>
                            </div>
                            <div class="p-2 rounded-xl bg-slate-950/60 border border-slate-800/80">
                                <span class="text-[10px] text-slate-500 block">Marks</span>
                                <span class="text-xs font-bold text-brand-primary">{{ (int)$quiz->total_marks }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between gap-3">
                        @if($stat['best_score'] !== null)
                            <div class="text-xs font-mono">
                                <span class="text-slate-500">Best:</span>
                                <strong class="text-brand-primary">{{ $stat['best_score'] }}/{{ (int)$quiz->total_marks }}</strong>
                            </div>
                        @else
                            <span class="text-xs text-slate-500 font-mono">Not attempted</span>
                        @endif

                        <a href="{{ route('student.quiz.lobby', $quiz->id) }}" class="px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5">
                            <span>{{ $attemptCount > 0 ? 'Retake / Review' : 'Start Quiz' }}</span>
                            <i class="fa fa-arrow-right"></i>
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
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-file-text-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Quizzes Found</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                No assessments found matching your filter criteria. Check back soon as teachers publish new tests.
            </p>
            <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <span>View All Tests</span>
            </a>
        </div>
    @endif

</div>
@endsection
