<!DOCTYPE html>
@php
    $initialTheme = isset($_COOKIE['theme_mode']) && in_array($_COOKIE['theme_mode'], ['light', 'dark']) ? $_COOKIE['theme_mode'] : 'light';
@endphp
<html lang="{{ App::getLocale() }}" class="light scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Immediate Theme Application: Default to Light in Frontend -->
    <script>
        (function() {
            var activeTheme = 'light';
            try {
                var storedTheme = localStorage.getItem('theme_mode');
                if (storedTheme === 'dark') {
                    activeTheme = 'dark';
                }
            } catch(e) {}
            document.documentElement.classList.remove('dark', 'light');
            document.documentElement.classList.add(activeTheme);
        })();
    </script>

    <!-- Bengali & Global Typography: Modern Sans-Serif (Plus Jakarta Sans, Inter, Noto Sans Bengali) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html {
            font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        :root {
            --brand-primary: {{ app_setting('theme_primary_color', '#10b981') }};
            --brand-primary-rgb: {{ app_setting('theme_primary_rgb', '16, 185, 129') }};
            --brand-accent: {{ app_setting('theme_accent_color', '#34d399') }};
            --brand-accent-rgb: {{ app_setting('theme_accent_rgb', '52, 211, 153') }};
            --brand-cyan: {{ app_setting('theme_cyan_color', '#22d3ee') }};
            --brand-indigo: {{ app_setting('theme_indigo_color', '#6366f1') }};
        }

        /* Clean Uncluttered Modern Typography */
        body, html, button, input, select, textarea, h1, h2, h3, h4, h5, h6, p, a, span {
            font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: inherit;
        }
        .font-mono, [class*="font-mono"], code, pre {
            font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace !important;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
        }

        body {
            background-color: #f8fafc;
            color: #0f172a;
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

        /* =========================================================
           ENTERPRISE LIGHT MODE SYSTEM (Universal for All Frontend Pages)
           Default Theme is Light: 100% WCAG Contrast & Crystal-Clear Colors
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
        html.light [class*="min-h-screen"].bg-slate-950,
        html.light [class*="bg-slate-950"] {
            background-color: #f8fafc !important;
        }

        /* Subtle Section Strips & Dividers */
        html.light section.bg-slate-900\/20,
        html.light section.bg-slate-900\/30,
        html.light section.bg-slate-900\/40,
        html.light section[class*="bg-slate-900/"],
        html.light div[class*="bg-slate-900/40"],
        html.light div[class*="bg-slate-900/30"] {
            background-color: #f1f5f9 !important;
        }

        /* Cards, Panels, Articles, Sidebar Widgets & Dropdowns */
        html.light a[class*="bg-slate-900"],
        html.light div[class*="bg-slate-900"],
        html.light article[class*="bg-slate-900"],
        html.light [class*="rounded-2xl"][class*="bg-slate-900"],
        html.light [class*="rounded-3xl"][class*="bg-slate-900"],
        html.light [class*="rounded-xl"][class*="bg-slate-900"],
        html.light [class*="bg-slate-900/"],
        html.light .bg-slate-900,
        html.light [class*="bg-brand-surface"],
        html.light [class*="bg-brand-card"],
        html.light [class*="bg-brand-dark"],
        html.light .course-item,
        html.light .accordion-item {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.03) !important;
        }

        /* Card Hover Effects */
        html.light a[class*="bg-slate-900"]:hover,
        html.light div[class*="hover:-translate-y-1"]:hover,
        html.light div[class*="hover:-translate-y-1.5"]:hover {
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

        /* Neutralize dark gradients on sections & cards in Light Mode */
        html.light section[class*="from-slate-9"],
        html.light section[class*="to-slate-9"],
        html.light section[class*="bg-gradient-to-"][class*="from-slate-"],
        html.light div.student-card[class*="from-slate-9"],
        html.light div.student-card[class*="to-slate-9"] {
            background-image: none !important;
            background-color: #f1f5f9 !important;
        }

        /* Badge and Chip contrast in Light Mode */
        html.light [class*="bg-emerald-500/10"]:not(button):not(.header-hotline-btn),
        html.light [class*="bg-emerald-500/20"]:not(button):not(.header-hotline-btn) {
            background-color: #ecfdf5 !important;
            border-color: #a7f3d0 !important;
            color: #047857 !important;
        }
        html.light [class*="bg-rose-500/10"],
        html.light [class*="bg-rose-500/20"] {
            background-color: #fff1f2 !important;
            border-color: #fecdd3 !important;
            color: #be123c !important;
        }
        html.light [class*="bg-cyan-500/10"],
        html.light [class*="bg-cyan-500/20"] {
            background-color: #ecfeff !important;
            border-color: #a5f3fc !important;
            color: #0e7490 !important;
        }
        html.light [class*="bg-amber-500/10"],
        html.light [class*="bg-amber-500/20"] {
            background-color: #fffbeb !important;
            border-color: #fde68a !important;
            color: #b45309 !important;
        }
        html.light [class*="bg-blue-500/10"],
        html.light [class*="bg-blue-500/20"] {
            background-color: #eff6ff !important;
            border-color: #bfdbfe !important;
            color: #1d4ed8 !important;
        }

        /* Secondary Badges, Chips, Track Pills & Counts */
        html.light [class*="bg-slate-800"],
        html.light .bg-slate-800,
        html.light [class*="bg-slate-850"],
        html.light [class*="bg-slate-950/80"],
        html.light [class*="bg-slate-950/90"] {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #1e293b !important;
        }

        /* Interactive Hover on Secondary Elements */
        html.light [class*="hover:bg-slate-800"]:hover,
        html.light [class*="hover:bg-slate-900"]:hover {
            background-color: #e2e8f0 !important;
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

        /* Typography: Headings & Strong Elements in Light Mode (Deep Navy Contrast) */
        html.light h1:not([class*="bg-emerald-"]):not([class*="bg-rose-"]):not(.btn *):not(#top-announcement-strip *):not(#international-works *),
        html.light h2:not([class*="bg-emerald-"]):not([class*="bg-rose-"]):not(.btn *):not(#top-announcement-strip *):not(#international-works *),
        html.light h3:not([class*="bg-emerald-"]):not([class*="bg-rose-"]):not(.btn *):not(#top-announcement-strip *):not(#international-works *),
        html.light h4:not([class*="bg-emerald-"]):not([class*="bg-rose-"]):not(.btn *):not(#top-announcement-strip *):not(#international-works *),
        html.light h5:not(.btn *):not(#top-announcement-strip *):not(#international-works *),
        html.light h6:not(.btn *):not(#top-announcement-strip *):not(#international-works *) {
            color: #0f172a !important;
        }

        /* International Works Overlay Cards — Always Pure White Heading */
        #international-works .international-card-title,
        html.light #international-works .international-card-title,
        #international-works h4,
        html.light #international-works h4,
        html.light #international-works .card-overlay-text h4 {
            color: #ffffff !important;
        }
        #international-works .international-card-sub,
        html.light #international-works .international-card-sub,
        html.light #international-works .card-overlay-text .international-card-sub * {
            color: #f1f5f9 !important;
        }
        #international-works .international-badge-black,
        html.light #international-works .international-badge-black,
        html.light #international-works .international-badge-black * {
            color: #000000 !important;
        }


        /* Universal Text-White Override in Light Mode */
        html.light .text-white:not([class*="bg-rose"]):not([class*="bg-emerald"]):not([class*="bg-blue"]):not([class*="bg-teal"]):not([class*="bg-indigo"]):not([class*="bg-brand"]):not([class*="bg-amber"]):not([class*="bg-purple"]):not([class*="bg-red"]):not([class*="bg-green"]):not(.text-white-force):not(button):not(button *):not(.btn):not(.btn *):not(.badge):not(.badge *):not(.hero-slide *):not(#top-announcement-strip *):not(.btn-shimmer *):not([class*="btn-"]):not([class*="btn-"] *),
        html.light div.text-white:not([class*="bg-"]):not(button *):not(a.btn *):not(.hero-slide *):not(#top-announcement-strip *),
        html.light span.text-white:not([class*="bg-"]):not([class*="badge"]):not(button *):not(a.btn *):not(.hero-slide *):not(#top-announcement-strip *),
        html.light p.text-white:not([class*="bg-"]):not(button *):not(a.btn *):not(.hero-slide *):not(#top-announcement-strip *) {
            color: #0f172a !important;
        }

        /* Scoped Body, Paragraph & Description Text for Light Mode (Crisp Deep Slate) */
        html.light p:not([class*="bg-"]):not(button *):not(.btn *):not(.badge *):not(#top-announcement-strip *),
        html.light li:not([class*="bg-"]):not(button *):not(.btn *):not(#top-announcement-strip *),
        html.light dt, html.light dd, html.light label {
            color: #0f172a !important;
        }

        /* Elements that MUST retain bright white text in Light Mode */
        html.light .text-white-force,
        html.light #top-announcement-strip,
        html.light #top-announcement-strip *,
        html.light [class*="bg-rose-500"]:not([class*="bg-rose-600"]),
        html.light [class*="bg-rose-500"]:not([class*="bg-rose-600"]) *,
        html.light [class*="bg-emerald-600"],
        html.light [class*="bg-emerald-600"] *,
        html.light [class*="bg-emerald-700"],
        html.light [class*="bg-emerald-700"] *,
        html.light [class*="bg-emerald-500"],
        html.light [class*="bg-emerald-500"] *,
        html.light .hero-slide *,
        html.light .btn-shimmer * {
            color: #ffffff !important;
        }

        /* User Directive: Buttons, badges, and elements with bg-rose-600 and bg-emerald-100 MUST have black font */
        [class*="bg-rose-600"],
        [class*="bg-rose-600"] *,
        button[class*="bg-rose-600"],
        a[class*="bg-rose-600"],
        .btn[class*="bg-rose-600"],
        span[class*="bg-rose-600"],
        html.light [class*="bg-rose-600"],
        html.light [class*="bg-rose-600"] *,
        html.light button[class*="bg-rose-600"],
        html.light a[class*="bg-rose-600"],
        html.light .btn[class*="bg-rose-600"],
        html.light span[class*="bg-rose-600"],
        [class*="bg-emerald-100"],
        [class*="bg-emerald-100"] *,
        button[class*="bg-emerald-100"],
        a[class*="bg-emerald-100"],
        .btn[class*="bg-emerald-100"],
        span[class*="bg-emerald-100"],
        html.light [class*="bg-emerald-100"],
        html.light [class*="bg-emerald-100"] *,
        html.light button[class*="bg-emerald-100"],
        html.light a[class*="bg-emerald-100"],
        html.light .btn[class*="bg-emerald-100"],
        html.light span[class*="bg-emerald-100"] {
            color: #000000 !important;
            font-weight: 800 !important;
        }

        /* Typography: High-Readability Body & Slate Classes in Light Mode */
        html.light .text-slate-100,
        html.light [class*="text-slate-100"]:not(#top-announcement-strip *) {
            color: #0f172a !important;
        }
        html.light .text-slate-200,
        html.light [class*="text-slate-200"] {
            color: #0f172a !important;
        }
        html.light .text-slate-300,
        html.light [class*="text-slate-300"] {
            color: #1e293b !important;
        }

        /* Typography: Subtext, Metadata, Captions in Light Mode (High Contrast Slate) */
        html.light .text-slate-400,
        html.light [class*="text-slate-400"] {
            color: #334155 !important;
        }
        html.light .text-slate-500,
        html.light [class*="text-slate-500"] {
            color: #475569 !important;
        }
        html.light .text-slate-600,
        html.light [class*="text-slate-600"] {
            color: #334155 !important;
        }

        /* Accent text in Light Mode (Deep Emerald, Cyan, Blue, Amber) */
        html.light .text-emerald-400,
        html.light [class*="text-emerald-400"],
        html.light .text-brand-accent,
        html.light [class*="text-brand-accent"] {
            color: #047857 !important;
        }
        html.light .text-cyan-400,
        html.light [class*="text-cyan-400"],
        html.light .text-cyan-300,
        html.light [class*="text-cyan-300"] {
            color: #0284c7 !important;
        }
        html.light .text-blue-400,
        html.light [class*="text-blue-400"] {
            color: #1d4ed8 !important;
        }
        html.light .text-amber-400,
        html.light [class*="text-amber-400"] {
            color: #b45309 !important;
        }
        html.light .text-indigo-400,
        html.light [class*="text-indigo-400"] {
            color: #4338ca !important;
        }
        html.light .text-rose-400,
        html.light [class*="text-rose-400"] {
            color: #be123c !important;
        }

        /* Counter Tickers & Metric Numbers */
        html.light [data-counter-target] {
            color: #0f172a !important;
        }

        /* Links in Light Mode */
        html.light a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not([class*="bg-slate"]):not(#top-announcement-strip *) {
            color: #0f172a;
        }
        html.light a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not(#top-announcement-strip *):hover {
            color: var(--brand-primary, #10b981) !important;
        }

        /* Hover Text Transitions */
        html.light [class*="group"]:hover [class*="group-hover:text-emerald-400"],
        html.light [class*="group"]:hover [class*="group-hover:text-brand-primary"],
        html.light [class*="hover:text-emerald-400"]:hover,
        html.light [class*="hover:text-brand-primary"]:hover {
            color: #047857 !important;
        }
        html.light [class*="hover:text-white"]:hover,
        html.light [class*="group"]:hover [class*="group-hover:text-white"] {
            color: var(--brand-primary, #10b981) !important;
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
            color: #64748b !important;
        }
        html.light select option {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
        html.light input:focus,
        html.light textarea:focus,
        html.light select:focus {
            border-color: var(--brand-primary, #10b981) !important;
            box-shadow: 0 0 0 2px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.2) !important;
        }

        /* Breadcrumbs in Light Mode */
        html.light nav[aria-label="Breadcrumb"] a {
            color: #334155 !important;
        }
        html.light nav[aria-label="Breadcrumb"] a:hover {
            color: var(--brand-primary, #10b981) !important;
        }
        html.light nav[aria-label="Breadcrumb"] span {
            color: #64748b !important;
        }
        html.light nav[aria-label="Breadcrumb"] span.text-brand-primary {
            color: var(--brand-primary, #10b981) !important;
        }

        /* Tables in Light Mode */
        html.light table {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
        }
        html.light th {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
            border-color: #e2e8f0 !important;
        }
        html.light td {
            color: #1e293b !important;
            border-color: #e2e8f0 !important;
        }
        html.light tr:hover td {
            background-color: #f8fafc !important;
        }

        /* Header Navigation & Dropdowns */
        html.light #main-header .rounded-2xl {
            background-color: rgba(255, 255, 255, 0.96) !important;
            border-color: #cbd5e1 !important;
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.08) !important;
        }
        html.light #main-header nav a {
            color: #0f172a !important;
            font-weight: 600 !important;
        }
        html.light #main-header nav a:hover {
            color: var(--brand-primary, #10b981) !important;
            background-color: #f1f5f9 !important;
        }
        html.light #main-header nav a[class*="text-brand-primary"] {
            color: var(--brand-primary, #10b981) !important;
            background-color: #ecfdf5 !important;
        }
        html.light #main-header input {
            background-color: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.light #main-header input::placeholder {
            color: #64748b !important;
        }
        html.light #main-header .fa-search {
            color: #64748b !important;
        }
        html.light #main-header div[class*="group-hover:block"] {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 15px 35px -5px rgba(15, 23, 42, 0.12) !important;
        }
        html.light #main-header div[class*="group-hover:block"] a {
            color: #0f172a !important;
        }
        html.light #main-header div[class*="group-hover:block"] a:hover {
            background-color: #f1f5f9 !important;
            color: var(--brand-primary, #10b981) !important;
        }
        html.light #main-header a[href*="student/login"] {
            background-color: #ffffff !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.light #main-header a[href*="student/login"]:hover {
            border-color: var(--brand-primary, #10b981) !important;
            color: var(--brand-primary, #10b981) !important;
        }
        html.light #main-header a[href*="tel:01791612121"],
        html.light .header-hotline-btn {
            background-color: #059669 !important;
            border-color: #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 6px rgba(5, 150, 105, 0.3) !important;
        }
        html.light #main-header a[href*="tel:01791612121"] *,
        html.light .header-hotline-btn * {
            color: #ffffff !important;
        }
        html.light #main-header a[href*="tel:01791612121"]:hover,
        html.light .header-hotline-btn:hover {
            background-color: #047857 !important;
            border-color: #047857 !important;
            color: #ffffff !important;
        }
        html.light #mobile-menu-btn {
            color: #0f172a !important;
        }
        html.light #mobile-menu {
            background-color: rgba(255, 255, 255, 0.98) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15) !important;
        }
        html.light #mobile-menu .mobile-nav-link {
            color: #0f172a !important;
        }
        html.light #mobile-menu .mobile-nav-link:hover {
            background-color: #f1f5f9 !important;
            color: var(--brand-primary, #10b981) !important;
        }

        /* Architectural Footer: Adaptive Light and Dark Contrast */
        html.light .site-footer {
            background-color: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #1e293b !important;
        }
        html.light .site-footer p {
            color: #334155 !important;
        }
        html.light .site-footer a {
            color: #1e293b !important;
        }
        html.light .site-footer a:hover {
            color: #047857 !important;
        }
        html.light .site-footer h4 {
            color: #047857 !important;
            font-weight: 700 !important;
        }
        html.light .site-footer li,
        html.light .site-footer span {
            color: #334155 !important;
        }
        html.light .site-footer i {
            color: #047857 !important;
        }
        html.light .site-footer .social-icon {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #334155 !important;
        }
        html.light .site-footer .social-icon:hover {
            background-color: #ecfdf5 !important;
            border-color: #10b981 !important;
            color: #047857 !important;
        }
        html.light .site-footer .border-b,
        html.light .site-footer .border-slate-800\/80 {
            border-color: #e2e8f0 !important;
        }

        html.dark .site-footer {
            background-color: #0b0f19 !important;
            border-top: 1px solid #1e293b !important;
            color: #cbd5e1 !important;
        }
        html.dark .site-footer p {
            color: #cbd5e1 !important;
        }
        html.dark .site-footer a {
            color: #cbd5e1 !important;
        }
        html.dark .site-footer a:hover {
            color: #ffffff !important;
        }
        html.dark .site-footer h4 {
            color: #34d399 !important;
            font-weight: 700 !important;
        }
        html.dark .site-footer li,
        html.dark .site-footer span {
            color: #cbd5e1 !important;
        }
        html.dark .site-footer i {
            color: #34d399 !important;
        }
        html.dark .site-footer .social-icon {
            background-color: #0f172a !important;
            border-color: #1e293b !important;
            color: #cbd5e1 !important;
        }
        html.dark .site-footer .social-icon:hover {
            background-color: #1e293b !important;
            border-color: #34d399 !important;
            color: #34d399 !important;
        }
        html.dark .site-footer .border-b,
        html.dark .site-footer .border-slate-800\/80 {
            border-color: #1e293b !important;
        }

        /* 10MS Bento & Portal Card Enhancements for Light Mode */
        html.light .bento-card {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05) !important;
        }
        html.light .bento-card h3 {
            color: #0f172a !important;
        }
        html.light .bento-card p {
            color: #475569 !important;
        }

        html.light .student-portal-banner {
            background: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 50%, #ffffff 100%) !important;
            border-color: #a7f3d0 !important;
            box-shadow: 0 10px 30px -5px rgba(16, 185, 129, 0.12) !important;
        }
        html.light .student-portal-banner h3 {
            color: #064e3b !important;
        }
        html.light .student-portal-banner p {
            color: #334155 !important;
        }

        /* About Page & Team Cards (Light & Dark Theme Optimization) */
        html.light .about-page-wrapper {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        html.light .about-page-wrapper section {
            background-color: transparent !important;
            border-color: #e2e8f0 !important;
        }
        html.light .about-page-wrapper h1,
        html.light .about-page-wrapper h2,
        html.light .about-page-wrapper h3,
        html.light .about-page-wrapper h4,
        html.light .about-page-wrapper h5 {
            color: #0f172a !important;
        }
        html.light .about-page-wrapper p,
        html.light .about-page-wrapper .text-slate-300,
        html.light .about-page-wrapper .text-slate-400 {
            color: #475569 !important;
        }
        html.light .about-page-wrapper .team-card {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 1px 3px rgba(15, 23, 42, 0.04) !important;
        }
        html.light .about-page-wrapper .team-card:hover {
            border-color: #10b981 !important;
            box-shadow: 0 12px 28px -4px rgba(16, 185, 129, 0.15) !important;
        }
        html.light .about-page-wrapper .team-card h3,
        html.light .about-page-wrapper .team-card h4,
        html.light .about-page-wrapper .team-card h5 {
            color: #0f172a !important;
        }
        html.light .about-page-wrapper .team-card p {
            color: #64748b !important;
        }
        html.light .about-page-wrapper .team-card div {
            border-color: #cbd5e1 !important;
        }

        html.dark .about-page-wrapper .team-card {
            background-color: rgba(15, 23, 42, 0.85) !important;
            border: 1px solid rgba(51, 65, 85, 0.7) !important;
            box-shadow: 0 4px 25px -2px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark .about-page-wrapper .team-card:hover {
            background-color: rgba(30, 41, 59, 0.95) !important;
            border-color: #10b981 !important;
            box-shadow: 0 12px 30px -4px rgba(16, 185, 129, 0.25) !important;
        }
        html.dark .about-page-wrapper .team-card h3,
        html.dark .about-page-wrapper .team-card h4,
        html.dark .about-page-wrapper .team-card h5 {
            color: #ffffff !important;
        }
        html.dark .about-page-wrapper .team-card p {
            color: #94a3b8 !important;
        }

        /* Universal Dark Mode Light Text Rules */
        html.dark,
        html.dark body {
            background-color: #030712 !important;
            color: #f1f5f9 !important;
        }
        html.dark h1,
        html.dark h2,
        html.dark h3,
        html.dark h4,
        html.dark h5,
        html.dark h6 {
            color: #ffffff !important;
        }
        html.dark p {
            color: #cbd5e1 !important;
        }
        html.dark li {
            color: #cbd5e1 !important;
        }
        html.dark .text-slate-400,
        html.dark [class*="text-slate-400"] {
            color: #94a3b8 !important;
        }
        html.dark .text-slate-300,
        html.dark [class*="text-slate-300"] {
            color: #cbd5e1 !important;
        }
        html.dark .text-slate-200,
        html.dark [class*="text-slate-200"] {
            color: #e2e8f0 !important;
        }
        html.dark .text-slate-100,
        html.dark [class*="text-slate-100"] {
            color: #f8fafc !important;
        }
        html.dark .text-slate-500,
        html.dark [class*="text-slate-500"] {
            color: #94a3b8 !important;
        }
        html.dark a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):not([class*="text-emerald"]):not([class*="text-brand"]) {
            color: #cbd5e1;
        }
        html.dark a:not(.btn):not([class*="bg-brand"]):not([class*="bg-emerald"]):not([class*="bg-rose"]):hover {
            color: #ffffff !important;
        }

        html.dark .bento-card {
            background-color: rgba(15, 23, 42, 0.7) !important;
            border-color: rgba(51, 65, 85, 0.7) !important;
        }
        html.dark .bento-card h3 {
            color: #ffffff !important;
        }
        html.dark .bento-card p {
            color: #94a3b8 !important;
        }

        html.dark .student-portal-banner {
            background: linear-gradient(135deg, rgba(6, 78, 59, 0.5) 0%, rgba(15, 23, 42, 0.95) 50%, #030712 100%) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }
        html.dark .student-portal-banner h3 {
            color: #ffffff !important;
        }
        html.dark .student-portal-banner p {
            color: #cbd5e1 !important;
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

        /* 5. Button Shimmer Light-Sweep Animation */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }
        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -150%;
            width: 80%;
            height: 200%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.35),
                transparent
            );
            transform: rotate(25deg);
            animation: btn-shine-sweep 4.5s ease-in-out infinite;
            pointer-events: none;
        }
        @keyframes btn-shine-sweep {
            0%, 65% {
                left: -150%;
            }
            100% {
                left: 200%;
            }
        }

        /* 6. Kinetic Gradient Wave for Headlines */
        .text-gradient-animated {
            background: linear-gradient(135deg, #ffffff 0%, var(--brand-primary, #10b981) 40%, var(--brand-cyan, #22d3ee) 75%, #ffffff 100%);
            background-size: 250% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: text-gradient-shift 8s ease infinite;
        }
        @keyframes text-gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        html.light .text-gradient-animated {
            background: linear-gradient(135deg, #0f172a 0%, var(--brand-primary, #10b981) 45%, #0284c7 80%, #0f172a 100%);
            background-size: 250% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: text-gradient-shift 8s ease infinite;
        }

        /* 7. Card Ambient Glow & Micro-Lift */
        .card-interactive-glow {
            position: relative;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-interactive-glow:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.6), 0 0 35px -5px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.25) !important;
        }
        html.light .card-interactive-glow:hover {
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.12), 0 0 30px -5px rgba(var(--brand-primary-rgb, 16, 185, 129), 0.2) !important;
        }

        /* 8. Floating Badges */
        @keyframes badge-float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-4px);
            }
        }
        .animate-badge-float {
            animation: badge-float 3.5s ease-in-out infinite;
        }

        /* 9. Interactive Accordion Polish & Light Mode Contrast */
        .accordion-item {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .accordion-item:hover {
            transform: translateY(-2px);
        }
        html.light .accordion-item {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 2px 8px -1px rgba(15, 23, 42, 0.04) !important;
        }
        html.light .accordion-item:hover {
            border-color: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.5) !important;
            box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.08) !important;
        }
        html.light .accordion-toggle {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
        html.light .accordion-toggle:hover {
            background-color: #f8fafc !important;
        }
        html.light .accordion-toggle span,
        html.light .accordion-toggle .accordion-title,
        html.light .accordion-toggle span.text-white,
        html.light [class*="accordion"] button span {
            color: #0f172a !important;
        }
        html.light .accordion-toggle:hover span.accordion-title {
            color: var(--brand-primary, #10b981) !important;
        }
        html.light .accordion-toggle .font-mono {
            background-color: #ecfdf5 !important;
            color: #047857 !important;
            border: 1px solid #a7f3d0 !important;
        }
        html.light .accordion-toggle .fa-chevron-down {
            color: #64748b !important;
        }
        html.light .accordion-toggle:hover .fa-chevron-down {
            color: #047857 !important;
        }
        html.light .accordion-item div[id^="content-item-"] {
            background-color: #ffffff !important;
            border-top-color: #f1f5f9 !important;
            color: #334155 !important;
        }
        html.light .accordion-item div[id^="content-item-"] * {
            color: #334155 !important;
        }
        html.light .accordion-item div[id^="content-item-"] strong {
            color: #0f172a !important;
        }

        /* 10. Card Hover Micro-Lift & Soft Pulse Glow */
        .hover-card-lift {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
        }
        .hover-card-lift:hover {
            transform: translateY(-4px);
        }
        html.light .hover-card-lift:hover {
            box-shadow: 0 16px 32px -8px rgba(15, 23, 42, 0.1) !important;
            border-color: rgba(var(--brand-primary-rgb, 16, 185, 129), 0.4) !important;
        }
        @keyframes pulse-subtle {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(var(--brand-primary-rgb, 16, 185, 129), 0.35);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(var(--brand-primary-rgb, 16, 185, 129), 0);
            }
        }
        .animate-pulse-glow {
            animation: pulse-subtle 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* 11. Top Announcement Strip Newsfeed Continuous Running Marquee Animation */
        @keyframes newsfeed-ticker {
            0% {
                transform: translate3d(0, 0, 0);
            }
            100% {
                transform: translate3d(-50%, 0, 0);
            }
        }
        .newsfeed-container {
            overflow: hidden;
            position: relative;
            white-space: nowrap;
            background: transparent !important;
        }
        .newsfeed-track {
            display: inline-flex;
            white-space: nowrap;
            animation: newsfeed-ticker 42s linear infinite;
            will-change: transform;
        }
        .newsfeed-container:hover .newsfeed-track {
            animation-play-state: paused;
        }

        /* 12. Pill Badges Crystal-Clear Contrast in Light Mode */
        html.light div.inline-flex.rounded-full[class*="bg-emerald-"] span,
        html.light div.inline-flex.rounded-full[class*="bg-emerald-"] i,
        html.light div.inline-flex.rounded-full[class*="border-emerald-"] span,
        html.light div.inline-flex.rounded-full[class*="border-emerald-"] i {
            color: #064e3b !important;
            font-weight: 800 !important;
        }
        html.light div.inline-flex.rounded-full[class*="bg-emerald-100"] {
            background-color: #d1fae5 !important;
            border-color: #6ee7b7 !important;
        }

        /* 13. Filter Count Badge Contrast */
        .filter-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 22px;
            height: 20px;
            padding: 0 6px;
            border-radius: 9999px;
            font-weight: 800 !important;
            font-size: 11px !important;
        }
        .course-filter-btn.active .filter-count,
        html.light .course-filter-btn.active .filter-count {
            background-color: rgba(255, 255, 255, 0.28) !important;
            color: #ffffff !important;
        }
        .course-filter-btn:not(.active) .filter-count,
        html.light .course-filter-btn:not(.active) .filter-count {
            background-color: #e2e8f0 !important;
            color: #0f172a !important;
        }

        /* 14. Course Syllabus CTA Button */
        html.light .course-item-card a .inline-flex.rounded-xl {
            background-color: #059669 !important;
            border-color: #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(5, 150, 105, 0.25) !important;
        }
        html.light .course-item-card a .inline-flex.rounded-xl * {
            color: #ffffff !important;
        }
        /* 15. Top Announcement Strip Gap Fix (Flush against browser viewport top even on 110% zoom) */
        #top-announcement-strip {
            top: -2px !important;
            padding-top: calc(0.375rem + 2px) !important;
            left: 0 !important;
            right: 0 !important;
            margin: 0 !important;
        }

        /* 16. Home Page Category Pills Styling */
        .category-pill {
            cursor: pointer;
            user-select: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            font-weight: 700 !important;
            display: inline-flex;
            align-items: center;
        }
        .category-pill.active {
            background-color: #059669 !important;
            border: 1px solid #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px -1px rgba(5, 150, 105, 0.35) !important;
        }
        .category-pill.active * {
            color: #ffffff !important;
        }
        html.light .category-pill:not(.active) {
            background-color: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            color: #1e293b !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        html.light .category-pill:not(.active) span {
            color: #1e293b !important;
        }
        html.light .category-pill:not(.active):hover {
            background-color: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }
        html.light .category-pill:not(.active):hover span {
            color: #0f172a !important;
        }
        html.dark .category-pill:not(.active) {
            background-color: #0f172a !important;
            border: 1px solid #334155 !important;
            color: #cbd5e1 !important;
        }
        html.dark .category-pill:not(.active) span {
            color: #cbd5e1 !important;
        }
        html.dark .category-pill:not(.active):hover {
            background-color: #1e293b !important;
            border-color: #475569 !important;
            color: #ffffff !important;
        }
        html.dark .category-pill:not(.active):hover span {
            color: #ffffff !important;
        }

        /* 17. Image Overlay Cards: Always Crisp White Text in Both Light & Dark Modes */
        #international-works h4,
        #international-works h4 *,
        #international-works .card-overlay-text h4,
        #international-works .card-overlay-text h4 *,
        html.light #international-works h4,
        html.light #international-works h4 *,
        html.light #international-works .card-overlay-text h4,
        html.light #international-works .card-overlay-text h4 * {
            color: #ffffff !important;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
        }
        #international-works .group:hover h4,
        #international-works .group:hover h4 *,
        html.light #international-works .group:hover h4,
        html.light #international-works .group:hover h4 * {
            color: #67e8f9 !important; /* cyan-300 */
        }
        #international-works .card-overlay-text span:not([class*="text-cyan"]),
        html.light #international-works .card-overlay-text span:not([class*="text-cyan"]) {
            color: #ffffff !important;
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
                        sans: ['system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Noto Sans Bengali"', 'sans-serif'],
                        display: ['system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Noto Sans Bengali"', 'sans-serif'],
                        bangla: ['"Noto Sans Bengali"', 'sans-serif'],
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

            // 5. Tactile 3D Tilt Interaction on Media & Key Cards
            document.addEventListener('DOMContentLoaded', function() {
                var tiltCards = document.querySelectorAll('.tilt-on-hover');
                tiltCards.forEach(function(card) {
                    card.style.transition = 'transform 0.15s ease-out';
                    card.style.transformStyle = 'preserve-3d';
                    card.addEventListener('mousemove', function(e) {
                        var rect = card.getBoundingClientRect();
                        var x = e.clientX - rect.left;
                        var y = e.clientY - rect.top;
                        var centerX = rect.width / 2;
                        var centerY = rect.height / 2;
                        var rotateX = ((y - centerY) / centerY) * -6;
                        var rotateY = ((x - centerX) / centerX) * 6;
                        card.style.transform = 'perspective(1000px) rotateX(' + rotateX.toFixed(2) + 'deg) rotateY(' + rotateY.toFixed(2) + 'deg) translateY(-4px)';
                    });
                    card.addEventListener('mouseleave', function() {
                        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
                    });
                });
            });
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
