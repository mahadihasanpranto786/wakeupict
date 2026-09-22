@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950">

    <!--========================== Globant-Inspired Auto-Sliding Hero ============================-->
    <section class="relative min-h-[92vh] flex items-center justify-center pt-28 pb-16 lg:py-0 overflow-hidden bg-grid-mesh">
        
        <!-- Ambient Glowing Core -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] sm:w-[900px] h-[500px] bg-gradient-to-tr from-brand-primary/15 via-brand-cyan/10 to-brand-indigo/10 blur-[140px] pointer-events-none rounded-full"></div>
        
        <!-- Ambient Background Texture from Active Slide -->
        <div class="absolute inset-0 z-0 opacity-10 mix-blend-luminosity overflow-hidden pointer-events-none">
            @if(isset($homeSliders) && count($homeSliders) > 0)
                <img id="hero-ambient-bg" src="{{ safe_asset($homeSliders[0]->slider_image) }}" alt="Ambient Background" class="w-full h-full object-cover filter grayscale contrast-125 transition-all duration-1000">
            @elseif(!empty($homeSlider->slider_image))
                <img id="hero-ambient-bg" src="{{ safe_asset($homeSlider->slider_image) }}" alt="Ambient Background" class="w-full h-full object-cover filter grayscale contrast-125">
            @endif
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center min-h-[80vh]">
                
                <!-- Left: Headline & Editorial Value Proposition (Cols 7) -->
                <div class="lg:col-span-7 flex flex-col justify-center text-left">
                    
                    <!-- Live Status Badge -->
                    <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-brand-primary/30 text-brand-primary text-xs font-mono tracking-wider uppercase mb-6 w-fit backdrop-blur-md shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-primary"></span>
                        </span>
                        <span>{{ app_setting('hero_badge', __('frontend.hero.badge')) }}</span>
                    </div>

                    <!-- Kinetic Display Headline -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12] mb-6">
                        {{ app_setting('hero_title', __('frontend.hero.title')) }}
                    </h1>

                    <!-- Editorial Manifesto / Subtitle -->
                    <p class="text-base sm:text-lg text-slate-300 font-normal leading-relaxed max-w-2xl mb-10">
                        {{ app_setting('hero_subtitle', __('frontend.hero.subtitle')) }}
                    </p>

                    <!-- High-Impact Dual CTAs -->
                    <div class="flex flex-wrap items-center gap-4 mb-12">
                        <a href="{{ route('academic-training') }}" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                            <span>{{ app_setting('hero_btn1_text', __('frontend.hero.explore_courses')) }}</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('services-page') }}" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-200 border border-slate-700/80 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1">
                            <span>{{ app_setting('hero_btn2_text', __('frontend.hero.our_services')) }}</span>
                            <i class="fa fa-angle-right text-xs text-brand-primary"></i>
                        </a>
                    </div>

                    <!-- Micro-Stats Ticker -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-800/80 max-w-lg">
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">
                                {{ app_setting('stat1_value', '15,000+') }}
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat1_label', __('frontend.hero.stats_students')) }}
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">
                                {{ app_setting('stat2_value', '250+') }}
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat2_label', __('frontend.hero.stats_projects')) }}
                            </div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-bold font-mono text-brand-primary tracking-tight">
                                {{ app_setting('stat3_value', '98.5%') }}
                            </div>
                            <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">
                                {{ app_setting('stat3_label', __('frontend.hero.stats_satisfaction')) }}
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right: Auto-Sliding Hero Showcase (Cols 5) -->
                <div class="lg:col-span-5 flex flex-col items-center justify-center">
                    
                    @if(isset($homeSliders) && count($homeSliders) > 0)
                        <!-- Multi-Image Carousel Container -->
                        <div id="hero-slider-carousel" class="relative w-full aspect-[16/10] sm:aspect-[4/3] rounded-2xl overflow-hidden border border-slate-800/90 shadow-2xl bg-slate-900 group">
                            
                            <!-- Slides -->
                            @foreach($homeSliders as $idx => $slide)
                                <div class="hero-slide absolute inset-0 transition-opacity duration-700 ease-in-out {{ $idx === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none' }}" data-index="{{ $idx }}" data-bg="{{ safe_asset($slide->slider_image) }}">
                                    <img src="{{ safe_asset($slide->slider_image) }}" alt="{{ $slide->slider_alt }}" class="w-full h-full object-cover filter brightness-95 contrast-105">
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
                            <img src="{{ safe_asset($homeSlider->slider_image) }}" alt="{{ $homeSlider->slider_alt }}" class="w-full h-full object-cover">
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
                        <h4 class="text-sm font-semibold text-white">Full-Throttle Innovation</h4>
                        <p class="text-xs text-slate-400 mt-1">High-impact agile methodology</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-cyan/10 border border-brand-cyan/20 flex items-center justify-center text-brand-cyan">
                        <i class="fa fa-users text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Elite Engineering Core</h4>
                        <p class="text-xs text-slate-400 mt-1">Handcrafted talent pipeline</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-indigo/10 border border-brand-indigo/20 flex items-center justify-center text-brand-indigo">
                        <i class="fa fa-shield text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Enterprise Scalability</h4>
                        <p class="text-xs text-slate-400 mt-1">Zero-downtime architecture</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary">
                        <i class="fa fa-trophy text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Award-Winning Quality</h4>
                        <p class="text-xs text-slate-400 mt-1">National recognition in ICT</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--========================== National Work (Dynamic Case Studies) ============================-->
    @if (!empty($nationalWork) && count($nationalWork) > 0)
        <section id="national-work" class="py-24 sm:py-32 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">
                            {{ app_setting('portfolio_header_badge', 'Featured Deployments') }}
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
                                            <span>Case Study</span>
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
                                        <span>Examine Architecture</span>
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
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-cyan font-semibold mb-3">Cross-Border Impact</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ $internationalProjectHeader->title ?? 'Global Engineering Footprint' }}
                        </h2>
                    </div>
                    <div class="max-w-md text-slate-400 text-sm leading-relaxed">
                        {!! $internationalProjectHeader->description ?? 'Collaborating with overseas partners on enterprise-grade software delivery.' !!}
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
                                        <span class="text-xs font-mono uppercase tracking-widest text-brand-cyan block mb-1">International Project</span>
                                        <h4 class="text-xl sm:text-2xl font-bold text-white group-hover:text-brand-cyan transition-colors">
                                            View Enterprise Solution
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">Regional Footprint</div>
                    <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white mb-4">
                        {{ $localProjectHeader->title ?? 'Local Innovation Initiatives' }}
                    </h2>
                    <div class="text-slate-400 text-sm">
                        {!! $localProjectHeader->description ?? 'Empowering our regional technology ecosystem through continuous high-grade implementations.' !!}
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
                    <div class="lg:col-span-6">
                        <div class="text-xs font-mono uppercase tracking-widest text-brand-primary font-semibold mb-3">Active R&D Pipelines</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ $developmentProjectHeader->title ?? 'Ongoing Innovations' }}
                        </h2>
                    </div>
                    <div class="lg:col-span-6 text-slate-400 text-base leading-relaxed">
                        {!! $developmentProjectHeader->description ?? 'Explore what our advanced engineering cohorts and lab teams are currently deploying.' !!}
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
                                        <span>Learn More</span>
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-block px-4 py-1.5 rounded-full bg-brand-primary/10 border border-brand-primary/30 text-brand-primary font-mono text-xs uppercase tracking-widest mb-4">
                Enterprise Partnerships
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
