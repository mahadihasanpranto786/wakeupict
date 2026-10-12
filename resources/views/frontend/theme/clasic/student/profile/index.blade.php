@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'My Profile — Wake Up ICT Student Portal')
@section('page_title', 'Student Profile')
@section('page_crumb', 'Profile Details')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <!-- Profile Header Card -->
    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-brand-primary shadow-glow-emerald">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-primary/10 border border-brand-primary/20 text-brand-primary text-xs font-mono font-bold uppercase mb-2">
                        <span>ID: {{ $student->student_id_code }}</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-white">{{ $student->name }}</h1>
                    <p class="text-xs text-slate-400 mt-1 flex items-center gap-3">
                        <span><i class="fa fa-phone text-brand-primary mr-1"></i>{{ $student->phone }}</span>
                        @if($student->email)
                            <span><i class="fa fa-envelope text-brand-cyan mr-1"></i>{{ $student->email }}</span>
                        @endif
                    </p>
                </div>
            </div>

            <a href="{{ route('student.profile.edit') }}" class="px-5 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                <i class="fa fa-pencil"></i>
                <span>Edit Profile / Change Password</span>
            </a>
        </div>
    </div>

    <!-- Personal & Academic Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Personal Information -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-5">
            <h2 class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-slate-800">
                <i class="fa fa-user-circle text-brand-primary"></i>
                <span>Personal Information</span>
            </h2>

            <div class="space-y-3.5 text-xs">
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Full Name</span>
                    <span class="text-white font-medium">{{ $student->name }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Phone Number</span>
                    <span class="text-white font-mono">{{ $student->phone }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Email Address</span>
                    <span class="text-white font-mono">{{ $student->email ?: 'Not provided' }}</span>
                </div>
                @if($admitted)
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">Father's Name</span>
                        <span class="text-white font-medium">{{ $admitted->fathers_name ?: 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">Mother's Name</span>
                        <span class="text-white font-medium">{{ $admitted->mothers_name ?: 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">Gender / Nationality</span>
                        <span class="text-white">{{ $admitted->gander }} / {{ $admitted->nationality }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">National ID / Birth Cert</span>
                        <span class="text-white font-mono">{{ $admitted->national_id_no ?: 'N/A' }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Academic & Address Details -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-5">
            <h2 class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-slate-800">
                <i class="fa fa-graduation-cap text-brand-cyan"></i>
                <span>Academic & Address Details</span>
            </h2>

            <div class="space-y-3.5 text-xs">
                @if($admitted)
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">Highest Qualification</span>
                        <span class="text-white font-medium">{{ $admitted->educational_qualification ?: 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between py-1 border-b border-slate-800/60">
                        <span class="text-slate-400">Passing Year & Result</span>
                        <span class="text-white">{{ $admitted->passing_year }} ({{ $admitted->result }})</span>
                    </div>
                    <div class="py-1 border-b border-slate-800/60">
                        <span class="text-slate-400 block mb-1">Present Address</span>
                        <span class="text-white leading-relaxed">{{ $admitted->present_address ?: 'N/A' }}</span>
                    </div>
                    <div class="py-1 border-b border-slate-800/60">
                        <span class="text-slate-400 block mb-1">Permanent Address</span>
                        <span class="text-white leading-relaxed">{{ $admitted->permanent_address ?: 'N/A' }}</span>
                    </div>
                @else
                    <p class="text-slate-400 text-xs py-4">No additional background details recorded yet. You can update your address under Account Settings.</p>
                @endif
                <div class="flex justify-between py-1">
                    <span class="text-slate-400">Account Created</span>
                    <span class="text-white font-mono">{{ $student->created_at ? $student->created_at->format('d M, Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
