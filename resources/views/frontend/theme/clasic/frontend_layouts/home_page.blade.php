@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950">

    <!--========================== Globant-Inspired Auto-Sliding Hero ============================-->
    <section class="relative min-h-[92vh] flex items-center justify-center pt-28 pb-16 lg:py-0 overflow-hidden bg-grid-mesh">
        
        <!-- Ambient Glowing Core with Slow Floating Movement -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] sm:w-[900px] h-[500px] bg-gradient-to-tr from-brand-primary/15 via-brand-cyan/10 to-brand-indigo/10 blur-[140px] pointer-events-none rounded-full animate-ambient-float"></div>
        <div class="absolute bottom-10 right-10 w-[350px] h-[350px] bg-brand-cyan/10 blur-[120px] pointer-events-none rounded-full animate-ambient-float-reverse"></div>
        
        <!-- Ambient Background Texture from Active Slide -->
        <div class="absolute inset-0 z-0 opacity-10 mix-blend-luminosity overflow-hidden pointer-events-none">
            @if(isset($homeSliders) && count($homeSliders) > 0)
                <img id="hero-ambient-bg" src="{{ safe_asset($homeSliders[0]->slider_image) }}" alt="Ambient Background" class="w-full h-full object-cover filter grayscale contrast-125 transition-all duration-1000" onerror="this.onerror=null; this.src='{{ asset('public/uploads/slider_image/images/wakeupict-brought-ideas-to-life-with-text.png') }}';">
            @elseif(!empty($homeSlider->slider_image))
                <img id="hero-ambient-bg" src="{{ safe_asset($homeSlider->slider_image) }}" alt="Ambient Background" class="w-full h-full object-cover filter grayscale contrast-125" onerror="this.onerror=null; this.src='{{ asset('public/uploads/slider_image/images/wakeupict-brought-ideas-to-life-with-text.png') }}';">
            @endif
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center min-h-[80vh]">
                
                <!-- Left: Headline & Editorial Value Proposition (Cols 7) -->
                <div class="lg:col-span-7 flex flex-col justify-center text-left reveal-on-scroll">
                    
                    <!-- Live Status Badge with Floating Wave -->
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-brand-primary/30 text-brand-primary text-xs font-mono tracking-wider uppercase mb-6 w-fit backdrop-blur-md shadow-sm animate-badge-float">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-primary"></span>
                        </span>
                        <span>{{ app_setting('hero_badge', __('frontend.hero.badge')) }}</span>
                    </div>

                    <!-- Kinetic Display Headline with Animated Gradient Shimmer -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.14] mb-6">
                        <span class="text-gradient-animated">{{ app_setting('hero_title', __('frontend.hero.title')) }}</span>
                    </h1>

                    <!-- Editorial Manifesto / Subtitle -->
                    <p class="text-base sm:text-lg text-slate-300 font-normal leading-relaxed max-w-2xl mb-10">
                        {{ app_setting('hero_subtitle', __('frontend.hero.subtitle')) }}
                    </p>

                    <!-- High-Impact Dual CTAs with Shimmer Effect -->
                    <div class="flex flex-wrap items-center gap-4 mb-12">
                        <a href="{{ route('academic-training') }}" class="btn-shimmer inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                            <span>{{ app_setting('hero_btn1_text', __('frontend.hero.explore_courses')) }}</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('services-page') }}" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-200 border border-slate-700/80 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1">
                            <span>{{ app_setting('hero_btn2_text', __('frontend.hero.our_services')) }}</span>
                            <i class="fa fa-angle-right text-xs text-brand-primary"></i>
                        </a>
                    </div>

                    <!-- Micro-Stats Ticker with Kinetic Number Animation -->
                    @php
                        $bnToEnMap = ['০'=>'0','১'=>'1','২'=>'2','৩'=>'3','৪'=>'4','৫'=>'5','৬'=>'6','৭'=>'7','৮'=>'8','৯'=>'9'];

                        $stat1Raw = app_setting('stat1_value', (App::getLocale() == 'bn' ? '১৫,০০০+' : '15,000+'));
                        $stat1Norm = strtr($stat1Raw, $bnToEnMap);
                        preg_match('/([\d,.]+)/', $stat1Norm, $m1);
                        $stat1Num = isset($m1[1]) ? str_replace(',', '', $m1[1]) : '15000';
                        $stat1Suf = (strpos($stat1Raw, '+') !== false ? '+' : (strpos($stat1Raw, '%') !== false ? '%' : ''));

                        $stat2Raw = app_setting('stat2_value', (App::getLocale() == 'bn' ? '২৫০+' : '250+'));
                        $stat2Norm = strtr($stat2Raw, $bnToEnMap);
                        preg_match('/([\d,.]+)/', $stat2Norm, $m2);
                        $stat2Num = isset($m2[1]) ? str_replace(',', '', $m2[1]) : '250';
                        $stat2Suf = (strpos($stat2Raw, '+') !== false ? '+' : (strpos($stat2Raw, '%') !== false ? '%' : ''));

                        $stat3Raw = app_setting('stat3_value', (App::getLocale() == 'bn' ? '৯৮.৫%' : '98.5%'));
                        $stat3Norm = strtr($stat3Raw, $bnToEnMap);
                        preg_match('/([\d,.]+)/', $stat3Norm, $m3);
                        $stat3Num = isset($m3[1]) ? str_replace(',', '', $m3[1]) : '98.5';
                        $stat3Suf = (strpos($stat3Raw, '%') !== false ? '%' : (strpos($stat3Raw, '+') !== false ? '+' : ''));
                    @endphp
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-800/80 max-w-lg">
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">
                                <span data-counter-target="{{ $stat1Num }}" data-counter-suffix="{{ $stat1Suf }}">{{ $stat1Raw }}</span>
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat1_label', __('frontend.hero.stats_students')) }}
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">
                                <span data-counter-target="{{ $stat2Num }}" data-counter-suffix="{{ $stat2Suf }}">{{ $stat2Raw }}</span>
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat2_label', __('frontend.hero.stats_projects')) }}
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-brand-primary tracking-tight">
                                <span data-counter-target="{{ $stat3Num }}" data-counter-suffix="{{ $stat3Suf }}">{{ $stat3Raw }}</span>
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat3_label', __('frontend.hero.stats_satisfaction')) }}
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Auto-Sliding Hero Showcase (Cols 5) with 3D Tilt Interaction -->
                <div class="lg:col-span-5 flex flex-col items-center justify-center">
                    
                    @if(isset($homeSliders) && count($homeSliders) > 0)
                        <!-- Multi-Image Carousel Container with Tilt Effect -->
                        <div id="hero-slider-carousel" class="tilt-on-hover relative w-full aspect-[16/10] sm:aspect-[4/3] rounded-2xl overflow-hidden border border-slate-800/90 shadow-2xl bg-slate-900 group">
                            
                            <!-- Slides -->
                            @foreach($homeSliders as $idx => $slide)
                                <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $idx === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}" data-index="{{ $idx }}" data-bg="{{ safe_asset($slide->slider_image) }}">
                                    <img src="{{ safe_asset($slide->slider_image) }}" alt="{{ $slide->slider_alt }}" class="w-full h-full object-cover filter brightness-95 contrast-105" onerror="this.onerror=null; this.src='{{ asset('public/uploads/slider_image/images/wakeupict-brought-ideas-to-life-with-text.png') }}';">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                                    
                                    <!-- Slide Caption Overlay -->
                                    <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900/80 border border-slate-700/80 backdrop-blur-md text-xs font-mono text-brand-primary mb-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-pulse"></span>
                                            <span>Slide {{ $idx + 1 }} of {{ count($homeSliders) }}</span>
                                        </div>
                                        <h3 class="text-base sm:text-lg font-bold text-white leading-snug drop-shadow-md">
                                            {{ $slide->slider_alt }}
                                        </h3>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Carousel Controls (Show if more than 1) -->
                            @if(count($homeSliders) > 1)
                                <button type="button" id="slider-prev-btn" class="absolute left-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-xl bg-slate-900/80 hover:bg-brand-primary hover:text-slate-950 text-white border border-slate-700/80 flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 focus:opacity-100" aria-label="Previous Slide">
                                    <i class="fa fa-chevron-left text-xs"></i>
                                </button>
                                <button type="button" id="slider-next-btn" class="absolute right-3 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-xl bg-slate-900/80 hover:bg-brand-primary hover:text-slate-950 text-white border border-slate-700/80 flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 focus:opacity-100" aria-label="Next Slide">
                                    <i class="fa fa-chevron-right text-xs"></i>
                                </button>

                                <!-- Indicator Dots -->
                                <div class="absolute bottom-3 right-4 sm:bottom-4 sm:right-6 z-20 flex items-center gap-1.5">
                                    @foreach($homeSliders as $idx => $slide)
                                        <button type="button" class="slider-dot w-2.5 h-2.5 rounded-full transition-all duration-300 {{ $idx === 0 ? 'bg-brand-primary w-6' : 'bg-slate-600 hover:bg-slate-400' }}" data-target="{{ $idx }}" aria-label="Go to slide {{ $idx + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    @elseif(!empty($homeSlider->slider_image))
                        <!-- Single Slider Fallback -->
                        <div class="relative w-full aspect-[16/10] sm:aspect-[4/3] rounded-2xl overflow-hidden border border-slate-800/90 shadow-2xl bg-slate-900">
                            <img src="{{ safe_asset($homeSlider->slider_image) }}" alt="{{ $homeSlider->slider_alt }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='{{ asset('public/uploads/slider_image/images/wakeupict-brought-ideas-to-life-with-text.png') }}';">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6">
                                <h3 class="text-base sm:text-lg font-bold text-white drop-shadow-md">
                                    {{ $homeSlider->slider_alt }}
                                </h3>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>

    <!--========================== Metrics Bar / Manifesto Strip ============================-->
    <section class="border-y border-slate-800/80 bg-slate-900/40 backdrop-blur-md py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary">
                        <i class="fa fa-rocket text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">{{ __('frontend.home.core_0_title') }}</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ __('frontend.home.core_0_sub') }}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center text-brand-cyan">
                        <i class="fa fa-users text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">{{ __('frontend.home.core_1_title') }}</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ __('frontend.home.core_1_sub') }}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-indigo/10 border border-brand-indigo/20 flex items-center justify-center text-brand-indigo">
                        <i class="fa fa-shield text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">{{ __('frontend.home.core_2_title') }}</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ __('frontend.home.core_2_sub') }}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary">
                        <i class="fa fa-trophy text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">{{ __('frontend.home.core_3_title') }}</h4>
                        <p class="text-xs text-slate-400 mt-1">{{ __('frontend.home.core_3_sub') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== 10 Minute School Inspired: Offline Course Categories & Explorer ============================-->
    <section id="courses-explorer" class="py-20 sm:py-28 relative bg-slate-50 dark:bg-slate-950 transition-colors duration-200">
        <!-- Ambient Glow -->
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[600px] h-[350px] bg-emerald-500/10 blur-[130px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-400 font-mono text-xs font-bold uppercase tracking-wider mb-4">
                    <i class="fa fa-graduation-cap"></i>
                    <span>ক্যাম্পাস স্কিলস ও একাডেমিক ট্রেনিং</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    দেশসেরা <span class="text-emerald-600 dark:text-transparent dark:bg-clip-text dark:bg-gradient-to-r dark:from-emerald-400 dark:via-teal-300 dark:to-cyan-400">অফলাইন ল্যাব কোর্সসমূহ</span>
                </h2>
                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 mt-4 leading-relaxed">
                    সরাসরি ক্যাম্পাসে আধুনিক কম্পিউটার ল্যাব প্র্যাকটিস, অভিজ্ঞ মেন্টরদের নিবিড় গাইডেন্স এবং কোর্স শেষে সরকারি ও ইন্ডাস্ট্রি ভেরিফায়েড সার্টিফিকেট।
                </p>
            </div>

            <!-- 10 Minute School Style Category Filter Pills -->
            <div class="flex items-center justify-start sm:justify-center gap-2.5 overflow-x-auto pb-4 mb-10 no-scrollbar" id="course-category-tabs">
                <button type="button" onclick="filterCourses('all', this)" class="category-pill active px-4 py-2.5 rounded-xl text-xs font-bold transition-all shrink-0 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-slate-950 shadow-md">
                    <i class="fa fa-th-large mr-1.5"></i> সকল কোর্স (All)
                </button>
                <button type="button" onclick="filterCourses('graphic', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-paint-brush mr-1.5 text-pink-500 dark:text-pink-400"></i> গ্রাফিক্স ডিজাইন
                </button>
                <button type="button" onclick="filterCourses('web', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-code mr-1.5 text-blue-500 dark:text-blue-400"></i> ওয়েব ডেভেলপমেন্ট
                </button>
                <button type="button" onclick="filterCourses('ict', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-book mr-1.5 text-emerald-600 dark:text-emerald-400"></i> ক্লাস ৬-১০ ICT
                </button>
                <button type="button" onclick="filterCourses('marketing', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-bullhorn mr-1.5 text-amber-500 dark:text-amber-400"></i> ডিজিটাল মার্কেটিং
                </button>
                <button type="button" onclick="filterCourses('office', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-desktop mr-1.5 text-indigo-500 dark:text-indigo-400"></i> মাইক্রোসফট অফিস
                </button>
                <button type="button" onclick="filterCourses('ai', this)" class="category-pill px-4 py-2.5 rounded-xl text-xs font-semibold transition-all shrink-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700/80 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800 shadow-sm">
                    <i class="fa fa-magic mr-1.5 text-cyan-600 dark:text-cyan-400"></i> AI ও আধুনিক টেক
                </button>
            </div>

            <!-- Course Cards Grid (10MS Style) -->
            @if(isset($courses) && count($courses) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="courses-grid">
                    @foreach($courses as $course)
                        @php
                            $titleLower = strtolower($course->course_title);
                            $cat = 'other';
                            if (strpos($titleLower, 'গ্রাফিক') !== false || strpos($titleLower, 'graphic') !== false) {
                                $cat = 'graphic';
                            } elseif (strpos($titleLower, 'ওয়েব') !== false || strpos($titleLower, 'ওয়েব') !== false || strpos($titleLower, 'web') !== false) {
                                $cat = 'web';
                            } elseif (strpos($titleLower, 'ict') !== false || strpos($titleLower, 'আইসিটি') !== false || strpos($titleLower, 'academic') !== false) {
                                $cat = 'ict';
                            } elseif (strpos($titleLower, 'মার্কেটিং') !== false || strpos($titleLower, 'marketing') !== false) {
                                $cat = 'marketing';
                            } elseif (strpos($titleLower, 'office') !== false || strpos($titleLower, 'অফিস') !== false) {
                                $cat = 'office';
                            } elseif (strpos($titleLower, 'ai') !== false || strpos($titleLower, 'artificial') !== false) {
                                $cat = 'ai';
                            }

                            // Price calculation
                            $cleanPrice = (float)preg_replace('/[^\d.]/', '', $course->price);
                            $currentPrice = $cleanPrice > 0 ? $cleanPrice : 3500;
                            $originalPrice = round($currentPrice * 1.35);
                        @endphp
                        <div class="course-item rounded-3xl bg-white dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col justify-between hover:border-emerald-500/50 hover:shadow-xl transition-all duration-300 group hover:-translate-y-1.5 shadow-sm" data-category="{{ $cat }}">
                            
                            <!-- Thumbnail with 10MS Style Badges -->
                            <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-950">
                                @if($course->image)
                                    <img src="{{ safe_asset($course->image) }}" alt="{{ $course->course_title }}" onerror="this.onerror=null; this.src='{{ safe_asset('uploads/course/images/1711513200931914.jpg') }}';" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-tr from-slate-950 via-slate-900 to-emerald-950/40 text-slate-700 text-4xl">
                                        <i class="fa fa-laptop text-emerald-500/40"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                                
                                <!-- Top Floating Badges -->
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-950/90 backdrop-blur-md border border-emerald-500/30 text-emerald-400 font-mono text-[10px] font-bold">
                                        🔥 অফলাইন ল্যাব
                                    </span>
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span class="px-2 py-0.5 rounded-full bg-rose-600 text-white font-mono text-[10px] font-bold uppercase tracking-wider shadow">
                                        ভর্তি চলছে
                                    </span>
                                </div>

                                <!-- Schedule pill at bottom of thumbnail -->
                                <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-[11px] font-mono text-slate-200">
                                    <span class="bg-slate-950/90 px-2.5 py-0.5 rounded-md backdrop-blur-sm border border-slate-800">
                                        <i class="fa fa-clock-o text-emerald-400 mr-1"></i> {{ $course->time_line ?: '৩ মাস' }}
                                    </span>
                                    <span class="bg-slate-950/90 px-2.5 py-0.5 rounded-md backdrop-blur-sm text-cyan-300 border border-slate-800">
                                        <i class="fa fa-map-marker mr-1"></i> ল্যাব #১
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div>
                                    <h3 class="text-base font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-2 leading-snug">
                                        {{ $course->course_title }}
                                    </h3>
                                    
                                    <!-- 10MS Spec Highlights -->
                                    <div class="mt-3 space-y-1.5 text-xs text-slate-600 dark:text-slate-400">
                                        <div class="flex items-center gap-1.5">
                                            <i class="fa fa-check-circle text-emerald-600 dark:text-emerald-400 text-xs"></i>
                                            <span>হাতে-কলমে আধুনিক কম্পিউটার ল্যাব প্র্যাকটিস</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fa fa-check-circle text-emerald-600 dark:text-emerald-400 text-xs"></i>
                                            <span>প্রিন্টেড লেকচার শিট ও ল্যাব টাস্ক</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fa fa-check-circle text-emerald-600 dark:text-emerald-400 text-xs"></i>
                                            <span>অ্যাডমিন ভেরিফায়েড সার্টিফিকেট</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing & Action Button -->
                                <div class="pt-3 border-t border-slate-200 dark:border-slate-800 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-xs text-slate-500 dark:text-slate-400 block">কোর্স ফি:</span>
                                            <div class="flex items-baseline gap-2">
                                                <span class="text-lg font-black text-emerald-600 dark:text-emerald-400 font-mono">
                                                    ৳ {{ number_format($currentPrice) }}
                                                </span>
                                                <span class="text-xs text-slate-400 dark:text-slate-500 line-through font-mono">
                                                    ৳ {{ number_format($originalPrice) }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 border border-rose-200 dark:bg-emerald-500/10 dark:border-emerald-500/20 dark:text-emerald-400 font-mono text-[10px] font-bold">
                                            Save 26%
                                        </span>
                                    </div>

                                    <!-- 10MS Full-Width Action Button -->
                                    <a href="{{ route('course-details', $course->course_slug ?: $course->id) }}" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 group-hover:shadow-lg">
                                        <span>বিস্তারিত ও সিলেবাস</span>
                                        <i class="fa fa-arrow-right text-[10px] transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Bottom Browse All CTA -->
            <div class="text-center mt-12">
                <a href="{{ route('academic-training') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-800 dark:text-white font-bold text-xs uppercase tracking-wider border border-slate-300 dark:border-slate-700 transition-all shadow-sm">
                    <i class="fa fa-book text-emerald-600 dark:text-emerald-400"></i>
                    <span>সকল কোর্স ক্যাটালগ দেখুন</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </a>
            </div>

        </div>
    </section>

    <!--========================== 10 Minute School Inspired: "কেন ওয়েক আপ আইসিটি?" (Why Us Bento Grid) ============================-->
    <section class="py-20 sm:py-28 relative bg-slate-100/70 dark:bg-slate-900/40 border-y border-slate-200 dark:border-slate-800/80 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-mono uppercase tracking-widest text-emerald-600 dark:text-emerald-400 font-semibold mb-2 block">
                    <i class="fa fa-star text-amber-500 mr-1"></i> আমাদের বিশেষত্ব
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                    কেন ওয়েক আপ আইসিটিতে শিখবেন?
                </h2>
                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 mt-4 leading-relaxed">
                    গতানুগতিক অনলাইন কোর্সের সীমাবদ্ধতা পেরিয়ে সরাসরি ফিজিক্যাল ক্যাম্পাস ল্যাবে হাতে-কলমে শেখার সেরা অভিজ্ঞতা।
                </p>
            </div>

            <!-- Bento 4-Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bento-card p-6 rounded-3xl bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:border-emerald-500/40 transition-all duration-300 space-y-4 hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl">
                        <i class="fa fa-desktop"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">আধুনিক কম্পিউটার ল্যাব</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        ল্যাবে আধুনিক পিসি এবং হাই-স্পিড ইন্টারনেট সমৃদ্ধ পরিবেশে গ্রুপভিত্তিক ইন্টারঅ্যাকশন ও সার্বক্ষণিক প্র্যাকটিস।
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bento-card p-6 rounded-3xl bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:border-cyan-500/40 transition-all duration-300 space-y-4 hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-50 dark:bg-cyan-500/10 border border-cyan-200 dark:border-cyan-500/20 text-cyan-600 dark:text-cyan-400 flex items-center justify-center text-2xl">
                        <i class="fa fa-user-circle-o"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">ইন্ডাস্ট্রি এক্সপার্ট ট্রেইনার</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        প্রফেশনাল ডেভেলপার ও অভিজ্ঞ ট্রেইনারদের সরাসরি ক্লাসরুম মেন্টরিং এবং রিয়েল-লাইফ প্রজেক্ট গাইডলাইন।
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bento-card p-6 rounded-3xl bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:border-indigo-500/40 transition-all duration-300 space-y-4 hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-200 dark:border-indigo-500/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-2xl">
                        <i class="fa fa-file-pdf-o"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">প্রিন্টেড লেকচার ও ল্যাব শিট</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        মুখস্থ নয়, প্রতিটি বিষয়ের সাজানো ক্লাসরুম হ্যান্ডআউট, স্টেপ-বাই-স্টেপ ল্যাব প্র্যাকটিস শিট ও এক্সারসাইজ ফাইল।
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bento-card p-6 rounded-3xl bg-white dark:bg-slate-950/70 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:border-amber-500/40 transition-all duration-300 space-y-4 hover:-translate-y-1">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">ভেরিফায়েড সনদপত্র</h3>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        কোর্স সমাপনী ও ব্যবহারিক পরীক্ষা মূল্যায়নের পর অ্যাডমিন কর্তৃক ইস্যুকৃত কিউআর কোড যুক্ত ভেরিফায়েড সার্টিফিকেট।
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--========================== 10 Minute School Style: Student Portal & Counseling Banner ============================-->
    <section class="py-16 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="student-portal-banner rounded-3xl bg-gradient-to-r from-emerald-50 via-teal-50 to-white dark:from-emerald-950/80 dark:via-slate-900/90 dark:to-slate-950 border border-emerald-200 dark:border-emerald-500/30 p-8 sm:p-12 relative overflow-hidden shadow-xl backdrop-blur-xl transition-all duration-200">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <div class="lg:col-span-8 space-y-4">
                        <span class="px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400 font-mono text-xs font-bold uppercase tracking-wider inline-flex items-center gap-1.5 border border-emerald-200 dark:border-emerald-500/30">
                            <i class="fa fa-graduation-cap"></i>
                            <span>স্মার্ট স্টুডেন্ট পোর্টাল</span>
                        </span>
                        <h3 class="text-2xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight leading-snug">
                            আপনার ক্লাসরুম ও অগ্রগতি এখন এক ঠিকানায়
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed max-w-2xl">
                            ল্যাব শিডিউল, ক্লাসরুম নোটিশ, লেকচার শিট ডাউনলোড, প্র্যাকটিস পরীক্ষা এবং পেমেন্ট রসিদ ম্যানেজ করুন আপনার ডেডিকেটেড স্টুডেন্ট প্যানেল থেকে।
                        </p>
                        <div class="pt-2 flex flex-wrap items-center gap-4">
                            @if(Auth::guard('student')->check())
                                <a href="{{ route('student.dashboard') }}" class="px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                    <i class="fa fa-tachometer"></i>
                                    <span>ড্যাশবোর্ডে প্রবেশ করুন</span>
                                </a>
                            @else
                                <a href="{{ route('student.login') }}" class="px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                    <i class="fa fa-sign-in"></i>
                                    <span>স্টুডেন্ট লগইন</span>
                                </a>
                                <a href="{{ route('student.register') }}" class="px-5 py-3.5 rounded-xl bg-white hover:bg-slate-100 text-slate-800 dark:bg-slate-900 dark:hover:bg-slate-800 dark:text-white font-bold text-xs uppercase tracking-wider border border-slate-300 dark:border-slate-700 transition-all flex items-center gap-2 shadow-sm">
                                    <i class="fa fa-user-plus text-emerald-600 dark:text-emerald-400"></i>
                                    <span>নতুন শিক্ষার্থী নিবন্ধন</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="lg:col-span-4 bg-white dark:bg-slate-900/90 border border-emerald-200 dark:border-slate-800 rounded-2xl p-6 text-center space-y-4 shadow-md">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 flex items-center justify-center mx-auto text-xl border border-emerald-100 dark:border-none">
                            <i class="fa fa-phone"></i>
                        </div>
                        <h4 class="text-base font-bold text-slate-900 dark:text-white">ফ্রি ক্যারিয়ার কাউন্সেলিং</h4>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            কোন কোর্সটি আপনার ক্যারিয়ারের জন্য উপযুক্ত তা নির্ধারণে আমাদের এক্সপার্টদের সাথে কথা বলুন।
                        </p>
                        <a href="tel:01791612121" class="block w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white dark:bg-slate-800 dark:text-emerald-400 font-bold text-xs border border-emerald-600 dark:border-emerald-500/30 transition-all shadow-sm">
                            <i class="fa fa-phone mr-1"></i> ০১৭৯১-৬১২১২১
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function filterCourses(category, btn) {
        var isLight = document.documentElement.classList.contains('light');
        // Toggle active pill button
        document.querySelectorAll('#course-category-tabs .category-pill').forEach(function(p) {
            p.classList.remove('active', 'bg-emerald-600', 'bg-emerald-500', 'text-white', 'text-slate-950', 'shadow-md', 'shadow-glow-emerald');
            if (isLight) {
                p.classList.add('bg-white', 'border', 'border-slate-200', 'text-slate-700', 'shadow-sm');
            } else {
                p.classList.add('bg-slate-900', 'border', 'border-slate-700/80', 'text-slate-300');
            }
        });
        btn.classList.add('active');
        if (isLight) {
            btn.classList.remove('bg-white', 'border-slate-200', 'text-slate-700', 'shadow-sm');
            btn.classList.add('bg-emerald-600', 'text-white', 'shadow-md');
        } else {
            btn.classList.remove('bg-slate-900', 'border-slate-700/80', 'text-slate-300');
            btn.classList.add('bg-emerald-500', 'text-slate-950', 'shadow-glow-emerald');
        }

        // Filter cards
        var cards = document.querySelectorAll('#courses-grid .course-item');
        cards.forEach(function(card) {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
    </script>

    <!--========================== National Work (Dynamic Case Studies) ============================-->
    @if (!empty($nationalWork) && count($nationalWork) > 0)
        <section id="national-work" class="py-24 sm:py-32 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
                
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">
                            {{ app_setting('portfolio_header_badge', __('frontend.home.featured_deployments')) }}
                        </div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ app_setting('portfolio_header_title', $nationalWorkHeader->title ?? 'National Digital Engineering') }}
                        </h2>
                    </div>
                    <div class="max-w-md text-slate-400 text-sm leading-relaxed">
                        {!! $nationalWorkHeader->description ?? 'Delivering scalable technology solutions to national institutions, startups, and enterprise giants.' !!}
                    </div>
                </div>

                <!-- Asymmetric Editorial Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">
                    @foreach ($nationalWork as $index => $project)
                        @php
                            $targetBlog = App\model\Blog::find($project->blog_id);
                            $blog_slug = $targetBlog ? $targetBlog->slug_title : '';
                            $isFeatured = ($index % 3 == 0);
                        @endphp

                        <div class="{{ $isFeatured ? 'lg:col-span-8' : 'lg:col-span-4' }} group">
                            <a href="{{ !empty($blog_slug) ? url('our-blogs/' . $blog_slug) : '#' }}" class="flex flex-col h-full rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-brand-primary/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                                
                                <!-- Image Container -->
                                <div class="relative w-full {{ $isFeatured ? 'h-72 sm:h-96' : 'h-60' }} overflow-hidden bg-slate-950">
                                    <img src="{{ safe_asset($project->image) }}" alt="{{ $project->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-950/80 border border-slate-700 text-xs font-mono text-brand-primary">
                                            <i class="{{ $project->logo }} text-xs"></i>
                                            <span>{{ __('frontend.home.case_study') }}</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-brand-primary transition-colors">
                                        {{ $project->title }}
                                    </h3>
                                    <div class="text-slate-400 text-sm leading-relaxed mb-6 flex-grow">
                                        {!! Str::limit(strip_tags($project->description), $isFeatured ? 140 : 90) !!}
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-brand-primary font-semibold group-hover:translate-x-1 transition-transform">
                                        <span>{{ __('frontend.home.examine_architecture') }}</span>
                                        <i class="fa fa-arrow-right text-[10px]"></i>
                                    </div>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    <!--========================== International Projects ============================-->
    @if (!empty($internationalWorks) && count($internationalWorks) > 0)
        <section class="py-24 sm:py-32 relative bg-slate-900/30 border-t border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-cyan font-semibold mb-3">{{ __('frontend.home.cross_border') }}</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ $internationalProjectHeader->title ?? __('frontend.home.international_title') }}
                        </h2>
                    </div>
                    <div class="max-w-md text-slate-400 text-sm leading-relaxed">
                        {!! $internationalProjectHeader->description ?? __('frontend.home.international_sub') !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($internationalWorks as $index => $work)
                        @php
                            $targetBlog = App\model\Blog::find($work->blog_id);
                            $blog_slug = $targetBlog ? $targetBlog->slug_title : '';
                        @endphp
                        <div class="group relative rounded-2xl overflow-hidden border border-slate-800/80 hover:border-brand-cyan/40 transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1 bg-slate-950">
                            <a href="{{ !empty($blog_slug) ? url('our-blogs/' . $blog_slug) : '#' }}" class="block aspect-[16/10] sm:aspect-[16/9] overflow-hidden relative">
                                <img src="{{ safe_asset($work->image) }}" alt="{{ $work->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-90 group-hover:brightness-100">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                                
                                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs font-mono uppercase tracking-widest text-brand-cyan block mb-1">{{ __('frontend.home.international_badge') }}</span>
                                        <h4 class="text-xl sm:text-2xl font-bold text-white group-hover:text-brand-cyan transition-colors">
                                            {{ __('frontend.home.view_enterprise_solution') }}
                                        </h4>
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-slate-900/90 border border-slate-700 flex items-center justify-center text-brand-cyan group-hover:bg-brand-cyan group-hover:text-slate-950 transition-all duration-300">
                                        <i class="fa fa-arrow-right text-sm"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    <!--========================== Local Projects / Ecosystem ============================-->
    @if (!empty($localProjects) && count($localProjects) > 0)
        <section class="py-20 relative border-t border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">{{ __('frontend.home.regional_footprint') }}</div>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white mb-4">
                        {{ $localProjectHeader->title ?? __('frontend.home.local_innovation') }}
                    </h2>
                    <div class="text-slate-400 text-sm">
                        {!! $localProjectHeader->description ?? __('frontend.home.local_sub') !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($localProjects as $index => $local)
                        @php
                            $targetBlog = App\model\Blog::find($local->blog_id);
                            $blog_slug = $targetBlog ? $targetBlog->slug_title : '';
                        @endphp
                        <a href="{{ !empty($blog_slug) ? url('our-blogs/' . $blog_slug) : '#' }}" class="group block rounded-2xl overflow-hidden bg-slate-900/60 border border-slate-800/80 hover:border-slate-700 transition-all duration-300 hover:-translate-y-1">
                            <div class="h-56 overflow-hidden bg-slate-950">
                                <img src="{{ safe_asset($local->image) }}" alt="{{ $local->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    <!--========================== Ongoing Development (R&D Pipeline) ============================-->
    @if (!empty($projects) && count($projects) > 0)
        <section class="py-24 sm:py-32 relative border-t border-slate-800/80 bg-slate-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
                    <div class="lg:col-span-6">
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">{{ __('frontend.home.active_rd') }}</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ $developmentProjectHeader->title ?? __('frontend.home.ongoing_innovations') }}
                        </h2>
                    </div>
                    <div class="lg:col-span-6 text-slate-400 text-base leading-relaxed">
                        {!! $developmentProjectHeader->description ?? __('frontend.home.ongoing_sub') !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($projects as $index => $project)
                        @php
                            $targetBlog = App\model\Blog::find($project->blog_id);
                            $blog_slug = $targetBlog ? $targetBlog->slug_title : '';
                        @endphp
                        <div class="group rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-brand-primary/40 p-6 sm:p-8 backdrop-blur-md transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                            <div class="flex flex-col sm:flex-row gap-6 items-start">
                                <div class="w-full sm:w-44 h-36 rounded-xl overflow-hidden bg-slate-950 flex-shrink-0">
                                    <img src="{{ safe_asset($project->image) }}" alt="{{ $project->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="flex flex-col flex-grow">
                                    <div class="text-brand-primary text-lg mb-2">
                                        <i class="{{ $project->logo }}"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-white mb-2 group-hover:text-brand-primary transition-colors">
                                        <a href="{{ !empty($blog_slug) ? url('our-blogs/' . $blog_slug) : '#' }}">{{ $project->title }}</a>
                                    </h3>
                                    <p class="text-slate-400 text-sm leading-relaxed mb-4 flex-grow">
                                        {!! Str::limit(strip_tags($project->description), 100) !!}
                                    </p>
                                    <a href="{{ !empty($blog_slug) ? url('our-blogs/' . $blog_slug) : '#' }}" class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-brand-primary font-semibold group-hover:translate-x-1 transition-transform">
                                        <span>{{ __('frontend.home.learn_more') }}</span>
                                        <i class="fa fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    <!--========================== Bottom Enterprise CTA Banner ============================-->
    <section class="py-20 relative border-t border-slate-800/80 overflow-hidden" style="background: linear-gradient(180deg, rgba(3, 7, 18, 0.6) 0%, rgba(11, 19, 41, 0.95) 100%);">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-primary/10 via-transparent to-brand-cyan/10 pointer-events-none"></div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 reveal-on-scroll">
            <span class="inline-block px-4 py-1.5 rounded-full bg-brand-primary/10 border border-brand-primary/30 text-brand-primary font-mono text-xs uppercase tracking-widest mb-4">
                {{ __('frontend.home.enterprise_partnerships') }}
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight mb-6">
                {{ app_setting('cta_banner_title', __('frontend.sections.cta_title')) }}
            </h2>
            <p class="text-slate-300 text-base sm:text-lg max-w-2xl mx-auto mb-10">
                {{ app_setting('cta_banner_sub', __('frontend.sections.cta_sub')) }}
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('contact-us-page') }}" class="px-8 py-4 rounded-xl font-bold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                    {{ app_setting('cta_btn_text', __('frontend.sections.cta_button')) }}
                </a>
                <a href="{{ route('academic-training') }}" class="px-8 py-4 rounded-xl font-bold text-sm tracking-wider uppercase bg-slate-900 border border-slate-700 hover:border-slate-500 text-slate-200 transition-all duration-300 hover:-translate-y-1">
                    {{ __('frontend.hero.explore_courses') }}
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Auto-Sliding Hero Carousel JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('slider-prev-btn');
        const nextBtn = document.getElementById('slider-next-btn');
        const ambientBg = document.getElementById('hero-ambient-bg');
        const container = document.getElementById('hero-slider-carousel');

        if (!slides || slides.length <= 1) return;

        let currentIndex = 0;
        let slideInterval = null;
        const intervalTime = 5000; // 5 seconds per slide

        function goToSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'z-0', 'pointer-events-none');
                    slide.classList.add('opacity-100', 'z-10');
                    if (ambientBg) {
                        const newBg = slide.getAttribute('data-bg');
                        if (newBg) ambientBg.src = newBg;
                    }
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0', 'pointer-events-none');
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-slate-600', 'w-2.5');
                    dot.classList.add('bg-brand-primary', 'w-6');
                } else {
                    dot.classList.remove('bg-brand-primary', 'w-6');
                    dot.classList.add('bg-slate-600', 'w-2.5');
                }
            });

            currentIndex = index;
        }

        function nextSlide() {
            let nextIndex = (currentIndex + 1) % slides.length;
            goToSlide(nextIndex);
        }

        function prevSlide() {
            let prevIndex = (currentIndex - 1 + slides.length) % slides.length;
            goToSlide(prevIndex);
        }

        function startAutoPlay() {
            if (slideInterval) clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, intervalTime);
        }

        function stopAutoPlay() {
            if (slideInterval) clearInterval(slideInterval);
        }

        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); startAutoPlay(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); startAutoPlay(); });

        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                const targetIdx = parseInt(this.getAttribute('data-target'));
                goToSlide(targetIdx);
                startAutoPlay();
            });
        });

        if (container) {
            container.addEventListener('mouseenter', stopAutoPlay);
            container.addEventListener('mouseleave', startAutoPlay);
        }

        // Start auto play
        startAutoPlay();
    });
</script>

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-343NCHFV71"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-343NCHFV71');
</script>
@endsection
