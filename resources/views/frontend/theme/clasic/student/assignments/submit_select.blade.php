@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Select Assignment to Submit — Wake Up ICT')
@section('page_title', 'Submit Assignment')
@section('page_crumb', 'Select Assignment')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <div class="pb-4 border-b border-slate-800">
        <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
            <i class="fa fa-cloud-upload text-brand-primary"></i>
            <span>Select Assignment to Submit</span>
        </h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">
            Choose which coursework task or practical project you want to upload work for.
        </p>
    </div>

    @if($pendingAssignments->count() > 0)
        <div class="space-y-4">
            @foreach($pendingAssignments as $item)
                <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl flex items-center justify-between gap-4 hover:border-slate-700 transition-all">
                    <div>
                        <span class="text-[10px] font-mono text-brand-primary font-bold uppercase block mb-1">
                            {{ $item->course ? $item->course->course_title : 'Course' }}
                        </span>
                        <h3 class="text-base font-bold text-white">
                            {{ $item->title }}
                        </h3>
                        <span class="text-xs font-mono text-slate-400 block mt-1">
                            Due: {{ $item->due_date ? $item->due_date->format('M d, Y') : 'No deadline' }} &bull; {{ (int)$item->total_marks }} Marks
                        </span>
                    </div>

                    <a href="{{ route('student.assignments.submit.id', $item->id) }}" class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5 shrink-0">
                        <span>Upload Work</span>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <h3 class="text-base font-bold text-white mb-2">No Open Assignments</h3>
            <p class="text-xs text-slate-400">All current assignments are closed or submitted.</p>
        </div>
    @endif

</div>
@endsection
