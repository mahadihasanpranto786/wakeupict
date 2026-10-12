@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Exam Scorecard: ' . $quiz->title . ' — Wake Up ICT')
@section('page_title', 'Assessment Results')
@section('page_crumb', 'Performance Scorecard')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Top Action & Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('student.quiz.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
            <i class="fa fa-arrow-left"></i>
            <span>Back to All Quizzes</span>
        </a>
        <a href="{{ route('student.results.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-brand-primary hover:underline">
            <i class="fa fa-history"></i>
            <span>All Results History</span>
        </a>
    </div>

    @php
        $isPassed = $attempt->isPassed();
        $totalQ = $questions->count();
        $correctCount = 0;
        $incorrectCount = 0;
        $unansweredCount = 0;

        foreach ($questions as $q) {
            $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
            if (!$ans || empty($ans->selected_option_ids_array)) {
                $unansweredCount++;
            } elseif ($ans->is_correct) {
                $correctCount++;
            } else {
                $incorrectCount++;
            }
        }

        $pct = $attempt->percentage;
        $grade = 'F';
        if ($pct >= 80) $grade = 'A+';
        elseif ($pct >= 70) $grade = 'A';
        elseif ($pct >= 60) $grade = 'A-';
        elseif ($pct >= 50) $grade = 'B';
        elseif ($pct >= 40) $grade = 'C';
    @endphp

    <!-- Result Banner Card -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl relative overflow-hidden space-y-6">
        <div class="absolute -right-20 -top-20 w-80 h-80 {{ $isPassed ? 'bg-brand-primary/10' : 'bg-rose-500/10' }} rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative z-10">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 rounded-full font-mono text-xs font-bold uppercase tracking-wider {{ $isPassed ? 'bg-emerald-500/10 border border-emerald-500/30 text-emerald-400' : 'bg-rose-500/10 border border-rose-500/30 text-rose-400' }}">
                        <i class="fa {{ $isPassed ? 'fa-trophy' : 'fa-times-circle' }} mr-1"></i>
                        {{ $isPassed ? 'Assessment Passed' : 'Assessment Not Passed' }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-300 font-mono text-xs">
                        Attempt #{{ $attempt->attempt_number }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white">
                    {{ $quiz->title }}
                </h1>
                <p class="text-xs text-slate-400 font-mono">
                    Completed on {{ $attempt->submitted_at ? $attempt->submitted_at->format('M d, Y h:i A') : $attempt->updated_at->format('M d, Y') }}
                </p>
            </div>

            <!-- Big Score & Grade Display -->
            <div class="p-5 rounded-2xl bg-slate-950/80 border border-slate-800 text-center font-mono shrink-0 sm:min-w-[160px]">
                <span class="text-xs text-slate-400 block mb-1 uppercase tracking-wider">Score</span>
                <div class="text-3xl sm:text-4xl font-black {{ $isPassed ? 'text-brand-primary' : 'text-rose-400' }}">
                    {{ (int)$attempt->score }}<span class="text-lg text-slate-500">/{{ (int)$quiz->total_marks }}</span>
                </div>
                <div class="mt-1 flex items-center justify-center gap-2">
                    <span class="text-xs text-slate-300 font-bold">{{ $attempt->percentage }}%</span>
                    <span class="px-2 py-0.5 rounded bg-brand-primary/20 text-brand-primary text-xs font-black">{{ $grade }}</span>
                </div>
            </div>
        </div>

        <!-- Metric Counters Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2 relative z-10 font-mono">
            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-400 block mb-1">Correct</span>
                <span class="text-base font-bold text-emerald-400">{{ $correctCount }}</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-400 block mb-1">Incorrect</span>
                <span class="text-base font-bold text-rose-400">{{ $incorrectCount }}</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-400 block mb-1">Unanswered</span>
                <span class="text-base font-bold text-slate-400">{{ $unansweredCount }}</span>
            </div>
            <div class="p-3.5 rounded-2xl bg-slate-950/60 border border-slate-800/80 text-center">
                <span class="text-[11px] text-slate-400 block mb-1">Time Spent</span>
                <span class="text-base font-bold text-brand-cyan">{{ $attempt->formatted_time_spent }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 border-t border-slate-800/80 flex flex-wrap items-center justify-between gap-3 relative z-10">
            <a href="#question-review" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-list-ol"></i>
                <span>Review Question Sheet</span>
            </a>

            @if($quiz->canAttempt($student->id))
                <form action="{{ route('student.quiz.start', $quiz->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                        <i class="fa fa-repeat"></i>
                        <span>Retake Assessment</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Question-by-Question Review Sheet -->
    <div id="question-review" class="space-y-6">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <i class="fa fa-check-square-o text-brand-primary"></i>
                <span>Detailed Question Review & Explanations</span>
            </h2>
            <span class="text-xs font-mono text-slate-400">{{ $totalQ }} Questions</span>
        </div>

        <div class="space-y-6">
            @foreach($questions as $index => $q)
                @php
                    $ans = isset($answers[$q->id]) ? $answers[$q->id] : null;
                    $selectedIds = $ans ? $ans->selected_option_ids_array : [];
                    $isCorrect = $ans ? $ans->is_correct : false;
                    $isAnswered = !empty($selectedIds);
                @endphp

                <div class="student-card rounded-3xl bg-slate-900/80 border {{ $isCorrect ? 'border-emerald-500/40' : ($isAnswered ? 'border-rose-500/40' : 'border-slate-800') }} p-6 sm:p-7 backdrop-blur-xl space-y-4">
                    
                    <!-- Question Top -->
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl font-mono text-xs font-bold flex items-center justify-center shrink-0 {{ $isCorrect ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : ($isAnswered ? 'bg-rose-500/10 text-rose-400 border border-rose-500/30' : 'bg-slate-800 text-slate-400') }}">
                                {{ $index + 1 }}
                            </span>
                            <div>
                                <span class="text-xs font-mono {{ $isCorrect ? 'text-emerald-400' : ($isAnswered ? 'text-rose-400' : 'text-slate-400') }} font-bold">
                                    {{ $isCorrect ? 'Correct (+'.(int)$q->marks.' Marks)' : ($isAnswered ? 'Incorrect (0 Marks)' : 'Unanswered') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Question Prompt -->
                    <h3 class="text-sm sm:text-base font-semibold text-white leading-relaxed">
                        {{ $q->question_text }}
                    </h3>

                    <!-- Options List with Color Highlights -->
                    <div class="space-y-2 pt-1 font-mono text-xs">
                        @foreach($q->options as $opt)
                            @php
                                $wasSelected = in_array($opt->id, $selectedIds);
                                $isThisCorrect = $opt->is_correct;

                                $optClass = 'bg-slate-950/40 border-slate-800 text-slate-400';
                                if ($isThisCorrect) {
                                    $optClass = 'bg-emerald-500/10 border-emerald-500/40 text-emerald-300 font-bold';
                                } elseif ($wasSelected && !$isThisCorrect) {
                                    $optClass = 'bg-rose-500/10 border-rose-500/40 text-rose-300';
                                }
                            @endphp

                            <div class="p-3.5 rounded-xl border flex items-center justify-between gap-3 {{ $optClass }}">
                                <div class="flex items-center gap-3">
                                    <span class="w-5 h-5 rounded-full flex items-center justify-center text-[10px] shrink-0 {{ $isThisCorrect ? 'bg-emerald-500 text-slate-950 font-bold' : ($wasSelected ? 'bg-rose-500 text-white font-bold' : 'bg-slate-800 text-slate-500') }}">
                                        @if($isThisCorrect)
                                            <i class="fa fa-check"></i>
                                        @elseif($wasSelected)
                                            <i class="fa fa-times"></i>
                                        @else
                                            &bull;
                                        @endif
                                    </span>
                                    <span>{{ $opt->option_text }}</span>
                                </div>

                                <div>
                                    @if($isThisCorrect)
                                        <span class="text-[10px] uppercase tracking-wider text-emerald-400 font-bold">Correct Answer</span>
                                    @elseif($wasSelected)
                                        <span class="text-[10px] uppercase tracking-wider text-rose-400 font-bold">Your Choice</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Teacher / Syllabus Explanation -->
                    @if($q->explanation)
                        <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800 space-y-1 text-xs">
                            <span class="font-mono text-brand-primary font-bold flex items-center gap-1.5 text-[11px] uppercase tracking-wider">
                                <i class="fa fa-lightbulb-o"></i>
                                <span>Explanation & NCTB Rationale</span>
                            </span>
                            <p class="text-slate-300 leading-relaxed font-sans">
                                {{ $q->explanation }}
                            </p>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
