<!--========================== Get In Touch Banner ============================-->
@php
    $footer = App\model\FooterContent::where('status', 1)
        ->where('active_status', 1)
        ->first();
@endphp

@if (!empty($footer))
    <section class="relative py-24 sm:py-32 overflow-hidden border-t border-slate-800/80">
        <!-- Background Image with Dark Mesh Overlay -->
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ safe_asset($footer->footer_backgroud) }}');">
            <div class="absolute inset-0 bg-slate-950/90 backdrop-blur-sm"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono tracking-wider uppercase mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-ping"></span>
                <span>{{ __('frontend.hero.badge') }}</span>
            </div>
            
            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-6 leading-tight">
                {{ $footer->footer_header }}
            </h2>
            
            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-300 font-normal leading-relaxed mb-10">
                {{ $footer->footer_content }}
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact-us-page') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1">
                    <span>{{ __('frontend.nav.contact') }}</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
@endif

<!--========================== Architectural Multi-Column Footer ============================-->
<footer class="relative bg-slate-950 border-t border-slate-800/80 pt-16 pb-12 overflow-hidden">
    <!-- Ambient Radial Glow -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-brand-primary/5 blur-[120px] pointer-events-none rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 pb-16 border-b border-slate-800/60">
            
            <!-- Column 1: Brand & Manifesto (Col 4) -->
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <a href="{{ route('home-page') }}" class="inline-block mb-6">
                        <img src="{{ safe_asset('frontend/image/wict-logo.png') }}" alt="{{ app_setting('site_title', 'Wake Up ICT') }}" class="h-10 w-auto object-contain">
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-6">
                        {{ app_setting('site_tagline', __('frontend.footer.tagline')) }}
                    </p>
                </div>
                
                <div class="flex items-center gap-3">
                    @if(app_setting('social_facebook', 'https://facebook.com/wakeupict'))
                        <a href="{{ app_setting('social_facebook', 'https://facebook.com/wakeupict') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-brand-primary hover:border-brand-primary/40 transition-all duration-200" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    @endif
                    @if(app_setting('social_linkedin', 'https://linkedin.com/company/wakeupict'))
                        <a href="{{ app_setting('social_linkedin', 'https://linkedin.com/company/wakeupict') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-brand-primary hover:border-brand-primary/40 transition-all duration-200" aria-label="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    @endif
                    @if(app_setting('social_youtube'))
                        <a href="{{ app_setting('social_youtube') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-brand-primary hover:border-brand-primary/40 transition-all duration-200" aria-label="YouTube">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Links (Col 2) -->
            <div class="lg:col-span-2">
                <h4 class="text-xs font-mono uppercase tracking-widest text-brand-primary mb-6 font-semibold">
                    {{ __('frontend.footer.quick_links') }}
                </h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('about-page') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.about') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('academic-training') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.courses') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services-page') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.services') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('our-blogs') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.blog') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('facebook-posts') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.facebook_posts') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center gap-2">
                            <span>{{ __('frontend.nav.login') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Platform Capabilities (Col 3) -->
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-brand-primary mb-6 font-semibold">
                    {{ __('frontend.footer.programs') }}
                </h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                        <span>{{ __('frontend.footer.track_1') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                        <span>{{ __('frontend.footer.track_2') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                        <span>{{ __('frontend.footer.track_3') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                        <span>{{ __('frontend.footer.track_4') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                        <span>{{ __('frontend.footer.track_5') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact & Headquarters (Col 3) -->
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-brand-primary mb-6 font-semibold">
                    {{ __('frontend.footer.contact_info') }}
                </h4>
                <div class="space-y-4 text-sm text-slate-400">
                    <div class="flex items-start gap-3">
                        <i class="fa fa-map-marker text-brand-primary mt-1"></i>
                        <span>{{ app_setting('contact_address', App::getLocale() == 'bn' ? 'নান্নু টাওয়ার (৩য় তলা), পান্না চত্বর, রাজবাড়ী, বাংলাদেশ' : 'Nannu Tower, 2nd Floor, Panna Chatter, Rajbari, Bangladesh') }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa fa-envelope text-brand-primary"></i>
                        <a href="mailto:{{ app_setting('contact_email', 'info@wakeupict.com') }}" class="hover:text-white transition-colors">
                            {{ app_setting('contact_email', 'info@wakeupict.com') }}
                        </a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa fa-phone text-brand-primary"></i>
                        <a href="tel:{{ app_setting('contact_phone', '+8801791612121') }}" class="hover:text-white transition-colors">
                            {{ app_setting('contact_phone', '+88 01791612121') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sub-Footer / Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-slate-500">
            @php
                $currentYear = Carbon\Carbon::now()->format('Y');
            @endphp
            <p>{{ app_setting('footer_copyright', "© {$currentYear} Wake Up ICT. " . __('frontend.footer.rights')) }}</p>
            <div class="flex items-center gap-6">
                <span>{{ __('frontend.footer.sub_footer_1') }}</span>
                <span class="w-1 h-1 rounded-full bg-slate-700"></span>
                <span>{{ __('frontend.footer.sub_footer_2') }}</span>
            </div>
        </div>
    </div>
</footer>
