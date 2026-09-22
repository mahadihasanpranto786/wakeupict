@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen">

    <!--========================== Hero Banner ============================-->
    @if (!empty($banner->image))
        <section class="relative min-h-[55vh] sm:min-h-[65vh] flex items-center justify-center pt-32 pb-20 overflow-hidden bg-grid-mesh border-b border-slate-800/80">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[350px] bg-cyan-500/10 blur-[130px] pointer-events-none rounded-full"></div>

            <div class="absolute inset-0 z-0 opacity-15 mix-blend-luminosity overflow-hidden pointer-events-none">
                <img src="{{ URL::asset($banner->image) }}" class="w-full h-full object-cover filter grayscale" alt="Services Banner">
            </div>

            <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-cyan-500/30 text-cyan-400 text-xs font-mono tracking-wider uppercase mb-6 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-ping"></span>
                    <span>{{ __('frontend.services.capabilities_badge') }}</span>
                </div>
                
                <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-white leading-tight mb-6">
                    {{ $banner->banner_title }}
                </h1>
                
                <div class="max-w-3xl mx-auto text-lg sm:text-xl text-slate-300 font-normal leading-relaxed">
                    {!! $banner->banner_description !!}
                </div>
            </div>
        </section>

        <!-- Services Methodology Intro -->
        @if (!empty($banner->body_title))
            <section class="py-16 sm:py-20 relative border-b border-slate-800/80 bg-slate-900/30">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
                    <div class="text-xs font-mono uppercase tracking-widest text-cyan-400 font-semibold mb-3">{{ __('frontend.services.methodology_badge') }}</div>
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

    <!--========================== Enterprise Matrix Layout ============================-->
    <section class="py-20 sm:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
                
                <!-- Left Column: Sticky Anchor Feature & Partnership Pitch (Cols 4) -->
                <div class="lg:col-span-4 lg:sticky lg:top-32">
                    <div class="p-8 rounded-2xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-xl shadow-2xl">
                        <div class="text-xs font-mono uppercase tracking-widest text-emerald-400 font-semibold mb-3">
                            {{ __('frontend.services.full_stack_badge') }}
                        </div>
                        <h3 class="text-2xl sm:text-4xl font-bold text-white mb-6 leading-tight">
                            {{ __('frontend.services.solutions_title') }}
                        </h3>
                        <p class="text-slate-400 text-sm sm:text-base leading-relaxed mb-8">
                            {{ __('frontend.services.solutions_sub') }}
                        </p>

                        <!-- Methodology Step Indicators -->
                        <div class="space-y-4 mb-8 pt-6 border-t border-slate-800/80 font-mono text-xs text-slate-300">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-lg bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center font-bold">1</span>
                                <span>{{ __('frontend.services.step_1') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-lg bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center font-bold">2</span>
                                <span>{{ __('frontend.services.step_2') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-lg bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 flex items-center justify-center font-bold">3</span>
                                <span>{{ __('frontend.services.step_3') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('contact-us-page') }}" class="btn-shimmer flex items-center justify-center gap-3 w-full py-4 px-6 rounded-xl font-semibold text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                            <span>{{ __('frontend.services.partner_btn') }}</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Staggered Interactive Service Cards (Cols 8) -->
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($services as $index => $service)
                            <div class="group relative rounded-2xl bg-slate-900/60 border border-slate-800/80 hover:border-emerald-500/40 p-8 backdrop-blur-md overflow-hidden transition-all duration-300 hover:shadow-card-dark card-interactive-glow reveal-on-scroll stagger-{{ ($index % 2) + 1 }} flex flex-col justify-between {{ $index % 2 != 0 ? 'md:translate-y-8' : '' }}">
                                
                                <!-- Decorative Faint Background Icon -->
                                <div class="absolute -right-6 -bottom-6 text-8xl text-slate-800/30 pointer-events-none transition-transform duration-500 group-hover:scale-110">
                                    <i class="{{ $service->logo }}"></i>
                                </div>

                                <div class="relative z-10">
                                    <!-- Icon Badge -->
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-2xl mb-6 group-hover:bg-emerald-500 group-hover:text-slate-950 transition-all duration-300">
                                        <i class="{{ $service->logo }}"></i>
                                    </div>

                                    <h4 class="text-xl sm:text-2xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors">
                                        {{ $service->title }}
                                    </h4>

                                    <div class="text-slate-400 text-sm leading-relaxed mb-6">
                                        {!! $service->description !!}
                                    </div>
                                </div>

                                <div class="relative z-10 pt-6 border-t border-slate-800/80">
                                    <a href="{{ route('contact-us-page') }}" class="inline-flex items-center gap-2 text-xs font-mono uppercase tracking-wider text-emerald-400 font-semibold group-hover:translate-x-1 transition-transform">
                                        <span>{{ __('frontend.services.consult_btn') }}</span>
                                        <i class="fa fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
