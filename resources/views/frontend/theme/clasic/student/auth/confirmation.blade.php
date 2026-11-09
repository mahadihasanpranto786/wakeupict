@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('title', 'Registration Submitted — Wake Up ICT')

@section('maincontent')
<div class="relative w-full min-h-screen pt-24 sm:pt-28 pb-16 flex items-center justify-center px-4">
    <!-- Ambient Lights -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-primary/10 rounded-full blur-[150px] pointer-events-none"></div>

    <div class="max-w-xl w-full relative z-10">
        <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-2xl p-6 sm:p-9 transition-all">

            <!-- Success Checkmark Header -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-full bg-emerald-100 dark:bg-emerald-950/60 border-2 border-emerald-500/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-3xl sm:text-4xl shadow-inner mb-4 animate-bounce">
                    <i class="fa fa-check"></i>
                </div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-950/40 border border-amber-300 dark:border-amber-700 text-amber-800 dark:text-amber-400 text-xs font-mono font-bold uppercase tracking-widest mb-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Pending Admin Verification</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Registration Submitted Successfully!
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-2 font-sans leading-relaxed">
                    আপনার রেজিস্ট্রেশন আবেদনটি সফলভাবে জমা হয়েছে। নিচে প্রদর্শিত রেজিস্ট্রেশন নম্বরটি সংরক্ষণ করুন।
                </p>
            </div>

            <!-- Mandatory Prominent Message Alert Box -->
            <div class="mb-6 p-4 sm:p-5 rounded-2xl bg-amber-50 dark:bg-amber-950/30 border border-amber-200 dark:border-amber-800/80 text-slate-800 dark:text-slate-200 space-y-2">
                <div class="flex items-center gap-2 font-bold text-amber-800 dark:text-amber-400 text-sm">
                    <i class="fa fa-exclamation-triangle text-amber-600 dark:text-amber-400 text-base"></i>
                    <span>গুরুত্বপূর্ণ নোটিশ (Important Notice)</span>
                </div>
                <p class="text-xs sm:text-sm text-slate-700 dark:text-slate-200 leading-relaxed font-sans">
                    <strong>"Your registration has been submitted successfully. Your Registration Number is shown above. Your student portal access will be activated after administrator verification. Please wait for approval."</strong>
                </p>
                <p class="text-xs text-slate-600 dark:text-slate-400 font-sans pt-1">
                    অ্যাডমিন কর্তৃক আবেদন যাচাই ও অনুমোদন সম্পন্ন হলে আপনার স্টুডেন্ট পোর্টাল সম্পূর্ণ সক্রিয় হবে।
                </p>
            </div>

            <!-- Highlighted Registration Number Card -->
            <div class="mb-6 p-5 sm:p-6 rounded-2xl bg-slate-900 text-white border border-emerald-500/30 shadow-xl relative overflow-hidden text-center">
                <div class="absolute -top-10 -right-10 w-28 h-28 bg-emerald-500/20 rounded-full blur-2xl pointer-events-none"></div>
                <span class="text-xs font-mono text-emerald-400 uppercase tracking-widest block font-bold mb-1">
                    Your Official Registration Number
                </span>
                <div id="regNumberDisplay" class="text-2xl sm:text-3xl font-mono font-extrabold text-white tracking-widest my-2 select-all">
                    {{ $confirmationData['registration_number'] ?? 'N/A' }}
                </div>
                <div class="mt-3 flex items-center justify-center gap-2">
                    <button type="button" onclick="copyRegNumber()" id="copyRegBtn"
                            class="px-4 py-2 rounded-xl text-xs font-bold font-mono transition-all flex items-center gap-2 cursor-pointer shadow-md bg-emerald-500 hover:bg-emerald-600 text-black"
                            style="background-color: #10B981 !important; color: #000000 !important; font-weight: 800;">
                        <i class="fa fa-clone"></i>
                        <span id="copyBtnText">Copy Registration Number</span>
                    </button>
                </div>
            </div>

            <!-- Registration Summary Details Table -->
            <div class="rounded-2xl border border-slate-200 dark:border-slate-800 overflow-hidden mb-6 text-xs sm:text-sm">
                <div class="divide-y divide-slate-200 dark:divide-slate-800">
                    <div class="p-3.5 sm:p-4 flex items-center justify-between bg-slate-50 dark:bg-slate-900/50">
                        <span class="text-slate-600 dark:text-slate-400 font-medium">Student Full Name</span>
                        <span class="font-bold text-slate-900 dark:text-white uppercase">{{ $confirmationData['student_name'] ?? 'N/A' }}</span>
                    </div>
                    <div class="p-3.5 sm:p-4 flex items-center justify-between">
                        <span class="text-slate-600 dark:text-slate-400 font-medium">Selected Course</span>
                        <span class="font-bold text-slate-900 dark:text-white">{{ $confirmationData['course_title'] ?? 'N/A' }}</span>
                    </div>
                    <div class="p-3.5 sm:p-4 flex items-center justify-between bg-slate-50 dark:bg-slate-900/50">
                        <span class="text-slate-600 dark:text-slate-400 font-medium">Selected Batch</span>
                        <span class="font-bold text-slate-900 dark:text-white font-mono">
                            {{ $confirmationData['batch_number'] ?? 'N/A' }} (Code: {{ $confirmationData['batch_code'] ?? 'N/A' }})
                        </span>
                    </div>
                    <div class="p-3.5 sm:p-4 flex items-center justify-between">
                        <span class="text-slate-600 dark:text-slate-400 font-medium">Academic Year</span>
                        <span class="font-bold text-slate-900 dark:text-white font-mono">{{ $confirmationData['academic_year'] ?? date('Y') }}</span>
                    </div>
                    <div class="p-3.5 sm:p-4 flex items-center justify-between bg-slate-50 dark:bg-slate-900/50">
                        <span class="text-slate-600 dark:text-slate-400 font-medium">Submission Status</span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                            {{ $confirmationData['submission_status'] ?? 'Pending Admin Verification' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Action Navigation Buttons -->
            <div class="space-y-2.5">
                <a href="{{ route('student.registration.verification') }}"
                   class="w-full py-3 px-4 rounded-xl text-center text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 border border-slate-300 dark:border-slate-700 text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i class="fa fa-search"></i>
                    <span>রেজিস্ট্রেশন ভেরিফিকেশন পেজ (Check / Retrieve Registration)</span>
                </a>

                <a href="{{ route('student.login') }}"
                   class="w-full py-3 px-4 rounded-xl text-center text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 bg-slate-900 dark:bg-slate-800 hover:bg-slate-800 dark:hover:bg-slate-700 text-white">
                    <i class="fa fa-sign-in"></i>
                    <span>স্টুডেন্ট লগইন পেজে যান (Student Login)</span>
                </a>
            </div>

            <!-- Helpline Info -->
            <div class="mt-6 pt-4 border-t border-slate-200 dark:border-slate-800 text-center">
                <p class="text-xs text-slate-600 dark:text-slate-400 font-sans">
                    যেকোনো প্রয়োজনে সরাসরি যোগাযোগ করুন:
                    <a href="tel:01791612121" class="font-bold text-emerald-700 dark:text-emerald-400 hover:underline font-mono">01791612121</a>
                </p>
            </div>

        </div>
    </div>
</div>

<script>
function copyRegNumber() {
    const text = document.getElementById('regNumberDisplay').innerText.trim();
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(showCopiedState);
    } else {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.opacity = '0';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        try {
            document.execCommand('copy');
            showCopiedState();
        } catch (err) {
            console.error('Copy fallback failed', err);
        }
        document.body.removeChild(textArea);
    }
}

function showCopiedState() {
    const btnText = document.getElementById('copyBtnText');
    const original = btnText.innerText;
    btnText.innerText = 'Copied to Clipboard!';
    setTimeout(() => {
        btnText.innerText = original;
    }, 2500);
}
</script>
@endsection

