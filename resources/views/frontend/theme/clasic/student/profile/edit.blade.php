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

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-xs">
                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" required class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $student->email) }}" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary font-mono">
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Student ID Code</label>
                    <input type="text" value="{{ $student->student_id_code }}" readonly disabled class="w-full px-4 py-3 rounded-xl bg-slate-950/40 border border-slate-800 text-slate-400 text-sm font-mono cursor-not-allowed">
                </div>

                @if($admitted)
                    <div class="sm:col-span-2">
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Present Address</label>
                        <textarea name="present_address" rows="2" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">{{ old('present_address', $admitted->present_address) }}</textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block font-semibold text-slate-300 uppercase tracking-wider mb-2">Permanent Address</label>
                        <textarea name="permanent_address" rows="2" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 text-white placeholder-slate-500 text-sm focus:outline-none focus:border-brand-primary">{{ old('permanent_address', $admitted->permanent_address) }}</textarea>
                    </div>
                @endif
            </div>

            <div class="flex justify-end pt-4 border-t border-slate-800">
                <button type="submit" class="px-6 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald">
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
