<!DOCTYPE html>
@php
    $initialTheme = isset($_COOKIE['theme_mode']) ? $_COOKIE['theme_mode'] : 'light';
@endphp
<html lang="{{ App::getLocale() }}" class="{{ $initialTheme }} scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Immediate Theme Application (Zero FOUT, Default Light Mode) -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('theme_mode') || '{{ $initialTheme }}';
            if (savedTheme === 'dark') {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            }
        })();
    </script>

    <!-- Fonts: Plus Jakarta Sans, Inter, JetBrains Mono, Noto Sans Bengali, Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

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
            font-family: {{ App::getLocale() == 'bn' ? '"Noto Sans Bengali", "Source Sans Pro", sans-serif' : "'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', 'Source Sans Pro', sans-serif" }};
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Bangla Global Font Styles */
        html[lang="bn"],
        html[lang="bn"] body,
        [lang="bn"],
        .font-bangla,
        .bangla-text {
            font-family: "Noto Sans Bengali", "Source Sans Pro", sans-serif !important;
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

        /* =========================================================
           ENTERPRISE LIGHT MODE SYSTEM (Universal for All Pages)
           ========================================================= */
        html.light,
        html.light body {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }

        /* Base Page Backgrounds & Wrappers */
        html.light .bg-slate-950,
        html.light div.bg-slate-950,
        html.light section.bg-slate-950,
        html.light main.bg-slate-950,
        html.light [class*="min-h-screen"].bg-slate-950 {
            background-color: #f8fafc !important;
        }

        /* Subtle Section Strips & Dividers */
        html.light section.bg-slate-900\/20,
        html.light section.bg-slate-900\/30,
        html.light section.bg-slate-900\/40,
        html.light section[class*="bg-slate-900/"] {
            background-color: #f1f5f9 !important;
        }

        /* Cards, Panels, Articles, Sidebar Widgets & Dropdowns */
        html.light a[class*="bg-slate-900"],
        html.light div[class*="bg-slate-900"],
        html.light article[class*="bg-slate-900"],
        html.light [class*="rounded-2xl"][class*="bg-slate-900"],
        html.light [class*="rounded-xl"][class*="bg-slate-900"],
        html.light [class*="bg-slate-900/"],
        html.light .bg-slate-900,
        html.light [class*="bg-brand-surface"],
        html.light [class*="bg-brand-card"],
        html.light [class*="bg-brand-dark"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.03) !important;
        }

        /* Card Hover Effects */
        html.light a[class*="bg-slate-900"]:hover,
        html.light div[class*="hover:-translate-y-1"]:hover {
            border-color: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.5) !important;
            box-shadow: 0 12px 30px -4px rgba(15, 23, 42, 0.1), 0 4px 10px -2px rgba(15, 23, 42, 0.05) !important;
        }

        /* Media / Image Container Placeholders */
        html.light .overflow-hidden.bg-slate-950,
        html.light [class*="overflow-hidden"][class*="bg-slate-950"] {
            background-color: #f1f5f9 !important;
        }

        /* Soft Gradient Overlays on Images */
        html.light .from-slate-950 {
            --tw-gradient-from: transparent !important;
        }
        html.light .via-slate-950\/30,
        html.light .via-slate-950\/20,
        html.light .via-slate-950\/40 {
            --tw-gradient-stops: transparent, transparent !important;
        }
        html.light .from-slate-950\/90,
        html.light .from-slate-950\/80,
        html.light .from-slate-950\/60 {
            --tw-gradient-from: rgba(15, 23, 42, 0.45) !important;
        }

        /* Secondary Badges, Chips, Track Pills & Counts */
        html.light [class*="bg-slate-800"],
        html.light .bg-slate-800,
        html.light [class*="bg-slate-850"],
        html.light [class*="bg-slate-950/80"],
        html.light [class*="bg-slate-950/90"] {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }

        /* Interactive Hover on Secondary Elements */
        html.light [class*="hover:bg-slate-800"]:hover,
        html.light [class*="hover:bg-slate-900"]:hover {
            background-color: #f1f5f9 !important;
        }

        /* Universal Borders */
        html.light [class*="border-slate-800"],
        html.light [class*="border-slate-700"],
        html.light [class*="border-slate-900"],
        html.light [class*="border-brand-border"],
        html.light .border-slate-800,
        html.light .border-slate-700 {
            border-color: #e2e8f0 !important;
        }
        html.light [class*="hover:border-slate-700"]:hover,
        html.light [class*="hover:border-slate-800"]:hover {
            border-color: #cbd5e1 !important;
        }

        /* Typography: Headings & Strong Elements */
        html.light h1,
        html.light h2,
        html.light h3,
        html.light h4,
        html.light h5,
        html.light h6,
        html.light .text-white,
        html.light [class*="text-white"],
        html.light .text-slate-100,
        html.light [class*="text-slate-100"] {
            color: #0f172a !important;
        }

        /* Typography: High-Readability Body & Descriptions */
        html.light .text-slate-200,
        html.light [class*="text-slate-200"] {
            color: #1e293b !important;
        }
        html.light .text-slate-300,
        html.light [class*="text-slate-300"] {
            color: #334155 !important;
        }

        /* Typography: Metadata, Captions, Timestamps */
        html.light .text-slate-400,
        html.light [class*="text-slate-400"],
        html.light .text-slate-500,
        html.light [class*="text-slate-500"] {
            color: #64748b !important;
        }

        /* Accent & Emerald text: Adjusted for White Card Contrast */
        html.light .text-emerald-400,
        html.light [class*="text-emerald-400"],
        html.light .text-brand-accent,
        html.light [class*="text-brand-accent"] {
            color: #059669 !important;
        }
        html.light .text-cyan-400,
        html.light [class*="text-cyan-400"] {
            color: #0891b2 !important;
        }
        html.light .text-blue-400,
        html.light [class*="text-blue-400"] {
            color: #2563eb !important;
        }

        /* Hover Text Transitions */
        html.light [class*="group"]:hover [class*="group-hover:text-emerald-400"],
        html.light [class*="group"]:hover [class*="group-hover:text-brand-primary"],
        html.light [class*="hover:text-emerald-400"]:hover,
        html.light [class*="hover:text-brand-primary"]:hover {
            color: var(--brand-primary, #10b981) !important;
        }
        html.light [class*="hover:text-white"]:hover,
        html.light [class*="group"]:hover [class*="group-hover:text-white"] {
            color: #0f172a !important;
        }

        /* Form Inputs & Textarea */
        html.light input:not([type="submit"]):not([type="button"]):not([type="checkbox"]):not([type="radio"]),
        html.light textarea,
        html.light select,
        html.light .input--style-5 {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.light input::placeholder,
        html.light textarea::placeholder {
            color: #94a3b8 !important;
        }
        html.light input:focus,
        html.light textarea:focus {
            border-color: var(--brand-primary, #10b981) !important;
            box-shadow: 0 0 0 2px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.2) !important;
        }

        /* Header Navigation & Dropdowns */
        html.light #main-header .rounded-2xl {
            background-color: rgba(255, 255, 255, 0.94) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.06) !important;
        }
        html.light #main-header a:not(.bg-brand-primary):not([class*="bg-brand-primary"]) {
            color: #475569 !important;
        }
        html.light #main-header a:not(.bg-brand-primary):not([class*="bg-brand-primary"]):hover {
            color: var(--brand-primary, #10b981) !important;
            background-color: #f1f5f9 !important;
        }
        html.light #main-header a[class*="text-brand-primary"] {
            color: var(--brand-primary, #10b981) !important;
            background-color: #f1f5f9 !important;
        }
        html.light #theme-toggle-btn {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }
        html.light #theme-dropdown {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.12) !important;
        }
        html.light #theme-dropdown button {
            color: #334155 !important;
        }
        html.light #theme-dropdown button:hover {
            background-color: #f1f5f9 !important;
            color: var(--brand-primary, #10b981) !important;
        }
        html.light #mobile-menu {
            background-color: rgba(255, 255, 255, 0.98) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15) !important;
        }
        html.light #mobile-menu .mobile-nav-link {
            color: #1e293b !important;
        }
        html.light #mobile-menu .mobile-nav-link:hover {
            background-color: #f1f5f9 !important;
            color: var(--brand-primary, #10b981) !important;
        }

        /* Footer */
        html.light footer.bg-slate-950,
        html.light footer {
            background-color: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
        }
        html.light footer .border-b,
        html.light footer .border-t {
            border-color: #e2e8f0 !important;
        }
        html.light footer a:not([class*="bg-brand-primary"]) {
            color: #64748b !important;
        }
        html.light footer a:not([class*="bg-brand-primary"]):hover {
            color: var(--brand-primary, #10b981) !important;
        }
        html.light footer [class*="bg-slate-900"] {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light footer [class*="bg-slate-900"]:hover {
            border-color: var(--brand-primary, #10b981) !important;
            color: var(--brand-primary, #10b981) !important;
        }

        /* Pagination Controls */
        html.light .dark-pagination .page-item .page-link,
        html.light .pagination .page-link {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            color: #334155 !important;
        }
        html.light .dark-pagination .page-item.active .page-link,
        html.light .pagination .page-item.active .page-link {
            background-color: var(--brand-primary, #10b981) !important;
            color: #030712 !important;
            border-color: var(--brand-primary, #10b981) !important;
            font-weight: bold;
        }
        html.light .dark-pagination .page-item .page-link:hover,
        html.light .pagination .page-item .page-link:hover {
            border-color: var(--brand-primary, #10b981) !important;
            color: var(--brand-primary, #10b981) !important;
            background-color: #f8fafc !important;
        }

        /* Preloader */
        html.light #app-preloader {
            background-color: #ffffff !important;
        }
        html.light #app-preloader .preloader-text {
            color: #0f172a !important;
        }

        /* Ambient Mesh Backgrounds in Light Mode */
        html.light .bg-grid-mesh {
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px) !important;
        }
        html.light .hero-mesh-glow {
            background: radial-gradient(circle at 50% 20%, rgba(var(--brand-primary-rgb, 16, 185, 129), 0.08) 0%, rgba(6, 182, 212, 0.04) 40%, transparent 70%) !important;
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

        /* =========================================================
           ADVANCED FRONTEND ANIMATION SYSTEM
           ========================================================= */
        /* 1. Animated Preloader Styles */
        #app-preloader {
            transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.6s ease;
        }
        html.light #app-preloader {
            background-color: #f8fafc !important;
        }
        html.light #app-preloader .preloader-icon-wrapper {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 15px 35px -5px rgba(15, 23, 42, 0.1) !important;
        }
        html.light #app-preloader .preloader-text {
            color: #0f172a !important;
        }
        html.light #app-preloader .text-slate-400 {
            color: #64748b !important;
        }
        html.light #app-preloader .preloader-bar-bg {
            background-color: #e2e8f0 !important;
        }

        @keyframes preloader-icon-float {
            0%, 100% {
                transform: scale(1) translateY(0);
                filter: drop-shadow(0 0 10px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.5));
            }
            50% {
                transform: scale(1.08) translateY(-4px);
                filter: drop-shadow(0 0 18px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.8));
            }
        }
        .preloader-icon-animated {
            animation: preloader-icon-float 2.2s ease-in-out infinite;
        }

        @keyframes preloader-bar-slide {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(0%); }
            100% { transform: translateX(100%); }
        }
        .preloader-bar-indeterminate {
            animation: preloader-bar-slide 1.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        /* 2. Scroll-Driven Reveal Animations */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-on-scroll.is-revealed {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-scale {
            opacity: 0;
            transform: scale(0.94);
            transition: opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1), transform 0.75s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-scale.is-revealed {
            opacity: 1;
            transform: scale(1);
        }
        .stagger-1 { transition-delay: 0.08s; }
        .stagger-2 { transition-delay: 0.16s; }
        .stagger-3 { transition-delay: 0.24s; }
        .stagger-4 { transition-delay: 0.32s; }

        /* 3. Floating Ambient Mesh Blobs */
        @keyframes float-ambient {
            0%, 100% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -25px) scale(1.08);
            }
            66% {
                transform: translate(-25px, 20px) scale(0.96);
            }
        }
        .animate-ambient-float {
            animation: float-ambient 14s ease-in-out infinite alternate;
        }
        .animate-ambient-float-reverse {
            animation: float-ambient 18s ease-in-out infinite alternate-reverse;
        }

        /* 4. Light Mode Scroll-to-Top Button */
        html.light #scroll-to-top {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #0f172a !important;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.15) !important;
        }
        html.light #scroll-to-top:hover {
            background-color: var(--brand-primary, #10b981) !important;
            color: #ffffff !important;
            border-color: var(--brand-primary, #10b981) !important;
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
                        sans: {!! App::getLocale() == 'bn' ? '[\'"Noto Sans Bengali"\', \'"Source Sans Pro"\', \'sans-serif\']' : '[\'"Plus Jakarta Sans"\', \'Inter\', \'"Noto Sans Bengali"\', \'"Source Sans Pro"\', \'sans-serif\']' !!},
                        display: {!! App::getLocale() == 'bn' ? '[\'"Noto Sans Bengali"\', \'"Source Sans Pro"\', \'sans-serif\']' : '[\'"Plus Jakarta Sans"\', \'"Noto Sans Bengali"\', \'"Source Sans Pro"\', \'sans-serif\']' !!},
                        bangla: ['"Noto Sans Bengali"', '"Source Sans Pro"', 'sans-serif'],
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
    
    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}">

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

    <!-- Modern Dynamic Theme Preloader with Animated Wake Up ICT Favicon -->
    <div id="app-preloader" class="fixed inset-0 z-[99999] flex flex-col items-center justify-center transition-all duration-700 ease-out bg-slate-950">
        <div class="relative flex items-center justify-center w-32 h-32 mb-6">
            
            <!-- Ambient Pulsing Glow Aura -->
            <div class="absolute inset-0 rounded-full animate-ping opacity-20" style="background: radial-gradient(circle, var(--brand-primary, #10b981) 0%, transparent 70%); animation-duration: 2.2s;"></div>
            
            <!-- Outer Spinning Gradient Track -->
            <div class="absolute w-28 h-28 rounded-full border-2 border-transparent animate-spin" style="border-top-color: var(--brand-primary, #10b981); border-right-color: var(--brand-cyan, #22d3ee); animation-duration: 1.4s;"></div>
            
            <!-- Middle Counter-Rotating Dashed Tech Ring -->
            <div class="absolute w-32 h-32 rounded-full border border-dashed border-slate-700/60 animate-[spin_3.5s_linear_infinite_reverse]" style="border-top-color: var(--brand-accent, #34d399); border-left-color: var(--brand-indigo, #6366f1);"></div>

            <!-- Central Glass Orb Enclosing the Animated Wake Up Favicon -->
            <div class="relative z-10 w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-slate-900/90 border border-slate-700/80 backdrop-blur-xl flex items-center justify-center p-3 shadow-2xl overflow-hidden preloader-icon-wrapper">
                <!-- Inner ambient glow -->
                <div class="absolute inset-0 bg-gradient-to-tr from-brand-primary/25 via-transparent to-brand-cyan/20 pointer-events-none"></div>
                <!-- The Animated Wake Up Favicon -->
                <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT Icon" class="w-full h-full object-contain relative z-10 preloader-icon-animated">
            </div>

            <!-- Orbiting Satellite Dot -->
            <div class="absolute w-32 h-32 animate-spin pointer-events-none" style="animation-duration: 2.8s;">
                <div class="w-2.5 h-2.5 rounded-full" style="background: var(--brand-primary, #10b981); box-shadow: 0 0 12px var(--brand-primary, #10b981);"></div>
            </div>
        </div>

        <!-- Typography & Sleek Loading Progress Indicator -->
        <div class="flex flex-col items-center gap-3">
            <div class="flex items-center gap-2 font-mono text-xs tracking-widest uppercase font-semibold text-slate-400">
                <span class="w-2 h-2 rounded-full animate-pulse" style="background: var(--brand-primary, #10b981);"></span>
                <span class="preloader-text text-white tracking-[0.22em] font-bold text-sm">WAKE UP ICT</span>
            </div>
            <!-- Progress Track with Sliding Highlight -->
            <div class="w-40 h-1 rounded-full bg-slate-800/90 overflow-hidden relative preloader-bar-bg">
                <div class="preloader-bar-indeterminate h-full w-1/2 rounded-full" style="background: linear-gradient(90deg, var(--brand-primary, #10b981), var(--brand-cyan, #22d3ee));"></div>
            </div>
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

    <!-- Circular Scroll-to-Top Button with Real-time Progress Ring -->
    <button id="scroll-to-top" type="button" class="fixed bottom-6 right-6 z-40 w-12 h-12 rounded-2xl bg-slate-900/90 text-slate-300 hover:text-slate-950 border border-slate-700/80 shadow-2xl backdrop-blur-xl flex items-center justify-center transition-all duration-300 opacity-0 translate-y-6 pointer-events-none hover:shadow-glow-emerald hover:-translate-y-1 focus:outline-none group" aria-label="Scroll to top">
        <!-- SVG Circular Progress Indicator -->
        <svg class="absolute inset-0 w-full h-full -rotate-90 pointer-events-none" viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20" class="stroke-slate-800/80 text-transparent" stroke-width="2.5" fill="none"></circle>
            <circle id="scroll-progress-indicator" cx="24" cy="24" r="20" stroke="currentColor" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-dasharray="125.66" stroke-dashoffset="125.66" class="text-brand-primary group-hover:text-slate-950 transition-all duration-150"></circle>
        </svg>
        <i class="fa fa-arrow-up text-sm transition-transform duration-300 group-hover:-translate-y-0.5"></i>
    </button>

    <!-- Preloader & Frontend Animation Controller Script -->
    <script>
        (function() {
            // 1. Smooth Preloader Dismissal
            function removePreloader() {
                var p = document.getElementById('app-preloader');
                if (p && !p.classList.contains('preloader-done')) {
                    p.classList.add('preloader-done');
                    p.style.opacity = '0';
                    p.style.pointerEvents = 'none';
                    setTimeout(function() { 
                        if (p && p.parentNode) p.parentNode.removeChild(p); 
                    }, 700);
                }
            }

            if (document.readyState === 'complete') {
                removePreloader();
            } else {
                window.addEventListener('load', removePreloader);
                setTimeout(removePreloader, 1500); // 1.5s max graceful fallback
            }

            // 2. Scroll Progress Ring & Back-to-Top Button
            window.addEventListener('scroll', function() {
                var topBtn = document.getElementById('scroll-to-top');
                var progressCircle = document.getElementById('scroll-progress-indicator');
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                
                if (topBtn) {
                    if (scrollTop > 280) {
                        topBtn.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                        topBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    } else {
                        topBtn.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
                        topBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    }
                }

                if (progressCircle && docHeight > 0) {
                    var scrollPercent = Math.min(Math.max(scrollTop / docHeight, 0), 1);
                    var circumference = 2 * Math.PI * 20; // 125.66
                    var offset = circumference - (scrollPercent * circumference);
                    progressCircle.style.strokeDashoffset = offset;
                }
            }, { passive: true });

            var scrollBtn = document.getElementById('scroll-to-top');
            if (scrollBtn) {
                scrollBtn.addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // 3. Scroll-Driven Reveal Observer
            document.addEventListener('DOMContentLoaded', function() {
                var revealElements = document.querySelectorAll('.reveal-on-scroll, .reveal-scale');
                
                if ('IntersectionObserver' in window && revealElements.length > 0) {
                    var revealObserver = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('is-revealed');
                                
                                // Trigger animated counters inside this element if present
                                var counters = entry.target.querySelectorAll('[data-counter-target]');
                                counters.forEach(function(counter) {
                                    if (!counter.dataset.counterDone) {
                                        counter.dataset.counterDone = "true";
                                        animateCounter(counter);
                                    }
                                });

                                revealObserver.unobserve(entry.target);
                            }
                        });
                    }, {
                        threshold: 0.1,
                        rootMargin: '0px 0px -40px 0px'
                    });

                    revealElements.forEach(function(el) {
                        revealObserver.observe(el);
                    });
                } else {
                    revealElements.forEach(function(el) {
                        el.classList.add('is-revealed');
                    });
                }
            });

            // 4. Smooth Kinetic Metric Number Ticker
            function animateCounter(el) {
                var targetStr = el.dataset.counterTarget;
                var suffix = el.dataset.counterSuffix || '';
                var prefix = el.dataset.counterPrefix || '';
                var targetNum = parseFloat(targetStr.replace(/,/g, ''));
                var isDecimal = targetStr.indexOf('.') !== -1;
                var duration = 1800;
                var start = 0;
                var startTime = null;

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    var easeOut = 1 - Math.pow(1 - progress, 3); // cubic ease-out
                    var current = start + (targetNum - start) * easeOut;
                    
                    if (isDecimal) {
                        el.textContent = prefix + current.toFixed(1) + suffix;
                    } else {
                        el.textContent = prefix + Math.floor(current).toLocaleString() + suffix;
                    }

                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.textContent = prefix + targetStr + suffix;
                    }
                }
                window.requestAnimationFrame(step);
            }
            window.animateCounter = animateCounter;
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
