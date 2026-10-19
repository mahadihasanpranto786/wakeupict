@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('title', 'Student Login — Wake Up ICT Portal')

@section('maincontent')
<div class="relative w-full min-h-screen pt-36 pb-24 flex items-center justify-center px-4">
    <!-- Ambient Lights -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-brand-primary/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="rounded-3xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-2xl p-8 sm:p-10 shadow-2xl">
            
            <!-- Logo & Badge -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-4 group">
                    <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT" class="w-12 h-12 object-contain group-hover:scale-105 transition-transform">
                </a>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono uppercase tracking-widest font-semibold mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Student Portal Access</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Student Login</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1.5">Enter your Student ID, Email, or Phone to access your courses.</p>
            </div>

            <!-- Error Alerts -->
            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-300 text-xs mb-6 space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-2">
                            <i class="fa fa-exclamation-circle text-rose-400"></i>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Default Password Tip for Online Admitted Students -->
            <div class="mb-6 p-3.5 rounded-2xl bg-brand-primary/10 border border-brand-primary/30 text-xs text-slate-300 space-y-1">
                <div class="flex items-center gap-1.5 font-bold text-brand-primary">
                    <i class="fa fa-info-circle text-sm"></i>
                    <span>অনলাইন ভর্তি হওয়া শিক্ষার্থীদের জন্য:</span>
                </div>
                <p class="text-[11px] text-slate-300 leading-relaxed font-sans">
                    ইউজারনেম হিসেবে আপনার <strong>Student ID</strong> অথবা <strong>মোবাইল নম্বর</strong> লিখুন। প্রাথমিক ডিফল্ট পাসওয়ার্ড হলো আপনার <strong>মোবাইল নম্বরের শেষ ৬ ডিজিট</strong>।
                </p>
            </div>

            <!-- Form -->
            <form action="{{ route('student.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="login_id" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Student ID / Email / Phone
                    </label>
                    <div class="relative">
                        <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="text" id="login_id" name="login_id" value="{{ old('login_id') }}" required autofocus
                               placeholder="e.g. WUICT-2026-0001 or 017XXXXXXXX"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">
                            Password
                        </label>
                    </div>
                    <div class="relative">
                        <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="password" id="password" name="password" required
                               placeholder="••••••••"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer select-none text-slate-400 hover:text-slate-300">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded bg-slate-950 border-slate-800 text-brand-primary focus:ring-brand-primary focus:ring-offset-0">
                        <span>Remember Me</span>
                    </label>
                    <span class="text-slate-500">Need help? Call admission</span>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl font-bold text-xs uppercase tracking-widest bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fa fa-sign-in"></i>
                    <span>Sign In to Dashboard</span>
                </button>
            </form>

            <!-- Registration Link -->
            <div class="mt-8 pt-6 border-t border-slate-800/80 text-center">
                <p class="text-xs text-slate-400">
                    New student or admitted recently?
                    <a href="{{ route('student.register') }}" class="font-bold text-brand-primary hover:underline ml-1">
                        Create / Claim Account
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
