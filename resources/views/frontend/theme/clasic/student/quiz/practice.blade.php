@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Self-Paced Practice Tests — Wake Up ICT')
@section('page_title', 'Practice Tests')
@section('page_crumb', 'Practice Mode')

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
        transform: translateY(-6px);
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
        color: #2563eb !important;
        border-color: rgba(191, 219, 254, 0.9) !important;
        background-color: rgba(239, 246, 255, 0.6) !important;
    }
    html.light .quiz-action-btn:hover {
        color: #ffffff !important;
        background-color: #2563eb !important;
        border-color: #2563eb !important;
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
        color: #60a5fa !important;
        border-color: rgba(30, 58, 138, 0.8) !important;
        background-color: rgba(30, 58, 138, 0.3) !important;
    }
    html.dark .quiz-action-btn:hover {
        color: #ffffff !important;
        background-color: #2563eb !important;
        border-color: #2563eb !important;
    }
</style>
@endpush

@section('content')
<!-- Full-Wrapper Container spanning edge-to-edge of main canvas -->
<div class="-m-4 sm:-m-8 p-4 sm:p-8 min-h-[calc(100vh-5rem)] relative overflow-hidden">

    <!-- Ambient Glows across full wrapper -->
    <div class="absolute -top-16 -left-20 w-[620px] sm:w-[750px] h-[620px] sm:h-[750px] bg-gradient-to-br from-blue-400/30 via-indigo-400/20 to-transparent rounded-full blur-[130px] pointer-events-none -z-10"></div>
    <div class="absolute -top-10 -right-20 w-[600px] sm:w-[720px] h-[600px] sm:h-[720px] bg-gradient-to-bl from-amber-300/30 via-orange-300/20 to-transparent rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute -left-20 top-1/2 -translate-y-1/2 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-blue-500/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute -right-20 bottom-10 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-orange-400/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <!-- Floating 3D Geometric Frosted Prism -->
    <div class="hidden lg:block absolute left-4 top-[280px] pointer-events-none animate-float-slow -z-10 opacity-70">
        <svg width="85" height="85" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-[0_15px_25px_rgba(37,99,235,0.25)]">
            <defs>
                <linearGradient id="prismPracticeGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#93c5fd" stop-opacity="0.8" />
                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.3" />
                </linearGradient>
                <linearGradient id="prismPracticeGrad2" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#60a5fa" stop-opacity="0.9" />
                    <stop offset="100%" stop-color="#1d4ed8" stop-opacity="0.5" />
                </linearGradient>
            </defs>
            <polygon points="50,15 90,65 50,85" fill="url(#prismPracticeGrad1)" />
            <polygon points="50,15 10,65 50,85" fill="url(#prismPracticeGrad2)" />
        </svg>
    </div>

    <!-- Central Inner Content -->
    <div class="max-w-7xl mx-auto space-y-10 relative z-10">

        <!-- Header matching Reference Design -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-slate-800/80">
            <div class="max-w-2xl space-y-2">
                <div class="quiz-subheading text-xs sm:text-sm font-extrabold uppercase tracking-widest flex items-center gap-2">
                    <span>Self-Paced Practice Drills</span>
                </div>
                <h1 class="quiz-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Practice Tests
                </h1>
                <p class="quiz-card-desc text-xs sm:text-sm lg:text-base leading-relaxed max-w-xl">
                    Unlimited retakes with instant explanations to master concepts, debug answers, and sharpen skills at your own pace.
                </p>
            </div>

            <a href="{{ route('student.results.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/90 dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-800 dark:text-slate-200 hover:border-blue-400 transition-all shadow-sm self-start sm:self-auto">
                <i class="fa fa-bar-chart text-blue-600"></i>
                <span>My Results History</span>
            </a>
        </div>

        @if($quizzes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 relative z-10">
                @foreach($quizzes as $quiz)
                    @php
                        $titleLower = strtolower($quiz->title . ' ' . $quiz->description);
                        if (strpos($titleLower, 'mobile') !== false || strpos($titleLower, 'app') !== false) {
                            $iconClass = 'fa fa-mobile text-2xl';
                        } elseif (strpos($titleLower, 'cloud') !== false || strpos($titleLower, 'devops') !== false) {
                            $iconClass = 'fa fa-code-fork text-xl';
                        } elseif (strpos($titleLower, 'block') !== false || strpos($titleLower, 'data') !== false) {
                            $iconClass = 'fa fa-cube text-xl';
                        } else {
                            $fallbackIcons = ['fa fa-refresh text-lg', 'fa fa-cube text-xl', 'fa fa-code text-xl', 'fa fa-check-square-o text-xl'];
                            $iconClass = $fallbackIcons[$loop->index % count($fallbackIcons)];
                        }
                    @endphp
                    <div class="quiz-glass-card quiz-card-surface rounded-3xl p-6 sm:p-7 flex flex-col justify-between group transition-all relative overflow-hidden border">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between gap-3">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center border border-blue-500/25 bg-blue-50/70 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 group-hover:scale-105 group-hover:border-blue-500/50 transition-all shadow-sm">
                                    <i class="{{ $iconClass }}"></i>
                                </div>
                                <span class="px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold">
                                    {{ $quiz->class_level ?: 'Practice Mode' }}
                                </span>
                            </div>

                            <div>
                                <h3 class="quiz-card-title text-lg sm:text-xl font-bold tracking-tight line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $quiz->title }}
                                </h3>
                                <p class="quiz-card-desc text-xs sm:text-sm line-clamp-2 leading-relaxed mt-2">
                                    {{ $quiz->description ?: 'Practice test with answers, immediate scoring, and educational explanations.' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-3 border-t border-slate-100 dark:border-slate-800/80 text-center font-mono">
                                <div class="p-2 rounded-xl bg-slate-50/70 dark:bg-slate-950/60 border border-slate-200/60 dark:border-slate-800/80">
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-sans">Questions</span>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $quiz->questions->count() }} Qs</span>
                                </div>
                                <div class="p-2 rounded-xl bg-slate-50/70 dark:bg-slate-950/60 border border-slate-200/60 dark:border-slate-800/80">
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-sans">Time</span>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $quiz->duration_minutes }}m</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 mt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between gap-3">
                            <span class="text-[11px] font-mono text-emerald-600 dark:text-emerald-400 font-bold flex items-center gap-1">
                                <i class="fa fa-infinity text-xs"></i> Unlimited Retakes
                            </span>
                            <a href="{{ route('student.quiz.lobby', $quiz->id) }}" 
                               class="quiz-action-btn px-4 py-2 rounded-xl text-xs font-extrabold uppercase tracking-wider flex items-center gap-1.5 transition-all shadow-sm">
                                <span>VISIT NOW</span>
                                <i class="fa fa-arrow-right text-[10px] opacity-80 group-hover:translate-x-0.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Stylish Pagination -->
            @if ($quizzes->hasPages())
                @php
                    $quizzes->appends(request()->query());
                    $current = $quizzes->currentPage();
                    $last = $quizzes->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp
                <div class="pt-8 pb-4 border-t border-slate-200/70 dark:border-slate-800/70 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs font-medium text-slate-500 dark:text-slate-400">
                        Showing <span class="font-bold text-slate-800 dark:text-white">{{ $quizzes->firstItem() }}</span> to 
                        <span class="font-bold text-slate-800 dark:text-white">{{ $quizzes->lastItem() }}</span> of 
                        <span class="font-bold text-blue-600 dark:text-blue-400">{{ $quizzes->total() }}</span> practice sets
                    </div>

                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1.5 sm:gap-2">
                        @if ($quizzes->onFirstPage())
                            <span class="px-3.5 py-2 rounded-2xl bg-slate-100/70 dark:bg-slate-900/40 text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-slate-800/60 text-xs font-semibold cursor-not-allowed flex items-center gap-1.5">
                                <i class="fa fa-angle-left"></i>
                                <span class="hidden sm:inline">Prev</span>
                            </span>
                        @else
                            <a href="{{ $quizzes->previousPageUrl() }}" 
                               class="px-3.5 py-2 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-1.5 hover:-translate-x-0.5">
                                <i class="fa fa-angle-left"></i>
                                <span class="hidden sm:inline">Prev</span>
                            </a>
                        @endif

                        <div class="flex items-center gap-1 sm:gap-1.5">
                            @if($start > 1)
                                <a href="{{ $quizzes->url(1) }}" 
                                   class="w-9 h-9 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 text-xs font-bold flex items-center justify-center transition-all shadow-sm hover:scale-105">
                                    1
                                </a>
                                @if($start > 2)
                                    <span class="w-6 h-9 flex items-center justify-center text-slate-400 font-bold text-xs">…</span>
                                @endif
                            @endif

                            @for ($page = $start; $page <= $end; $page++)
                                @if ($page == $current)
                                    <span class="w-9 h-9 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-lg shadow-blue-500/30 scale-105 border border-blue-500">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $quizzes->url($page) }}" 
                                       class="w-9 h-9 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 text-xs font-bold flex items-center justify-center transition-all shadow-sm hover:scale-105">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $last)
                                @if($end < $last - 1)
                                    <span class="w-6 h-9 flex items-center justify-center text-slate-400 font-bold text-xs">…</span>
                                @endif
                                <a href="{{ $quizzes->url($last) }}" 
                                   class="w-9 h-9 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 text-xs font-bold flex items-center justify-center transition-all shadow-sm hover:scale-105">
                                    {{ $last }}
                                </a>
                            @endif
                        </div>

                        @if ($quizzes->hasMorePages())
                            <a href="{{ $quizzes->nextPageUrl() }}" 
                               class="px-3.5 py-2 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-1.5 hover:translate-x-0.5">
                                <span class="hidden sm:inline">Next</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        @else
                            <span class="px-3.5 py-2 rounded-2xl bg-slate-100/70 dark:bg-slate-900/40 text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-slate-800/60 text-xs font-semibold cursor-not-allowed flex items-center gap-1.5">
                                <span class="hidden sm:inline">Next</span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        @endif
                    </nav>
                </div>
            @endif

        @else
            <div class="quiz-card-surface rounded-3xl p-12 text-center max-w-lg mx-auto border relative z-10">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">No Practice Sets Available</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">All available assessments will appear here.</p>
            </div>
        @endif

    </div>

</div>
@endsection
