@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950">

    <!--========================== The Connected Intelligence Hero ============================-->
    @if (!empty($homeSlider->slider_image))
        <section class="relative min-h-[92vh] flex items-center justify-center pt-24 pb-16 lg:py-0 overflow-hidden bg-grid-mesh">
            
            <!-- Ambient Lighting & Atmospheric Blurs -->
            <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] sm:w-[900px] h-[500px] bg-gradient-to-tr from-emerald-500/15 via-cyan-500/10 to-indigo-500/10 blur-[140px] pointer-events-none rounded-full"></div>
            
            <!-- Dynamic Background Slider as Ambient Texture -->
            <div class="absolute inset-0 z-0 opacity-15 mix-blend-luminosity overflow-hidden pointer-events-none">
                <img src="{{ URL::asset($homeSlider->slider_image) }}" alt="{{ $homeSlider->slider_alt }}" class="w-full h-full object-cover filter grayscale contrast-125">
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center min-h-[80vh]">
                    
                    <!-- Left: Kinetic Headline & Value Proposition (Cols 7) -->
                    <div class="lg:col-span-7 flex flex-col justify-center text-left">
                        
                        <!-- Live Status Badge -->
                        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-emerald-500/30 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-6 w-fit backdrop-blur-md shadow-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Enterprise Technology & Consulting 2026</span>
                        </div>

                        <!-- Kinetic Display Headline -->
                        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white leading-[1.08] mb-6">
                            Engineering High-Velocity 
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-cyan-300 to-indigo-400">
                                Digital Intelligence.
                            </span>
                        </h1>

                        <!-- Editorial Manifesto / Subtitle -->
                        <p class="text-lg sm:text-xl text-slate-300 font-normal leading-relaxed max-w-2xl mb-10">
                            We architect cutting-edge enterprise software, empower the next generation of engineers, and accelerate digital transformation with uncompromising precision.
                        </p>

                        <!-- High-Impact Dual CTAs -->
                        <div class="flex flex-wrap items-center gap-4 mb-12">
                            <a href="{{ route('academic-training') }}" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                                <span>Explore Academics</span>
                                <i class="fa fa-arrow-right text-xs"></i>
                            </a>
                            <a href="{{ route('services-page') }}" class="inline-flex items-center justify-center gap-3 px-7 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-200 border border-slate-700/80 hover:border-slate-600 transition-all duration-300 hover:-translate-y-1">
                                <span>Enterprise Services</span>
                                <i class="fa fa-angle-right text-xs text-emerald-400"></i>
                            </a>
                        </div>

                        <!-- Micro-Stats Ticker -->
                        <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-800/80 max-w-lg">
                            <div>
                                <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">1,500+</div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">Engineers Trained</div>
                            </div>
                            <div>
                                <div class="text-2xl sm:text-3xl font-bold font-mono text-white tracking-tight">50+</div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">Industry Partners</div>
                            </div>
                            <div>
                                <div class="text-2xl sm:text-3xl font-bold font-mono text-emerald-400 tracking-tight">98.4%</div>
                                <div class="text-xs font-mono uppercase tracking-wider text-slate-400 mt-1">Placement Rate</div>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Interactive SVG Constellation / Diagram (Cols 5) -->
                    <div class="lg:col-span-5 flex items-center justify-center">
                        
                        <!-- Desktop SVG Graphic -->
                        <div class="hidden sm:block relative w-full aspect-square max-w-[480px]">
                            <!-- Outer pulsing orb -->
                            <div class="absolute inset-0 rounded-full border border-slate-800 animate-pulse-subtle"></div>
                            <div class="absolute inset-8 rounded-full border border-slate-800/60 border-dashed animate-[spin_60s_linear_infinite]"></div>
                            
                            <!-- Connected SVG Canvas -->
                            <svg viewBox="0 0 500 500" class="w-full h-full overflow-visible drop-shadow-2xl">
                                <defs>
                                    <linearGradient id="grad-emerald" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#10b981" />
                                        <stop offset="100%" stop-color="#06b6d4" />
                                    </linearGradient>
                                    <filter id="glow-node" x="-20%" y="-20%" width="140%" height="140%">
                                        <feGaussianBlur stdDeviation="6" result="blur" />
                                        <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                    </filter>
                                </defs>

                                <!-- Vector Connection Lines -->
                                <line x1="250" y1="250" x2="250" y2="80" stroke="#1e293b" stroke-width="2" stroke-dasharray="4,4" />
                                <line x1="250" y1="250" x2="410" y2="170" stroke="#1e293b" stroke-width="2" stroke-dasharray="4,4" />
                                <line x1="250" y1="250" x2="370" y2="380" stroke="#1e293b" stroke-width="2" stroke-dasharray="4,4" />
                                <line x1="250" y1="250" x2="130" y2="380" stroke="#1e293b" stroke-width="2" stroke-dasharray="4,4" />
                                <line x1="250" y1="250" x2="90" y2="170" stroke="#1e293b" stroke-width="2" stroke-dasharray="4,4" />

                                <!-- Center Core Node -->
                                <g class="group cursor-pointer">
                                    <circle cx="250" cy="250" r="50" fill="#0b1329" stroke="url(#grad-emerald)" stroke-width="3" filter="url(#glow-node)" />
                                    <text x="250" y="246" fill="#ffffff" font-family="'Plus Jakarta Sans', sans-serif" font-weight="700" font-size="13" text-anchor="middle">WAKE UP</text>
                                    <text x="250" y="262" fill="#10b981" font-family="'JetBrains Mono', monospace" font-weight="600" font-size="11" text-anchor="middle">NEXUS</text>
                                </g>

                                <!-- Node 1: Software Engineering (Top) -->
                                <g transform="translate(250, 80)" class="cursor-pointer group">
                                    <circle cx="0" cy="0" r="28" fill="#0f172a" stroke="#10b981" stroke-width="2" class="transition-all duration-300 group-hover:scale-110" />
                                    <text x="0" y="4" fill="#34d399" font-family="FontAwesome" font-size="14" text-anchor="middle">&#xf121;</text>
                                    <text x="0" y="44" fill="#cbd5e1" font-family="'JetBrains Mono', monospace" font-size="10" font-weight="600" text-anchor="middle">Architecture</text>
                                </g>

                                <!-- Node 2: Cloud & DevOps (Top Right) -->
                                <g transform="translate(410, 170)" class="cursor-pointer group">
                                    <circle cx="0" cy="0" r="28" fill="#0f172a" stroke="#06b6d4" stroke-width="2" class="transition-all duration-300 group-hover:scale-110" />
                                    <text x="0" y="4" fill="#22d3ee" font-family="FontAwesome" font-size="14" text-anchor="middle">&#xf0c2;</text>
                                    <text x="0" y="44" fill="#cbd5e1" font-family="'JetBrains Mono', monospace" font-size="10" font-weight="600" text-anchor="middle">Cloud & DevOps</text>
                                </g>

                                <!-- Node 3: AI & Machine Learning (Bottom Right) -->
                                <g transform="translate(370, 380)" class="cursor-pointer group">
                                    <circle cx="0" cy="0" r="28" fill="#0f172a" stroke="#6366f1" stroke-width="2" class="transition-all duration-300 group-hover:scale-110" />
                                    <text x="0" y="4" fill="#818cf8" font-family="FontAwesome" font-size="14" text-anchor="middle">&#xf085;</text>
                                    <text x="0" y="44" fill="#cbd5e1" font-family="'JetBrains Mono', monospace" font-size="10" font-weight="600" text-anchor="middle">AI & Analytics</text>
                                </g>

                                <!-- Node 4: Cybersecurity (Bottom Left) -->
                                <g transform="translate(130, 380)" class="cursor-pointer group">
                                    <circle cx="0" cy="0" r="28" fill="#0f172a" stroke="#10b981" stroke-width="2" class="transition-all duration-300 group-hover:scale-110" />
                                    <text x="0" y="4" fill="#34d399" font-family="FontAwesome" font-size="14" text-anchor="middle">&#xf132;</text>
                                    <text x="0" y="44" fill="#cbd5e1" font-family="'JetBrains Mono', monospace" font-size="10" font-weight="600" text-anchor="middle">Cybersecurity</text>
                                </g>

                                <!-- Node 5: Product & UI/UX (Top Left) -->
                                <g transform="translate(90, 170)" class="cursor-pointer group">
                                    <circle cx="0" cy="0" r="28" fill="#0f172a" stroke="#06b6d4" stroke-width="2" class="transition-all duration-300 group-hover:scale-110" />
                                    <text x="0" y="4" fill="#22d3ee" font-family="FontAwesome" font-size="14" text-anchor="middle">&#xf040;</text>
                                    <text x="0" y="44" fill="#cbd5e1" font-family="'JetBrains Mono', monospace" font-size="10" font-weight="600" text-anchor="middle">UI/UX Systems</text>
                                </g>
                            </svg>
                        </div>

                        <!-- Mobile Constellation Chips (< 640px) -->
                        <div class="sm:hidden w-full grid grid-cols-2 gap-3 pt-4">
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                                <i class="fa fa-code text-emerald-400"></i>
                                <span class="text-xs font-mono font-medium text-slate-200">Architecture</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                                <i class="fa fa-cloud text-cyan-400"></i>
                                <span class="text-xs font-mono font-medium text-slate-200">Cloud & DevOps</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                                <i class="fa fa-cogs text-indigo-400"></i>
                                <span class="text-xs font-mono font-medium text-slate-200">AI & Analytics</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-900/90 border border-slate-800">
                                <i class="fa fa-shield text-emerald-400"></i>
                                <span class="text-xs font-mono font-medium text-slate-200">Cybersecurity</span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    @endif

    <!--========================== Metrics Bar / Manifesto Strip ============================-->
    <section class="border-y border-slate-800/80 bg-slate-900/40 backdrop-blur-md py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center sm:text-left">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa fa-rocket text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Full-Throttle Innovation</h4>
                        <p class="text-xs text-slate-400 mt-1">High-impact agile methodology</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                        <i class="fa fa-users text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Elite Engineering Core</h4>
                        <p class="text-xs text-slate-400 mt-1">Handcrafted talent pipeline</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400">
                        <i class="fa fa-shield text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-white">Enterprise Scalability</h4>
                        <p class="text-xs text-slate-400 mt-1">Zero-downtime architecture</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
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

    <!--========================== National Work (Asymmetric Case Studies) ============================-->
    @if (!empty($nationalWork))
        <section id="national-work" class="py-24 sm:py-32 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Featured Deployments</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight">
                            {{ $nationalWorkHeader->title ?? 'National Digital Engineering' }}
                        </h2>
                    </div>
                    <div class="max-w-md text-slate-400 text-sm leading-relaxed">
                        {!! $nationalWorkHeader->description ?? 'Delivering scalable technology solutions to national institutions, startups, and enterprise giants.' !!}
                    </div>
                </div>

                <!-- Asymmetric Editorial Grid (8/4 or Staggered) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">
                    @foreach ($nationalWork as $index => $project)
                        @php
                            $blog_slug = App\model\Blog::find($project->blog_id)->slug_title;
                            $isFeatured = ($index % 3 == 0);
                        @endphp

                        <div class="{{ $isFeatured ? 'lg:col-span-8' : 'lg:col-span-4' }} group">
                            <a href="{{ url('our-blogs/' . $blog_slug) }}" class="flex flex-col h-full rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                                
                                <!-- Image Container with Zoom -->
                                <div class="relative w-full {{ $isFeatured ? 'h-72 sm:h-96' : 'h-60' }} overflow-hidden bg-slate-950">
                                    <img src="{{ URL::asset($project->image) }}" alt="{{ $project->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                                    
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-950/80 border border-slate-700 text-xs font-mono text-emerald-400">
                                            <i class="{{ $project->logo }} text-xs"></i>
                                            <span>Case Study</span>
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Content Body -->
                                <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                    <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">
                                        {{ $project->title }}
                                    </h3>
                                    <div class="text-slate-400 text-sm leading-relaxed mb-6 flex-grow">
                                        {!! Str::limit(strip_tags($project->description), $isFeatured ? 140 : 90) !!}
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform">
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

    <!--========================== International Projects (High-Tech Dark Grid) ============================-->
    @if (!empty($internationalWorks))
        <section class="py-24 sm:py-32 relative bg-slate-900/30 border-t border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
                    <div>
                        <div class="text-xs font-mono uppercase tracking-widest text-cyan-400 font-semibold mb-3">Cross-Border Impact</div>
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
                            $blog_slug = App\model\Blog::find($work->blog_id)->slug_title;
                        @endphp
                        <div class="group relative rounded-2xl overflow-hidden border border-slate-800/80 hover:border-cyan-500/40 transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1 bg-slate-950">
                            <a href="{{ url('our-blogs/' . $blog_slug) }}" class="block aspect-[16/10] sm:aspect-[16/9] overflow-hidden relative">
                                <img src="{{ URL::asset($work->image) }}" alt="{{ $work->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-90 group-hover:brightness-100">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                                
                                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs font-mono uppercase tracking-widest text-cyan-400 block mb-1">International Project</span>
                                        <h4 class="text-xl sm:text-2xl font-bold text-white group-hover:text-cyan-300 transition-colors">
                                            View Enterprise Solution
                                        </h4>
                                    </div>
                                    <div class="w-10 h-10 rounded-xl bg-slate-900/90 border border-slate-700 flex items-center justify-center text-cyan-400 group-hover:bg-cyan-500 group-hover:text-slate-950 transition-all duration-300">
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
    @if (!empty($localProjects))
        <section class="py-20 relative border-t border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Regional Footprint</div>
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
                            $blog_slug = App\model\Blog::find($local->blog_id)->slug_title;
                        @endphp
                        <a href="{{ url('our-blogs/' . $blog_slug) }}" class="group block rounded-2xl overflow-hidden bg-slate-900/60 border border-slate-800/80 hover:border-slate-700 transition-all duration-300 hover:-translate-y-1">
                            <div class="h-56 overflow-hidden bg-slate-950">
                                <img src="{{ URL::asset($local->image) }}" alt="{{ $local->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    <!--========================== Ongoing Development (Storytelling Split) ============================-->
    @if (!empty($projects))
        <section class="py-24 sm:py-32 relative border-t border-slate-800/80 bg-slate-900/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
                    <div class="lg:col-span-6">
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Active R&D Pipelines</div>
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
                            $blog_slug = App\model\Blog::find($project->blog_id)->slug_title;
                        @endphp
                        <div class="group rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 p-6 sm:p-8 backdrop-blur-md transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                            <div class="flex flex-col sm:flex-row gap-6 items-start">
                                <div class="w-full sm:w-44 h-36 rounded-xl overflow-hidden bg-slate-950 flex-shrink-0">
                                    <img src="{{ URL::asset($project->image) }}" alt="{{ $project->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div class="flex flex-col flex-grow">
                                    <div class="text-emerald-400 text-lg mb-2">
                                        <i class="{{ $project->logo }}"></i>
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">
                                        <a href="{{ url('our-blogs/' . $blog_slug) }}">{{ $project->title }}</a>
                                    </h3>
                                    <p class="text-slate-400 text-sm leading-relaxed mb-4 flex-grow">
                                        {!! Str::limit(strip_tags($project->description), 100) !!}
                                    </p>
                                    <a href="{{ url('our-blogs/' . $blog_slug) }}" class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform">
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

</div>

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
