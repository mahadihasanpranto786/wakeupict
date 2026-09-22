<!-- Sticky Floating Navigation Header with Dynamic Theme Colors, Global Theme Switcher & Multi-Language Switcher -->
<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="relative flex items-center justify-between px-4 py-2.5 sm:px-6 rounded-2xl bg-slate-950/85 backdrop-blur-xl border border-slate-800/80 shadow-2xl transition-all duration-300">
            
            <!-- Brand Logo -->
            <a href="{{ route('home-page') }}" class="flex items-center gap-3 group focus:outline-none">
                <img src="{{ safe_asset('frontend/image/wict-logo.png') }}" alt="{{ app_setting('site_title', 'Wake Up ICT') }}" class="h-9 sm:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1 font-medium text-sm text-slate-300">
                <a href="{{ route('home-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('home-page') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    {{ __('frontend.nav.home') }}
                </a>
                <a href="{{ route('about-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('about-page') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    {{ __('frontend.nav.about') }}
                </a>
                <a href="{{ route('academic-training') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('academic-training') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    {{ __('frontend.nav.courses') }}
                </a>
                <a href="{{ route('services-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('services-page') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    {{ __('frontend.nav.services') }}
                </a>
                <a href="{{ route('our-blogs') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('our-blogs*') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    {{ __('frontend.nav.blog') }}
                </a>
                <a href="{{ route('facebook-posts') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('facebook-posts') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                    <i class="fa fa-facebook-square mr-1 text-blue-400"></i>
                    {{ __('frontend.nav.facebook_posts') }}
                </a>

                @php
                    $post = App\model\TalentHunt::orderBy('id', 'asc')->first();
                @endphp

                @if (isset($post) && $post->status == 1)
                    <a href="{{ route('talent-hunt') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('talent-hunt') ? 'text-brand-primary font-semibold bg-slate-800/50' : '' }}">
                        Talent Hunt
                    </a>
                @endif
            </nav>

            <!-- CTA Action, Theme Switcher & Language Switcher (Desktop) -->
            <div class="hidden lg:flex items-center gap-2.5">
                <!-- Global Theme Switcher Dropdown Button -->
                <div class="relative">
                    <button type="button" id="theme-toggle-btn" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-900 border border-slate-700/80 text-xs font-mono text-slate-300 hover:text-white transition-colors focus:outline-none" title="Switch Theme (Light / Dark / Dynamic)">
                        <span id="theme-icon-dark" class="hidden items-center gap-1.5"><i class="fa fa-moon-o text-brand-primary"></i> Dark</span>
                        <span id="theme-icon-light" class="flex items-center gap-1.5"><i class="fa fa-sun-o text-amber-400"></i> Light</span>
                        <span id="theme-icon-custom" class="hidden items-center gap-1.5"><i class="fa fa-magic text-brand-cyan"></i> Dynamic</span>
                        <i class="fa fa-angle-down text-[10px] text-slate-500 ml-0.5"></i>
                    </button>

                    <div id="theme-dropdown" class="hidden absolute right-0 mt-2 w-44 rounded-xl bg-slate-950 border border-slate-800 shadow-2xl p-1.5 z-50 text-xs font-medium backdrop-blur-xl">
                        <button type="button" onclick="setAppTheme('dark')" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors text-left">
                            <i class="fa fa-moon-o text-brand-primary w-4"></i>
                            <span>Dark Mode</span>
                        </button>
                        <button type="button" onclick="setAppTheme('light')" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors text-left">
                            <i class="fa fa-sun-o text-amber-400 w-4"></i>
                            <span>Light Mode</span>
                        </button>
                        <button type="button" onclick="setAppTheme('custom')" class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-slate-300 hover:bg-slate-800/80 hover:text-white transition-colors text-left">
                            <i class="fa fa-magic text-brand-cyan w-4"></i>
                            <span>Custom Dynamic</span>
                        </button>
                    </div>
                </div>

                <!-- Global Language Switcher Pill -->
                <div class="flex items-center rounded-xl bg-slate-900 border border-slate-700/80 p-1 text-xs font-mono font-medium">
                    <a href="{{ route('language.switch', 'en') }}" class="px-2.5 py-1 rounded-lg transition-colors {{ App::getLocale() == 'en' ? 'bg-brand-primary text-slate-950 font-bold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                        EN
                    </a>
                    <span class="text-slate-600 px-1">|</span>
                    <a href="{{ route('language.switch', 'bn') }}" class="px-2.5 py-1 rounded-lg transition-colors {{ App::getLocale() == 'bn' ? 'bg-brand-primary text-slate-950 font-bold shadow-sm' : 'text-slate-400 hover:text-white' }}">
                        বাং
                    </a>
                </div>

                <!-- Contact CTA Button -->
                <a href="{{ route('contact-us-page') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold text-xs tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 hover:shadow-glow-emerald hover:-translate-y-0.5 active:translate-y-0">
                    <span>{{ __('frontend.nav.contact') }}</span>
                    <i class="fa fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <!-- Mobile Controls -->
            <div class="flex lg:hidden items-center gap-2">
                <!-- Mobile Theme Toggle -->
                <button type="button" onclick="cycleThemeMobile()" class="p-2 rounded-lg bg-slate-900 border border-slate-700 text-slate-300 text-xs focus:outline-none" title="Toggle Theme">
                    <i id="mobile-theme-icon" class="fa fa-moon-o text-brand-primary"></i>
                </button>

                <!-- Mobile Language Pill -->
                <div class="flex items-center rounded-lg bg-slate-900 border border-slate-700 p-0.5 text-xs font-mono">
                    <a href="{{ route('language.switch', 'en') }}" class="px-2 py-0.5 rounded {{ App::getLocale() == 'en' ? 'bg-brand-primary text-slate-950 font-bold' : 'text-slate-400' }}">EN</a>
                    <span class="text-slate-600 px-0.5">|</span>
                    <a href="{{ route('language.switch', 'bn') }}" class="px-2 py-0.5 rounded {{ App::getLocale() == 'bn' ? 'bg-brand-primary text-slate-950 font-bold' : 'text-slate-400' }}">বাং</a>
                </div>

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
            <a href="{{ route('home-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span>{{ __('frontend.nav.home') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('about-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span>{{ __('frontend.nav.about') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('academic-training') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span>{{ __('frontend.nav.courses') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('services-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span>{{ __('frontend.nav.services') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('our-blogs') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span>{{ __('frontend.nav.blog') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('facebook-posts') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                <span><i class="fa fa-facebook-square mr-2 text-blue-400"></i>{{ __('frontend.nav.facebook_posts') }}</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>

            @if (isset($post) && $post->status == 1)
                <a href="{{ route('talent-hunt') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-brand-primary font-medium transition-colors">
                    <span>Talent Hunt</span>
                    <i class="fa fa-angle-right text-slate-500"></i>
                </a>
            @endif

            <div class="pt-4 mt-2 border-t border-slate-800">
                <a href="{{ route('contact-us-page') }}" class="flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald">
                    <span>{{ __('frontend.nav.contact') }}</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    // Theme Switcher Functions
    function setAppTheme(theme) {
        localStorage.setItem('theme_mode', theme);
        document.cookie = "theme_mode=" + theme + "; path=/; max-age=" + (365*24*60*60);

        if (theme === 'light') {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        } else {
            document.documentElement.classList.remove('light');
            document.documentElement.classList.add('dark');
        }

        updateThemeUI(theme);
        var dd = document.getElementById('theme-dropdown');
        if (dd) dd.classList.add('hidden');
    }

    function updateThemeUI(theme) {
        var darkIcon = document.getElementById('theme-icon-dark');
        var lightIcon = document.getElementById('theme-icon-light');
        var customIcon = document.getElementById('theme-icon-custom');
        var mobIcon = document.getElementById('mobile-theme-icon');

        if (!darkIcon) return;

        darkIcon.classList.add('hidden');
        lightIcon.classList.add('hidden');
        customIcon.classList.add('hidden');

        if (theme === 'light') {
            lightIcon.classList.remove('hidden');
            lightIcon.classList.add('flex');
            if (mobIcon) mobIcon.className = 'fa fa-sun-o text-amber-400';
        } else if (theme === 'custom') {
            customIcon.classList.remove('hidden');
            customIcon.classList.add('flex');
            if (mobIcon) mobIcon.className = 'fa fa-magic text-brand-cyan';
        } else {
            darkIcon.classList.remove('hidden');
            darkIcon.classList.add('flex');
            if (mobIcon) mobIcon.className = 'fa fa-moon-o text-brand-primary';
        }
    }

    function cycleThemeMobile() {
        var cur = localStorage.getItem('theme_mode') || 'light';
        if (cur === 'light') setAppTheme('dark');
        else if (cur === 'dark') setAppTheme('custom');
        else setAppTheme('light');
    }

    document.addEventListener('DOMContentLoaded', function () {
        var curTheme = localStorage.getItem('theme_mode') || 'light';
        updateThemeUI(curTheme);

        var toggleBtn = document.getElementById('theme-toggle-btn');
        var dropdown = document.getElementById('theme-dropdown');

        if (toggleBtn && dropdown) {
            toggleBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function () {
                dropdown.classList.add('hidden');
            });
        }

        // Mobile Menu Toggle
        var btn = document.getElementById('mobile-menu-btn');
        var menu = document.getElementById('mobile-menu');
        var hamburger = document.getElementById('hamburger-icon');
        var close = document.getElementById('close-icon');

        if (btn && menu) {
            btn.addEventListener('click', function () {
                var isOpen = !menu.classList.contains('hidden');
                if (isOpen) {
                    menu.classList.add('hidden');
                    hamburger.classList.remove('hidden');
                    close.classList.add('hidden');
                } else {
                    menu.classList.remove('hidden');
                    hamburger.classList.add('hidden');
                    close.classList.remove('hidden');
                }
            });
        }
    });
</script>
