<!DOCTYPE html>
@php
    $initialTheme = isset($_COOKIE['theme_mode']) ? $_COOKIE['theme_mode'] : 'light';
    $studentUser = Auth::guard('student')->user();
    $studentMenus = \App\Services\StudentMenuService::getTree();
@endphp
<html lang="{{ App::getLocale() }}" class="{{ $initialTheme }} scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Immediate Theme Application (Pure System Default Auto-Sync) -->
    <script>
        (function() {
            try {
                localStorage.removeItem('theme_mode');
                document.cookie = "theme_mode=;path=/;max-age=0";
            } catch(e) {}
            function syncWithSystemTheme() {
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (prefersDark) {
                    document.documentElement.classList.remove('light');
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                }
            }
            syncWithSystemTheme();
            if (window.matchMedia) {
                var mql = window.matchMedia('(prefers-color-scheme: dark)');
                if (mql.addEventListener) {
                    mql.addEventListener('change', syncWithSystemTheme);
                } else if (mql.addListener) {
                    mql.addListener(syncWithSystemTheme);
                }
            }
        })();
    </script>

    <!-- Bengali & Global Typography: my_kalpurush & Inherit -->
    <style>
        @font-face {
            font-family: 'my_kalpurush';
            font-display: swap;
            font-style: normal;
            font-weight: 100 900;
            src: local('my_kalpurush'), local('Kalpurush'), local('Kalpurush ANSI'),
                 url('{{ asset('frontend/fonts/Kalpurush.woff2') }}') format('woff2'),
                 url('{{ asset('frontend/fonts/Kalpurush.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'Kalpurush';
            font-display: swap;
            font-style: normal;
            font-weight: 100 900;
            src: local('Kalpurush'), local('my_kalpurush'), local('Kalpurush ANSI'),
                 url('{{ asset('frontend/fonts/Kalpurush.woff2') }}') format('woff2'),
                 url('{{ asset('frontend/fonts/Kalpurush.ttf') }}') format('truetype');
        }

        html {
            font-family: my_kalpurush, 'Kalpurush', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        :root {
            --brand-primary: {{ app_setting('theme_primary_color', '#10b981') }};
            --brand-primary-rgb: {{ app_setting('theme_primary_rgb', '16, 185, 129') }};
            --brand-accent: {{ app_setting('theme_accent_color', '#34d399') }};
            --brand-accent-rgb: {{ app_setting('theme_accent_rgb', '52, 211, 153') }};
            --brand-cyan: {{ app_setting('theme_cyan_color', '#22d3ee') }};
            --brand-indigo: {{ app_setting('theme_indigo_color', '#6366f1') }};
        }

        /* Clean Uncluttered Typography per User Directive */
        body, html, button, input, select, textarea, h1, h2, h3, h4, h5, h6, p, a, span {
            font-family: my_kalpurush;
            font-family: inherit;
            font-weight: 500;
            line-height: 1.1;
            color: inherit;
        }
        .font-mono, [class*="font-mono"], code, pre {
            font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
        }

        body {
            background-color: #030712;
            color: #f1f5f9;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* =========================================================================
           ENTERPRISE LIGHT & DARK MODE DESIGN SYSTEM FOR STUDENT PORTAL
           Guarantees 100% WCAG contrast, crystal-clear typography & premium surfaces
           ========================================================================= */

        /* 1. Global Page Background & Base Text */
        html.light body {
            background-color: #f8fafc !important; /* Tailwind slate-50 */
            color: #0f172a !important;            /* Tailwind slate-900 */
        }

        /* 2. Headings & Universal Text Contrast */
        html.light h1,
        html.light h2,
        html.light h3,
        html.light h4,
        html.light h5,
        html.light h6 {
            color: #0f172a !important;
        }

        html.light .text-white,
        html.light [class*="text-white"] {
            color: #0f172a !important;
        }
        html.light .text-slate-100,
        html.light [class*="text-slate-100"] {
            color: #0f172a !important;
        }
        html.light .text-slate-200,
        html.light [class*="text-slate-200"] {
            color: #1e293b !important;
        }
        html.light .text-slate-300,
        html.light [class*="text-slate-300"] {
            color: #334155 !important;
        }
        html.light .text-slate-400,
        html.light [class*="text-slate-400"] {
            color: #475569 !important; /* Slate-600: strong, readable text */
        }
        html.light .text-slate-500,
        html.light [class*="text-slate-500"] {
            color: #64748b !important;
        }

        /* 3. Surfaces, Cards & Panels */
        html.light .student-sidebar {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 2px 0 16px rgba(15, 23, 42, 0.03) !important;
        }

        html.light .student-header {
            background-color: rgba(255, 255, 255, 0.96) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04) !important;
        }

        html.light .student-card,
        html.light .bg-slate-900,
        html.light [class*="bg-slate-900"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.03) !important;
        }

        /* Secondary containers, inner cards & stat backgrounds */
        html.light .bg-slate-950,
        html.light [class*="bg-slate-950"] {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        /* Soft badges, chips, tags */
        html.light .bg-slate-800,
        html.light [class*="bg-slate-800"] {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }

        /* 4. Borders & Dividers */
        html.light .border-slate-800,
        html.light [class*="border-slate-800"],
        html.light .border-slate-700,
        html.light [class*="border-slate-700"] {
            border-color: #e2e8f0 !important;
        }
        html.light .divide-slate-800,
        html.light [class*="divide-slate-800"],
        html.light .divide-slate-700,
        html.light [class*="divide-slate-700"] {
            border-color: #e2e8f0 !important;
        }

        /* 5. Inputs, Textareas, Selects */
        html.light input:not([type="checkbox"]):not([type="radio"]),
        html.light textarea,
        html.light select {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.light input::placeholder,
        html.light textarea::placeholder {
            color: #94a3b8 !important;
        }
        html.light input:focus,
        html.light textarea:focus,
        html.light select:focus {
            background-color: #ffffff !important;
            border-color: var(--brand-primary, #10b981) !important;
            box-shadow: 0 0 0 1px var(--brand-primary, #10b981) !important;
        }

        html.light input:disabled,
        html.light textarea:disabled,
        html.light select:disabled {
            background-color: #f1f5f9 !important;
            color: #64748b !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed !important;
        }

        /* Option labels and quiz choices */
        html.light .option-label {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }
        html.light .option-label:hover {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }
        html.light [id*="palette-btn-"] {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light [id*="palette-btn-"].bg-brand-primary {
            background-color: var(--brand-primary, #10b981) !important;
            color: #020617 !important;
        }

        /* 6. Tables */
        html.light table th {
            background-color: #f8fafc !important;
            color: #475569 !important;
            border-color: #e2e8f0 !important;
        }
        html.light table td {
            color: #1e293b !important;
            border-color: #e2e8f0 !important;
        }
        html.light table tr:hover td {
            background-color: #f8fafc !important;
        }

        /* 7. Brand Buttons & Solid Action Elements */
        html.light a[class*="bg-brand-primary"],
        html.light button[class*="bg-brand-primary"],
        html.light .bg-brand-primary {
            background-color: var(--brand-primary, #10b981) !important;
            color: #020617 !important;
            font-weight: 700 !important;
        }
        html.light a[class*="bg-brand-primary"] *,
        html.light button[class*="bg-brand-primary"] *,
        html.light .bg-brand-primary * {
            color: #020617 !important;
        }

        /* Preserve bright text for colored badges / status buttons */
        html.light .bg-rose-500,
        html.light .bg-rose-600,
        html.light .bg-blue-500,
        html.light .bg-blue-600,
        html.light .bg-emerald-500,
        html.light .bg-emerald-600 {
            color: #ffffff !important;
        }
        html.light .bg-rose-500 *,
        html.light .bg-rose-600 *,
        html.light .bg-blue-500 *,
        html.light .bg-blue-600 *,
        html.light .bg-emerald-500 *,
        html.light .bg-emerald-600 * {
            color: #ffffff !important;
        }

        /* Color accents calibrated for light mode */
        html.light .text-amber-400,
        html.light [class*="text-amber-400"] {
            color: #d97706 !important; /* amber-600 */
        }
        html.light .text-emerald-400,
        html.light [class*="text-emerald-400"] {
            color: #059669 !important; /* emerald-600 */
        }
        html.light .text-rose-400,
        html.light [class*="text-rose-400"] {
            color: #e11d48 !important; /* rose-600 */
        }
        html.light .text-blue-400,
        html.light [class*="text-blue-400"] {
            color: #2563eb !important; /* blue-600 */
        }
        html.light .text-purple-400,
        html.light .text-purple-300 {
            color: #7c3aed !important; /* purple-600 */
        }
        html.light .text-brand-primary {
            color: var(--brand-primary, #059669) !important;
        }
        html.light .text-brand-cyan {
            color: #0891b2 !important;
        }

        /* 8. Sidebar Items in Light Mode */
        html.light .student-sidebar a {
            color: #475569 !important;
        }
        html.light .student-sidebar a:hover {
            color: #0f172a !important;
            background-color: #f1f5f9 !important;
        }
        html.light .student-sidebar button {
            color: #475569 !important;
        }
        html.light .student-sidebar button:hover {
            color: #0f172a !important;
            background-color: #f1f5f9 !important;
        }
        html.light .menu-group button.bg-slate-800\/60 {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
            border-color: #e2e8f0 !important;
        }
        html.light .submenu-container {
            border-color: #e2e8f0 !important;
        }
        html.light .submenu-container a {
            color: #64748b !important;
        }
        html.light .submenu-container a:hover {
            color: #0f172a !important;
            background-color: #f1f5f9 !important;
        }
        html.light .submenu-container a[class*="bg-brand-primary"] {
            background-color: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.12) !important;
            color: var(--brand-primary, #059669) !important;
            font-weight: 700 !important;
        }

        /* Student profile card in sidebar */
        html.light .student-sidebar .p-4.mx-4.my-3 {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }
        html.light .student-sidebar .p-4.mx-4.my-3 p.text-white {
            color: #0f172a !important;
        }

        /* Active sidebar link */
        html.light nav a.bg-brand-primary,
        html.light .student-sidebar a.bg-brand-primary {
            background-color: var(--brand-primary, #10b981) !important;
            color: #020617 !important;
            font-weight: 700 !important;
        }
        html.light nav a.bg-brand-primary *,
        html.light .student-sidebar a.bg-brand-primary * {
            color: #020617 !important;
        }

        /* 9. Header Controls in Top Navbar */
        html.light #theme-toggle {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light #theme-toggle i {
            color: #475569 !important;
        }
        html.light a[href*="locale"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light a[title="Notifications"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light a[title="Notifications"] i {
            color: #475569 !important;
        }
        html.light #profile-dropdown-btn {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #0f172a !important;
        }
        html.light #profile-dropdown-btn span {
            color: #0f172a !important;
        }
        html.light #profile-dropdown-menu {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.12) !important;
        }
        html.light #profile-dropdown-menu a {
            color: #334155 !important;
        }
        html.light #profile-dropdown-menu a:hover {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        html.light #mobile-toggle-btn {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #334155 !important;
        }
        html.light #mobile-drawer > div:last-child {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
        }
        html.light #mobile-drawer a {
            color: #334155 !important;
        }
        html.light #mobile-drawer a:hover {
            color: #0f172a !important;
            background-color: #f1f5f9 !important;
        }
        html.light #mobile-drawer p {
            color: #64748b !important;
        }
        html.light #mobile-drawer span {
            color: #0f172a !important;
        }
        html.light #mobile-drawer-close {
            background-color: #f1f5f9 !important;
            color: #475569 !important;
            border-color: #e2e8f0 !important;
        }

        /* 10. Filter Tabs & Pills */
        html.light a.bg-slate-900.border-slate-800,
        html.light button.bg-slate-900.border-slate-800,
        html.light a[class*="bg-slate-900"][class*="border-slate-800"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #475569 !important;
        }
        html.light a.bg-slate-900.border-slate-800:hover,
        html.light button.bg-slate-900.border-slate-800:hover {
            background-color: #f8fafc !important;
            color: #0f172a !important;
            border-color: #cbd5e1 !important;
        }

        /* 11. Gradients & Helpline Cards */
        html.light [class*="from-blue-950"],
        html.light [class*="from-slate-900"] {
            background-image: linear-gradient(to right, #eff6ff, #f8fafc) !important;
            border-color: #bfdbfe !important;
        }
        html.light [class*="from-blue-950"] h4 {
            color: #1e3a8a !important;
        }
        html.light [class*="from-blue-950"] p {
            color: #2563eb !important;
        }

        /* 12. Ambient Lighting Grid Mesh in Light Mode */
        html.light .bg-grid-mesh {
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.04) 1px, transparent 1px) !important;
        }
        html.light .blur-\[140px\] {
            opacity: 0.15 !important;
        }

        /* 13. Universal Dark Mode Light Text Rules */
        html.dark body {
            background-color: #030712 !important;
            color: #f1f5f9 !important;
        }
        html.dark h1, html.dark h2, html.dark h3, html.dark h4, html.dark h5, html.dark h6 {
            color: #ffffff !important;
        }
        html.dark p {
            color: #cbd5e1 !important;
        }
        html.dark li {
            color: #cbd5e1 !important;
        }
        html.dark .text-slate-400, html.dark [class*="text-slate-400"] {
            color: #94a3b8 !important;
        }
        html.dark .text-slate-300, html.dark [class*="text-slate-300"] {
            color: #cbd5e1 !important;
        }
        html.dark .text-slate-200, html.dark [class*="text-slate-200"] {
            color: #e2e8f0 !important;
        }
        html.dark a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not([class*="text-emerald"]):not([class*="text-brand"]) {
            color: #cbd5e1;
        }
        html.dark a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):hover {
            color: #ffffff !important;
        }
    </style>

    <!-- Tailwind CSS v3 via CDN -->
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
                            primary: 'var(--brand-primary, #10b981)',
                            accent: 'var(--brand-accent, #34d399)',
                            cyan: 'var(--brand-cyan, #22d3ee)',
                            indigo: 'var(--brand-indigo, #6366f1)',
                        }
                    },
                    fontFamily: {
                        sans: ['system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Noto Sans Bengali"', 'sans-serif'],
                        display: ['system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Noto Sans Bengali"', 'sans-serif'],
                        bangla: ['"Noto Sans Bengali"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 25px -5px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.35)',
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Toastr Notifications -->
    <link rel="stylesheet" href="{{ safe_asset('admin/css/toastr/toastr.min.css') }}">

    <title>@yield('title', 'Student Portal — Wake Up ICT')</title>
    @stack('css')
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col antialiased selection:bg-brand-primary selection:text-slate-950">

    <!-- Ambient Grid & Glow -->
    <div class="fixed inset-0 bg-grid-mesh opacity-20 pointer-events-none z-0"></div>
    <div class="fixed -top-40 -left-40 w-96 h-96 bg-brand-primary/10 rounded-full blur-[140px] pointer-events-none z-0"></div>
    <div class="fixed -bottom-40 -right-40 w-96 h-96 bg-brand-cyan/10 rounded-full blur-[140px] pointer-events-none z-0"></div>

    <div class="relative z-10 flex min-h-screen">

        <!-- =========================================================================
             1. DESKTOP SIDEBAR (DYNAMICALLY RENDERED FROM DATABASE)
             ========================================================================= -->
        <aside id="student-sidebar" class="student-sidebar hidden lg:flex flex-col w-72 bg-slate-900/90 border-r border-slate-800/80 backdrop-blur-2xl fixed inset-y-0 left-0 z-30 transition-all duration-300">
            
            <!-- Brand / Header -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80">
                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT" class="w-9 h-9 object-contain drop-shadow-md group-hover:scale-105 transition-transform">
                    <div>
                        <div class="font-bold text-base tracking-wider text-white flex items-center gap-1.5">
                            <span>WAKE UP ICT</span>
                        </div>
                        <div class="text-[10px] font-mono tracking-widest text-brand-primary uppercase font-semibold">
                            Student Portal
                        </div>
                    </div>
                </a>
            </div>

            <!-- Student Quick Badge -->
            <div class="p-4 mx-4 my-3 rounded-2xl bg-slate-950/60 border border-slate-800 flex items-center gap-3">
                <img src="{{ $studentUser->avatar_url }}" alt="{{ $studentUser->name }}" class="w-11 h-11 rounded-xl object-cover border border-slate-700/60">
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate">{{ $studentUser->name }}</p>
                    <p class="text-[11px] font-mono text-brand-primary font-semibold truncate">{{ $studentUser->student_id_code }}</p>
                </div>
            </div>

            <!-- Dynamic Navigation Links -->
            <nav class="flex-1 overflow-y-auto px-4 py-2 space-y-1.5 custom-scrollbar">
                @foreach($studentMenus as $menu)
                    @php
                        $hasChildren = $menu->activeChildren->count() > 0;
                        $isCurrent = $menu->isCurrent();
                        $isChildCurrent = $menu->isChildCurrent();
                        $isOpen = $isCurrent || $isChildCurrent;
                    @endphp

                    @if($hasChildren)
                        <!-- Parent with Submenus (Collapsible) -->
                        <div class="menu-group" x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }">
                            <button type="button" 
                                onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.arrow-icon').classList.toggle('rotate-90');"
                                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition-all duration-200 {{ $isOpen ? 'bg-slate-800/60 text-white border border-slate-700/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                                <div class="flex items-center gap-3 truncate">
                                    <i class="{{ $menu->icon }} text-sm w-4 text-center {{ $isOpen ? 'text-brand-primary' : 'text-slate-400' }}"></i>
                                    <span class="truncate">{{ $menu->getTitle() }}</span>
                                </div>
                                <i class="fa fa-angle-right arrow-icon text-xs transition-transform duration-200 {{ $isOpen ? 'rotate-90 text-brand-primary' : 'text-slate-500' }}"></i>
                            </button>

                            <!-- Submenu Items -->
                            <div class="submenu-container mt-1 ml-4 pl-3 border-l-2 border-slate-800 space-y-1 {{ $isOpen ? '' : 'hidden' }}">
                                @foreach($menu->activeChildren as $child)
                                    @php $childCurrent = $child->isCurrent(); @endphp
                                    <a href="{{ $child->resolveUrl() }}" 
                                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs font-medium transition-all duration-200 {{ $childCurrent ? 'bg-brand-primary/10 text-brand-primary font-semibold border border-brand-primary/20' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                                        <i class="{{ $child->icon }} text-xs w-3 text-center {{ $childCurrent ? 'text-brand-primary' : 'text-slate-500' }}"></i>
                                        <span class="truncate">{{ $child->getTitle() }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Direct Link -->
                        <a href="{{ $menu->resolveUrl() }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold tracking-wide transition-all duration-200 {{ $isCurrent ? 'bg-brand-primary text-slate-950 shadow-glow-emerald font-bold' : 'text-slate-400 hover:text-white hover:bg-slate-800/40' }}">
                            <i class="{{ $menu->icon }} text-sm w-4 text-center {{ $isCurrent ? 'text-slate-950' : 'text-slate-400' }}"></i>
                            <span class="truncate">{{ $menu->getTitle() }}</span>
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Bottom Exit Link -->
            <div class="p-4 border-t border-slate-800/80 flex items-center justify-between">
                <a href="{{ url('/') }}" target="_blank" class="text-xs text-slate-400 hover:text-brand-primary flex items-center gap-1.5 transition-colors">
                    <i class="fa fa-external-link"></i>
                    <span>Public Website</span>
                </a>
                <form action="{{ route('student.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 flex items-center gap-1.5 transition-colors font-semibold" title="Sign Out">
                        <i class="fa fa-sign-out"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- =========================================================================
             2. MAIN WRAPPER & TOP HEADER
             ========================================================================= -->
        <div class="flex-1 lg:pl-72 flex flex-col min-w-0">
            
            <!-- Top Header Navigation Bar -->
            <header class="student-header sticky top-0 z-20 h-20 bg-slate-900/80 border-b border-slate-800/80 backdrop-blur-2xl px-4 sm:px-8 flex items-center justify-between">
                
                <!-- Left: Mobile Toggle & Breadcrumb Title -->
                <div class="flex items-center gap-4">
                    <button id="mobile-toggle-btn" type="button" class="lg:hidden p-2 rounded-xl bg-slate-800/80 text-slate-300 hover:text-white border border-slate-700/60 focus:outline-none" aria-label="Open Mobile Menu">
                        <i class="fa fa-bars text-base"></i>
                    </button>
                    <div>
                        <h1 class="text-base sm:text-lg font-extrabold text-white tracking-wide">
                            @yield('page_title', 'Student Dashboard')
                        </h1>
                        <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400 font-medium">
                            <a href="{{ route('student.dashboard') }}" class="hover:text-brand-primary transition-colors">Student</a>
                            <span>/</span>
                            <span class="text-brand-primary">@yield('page_crumb', 'Overview')</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Theme Toggle, Notifications & Profile Dropdown -->
                <div class="flex items-center gap-3">
                    
                    <!-- Theme Mode Toggle -->
                    <button id="theme-toggle" type="button" class="p-2.5 rounded-xl bg-slate-800/80 text-slate-300 hover:text-white border border-slate-700/60 transition-all hover:border-brand-primary/40 focus:outline-none" title="Toggle Theme">
                        <i class="fa fa-sun-o hidden dark:inline text-amber-400"></i>
                        <i class="fa fa-moon-o inline dark:hidden text-indigo-400"></i>
                    </button>

                    <!-- Language Switcher -->
                    <a href="{{ url('locale/' . (App::getLocale() == 'bn' ? 'en' : 'bn')) }}" class="px-3 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700/60 text-xs font-semibold text-slate-300 hover:text-brand-primary transition-colors">
                        {{ App::getLocale() == 'bn' ? 'English' : 'বাংলা' }}
                    </a>

                    <!-- Notification Bell -->
                    @php
                        $unreadNotifCount = \App\model\LmsNotification::where(function($q) use ($studentUser) {
                            $q->where('student_account_id', $studentUser->id)->orWhereNull('student_account_id');
                        })->where('is_read', false)->count();
                    @endphp
                    <a href="{{ route('student.notifications.index') }}" class="relative p-2.5 rounded-xl bg-slate-800/80 text-slate-300 hover:text-white border border-slate-700/60 transition-all hover:border-brand-primary/40 focus:outline-none" title="Notifications">
                        <i class="fa fa-bell-o text-sm"></i>
                        @if($unreadNotifCount > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white font-mono text-[9px] font-bold flex items-center justify-center animate-pulse">
                                {{ $unreadNotifCount > 9 ? '9+' : $unreadNotifCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Profile Dropdown Trigger -->
                    <div class="relative" id="profile-dropdown-wrapper">
                        <button id="profile-dropdown-btn" type="button" class="flex items-center gap-2.5 p-1.5 pr-3 rounded-2xl bg-slate-800/60 border border-slate-700/60 hover:border-slate-600 transition-all focus:outline-none">
                            <img src="{{ $studentUser->avatar_url }}" alt="{{ $studentUser->name }}" class="w-8 h-8 rounded-xl object-cover border border-slate-700">
                            <span class="hidden md:inline text-xs font-bold text-white max-w-[120px] truncate">{{ $studentUser->name }}</span>
                            <i class="fa fa-angle-down text-slate-400 text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="profile-dropdown-menu" class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-slate-900 border border-slate-800 shadow-2xl p-2 z-50">
                            <div class="px-3 py-2.5 border-b border-slate-800 mb-1">
                                <p class="text-xs font-bold text-white">{{ $studentUser->name }}</p>
                                <p class="text-[11px] font-mono text-brand-primary mt-0.5">{{ $studentUser->student_id_code }}</p>
                            </div>
                            <a href="{{ route('student.profile.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all">
                                <i class="fa fa-user-circle-o text-brand-primary w-4"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="{{ route('student.profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all">
                                <i class="fa fa-sliders text-brand-cyan w-4"></i>
                                <span>Account Settings</span>
                            </a>
                            <div class="border-t border-slate-800 my-1"></div>
                            <form action="{{ route('student.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs font-semibold text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition-all text-left">
                                    <i class="fa fa-sign-out w-4"></i>
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <!-- =========================================================================
                 3. MAIN CONTENT INJECTION
                 ========================================================================= -->
            <main class="flex-1 p-4 sm:p-8">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="p-6 border-t border-slate-800/60 text-center text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} Wake Up ICT — Student Learning Management System. All rights reserved.</p>
            </footer>

        </div>
    </div>

    <!-- =========================================================================
         4. MOBILE SLIDEOUT DRAWER
         ========================================================================= -->
    <div id="mobile-drawer" class="fixed inset-0 z-50 lg:hidden hidden">
        <div id="mobile-drawer-backdrop" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-y-0 left-0 w-80 max-w-[85%] bg-slate-900 border-r border-slate-800 flex flex-col p-6 z-10 overflow-y-auto">
            <div class="flex items-center justify-between pb-6 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT" class="w-8 h-8 object-contain">
                    <span class="font-bold text-white text-sm">WAKE UP ICT</span>
                </div>
                <button id="mobile-drawer-close" type="button" class="p-2 rounded-xl bg-slate-800 text-slate-400 hover:text-white">
                    <i class="fa fa-times text-base"></i>
                </button>
            </div>

            <!-- Mobile Dynamic Links -->
            <nav class="flex-1 py-6 space-y-1.5">
                @foreach($studentMenus as $menu)
                    @php $hasChildren = $menu->activeChildren->count() > 0; @endphp
                    @if($hasChildren)
                        <div class="pt-2 pb-1">
                            <p class="px-3 text-[10px] font-mono tracking-wider text-slate-400 uppercase font-bold">{{ $menu->getTitle() }}</p>
                            <div class="mt-1 space-y-1">
                                @foreach($menu->activeChildren as $child)
                                    <a href="{{ $child->resolveUrl() }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-xs font-medium text-slate-300 hover:bg-slate-800">
                                        <i class="{{ $child->icon }} text-xs w-4 text-center text-brand-primary"></i>
                                        <span>{{ $child->getTitle() }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->resolveUrl() }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-800">
                            <i class="{{ $menu->icon }} text-sm w-4 text-center text-brand-primary"></i>
                            <span>{{ $menu->getTitle() }}</span>
                        </a>
                    @endif
                @endforeach
            </nav>

            <form action="{{ route('student.logout') }}" method="POST" class="pt-4 border-t border-slate-800">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 font-bold text-xs">
                    <i class="fa fa-sign-out"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts: Toastr & Theme Controller -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ safe_asset('admin/js/toastr/toastr.min.js') }}"></script>
    <script>
        // Profile dropdown
        var profileBtn = document.getElementById('profile-dropdown-btn');
        var profileMenu = document.getElementById('profile-dropdown-menu');
        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function() {
                profileMenu.classList.add('hidden');
            });
        }

        // Mobile drawer
        var mobileToggle = document.getElementById('mobile-toggle-btn');
        var mobileDrawer = document.getElementById('mobile-drawer');
        var mobileClose = document.getElementById('mobile-drawer-close');
        var mobileBackdrop = document.getElementById('mobile-drawer-backdrop');

        function toggleMobileDrawer(show) {
            if (mobileDrawer) {
                if (show) mobileDrawer.classList.remove('hidden');
                else mobileDrawer.classList.add('hidden');
            }
        }
        if (mobileToggle) mobileToggle.addEventListener('click', function() { toggleMobileDrawer(true); });
        if (mobileClose) mobileClose.addEventListener('click', function() { toggleMobileDrawer(false); });
        if (mobileBackdrop) mobileBackdrop.addEventListener('click', function() { toggleMobileDrawer(false); });

        // Theme Toggle
        var themeToggleBtn = document.getElementById('theme-toggle');
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                var isDark = document.documentElement.classList.contains('dark');
                if (isDark) {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                    localStorage.setItem('theme_mode', 'light');
                    document.cookie = "theme_mode=light;path=/;max-age=31536000";
                } else {
                    document.documentElement.classList.remove('light');
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme_mode', 'dark');
                    document.cookie = "theme_mode=dark;path=/;max-age=31536000";
                }
            });
        }

        // Toastr Flash Notifications
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif
        @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
    @stack('scripts')
</body>
</html>
