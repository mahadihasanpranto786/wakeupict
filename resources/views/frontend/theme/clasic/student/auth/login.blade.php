@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@php
    $activeTab = (isset($initialTab) && $initialTab === 'register')
        || request('tab') === 'register'
        || $errors->has('name')
        || $errors->has('password_confirmation')
        ? 'register'
        : 'login';
@endphp

@section('title', ($activeTab === 'register' ? 'Student Registration' : 'Student Login') . ' — Wake Up ICT Portal')

@push('css')
<link rel="stylesheet" href="{{ safe_asset('admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ safe_asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    /* Select2 Container Integration & Modern UI Styling */
    .select2-container--bootstrap4 .select2-selection--single {
        height: 44px !important;
        border-radius: 0.75rem !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        font-size: 0.875rem !important;
        padding-left: 2.25rem !important;
        display: flex !important;
        align-items: center !important;
        box-shadow: none !important;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
    }
    html.dark .select2-container--bootstrap4 .select2-selection--single {
        background-color: rgba(2, 6, 23, 0.8) !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        color: #0f172a !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        padding-left: 0 !important;
        line-height: 42px !important;
    }
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
        color: #94a3b8 !important;
        font-weight: 500 !important;
    }
    html.dark .select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
        color: #64748b !important;
    }
    html.dark .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        color: #ffffff !important;
    }
    .select2-container--bootstrap4.select2-container--focus .select2-selection {
        border-color: var(--brand-primary, #F26522) !important;
        box-shadow: 0 0 0 1px var(--brand-primary, #F26522) !important;
    }
    .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
        top: 50% !important;
        transform: translateY(-50%) !important;
        right: 12px !important;
    }
    /* Select2 Dropdown Popup */
    .select2-dropdown {
        border-radius: 0.75rem !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
        z-index: 99999 !important;
        overflow: hidden !important;
    }
    html.dark .select2-dropdown {
        background-color: #0f172a !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }
    .select2-container--bootstrap4 .select2-search--dropdown {
        padding: 8px !important;
    }
    .select2-container--bootstrap4 .select2-search--dropdown .select2-search__field {
        border-radius: 0.5rem !important;
        border: 1px solid #cbd5e1 !important;
        padding: 6px 12px !important;
        font-size: 0.85rem !important;
        color: #0f172a !important;
    }
    html.dark .select2-container--bootstrap4 .select2-search--dropdown .select2-search__field {
        background-color: #020617 !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }
    .select2-container--bootstrap4 .select2-results__option {
        padding: 8px 12px !important;
        font-size: 0.85rem !important;
        color: #0f172a !important;
        font-weight: 500 !important;
    }
    html.dark .select2-container--bootstrap4 .select2-results__option {
        color: #f1f5f9 !important;
    }
    .select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected] {
        background-color: var(--brand-primary, #F26522) !important;
        color: #ffffff !important;
    }
</style>
@endpush

@section('maincontent')
<div class="relative w-full min-h-screen pt-20 sm:pt-24 pb-12 flex items-center justify-center px-4">
    <!-- Ambient Lights -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] h-[550px] bg-brand-primary/10 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="rounded-3xl bg-white dark:bg-slate-900/90 border border-slate-200 dark:border-slate-800/80 backdrop-blur-2xl p-5 sm:p-7 shadow-2xl transition-all">
            
            <!-- Logo & Badge -->
            <div class="text-center mb-4">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mb-2 group">
                    <img src="{{ safe_asset('frontend/image/wakeupict-fabicon.png') }}" alt="Wake Up ICT" class="w-10 h-10 object-contain group-hover:scale-105 transition-transform">
                </a>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary/15 border border-brand-primary/30 text-emerald-700 dark:text-brand-primary text-xs font-mono uppercase tracking-widest font-bold mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 dark:bg-brand-primary animate-pulse"></span>
                    <span>Student Portal Access</span>
                </div>
                <h1 id="authMainHeading" class="text-xl sm:text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">
                    {{ $activeTab === 'register' ? 'Create Student Account' : 'Student Login' }}
                </h1>
                <p id="authSubHeading" class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1.5">
                    {{ $activeTab === 'register' ? 'Activate your student portal access using your admission phone number.' : 'Enter your Registration Number, Email, or Phone to access your courses.' }}
                </p>
            </div>

            <!-- Interactive 2-Tab Navigation Switcher -->
            <div class="p-1 rounded-2xl bg-slate-100 dark:bg-slate-950 border border-slate-300 dark:border-slate-800 grid grid-cols-2 gap-1 mb-4 select-none shadow-inner">
                <button type="button" onclick="switchAuthTab('login')" id="tabBtn-login"
                        class="auth-tab-btn py-2 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 cursor-pointer {{ $activeTab === 'login' ? 'bg-brand-primary text-white shadow-md font-extrabold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa fa-sign-in"></i>
                    <span>লগইন (Sign In)</span>
                </button>
                <button type="button" onclick="switchAuthTab('register')" id="tabBtn-register"
                        class="auth-tab-btn py-2 px-3 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 cursor-pointer {{ $activeTab === 'register' ? 'bg-brand-primary text-white shadow-md font-extrabold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                    <i class="fa fa-user-plus"></i>
                    <span>রেজিস্ট্রেশন (Register)</span>
                </button>
            </div>

            <!-- Error Alerts -->
            @if($errors->any())
                <div class="auth-error-alert p-4 rounded-2xl bg-rose-50 dark:bg-rose-950/70 border-2 border-rose-400 dark:border-rose-800 text-xs mb-6 space-y-2 shadow-sm font-sans" style="background-color: #FEF2F2 !important; border-color: #F87171 !important;">
                    @foreach($errors->all() as $error)
                        <div class="flex items-start gap-2.5 font-bold leading-relaxed" style="color: #991B1B !important;">
                            <i class="fa fa-exclamation-circle text-rose-600 flex-shrink-0 text-sm mt-0.5" style="color: #DC2626 !important;"></i>
                            <span class="text-xs font-bold leading-relaxed" style="color: #991B1B !important; font-weight: 700;">{{ $error }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Success Alert -->
            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-700 dark:text-emerald-300 text-xs mb-6 flex items-center gap-2 font-semibold">
                    <i class="fa fa-check-circle text-emerald-600 flex-shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- ========================================================================= -->
            <!-- TAB PANE 1: STUDENT LOGIN -->
            <!-- ========================================================================= -->
            <div id="authPaneLogin" class="{{ $activeTab === 'login' ? 'block' : 'hidden' }}">
                <!-- Default Password Tip for Online Admitted Students -->
                <div class="mb-3.5 p-2.5 px-3 rounded-2xl bg-emerald-50/80 dark:bg-brand-primary/10 border border-emerald-300 dark:border-brand-primary/30 text-xs text-slate-800 dark:text-slate-300 space-y-1">
                    <div class="flex items-center gap-1.5 font-bold text-emerald-800 dark:text-brand-primary">
                        <i class="fa fa-info-circle text-sm"></i>
                        <span>অনলাইন ভর্তি হওয়া শিক্ষার্থীদের জন্য:</span>
                    </div>
                    <p class="text-[11px] text-slate-700 dark:text-slate-300 leading-relaxed font-sans">
                        ইউজারনেম হিসেবে আপনার <strong>রেজিস্ট্রেশন নম্বর (Registration Number)</strong> অথবা <strong>মোবাইল নম্বর</strong> লিখুন। প্রাথমিক ডিফল্ট পাসওয়ার্ড হলো আপনার <strong>মোবাইল নম্বরের শেষ ৬ ডিজিট</strong>।
                    </p>
                </div>

                <form action="{{ route('student.login.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="login_id" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-2">
                            Registration No / Phone / Email <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="text" id="login_id" name="login_id" value="{{ old('login_id') }}" required
                                   placeholder="যেমন: 202605010001 বা 017XXXXXXXX"
                                   class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider">
                                Password <span class="text-rose-500">*</span>
                            </label>
                        </div>
                        <div class="relative">
                            <i class="fa fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="password" id="password" name="password" required
                                   placeholder="••••••••"
                                   class="w-full pl-11 pr-11 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                            <button type="button" onclick="toggleAuthPasswordVisibility('password', this)" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 focus:outline-none p-1 cursor-pointer transition-colors" title="পাসওয়ার্ড দেখুন / লুকান">
                                <i class="fa fa-eye text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-xs pt-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none text-slate-700 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-300 font-medium">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded cursor-pointer">
                            <span>Remember Me</span>
                        </label>
                        <a href="tel:01791612121" class="text-emerald-700 dark:text-brand-primary hover:underline font-semibold flex items-center gap-1">
                            <i class="fa fa-phone"></i>
                            <span>Helpline 01791612121</span>
                        </a>
                    </div>

                    <div class="text-right pt-0.5">
                        <a href="{{ route('student.registration.verification') }}" class="text-[11px] text-emerald-700 dark:text-brand-primary hover:underline font-semibold inline-flex items-center gap-1">
                            <i class="fa fa-question-circle"></i>
                            <span>রেজিস্ট্রেশন নম্বর ভুলে গেছেন? (Forgot Registration Number)</span>
                        </a>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest bg-brand-primary hover:bg-brand-accent text-white transition-all shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa fa-sign-in"></i>
                            <span>Sign In to Dashboard</span>
                        </button>
                    </div>
                </form>

                <!-- Quick Switcher to Register -->
                <div class="mt-6 pt-5 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        নতুন শিক্ষার্থী বা একাউন্ট নেই?
                        <button type="button" onclick="switchAuthTab('register')" class="font-bold text-emerald-700 dark:text-brand-primary hover:underline ml-1 cursor-pointer">
                            একাউন্ট খুলুন (Create / Claim Account)
                        </button>
                    </p>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- TAB PANE 2: STUDENT REGISTRATION / ACCOUNT ACTIVATION -->
            <!-- ========================================================================= -->
            <div id="authPaneRegister" class="{{ $activeTab === 'register' ? 'block' : 'hidden' }}">
                <div class="mb-3.5 p-2.5 px-3 rounded-2xl bg-cyan-50/80 dark:bg-cyan-950/20 border border-cyan-300 dark:border-cyan-800 text-xs text-slate-800 dark:text-slate-300 space-y-1">
                    <div class="flex items-center gap-1.5 font-bold text-cyan-800 dark:text-cyan-400">
                        <i class="fa fa-shield text-sm"></i>
                        <span>অটো-কোর্স লিংকিং সুবিধা:</span>
                    </div>
                    <p class="text-[11px] text-slate-700 dark:text-slate-300 leading-relaxed font-sans">
                        ভর্তির সময় ব্যবহৃত মোবাইল নম্বরটি লিখলে আপনার কোর্স, ব্যাচ ও ম্যাটেরিয়ালস স্বয়ংক্রিয়ভাবে প্রোফাইলে যুক্ত হবে।
                    </p>
                </div>

                <form action="{{ route('student.register.submit') }}" method="POST" class="space-y-3.5">
                    @csrf

                    <div>
                        <label for="reg_name" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Full Name <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-user-circle absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="text" id="reg_name" name="name" value="{{ old('name') }}" required
                                   placeholder="যেমন: MD. RAHIM MIAH"
                                   class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="reg_phone" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Mobile Phone Number <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="text" id="reg_phone" name="phone" value="{{ old('phone') }}" required
                                   placeholder="017XXXXXXXX"
                                   class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                        </div>
                    </div>

                    <div>
                        <label for="reg_email" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Email Address <span class="text-slate-500 font-normal lowercase">(ঐচ্ছিক)</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                            <input type="email" id="reg_email" name="email" value="{{ old('email') }}"
                                   placeholder="student@example.com"
                                   class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all font-mono">
                        </div>
                    </div>

                    <!-- Dynamic Course Selection -->
                    <div>
                        <label for="reg_course_id" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Select Course <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-graduation-cap absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm z-10 pointer-events-none"></i>
                            <select id="reg_course_id" name="course_id" required
                                    class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                                <option value="" disabled {{ old('course_id') ? '' : 'selected' }}>-- Select Course --</option>
                                @if(isset($activeCourses))
                                    @foreach($activeCourses as $c)
                                        <option value="{{ $c->id }}" {{ old('course_id') == $c->id ? 'selected' : '' }}>
                                            {{ $c->course_title }} (Code: {{ $c->course_code ?: str_pad($c->id, 2, '0', STR_PAD_LEFT) }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <!-- Dynamic Active Batch Selection -->
                    <div>
                        <label for="reg_batch_id" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                            Select Active Batch <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <i class="fa fa-users absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm z-10 pointer-events-none"></i>
                            <select id="reg_batch_id" name="batch_id" required
                                    class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                                <option value="" disabled {{ old('batch_id') ? '' : 'selected' }}>-- Select Batch --</option>
                                @if(isset($activeBatches))
                                    @foreach($activeBatches as $b)
                                        <option value="{{ $b->id }}" data-course="{{ $b->course_id }}" {{ old('batch_id') == $b->id ? 'selected' : '' }}>
                                            Batch-Code-{{ $b->batch_code ?: $b->batch_number }} [{{ $b->academic_year ?: date('Y') }}]
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="reg_password" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                Password <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input type="password" id="reg_password" name="password" required minlength="6"
                                       placeholder="কমপক্ষে ৬ ডিজিট"
                                       class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-xs sm:text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                                <button type="button" onclick="toggleAuthPasswordVisibility('reg_password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 focus:outline-none p-1 cursor-pointer transition-colors" title="পাসওয়ার্ড দেখুন / লুকান">
                                    <i class="fa fa-eye text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="reg_password_confirmation" class="block text-xs font-bold text-slate-800 dark:text-slate-300 uppercase tracking-wider mb-1.5">
                                Confirm <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <i class="fa fa-check-circle absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input type="password" id="reg_password_confirmation" name="password_confirmation" required minlength="6"
                                       placeholder="পুনরায় পাসওয়ার্ড দিন"
                                       class="w-full pl-10 pr-10 py-2.5 rounded-xl bg-white dark:bg-slate-950/80 border border-slate-300 dark:border-slate-800 text-slate-900 dark:text-white placeholder-slate-400 text-xs sm:text-sm focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all">
                                <button type="button" onclick="toggleAuthPasswordVisibility('reg_password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 focus:outline-none p-1 cursor-pointer transition-colors" title="পাসওয়ার্ড দেখুন / লুকান">
                                    <i class="fa fa-eye text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest bg-brand-primary hover:bg-brand-accent text-white transition-all shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa fa-check-circle"></i>
                            <span>Activate &amp; Enter Dashboard</span>
                        </button>
                    </div>
                </form>

                <!-- Quick Switcher to Login -->
                <div class="mt-6 pt-5 border-t border-slate-200 dark:border-slate-800 text-center">
                    <p class="text-xs text-slate-600 dark:text-slate-400">
                        ইতিমধ্যে একাউন্ট তৈরি করেছেন?
                        <button type="button" onclick="switchAuthTab('login')" class="font-bold text-emerald-700 dark:text-brand-primary hover:underline ml-1 cursor-pointer">
                            সরাসরি লগইন করুন (Sign In)
                        </button>
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ safe_asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    function switchAuthTab(tab) {
        var paneLogin = document.getElementById('authPaneLogin');
        var paneRegister = document.getElementById('authPaneRegister');
        var btnLogin = document.getElementById('tabBtn-login');
        var btnRegister = document.getElementById('tabBtn-register');
        var heading = document.getElementById('authMainHeading');
        var subheading = document.getElementById('authSubHeading');

        if (tab === 'register') {
            paneLogin.classList.add('hidden');
            paneRegister.classList.remove('hidden');

            btnLogin.className = 'auth-tab-btn py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 cursor-pointer text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white';
            btnRegister.className = 'auth-tab-btn py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 cursor-pointer bg-brand-primary text-white shadow-md font-extrabold';

            heading.innerText = 'Create Student Account';
            subheading.innerText = 'Activate your student portal access using your admission phone number.';
            document.title = 'Student Registration — Wake Up ICT Portal';

            if (window.history.replaceState) {
                window.history.replaceState(null, '', '{{ route("student.register") }}');
            }

            // Re-render Select2 once register container is unhidden
            setTimeout(function() {
                if (typeof $.fn.select2 === 'function') {
                    $('#reg_course_id, #reg_batch_id').select2({
                        theme: 'bootstrap4',
                        width: '100%'
                    });
                }
            }, 60);
        } else {
            paneRegister.classList.add('hidden');
            paneLogin.classList.remove('hidden');

            btnRegister.className = 'auth-tab-btn py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 cursor-pointer text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white';
            btnLogin.className = 'auth-tab-btn py-2.5 px-3 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 cursor-pointer bg-brand-primary text-white shadow-md font-extrabold';

            heading.innerText = 'Student Login';
            subheading.innerText = 'Enter your Registration Number, Email, or Phone to access your courses.';
            document.title = 'Student Login — Wake Up ICT Portal';

            if (window.history.replaceState) {
                window.history.replaceState(null, '', '{{ route("student.login") }}');
            }
        }
    }

    function toggleAuthPasswordVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        if (!input) return;
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    }

    function filterBatchesForCourse(courseId) {
        var $batchSelect = $('#reg_batch_id');
        if (!$batchSelect.length) return;

        if (courseId) {
            fetch('{{ url("/batches-for-course") }}/' + courseId)
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    $batchSelect.empty();
                    $batchSelect.append(new Option('-- Select Batch --', '', true, true));
                    if (Array.isArray(data) && data.length > 0) {
                        data.forEach(function(b) {
                            var codeVal = b.batch_code || b.batch_number;
                            var yearVal = b.academic_year || '{{ date("Y") }}';
                            var labelText = 'Batch-Code-' + codeVal + ' [' + yearVal + ']';
                            var opt = new Option(labelText, b.id, false, false);
                            $(opt).attr('data-course', courseId);
                            $batchSelect.append(opt);
                        });
                    }
                    $batchSelect.val('').trigger('change');
                })
                .catch(function(err) {
                    console.log('Batch fetch fallback error:', err);
                });
        } else {
            $batchSelect.val('').trigger('change');
        }
    }

    $(document).ready(function() {
        if (typeof $.fn.select2 === 'function') {
            $('#reg_course_id').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: '-- Select Course --'
            });

            $('#reg_batch_id').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: '-- Select Batch --'
            });

            $('#reg_course_id').on('change', function() {
                filterBatchesForCourse($(this).val());
            });
        }

        if (window.location.hash === '#register' || window.location.search.indexOf('tab=register') !== -1 || '{{ $activeTab }}' === 'register') {
            switchAuthTab('register');
        }
    });
</script>
@endpush
