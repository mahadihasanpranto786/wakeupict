@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Online Quizzes & Assessments — Wake Up ICT')
@section('page_title', 'Online Quizzes')
@section('page_crumb', 'Quizzes & Practice Tests')

@push('css')
<style>
    /* Ambient Glow & Floating Animations */
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

    /* Glass Card Hover & Transitions */
    .quiz-glass-card {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    .quiz-glass-card:hover {
        transform: translateY(-6px);
    }

    /* High contrast text guarantees for light mode */
    html.light .quiz-heading {
        color: #1d4ed8 !important; /* Rich vibrant blue */
    }
    html.light .quiz-subheading {
        color: #ea580c !important; /* Orange accent */
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

    /* Dark Mode Glass */
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

    <!-- =========================================================================
         1. FULL-WRAPPER AMBIENT BACKGROUND GLOWS & FLOATING 3D SHAPES
         ========================================================================= -->
    <!-- Soft Blue Atmosphere Aura spanning entire top-left from header edge -->
    <div class="absolute -top-16 -left-20 w-[620px] sm:w-[750px] h-[620px] sm:h-[750px] bg-gradient-to-br from-blue-400/30 via-indigo-400/20 to-transparent rounded-full blur-[130px] pointer-events-none -z-10"></div>
    
    <!-- Soft Warm Amber/Peach Atmosphere Aura spanning top-right edge -->
    <div class="absolute -top-10 -right-20 w-[600px] sm:w-[720px] h-[600px] sm:h-[720px] bg-gradient-to-bl from-amber-300/30 via-orange-300/20 to-transparent rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <!-- Mid & Bottom Ambient Auras for complete vertical screen coverage -->
    <div class="absolute -left-20 top-1/2 -translate-y-1/2 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-blue-500/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>
    <div class="absolute -right-20 bottom-10 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-orange-400/15 rounded-full blur-[140px] pointer-events-none -z-10"></div>

    <!-- Floating 3D Geometric Frosted Prism - Left Shape -->
    <div class="hidden lg:block absolute left-4 top-[280px] pointer-events-none animate-float-slow -z-10 opacity-70">
        <svg width="90" height="90" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-[0_15px_25px_rgba(37,99,235,0.25)]">
            <defs>
                <linearGradient id="prismLeftGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#93c5fd" stop-opacity="0.85" />
                    <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.3" />
                </linearGradient>
                <linearGradient id="prismLeftGrad2" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#60a5fa" stop-opacity="0.9" />
                    <stop offset="100%" stop-color="#1d4ed8" stop-opacity="0.5" />
                </linearGradient>
                <linearGradient id="prismLeftGrad3" x1="0%" y1="100%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#bfdbfe" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="#93c5fd" stop-opacity="0.4" />
                </linearGradient>
            </defs>
            <polygon points="50,15 90,65 50,85" fill="url(#prismLeftGrad1)" />
            <polygon points="50,15 10,65 50,85" fill="url(#prismLeftGrad2)" />
            <polygon points="50,15 90,65 10,65" fill="url(#prismLeftGrad3)" fill-opacity="0.6" />
        </svg>
    </div>

    <!-- Floating 3D Geometric Frosted Prism - Right Shape -->
    <div class="hidden lg:block absolute right-8 top-[140px] pointer-events-none animate-float-reverse -z-10 opacity-65">
        <svg width="80" height="80" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="drop-shadow-[0_15px_25px_rgba(245,158,11,0.25)]">
            <defs>
                <linearGradient id="prismRightGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#fde68a" stop-opacity="0.85" />
                    <stop offset="100%" stop-color="#f59e0b" stop-opacity="0.3" />
                </linearGradient>
                <linearGradient id="prismRightGrad2" x1="100%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#fbbf24" stop-opacity="0.9" />
                    <stop offset="100%" stop-color="#d97706" stop-opacity="0.5" />
                </linearGradient>
                <linearGradient id="prismRightGrad3" x1="0%" y1="100%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#fef3c7" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="#fde68a" stop-opacity="0.4" />
                </linearGradient>
            </defs>
            <polygon points="50,12 88,50 50,88 12,50" fill="url(#prismRightGrad1)" />
            <polygon points="50,12 88,50 50,50" fill="url(#prismRightGrad2)" />
            <polygon points="12,50 50,50 50,88" fill="url(#prismRightGrad3)" />
        </svg>
    </div>

    <!-- Central Inner Grid (Max Width 7XL with Clean Margins) -->
    <div class="max-w-7xl mx-auto space-y-10 relative z-10">

        <!-- =========================================================================
             2. SECTION HEADER (Services & Assessments Header matching Reference)
             ========================================================================= -->
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 pb-6 border-b border-slate-200/80 dark:border-slate-800/80">
            <div class="max-w-2xl space-y-2">
                <!-- Orange Subheading Tag -->
                <div class="quiz-subheading text-xs sm:text-sm font-extrabold uppercase tracking-widest flex items-center gap-2">
                    <span>Choose The Best ICT Assessments</span>
                </div>

                <!-- Big Vibrant Title -->
                <h1 class="quiz-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                    Online Quizzes
                </h1>

                <!-- Descriptive Paragraph -->
                <p class="quiz-card-desc text-xs sm:text-sm lg:text-base leading-relaxed max-w-xl">
                    অনলাইন কুইজ ক্যাটালগে বিভিন্ন কোর্স ও বিষয়ের কুইজ কার্ডগুলো দেখে নিন। পরীক্ষায় অংশ নিতে অনুগ্রহ করে বাম পাশের <strong>"অনুশীলন পরীক্ষা"</strong> অথবা নির্ধারিত লাইভ পরীক্ষার জন্য <strong>"আসন্ন পরীক্ষা"</strong> মেনু ব্যবহার করুন।
                </p>
            </div>

            <!-- Filter & Search Controls -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <!-- Search Input -->
                <form action="{{ route('student.quiz.index') }}" method="GET" class="relative">
                    @if(request('class'))
                        <input type="hidden" name="class" value="{{ request('class') }}">
                    @endif
                    <i class="fa fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search quizzes..." 
                           class="pl-9 pr-3.5 py-2 text-xs rounded-xl bg-white/90 dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm w-full sm:w-48 transition-all">
                </form>

                <!-- Filter Buttons -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('student.quiz.index') }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm {{ !request('class') && !request('type') ? 'bg-blue-600 text-white shadow-blue-500/20' : 'bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:border-blue-400' }}">
                        All Tests
                    </a>
                    <a href="{{ route('student.quiz.index', ['class' => 'Class 6-7']) }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm {{ request('class') == 'Class 6-7' ? 'bg-blue-600 text-white shadow-blue-500/20' : 'bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:border-blue-400' }}">
                        Class 6–7
                    </a>
                    <a href="{{ route('student.quiz.index', ['class' => 'Class 8-10']) }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm {{ request('class') == 'Class 8-10' ? 'bg-blue-600 text-white shadow-blue-500/20' : 'bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:border-blue-400' }}">
                        Class 8–10
                    </a>
                    <a href="{{ route('student.quiz.index', ['class' => 'Professional']) }}" 
                       class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all shadow-sm {{ request('class') == 'Professional' ? 'bg-blue-600 text-white shadow-blue-500/20' : 'bg-white/80 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:border-blue-400' }}">
                        Professional
                    </a>
                </div>
            </div>
        </div>


        <!-- =========================================================================
             3. QUIZZES GRID (CARDS MATCHING THE REFERENCE IMAGE)
             ========================================================================= -->
        @if($quizzes->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 relative z-10">
                @foreach($quizzes as $quiz)
                    @php
                        $stat = isset($attemptStats[$quiz->id]) ? $attemptStats[$quiz->id] : ['count' => 0, 'best_score' => null, 'passed' => false];
                        $hasPassed = $stat['passed'];
                        $attemptCount = $stat['count'];

                        // Modern outline icon matching reference cards
                        $titleLower = strtolower($quiz->title . ' ' . $quiz->description);
                        if (strpos($titleLower, 'mobile') !== false || strpos($titleLower, 'app') !== false || strpos($titleLower, 'phone') !== false) {
                            $iconClass = 'fa fa-mobile text-2xl';
                        } elseif (strpos($titleLower, 'devops') !== false || strpos($titleLower, 'cloud') !== false || strpos($titleLower, 'server') !== false) {
                            $iconClass = 'fa fa-code-fork text-xl';
                        } elseif (strpos($titleLower, 'block') !== false || strpos($titleLower, 'data') !== false || strpos($titleLower, 'cube') !== false) {
                            $iconClass = 'fa fa-cube text-xl';
                        } elseif (strpos($titleLower, 'test') !== false || strpos($titleLower, 'software') !== false || strpos($titleLower, 'quality') !== false) {
                            $iconClass = 'fa fa-check-square-o text-xl';
                        } elseif (strpos($titleLower, 'program') !== false || strpos($titleLower, 'code') !== false || strpos($titleLower, 'c++') !== false || strpos($titleLower, 'python') !== false) {
                            $iconClass = 'fa fa-code text-xl';
                        } elseif (strpos($titleLower, 'network') !== false || strpos($titleLower, 'web') !== false || strpos($titleLower, 'internet') !== false) {
                            $iconClass = 'fa fa-globe text-xl';
                        } else {
                            $fallbackIcons = ['fa fa-laptop text-xl', 'fa fa-cube text-xl', 'fa fa-code-fork text-xl', 'fa fa-check-square-o text-xl'];
                            $iconClass = $fallbackIcons[$loop->index % count($fallbackIcons)];
                        }
                    @endphp

                    <!-- Card Structure -->
                    <div class="quiz-glass-card quiz-card-surface rounded-3xl p-6 sm:p-7 flex flex-col justify-between group transition-all relative overflow-hidden border">
                        
                        <div class="space-y-4">
                            <!-- Top Row: Modern Outlined Icon + Tag -->
                            <div class="flex items-center justify-between gap-3">
                                <!-- Outlined Icon in Square Box (Exact Reference Style) -->
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center border border-blue-500/25 bg-blue-50/70 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 group-hover:scale-105 group-hover:border-blue-500/50 transition-all shadow-sm">
                                    <i class="{{ $iconClass }}"></i>
                                </div>

                                <!-- Class Level or Status Badge -->
                                <div class="flex items-center gap-1.5">
                                    @if($hasPassed)
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                            <i class="fa fa-check-circle"></i> Passed
                                        </span>
                                    @elseif($attemptCount > 0)
                                        <span class="px-2.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                            <i class="fa fa-repeat"></i> {{ $attemptCount }} Attempt(s)
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-600 dark:text-blue-400 font-mono text-[10px] font-bold">
                                            {{ $quiz->class_level ?: ($quiz->course ? $quiz->course->course_title : 'General ICT') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Quiz Title (Bold, Crisp, Matching Reference) -->
                            <div>
                                <h3 class="quiz-card-title text-lg sm:text-xl font-bold tracking-tight line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $quiz->title }}
                                </h3>

                                <!-- Quiz Description (Clean, Readable) -->
                                <p class="quiz-card-desc text-xs sm:text-sm line-clamp-2 leading-relaxed mt-2">
                                    {{ $quiz->description ?: 'Comprehensive assessment aligned with NCTB ICT curriculum syllabus standards and live coaching batches.' }}
                                </p>
                            </div>

                            <!-- Quiz Meta Badges (Questions, Time, Marks) -->
                            <div class="grid grid-cols-3 gap-2 pt-3 border-t border-slate-100 dark:border-slate-800/80 text-center font-mono">
                                <div class="p-2 rounded-xl bg-slate-50/70 dark:bg-slate-950/60 border border-slate-200/60 dark:border-slate-800/80">
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-sans">Questions</span>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $quiz->questions->count() }} Qs</span>
                                </div>
                                <div class="p-2 rounded-xl bg-slate-50/70 dark:bg-slate-950/60 border border-slate-200/60 dark:border-slate-800/80">
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-sans">Time</span>
                                    <span class="text-xs font-bold text-slate-800 dark:text-white">{{ $quiz->duration_minutes }}m</span>
                                </div>
                                <div class="p-2 rounded-xl bg-slate-50/70 dark:bg-slate-950/60 border border-slate-200/60 dark:border-slate-800/80">
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 block font-sans">Marks</span>
                                    <span class="text-xs font-bold text-blue-600 dark:text-blue-400">{{ (int)$quiz->total_marks }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Actions: View Only in Online Quiz Menu (Cannot start exam directly from here) -->
                        <div class="pt-5 mt-4 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between gap-2 flex-wrap">
                            <!-- Score / Attempt status -->
                            <div class="text-[11px] font-mono">
                                @if($stat['best_score'] !== null)
                                    <span class="text-slate-500">Best:</span>
                                    <strong class="text-blue-600 dark:text-blue-400 font-bold">{{ $stat['best_score'] }}/{{ (int)$quiz->total_marks }}</strong>
                                @else
                                    <span class="text-slate-500 dark:text-slate-400">Pass: {{ (int)$quiz->pass_marks }}</span>
                                @endif
                            </div>

                            <!-- View Only Action Pills -->
                            <div class="flex items-center gap-1.5">
                                <span class="px-2.5 py-1.5 rounded-xl text-[11px] font-semibold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 flex items-center gap-1" title="অনলাইন কুইজ মেনুতে কার্ডটি শুধু দেখার জন্য">
                                    <i class="fa fa-eye text-[10px] text-slate-400"></i>
                                    <span>বিবরণ (View Only)</span>
                                </span>
                                <a href="{{ route('student.practice.index') }}" 
                                   class="px-2.5 py-1.5 rounded-xl text-[11px] font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/60 hover:bg-blue-100 dark:hover:bg-blue-900/60 border border-blue-200 dark:border-blue-800 flex items-center gap-1 transition-all shadow-sm"
                                   title="অনুশীলন পরীক্ষা মেনু থেকে অংশ নিন">
                                    <span>অনুশীলন মেনু</span>
                                    <i class="fa fa-arrow-right text-[9px]"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- =========================================================================
                 4. STYLISH MODERN PAGINATION (NO "DISCOVER MORE" BUTTON)
                 ========================================================================= -->
            @if ($quizzes->hasPages())
                @php
                    $quizzes->appends(request()->query());
                    $current = $quizzes->currentPage();
                    $last = $quizzes->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);
                @endphp
                <div class="pt-8 pb-4 border-t border-slate-200/70 dark:border-slate-800/70 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Results Count Indicator -->
                    <div class="text-xs font-medium text-slate-500 dark:text-slate-400">
                        Showing <span class="font-bold text-slate-800 dark:text-white">{{ $quizzes->firstItem() }}</span> to 
                        <span class="font-bold text-slate-800 dark:text-white">{{ $quizzes->lastItem() }}</span> of 
                        <span class="font-bold text-blue-600 dark:text-blue-400">{{ $quizzes->total() }}</span> assessments
                    </div>

                    <!-- Modern Squircle Pagination Navigation -->
                    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1.5 sm:gap-2">
                        <!-- Prev Button -->
                        @if ($quizzes->onFirstPage())
                            <span class="px-3.5 py-2 rounded-2xl bg-slate-100/70 dark:bg-slate-900/40 text-slate-400 dark:text-slate-600 border border-slate-200/50 dark:border-slate-800/60 text-xs font-semibold cursor-not-allowed flex items-center gap-1.5">
                                <i class="fa fa-angle-left"></i>
                                <span class="hidden sm:inline">Prev</span>
                            </span>
                        @else
                            <a href="{{ $quizzes->previousPageUrl() }}" 
                               class="px-3.5 py-2 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 dark:hover:border-blue-500 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-1.5 hover:-translate-x-0.5">
                                <i class="fa fa-angle-left"></i>
                                <span class="hidden sm:inline">Prev</span>
                            </a>
                        @endif

                        <!-- Page Numbers -->
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
                                       class="w-9 h-9 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 dark:hover:border-blue-500 text-xs font-bold flex items-center justify-center transition-all shadow-sm hover:scale-105">
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

                        <!-- Next Button -->
                        @if ($quizzes->hasMorePages())
                            <a href="{{ $quizzes->nextPageUrl() }}" 
                               class="px-3.5 py-2 rounded-2xl bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 hover:text-blue-600 hover:border-blue-400 dark:hover:border-blue-500 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-1.5 hover:translate-x-0.5">
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
            <!-- Empty State -->
            <div class="quiz-card-surface rounded-3xl p-12 text-center max-w-lg mx-auto border relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-500/10 text-blue-600 flex items-center justify-center mx-auto mb-4 text-2xl border border-blue-500/20">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">No Quizzes Found</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-6 leading-relaxed">
                    No assessments found matching your filter criteria. Please check back soon or reset your filter.
                </p>
                <a href="{{ route('student.quiz.index') }}" 
                   class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-blue-600 text-white font-bold text-xs uppercase tracking-wider shadow-md hover:bg-blue-700 transition-all">
                    <span>View All Tests</span>
                </a>
            </div>
        @endif


        <!-- =========================================================================
             5. BOTTOM BANNER ("Have any questions? Let's Work Together")
             ========================================================================= -->
        <div class="pt-4 pb-8 relative z-10">
            <div class="quiz-card-surface rounded-3xl p-8 sm:p-10 border relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-1 text-center md:text-left">
                    <p class="text-amber-500 font-extrabold text-xs uppercase tracking-widest flex items-center justify-center md:justify-start gap-1.5">
                        <span>“</span> Have any questions or topic suggestions?
                    </p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-blue-600 dark:text-blue-400 tracking-tight">
                        Let's Practice Together.
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 max-w-lg">
                        Join our physical computer lab sessions or contact course instructors directly for personalized mock tests and offline batch assistance.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('student.support.index') }}" 
                       class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-blue-600/20 hover:scale-105 transition-all flex items-center gap-2">
                        <i class="fa fa-comments-o"></i>
                        <span>Contact Instructor</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
