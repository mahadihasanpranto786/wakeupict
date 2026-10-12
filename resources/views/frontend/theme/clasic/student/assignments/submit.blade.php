@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Submit Assignment: ' . $assignment->title . ' — Wake Up ICT')
@section('page_title', 'Submit Assignment')
@section('page_crumb', $assignment->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <a href="{{ route('student.assignments.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
        <i class="fa fa-arrow-left"></i>
        <span>Back to Assignments</span>
    </a>

    <!-- Assignment Description Card -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-4">
        <div class="flex items-center justify-between gap-2">
            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                {{ $assignment->course ? $assignment->course->course_title : 'Coursework' }}
            </span>
            <span class="text-xs font-mono text-slate-400">
                Due: {{ $assignment->due_date ? $assignment->due_date->format('M d, Y h:i A') : 'No deadline' }}
            </span>
        </div>

        <h1 class="text-xl sm:text-2xl font-extrabold text-white">
            {{ $assignment->title }}
        </h1>

        <div class="p-5 rounded-2xl bg-slate-950/60 border border-slate-800/80 text-xs text-slate-300 leading-relaxed prose prose-invert max-w-none">
            {!! nl2br(e($assignment->description)) !!}
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-mono text-slate-400 pt-2">
            <div>
                <span class="text-[10px] text-slate-500 block">Total Marks</span>
                <span class="font-bold text-brand-primary">{{ (int)$assignment->total_marks }}</span>
            </div>
            <div>
                <span class="text-[10px] text-slate-500 block">Pass Marks</span>
                <span class="font-bold text-white">{{ (int)$assignment->pass_marks }}</span>
            </div>
            <div>
                <span class="text-[10px] text-slate-500 block">Allowed Files</span>
                <span class="font-bold text-slate-300 uppercase">{{ $assignment->allowed_file_types }}</span>
            </div>
            <div>
                <span class="text-[10px] text-slate-500 block">Max Size</span>
                <span class="font-bold text-slate-300">{{ $assignment->max_file_size_mb }} MB</span>
            </div>
        </div>
    </div>

    <!-- Prior Submission Status (if exists) -->
    @if($submission)
        <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 backdrop-blur-xl space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa fa-check-circle text-emerald-400"></i>
                    <span>Your Previous Submission</span>
                </h3>
                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 font-mono text-[10px] font-bold {{ $submission->status == 'graded' ? 'text-emerald-400' : 'text-brand-cyan' }}">
                    {{ ucfirst($submission->status) }}
                </span>
            </div>

            <p class="text-xs font-mono text-slate-400">
                Submitted on {{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y h:i A') : '-' }}
            </p>

            @if($submission->submitted_file)
                <div class="p-3 rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-between text-xs font-mono">
                    <span class="text-slate-300 truncate"><i class="fa fa-file-archive-o mr-2 text-brand-primary"></i> {{ basename($submission->submitted_file) }}</span>
                    <a href="{{ safe_asset($submission->submitted_file) }}" target="_blank" download class="text-brand-primary hover:underline font-semibold ml-2">
                        Download
                    </a>
                </div>
            @endif

            @if($submission->submission_text)
                <div class="p-3 rounded-xl bg-slate-950 border border-slate-800 text-xs text-slate-300">
                    {{ $submission->submission_text }}
                </div>
            @endif

            @if($submission->status === 'graded')
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs space-y-1">
                    <div class="flex items-center justify-between font-mono">
                        <strong class="text-emerald-400">Marks Awarded: {{ $submission->marks_obtained }} / {{ (int)$assignment->total_marks }}</strong>
                        <span class="text-slate-400">Reviewed by Instructor</span>
                    </div>
                    @if($submission->feedback)
                        <p class="text-slate-300 mt-1 font-sans">{{ $submission->feedback }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <!-- Upload Form Card -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-6">
        <h2 class="text-base font-bold text-white flex items-center gap-2">
            <i class="fa fa-upload text-brand-primary"></i>
            <span>{{ $submission ? 'Re-upload / Update Submission' : 'Submit Your Work' }}</span>
        </h2>

        <form action="{{ route('student.assignments.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Text Notes / Links -->
            <div class="space-y-1.5">
                <label for="submission_text" class="block text-xs font-mono font-bold text-slate-300 uppercase">
                    Notes / GitHub / Live Demo Link (Optional)
                </label>
                <textarea 
                    name="submission_text" 
                    id="submission_text" 
                    rows="3" 
                    placeholder="Enter repository URLs, hosting links, or specific execution notes for your teacher..."
                    class="w-full px-4 py-3 rounded-2xl bg-slate-950 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary transition-all">{{ old('submission_text') }}</textarea>
            </div>

            <!-- File Upload Input -->
            <div class="space-y-1.5">
                <label for="submitted_file" class="block text-xs font-mono font-bold text-slate-300 uppercase">
                    Upload Project Archive or Document
                </label>
                <input 
                    type="file" 
                    name="submitted_file" 
                    id="submitted_file" 
                    class="w-full p-3 rounded-2xl bg-slate-950 border border-slate-800 text-xs text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-white hover:file:bg-brand-primary hover:file:text-slate-950 file:transition-all cursor-pointer">
                <span class="text-[11px] text-slate-500 font-mono block">
                    Supported: {{ strtoupper($assignment->allowed_file_types) }} (Maximum size: {{ $assignment->max_file_size_mb }}MB)
                </span>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-800/80">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                    <i class="fa fa-cloud-upload"></i>
                    <span>Confirm &amp; Submit Assignment</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
