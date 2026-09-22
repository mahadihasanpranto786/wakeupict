<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Credentials — Wake Up ICT</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

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
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glow-emerald': '0 0 40px -10px rgba(16, 185, 129, 0.35)',
                        'card-glow': '0 25px 50px -12px rgba(0, 0, 0, 0.8), 0 0 50px -10px rgba(16, 185, 129, 0.15)',
                    },
                    animation: {
                        'float': 'float 8s ease-in-out infinite',
                        'float-reverse': 'floatReverse 10s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                            '50%': { transform: 'translate(25px, -35px) scale(1.08)' },
                        },
                        floatReverse: {
                            '0%, 100%': { transform: 'translate(0px, 0px) scale(1)' },
                            '50%': { transform: 'translate(-30px, 30px) scale(1.1)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .bg-grid-cyber {
            background-size: 36px 36px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }

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
            background: linear-gradient(60deg, transparent 30%, rgba(255, 255, 255, 0.25) 50%, transparent 70%);
            transform: rotate(30deg);
            animation: btnSweep 4s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        @keyframes btnSweep {
            0% { transform: translateX(-150%) rotate(30deg); }
            40%, 100% { transform: translateX(150%) rotate(30deg); }
        }
    </style>
</head>

<body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between relative overflow-x-hidden selection:bg-brand-primary selection:text-slate-950">

    <!-- Ambient Glow Orbs -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-32 -left-32 w-[600px] h-[600px] bg-gradient-to-br from-emerald-500/20 via-brand-primary/10 to-transparent rounded-full blur-[140px] animate-float"></div>
        <div class="absolute -bottom-40 -right-40 w-[650px] h-[650px] bg-gradient-to-tl from-cyan-500/15 via-indigo-500/10 to-transparent rounded-full blur-[150px] animate-float-reverse"></div>
        <div class="absolute inset-0 bg-grid-cyber opacity-70 [mask-image:radial-gradient(ellipse_at_center,black_40%,transparent_80%)]"></div>
    </div>

    <!-- Header -->
    <header class="relative z-20 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8 flex items-center justify-between">
        <a href="{{ route('home-page') }}" class="flex items-center gap-3">
            <div class="relative w-10 h-10 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-center p-2 shadow-lg">
                <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <div class="text-base font-extrabold tracking-tight text-white">WAKE UP ICT</div>
                <div class="text-[10px] font-mono text-slate-400 tracking-wider uppercase">Enterprise Portal</div>
            </div>
        </a>

        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-900/70 hover:bg-slate-800 border border-slate-800 text-xs font-mono text-slate-300 hover:text-emerald-400 transition-all backdrop-blur-md">
            <i class="fa fa-arrow-left text-[10px]"></i>
            <span>Back to Login</span>
        </a>
    </header>

    <!-- Main Container -->
    <main class="relative z-10 flex-grow flex items-center justify-center px-4 sm:px-6 py-10 sm:py-14">
        <div class="w-full max-w-md">
            
            <div class="glass-card rounded-3xl p-6 sm:p-10 shadow-card-glow">
                
                <div class="text-center mb-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Credential Recovery</span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight mb-2">
                        Reset Password
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Enter your verified email address to receive an authentication recovery link.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs font-mono flex items-center gap-2.5">
                        <i class="fa fa-check-circle text-sm text-emerald-400"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2">
                            Registered Account Email
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
                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/80 border @error('email') border-rose-500/80 focus:border-rose-500 @else border-slate-800 focus:border-emerald-500 @enderror focus:ring-2 focus:ring-emerald-500/20 focus:outline-none text-white placeholder-slate-500 text-sm transition-all"
                            />
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-rose-400 font-mono flex items-center gap-1">
                                <i class="fa fa-triangle-exclamation text-[10px]"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="btn-shimmer group relative w-full flex items-center justify-center gap-3 py-3.5 px-6 rounded-xl font-bold text-sm tracking-wider uppercase bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-slate-950 shadow-glow-emerald transition-all hover:-translate-y-0.5"
                        >
                            <span>Transmit Recovery Link</span>
                            <i class="fa fa-paper-plane text-xs group-hover:translate-x-1.5 transition-transform duration-200"></i>
                        </button>
                    </div>

                    <div class="text-center pt-2">
                        <a href="{{ route('login') }}" class="text-xs font-mono text-slate-400 hover:text-emerald-400 transition-colors">
                            Remembered password? <span class="text-emerald-400 underline">Sign In</span>
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </main>

    <footer class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-xs text-slate-500 font-mono">
        <p>&copy; {{ date('Y') }} Wake Up ICT. All rights reserved.</p>
    </footer>

</body>
</html>
