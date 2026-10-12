@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Capstone Projects & Portfolios — Wake Up ICT')
@section('page_title', 'Term Projects')
@section('page_crumb', 'Project Submissions')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-cubes text-brand-primary"></i>
                <span>Capstone Term Projects &amp; Portfolios</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Real-world project submissions evaluated for professional certification.
            </p>
        </div>
        <a href="{{ route('student.assignments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-tasks"></i>
            <span>All Assignments</span>
        </a>
    </div>

    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $proj)
                @php
                    $sub = $proj->studentSubmission($student->id);
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                {{ $proj->course ? $proj->course->course_title : 'Capstone' }}
                            </span>
                            @if($sub)
                                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold">
                                    Submitted
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 rounded-full bg-brand-cyan/10 border border-brand-cyan/20 text-brand-cyan font-mono text-[10px] font-bold">
                                    Term Project
                                </span>
                            @endif
                        </div>

                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $proj->title }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-3 leading-relaxed">
                            {{ strip_tags($proj->description) }}
                        </p>

                        <div class="pt-2 border-t border-slate-800/60 text-xs font-mono text-slate-400 flex items-center justify-between">
                            <span>Due: {{ $proj->due_date ? $proj->due_date->format('M d, Y') : 'No deadline' }}</span>
                            <span class="text-brand-primary font-bold">{{ (int)$proj->total_marks }} Marks</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-800/80">
                        <a href="{{ route('student.assignments.submit.id', $proj->id) }}" class="w-full justify-center px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                            <i class="fa fa-folder-open-o"></i>
                            <span>{{ $sub ? 'Review Project' : 'Submit Project' }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-4">
            {{ $projects->links() }}
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-cubes"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Capstone Projects Assigned Yet</h3>
            <p class="text-xs text-slate-400">Final portfolio capstone briefs are issued in the second half of the term.</p>
        </div>
    @endif

</div>
@endsection
