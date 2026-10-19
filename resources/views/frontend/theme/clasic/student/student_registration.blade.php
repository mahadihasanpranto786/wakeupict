@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@php
    // Safe price formatter helper
    $formatPrice = function($price) {
        if (is_numeric($price)) {
            return number_format((float)$price);
        }
        $digits = preg_replace('/[^\d.]/', '', (string)$price);
        return $digits !== '' ? number_format((float)$digits) : '0';
    };
@endphp

@section('maincontent')
<style>
    /* Wizard Smooth Keyframe Animations */
    @keyframes wizardFadeIn {
        from {
            opacity: 0;
            transform: translateY(14px) scale(0.995);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes pulseRing {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.18); opacity: 0; }
        100% { transform: scale(0.95); opacity: 0; }
    }

    .wizard-step-anim {
        animation: wizardFadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .pulse-ring {
        animation: pulseRing 2s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    }

    .field-error-shake {
        animation: shakeError 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    }

    @keyframes shakeError {
        10%, 90% { transform: translate3d(-1px, 0, 0); }
        20%, 80% { transform: translate3d(2px, 0, 0); }
        30%, 50%, 70% { transform: translate3d(-3px, 0, 0); }
        40%, 60% { transform: translate3d(3px, 0, 0); }
    }
</style>

<div class="relative w-full overflow-hidden bg-slate-950 text-slate-100 min-h-screen pt-28 pb-24">
    <!-- Ambient Background Lighting & Mesh -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-brand-primary/10 rounded-full blur-[160px] pointer-events-none"></div>
    <div class="absolute bottom-1/3 right-10 w-[500px] h-[500px] bg-brand-cyan/10 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Header & Breadcrumbs Hero Section -->
    <section class="relative py-8 border-b border-slate-800/80 bg-slate-900/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-4" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('academic-training') }}" class="hover:text-brand-primary transition-colors">Training</a>
                <span class="text-slate-600">/</span>
                <a href="{{ url('training/' . $course->course_slug) }}" class="hover:text-brand-primary transition-colors">{{ Str::limit($course->course_title, 30) }}</a>
                <span class="text-slate-600">/</span>
                <span class="text-brand-primary font-semibold">Step-by-Step Online Admission</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono tracking-wider uppercase mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-ping"></span>
                        <span>Wake Up ICT Interactive Admission Wizard</span>
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        {{ $course->course_title }}
                    </h1>
                </div>

                <div class="flex items-center gap-3 self-start md:self-auto">
                    <div class="px-5 py-3 rounded-2xl bg-slate-900/90 border border-slate-800 text-right shadow-lg backdrop-blur-md">
                        <span class="text-xs font-mono text-slate-400 block uppercase tracking-wider">Base Course Fee</span>
                        <span class="text-xl font-bold font-mono text-emerald-400">৳ {{ $formatPrice($course->price) }}/-</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Registration Section -->
    <section class="py-10 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                <!-- Left 8 Columns: Interactive Step-by-Step Wizard Form -->
                <div class="lg:col-span-8">
                    <div class="rounded-3xl bg-slate-900/95 border border-slate-800 backdrop-blur-2xl p-6 sm:p-10 shadow-2xl relative overflow-hidden" id="admissionWizardCard">
                        
                        <!-- Official Institute Header from Mockup -->
                        <div class="p-6 rounded-2xl bg-slate-950/80 border border-slate-800/80 mb-8 relative overflow-hidden">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                                <div class="flex items-center gap-4 text-center sm:text-left">
                                    <div class="w-20 h-20 rounded-2xl bg-white/5 border border-slate-700/60 p-2 flex items-center justify-center flex-shrink-0 shadow-md">
                                        <img src="{{ asset('frontend/image/wict-logo.png') }}" alt="Wake Up ICT" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <div>
                                        <h2 class="text-xl sm:text-2xl font-black tracking-tight text-white">
                                            Wake Up ICT Institute
                                        </h2>
                                        <p class="text-xs font-medium text-brand-primary tracking-wide italic">
                                            "Let's break the limit..."
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            Namnu tower, 2nd Floor, Panna Chattar, Rajbari-7700
                                        </p>
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-slate-400 mt-1.5 font-mono">
                                            <span class="flex items-center gap-1">
                                                <i class="fa fa-envelope text-brand-primary"></i> info@wakeupict.com
                                            </span>
                                            <span class="text-slate-600">|</span>
                                            <span class="flex items-center gap-1">
                                                <i class="fa fa-phone text-emerald-400"></i> +88 01791612121
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Photo Upload Box Preview from Mockup -->
                                <div class="flex-shrink-0 text-center">
                                    <div class="w-28 h-32 rounded-xl border-2 border-dashed border-slate-700 hover:border-brand-primary bg-slate-900/90 flex flex-col items-center justify-center relative overflow-hidden group cursor-pointer transition-all shadow-inner" id="photoPreviewBox">
                                        <img id="photoPreviewImg" src="" alt="Preview" class="w-full h-full object-cover hidden">
                                        <div id="photoPlaceholder" class="flex flex-col items-center justify-center p-2 text-slate-400 group-hover:text-brand-primary transition-colors">
                                            <i class="fa fa-user-circle text-3xl mb-1 text-slate-500 group-hover:text-brand-primary"></i>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">Photo</span>
                                            <span class="text-[9px] text-slate-500 font-mono">(Click to upload)</span>
                                        </div>
                                        <input type="file" name="student_photo" id="student_photo_input" form="studentRegistrationForm" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                                    </div>
                                    <span class="text-[10px] text-slate-500 block mt-1">Passport Size Photo</span>
                                </div>
                            </div>
                        </div>

                        <!-- ================= INTERACTIVE STEP WIZARD PROGRESS BAR ================= -->
                        <div class="mb-10">
                            <!-- Progress Line Background & Fill -->
                            <div class="relative mb-6">
                                <div class="w-full h-2 rounded-full bg-slate-950 border border-slate-800 overflow-hidden">
                                    <div id="wizardProgressBar" class="h-full bg-gradient-to-r from-brand-primary via-emerald-400 to-brand-cyan rounded-full transition-all duration-500 ease-out" style="width: 25%;"></div>
                                </div>
                            </div>

                            <!-- 4 Step Pill Badges (Clickable to jump to visited steps) -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4 select-none">
                                <!-- Step 1 Badge -->
                                <button type="button" class="wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer group" data-step-target="1" id="stepIndicator-1">
                                    <div class="indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all relative">
                                        <span class="indicator-pulse-ring absolute inset-0 rounded-full bg-brand-primary/30 pulse-ring"></span>
                                        <span class="indicator-num relative z-10">1</span>
                                        <i class="fa fa-check indicator-check hidden relative z-10 text-slate-950"></i>
                                    </div>
                                    <span class="indicator-title text-xs font-bold tracking-tight text-white transition-colors">Basic Info</span>
                                    <span class="indicator-subtitle text-[10px] text-slate-400 font-mono hidden sm:block">Name &amp; Family</span>
                                </button>

                                <!-- Step 2 Badge -->
                                <button type="button" class="wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer group" data-step-target="2" id="stepIndicator-2">
                                    <div class="indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all relative">
                                        <span class="indicator-pulse-ring absolute inset-0 rounded-full bg-brand-primary/30 pulse-ring hidden"></span>
                                        <span class="indicator-num relative z-10">2</span>
                                        <i class="fa fa-check indicator-check hidden relative z-10 text-slate-950"></i>
                                    </div>
                                    <span class="indicator-title text-xs font-bold tracking-tight text-slate-400 transition-colors">Personal</span>
                                    <span class="indicator-subtitle text-[10px] text-slate-500 font-mono hidden sm:block">Contact &amp; NID</span>
                                </button>

                                <!-- Step 3 Badge -->
                                <button type="button" class="wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer group" data-step-target="3" id="stepIndicator-3">
                                    <div class="indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all relative">
                                        <span class="indicator-pulse-ring absolute inset-0 rounded-full bg-brand-primary/30 pulse-ring hidden"></span>
                                        <span class="indicator-num relative z-10">3</span>
                                        <i class="fa fa-check indicator-check hidden relative z-10 text-slate-950"></i>
                                    </div>
                                    <span class="indicator-title text-xs font-bold tracking-tight text-slate-400 transition-colors">Education</span>
                                    <span class="indicator-subtitle text-[10px] text-slate-500 font-mono hidden sm:block">Courses &amp; Degree</span>
                                </button>

                                <!-- Step 4 Badge -->
                                <button type="button" class="wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer group" data-step-target="4" id="stepIndicator-4">
                                    <div class="indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all relative">
                                        <span class="indicator-pulse-ring absolute inset-0 rounded-full bg-brand-primary/30 pulse-ring hidden"></span>
                                        <span class="indicator-num relative z-10">4</span>
                                        <i class="fa fa-check indicator-check hidden relative z-10 text-slate-950"></i>
                                    </div>
                                    <span class="indicator-title text-xs font-bold tracking-tight text-slate-400 transition-colors">Submission</span>
                                    <span class="indicator-subtitle text-[10px] text-slate-500 font-mono hidden sm:block">Rules &amp; Files</span>
                                </button>
                            </div>
                        </div>

                        <!-- Error Notification Alert -->
                        @if ($errors->any())
                            <div class="mb-8 p-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
                                <div class="flex items-center gap-2 font-bold mb-2 text-rose-400">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    <span>Please fix the following errors before submitting:</span>
                                </div>
                                <ul class="list-disc list-inside space-y-1 text-xs text-rose-300/90">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('store-student-form') }}" enctype="multipart/form-data" id="studentRegistrationForm">
                            @csrf
                            <input type="hidden" name="course_id" id="hidden_course_id" value="{{ $course->id }}">
                            <input type="hidden" name="course_fee" id="hidden_course_fee" value="{{ $course->price }}">

                            <!-- ========================================================================= -->
                            <!-- STEP 1: Basic Information & Family Background -->
                            <!-- ========================================================================= -->
                            <div class="wizard-step-pane wizard-step-anim space-y-6" data-step="1" id="wizardStepPane-1">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                    <div>
                                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">1</span>
                                            <span>Student &amp; Family Information</span>
                                        </h3>
                                        <p class="text-xs text-slate-400 mt-1">Please provide accurate personal and parent information matching official certificates.</p>
                                    </div>
                                    <span class="text-xs font-mono font-semibold text-brand-primary bg-brand-primary/10 px-3 py-1 rounded-full border border-brand-primary/20">
                                        Step 1 of 4
                                    </span>
                                </div>

                                <!-- 1. Student Name (IN BLOCK LETTERS) -->
                                <div class="p-5 rounded-2xl bg-slate-950/60 border border-slate-800 transition-all hover:border-slate-700">
                                    <label for="student_name" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                        1. Student Full Name <span class="text-brand-primary font-mono">(IN BLOCK LETTERS)</span> <span class="text-rose-400 font-bold">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input id="student_name" type="text" name="student_name" 
                                            value="{{ old('student_name') }}"
                                            required
                                            autocomplete="name"
                                            placeholder="e.g. MOHAMMED RAHIM UDDIN"
                                            oninput="this.value = this.value.toUpperCase(); updateSidebarSummary();"
                                            style="text-transform: uppercase;"
                                            class="w-full pl-10 pr-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-white font-mono placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('student_name') border-rose-500 @enderror">
                                    </div>
                                    <p class="text-[11px] text-slate-500 mt-1.5 flex items-center gap-1">
                                        <i class="fa fa-info-circle text-brand-primary"></i>
                                        <span>Automatically converted to block capital letters for certificate accuracy.</span>
                                    </p>
                                </div>

                                <!-- 2. Gender & 3. Date of Birth -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <!-- 2. Gender Selection -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            2. Gender <span class="text-rose-400 font-bold">*</span>
                                        </label>
                                        <div class="grid grid-cols-3 gap-2.5">
                                            <label class="relative flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-700 bg-slate-900 hover:bg-slate-800 cursor-pointer transition-all gender-card text-center group has-[:checked]:border-brand-primary has-[:checked]:bg-brand-primary/10">
                                                <input type="radio" name="gander" value="male" class="text-brand-primary focus:ring-brand-primary w-4 h-4" {{ old('gander', 'male') === 'male' ? 'checked' : '' }} required>
                                                <span class="text-xs font-semibold text-slate-200 group-hover:text-white">
                                                    <i class="fa fa-mars text-brand-primary"></i> Male
                                                </span>
                                            </label>

                                            <label class="relative flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-700 bg-slate-900 hover:bg-slate-800 cursor-pointer transition-all gender-card text-center group has-[:checked]:border-pink-500 has-[:checked]:bg-pink-500/10">
                                                <input type="radio" name="gander" value="female" class="text-brand-primary focus:ring-brand-primary w-4 h-4" {{ old('gander') === 'female' ? 'checked' : '' }}>
                                                <span class="text-xs font-semibold text-slate-200 group-hover:text-white">
                                                    <i class="fa fa-venus text-pink-400"></i> Female
                                                </span>
                                            </label>

                                            <label class="relative flex items-center justify-center gap-2 p-3 rounded-xl border border-slate-700 bg-slate-900 hover:bg-slate-800 cursor-pointer transition-all gender-card text-center group has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-500/10">
                                                <input type="radio" name="gander" value="other" class="text-brand-primary focus:ring-brand-primary w-4 h-4" {{ old('gander') === 'other' ? 'checked' : '' }}>
                                                <span class="text-xs font-semibold text-slate-200 group-hover:text-white">
                                                    <i class="fa fa-genderless text-indigo-400"></i> Other
                                                </span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- 3. Date Of Birth -->
                                    <div>
                                        <label for="date_of_birth" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2 flex items-center justify-between">
                                            <span>3. Date Of Birth <span class="text-rose-400 font-bold">*</span></span>
                                            <span class="text-[10px] text-emerald-400 font-mono">(Age auto-calculates)</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input id="date_of_birth" type="date" name="date_of_birth" 
                                                value="{{ old('date_of_birth') }}"
                                                required
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('date_of_birth') border-rose-500 @enderror">
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Father's Name & 5. Mother's Name -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <!-- 4. Father's Name -->
                                    <div>
                                        <label for="fathers_name" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            4. Father's Name <span class="text-rose-400 font-bold">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-male text-lg"></i>
                                            </div>
                                            <input id="fathers_name" type="text" name="fathers_name" 
                                                value="{{ old('fathers_name') }}"
                                                required
                                                placeholder="Enter Father's full name"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('fathers_name') border-rose-500 @enderror">
                                        </div>
                                    </div>

                                    <!-- 5. Mother's Name -->
                                    <div>
                                        <label for="mothers_name" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                            5. Mother's Name <span class="text-rose-400 font-bold">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-female text-lg"></i>
                                            </div>
                                            <input id="mothers_name" type="text" name="mothers_name" 
                                                value="{{ old('mothers_name') }}"
                                                required
                                                placeholder="Enter Mother's full name"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('mothers_name') border-rose-500 @enderror">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================================================= -->
                            <!-- STEP 2: Personal & Contact Information -->
                            <!-- ========================================================================= -->
                            <div class="wizard-step-pane wizard-step-anim hidden space-y-6" data-step="2" id="wizardStepPane-2">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                    <div>
                                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">2</span>
                                            <span>Personal, Identification &amp; Contact Details</span>
                                        </h3>
                                        <p class="text-xs text-slate-400 mt-1">Student phone number is required to automatically configure your Student LMS Portal account.</p>
                                    </div>
                                    <span class="text-xs font-mono font-semibold text-brand-primary bg-brand-primary/10 px-3 py-1 rounded-full border border-brand-primary/20">
                                        Step 2 of 4
                                    </span>
                                </div>

                                <div class="p-6 rounded-2xl bg-slate-950/60 border border-slate-800 space-y-6">
                                    <!-- Nationality & Religion -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nationality" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                Nationality <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <select id="nationality" name="nationality" required class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary text-sm">
                                                <option value="Bangladeshi" {{ old('nationality') == 'Bangladeshi' || !old('nationality') ? 'selected' : '' }}>Bangladeshi</option>
                                                <option value="Other" {{ old('nationality') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="religion" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                Religion <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <select id="religion" name="religion" required class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary text-sm">
                                                <option value="Islam" {{ old('religion', 'Islam') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Hinduism" {{ old('religion') == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                                                <option value="Christianity" {{ old('religion') == 'Christianity' ? 'selected' : '' }}>Christianity</option>
                                                <option value="Buddhism" {{ old('religion') == 'Buddhism' ? 'selected' : '' }}>Buddhism</option>
                                                <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- National ID / Birth Certificate (Dropdown + Input) -->
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                        <div class="md:col-span-4">
                                            <label for="id_type" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                ID Type <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <select id="id_type" name="id_type" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary text-sm">
                                                <option value="National ID" {{ old('id_type') == 'National ID' ? 'selected' : '' }}>National ID (NID)</option>
                                                <option value="Birth Certificate" {{ old('id_type') == 'Birth Certificate' ? 'selected' : '' }}>Birth Certificate (জন্ম নিবন্ধন)</option>
                                                <option value="Passport" {{ old('id_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                                            </select>
                                        </div>

                                        <div class="md:col-span-8">
                                            <label for="national_id_no" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                National ID / Birth Certificate Number <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-id-card"></i>
                                                </div>
                                                <input id="national_id_no" type="text" name="national_id_no" 
                                                    value="{{ old('national_id_no') }}"
                                                    required
                                                    placeholder="Enter NID or Birth Certificate number"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm font-mono @error('national_id_no') border-rose-500 @enderror">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Occupation & Age -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="occupation" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                Occupation <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <input id="occupation" type="text" name="occupation" 
                                                    value="{{ old('occupation') }}"
                                                    required
                                                    placeholder="e.g. Student / Job Holder / Freelancer"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm">
                                            </div>
                                        </div>

                                        <div>
                                            <label for="age" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2 flex items-center justify-between">
                                                <span>Age (Years) <span class="text-rose-400 font-bold">*</span></span>
                                                <span class="text-[10px] text-brand-primary font-mono" id="ageCalculatedBadge">Calculated from Date of Birth</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input id="age" type="text" name="age" 
                                                    value="{{ old('age') }}"
                                                    required
                                                    placeholder="e.g. 21"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white font-mono placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Present Address & Permanent Address with Auto-Sync Checkbox -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="present_address" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                                Present Address <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute top-3 left-3 text-slate-500">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <textarea id="present_address" name="present_address" rows="2" required
                                                    placeholder="Village / Road, Post Office, Upazila / Thana, District"
                                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm">{{ old('present_address') }}</textarea>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="flex items-center justify-between mb-2">
                                                <label for="permanent_address" class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                                                    Permanent Address <span class="text-rose-400 font-bold">*</span>
                                                </label>
                                                <!-- Present to Permanent copy checkbox as annotated in mockup -->
                                                <label class="inline-flex items-center gap-2 cursor-pointer text-xs text-brand-primary font-medium hover:text-brand-accent transition-colors">
                                                    <input type="checkbox" id="sameAddressCheck" class="rounded border-slate-700 text-brand-primary focus:ring-brand-primary w-4 h-4 bg-slate-900">
                                                    <span>Same as Present Address</span>
                                                </label>
                                            </div>
                                            <div class="relative">
                                                <div class="absolute top-3 left-3 text-slate-500">
                                                    <i class="fa fa-home"></i>
                                                </div>
                                                <textarea id="permanent_address" name="permanent_address" rows="2" required
                                                    placeholder="Village / Road, Post Office, Upazila / Thana, District"
                                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm">{{ old('permanent_address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Phone Numbers & Email -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                                        <!-- Student Mobile Number (Mandatory - Account Created) -->
                                        <div>
                                            <label for="personal_call_no" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                                Student Phone <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <span class="text-[10px] text-emerald-400 font-mono block mb-1.5">(Creates Student Portal Account)</span>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-mobile text-lg text-emerald-400"></i>
                                                </div>
                                                <input id="personal_call_no" type="tel" name="personal_call_no" 
                                                    value="{{ old('personal_call_no') }}"
                                                    required
                                                    placeholder="017XXXXXXXX"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-emerald-500/50 text-white font-mono placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('personal_call_no') border-rose-500 @enderror">
                                            </div>
                                        </div>

                                        <!-- Guardian Mobile Number (Optional) -->
                                        <div>
                                            <label for="guardian_call_no" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                                Guardian Phone
                                            </label>
                                            <span class="text-[10px] text-slate-400 font-mono block mb-1.5">(Optional / Emergency Contact)</span>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input id="guardian_call_no" type="tel" name="guardian_call_no" 
                                                    value="{{ old('guardian_call_no') }}"
                                                    placeholder="01XXXXXXXXX"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white font-mono placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                                Email Address <span class="text-rose-400 font-bold">*</span>
                                            </label>
                                            <span class="text-[10px] text-slate-400 font-mono block mb-1.5">(For updates &amp; credentials)</span>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <input id="email" type="email" name="email" 
                                                    value="{{ old('email') }}"
                                                    required
                                                    placeholder="student@example.com"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('email') border-rose-500 @enderror">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================================================= -->
                            <!-- STEP 3: Educational Qualifications & Course Selection -->
                            <!-- ========================================================================= -->
                            <div class="wizard-step-pane wizard-step-anim hidden space-y-6" data-step="3" id="wizardStepPane-3">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                    <div>
                                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">3</span>
                                            <span>Academic Records &amp; Course Selection</span>
                                        </h3>
                                        <p class="text-xs text-slate-400 mt-1">Select your desired courses and enter your highest educational qualifications.</p>
                                    </div>
                                    <span class="text-xs font-mono font-semibold text-brand-primary bg-brand-primary/10 px-3 py-1 rounded-full border border-brand-primary/20">
                                        Step 3 of 4
                                    </span>
                                </div>

                                <!-- 7. Educational Qualification (Dynamic Repeater) -->
                                <div class="p-6 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                                        <div class="flex items-center gap-2">
                                            <i class="fa fa-graduation-cap text-brand-primary text-base"></i>
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">
                                                7. Educational Qualification
                                            </h4>
                                        </div>
                                        <button type="button" id="addQualificationBtn" class="px-3 py-1.5 rounded-lg bg-brand-primary/10 hover:bg-brand-primary/20 border border-brand-primary/30 text-brand-primary text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i class="fa fa-plus"></i>
                                            <span>Add Another Qualification</span>
                                        </button>
                                    </div>

                                    <div class="overflow-x-auto">
                                        <table class="w-full text-left text-xs text-slate-300 border-collapse" id="qualificationsTable">
                                            <thead>
                                                <tr class="border-b border-slate-800 bg-slate-900/80 font-bold uppercase text-slate-400">
                                                    <th class="p-3">Degree / Exam</th>
                                                    <th class="p-3">Board / University</th>
                                                    <th class="p-3">Result / GPA</th>
                                                    <th class="p-3">Passing Year</th>
                                                    <th class="p-3 text-center w-12">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="qualificationsTbody" class="divide-y divide-slate-800/60 font-sans">
                                                <!-- Row 1: Primary Qualification (S.S.C or equivalent) -->
                                                <tr class="qualification-row">
                                                    <td class="p-2">
                                                        <select name="degrees[]" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs" required>
                                                            <option value="S.S.C / Dakhil / O-Level" selected>S.S.C / Dakhil / O-Level</option>
                                                            <option value="H.S.C / Alim / A-Level">H.S.C / Alim / A-Level</option>
                                                            <option value="Honors / Bachelor / Degree">Honors / Bachelor / Degree</option>
                                                            <option value="Masters / Post Graduate">Masters / Post Graduate</option>
                                                            <option value="J.S.C / J.D.C">J.S.C / J.D.C</option>
                                                            <option value="Diploma in Engineering">Diploma in Engineering</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="boards[]" placeholder="e.g. Dhaka Board / NU" required class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="results[]" placeholder="e.g. GPA 4.80" required class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="passing_years[]" placeholder="e.g. 2022" required class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs font-mono">
                                                    </td>
                                                    <td class="p-2 text-center">
                                                        <button type="button" class="text-slate-600 cursor-not-allowed text-xs p-1" title="Primary qualification row is required">
                                                            <i class="fa fa-lock"></i>
                                                        </button>
                                                    </td>
                                                </tr>

                                                <!-- Row 2: Secondary Qualification (H.S.C or higher) -->
                                                <tr class="qualification-row">
                                                    <td class="p-2">
                                                        <select name="degrees[]" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                                                            <option value="">-- Optional Additional Degree --</option>
                                                            <option value="H.S.C / Alim / A-Level" selected>H.S.C / Alim / A-Level</option>
                                                            <option value="Honors / Bachelor / Degree">Honors / Bachelor / Degree</option>
                                                            <option value="Masters / Post Graduate">Masters / Post Graduate</option>
                                                            <option value="Diploma in Engineering">Diploma in Engineering</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="boards[]" placeholder="Board / University" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="results[]" placeholder="Result / GPA" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                                                    </td>
                                                    <td class="p-2">
                                                        <input type="text" name="passing_years[]" placeholder="Passing Year" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs font-mono">
                                                    </td>
                                                    <td class="p-2 text-center">
                                                        <button type="button" class="text-rose-400 hover:text-rose-300 text-sm p-1 delete-qualification-btn transition-colors" title="Delete Row">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- 8. Courses (Tick on your choice) -->
                                <div class="p-6 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-3 mb-4 border-b border-slate-800 gap-2">
                                        <div class="flex items-center gap-2">
                                            <i class="fa fa-book text-brand-primary text-base"></i>
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">
                                                8. Select Courses (Multiple selection supported)
                                            </h4>
                                        </div>
                                        <span class="text-xs text-brand-primary font-mono font-semibold">
                                            Tick to enroll
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5" id="coursesCheckboxContainer">
                                        @foreach ($allCourses as $cItem)
                                            @php
                                                $isPreSelected = ($cItem->id == $course->id);
                                                $cleanItemPrice = is_numeric($cItem->price) ? (float)$cItem->price : (float)preg_replace('/[^\d.]/', '', (string)$cItem->price);
                                            @endphp
                                            <label class="relative flex items-start gap-3 p-3.5 rounded-xl border border-slate-800 bg-slate-900/80 hover:bg-slate-800/60 cursor-pointer transition-all course-selection-label {{ $isPreSelected ? 'border-brand-primary bg-brand-primary/10 shadow-glow-emerald/20' : '' }}" data-price="{{ $cleanItemPrice }}">
                                                <input type="checkbox" name="selected_courses[]" value="{{ $cItem->id }}" class="mt-1 rounded border-slate-700 text-brand-primary focus:ring-brand-primary w-4 h-4 bg-slate-950 course-checkbox" {{ $isPreSelected ? 'checked' : '' }}>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between gap-2">
                                                        <span class="text-xs sm:text-sm font-bold text-white leading-tight">
                                                            {{ $cItem->course_title }}
                                                        </span>
                                                        <span class="text-xs font-mono font-bold text-emerald-400 flex-shrink-0">
                                                            ৳ {{ $formatPrice($cItem->price) }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-[10px] text-slate-400 mt-1">
                                                        <span class="px-1.5 py-0.5 rounded bg-slate-800 text-slate-300 font-mono">{{ $cItem->time_line ?? 'Batch Coaching' }}</span>
                                                        @if(strpos($cItem->course_title, 'BTEB') !== false)
                                                            <span class="px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-300 font-mono font-semibold">Govt. BTEB</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>

                                    <!-- Dynamic Total Calculation Summary Bar -->
                                    <div class="mt-5 p-4 rounded-xl bg-slate-900 border border-slate-700 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-inner">
                                        <div class="flex items-center gap-2">
                                            <i class="fa fa-calculator text-brand-primary text-base"></i>
                                            <span class="text-xs text-slate-300 font-medium">Selected Courses: <strong id="selectedCoursesCount" class="text-white font-mono">1</strong></span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs text-slate-400 font-mono block">Calculated Total Fee:</span>
                                            <span class="text-xl font-extrabold font-mono text-emerald-400" id="calculatedTotalFee">৳ {{ $formatPrice($course->price) }}/-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========================================================================= -->
                            <!-- STEP 4: Attachments, Rules & Declaration Submission -->
                            <!-- ========================================================================= -->
                            <div class="wizard-step-pane wizard-step-anim hidden space-y-6" data-step="4" id="wizardStepPane-4">
                                <div class="flex items-center justify-between pb-3 border-b border-slate-800">
                                    <div>
                                        <h3 class="text-base font-bold text-white flex items-center gap-2">
                                            <span class="w-7 h-7 rounded-lg bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">4</span>
                                            <span>Attachments, Rules &amp; Final Declaration</span>
                                        </h3>
                                        <p class="text-xs text-slate-400 mt-1">Please upload required documents and accept the academy rules before submitting.</p>
                                    </div>
                                    <span class="text-xs font-mono font-semibold text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
                                        Final Step
                                    </span>
                                </div>

                                <!-- 9. Attachments (Dynamic Repeater) -->
                                <div class="p-6 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-800">
                                        <div class="flex items-center gap-2">
                                            <i class="fa fa-paperclip text-brand-primary text-base"></i>
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">
                                                9. Document Attachments
                                            </h4>
                                        </div>
                                        <button type="button" id="addAttachmentBtn" class="px-3 py-1.5 rounded-lg bg-brand-primary/10 hover:bg-brand-primary/20 border border-brand-primary/30 text-brand-primary text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i class="fa fa-plus"></i>
                                            <span>Add Another Attachment</span>
                                        </button>
                                    </div>

                                    <div class="space-y-3" id="attachmentsContainer">
                                        <!-- Attachment 1: Certificate / Marksheet -->
                                        <div class="p-3.5 rounded-xl bg-slate-900/80 border border-slate-800 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center attachment-row">
                                            <div class="sm:col-span-5">
                                                <input type="text" name="attachment_titles[]" value="J.S.C / S.S.C Marksheet or Certificate" placeholder="Document Name" class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-700 text-white text-xs">
                                            </div>
                                            <div class="sm:col-span-6">
                                                <input type="file" name="attachment_files[]" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                                            </div>
                                            <div class="sm:col-span-1 text-center">
                                                <button type="button" class="text-slate-600 cursor-not-allowed text-xs p-1" title="Initial attachment slot">
                                                    <i class="fa fa-lock"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Attachment 2: NID / Birth Certificate -->
                                        <div class="p-3.5 rounded-xl bg-slate-900/80 border border-slate-800 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center attachment-row">
                                            <div class="sm:col-span-5">
                                                <input type="text" name="attachment_titles[]" value="National ID / Birth Certificate Copy" placeholder="Document Name" class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-700 text-white text-xs">
                                            </div>
                                            <div class="sm:col-span-6">
                                                <input type="file" name="attachment_files[]" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                                            </div>
                                            <div class="sm:col-span-1 text-center">
                                                <button type="button" class="text-rose-400 hover:text-rose-300 text-xs p-1 delete-attachment-btn transition-colors" title="Delete attachment">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 10. Rules & Regulations (Mandatory Agreement) -->
                                <div class="p-6 rounded-2xl bg-slate-950/80 border border-amber-500/30 shadow-lg">
                                    <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-800">
                                        <span class="w-6 h-6 rounded-md bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs font-mono font-bold">10</span>
                                        <h4 class="text-xs font-bold uppercase tracking-wider text-amber-300 flex items-center gap-2">
                                            <i class="fa fa-gavel"></i>
                                            <span>Rules &amp; Regulations</span>
                                        </h4>
                                    </div>

                                    <ol class="list-decimal list-outside pl-5 space-y-2 text-xs text-slate-300 leading-relaxed font-sans mb-6">
                                        <li>Application must appropriately fill &amp; submit the admission form. Incomplete/not properly filled form will be rejected. Avoid rewriting/cutting while filling the form.</li>
                                        <li>Applicant must study and understand the rules and regulations of Wake Up ICT Academy and act accordingly.</li>
                                        <li>Students will pay 100% of the total fees while taking admission, or as per approved coaching installment schedule.</li>
                                        <li>Students are advised to take full responsibilities for their belongings. If anything unwanted happens, the authority will not be responsible.</li>
                                        <li>Authority reserves the right to approve or disapprove any applicant.</li>
                                        <li>Smoking or any kind of drug abuse is strictly prohibited within academy premises.</li>
                                        <li>Students are not allowed to remove or take away any tangible asset or equipment from the academy.</li>
                                        <li>Students must hold and wear their ID card within the academy premises and lab sessions.</li>
                                        <li>Authority has the right to amend any provision or schedule at any time.</li>
                                    </ol>

                                    <!-- Mandatory Acceptance Checkbox as marked in mockup -->
                                    <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/40">
                                        <label class="flex items-start gap-3 cursor-pointer">
                                            <input type="checkbox" id="rulesAgreedCheckbox" name="rules_agreed" value="1" required class="mt-1 rounded border-amber-500 text-brand-primary focus:ring-brand-primary w-5 h-5 bg-slate-900">
                                            <span class="text-xs sm:text-sm font-semibold text-amber-200 leading-snug">
                                                I have carefully read, understood, and accept all the above 9 Rules &amp; Regulations of Wake Up ICT Institute. <span class="text-rose-400 font-bold">*</span>
                                            </span>
                                        </label>
                                        @error('rules_agreed')
                                            <p class="text-xs text-rose-400 mt-2 font-medium"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- 11. Declaration & Signature Confirmation -->
                                <div class="p-6 rounded-2xl bg-slate-950/60 border border-slate-800">
                                    <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-800">
                                        <span class="w-6 h-6 rounded-md bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">11</span>
                                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-200">
                                            Academy Declaration Pledge
                                        </h4>
                                    </div>

                                    <div class="space-y-2.5 text-xs text-slate-300 font-sans mb-6">
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa fa-check-circle text-brand-primary"></i>
                                            <span>I will maintain the discipline and cleanness of the academy at all times.</span>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa fa-check-circle text-brand-primary"></i>
                                            <span>I will be regular in my classes and attend all physical laboratory sessions.</span>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <i class="fa fa-check-circle text-brand-primary"></i>
                                            <span>I will not destroy or tamper with any computer hardware, network, or academy property.</span>
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                                        <div class="text-slate-400 font-mono">
                                            <span>Application Date:</span>
                                            <strong class="text-white ml-1">{{ date('d F, Y') }}</strong>
                                        </div>
                                        <div class="text-slate-400 font-mono text-center sm:text-right">
                                            <span class="text-slate-500">Applicant Signature:</span>
                                            <strong class="text-brand-primary ml-1 uppercase">[Electronic Submission Verified]</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= WIZARD BOTTOM NAVIGATION TOOLBAR ================= -->
                            <div class="mt-10 pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                                <!-- Previous Step Button -->
                                <button type="button" id="wizardPrevBtn" class="w-full sm:w-auto px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 transition-all flex items-center justify-center gap-2 cursor-pointer invisible">
                                    <i class="fa fa-arrow-left"></i>
                                    <span>Previous Step</span>
                                </button>

                                <!-- Step Status Chip -->
                                <div class="text-xs font-mono text-slate-400 text-center">
                                    <span id="stepStatusChip">Step 1 of 4: Student &amp; Family Info</span>
                                </div>

                                <!-- Next Step / Final Submit Button Container -->
                                <div class="w-full sm:w-auto">
                                    <!-- Next Step Button (Shown on Steps 1, 2, 3) -->
                                    <button type="button" id="wizardNextBtn" class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2.5 cursor-pointer">
                                        <span>Continue to Next Step</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>

                                    <!-- Final Submit Button (Shown on Step 4) -->
                                    <button type="submit" id="submitAdmissionBtn" class="hidden w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-0.5 flex items-center justify-center gap-2.5 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                                        <i class="fa fa-paper-plane"></i>
                                        <span>Submit Online Admission</span>
                                    </button>
                                </div>
                            </div>

                            <p id="submitWarningNote" class="hidden text-center text-xs text-amber-400/90 mt-3 flex items-center justify-center gap-1.5 font-sans">
                                <i class="fa fa-info-circle"></i>
                                <span>Please accept the Rules &amp; Regulations in Step 4 before submitting.</span>
                            </p>
                        </form>
                    </div>
                </div>

                <!-- Right 4 Columns: Sticky Course Overview & Live Form Summary -->
                <div class="lg:col-span-4 sticky top-28 space-y-6">
                    <div class="rounded-3xl bg-slate-900/90 border border-slate-800 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">
                        
                        <!-- Course Image Preview -->
                        <div class="relative w-full h-44 rounded-2xl overflow-hidden mb-6 bg-slate-950 border border-slate-800/80 group shadow-md">
                            <img src="{{ URL::asset($course->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $course->course_title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 rounded-lg bg-brand-primary text-slate-950 font-mono font-bold text-xs uppercase tracking-wider shadow">
                                    Admissions Open
                                </span>
                            </div>
                        </div>

                        <!-- Live Application Summary Card -->
                        <div class="p-4 rounded-2xl bg-slate-950/90 border border-brand-primary/20 mb-6 space-y-2.5">
                            <span class="text-[10px] font-mono uppercase tracking-wider text-brand-primary font-bold block">Live Application Summary</span>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-400">Applicant:</span>
                                <strong id="summaryApplicantName" class="text-white font-mono uppercase truncate max-w-[160px]">{{ old('student_name', 'Not entered yet') }}</strong>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-slate-400">Wizard Progress:</span>
                                <strong id="summaryProgressPercent" class="text-emerald-400 font-mono font-bold">Step 1 (25%)</strong>
                            </div>
                            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-800/80">
                                <span class="text-slate-400">Total Course Fee:</span>
                                <strong id="summaryTotalFee" class="text-emerald-400 font-mono text-sm font-bold">৳ {{ $formatPrice($course->price) }}/-</strong>
                            </div>
                        </div>

                        <!-- Course Title & Metadata List -->
                        <div class="mb-6 pb-6 border-b border-slate-800">
                            <h3 class="text-lg font-bold text-white leading-snug mb-2">
                                {{ $course->course_title }}
                            </h3>
                            <ul class="space-y-3 text-xs text-slate-300 mt-4">
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2 text-slate-400">
                                        <i class="fa fa-calendar text-brand-primary"></i>
                                        <span>Duration</span>
                                    </span>
                                    <span class="font-semibold text-white font-mono">{{ $course->time_line }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2 text-slate-400">
                                        <i class="fa fa-users text-brand-primary"></i>
                                        <span>Batch Capacity</span>
                                    </span>
                                    <span class="font-semibold text-white font-mono">{{ $course->student_quantity }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2 text-slate-400">
                                        <i class="fa fa-desktop text-brand-primary"></i>
                                        <span>Class Format</span>
                                    </span>
                                    <span class="font-semibold text-emerald-400">Physical Lab Coaching</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Facilities List -->
                        @if(count($course_fassilities) > 0)
                            <div class="pt-2 mb-6">
                                <span class="text-xs font-mono uppercase tracking-wider text-slate-400 block mb-3">Course Privileges</span>
                                <ul class="space-y-2">
                                    @foreach ($course_fassilities as $item)
                                        <li class="flex items-start gap-2 text-slate-300 text-xs leading-relaxed">
                                            <i class="fa fa-check text-brand-primary mt-0.5 flex-shrink-0"></i>
                                            <span>{{ $item->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Admission Hotline Box -->
                        <div class="p-4 rounded-2xl bg-slate-950/90 border border-slate-800 text-xs text-slate-400 space-y-1.5">
                            <div class="flex items-center gap-2 text-white font-semibold">
                                <i class="fa fa-headphones text-brand-primary"></i>
                                <span>Admissions Support Helpline</span>
                            </div>
                            <p class="font-mono text-emerald-400 font-bold text-sm">
                                +88 01791612121
                            </p>
                            <p class="text-[11px] text-slate-500">
                                2nd Floor, Namnu Tower, Panna Chattar, Rajbari. Open Sat–Thu.
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- ================= STEP-WISE WIZARD & INTERACTIVITY ENGINE ================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 4;
    const maxVisitedStep = { value: 1 };

    const stepPanes = document.querySelectorAll('.wizard-step-pane');
    const stepIndicators = document.querySelectorAll('.wizard-step-indicator');
    const progressBar = document.getElementById('wizardProgressBar');
    const prevBtn = document.getElementById('wizardPrevBtn');
    const nextBtn = document.getElementById('wizardNextBtn');
    const submitBtn = document.getElementById('submitAdmissionBtn');
    const stepStatusChip = document.getElementById('stepStatusChip');
    const summaryProgressPercent = document.getElementById('summaryProgressPercent');
    const summaryApplicantName = document.getElementById('summaryApplicantName');
    const wizardCard = document.getElementById('admissionWizardCard');

    const stepLabels = [
        "Step 1 of 4: Student & Family Info",
        "Step 2 of 4: Personal, Contact & NID",
        "Step 3 of 4: Education & Selected Courses",
        "Step 4 of 4: Attachments, Rules & Submission"
    ];

    // Update Wizard View
    function renderStep(step) {
        currentStep = step;
        if (step > maxVisitedStep.value) {
            maxVisitedStep.value = step;
        }

        // Show active pane with animation
        stepPanes.forEach(pane => {
            const paneStep = parseInt(pane.getAttribute('data-step'), 10);
            if (paneStep === currentStep) {
                pane.classList.remove('hidden');
                pane.classList.remove('wizard-step-anim');
                void pane.offsetWidth; // Force CSS reflow
                pane.classList.add('wizard-step-anim');
            } else {
                pane.classList.add('hidden');
            }
        });

        // Update Progress Bar Percentage
        const percent = (currentStep / totalSteps) * 100;
        if (progressBar) {
            progressBar.style.width = percent + '%';
        }
        if (summaryProgressPercent) {
            summaryProgressPercent.textContent = `Step ${currentStep} (${percent}%)`;
        }

        // Update Step Badges
        stepIndicators.forEach((btn, index) => {
            const stepNum = index + 1;
            const iconWrap = btn.querySelector('.indicator-icon-wrap');
            const numEl = btn.querySelector('.indicator-num');
            const checkEl = btn.querySelector('.indicator-check');
            const pulseRingEl = btn.querySelector('.indicator-pulse-ring');
            const titleEl = btn.querySelector('.indicator-title');

            if (stepNum < currentStep) {
                // Completed Step
                btn.className = 'wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer border-emerald-500/40 bg-emerald-500/10 text-emerald-400';
                if (iconWrap) iconWrap.className = 'indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all bg-emerald-400 text-slate-950';
                if (numEl) numEl.classList.add('hidden');
                if (checkEl) checkEl.classList.remove('hidden');
                if (pulseRingEl) pulseRingEl.classList.add('hidden');
                if (titleEl) titleEl.className = 'indicator-title text-xs font-bold tracking-tight text-emerald-300';
            } else if (stepNum === currentStep) {
                // Active Step
                btn.className = 'wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center cursor-pointer border-brand-primary bg-brand-primary/10 text-brand-primary shadow-glow-emerald/30';
                if (iconWrap) iconWrap.className = 'indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all bg-brand-primary text-slate-950 font-bold ring-2 ring-brand-primary ring-offset-2 ring-offset-slate-950';
                if (numEl) numEl.classList.remove('hidden');
                if (checkEl) checkEl.classList.add('hidden');
                if (pulseRingEl) pulseRingEl.classList.remove('hidden');
                if (titleEl) titleEl.className = 'indicator-title text-xs font-bold tracking-tight text-white';
            } else {
                // Inactive / Pending Step
                const canClick = stepNum <= maxVisitedStep.value;
                btn.className = `wizard-step-indicator flex flex-col items-center p-3 rounded-2xl border transition-all text-center ${canClick ? 'cursor-pointer hover:border-slate-600' : 'cursor-default opacity-60'} border-slate-800 bg-slate-950/40 text-slate-500`;
                if (iconWrap) iconWrap.className = 'indicator-icon-wrap w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold font-mono mb-1.5 transition-all bg-slate-900 border border-slate-700 text-slate-400';
                if (numEl) numEl.classList.remove('hidden');
                if (checkEl) checkEl.classList.add('hidden');
                if (pulseRingEl) pulseRingEl.classList.add('hidden');
                if (titleEl) titleEl.className = 'indicator-title text-xs font-bold tracking-tight text-slate-400';
            }
        });

        // Bottom Controls Visibility
        if (prevBtn) {
            if (currentStep === 1) {
                prevBtn.classList.add('invisible');
            } else {
                prevBtn.classList.remove('invisible');
            }
        }

        if (nextBtn && submitBtn) {
            if (currentStep === totalSteps) {
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
        }

        if (stepStatusChip) {
            stepStatusChip.textContent = stepLabels[currentStep - 1];
        }

        // Smooth scroll to top of wizard card if scrolled past
        if (wizardCard) {
            const cardRect = wizardCard.getBoundingClientRect();
            if (cardRect.top < 80) {
                window.scrollTo({
                    top: window.scrollY + cardRect.top - 100,
                    behavior: 'smooth'
                });
            }
        }
    }

    // Step Validation Engine
    function validateStep(step) {
        const pane = document.querySelector(`.wizard-step-pane[data-step="${step}"]`);
        if (!pane) return true;

        const requiredInputs = pane.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        let firstInvalid = null;

        requiredInputs.forEach(input => {
            // For radio groups, check if any in the group is checked
            if (input.type === 'radio') {
                const groupName = input.name;
                const anyChecked = pane.querySelector(`input[name="${groupName}"]:checked`);
                if (!anyChecked) {
                    isValid = false;
                    const card = input.closest('.gender-card') || input.parentElement;
                    card.classList.add('field-error-shake', 'border-rose-500');
                    setTimeout(() => card.classList.remove('field-error-shake'), 450);
                    if (!firstInvalid) firstInvalid = input;
                }
            } else if (!input.value || input.value.trim() === '') {
                isValid = false;
                input.classList.add('field-error-shake', 'border-rose-500', 'bg-rose-500/10');
                setTimeout(() => input.classList.remove('field-error-shake'), 450);
                if (!firstInvalid) firstInvalid = input;
            } else {
                input.classList.remove('border-rose-500', 'bg-rose-500/10');
            }
        });

        if (!isValid && firstInvalid) {
            firstInvalid.focus();
            return false;
        }

        return true;
    }

    // Next Step Button Click
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    renderStep(currentStep + 1);
                }
            }
        });
    }

    // Prev Step Button Click
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentStep > 1) {
                renderStep(currentStep - 1);
            }
        });
    }

    // Click on Step Indicator Badges (Permit jumping to any previously visited step)
    stepIndicators.forEach(btn => {
        btn.addEventListener('click', function() {
            const target = parseInt(this.getAttribute('data-step-target'), 10);
            if (target === currentStep) return;

            if (target < currentStep) {
                // Always allow moving back
                renderStep(target);
            } else if (target <= maxVisitedStep.value) {
                // If moving forward to already visited step, validate current
                if (validateStep(currentStep)) {
                    renderStep(target);
                }
            } else if (target === currentStep + 1) {
                if (validateStep(currentStep)) {
                    renderStep(target);
                }
            }
        });
    });

    // 1. Photo File Live Preview
    const photoInput = document.getElementById('student_photo_input');
    const photoPreviewImg = document.getElementById('photoPreviewImg');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    photoPreviewImg.src = evt.target.result;
                    photoPreviewImg.classList.remove('hidden');
                    photoPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 2. Date of Birth -> Age Automatic Real-time Calculation
    const dobInput = document.getElementById('date_of_birth');
    const ageInput = document.getElementById('age');

    function calculateAge(dobString) {
        if (!dobString) return '';
        const dob = new Date(dobString);
        if (isNaN(dob.getTime())) return '';
        const today = new Date();
        let years = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            years--;
        }
        return years > 0 ? years : 0;
    }

    if (dobInput && ageInput) {
        dobInput.addEventListener('change', function() {
            const computedAge = calculateAge(this.value);
            if (computedAge !== '') {
                ageInput.value = computedAge;
            }
        });

        if (dobInput.value && !ageInput.value) {
            ageInput.value = calculateAge(dobInput.value);
        }
    }

    // 3. Present Address -> Permanent Address Sync Checkbox
    const presentAddr = document.getElementById('present_address');
    const permAddr = document.getElementById('permanent_address');
    const sameAddrCheck = document.getElementById('sameAddressCheck');

    if (sameAddrCheck && presentAddr && permAddr) {
        sameAddrCheck.addEventListener('change', function() {
            if (this.checked) {
                permAddr.value = presentAddr.value;
                permAddr.setAttribute('readonly', 'readonly');
                permAddr.classList.add('opacity-75', 'bg-slate-950');
            } else {
                permAddr.removeAttribute('readonly');
                permAddr.classList.remove('opacity-75', 'bg-slate-950');
            }
        });

        presentAddr.addEventListener('input', function() {
            if (sameAddrCheck.checked) {
                permAddr.value = this.value;
            }
        });
    }

    // 4. Dynamic Educational Qualification Repeater
    const addQualificationBtn = document.getElementById('addQualificationBtn');
    const qualificationsTbody = document.getElementById('qualificationsTbody');

    if (addQualificationBtn && qualificationsTbody) {
        addQualificationBtn.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.className = 'qualification-row';
            newRow.innerHTML = `
                <td class="p-2">
                    <select name="degrees[]" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                        <option value="Honors / Bachelor / Degree">Honors / Bachelor / Degree</option>
                        <option value="Masters / Post Graduate">Masters / Post Graduate</option>
                        <option value="H.S.C / Alim / A-Level">H.S.C / Alim / A-Level</option>
                        <option value="S.S.C / Dakhil / O-Level">S.S.C / Dakhil / O-Level</option>
                        <option value="Diploma in Engineering">Diploma in Engineering</option>
                        <option value="Others" selected>Others</option>
                    </select>
                </td>
                <td class="p-2">
                    <input type="text" name="boards[]" placeholder="Board / University" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                </td>
                <td class="p-2">
                    <input type="text" name="results[]" placeholder="Result / GPA" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs">
                </td>
                <td class="p-2">
                    <input type="text" name="passing_years[]" placeholder="Passing Year" class="w-full px-2.5 py-2 rounded-lg bg-slate-900 border border-slate-700 text-white focus:outline-none focus:border-brand-primary text-xs font-mono">
                </td>
                <td class="p-2 text-center">
                    <button type="button" class="text-rose-400 hover:text-rose-300 text-sm p-1 delete-qualification-btn transition-colors" title="Delete Row">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            `;
            qualificationsTbody.appendChild(newRow);
        });

        qualificationsTbody.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-qualification-btn');
            if (btn) {
                const row = btn.closest('.qualification-row');
                if (row) {
                    row.remove();
                }
            }
        });
    }

    // 5. Dynamic Attachments Repeater
    const addAttachmentBtn = document.getElementById('addAttachmentBtn');
    const attachmentsContainer = document.getElementById('attachmentsContainer');

    if (addAttachmentBtn && attachmentsContainer) {
        addAttachmentBtn.addEventListener('click', function() {
            const count = attachmentsContainer.querySelectorAll('.attachment-row').length + 1;
            const newRow = document.createElement('div');
            newRow.className = 'p-3.5 rounded-xl bg-slate-900/80 border border-slate-800 grid grid-cols-1 sm:grid-cols-12 gap-3 items-center attachment-row';
            newRow.innerHTML = `
                <div class="sm:col-span-5">
                    <input type="text" name="attachment_titles[]" value="Additional Document ${count}" placeholder="Document Name" class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-700 text-white text-xs">
                </div>
                <div class="sm:col-span-6">
                    <input type="file" name="attachment_files[]" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="w-full text-xs text-slate-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                </div>
                <div class="sm:col-span-1 text-center">
                    <button type="button" class="text-rose-400 hover:text-rose-300 text-xs p-1 delete-attachment-btn transition-colors" title="Delete attachment">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            `;
            attachmentsContainer.appendChild(newRow);
        });

        attachmentsContainer.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-attachment-btn');
            if (btn) {
                const row = btn.closest('.attachment-row');
                if (row) {
                    row.remove();
                }
            }
        });
    }

    // 6. Dynamic Courses Checkbox Selection and Live Total Calculation
    const courseCheckboxes = document.querySelectorAll('.course-checkbox');
    const selectedCoursesCount = document.getElementById('selectedCoursesCount');
    const calculatedTotalFee = document.getElementById('calculatedTotalFee');
    const hiddenCourseFee = document.getElementById('hidden_course_fee');
    const summaryTotalFee = document.getElementById('summaryTotalFee');

    function updateCourseTotals() {
        let count = 0;
        let total = 0;

        courseCheckboxes.forEach(cb => {
            const label = cb.closest('.course-selection-label');
            const price = parseFloat(label.getAttribute('data-price')) || 0;

            if (cb.checked) {
                count++;
                total += price;
                label.classList.add('border-brand-primary', 'bg-brand-primary/10');
                label.classList.remove('border-slate-800');
            } else {
                label.classList.remove('border-brand-primary', 'bg-brand-primary/10');
                label.classList.add('border-slate-800');
            }
        });

        const formattedTotal = '৳ ' + total.toLocaleString('en-US') + '/-';

        if (selectedCoursesCount) {
            selectedCoursesCount.textContent = count;
        }
        if (calculatedTotalFee) {
            calculatedTotalFee.textContent = formattedTotal;
        }
        if (hiddenCourseFee) {
            hiddenCourseFee.value = total;
        }
        if (summaryTotalFee) {
            summaryTotalFee.textContent = formattedTotal;
        }
    }

    courseCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateCourseTotals);
    });
    updateCourseTotals();

    // 7. Rules and Regulations Checkbox -> Submit Enable Validator
    const rulesCheck = document.getElementById('rulesAgreedCheckbox');
    const submitWarningNote = document.getElementById('submitWarningNote');

    function toggleSubmitState() {
        if (!rulesCheck || !submitBtn) return;
        if (rulesCheck.checked) {
            submitBtn.removeAttribute('disabled');
            if (submitWarningNote) {
                submitWarningNote.classList.add('hidden');
            }
        } else {
            submitBtn.setAttribute('disabled', 'disabled');
            if (submitWarningNote) {
                submitWarningNote.classList.remove('hidden');
            }
        }
    }

    if (rulesCheck) {
        rulesCheck.addEventListener('change', toggleSubmitState);
        toggleSubmitState();
    }

    // Live Sidebar Summary updater
    window.updateSidebarSummary = function() {
        const studentNameInput = document.getElementById('student_name');
        if (studentNameInput && summaryApplicantName) {
            const val = studentNameInput.value.trim();
            summaryApplicantName.textContent = val !== '' ? val : 'Not entered yet';
        }
    };

    // Initialize first step
    renderStep(1);
});
</script>
@endsection
