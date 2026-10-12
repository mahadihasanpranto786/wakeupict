@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', $course->course_title . ' — Wake Up ICT')
@section('page_title', 'Course Syllabus')
@section('page_crumb', 'Curriculum Details')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Breadcrumb & Back Action -->
    <div class="flex items-center justify-between">
        <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
            <i class="fa fa-arrow-left"></i>
            <span>Back to All Courses</span>
        </a>
        <div class="flex items-center gap-2">
            @if($isEnrolled)
                <span class="px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/30 text-brand-primary font-mono text-xs font-bold flex items-center gap-1.5">
                    <i class="fa fa-check-circle"></i>
                    <span>Enrolled</span>
                </span>
            @endif
        </div>
    </div>

    <!-- Course Hero Section -->
    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-brand-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start relative z-10">
            <!-- Left Info -->
            <div class="lg:col-span-8 space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-3 py-1 rounded-full bg-slate-800 border border-slate-700 text-brand-primary font-mono text-xs font-semibold">
                        {{ $course->course_type ?: 'Professional Training' }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-slate-800/60 border border-slate-700/60 text-slate-300 font-mono text-xs">
                        <i class="fa fa-clock-o mr-1"></i> {{ $course->course_duration ?: '3 Months' }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-slate-800/60 border border-slate-700/60 text-slate-300 font-mono text-xs">
                        <i class="fa fa-book mr-1"></i> {{ $chapters->count() }} Modules
                    </span>
                    <span class="px-3 py-1 rounded-full bg-slate-800/60 border border-slate-700/60 text-slate-300 font-mono text-xs">
                        <i class="fa fa-play-circle mr-1"></i> {{ $chapters->sum(function($c) { return $c->activeLessons->count(); }) }} Lessons
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    {{ $course->course_title }}
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed max-w-3xl">
                    {{ $course->short_description ?: 'Master industry-standard technical skills with structured lessons, practical assignments, and direct mentorship at Wake Up ICT.' }}
                </p>

                <!-- Key Metrics & Enrollment Action -->
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    @if($isEnrolled)
                        <a href="{{ route('student.courses.learn', $course->id) }}" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-sm uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                            <i class="fa fa-play"></i>
                            <span>Continue Learning</span>
                        </a>
                    @else
                        <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-sm uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                                <i class="fa fa-graduation-cap"></i>
                                <span>Enroll Now (Free with Admission)</span>
                            </button>
                        </form>
                    @endif

                    <a href="#curriculum" class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs border border-slate-700 transition-all flex items-center gap-1.5">
                        <i class="fa fa-list-ul"></i>
                        <span>Explore Syllabus</span>
                    </a>
                </div>
            </div>

            <!-- Right Media / Quick Summary -->
            <div class="lg:col-span-4 w-full">
                <div class="rounded-2xl overflow-hidden bg-slate-950 border border-slate-800 shadow-2xl relative group">
                    @if($course->image)
                        <img src="{{ safe_asset($course->image) }}" alt="{{ $course->course_title }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-52 flex items-center justify-center text-slate-700 text-5xl">
                            <i class="fa fa-laptop"></i>
                        </div>
                    @endif
                    <div class="p-5 space-y-3 bg-slate-900/90 border-t border-slate-800">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Course Fee:</span>
                            <span class="font-bold text-brand-primary font-mono text-base">
                                {{ $course->after_discount ? '৳ ' . number_format($course->after_discount) : ($course->course_fee ? '৳ ' . number_format($course->course_fee) : 'Free for Admitted Students') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Class Mode:</span>
                            <span class="text-emerald-400 font-semibold flex items-center gap-1">
                                <i class="fa fa-map-marker"></i> অফলাইন ক্যাম্পাস ব্যাচ
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Campus Venue:</span>
                            <span class="text-slate-200 font-medium">কম্পিউটার ল্যাব (Campus Lab)</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Class Handouts:</span>
                            <span class="text-slate-300 font-medium">প্রিন্টেড শীট ও ডিজিটাল PDF</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400">Certificate:</span>
                            <span class="text-brand-cyan font-medium"><i class="fa fa-certificate mr-1"></i> কোর্স সমাপনীতে অ্যাডমিন কর্তৃক ইস্যুকৃত</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Curriculum Syllabus Section -->
    <div id="curriculum" class="space-y-6">
        <div class="flex items-center justify-between pb-2 border-b border-slate-800">
            <div>
                <h2 class="text-xl font-extrabold text-white flex items-center gap-2">
                    <i class="fa fa-list-alt text-brand-primary"></i>
                    <span>Curriculum Syllabus</span>
                </h2>
                <p class="text-xs text-slate-400 mt-1">Structured chapters and lesson modules designed for progressive learning.</p>
            </div>
            <span class="text-xs text-slate-400 font-mono">
                {{ $chapters->count() }} Modules &bull; {{ $chapters->sum(function($c) { return $c->activeLessons->count(); }) }} Lessons
            </span>
        </div>

        @if($chapters->count() > 0)
            <div class="space-y-4">
                @foreach($chapters as $cIndex => $chapter)
                    <div class="student-card rounded-2xl bg-slate-900/70 border border-slate-800 overflow-hidden transition-all">
                        <!-- Chapter Header -->
                        <div class="p-4 sm:p-5 bg-slate-850/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-800/60">
                            <div class="flex items-start sm:items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-brand-primary/10 border border-brand-primary/20 text-brand-primary font-mono text-xs font-bold flex items-center justify-center shrink-0">
                                    {{ $cIndex + 1 }}
                                </span>
                                <div>
                                    <h3 class="text-sm sm:text-base font-bold text-white">
                                        {{ $chapter->chapter_name }}
                                    </h3>
                                    @if($chapter->chapter_description)
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $chapter->chapter_description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-400 font-mono self-end sm:self-auto">
                                <span>{{ $chapter->activeLessons->count() }} Lessons</span>
                            </div>
                        </div>

                        <!-- Lessons List -->
                        <div class="divide-y divide-slate-800/50">
                            @forelse($chapter->activeLessons as $lIndex => $lesson)
                                @php
                                    $isDone = in_array($lesson->id, $completedLessonIds);
                                @endphp
                                <div class="p-3.5 sm:p-4 hover:bg-slate-800/30 transition-colors flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <!-- Status / Icon Indicator -->
                                        @if($isDone)
                                            <span class="w-6 h-6 rounded-full bg-brand-primary text-slate-950 flex items-center justify-center text-[10px] shrink-0" title="Completed">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        @elseif($lesson->is_free_preview || $isEnrolled)
                                            <span class="w-6 h-6 rounded-full bg-slate-800 border border-slate-700 text-slate-400 flex items-center justify-center text-[10px] shrink-0">
                                                <i class="fa {{ $lesson->lesson_type == 'video' ? 'fa-play' : 'fa-file-text-o' }}"></i>
                                            </span>
                                        @else
                                            <span class="w-6 h-6 rounded-full bg-slate-800/60 text-slate-600 flex items-center justify-center text-[10px] shrink-0" title="Enroll to unlock">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        @endif

                                        <div class="truncate">
                                            <h4 class="text-xs sm:text-sm font-semibold text-slate-200 truncate">
                                                {{ $lesson->lesson_title }}
                                            </h4>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-[11px] text-slate-500 font-mono">{{ $lesson->formatted_duration }}</span>
                                                @if($lesson->pdf_file)
                                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-brand-cyan/10 text-brand-cyan font-mono"><i class="fa fa-file-pdf-o"></i> PDF Handout</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action -->
                                    <div class="flex items-center gap-2 shrink-0">
                                        @if($lesson->is_free_preview && !$isEnrolled)
                                            <span class="px-2 py-0.5 rounded bg-brand-cyan/20 border border-brand-cyan/30 text-brand-cyan text-[10px] font-bold uppercase tracking-wider">
                                                Preview
                                            </span>
                                        @endif

                                        @if($isEnrolled || $lesson->is_free_preview)
                                            <a href="{{ route('student.courses.learn', [$course->id, $lesson->id]) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-brand-primary hover:text-slate-950 text-slate-200 text-xs font-semibold transition-all">
                                                <i class="fa fa-play mr-1"></i> Watch
                                            </a>
                                        @else
                                            <span class="text-slate-600 text-xs">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center text-xs text-slate-500">
                                    Lessons will be released soon for this module.
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="student-card rounded-2xl bg-slate-900/60 border border-slate-800 p-8 text-center text-slate-400 text-sm">
                <i class="fa fa-clock-o text-2xl text-slate-600 mb-2 block"></i>
                Detailed syllabus is being updated by the academic faculty. Check back shortly!
            </div>
        @endif
    </div>

    <!-- Additional Details & Outcomes -->
    @if($course->importents || $course->possibilities_of_this_course || $course->future_of_this_course)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
            @if($course->importents)
                <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-6 space-y-2">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i class="fa fa-star text-amber-400"></i>
                        <span>Course Highlights</span>
                    </h3>
                    <div class="text-xs text-slate-300 leading-relaxed prose prose-invert max-w-none">
                        {!! $course->importents !!}
                    </div>
                </div>
            @endif

            @if($course->possibilities_of_this_course)
                <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-6 space-y-2">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i class="fa fa-bullseye text-brand-primary"></i>
                        <span>Skill Opportunities</span>
                    </h3>
                    <div class="text-xs text-slate-300 leading-relaxed prose prose-invert max-w-none">
                        {!! $course->possibilities_of_this_course !!}
                    </div>
                </div>
            @endif

            @if($course->future_of_this_course)
                <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-6 space-y-2">
                    <h3 class="text-sm font-bold text-white flex items-center gap-2">
                        <i class="fa fa-line-chart text-brand-cyan"></i>
                        <span>Career Scope</span>
                    </h3>
                    <div class="text-xs text-slate-300 leading-relaxed prose prose-invert max-w-none">
                        {!! $course->future_of_this_course !!}
                    </div>
                </div>
            @endif
        </div>
    @endif

</div>
@endsection
