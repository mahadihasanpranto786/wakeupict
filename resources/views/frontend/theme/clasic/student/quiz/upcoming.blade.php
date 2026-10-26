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
<div class="-m-4 sm:-m-8 p-4 sm:p-8 min-h-[calc(100vh-5rem)] relative overflow-hidden">

    <!-- Ambient Atmosphere Aura spanning entire canvas from sidebar to right edge -->
    <div class="absolute -top-16 -left-20 w-[620px] sm:w-[750px] h-[620px] sm:h-[750px] bg-gradient-to-br from-blue-400/30 via-indigo-400/20 to-transparent rounded-full blur-[130px] pointer-events-none -z-10"></div>
    <div class="absolute -top-10 -right-20 w-[600px] sm:w-[720px] h-[600px] sm:h-[720px] bg-gradient-to-bl from-amber-300/30 via-orange-300/20 to-transparent rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute -left-20 bottom-10 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-blue-500/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>

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
                    <div class="quiz-glass-card quiz-card-surface rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 border">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 font-mono text-[10px] font-bold uppercase">
                                    Formal Exam
                                </span>
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
                            <div class="flex flex-wrap items-center gap-4 text-xs font-mono text-slate-500 dark:text-slate-400 pt-1">
                                <span><i class="fa fa-clock-o text-blue-600 mr-1"></i> {{ $exam->duration_minutes }} Minutes</span>
                                <span><i class="fa fa-question-circle text-indigo-500 mr-1"></i> {{ $exam->questions->count() }} Questions</span>
                                <span><i class="fa fa-trophy text-amber-500 mr-1"></i> {{ (int)$exam->total_marks }} Total Marks (Pass: {{ (int)$exam->pass_marks }})</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 self-end md:self-auto shrink-0">
                            <a href="{{ route('student.quiz.lobby', $exam->id) }}" 
                               class="quiz-action-btn px-7 py-3.5 rounded-2xl font-extrabold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2 hover:scale-105">
                                <i class="fa fa-play text-[10px]"></i>
                                <span>Enter Exam Hall</span>
                            </a>
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
