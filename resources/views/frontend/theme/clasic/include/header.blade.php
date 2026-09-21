<!-- Sticky Floating Navigation Header -->
<header id="main-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="relative flex items-center justify-between px-4 py-2.5 sm:px-6 rounded-2xl bg-slate-950/75 backdrop-blur-xl border border-slate-800/80 shadow-2xl transition-all duration-300">
            
            <!-- Brand Logo -->
            <a href="{{ route('home-page') }}" class="flex items-center gap-3 group focus:outline-none">
                <img src="{{ URL::asset('frontend/image/wict-logo.png') }}" alt="Wake Up ICT Logo" class="h-9 sm:h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Navigation Links -->
            <nav class="hidden lg:flex items-center gap-1 font-medium text-sm text-slate-300">
                <a href="{{ route('home-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('home-page') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                    Home
                </a>
                <a href="{{ route('about-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('about-page') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                    About Us
                </a>
                <a href="{{ route('academic-training') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('academic-training') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                    Academic Training
                </a>
                <a href="{{ route('services-page') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('services-page') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                    Services
                </a>
                <a href="{{ route('our-blogs') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('our-blogs*') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                    Our Blogs
                </a>

                @php
                    $post = App\model\TalentHunt::orderBy('id', 'asc')->first();
                @endphp

                @if (isset($post) && $post->status == 1)
                    <a href="{{ route('talent-hunt') }}" class="px-3.5 py-2 rounded-xl transition-all duration-200 hover:text-white hover:bg-slate-800/60 {{ request()->routeIs('talent-hunt') ? 'text-emerald-400 font-semibold bg-slate-800/40' : '' }}">
                        Talent Hunt
                    </a>
                @endif
            </nav>

            <!-- CTA Action Button (Desktop) -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('contact-us-page') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-medium text-xs tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 hover:shadow-glow-emerald hover:-translate-y-0.5 active:translate-y-0">
                    <span>Get A Quote</span>
                    <i class="fa fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <!-- Mobile Hamburger Toggle Button -->
            <div class="flex lg:hidden items-center">
                <button id="mobile-menu-btn" type="button" class="inline-flex items-center justify-center p-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 focus:outline-none" aria-label="Toggle navigation">
                    <i id="hamburger-icon" class="fa fa-bars text-lg"></i>
                    <i id="close-icon" class="fa fa-times text-lg hidden"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Full-Screen / Overlay Navigation -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-x-4 top-20 rounded-2xl bg-slate-950/95 backdrop-blur-2xl border border-slate-800 shadow-2xl p-6 transition-all duration-300 z-50">
        <nav class="flex flex-col space-y-2">
            <a href="{{ route('home-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                <span>Home</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('about-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                <span>About Us</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('academic-training') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                <span>Academic Training</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('services-page') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                <span>Services</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>
            <a href="{{ route('our-blogs') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                <span>Our Blogs</span>
                <i class="fa fa-angle-right text-slate-500"></i>
            </a>

            @if (isset($post) && $post->status == 1)
                <a href="{{ route('talent-hunt') }}" class="mobile-nav-link flex items-center justify-between px-4 py-3 rounded-xl text-slate-200 hover:bg-slate-800/80 hover:text-emerald-400 font-medium transition-colors">
                    <span>Talent Hunt</span>
                    <i class="fa fa-angle-right text-slate-500"></i>
                </a>
            @endif

            <div class="pt-4 mt-2 border-t border-slate-800">
                <a href="{{ route('contact-us-page') }}" class="flex items-center justify-center gap-2 w-full py-3 px-4 rounded-xl font-medium text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all shadow-glow-emerald">
                    <span>Get A Quote</span>
                    <i class="fa fa-arrow-right text-xs"></i>
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const header = document.getElementById('main-header');
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        // Scroll glassmorphism effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                header.classList.add('py-2');
                header.classList.remove('py-3');
            } else {
                header.classList.add('py-3');
                header.classList.remove('py-2');
            }
        });

        // Mobile menu toggle
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                const isExpanded = !mobileMenu.classList.contains('hidden');
                if (isExpanded) {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                } else {
                    mobileMenu.classList.remove('hidden');
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                }
            });

            // Close on nav click
            const links = mobileMenu.querySelectorAll('a');
            links.forEach(l => {
                l.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                    hamburgerIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                });
            });
        }
    });
</script>
