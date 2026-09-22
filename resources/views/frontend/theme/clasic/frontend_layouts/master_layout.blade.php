<!DOCTYPE html>
@php
    $initialTheme = isset($_COOKIE['theme_mode']) ? $_COOKIE['theme_mode'] : 'dark';
@endphp
<html lang="{{ App::getLocale() }}" class="{{ $initialTheme }} scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Immediate Theme Application (Zero FOUT) -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme_mode') || '{{ $initialTheme }}';
            if (savedTheme === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts: Plus Jakarta Sans, Inter, JetBrains Mono, Hind Siliguri -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Dynamic Theme Palette CSS Variables -->
    <style>
        :root {
            --brand-primary: {{ app_setting('theme_primary_color', '#10b981') }};
            --brand-primary-rgb: {{ app_setting('theme_primary_rgb', '16, 185, 129') }};
            --brand-accent: {{ app_setting('theme_accent_color', '#34d399') }};
            --brand-accent-rgb: {{ app_setting('theme_accent_rgb', '52, 211, 153') }};
            --brand-cyan: {{ app_setting('theme_cyan_color', '#22d3ee') }};
            --brand-indigo: {{ app_setting('theme_indigo_color', '#6366f1') }};
        }
        body {
            background-color: #030712;
            color: #f1f5f9;
            font-family: {{ App::getLocale() == 'bn' ? "'Hind Siliguri', 'Plus Jakarta Sans', sans-serif" : "'Plus Jakarta Sans', 'Inter', sans-serif" }};
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Utility Theme Classes */
        .theme-glow-primary {
            box-shadow: 0 0 30px -5px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.35);
        }
        .theme-border-primary {
            border-color: var(--brand-primary, #10b981);
        }
        .theme-text-primary {
            color: var(--brand-primary, #10b981);
        }
        .theme-bg-primary {
            background-color: var(--brand-primary, #10b981);
        }
        .theme-bg-primary-dim {
            background-color: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.12);
        }

        /* Light Mode Enterprise Overrides */
        html.light body {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        html.light .bg-slate-950,
        html.light .bg-slate-900 {
            background-color: #ffffff !important;
        }
        html.light .bg-slate-900\/60,
        html.light .bg-slate-900\/80,
        html.light .bg-slate-900\/40,
        html.light .bg-slate-900\/30,
        html.light .bg-slate-900\/20,
        html.light .bg-slate-950\/80,
        html.light .bg-slate-950\/90,
        html.light .bg-slate-950\/75 {
            background-color: rgba(255, 255, 255, 0.94) !important;
        }
        html.light .border-slate-800,
        html.light .border-slate-700,
        html.light .border-slate-800\/80,
        html.light .border-slate-800\/90,
        html.light .border-slate-800\/60 {
            border-color: #e2e8f0 !important;
        }
        html.light .text-white {
            color: #0f172a !important;
        }
        html.light .text-slate-300 {
            color: #334155 !important;
        }
        html.light .text-slate-400 {
            color: #64748b !important;
        }
        html.light .text-slate-500 {
            color: #94a3b8 !important;
        }
        html.light .bg-grid-mesh {
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px) !important;
        }
        html.light #app-preloader {
            background-color: #ffffff !important;
        }
        html.light #app-preloader .preloader-text {
            color: #0f172a !important;
        }
        html.light #main-header .rounded-2xl {
            background-color: rgba(255, 255, 255, 0.9) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.07) !important;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #030712;
        }
        html.light ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 4px;
        }
        html.light ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--brand-primary, #10b981);
        }
        
        /* Subtle grid background utility */
        .bg-grid-mesh {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }

        .hero-mesh-glow {
            background: radial-gradient(circle at 50% 20%, rgba(var(--brand-primary-rgb, 16, 185, 129), 0.12) 0%, rgba(6, 182, 212, 0.06) 40%, transparent 70%);
        }
    </style>

    <!-- Tailwind CSS (v3 with Forms, Typography, Aspect-Ratio plugins) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        slate: {
                            950: '#030712',
                            900: '#0b1329',
                            850: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                        },
                        brand: {
                            dark: '#030712',
                            surface: '#0b1329',
                            card: '#0f172a',
                            border: '#1e293b',
                            primary: 'var(--brand-primary, #10b981)',
                            primaryHover: 'var(--brand-accent, #059669)',
                            accent: 'var(--brand-accent, #34d399)',
                            cyan: 'var(--brand-cyan, #22d3ee)',
                            indigo: 'var(--brand-indigo, #6366f1)',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 25px -5px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.35)',
                        'glow-cyan': '0 0 25px -5px rgba(34, 211, 238, 0.35)',
                        'glow-indigo': '0 0 25px -5px rgba(99, 102, 241, 0.35)',
                        'card-dark': '0 20px 40px -15px rgba(0, 0, 0, 0.7)',
                    },
                    animation: {
                        'pulse-subtle': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-8px)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" />

    <!-- Toastr Notifications & Datepicker -->
    <link rel="stylesheet" href="{{ safe_asset('admin/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ safe_asset('admin/plugins/datepicker/datepicker.css') }}">

    <!-- SEO & OpenGraph Meta Tags -->
    <title>@yield('title', 'Wake Up ICT — Enterprise Technology & Engineering')</title>
    <meta name="description" content="@yield('description', 'Wake Up ICT is a next-generation technology academy and digital engineering consulting platform.')" />
    <link rel="canonical" href="@yield('link_canonical')" />
    <meta property="og:locale" content="@yield('og_locale', 'en_US')" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:url" content="@yield('og_url')" />
    <meta property="og:site_name" content="@yield('og_site_name', 'Wake Up ICT')" />
    <meta property="article:publisher" content="@yield('article_publisher')" />
    <meta property="article:modified_time" content="@yield('article_modified_time')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:width" content="@yield('og_image_width')" />
    <meta property="og:image:height" content="@yield('og_image_height')" />
    <meta name="twitter:card" content="@yield('twitter_card', 'summary_large_image')" />
    <meta name="twitter:title" content="@yield('title')" />
    <meta name="twitter:description" content="@yield('description')" />
    <meta name="twitter:image" content="@yield('image')" />
    <meta name="twitter:label1" content="@yield('twitter_label1')" />
    <meta name="twitter:data1" content="@yield('twitter_data1')" />
    <meta name="msvalidate.01" content="@yield('msvalidate')" />
    <meta name="google-site-verification" content="@yield('google_site_verification')" />

    @stack('css')
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-brand-primary selection:text-slate-950 min-h-screen flex flex-col overflow-x-hidden">

    <!-- Modern Dynamic Theme Preloader -->
    <div id="app-preloader" class="fixed inset-0 z-[99999] flex flex-col items-center justify-center transition-all duration-500 ease-out bg-slate-950">
        <div class="relative flex items-center justify-center w-24 h-24 mb-4">
            <!-- Ambient Radial Pulse -->
            <div class="absolute inset-0 rounded-full animate-ping opacity-20" style="background: radial-gradient(circle, var(--brand-primary, #10b981) 0%, transparent 70%);"></div>
            <!-- Primary Spinning Ring -->
            <div class="w-16 h-16 rounded-full border-2 border-slate-800 border-t-transparent animate-spin" style="border-top-color: var(--brand-primary, #10b981); border-right-color: var(--brand-accent, #34d399); animation-duration: 0.8s;"></div>
            <!-- Secondary Counter Ring -->
            <div class="absolute w-10 h-10 rounded-full border-2 border-slate-800 border-b-transparent animate-[spin_1.2s_linear_infinite_reverse]" style="border-bottom-color: var(--brand-cyan, #22d3ee);"></div>
            <!-- Center Core Glow -->
            <div class="absolute w-3.5 h-3.5 rounded-full animate-pulse" style="background: var(--brand-primary, #10b981); box-shadow: 0 0 14px var(--brand-primary, #10b981);"></div>
        </div>
        <div class="flex items-center gap-2 font-mono text-xs tracking-widest uppercase font-semibold text-slate-400">
            <span class="w-2 h-2 rounded-full animate-pulse" style="background: var(--brand-primary, #10b981);"></span>
            <span class="preloader-text text-white tracking-widest font-bold">WAKE UP ICT</span>
        </div>
    </div>

    <!-- Header Navigation -->
    @include('frontend.theme.clasic.include.header')

    <!-- Main Dynamic Content -->
    <main class="flex-grow w-full">
        @yield('maincontent')
    </main>

    <!-- Footer -->
    @include('frontend.theme.clasic.include.footer')

    <!-- Preloader Fade-out Script -->
    <script>
        (function() {
            function removePreloader() {
                var p = document.getElementById('app-preloader');
                if (p && !p.classList.contains('preloader-done')) {
                    p.classList.add('preloader-done');
                    p.style.opacity = '0';
                    p.style.pointerEvents = 'none';
                    setTimeout(function() { if (p && p.parentNode) p.parentNode.removeChild(p); }, 500);
                }
            }
            if (document.readyState === 'complete') {
                removePreloader();
            } else {
                window.addEventListener('load', removePreloader);
                setTimeout(removePreloader, 1500); // 1.5s max fallback
            }
        })();
    </script>

    <!-- Scripts -->
    <script src="{{ safe_asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ safe_asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    
    <!-- Datepicker Init -->
    <script>
        $(document).ready(function() {
            if ($("#datepicker").length) {
                $("#datepicker").datepicker({
                    showButtonPanel: true,
                    showTodayButton: true,
                    setDate: new Date(),
                    showAnim: 'slide',
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                });
            }
        });
    </script>

    <!-- Toastr Notifications -->
    <script src="{{ safe_asset('admin/js/toastr.min.js') }}"></script>
    <script src="{{ safe_asset('admin/sweetalert/sweetalert.min.js') }}"></script>

    @if (Session::has('success'))
        <script>
            toastr.options = { "positionClass": "toast-top-right", "timeOut": "5000" };
            toastr.success("{{ Session::get('success') }}");
        </script>
    @elseif (!empty(Session::get('error')))
        <script>
            toastr.options = { "positionClass": "toast-top-right", "timeOut": "5000" };
            toastr.error("{{ Session::get('error') }}");
        </script>
    @endif

    <!-- Form Validation -->
    <script src="{{ safe_asset('common/jquery.form-validation.min.js') }}"></script>
    <script>
        if (typeof $.validate === 'function') {
            $.validate({
                lang: 'en'
            });
        }
    </script>

    @yield('script')
    @stack('js')

</body>
</html>
