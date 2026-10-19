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
                আপনার ভর্তি আবেদন ও অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে।
            </p>

            @if(isset($studentAccount) && $studentAccount)
            <!-- Student Portal Account Card -->
            <div class="p-6 rounded-2xl bg-slate-950/90 border border-brand-primary/30 text-left mb-6 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 px-3 py-1 bg-brand-primary/20 text-brand-primary text-xs font-mono uppercase font-bold rounded-bl-lg">
                    Student Portal Access
                </div>
                <h3 class="text-base font-bold text-white mb-3 flex items-center gap-2">
                    <i class="fa fa-user-circle text-brand-primary"></i>
                    <span>আপনার স্টুডেন্ট পোর্টাল লগইন তথ্য</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                    <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block font-mono">Student ID:</span>
                        <strong class="text-white font-mono text-base">{{ $studentIdCode ?? $studentAccount->student_id_code }}</strong>
                    </div>
                    <div class="bg-slate-900/80 p-3 rounded-xl border border-slate-800">
                        <span class="text-xs text-slate-400 block font-mono">Login Mobile / Phone:</span>
                        <strong class="text-brand-primary font-mono text-base">{{ $studentAccount->phone }}</strong>
                    </div>
                    @php
                        $displayPass = $tempPassword ?? (strlen(preg_replace('/[^\d]/', '', $studentAccount->phone)) >= 6 ? substr(preg_replace('/[^\d]/', '', $studentAccount->phone), -6) : '123456');
                    @endphp
                    <div class="bg-slate-900/80 p-3.5 rounded-xl border border-emerald-500/40 sm:col-span-2">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs text-slate-400 font-mono">Default Portal Password:</span>
                            <span class="text-[10px] text-emerald-400 font-mono font-semibold bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/30">Auto-Generated</span>
                        </div>
                        <div class="flex items-center justify-between bg-slate-950 p-2.5 rounded-lg border border-slate-800">
                            <strong class="text-emerald-400 font-mono text-lg tracking-widest font-black">{{ $displayPass }}</strong>
                            <span class="text-[11px] text-slate-400 font-sans">মোবাইল নম্বরের শেষ ৬ ডিজিট</span>
                        </div>
                        <span class="text-[11px] text-slate-400 block mt-1.5 leading-relaxed">
                            <i class="fa fa-info-circle text-brand-primary"></i> এই পাসওয়ার্ড দিয়ে লগইন করুন। পোর্টালে ঢুকে যেকোনো সময় নতুন পাসওয়ার্ড সেট করতে পারবেন।
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-3">
                    <span class="text-xs text-slate-400">অনলাইন পোর্টাল থেকে ক্লাস শিডিউল ও পেমেন্ট হিস্ট্রি দেখুন</span>
                    <a href="{{ route('student.login') }}" class="px-4 py-2 rounded-lg bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider hover:bg-brand-accent transition-colors flex items-center gap-2">
                        <span>স্টুডেন্ট লগইন</span>
                        <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endif

            <!-- Information Card -->
            <div class="p-5 rounded-2xl bg-slate-950/60 border border-slate-800 text-left mb-8 space-y-3">
                <div class="flex items-start gap-3">
                    <i class="fa fa-info-circle text-brand-cyan text-base mt-0.5 flex-shrink-0"></i>
                    <p class="text-sm text-slate-300 leading-relaxed">
                        আমাদের অ্যাডমিশন টিম আপনার আবেদনটি পর্যালোচনা করবে এবং পরবর্তীতে আপনার সাথে ফোনে সরাসরি যোগাযোগ করে ব্যাচ টাইম ও ক্লাসের দিন কনফার্ম করবে।
                    </p>
                </div>
                <div class="flex items-start gap-3 pt-2 border-t border-slate-800/60">
                    <i class="fa fa-phone text-brand-primary text-base mt-0.5 flex-shrink-0"></i>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        জরুরি প্রয়োজনে আমাদের হেল্পলাইনে সরাসরি কল করুন: <strong class="text-white">01791612121</strong>
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
