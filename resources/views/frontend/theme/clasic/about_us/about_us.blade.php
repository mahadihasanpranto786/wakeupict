@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen">

    <!--========================== Hero Banner ============================-->
    @if (!empty($banner->image))
        <section class="relative min-h-[55vh] sm:min-h-[65vh] flex items-center justify-center pt-32 pb-20 overflow-hidden bg-grid-mesh border-b border-slate-800/80">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-emerald-500/10 blur-[130px] pointer-events-none rounded-full"></div>

            <div class="absolute inset-0 z-0 opacity-15 mix-blend-luminosity overflow-hidden pointer-events-none">
                <img src="{{ URL::asset($banner->image) }}" class="w-full h-full object-cover filter grayscale" alt="About Banner">
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-emerald-500/30 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Our DNA & Purpose</span>
                </div>
                
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                    {{ $banner->title }}
                </h1>
                
                <div class="max-w-3xl mx-auto text-lg sm:text-xl text-slate-300 font-normal leading-relaxed">
                    {!! $banner->description !!}
                </div>
            </div>
        </section>
    @endif

    <!--========================== Story / History Timeline ============================-->
    @if (!empty($history->image))
        <section class="py-24 sm:py-32 relative border-b border-slate-800/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                    
                    <!-- Left: Story Narrative with Timeline Accent -->
                    <div class="lg:col-span-6 border-l-2 border-emerald-500/40 pl-8 relative">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-slate-950 border-2 border-emerald-400"></div>
                        
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Our Genesis</div>
                        <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white leading-tight mb-6">
                            {{ $history->title }}
                        </h2>
                        
                        <div class="text-slate-300 text-base sm:text-lg leading-relaxed space-y-4">
                            {!! $history->description !!}
                        </div>
                    </div>

                    <!-- Right: Asymmetric Architecture Visual -->
                    <div class="lg:col-span-6 relative">
                        <div class="relative rounded-2xl overflow-hidden bg-slate-900 border border-slate-800 shadow-2xl">
                            <img src="{{ URL::asset($history->image) }}" alt="{{ $history->image_alt }}" class="w-full h-auto object-cover filter contrast-105">
                            <div class="absolute inset-0 bg-gradient-to-tr from-slate-950/60 via-transparent to-transparent pointer-events-none"></div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    <!--========================== Team Section ============================-->
    <section class="py-24 sm:py-32 relative bg-slate-900/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-20">
                <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">Intellectual Capital</div>
                <h2 class="text-3xl sm:text-5xl font-bold tracking-tight text-white mb-4">
                    Wake Up ICT Leadership & Team
                </h2>
                <p class="text-slate-400 text-base leading-relaxed">
                    A multidisciplinary collective of architects, technologists, and educators pioneering digital engineering standards.
                </p>
            </div>

            <!-- Leadership / Chairman Card -->
            @if (!empty($chairmanSir->image))
                <div class="max-w-md mx-auto mb-20">
                    <div class="rounded-2xl bg-slate-900/80 border border-slate-800/90 p-8 text-center backdrop-blur-xl shadow-2xl hover:border-emerald-500/40 transition-all duration-300 group">
                        <div class="relative w-36 h-36 mx-auto mb-6 rounded-full overflow-hidden border-4 border-slate-800 group-hover:border-emerald-500 transition-colors">
                            <img src="{{ URL::asset($chairmanSir->image) }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500" alt="{{ $chairmanSir->image_alt }}">
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-1">{{ $chairmanSir->name }}</h3>
                        <p class="text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold">{{ $chairmanSir->designation }}</p>
                    </div>
                </div>
            @endif

            <!-- Core Team Grid (Grayscale to Color Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-24">
                @foreach ($abouts as $index => $about)
                    <a href="{{ $about->slug == null ? '#' : url('members/' . $about->slug) }}" class="group block rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 p-6 text-center backdrop-blur-md transition-all duration-300 hover:shadow-card-dark hover:-translate-y-1">
                        <div class="w-28 h-28 mx-auto mb-4 rounded-full overflow-hidden border-2 border-slate-800 group-hover:border-emerald-400 transition-colors">
                            <img src="{{ URL::asset($about->image) }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500" alt="{{ $about->image_alt }}">
                        </div>
                        <h4 class="text-base font-bold text-white mb-1 group-hover:text-emerald-400 transition-colors">{{ $about->name }}</h4>
                        <p class="text-xs font-mono text-slate-400 uppercase tracking-wide">{{ $about->designation }}</p>
                    </a>
                @endforeach
            </div>

            <!-- Interns Cohort -->
            @if (!empty($interns) && count($interns) > 0)
                <div class="pt-12 border-t border-slate-800/80 mb-24">
                    <div class="text-center mb-12">
                        <h3 class="text-2xl font-bold text-white mb-2">Our Engineering Interns</h3>
                        <p class="text-xs font-mono uppercase tracking-wider text-cyan-400">Rising Tech Talent</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($interns as $index => $intern)
                            <a href="{{ $intern->slug == null ? '#' : url('members/' . $intern->slug) }}" class="group block rounded-xl bg-slate-900/40 border border-slate-800/60 hover:border-cyan-500/40 p-5 text-center transition-all duration-300 hover:-translate-y-1">
                                <div class="w-20 h-20 mx-auto mb-3 rounded-full overflow-hidden border border-slate-700 group-hover:border-cyan-400 transition-colors">
                                    <img src="{{ URL::asset($intern->image) }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500" alt="{{ $intern->image_alt }}">
                                </div>
                                <h5 class="text-sm font-bold text-white mb-1 group-hover:text-cyan-400 transition-colors">{{ $intern->name }}</h5>
                                <p class="text-[11px] font-mono text-slate-400 uppercase">{{ $intern->designation }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Former Colleagues -->
            @if (!empty($oldEmployees) && count($oldEmployees) > 0)
                <div class="pt-12 border-t border-slate-800/80">
                    <div class="text-center mb-12">
                        <h3 class="text-2xl font-bold text-white mb-2">Alumni & Former Colleagues</h3>
                        <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Part of Our Legacy</p>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($oldEmployees as $index => $about)
                            <a href="{{ $about->slug == null ? '#' : url('members/' . $about->slug) }}" class="group block rounded-xl bg-slate-900/40 border border-slate-800/60 hover:border-slate-700 p-5 text-center transition-all duration-300 hover:-translate-y-1">
                                <div class="w-20 h-20 mx-auto mb-3 rounded-full overflow-hidden border border-slate-700 transition-colors">
                                    <img src="{{ URL::asset($about->image) }}" class="w-full h-full object-cover filter grayscale group-hover:grayscale-0 transition-all duration-500" alt="{{ $about->image_alt }}">
                                </div>
                                <h5 class="text-sm font-bold text-white mb-1 group-hover:text-white transition-colors">{{ $about->name }}</h5>
                                <p class="text-[11px] font-mono text-slate-400 uppercase">{{ $about->designation }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!--========================== High-Impact Dark CTA ============================-->
    <section class="py-20 relative border-t border-slate-800/80 bg-gradient-to-b from-slate-950 to-slate-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-3xl sm:text-5xl font-extrabold text-white mb-6 leading-tight">
                Are you Dedicated, Hardworking, and Fun? Join Us!
            </h2>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8">
                Wake Up ICT Academy is an accomplished training and service providing company delivering high-velocity, innovative solutions.
            </p>
            <a href="{{ route('contact-us-page') }}" class="inline-flex items-center gap-3 px-8 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                <span>Get In Touch With Leadership</span>
                <i class="fa fa-arrow-right text-xs"></i>
            </a>
        </div>
    </section>

</div>
@endsection
