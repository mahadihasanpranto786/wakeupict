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

            <!-- Course Search Bar (Desktop) -->
            <div class="hidden 2xl:flex items-center w-44 shrink-0 mx-2">
                <form action="{{ route('academic-training') }}" method="GET" class="w-full relative">
                    <input type="text" name="search" placeholder="কোর্স খুঁজুন..." class="w-full pl-8 pr-3 py-1.5 rounded-xl bg-slate-900 border border-slate-700/80 text-xs text-slate-200 placeholder-slate-400 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    <i class="fa fa-search absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </form>
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
            <div class="flex lg:hidden items-center gap-2">
                <!-- Hamburger Button -->
                <button id="mobile-menu-btn" type="button" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 focus:outline-none" aria-label="Toggle navigation">
                    <i id="hamburger-icon" class="fa fa-bars text-lg"></i>
                    <i id="close-icon" class="fa fa-times text-lg hidden"></i>
                </button>
            </div>

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

        if (btn && menu) {
            btn.addEventListener('click', function () {
                var isHidden = menu.classList.contains('hidden');
                if (isHidden) {
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
