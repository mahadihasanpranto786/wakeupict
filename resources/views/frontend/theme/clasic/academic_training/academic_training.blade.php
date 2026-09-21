@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen">

    <!--========================== Hero Banner ============================-->
    @if (!empty($banner->image))
        <section class="relative min-h-[55vh] sm:min-h-[65vh] flex items-center justify-center pt-32 pb-20 overflow-hidden bg-grid-mesh border-b border-slate-800/80">
            <!-- Ambient Lighting -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full"></div>

            <!-- Background Image Texture -->
            <div class="absolute inset-0 z-0 opacity-15 mix-blend-luminosity overflow-hidden pointer-events-none">
                <img src="{{ URL::asset($banner->image) }}" class="w-full h-full object-cover filter grayscale" alt="Academic Banner">
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-emerald-500/30 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Industry-Grade Curriculum</span>
                </div>
                
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                    {{ $banner->banner_title }}
                </h1>
                
                <div class="max-w-3xl mx-auto text-lg sm:text-xl text-slate-300 font-normal leading-relaxed">
                    {!! $banner->banner_description !!}
                </div>
            </div>
        </section>

        <!-- Academic Methodology & Value Statement -->
        @if (!empty($banner->body_title))
            <section class="py-16 sm:py-20 relative border-b border-slate-800/80 bg-slate-900/30">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
                    <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Our Pedagogical Framework</div>
                    <h2 class="text-2xl sm:text-4xl font-bold text-white mb-6">
                        {{ $banner->body_title }}
                    </h2>
                    <div class="text-slate-400 text-base sm:text-lg leading-relaxed">
                        {!! $banner->body_description !!}
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!--========================== Interactive Filter Bar & Course Matrix ============================-->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Dynamic Filter Pills -->
            <div class="flex items-center justify-start sm:justify-center gap-2 sm:gap-3 overflow-x-auto pb-6 mb-12 sm:mb-16 scrollbar-none">
                <button type="button" class="course-filter-btn active px-4 py-2 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase bg-emerald-500 text-slate-950 font-semibold transition-all">
                    All Tracks
                </button>
                <button type="button" class="course-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-all">
                    Engineering
                </button>
                <button type="button" class="course-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-all">
                    Cloud & Cyber
                </button>
                <button type="button" class="course-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-mono tracking-wider uppercase bg-slate-900/80 hover:bg-slate-800 text-slate-300 border border-slate-800 transition-all">
                    Product & UI
                </button>
            </div>

            <!-- Asymmetric Modern Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">
                @foreach ($courseData as $index => $content)
                    @php
                        // First item or every 4th item gets featured width (col-span-8)
                        $isFeatured = ($index % 3 == 0);
                    @endphp
                    
                    <div class="{{ $isFeatured ? 'lg:col-span-8' : 'lg:col-span-4' }} group">
                        <a href="{{ url('training/' . $content->course_slug) }}" class="flex flex-col h-full rounded-2xl bg-slate-900/70 border border-slate-800/80 hover:border-emerald-500/40 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                            
                            <!-- Course Preview Image -->
                            <div class="relative w-full {{ $isFeatured ? 'h-64 sm:h-80' : 'h-52' }} overflow-hidden bg-slate-950">
                                <img src="{{ URL::asset($content->image) }}" alt="{{ $content->image_alt }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 filter brightness-95 group-hover:brightness-100">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                                
                                <div class="absolute top-4 left-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-950/80 border border-emerald-500/30 text-xs font-mono text-emerald-400">
                                        <span>Track {{ sprintf('%02d', $index + 1) }}</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Course Details Body -->
                            <div class="p-6 sm:p-8 flex flex-col flex-grow">
                                <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-2">
                                    Academic Training
                                </div>

                                <h3 class="text-xl sm:text-2xl font-bold text-white mb-3 group-hover:text-emerald-400 transition-colors">
                                    {{ $content->course_title }}
                                </h3>

                                <div class="text-slate-400 text-sm leading-relaxed mb-8 flex-grow">
                                    {!! Str::limit(strip_tags($content->short_description), $isFeatured ? 150 : 90) !!}
                                </div>

                                <!-- Card Footer: Fee & Action -->
                                <div class="pt-6 border-t border-slate-800/80 flex items-center justify-between mt-auto">
                                    <div>
                                        <span class="text-[11px] font-mono uppercase tracking-wider text-slate-400 block">Tuition Fee</span>
                                        <div class="text-lg sm:text-xl font-bold font-mono text-white tracking-tight">
                                            {{ $content->price }} <span class="text-xs font-normal text-emerald-400">BDT</span>
                                        </div>
                                    </div>

                                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold tracking-wider uppercase bg-slate-800/80 group-hover:bg-emerald-500 text-slate-200 group-hover:text-slate-950 border border-slate-700/80 group-hover:border-emerald-500 transition-all duration-300">
                                        <span>View Syllabus</span>
                                        <i class="fa fa-arrow-right text-[10px]"></i>
                                    </div>
                                </div>

                            </div>

                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</div>
@endsection
