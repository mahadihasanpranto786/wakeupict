<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal Authentication — Wake Up ICT</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" />

    <!-- Google Fonts: Plus Jakarta Sans, Inter, Noto Sans Bengali, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS (v3 CDN) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,aspect-ratio"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#10b981',
                            primaryHover: '#059669',
                            accent: '#34d399',
                            cyan: '#06b6d4',
                            indigo: '#6366f1',
                            dark: '#030712',
                            card: '#0b1329',
                            border: '#1e293b',
                        }
                    },
                    fontFamily: {
                        sans: {!! App::getLocale() == 'bn' ? '[\'"Noto Sans Bengali"\', \'"Source Sans Pro"\', \'sans-serif\']' : '[\'"Plus Jakarta Sans"\', \'Inter\', \'"Noto Sans Bengali"\', \'sans-serif\']' !!},
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 40px -10px rgba(16, 185, 129, 0.35)',
                        'glow-cyan': '0 0 40px -10px rgba(6, 182, 212, 0.35)',
                        'card-glow': '0 25px 50px -12px rgba(0, 0, 0, 0.8), 0 0 50px -10px rgba(16, 185, 129, 0.15)',
                    },
                    animation: {
                        'float': 'float 8s ease-in-out infinite',
                        'float-reverse': 'floatReverse 10s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'shimmer': 'shimmer 2.5s infinite',
                        'glow-pulse': 'glowPulse 3s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                            '50%': { transform: 'translate(25px, -35px) scale(1.08)' },
                        },
                        floatReverse: {
                            '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                            '50%': { transform: 'translate(-30px, 30px) scale(1.1)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        glowPulse: {
                            '0%': { opacity: '0.35', transform: 'scale(0.98)' },
                            '100%': { opacity: '0.7', transform: 'scale(1.02)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Cyber Grid Background Utility */
        .bg-grid-cyber {
            background-size: 36px 36px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }

        /* Ambient Glass Card Reflection */
        .glass-card {
            background: rgba(11, 19, 41, 0.72);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(16, 185, 129, 0.6), rgba(6, 182, 212, 0.6), transparent);
        }

        /* Button Light-Sweep Shimmer */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                60deg,
                transparent 30%,
                rgba(255, 255, 255, 0.25) 50%,
                transparent 70%
            );
            transform: rotate(30deg);
            animation: btnSweep 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        @keyframes btnSweep {
            0% { transform: translateX(-150%) rotate(30deg); }
            40%, 100% { transform: translateX(150%) rotate(30deg); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #030712; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #10b981; }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden selection:bg-brand-primary selection:text-slate-950">

    <!--========================== Ambient Dynamic Glow Orbs ============================-->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <!-- Top Left Emerald Orb -->
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] bg-gradient-to-br from-emerald-500/20 via-brand-primary/10 to-transparent rounded-full blur-[140px] animate-float"></div>
        
        <!-- Bottom Right Cyan/Indigo Orb -->
        <div class="absolute -bottom-40 -right-40 w-[650px] h-[650px] bg-gradient-to-tl from-cyan-500/15 via-indigo-500/10 to-transparent rounded-full blur-[150px] animate-float-reverse"></div>
        
        <!-- Center Core Ambient Accent -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-emerald-500/5 rounded-full blur-[120px] pointer-events-none animate-pulse-slow"></div>
        
        <!-- Cyber Background Grid -->
        <div class="absolute inset-0 bg-grid-cyber opacity-70 [mask-image:radial-gradient(ellipse_at_center,black_40%,transparent_80%)]"></div>
    </div>

    <!--========================== Top Navigation Bar ============================-->
    <header class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 flex items-center justify-between">
        <!-- Brand Logo -->
        <a href="{{ route('home-page') }}" class="group flex items-center gap-3 transition-transform duration-300 hover:scale-[1.02]">
            <div class="relative w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center p-2 shadow-lg group-hover:border-emerald-500/40 transition-colors">
                <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT Logo" class="w-full h-full object-contain">
                <span class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="absolute -top-1 -right-1 w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
            </div>
            <div>
                <div class="text-base font-extrabold tracking-tight text-white group-hover:text-brand-primary transition-colors flex items-center gap-1.5">
                    <span>WAKE UP ICT</span>
                </div>
                <div class="text-[10px] font-mono text-slate-400 tracking-wider uppercase">
                    Enterprise Portal
                </div>
            </div>
        </a>

        <!-- Return to Main Site Link -->
        <a href="{{ route('home-page') }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-900/70 hover:bg-slate-800/90 border border-slate-800/80 hover:border-emerald-500/40 text-xs font-mono text-slate-300 hover:text-emerald-400 transition-all duration-200 backdrop-blur-md">
            <i class="fa fa-arrow-left text-[10px]"></i>
            <span class="hidden sm:inline">Return to Website</span>
            <span class="sm:hidden">Home</span>
        </a>
    </header>

    <!--========================== Main Authentication Container ============================-->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 sm:px-6 py-10 sm:py-14">
        <div class="w-full max-w-md">
            
            <!-- Glassmorphic Auth Card -->
            <div class="glass-card rounded-3xl p-6 sm:p-10 shadow-card-glow transition-all duration-300">
                
                <!-- Card Header -->
                <div class="text-center mb-8">
                    <!-- Status Badge -->
                   

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-snug mb-2">
                        System Access
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Authenticate with your registered credentials to initiate administrative session.
                    </p>
                </div>

                <!-- Session / Validation Flash Alerts -->
                @if (session('status'))
                    <div class="mb-6 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-mono flex items-center gap-2.5">
                        <i class="fa fa-check-circle text-sm"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs flex items-start gap-2.5">
                        <i class="fa fa-circle-exclamation text-sm mt-0.5 text-rose-400 flex-shrink-0"></i>
                        <div>
                            <span class="font-semibold block font-mono">Authentication Unsuccessful</span>
                            <span class="text-slate-300 text-[11px] leading-relaxed">Please check your email and password before trying again.</span>
                        </div>
                    </div>
                @endif

                <!-- Authentication Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2 flex items-center justify-between">
                            <span>Account Email</span>
                            <span class="text-slate-500 text-[10px]">Required</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa fa-envelope text-sm"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus
                                placeholder="engineer@wakeupict.com"
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/80 border @error('email') border-rose-500/80 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 @enderror focus:ring-2 focus:outline-none text-white placeholder-slate-500 text-sm transition-all duration-200"
                            />
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-rose-400 font-mono flex items-center gap-1">
                                <i class="fa fa-triangle-exclamation text-[10px]"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-mono text-emerald-400 hover:text-emerald-300 transition-colors">
                                    Forgot?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa fa-shield-halved text-sm"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                placeholder="••••••••••••"
                                class="w-full pl-10 pr-11 py-3 rounded-xl bg-slate-950/80 border @error('password') border-rose-500/80 focus:border-rose-500 focus:ring-rose-500/20 @else border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 @enderror focus:ring-2 focus:outline-none text-white placeholder-slate-500 text-sm font-mono tracking-wider transition-all duration-200"
                            />
                            <!-- Show/Hide Password Interactive Button -->
                            <button 
                                type="button" 
                                id="togglePasswordBtn" 
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition-colors focus:outline-none"
                                title="Toggle Password Visibility"
                                aria-label="Toggle Password Visibility"
                            >
                                <i id="togglePasswordIcon" class="fa fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-rose-400 font-mono flex items-center gap-1">
                                <i class="fa fa-triangle-exclamation text-[10px]"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Session Checkbox -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="relative flex items-center gap-3 cursor-pointer select-none group">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember" 
                                {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 rounded bg-slate-950 border-slate-700 text-emerald-500 focus:ring-emerald-500/20 focus:ring-offset-0 focus:ring-offset-transparent cursor-pointer transition-colors"
                            />
                            <span class="text-xs text-slate-300 group-hover:text-white transition-colors font-medium">
                                Keep session active
                            </span>
                        </label>

                        <div class="flex items-center gap-1 text-[11px] font-mono text-slate-500">
                            <i class="fa fa-lock text-[10px] text-emerald-500/70"></i>
                            <span>End-to-End</span>
                        </div>
                    </div>

                    <!-- Submit Button with Shimmer Sweep -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="btn-shimmer group relative w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl font-bold text-sm tracking-wider uppercase bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-slate-950 shadow-glow-emerald hover:shadow-[0_0_50px_-5px_rgba(16,185,129,0.5)] transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0"
                        >
                            <span>Authenticate Session</span>
                            <i class="fa fa-arrow-right text-xs group-hover:translate-x-1.5 transition-transform duration-200"></i>
                        </button>
                    </div>

                </form>

                <!-- Divider -->
                <div class="relative my-7">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-800/80"></div>
                    </div>
                    <div class="relative flex justify-center text-[10px] font-mono uppercase tracking-widest text-slate-500">
                        <span class="bg-slate-900/90 px-3 py-0.5 rounded-full border border-slate-800">Protected Architecture</span>
                    </div>
                </div>

                <!-- Assistance / Secondary Links -->
                <div class="text-center">
                    <p class="text-xs text-slate-400">
                        Need access permissions? 
                        <a href="{{ route('contact-us-page') }}" class="text-emerald-400 hover:text-emerald-300 font-semibold underline underline-offset-4 transition-colors">
                            Contact Administration
                        </a>
                    </p>
                </div>

            </div>

            <!-- Security Trust Footnote -->
            <div class="mt-8 flex items-center justify-center gap-6 text-xs font-mono text-slate-500"> 
                <div class="flex items-center gap-1.5">
                    <i class="fa fa-server text-indigo-400/80"></i>
                    <span>Wake Up ICT</span>
                </div>
            </div>

        </div>
    </main>

    <!--========================== Footer ============================-->
    <footer class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-xs text-slate-500 font-mono">
        <p>&copy; {{ date('Y') }} Wake Up ICT. All rights reserved. Enterprise Computing & Academic Training.</p>
    </footer>

    <!-- Interactive Password Visibility Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (toggleBtn && passwordInput && toggleIcon) {
                toggleBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    
                    if (isPassword) {
                        passwordInput.setAttribute('type', 'text');
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash', 'text-emerald-400');
                    } else {
                        passwordInput.setAttribute('type', 'password');
                        toggleIcon.classList.remove('fa-eye-slash', 'text-emerald-400');
                        toggleIcon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>

</body>

</html>
