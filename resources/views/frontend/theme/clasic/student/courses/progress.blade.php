@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Learning Progress & Milestones — Wake Up ICT')
@section('page_title', 'Course Progress')
@section('page_crumb', 'Completion Milestones')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-line-chart text-brand-primary"></i>
                <span>Learning Progress & Milestones</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Monitor your completion percentages, lecture milestones, and curriculum progress across all your courses.
            </p>
        </div>
        <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-plus"></i>
            <span>Browse Courses</span>
        </a>
    </div>

    @if($enrollments->count() > 0)
        @php
            $totalEnrolled = $enrollments->count();
            $totalLessonsInAll = 0;
            $totalCompletedInAll = 0;

            foreach($enrollments as $enr) {
                $totalLessonsInAll += \App\model\LmsLesson::where('course_id', $enr->course_id)->where('status', 1)->count();
                $totalCompletedInAll += \App\model\LmsLessonProgress::where('student_account_id', $student->id)->where('course_id', $enr->course_id)->where('is_completed', true)->count();
            }

            $overallAvg = $totalLessonsInAll > 0 ? (int) round(($totalCompletedInAll / $totalLessonsInAll) * 100) : 0;
        @endphp

        <!-- Overall KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400 uppercase">Enrolled Courses</span>
                    <span class="w-8 h-8 rounded-lg bg-brand-primary/10 text-brand-primary flex items-center justify-center text-sm">
                        <i class="fa fa-book"></i>
                    </span>
                </div>
                <div class="text-2xl font-black text-white mt-2 font-mono">{{ $totalEnrolled }}</div>
                <span class="text-[11px] text-slate-500 mt-1 block">Active technical programs</span>
            </div>

            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400 uppercase">Lessons Completed</span>
                    <span class="w-8 h-8 rounded-lg bg-brand-cyan/10 text-brand-cyan flex items-center justify-center text-sm">
                        <i class="fa fa-check-circle"></i>
                    </span>
                </div>
                <div class="text-2xl font-black text-white mt-2 font-mono">{{ $totalCompletedInAll }}</div>
                <span class="text-[11px] text-slate-500 mt-1 block">Out of {{ $totalLessonsInAll }} total lessons</span>
            </div>

            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400 uppercase">Overall Progress</span>
                    <span class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-sm">
                        <i class="fa fa-pie-chart"></i>
                    </span>
                </div>
                <div class="text-2xl font-black text-brand-primary mt-2 font-mono">{{ $overallAvg }}%</div>
                <span class="text-[11px] text-slate-500 mt-1 block">Average completion rate</span>
            </div>

            <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-mono text-slate-400 uppercase">Certifications</span>
                    <span class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center text-sm">
                        <i class="fa fa-certificate"></i>
                    </span>
                </div>
                <div class="text-2xl font-black text-white mt-2 font-mono">
                    {{ $enrollments->filter(function($e) { return $e->progress_percentage >= 100; })->count() }}
                </div>
                <span class="text-[11px] text-slate-500 mt-1 block">Completed curriculum programs</span>
            </div>
        </div>

        <!-- Per Course Detailed Progress List -->
        <div class="space-y-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa fa-tasks text-brand-primary"></i>
                <span>Individual Course Progress</span>
            </h2>

            <div class="space-y-4">
                @foreach($enrollments as $enr)
                    @php
                        $course = $enr->course;
                        $batch = $enr->batch;
                        $prog = $enr->progress_percentage;
                        $totalL = \App\model\LmsLesson::where('course_id', $course->id)->where('status', 1)->count();
                        $doneL = \App\model\LmsLessonProgress::where('student_account_id', $student->id)->where('course_id', $course->id)->where('is_completed', true)->count();
                        $chapters = \App\model\LmsChapter::where('course_id', $course->id)->where('status', 1)->with('activeLessons')->get();
                    @endphp

                    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 backdrop-blur-xl hover:border-slate-700 transition-all space-y-6">
                        
                        <!-- Course Header & Progress Bar -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                @if($course->image)
                                    <img src="{{ safe_asset($course->image) }}" alt="{{ $course->course_title }}" class="w-16 h-16 rounded-2xl object-cover shrink-0 border border-slate-800">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-500 text-2xl shrink-0">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                            {{ $batch ? $batch->batch_number : 'Standard Track' }}
                                        </span>
                                        <span class="text-xs text-slate-400 font-mono">
                                            {{ $doneL }} of {{ $totalL }} lessons completed
                                        </span>
                                    </div>
                                    <h3 class="text-base font-bold text-white hover:text-brand-primary transition-colors">
                                        <a href="{{ route('student.courses.learn', $course->id) }}">{{ $course->course_title }}</a>
                                    </h3>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 self-end md:self-auto">
                                <div class="text-right">
                                    <span class="text-2xl font-black font-mono {{ $prog == 100 ? 'text-brand-primary' : 'text-white' }}">{{ $prog }}%</span>
                                    <span class="text-[10px] text-slate-500 block uppercase font-mono">{{ $prog == 100 ? 'Completed' : 'In Progress' }}</span>
                                </div>
                                <a href="{{ route('student.courses.learn', $course->id) }}" class="px-5 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5 shrink-0">
                                    <i class="fa fa-play"></i>
                                    <span>Resume</span>
                                </a>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full h-2.5 rounded-full bg-slate-800 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-brand-primary to-brand-cyan transition-all duration-500" style="width: {{ $prog }}%"></div>
                        </div>

                        <!-- Module Breakdown Chips -->
                        @if($chapters->count() > 0)
                            <div class="pt-2 border-t border-slate-800/60">
                                <span class="text-[11px] font-mono text-slate-400 block mb-2">Module Breakdown:</span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2.5">
                                    @foreach($chapters as $ch)
                                        @php
                                            $chLessons = $ch->activeLessons;
                                            $chTotal = $chLessons->count();
                                            $chDone = \App\model\LmsLessonProgress::where('student_account_id', $student->id)
                                                ->whereIn('lesson_id', $chLessons->pluck('id'))
                                                ->where('is_completed', true)
                                                ->count();
                                            $chPct = $chTotal > 0 ? (int) round(($chDone / $chTotal) * 100) : 0;
                                        @endphp
                                        <div class="p-2.5 rounded-xl bg-slate-950/60 border border-slate-800/80 flex items-center justify-between text-xs">
                                            <span class="text-slate-300 truncate pr-2" title="{{ $ch->chapter_name }}">{{ $ch->chapter_name }}</span>
                                            <span class="font-mono text-[11px] {{ $chPct == 100 ? 'text-brand-primary font-bold' : 'text-slate-400' }} shrink-0">
                                                {{ $chDone }}/{{ $chTotal }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>

    @else
        <!-- Empty State -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary border border-brand-primary/20 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-line-chart"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Active Progress Records</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                You haven't enrolled in any courses yet. Once you enroll and start lessons, your progress and milestones will display here.
            </p>
            <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <i class="fa fa-search"></i>
                <span>Explore Available Courses</span>
            </a>
        </div>
    @endif

</div>
@endsection
