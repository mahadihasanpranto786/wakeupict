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
                        <span>Reg: {{ $student->registration_number ?: $student->student_id_code }}</span>
                        <span class="text-slate-600">·</span>
                        <span class="text-emerald-400 font-sans normal-case font-bold">One Student Account</span>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-extrabold text-white">{{ $student->name }}</h1>
                    <p class="text-xs text-slate-400 mt-1 flex flex-wrap items-center gap-3">
                        <span><i class="fa fa-phone text-brand-primary mr-1"></i>{{ $student->phone }}</span>
                        @if($student->email)
                            <span><i class="fa fa-envelope text-brand-cyan mr-1"></i>{{ $student->email }}</span>
                        @endif
                        <span class="px-2.5 py-0.5 rounded-full bg-violet-500/20 text-violet-300 text-[11px] font-semibold border border-violet-500/30">
                            <i class="fa fa-graduation-cap mr-1"></i>{{ $courses->count() }} {{ Str::plural('Course', $courses->count()) }} Enrolled
                        </span>
                    </p>
                </div>
            </div>

            <a href="{{ route('student.profile.edit') }}" class="px-5 py-3 rounded-xl bg-brand-primary hover:bg-brand-accent text-white font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                <i class="fa fa-pencil"></i>
                <span>Edit Profile / Change Password</span>
            </a>
        </div>
    </div>

    <!-- Enrolled Courses Card (Multi-Course Enrollment) -->
    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-800">
            <div>
                <h2 class="text-base font-bold text-white flex items-center gap-2">
                    <i class="fa fa-book-open text-brand-primary"></i>
                    <span>Enrolled Courses &amp; Applications (আমার কোর্সসমূহ)</span>
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">
                    আপনার এই একটি অ্যাকাউন্ট থেকেই সকল কোর্সে অংশগ্রহণ ও অগ্রগতি পরিচালিত হয়।
                </p>
            </div>
            <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 font-mono text-xs font-bold">
                {{ $courses->count() }} Active {{ Str::plural('Course', $courses->count()) }}
            </span>
        </div>

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($courses as $c)
                    <div class="p-4 rounded-2xl bg-slate-950/70 border border-slate-800/80 hover:border-slate-700 transition-all flex flex-col justify-between gap-3">
                        <div class="flex items-start justify-between gap-2">
                            <div class="space-y-1">
                                <span class="text-[10px] uppercase font-mono font-bold tracking-wider px-2 py-0.5 rounded bg-blue-500/15 text-blue-400 border border-blue-500/30">
                                    {{ ucfirst($c['enrollment_type'] ?? 'Course') }}
                                </span>
                                <h3 class="text-sm font-bold text-white mt-1 leading-snug">
                                    {{ $c['title'] }}
                                </h3>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase font-mono {{ ($c['status'] ?? 'active') === 'admitted' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-brand-primary/20 text-brand-primary border border-brand-primary/30' }}">
                                {{ $c['status'] ?? 'Active' }}
                            </span>
                        </div>

                        <div class="pt-3 border-t border-slate-900 flex items-center justify-between text-xs text-slate-400">
                            <span>
                                <i class="fa fa-users text-slate-500 mr-1"></i>
                                {{ $c['batch_number'] ? 'Batch: ' . $c['batch_number'] : 'Batch Pending' }}
                            </span>
                            @if(isset($c['id']))
                                <a href="{{ route('student.courses.details', $c['id']) }}" class="text-brand-primary hover:text-brand-accent font-semibold flex items-center gap-1 text-xs">
                                    <span>Course Details</span>
                                    <i class="fa fa-arrow-right text-[10px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 rounded-2xl bg-slate-950/40 border border-slate-800/60 text-center text-slate-400 text-xs">
                <i class="fa fa-graduation-cap text-2xl text-slate-600 mb-2 block"></i>
                <span>Currently no active course enrollment found.</span>
            </div>
        @endif
    </div>

    <!-- Personal & Academic Information Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Personal Information -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-5">
            <h2 class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-slate-800">
                <i class="fa fa-user-circle text-brand-primary"></i>
                <span>Personal &amp; Family Information (ব্যক্তিগত তথ্য)</span>
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
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Father's Name</span>
                    <span class="text-white font-medium">{{ $student->getProfileDetail('fathers_name') ?: 'Not provided' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Mother's Name</span>
                    <span class="text-white font-medium">{{ $student->getProfileDetail('mothers_name') ?: 'Not provided' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Gender / Nationality</span>
                    <span class="text-white capitalize">{{ $student->getProfileDetail('gander', 'Not set') }} / {{ $student->getProfileDetail('nationality', 'Bangladeshi') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Age / Date of Birth</span>
                    <span class="text-white">{{ $student->getProfileDetail('age') ?: 'Not provided' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Religion / Occupation</span>
                    <span class="text-white">{{ $student->getProfileDetail('religion', 'Islam') }} / {{ $student->getProfileDetail('occupation', 'Student') }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">National ID / Birth Cert</span>
                    <span class="text-white font-mono">{{ $student->getProfileDetail('national_id_no') ?: 'Not provided' }}</span>
                </div>
            </div>
        </div>

        <!-- Academic & Address Details -->
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-5">
            <h2 class="text-base font-bold text-white flex items-center gap-2 pb-3 border-b border-slate-800">
                <i class="fa fa-graduation-cap text-brand-cyan"></i>
                <span>Academic &amp; Address Details (ঠিকানা ও শিক্ষা)</span>
            </h2>

            <div class="space-y-3.5 text-xs">
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Highest Qualification</span>
                    <span class="text-white font-medium">{{ $student->getProfileDetail('educational_qualification') ?: 'Not provided' }}</span>
                </div>
                <div class="flex justify-between py-1 border-b border-slate-800/60">
                    <span class="text-slate-400">Passing Year &amp; Result</span>
                    <span class="text-white">
                        @if($student->getProfileDetail('passing_year') || $student->getProfileDetail('result'))
                            {{ $student->getProfileDetail('passing_year') ?: 'Year N/A' }} ({{ $student->getProfileDetail('result') ?: 'Result N/A' }})
                        @else
                            Not provided
                        @endif
                    </span>
                </div>
                <div class="py-1 border-b border-slate-800/60">
                    <span class="text-slate-400 block mb-1">Present Address (বর্তমান ঠিকানা)</span>
                    <span class="text-white leading-relaxed">{{ $student->getProfileDetail('present_address') ?: 'Not provided yet. Update via Edit Profile.' }}</span>
                </div>
                <div class="py-1 border-b border-slate-800/60">
                    <span class="text-slate-400 block mb-1">Permanent Address (স্থায়ী ঠিকানা)</span>
                    <span class="text-white leading-relaxed">{{ $student->getProfileDetail('permanent_address') ?: 'Not provided yet. Update via Edit Profile.' }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span class="text-slate-400">Account Created</span>
                    <span class="text-white font-mono">{{ $student->created_at ? $student->created_at->format('d M, Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
