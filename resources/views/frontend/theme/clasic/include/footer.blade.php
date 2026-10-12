<!--========================== Get In Touch Banner ============================-->
@php
    $footer = App\model\FooterContent::where('status', 1)
        ->where('active_status', 1)
        ->first();
@endphp

@if (!empty($footer))
    <section class="get-in-touch-section relative py-20 sm:py-28 overflow-hidden border-t border-slate-200 dark:border-slate-800/80">
        <!-- Background Image with Adaptive Overlay -->
        <div class="absolute inset-0 z-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ safe_asset($footer->footer_backgroud) }}');">
            <!-- Light mode: Frosted crisp overlay | Dark mode: Deep midnight mesh -->
            <div class="absolute inset-0 bg-slate-50/95 dark:bg-slate-950/90 backdrop-blur-sm"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-slate-50/80 dark:from-slate-950 dark:via-transparent dark:to-slate-950/80"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-brand-primary text-xs font-mono tracking-wider uppercase mb-6 font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                <span>{{ __('frontend.hero.badge') }}</span>
            </div>
            
            <h2 class="text-3xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 dark:text-white mb-6 leading-tight">
                {{ $footer->footer_header }}
            </h2>
            
            <p class="max-w-2xl mx-auto text-base sm:text-lg text-slate-600 dark:text-slate-300 font-normal leading-relaxed mb-10">
                {{ $footer->footer_content }}
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('contact-us-page') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-bold text-sm tracking-wider uppercase bg-emerald-600 hover:bg-emerald-500 text-white dark:bg-brand-primary dark:hover:bg-brand-accent dark:text-slate-950 transition-all duration-300 shadow-lg hover:-translate-y-1">
                    <span>{{ __('frontend.nav.contact') }}</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>
@endif

<!--========================== Architectural Multi-Column Footer ============================-->
<footer class="site-footer relative bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800/80 pt-16 pb-12 overflow-hidden text-slate-700 dark:text-slate-300">
    <!-- Ambient Radial Glow -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-emerald-500/5 blur-[120px] pointer-events-none rounded-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-12 pb-16 border-b border-slate-200 dark:border-slate-800/80">
            
            <!-- Column 1: Brand & Manifesto (Col 4) -->
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <a href="{{ route('home-page') }}" class="inline-block mb-6">
                        <img src="{{ safe_asset('frontend/image/wict-logo.png') }}" alt="{{ app_setting('site_title', 'Wake Up ICT') }}" class="h-10 w-auto object-contain">
                    </a>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed max-w-sm mb-6 font-normal">
                        {{ app_setting('site_tagline', __('frontend.footer.tagline')) }}
                    </p>
                </div>
                
                <div class="flex items-center gap-3">
                    @if(app_setting('social_facebook', 'https://facebook.com/wakeupict'))
                        <a href="{{ app_setting('social_facebook', 'https://facebook.com/wakeupict') }}" target="_blank" rel="noopener noreferrer" class="social-icon w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-700 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:border-emerald-500/40 transition-all duration-200" aria-label="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                    @endif
                    @if(app_setting('social_linkedin', 'https://linkedin.com/company/wakeupict'))
                        <a href="{{ app_setting('social_linkedin', 'https://linkedin.com/company/wakeupict') }}" target="_blank" rel="noopener noreferrer" class="social-icon w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-700 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:border-emerald-500/40 transition-all duration-200" aria-label="LinkedIn">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    @endif
                    @if(app_setting('social_youtube'))
                        <a href="{{ app_setting('social_youtube') }}" target="_blank" rel="noopener noreferrer" class="social-icon w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-700 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:border-emerald-500/40 transition-all duration-200" aria-label="YouTube">
                            <i class="fa fa-youtube-play"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Links (Col 2) (Dynamically Managed from Backend) -->
            @php
                $footerQuickMenus = \App\Services\FrontendMenuService::getTree('footer_quick');
            @endphp
            <div class="lg:col-span-2">
                <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-6 font-bold">
                    {{ __('frontend.footer.quick_links') }}
                </h4>
                <ul class="space-y-3 text-sm">
                    @foreach($footerQuickMenus as $fMenu)
                        <li>
                            <a href="{{ $fMenu->resolveUrl() }}" target="{{ $fMenu->target }}" class="text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-white transition-colors duration-200 flex items-center gap-2">
                                @if($fMenu->icon)
                                    <i class="{{ $fMenu->icon }} text-xs text-emerald-600 dark:text-emerald-400"></i>
                                @endif
                                <span>{{ $fMenu->getTitle() }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Column 3: Platform Capabilities (Col 3) -->
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-6 font-bold">
                    {{ __('frontend.footer.programs') }}
                </h4>
                <ul class="space-y-3 text-sm text-slate-700 dark:text-slate-300">
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                        <span>{{ __('frontend.footer.track_1') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                        <span>{{ __('frontend.footer.track_2') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                        <span>{{ __('frontend.footer.track_3') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                        <span>{{ __('frontend.footer.track_4') }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                        <span>{{ __('frontend.footer.track_5') }}</span>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact & Headquarters (Col 3) -->
            <div class="lg:col-span-3">
                <h4 class="text-xs font-mono uppercase tracking-widest text-emerald-700 dark:text-emerald-400 mb-6 font-bold">
                    {{ __('frontend.footer.contact_info') }}
                </h4>
                <div class="space-y-4 text-sm text-slate-700 dark:text-slate-300">
                    <div class="flex items-start gap-3">
                        <i class="fa fa-map-marker text-emerald-600 dark:text-emerald-400 mt-1"></i>
                        <span>{{ app_setting('contact_address', App::getLocale() == 'bn' ? 'নান্নু টাওয়ার (৩য় তলা), পান্না চত্বর, রাজবাড়ী, বাংলাদেশ' : 'Nannu Tower, 2nd Floor, Panna Chatter, Rajbari, Bangladesh') }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa fa-envelope text-emerald-600 dark:text-emerald-400"></i>
                        <a href="mailto:{{ app_setting('contact_email', 'info@wakeupict.com') }}" class="text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:white transition-colors">
                            {{ app_setting('contact_email', 'info@wakeupict.com') }}
                        </a>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fa fa-phone text-emerald-600 dark:text-emerald-400"></i>
                        <a href="tel:{{ app_setting('contact_phone', '+8801791612121') }}" class="text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:white transition-colors">
                            {{ app_setting('contact_phone', '+88 01791612121') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sub-Footer / Copyright -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-mono text-slate-600 dark:text-slate-400">
            @php
                $currentYear = Carbon\Carbon::now()->format('Y');
            @endphp
            <p>{{ app_setting('footer_copyright', "© {$currentYear} Wake Up ICT. " . __('frontend.footer.rights')) }}</p>
            <div class="flex items-center gap-6 text-slate-600 dark:text-slate-400">
                <span>{{ __('frontend.footer.sub_footer_1') }}</span>
                <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                <span>{{ __('frontend.footer.sub_footer_2') }}</span>
            </div>
        </div>
    </div>
</footer>
