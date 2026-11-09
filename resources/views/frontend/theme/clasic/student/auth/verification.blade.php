@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('title', 'Registration Verification / Forgot Number — Wake Up ICT')

@section('maincontent')
<div class="relative w-full min-h-screen pt-24 sm:pt-28 pb-16 flex items-center justify-center px-4">
    <!-- Ambient Lighting -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-brand-primary/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-lg w-full relative z-10">
        <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-8 transition-all">

            <!-- Title & Header -->
            <div class="text-center mb-6">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-emerald-700 dark:text-brand-primary text-2xl mb-3 shadow-sm">
                    <i class="fa fa-id-card"></i>
                </div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 text-xs font-mono font-bold uppercase tracking-widest mb-2">
                    <span>Identity Verification</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    ভুলে যাওয়া রেজিস্ট্রেশন নম্বর উদ্ধার
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1 font-sans">
                    আপনার নিবন্ধিত মোবাইল নম্বর ও ব্যাচ প্রদান করে আপনার রেজিস্ট্রেশন নম্বর পুনরুদ্ধার করুন।
                </p>
            </div>

            <!-- RESULT: SUCCESS -->
            @if(isset($result) && $result['status'] === 'success' && !empty($result['student']))
                <div class="mb-6 p-5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-300 dark:border-emerald-700 text-slate-900 dark:text-slate-100 space-y-4">
                    <div class="flex items-center gap-2 font-bold text-emerald-800 dark:text-emerald-300 text-sm">
                        <i class="fa fa-check-circle text-lg text-emerald-600"></i>
                        <span>{{ $result['message'] }}</span>
                    </div>

                    <!-- Highlighted Box with Registration Number -->
                    <div class="p-4 rounded-xl bg-slate-900 text-white text-center shadow-md relative overflow-hidden">
                        <span class="text-[11px] font-mono text-emerald-400 uppercase tracking-wider block">Registration Number</span>
                        <div id="verifiedRegNum" class="text-2xl font-mono font-extrabold tracking-widest text-white my-1 select-all">
                            {{ $result['student']['registration_number'] }}
                        </div>
                        <button type="button" onclick="copyVerifiedReg()" id="copyVerifiedBtn"
                                class="mt-2 px-3 py-1.5 rounded-lg text-xs font-bold font-mono transition-all inline-flex items-center gap-1.5 cursor-pointer"
                                style="background-color: #10B981 !important; color: #000000 !important; font-weight: 800;">
                            <i class="fa fa-copy"></i>
                            <span id="copyVerifiedText">Copy Number</span>
                        </button>
                    </div>

                    <!-- Meta details -->
                    <div class="text-xs space-y-1.5 pt-1 text-slate-700 dark:text-slate-300 font-sans border-t border-emerald-200 dark:border-emerald-800/80">
                        <p><strong>Student Name:</strong> {{ $result['student']['name'] }}</p>
                        <p><strong>Course:</strong> {{ $result['student']['course_title'] }}</p>
                        <p><strong>Batch:</strong> {{ $result['student']['batch_number'] }} (Code: {{ $result['student']['batch_code'] }})</p>
                        <p><strong>Registered Phone:</strong> {{ $result['student']['phone_masked'] }}</p>
                        <p class="pt-1">
                            <strong>Status:</strong>
                            @if($result['student']['registration_status'] === 'approved')
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200">
                                    Approved (Active Portal Access)
                                </span>
                            @elseif($result['student']['registration_status'] === 'rejected')
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-bold bg-rose-100 text-rose-800 dark:bg-rose-900 dark:text-rose-200">
                                    Rejected
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded-md text-[11px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                                    Pending Admin Verification
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

            <!-- RESULT: BLOCKED (Exceeded 3 attempts) -->
            @elseif(isset($result) && $result['status'] === 'blocked')
                <div class="mb-6 p-5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-300 dark:border-rose-800 text-slate-800 dark:text-slate-200 space-y-3">
                    <div class="flex items-center gap-2 font-bold text-rose-700 dark:text-rose-400 text-sm">
                        <i class="fa fa-lock text-lg"></i>
                        <span>স্বয়ংক্রিয় ভেরিফিকেশন স্থগিত (Blocked)</span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-sans">
                        {{ $result['message'] }}
                    </p>
                    <div class="p-3 rounded-xl bg-white dark:bg-slate-900 border border-rose-200 dark:border-rose-900 text-xs">
                        <p class="text-slate-600 dark:text-slate-400 font-sans">
                            অ্যাডমিন পর্যালোচনার পর এই নম্বরের ভেরিফিকেশন অনুমোদন করা হলে পুনরায় চেক করা যাবে। তাৎক্ষণিক তথ্যের জন্য হেল্পলাইনে যোগাযোগ করুন:
                            <a href="tel:01791612121" class="font-bold text-rose-600 dark:text-rose-400 font-mono">01791612121</a>
                        </p>
                    </div>
                </div>

            <!-- RESULT: FAILED -->
            @elseif(isset($result) && $result['status'] === 'failed')
                <div class="mb-6 p-4 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-300 dark:border-amber-800 text-slate-800 dark:text-slate-200 space-y-2">
                    <div class="flex items-center gap-2 font-bold text-amber-800 dark:text-amber-400 text-xs sm:text-sm">
                        <i class="fa fa-exclamation-circle text-base"></i>
                        <span>যাচাইকরণ ব্যর্থ (Verification Failed)</span>
                    </div>
                    <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed font-sans">
                        {{ $result['message'] }}
                    </p>
                </div>

            <!-- RESULT: OTP REQUIRED -->
            @elseif(isset($result) && $result['status'] === 'otp_required')
                <div class="mb-6 p-5 rounded-2xl bg-cyan-50 dark:bg-cyan-950/40 border border-cyan-300 dark:border-cyan-800 text-slate-800 dark:text-slate-200 space-y-3">
                    <div class="flex items-center gap-2 font-bold text-cyan-800 dark:text-cyan-400 text-sm">
                        <i class="fa fa-mobile-phone text-xl"></i>
                        <span>ওটিপি যাচাই (SMS OTP Verification)</span>
                    </div>
                    <p class="text-xs text-slate-700 dark:text-slate-300 font-sans">
                        {{ $result['message'] }}
                    </p>

                    <form action="{{ route('student.registration.verification.otp') }}" method="POST" class="space-y-3 pt-2">
                        @csrf
                        <input type="hidden" name="verification_id" value="{{ $result['verification_id'] }}">
                        <div>
                            <label for="otp_code" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1">
                                Enter 6-Digit OTP Code
                            </label>
                            <input type="text" id="otp_code" name="otp_code" required maxlength="6"
                                   placeholder="123456"
                                   class="w-full px-4 py-2.5 rounded-xl bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-center font-mono text-lg font-bold tracking-widest text-slate-900 dark:text-white">
                        </div>
                        <button type="submit"
                                class="w-full py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary text-white shadow-md">
                            Verify &amp; Show Registration Number
                        </button>
                    </form>
                </div>
            @endif

            <!-- Errors -->
            @if($errors->any())
                <div class="auth-error-alert p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/70 border-2 border-rose-400 dark:border-rose-800 text-xs mb-5 space-y-2 shadow-sm font-sans" style="background-color: #FEF2F2 !important; border-color: #F87171 !important;">
                    @foreach($errors->all() as $error)
                        <div class="flex items-start gap-2.5 font-bold leading-relaxed" style="color: #991B1B !important;">
                            <i class="fa fa-times-circle flex-shrink-0 text-sm mt-0.5" style="color: #DC2626 !important;"></i>
                            <span class="text-xs font-bold leading-relaxed" style="color: #991B1B !important; font-weight: 700;">{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Verification Submission Form -->
            <form action="{{ route('student.registration.verification.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="phone" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                        Registered Mobile Phone Number <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                               placeholder="017XXXXXXXX"
                               class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm font-mono focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                    </div>
                </div>

                <div>
                    <label for="batch_code" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                        Batch Code / Batch Number <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <i class="fa fa-users absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        @if(isset($activeBatches) && count($activeBatches) > 0)
                            <select id="batch_code" name="batch_code" required
                                    class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                                <option value="" selected disabled>Select your batch</option>
                                @foreach($activeBatches as $b)
                                    <option value="{{ $b->batch_code ?: $b->batch_number }}" {{ old('batch_code') == ($b->batch_code ?: $b->batch_number) ? 'selected' : '' }}>
                                        Batch-Code-{{ $b->batch_code ?: $b->batch_number }} [{{ $b->academic_year ?: date('Y') }}] — {{ $b->course ? $b->course->course_title : 'Local' }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" id="batch_code" name="batch_code" value="{{ old('batch_code') }}" required
                                   placeholder="যেমন: 05 বা Batch-05"
                                   class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                        @endif
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest bg-brand-primary hover:bg-brand-accent text-white transition-all shadow-glow-emerald flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa fa-search"></i>
                        <span>রেজিস্ট্রেশন নম্বর অনুসন্ধান করুন (Verify)</span>
                    </button>
                </div>
            </form>

            <!-- Bottom Helpers -->
            <div class="mt-6 pt-5 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between text-xs text-slate-600 dark:text-slate-400">
                <a href="{{ route('student.login') }}" class="hover:text-brand-primary transition-colors flex items-center gap-1 font-semibold">
                    <i class="fa fa-arrow-left text-[11px]"></i>
                    <span>লগইন পেজ (Sign In)</span>
                </a>
                <a href="{{ route('student.register') }}" class="hover:text-brand-primary transition-colors flex items-center gap-1 font-semibold">
                    <span>নতুন রেজিস্ট্রেশন (Register)</span>
                    <i class="fa fa-arrow-right text-[11px]"></i>
                </a>
            </div>

        </div>
    </div>
</div>

<script>
function copyVerifiedReg() {
    const text = document.getElementById('verifiedRegNum').innerText.trim();
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showCopiedNotice);
    } else {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.focus();
        ta.select();
        try {
            document.execCommand('copy');
            showCopiedNotice();
        } catch (e) {
            console.error('Copy failed', e);
        }
        document.body.removeChild(ta);
    }
}

function showCopiedNotice() {
    const el = document.getElementById('copyVerifiedText');
    const orig = el.innerText;
    el.innerText = 'Copied!';
    setTimeout(() => {
        el.innerText = orig;
    }, 2000);
}
</script>
@endsection

