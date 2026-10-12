@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'কোর্স ক্যাটালগ — Wake Up ICT Learning Platform')
@section('page_title', 'কোর্স ব্রাউজ করুন')
@section('page_crumb', 'অফলাইন ল্যাব কোর্সসমূহ')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- 10MS Signature Header & Search -->
    <div class="student-card rounded-3xl bg-gradient-to-r from-slate-900 via-slate-900/95 to-slate-950 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Explore Training Programs • অফলাইন ক্যাম্পাস ল্যাব</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                    আপনার পছন্দের স্কিল ডেভেলপমেন্ট কোর্সটি বেছে নিন
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    আধুনিক কম্পিউটার ল্যাব প্র্যাকটিস, এক্সপার্ট ট্রেইনারের তত্ত্বাবধানে অফলাইন ব্যাচে হাতে-কলমে প্রজেক্ট শিখুন।
                </p>
            </div>

            <!-- Search Form -->
            <form action="{{ route('student.courses.browse') }}" method="GET" class="w-full md:w-80 relative shrink-0">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="কোর্স বা বিষয় অনুসন্ধান..."
                       class="w-full pl-11 pr-4 py-3 rounded-2xl bg-slate-950/80 border border-slate-700/80 text-xs sm:text-sm text-white placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all shadow-inner">
            </form>
        </div>

        <!-- 10MS Category Filter Pills Bar -->
        @php
            $cat = request('category', 'all');
            $categories = [
                'all'       => ['label' => 'সকল কোর্স', 'icon' => 'fa-th-large'],
                'graphics'  => ['label' => 'গ্রাফিক্স ডিজাইন', 'icon' => 'fa-paint-brush'],
                'web'       => ['label' => 'ওয়েব ডেভেলপমেন্ট', 'icon' => 'fa-code'],
                'ict'       => ['label' => 'ক্লাস ৬-১০ ICT', 'icon' => 'fa-graduation-cap'],
                'marketing' => ['label' => 'ডিজিটাল মার্কেটিং', 'icon' => 'fa-bullhorn'],
                'office'    => ['label' => 'মাইক্রোসফট অফিস', 'icon' => 'fa-desktop'],
                'ai'        => ['label' => 'AI ও টেকনোলজি', 'icon' => 'fa-microchip'],
            ];
        @endphp

        <div class="mt-6 pt-6 border-t border-slate-800/80 flex items-center gap-2 overflow-x-auto no-scrollbar pb-2">
            @foreach($categories as $key => $meta)
                <a href="{{ route('student.courses.browse', array_merge(request()->except('page'), ['category' => $key])) }}" 
                   class="px-4 py-2 rounded-xl text-xs font-semibold whitespace-nowrap transition-all duration-200 flex items-center gap-2 {{ $cat === $key ? 'bg-emerald-500 text-slate-950 shadow-glow-emerald font-bold' : 'bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700/60' }}">
                    <i class="fa {{ $meta['icon'] }} text-xs"></i>
                    <span>{{ $meta['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $c)
            @php 
                $isEnrolled = in_array($c->id, $enrolledCourseIds);
                $coursePrice = (float)$c->price;
                $regularPrice = $coursePrice > 0 ? $coursePrice * 1.35 : 0;
            @endphp
            <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 overflow-hidden backdrop-blur-xl flex flex-col justify-between group hover:border-emerald-500/50 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300">
                
                <!-- 16:9 Thumbnail Banner -->
                <div class="relative aspect-video w-full overflow-hidden bg-slate-950">
                    @if($c->image)
                        <img src="{{ safe_asset($c->image) }}" alt="{{ $c->course_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-700 text-4xl">
                            <i class="fa fa-desktop"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    
                    <!-- Top Badges -->
                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        <span class="px-2.5 py-1 rounded-full bg-slate-950/90 backdrop-blur-md border border-slate-700 text-emerald-400 font-mono text-[11px] font-bold flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                            <span>অফলাইন ল্যাব</span>
                        </span>
                    </div>

                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full bg-slate-950/90 backdrop-blur-md border border-slate-700 text-slate-300 font-mono text-[11px] font-bold">
                            {{ $c->time_line ?: '৩ মাস মেয়াদ' }}
                        </span>
                    </div>

                    <!-- Discount Badge -->
                    @if($coursePrice > 0)
                        <div class="absolute bottom-3 right-3">
                            <span class="px-2.5 py-1 rounded-full bg-rose-500/90 text-white font-mono text-[10px] font-extrabold uppercase tracking-wider shadow-md">
                                Save 26%
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Course Info Body -->
                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <h3 class="text-base font-bold text-white line-clamp-2 leading-snug group-hover:text-emerald-400 transition-colors">
                            {{ $c->course_title }}
                        </h3>

                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                            {{ $c->short_description ?: 'ওয়েব, ডিজাইন, কোডিং ও ফ্রিল্যান্সিং এর সম্পূর্ণ প্র্যাকটিক্যাল ল্যাব ট্রেনিং।' }}
                        </p>

                        <!-- 10MS-Style Key Features List -->
                        <div class="pt-2 space-y-1.5 text-xs text-slate-400 border-t border-slate-800/60">
                            <div class="flex items-center gap-2">
                                <i class="fa fa-check text-emerald-400 text-[10px]"></i>
                                <span>আধুনিক কম্পিউটার ল্যাব প্র্যাকটিস</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa fa-check text-emerald-400 text-[10px]"></i>
                                <span>প্রিন্টেড লেকচার শিট ও এসাইনমেন্ট</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa fa-check text-emerald-400 text-[10px]"></i>
                                <span>ক্যাম্পাস ট্রেইনারের সার্বক্ষণিক সাপোর্ট</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Action Row -->
                    <div class="pt-4 border-t border-slate-800/80 space-y-3">
                        <div class="flex items-baseline justify-between">
                            <div>
                                <span class="text-xs text-slate-400 block font-sans">কোর্স ফি:</span>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-lg font-black text-white font-mono">
                                        ৳ {{ number_format($coursePrice) }}
                                    </span>
                                    @if($regularPrice > $coursePrice)
                                        <span class="text-xs text-slate-500 line-through font-mono">
                                            ৳ {{ number_format($regularPrice) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <span class="text-[11px] font-mono text-emerald-400 font-semibold">
                                <i class="fa fa-users mr-1"></i> সীমিত আসন
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <a href="{{ route('student.courses.details', $c->id) }}" class="px-3 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-xs font-semibold text-center border border-slate-700 transition-all flex items-center justify-center gap-1.5">
                                <i class="fa fa-list-alt text-xs"></i>
                                <span>সিলেবাস দেখুন</span>
                            </a>

                            @if($isEnrolled)
                                <a href="{{ route('student.courses.learn', $c->id) }}" class="px-3 py-2.5 rounded-xl bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 border border-emerald-500/30 text-xs font-bold text-center transition-all flex items-center justify-center gap-1.5">
                                    <i class="fa fa-play text-xs"></i>
                                    <span>ল্যাব ক্লাসে যান</span>
                                </a>
                            @else
                                <form action="{{ route('student.courses.enroll', $c->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full px-3 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-black uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-1.5">
                                        <i class="fa fa-bolt text-xs"></i>
                                        <span>ভর্তি হোন</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 text-center student-card rounded-3xl bg-slate-900/60 border border-slate-800 p-8 space-y-3">
                <div class="w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mx-auto text-2xl">
                    <i class="fa fa-search"></i>
                </div>
                <h3 class="text-base font-bold text-white">কোন কোর্স পাওয়া যায়নি</h3>
                <p class="text-xs text-slate-400 max-w-sm mx-auto">
                    আপনার সার্চ কিওয়ার্ড অথবা নির্বাচিত ক্যাটাগরিতে এই মুহূর্তে নতুন কোর্স নেই। অনুগ্রহ করে অন্য ক্যাটাগরি দেখুন।
                </p>
                <div class="pt-2">
                    <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 text-slate-200 text-xs font-semibold hover:bg-slate-700">
                        <i class="fa fa-refresh"></i>
                        <span>সকল কোর্স দেখুন</span>
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($courses->hasPages())
        <div class="pt-6 flex justify-center">
            {{ $courses->links() }}
        </div>
    @endif

    <!-- 10MS Offline Counseling & Helpline Callout -->
    <div class="student-card rounded-3xl bg-gradient-to-r from-emerald-950/60 via-slate-900 to-slate-950 border border-emerald-500/20 p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="space-y-1 text-center sm:text-left">
            <h3 class="text-base sm:text-lg font-bold text-white flex items-center justify-center sm:justify-start gap-2">
                <i class="fa fa-headphones text-emerald-400"></i>
                <span>কোর্স সিলেক্ট করতে কোনো দ্বিধা আছে?</span>
            </h3>
            <p class="text-xs text-slate-300">
                আমাদের অভিজ্ঞ ক্যারিয়ার কাউন্সিলরদের সাথে সরাসরি কথা বলে আপনার উপযুক্ত অফলাইন ল্যাব ব্যাচ নিশ্চিত করুন।
            </p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="tel:{{ app_setting('contact_phone', '01791612121') }}" class="px-6 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                <i class="fa fa-phone"></i>
                <span>হটলাইনে কল করুন</span>
            </a>
        </div>
    </div>

</div>
@endsection
