@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('title', 'Student Account Activation — Wake Up ICT')

@section('maincontent')
<div class="relative w-full min-h-screen pt-36 pb-24 flex items-center justify-center px-4">
    <!-- Ambient Lights -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-brand-cyan/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="rounded-3xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-2xl p-8 sm:p-10 shadow-2xl">
            
            <!-- Logo & Badge -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-4 group">
                    <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT" class="w-12 h-12 object-contain group-hover:scale-105 transition-transform">
                </a>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono uppercase tracking-widest font-semibold mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-pulse"></span>
                    <span>Account Setup</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">Create Student Account</h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1.5">Activate your student portal access using your admission phone number.</p>
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

            <!-- Form -->
            <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Full Name
                    </label>
                    <div class="relative">
                        <i class="fa fa-user-circle absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="e.g. Mahadi Hasan Pranto"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    </div>
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Mobile Phone Number
                    </label>
                    <div class="relative">
                        <i class="fa fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                               placeholder="017XXXXXXXX"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1">Use the same number used during course registration for auto-linking.</p>
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Email Address <span class="text-slate-500 lowercase">(optional)</span>
                    </label>
                    <div class="relative">
                        <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               placeholder="student@example.com"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Create Password
                    </label>
                    <div class="relative">
                        <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="password" id="password" name="password" required minlength="6"
                               placeholder="Minimum 6 characters"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <i class="fa fa-check-circle absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" required minlength="6"
                               placeholder="Re-enter password"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-4 rounded-xl font-bold text-xs uppercase tracking-widest bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa fa-check"></i>
                        <span>Activate & Enter Dashboard</span>
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="mt-8 pt-6 border-t border-slate-800/80 text-center">
                <p class="text-xs text-slate-400">
                    Already have an account?
                    <a href="{{ route('student.login') }}" class="font-bold text-brand-primary hover:underline ml-1">
                        Sign In here
                    </a>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
