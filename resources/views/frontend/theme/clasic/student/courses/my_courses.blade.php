@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'আমার কোর্সসমূহ — Wake Up ICT Learning Platform')
@section('page_title', 'আমার কোর্সসমূহ')
@section('page_crumb', 'এনরোলকৃত অফলাইন ব্যাচ')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- 10MS-Style Enrolled Header -->
    <div class="student-card rounded-3xl bg-gradient-to-r from-slate-900 via-slate-900/95 to-slate-950 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>স্টুডেন্ট লার্নিং ড্যাশবোর্ড</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight flex items-center gap-2.5">
                    <span>আমার অফলাইন ল্যাব কোর্সসমূহ</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-300">
                    ক্যাম্পাস ল্যাব ক্লাস, লেকচার শিট, প্র্যাকটিস ফাইল ও সার্টিফিকেট ট্র্যাকিং।
                </p>
            </div>

            <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald self-start sm:self-auto shrink-0">
                <i class="fa fa-plus"></i>
                <span>নতুন কোর্স ব্রাউজ করুন</span>
            </a>
        </div>
    </div>

    <!-- Enrolled Courses Grid -->
    @if($enrollments->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($enrollments as $enr)
                @php
                    $course = $enr->course;
                    $batch = $enr->batch;
                    $progress = $enr->progress_percentage;
                    $totalLessons = \App\model\LmsLesson::where('course_id', $course->id)->where('status', 1)->count();
                    $completedLessons = \App\model\LmsLessonProgress::where('student_account_id', $student->id)->where('course_id', $course->id)->where('is_completed', true)->count();
                @endphp
                <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 overflow-hidden backdrop-blur-xl flex flex-col group hover:border-emerald-500/50 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300">
                    
                    <!-- 16:9 Thumbnail Banner -->
                    <div class="relative aspect-video w-full overflow-hidden bg-slate-950">
                        @if($course->image)
                            <img src="{{ safe_asset($course->image) }}" alt="{{ $course->course_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-700 text-4xl">
                                <i class="fa fa-laptop"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                        
                        <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                            <span class="px-2.5 py-1 rounded-full bg-slate-950/90 backdrop-blur-md border border-slate-700 text-emerald-400 font-mono text-[11px] font-bold">
                                {{ $batch ? $batch->batch_number : 'অফলাইন ল্যাব ব্যাচ' }}
                            </span>
                            <span class="px-2 py-1 rounded-full bg-emerald-500/20 backdrop-blur-md border border-emerald-500/30 text-emerald-300 font-mono text-[10px] font-bold flex items-center gap-1">
                                <i class="fa fa-map-marker"></i> ক্যাম্পাস
                            </span>
                        </div>

                        <div class="absolute bottom-3 right-3">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500 text-slate-950 text-xs font-black font-mono shadow-md">
                                {{ $progress }}% সম্পন্ন
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                        <div class="space-y-2">
                            <h3 class="text-base font-bold text-white line-clamp-2 leading-snug group-hover:text-emerald-400 transition-colors">
                                {{ $course->course_title }}
                            </h3>
                            <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $course->short_description ?: 'ওয়েক আপ আইসিটি ক্যাম্পাস ল্যাবে হাতে-কলমে প্র্যাকটিস ও গাইডলাইন।' }}
                            </p>
                        </div>

                        <!-- Progress Bar & Stats -->
                        <div class="space-y-2 pt-2 border-t border-slate-800/60">
                            <div class="flex justify-between text-xs font-mono">
                                <span class="text-slate-400">{{ $completedLessons }} / {{ $totalLessons }} ক্লাস সম্পন্ন</span>
                                <span class="text-emerald-400 font-bold">{{ $progress }}%</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-slate-800 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-teal-400 transition-all duration-500" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <!-- 10MS Action Row -->
                        <div class="pt-3 border-t border-slate-800/80 grid grid-cols-2 gap-2">
                            <a href="{{ route('student.courses.details', $course->id) }}" class="px-3 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-semibold text-center border border-slate-700 transition-colors flex items-center justify-center gap-1.5">
                                <i class="fa fa-book text-xs"></i>
                                <span>সিলেবাস</span>
                            </a>
                            <a href="{{ route('student.courses.learn', $course->id) }}" class="px-3 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-black uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-1.5">
                                <i class="fa fa-play text-xs"></i>
                                <span>ক্লাস শুরু</span>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto space-y-4">
            <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mx-auto text-2xl">
                <i class="fa fa-graduation-cap"></i>
            </div>
            <h3 class="text-base font-bold text-white">কোনো কোর্স পাওয়া যায়নি</h3>
            <p class="text-xs text-slate-400 leading-relaxed">
                আপনি এখনও কোনো কোর্সে ভর্তি হননি অথবা আপনার অফলাইন ভর্তি আবেদন অনুমোদনের অপেক্ষায় রয়েছে।
            </p>
            <div class="pt-2">
                <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs uppercase tracking-wider shadow-glow-emerald">
                    <i class="fa fa-th-large"></i>
                    <span>কোর্স ক্যাটালগ দেখুন</span>
                </a>
            </div>
        </div>
    @endif

</div>
@endsection
