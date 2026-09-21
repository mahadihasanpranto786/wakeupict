<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts: Plus Jakarta Sans, Inter, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
                            primary: '#10b981',
                            primaryHover: '#059669',
                            accent: '#34d399',
                            cyan: '#22d3ee',
                            indigo: '#6366f1',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 25px -5px rgba(16, 185, 129, 0.35)',
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
    <link rel="shortcut icon" type="image/jpg" href="{{ URL::asset('frontend/image/wakeupict-fabicon.png') }}" />

    <!-- Toastr Notifications & Datepicker -->
    <link rel="stylesheet" href="{{ URL::asset('admin/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/datepicker/datepicker.css') }}">

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

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #030712;
        }
        ::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #10b981;
        }
        
        /* Subtle grid background utility */
        .bg-grid-mesh {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }

        .hero-mesh-glow {
            background: radial-gradient(circle at 50% 20%, rgba(16, 185, 129, 0.12) 0%, rgba(6, 182, 212, 0.06) 40%, transparent 70%);
        }
    </style>

    @stack('css')
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased selection:bg-emerald-500 selection:text-slate-950 min-h-screen flex flex-col overflow-x-hidden">

    <!-- Header Navigation -->
    @include('frontend.theme.clasic.include.header')

    <!-- Main Dynamic Content -->
    <main class="flex-grow w-full">
        @yield('maincontent')
    </main>

    <!-- Footer -->
    @include('frontend.theme.clasic.include.footer')

    <!-- Scripts -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    
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
    <script src="{{ URL::asset('admin/js/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('admin/sweetalert/sweetalert.min.js') }}"></script>

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
    <script src="{{ URL::asset('common/jquery.form-validation.min.js') }}"></script>
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
