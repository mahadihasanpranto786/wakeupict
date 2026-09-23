@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-32 pb-24 flex items-center justify-center">
    <!-- Ambient Lighting & Mesh -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-brand-primary/15 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-2xl w-full mx-auto px-4 sm:px-6 relative z-10 text-center">
        <div class="rounded-3xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-2xl p-8 sm:p-12 shadow-2xl">
            
            <!-- Success Icon Animation -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-emerald-500/10 border-2 border-emerald-500/30 text-emerald-400 flex items-center justify-center mx-auto mb-6 shadow-glow-emerald animate-pulse">
                <i class="fa fa-check text-3xl sm:text-4xl"></i>
            </div>

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono tracking-wider uppercase mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-primary"></span>
                <span>Registration Successful</span>
            </div>

            <!-- Headline -->
            <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-2 leading-tight">
                ধন্যবাদ, <span class="text-brand-primary">{{ $student_name }}</span>!
            </h1>
            <p class="text-slate-300 text-base sm:text-lg mb-6">
                আপনার আবেদন সফলভাবে গৃহীত হয়েছে।
            </p>

            <!-- Information Card -->
            <div class="p-5 rounded-2xl bg-slate-950/60 border border-slate-800 text-left mb-8 space-y-3">
                <div class="flex items-start gap-3">
                    <i class="fa fa-info-circle text-brand-cyan text-base mt-0.5 flex-shrink-0"></i>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        আমাদের অ্যাডমিশন টিম আপনার আবেদনটি পর্যালোচনা করবে এবং পরবর্তীতে আপনার সাথে ফোনে অথবা ইমেইলে ভর্তির বিষয়ে সরাসরি যোগাযোগ করবে।
                    </p>
                </div>
                <div class="flex items-start gap-3 pt-2 border-t border-slate-800/60">
                    <i class="fa fa-phone text-brand-primary text-base mt-0.5 flex-shrink-0"></i>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        জরুরি প্রয়োজনে আমাদের হেল্পলাইনে সরাসরি কল করুন: <strong class="text-white">{{ app_setting('contact_phone', '01700-000000') }}</strong>
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ url('/') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-semibold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fa fa-home"></i>
                    <span>Home Page</span>
                </a>
                <a href="{{ route('academic-training') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-semibold text-sm tracking-wider uppercase bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 hover:border-slate-600 transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fa fa-book"></i>
                    <span>Browse More Courses</span>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
