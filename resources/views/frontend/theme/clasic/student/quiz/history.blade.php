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

    /* High-Contrast Review Sheet Button with Guaranteed White Text on Hover */
    .btn-review-sheet {
        background-color: #eff6ff !important;
        color: #1d4ed8 !important;
        border: 1px solid #bfdbfe !important;
        font-weight: 700 !important;
        transition: all 0.2s ease-in-out !important;
        text-decoration: none !important;
    }
    .btn-review-sheet:hover {
        background-color: #1d4ed8 !important;
        color: #ffffff !important;
        border-color: #1d4ed8 !important;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.35) !important;
    }
    html.dark .btn-review-sheet {
        background-color: rgba(30, 58, 138, 0.4) !important;
        color: #93c5fd !important;
        border-color: #1e40af !important;
    }
    html.dark .btn-review-sheet:hover {
        background-color: #2563eb !important;
        color: #ffffff !important;
        border-color: #3b82f6 !important;
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 font-mono">
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Total Attempts</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white">{{ $totalAttemptsCount ?? $attempts->total() }}</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Passed Assessments</span>
                    <span class="text-2xl font-black text-emerald-600 dark:text-emerald-400">{{ $passedAttemptsCount ?? 0 }}</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Average Percentage</span>
                    <span class="text-2xl font-black text-blue-600 dark:text-blue-400">{{ $avgPctVal ?? 0 }}%</span>
                </div>
                <div class="quiz-glass-card quiz-card-surface rounded-2xl p-5 border">
                    <span class="text-xs text-slate-500 dark:text-slate-400 uppercase block mb-1 font-sans">Top Score</span>
                    <span class="text-2xl font-black text-amber-500">{{ $maxScoreVal ?? 0 }}</span>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="quiz-glass-card quiz-card-surface rounded-2xl p-3 sm:p-4 border">
                <form action="{{ route('student.results.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-3">
                    <div class="relative flex-1 w-full">
                        <i class="fa fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search by assessment title, course, or set..." 
                               class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-xs focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 font-sans shadow-sm">
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <select name="status" class="py-2.5 px-3 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-200 text-xs focus:outline-none focus:border-blue-500 font-sans cursor-pointer w-full md:w-auto shadow-sm">
                            <option value="">সকল ফলাফল (All Status)</option>
                            <option value="passed" {{ request('status') === 'passed' ? 'selected' : '' }}>উত্তীর্ণ (Passed)</option>
                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>পুনঃপরীক্ষা আবশ্যক (Failed)</option>
                        </select>

                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-1.5 shrink-0 cursor-pointer">
                            <i class="fa fa-filter"></i>
                            <span>ফিল্টার</span>
                        </button>

                        @if(request('search') || request('status'))
                            <a href="{{ route('student.results.index') }}" class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 text-slate-600 dark:text-slate-300 text-xs transition-colors shrink-0" title="রিসেট">
                                <i class="fa fa-refresh"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- History Records Table with Parent-Child Retake Chain -->
            <div class="quiz-glass-card quiz-card-surface rounded-3xl border overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-100/80 dark:bg-slate-950/80 text-slate-500 dark:text-slate-400 uppercase text-[10px] border-b border-slate-200 dark:border-slate-800">
                            <tr>
                                <th class="p-4">Assessment Title</th>
                                <th class="p-4">Track / Level</th>
                                <th class="p-4">Completion Date (BD Time)</th>
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
                                    $retakes = $att->retakes ?: collect();
                                    $allAttempts = collect([$att])->concat($retakes);
                                    $passedAttempt = $allAttempts->first(function($a) { return $a->isPassed(); });
                                    $hasPassed100 = $passedAttempt !== null;
                                    $latestAttempt = $allAttempts->last();
                                    $retakeCount = $retakes->count();
                                @endphp
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-850/40 transition-colors">
                                    <td class="p-4 font-bold text-slate-900 dark:text-white max-w-xs">
                                        <div class="truncate">{{ $q ? $q->title : 'Assessment #' . $att->quiz_id }}</div>
                                        @if($retakeCount > 0)
                                            <div class="mt-1 flex items-center gap-1.5 flex-wrap">
                                                <span class="px-2 py-0.5 rounded-full bg-blue-50 dark:bg-blue-950/50 border border-blue-200 dark:border-blue-900 text-blue-700 dark:text-blue-300 text-[10px] font-bold">
                                                    <i class="fa fa-history mr-0.5"></i> মোট {{ $retakeCount + 1 }} বার অংশগ্রহণ ({{ $retakeCount }}টি রিটেক)
                                                </span>
                                                @if($hasPassed100)
                                                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-300 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold">
                                                        {{ $passedAttempt->attempt_number }} বার চেষ্টায় উত্তীর্ণ
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-slate-500 dark:text-slate-400">
                                        {{ $q ? ($q->class_level ?: 'Professional') : '-' }}
                                    </td>
                                    <td class="p-4 text-slate-500 dark:text-slate-400">
                                        {{ $latestAttempt->submitted_at ? $latestAttempt->submitted_at->timezone('Asia/Dhaka')->format('M d, Y h:i A') : $latestAttempt->created_at->timezone('Asia/Dhaka')->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="p-4 font-bold {{ $hasPassed100 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                        {{ $latestAttempt->score }} / {{ (int)$latestAttempt->total_marks }}
                                        @if($hasPassed100 && $latestAttempt->id !== $passedAttempt->id)
                                            <div class="text-[10px] text-emerald-600 dark:text-emerald-400">সর্বোচ্চ: {{ $passedAttempt->score }}/{{ (int)$passedAttempt->total_marks }}</div>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        {{ $latestAttempt->percentage }}%
                                    </td>
                                    <td class="p-4">
                                        @if($hasPassed100)
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold">
                                                <i class="fa fa-check-circle mr-1"></i> Passed (উত্তীর্ণ)
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/30 text-rose-600 dark:text-rose-400 text-[10px] font-bold">
                                                <i class="fa fa-times-circle mr-1"></i> Failed (পুনঃপরীক্ষা আবশ্যক)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex items-center justify-end gap-2 flex-wrap">
                                            <a href="{{ route('student.quiz.results', $latestAttempt->id) }}" class="btn-review-sheet inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold transition-all">
                                                <span>Review Sheet</span> &rarr;
                                            </a>
                                            @if(!$hasPassed100)
                                                <form action="{{ route('student.quiz.retake', $latestAttempt->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs transition-all shadow-md cursor-pointer" title="এই সেটের প্রশ্নে পুনরায় পরীক্ষা দিন">
                                                        <i class="fa fa-repeat"></i> <span>Retake Exam</span>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($retakeCount > 0)
                                                <button type="button" onclick="toggleRetakeChain({{ $att->id }})" id="retake-toggle-btn-{{ $att->id }}" class="px-2.5 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-semibold flex items-center gap-1 cursor-pointer transition-colors" title="সকল চেষ্টার বিস্তারিত দেখুন">
                                                    <i class="fa fa-chevron-down text-[10px]"></i>
                                                    <span>ইতিহাস ({{ $retakeCount + 1 }})</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                @if($retakeCount > 0)
                                    <tr id="retake-chain-{{ $att->id }}" class="hidden bg-slate-50/80 dark:bg-slate-900/60 border-t border-b border-blue-200/50 dark:border-blue-900/40">
                                        <td colspan="7" class="p-3 sm:p-5">
                                            <div class="rounded-2xl bg-white dark:bg-slate-950/80 border border-slate-200 dark:border-slate-800 p-4 shadow-sm space-y-3 font-sans">
                                                <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-2">
                                                    <span class="text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5 font-mono">
                                                        <i class="fa fa-sitemap text-blue-600"></i>
                                                        পুনঃপরীক্ষা ট্র্যাকিং হিস্টোরি (Parent-Child Retake Chain)
                                                    </span>
                                                    <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400">
                                                        {{ $hasPassed100 ? 'সফলভাবে উত্তীর্ণ হয়েছে' : 'উত্তীর্ণ হওয়ার জন্য পুনরায় চেষ্টা চলমান' }}
                                                    </span>
                                                </div>
                                                <div class="overflow-x-auto">
                                                    <table class="w-full text-left text-xs font-mono">
                                                        <thead class="text-[10px] text-slate-400 uppercase border-b border-slate-100 dark:border-slate-800">
                                                            <tr>
                                                                <th class="py-2 px-3">চেষ্টা ক্রম (Attempt)</th>
                                                                <th class="py-2 px-3">তারিখ ও সময় (BD Time)</th>
                                                                <th class="py-2 px-3">প্রাপ্ত নম্বর (Score)</th>
                                                                <th class="py-2 px-3">শতকরা (Pct)</th>
                                                                <th class="py-2 px-3">ফলাফল (Status)</th>
                                                                <th class="py-2 px-3 text-right">উত্তরপত্র</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800/50">
                                                            @foreach($allAttempts as $chainIndex => $subAtt)
                                                                @php
                                                                    $subPassed = $subAtt->isPassed();
                                                                @endphp
                                                                <tr class="{{ $subPassed ? 'bg-emerald-50/40 dark:bg-emerald-950/20' : '' }}">
                                                                    <td class="py-2.5 px-3 font-bold">
                                                                        @if($chainIndex === 0)
                                                                            <span class="px-2 py-0.5 rounded bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-[10px]">
                                                                                মূল পরীক্ষা (Initial #1)
                                                                            </span>
                                                                        @else
                                                                            <span class="px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-800 dark:text-blue-300 text-[10px]">
                                                                                পুনঃপরীক্ষা #{{ $chainIndex }} (Attempt #{{ $subAtt->attempt_number }})
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="py-2.5 px-3 text-slate-600 dark:text-slate-400">
                                                                        {{ $subAtt->submitted_at ? $subAtt->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $subAtt->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
                                                                    </td>
                                                                    <td class="py-2.5 px-3 font-bold {{ $subPassed ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                                                        {{ $subAtt->score }} / {{ (int)$subAtt->total_marks }}
                                                                    </td>
                                                                    <td class="py-2.5 px-3">
                                                                        {{ $subAtt->percentage }}%
                                                                    </td>
                                                                    <td class="py-2.5 px-3">
                                                                        @if($subPassed)
                                                                            <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold text-[10px]">
                                                                                উত্তীর্ণ (Passed)
                                                                            </span>
                                                                        @else
                                                                            <span class="px-2 py-0.5 rounded-full bg-rose-500/10 text-rose-600 dark:text-rose-400 font-bold text-[10px]">
                                                                                অনুত্তীর্ণ (Failed)
                                                                            </span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="py-2.5 px-3 text-right">
                                                                        <a href="{{ route('student.quiz.results', $subAtt->id) }}" class="btn-review-sheet inline-block px-2.5 py-1 rounded-lg text-[11px]">
                                                                            Review &rarr;
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($attempts->hasPages())
                    <div class="p-4 sm:p-5 border-t border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 font-sans text-xs">
                        <div class="text-slate-500 dark:text-slate-400 font-medium">
                            Showing <span class="font-bold text-slate-900 dark:text-white">{{ $attempts->firstItem() }}</span> to <span class="font-bold text-slate-900 dark:text-white">{{ $attempts->lastItem() }}</span> of <span class="font-bold text-slate-900 dark:text-white">{{ $attempts->total() }}</span> results
                        </div>
                        <div class="inline-flex items-center gap-1.5 flex-wrap">
                            {{-- Previous Page Link --}}
                            @if ($attempts->onFirstPage())
                                <span class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-400 dark:text-slate-600 cursor-not-allowed opacity-50 flex items-center gap-1 select-none">
                                    <i class="fa fa-chevron-left text-[10px]"></i> <span>Prev</span>
                                </span>
                            @else
                                <a href="{{ $attempts->previousPageUrl() }}" class="px-3 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 transition-all shadow-sm flex items-center gap-1 font-semibold">
                                    <i class="fa fa-chevron-left text-[10px]"></i> <span>Prev</span>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($attempts->getUrlRange(1, $attempts->lastPage()) as $page => $url)
                                @if ($page == $attempts->currentPage())
                                    <span class="w-8 h-8 rounded-xl bg-blue-600 text-white font-bold flex items-center justify-center shadow-md shadow-blue-500/20 select-none">
                                        {{ $page }}
                                    </span>
                                @elseif($page == 1 || $page == $attempts->lastPage() || abs($page - $attempts->currentPage()) <= 1)
                                    <a href="{{ $url }}" class="w-8 h-8 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 hover:border-blue-500 hover:text-blue-600 transition-all font-semibold flex items-center justify-center shadow-sm">
                                        {{ $page }}
                                    </a>
                                @elseif(abs($page - $attempts->currentPage()) == 2)
                                    <span class="w-8 h-8 flex items-center justify-center text-slate-400 select-none">...</span>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($attempts->hasMorePages())
                                <a href="{{ $attempts->nextPageUrl() }}" class="px-3 py-1.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:border-blue-500 hover:text-blue-600 dark:hover:text-blue-400 transition-all shadow-sm flex items-center gap-1 font-semibold">
                                    <span>Next</span> <i class="fa fa-chevron-right text-[10px]"></i>
                                </a>
                            @else
                                <span class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-400 dark:text-slate-600 cursor-not-allowed opacity-50 flex items-center gap-1 select-none">
                                    <span>Next</span> <i class="fa fa-chevron-right text-[10px]"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
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

<script>
function toggleRetakeChain(id) {
    var row = document.getElementById('retake-chain-' + id);
    var btn = document.getElementById('retake-toggle-btn-' + id);
    if (!row) return;
    if (row.classList.contains('hidden')) {
        row.classList.remove('hidden');
        if (btn) btn.querySelector('i').className = 'fa fa-chevron-up text-[10px]';
    } else {
        row.classList.add('hidden');
        if (btn) btn.querySelector('i').className = 'fa fa-chevron-down text-[10px]';
    }
}
</script>
@endsection
