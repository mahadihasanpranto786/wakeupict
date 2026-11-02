<!-- 10 Minute School Inspired Top Emergency Helpline & Admission Notice Strip with Running Newsfeed -->
<div class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 text-white py-1.5 px-3 sm:px-6 lg:px-8 text-xs font-medium shadow-sm transition-all duration-300" id="top-announcement-strip">
    <div class="w-full flex items-center justify-between gap-3 sm:gap-4">
        
        <!-- Left: Pinned Pulse Badge (Zero gap layout) -->
        <div class="flex items-center gap-2 shrink-0 z-10">
            <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-white font-mono text-[10px] font-black uppercase tracking-wider shrink-0 flex items-center gap-1.5 border border-white/30 shadow-xs animate-pulse">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-300"></span>
                <span>🔥 অফলাইন ব্যাচ</span>
            </span>
        </div>

        <!-- Center: Dynamic Continuous Running Newsfeed Ticker -->
        <div class="newsfeed-container flex-1 min-w-0 overflow-hidden relative mx-2 cursor-pointer" title="মাউস হোভার করে থামান">
            <div class="newsfeed-track flex items-center whitespace-nowrap text-white font-medium text-[11px] sm:text-xs">
                @for ($seg = 0; $seg < 4; $seg++)
                <div class="newsfeed-segment inline-flex items-center gap-4 shrink-0 pr-6" {!! $seg > 0 ? 'aria-hidden="true"' : '' !!}>
                    <span>নতুন অফলাইন ক্যাম্পাস ল্যাব ব্যাচে ভর্তি চলছে! আধুনিক কম্পিউটার ল্যাবে গ্রুপভিত্তিক ইন্টারেক্টিভ ও প্র্যাকটিক্যাল ট্রেনিং।</span>
                    <span class="text-amber-300 font-bold">✦</span>
                    <span>ভেরিফায়েড সার্টিফিকেট ও ইন্ডাস্ট্রি-স্ট্যান্ডার্ড স্কিল ডেভেলপমেন্ট</span>
                    <span class="text-amber-300 font-bold">✦</span>
                    <span>সীমিত আসন, সরাসরি ল্যাব সিট বুকিং চলছে!</span>
                    <span class="text-amber-300 font-bold">✦</span>
                    <span>সরাসরি মেইন ক্যাম্পাস ভিজিট করুন: নান্নু টাওয়ার (৩য় তলা), পান্না চত্বর, রাজবাড়ী</span>
                    <span class="text-amber-300 font-bold">✦</span>
                    <span>হটলাইন: 01791-612121</span>
                    <span class="text-amber-300 font-bold">✦</span>
                </div>
                @endfor
            </div>
        </div>

        <!-- Right: Daraz-style Utility Strip (Helpline, Student Sign Up, Login, Language) -->
        <div class="flex items-center gap-2 sm:gap-3 shrink-0 text-[11px] font-sans font-semibold tracking-wide z-10 text-white/95">
            
            <!-- Hotline Helpline -->
            <a href="tel:01791612121" class="hidden md:inline-flex hover:text-amber-300 transition-colors items-center gap-1.5 font-mono text-[11px] font-bold">
                <i class="fa fa-phone text-amber-300"></i>
                <span>01791-612121</span>
            </a>

            <span class="hidden md:inline text-white/30">|</span>

            @if(function_exists('is_student_logged_in') && is_student_logged_in())
                <!-- Logged In Student Links -->
                <a href="{{ route('student.dashboard') }}" class="hover:text-amber-300 transition-colors inline-flex items-center gap-1.5 text-amber-300 font-bold text-[11px]">
                    <i class="fa fa-graduation-cap"></i>
                    <span>ড্যাশবোর্ড</span>
                </a>
                <span class="text-white/30">|</span>
                <form action="{{ route('student.logout') }}" method="POST" class="inline m-0 p-0">
                    @csrf
                    <button type="submit" class="hover:text-rose-300 transition-colors inline-flex items-center gap-1 cursor-pointer bg-transparent border-0 text-white/90 hover:text-white p-0 text-[11px] font-semibold">
                        <i class="fa fa-sign-out"></i>
                        <span>লগআউট</span>
                    </button>
                </form>
            @else
                <!-- Guest Student: Login & Sign Up (Daraz Style) -->
                <a href="{{ route('student.login') }}" class="hover:text-amber-300 transition-colors inline-flex items-center gap-1 uppercase font-bold text-[11px]">
                    <i class="fa fa-user-circle text-amber-300"></i>
                    <span>LOGIN</span>
                </a>

                <span class="text-white/30">|</span>

                <a href="{{ route('student.register') }}" class="hover:text-amber-300 transition-colors inline-flex items-center gap-1 uppercase font-bold text-[11px]">
                    <i class="fa fa-user-plus text-amber-300"></i>
                    <span>SIGN UP</span>
                </a>
            @endif

            <span class="text-white/30">|</span>

            <!-- Language Switcher (Daraz Style: ভাষা / Language) -->
            <div class="inline-flex items-center gap-1 text-[11px] font-bold">
                <i class="fa fa-globe text-amber-300 text-xs"></i>
                <a href="{{ route('language.switch', 'en') }}" class="px-1.5 py-0.5 rounded text-[10px] uppercase transition-colors {{ App::getLocale() == 'en' ? 'bg-amber-300 text-slate-950 font-black shadow-xs' : 'text-white/80 hover:text-white' }}">EN</a>
                <span class="text-white/30 text-[10px]">|</span>
                <a href="{{ route('language.switch', 'bn') }}" class="px-1.5 py-0.5 rounded text-[10px] transition-colors {{ App::getLocale() == 'bn' ? 'bg-amber-300 text-slate-950 font-black shadow-xs' : 'text-white/80 hover:text-white' }}">বাং</a>
            </div>

        </div>

    </div>
</div>

<!-- Sticky Floating Navigation Header with Dynamic Theme Colors, Global Theme Switcher & Multi-Language Switcher -->
<header id="main-header" class="fixed top-8 left-0 right-0 z-40 transition-all duration-300 py-2.5 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="relative flex items-center justify-between px-4 py-2 sm:px-6 rounded-2xl bg-slate-950/90 backdrop-blur-2xl border border-slate-800/80 shadow-2xl transition-all duration-300">
            
            <!-- Brand Logo -->
            <a href="{{ route('home-page') }}" class="flex items-center gap-3 group focus:outline-none shrink-0">
                <img src="{{ safe_asset('frontend/image/wict-logo.png') }}" alt="{{ app_setting('site_title', 'Wake Up ICT') }}" class="h-9 sm:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Course Search Bar with Real-time Auto-Suggestion (Desktop & Tablet) -->
            @php
                $activeCoursesList = \Illuminate\Support\Facades\Cache::remember('active_courses_for_search_bar', 3600, function() {
                    return \App\model\Course::where('status', 1)
                        ->select('id', 'course_title', 'course_slug', 'price', 'time_line', 'image')
                        ->orderBy('sort_order', 'ASC')
                        ->orderBy('id', 'ASC')
                        ->get();
                });
            @endphp
            <div class="hidden sm:flex items-center w-72 sm:w-80 md:w-[350px] lg:w-[360px] xl:w-[380px] shrink-0 mx-2 relative" id="header-search-wrapper">
                <form id="header-course-search-form" action="{{ route('academic-training') }}" method="GET" class="w-full relative" autocomplete="off">
                    <input type="text" 
                           id="header-course-search-input"
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="কোর্স খুঁজুন (যেমন: গ্রাফিক্স, ওয়েব, AI)..." 
                           class="w-full pl-9 pr-8 py-2 rounded-xl bg-slate-900 border border-slate-700/80 text-xs sm:text-[13px] text-slate-200 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all font-medium"
                           autocomplete="off">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-emerald-500 text-xs border-0 bg-transparent p-0 cursor-pointer" title="খুঁজুন">
                        <i class="fa fa-search"></i>
                    </button>
                    <!-- Clear query icon -->
                    <button type="button" id="header-search-clear-btn" class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-rose-400 text-xs border-0 bg-transparent p-0 cursor-pointer" title="মুছুন">
                        <i class="fa fa-times-circle"></i>
                    </button>
                </form>

                <!-- Course Auto-Suggestion Dropdown Panel (Identical Width & Alignment as Search Box) -->
                <div id="course-suggestion-dropdown" 
                     class="hidden absolute left-0 right-0 top-full mt-2 w-full rounded-2xl bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-800 shadow-2xl p-2.5 z-50 transition-all duration-200 max-h-[390px] overflow-y-auto">
                    
                    <!-- Panel Header -->
                    <div class="flex items-center justify-between px-2 py-1.5 border-b border-slate-100 dark:border-slate-800/80 mb-1.5">
                        <span class="text-[11px] font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5 uppercase tracking-wide">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>উপলব্ধ কোর্সসমূহ</span>
                        </span>
                        <span id="suggestion-count-badge" class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                            {{ $activeCoursesList->count() }}টি কোর্স
                        </span>
                    </div>

                    <!-- Suggestions List Container -->
                    <div id="suggestion-items-container" class="space-y-1">
                        @foreach($activeCoursesList as $course)
                            <div class="suggestion-item group flex items-center justify-between p-2 rounded-xl transition-all duration-150 cursor-pointer hover:bg-emerald-50 dark:hover:bg-slate-900 border border-transparent hover:border-emerald-200 dark:hover:border-slate-800"
                                 data-course-title="{{ $course->course_title }}"
                                 onclick="selectCourseSuggestion('{{ addslashes($course->course_title) }}')">
                                <div class="flex items-center gap-2.5 min-w-0 pr-2">
                                    <div class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 text-xs font-bold shadow-xs group-hover:scale-105 transition-transform">
                                        <i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="course-item-title text-xs font-bold text-slate-900 dark:text-slate-100 truncate group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                            {{ $course->course_title }}
                                        </div>
                                        <div class="flex items-center gap-2 text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">
                                            @if($course->time_line)
                                                <span class="inline-flex items-center gap-1"><i class="fa fa-clock-o text-amber-500"></i> {{ $course->time_line }}</span>
                                            @endif
                                            <span>•</span>
                                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold">১০ জন ব্যাচ</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <span class="px-2 py-1 rounded-lg text-[10px] font-bold text-slate-600 dark:text-slate-400 group-hover:bg-emerald-600 group-hover:text-white transition-all flex items-center gap-1 shadow-2xs">
                                        <span>সার্চ</span>
                                        <i class="fa fa-search text-[9px]"></i>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- No Match Message -->
                    <div id="suggestion-no-match" class="hidden py-6 px-3 text-center">
                        <div class="w-9 h-9 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400 flex items-center justify-center mb-2">
                            <i class="fa fa-search"></i>
                        </div>
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">সরাসরি কোনো কোর্স মেলেনি</p>
                        <p class="text-[11px] text-slate-500 mb-3">সব কোর্সসমূহের বর্ণনায় খুঁজতে নিচের বাটনে চাপুন</p>
                        <button type="button" onclick="submitHeaderSearch()" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs inline-flex items-center gap-1.5 transition-colors shadow-sm">
                            <i class="fa fa-search text-[10px]"></i>
                            <span>এই নামে খুঁজুন</span>
                        </button>
                    </div>

                    <!-- Panel Footer Tip -->
                    <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-800/80 px-2 flex items-center justify-between text-[10px] text-slate-400">
                        <span class="flex items-center gap-1">
                            <i class="fa fa-info-circle text-amber-500"></i>
                            <span>ক্লিক করলে কোর্সের নামে সার্চ হবে</span>
                        </span>
                        <span class="font-mono text-slate-400 dark:text-slate-500">ESC দিয়ে বন্ধ</span>
                    </div>

                </div>
            </div>

            <!-- Desktop Navigation Links (Dynamically Managed from Backend) -->
            @php
                $headerMenus = \App\Services\FrontendMenuService::getTree('header');
            @endphp
            <nav class="hidden lg:flex items-center gap-0.5 xl:gap-1 2xl:gap-1.5 font-medium text-[13px] 2xl:text-sm text-slate-300 shrink-0">
                @foreach($headerMenus as $menu)
                    @php
                        $hasChildren = $menu->activeChildren->count() > 0;
                        $isActive = $menu->isCurrent() || $menu->isChildCurrent();
                    @endphp

                    @if($hasChildren)
                        <!-- Dropdown Menu Item -->
                        <div class="relative group shrink-0">
                            <a href="{{ $menu->resolveUrl() }}" 
                               target="{{ $menu->target }}"
                               class="whitespace-nowrap shrink-0 px-2 xl:px-2.5 2xl:px-3 py-1.5 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 inline-flex items-center gap-1 {{ $isActive ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                                @if($menu->icon)
                                    <i class="{{ $menu->icon }} mr-1"></i>
                                @endif
                                <span class="whitespace-nowrap">{{ $menu->getTitle() }}</span>
                                <i class="fa fa-angle-down text-xs text-slate-500 transition-transform group-hover:rotate-180"></i>
                                @if($menu->badge_text)
                                    <span class="px-1.5 py-0.5 rounded bg-brand-primary/20 text-brand-primary text-[10px] font-bold">{{ $menu->badge_text }}</span>
                                @endif
                            </a>
                            <!-- Dropdown Box -->
                            <div class="hidden group-hover:block absolute left-0 mt-1 w-52 rounded-xl bg-slate-950/95 border border-slate-800 shadow-2xl p-1.5 z-50 text-xs backdrop-blur-xl">
                                @foreach($menu->activeChildren as $child)
                                    <a href="{{ $child->resolveUrl() }}" 
                                       target="{{ $child->target }}"
                                       class="flex items-center justify-between px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800/80 hover:text-brand-primary transition-colors whitespace-nowrap {{ $child->isCurrent() ? 'text-brand-primary font-bold bg-slate-800/50' : '' }}">
                                        <div class="flex items-center gap-2">
                                            @if($child->icon)
                                                <i class="{{ $child->icon }}"></i>
                                            @endif
                                            <span class="whitespace-nowrap">{{ $child->getTitle() }}</span>
                                        </div>
                                        @if($child->badge_text)
                                            <span class="px-1.5 py-0.5 rounded bg-brand-primary/20 text-brand-primary text-[10px]">{{ $child->badge_text }}</span>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Direct Link -->
                        <a href="{{ $menu->resolveUrl() }}" 
                           target="{{ $menu->target }}"
                           class="whitespace-nowrap shrink-0 px-2 xl:px-2.5 2xl:px-3 py-1.5 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 inline-flex items-center gap-1 {{ $isActive ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                            @if($menu->icon)
                                <i class="{{ $menu->icon }} mr-1"></i>
                            @endif
                            <span class="whitespace-nowrap">{{ $menu->getTitle() }}</span>
                            @if($menu->badge_text)
                                <span class="px-1.5 py-0.5 rounded bg-brand-primary/20 text-brand-primary text-[10px] font-bold">{{ $menu->badge_text }}</span>
                            @endif
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Right CTA (Desktop Hotline) - Student Login, Sign Up & Language are in the Top Utility Strip -->
            <div class="hidden lg:flex items-center shrink-0">
                <a href="tel:01791612121" class="header-hotline-btn inline-flex items-center gap-1.5 px-3.5 py-1.5 2xl:px-4 2xl:py-2 rounded-xl font-bold text-xs tracking-wider uppercase bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition-all duration-300 shrink-0 whitespace-nowrap">
                    <i class="fa fa-phone text-amber-300"></i>
                    <span>01791-612121</span>
                </a>
            </div>

                        <!-- Mobile Controls -->
            <div class="flex lg:hidden items-center gap-1.5 sm:gap-2">
                <!-- Mobile Search Button -->
                <button id="mobile-search-toggle-btn" type="button" class="sm:hidden inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 focus:outline-none transition-colors border border-slate-700/60 bg-slate-900/60" aria-label="Search courses" title="কোর্স খুঁজুন">
                    <i id="mobile-search-icon" class="fa fa-search text-sm text-emerald-400"></i>
                    <i id="mobile-search-close-icon" class="fa fa-times text-sm hidden text-rose-400"></i>
                </button>

                <!-- Hamburger Button -->
                <button id="mobile-menu-btn" type="button" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 focus:outline-none transition-colors border border-slate-700/60 bg-slate-900/60" aria-label="Toggle navigation">
                    <i id="hamburger-icon" class="fa fa-bars text-sm"></i>
                    <i id="close-icon" class="fa fa-times text-sm hidden"></i>
                </button>
            </div>

        </div>
    </div>

    
    <!-- Mobile Floating Search Bar Drawer -->
    <div id="mobile-search-drawer" class="hidden sm:hidden fixed inset-x-3 top-20 rounded-2xl bg-slate-950/95 dark:bg-slate-950/95 backdrop-blur-2xl border border-slate-800 dark:border-slate-800 shadow-2xl p-3 z-50 transition-all duration-300 max-h-[85vh] flex flex-col">
        <!-- Search Input Form -->
        <form id="mobile-course-search-form" action="{{ route('academic-training') }}" method="GET" class="relative w-full shrink-0" autocomplete="off">
            <div class="relative flex items-center">
                <i class="fa fa-search absolute left-3.5 text-slate-400 text-sm pointer-events-none"></i>
                <input type="text" 
                       id="mobile-course-search-input"
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="কোর্স খুঁজুন (যেমন: গ্রাফিক্স, ওয়েব, AI)..." 
                       class="w-full pl-10 pr-20 py-2.5 rounded-xl bg-slate-900 dark:bg-slate-900 border border-slate-700 dark:border-slate-700 text-xs sm:text-sm text-slate-100 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 font-medium"
                       autocomplete="off">
                <!-- Clear Button -->
                <button type="button" id="mobile-search-clear-btn" class="hidden absolute right-11 text-slate-400 hover:text-rose-400 text-sm border-0 bg-transparent p-1 cursor-pointer" title="মুছুন">
                    <i class="fa fa-times-circle"></i>
                </button>
                <!-- Search Button -->
                <button type="submit" class="absolute right-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition-colors flex items-center gap-1 cursor-pointer">
                    <span>সার্চ</span>
                </button>
            </div>
        </form>

        <!-- Course Suggestions Panel in Mobile Drawer -->
        <div class="mt-2.5 pt-2 border-t border-slate-800/80 flex-1 overflow-y-auto max-h-[340px] pr-1">
            <div class="flex items-center justify-between px-1.5 py-1 mb-1">
                <span class="text-[11px] font-bold text-slate-400 flex items-center gap-1.5 uppercase tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>উপলব্ধ কোর্সসমূহ</span>
                </span>
                <span id="mobile-suggestion-count-badge" class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                    {{ $activeCoursesList->count() }}টি কোর্স
                </span>
            </div>

            <div id="mobile-suggestion-items-container" class="space-y-1">
                @foreach($activeCoursesList as $course)
                    <div class="mobile-suggestion-item group flex items-center justify-between p-2 rounded-xl transition-all duration-150 cursor-pointer hover:bg-emerald-50 dark:hover:bg-slate-900 border border-transparent hover:border-emerald-200 dark:hover:border-slate-800"
                         data-course-title="{{ $course->course_title }}"
                         onclick="selectMobileCourseSuggestion('{{ addslashes($course->course_title) }}')">
                        <div class="flex items-center gap-2.5 min-w-0 pr-2">
                            <div class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-slate-800 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 text-xs font-bold shadow-xs">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="course-item-title text-xs font-bold text-slate-100 truncate group-hover:text-emerald-500 transition-colors">
                                    {{ $course->course_title }}
                                </div>
                                <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-0.5">
                                    @if($course->time_line)
                                        <span class="inline-flex items-center gap-1"><i class="fa fa-clock-o text-amber-500"></i> {{ $course->time_line }}</span>
                                    @endif
                                    <span>•</span>
                                    <span class="text-emerald-500 font-semibold">১০ জন ব্যাচ</span>
                                </div>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <span class="px-2 py-1 rounded-lg text-[10px] font-bold text-slate-400 group-hover:bg-emerald-600 group-hover:text-white transition-all flex items-center gap-1 shadow-2xs">
                                <i class="fa fa-search text-[9px]"></i>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No Match in Mobile Drawer -->
            <div id="mobile-suggestion-no-match" class="hidden py-5 px-3 text-center">
                <div class="w-8 h-8 mx-auto rounded-full bg-slate-900 text-slate-400 flex items-center justify-center mb-1.5">
                    <i class="fa fa-search text-xs"></i>
                </div>
                <p class="text-xs font-semibold text-slate-300 mb-0.5">কোনো সরাসরি কোর্স মেলেনি</p>
                <p class="text-[11px] text-slate-400 mb-2.5">সকল কোর্সের ভেতরে খুঁজতে নিচের বাটনে চাপুন</p>
                <button type="button" onclick="submitMobileSearch()" class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs inline-flex items-center gap-1.5 transition-colors shadow-sm">
                    <i class="fa fa-search text-[10px]"></i>
                    <span>এই নামে খুঁজুন</span>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Close Footer -->
        <div class="mt-2 pt-2 border-t border-slate-800/80 flex items-center justify-between text-[11px] text-slate-400">
            <span class="flex items-center gap-1 text-[10px]">
                <i class="fa fa-info-circle text-amber-500"></i>
                <span>ক্লিক করলে কোর্সের নামে সার্চ হবে</span>
            </span>
            <button type="button" onclick="closeMobileSearchDrawer()" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white text-[11px] font-semibold transition-colors flex items-center gap-1">
                <i class="fa fa-times text-[10px]"></i>
                <span>বন্ধ করুন</span>
            </button>
        </div>
    </div>

<!-- Mobile Navigation Overlay -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-x-4 top-20 rounded-2xl bg-slate-950/95 backdrop-blur-2xl border border-slate-800 shadow-2xl p-6 transition-all duration-300 z-50">
        <nav class="flex flex-col space-y-2">
            @foreach($headerMenus as $menu)
                @php
                    $hasChildren = $menu->activeChildren->count() > 0;
                    $isActive = $menu->isCurrent() || $menu->isChildCurrent();
                @endphp
                @if($hasChildren)
                    <div class="space-y-1">
                        <div class="px-4 py-1.5 text-xs font-mono uppercase text-slate-500 font-bold">
                            {{ $menu->getTitle() }}
                        </div>
                        @foreach($menu->activeChildren as $child)
                            <a href="{{ $child->resolveUrl() }}" 
                               target="{{ $child->target }}"
                               class="mobile-nav-link flex items-center justify-between px-4 py-2.5 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors pl-6 {{ $child->isCurrent() ? 'text-brand-primary font-bold bg-slate-800/50' : '' }}">
                                <span class="flex items-center gap-2">
                                    @if($child->icon)
                                        <i class="{{ $child->icon }}"></i>
                                    @endif
                                    <span>{{ $child->getTitle() }}</span>
                                </span>
                                <i class="fa fa-angle-right text-slate-500"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <a href="{{ $menu->resolveUrl() }}" 
                       target="{{ $menu->target }}"
                       class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors {{ $isActive ? 'text-brand-primary font-bold bg-slate-800/50' : '' }}">
                        <span class="flex items-center gap-2">
                            @if($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endif
                            <span>{{ $menu->getTitle() }}</span>
                            @if($menu->badge_text)
                                <span class="px-1.5 py-0.5 rounded bg-brand-primary/20 text-brand-primary text-[10px] font-bold">{{ $menu->badge_text }}</span>
                            @endif
                        </span>
                        <i class="fa fa-angle-right text-slate-500"></i>
                    </a>
                @endif
            @endforeach

            <div class="pt-4 mt-2 border-t border-slate-800 space-y-2.5">
                @if(function_exists('is_student_logged_in') && is_student_logged_in())
                    <a href="{{ route('student.dashboard') }}" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl font-bold text-xs tracking-wider uppercase bg-brand-primary text-slate-950">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Student Dashboard</span>
                    </a>
                @else
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('student.login') }}" class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl font-bold text-xs tracking-wider uppercase bg-slate-900 border border-slate-700 text-white hover:border-brand-primary">
                            <i class="fa fa-user-circle text-brand-primary"></i>
                            <span>LOGIN</span>
                        </a>
                        <a href="{{ route('student.register') }}" class="flex items-center justify-center gap-1.5 py-2.5 px-3 rounded-xl font-bold text-xs tracking-wider uppercase bg-emerald-600 hover:bg-emerald-700 text-white">
                            <i class="fa fa-user-plus"></i>
                            <span>SIGN UP</span>
                        </a>
                    </div>
                @endif
                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-900 border border-slate-800 text-xs">
                    <span class="text-slate-400 font-medium">ভাষা / Language:</span>
                    <div class="flex items-center gap-1 font-mono font-bold">
                        <a href="{{ route('language.switch', 'en') }}" class="px-2 py-0.5 rounded {{ App::getLocale() == 'en' ? 'bg-brand-primary text-slate-950' : 'text-slate-400 hover:text-white' }}">EN</a>
                        <span class="text-slate-600">|</span>
                        <a href="{{ route('language.switch', 'bn') }}" class="px-2 py-0.5 rounded {{ App::getLocale() == 'bn' ? 'bg-brand-primary text-slate-950' : 'text-slate-400 hover:text-white' }}">বাং</a>
                    </div>
                </div>
                <a href="tel:01791612121" class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl font-bold text-xs tracking-wider uppercase bg-emerald-600/20 border border-emerald-500/30 text-emerald-400">
                    <i class="fa fa-phone"></i>
                    <span>হটলাইন: 01791-612121</span>
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile Menu Toggle
        var btn = document.getElementById('mobile-menu-btn');
        var menu = document.getElementById('mobile-menu');
        var hamburger = document.getElementById('hamburger-icon');
        var close = document.getElementById('close-icon');

        // Course Search Auto-Suggestion Logic
        var searchInput = document.getElementById('header-course-search-input');
        var searchDropdown = document.getElementById('course-suggestion-dropdown');
        var searchForm = document.getElementById('header-course-search-form');
        var clearBtn = document.getElementById('header-search-clear-btn');
        var suggestionContainer = document.getElementById('suggestion-items-container');
        var noMatchBox = document.getElementById('suggestion-no-match');
        var countBadge = document.getElementById('suggestion-count-badge');
        var searchWrapper = document.getElementById('header-search-wrapper');

        function openSearchDropdown() {
            if (searchDropdown) {
                searchDropdown.classList.remove('hidden');
            }
        }

        function closeSearchDropdown() {
            if (searchDropdown) {
                searchDropdown.classList.add('hidden');
            }
        }

        window.submitHeaderSearch = function() {
            if (searchForm) {
                searchForm.submit();
            }
        };

        window.selectCourseSuggestion = function(title) {
            if (searchInput) {
                searchInput.value = title;
            }
            closeSearchDropdown();
            if (searchForm) {
                searchForm.submit();
            }
        };

        if (searchInput && searchDropdown) {
            // Show suggestions on click or focus
            searchInput.addEventListener('focus', function() {
                openSearchDropdown();
                filterSuggestions();
            });

            searchInput.addEventListener('click', function() {
                openSearchDropdown();
            });

            // Filter suggestions as user types
            searchInput.addEventListener('input', function() {
                filterSuggestions();
            });

            function filterSuggestions() {
                var query = searchInput.value.trim().toLowerCase();
                var items = suggestionContainer ? suggestionContainer.querySelectorAll('.suggestion-item') : [];
                var matchedCount = 0;

                if (clearBtn) {
                    if (query.length > 0) {
                        clearBtn.classList.remove('hidden');
                    } else {
                        clearBtn.classList.add('hidden');
                    }
                }

                items.forEach(function(item) {
                    var title = (item.getAttribute('data-course-title') || '').toLowerCase();
                    if (!query || title.indexOf(query) !== -1) {
                        item.style.display = 'flex';
                        matchedCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (countBadge) {
                    countBadge.textContent = matchedCount + 'টি কোর্স';
                }

                if (matchedCount === 0 && query.length > 0) {
                    if (noMatchBox) noMatchBox.classList.remove('hidden');
                } else {
                    if (noMatchBox) noMatchBox.classList.add('hidden');
                }
            }

            // Clear button click
            if (clearBtn) {
                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchInput.value = '';
                    clearBtn.classList.add('hidden');
                    filterSuggestions();
                    searchInput.focus();
                });
            }

            // Keyboard navigation (Arrow keys, Escape, Enter)
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSearchDropdown();
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (searchWrapper && !searchWrapper.contains(e.target)) {
                    closeSearchDropdown();
                }
            });
        }

        
        // ============================================
        // Mobile Search Toggle & Auto-Suggestion Logic
        // ============================================
        var mobileSearchBtn = document.getElementById('mobile-search-toggle-btn');
        var mobileSearchDrawer = document.getElementById('mobile-search-drawer');
        var mobileSearchIcon = document.getElementById('mobile-search-icon');
        var mobileSearchCloseIcon = document.getElementById('mobile-search-close-icon');
        var mobileSearchInput = document.getElementById('mobile-course-search-input');
        var mobileSearchForm = document.getElementById('mobile-course-search-form');
        var mobileClearBtn = document.getElementById('mobile-search-clear-btn');
        var mobileSuggestionContainer = document.getElementById('mobile-suggestion-items-container');
        var mobileNoMatchBox = document.getElementById('mobile-suggestion-no-match');
        var mobileCountBadge = document.getElementById('mobile-suggestion-count-badge');

        function openMobileSearchDrawer() {
            if (mobileSearchDrawer) {
                mobileSearchDrawer.classList.remove('hidden');
                if (mobileSearchIcon) mobileSearchIcon.classList.add('hidden');
                if (mobileSearchCloseIcon) mobileSearchCloseIcon.classList.remove('hidden');
                // Auto close mobile navigation menu if open
                if (menu && !menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    if (hamburger) hamburger.classList.remove('hidden');
                    if (close) close.classList.add('hidden');
                }
                setTimeout(function() {
                    if (mobileSearchInput) {
                        mobileSearchInput.focus();
                        filterMobileSuggestions();
                    }
                }, 60);
            }
        }

        function closeMobileSearchDrawer() {
            if (mobileSearchDrawer) {
                mobileSearchDrawer.classList.add('hidden');
                if (mobileSearchIcon) mobileSearchIcon.classList.remove('hidden');
                if (mobileSearchCloseIcon) mobileSearchCloseIcon.classList.add('hidden');
            }
        }

        window.closeMobileSearchDrawer = closeMobileSearchDrawer;

        window.submitMobileSearch = function() {
            if (mobileSearchForm) {
                mobileSearchForm.submit();
            }
        };

        window.selectMobileCourseSuggestion = function(title) {
            if (mobileSearchInput) {
                mobileSearchInput.value = title;
            }
            closeMobileSearchDrawer();
            if (mobileSearchForm) {
                mobileSearchForm.submit();
            }
        };

        function filterMobileSuggestions() {
            if (!mobileSearchInput) return;
            var query = mobileSearchInput.value.trim().toLowerCase();
            var items = mobileSuggestionContainer ? mobileSuggestionContainer.querySelectorAll('.mobile-suggestion-item') : [];
            var matchedCount = 0;

            if (mobileClearBtn) {
                if (query.length > 0) {
                    mobileClearBtn.classList.remove('hidden');
                } else {
                    mobileClearBtn.classList.add('hidden');
                }
            }

            items.forEach(function(item) {
                var title = (item.getAttribute('data-course-title') || '').toLowerCase();
                if (!query || title.indexOf(query) !== -1) {
                    item.style.display = 'flex';
                    matchedCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (mobileCountBadge) {
                mobileCountBadge.textContent = matchedCount + 'টি কোর্স';
            }

            if (matchedCount === 0 && query.length > 0) {
                if (mobileNoMatchBox) mobileNoMatchBox.classList.remove('hidden');
            } else {
                if (mobileNoMatchBox) mobileNoMatchBox.classList.add('hidden');
            }
        }

        if (mobileSearchBtn && mobileSearchDrawer) {
            mobileSearchBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                var isHidden = mobileSearchDrawer.classList.contains('hidden');
                if (isHidden) {
                    openMobileSearchDrawer();
                } else {
                    closeMobileSearchDrawer();
                }
            });

            if (mobileSearchInput) {
                mobileSearchInput.addEventListener('input', filterMobileSuggestions);
            }

            if (mobileClearBtn) {
                mobileClearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (mobileSearchInput) {
                        mobileSearchInput.value = '';
                        filterMobileSuggestions();
                        mobileSearchInput.focus();
                    }
                });
            }

            // Close mobile search on outside click
            document.addEventListener('click', function(e) {
                if (mobileSearchDrawer && !mobileSearchDrawer.contains(e.target) && !mobileSearchBtn.contains(e.target)) {
                    closeMobileSearchDrawer();
                }
            });
        }

        if (btn && menu) {
            btn.addEventListener('click', function () {
                var isHidden = menu.classList.contains('hidden');
                if (isHidden) {
                    closeMobileSearchDrawer();
                    menu.classList.remove('hidden');
                    if (hamburger) hamburger.classList.add('hidden');
                    if (close) close.classList.remove('hidden');
                } else {
                    menu.classList.add('hidden');
                    if (hamburger) hamburger.classList.remove('hidden');
                    if (close) close.classList.add('hidden');
                }
            });
        }
    });
</script>
