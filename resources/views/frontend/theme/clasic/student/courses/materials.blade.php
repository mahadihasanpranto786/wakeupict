@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Learning Materials & Lecture Notes — Wake Up ICT')
@section('page_title', 'Learning Materials')
@section('page_crumb', 'Lecture Notes & Resources')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-file-pdf-o text-rose-500"></i>
                <span>Lecture Notes & Study Materials</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Centralized library of syllabus worksheets, presentation slides, and PDF resources for your enrolled courses.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700 text-slate-300 font-mono text-xs">
                Total Files: <strong class="text-brand-primary">{{ $materials->count() }}</strong>
            </span>
        </div>
    </div>

    <!-- Materials Grid -->
    @if($materials->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($materials as $item)
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    
                    <div class="space-y-3">
                        <!-- Top Meta -->
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-[11px] font-semibold truncate max-w-[200px]">
                                {{ $item->course ? $item->course->course_title : 'Course' }}
                            </span>
                            <span class="px-2 py-0.5 rounded bg-rose-500/10 border border-rose-500/20 text-rose-400 font-mono text-[10px] font-bold uppercase">
                                PDF
                            </span>
                        </div>

                        <!-- Title & Chapter -->
                        <div>
                            <span class="text-[11px] font-mono text-slate-500 block mb-1">
                                {{ $item->chapter ? $item->chapter->chapter_name : 'Module Material' }}
                            </span>
                            <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2">
                                {{ $item->lesson_title }}
                            </h3>
                        </div>

                        <!-- Brief description or instruction -->
                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            Complete official handout and practice guide for this topic. Download to read offline.
                        </p>
                    </div>

                    <!-- Bottom Action Buttons -->
                    <div class="pt-4 border-t border-slate-800/80 flex items-center justify-between gap-3">
                        <a href="{{ route('student.courses.learn', [$item->course_id, $item->id]) }}" class="text-xs text-slate-400 hover:text-white transition-colors flex items-center gap-1 font-medium">
                            <i class="fa fa-play-circle-o"></i>
                            <span>View Lesson</span>
                        </a>

                        <a href="{{ safe_asset($item->pdf_file) }}" target="_blank" download class="px-4 py-2 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-bold text-xs transition-all shadow-md flex items-center gap-1.5">
                            <i class="fa fa-download"></i>
                            <span>Download PDF</span>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-rose-500/10 text-rose-500 border border-rose-500/20 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-folder-open-o"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Materials Available Yet</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                You do not have any PDF handouts uploaded yet, or you haven't enrolled in courses with attached resources.
            </p>
            <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <i class="fa fa-search"></i>
                <span>Explore Available Courses</span>
            </a>
        </div>
    @endif

</div>
@endsection
