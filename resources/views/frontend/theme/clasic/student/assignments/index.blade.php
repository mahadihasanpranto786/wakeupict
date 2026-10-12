@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'My Course Assignments — Wake Up ICT')
@section('page_title', 'My Assignments')
@section('page_crumb', 'Coursework & Submissions')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-tasks text-brand-primary"></i>
                <span>Assignments &amp; Practical Coursework</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Hands-on tasks, coding challenges, design briefs, and homework assigned by instructors.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('student.projects.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-folder-open-o"></i>
                <span>Term Projects</span>
            </a>
            <a href="{{ route('student.assignments.feedback') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-commenting-o"></i>
                <span>Teacher Feedback</span>
            </a>
        </div>
    </div>

    @if($assignments->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($assignments as $assign)
                @php
                    $sub = $assign->studentSubmission($student->id);
                    $isPast = $assign->isPastDue();
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                {{ $assign->course ? $assign->course->course_title : 'General' }}
                            </span>

                            @if($sub)
                                @if($sub->status === 'graded')
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold">
                                        Graded: {{ (int)$sub->marks_obtained }}/{{ (int)$assign->total_marks }}
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan font-mono text-[10px] font-bold">
                                        Submitted
                                    </span>
                                @endif
                            @elseif($isPast)
                                <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 font-mono text-[10px] font-bold">
                                    Past Due
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-mono text-[10px] font-bold">
                                    Pending
                                </span>
                            @endif
                        </div>

                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $assign->title }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-3 leading-relaxed">
                            {{ strip_tags($assign->description) }}
                        </p>

                        <div class="pt-2 border-t border-slate-800/60 grid grid-cols-2 gap-2 text-xs font-mono text-slate-400">
                            <div>
                                <span class="text-[10px] text-slate-500 block">Due Date</span>
                                <span class="font-bold text-slate-300">{{ $assign->due_date ? $assign->due_date->format('M d, Y') : 'No limit' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-500 block">Marks</span>
                                <span class="font-bold text-brand-primary">{{ (int)$assign->total_marks }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="pt-4 border-t border-slate-800/80">
                        @if($sub)
                            <a href="{{ route('student.assignments.submit.id', $assign->id) }}" class="w-full justify-center px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-xs border border-slate-700 transition-colors flex items-center gap-1.5">
                                <i class="fa fa-eye"></i>
                                <span>View Submission</span>
                            </a>
                        @else
                            <a href="{{ route('student.assignments.submit.id', $assign->id) }}" class="w-full justify-center px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                                <i class="fa fa-upload"></i>
                                <span>Submit Work</span>
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $assignments->links() }}
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-tasks"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Active Assignments</h3>
            <p class="text-xs text-slate-400">New assignments and homework tasks will appear here as coursework progresses.</p>
        </div>
    @endif

</div>
@endsection
