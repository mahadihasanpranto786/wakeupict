@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Edit Profile & Settings — Wake Up ICT')
@section('page_title', 'Account Settings')
@section('page_crumb', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">

    <!-- Validation Error Alerts -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-300 text-xs space-y-1">
            @foreach($errors->all() as $error)
                <p class="flex items-center gap-2">
                    <i class="fa fa-exclamation-circle text-rose-400"></i>
                    <span>{{ $error }}</span>
                </p>
            @endforeach
        </div>
    @endif

    <!-- Profile Details Form -->
    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl">
        <h2 class="text-lg font-bold text-white flex items-center gap-2 pb-4 border-b border-slate-800 mb-6">
            <i class="fa fa-user-circle text-brand-primary"></i>
            <span>Update Personal Information</span>
        </h2>

        <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Avatar Preview & Upload -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b border-slate-800">
                <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-brand-primary/50 shadow-glow-emerald">
                <div class="flex-1 text-center sm:text-left">
                    <label class="block text-xs font-semibold text-white mb-1">Profile Photo</label>
                    <p class="text-[11px] text-slate-400 mb-3">Upload a clean square photo (JPEG, PNG, WEBP - Max 2MB).</p>
                    <input type="file" name="avatar" accept="image/*" class="text-xs text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-brand-primary hover:file:bg-slate-700 cursor-pointer">
                </div>
            </div>

            <!-- 1. Core Profile Details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Full Name (পূর্ণ নাম) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Phone Number (মোবাইল নম্বর) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Email Address (ইমেইল ঠিকানা)
                    </label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">
                        Registration Number / Student ID (অপরিবর্তনীয়)
                    </label>
                    <input type="text" value="{{ $student->registration_number ?: $student->student_id_code }}" readonly disabled class="w-full px-4 py-3 rounded-xl bg-slate-950/40 border border-slate-800 text-slate-400 text-sm font-mono cursor-not-allowed">
                </div>
            </div>

            <!-- 2. Personal & Family Information (ব্যক্তিগত ও পারিবারিক তথ্য) -->
            <div class="pt-6 border-t border-slate-800">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
                    <i class="fa fa-id-card text-brand-cyan"></i>
                    <span>Personal &amp; Family Information (ব্যক্তিগত ও পারিবারিক তথ্য)</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Father's Name (পিতার নাম)</label>
                        <input type="text" name="fathers_name" value="{{ old('fathers_name', $student->getProfileDetail('fathers_name')) }}" placeholder="যেমন: MD. ABDUR RAHIM" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Mother's Name (মাতার নাম)</label>
                        <input type="text" name="mothers_name" value="{{ old('mothers_name', $student->getProfileDetail('mothers_name')) }}" placeholder="যেমন: RAHIMA BEGUM" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Gender (লিঙ্গ)</label>
                        @php $genderVal = old('gander', strtolower($student->getProfileDetail('gander', 'male'))); @endphp
                        <select name="gander" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white text-sm focus:outline-none focus:border-brand-primary">
                            <option value="male" {{ $genderVal === 'male' ? 'selected' : '' }}>Male (পুরুষ)</option>
                            <option value="female" {{ $genderVal === 'female' ? 'selected' : '' }}>Female (মহিলা)</option>
                            <option value="other" {{ $genderVal === 'other' ? 'selected' : '' }}>Other (অন্যান্য)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Date of Birth / Age (জন্মতারিখ বা বয়স)</label>
                        <input type="text" name="age" value="{{ old('age', $student->getProfileDetail('age')) }}" placeholder="যেমন: 22 Years বা DD/MM/YYYY" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Religion (ধর্ম)</label>
                        @php $relVal = old('religion', $student->getProfileDetail('religion', 'Islam')); @endphp
                        <select name="religion" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white text-sm focus:outline-none focus:border-brand-primary">
                            <option value="Islam" {{ $relVal === 'Islam' ? 'selected' : '' }}>Islam (ইসলাম)</option>
                            <option value="Hinduism" {{ $relVal === 'Hinduism' ? 'selected' : '' }}>Hinduism (হিন্দু)</option>
                            <option value="Christianity" {{ $relVal === 'Christianity' ? 'selected' : '' }}>Christianity (খ্রিস্টান)</option>
                            <option value="Buddhism" {{ $relVal === 'Buddhism' ? 'selected' : '' }}>Buddhism (বৌদ্ধ)</option>
                            <option value="Other" {{ $relVal === 'Other' ? 'selected' : '' }}>Other (অন্যান্য)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Occupation (পেশা)</label>
                        <input type="text" name="occupation" value="{{ old('occupation', $student->getProfileDetail('occupation', 'Student')) }}" placeholder="যেমন: Student, Job, Freelancer" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Nationality (জাতীয়তা)</label>
                        <input type="text" name="nationality" value="{{ old('nationality', $student->getProfileDetail('nationality', 'Bangladeshi')) }}" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">National ID / Birth Cert (এনআইডি / জন্ম নিবন্ধন নম্বর)</label>
                        <input type="text" name="national_id_no" value="{{ old('national_id_no', $student->getProfileDetail('national_id_no')) }}" placeholder="জাতীয় পরিচয়পত্র বা জন্ম সনদ নম্বর" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                    </div>
                </div>
            </div>

            <!-- 3. Address Details (ঠিকানা সংক্রান্ত তথ্য) -->
            <div class="pt-6 border-t border-slate-800">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
                    <i class="fa fa-map-marker text-emerald-400"></i>
                    <span>Address Details (ঠিকানা সংক্রান্ত তথ্য)</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Present Address (বর্তমান ঠিকানা)</label>
                        <textarea name="present_address" rows="3" placeholder="গ্রাম/রোড, ডাকঘর, উপজেলা, জেলা..." class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">{{ old('present_address', $student->getProfileDetail('present_address')) }}</textarea>
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Permanent Address (স্থায়ী ঠিকানা)</label>
                        <textarea name="permanent_address" rows="3" placeholder="গ্রাম/রোড, ডাকঘর, উপজেলা, জেলা..." class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">{{ old('permanent_address', $student->getProfileDetail('permanent_address')) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- 4. Educational & Academic Background (শিক্ষাগত যোগ্যতা) -->
            <div class="pt-6 border-t border-slate-800">
                <h3 class="text-sm font-bold text-white flex items-center gap-2 mb-4">
                    <i class="fa fa-graduation-cap text-violet-400"></i>
                    <span>Educational Qualification (শিক্ষাগত যোগ্যতা)</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 text-xs">
                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Highest Qualification (ডিগ্রি / স্তর)</label>
                        <input type="text" name="educational_qualification" value="{{ old('educational_qualification', $student->getProfileDetail('educational_qualification')) }}" placeholder="যেমন: SSC, HSC, Graduate, Diploma" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Result / GPA / Division (ফলাফল)</label>
                        <input type="text" name="result" value="{{ old('result', $student->getProfileDetail('result')) }}" placeholder="যেমন: GPA 5.00 বা 1st Class" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                    </div>

                    <div>
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Passing Year (পাসের সাল)</label>
                        <input type="text" name="passing_year" value="{{ old('passing_year', $student->getProfileDetail('passing_year')) }}" placeholder="যেমন: 2024" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-800">
                <button type="submit" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-white font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald">
                    Save Profile Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Password Change Form -->
    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl">
        <h2 class="text-lg font-bold text-white flex items-center gap-2 pb-4 border-b border-slate-800 mb-6">
            <i class="fa fa-lock text-brand-cyan"></i>
            <span>Change Account Password</span>
        </h2>

        <form action="{{ route('student.profile.password') }}" method="POST" class="space-y-5 max-w-lg">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Current Password</label>
                <input type="password" name="current_password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">New Password (Min 6 characters)</label>
                <input type="password" name="password" required minlength="6" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" required minlength="6" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
            </div>

            <div class="pt-2">
                <button type="submit" class="px-6 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider border border-slate-700 transition-all">
                    Update Password
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
