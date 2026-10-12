@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Upcoming Examinations — Wake Up ICT')
@section('page_title', 'Upcoming Exams')
@section('page_crumb', 'Examination Schedule')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-calendar-check-o text-brand-primary"></i>
                <span>Upcoming Examinations & Board Tests</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Official certification assessments and NCTB board-standard model examinations.
            </p>
        </div>
        <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-pencil"></i>
            <span>All Practice Quizzes</span>
        </a>
    </div>

    @if($exams->count() > 0)
        <div class="space-y-4">
            @foreach($exams as $exam)
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 backdrop-blur-xl hover:border-slate-700 transition-all">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 font-mono text-[10px] font-bold uppercase">
                                Formal Exam
                            </span>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                {{ $exam->class_level ?: 'Course Certification' }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-white">
                            {{ $exam->title }}
                        </h3>
                        <p class="text-xs text-slate-400 max-w-2xl leading-relaxed">
                            {{ $exam->description }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-400 pt-1">
                            <span><i class="fa fa-clock-o text-brand-primary mr-1"></i> {{ $exam->duration_minutes }} Minutes</span>
                            <span><i class="fa fa-question-circle text-brand-cyan mr-1"></i> {{ $exam->questions->count() }} Questions</span>
                            <span><i class="fa fa-trophy text-amber-400 mr-1"></i> {{ (int)$exam->total_marks }} Total Marks (Pass: {{ (int)$exam->pass_marks }})</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 self-end md:self-auto shrink-0">
                        <a href="{{ route('student.quiz.lobby', $exam->id) }}" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                            <i class="fa fa-play"></i>
                            <span>Enter Exam Hall</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-calendar-check-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Scheduled Examinations</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                You do not have any upcoming formal exams scheduled right now. You can prepare by taking practice tests.
            </p>
            <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <span>Explore Practice Quizzes</span>
            </a>
        </div>
    @endif

</div>
@endsection
