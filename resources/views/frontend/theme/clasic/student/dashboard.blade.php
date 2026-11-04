@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'কুইজ ও পরীক্ষা ড্যাশবোর্ড — Wake Up ICT')
@section('page_title', 'Student Dashboard')
@section('page_crumb', 'কুইজ ও পরীক্ষা ড্যাশবোর্ড')

@section('content')
@php
    $bngDigits = ['0'=>'০','1'=>'১','2'=>'২','3'=>'৩','4'=>'৪','5'=>'৫','6'=>'৬','7'=>'৭','8'=>'৮','9'=>'৯'];
    $toBng = function($num) use ($bngDigits) {
        return strtr((string)$num, $bngDigits);
    };
    $passRate = $totalAttemptsCount > 0 ? round(($passedAttemptsCount / $totalAttemptsCount) * 100) : 0;
@endphp

<div class="space-y-8 max-w-7xl mx-auto pb-10">

    <!-- =========================================================================
         1. MODERN WELCOME HERO BANNER (QUIZ & EXAMINATION FOCUSED)
         ========================================================================= -->
    <div class="student-card relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-900 via-slate-900 to-emerald-950 border border-emerald-500/30 p-6 sm:p-8 backdrop-blur-xl shadow-2xl text-white">
        <!-- Ambient Decorative Glow -->
        <div class="absolute -right-16 -top-16 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -bottom-20 w-64 h-64 bg-cyan-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="relative flex-shrink-0">
                    <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover border-2 border-emerald-400 shadow-glow-emerald bg-slate-800">
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-400 border-2 border-slate-900" title="Active Campus Student"></span>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-2.5">
                        <span class="px-3 py-1 rounded-full bg-slate-900 text-white dark:bg-emerald-950/80 dark:text-emerald-300 border border-slate-900 dark:border-emerald-500/50 text-xs font-mono tracking-wider uppercase font-black shadow-sm" style="color: #ffffff !important; font-weight: 800; background-color: #0f172a !important;">
                            আইডি: {{ $student->student_id_code }}
                        </span>
                        <span class="px-2.5 py-1 rounded-full bg-blue-100 dark:bg-blue-950/60 border border-blue-300 dark:border-blue-500/40 text-blue-950 dark:text-blue-300 text-xs font-black shadow-sm flex items-center gap-1.5" style="color: #1e3a8a !important; font-weight: 800;">
                            <i class="fa fa-graduation-cap text-blue-700 dark:text-blue-400"></i>
                            <span>কুইজ ও পরীক্ষা পোর্টাল</span>
                        </span>
                        <span class="px-2.5 py-1 rounded-full bg-amber-100 dark:bg-amber-950/60 border border-amber-300 dark:border-amber-500/40 text-amber-950 dark:text-amber-300 text-xs font-black shadow-sm flex items-center gap-1.5" style="color: #78350f !important; font-weight: 800;">
                            <i class="fa fa-bolt text-amber-600 dark:text-amber-400"></i>
                            <span>রিয়েলটাইম ওএমআর মূল্যায়ন</span>
                        </span>
                    </div>

                    <h1 class="text-xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                        স্বাগতম, <span class="text-emerald-600 dark:text-emerald-400">{{ $student->name }}</span>! 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 mt-1.5 max-w-2xl leading-relaxed font-semibold">
                        Wake Up ICT অনলাইন পরীক্ষা পোর্টালে আপনাকে স্বাগতম। এখান থেকে আনলিমিটেড প্রশ্ন ব্যাংক অনুশীলন করুন, নির্ধারিত কুইজে অংশ নিন এবং আপনার প্রতিটি পরীক্ষার বিস্তারিত ওএমআর ফলাফল যাচাই করুন।
                    </p>
                </div>
            </div>

            <!-- Quick Action Shortcuts -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0 pt-2 lg:pt-0">
                <a href="{{ route('student.practice.index') }}" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-black uppercase tracking-wider transition-all shadow-md flex items-center gap-2 active:scale-95" style="color: #ffffff !important; font-weight: 800; background-color: #059669 !important;">
                    <i class="fa fa-check-square-o text-sm"></i>
                    <span>অনুশীলন পরীক্ষা</span>
                </a>
                <a href="{{ route('student.quiz.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition-all flex items-center gap-2 shadow-xs">
                    <i class="fa fa-clock-o text-cyan-700 dark:text-cyan-400"></i>
                    <span>অনলাইন কুইজ</span>
                </a>
                <a href="{{ route('student.results.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition-all flex items-center gap-2 shadow-xs">
                    <i class="fa fa-bar-chart text-amber-700 dark:text-amber-400"></i>
                    <span>ফলাফল ও ওএমআর</span>
                </a>
                <a href="{{ route('student.exams.history') }}" class="px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-white text-xs font-bold border border-slate-300 dark:border-slate-700 transition-all flex items-center gap-2 shadow-xs">
                    <i class="fa fa-history text-indigo-700 dark:text-indigo-400"></i>
                    <span>হিস্ট্রি</span>
                </a>
            </div>
        </div>
    </div>

    <!-- =========================================================================
         2. CORE QUIZ & EXAMINATION METRICS (4 CARDS)
         ========================================================================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- 1. Total Completed Exams -->
        <a href="{{ route('student.exams.history') }}" class="student-card block rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-emerald-500/50 transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">মোট পরীক্ষা সম্পন্ন</span>
                <div class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-slate-900 dark:text-white font-mono">
                {{ $toBng($totalAttemptsCount) }} <span class="text-xs font-sans text-slate-500 dark:text-slate-400 font-semibold">টি পরীক্ষা</span>
            </p>
            <div class="mt-2 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-600 dark:text-emerald-400 font-semibold flex items-center gap-1">
                    <i class="fa fa-archive"></i>
                    <span>সংরক্ষিত ও মূল্যায়িত</span>
                </span>
                <span class="text-slate-400 group-hover:text-emerald-500 flex items-center gap-0.5">
                    <span>হিস্ট্রি দেখুন</span>
                    <i class="fa fa-arrow-right text-[10px]"></i>
                </span>
            </div>
        </a>

        <!-- 2. Passed Exams Count -->
        <a href="{{ route('student.results.index') }}" class="student-card block rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-cyan-500/50 transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">উত্তীর্ণ পরীক্ষা</span>
                <div class="w-10 h-10 rounded-2xl bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa fa-trophy"></i>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-cyan-600 dark:text-cyan-400 font-mono">
                {{ $toBng($passedAttemptsCount) }} <span class="text-xs font-sans text-slate-500 dark:text-slate-400 font-semibold">টি উত্তীর্ণ</span>
            </p>
            <div class="mt-2 flex items-center justify-between text-xs font-medium">
                <span class="text-slate-600 dark:text-slate-400">
                    <i class="fa fa-star text-amber-500 mr-1"></i> পাস মার্ক অর্জনকারী
                </span>
                <span class="text-slate-400 group-hover:text-cyan-500 flex items-center gap-0.5">
                    <span>ফলাফল</span>
                    <i class="fa fa-arrow-right text-[10px]"></i>
                </span>
            </div>
        </a>

        <!-- 3. Pass Rate Percentage -->
        <div class="student-card block rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm transition-all">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">পাসের হার (সাফল্য)</span>
                <div class="w-10 h-10 rounded-2xl bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center text-base">
                    <i class="fa fa-percent"></i>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-slate-900 dark:text-white font-mono">
                {{ $toBng($passRate) }}%
            </p>
            <div class="mt-2 flex items-center justify-between text-xs font-medium">
                <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden mr-2">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-400 h-2 rounded-full" style="width: {{ min(100, max(0, $passRate)) }}%"></div>
                </div>
                <span class="text-emerald-600 dark:text-emerald-400 font-bold font-mono">{{ $toBng($passRate) }}%</span>
            </div>
        </div>

        <!-- 4. Available Live Quizzes -->
        <a href="{{ route('student.quiz.index') }}" class="student-card block rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-amber-500/50 transition-all group">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">বর্তমান উন্মুক্ত কুইজ</span>
                <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-base group-hover:scale-110 transition-transform">
                    <i class="fa fa-file-text-o"></i>
                </div>
            </div>
            <p class="text-2xl font-extrabold text-amber-600 dark:text-amber-400 font-mono">
                {{ $toBng(count($availableQuizzes)) }} <span class="text-xs font-sans text-slate-500 dark:text-slate-400 font-semibold">টি কুইজ</span>
            </p>
            <div class="mt-2 flex items-center justify-between text-xs font-medium">
                <span class="text-slate-600 dark:text-slate-400">
                    <i class="fa fa-circle text-emerald-500 text-[8px] mr-1 animate-pulse"></i> অংশগ্রহণের উপযোগী
                </span>
                <span class="text-slate-400 group-hover:text-amber-500 flex items-center gap-0.5">
                    <span>কুইজ তালিকা</span>
                    <i class="fa fa-arrow-right text-[10px]"></i>
                </span>
            </div>
        </a>

    </div>

    <!-- =========================================================================
         3. QUIZ & EXAMINATION NAVIGATION HUB (৫টি মূল মডিউল কার্ড)
         ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="fa fa-th-large text-emerald-600 dark:text-emerald-400"></i>
                    <span>কুইজ ও পরীক্ষা মডিউল হাব (Examination Hub)</span>
                </h2>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                    পরীক্ষার যেকোনো সেকশনে সরাসরি প্রবেশ করতে নিচের কার্ডগুলোতে ক্লিক করুন।
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">

            <!-- Card 1: Practice Drill -->
            <a href="{{ route('student.practice.index') }}" class="student-card block rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-emerald-500/50 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl mb-3.5 group-hover:scale-110 transition-transform">
                    <i class="fa fa-crosshairs"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                    অনুশীলন পরীক্ষা
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                    স্মার্ট প্রশ্ন ব্যাংক ড্রিল। আনলিমিটেড প্রশ্ন রোটেশন ভিত্তিক সেলফ-পেসড প্রস্তুতি।
                </p>
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-emerald-600 dark:text-emerald-400">
                    <span>অনুশীলন করুন</span>
                    <i class="fa fa-arrow-right text-[11px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Card 2: Online Quizzes -->
            <a href="{{ route('student.quiz.index') }}" class="student-card block rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-cyan-500/50 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-cyan-500/10 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-xl mb-3.5 group-hover:scale-110 transition-transform">
                    <i class="fa fa-laptop"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white group-hover:text-cyan-600 dark:group-hover:text-cyan-400 transition-colors">
                    অনলাইন কুইজ
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                    নির্ধারিত সময়, বিষয়ভিত্তিক পূর্ণমান এবং সরাসরি বোর্ড স্ট্যান্ডার্ড অনলাইন পরীক্ষা।
                </p>
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-cyan-600 dark:text-cyan-400">
                    <span>কুইজ তালিকা</span>
                    <i class="fa fa-arrow-right text-[11px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Card 3: Upcoming Exams -->
            <a href="{{ route('student.exams.upcoming') }}" class="student-card block rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-indigo-500/50 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl mb-3.5 group-hover:scale-110 transition-transform">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                    আসন্ন পরীক্ষা
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                    আসন্ন শিডিউল করা সকল পরীক্ষার তারিখ, সময়সূচী ও সিলেবাস নির্দেশিকা।
                </p>
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-indigo-600 dark:text-indigo-400">
                    <span>শিডিউল দেখুন</span>
                    <i class="fa fa-arrow-right text-[11px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Card 4: Results & OMR Evaluation -->
            <a href="{{ route('student.results.index') }}" class="student-card block rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-amber-500/50 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl mb-3.5 group-hover:scale-110 transition-transform">
                    <i class="fa fa-bar-chart"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                    ফলাফল ও ওএমআর
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                    সম্পূর্ণ ওএমআর উত্তরপত্র মেট্রিক্স, সঠিক/ভুল বিশ্লেষণ ও প্রিন্টযোগ্য মার্কশিট।
                </p>
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-amber-600 dark:text-amber-400">
                    <span>ফলাফল বিবরণী</span>
                    <i class="fa fa-arrow-right text-[11px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Card 5: Exam History Archive -->
            <a href="{{ route('student.exams.history') }}" class="student-card block rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-purple-500/50 transition-all group">
                <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl mb-3.5 group-hover:scale-110 transition-transform">
                    <i class="fa fa-history"></i>
                </div>
                <h3 class="text-sm font-extrabold text-slate-900 dark:text-white group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                    পরীক্ষার ইতিহাস
                </h3>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">
                    পূর্ববর্তী সকল পরীক্ষার বিস্তারিত আর্কাইভ, নম্বর ট্র্যাকিং ও অগ্রগতি বিশ্লেষণ।
                </p>
                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80 flex items-center justify-between text-xs font-bold text-purple-600 dark:text-purple-400">
                    <span>আর্কাইভ দেখুন</span>
                    <i class="fa fa-arrow-right text-[11px] group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

        </div>
    </div>

    <!-- =========================================================================
         4. AVAILABLE ONLINE QUIZZES (চলমান কুইজসমূহ)
         ========================================================================= -->
    @if($availableQuizzes && $availableQuizzes->count() > 0)
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="fa fa-fire text-amber-500"></i>
                    <span>চলমান অনলাইন কুইজসমূহ (Live Quizzes)</span>
                </h2>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                    যেকোনো কুইজে অংশ নিতে "পরীক্ষায় অংশ নিন" বাটনে ক্লিক করুন।
                </p>
            </div>
            <a href="{{ route('student.quiz.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                <span>সকল কুইজ</span>
                <i class="fa fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($availableQuizzes as $quiz)
                <div class="student-card rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm hover:shadow-md hover:border-emerald-500/40 transition-all flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-2.5">
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-[11px] font-bold">
                                {{ $quiz->exam_type ?: 'অনলাইন কুইজ' }}
                            </span>
                            <span class="text-[11px] font-mono text-slate-500 dark:text-slate-400 font-semibold flex items-center gap-1">
                                <i class="fa fa-clock-o text-slate-400"></i>
                                <span>{{ $toBng($quiz->duration_minutes ?: 30) }} মি.</span>
                            </span>
                        </div>
                        <h3 class="text-sm font-extrabold text-slate-900 dark:text-white line-clamp-2">
                            {{ $quiz->title }}
                        </h3>
                        @if($quiz->description)
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">
                                {{ $quiz->description }}
                            </p>
                        @endif

                        <div class="mt-3 grid grid-cols-2 gap-2 text-[11px] font-mono text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-slate-950 p-2.5 rounded-xl border border-slate-100 dark:border-slate-800">
                            <div>
                                <span class="text-slate-400 block text-[10px]">পূর্ণমান</span>
                                <span class="font-bold">{{ $toBng($quiz->total_marks ?: 30) }} নম্বর</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">পাস মার্ক</span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $toBng($quiz->pass_marks ?: 12) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800/80">
                        <a href="{{ route('student.quiz.lobby', $quiz->id) }}" class="w-full py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold flex items-center justify-center gap-1.5 transition-all shadow-sm">
                            <i class="fa fa-play-circle text-xs"></i>
                            <span>পরীক্ষায় অংশ নিন</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- =========================================================================
         5. RECENT EXAM ATTEMPTS TABLE (সাম্প্রতিক পরীক্ষার ফলাফল)
         ========================================================================= -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                    <i class="fa fa-history text-cyan-600 dark:text-cyan-400"></i>
                    <span>সাম্প্রতিক পরীক্ষার ফলাফল ও বিবরণী (Recent Performance)</span>
                </h2>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-0.5">
                    আপনার সর্বশেষ দেওয়া পরীক্ষাগুলোর ফলাফল, প্রাপ্ত নম্বর ও মূল্যায়ন ওএমআর।
                </p>
            </div>
            <a href="{{ route('student.results.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                <span>সম্পূর্ণ ফলাফল দেখুন</span>
                <i class="fa fa-chevron-right text-[10px]"></i>
            </a>
        </div>

        <div class="student-card rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
            @if($recentAttempts && $recentAttempts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 dark:bg-slate-950 border-b border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-bold uppercase tracking-wider text-[11px]">
                            <tr>
                                <th class="py-3 px-4"># ক্রমিক</th>
                                <th class="py-3 px-4">পরীক্ষার নাম ও সেট</th>
                                <th class="py-3 px-4">তারিখ ও সময়</th>
                                <th class="py-3 px-4 text-center">স্কোর / পূর্ণমান</th>
                                <th class="py-3 px-4 text-center">শতকরা</th>
                                <th class="py-3 px-4 text-center">ফলাফল</th>
                                <th class="py-3 px-4 text-right">ওএমআর ও মূল্যায়ন</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 font-medium text-slate-800 dark:text-slate-200">
                            @foreach($recentAttempts as $idx => $attempt)
                                @php
                                    $isPassed = $attempt->isPassed();
                                    $totalQ = $attempt->total_questions ?: 10;
                                    $score = $attempt->score ?: 0;
                                    $totalM = $attempt->total_marks ?: $totalQ;
                                    $pct = $totalM > 0 ? round(($score / $totalM) * 100) : 0;
                                @endphp
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="py-3 px-4 font-mono text-slate-500 dark:text-slate-400">
                                        #{{ $toBng($idx + 1) }}
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="font-extrabold text-slate-900 dark:text-white">
                                            {{ $attempt->quiz ? $attempt->quiz->title : 'অনুশীলন পরীক্ষা ড্রিল' }}
                                        </div>
                                        <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                            প্রচেষ্টা নং #{{ $toBng($attempt->attempt_number ?: 1) }}
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 dark:text-slate-300 font-mono text-[11px]">
                                        {{ $attempt->submitted_at ? $attempt->submitted_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') : $attempt->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
                                    </td>
                                    <td class="py-3 px-4 text-center font-mono font-bold text-slate-900 dark:text-white">
                                        {{ $toBng($score) }} / {{ $toBng($totalM) }}
                                    </td>
                                    <td class="py-3 px-4 text-center font-mono font-bold text-slate-800 dark:text-slate-200">
                                        {{ $toBng($pct) }}%
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        @if($isPassed)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-300 text-[11px] font-bold" style="color: #000000 !important; font-weight: 800;">
                                                <i class="fa fa-check text-[10px]"></i> উত্তীর্ণ
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-rose-600 text-white text-[11px] font-bold" style="color: #000000 !important; font-weight: 800;">
                                                <i class="fa fa-times text-[10px]"></i> অনুত্তীর্ণ
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <a href="{{ route('student.quiz.results', $attempt->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-slate-800 hover:bg-emerald-600 hover:text-white dark:hover:bg-emerald-600 text-slate-700 dark:text-slate-200 font-bold transition-all text-[11px]">
                                            <i class="fa fa-file-text-o"></i>
                                            <span>ওএমআর দেখুন</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center space-y-3">
                    <div class="w-14 h-14 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 mx-auto flex items-center justify-center text-2xl">
                        <i class="fa fa-check-square-o"></i>
                    </div>
                    <h3 class="text-sm font-extrabold text-slate-900 dark:text-white">এখনও কোনো পরীক্ষায় অংশ নেননি!</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 max-w-md mx-auto leading-relaxed">
                        আপনার প্রস্তুতি শুরু করতে এখনই অনুশীলন পরীক্ষায় অংশ নিন অথবা চলমান অনলাইন কুইজ থেকে যেকোনো পরীক্ষা সম্পন্ন করুন।
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('student.practice.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold shadow-md transition-all">
                            <i class="fa fa-play text-xs"></i>
                            <span>প্রথম অনুশীলন পরীক্ষা শুরু করুন</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- =========================================================================
         6. QUESTION BANK UNLIMITED PRACTICE CALL-TO-ACTION BANNER
         ========================================================================= -->
    <div class="student-card rounded-3xl bg-gradient-to-r from-emerald-600 to-teal-700 p-6 sm:p-8 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-2 text-center md:text-left">
            <span class="px-3 py-1 rounded-full bg-white/20 text-white text-xs font-mono font-bold tracking-wide uppercase inline-block">
                আনলিমিটেড সেলফ-পেসড প্রস্তুতি
            </span>
            <h3 class="text-xl sm:text-2xl font-black">
                প্রশ্ন ব্যাংক থেকে রোটেশন ভিত্তিক স্মার্ট ড্রিল দিন!
            </h3>
            <p class="text-xs sm:text-sm text-emerald-100 max-w-xl leading-relaxed">
                প্রতিটি চেষ্টায় ভিন্ন ভিন্ন প্রশ্ন সেটের মুখোমুখি হয়ে নিজেকে নির্ভুলভাবে প্রস্তুত করুন। পরীক্ষা শেষে তাৎক্ষণিক ওএমআর ও সঠিক উত্তর দেখার সুবিধা।
            </p>
        </div>
        <div class="shrink-0">
            <a href="{{ route('student.practice.index') }}" class="px-6 py-3.5 rounded-2xl bg-white hover:bg-slate-100 text-emerald-950 font-black text-sm uppercase tracking-wider transition-all shadow-lg flex items-center gap-2 active:scale-95">
                <i class="fa fa-bolt text-emerald-600"></i>
                <span>প্র্যাকটিস শুরু করুন</span>
            </a>
        </div>
    </div>

</div>
@endsection
