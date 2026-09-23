@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-28 pb-24">
    <!-- Ambient Background Lighting & Mesh -->
    <div class="absolute inset-0 bg-grid-mesh opacity-20 pointer-events-none"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-primary/10 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute bottom-1/3 right-10 w-[450px] h-[450px] bg-brand-cyan/10 rounded-full blur-[120px] pointer-events-none"></div>

    <!-- Header & Breadcrumbs Hero Section -->
    <section class="relative py-10 border-b border-slate-800/80 bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs font-mono text-slate-400 mb-4" aria-label="Breadcrumb">
                <a href="{{ url('/') }}" class="hover:text-brand-primary transition-colors">Home</a>
                <span class="text-slate-600">/</span>
                <a href="{{ route('academic-training') }}" class="hover:text-brand-primary transition-colors">Training</a>
                <span class="text-slate-600">/</span>
                <a href="{{ url('training/' . $course->course_slug) }}" class="hover:text-brand-primary transition-colors">{{ Str::limit($course->course_title, 25) }}</a>
                <span class="text-slate-600">/</span>
                <span class="text-brand-primary font-semibold">Registration</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono tracking-wider uppercase mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-primary animate-ping"></span>
                        <span>{{ __('frontend.student.reg_title') }}</span>
                    </div>
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        {{ $course->course_title }}
                    </h1>
                </div>

                <div class="flex items-center gap-3 self-start md:self-auto">
                    <div class="px-4 py-2.5 rounded-xl bg-slate-900/90 border border-slate-800 text-right">
                        <span class="text-xs font-mono text-slate-400 block">{{ __('frontend.student.course_fee_label') }}</span>
                        <span class="text-lg font-bold font-mono text-emerald-400">৳ {{ number_format($course->price) }}/-</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Registration Section -->
    <section class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <!-- Left 8 Columns: Enhanced Registration Form -->
                <div class="lg:col-span-8">
                    <div class="rounded-2xl bg-slate-900/80 border border-slate-800/80 backdrop-blur-xl p-6 sm:p-10 shadow-2xl">
                        
                        <div class="border-b border-slate-800 pb-6 mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-white flex items-center gap-3">
                                <span class="w-9 h-9 rounded-xl bg-brand-primary/10 border border-brand-primary/20 flex items-center justify-center text-brand-primary text-base">
                                    <i class="fa fa-id-card-o"></i>
                                </span>
                                <span>{{ __('frontend.student.reg_title') }}</span>
                            </h2>
                            <p class="text-slate-400 text-sm mt-2">
                                Please fill out the registration form accurately. All fields marked with (<span class="text-rose-400 font-bold">*</span>) are mandatory.
                            </p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-8 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm">
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
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="course_fee" value="{{ $course->price }}">

                            <!-- ================= PART 1: Basic Information ================= -->
                            <div class="mb-10">
                                <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-800/70">
                                    <span class="w-6 h-6 rounded-md bg-brand-primary/20 text-brand-primary flex items-center justify-center text-xs font-mono font-bold">1</span>
                                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-200">
                                        {{ __('frontend.student.name') }} &amp; Family Info
                                    </h3>
                                </div>

                                <div class="space-y-6">
                                    <!-- Student Name -->
                                    <div>
                                        <label for="student_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                            {{ __('frontend.student.name') }} <span class="text-rose-400">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input id="student_name" type="text" name="student_name" 
                                                value="{{ old('student_name') }}"
                                                data-validation="required"
                                                placeholder="{{ __('frontend.student.name_placeholder') }}"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('student_name') border-rose-500 @enderror">
                                        </div>
                                        @error('student_name')
                                            <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Gender Selection -->
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                            {{ __('frontend.student.gender') }} <span class="text-rose-400">*</span>
                                        </label>
                                        <div class="grid grid-cols-2 gap-4">
                                            <label class="relative flex items-center justify-center gap-3 p-3.5 rounded-xl border border-slate-800 bg-slate-950/50 hover:bg-slate-800/40 cursor-pointer transition-all duration-200 gender-card group has-[:checked]:border-brand-primary has-[:checked]:bg-brand-primary/10">
                                                <input type="radio" name="gander" value="male" class="text-brand-primary focus:ring-brand-primary w-4 h-4" {{ old('gander', 'male') === 'male' ? 'checked' : '' }}>
                                                <span class="flex items-center gap-2 text-sm font-medium text-slate-200 group-hover:text-white">
                                                    <i class="fa fa-mars text-brand-primary"></i>
                                                    <span>{{ __('frontend.student.male') }}</span>
                                                </span>
                                            </label>

                                            <label class="relative flex items-center justify-center gap-3 p-3.5 rounded-xl border border-slate-800 bg-slate-950/50 hover:bg-slate-800/40 cursor-pointer transition-all duration-200 gender-card group has-[:checked]:border-brand-primary has-[:checked]:bg-brand-primary/10">
                                                <input type="radio" name="gander" value="female" class="text-brand-primary focus:ring-brand-primary w-4 h-4" {{ old('gander') === 'female' ? 'checked' : '' }}>
                                                <span class="flex items-center gap-2 text-sm font-medium text-slate-200 group-hover:text-white">
                                                    <i class="fa fa-venus text-pink-400"></i>
                                                    <span>{{ __('frontend.student.female') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        @error('gander')
                                            <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Parents Info -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Father's Name -->
                                        <div>
                                            <label for="fathers_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.father_name') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-male"></i>
                                                </div>
                                                <input id="fathers_name" type="text" name="fathers_name" 
                                                    value="{{ old('fathers_name') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.father_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('fathers_name') border-rose-500 @enderror">
                                            </div>
                                            @error('fathers_name')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Mother's Name -->
                                        <div>
                                            <label for="mothers_name" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.mother_name') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-female"></i>
                                                </div>
                                                <input id="mothers_name" type="text" name="mothers_name" 
                                                    value="{{ old('mothers_name') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.mother_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('mothers_name') border-rose-500 @enderror">
                                            </div>
                                            @error('mothers_name')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= PART 2: Personal & Contact Information ================= -->
                            <div class="mb-10">
                                <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-800/70">
                                    <span class="w-6 h-6 rounded-md bg-brand-cyan/20 text-brand-cyan flex items-center justify-center text-xs font-mono font-bold">2</span>
                                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-200">
                                        {{ __('frontend.student.personal_info') }}
                                    </h3>
                                </div>

                                <div class="space-y-6">
                                    <!-- Nationality & NID -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="nationality" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.nationality') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-flag"></i>
                                                </div>
                                                <input id="nationality" type="text" name="nationality" 
                                                    value="{{ old('nationality', 'Bangladeshi') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.nationality_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('nationality') border-rose-500 @enderror">
                                            </div>
                                            @error('nationality')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="national_id_no" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.nid') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-address-card"></i>
                                                </div>
                                                <input id="national_id_no" type="number" name="national_id_no" 
                                                    value="{{ old('national_id_no') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.nid_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('national_id_no') border-rose-500 @enderror">
                                            </div>
                                            @error('national_id_no')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Mobile & Email -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="personal_call_no" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.mobile') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input id="personal_call_no" type="text" name="personal_call_no" 
                                                    value="{{ old('personal_call_no') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.mobile_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('personal_call_no') border-rose-500 @enderror">
                                            </div>
                                            @error('personal_call_no')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.email') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <input id="email" type="email" name="email" 
                                                    value="{{ old('email') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.email_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('email') border-rose-500 @enderror">
                                            </div>
                                            @error('email')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Date of Birth, Religion & Occupation -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <label for="age" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.dob') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input id="age" type="text" name="age" 
                                                    value="{{ old('age') }}"
                                                    data-validation="required"
                                                    placeholder="YYYY-MM-DD"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('age') border-rose-500 @enderror">
                                            </div>
                                            @error('age')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="religion" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.religion') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <input id="religion" type="text" name="religion" 
                                                    value="{{ old('religion', 'Islam') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.religion_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('religion') border-rose-500 @enderror">
                                            </div>
                                            @error('religion')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="occupation" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.occupation') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                                <input id="occupation" type="text" name="occupation" 
                                                    value="{{ old('occupation', 'Student') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.occupation_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('occupation') border-rose-500 @enderror">
                                            </div>
                                            @error('occupation')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Addresses -->
                                    <div class="space-y-6">
                                        <!-- Present Address -->
                                        <div>
                                            <label for="present_address" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.present_address') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <textarea id="present_address" name="present_address" rows="3"
                                                data-validation="required"
                                                placeholder="{{ __('frontend.student.present_placeholder') }}"
                                                class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm resize-y @error('present_address') border-rose-500 @enderror">{{ old('present_address') }}</textarea>
                                            @error('present_address')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Permanent Address -->
                                        <div>
                                            <div class="flex items-center justify-between mb-2">
                                                <label for="permanent_address" class="block text-xs font-semibold uppercase tracking-wider text-slate-300">
                                                    {{ __('frontend.student.permanent_address') }} <span class="text-rose-400">*</span>
                                                </label>
                                                <button type="button" id="copyAddressBtn" class="text-xs font-mono text-brand-primary hover:underline flex items-center gap-1 focus:outline-none">
                                                    <i class="fa fa-copy"></i>
                                                    <span>Same as present</span>
                                                </button>
                                            </div>
                                            <textarea id="permanent_address" name="permanent_address" rows="3"
                                                data-validation="required"
                                                placeholder="{{ __('frontend.student.permanent_placeholder') }}"
                                                class="w-full px-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm resize-y @error('permanent_address') border-rose-500 @enderror">{{ old('permanent_address') }}</textarea>
                                            @error('permanent_address')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================= PART 3: Educational Qualifications ================= -->
                            <div class="mb-10">
                                <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-800/70">
                                    <span class="w-6 h-6 rounded-md bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-mono font-bold">3</span>
                                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-200">
                                        {{ __('frontend.student.education') }}
                                    </h3>
                                </div>

                                <div class="space-y-6">
                                    <!-- Educational Qualification Degree -->
                                    <div>
                                        <label for="educational_qualification" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                            {{ __('frontend.student.education') }} <span class="text-rose-400">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-graduation-cap"></i>
                                            </div>
                                            <select id="educational_qualification" name="educational_qualification" data-validation="required"
                                                class="w-full pl-10 pr-10 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm appearance-none cursor-pointer @error('educational_qualification') border-rose-500 @enderror">
                                                <option value="" disabled {{ old('educational_qualification') ? '' : 'selected' }}>{{ __('frontend.student.choose_option') }}</option>
                                                <option value="Masters" {{ old('educational_qualification') === 'Masters' ? 'selected' : '' }}>Masters</option>
                                                <option value="Honers" {{ old('educational_qualification') === 'Honers' ? 'selected' : '' }}>Honors / Bachelor's</option>
                                                <option value="H.S.C" {{ old('educational_qualification') === 'H.S.C' ? 'selected' : '' }}>H.S.C / Equivalent</option>
                                                <option value="S.S.C" {{ old('educational_qualification') === 'S.S.C' ? 'selected' : '' }}>S.S.C / Equivalent</option>
                                                <option value="Others" {{ old('educational_qualification') === 'Others' ? 'selected' : '' }}>Others</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-500">
                                                <i class="fa fa-chevron-down text-xs"></i>
                                            </div>
                                        </div>
                                        @error('educational_qualification')
                                            <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Result & Passing Year -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="result" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.result') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-trophy"></i>
                                                </div>
                                                <input id="result" type="text" name="result" 
                                                    value="{{ old('result') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.result_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('result') border-rose-500 @enderror">
                                            </div>
                                            @error('result')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="passing_year" class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">
                                                {{ __('frontend.student.passing_year') }} <span class="text-rose-400">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                                <input id="passing_year" type="text" name="passing_year" 
                                                    value="{{ old('passing_year') }}"
                                                    data-validation="required"
                                                    placeholder="{{ __('frontend.student.passing_year_placeholder') }}"
                                                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-slate-950/60 border border-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary focus:ring-1 focus:ring-brand-primary transition-all text-sm @error('passing_year') border-rose-500 @enderror">
                                            </div>
                                            @error('passing_year')
                                                <p class="text-xs text-rose-400 mt-1 flex items-center gap-1"><i class="fa fa-exclamation-circle"></i> {{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" class="w-full py-4 px-8 rounded-xl font-bold text-sm tracking-wider uppercase bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1 flex items-center justify-center gap-3 cursor-pointer group">
                                    <i class="fa fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                                    <span>{{ __('frontend.student.submit_btn') }}</span>
                                </button>
                                <p class="text-center text-xs text-slate-500 mt-3 flex items-center justify-center gap-1.5">
                                    <i class="fa fa-lock text-emerald-400"></i>
                                    <span>Your information is safely processed under Wake Up ICT admissions policy.</span>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right 4 Columns: Sticky Course Overview Sidebar -->
                <div class="lg:col-span-4 sticky top-28 space-y-6">
                    <div class="rounded-2xl bg-slate-900/90 border border-slate-800 backdrop-blur-xl shadow-2xl p-6 sm:p-8 overflow-hidden">
                        
                        <!-- Course Image Preview -->
                        <div class="relative w-full h-48 rounded-xl overflow-hidden mb-6 bg-slate-950 border border-slate-800/80 group">
                            <img src="{{ URL::asset($course->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $course->course_title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="px-2.5 py-1 rounded-md bg-brand-primary text-slate-950 font-mono font-bold text-xs">
                                    {{ __('frontend.academic.admissions_open') ?? 'Admissions Open' }}
                                </span>
                            </div>
                        </div>

                        <!-- Course Title & Fee -->
                        <div class="mb-6 pb-6 border-b border-slate-800">
                            <h3 class="text-lg font-bold text-white leading-snug mb-3">
                                {{ $course->course_title }}
                            </h3>
                            <span class="text-xs font-mono uppercase tracking-wider text-slate-400 block">{{ __('frontend.student.course_fee_label') }}</span>
                            <div class="text-3xl font-extrabold font-mono text-white tracking-tight mt-1 flex items-baseline gap-2">
                                <span>৳ {{ number_format($course->price) }}</span>
                                <span class="text-xs font-mono font-normal text-brand-primary uppercase">BDT</span>
                            </div>
                        </div>

                        <!-- Course Metadata List -->
                        <ul class="space-y-4 text-sm mb-6">
                            <li class="flex items-center justify-between text-slate-300">
                                <span class="flex items-center gap-2.5 text-slate-400">
                                    <i class="fa fa-calendar text-brand-primary"></i>
                                    <span>{{ __('frontend.student.course_duration_label') }}</span>
                                </span>
                                <span class="font-semibold text-white font-mono">{{ $course->time_line }}</span>
                            </li>

                            <li class="flex items-center justify-between text-slate-300">
                                <span class="flex items-center gap-2.5 text-slate-400">
                                    <i class="fa fa-users text-brand-primary"></i>
                                    <span>{{ __('frontend.student.batch_capacity_label') }}</span>
                                </span>
                                <span class="font-semibold text-white font-mono">{{ $course->student_quantity }}</span>
                            </li>

                            @php
                                $sl = 1;
                            @endphp
                            @foreach ($course_members as $member)
                                @php
                                    $instructorUser = App\User::find($member->member_id);
                                @endphp
                                @if($instructorUser)
                                    <li class="flex items-center justify-between text-slate-300">
                                        <span class="flex items-center gap-2.5 text-slate-400">
                                            <i class="fa fa-user-circle text-brand-primary"></i>
                                            <span>{{ __('frontend.student.instructor_label') }}</span>
                                        </span>
                                        <span class="font-semibold text-white">{{ $instructorUser->name }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <!-- Facilities List -->
                        @if(count($course_fassilities) > 0)
                            <div class="pt-4 border-t border-slate-800 mb-6">
                                <span class="text-xs font-mono uppercase tracking-wider text-slate-400 block mb-3">Course Privileges</span>
                                <ul class="space-y-2.5">
                                    @foreach ($course_fassilities as $item)
                                        <li class="flex items-start gap-2.5 text-slate-300 text-xs leading-relaxed">
                                            <i class="fa fa-check text-brand-primary mt-0.5 flex-shrink-0"></i>
                                            <span>{{ $item->title }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Help / Query Support Box -->
                        <div class="p-4 rounded-xl bg-slate-950/70 border border-slate-800 text-xs text-slate-400">
                            <div class="flex items-center gap-2 text-white font-semibold mb-1">
                                <i class="fa fa-headphones text-brand-cyan"></i>
                                <span>Need Help Registering?</span>
                            </div>
                            <p class="leading-relaxed">Contact our admissions support helpline directly at <strong class="text-brand-primary">{{ app_setting('contact_phone', '01700-000000') }}</strong></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- jQuery UI Datepicker initialization & Address Copy Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Datepicker on #age if jQuery UI datepicker is available
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.datepicker === 'function') {
            jQuery('#age').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                yearRange: '1970:2020',
                showAnim: 'slideDown'
            });
        }

        // Copy Present Address to Permanent Address
        var copyBtn = document.getElementById('copyAddressBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                var present = document.getElementById('present_address');
                var perm = document.getElementById('permanent_address');
                if (present && perm) {
                    perm.value = present.value;
                    perm.dispatchEvent(new Event('input'));
                }
            });
        }
    });
</script>
@endsection
