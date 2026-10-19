@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Student Dashboard — Wake Up ICT')
@section('page_title', 'Student Dashboard')
@section('page_crumb', 'Dashboard Overview')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    <!-- =========================================================================
         1. 10 MINUTE SCHOOL STYLE STUDENT WELCOME BANNER
         ========================================================================= -->
    <div class="student-card relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950/90 via-slate-900 to-slate-950 border border-emerald-500/30 p-6 sm:p-8 backdrop-blur-xl shadow-2xl">
        <!-- Ambient Glow -->
        <div class="absolute -right-16 -top-16 w-72 h-72 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="relative flex-shrink-0">
                    <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl object-cover border-2 border-emerald-400 shadow-glow-emerald">
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-400 border-2 border-slate-900" title="Active Campus Student"></span>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[11px] font-mono tracking-wider uppercase font-bold">
                            আইডি: {{ $student->student_id_code }}
                        </span>
                        @if($batch)
                            <span class="px-2.5 py-1 rounded-full bg-slate-800 text-slate-300 text-[11px] font-mono font-medium">
                                <i class="fa fa-users text-cyan-400 mr-1"></i> ব্যাচ: {{ $batch->batch_number }}
                            </span>
                        @endif
                        <span class="px-2.5 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[11px] font-mono font-medium">
                            <i class="fa fa-map-marker mr-1"></i> অফলাইন ল্যাব শিক্ষার্থী
                        </span>
                    </div>

                    <h1 class="text-xl sm:text-3xl font-extrabold text-white tracking-tight">
                        স্বাগতম, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">{{ $student->name }}</span>! 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1">
                        Wake Up ICT ক্যাম্পাস পোর্টালে আপনার স্বাগতম। আজকের ক্লাসের তথ্য, লেকচার শিট ও অগ্রগতি নিচে প্রদর্শিত হচ্ছে।
                    </p>
                </div>
            </div>

            <!-- 10MS Style Quick Navigation Shortcuts -->
            <!-- <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <a href="{{ route('student.materials.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold border border-slate-700 transition-all flex items-center gap-2">
                    <i class="fa fa-file-pdf-o text-rose-400"></i>
                    <span>লেকচার শিট</span>
                </a>
                <a href="{{ route('student.certificates.index') }}" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold border border-slate-700 transition-all flex items-center gap-2">
                    <i class="fa fa-certificate text-amber-400"></i>
                    <span>সার্টিফিকেট</span>
                </a>
                <a href="{{ route('student.courses.browse') }}" class="px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 text-xs font-black uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-1.5">
                    <i class="fa fa-plus-circle"></i>
                    <span>নতুন কোর্স</span>
                </a>
            </div> -->
        </div>
    </div>

    <!-- =========================================================================
         2. 10 MINUTE SCHOOL STYLE CORE METRICS ROW
         ========================================================================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Enrolled Course Card -->
        <!-- <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800/80 p-5 backdrop-blur-xl hover:border-emerald-500/40 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-medium text-slate-400">নিবন্ধিত কোর্স (Enrolled)</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-sm">
                    <i class="fa fa-graduation-cap"></i>
                </div>
            </div>
            <p class="text-base font-bold text-white truncate">
                {{ $course ? $course->course_title : 'কোর্স নির্ধারিত হয়নি' }}
            </p>
            <p class="text-[11px] font-mono text-emerald-400 mt-1 flex items-center gap-1">
                <i class="fa fa-check-circle"></i>
                <span>{{ $batch ? 'ব্যাচ: ' . $batch->batch_number : 'অ্যাডমিশন সম্পন্ন' }}</span>
            </p>
        </div> -->

        <!-- Attendance / Batch Status -->
        <!-- <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800/80 p-5 backdrop-blur-xl hover:border-cyan-500/40 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-medium text-slate-400">অফলাইন ল্যাব ব্যাচ</span>
                <div class="w-9 h-9 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center text-sm">
                    <i class="fa fa-calendar-check-o"></i>
                </div>
            </div>
            <p class="text-base font-bold text-white">
                {{ $batch ? $batch->batch_number : 'ক্যাম্পাস ল্যাব #১' }}
            </p>
            <p class="text-[11px] font-mono text-cyan-400 mt-1 flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                <span>সরাসরি ল্যাব প্র্যাকটিস চলমান</span>
            </p>
        </div> -->

        <!-- Total Paid Fee -->
        <!-- <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800/80 p-5 backdrop-blur-xl hover:border-emerald-500/40 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-medium text-slate-400">পরিশোধিত ফি (Paid)</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-sm">
                    <i class="fa fa-check-circle-o"></i>
                </div>
            </div>
            <p class="text-base font-bold text-emerald-400 font-mono">
                ৳ {{ number_format($totalPaid) }}
            </p>
            <p class="text-[11px] text-slate-400 mt-1 flex items-center justify-between">
                <span>{{ count($payments) }} টি রসিদ যাচাইকৃত</span>
                <a href="{{ route('student.receipts.index') }}" class="text-emerald-400 hover:underline">রসিদ</a>
            </p>
        </div> -->

        <!-- Outstanding Dues -->
        <!-- <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800/80 p-5 backdrop-blur-xl hover:border-amber-500/40 transition-all duration-300">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-medium text-slate-400">বকেয়া কিস্তি (Dues)</span>
                <div class="w-9 h-9 rounded-xl {{ $dueFee > 0 ? 'bg-rose-500/10 text-rose-400' : 'bg-emerald-500/10 text-emerald-400' }} flex items-center justify-center text-sm">
                    <i class="fa {{ $dueFee > 0 ? 'fa-exclamation-triangle' : 'fa-check' }}"></i>
                </div>
            </div>
            <p class="text-base font-bold {{ $dueFee > 0 ? 'text-rose-400' : 'text-emerald-400' }} font-mono">
                ৳ {{ number_format($dueFee) }}
            </p>
            <p class="text-[11px] {{ $dueFee > 0 ? 'text-rose-300' : 'text-emerald-300' }} mt-1 flex items-center justify-between">
                <span>{{ $dueFee > 0 ? 'বকেয়া রয়েছে' : 'সকল ফি পরিশোধিত' }}</span>
                @if($dueFee > 0)
                    <a href="{{ route('student.fees.index') }}" class="text-rose-400 hover:underline">পরিশোধ</a>
                @endif
            </p>
        </div> -->

    </div>

    <!-- =========================================================================
         3. CURRENT LEARNING & ACTIVE COURSE DETAILS
         ========================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Course Overview & Details (2 columns) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl">
                <div class="flex items-center justify-between pb-4 border-b border-slate-800 mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fa fa-bookmark text-brand-primary"></i>
                            <span>My Registered Program</span>
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Enrolled training course & curriculum overview</p>
                    </div>
                    @if($course)
                        <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-mono font-semibold">
                            Course Fee: ৳ {{ number_format($courseFee) }}
                        </span>
                    @endif
                </div>

                @if($course)
                    <div class="flex flex-col sm:flex-row gap-6 items-start">
                        @if($course->image)
                            <img src="{{ safe_asset($course->image) }}" alt="{{ $course->course_title }}" class="w-full sm:w-48 h-32 object-cover rounded-2xl border border-slate-800">
                        @else
                            <div class="w-full sm:w-48 h-32 rounded-2xl bg-slate-950 border border-slate-800 flex items-center justify-center text-slate-600 text-3xl">
                                <i class="fa fa-desktop"></i>
                            </div>
                        @endif
                        <div class="flex-1 space-y-3">
                            <h3 class="text-base sm:text-lg font-bold text-white leading-tight">
                                {{ $course->course_title }}
                            </h3>
                            <p class="text-xs text-slate-300 line-clamp-3 leading-relaxed">
                                {{ $course->short_description ?: 'Comprehensive technology training provided by Wake Up ICT expert instructors.' }}
                            </p>
                            <div class="flex flex-wrap items-center gap-4 pt-2 text-xs text-slate-400 font-mono">
                                <span><i class="fa fa-clock-o text-brand-primary mr-1"></i> {{ $course->time_line ?: '3 Months' }}</span>
                                <span><i class="fa fa-users text-brand-cyan mr-1"></i> Batch: {{ $batch ? $batch->batch_number : 'Assigned Soon' }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-8 text-center rounded-2xl bg-slate-950/50 border border-slate-800/60">
                        <i class="fa fa-info-circle text-brand-primary text-3xl mb-3"></i>
                        <h4 class="text-sm font-bold text-white mb-1">No Active Admission Linked</h4>
                        <p class="text-xs text-slate-400 max-w-md mx-auto mb-4">
                            You have activated your student account. Once our admission team verifies your enrollment, your assigned course materials and batch schedule will appear here.
                        </p>
                        <a href="{{ route('student.courses.browse') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs">
                            <i class="fa fa-search"></i>
                            <span>Explore Courses</span>
                        </a>
                    </div>
                @endif
            </div> -->

            <!-- Recent Payments Record -->
            <!-- <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800/80 p-6 sm:p-8 backdrop-blur-xl">
                <div class="flex items-center justify-between pb-4 border-b border-slate-800 mb-5">
                    <div>
                        <h2 class="text-lg font-bold text-white flex items-center gap-2">
                            <i class="fa fa-credit-card text-emerald-400"></i>
                            <span>Recent Payment Records</span>
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Verified installments and receipts</p>
                    </div>
                    <a href="{{ route('student.fees.index') }}" class="text-xs font-semibold text-brand-primary hover:underline">
                        View All
                    </a>
                </div>

                @if($payments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="text-slate-400 uppercase tracking-wider font-mono border-b border-slate-800">
                                <tr>
                                    <th class="pb-3">Date</th>
                                    <th class="pb-3">Amount</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Remark</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/60">
                                @foreach($payments->take(3) as $pm)
                                    <tr class="hover:bg-slate-800/30 transition-colors">
                                        <td class="py-3 font-mono text-slate-300">{{ $pm->date ?: $pm->created_at->format('Y-m-d') }}</td>
                                        <td class="py-3 font-bold text-emerald-400 font-mono">৳ {{ number_format((float)$pm->paid) }}</td>
                                        <td class="py-3">
                                            <span class="px-2 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 text-[10px] font-bold">Verified</span>
                                        </td>
                                        <td class="py-3 text-slate-400 truncate max-w-[150px]">{{ $pm->remark ?: 'Course Installment' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-xs text-slate-400 text-center py-6">No payment records available yet.</p>
                @endif
            </div> -->
        </div>

        <!-- Right: Profile Info & Quick Shortcuts (1 column) -->
        <div class="space-y-6">
            
            <!-- Student Identity Card -->
            <!-- <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800/80 p-6 backdrop-blur-xl space-y-4">
                <div class="flex items-center gap-4">
                    <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}" class="w-14 h-14 rounded-2xl object-cover border border-slate-700">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-sm font-bold text-white truncate">{{ $student->name }}</h3>
                        <p class="text-xs font-mono text-brand-primary truncate">{{ $student->student_id_code }}</p>
                        <p class="text-[11px] text-slate-400 truncate mt-0.5">{{ $student->phone }}</p>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-800 space-y-2 text-xs">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Account Status:</span>
                        <span class="text-emerald-400 font-semibold font-mono">Active</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Member Since:</span>
                        <span class="text-slate-300 font-mono">{{ $student->created_at ? $student->created_at->format('M Y') : '2026' }}</span>
                    </div>
                    @if($student->email)
                        <div class="flex justify-between">
                            <span class="text-slate-400">Email:</span>
                            <span class="text-slate-300 truncate max-w-[160px]">{{ $student->email }}</span>
                        </div>
                    @endif
                </div>

                <a href="{{ route('student.profile.index') }}" class="w-full py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-semibold text-xs flex items-center justify-center gap-2 transition-all">
                    <i class="fa fa-id-card-o"></i>
                    <span>View Student Profile</span>
                </a>
            </div> -->

            <!-- Helpdesk & Helpline Notice -->
            <!-- <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800/80 p-6 backdrop-blur-xl">
                <div class="w-10 h-10 rounded-xl bg-brand-cyan/10 text-brand-cyan flex items-center justify-center mb-4">
                    <i class="fa fa-headphones text-lg"></i>
                </div>
                <h3 class="text-sm font-bold text-white mb-1">Student Support Desk</h3>
                <p class="text-xs text-slate-300 leading-relaxed mb-4">
                    ক্লাস, পরীক্ষা বা যেকোনো অ্যাকাডেমিক প্রয়োজনে আমাদের সাপোর্ট টিমের সাথে সরাসরি যোগাযোগ করুন।
                </p>
                <div class="p-3 rounded-xl bg-slate-950/70 border border-slate-800 text-xs space-y-1">
                    <p class="text-slate-400">জরুরি হেল্পলাইন:</p>
                    <p class="text-white font-bold font-mono">{{ app_setting('contact_phone', '01791-612121') }}</p>
                </div>
            </div> -->

        </div>

    </div>

</div>
@endsection
