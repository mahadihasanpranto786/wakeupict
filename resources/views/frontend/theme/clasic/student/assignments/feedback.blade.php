@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Teacher Feedback & Remarks — Wake Up ICT')
@section('page_title', 'Teacher Feedback')
@section('page_crumb', 'Grading & Remarks')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-commenting-o text-brand-primary"></i>
                <span>Teacher Feedback &amp; Rubric Evaluations</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Detailed reviews, constructive feedback, and grading scores from faculty instructors.
            </p>
        </div>
        <a href="{{ route('student.assignments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-tasks"></i>
            <span>Assignments List</span>
        </a>
    </div>

    @if($gradedSubmissions->count() > 0)
        <div class="space-y-4">
            @foreach($gradedSubmissions as $sub)
                @php
                    $assign = $sub->assignment;
                    $passed = $sub->isPassed();
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-7 backdrop-blur-xl hover:border-slate-700 transition-all space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                {{ $assign && $assign->course ? $assign->course->course_title : 'Course' }}
                            </span>
                            <h3 class="text-lg font-bold text-white mt-1">
                                {{ $assign ? $assign->title : 'Assignment #' . $sub->assignment_id }}
                            </h3>
                            <span class="text-xs font-mono text-slate-400 block mt-0.5">
                                Submitted on {{ $sub->submitted_at ? $sub->submitted_at->format('M d, Y') : '-' }}
                            </span>
                        </div>

                        <!-- Score Badge -->
                        <div class="p-3.5 rounded-2xl bg-slate-950 border border-slate-800 font-mono text-center shrink-0 min-w-[120px]">
                            <span class="text-[10px] text-slate-500 uppercase block">Score</span>
                            <span class="text-xl font-black {{ $passed ? 'text-brand-primary' : 'text-rose-400' }}">
                                {{ (int)$sub->marks_obtained }}<span class="text-xs text-slate-500">/{{ $assign ? (int)$assign->total_marks : 100 }}</span>
                            </span>
                            <span class="text-[10px] block mt-0.5 font-bold {{ $passed ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $passed ? 'Pass' : 'Needs Work' }}
                            </span>
                        </div>
                    </div>

                    <!-- Teacher Comments Box -->
                    <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800/80 space-y-1.5 text-xs">
                        <span class="text-brand-primary font-mono font-bold flex items-center gap-1.5 uppercase text-[11px]">
                            <i class="fa fa-quote-left"></i>
                            <span>Instructor Feedback</span>
                        </span>
                        <p class="text-slate-300 leading-relaxed font-sans">
                            {{ $sub->feedback ?: 'Great effort! Project requirements have been met according to the standard rubric.' }}
                        </p>
                    </div>

                    <!-- Submission File Download & Meta -->
                    @if($sub->submitted_file)
                        <div class="pt-2 flex items-center justify-between text-xs font-mono text-slate-400">
                            <span>Attachment: {{ basename($sub->submitted_file) }}</span>
                            <a href="{{ safe_asset($sub->submitted_file) }}" target="_blank" download class="text-brand-primary hover:underline font-semibold">
                                <i class="fa fa-download mr-1"></i> Download Submitted Copy
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $gradedSubmissions->links() }}
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-commenting-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Graded Feedback Yet</h3>
            <p class="text-xs text-slate-400">Once your instructor grades your submissions, detailed marks and feedback will appear here.</p>
        </div>
    @endif

</div>
@endsection
